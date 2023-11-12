<?php 
$host = "localhost";
$usernm = "root";
$pw = "";
$db = "database_idn";

$koneksi = new mysqli($host, $usernm, $pw, $db);

if ($koneksi->connect_error){
    die("Koneksi gagal :". $koneksi->connect_error);
} else {
    echo "";
}
?>