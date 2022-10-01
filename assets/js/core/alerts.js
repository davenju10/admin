function proceso_ajax(){
    Swal.fire({
      title: '¿Quieres guardar los cambios?',
      showDenyButton: true,
      showCancelButton: true,
      confirmButtonText: 'Guardar',
      denyButtonText: 'Descartar',
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        //mostrar mensaje de espera
        alerta_procesando()
        //Lanzar petición
        return fetch(`./aax.php?login=juan`)
          .then(response => {
            if (!response.ok) {
              Swal.fire(`Oops.. <br> Ha ocurrido un error inesperado <br> Intentalo de nuevo más tarde.`, './img/illustrations/error-404.png', 'error')
              return false;
            }
            Swal.fire('Guardado!', '', 'success')
            console.log('Correcto '+response)
            return false
          })
          .catch(error => {
            Swal.fire(`Oops.. <br> Ha ocurrido un error inesperado <br> Intentalo de nuevo más tarde.`, './img/illustrations/error-404.png', 'error')
          })
      } else if (result.isDenied) {
        Swal.fire('Cancelado', '', 'info')
      }
    })
  }

  function alerta_procesando(){
    let timerInterval
    Swal.fire({
      title: 'Guardando..',
      html: 'Cosa',
      timer: 10000,
      timerProgressBar: true,
      didOpen: () => {
        Swal.showLoading()
      },
      willClose: () => {
        clearInterval(timerInterval)
      }
    }).then((result) => {
      /* Read more about handling dismissals below */
      if (result.dismiss === Swal.DismissReason.timer) {
        console.log('Fin de la espera')
      }
    })
  }

  function notificacion_panel(){
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    })

    Toast.fire({
      icon: 'success',
      title: '¡Date por notificado!'
    })
  }