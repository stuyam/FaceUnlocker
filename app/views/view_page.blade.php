<!DOCTYPE html>
<html lang="eng">
<head>
    <title>Face Unlocker</title>
    <meta charset="utf-8">
    <meta name="description" concent="Foo">
    <meta name="author" content="Stuart Yamartino">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/page.css') }}">
</head>
<body>
    
    <div id="cover">
      <div class="container">
        <h2>Congratulations!</h2>
        <h3>You have unlocked a new face!</h3>
      </div>
    </div>
    
    <div class="container" id="all">

        <h1>Say hello to</h1>
        <h4>@{{{ $name }}}</h4>
        <h1>from</h1>
        <h4>{{{ $location }}}</h4>
        
        <a href="https://twitter.com/share" class="twitter-share-button" data-text="Just found @{{{ $name }}}'s face on Face Unlocker" data-size="large" data-count="none" data-hashtags="FaceUnlocker">Tweet</a><span id="reall">no really, say hello</span>
        
        
    </div>
    
    <div class="container" style="visibility:hidden;">

        <h1>Say hello to</h1>
        <h4>@{{{ $name }}}</h4>
        <h1>from</h1>
        <h4>{{{ $location }}}</h4>
        
        <a href="https://twitter.com/share" class="twitter-share-button" data-text="Just found @{{{ $name }}}'s face on Face Unlocker" data-size="large" data-count="none" data-hashtags="FaceUnlocker">Tweet</a><span id="reall">no really, say hello</span>
        
        
    </div>
    
    <img id="image" src='{{ asset("uploads/$page_id.png") }}' />

    <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script>
    $(document).ready(function(){
      $('#all').show();
      setTimeout(later, 2000);
    });
    
    function later(){
      $('#cover').animate({
        top: "110%",
      }, 2000, function() {
        // Animation complete.
      });
    }
    </script>
    
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
    </script>
</body>
</html>