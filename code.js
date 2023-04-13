var code = null;




$(document).ready(function () {


$("#lblogin4").click(function(){
  openPageReplace("adminPage.php")
})

 

  $("#form").submit(function (e) {
 
    e.preventDefault();
    showSpin();

    getInput();
    getCode();

  });

});

function myAjax1() {
  $.ajax({
    type: "post",
    data: {
      id: id,
    },
    cache: false,
    url: "",
    dataType: "text",
    success: function (data, status) {
      //alert(data);
    },
    error: function (xhr, status, error) {
      // alert(error);
    },
  });
}



function getCode() {

  $.ajax({
    type: "post",
    cache: false,
    url: "code_.php",
    dataType: "text",
    success: function (data, status) {
      hideSpin();
      //alert(data);
      $("#code").val(data);
      return;

   
    },
    error: function (xhr, status, error) {
      alert(error);

      $("#error").css("display", "block");

      $("#container").height("22rem");
    },
  });
}

function getInput() {

}

function validate_mobile_g(mobile) {
  var phoneRe = /^[0-9]{10}$/;
  var digits = mobile.replace(/\D/g, "");
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
  var ee = "";
  try {
    ee = e.trim();
  } catch (error) {
    return true;
  }
  try {
    switch (e) {
      case "":
      case 0:
      case "0":
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
  $("#error_message").text(message);
  $("#error_message").show();
}

function hideErrorText() {
  $("#error_message").text("");
  $("#error_message").hide();
}

function showSpin() {
  document.getElementById("spin").style.visibility = "visible";
}
function hideSpin() {
  document.getElementById("spin").style.visibility = "hidden";
}

function openPage_blank(url) {
  window.open(url, "_blank");
}
function openPage(url) {
  window.open(url);
}

function showAEMsuccess(aeBody, aeTitle) {
  if (!aeEmpty(aeTitle)) {
    $("#aeAlertTitle").text(aeTitle);
  }

  if (!aeEmpty(aeBody)) {
    $("#aeAlertBody").text(aeBody);
  }
  $("#aeMsuccess").modal("show");
}

function showAEMsuccessw(aeBody, aeTitle) {
  if (!aeEmpty(aeTitle)) {
    $("#aeAlertTitlew").text(aeTitle);
  }

  if (!aeEmpty(aeBody)) {
    $("#aeAlertBodyw").text(aeBody);
  }
  $("#aeMsuccessw").modal("show");
}

function showAEMerror(aeBody, aeTitle) {
  if (!aeEmpty(aeTitle)) {
    $("#aeMerrorTitle").text(aeTitle);
  }

  if (!aeEmpty(aeBody)) {
    $("#aeMerrorBody").text(aeBody);
  }
  $("#aeMerror").modal("show");
}

function showMYesNo(aeBody) {
  if (!aeEmpty(aeBody)) {
    $("#aeMBody").text(aeBody);
  }
  $("#aeMyesNo").modal("show");
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
  $("#codeHide").show();
}
function hideCodeField() {
  $("#codeHide").hide();
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

  if (!passwordConfirm(ii, "GHA-")) {
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
    "must be at least 8 characters long " +
    " and contains at least one lowercase letter, one " +
    "uppercase letter, one number, and one special character";

  return passwordRegex.test(password);
}

function checkImageFileSize(id) {
  var file = document.getElementById(id).files[0];
  if (file.size > 1258291) {
    showAEMerror("FILE TOO LARGE");

    return false;
  }
  if (!file.type.startsWith("image/")) {
    showAEMerror("CHOOSE IMAGE FILE ONLY");
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

    if (type !== "application/pdf") {
      aeModelTitle = "CHOOSE PDF ONLY";
      aeModelBody = "ONLY PDF FILES ARE ALLOWED";

      $("#aeMBody").text(aeModelBody);
      $("#aeMTitle").text(aeModelTitle);
      $("#aeModelPassive").modal("show");

      document.getElementById(fileId).value = "";
      return false;
      return false;
    } else if (size > 2) {
      aeModelTitle = "PICTURE SIZE TOO LARGE";
      aeModelBody =
        "Your picture size is too large." +
        "we can only accept pictures that are not more than 2mb";

      $("#aeMBody").text(aeModelBody);
      $("#aeMTitle").text(aeModelTitle);
      $("#aeModelPassive").modal("show");
      document.getElementById(fileId).value = "";

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
    if (!type.startsWith("image")) {
      aeModelTitle = "ONLY IMAGE FILE ALLOWED";
      aeModelBody = "Please Choose Image File";
      $("#aeMBody").text(aeModelBody);
      $("#aeMTitle").text(aeModelTitle);
      $("#aeModelPassive").modal("show");
      document.getElementById(fileId).value = "";

      return false;
    } else if (size > 2) {
      aeModelTitle = "FILE TOO LARGE";
      aeModelBody = "Please Your file is too large";
      $("#aeMBody").text(aeModelBody);
      $("#aeMTitle").text(aeModelTitle);
      $("#aeModelPassive").modal("show");
      document.getElementById(fileId).value = "";
      return false;
    } else {
      return true;
    }
  }
}







