 var recID=0;




 $(document).ready(function() {
  

    // Automatically set today's date
    const today = new Date().toISOString().substr(0, 10);
    $("#expenseDate").val(today);

    
    $("#totalAmount").on("keyup", function() {
        let totalAmount = parseFloat($(this).val()) || 0;
     let    washerAmount = (totalAmount * 0.4).toFixed(2);
        $("#washerAmount").val(washerAmount);
      });
  
    // Handle form submission
    $("#addExpenseForm").on("submit", function(e) {
      e.preventDefault();


    
  
      const totalAmount = $("#totalAmount").val();
      const washerAmount = $("#washerAmount").val();
      const washerSelect = $("#washerSelect").val();

      if (washerSelect == 0) {
        showToast("aeToastE", "Error", "Please select a washer", "20");
        return;
      }
      let expenseDescription = $("#expenseDescription").val();
      // Convert expense description to uppercase
      expenseDescription = expenseDescription.toUpperCase();
      const expenseDate = $("#expenseDate").val();
  
      $.ajax({
        type: "post",
        cache: false,
        url: "MISC_INSERT.php",
        data: {
          totalAmount,
          washerAmount,
          washerSelect,
          expenseDescription,
          expenseDate
        },
        success: function(data) {
          fetchRecords();
       
          if (data == 1) {
            showToast("aeToastS", "Success", "Expense added successfully", "20");
          } else {
         //   showToast("aeToastE", "Error", "Could not add expense", "20");
          }
          document.getElementById("addExpenseForm").reset();
        },
        error: function(xhr, status, error) {
          showToast("aeToastE", "Error", error, "20");

        }
      });
    });
  });
  


  $(document).ready(function() {
    // Load washers into the select box
    $.ajax({
      type: "post",
      cache: false,
      url: "MISC_SW.php",
      dataType: "json",
      success: function(data, status) {
        let options = '<option selected value="0">Select Washer</option>';
        data.forEach(washer => {
          options += `<option value="${washer.wmobile}">${washer.wfullname}</option>`;

    
        });
        $('#washerSelect').html(options);
      },
      error: function(xhr, status, error) {
        showToast("aeToastE", "Error", error, "20");
      }
    });
  });
  





  function confirmDelete(id) {
  //  alert(1)
    showToastY(
      "aeToastY",
      "Confirm Deletion",
      "Are you sure you want to delete this record?",
      "20",
      function() { deleteRecord(id); },
      function() { /* Do nothing for No option */ }
    );
  }


  // Fetch and display the records from the database


  function fetchRecords() {
    $.ajax({
      type: "post",
      cache: false,
      url: "MISC_F.php",
      dataType: "json",
      success: function(data, status) {
        const today = new Date().toISOString().substr(0, 10);
        $("#expenseDate").val(today);



        let tableRows = '<table class="table"><thead><tr><th>ID</th><th>Total Amount</th><th>Washer Amount</th><th>Description</th><th class="d-none">Date Added</th><th class="d-none">Washer ID</th><th>Action</th></tr></thead><tbody>';
        
        data.forEach(record => {

          // shorten the description if it is too long
          let shortDescription = record.Description;
          if (shortDescription.length > 10) {
            shortDescription = shortDescription.substr(0, 20) + "...";

            // to lower case
            shortDescription = shortDescription.toLowerCase();
          }


          // write shorten form of id 
          let shortID = record.id;
          let longID = record.id;
          if (shortID.length > 2) {
            shortID = shortID.substr(0, 2) + "..";
          }
          
 


          tableRows += `<tr class="clickable-row">
                          <td  contenteditable="false">${shortID}</td>
                          <td contenteditable="true">${record.totalAmount}</td>
                          <td contenteditable="true">${record.washer_amount}</td>
                          <td contenteditable="true">${shortDescription}</td>
                          <td class="d-none">${record.DateAdded}</td>
                          <td class="d-none">${record.washer_id}</td>
                          <td class="d-none">${record.Description}</td>
                          <td class="d-none">${longID}</td>
                          <td><button class="btn btn-danger btn-sm myDeletebutton" onclick="confirmDelete('${record.id}')">Delete</button></td>
                        </tr>`;

                 
        });
  
        tableRows += '</tbody></table>';
        $('#miscTable').html(tableRows);
      },
      error: function(xhr, status, error) {
        showToast("aeToastE", "Error", error, "20");
      }
    });
  }
  
  $(document).on('click', '.clickable-row', function() {
    const row = $(this).closest('tr');
    const totalAmount = row.find("td:nth-child(2)").text();
    const washerAmount = row.find("td:nth-child(3)").text();
  
    const dateAdded = row.find("td:nth-child(5)").text();
    const washerID = row.find("td:nth-child(6)").text();  
    let fullDescription  = row.find("td:nth-child(7)").text();  
    fullDescription = fullDescription.toLowerCase();
    recID = row.find("td:nth-child(8)").text();

    $('#totalAmount').val(totalAmount);
    $('#washerAmount').val(washerAmount);
    $('#expenseDescription').val(fullDescription);
    $('#expenseDate').val(dateAdded);
  
    $("#washerSelect option").each(function() {
      if ($(this).val() === washerID) {
        $(this).prop('selected', true).trigger('change');
        return false;
      }
    });

  });
  
  
  
  

  
  

  $(document).ready(function() {
    fetchRecords();
   });
  

  function deleteRecord(id) {

    alert(id)
    $.ajax({
      type: "post",
      cache: false,
      url: "MISC_DELETE.php",
      data: { id },
      success: function(data) {
        if (data === "success") {
          showToast("aeToastS", "Success", "Record deleted successfully", "20");
          fetchRecords();
        } else {
          showToast("aeToastE", "Error", "Could not delete record", "20");
        }
      },
      error: function(xhr, status, error) {
        showToast("aeToastE", "Error", error, "20");
      }
    });
  }
  

  
  
  // Edit and update records on keyup
  function editRecord(id, column, value) {

    // check if the value is empty
    if (value === "") {
    //  showToast("aeToastE", "Error", "Value cannot be empty", "20");
      return;
    }




    $.ajax({
      type: "post",
      cache: false,
      url: "MISC_U.php",
      data: {
        id,
        column,
        value
      },
      success: function(data) {
        if (data === "success") {
         // showToast("aeToastS", "Success", "Record updated successfully", "20");
        } else {
          showToast("aeToastE", "Error", "Could not update record", "20");
        }
      },
      error: function(xhr, status, error) {
        showToast("aeToastE", "Error", error, "20");
      }
    });
  }
  
  $(document).ready(function() {
    fetchRecords();
  });

  
