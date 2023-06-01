$(document).ready(function () {
    $("#form").submit(function (e) {
      e.preventDefault();
      deleteServiceByName();

    });

});


      



function deleteServiceByName() {
    // Get the selected option from the select list
    var selectElement = document.getElementById('service_select');
    var id = selectElement.options[selectElement.selectedIndex].value;

    $.ajax({
        type: "post",
        data: {
            id: id,
        },
        cache: false,
        url: "deleteServiceByID.php", // assuming deleteService.php is your target PHP script
        dataType: "text",
        success: function (data, status) {
       
          //  alert(data) 

            if(data == "1"){
                showToast("aeToastS","Success","Service Deleted Successfully","10");

                window.location.reload(true);
            } 
   
        },
        error: function (xhr, status, error) {
            // Handle error scenario here
            console.log(error);
        },
    });
}














function showToastB(toastID,title,message,positionInPercentage) {
    var toastElement = document.getElementById(toastID);
  
    // Check if the title is not null
    if(title != null) {
        toastElement.getElementsByClassName("toast-header")[0]
        .getElementsByTagName("strong")[0].innerText = title;
    }
  
    // Check if the message is not null
    if(message != null) {
        toastElement.getElementsByClassName("toast-body")[0].innerText = message;
    }

    toastElement.style.position = "fixed";
  
    if(positionInPercentage != null) {
        toastElement.style.top = positionInPercentage + "%";
    }
    toastElement.style.left = "50%";
    toastElement.style.transform = "translate(-50%, -50%)";
    toastElement.style.zIndex = "99999";

    var toastBootstrap = new bootstrap.Toast(toastElement, {
        autohide: false
    });

    document.getElementById("toastYes").addEventListener("click", function() {

        deleteServiceByName();



  
        toastBootstrap.hide(); // Hide the toast when Yes button is clicked
    });

    document.getElementById("toastNo").addEventListener("click", function() {
    
        toastBootstrap.hide(); // Hide the toast when No button is clicked
    });

    toastBootstrap.show();
}


function deleteService() {
    $.ajax({
      type: "post",
      data: {
        id: id,
      },
      cache: false,
      url: "deleteServiceBYName.php",
      dataType: "text",
      success: function (data, status) {
        //alert(data);
      },
      error: function (xhr, status, error) {
        // alert(error);
      },
    });
  }