var cusName = null;
var cusLoc = null;
var cusMobile = null;
var cusDesc = 34;
var cusservice = null;
var receiverEMail = [];
var receiverMobile = [];
var receiver = null;

$(document).ready(function () {
  document.getElementById('overlay').style.display = 'none';
  $('#form').submit(function (e) {
    e.preventDefault();
    getInputE();
    saveData();
  });
  init();
  getData();
  getServices();

  $('#ss').keyup(function () {});

  function getInputE() {
    cusName = $('#taName').val();
    cusLoc = $('#taLoc').val();
    cusMobile = $('#mobile').val();
    cusDesc = $('#tadesc').val();
    cusservice = $('#taservice').val();

    cusName = trimV(cusName);
    cusName = cusName.toUpperCase();
    cusMobile = trimV(cusMobile);
    cusDesc = trimV(cusDesc);
    cusDesc = cusDesc.toUpperCase();
    cusservice = trimV(cusservice);
    cusLoc = trimV(cusLoc);
    cusLoc = cusLoc.toUpperCase();
  }

  $('#aeMyesNo').on('click', '#aeMyesNoBt', function (e) {
    //  $("#aeMyesNo").modal("hide")
  });

  $('#myModal').on('click', '#btResend', function (e) {});

  $('#aeMsuccessw').on('hidden.bs.modal', function () {
    openPageReplace('index.php');
  });

  $('#aeMerror').on('hidden.bs.modal', function () {
    hideSpin();
  });
});

// Define the AJAX function to retrieve the JSON data
function getData() {
  receiverEMail.length = 0;

  $.ajax({
    url: 'home_4.php', // replace with your PHP script URL
    dataType: 'json',
    success: function (data) {
      // Define an array to store the email and mobile  receiverEMail
      // Loop through each object in the JSON data array
      $.each(data, function (index, object) {
        // Extract the email and mobile  receiverEMail from the object and add them to the array
        receiverEMail.push(object.email);
      });
    },
    error: function (xhr, status, error) {
      // alert("Error: " + error);
    },
  });
}

function init() {
  $.ajax({
    type: 'post',
    cache: false,
    url: 'home_2.php',
    dataType: 'json',
    success: function (data, status) {
      $('#gmanager').text(data[0]);
    },
    error: function (xhr, status, error) {
      console.log(error);
    },
  });
}

function getServices() {
  $.ajax({
    type: 'post',
    cache: false,
    url: 'home_.php',
    dataType: 'json',
    success: function (data, status) {
      $('#managerList').empty();
      // Loop through the data and add each washer as a list item
      for (var i = 0; i < data.length; i++) {
        var listItem = $('<li></li>').text(data[i]);
        listItem.css('color', 'blue'); // Set the text color to green
        listItem.css('font-weight', 'bold'); // Set the font weight to bold
        listItem.css('font-size', '16px');
        $('#managerList').append(listItem);
      }
      $('#managerList').css('list-style', 'disc').css('color', 'green');
    },
    error: function (xhr, status, error) {
      console.log(error);
    },
  });
}

function saveData() {
  alert(1)
  //document.getElementById('overlay').style.display = 'flex';
  $.ajax({
    type: 'post',
    cache: false,
    data: {
      cusname: cusName,
      cusloc: cusLoc,
      cusmobile: cusMobile,
      cusDesc: cusDesc,
      cusservice: cusservice,
    },
    url: 'home_3.php',
    dataType: 'text',
    success: function (data, status) {
      alert(data)

      sendEmailRecursive(0);
      if (data != 1) {
        showAEMerror('COULD NOT SAVE DATA', 'DATA NOT SAVED');
        // return
      }

 
    },
    error: function (xhr, status, error) {
      console.log(error);
    },
  });
}

var sentData = null;


function sendEmailRecursive(index) {
  if (index >= receiverEMail.length) {
   
    document.getElementById('overlay').style.display = 'none';
    showAEMsuccessw("REQUEST SENT SUCCESSFULLY!","THANK YOU.");
    return;
  }

  var receiver = receiverEMail[index];
  $.ajax({
    type: 'post',
    cache: false,
    data: {
      receiver: receiver,
      cusname: cusName,
      cusloc: cusLoc,
      cusmobile: cusMobile,
      cusDesc: cusDesc,
      cusservice: cusservice,
    },
    url: 'homeEmail.php',
    dataType: 'text',
    success: function (data, status) {

      alert(data);

      
      // Proceed to send the next email recursively
      sendEmailRecursive(index + 1);
    },
    error: function (xhr, status, error) {
      document.getElementById('overlay').style.display = 'none';

      showAEMerror('COULD NOT SAVE DATA');
      
      // Proceed to send the next email recursively
      sendEmailRecursive(index + 1);
    },
  });
}

// Start sending emails recursively from the first email address



$('#exitIcon').click(function () {
  openPageReplace('index.php');
});
