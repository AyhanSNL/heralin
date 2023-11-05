<?php
try {
    $db=new PDO("mysql:host=localhost;dbname=heralindb;charset=utf8",'heralindbu','h3q0q8!1N');
    $rewurlbase="/";
}
catch (PDOExpception $e) {
    echo $e->getMessage();
}
?>