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
      <td><H2><U><font size="6">Data Anggota Perpustakaan Prodi Pendidikan Informatika</font></U></H2></td>
    </tr>
    <tr>
      <td><?php 
   echo "<a href=?open=Anggota-Add target=_self><H1>TAMBAH</H1></a>";?>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="100%"><input type="text" id="cari"/><a href="#" onclick="cariFunction()" id="tombolCari" target="">CARI</a>  </td>
      <script>
	  var input = document.getElementById('cari');
	  var link = document.getElementById('tombolCari');
	  function cariFunction () {window.location.href ="?open=Anggota-Data&cari=" + input.value;}
	  </script>
    </tr>
    <tr>
      <td><table class ="table-list" width="100%" border="2" cellspacing="1" cellpadding="1" bordercolor="#999999">
        <tbody>
        <tr>
          <td><table class ="table-list" width="100%" border="2" cellspacing="1" cellpadding="1" bordercolor="#999999">
            <tbody>
              <tr bgcolor="#0275d8">
                <td width="3%"><font size="4.5">No</td>
                <td width="10%"><font size="4.5">ID</td>
                <td width="20%"><font size="4.5">Nama Anggota</td>
                <td width="10%"><font size="4.5">Username Anggota</td>
                <td width="5%"><font size="4.5">Jenis Kelamin</td>
                <td width="10%"><font size="4.5">Alamat</td>
                <td width="10%"><font size="4.5">Tanggal Lahir</td>
                 <td width="5%"><font size="4.5">Agama</td>
                <td width="7%"><font size="4.5">Tahun Angkatan</td>
                <td width="10%"><font size="4.5">Nomor Telepon</td>
                <td width="5%"><font size="4.5">Keterangan</td>
                <td width="5%" align="center"><font size="4.5">Setting</td>
              </tr>
              <?php
	  // Skrip menampilkan data User ke layar
	$mySql 	= "SELECT * FROM anggota ORDER BY ID_ANGGOTA ASC";
	if (isset($_GET['cari'])) {
		$mySql 	= "SELECT * FROM anggota WHERE NAMA_ANGGOTA like '%$_GET[cari]%' ORDER BY ID_ANGGOTA ASC";
	}
	else {
		$mySql = "SELECT * FROM anggota ORDER BY ID_ANGGOTA ASC";
	}
	$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query  salah : ".mysql_error());
	$nomor  = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['ID_ANGGOTA'];?>
              <tr>
                <td><font size="3"><?php echo $nomor; ?></td>
                <td><font size="3"><?php echo $myData['ID_ANGGOTA']; ?></td>
                <td><font size="3"><?php echo $myData['NAMA_ANGGOTA']; ?></td>
                <td><font size="3"><?php echo $myData['USERNAME1']; ?></td>
                <td><font size="3"><?php echo $myData['JENIS_KELAMIN']; ?></td>
                <td><font size="3"><?php echo $myData['ALAMAT']; ?></td>
                <td><font size="3"><?php echo $myData['TANGGAL_LAHIR']; ?></td>
                <td><font size="3"><?php echo $myData['AGAMA']; ?></td>
                <td><font size="3"><?php echo $myData['TAHUN_ANGKATAN']; ?></td>
                <td><font size="3"><?php echo $myData['NOMOR_TELEPON']; ?></td>
                <td><font size="3"><?php echo $myData['KETERANGAN']; ?></td>
                <td align="center"><font size="3"><?php 
  echo " <a href=?open=Anggota-Edit&Kode=$myData[ID_ANGGOTA]> Edit /</a> 
  <a href=?open=Anggota-Delete&Kode=$myData[ID_ANGGOTA] onClick='return tanya2()'> Delete</a>";
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
