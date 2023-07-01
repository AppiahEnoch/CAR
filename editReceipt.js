$(document).ready(function() {

    
    // Fetch data from PHP script
    $.ajax({
        url: 'editReceipt.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            // Iterate through each record in the data
            $.each(data, function(key, record) {
                // Create a new table row
                var row = $("<tr data-id='" + record.id + "'></tr>");

                // Append table columns with the record data
                row.append($("<td contenteditable='true' data-column='washer'></td>").text(record.washer));
                row.append($("<td contenteditable='true' data-column='carname'></td>").text(record.carname));
                row.append($("<td contenteditable='true' data-column='carNumber'></td>").text(record.carNumber));
                row.append($("<td contenteditable='true' data-column='action'></td>").text(record.action));
                row.append($("<td contenteditable='true' data-column='amount'></td>").text(record.amount));
                row.append($("<td contenteditable='true' data-column='washeramount'></td>").text(record.washeramount));
                row.append($("<td contenteditable='true' data-column='locationUser'></td>").text(record.locationUser));
                row.append($("<td contenteditable='true' data-column='location'></td>").text(record.location));
                row.append($("<td contenteditable='true' data-column='recdate'></td>").text(record.recdate));
                row.append($("<td contenteditable='true' data-column='receiptid'></td>").text(record.receiptid));

                // Append a delete button to the row
                var deleteButton = $("<button></button>").text("Delete").attr("class", "btn btn-danger delete-btn").attr("data-id", record.id);
                row.append($("<td></td>").append(deleteButton));

                // Append the row to the table body
                $("#receiptTable tbody").append(row);
            });

            // Add click event to the delete buttons
            $(".delete-btn").on('click', function() {
                var recordId = $(this).data("id");
                
                // Send AJAX request to delete.php with record ID
                $.ajax({
                    url: 'deleteReceipt.php',
                    type: 'POST',
                    data: { id: recordId },
                    success: function(response) {
                        console.log("Record deleted successfully:", response);
                    },
                    error: function(error) {
                        console.log("Error deleting record:", error);
                    }
                });

                // Remove the parent row of the delete button that was clicked
                $(this).closest("tr").remove();
            });
            

            // Add blur event to the contenteditable cells
            $("td[contenteditable='true']").on('blur', function() {
                var recordId = $(this).parent().data("id");
                var column = $(this).data("column");
                var value = $(this).text();

                // Send AJAX request to updateReceipt.php with record ID, column name, and new value
                $.ajax({
                    url: 'updateReceipt.php',
                    type: 'POST',
                    data: { id: recordId, column: column, value: value },
                    success: function(response) {
                        console.log("Record updated successfully:", response);
                    },
                    error: function(error) {
                        console.log("Error updating record:", error);
                    }
                });
            });
        },
        error: function(error) {
            console.log("Error fetching data:", error);
        }
    });





});
