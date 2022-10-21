<?php
$dsn="mysql:host=localhost; dbname=banksystem";
$user="root";
$pass="";

try
{
    $con=new PDO($dsn,$user,$pass);
    $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    //echo "success!";

}
catch(PDOException $e)
{
    echo "failed to connect!..".$e->getMessage();
}
?>