
$(document).ready(function () {
  init()
});

function init() {
  $.ajax({
    type: "post",
    cache: false,
    url: "userPage_.php",
    dataType: "json",
    success: function (data, status) {
      var s=data.total_services;
      var t=data.total_amount;

     if(aeEmpty(s)){
      return;
     }


  $("#totalServices").text(s);
  $("#totalServiceMoney").text(t);

    },
    error: function (xhr, status, error) {
       alert(error);
    },
  });
}



