<?php 
$con=mysqli_connect('localhost','dragonxp_etilang','Okitosenpai123.','dragonxp_etilang');
$link="foto_user/";
$lg="http://etilang.us.to/layanan/foto_user/";
$fp="http://etilang.us.to/layanan/foto_pengaduan/";
$gp="foto_pengaduan/";
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

?>