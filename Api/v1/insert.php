<?php

require_once ("../../config/settings.php");

$now = date("Y-m-d H:i:s");
$date = date("Y-m-d");

if(!empty($_GET['site']) && !empty($_GET['value']))
{
    $site = $_GET['site'];
    $value = $_GET['value'];
    $time_slot = date("H");

    $query_check = "SELECT * FROM item_counter 
    WHERE time_slot = $time_slot 
    AND site_id = $site 
    AND date_create BETWEEN '$date 00:00:00' AND '$date 23:59:59'
    ";
    $result_check = mysqli_query($connection, $query_check);


    if(mysqli_num_rows($result_check) > 0)
    {
        echo "Found!<br>";
        $row = mysqli_fetch_array($result_check);
        $id = $row['id'];
        $current_count = $row['count'];
        $count = $value + $current_count;

        $query_insert = "UPDATE item_counter SET site_id = $site, count = $count, time_slot = $time_slot WHERE id = $id";
    }
    else
    {
        $query_insert = "INSERT INTO  item_counter (site_id, count, time_slot) VALUES  ($site,$value,$time_slot)";
    }

    $run_insert = mysqli_query($connection, $query_insert);

    if(!$run_insert)
    {
        $log = fopen("error_log.txt", "a");
        $txt = "$now: Error on empty GET parameter site or value. \n";
        fwrite($log, $txt);
        fclose($log);
    }
    else
    {
        echo "Success";
    }





}
else
{
    $log = fopen("error_log.txt", "a");
    $txt = "$now: Error on empty GET parameter site or value. \n";
    fwrite($log, $txt);
    fclose($log);
}

