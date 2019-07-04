<?php
include_once "library/koneksi.php";
include_once "library/library.php";

# Tombol Simpan diklik
if(isset($_POST['btnSimpan'])){	
# BACA DATA DALAM FORM, masukkan datake variabel
	$txtKategoriBuku= $_POST['txtKategoriBuku'];
	$txtJudulBuku	= $_POST['txtJudul'];
	$txtNamaPengarang = $_POST['txtNamaPengarang'];
	$txtNamaPenerbit= $_POST['txtNamaPenerbit'];
	$txtTahunTerbit	= $_POST['txtTahunTerbit'];
	
	# VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
	$pesanError = array();
	if (trim($txtKategoriBuku)=="") {
		$pesanError[] = "Data <b>kategori Buku</b> tidak boleh kosong, silahkan diperbaiki !";		
	}
	if (trim($txtJudulBuku)=="") {
		$pesanError[] = "Data <b>Judul Buku</b> tidak boleh kosong, silahkan diperbaiki !";		
	}
	if (trim($txtNamaPengarang)=="") {
		$pesanError[] = "Data <b>NamaPengarang</b> tidak boleh kosong, silahkan diperbaiki !";		
	}
	if (trim($txtNamaPenerbit)=="") {
		$pesanError[] = "Data <b>NamaPenerbit</b> tidak boleh kosong, silahkan diperbaiki !";		
	}
	if (trim($txtTahunTerbit)=="") {
		$pesanError[] = "Data <b>Tahun Terbit</b> tidak boleh kosong, silahkan diperbaiki !";		
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
		// Membaca Kode dari Form Hidden
		$Kode	= $_POST['txtKode'];
		 
		# SIMPAN DATA KE DATABASE (Jika tidak menemukan error, simpan data ke database)
		$mySql  = "UPDATE buku SET KATEGORI_BUKU='$txtKategoriBuku',JUDUL='$txtJudulBuku', PENGARANG='$txtNamaPengarang', PENERBIT='$txtNamaPenerbit',TAHUN_TERBIT='$txtTahunTerbit' 
					WHERE ID_BUKU='$Kode'";
		$myQry=mysql_query($mySql, $koneksidb) or die ("Gagal query coy $mySql ".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?open=Buku-Data'>";
		}
		exit;	
	}
}//penutup tombol simpan

# TAMPILKAN DATA DARI DATABASE, Untuk ditampilkan kembali ke form edit
$Kode	= $_GET['Kode']; 
$mySql	= "SELECT * FROM buku WHERE ID_BUKU='$Kode'";
$myQry	= mysql_query($mySql, $koneksidb)  or die ("Query ambil data salah : ".mysql_error());
$myData = mysql_fetch_array($myQry);

	// Data Variabel Temporary (sementara)
	$dataKode		= $myData['ID_BUKU'];
	$dataKategoriBuku		= isset($_POST['txtKategoriBuku']) ? $_POST['txtKategoriBuku'] : $myData['KATEGORI_BUKU'];
	$dataJudul		= isset($_POST['txtJudulBuku']) ? $_POST['txtNama'] : $myData['JUDUL'];
	$dataNamaPengarang	= isset($_POST['txtPengarang']) ? $_POST['txtPengarang'] : $myData['PENGARANG'];
	$dataNamaPenerbit	= isset($_POST['txtPenerbit']) ? $_POST['txtPengarang'] : $myData['PENERBIT'];
	$dataTahunTerbit		= isset($_POST['txtTahunTerbit']) ? $_POST['txtTahunTerbit'] : $myData['TAHUN_TERBIT'];
?>
<form name="form1" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" target="_self">
<table width="100%" class = "table-list" border="0" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC"">
  <tbody>
    <tr>
      <td colspan="3"><h2><font size="6">Edit Data Buku</h2></td>
    </tr>
        <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td width="111"><font size="4.5">ID Buku</td>
      <td width="6">:</td>
      <td width="585"><input name="textfield" type="text" id="textfield" value="<?php echo $dataKode; ?>" >
      <input name="txtKode" type="hidden" value="<?php echo $dataKode; ?>" /></td>
    </tr>
     <tr>
      <td><font size="4.5">Kategori Buku</td>
      <td>:</td>
      <td><input name="txtKategoriBuku" type="text" value="<?php echo $dataKategoriBuku; ?>" size="80" maxlength="100" /></td>
    </tr>
    <tr>
      <td><font size="4.5">Judul Buku</td>
      <td>:</td>
      <td><input name="txtJudul" type="text" value="<?php echo $dataJudul; ?>" size="80" maxlength="100" /></td>
    </tr>
    <tr>
      <td><p><font size="4.5">Nama Pengarang</p></td>
      <td>:</td>
      <td><input name="txtNamaPengarang" type="text"  value="<?php echo $dataNamaPengarang; ?>" size="30" maxlength="20" /></td>
    </tr>
     <tr>
      <td><p><font size="4.5">Nama Penerbit</p></td>
      <td>:</td>
      <td><input name="txtNamaPenerbit" type="text"  value="<?php echo $dataNamaPenerbit; ?>" size="30" maxlength="20" /></td>
    </tr>
     <tr>
      <td><font size="4.5">Tahun Terbit</td>
      <td>:</td>
      <td><input name="txtTahunTerbit" type="text" value="<?php echo $dataTahunTerbit; ?>" size="30" maxlength="20" /></td>
    </tr>
    <tr>
      <td><a href="?open=Buku-Data"><font size="4.5">back</a></td>
      <td>&nbsp;</td>
      <td><input type="submit" name="btnSimpan" value=" Simpan " /></td>
    </tr>
  </tbody>
</table>
</form>
