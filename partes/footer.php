<footer class="footer py-4">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-6 mb-lg-0 m-4">
                <div class="copyright text-center text-sm text-muted text-lg-start">
                © <span id="year"></span>,
                hecho con <i translate="no"class="fa fa-heart"></i> por
                David Enamorado
                para una web mejor.
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="row" style="display: none;">
    <div class="col-lg-3 col-sm-6 col-12">
        <button class="btn bg-gradient-success w-100 mb-0 toast-btn" type="button" data-target="successToast" id="lanzarOk">Ok</button>
    </div>
    <div class="col-lg-3 col-sm-6 col-12 mt-sm-0 mt-2">
        <button class="btn bg-gradient-info w-100 mb-0 toast-btn" type="button" data-target="infoToast" id="lanzarInfo">Info</button>
    </div>
    <div class="col-lg-3 col-sm-6 col-12 mt-lg-0 mt-2">
        <button class="btn bg-gradient-warning w-100 mb-0 toast-btn" type="button" data-target="warningToast" id="lanzarAlerta">Alerta</button>
    </div>
    <div class="col-lg-3 col-sm-6 col-12 mt-lg-0 mt-2">
        <button class="btn bg-gradient-danger w-100 mb-0 toast-btn" type="button" data-target="dangerToast" id="lanzarBorrar">Borrar</button>
    </div>
</div>
<div class="position-fixed top-5 end-1" style="z-index: 10;">
    <div class="toast fade hide p-2 bg-white" role="alert" aria-live="assertive" id="successToast" aria-atomic="true">
        <div class="toast-header border-0">
        <i class="material-icons text-success me-2">
            check
        </i>
        <span class="me-auto font-weight-bold">- Cuadro de mandos -</span>
        <small class="text-body">Hace 21 minutos</small>
        <i class="fas fa-times text-md ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"></i>
        </div>
        <hr class="horizontal dark m-0">
        <div class="toast-body" id="successToast-mensaje">
        ¡Éxito! Mensaje de notificación.
        </div>
    </div>
    <div class="toast fade hide p-2 mt-2 bg-gradient-info" role="alert" aria-live="assertive" id="infoToast" aria-atomic="true">
        <div class="toast-header bg-transparent border-0">
        <i class="material-icons text-white me-2">
            notifications
        </i>
        <span class="me-auto text-white font-weight-bold">- Cuadro de mandos -</span>
        <small class="text-white">Hace 16 minutos</small>
        <i class="fas fa-times text-md text-white ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"></i>
        </div>
        <hr class="horizontal light m-0">
        <div class="toast-body text-white" id="infoToast-mensaje">
        ¡Información! Mensaje de notificación.
        </div>
    </div>
    <div class="toast fade hide p-2 mt-2 bg-white" role="alert" aria-live="assertive" id="warningToast" aria-atomic="true">
        <div class="toast-header border-0">
        <i class="material-icons text-warning me-2">
            travel_explore
        </i>
        <span class="me-auto font-weight-bold">- Cuadro de mandos -</span>
        <small class="text-body">Hace 9 minutos</small>
        <i class="fas fa-times text-md ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"></i>
        </div>
        <hr class="horizontal dark m-0">
        <div class="toast-body" id="warningToast-mensaje">
        ¡Advertencia! Mensaje de notificación.
        </div>
    </div>
    <div class="toast fade hide p-2 mt-2 bg-white" role="alert" aria-live="assertive" id="dangerToast" aria-atomic="true">
        <div class="toast-header border-0">
        <i class="material-icons text-danger me-2">
        campaign
        </i>
        <span class="me-auto text-gradient text-danger font-weight-bold">- Cuadro de mandos -</span>
        <small class="text-body">Hace 11 minutos</small>
        <i class="fas fa-times text-md ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"></i>
        </div>
        <hr class="horizontal dark m-0">
        <div class="toast-body" id="dangerToast-mensaje">
        ¡Peligro! Mensaje de notificación.
        </div>
    </div>
</div>
<script>
    document.getElementById('year').innerHTML = new Date().getFullYear();
</script>