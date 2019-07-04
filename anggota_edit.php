<?php
include_once "library/koneksi.php";
include_once "library/library.php";

# Tombol Simpan diklik
if(isset($_POST['btnSimpan'])){	
# BACA DATA DALAM FORM, masukkan datake variabel
	$txtNama	= $_POST['txtNama'];
	$txtUsername= $_POST['txtUsername'];
	$txtPassword= $_POST['txtPassword'];
	$txtJeniskelamin= $_POST['txtJeniskelamin'];
	$txtAlamat= $_POST['txtAlamat'];
	$txtTanggalLahir= $_POST['txtTanggalLahir'];
	$txtAgama= $_POST['txtAgama'];
	$txtTahunAngkatan= $_POST['txtTahunAngkatan'];
	$txtNomorTelepon= $_POST['txtNomorTelepon'];
	$txtKeterangan= $_POST['txtKeterangan'];
	
	# VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
	$pesanError = array();
	if (trim($txtNama)=="") {
		$pesanError[] = "Data <b>Nama Anggota</b> tidak boleh kosong, silahkan diperbaiki !";		
	}
	if (trim($txtUsername)=="") {
		$pesanError[] = "Data <b>Username Anggota</b> tidak boleh kosong, silahkan diperbaiki !";		
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
			$passwSQL = ", PASSWORD1='$txtPassLama'";
		}
		else {
			$passwSQL = ",  PASSWORD1 ='$txtPassword'";
		}
		// Membaca Kode dari Form Hidden
		$Kode	= $_POST['txtKode'];
		 
		# SIMPAN DATA KE DATABASE (Jika tidak menemukan error, simpan data ke database)
		$mySql  = "UPDATE anggota SET NAMA_ANGGOTA='$txtNama', USERNAME1='$txtUsername', JENIS_KELAMIN ='$txtJeniskelamin', ALAMAT ='$txtAlamat', TANGGAL_LAHIR ='$txtTanggalLahir', AGAMA ='$txtAgama', TAHUN_ANGKATAN ='$txtTahunAngkatan', NOMOR_TELEPON ='$txtNomorTelepon', KETERANGAN ='$txtKeterangan'
					$passwSQL
					WHERE ID_ANGGOTA='$Kode'";
		$myQry=mysql_query($mySql, $koneksidb) or die ("Gagal query coy $mySql ".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?open=Anggota-Data'>";
		}
		exit;	
	}
}//penutup tombol simpan

# TAMPILKAN DATA DARI DATABASE, Untuk ditampilkan kembali ke form edit
$Kode	= $_GET['Kode']; 
$mySql	= "SELECT * FROM anggota WHERE ID_ANGGOTA='$Kode'";
$myQry	= mysql_query($mySql, $koneksidb)  or die ("Query ambil data salah : ".mysql_error());
$myData = mysql_fetch_array($myQry);

	// Data Variabel Temporary (sementara)
	$dataKode		= $myData['ID_ANGGOTA'];
	$dataNama		= isset($_POST['txtNama']) ? $_POST['txtNama'] : $myData['NAMA_ANGGOTA'];
	$dataUsername	= isset($_POST['txtUsername']) ? $_POST['txtUsername'] : $myData['USERNAME1'];
	$dataJeniskelamin	= isset($_POST['txtJeniskelamin']) ? $_POST['txtJeniskelamin'] : $myData['JENIS_KELAMIN'];
	$dataAlamat	= isset($_POST['txtAlamat']) ? $_POST['txtAlamat'] : $myData['ALAMAT'];
	$dataTanggalLahir	= isset($_POST['txtTanggalLahir']) ? $_POST['txtTanggalLahir'] : $myData['TANGGAL_LAHIR'];
	$dataAgama	= isset($_POST['txtAgama']) ? $_POST['txtAgama'] : $myData['AGAMA'];
	$dataTahunAngkatan	= isset($_POST['txtTahunAngkatan']) ? $_POST['txtTahunAngkatan'] : $myData['TAHUN_ANGKATAN'];
	$dataNomorTelepon	= isset($_POST['txtNomorTelepon']) ? $_POST['txtNomorTelepon'] : $myData['NOMOR_TELEPON'];
	$dataKeterangan	= isset($_POST['txtKeterangan']) ? $_POST['txtKeterangan'] : $myData['KETERANGAN'];
	
