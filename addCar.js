var washeramount = null;
var carname = 'not Set';
var amount = null;
var action = null;
var carFile = null;

$(document).ready(function () {
  setcarname();

  $('#lblogin4').click(function () {
    openPageReplace('adminpage.php');
  });

  $('#lbEditCar').click(function () {
    openPageReplace('editCarHTML.php');
  });


  $('#carImage').click(function () {
    $('#carImageF').click();
  });

  $('#amount').keyup(function () {
    getInput();
    var am = amount;

    var am1 = Math.round(0.4 * am);

    $('#washeramount').val(am1);
  });

  $('#carImageF').change(function () {
    if (isFileImage('carImageF')) {
      updateImage('carImageF', 'carImage');
    }
  });

  $('#form').submit(function (e) {
    e.preventDefault();
    showSpin();

    getInput();

    savedata();
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
function setcarname() {
  $.ajax({
    type: 'post',

    cache: false,
    url: 'addCar2_.php',
    dataType: 'text',
    success: function (data, status) {
     // alert(data);
      var output = data.split('|');
      $('#carname').val(output[0]);

      // alert(output[0])
      // alert(output[1])

      $('#carImage').attr('src', output[1]);
    },
    error: function (xhr, status, error) {
     alert(error);
    },
  });
}

function savedata() {
  // alert(1)
  var formData = new FormData();
  formData.append('carImage', document.getElementById('carImageF').files[0]);
 // alert(2);
  formData.append('carname', carname);
  formData.append('action', action);
  formData.append('amount', amount);
  formData.append('washeramount', washeramount);

  // alert(3)

  $.ajax({
    type: 'post',
    cache: false,
    url: 'addCar_.php',
    data: formData,
    processData: false,
    contentType: false,
    success: function (data, status) {
      openPageReplace('addCar.php');
    },
    error: function (xhr, status, error) {
      alert(error);
      hideSpin();
    },
  });
}

function getInput() {
  carname = $('#carname').val();
  action = $('#action').val();
  amount = $('#amount').val();
  washeramount = $('#washeramount').val();

  let variables = [carname, action];
  variables = trimVariables(variables);
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
  location.reload();
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
      showAEMerror('Please Choose Image File', 'ONLY IMAGE FILE ALLOWED');
      document.getElementById('carImageF').value = 'image/logo.jpg';
      document
        .querySelector('#carImage')
        ?.setAttribute('src', 'image/logo.jpg');

      return false;
    } else if (size > 2) {
      showAEMerror('Please Your file is too large', 'FILE TOO LARGE');
      document.getElementById('carImageF').value = 'image/logo.jpg';

      document
        .querySelector('#carImage')
        ?.setAttribute('src', 'image/logo.jpg');

      return false;
    } else {
      return true;
    }
  }
}

function trimVariables(variablesArray) {
  for (let i = 0; i < variablesArray.length; i++) {
    variablesArray[i] = variablesArray[i].trim();
  }
  return variablesArray;
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
