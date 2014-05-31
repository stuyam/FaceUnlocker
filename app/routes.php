<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('main');
});

Route::post('/upload', 'ImageController@upload');


Route::get('/{page}', function($page){
	$collection = Item::where('page_id', '=', $page)->get();
	// if(isset($collection)){
	// 	return Redirect::to('/');
	// }

	//return Response::json($collection[0]);

	return View::make('view_page', $collection[0]);
});












// Route::post('/filecheck', function(){
//
// 	if (Input::hasFile('photo'))
// 	{
// 		$filepath = Input::file('photo')->getRealPath();
// 		$checksum = md5_file($filepath);
// 		if( Item::find($checksum)->checksum ){
// 			return Response::make('failPhoto has already been used, please use another photo');
// 		}
//
//
//
//
// 		$newfile = image_fix_orientation( imagecreatefromjpeg($filepath), $filepath);
// 		imagepng($newfile, public_path()."/uploads2/file.png");
//
// 		return Response::make('done');
// 	}
// 	return Response::make('no file');
// });
//
// Route::get('/tester', function(){
//
// 	$newfile = image_fix_orientation(imagecreatefromjpeg(public_path().'/test.jpeg'),  public_path().'/test.jpeg');
// 	imagepng($newfile, public_path().'/uploads2/file2.png');
//
// 	$ch = curl_init();
// 	$data = array('api_key' => 'tOQvKfCvqOEuOrss',
// 	              'api_secret' => 'VuqlytMKq0CvNJnj',
// 	              'jobs' => 'face',
// 	              'urls' => asset('uploads2/file2.png')
// 	              );
//
// 	curl_setopt($ch, CURLOPT_URL, 'http://rekognition.com/func/api/');
// 	curl_setopt($ch, CURLOPT_POST, 1);
// 	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// 	$bi = curl_exec($ch);
// 	curl_close($ch);
//
// 	return $bi;
//
// });
