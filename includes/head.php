<?php 
include("connection.php"); 
include("functions.php"); 
if(checkLogin() == false && checkUserType() != "SA"){
    header("location:login.php");
    exit();
}

$pageName = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Route Tracker Admin Area : Dashboard</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />

    <script src="https://use.fontawesome.com/cdc92039bf.js"></script>
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   <style type="text/css">
        .align-middle {
            vertical-align: middle!important;
        }
       .panelHeadBg,.panelFootBg{
        background: #c90000 !important;
        color: #ffffff !important;
       }
       .panelBorder{
        border: 1px #c90000 !important;;
       }
       .pagination > .active > a, .pagination > .active > span, .pagination > .active > a:hover, .pagination > .active > span:hover, .pagination > .active > a:focus, .pagination > .active > span:focus{
        background: #c90000 !important;
        border-color: #c90000 !important;
       }
         /* width */
        #notification::-webkit-scrollbar {
          width: 7px;
        }

        /* Track */
        #notification::-webkit-scrollbar-track {
          box-shadow: inset 0 0 5px grey; 
          border-radius: 5px;
        }
         
        /* Handle */
        #notification::-webkit-scrollbar-thumb {
          background: red; 
          border-radius: 7px;
        }

        /* Handle on hover */
        #notification::-webkit-scrollbar-thumb:hover {
          background: #c90000; 
        }
   </style>
</head>
<body>