
<?php 
$log_fin = (isset($_SESSION["log_fin"]))? $_SESSION["log_fin"] : '';
$log_fam = (isset($_SESSION["log_fam"]))? $_SESSION["log_fam"] : '';

$level_us = (isset($_SESSION["level_user"]))? $_SESSION["level_user"] : '';
$level3 = (isset($_SESSION["level3"]))? $_SESSION["level3"] : '';
$page = (isset($data['page']))? $data['page'] : '';
$pages = (isset($data['pages']))? $data['pages'] : '';

?>

<div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
            <div class="sidebar-header position-relative">
                <div class="d-flex justify-content-between align-items-center">
                    <!-- <div class="logo">
                        <h5><a href="<?=base_url?>/transaksi"><?=$_SESSION['nama']?></a><h5>
                    </div> -->
                    <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                        <!-- <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21"><g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2" opacity=".3"></path><g transform="translate(-210 -1)"><path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path><circle cx="220.5" cy="11.5" r="4"></circle><path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path></g></g></svg> -->
                        <div class="form-check form-switch fs-6">
                            <input class="  me-0" type="hidden" id="toggle-dark" >
                        </div>
                    </div>
                    <div class="sidebar-toggler  x">
                        <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                    </div>
                </div>
            </div>
    <div class="sidebar-menu">
  
       
        <ul  class="menu">
            <li class="sidebar-title">Master</li>
            <!--  -->
          
            <li 
                class="sidebar-item   <?php if ($page == 'ms_petugas') {echo 'active';} else {echo'';} ?>  " aria-current="page" >
                <a href="<?= base_url; ?>/masterpetugas/index"  class='sidebar-link'>
                <i class="fa-solid fa-users-gear"></i>
                    <span>Master Petugas</span>
                </a>    

            </li>
            <li 
                class="sidebar-item   <?php if ($page == 'ms_jadwal') {echo 'active';} else {echo'';} ?>  " aria-current="page" >
                <a href="<?= base_url; ?>/masterjadwal/index"  class='sidebar-link'>
                <i class="fa-solid fa-users-gear"></i>
                    <span>Master Jadwal</span>
                </a>    

            </li>
            <li 
                class="sidebar-item   <?php if ($page == 'ms_jenis') {echo 'active';} else {echo'';} ?>  " aria-current="page" >
                <a href="<?= base_url; ?>/masterjenislimbah/index"  class='sidebar-link'>
                <i class="fa-solid fa-users-gear"></i>
                    <span>Master Jenis Limbah</span>
                </a>    

            </li>
        </ul>
        
        <ul class ="menu">
        <!-- <li
                class="sidebar-item" aria-current="page">
                <a  href="<?= base_url; ?>/logout" class='sidebar-link'>
                <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Sign Out</span>
                </a>
            </li> -->
        </ul>
    
    </div>
</div>