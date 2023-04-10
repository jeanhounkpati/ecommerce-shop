<?php
include("../database.php");
function getAll($table)
{
    global $PDO;
    $req=$PDO->prepare("SELECT * FROM $table");
    $req->execute();
    return $result=$req->fetchAll(PDO::FETCH_OBJ);  
}

function getById($table,$id)

{
    global $PDO;
    $req=$PDO->prepare("SELECT *  FROM products WHERE id=:id");
    $req->execute(['id'=>$_GET['id']]);
    return $result=$req->fetchAll(PDO::FETCH_OBJ);  
}

function redirect($url,$message)
{
    $_SESSION['message'] = $message;
    header('location:'.$url);
    exit();
}
?>