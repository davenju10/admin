<div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i translate="no"class="material-icons py-2">settings</i>
    </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Configurador de interfaz de usuario</h5>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i translate="no"class="material-icons">clear</i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="pt-sm-3 pt-0" style="margin: 1rem !important;">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Color de preferencia</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark2" data-color="dark2" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3 hide-1200">
          <h6 class="mb-0">Menú lateral</h6>
          <p class="text-sm">
            Elija entre 3 tipos diferentes de menú.
          </p>
        </div>
        <div class="d-block hide-1200" id="botones_derecha">
          <button class="btn bg-gradient-primary mis-botones btn-sidenav px-2 mb-2 active" data-class="bg-white" data-texto="text-dark" onclick="sidebarType(this)">Claro</button>
          <button class="btn bg-gradient-primary mis-botones btn-sidenav px-2 mb-2 ms-2" data-class="bg-transparent" data-texto="text-dark" onclick="sidebarType(this)">Transparente</button>
          <button class="btn bg-gradient-primary mis-botones btn-sidenav px-2 mb-2 ms-2" data-class="bg-gradient-dark" data-texto="text-white" onclick="sidebarType(this)">Oscuro</button>
          <p class="text-sm d-xl-none mt-2">Solo puede cambiar el tipo de menu en la vista de ordenador.</p>
        </div>
        <!-- Navbar Fixed -->
        <div class="mt-3 show-movil">
          <h6 class="mb-0"><label for="navbarFixed">Anclar barra superior abajo</label></h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" name="navbarFixed" id="navbarFixed" onclick="navbarFixed(this)">
          </div>
        </div>
        <hr class="horizontal dark my-3">
        <div class="mt-2 d-flex">
          <h6 class="mb-0"><label for="dark-version">Claro / Oscuro</label></h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" data-class="bg-white" type="checkbox" name="dark-version" id="dark-version" onclick="darkMode(this)">
          </div>
        </div>
        <hr class="horizontal dark my-sm-4">
        <div class="w-100 text-center">
          <h6 class="mt-3">Gracias por compartirme!</h6>
          <a href="https://twitter.com/intent/tweet?text=Tablero%20de%20administracion%20por%20David%20Enamorado&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-dashboard" class="btn btn-primary bg-gradient-primary text-white mb-0 me-2 mis-botones active" target="_blank">
            <i translate="no"class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
          </a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $compartir ?>" class="btn btn-primary bg-gradient-primary text-white mb-0 me-2 mis-botones active" target="_blank">
            <i translate="no"class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
          </a>
        </div>
      </div>
    </div>
  </div>