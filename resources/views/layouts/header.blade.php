<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use App\Models\User;
$user_details = User::where('id', Auth::user()->id)->first();
?>

<!DOCTYPE html>
<html data-bs-theme="light" lang="en-US" dir="ltr">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>{{ env('APP_NAME') }}</title>

    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="/assets/img/favicons/favicon.ico">
    <link rel="manifest" href="/assets/img/favicons/manifest.json">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css" />

    <meta name="msapplication-TileImage" content="/assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">

    {{-- Multi File Upload and preview --}}
    <script src="/assets/vendors/dropzone/dropzone.min.js"></script>
    <link href="/assets/vendors/dropzone/dropzone.min.css" rel="stylesheet" />

    <script src="/assets/js/config.js"></script>
    <script src="/assets/vendors/simplebar/simplebar.min.js"></script>
    <script src="/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.min.css"></script>

    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap"
        rel="stylesheet">
    <link href="/assets/vendors/simplebar/simplebar.min.css" rel="stylesheet">
    <link href="/assets/css/theme-rtl.min.css" rel="stylesheet" id="style-rtl">
    <link href="/assets/css/theme.min.css" rel="stylesheet" id="style-default">
    <link href="/assets/css/user-rtl.min.css" rel="stylesheet" id="user-style-rtl">
    <link href="/assets/css/user.min.css" rel="stylesheet" id="user-style-default">
    <script>
        var isRTL = JSON.parse(localStorage.getItem('isRTL'));
        if (isRTL) {
          var linkDefault = document.getElementById('style-default');
          var userLinkDefault = document.getElementById('user-style-default');
          linkDefault.setAttribute('disabled', true);
          userLinkDefault.setAttribute('disabled', true);
          document.querySelector('html').setAttribute('dir', 'rtl');
        } else {
          var linkRTL = document.getElementById('style-rtl');
          var userLinkRTL = document.getElementById('user-style-rtl');
          linkRTL.setAttribute('disabled', true);
          userLinkRTL.setAttribute('disabled', true);
        }
      </script>
    </head>

    <body>
      <!-- ===============================================--><!--    Main Content--><!-- ===============================================-->
      <main class="main" id="top">
        <div class="container-fluid bg-white" data-layout="container">

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
