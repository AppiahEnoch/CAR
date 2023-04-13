function insertTransaction() {
  if (
    aeEmpty(chosenCar) ||
    aeEmpty(wfullname) ||
    aeEmpty(action1) ||
    aeEmpty(amount1)
  ) {
    return;
  }

  $.ajax({
    type: "post",
    cache: false,
    url: "washerPage13.php",
    dataType: "text",
    data: {
      carname: chosenCar,
      carNumber: carNumber,
      washer: wfullname,
      action: action1,
      amount: amount1,
      washeramount: washerAmount1,
    },
    success: function (data, status) {
     // alert(data)
      window.open("report/"+ data, "_blank");
      openPageReplace("washCarPage.php")
    },
    error: function (xhr, status, error) {
      alert(error);
    },
  });
}
