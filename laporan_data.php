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

<table width="100%"  border="0" ccellpadding="1" bgcolor="#CCCCCC">
  <tbody>
    <tr>
      <td><H2><U><font size="6">Laporan Peminjaman Perpustakaan Prodi Pendidikan Informatika</U></H2></td>
    </tr>
      <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><table class ="table-list" width="100%"  cellspacing="1" cellpadding="1" bordercolor="#0275d8">
        <tbody>
        <tr>
          <td><table class ="table-list" width="100%" border="2" cellspacing="1" cellpadding="1" bordercolor="#0275d8">
            <tbody class="width: 100%">
              
              <?php
			  $sql = mysql_query("select anggota.KETERANGAN, anggota.ID_ANGGOTA from anggota where (ID_ANGGOTA='$_SESSION[User]') UNION select admin.LEVEL, admin.ID_ADMIN  from admin where (ID_ADMIN='$_SESSION[User]')") or die (mysql_error());
		$data = mysql_fetch_array($sql);
		$akun = $data['KETERANGAN'];
		if ($data['KETERANGAN'] == "Admin"|| $data['KETERANGAN'] == "Petugas") {
			$mySql 	= "SELECT * FROM peminjaman INNER JOIN anggota On peminjaman.ID_ANGGOTA=anggota.ID_ANGGOTA INNER JOIN buku On peminjaman.ID_BUKU=buku.ID_BUKU ORDER BY ID_PEMINJAMAN ASC";
	$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query  salah : ".mysql_error());
		}
		else if ($data['KETERANGAN'] == "Mahasiswa"|| $data['KETERANGAN'] == "Dosen") {
			$mySql 	= "SELECT * FROM peminjaman INNER JOIN buku On peminjaman.ID_BUKU=buku.ID_BUKU INNER JOIN anggota On peminjaman.ID_ANGGOTA=anggota.ID_ANGGOTA WHERE peminjaman.ID_ANGGOTA='$_SESSION[User]' ORDER BY ID_PEMINJAMAN ASC";
	$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query  salah : ".mysql_error());
		}
	  // Skrip menampilkan data User ke layar
	$nomor  = 0;?> 
    <tr bgcolor="#0275d8">
                <td width="2%"><font size="4.5">No </td>
                <td width="10%"><font size="4.5">ID Buku</td>
                <td width="10%"><font size="4.5">ID Anggota</td>
                <td width="15%"><font size="4.5">Nama Anggota</td>
                <td width="23%"><font size="4.5">Judul Buku</td>
                <td width="10%"><font size="4.5">Tanggal Pinjam</td>
                <td width="10%"><font size="4.5">Tanggal Kembali</td>
                <td width="10%"><font size="4.5">Jatuh Tempo</td>
                <td width="10%"><font size="4.5">Status</td>
                <td width="10%"><font size="4.5">Denda</td>
                <?php $akun; if ($akun == "Admin"|| $akun == "Petugas")echo '<td width="10%"></td>';?>
              </tr>
	<?php while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
	?>
              <tr>
                <td><font size="3"><?php echo $nomor; ?></td>
                <td><font size="3"><?php echo $myData['ID_BUKU']; ?></td>
                <td><font size="3"><?php echo $myData['ID_ANGGOTA']; ?></td>
                <td><font size="3"><?php echo $myData['NAMA_ANGGOTA']; ?></td>
                <td><font size="3"><?php echo $myData['JUDUL']; ?></td>
                <td><font size="3"><?php echo $myData['TANGGAL_PINJAM']; ?></td>
                <td><font size="3"><?php echo $myData['TANGGAL_KEMBALI']; ?></td>
                <td><font size="3"><?php echo date("d/m/Y", strtotime(strtr($myData['TANGGAL_PINJAM'].'7day', "/", "-")));?></td>
                <td><font size="3"><?php 
			if (!empty($myData['TANGGAL_KEMBALI'])) 
			{echo "Sudah dikembalikan";}
			else 
			{echo "Belum dikembalikan";} 
			?></td>
            <td><font size="3"><?php
			$date1 = date_create(date("Y-m-d", strtotime(strtr($myData['TANGGAL_PINJAM'].'7day',"/","-"))));
	$date2 = date_create(date("Y-m-d"));
	
	if (date_diff($date1, $date2)->format("%a") > 7) {
		echo date_diff($date1, $date2)->format("%a") * 200;
	}
			else {
			echo "-";
			}?></td>
             <?php if ($akun == "Admin"|| $akun == "Petugas"){ echo "<td>"; if (empty($myData['TANGGAL_KEMBALI']))
            echo "<a href='?open=admin_kembali&id=".$myData['ID_BUKU']."'>Kembalikan</a>";
            else echo "-";
			echo "</td>";
            } }?>
            
        </tr>
        </tbody>
      </table></td>
    </tr>
  </tbody>
</table>
