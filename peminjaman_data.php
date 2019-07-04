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

<table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC"" >
  <tbody>
    <tr>
      <td><H2><U><font size="5">Data Peminjam Perpustakaan Prodi Pendidikan Informatika</U></H2></td>
    </tr>
    <tr>
    <?php
	$sql = mysql_query("select anggota.KETERANGAN, anggota.ID_ANGGOTA from anggota where (ID_ANGGOTA='$_SESSION[User]') UNION select admin.LEVEL, admin.ID_ADMIN  from admin where (ID_ADMIN='$_SESSION[User]')") or die (mysql_error());
		$data = mysql_fetch_array($sql);
		if ($data['KETERANGAN'] == "Admin"|| $data['KETERANGAN'] == "Petugas") {
			
		}
		else if ($data['KETERANGAN'] == "Mahasiswa"|| $data['KETERANGAN'] == "Dosen") {?>
        <tr><td><?php 
   echo "<a href=?open=Peminjaman-Add target=_self><H1>Pinjam Buku</H1></a>";?>
      </td>
      </tr>
      <tr>
      <td><?php 
   echo "<a href=?open=Peminjaman-Back target=_self><H1>Kembalikan Buku</H1></a>";?>
      </td>
    </tr>
		<?php } ?>
    <tr>
      <td>&nbsp;</td>
    </tr>
            </tbody>
      </table></td>
    </tr>
  </tbody>
</table>
