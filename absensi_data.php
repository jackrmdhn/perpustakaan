<?php
include_once "library/koneksi.php";
include_once "library/library.php";
?>

<script language="javascript">
function tanya1() {
if (confirm ("Memerlukan Hak Akses..!!")) {
return true;
} else {
return false;
}
}
function tanya2() {
if (confirm ("Anda Yakin Akan Menghapus Data Ini?")) {
return true;
} else {
return false;
}
}
</script>

<table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC">
  <tbody>
    <tr>
      <td><H2><U><font size="6">Data Pengunjung Perpustakaan Prodi Pendidikan Informatika</U></H2></td>
    </tr>
    <tr>
    </tr>
    <tr>
      <td><table class ="table-list" width="100%" border="2" cellspacing="1" cellpadding="1" bordercolor="#999999">
        <tbody>
        <tr>
          <td>
            <table class ="table-list" width="100%" border="2" cellspacing="1" cellpadding="1" bordercolor="#999999">
            <tbody>
              <tr bgcolor="#0275d8">
                <td width="5%"><font size="4.5">No </td>
                <td width="15%"><font size="4.5">ID Admin</td>
                <td width="20%"><font size="4.5">ID Anggota</td>
                <td width="30%"><font size="4.5">Nama</td>
                <td width="20%"><font size="4.5">Tanggal Absensi</td>
                <td width="10%"><font size="4.5">Status</td>
              </tr>
              <?php
	  // Skrip menampilkan data User ke layar
	$mySql 	= "(SELECT ID_ABSENSi, absensi.ID_ADMIN, absensi.ID_ANGGOTA, TANGGAL_ABSENSI, JAM_ABSENSI, NAMA_ANGGOTA, STATUS FROM absensi INNER JOIN anggota On absensi.ID_ANGGOTA=anggota.ID_ANGGOTA) UNION (SELECT ID_ABSENSi, absensi.ID_ADMIN, absensi.ID_ANGGOTA, TANGGAL_ABSENSI, JAM_ABSENSI, NAMA_ADMIN, LEVEL FROM absensi INNER JOIN admin On absensi.ID_ADMIN=admin.ID_ADMIN) ORDER BY ID_ABSENSI ASC";
	$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query  salah : ".mysql_error());
	$nomor  = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
	?>
              <tr>
                <td><font size="3"><?php echo $nomor; ?></td>
                <td><font size="3"><?php if ($myData['ID_ADMIN'] != "") echo $myData['ID_ADMIN']; else echo "-"; ?></td>
                <td><font size="3"><?php if ($myData['ID_ANGGOTA'] != "") echo $myData['ID_ANGGOTA']; else echo "-"; ?></td>
                <td><font size="3"><?php echo $myData['NAMA_ANGGOTA']; ?></td>
                <td><font size="3"><?php echo $myData['JAM_ABSENSI']." ".$myData['TANGGAL_ABSENSI']; ?></td>
                <td><font size="3"><?php echo $myData['STATUS']; ?></td>
             </tr>
            </tbody>
            <?php } ?>
          </table>
  </tbody>
</table>
