<?php
include "checkUser.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="AECleanCodes" />
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
      src="https://code.jquery.com/jquery-3.6.1.min.js"
      integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
      integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>

    <title>Crustal Clear Washing bay</title>

    
    <!-- Custom styles for this template -->
    <link href="adminpage.css" rel="stylesheet" />
  </head>
  <body class="d-flex flex-column h-100">
    <header>
      <!-- Fixed navbar -->
      <nav
        id="nav1"
        class="navbar navbar-expand-md navbar-brand fixed-top w-100 m-0"
      >
        <div class="container-fluid">
          <img id="logo" class="navbar-brand" src="image/logo.jpg" alt="" />
          <button
            id="hambergerButton"
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarCollapse"
            aria-controls="navbarCollapse"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
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
                  Wash Car</a
                >
              </li>
              <li class="nav-item ">
                <a id="ll1" class="nav-link" href="addWasher.php">
                <i class="fa fa-user-circle" aria-hidden="true"></i>
                  Add Washer</a
                >
              </li>
              <li class="nav-item d-none">
                <a id="ll2" class="nav-link" href="addCar.php">
                  <i class="fa fa-car" aria-hidden="true"></i>

                  Add Car</a
                >
              </li>

              <li class="nav-item d-none">
                <a id="ll3" class="nav-link" href="#">
                  <i class="fa fa-search" aria-hidden="true"></i>

                  Search</a
                >
              </li>

              <li class="nav-item d-none">
                <a id="ll3" class="nav-link" href="code.php">
                  <i class="fa fa-key" aria-hidden="true"></i>

                  Code</a
                >
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
              <label class="myTitle">Today</label>
             
              <ul class="list-group">
                <li
                  class="list-group-item d-flex justify-content-between align-items-center"
                >
                Total Services
                  <span id="totalServices" class="badge badge-secondary text-muted">00</span>
                </li>
                <li
                  class="list-group-item d-flex justify-content-between align-items-center"
                >
                  Total money received
                  <span  id="totalServiceMoney" class="badge badge-secondary text-muted">00</span>
                </li>
          
              </ul>
            </div>
          </div>
          



        </div>
        
        
    <footer id="myFooter" class="py-0 fixed-bottom">
      <div class="container">
        <span class="text-bg-success">&COPY;2023 All rights reserved</span>
      </div>
    </footer>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
      crossorigin="anonymous"
    ></script>

    <script src="userPage.js"></script>
    <script src="jf.js"></script>
  </body>
</html>
