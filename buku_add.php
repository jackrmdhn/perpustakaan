<?php
include_once "library/koneksi.php";
include_once "library/library.php";

# Tombol Simpan diklik
if(isset($_POST['btnSimpan'])){	
# BACA DATA DALAM FORM, masukkan datake variabel
	$txtKategoriBuku	= $_POST['txtKategoriBuku'];
	$txtJudulBuku	= $_POST['txtJudul'];
	$txtNamaPengarang = $_POST['txtPengarang'];
	$txtNamaPenerbit= $_POST['txtPenerbit'];
	$txtTahunTerbit	= $_POST['txtTahunTerbit'];
	
	# VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
	$pesanError = array();
	if (trim($txtKategoriBuku)=="") {
		$pesanError[] = "Data <b>Kategori Buku</b> tidak boleh kosong, silahkan diperbaiki !";		
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
		// Jika tidak menemukan error, simpan data ke database
		$kodeBaru	= $_POST['txtKode'];
		$mySql  	= "INSERT INTO buku (ID_BUKU, KATEGORI_BUKU, JUDUL, PENGARANG, PENERBIT, TAHUN_TERBIT)
						VALUES ('$kodeBaru', '$txtKategoriBuku', '$txtJudulBuku', '$txtNamaPengarang', '$txtNamaPenerbit', '$txtTahunTerbit')";
		$myQry=mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?open=Buku-Data'>";
		}
		exit;
		}}
#MEMBUAT VARIABEL KOTAK FORM
$dataKode		= isset($_POST['txtKode']) ? $_POST['txtKode'] : '';
$dataKategori	= isset($_POST['txtKategori']) ? $_POST['txtKategori'] : '';
$dataJudul		= isset($_POST['txtJudul']) ? $_POST['txtJudul'] : '';
$dataPengarang	= isset($_POST['txtPengarang']) ? $_POST['txtPengarang'] : '';
$dataPenerbit	= isset($_POST['txtPenerbit']) ? $_POST['txtPenerbit'] : '';
$dataTahunTerbit= isset($_POST['txtTahunTerbit']) ? $_POST['txtTahunTerbit'] : '';

?>
<form name="form1" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" target="_self">
<table width="100%" class = "table-list" border="0" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC"">
  <tbody>
    <tr>
      <td colspan="3"><h2><font size="6">Tambah Data Buku</h2></td>
    </tr>
        <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td width="111"><font size="4.5">ID Buku</td>
      <td width="6">:</td>
      <td width="573"><input name="txtKode" type="text" id="txtKode" value="<?php echo $dataKode; ?>" size="10"></td>
    </tr>
     <tr>
      <td><font size="4.5">Kategori</td>
      <td>:</td>
      <td><input name="txtKategoriBuku" type="text" value="<?php echo $dataJudul; ?>" size="80" maxlength="100" /></td>
    </tr>
    <tr>
      <td><font size="4.5">Judul Buku</td>
      <td>:</td>
      <td><input name="txtJudul" type="text" value="<?php echo $dataJudul; ?>" size="80" maxlength="100" /></td>
    </tr>
    <tr>
      <td><font size="4.5">Nama Pengarang</td>
      <td>:</td>
      <td><input name="txtPengarang" type="text"  value="<?php echo $dataPengarang; ?>" size="30" maxlength="20" /></td>
    </tr>
   <tr>
      <td><font size="4.5">Nama Penerbit</td>
      <td>:</td>
      <td><input name="txtPenerbit" type="text"  value="<?php echo $dataPenerbit; ?>" size="30" maxlength="20" /></td>
    </tr>
     <tr>
      <td><font size="4.5">Tahun Terbit</td>
      <td>:</td>
      <td><input name="txtTahunTerbit" type="text" value="<?php echo $dataJudul; ?>" size="80" maxlength="100" /></td>
    </tr>
    <tr>
      <td><a href="?open=Buku-Data"><font size="4.5">Back</a></td>
      <td>&nbsp;</td>
      <td><input type="submit" name="btnSimpan" value=" Simpan " /></td>
    </tr>
  </tbody>
</table>
</form>
