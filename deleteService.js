$(document).ready(function () {


  $('delete_service').click(function () {});

  $.ajax({
    url: 'selectService.php',
    type: 'POST',
    dataType: 'json',
    success: function (data) {
      var $select = $('#service_select');
      $select.empty(); // remove old options
      $.each(data, function (key, value) {
        $select.append(
          '<option value=' + value.id + '>' + value.service_name + '</option>'
        );
      });
    },
    error: function (err) {
      console.log(err);
    },
  });
});







