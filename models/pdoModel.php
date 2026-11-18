<?php

function setDB(){
    static $pdo;
    if($pdo === null){
        $pdo = new PDO("mysql:host=mysql-gabyalaprod.alwaysdata.net; dbname=gabyalaprod_bd","412561","Kuroko2004&**");
        //$pdo = new PDO("mysql:host=localhost; dbname=bdProd","root","");
        $pdo->setAttribute(PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION);
    }
    return $pdo;

}