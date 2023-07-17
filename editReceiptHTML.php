<?php
include "closeSession.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Crystal Clear | Edit Receipt</title>
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
    <link rel="stylesheet" href="./editReceipt.css" />
  </head>
  <body>
    <div class="container-fluid d-flex align-items-center justify-content-center m-auto mt-2">
      <div class="row d-flex align-items-center justify-content-center m-auto">
        <div class="col-12 d-flex align-items-center justify-content-center m-auto">
          <img id="logo" src="5.jpg" alt="" />
        </div>
        
        <div id="wrapper1" class="col">
          <h6 style="color: #735800">ALL RECEIPT INFORMATION</h6>
          
          <div class="scrollable-table m-auto">
          <table id="receiptTable" class="table table-striped">
            <thead>
                <tr>
                    <th>Washer</th>
                    <th>Car Name</th>
                    <th>Car Number</th>
                    <th>Service</th>
                    <th>Amount</th>
                    <th>Washer Amount</th>
                    <th>User Location</th>
                    <th>Location</th>
                    <th>Receipt Date</th>
                    <th>Receipt ID</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
          </div>
        </div>

        <!-- your remaining HTML code -->
    </div>


    <!-- END MY TOASTS -->

    <div id="spinner-container" class="spinner-container" style="display: none">
      <div class="spinner-border" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
      <p class="loading-text">Please Wait...</p>
    </div>

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

    <script src="ae.js"></script>
    <script src="editReceipt.js"></script>

  </body>
</html>