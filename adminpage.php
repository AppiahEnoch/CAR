<?php
include "checkSysadmin.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="" />
  <meta name="author" content="AECleanCodes" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />

  <script src="https://kit.fontawesome.com/c1db89cf54.js" crossorigin="anonymous"></script>

  <script src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
    integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <title>Crustal Clear Washing bay</title>


  <!-- Custom styles for this template -->
  <link href="adminpage.css" rel="stylesheet" />
</head>
<body class="d-flex flex-column h-100">
  <header>
    <!-- Fixed navbar -->
    <nav id="nav1" class="navbar navbar-expand-md navbar-brand fixed-top w-100 m-0">
      <div class="container-fluid">
        <img id="logo" class="navbar-brand" src="image/logo.jpg" alt="" />
        <button id="hambergerButton" class="navbar-toggler" type="button" data-bs-toggle="collapse"
          data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="navbar-toggler-icon bg-light"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav me-auto mb-2 mb-md-0">
            <li class="nav-item">
              <a href="login.php" id="logout" class="nav-link"> Log out</a>
            </li>
            <li class="nav-item">
              <a id="ll1" class="nav-link" href="washCarPage.php">
              <i class="fa fa-tint" aria-hidden="true"></i>
                Wash Car</a>
            </li>
            <li class="nav-item">
              <a id="ll1" class="nav-link" href="addWasher.php">
              <i class="fa fa-user-circle" aria-hidden="true"></i>
                Add Washer</a>
            </li>
            <li class="nav-item">
              <a id="ll2" class="nav-link" href="addCar.php">
                <i class="fa fa-car" aria-hidden="true"></i>

                Add Car</a>
            </li>

            <li class="nav-item">
              <a id="ll3" class="nav-link" href="addService.html">
              <i class="fa fa-tags" aria-hidden="true"></i>

                Service</a>
            </li>



     

            <li class="nav-item">
              <a id="ll3" class="nav-link" href="code.php">
                <i class="fa fa-key" aria-hidden="true"></i>

                Code</a>
            </li>

     
            <li class="nav-item">
              <a id="emptySystem" class="nav-link" href="#">
              <i class="fa fa-trash" aria-hidden="true"></i>

                Delete all2</a>
            </li>

            

           
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <!-- Begin page content -->

  <div class="container mt-5 mb-1">
    <div class="row mt-5">
      <div class="col-lg-6 col-md-12">

        <div class="card">
          <div class="card-body">
            <label class="myTitle">Daily Worker Record</label>

            <ul class="list-group">
              <li class="list-group-item d-flex justify-content-between align-items-center">

                <select id="washerList">
               
                </select>
              

              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
               <input id="day1" type="number" placeholder="Number eg. 1 ">
            

                <span id="downloadwasher1" class="badge badge-secondary text-muted">download</span>
              </li>
              
              <li class="list-group-item d-flex justify-content-between align-items-center">
              <label class="myTitle">Monthly Record</label>
                <span id="downloadwasher2" class="badge badge-secondary text-muted">download</span>
              </li>
              <button id="btDeleteWorker" class="btn-primary"> Delete</button>
            </ul>
          </div>
        </div>




      </div>


      <div class="col-lg-6 col-md-12">
        <div class="card">
          <div class="card-body">
            <label class="myTitle">Location Managers</label>
            <ul class="list-group">
              <li class="list-group-item d-flex justify-content-between align-items-center">
              <select id="managerList">
                </select>
              </li>
              
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <input id="day2" type="number" placeholder="Number eg. 1 ">
                <span id="downloadmanager1" class="badge badge-secondary text-muted">download</span>
              </li>

              <li  
                  class="list-group-item d-flex justify-content-between align-items-center">
              <label class="myTitle">Monthly Record</label>
              <span  id="downloadmanager2" class="badge badge-secondary text-muted">download</span>
              </li>
              <button id="btDeleteUser" class="btn-primary"> Delete</button>
            </ul>
          </div>
        </div>
      </div>



      <div class="col-lg-6 col-md-12">

        <div class="card">
          <div class="card-body">
            <label class="myTitle">SYSTEM REPORT</label>
            <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
               <input id="day3" type="number" placeholder="Number eg.1">
              
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                 Daily   Report
                <span id="downloadS1" class="badge badge-secondary text-muted">download</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
              Monthly Report
                <span id="downloadS2" class="badge badge-secondary text-muted">download</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
              Yearly Report
                <span id="downloadS3" class="badge badge-secondary text-muted">download</span>
              </li>

            </ul>
          </div>
        </div>
      </div>

      <div class="col-lg-6 col-md-12 d-none">

        <div class="card">
          <div class="card-body">
            <label class="myTitle">Three Months</label>
            <ul class="list-group">
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Total cars washed
                <span class="badge badge-secondary text-muted">00</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Total money received
                <span class="badge badge-secondary text-muted">00</span>
              </li>

            </ul>
          </div>
        </div>
      </div>



      <div class="col-lg-6 col-md-12 d-none">
        <div class="card">
          <div class="card-body">
            <label class="myTitle">This year</label>
            <ul class="list-group">
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Total cars washed
                <span class="badge badge-secondary text-muted">00</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Total money received
                <span class="badge badge-secondary text-muted">00</span>
              </li>

            </ul>
          </div>
        </div>
      </div>

    </div>
  </div>


    <!-- BEGIN  MODALS-->

    <div id="aeMsuccess" class="modal fade" tabindex="-3">
      <div class="modal-dialog" style="width: 20rem; margin: auto">
        <div class="modal-content">
          <div id="aeMsucces" class="modal-header">
            <h5 id="aeAlertTitle" class="modal-title">SUCCESS!</h5>
            <i
              style="color: white; margin-left: 1rem"
              class="fa fa-check-circle fa-2x"
              aria-hidden="true"
            ></i>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
            ></button>
          </div>
          <div style="background-color: white; color: black" class="modal-body">
            <h6 id="aeAlertBody">ACTION PERFORMED SUCCESSFULLY.</h6>
          </div>
        </div>
      </div>
    </div>

    <!-- END  MODALS-->
 
    <!-- BEGIN  MODALS-->

    <div id="aeMsuccessw" class="modal fade" tabindex="-3">
      <div class="modal-dialog" style="width: 20rem; margin: auto">
        <div class="modal-content">
          <div id="aeMsuccesw" class="modal-header">
            <h5 id="aeAlertTitlew" class="modal-title">SUCCESS!</h5>
            <i
              style="color: white; margin-left: 1rem"
              class="fa fa-check-circle fa-2x"
              aria-hidden="true"
            ></i>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
            ></button>
          </div>
          <div style="background-color: white; color: black" class="modal-body">
            <h6 id="aeAlertBodyw">ACTION PERFORMED SUCCESSFULLY.</h6>
          </div>
        </div>
      </div>
    </div>

    <!-- END  MODALS-->

    <!-- BEGIN  MODALS-->

    <div id="aeMerror" class="modal fade" tabindex="-3">
      <div class="modal-dialog" style="width: 20rem; margin: auto">
        <div class="modal-content">
          <div id="aeMerro" class="modal-header">
            <h5 id="aeMerrorTitle" class="modal-title">ERROR!</h5>
            <i
              style="color: white; margin-left: 1rem"
              class="fa fa-exclamation-triangle"
              aria-hidden="true"
            ></i>

            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
            ></button>
          </div>
          <div style="background-color: white; color: black" class="modal-body">
            <h6 id="aeMerrorBody">PLEASE TRY AGAIN.</h6>
          </div>
        </div>
      </div>
    </div>

    <!-- END  MODALS-->

  
      <!-- BEGIN AEMODEL-->
      <div id="aeMyesNo" class="modal" tabindex="-1">
        <div
          id="aeMyesN"
          style="max-width: 20rem; background-color: gray; margin: auto"
          class="modal-dialog"
        >
          <div class="modal-content">
            <div class="modal-header">
              <h5 id="aeMTitle" class="modal-title">
                <strong class="yenC" >CONFIRM DELETE ACTION!</strong>
              </h5>
            </div>
            <div class="modal-body">
            <span class="yenC" id="aeMBody"> Select Option To Delete </span>


        <div class="row">
        <select name="deleteOptions" id="deleteOptions">
                  <option value="0">CHOOSE OPTION</option>
                  <option value="1">ALL USER DATA</option>
                  <option value="2">ALL VEHICLE</option>
                  <option value="3">ALL WORKERS</option>
        
                </select>
        </div>
            </div>

         
              <div style="margin-left:2rem; margin-right:2rem; margin-bottom: 3rem;" class="row">
              <div class="col-6 d-flex justify-content-center">
  <button id="aeMyesNoBt" type="button" class="btn btn-danger">
    Delete
  </button>
</div>
<div class="col-6 d-flex justify-content-center">
  <button id="btClose" type="button" class="btn btn-primary" data-bs-dismiss="modal">
    Cancel
  </button>
</div>

     
          </div>
        </div>
      </div>
      <!-- END AEMODEL-->

  
   



  <footer id="myFooter" class="py-0 fixed-bottom">
    <div class="container">
      <span class="text-bg-success">&COPY;2023 All rights reserved</span>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>

    <script src="jf.js"></script>
    <script src="adminpage.js"></script>

</body>
</html>