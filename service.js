// get user data from above form

$(document).ready(function () {


  $('#form1').submit(function (e) {
    e.preventDefault();

    getUserData();
  });
});

function getUserData() {
  var username = document.getElementById('username').value;
  var user_mobile = document.getElementById('user_mobile').value;
  var location = document.getElementById('location').value;
  var description = document.getElementById('desc').value;
  var verhicle = document.getElementById('verhicle').value;

  //convert all values to uppercase
  username = username.toUpperCase();
  location = location.toUpperCase();
  verhicle = verhicle.toUpperCase();

  showSpin(1);
  saveToDatabase(username, user_mobile, location, description, verhicle);
}

function saveToDatabase(
  username,
  user_mobile,
  location_code,
  description,
  verhicle
) {


  $.ajax({
    type: 'post',
    data: {
      username: username,
      user_mobile: user_mobile,
      location: location_code,
      description: description,
      verhicle: verhicle,
    },
    cache: false,
    url: 'saveServiceRequest.php',
    dataType: 'text',
    success: function (data, status) {
      hideAllSpin();
      if(data==1){
        showToast('aeToastS', 'Thank You For your request',  'Crystal Clear Washing bay Team will contact you soon!', '10');
     
      }
      else{
        showToast('aeToastE', 'Something Went Wrong', 'Please try again later!', '10');
      }
    
    },
    error: function (xhr, status, error) {
      hideAllSpin();
      alert(error);
    },
  });
}
