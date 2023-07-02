<?php
include "checkUser.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <html lang="en">
      <head>
        <script
          src="https://code.jquery.com/jquery-3.6.3.min.js"
          integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
          crossorigin="anonymous"
        ></script>

        <link
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
          crossorigin="anonymous"
        />

        <script
          src="https://kit.fontawesome.com/c1db89cf54.js"
          crossorigin="anonymous"
        ></script>

        <script
          src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
          crossorigin="anonymous"
        ></script>

        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>Crystal Clear Washing Bay</title>
        <link rel="stylesheet" href="./washCarPage.css?<?php echo filemtime("washCarPage.css"); ?>" />

        <link rel="stylesheet" href="./washCarPageXS.css" />
        <link rel="stylesheet" href="./washCarList.css" />
      </head>
      <body>
        <div id="container1">
          <div id="crytalT" class="card">
     
            <h2 id="wash1">
            <i id="refresh" class="fa fa-leaf" aria-hidden="true"></i>
            WASH CAR <i id="exitIcon" class="fa fa-sign-out" aria-hidden="true" title="Exit"></i></h2>
          </div>
          <form id="form">
            <input id="tfCarNumber" placeholder="Car Number" type="text">
            <button type="submit" id="btCarType">Car Type</button>

            <button type="submit" id="btWasher">Washer</button>

            <button type="submit" id="btService">Services</button>
            <button type="submit" id="btPrint">Print
              <i id="spin1" class="fas fa-spinner fa-spin d-none"></i>
            </button>

       <div id="myrowD" class="row">
        <label class="lbD" id="lbWasherD">#######</label>
        <label class="lbD"  id="lbCarD">#######</label>
        <label class="lbD"  id="lbCountD"> 0</label>
       </div>
            <textarea
              name="taReport"
              id="taReport"
              cols="30"
              rows="6"
            ></textarea>
          </form>
        </div>

        <div  id="container2">
          <div id="container2Row0" class="row align-items-center">
            <div class="col-md-8">
              <input placeholder="Enter Car Name" id="tfSearch" type="search" class="form-control" />
            </div>
            <div class="col-md-4">
              <select id="car_list" class="form-select" aria-label="Default select example">
                <option selected>Open this select menu</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </div>
          </div>
        
          <div id="listRow" class="row">
            <!-- Other contents of the row -->
          </div>
        
          <div class="grid-container">
          </div>
        
          <div id="container2Row" class="row d-none">
            <button id="btC2done">Done</button>
          </div>
        </div>
        

        <div id="container3">

          <div id="container2Row0" class="row">
            <input placeholder="Enter Washer's Name" id="tfSearch2" type="search" />
    
          </div>
         
         
          <div class="grid-container2">
          </div>
        </div>

        <div id="container4">

          <div id="container2Row4" class="row">
            <input placeholder=" Choose Service" id="tfSearch4" type="search" />
    
          </div>
         
         
          <div class="grid-container4">

          
          </div>
          <div class="myrow">
            <button  id="btcontainer4Submit"> Done </button>
          </div>
      </body>

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
            <div
              style="background-color: white; color: black"
              class="modal-body"
            >
              <h6 style="color: black !important" id="aeAlertBody">
                ACTION PERFORMED SUCCESSFULLY.
              </h6>
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
            <div
              style="background-color: white; color: black"
              class="modal-body"
            >
              <h6 style="color: black !important" id="aeAlertBodyw">
                ACTION PERFORMED SUCCESSFULLY.
              </h6>
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
              <h5 id="aeMerrorTitle" class="modal-title">SORRY!</h5>
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
            <div
              style="background-color: white; color: black"
              class="modal-body"
            >
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
                <strong>CONFIRM ACTION!</strong>
              </h5>
            </div>
            <div class="modal-body">
              <p style="font-weight: bold">
                <span id="aeMBody"> Do you want to perform this action? </span>
              </p>
            </div>

            <div class="modal-footer">
              <div class="row">
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
        </div>
      </div>
      <!-- END AEMODEL-->

      <script src="washerPage.js"></script>
      <script src="washCarPage1.js"></script>
      <script src="washCarPage2.js?<?php echo filemtime("washCarPage2.js");?>"></script>
      <script src="washCarPage3.js?<?php echo filemtime("washCarPage3.js");?>"></script>
      <script src="washCarPage4.js?<?php echo filemtime("washCarPage4.js");?>"></script>

      <script src="car_list.js"></script>
    </html>
  </head>
</html>
