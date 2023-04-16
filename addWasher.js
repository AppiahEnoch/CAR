var nFullname = '';
var nEmail = '';
var nMobile = '';
var ghana = '';
var location1 = '';

$(document).ready(function () {
  $('#aeMsuccessw').on('hidden.bs.modal', function () {
    openPageReplace('login.php');
  });

  $('#form3').submit(function (e) {
    e.preventDefault();
    showSpin();
    getInput();
    saveWasher();
  });

  $('#lblogin4B').click(function () {
    openPageReplace('login.php');
  });

  $('#washerImage').click(function () {
    $('#carImageF').click();
  });

  $('#carImageF').change(function () {
    if (isFileImage('carImageF')) {
      updateImage('carImageF', 'washerImage');
    }
  });
});

function myAjax1() {
  $.ajax({
    type: 'post',
    data: {
      id: id,
    },
    cache: false,
    url: '',
    dataType: 'text',
    success: function (data, status) {
      //alert(data);
    },
    error: function (xhr, status, error) {
      // alert(error);
    },
  });
}
function sendOTP() {
  $.ajax({
    type: 'post',
    data: {
      code: localEmailCode,
      receiver: nEmail,
    },
    cache: false,
    url: 'sendEmailOTP.php',
    dataType: 'text',
    success: function (data, status) {
      alert(data);
    },
    error: function (xhr, status, error) {
      alert(error);
    },
  });
}

function saveImage() {
  // alert(1)
  var formData = new FormData();
  formData.append('washerImage', document.getElementById('carImageF').files[0]);
  formData.append('mobile', nMobile);

  // alert(3)

  $.ajax({
    type: 'post',
    cache: false,
    url: 'uploadImage.php',
    data: formData,
    processData: false,
    contentType: false,
    success: function (data, status) {
      alert(data);
    },
    error: function (xhr, status, error) {
      alert(error);
      hideSpin();
    },
  });
}

function saveWasher() {
  saveImage();
  showSpin();

  $.ajax({
    type: 'post',
    data: {
      nFullname: nFullname,
      nEmail: nEmail,
      nMobile: nMobile,
      ghana: ghana,
      location1: location1,
    },
    cache: false,
    url: 'addWasher_.php',
    dataType: 'text',
    success: function (data, status) {
      hideSpin();
      //alert(data)
      hideSpin();
      if (data == 1) {
        showAEMsuccessw();
      } else if (data == 3) {
        $('#nUsername').val('');
        showAEMerror(
          'Please use a different Mobile Number',
          'Mobile Number already taken'
        );
        return;
      }
    },
    error: function (xhr, status, error) {
      hideSpin();
      alert(error);
    },
  });
}

function sendPassword(username, password) {
  showSpin();
  $.ajax({
    type: 'post',
    data: {
      receiver: emailresend,
      username: username,
      password: password,
    },
    cache: false,
    url: 'sendEmaiLPassword.php',
    dataType: 'text',
    success: function (data, status) {
      hideSpin();
      showAEMsuccess('Password recovery sent successfully!');
    },
    error: function (xhr, status, error) {
      alert(error);
    },
  });
}

function getLoginDetails() {
  $.ajax({
    type: 'post',
    data: {
      email: emailresend,
    },
    cache: false,
    url: 'indexC2.php',
    dataType: 'text',
    success: function (data, status) {
      if (!aeEmpty(data)) {
        var output = data.split('|');
        var username = output[0];
        var password = output[1];
        // alert(username);
        //  alert(password)

        sendPassword(username, password);
      }
    },
    error: function (xhr, status, error) {
      alert(error);
    },
  });
}

function getuser() {
  $.ajax({
    type: 'post',
    data: {
      username: username,
      password: password,
    },
    cache: false,
    url: 'index__.php',
    dataType: 'text',
    success: function (data, status) {
      hideSpin();

      if (data == 900) {
        openPageReplace('adminPage.php');
        return;
      }
      if (data == 1) {
        openPageReplace('adminpage.php');
        return;
      } else {
        showAEMerror(
          'Invalid login attempt try again',
          'Invalid login attempt'
        );
      }
    },
    error: function (xhr, status, error) {
      alert(error);

      $('#error').css('display', 'block');

      $('#container').height('22rem');
    },
  });
}

function getInput() {
  nFullname = $('#nFullname').val();
  nEmail = $('#nEmail').val();
  nMobile = $('#nMobile').val();

  ghana = $('#ghana').val();
  location1 = $('#location1').val();

  nFullname = trimV(nFullname);
  nEmail = trimV(nEmail);
  nMobile = trimV(nMobile);
  ghana = trimV(ghana);
  location1 = trimV(location1);

  n1 = nFullname.toUpperCase();
  nFullname = n1;

  //
}

function validate_mobile_g(mobile) {
  var phoneRe = /^[0-9]{10}$/;
  var digits = mobile.replace(/\D/g, '');
  return phoneRe.test(digits);
}

const validateEmail = (email) => {
  return String(email)
    .toLowerCase()
    .match(
      /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    );
};

function aeEmpty(e) {
  var ee = '';
  try {
    ee = e.trim();
  } catch (error) {
    return true;
  }
  try {
    switch (e) {
      case '':
      case 0:
      case '0':
      case null:
      case false:
      case undefined:
        return true;
      default:
        return false;
    }
  } catch (error) {
    return true;
  }
}

function isNumber(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}

function showErrorText(message) {
  $('#error_message').text(message);
  $('#error_message').show();
}

function hideErrorText() {
  $('#error_message').text('');
  $('#error_message').hide();
}

