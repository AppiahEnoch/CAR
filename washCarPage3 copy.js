


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

var data2=null

   function getService() {
    var gridW = document.querySelector('.grid-container4');
gridW.innerHTML = '';
   

  
    $.ajax({
      type: "post",
 
      cache: false,
      url: "washerPage12.php",
      dataType: "json",
      data:{
        keyword:chosenCar
      },

      success: function (data, status) {
        var len=data.length;

        data2=data;


        for(var i=0; i<data.length; i++) {
          var div = $("<div id=sd"+i +" class='grid-item'></div>");
          var img = $("<img id=wm"+i +">");
          var checkbox = $("<input type='checkbox' id='cb"+i+"' />");
          var labelWasher = $("<label  class='lbw'  id= 'lbs'"+i +">" + data[i].action + "</label>");
          
          labelWasher.attr("for", "lbs" + (i));
          // div.append(img);
          div.append(checkbox); // add checkbox to your div
          div.append(labelWasher);
          $(".grid-container4").append(div);
      }
      
        
      },
      error: function (xhr, status, error) {
         alert(error);
      },
    });
  }


  var gridW = document.querySelector('.grid-container4');

gridW.addEventListener('click', function(event) {
  var clickedCell = event.target;
  var cellId = clickedCell.getAttribute('id');

 
  const num = extractNumberFromString(cellId);

alert(cellId+":" +num);
  

  
// Supposing that clickedCell, data2, wfullname, and chosenCar are all defined somewhere else in your code

for (var i = 0; i < globalArray.length; i++) {
  var num1 = globalArray[i].num;
  var cellId1 = globalArray[i].cellId;

  var labelWasher = document.getElementById(cellId1).querySelector('label');
  var labelText = labelWasher.textContent;

  var textarea = document.getElementById("taReport");
  var currentText = textarea.value;
  var newText = labelText;
  var updatedText = currentText + "\n" + newText;
  textarea.value = updatedText;

  var amount=data2[num1].amount;
  var washerAmount=data2[num1].washerAmount;
  action1=data2[num1].action
  washerAmount1=washerAmount;
  amount1=amount

  currentText = textarea.value;

  updatedText = currentText + "\n" + "Fee: GHS\t"+amount1+".00\n"+"washer: GHS\t"+washerAmount+".00";
  textarea.value=''
  textarea.value = updatedText;

  updatedText= chosenCar+ "\n" + wfullname+ "\n" + "Fee: GHS\t"+amount+".00\n"+"washer: GHS\t"+washerAmount+".00";
  textarea.value = updatedText;
}

  

return 


});


function extractNumberFromString(str) {
  const match = str.match(/\d+/); // matches one or more digits
  return match ? parseInt(match[0]) : null; // convert the match to a number
}





