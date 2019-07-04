<?php
# KONTROL MENU PROGRAM
if(isset($_GET['open'])) {
	// Jika mendapatkan variabel URL ?open
	switch($_GET['open']){	
			
		case '' :
			if(!file_exists ("info.php")) die ("File tidak ada !"); 
			include "info.php";	break;
			
		case 'Halaman-Utama' :
			if(!file_exists ("info.php")) die ("File tidak ada !"); 
			include "info.php";	break;
				
		
		# ADMIN ///////////////////////////////////////////////////////////////////////////
		case 'Admin-Data' :
			if(!file_exists ("admin_data.php")) die ("File tidak ada !"); 
			include "admin_data.php";	 break;		
		case 'Admin-Add' :
			if(!file_exists ("admin_add.php")) die ("File tidak ada !"); 
			include "admin_add.php";	 break;		
		case 'Admin-Delete' :
			if(!file_exists ("admin_delete.php")) die ("File tidak ada !"); 
			include "admin_delete.php"; break;		
		case 'Admin-Edit' :
			if(!file_exists ("admin_edit.php")) die ("File tidak ada !"); 
			include "admin_edit.php"; break;
	
	# BUKU ///////////////////////////////////////////////////////////////////////////
		case 'Buku-Data' :
			if(!file_exists ("buku_data.php")) die ("File tidak ada !"); 
			include "buku_data.php";	 break;		
		case 'Buku-Add' :
			if(!file_exists ("buku_add.php")) die ("File tidak ada !"); 
			include "buku_add.php";	 break;	
			case 'Absensi-Data' :
			if(!file_exists ("absensi_data.php")) die ("File tidak ada !"); 
			include "absensi_data.php";	 break;		
		case 'Buku-Add' :
			if(!file_exists ("buku_add.php")) die ("File tidak ada !"); 
			include "buku_add.php";	 break;		
		case 'Buku-Delete' :
			if(!file_exists ("buku_delete.php")) die ("File tidak ada !"); 
			include "buku_delete.php"; break;		
		case 'Buku-Edit' :
			if(!file_exists ("buku_edit.php")) die ("File tidak ada !"); 
			include "buku_edit.php"; break;
		
		default:
			if(!file_exists ("info.php")) die ("File tidak ada !"); 
			include "info.php";						
		break;
		
		# PEMINJAMAN ///////////////////////////////////////////////////////////////////////////
		case 'Peminjaman-Data' :
			if(!file_exists ("peminjaman_data.php")) die ("File tidak ada !"); 
			include "Peminjaman_data.php";	 break;		
		case 'Peminjaman-Add' :
			if(!file_exists ("peminjaman_pinjam_buku.php")) die ("File tidak ada !"); 
			include "peminjaman_pinjam_buku.php";	 break;		
			case 'Peminjaman-Back' :
			if(!file_exists ("peminjaman_kembalikan_buku.php")) die ("File tidak ada !"); 
			include "peminjaman_kembalikan_buku.php";	 break;		
		case 'Peminjaman-Delete' :
			if(!file_exists ("peminjaman_delete.php")) die ("File tidak ada !"); 
			include "peminjaman_delete.php"; break;		
		case 'Peminjaman-Edit' :
			if(!file_exists ("peminjaman_edit.php")) die ("File tidak ada !"); 
			include "peminjaman_edit.php"; break;
			
			# MAHASISWA ///////////////////////////////////////////////////////////////////////////
		case 'Anggota-Data' :
			if(!file_exists ("anggota_data.php")) die ("File tidak ada !"); 
			include "anggota_data.php";	 break;		
		case 'Anggota-Add' :
			if(!file_exists ("anggota_add.php")) die ("File tidak ada !"); 
			include "anggota_add.php";	 break;		
		case 'Anggota-Delete' :
			if(!file_exists ("anggota_delete.php")) die ("File tidak ada !"); 
			include "anggota_delete.php"; break;		
		case 'Anggota-Edit' :
			if(!file_exists ("anggota_edit.php")) die ("File tidak ada !"); 
			include "anggota_edit.php"; break;
			case 'admin_kembali' :
			if(!file_exists ("admin_kembali.php")) die ("File tidak ada !"); 
			include "admin_kembali.php";	 break;	
			
			
			# LAPORAN ///////////////////////////////////////////////////////////////////////////
		case 'Laporan-Data' :
			if(!file_exists ("laporan_data.php")) die ("File tidak ada !"); 
			include "laporan_data.php";	 break;		
			
		
		default:
			if(!file_exists ("info.php")) die ("File tidak ada !"); 
			include "info.php";						
		break;	
		
	}
}
else {
	// Jika tidak mendapatkan variabel URL : ?page
	if(!file_exists ("info.php")) die ("File tidak ada !"); 
	include "info.php";	
}
?>