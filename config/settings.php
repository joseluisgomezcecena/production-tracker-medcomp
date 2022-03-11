<?php

/*
 *  APP SETTINGS
 */
ob_start();

date_default_timezone_set("America/Tijuana");

if(isset($_GET['page']))
{
    $page = $_GET['page'];
}
else
{
    $page = "";
}

/*
 *  DATABASE CONNECTION
 */
const DB_HOST = "localhost";
const DB_NAME = "production_tracker";
const DB_USER = "root";
const DB_PASS = "";

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if(!$connection)
{
    die("Error connecting to database");
}


