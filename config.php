<?php
    $dhost="localhost";
    $duser="root";
    $dpass="";
    $dname="shopping";

    $conn = mysqli_connect($dhost,$duser,$dpass,$dname);

    if(!$conn){
        
        die("Error Message". mysqli_connect_error());
    }