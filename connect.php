<?php
 $host='localhost';
 $username='root';
 $password='';
 $db='minischl_db';

 $minischl= new mysqli($host, $username, $password, $db);
 if($minischl){
    // echo 'connected';
 }
 else{
    echo 'connection failed'.$minischl->connect_error;
 }
?>