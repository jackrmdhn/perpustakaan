<?php
include_once "library/koneksi.php";

// Jika ditemukan data Kode dari URL browser
if(isset($_GET['Kode'])){
	// Hapus data sesuai Kode yang didapat di URL
	$Kode	= $_GET['Kode'];
	$mySql = "DELETE FROM anggota WHERE ID_ANGGOTA='$Kode'";
	$myQry = mysql_query($mySql, $koneksidb) or die ("Eror hapus data".mysql_error());
	if($myQry){
		// Refresh halaman
		echo "<meta http-equiv='refresh' content='0; url=?open=Anggota-Data'>";
	}
}
else {
	// Jika tidak ada data Kode ditemukan di URL
	echo "<b>Data yang dihapus tidak ada</b>";
}
?>