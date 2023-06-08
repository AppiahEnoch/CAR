$(document).ready(function () {
    $.ajax({
      url: "editCar.php", // The URL of the PHP script
      type: "GET", // HTTP method to use (GET or POST)
      dataType: "json", // The type of data we're expecting back from the server
      success: function (data) {
        // This function will be run when the request succeeds
        var carTable = $("#carTable");
        data.forEach(function (car) {
          var row = $("<tr data-id='"+car.id+"'>"); // Include ID in the HTML
          row.append($('<td contenteditable="true" class="editable">').text(car.carname));
          row.append($('<td contenteditable="true" class="editable">').text(car.action));
          row.append($('<td contenteditable="true" class="editable">').text(car.amount));
          row.append($('<td contenteditable="true" class="editable">').text(car.washeramount));
          row.append($('<td contenteditable="true" class="editable">').text(car.car_recdate));
          row.append($('<td contenteditable="false" class="editable">').text(car.img));
          carTable.append(row);
        });
        
        // Listen for the 'focusout' event on any element with class 'editable'
        $('.editable').focusout(function() {
          // This is the new text content of the cell
          var newText = $(this).text();
          // This is the row's ID
          var rowId = $(this).parent().attr('data-id');
          // This is the column number (zero-based index) of the cell in the row
          var colIndex = $(this).index();

          // Send the new data to the server to update the database
          $.ajax({
            url: 'editCarUpdate.php',
            type: 'POST',
            data: {
              'newText': newText,
              'rowId': rowId, // Use rowId instead of rowIndex
              'colIndex': colIndex
            },
            success: function(data) {
              console.log(data);
            },
            error: function(jqXHR, textStatus, errorThrown) {
              console.log('AJAX error: ' + textStatus + ' : ' + errorThrown);
            }
          });
        });
      },
      error: function (jqXHR, textStatus, errorThrown) {
        // This function will be run if the request fails
        console.log("AJAX error: " + textStatus + " : " + errorThrown);
      },
    });
});
