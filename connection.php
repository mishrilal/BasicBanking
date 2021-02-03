<?php
    $con = mysqli_connect("localhost", "root", "", "GRIPBank");

    if(!$con) {
        die("Could not connect to the database - ". mysqli_connect_error());
    }
?>