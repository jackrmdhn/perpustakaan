<?php
#koneksi ke web serser lokal
$host	= "localhost";
$user	= "root";
$pass	= "";
$db		= "sippif"; // nama database

# koneksi ke web server lokal
$koneksidb = mysql_connect ($host, $user, $pass);
if (! $koneksidb) {
	echo "Koneksi MySQL gagal, periksa Host/ User/ Passwordnya!";
	}
	
# memilih database pada MySQL Server
mysql_select_db($db) or die ("Databse <b>$db</b> tidak ditemukan!");

$denda1=500;
?>