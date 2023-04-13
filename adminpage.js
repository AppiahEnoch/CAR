var washerName=null
var washerDays=null
var managerName=null
var managerDays=null
$(document).ready(function () {


    getWashers()
    getManager()
    showSpin();


  $("#ss").keyup(function () {
    
  });

  $("#downloadwasher1").click(function () {
      washerName=getSelectedText("washerList");
     washerDays= $("#day1").val()

     if(aeEmpty(washerDays)){
      washerDays=1;
     }
     getWorkerDaily();

  });

  $("#downloadwasher2").click(function () {
      washerName=getSelectedText("washerList");
     washerDays= $("#day1").val()
     if(aeEmpty(washerDays)){
      washerDays=1;
     }
     getWorkerMonthly()
   
  });

  $("#downloadmanager1").click(function () {
      managerName=getSelectedText("managerList");
      managerDays= $("#day2").val()
      if(aeEmpty(managerDays)){
        managerDays=1;
       }
      getManagerDaily();
     
  });

  $("#downloadmanager2").click(function () {
      managerName=getSelectedText("managerList");
      managerDays= $("#day2").val()
      if(aeEmpty(managerDays)){
        managerDays=1;
       }
       getManagerMonthly();
     
  });


  

$("#aeMyesNo").on("click", "#aeMyesNoBt", function (e) {
//  $("#aeMyesNo").modal("hide")
});

  $("#myModal").on("click", "#btResend", function (e) {});

  $("#aeMsuccessw").on("hidden.bs.modal", function () {
    openPageReplace("signup2.html");
  });

  $("#aeMerror").on("hidden.bs.modal", function () {
    hideSpin();
  });
});

function getWashers() {
  $.ajax({
    type: "post",
    cache: false,
    url: "selectWasher.php",
    dataType: "json",
    success: function (data, status) {
 $('#washerList').empty();

      // Loop through the data and add each washer as an option
      for (var i = 0; i < data.length; i++) {
        var option = $('<option></option>').attr('value', data[i]).text(data[i]);
        $('#washerList').append(option);
      }
    },
    error: function (xhr, status, error) {
      console.log(error);
    },
  });
}

function getManager() {
  $.ajax({
    type: "post",
    cache: false,
    url: "selectManager.php",
    dataType: "json",
    success: function (data, status) {
 $('#managerList').empty();
      // Loop through the data and add each washer as an option
      for (var i = 0; i < data.length; i++) {
        var option = $('<option></option>').attr('value', data[i]).text(data[i]);
        $('#managerList').append(option);
      }
    },
    error: function (xhr, status, error) {
      console.log(error);
    },
  });
}


function getWorkerDaily() {
  $.ajax({
    type: "post",
    cache: false,
    data:{
      workerName:washerName,
      workerDays:washerDays

    },
   // url: "dailyworkerReport.php",
    url: "dailyworkerReportDetails.php",
    dataType: "text",
    success: function (data, status) {
      alert(data)

     if(data!=11){
      showAEMerror("NO RECORD FOUND","NO RECORD FOUND")
      return
     }

     aeDownload("report/workerDailyReport.pdf")
    },

    error: function (xhr, status, error) {
      console.log(error);
    },
  });
}


function getWorkerMonthly() {
  $.ajax({
    type: "post",
    cache: false,
    data:{
      workerName:washerName,
      workerDays:washerDays

    },
   // url: "dailyworkerReport.php",
    url: "monthlyworkerReportDetails.php",
    dataType: "text",
    success: function (data, status) {
      alert(data)

     if(data!=11){
      showAEMerror("NO RECORD FOUND","NO RECORD FOUND")
      return
     }

     aeDownload("report/workerMonthlyReport.pdf")
    },

    error: function (xhr, status, error) {
      console.log(error);
    },
  });
}



function getManagerDaily() {
  $.ajax({
    type: "post",
    cache: false,
    data:{
      workerName:managerName,
      workerDays:managerDays
      
    },
    url: "dailyManagerReportDetails.php",
    // url: "monthlyworkerReportDetails.php",
    dataType: "text",
    success: function (data, status) {
      alert(data)
      
      if(data!=11){
        showAEMerror("NO RECORD FOUND","NO RECORD FOUND")
        return
      }
      
      aeDownload("report/managerDailyReport.pdf")
    },
    
    error: function (xhr, status, error) {
      console.log(error);
    },
  });
}


function getManagerMonthly() {
  $.ajax({
    type: "post",
    cache: false,
    data:{
      workerName:managerName,
      workerDays:managerDays

    },
   // url: "dailyworkerReport.php",
    url: "monthlyManagerReportDetails.php",
    dataType: "text",
    success: function (data, status) {
      alert(data)

     if(data!=11){
      showAEMerror("NO RECORD FOUND","NO RECORD FOUND")
      return
     }

     aeDownload("report/managerMonthlyReport.pdf")
    },

    error: function (xhr, status, error) {
      console.log(error);
    },
  });
}

