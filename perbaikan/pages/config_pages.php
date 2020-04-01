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
			case 'budget':
				include "budget/index.php";
			break;
			case 'pengajuan':
				include "pengajuan/index.php";
            break;
            case 'verify':
				include "verify/index.php";
			break;
			case 'department':
				include "department/index.php";
			break;
			case 'jabatan':
				include "jabatan/index.php";
			break;
			case 'marrid':
				include "marrid/index.php";
			break;
            case 'approval':
				include "approval/index.php";
			break;
			
			default:
				include "404.php";
			break;



			// form karyawan
            case 'formKaryawan':
				include "karyawan/form.php";
			break;
			case 'profileKaryawan':
				include "karyawan/profile.php";
			break;
			
			// form Budget
			case 'formBudget':
				include "budget/form.php";
			break;

			// form Department
			case 'formDepartment':
				include "department/form.php";
			break;

			// form pengajuan
			case 'formPengajuan':
				include "pengajuan/form.php";
			break;
			case 'details':
				include "pengajuan/detailsPengajuan.php";
			break;

		}
	}else{
		include "dashboard/index.php";
	}
?>