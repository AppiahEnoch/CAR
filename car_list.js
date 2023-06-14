function loadCarNames() {
    $.ajax({
      url: 'getCarNames.php',  // Replace with the actual path to your PHP file
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        var select = $('#car_list');
        select.empty();  // Remove existing options
        select.append('<option selected>Open this select menu</option>');
  
        // Loop through each item in the returned array
        $.each(data, function(index, value) {
          // Add an option to the select for each item
          select.append('<option value="' + value + '">' + value + '</option>');
        });
      },
      error: function(xhr, status, error) {
        console.log('Error: ' + error);
      }
    });
  }
  
  // Call the function when the page loads
  $(document).ready(function(){
    loadCarNames() 


    $('#car_list').on('change', function() {
        // Get the selected value
        var selectedCar = $(this).val();
      
        // Set the value of the search input
        $('#tfSearch').val(selectedCar);
      
        // Trigger the keyup event
        $('#tfSearch').trigger('keyup');
      });
      
  });
  