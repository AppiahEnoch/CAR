// Assuming you have added jQuery

let carNumbersData = [];

// Fetch carNumbers and their IDs on page load
$(document).ready(function() {
    $.ajax({
        type: "GET",
        url: "aeSC_F.php",
        dataType: "json",
        success: function(data) {
            carNumbersData = data;
        },
        error: function(xhr, status, error) {
            showToast("aeToastE", "Error", error, "20");
        }
    });

    // Listen for input on search box
    $(".search-input").on('keyup', function() {
        let dropdown = $(".suggestion-dropdown");
        dropdown.empty();  // Clear previous suggestions
        let value = $(this).val().toLowerCase();
        let suggestions = carNumbersData.filter(item => item.carNumber.toLowerCase().includes(value));
// ckeck if value is empty
        if (value === "") {
            dropdown.empty();  
            return;
        }

        renderSuggestions(suggestions);
    });
});

function renderSuggestions(suggestions) {
    let dropdown = $(".suggestion-dropdown");
    dropdown.empty();  // Clear previous suggestions

    suggestions.forEach(item => {
        dropdown.append(`
            <li><a class="dropdown-item wt" href="#" data-id="${item.id}">
                <i class="fas fa-search me-2"></i>
                ${item.carNumber}
            </a></li>
        `);
    });
}

// Add event listener to dropdown items
$(document).on('click', '.wt', function() {
    let id = $(this).data('id');
    let carNumber = $(this).text();
    $(".search-input").val(carNumber);

    printCarDetails(carNumber)



});



function printCarDetails(carNumber) {
    
    $.ajax({
      type: "post",
      data: {
        carNumber: carNumber,
      },
      cache: false,
      url: "printCardetails.php",
      dataType: "text",
      success: function (data, status) {

           alert(data) 
     // console.log(data)
      if (data != 1) {
        showAEMerror('NO RECORD FOUND', 'NO RECORD FOUND');
        return;
      }

      aeDownload('report/customerVehicleReport.pdf');
        
    
      },
      error: function (xhr, status, error) {
        // alert(error);
      },
    });
  }