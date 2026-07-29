<?php
try{
 $conn= new PDO("mysql:host=localhost;dbname=demo1","root","root");
 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}
