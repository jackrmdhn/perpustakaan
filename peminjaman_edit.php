<?php
include_once "library/koneksi.php";
include_once "library/library.php";

# Tombol Simpan diklik
if(isset($_POST['btnSimpan'])){	
# BACA DATA DALAM FORM, masukkan datake variabel
	$txtNama	= $_POST['txtNama'];
	$txtUsername= $_POST['txtUsername'];
	$txtPassword= $_POST['txtPassword'];
	
	# VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
	$pesanError = array();
	if (trim($txtNama)=="") {
		$pesanError[] = "Data <b>Nama Admin</b> tidak boleh kosong, silahkan diperbaiki !";		
	}
	if (trim($txtUsername)=="") {
		$pesanError[] = "Data <b>Username</b> tidak boleh kosong, silahkan diperbaiki !";		
	}
	if (trim($txtPassword)=="") {
		$pesanError[] = "Data <b>Password</b> tidak boleh kosong, silahkan diperbaiki !";		
	}
	
	# JIKA ADA PESAN ERROR DARI VALIDASI
	if (count($pesanError)>=1 ){
		echo "<div class='mssgBox'>";
		echo "<img src='images/attention.png'> <br><hr>";
			$noPesan=0;
			foreach ($pesanError as $indeks=>$pesan_tampil) { 
			$noPesan++;
				echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
			} 
		echo "</div> <br>"; 
	}
	else {
		# SIMPAN DATA KE DATABASE. 
		# Cek Password baru
		if (trim($txtPassword)=="") {
			$txtPassLama= $_POST['txtPassLama'];
			$passwSQL = ", PASSWORD='$txtPassLama'";
		}
		else {
			$passwSQL = ",  PASSWORD ='$txtPassword'";
		}
		// Membaca Kode dari Form Hidden
		$Kode	= $_POST['txtKode'];
		 
		# SIMPAN DATA KE DATABASE (Jika tidak menemukan error, simpan data ke database)
		$mySql  = "UPDATE admin SET NAMA_ADMIN='$txtNama', USERNAME='$txtUsername'
					$passwSQL
					WHERE ID_ADMIN='$Kode'";
		$myQry=mysql_query($mySql, $koneksidb) or die ("Gagal query coy $mySql ".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?open=Admin-Data'>";
		}
		exit;	
	}
}//penutup tombol simpan

# TAMPILKAN DATA DARI DATABASE, Untuk ditampilkan kembali ke form edit
$Kode	= $_GET['Kode']; 
$mySql	= "SELECT * FROM admin WHERE ID_ADMIN='$Kode'";
$myQry	= mysql_query($mySql, $koneksidb)  or die ("Query ambil data salah : ".mysql_error());
$myData = mysql_fetch_array($myQry);

	// Data Variabel Temporary (sementara)
	$dataKode		= $myData['ID_ADMIN'];
	$dataNama		= isset($_POST['txtNama']) ? $_POST['txtNama'] : $myData['NAMA_ADMIN'];
	$dataUsername	= isset($_POST['txtUsername']) ? $_POST['txtUsername'] : $myData['USERNAME'];
?>
<form name="form1" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" target="_self">
<table width="700" class = "table-list" border="0" cellspacing="1" cellpadding="1">
  <tbody>
    <tr>
      <td colspan="3"><h2>Edit Data Admin</h2></td>
    </tr>
        <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td width="111">ID</td>
      <td width="6">:</td>
      <td width="573"><input name="textfield" type="text" id="textfield" value="<?php echo $dataKode; ?>" size="10" maxlength="6" readonly>
      <input name="txtKode" type="hidden" value="<?php echo $dataKode; ?>" /></td>
    </tr>
    <tr>
      <td>Nama Admin</td>
      <td>:</td>
      <td><input name="txtNama" type="text" value="<?php echo $dataNama; ?>" size="80" maxlength="100" /></td>
    </tr>
    <tr>
      <td>Username Admin</td>
      <td>:</td>
      <td><input name="txtUsername" type="text"  value="<?php echo $dataUsername; ?>" size="30" maxlength="20" /></td>
    </tr>
    <tr>
      <td>Password</td>
      <td>:</td>
      <td><input name="txtPassword" type="password"  size="30" maxlength="20" />
      <input name="txtPassLama" type="hidden" value="<?php echo $myData['PASSWORD']; ?>" /></td>
    </tr>
    <tr>
      <td><a href="?open=Admin-Data"><img src="images/kembalilah.png" width="100" height="30" alt=""/></a></td>
      <td>&nbsp;</td>
      <td><input type="submit" name="btnSimpan" value=" Simpan " /></td>
    </tr>
  </tbody>
</table>
</form>
