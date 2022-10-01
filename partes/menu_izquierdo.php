<!-- MENU LATERAL
    Opciones($menu): 
        1 - Dashboard
        2 - Tables
        3 - Billing
        4 - Notifications
        5 - Profile
        6 - Sign In
        7 - Sign Up
-->
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 ps bg-white" id="sidenav-main">
    <div class="sidenav-header">
      <i translate="no"class="fas fa-times p-3 cursor-pointer opacity-5 position-absolute end-0 top-0 d-xl-none" style="position: absolute !important; width: 50px !important;height: 50px !important;" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="./" target="_blank">
        <img src="<?= $logo_menu ?>" style="width: 70px !important;height: 70px !important;margin: auto; background: transparent;" alt="Logo"></img>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link <?php echo ($menu == 1) ? "active bg-gradient-primary" : ""; ?> mis-botones" href="./">
            <div class="text-center me-2 d-flex align-items-center justify-content-center">
              <i translate="no"class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Cuadro de mandos</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo ($menu == 2) ? "active bg-gradient-primary" : ""; ?> mis-botones" href="./empresa.php">
            <div class="text-center me-2 d-flex align-items-center justify-content-center">
              <i translate="no"class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Empresa</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo ($menu == 3) ? "active bg-gradient-primary" : ""; ?> mis-botones" href="./facturas.php">
            <div class="text-center me-2 d-flex align-items-center justify-content-center">
              <i translate="no"class="material-icons opacity-10">receipt_long</i>
            </div>
            <span class="nav-link-text ms-1">Facturas</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo ($menu == 4) ? "active bg-gradient-primary" : ""; ?> mis-botones" href="./notificaciones.php">
            <div class="text-center me-2 d-flex align-items-center justify-content-center">
              <i translate="no"class="material-icons opacity-10">notifications</i>
            </div>
            <span class="nav-link-text ms-1">Notificaciones</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-8">PÁGINAS DE USUARIO</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo ($menu == 5) ? "active bg-gradient-primary" : ""; ?> mis-botones" href="./perfil.php">
            <div class="text-center me-2 d-flex align-items-center justify-content-center">
              <i translate="no"class="material-icons opacity-10">person</i>
            </div>
            <span class="nav-link-text ms-1">Perfil</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo ($menu == 6) ? "active bg-gradient-primary" : ""; ?> mis-botones" href="./sign-in.html">
            <div class="text-center me-2 d-flex align-items-center justify-content-center">
              <i translate="no"class="material-icons opacity-10">login</i>
            </div>
            <span class="nav-link-text ms-1">Inicia sesión</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo ($menu == 7) ? "active bg-gradient-primary" : ""; ?> mis-botones" href="./sign-up.html">
            <div class="text-center me-2 d-flex align-items-center justify-content-center">
              <i translate="no"class="material-icons opacity-10">assignment</i>
            </div>
            <span class="nav-link-text ms-1">Regístrate</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
      <div class="mx-3">
        <button class="btn btn-primary bg-gradient-primary mt-4 w-100 mis-botones active" onclick="proceso_ajax()" type="button">Proceso de alertas</button>
      </div>
    </div>
  </aside>