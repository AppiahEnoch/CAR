function processSelectedItems(globalArray, data2) {
    var ajaxRequests = []; // Array to hold all AJAX requests
  
    for (var i = 0; i < globalArray.length; i++) {
        var num1 = globalArray[i].num;
        var cellId1 = globalArray[i].cellId;
        var isvalid = true; 
        var labelWasher = document.getElementById(cellId1).querySelector('label');
        if (labelWasher) {
            var labelText = labelWasher.textContent;
  
            var textarea = document.getElementById("taReport");
            var currentText = textarea.value;
            var newText = labelText;
            var updatedText = currentText + "\n" + newText;
  
            var amount = data2[num1].amount;
            var washerAmount = data2[num1].washerAmount;
            var action1 = data2[num1].action;
  
            var globalCarName = document.getElementById('lbCarD').textContent;
            var globalWasher = document.getElementById('lbWasherD').textContent;
            var globalCarNumber = document.getElementById('tfCarNumber').value;
  
            if (aeEmpty(globalCarNumber)) {
                globalCarNumber = "not Available";
            }
  
            // Prepare the data to be sent
            var payload = {
                washer: globalWasher,
                carname: globalCarName,
                carNumber: globalCarNumber,
                action: action1,
                amount: amount,
                washeramount: washerAmount,
                // include other fields as needed
            };
  
            // Send the data to the server using AJAX
            var ajaxCall = $.ajax({
                type: "POST",
                url: "saveSelectedActions.php",
                data: payload,
                success: function(response) {
                  //alert(response);
                },
                error: function(xhr, status, error) {
                    console.error("Error occurred while sending data: ", error);
                }
            });
  
            // Push the ajax request to the array
            ajaxRequests.push(ajaxCall);
        }
    }
  
    // After all AJAX requests are done
    $.when.apply($, ajaxRequests).done(function() {
        hideAllSpin()
      
      openPage_blank("receipt.php");
    });
  }
  