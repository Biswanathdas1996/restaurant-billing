<!DOCTYPE html>
<html lang="en">
<head>
  <title>Resturant</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php
  include('../../src/files/cdn.php');
  include('../../src/files/css.php');
  error_reporting(0);
  ?>
</head>

<body class="skin-blue">
  <div class="wrapper">
    <header class="main-header">
      <!-- Logo -->
      <a href="#" class="logo"><b>Resturant</b></a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="" data-toggle="offcanvas" role="button">

          <span class="glyphicon glyphicon-align-justify" style="float: left;background-color: transparent;background-image: none;padding: 14px 14px;color: white;font-size: 20px;">
        </a>

<!-- 
        <button type="button" class="btn btn-default" onclick="window.history.go(-1); return false;" style="margin-top: 8px;">
          <span class="glyphicon glyphicon-arrow-left"></span>&nbsp;
          <b>Go Back</b></button> -->




        <!-- <button type="button" class="btn btn-default" onclick="window.location.reload()" style="margin-top: 8px;">
            <span class="glyphicon glyphicon-refresh"></span>&nbsp;
            <b>Refresh</b></button> -->
        <?php
        $actual_link_page = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        ?>
        <!-- <button type="button" class="btn btn-default" onclick='window.location.replace("<?php echo $actual_link_page; ?>")' style="margin-top: 8px;">
          <span class="glyphicon glyphicon-refresh"></span>&nbsp;
          <b>Refresh</b></button> -->



        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">


            <li>
              <a href="../../pages/forget-password/">
                <span class="glyphicon glyphicon-cog"></span>&nbsp;
                Account</a>
            </li>

            <li>
              <a href="../../login/logout.php">
                <span class="glyphicon glyphicon-log-out"></span>&nbsp;
                Logout</a>
            </li>



          </ul>
        </div>
      </nav>

      <style>
        #loader {
          /* border: 12px solid #f3f3f3; 
            border-radius: 50%; 
            border-top: 12px solid #444444; 
            width: 70px; 
            height: 70px; 
            animation: spin 1s linear infinite;  */

          /* background-image: url("../../src/layout/loader.gif"); */

          /* Full height */
          height: 100%;

          /* Center and scale the image nicely */
          background-position: center;
          background-repeat: no-repeat;
          background-size: cover;
          background-color: #c5b8a8;
          /* background: url('loader.gif') no-repeat; */

        }

        @keyframes spin {
          100% {
            transform: rotate(360deg);
          }
        }

        .center {
          position: absolute;
          top: 0;
          bottom: 0;
          left: 0;
          right: 0;
          margin: auto;

        }


        .skin-red .main-header .logo {
          color: #ffffff;
          border-bottom: 0px solid transparent;
          background: linear-gradient(to right, #e52d27, #b31217) !important;
        }

        .panel-default {
          border-color: #ddd !important;
          box-shadow: 0 0.46875rem 2.1875rem rgba(11, 41, 84, 0.03), 0 0.9375rem 1.40625rem rgba(11, 41, 84, 0.03), 0 0.25rem 0.53125rem rgba(11, 41, 84, 0.05), 0 0.125rem 0.1875rem rgba(11, 41, 84, 0.03) !important;
          /* box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.1), 0 6px 20px 0 rgba(0, 0, 0, 0.08) !important; */
          border-radius: 5px !important;
        }

        .panel-default>.panel-heading {
          color: black;
          background-color: #f5f5f5;
          border-color: #ddd;
          /* background: #8e9eab;
          background: -webkit-linear-gradient(to right, #8e9eab, #eef2f3);
          background: linear-gradient(to right, #cecfd13d, #f1f1f1) !important; */
          background: #fdfffc;
          font-weight: bold;
          letter-spacing: 1px;
        }


        .box {
          position: relative;
          border-radius: 3px;
          background: #ffffff;
          border-top: 3px solid #d2d6de;
          border-top-color: rgb(210, 214, 222);
          margin-bottom: 20px;
          width: 100%;
          box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
          border-color: #ddd !important;
          /* box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.1), 0 6px 20px 0 rgba(0, 0, 0, 0.08) !important; */
          box-shadow: 0 0.46875rem 2.1875rem rgba(11, 41, 84, 0.03), 0 0.9375rem 1.40625rem rgba(11, 41, 84, 0.03), 0 0.25rem 0.53125rem rgba(11, 41, 84, 0.05), 0 0.125rem 0.1875rem rgba(11, 41, 84, 0.03) !important;
          border-radius: 5px !important;
        }

        .info-box {
          display: block;
          min-height: 90px;
          background: #fff;
          width: 100%;
          box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
          border-radius: 2px;
          margin-bottom: 15px;
          box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.1), 0 6px 20px 0 rgba(0, 0, 0, 0.08) !important;
          border-radius: 5px !important;
        }

        .box-header.with-border {
          border-bottom: 1px solid #f4f4f4;
          border-bottom-color: rgb(244, 244, 244);
          color: black;
          background-color: #f5f5f5;
          border-color: #ddd;
          /* background: #8e9eab;
          background: -webkit-linear-gradient(to right, #8e9eab, #eef2f3);
          background: linear-gradient(to right, #cecfd13d, #f1f1f1) !important; */
          background: #fdfffc;
          font-weight: bold;
          letter-spacing: 1px;
        }

        .btn-default {
          background: #8e9eab;
          background: -webkit-linear-gradient(to right, #8e9eab, #eef2f3);
          background: linear-gradient(to right, #e9e9e9, #fff);
          box-shadow: 0 3px 6px 0 rgba(0, 0, 0, 0.16), 0 6px 20px 0 rgba(0, 0, 0, 0.18) !important;
          border: none !important;
        }

        .btn-info {
          background: #00c6ff;
          background: -webkit-linear-gradient(to right, #00c6ff, #0072ff);
          background: linear-gradient(to right, #00c6ff, #0072ffd6);
          box-shadow: 0 3px 6px 0 rgba(0, 0, 0, 0.16), 0 6px 20px 0 rgba(0, 0, 0, 0.18) !important;
          border: none !important;
        }

        .btn-success {
          background: #11998e;
          background: -webkit-linear-gradient(to right, #11998e, #00b644);
          background: linear-gradient(to right, #11998e, #00b644) !important;
          box-shadow: 0 3px 6px 0 rgba(0, 0, 0, 0.16), 0 6px 20px 0 rgba(0, 0, 0, 0.18) !important;

          border: none !important;
        }

        .btn-primary {
          background: #2980b9;
          background: -webkit-linear-gradient(to right, #2980b9, #2c3e50);
          background: linear-gradient(to right, #2980b9, #2f5981) !important;
          box-shadow: 0 3px 6px 0 rgba(0, 0, 0, 0.16), 0 6px 20px 0 rgba(0, 0, 0, 0.18) !important;
          border: none !important;
        }

        .btn-warning {
          background: #fdc830;
          background: -webkit-linear-gradient(to right, #fdc830, #f37335);
          background: linear-gradient(to right, #fdc830, #ff7937) !important;
          box-shadow: 0 3px 6px 0 rgba(0, 0, 0, 0.16), 0 6px 20px 0 rgba(0, 0, 0, 0.18) !important;
          border: none !important;
        }

        .btn-danger {
          background: #e52d27;
          background: -webkit-linear-gradient(to right, #e52d27, #b31217);
          background: linear-gradient(to right, #e52d27, #b31217) !important;

          box-shadow: 0 3px 6px 0 rgba(0, 0, 0, 0.16), 0 6px 20px 0 rgba(0, 0, 0, 0.18) !important;
          border: none !important;
        }


        .progress-bar-aqua,
        .progress-bar-info {
          background: #00c6ff;
          background: -webkit-linear-gradient(to right, #00c6ff, #0072ff);
          background: linear-gradient(to right, #00c6ff, #0072ff);
        }

        .bg-aqua,
        .callout.callout-info,
        .alert-info,
        .label-info,
        .modal-info .modal-body {
          background: #00c6ff;
          background: -webkit-linear-gradient(to right, #00c6ff, #0072ff) !important;
          background: linear-gradient(to right, #00c6ff, #0072ff) !important;

        }

        .bg-red,
        .callout.callout-danger,
        .alert-danger,
        .alert-error,
        .label-danger,
        .modal-danger .modal-body {
          background: #e52d27;
          background: -webkit-linear-gradient(to right, #e52d27, #b31217) !important;
          background: linear-gradient(to right, #e52d27, #b31217) !important;
          background-color: rgba(0, 0, 0, 0);
        }

        .bg-yellow,
        .callout.callout-warning,
        .alert-warning,
        .label-waring,
        .modal-warning .modal-body {
          background: #fdc830;
          background: -webkit-linear-gradient(to right, #fdc830, #f37335) !important;
          background: linear-gradient(to right, #fdc830, #ff9d6e) !important;
          background-color: rgba(0, 0, 0, 0);
        }



        .bg-green,
        .callout.callout-success,
        .alert-success,
        .label-success,
        .modal-success .modal-body {
          background: #11998e;
          background: -webkit-linear-gradient(to right, #11998e, #38ef7d) !important;
          background: linear-gradient(to right, #11998e, #00e556) !important;
          background-color: rgba(0, 0, 0, 0);
        }


        .content-wrapper,
        .right-side {
          min-height: 100%;
          background-color: #f4f5fd !important;
          z-index: 800;
        }


        .form-control {
          border-radius: 5px !important;
          box-shadow: none;
          border-color: #d2d6de;
          background: #dedede38 !important;
          padding: 8px !important;
          height: 40px;
        }
      </style>


    </header>



    <div id="loader" class="center">
      <center>
        <img src="../../src/layout/loader.gif" style="margin-left:180px;" />
      </center>
    </div>

    <script>
      document.onreadystatechange = function() {
        if (document.readyState !== "complete") {
          document.querySelector(
            "body").style.visibility = "hidden";
          document.querySelector(
            "#loader").style.visibility = "visible";
        } else {
          document.querySelector(
            "#loader").style.display = "none";
          document.querySelector(
            "body").style.visibility = "visible";
        }
      };

      $(document).ready(function() {
        $(".no-print").hide();
      });
    </script>