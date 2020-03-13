<?php 
	if(isset($_GET['page'])){
		$page = $_GET['page'];
 
		switch ($page) {
			case 'dashboard':
				include "dashboard/index.php";
				break;
			case 'karyawan':
				include "karyawan/index.php";
				break;
			case 'pengajuan':
				include "pengajuan/index.php";
                break;
            case 'persetujuan':
				include "persetujuan/index.php";
            break;
            case 'requisition':
				include "requisition/index.php";
			break;
			// form karyawan
            case 'formKaryawan':
				include "karyawan/form.php";
			break;
			case 'profileKaryawan':
				include "karyawan/profile.php";
			break;
			

			default:
				echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
            break;
		}
	}else{
		include "dashboard/index.php";
	}
?>