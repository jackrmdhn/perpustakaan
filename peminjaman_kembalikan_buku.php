<?php
include_once "library/koneksi.php";
include_once "library/library.php";

	$txtJudul	= "";
	$txtPengarang= "";
	$txtPenerbit= "";
	$kode = "";
# Tombol Simpan diklik
if(isset($_POST['btnSimpan'])){
# BACA DATA DALAM FORM, masukkan datake variabel
	$txtJudul	= $_POST['txtJudul'];
	$txtPengarang= $_POST['txtPengarang'];
	$txtPenerbit= $_POST['txtPenerbit'];
	$kode = $_POST['txtKode'];

	$mySql	= "SELECT * FROM buku WHERE ID_BUKU='$kode'";
	$myQry	= mysql_query($mySql, $koneksidb)  or die ("Query ambil data salah : ".mysql_error());
	$myData = mysql_fetch_array($myQry);

	// Data Variabel Temporary (sementara)

	$kode = $myData['ID_BUKU'];
	$txtJudul = $myData['JUDUL'];
	$txtPengarang = $myData['PENGARANG'];
	$txtPenerbit = $myData['PENERBIT'];

	# VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
	$pesanError = array();
	if (trim($txtJudul)=="") {
		$pesanError[] = "Data <b>Nama </b> tidak boleh kosong, silahkan diperbaiki !";		
	}
	if (trim($txtPengarang)=="") {
		$pesanError[] = "Data <b>Username</b> tidak boleh kosong, silahkan diperbaiki !";		
	}
	if (trim($txtPenerbit)=="") {
		$pesanError[] = "Data <b>Password</b> tidak boleh kosong, silahkan diperbaiki !";		
	}
	
	$mySql2	= "SELECT * FROM peminjaman WHERE ID_BUKU='$kode' AND TANGGAL_KEMBALI IS NULL";
	$myQry2	= mysql_query($mySql2, $koneksidb)  or die ("Query ambil data salah : ".mysql_error());
	$myData2 = mysql_fetch_array($myQry2);
	
	$date1 = date_create(date("Y-m-d", strtotime(strtr($myData2['TANGGAL_PINJAM'].'7day',"/","-"))));
	$date2 = date_create(date("Y-m-d"));
	
	if (date_diff($date1, $date2)->format("%a") > 7) {
		$pesanError[] = "Terlambat";
	}
	
	# JIKA ADA PESAN ERROR DARI VALIDASI
	if (count($pesanError)>=1 ){
		echo "<div class='mssgBox'>";
		
			$noPesan=0;
			foreach ($pesanError as $indeks=>$pesan_tampil) { 
			$noPesan++;
				echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
			} 
		echo "</div> <br>"; 
	}
	else {
		$tanggalAbsen = date('d/m/Y');
		$jamAbsen = date('H:i:s');

		$waktuPinjam = $tanggalAbsen." ".$jamAbsen;
		# SIMPAN DATA KE DATABASE. 
		// Jika tidak menemukan error, simpan data ke database
		$mySql  	= "UPDATE peminjaman SET TANGGAL_KEMBALI='$waktuPinjam'
					WHERE ID_BUKU='$kode' AND ID_ANGGOTA='$_SESSION[User]'";
		$myQry=mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?open=Peminjaman-Back'>";
			echo "Peminjaman ".$txtJudul." sukses";
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
      <td colspan="3"><h2><font size="6">Kembalikan Buku</h2></td>
    </tr>
        <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td width="111"><font size="4.5">ID Buku</td>
      <td width="6">:</td>
      <td width="573"><input name="txtKode" type="text" id="txtKode" size="10" value="<?php echo $kode; ?>"  autofocus /></td>
    </tr>
    <tr>
      <td><font size="4.5">Judul</td>
      <td>:</td>
      <td><input name="txtJudul" type="text" value="<?php echo $txtJudul; ?>" size="80" maxlength="100" /></td>
    </tr>
    <tr>
      <td><font size="4.5">Pengarang</td>
      <td>:</td>
      <td><input name="txtPengarang" type="text" value="<?php echo $txtPengarang; ?>" size="30" maxlength="20" /></td>
    </tr>
    <tr>
      <td><font size="4.5">Penerbit</td>
      <td>:</td>
      <td><input name="txtPenerbit" type="text"  value="<?php echo $txtPenerbit; ?>" size="30" maxlength="20" /></td>
    </tr>
    <tr>
     <td><a href="?open=Peminjaman-Data"><font size="4.5">back</a></td>
      <td>&nbsp;</td>
      <td><input type="submit" name="btnSimpan" value=" Kembali " /></td>
    </tr>
  </tbody>
</table>
</form>
