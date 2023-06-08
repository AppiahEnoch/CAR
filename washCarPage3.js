


$("#btService").click(function () {


  if(aeEmpty(wfullname)){
  
    return
  }
  const form1 = (document.getElementById("container1").style.display =
    "none");
  const form2 = (document.getElementById("container4").style.display =
    "block");
    getService()
});


$("#btcontainer4Submit").click(function () {

  const con1 = (document.getElementById("container1").style.display =
  "block");
  const con2 = (document.getElementById("container4").style.display =
  "none");


});


var amount1;
var washerAmount1;



   function getService() {
    var gridW = document.querySelector('.grid-container4');

    if (gridW.childElementCount > 0) {

    return
    }
 
    gridW.innerHTML = '';

  
    $.ajax({
      type: "post",
      cache: false,
      url: "washerPage12.php",
      dataType: "json",
      data: {
        keyword: chosenCar
      },
      success: function (data, status) {
        var len = data.length;
        data2 = data;
    
        for (var i = 0; i < data.length; i++) {
          var div = $("<div id=sd" + i + " class='grid-item'></div>");
          var img = $("<img id=wm" + i + ">");
          var checkbox = $("<input type='checkbox' id='cb" + i + "' />");
          var labelWasher = $("<label class='lbw' for='cb" + i + "'>" + data[i].action + "</label>");
    
          div.append(checkbox); // add checkbox to your div
          div.append(labelWasher);
          $(".grid-container4").append(div);
        }
      },
      error: function (xhr, status, error) {
        alert(error);
      },
    });
    
    var gridW = document.querySelector('.grid-container4');
 
    
    gridW.addEventListener('click', function (event) {
      var clickedCell = event.target;
      var cellId = clickedCell.parentNode.getAttribute('id'); // Get id of the parent div
      const num = extractNumberFromString(cellId);
    
      var index = globalArray.findIndex(function (obj) {
        return obj.cellId === cellId && obj.num === num;
      });
    
      if (index !== -1) {
        // Pair is in the array, remove it
        globalArray.splice(index, 1);
      } else {
        // Pair is not in the array, add it
        globalArray.push({ cellId, num });
      }

      var lbCountD= document.getElementById('lbCountD');
       
      lbCountD.textContent = 0;
    
      document.getElementById("taReport").value = ''; // Make sure the textarea is cleared before starting the loop
    var isvalid=false; //
      for (var i = 0; i < globalArray.length; i++) {
        var num1 = globalArray[i].num;
        var cellId1 = globalArray[i].cellId;
    isvalid = true; //
        var labelWasher = document.getElementById(cellId1).querySelector('label');
        // Add a null check for labelWasher
        if (labelWasher) {
          var labelText = labelWasher.textContent;
    
          var textarea = document.getElementById("taReport");
          var currentText = textarea.value;
          var newText = labelText;
          var updatedText = currentText + "\n" + newText;
    
          var amount = data2[num1].amount;
          var washerAmount = data2[num1].washerAmount;
          action1 = data2[num1].action;

          var globalCarName = document.getElementById('lbCarD').textContent;
          var globalWasher = document.getElementById('lbWasherD').textContent;
          var globalCarNumber = document.getElementById('tfCarNumber').value;
    
        if(aeEmpty(globalCarNumber)){
          globalCarNumber="not Available";
        }




       

          washerAmount1 = washerAmount;
          amount1 = amount;







    
          updatedText += "\n" + "Fee: GHS\t" + amount1 + ".00\n" + "washer: GHS\t" + washerAmount + ".00";
          updatedText += "\n ....................."
          textarea.value = updatedText;
        } else {
          console.error(`No label found for the element with id ${cellId1}`);
        }

        var lbCountD= document.getElementById('lbCountD');
       
        lbCountD.textContent = 0;
        if (isvalid == true) {
          lbCountD.textContent = i+1;
      }






      
      }
    });
    
    function extractNumberFromString(str) {
      const match = str.match(/\d+/); // matches one or more digits
      return match ? parseInt(match[0]) : null; // convert the match to a number
    }
  }