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
      <td><H2><U><font size="6">Data Admin Perpustakaan Prodi Pendidikan Informatika</U></H2></td>
    </tr>
    <tr>
      <td><?php 
  echo "<a href=?open=Admin-Add target=_self><H1>Tambah<H1></a>";
 ?>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><table class ="table-list" width="100%" border="2" cellspacing="1" cellpadding="1" bordercolor="#0275d8">
        <tbody>
        <tr>
          <td><table class ="table-list" width="100%" border="2" cellspacing="1" cellpadding="1" bordercolor="#0275d8">
            <tbody>
              <tr bgcolor="#0275d8">
                <td width="5%"><font size="4.5">No </td>
                <td width="10%"><font size="4.5">ID Admin</td>
                <td width="25%"><font size="4.5">Nama Admin</td>
                <td width="20%"><font size="4.5">Username Admin</td>
                <td width="20%"><font size="4.5">Level</td>
                <td width="20%" align="center"><font size="4.5">Setting</td>
              </tr>
              <?php
	  // Skrip menampilkan data User ke layar
	$mySql 	= "SELECT * FROM admin ORDER BY ID_ADMIN ASC";
	$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query  salah : ".mysql_error());
	$nomor  = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['ID_ADMIN'];
	?>
              <tr>
                <td><font size="3"><?php echo $nomor; ?></td>
                <td><font size="3"><?php echo $myData['ID_ADMIN']; ?></td>
                <td><font size="3"><?php echo $myData['NAMA_ADMIN']; ?></td>
                <td><font size="3"><?php echo $myData['USERNAME']; ?></td>
                <td><font size="3"><?php echo $myData['LEVEL']; ?></td>
                <td align="center"><font size="3"><?php 
  echo " <a href=?open=Admin-Edit&Kode=$myData[ID_ADMIN]>Edit /</a> 
  <a href=?open=Admin-Delete&Kode=$myData[ID_ADMIN] onClick='return tanya2()'>Delete</a>";
?>
             </tr>
            </tbody>
            <?php } ?>
          </table></td>
        </tr>
        </tbody>
      </table></td>
    </tr>
  </tbody>
</table>
