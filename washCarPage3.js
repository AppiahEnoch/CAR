


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

           // alert(imgPath)
           // alert(data[i].imageUrl) 
           // img.attr("src",imgPath);
            var labelWasher = $("<label  class='lbw'  id= 'lbs'"+i +">" + data[i].action + "</label>");
            labelWasher.attr("for", "lbs" + (i));
           // div.append(img);
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


  

  

  var labelWasher = clickedCell.querySelector('label');
  var labelText = labelWasher.textContent;


  var textarea = document.getElementById("taReport");
  var currentText = textarea.value;
  var newText = labelText;
  var updatedText = currentText + "\n" + newText;
  textarea.value = updatedText;


  var amount=data2[num].amount;
  var washerAmount=data2[num].washerAmount;
  action1=data2[num].action
  washerAmount1=washerAmount;
  amount1=amount

  currentText = textarea.value;

  updatedText = currentText + "\n" + "Fee: GHS\t"+amount1+".00\n"+"washer: GHS\t"+washerAmount+".00";
  textarea.value=''
  textarea.value = updatedText;



  updatedText= chosenCar+ "\n" + wfullname+
  "\n" + "Fee: GHS\t"+amount+".00\n"+"washer: GHS\t"+washerAmount+".00";
  textarea.value = updatedText;



  









  const con1 = (document.getElementById("container1").style.display =
  "block");
  const con2 = (document.getElementById("container4").style.display =
  "none");
});


function extractNumberFromString(str) {
  const match = str.match(/\d+/); // matches one or more digits
  return match ? parseInt(match[0]) : null; // convert the match to a number
}