// Update existing record when update button is clicked
$("#updateButton").click(function() {
 // Assuming you have a hidden input field with id="idField" to store the selected id
  const totalAmount = $("#totalAmount").val();
  const washerAmount = $("#washerAmount").val();
  const expenseDescription = $("#expenseDescription").val();
  const expenseDate = $("#expenseDate").val();
  const washerID = $("#washerSelect").val();

// alert all
//alert( washerAmount  + ": "+ recID + ": " + expenseDescription + ": " + expenseDate + ": " + washerID)


  // check if recID is empty
  if (recID === 0) {
    showToast("aeToastE", "Error", "Please select a record to update", "20");
    return;
  }

  $.ajax({
    type: "post",
    cache: false,
    url: "MISC_UP.php",
    dataType: "text",
    data: {
      id: recID,
      totalAmount: totalAmount,
      washerAmount: washerAmount,
      Description: expenseDescription,
      DateAdded: expenseDate,
      washer_id: washerID
    },
    success: function(data, status) {

      fetchRecords();

      // RESET FORM
      document.getElementById("addExpenseForm").reset();

      const today = new Date().toISOString().substr(0, 10);
      $("#expenseDate").val(today);
      

      if (data.status =="success") {
        showToast("aeToastS", "Update Successful", "The record has been updated.", "20");
        fetchRecords(); // Reload the table data
      } else {
        showToast("aeToastE", "Update Failed", "Could not update the record.", "20");
      }
    },
    error: function(xhr, status, error) {
      showToast("aeToastE", "Error", error, "20");
    }
  });
});

  