function showSpin() {
  document.getElementById('spin').style.visibility = 'visible';
}
function hideSpin() {
  document.getElementById('spin').style.visibility = 'hidden';
}

function openPage_blank(url) {
  window.open(url, '_blank');
}
function openPage(url) {
  window.open(url);
}

function showAEMsuccess(aeBody, aeTitle) {
  if (!aeEmpty(aeTitle)) {
    $('#aeAlertTitle').text(aeTitle);
  }

  if (!aeEmpty(aeBody)) {
    $('#aeAlertBody').text(aeBody);
  }
  $('#aeMsuccess').modal('show');
}

function showAEMsuccessw(aeBody, aeTitle) {
  if (!aeEmpty(aeTitle)) {
    $('#aeAlertTitlew').text(aeTitle);
  }

  if (!aeEmpty(aeBody)) {
    $('#aeAlertBodyw').text(aeBody);
  }
  $('#aeMsuccessw').modal('show');
}

function showAEMerror(aeBody, aeTitle) {
  if (!aeEmpty(aeTitle)) {
    $('#aeMerrorTitle').text(aeTitle);
  }

  if (!aeEmpty(aeBody)) {
    $('#aeMerrorBody').text(aeBody);
  }
  $('#aeMerror').modal('show');
}

function showMYesNo(aeBody) {
  if (!aeEmpty(aeBody)) {
    $('#aeMBody').text(aeBody);
  }
  $('#aeMyesNo').modal('show');
}

function passwordConfirm(a, b) {
  return a == b;
}

function trimV(a) {
  try {
    a = a.trim();
  } catch (error) {}
  return a;
}

function refreshPage() {
  location1.reload();
}

function showCodeField() {
  $('#codeHide').show();
}
function hideCodeField() {
  $('#codeHide').hide();
}

function validateGhanaCard(ghanaCard) {
  if (aeEmpty(ghanaCard)) {
    return false;
  }
  ghanaCard = ghanaCard.toUpperCase();
  var i = ghanaCard.length;

  if (i < 8) {
    return false;
  }

  if (i > 20) {
    return false;
  }

  ii = ghanaCard.substring(0, 4);

  if (!passwordConfirm(ii, 'GHA-')) {
    return false;
  }

  return true;
}

function openPageReplace(url) {
  location.href = url;
}

function validatePassword(password) {
  var passwordRegex =
    /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/;
  var m =
    'must be at least 8 characters long ' +
    ' and contains at least one lowercase letter, one ' +
    'uppercase letter, one number, and one special character';

  return passwordRegex.test(password);
}

function checkImageFileSize(id) {
  var file = document.getElementById(id).files[0];
  if (file.size > 1258291) {
    showAEMerror('FILE TOO LARGE');

    return false;
  }
  if (!file.type.startsWith('image/')) {
    showAEMerror('CHOOSE IMAGE FILE ONLY');
    return false;
  }
  return true;
}

function changeImageSRC(fileID, imageTagID) {
  var file = document.getElementById(fileID).files[0];
  document.getElementById(imageTagID).src = URL.createObjectURL(file);
}

function isFilePDF(fileId) {
  var input = document.getElementById(fileId);
  if (input.files && input.files[0]) {
    var file = input.files[0];
    var size = file.size / 1024 / 1024; // size in MB
    var type = file.type;

    if (type !== 'application/pdf') {
      aeModelTitle = 'CHOOSE PDF ONLY';
      aeModelBody = 'ONLY PDF FILES ARE ALLOWED';

      $('#aeMBody').text(aeModelBody);
      $('#aeMTitle').text(aeModelTitle);
      $('#aeModelPassive').modal('show');

      document.getElementById(fileId).value = '';
      return false;
      return false;
    } else if (size > 2) {
      aeModelTitle = 'PICTURE SIZE TOO LARGE';
      aeModelBody =
        'Your picture size is too large.' +
        'we can only accept pictures that are not more than 2mb';

      $('#aeMBody').text(aeModelBody);
      $('#aeMTitle').text(aeModelTitle);
      $('#aeModelPassive').modal('show');
      document.getElementById(fileId).value = '';

      return false;
      return false;
    } else {
      return true;
    }
  }
}

function isFileImage(fileId) {
  var input = document.getElementById(fileId);
  if (input.files && input.files[0]) {
    var file = input.files[0];
    var size = file.size / 1024 / 1024; // size in MB
    var type = file.type;
    if (!type.startsWith('image')) {
      aeModelTitle = 'ONLY IMAGE FILE ALLOWED';
      aeModelBody = 'Please Choose Image File';
      $('#aeMBody').text(aeModelBody);
      $('#aeMTitle').text(aeModelTitle);
      $('#aeModelPassive').modal('show');
      document.getElementById(fileId).value = '';

      return false;
    } else if (size > 2) {
      aeModelTitle = 'FILE TOO LARGE';
      aeModelBody = 'Please Your file is too large';
      $('#aeMBody').text(aeModelBody);
      $('#aeMTitle').text(aeModelTitle);
      $('#aeModelPassive').modal('show');
      document.getElementById(fileId).value = '';
      return false;
    } else {
      return true;
    }
  }
}

function updateImage(inputFileId, imgTagId) {
  const inputFile = document.getElementById(inputFileId); // get the input file element by its ID
  const file = inputFile.files[0]; // get the first file in the input
  if (file) {
    const reader = new FileReader(); // create a FileReader object
    reader.onload = function () {
      const imgTag = document.getElementById(imgTagId); // get the img tag by its ID
      imgTag.src = reader.result; // set the src attribute of the img tag to the base64-encoded data URL of the selected file
    };
    reader.readAsDataURL(file); // read the selected file as a data URL
  }
}
