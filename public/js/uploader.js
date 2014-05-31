$(document).ready(function(){
  $('#all').show();
});


$('#cover').click(function(){
  $( this ).animate({
    top: "-110%",
  }, 500, function() {
    // Animation complete.
  });
});



$("#submit").click(function(){

  
      var formData = new FormData($('form#data')[0]);
      
      /* formData.append("photo", dataURItoBlob(document.getElementById('result_image').src)); */
  
      //$('#curtain').show();
  
      $.ajax({
          url: 'upload',
          type: 'POST',
          data: formData,
          async: false,
          success: function (data) {
              //alert(data)
              if(data.substring(0, 4) != 'fail')
                  window.location = 'http://faceunlocker.com/'+data;
              else
                  alert(data.substring(4));
          },
          error: function() { 
            alert('Use your front camera'); 
          },
          cache: false,
          contentType: false,
          processData: false
      });
      return false;

});
/*

function dataURItoBlob(dataURI)
{
    var byteString = atob(dataURI.split(',')[1]);

    var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0]

    var ab = new ArrayBuffer(byteString.length);
    var ia = new Uint8Array(ab);
    for (var i = 0; i < byteString.length; i++)
    {
        ia[i] = byteString.charCodeAt(i);
    }

    var bb = new Blob([ab], { "type": mimeString });
    return bb;
}

$("#cat").click(function(){
  var source_image = document.getElementById('cat');
  var result_image = document.getElementById('result_image');
  if (source_image.src == "") {
      alert("You must load an image first!");
      return false;
  }

  
  result_image.src = jic.compress(source_image,20).src;
});
*/




function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            //imageBin = jic.compress(imageBin,20).src;
            $('#swap').html('<img id="preview_image" src="' + e.target.result +'" alt="image" />');
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#photo").change(function(){
    readURL(this);
});




navigator.geolocation.getCurrentPosition (function (pos)
{
    var lat = pos.coords.latitude;
    var lng = pos.coords.longitude;
    var geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(lat, lng);

    geocoder.geocode({
        'latLng': latlng
    }, function(results, status) {

        $("#content").html('<strong class="info"><input type="hidden" name="local" value="' + results[5].formatted_address + '" required />' + results[5].formatted_address + '</strong>');
    });
});