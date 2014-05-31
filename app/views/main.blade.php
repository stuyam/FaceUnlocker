<!DOCTYPE html>
<html lang="eng">
<head>
    <title>Face Unlocker</title>
    <meta charset="utf-8">
    <meta name="description" concent="Foo">
    <meta name="author" content="Stuart Yamartino">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <div id="curtain"><img src="http://d2zgpgte76tf58.cloudfront.net/assets/img/loading.gif" width="40px" />Processing Photo</div>
    
    <div id="cover">
      <div class="container">
        <h2>Face Unlocker</h2>
        <h3>
          Share a photo of yourself. You will then unlock the previous persons photo.
        </h3>
        <br>
        <h4>(tap anywhere to start)</h4>
      </div>
    </div>

    <div class="container" id="all">

        <form id="data" method="post" enctype="multipart/form-data">
            <h1>Hello, my name is</h1>
            <h1 class="info"><input type="text" name="name" placeholder="@TwitterHandle"/></h1>
            <h1>from</h1>
            <h1>
                <div data-role="content" id="content">
                    <img src="http://d2zgpgte76tf58.cloudfront.net/assets/img/loading.gif" width="40px" />
                </div>
            </h1>
            <div class="btn btn-primary btn-file">
                <div id="swap">
                    <img src="http://d2zgpgte76tf58.cloudfront.net/assets/img/camera.png" width="40px" />
                </div>
                <input type="file" accept="image/*" capture="camera" name="photo" id="photo" />
            </div>
            <button class="btn btn-success" id="submit">Submit</button>
        </form>

      <div class="holder" id="holder_result">
        <img id="result_image" class='img_container' />
      </div>
        
    </div>

    <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script src="{{ asset('js/uploader.js') }}"></script>
</body>
</html>
