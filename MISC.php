<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>ADD MISC</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
    />

    <script
      src="https://code.jquery.com/jquery-3.7.0.min.js"
      integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
      crossorigin="anonymous"
    ></script>

    <link rel="stylesheet" href="./MISC.css?<?php echo filemtime("MISC.css"); ?>" />
    <link rel="stylesheet" href="./aeT.css?<?php echo filemtime("aeT.css"); ?>" />

  </head>
  <body>
    <div
      class="container-fluid d-flex align-items-center justify-content-center m-auto mt-2"
    >
      <div class="row d-flex align-items-center justify-content-center m-auto">
        <div
          class="col-12 d-flex align-items-center justify-content-center m-auto"
        >
          <img id="logo" src="5.jpg" alt="" />
        </div>



    <div class="row gap-2">
    <div id="wrapper1" class="col-12 col-md-6 me-2 order-2 order-md-1">
<div id="miscTable" class="row g-3 d-flex align-items-center justify-content-center m-auto mt-2">

       
</div>
</div>



<div id="wrapper2" class="col order-1  order-md-2">
          <i
            style="color: #735800"
            id="spin2"
            class="fas fa-spinner fa-spin d-none"
          ></i>
          <i id="spin4" class="fas fa-spinner fa-spin d-none"></i>
          <h5 style="color: #735800"><b>MISCELLANEOUS RECORD</b></h5>
          <div class="row align-items-end">
  
  
          <div class="dropdown">
  <!-- Dropdown button -->
  <button class="btn btn-secondary dropdown-toggle" type="button" id="printDropdown" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="fas fa-print"></i> Print
  </button>

  <!-- Dropdown menu -->
  <ul class="dropdown-menu" aria-labelledby="printDropdown">
    <li><a class="dropdown-item" href="MISC_P1.php">DAILY</a></li>
    <li><a class="dropdown-item" href="MISC_P2.php">WEEKLY</a></li>
    <li><a class="dropdown-item" href="MISC_P3.php">MONTHLY</a></li>
    <li><a class="dropdown-item" href="MISC_P4.php">YEARLY</a></li>
  </ul>
</div>

  </div>




          <form id="addExpenseForm"

class="row g-3 d-flex align-items-center justify-content-center m-auto mt-2"
>

<div class="col-12">
<div class="row gap-2">

<div class="col-12">
    
<select class="form-select" name="washerSelect" id="washerSelect">
<option selected value="0">Select Washer</option>
    <option value="1">waherName</option>
    <option value="2">waherName2</option>
</select>

</div>




<div class="col-12">

  <input type="number" class="form-control" id="totalAmount" placeholder="Total Amount" step="any">
    </div>
    <div class="col-12">

    <input type="number" class="form-control" id="washerAmount" placeholder="Washer Amount" step="any">
    </div>
</div>
</div>


<div class="col-12">

  <textarea class="form-control" id="expenseDescription" rows="2" placeholder="Enter Description"></textarea>
</div>

<div class="col-12">
  <label for="expenseDate" class="form-label">Date</label>
  <input type="date" class="form-control" id="expenseDate">
</div>

<div class="row mt-2">
<div class="col-6">
  <button id="btAddExpense" type="submit" class="btn btn-primary w-100">
  <i class="fa-solid fa-leaf"></i>    Add New
  </button>
</div>
<div class="col-6">
  <button id="updateButton" type="button" class="btn btn-primary w-100">
  <i class="fa-solid fa-pen-to-square"     data-bs-toggle="tooltip" data-bs-placement="top" title="Record on Customers"></i>  Update
  </button>
</div>
</div>

<div id="wrapper-col-6" class="row mt-2">
  <div class="col-6">
    <a href="adminpage.php"> <i class="bi bi-house-fill"></i>Go Back</a>
  </div>
</div>
</form>



        </div>

    </div>



   


        

        
      </div>
    </div>

    <div
      id="aeToastYN"
      class="toast"
      role="alert"
      aria-live="assertive"
      aria-atomic="true"
    >
      <div class="toast-header bg-danger text-white">
        <i
          style="color: white"
          class="fa fa-exclamation-triangle me-2"
          aria-hidden="true"
        ></i>
        <strong class="me-auto">Error!</strong>
        <small>AECleanCodes</small>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="toast"
          aria-label="Close"
        ></button>
      </div>
      <div style="background-color: #f2f2f2" class="toast-body"></div>
      <div class="toast-footer">
        <div
          class="row d-flex align-items-center justify-content-center m-auto"
        >
          <div class="col-6">
            <button
              type="button"
              class="btn btn-primary btn-sm w-100"
              id="toastYes"
            >
              Yes
            </button>
          </div>

          <div class="col-6">
            <button
              type="button"
              class="btn btn-primary btn-sm w-100"
              id="toastNo"
            >
              No
            </button>
          </div>
        </div>
      </div>
    </div>




    
<div id="aeToastY" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="toast-header">
      <i class="fa fa-question-circle"></i>
      <strong>Confirm Delete Action!</strong>
      <small>Confirm!</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  <div class="toast-body">
      <p id="toastMessage"></p>
      <div class="row row-cols-2">
          <div class="col text-end">
              <button type="button" class="btn btn-success btn-sm">Yes <i class="fa fa-thumbs-up"></i></button>
          </div>
          <div class="col">
              <button type="button" class="btn btn-danger btn-sm">No <i class="fa fa-thumbs-down"></i></button>
          </div>
      </div>
  </div>
</div>

    

<!-- BEGIN MY TOASTS -->


<div id="aeToastE" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
   
  <div class="toast-header bg-danger text-white">
      <i style="color:white" class="fa fa-exclamation-triangle me-2" aria-hidden="true"></i>
    <strong class="me-auto">Error!</strong>
    <small>AECleanCodes</small>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  <div style="background-color: #f2f2f2;" class="toast-body">

  </div>
</div>



<div id="aeToastS" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="toast-header bg-success text-white">
      <i style="color: white;" class="bi bi-check-circle-fill me-2"></i>
    <strong class="me-auto">Success!</strong>
    <small>Success!</small>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  <div style="background-color: #f2f2f2;" class="toast-body">

  </div>
</div>

<!-- END MY TOASTS -->

<div id="spinner-container" class="spinner-container" style="display: none">
<div class="spinner-border" role="status">
    <span class="visually-hidden">Loading...</span>
</div>
<p class="loading-text">Please Wait...</p>
</div>




    <!-- Rest of the HTML -->

    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
      integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
      integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ"
      crossorigin="anonymous"
    ></script>

    <script
      src="https://kit.fontawesome.com/c1db89cf54.js"
      crossorigin="anonymous"
    ></script>

    <script src="ae.js?version=<?php echo filemtime('ae.js'); ?>"></script>
    <script src="MISC.js?version=<?php echo filemtime('MISC.js'); ?>"></script>

  </body>
</html>
