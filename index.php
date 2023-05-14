<?php
include "closeSession.php";
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
  <link href="home.css" rel="stylesheet" />
</head>
<body class="d-flex flex-column h-100">

<div id="overlay">
  <div class="loader"></div>
</div>

  <header>
    <!-- Fixed navbar -->
    <nav id="nav1" class="navbar navbar-expand-md navbar-brand fixed-top w-100 m-0">
      <div class="container-fluid">
        <img id="logo" class="navbar-brand" src="image/logo.jpg" alt="" />
        <a id="title1" class="nav-link">

           CRYSTAL CLEAR WASHING BAY</a>

        <button id="hambergerButton" class="navbar-toggler" type="button" data-bs-toggle="collapse"
          data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="navbar-toggler-icon bg-light"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav me-auto mb-2 mb-md-0">
            <li class="nav-item">
              <a href="login.php" id="logout" class="nav-link"> Login <i class="fa fa-key" aria-hidden="true"></i></a>
            </li>
            <li class="nav-item d-none ">
              <a id="title1" class="nav-link" href="washCarPage.php">

                SOME TEXT</a>
            </li>
            <li class="nav-item d-none">
              <a id="ll0" class="nav-link" href="addWasher.php">

                Add Washer</a>
            </li>
            <li class="nav-item d-none">
              <a id="ll2" class="nav-link" href="addCar.php">
                <i class="fa fa-car" aria-hidden="true"></i>

                Add Car</a>
            </li>

            <li class="nav-item d-none">
              <a id="ll3" class="nav-link" href="#">
                <i class="fa fa-search" aria-hidden="true"></i>

                Search</a>
            </li>

            <li class="nav-item d-none">
              <a id="ll3" class="nav-link" href="code.php">
                <i class="fa fa-key" aria-hidden="true"></i>

                Code</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <!-- Begin page content -->

  <div class="container mt-5 mb-1">
    <div class="row mt-5">
    <label id="managerN" class="myTitle">Call the General Manager: <span id="gmanager"> 0000 </span></label>
      <div class="col-lg-6 col-md-12">
    
        <div class="card">
          <div class="card-body">
            <label id="blinkT" class="myTitle">Request for a Service. Its Easy!</label>
          <form id="form">

          
          <ul class="list-group">
              <li class="list-group-item d-flex justify-content-between align-items-center">

       

              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
             <textarea required placeholder="Your name" name="taName" id="taName" cols="30" rows="1"></textarea>
                
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
             <textarea  required placeholder="Your location" name="taLoc" id="taLoc" cols="30" rows="1"></textarea>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
               <input required id="mobile" type="tel" placeholder="Mobile Number"  pattern="^((\+?\d{1,3})|0)?\s*([1-9]\d{6,14})$">
           
            
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
              <textarea  required placeholder="describe your vehicle" name="tadesc" id="tadesc" cols="30" rows="2"></textarea>
               
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">

              <textarea  required placeholder="What Can We Do For You?" name="taservice" id="taservice" cols="30" rows="5"></textarea>
             
                
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
          
                <button name="submit" id="submit" type="submit" class="badge badge-secondary text-muted">Submit</button>
              </li>
            </ul>



          </form>            
          </div>
        </div>



      </div>


      <div class="col-lg-6 col-md-12">
        <div class="card">
          <div class="card-body">
            <label class="myTitle">OUR SERVICES</label>
            <ul class="list-group">
              <li class="listG d-flex justify-content-between align-items-center">
            <ul id="managerList">
            </ul>

              </li>
        
              
            </ul>
          </div>
        </div>
      </div>



      <div class="col-lg-6 col-md-12 d-none">

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
                <strong class="yenC" >CONFIRM ACTION!</strong>
              </h5>
            </div>
            <div class="modal-body">
                <span class="yenC" id="aeMBody"> Do you want to perform this action? </span>
            </div>

         
              <div style="margin:0; padding: 0;" class="row">
                <div class="col-6">
                  <button id="aeMyesNoBt" type="button" class="btn btn-danger">
                    Yes
                  </button>
                </div>
                <div class="col-6">
                  <button
                    id="btClose"
                    type="button"
                    class="btn btn-primary"
                    data-bs-dismiss="modal"
                  >
                    No
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
  

</body>
</html>