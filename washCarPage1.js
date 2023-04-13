
var keyWord=null;
var carname=null;
var carname1=null;
var action1=null;
var washer1=null;


$("#tfSearch").keyup(function () {
    var gridC = document.querySelector('.grid-container');
gridC.innerHTML = '';

   keyWord=$("#tfSearch").val();

   if(aeEmpty(keyWord)==false){
    getCars();

   }
  
   });

$("#exitIcon").click(function () {
  
  openPageReplace("index.php");
  
   });


var chosenCar=null;

   function getCars() {
    $.ajax({
      type: "post",
      data: {
        id: keyWord,
      },
      cache: false,
      url: "washerPage10.php",
      dataType: "json",
      success: function (data, status) {
        var len=data.length;


        for(var i=0; i<data.length; i++) {
            var div = $("<div id=d"+i +" class='grid-item'></div>");
            var img = $("<img id=m"+i +">");

            var newUrl = data[i].carname.replace(/ /g, "_");
            var imgPath= "car/"+newUrl+".jpg";

           // alert(imgPath)

           // alert(data[i].imageUrl)
            img.attr("src",imgPath);
            var label = $("<label  class='lbCar'  id=lb"+i +">" + data[i].carname + "</label>");
            label.attr("for", "c" + (i+1));
            div.append(img);
            div.append(label);
            $(".grid-container").append(div);
            chosenCar=data[i].carname;
        }
        
      },
      error: function (xhr, status, error) {
        // alert(error);
      },
    });
  }



   function init() {
    $.ajax({
      type: "post",
      data: {
        id: keyWord,
      },
      cache: false,
      url: "washerPage10_.php",
      dataType: "json",
      success: function (data, status) {
        var len=data.length;


        for(var i=0; i<data.length; i++) {
            var div = $("<div id=d"+i +" class='grid-item'></div>");
            var img = $("<img id=m"+i +">");

            var newUrl = data[i].carname.replace(/ /g, "_");
            var imgPath= "car/"+newUrl+".jpg";

           // alert(imgPath)

           // alert(data[i].imageUrl)
            img.attr("src",imgPath);
            var label = $("<label  class='lbCar'  id=lb"+i +">" + data[i].carname + "</label>");
            label.attr("for", "c" + (i+1));
            div.append(img);
            div.append(label);
            $(".grid-container").append(div);
            chosenCar=data[i].carname;

            
        }
        
      },
      error: function (xhr, status, error) {
        // alert(error);
      },
    });
  }


  var gridC = document.querySelector('.grid-container');

gridC.addEventListener('click', function(event) {
  var clickedCell = event.target;
  var cellId = clickedCell.getAttribute('id');
  

  var label = clickedCell.querySelector('label');
  var labelText = label.textContent;


  var textarea = document.getElementById("taReport");
  textarea.value='';
  textarea.value = labelText;

  const con1 = (document.getElementById("container1").style.display =
  "block");
  const con2 = (document.getElementById("container2").style.display =
  "none");
});




