<?php
session_start();
include_once "library/koneksi.php";

if(@$_SESSION['User']){
	
//baca Jam Pada Komputer
date_default_timezone_set("Asia/Jakarta");
?>
<!DOCTYPE html><head>
<title>Perpustakaan Prodi Pendidikan Informatika</title>
<link rel="stylesheet" href="style.css" type="text/css" charset="utf-8" />

</head>
<body>
<div id="outer">
  <div id="wrapper">
    <div id="body">
      <div id="body-bot">
        <div id="wrapper2">
          <div id="nav">
            <div id="nav-left">
              <div id="nav-right">
               <?php
			   
				 
				$user_terlogin = @$_SESSION['User'];
				
				/*$sql_absen = mysql_query("select * from absensi where (ID_ADMIN='$user_terlogin'||ID_ANGGOTA='$user_terlogin') AND TANGGAL_ABSENSI='$tanggalAbsen'") or die (mysql_error());*/
			
					  
				$sql_user = mysql_query("select anggota.KETERANGAN from anggota where (anggota.ID_ANGGOTA='$user_terlogin') UNION select admin.LEVEL from admin where (admin.ID_ADMIN='$user_terlogin')") or die (mysql_error());
				$data_user = mysql_fetch_array($sql_user);
				
				//if (mysql_num_rows($sql_absen) == 0){
				
				//}
			?>
                <ul>
                  <li><a href="?open=Absensi-Data" target="_self">
<font size="3.5" color="#0275d8">DATA PENGNUNJUNG</font></a></li>
                  
                  <li><a href="?open=Buku-Data" target="_self">
<font size="3.5" color="#0275d8">BUKU</font></a></li> 
                  <?php if ($data_user['KETERANGAN'] == "Admin"|| $data_user['KETERANGAN'] == "Petugas" || $data_user['KETERANGAN'] == "") {?>
                  
                  <li><?php echo " <a href='?open=Anggota-Data' target='_self'>ANGGOTA
</a>";}?></li>

                  <li><a href="?open=Peminjaman-Data" target="_self">
<font size="3.5" color="#0275d8">PEMINJAMAN</font></a></li>
                  <?php if ($data_user['KETERANGAN'] == "Admin" || $data_user['KETERANGAN'] == "") {?>
                  
                  <li> <?php echo " <a href='?open=Admin-Data' target='_self'>ADMIN </a>";}?></li>
                  
                  <li><a href="?open=Laporan-Data" target="_self"><font size="3.5" color="#0275d8">LAPORAN</font></a></li>
                  
                  <li style="float:right"><a href="logout.php"><font size="3.5" color="#0275d8">LOGOUT</font></a></li>
                 
            <a><?php if ($data_user['KETERANGAN'] != '') {
				echo $data_user['KETERANGAN'];
			} else {
				echo 'Admin';
				} ?></a> </div>
                </ul> 
              </div>
            </div>
            <div class="clear"></div>
          </div>
          <div id="head">
            <div id="head-left"></div>
            <div id="head-right"></div>
            <div id="head-1"></div>
            <div id="navb"></div>
          </div>
          <div id="login">
              </div>
              <div class="clear"></div>
            </div>
          </div>
          <?php echo "<h2>".date('d/m/Y')."</h2>";?>
          <div id="body2">
            <div id="body-bot2">
              
              <div id="items">
                <div class="clear"></div>
              </div>
    
              <div id="banner">
       
              
			  <?php include "buka_file.php";?>               
                
              </div>
              <div id="footer">
                <p><a>Sistem Informasi Perpustakaan Zakaria Ramadhan</a> <strong></strong> <a></a> <br />© Copyright 2018 Supported by <a>Prodi Pendidikan Informatika</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body></html>
<?php
}else{
	echo "tidak ada session";
}
?>