<?php
$id = $_GET['id'];
$waktu = date("d/m/Y H:i:s");
$mySql  	= "UPDATE peminjaman SET TANGGAL_KEMBALI='$waktu'
					WHERE ID_BUKU='$id'";
		$myQry=mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?open=Laporan-Data'>";
			echo "Peminjaman ".$txtJudul." sukses";
		}
		exit;
?>