$(document).ready(function () {
  $('#idelete').click(function () {
    window.location.href = 'deleteService.html';
  });
});

document.getElementById('form1').addEventListener('submit', function (event) {
  event.preventDefault();

  var serviceName = document.getElementById('service_name').value;
  var serviceDescription = document.getElementById('service_description').value;

  //alert(serviceDescription)

  $.ajax({
    url: 'addService.php',
    type: 'post',
    data: {
      service_name: serviceName,
      service_description: serviceDescription,
    },
    success: function (response) {
    //  alert(response)
      showToastC('aeToastC', 'Success!', 'Service added successfully', '10');
    },
    error: function (jqXHR, textStatus, errorThrown) {
      showToast('aeToastE', 'Error!', 'Service not added', '10');
    },
  });
});



function showToastC(toastID, title, message, positionInPercentage) {
  var toastElement = document.getElementById(toastID);

  // Check if the title is not null
  if (title != null) {
    toastElement.getElementsByClassName("toast-header")[0]
    .getElementsByTagName("strong")[0].innerText = title;
  }

  // Check if the message is not null
  if (message != null) {
    toastElement.getElementsByClassName("toast-body")[0].innerText = message;
  }

  toastElement.style.position = "fixed";

  if (positionInPercentage != null) {
    toastElement.style.top = positionInPercentage + "%";
  }
  toastElement.style.left = "50%";
  toastElement.style.transform = "translate(-50%, -50%)";
  toastElement.style.zIndex = "99999";

  var toastBootstrap = new bootstrap.Toast(toastElement, {
    autohide: false
  });

  toastElement.addEventListener('hidden.bs.toast', function () {
    // Page reload when the toast is closed.
    window.location.reload();
  })

  document.getElementById("btclose").addEventListener("click", function() {
    toastBootstrap.hide(); // Hide the toast when Yes button is clicked
  });

  toastBootstrap.show();
}









function getOTP(length) {
  if (length == null) {
    length = 6;
  }
  var result = '';
  var characters = '0123456789';
  var charactersLength = characters.length;
  for (var i = 0; i < length; i++) {
    result += characters.charAt(Math.floor(Math.random() * charactersLength));
  }
  return result;
}
