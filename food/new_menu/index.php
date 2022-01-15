<?php 

include("../db/query.php");
$editor=select('customize_menu');

// pr($editor);

include('Components/header.php');
include('Components/banner.php');


// include('Components/banner_desk.php');

include('Components/menu.php');
include('Components/reservation.php');
include('Components/aboutus.php');
include('Components/footer.php')
?>