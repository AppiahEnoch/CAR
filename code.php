<?php
include "checkSysadmin.php";
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

        <link rel="stylesheet" href="./code.css" />
      </head>
      <body>
        
        <div id="container1">
          <h5 style="color:white; font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif ;" >GENERATE REGISTRATION CODE</h5>
          <form id="form">
            <input  type="text" id="code" placeholder="Copy this Code"/>
            <br>
            <button type="submit" id="submit">
              Generate  <i id="spin" class="fas fa-spinner fa-spin"></i>
            </button>
            <label id="lblogin4" class="lbforgot">
              <i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i>
              Back</label
            >

        
          </form>
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

      <script src="./code.js"></script>
    </html>
  </head>
</html>
