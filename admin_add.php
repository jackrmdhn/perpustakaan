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
		// Jika tidak menemukan error, simpan data ke database
		$kodeBaru	= buatKode("admin", "A");
		$mySql  	= "INSERT INTO admin (ID_ADMIN, NAMA_ADMIN, USERNAME, PASSWORD, LEVEL)
						VALUES ('$kodeBaru', '$txtNama', '$txtUsername', '$txtPassword', 'Petugas')";
		$myQry=mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?open=Admin-Data'>";
		}
		exit;
	
	}
}
#MEMBUAT VARIABEL KOTAK FORM
$dataKode		= buatKode("admin ", "A");
$dataNama		= isset($_POST['txtNama']) ? $_POST['txtNama'] : '';
$dataUsername	= isset($_POST['txtUsername']) ? $_POST['txtUsername'] : '';


?>
<form name="form1" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" target="_self">
<table width="100%" class = "table-list" border="0" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC"">
  <tbody>
    <tr>
      <td colspan="3"><h2><font size="6">Tambah Data Admin</h2></td>
    </tr>
        <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td width="111"><font size="4.5">ID </td>
      <td width="6">:</td>
      <td width="573"><input name="txtKode" type="text" id="txtKode" value="<?php echo $dataKode; ?>" size="10" maxlength="6" readonly></td>
    </tr>
    <tr>
      <td><font size="4.5">Nama Admin</td>
      <td>:</td>
      <td><input name="txtNama" type="text" value="<?php echo $dataNama; ?>" size="80" maxlength="100" /></td>
    </tr>
    <tr>
      <td><font size="4.5">Username Admin</td>
      <td>:</td>
      <td><input name="txtUsername" type="text"  value="<?php echo $dataUsername; ?>" size="30" maxlength="20" /></td>
    </tr>
        <tr>
      <td><font size="4.5">Password</td>
      <td>:</td>
      <td><input name="txtPassword" type="password"  size="30" maxlength="20" /></td>
    </tr>
    <tr>
      <td><a href="?open=Admin-Data"><font size="4.5">back</a></td>
      <td>&nbsp;</td>
      <td><input type="submit" name="btnSimpan" value=" Simpan " /></td>
    </tr>
  </tbody>
</table>
</form>
