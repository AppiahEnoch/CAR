var washerName = null;
var washerDays = null;
var managerName = null;
var managerDays = null;
var sysDays = null;
$(document).ready(function () {
  getWashers();
  getManager();
  showSpin();

  $('#ss').keyup(function () {});

  $('#downloadwasher1').click(function () {
    washerName = getSelectedText('washerList');
    washerDays = $('#day1').val();

    if (aeEmpty(washerDays)) {
      washerDays = 1;
    }
    getWorkerDaily();
  });

  $('#downloadwasher2').click(function () {
    washerName = getSelectedText('washerList');
    washerDays = $('#day1').val();
    if (aeEmpty(washerDays)) {
      washerDays = 1;
    }
    getWorkerMonthly();
  });

  $('#downloadmanager1').click(function () {
    managerName = getSelectedText('managerList');
    managerDays = $('#day2').val();
    if (aeEmpty(managerDays)) {
      managerDays = 1;
    }
    getManagerDaily();
  });

  $('#downloadmanager2').click(function () {
    managerName = getSelectedText('managerList');
    managerDays = $('#day2').val();
    if (aeEmpty(managerDays)) {
      managerDays = 1;
    }
    getManagerMonthly();
  });

  $('#downloadS1').click(function () {
    sysDays = $('#day3').val();
    if (aeEmpty(sysDays)) {
      sysDays = 1;
    }
    getSystemDailyReport();
  });

  $('#downloadS2').click(function () {
    sysDays = $('#day3').val();
    if (aeEmpty(sysDays)) {
      sysDays = 1;
    }
    getSystemMonthlyReport();
  });

  $('#downloadS3').click(function () {
    sysDays = $('#day3').val();
    if (aeEmpty(sysDays)) {
      sysDays = 1;
    }
    getSystemYearlyReport();
  });

  $('#emptySystem').click(function () {
    showMYesNo();
  });

  $('#btDeleteWorker').click(function () {
    if (confirm('Are you sure you want to delete this worker?')) {
      washerName = getSelectedText('washerList');
      deleteWorker();
    }
  });

  $('#btDeleteUser').click(function () {
    if (confirm('Are you sure you want to delete this User?')) {
      managerName = getSelectedText('managerList');
      deleteUser();
    }
  });

  $('#aeMyesNo').on('click', '#aeMyesNoBt', function (e) {
    $('#aeMyesNo').modal('hide');
    var value1 = $('#deleteOptions').val();

    if (value1 == 1) {
      deleteAllUserData();
    } else if (value1 == 2) {
      deleteAllVehicle();
    } else if (value1 == 3) {
      deleteAllWorkers();
    }

    if (value1 == 1 || value1 == 2 || value1 == 3) {
      $('#aeMyesNo').modal('hide');
      $('#aeMsuccessw').modal('show');
    }
  });

  $('#myModal').on('click', '#btResend', function (e) {});

  $('#aeMsuccessw').on('hidden.bs.modal', function () {
    openPageReplace('adminpage.php');
  });

  $('#aeMerror').on('hidden.bs.modal', function () {
    hideSpin();
  });
});

