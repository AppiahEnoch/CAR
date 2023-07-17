$(document).ready(function() {
 getServices();
 getManagerNumber()
  });





// Define the function
function getManagerNumber() {
  // Make an AJAX call
  $.ajax({
    type: "POST", // Use a POST request
    cache: false, // Don't cache the result
    url: "selectMangerdetails.php", // URL to send the request to
    dataType: "text", // The type of data we're expecting back from the server
    
    // Function to run on a successful response
    success: function (data, status) {
    alert(data)
      // $("#managerNumber").text(data); // Update the text of the HTML element with the id "managerNumber"
    },
    
    // Function to run if the request fails
    error: function (xhr, status, error) {
      console.error("Error: ", error); // Log the error to the console
    },
  });
}









function getServices() {
    $.ajax({
      url: 'selectService.php',
      type: 'GET',
      success: function(response) {
        var services = JSON.parse(response);
        
        // clear existing cards
        $("#serviceWrapper .row-cols-1").empty();
  
        // iterate through each service
        services.forEach(function(service) {
          // create a new card
          var card = `
            <div class="col">
              <div class="card">
                <div class="card-body">
                  <h1 class="card-title">${service.service_name}</h1>
                  <p class="card-text">${service.service_description}</p>
                  <a href="service.html" class="btn btn-success">Get Service</a>
                </div>
              </div>
            </div>
          `;
          // append the new card to the grid
          $("#serviceWrapper .row-cols-1").append(card);
        });
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);
      }
    });
  }
  

  