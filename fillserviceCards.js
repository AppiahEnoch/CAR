$(document).ready(function() {
 getServices();
 getManagerNumber()
  });





  
function getManagerNumber() {
    $.ajax({
      type: "post",
      cache: false,
      url: "selectMangerdetails.php",
      dataType: "text",
      success: function (data, status) {
        alert(data)
       /// $("#managerNumber").text(data);
      },
      error: function (xhr, status, error) {
        // alert(error);
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
  

  