function getWashers() {
  $.ajax({
    type: 'post',
    cache: false,
    url: 'selectWasher.php',
    dataType: 'json',
    success: function (data, status) {
      $('#washerList').empty();

      // Loop through the data and add each washer as an option
      for (var i = 0; i < data.length; i++) {
        var option = $('<option></option>')
          .attr('value', data[i])
          .text(data[i]);
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
    type: 'post',
    cache: false,
    url: 'selectManager.php',
    dataType: 'json',
    success: function (data, status) {
      $('#managerList').empty();
      // Loop through the data and add each washer as an option
      for (var i = 0; i < data.length; i++) {
        var option = $('<option></option>')
          .attr('value', data[i])
          .text(data[i]);
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
    type: 'post',
    cache: false,
    data: {
      workerName: washerName,
      workerDays: washerDays,
    },
    // url: "dailyworkerReport.php",
    url: 'dailyworkerReportDetails.php',
    dataType: 'text',
    success: function (data, status) {
      alert(data) 
      if (data != 11) {
        showAEMerror('NO RECORD FOUND', 'NO RECORD FOUND');
        return;
      }

      aeDownload('report/workerDailyReport.pdf');
    },

    error: function (xhr, status, error) {
      console.log(error);
    },
  });
}

function getWorkerMonthly() {
  $.ajax({
    type: 'post',
    cache: false,
    data: {
      workerName: washerName,
      workerDays: washerDays,
    },
    // url: "dailyworkerReport.php",
    url: 'monthlyworkerReportDetails.php',
    dataType: 'text',
    success: function (data, status) {
      if (data != 11) {
        showAEMerror('NO RECORD FOUND', 'NO RECORD FOUND');
        return;
      }

      aeDownload('report/workerMonthlyReport.pdf');
    },

    error: function (xhr, status, error) {
      console.log(error);
    },
  });
}

function getManagerDaily() {
  $.ajax({
    type: 'post',
    cache: false,
    data: {
      workerName: managerName,
      workerDays: managerDays,
    },
    url: 'dailyManagerReportDetails.php',
    // url: "monthlyworkerReportDetails.php",
    dataType: 'text',
    success: function (data, status) {
      if (data != 11) {
        showAEMerror('NO RECORD FOUND', 'NO RECORD FOUND');
        return;
      }

      aeDownload('report/managerDailyReport.pdf');
    },

    error: function (xhr, status, error) {
      console.log(error);
    },
  });
}

function getManagerMonthly() {
  $.ajax({
    type: 'post',
    cache: false,
    data: {
      workerName: managerName,
      workerDays: managerDays,
    },
    url: 'monthlyManagerReportDetails.php',
    // url: "monthlyworkerReportDetails.php",
    dataType: 'text',
    success: function (data, status) {
      if (data != 11) {
        showAEMerror('NO RECORD FOUND', 'NO RECORD FOUND');
        return;
      }

      aeDownload('report/managerMonthlyReport.pdf');
    },

    error: function (xhr, status, error) {
      console.log(error);
    },
  });
}

function getSystemDailyReport() {
  $.ajax({
    type: 'post',
    cache: false,
    data: {
      sysDays: sysDays,
    },
    // url: "dailyworkerReport.php",
    url: 'dailySystemReportDetails.php',
    dataType: 'text',
    success: function (data, status) {
      if (data != 11) {
        showAEMerror('NO RECORD FOUND', 'NO RECORD FOUND');
        return;
      }

      aeDownload('report/systemDailyReport.pdf');
    },

    error: function (xhr, status, error) {
      console.log(error);
    },
  });
}

function getSystemMonthlyReport() {
  $.ajax({
    type: 'post',
    cache: false,
    data: {
      sysDays: sysDays,
    },
    // url: "dailyworkerReport.php",
    url: 'monthlySystemReportDetails.php',
    dataType: 'text',
    success: function (data, status) {
      if (data != 11) {
        showAEMerror('NO RECORD FOUND', 'NO RECORD FOUND');
        return;
      }

      aeDownload('report/systemMonthlyReport.pdf');
    },

    error: function (xhr, status, error) {
      console.log(error);
    },
  });
}

function getSystemYearlyReport() {
  $.ajax({
    type: 'post',
    cache: false,
    data: {
      sysDays: sysDays,
    },
    // url: "dailyworkerReport.php",
    url: 'yearlySystemReportDetails.php',
    dataType: 'text',
    success: function (data, status) {
      if (data != 11) {
        showAEMerror('NO RECORD FOUND', 'NO RECORD FOUND');
        return;
      }

      aeDownload('report/systemYearlyReport.pdf');
    },

    error: function (xhr, status, error) {
      console.log(error);
    },
  });
}

function deleteAllUserData() {
  $.ajax({
    type: 'post',
    cache: false,
    url: 'deleteAllUsers.php',
    dataType: 'json',
    success: function (data, status) {
      // alert(data)
    },
    error: function (xhr, status, error) {
      console.log(error);
    },
  });
}

function deleteAllVehicle() {
  $.ajax({
    type: 'post',
    cache: false,
    url: 'deleteAllVehicle.php',
    dataType: 'json',
    success: function (data, status) {
      //alert(data)
    },
    error: function (xhr, status, error) {
      console.log(error);
    },
  });
}
function deleteAllWorkers() {
  $.ajax({
    type: 'post',
    cache: false,
    url: 'deleteAllWorkers.php',
    dataType: 'json',
    success: function (data, status) {
      //alert(data)
    },
    error: function (xhr, status, error) {
      console.log(error);
    },
  });
}

function deleteWorker() {
  $.ajax({
    type: 'post',
    cache: false,
    url: 'deleteWorker.php',
    data: {
      worker: washerName,
    },
    dataType: 'json',
    success: function (data, status) {
      alert(data);
    },
    error: function (xhr, status, error) {
      console.log(error);
    },
  });
}
function deleteUser() {
  $.ajax({
    type: 'post',
    cache: false,
    url: 'deleteUser.php',
    data: {
      worker: managerName,
    },
    dataType: 'json',
    success: function (data, status) {
      alert(data);
    },
    error: function (xhr, status, error) {
      console.log(error);
    },
  });
}
