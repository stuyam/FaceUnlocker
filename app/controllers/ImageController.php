<?php

class ImageController extends \BaseController {

    public function upload()
    {
        if (!Input::has('name'))
        {
            return Response::make('failPlease Enter Your Twitter Handle');
        }

        if (!Input::has('local'))
        {
            return Response::make('failPlease Allow GPS to Enter Location');
        }

        if (!Input::hasFile('photo'))
        {
            return Response::make('failPlease Add Photo');
        }

        $id = substr(md5(uniqid()), 0, 10);

        $filepath = Input::file('photo')->getRealPath();
        $filetype = Input::file('photo')->getMimeType();
        $checksum = md5_file($filepath);

        $file = $this->fixRotation($filepath, $filetype);
        $this->tempSaveImage($id, $file);

        if ($this->doesExistInDatabase($checksum))
        {
            return Response::make('failPhoto has already been uploaded to this site, please take another');
        }

        if (!$this->doesContainFace($id))
        {
            return Response::make('failPhoto needs to contain your face :)');
        }

        //Delete Temp file and save to perminent
        $this->killTempSaveImage($id, $file);
        //Get that last page id of the item uploaded
        $pageid = $this->getLastItemId();
        //save current item
        $this->saveItem($id, Input::get('name'), Input::get('local'), $checksum);

        return Response::make($pageid);
    }

    private function saveItem($id, $name, $location, $checksum)
    {
        $name = preg_replace("/[^a-zA-Z0-9_]/", "", $name);
        $item = new Item;
        $item->page_id = $id;
        $item->name = $name;
        $item->location = $location;
        $item->checksum = $checksum;
        $item->save();

        return;
    }

    private function getLastItemId()
    {
        $newid = Item::max('id');

        return Item::find($newid)->page_id;
    }

    private function doesExistInDatabase($checksum)
    {
        return count(Item::where('checksum', '=', $checksum)->get()) ? TRUE : FALSE;
    }

    private function fixRotation($filepath, $filetype)
    {
        if ($filetype == 'image/png')
        {
            return image_fix_orientation(imagecreatefrompng($filepath), $filepath);
        } else
        {
            return image_fix_orientation(imagecreatefromjpeg($filepath), $filepath);
        }
    }

    private function killTempSaveImage($name, $file)
    {
        imagepng($file, public_path() . "/uploads/$name.png", 9);
        unlink(public_path() . "/tempuploads/$name.png");

        return;
    }

    private function tempSaveImage($name, $file)
    {
        imagepng($file, public_path() . "/tempuploads/$name.png");

        return;
    }

    private function doesContainFace($filename)
    {
        $ch = curl_init();
        $data = array('api_key'    => 'tOQvKfCvqOEuOrss',
                      'api_secret' => 'VuqlytMKq0CvNJnj',
                      'jobs'       => 'face',
                      'urls'       => asset("tempuploads/$filename.png")
        );

        curl_setopt($ch, CURLOPT_URL, 'http://rekognition.com/func/api/');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $bi = curl_exec($ch);
        curl_close($ch);
        $json = json_decode($bi);

        return count($json->face_detection) > 0 ? TRUE : FALSE;
    }

}
