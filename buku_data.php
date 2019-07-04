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
      <td><H2><U><font size="6">Data Buku Perpustakaan Prodi Pendidikan Informatika</U></H2></td>
    </tr>
    <tr>
      <td width="100%"><input type="text" id="cari"/>
      <a href="#" onclick="cariFunction()" id="tombolCari" target=""> CARI </a>  </td>
      <script>
	  var input = document.getElementById('cari');
	  var link = document.getElementById('tombolCari');
	  function cariFunction () {window.location.href ="?open=Buku-Data&cari=" + input.value;}
	  </script>
    </tr>
    <tr>
      <td><?php if ($data_user['KETERANGAN'] == "Admin"|| $data_user['KETERANGAN'] == "Petugas" || $data_user['KETERANGAN'] == "")
  echo "<a href=?open=Buku-Add target=_self><H1>Tambah</H1></a>";?>
      </td>
    </tr> 
    <tr>
      <td><table class ="table-list" width="100%" border="2" cellspacing="1" cellpadding="1" bordercolor="#999999">
        <tbody>
        <tr>
          <td><table class ="table-list" width="100%" border="2" cellspacing="1" cellpadding="1" bordercolor="#999999">
            <tbody>
              <tr bgcolor="#0275d8">
                <td width="3%"><font size="4.5"><center>No </td>
                <td width="10%"><font size="4.5"><center>ID Buku</td>
                 <td width="10%"><font size="4.5"><center>Kategori Buku</td>
                <td width="35%"><font size="4.5"><center>Judul Buku</td>
                <td width="10%"><font size="4.5"><center>Nama Pengarang</td>
                <td width="15%"><font size="4.5"><center>Nama Penerbit</td>
                 <td width="7%"><font size="4.5"><center>Tahun Terbit</td>
                 <td width="15%"><font size="4.5"><center>Keterangan</td>
                <?php if ($data_user['KETERANGAN'] == "Admin"|| $data_user['KETERANGAN'] == "Petugas" || $data_user['KETERANGAN'] == "") echo 
                "<td width='80%' align='center'>Edit/Delete</td>";
				?>
              </tr>
              <?php
	  // Skrip menampilkan data User ke layar
	  $mySql = "SELECT * FROM buku ORDER BY ID_BUKU ASC";
		if (isset($_GET['cari'])) {
			$mySql 	= "SELECT * FROM buku WHERE JUDUL like '%$_GET[cari]%' or KATEGORI_BUKU like '%$_GET[cari]%' ORDER BY ID_BUKU ASC";
		}
		else {
		$mySql 	= "SELECT * FROM buku ORDER BY ID_BUKU ASC";
		}
	$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query  salah : ".mysql_error());
	$nomor  = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['ID_BUKU'];
	?>
              <tr>
                <td><font size="3"><?php echo $nomor; ?></td>
                <td><font size="3"><?php echo $myData['ID_BUKU']; ?></td>
                <td><font size="3"><?php echo $myData['KATEGORI_BUKU']; ?></td>
                <td><font size="3"><?php echo $myData['JUDUL']; ?></td>
                <td><font size="3"><?php echo $myData['PENGARANG']; ?></td>
                <td><font size="3"><?php echo $myData['PENERBIT']; ?></td>
                <td><font size="3"><?php echo $myData['TAHUN_TERBIT']; ?></td>
                <?php $mySqlQ = mysql_query("SELECT * FROM peminjaman WHERE (ID_BUKU='$myData[ID_BUKU]' AND TANGGAL_PINJAM IS NOT NULL AND TANGGAL_KEMBALI IS NULL)") or die (mysql_error());
	$cek = mysql_num_rows($mySqlQ);
		if ($cek > 0){
			echo "<td>Tidak tersedia</td>";
		}
		else {
			echo "<td>Tersedia</td>";
		}?>
                <?php if ($data_user['KETERANGAN'] == "Admin"|| $data_user['KETERANGAN'] == "Petugas" || $data_user['KETERANGAN'] == "")
        echo "<td align='center'>
  <a href=?open=Buku-Edit&Kode=$myData[ID_BUKU]> edit</a> 

  <a href=?open=Buku-Delete&Kode=$myData[ID_BUKU] onClick='return tanya2()'>delete</a>";
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
