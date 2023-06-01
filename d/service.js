
// get user data from above form
function getUserData() {
    var username = document.getElementById('username').value;
    var user_mobile = document.getElementById('user_mobile').value;
    var location = document.getElementById('location').value;
    var description = document.getElementById('desc').value;
    var verhicle = document.getElementById('verhicle').value;
    
    saveToDatabase(username, user_mobile, location_code, description,verhicle);
    
    }
     
    
    function saveToDatabase(username, user_mobile, location_code, description,verhicle) {
      $.ajax({
        type: "post",
        data: {
          username: username,
          user_mobile: user_mobile,
          location: location_code,
          description: description,
          verhicle: verhicle
          
          
        },
        cache: false,
        url: "saveServiceRequest.php",
        dataType: "text",
        success: function (data, status) {
          alert(data);
        },
        error: function (xhr, status, error) {
           alert(error);
        },
      });
    }
    