?>
<form name="form1" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" target="_self">
<table width="100%" class = "table-list" border="0" cellspacing="1" cellpadding="1"  bgcolor="#CCCCCC"">
  <tbody>
    <tr>
      <td colspan="3"><h2><font size="6">Edit Data Anggota</h2></td>
    </tr>
        <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td width="114"><font size="4.5">ID</td>
      <td width="3">:</td>
      <td width="573"><input name="textfield" type="text" id="textfield" value="<?php echo $dataKode; ?>" size="10" maxlength="6" readonly>
      <input name="txtKode" type="hidden" value="<?php echo $dataKode; ?>" /></td>
    </tr>
    <tr>
      <td><font size="4.5">Nama Anggota</td>
      <td>:</td>
      <td><input name="txtNama" type="text" value="<?php echo $dataNama; ?>" size="80" maxlength="100" /></td>
    </tr>
    <tr>
      <td><font size="4.5">Username Anggota</td>
      <td>:</td>
      <td><input name="txtUsername" type="text"  value="<?php echo $dataUsername; ?>" size="30" maxlength="20" /></td>
    </tr>
    <tr>
      <td><font size="4.5">Password</td>
      <td>:</td>
      <td><input name="txtPassword" type="password"  size="30" maxlength="20" />
      <input name="txtPassLama" type="hidden" value="<?php echo $myData['PASSWORD']; ?>" /></td>
    </tr>
    <tr>
      <td><font size="4.5">Jenis Kelamin</td>
      <td>:</td>
      <td><input name="txtJeniskelamin" type="text"  value="<?php echo $dataJeniskelamin; ?>" size="30" maxlength="20" /></td>
    </tr>
    <tr>
      <td><font size="4.5">Alamat</td>
      <td>:</td>
      <td><input name="txtAlamat" type="text"  value="<?php echo $dataAlamat; ?>" size="30" maxlength="20" /></td>
    </tr>
    <tr>
      <td><font size="4.5">Tanggal Lahir</td>
      <td>:</td>
      <td><input name="txtTanggalLahir" type="text"  value="<?php echo $dataTanggalLahir; ?>" size="30" maxlength="20" /></td>
    </tr>
     <tr>
      <td><font size="4.5">Agama</td>
      <td>:</td>
      <td><input name="txtAgama" type="text"  value="<?php echo $dataAgama; ?>" size="30" maxlength="20" /></td>
    </tr>
    <tr>
      <td><font size="4.5">Tahun Angkatan</td>
      <td>:</td>
      <td><input name="txtTahunAngkatan" type="text"  value="<?php echo $dataTahunAngkatan; ?>" size="30" maxlength="20" /></td>
    </tr>
     <tr>
      <td><font size="4.5">Nomor Telepon</td>
      <td>:</td>
      <td><input name="txtNomorTelepon" type="text"  value="<?php echo $dataNomorTelepon; ?>" size="30" maxlength="20" /></td>
    </tr>
    <tr>
      <td><font size="4.5">Keterangan</td>
      <td>:</td>
      <td><input name="txtKeterangan" type="text"  value="<?php echo $dataKeterangan; ?>" size="30" maxlength="20" /></td>
    </tr>
    <tr>
      <td><a href="?open=Anggota-Data"><font size="4.5">back</a></td>
      <td>&nbsp;</td>
      <td><input type="submit" name="btnSimpan" value=" Simpan " /></td>
    </tr>
  </tbody>
</table>
</form>
