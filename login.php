<?php
session_start();
include("library/koneksi.php");
$username=$_POST['username'];
$password=$_POST['password'];
$login=$_POST['login'];

date_default_timezone_set("Asia/Jakarta");

if($login){
if($username=="" || $password == "" ){
	?> <script type="text/javascript"> alert ("Username / password tidak boleh kosong"); </script><?php
	}else{
		$sql = mysql_query("select anggota.KETERANGAN, anggota.ID_ANGGOTA from anggota where (anggota.USERNAME1='$username' and anggota.PASSWORD1 =  '$password') UNION select admin.LEVEL, admin.ID_ADMIN  from admin where (admin.USERNAME='$username' and admin.PASSWORD = '$password')") or die (mysql_error());
		$data = mysql_fetch_array($sql);
		$cek = mysql_num_rows($sql);
		if ($cek >= 1){
			$tanggalAbsen = date('d/m/Y');
			   $jamAbsen = date('H:i:s');
				if ($data['KETERANGAN'] == "Admin"|| $data['KETERANGAN'] == "Petugas") {
					$mySql  	= "INSERT INTO absensi (ID_ADMIN, TANGGAL_ABSENSI, JAM_ABSENSI, STATUS)
						VALUES ('$data[ID_ANGGOTA]', '$tanggalAbsen', '$jamAbsen','$data[KETERANGAN]')";
		$myQry=mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
				} else if ($data['KETERANGAN'] == "Mahasiswa"|| $data['KETERANGAN'] == "Dosen") {
					$mySql  	= "INSERT INTO absensi (ID_ANGGOTA, TANGGAL_ABSENSI, JAM_ABSENSI, STATUS)
						VALUES ('$data[ID_ANGGOTA]', '$tanggalAbsen','$jamAbsen' ,'$data[KETERANGAN]')";
		$myQry=mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
				}
				@$_SESSION ['User'] = $data ['ID_ANGGOTA'];
				header("location: index2.php");
				
			}else{
				echo"Login Gagal";
				}
		}	
	}
 
?> 

