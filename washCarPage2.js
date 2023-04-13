
var keyword2=null;
var carname=null;
var wfullname=null;

$("#tfSearch2").keyup(function () {
    var gridW = document.querySelector('.grid-container2');
gridW.innerHTML = '';

   keyword2=$("#tfSearch2").val();

   if(aeEmpty(keyword2)==false){
    getWasher();

   }
  
   });




   function getWasher() {

  
    $.ajax({
      type: "post",
      data: {
        id: keyword2,
      },
      cache: false,
      url: "washerPage11.php",
      dataType: "json",
      success: function (data, status) {
        var len=data.length;



        for(var i=0; i<data.length; i++) {
            var div = $("<div id=wd"+i +" class='grid-item'></div>");
            var img = $("<img id=wm"+i +">");

          
          var  imgPath=data[i].wmobile;
          var cc="washer/"+ imgPath+".jpg";
          imgPath=cc;

         // alert(imgPath)

           // alert(imgPath)

           // alert(data[i].imageUrl)
            img.attr("src",imgPath);
            var labelWasher = $("<label  class='lbw'  id=lbw"+i +">" + data[i].wfullname + "</label>");
            labelWasher.attr("for", "lbw" + (i));
            div.append(img);
            div.append(labelWasher);
            $(".grid-container2").append(div);
        }
        
      },
      error: function (xhr, status, error) {
        // alert(error);
      },
    });
  }


   function init2() {

  
    $.ajax({
      type: "post",
      data: {
        id: keyword2,
      },
      cache: false,
      url: "washerPage11_.php",
      dataType: "json",
      success: function (data, status) {
        var len=data.length;



        for(var i=0; i<data.length; i++) {
            var div = $("<div id=wd"+i +" class='grid-item'></div>");
            var img = $("<img id=wm"+i +">");

          
          var  imgPath=data[i].wmobile;
          var cc="washer/"+ imgPath+".jpg";
          imgPath=cc;

           // alert(imgPath)

           // alert(data[i].imageUrl)
           // img.attr("src",imgPath);
            var labelWasher = $("<label  class='lbw'  id=lbw"+i +">" + data[i].wfullname + "</label>");
            labelWasher.attr("for", "lbw" + (i));
            div.append(img);
            div.append(labelWasher);
            $(".grid-container2").append(div);
        }
        
      },
      error: function (xhr, status, error) {
        // alert(error);
      },
    });
  }


  var gridW = document.querySelector('.grid-container2');

gridW.addEventListener('click', function(event) {
  var clickedCell = event.target;
  var cellId = clickedCell.getAttribute('id');
  

  var labelWasher = clickedCell.querySelector('label');
  var labelText = labelWasher.textContent;


  var textarea = document.getElementById("taReport");
 
  var newText = labelText;
  wfullname=newText
  var updatedText =   chosenCar+ "\n" + newText;
  textarea.value = updatedText;

  amount1=null;


  const con1 = (document.getElementById("container1").style.display =
  "block");
  const con2 = (document.getElementById("container3").style.display =
  "none");
});




