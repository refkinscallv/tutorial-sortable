<?php

    $connect    = mysqli_connect("localhost", "root", "", "sortable");

    if(!$connect){
        echo "Database connection failed : ". mysqli_connect_error();
        die();
    }