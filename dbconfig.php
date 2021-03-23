<?php
    $hostname           =       "localhost";
    $username           =       "admin";
    $password           =       "lubega1992";
    $dbname             =       "fremuug";

    $conn               =        mysqli_connect($hostname, $username, $password, $dbname) 
                                 or die("Database connection failed.");
?>