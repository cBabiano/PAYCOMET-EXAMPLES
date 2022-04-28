<?php
include("methods.php");

$apikey	= "4946862062130a3737333942ee2daedaf04ff3d5";
$obj= new Paycomet_Rest($apikey);

echo $obj->form(1, "ES", 9779,"001","1919","EUR",1);

?>
