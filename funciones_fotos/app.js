let form_data = new FormData(),
form_data2 = new FormData(),
array = [],
array2 = [],
caja = document.querySelector('#caja_form'),
caja2 = document.querySelector('#caja_form2'),
container = document.querySelector('.container_drop'),
max_imagenes = 20,
text = document.querySelector('.inner');


const MAX_WIDTH = 2048;
const MAX_HEIGHT = 1080;
const MIME_TYPE = "image/jpeg";

async function comprimir(file){
    
    const blobURL = URL.createObjectURL(file);
    const img = new Image();
    img.src = blobURL;
    img.onerror = function () {
        URL.revokeObjectURL(this.src);
        // Handle the failure properly
    };
    return await new Promise((resolve, reject)=>{
        img.onload = function () {
            URL.revokeObjectURL(this.src);
            var dpr = window.devicePixelRatio || 1;
            const [newWidth, newHeight] = calculateSize(img, MAX_WIDTH, MAX_HEIGHT);
            const canvas = document.createElement("canvas");
            canvas.width = newWidth;
            canvas.height = newHeight;
            const ctx = canvas.getContext("2d");
            ctx.drawImage(img, 0, 0, newWidth, newHeight);
            let arr = [];
            arr.push(canvas.toDataURL())
            arr.push(file.name)
            resolve(arr); 
        }
    });

};

function calculateSize(img, maxWidth, maxHeight) {
  let width = img.width;
  let height = img.height;

  // calculate the width and height, constraining the proportions
  if (width > height) {
    if (width > maxWidth) {
      height = Math.round((height * maxWidth) / width);
      width = maxWidth;
    }
  } else {
    if (height > maxHeight) {
      width = Math.round((width * maxHeight) / height);
      height = maxHeight;
    }
  }
  return [width, height];
}

// Utility functions for demo purpose

function displayInfo(label, file) {
  const p = document.createElement('p');
  p.innerText = `${label} - ${readableBytes(file.size)}`;
  document.getElementById('root').append(p);
}

function readableBytes(bytes) {
  const i = Math.floor(Math.log(bytes) / Math.log(1024)),
    sizes = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

  return (bytes / Math.pow(1024, i)).toFixed(2) + ' ' + sizes[i];
}

function uploadCanvas(dataURL) {
    var blobBin = atob(dataURL[0].toString().split(',')[1]);
    var array = [];
    for(var i = 0; i < blobBin.length; i++) {
        array.push(blobBin.charCodeAt(i));
    }
    var file = new Blob([new Uint8Array(array)], {type: 'image/png'});
    let arr = [];
    arr.push(file);
    arr.push(dataURL[1])
    return arr;
}

function upload_file(e) {
    e.preventDefault();
    array_upload(e.dataTransfer.files);
}
  
function file_explorer() {
    document.getElementById('selectfile').click();
    caja.classList.add('dragover')
    document.getElementById('selectfile').onchange = function() {
        files = document.getElementById('selectfile').files;
        array_upload(files);
        caja.classList.remove('dragover')
        document.getElementById('texto_drop').innerHTML = "Click o arrastra tus imagenes aquí.";
    };
}

let timerInterval;

async function ajax_file_upload(files_obj) {
    return await new Promise((resolve, reject)=>{
        if(files_obj != undefined) {
            let img_nueva;
            timerInterval = Swal.fire({
                title: 'Guardando Fotos',
                html: 'Por favor, espere.',
                timer: 10000,
                timerProgressBar: true,
                didOpen: () => {
                  Swal.showLoading()
                },
                willClose: () => {
                  clearInterval(timerInterval)
                }
            })
            
            for(i=0; i<files_obj.length; i++) {
                var compro = check_nombre(files_obj[i].name)
                if(compro !== 0){
                    console.log('array_upload', files_obj[i].name, check_nombre(files_obj[i].name))
                    Swal.fire({
                        title: "¡Error!", 
                        html: compro, 
                        icon: "error", 
                        showDenyButton: false,
                        showCancelButton: false,
                        confirmButtonText: 'Cerrar',
                        didOpen: () => {
                            Swal.hideLoading()
                        }
                    })
                    return;
                }else{
                    comprimir(files_obj[i]).then((result)=>{
                        return result;
                    }).then(function(otro) { // (**)
                        img_nueva = uploadCanvas(otro);
                        return img_nueva;
                    }).then(function(img) { // (**)
                        form_data.append('file[]', img[0], img[1]);
                    });
                }
            }
            resolve(true)
        }
    });
}

function enviarFormulario(){
    ajax_file_upload(array).then((result)=>{
        return result;
    }).then(function(respuesta) {
        let tiempo = setInterval(() => {
           if(respuesta){
                clearInterval(tiempo);
                clearInterval(timerInterval)
                var xhttp = new XMLHttpRequest();
                xhttp.open("POST", "upload.php", true);
                xhttp.onload = function(event) {
                    if (xhttp.status == 200) {
                        Swal.fire('Guardado!', '', 'success')
                        document.getElementById('root').innerHTML = xhttp.response;
                        form_data = new FormData();
                    } else {
                        // alert("Error " + xhttp.status + " occurred when trying to upload your file.");
                        console.log("Error " + xhttp.status + " occurred when trying to upload your file.")
                    }
                }
            
                xhttp.send(form_data);
            }
        }, 1000);
        
    });
}

function comprobar_maximo_imagenes(files){
    if(files.length >= max_imagenes){
        return false
    }
    return true
}

function array_upload(files_obj) {
    
    if(files_obj != undefined) {
        for(i=0; i<files_obj.length; i++) {
            if(comprobar_maximo_imagenes(array)){
                array.push(files_obj[i]);
            }else{
                Swal.fire("¡Demasiados archivos!", `Hemos establecido un límite de ${max_imagenes} archivos`, "error")
                break;
            }
        }
    }
    form_data.append('carpeta', document.getElementById('carpeta').value);
    enviarFormulario();
    document.getElementById('selectfile').value = "";
    array = [];
}

function comprobaciones(e, blob){
    //comprobaciones de peso y tipo
    // var peso;
    
    // if(e.size > 999999){
    //     peso = parseFloat(e.size/1000000).toFixed(2) + "MB"
    // }else{
    //     peso = parseFloat(e.size/1000).toFixed(2) + "KB"
    // }
    // return `<div class="info"><p>${e.name}</p></div>`;

    // let pattern = /[a-zA-Z0-9](?:[a-zA-Z0-9 _-]*[a-zA-Z0-9])?.[a-zA-Z0-9_-]+/g;
    // let result = e.match(pattern);
    // console.log(result);
}

function check_nombre(current_form){

    // si esta vacio permitimos enviar el formulario
    if(current_form.search(/\S/g) == -1){
      return 0
    }

    var msg = ""
    // extraemos el nombre del archivo y la extension
    var file1 = current_form.match(/[^\/\\]+\.(?:jpg|gif|jpeg|webp|png)$/i)

    // la extension de archivo son validas
    if(file1 != null){
        // Extraemos solo el nombre del archivo
        file1 = file1.toString().replace(/\.jpg$|\.jpeg$|\.webp$|\.png$|\.gif$/i,"")

        if(file1.split('.').length > 1){
            msg+="No se permiten varios puntos en el nombre del archivo.\t\n"
        }

        if(file1.split(' ').length > 1){
            msg+="No se permiten espacios en el nombre del archivo.\t\n"
        }

        if(file1.split('\'').length > 1){
            msg+="No se permiten comillas simples ni dobles en el nombre del archivo.\t\n"
        }

        // if((/["'.]|\-{4,}|\ {0}|\s/i).test(file1)){
        //     msg+="No se permiten comillas simples o doble, puntos, espacios"+
        //     "\n o más de tres guiones en el nombre del archivo.\t\n"
        // }

        // if(!(/^\(.+\)$/i).test(file1)){
        //     msg+= "El nombre del archivo debe estar entre parentesis.\t\n"
        // }

    }else{
        msg+="Solo son validos los archivos con la extension jpg, jpeg, webp, png o gif.\t\n"
    }

    //Si el mensaje no esta vacio
    if(msg!=""){
        msg+="Ejemplo de una archivo valido:\n\n"+
        "\n nombredelarchivo.jpeg ";
        return msg;
    }else{
        // esta todo bien
        return 0
    }

}

function file_explorer2() {
    console.log('file_explorer2')
    document.getElementById('selectdocs').click();
    caja2.classList.add('dragover')
    document.getElementById('selectdocs').onchange = function() {
        var files2 = document.getElementById('selectdocs').files;
        array_upload2(files2);
        caja2.classList.remove('dragover')
        document.getElementById('texto_drop_docs').innerHTML = "Click o arrastra tus documentos aquí.";
    };
}

async function ajax_file_upload2(files_obj) {
    console.log('ajax_file_upload2')
    return await new Promise((resolve, reject)=>{
        if(files_obj != undefined) {
            let img_nueva;
            timerInterval = Swal.fire({
                title: 'Guardando Documentos',
                html: 'Por favor, espere.',
                timer: 10000,
                timerProgressBar: true,
                didOpen: () => {
                  Swal.showLoading()
                },
                willClose: () => {
                  clearInterval(timerInterval)
                }
            })
            
            for(i=0; i<files_obj.length; i++) {
                form_data2.append('file[]', files_obj[i]);
            }
            resolve(true)
        }
    });
}

function enviarFormulario2(){
    console.log('enviarFormulario2')
    ajax_file_upload2(array2).then((result)=>{
        return result;
    }).then(function(respuesta) {
        let tiempo = setInterval(() => {
           if(respuesta){
                clearInterval(tiempo);
                clearInterval(timerInterval)
                var xhttp = new XMLHttpRequest();
                xhttp.open("POST", "uploaddocs.php", true);
                xhttp.onload = function(event) {
                    if (xhttp.status == 200) {
                        if(xhttp.response == 200){
                            Swal.fire('Guardado!', '', 'success')
                            pintarDocumentos(document.getElementById('carpeta').value);
                        }else{
                            Swal.fire('¡Ha ocurrido un error!', 'uno o mas archivos no han podido subirse', 'error')
                        }
                        form_data2 = new FormData();
                    } else {
                        // alert("Error " + xhttp.status + " occurred when trying to upload your file.");
                        console.log("Error " + xhttp.status + " occurred when trying to upload your file.")
                    }
                }
            
                xhttp.send(form_data2);
            }
        }, 1000);
        
    });
}

function array_upload2(files_obj) {
    console.log('array_upload2')
    if(files_obj != undefined) {
        for(i=0; i<files_obj.length; i++) {
            if(comprobar_maximo_imagenes(array2)){
                array2.push(files_obj[i]);
            }else{
                Swal.fire("¡Demasiados archivos!", `Hemos establecido un límite de ${max_imagenes} archivos`, "error")
                break;
            }
        }
    }
    form_data2.append('carpeta', document.getElementById('carpeta').value);
    enviarFormulario2();
    document.getElementById('selectdocs').value = "";
    array2 = [];
}

// drag and drop 
caja.addEventListener('dragover', e => {
	e.preventDefault()

	caja.classList.add('dragover')
    document.getElementById('texto_drop').innerHTML = "¡Sueltame!";
})

caja.addEventListener('dragleave', e => {
	e.preventDefault()

	caja.classList.remove('dragover')
    document.getElementById('texto_drop').innerHTML = "Click o arrastra tus imagenes aquí.";
})

caja.addEventListener("drop", e => {
    e.preventDefault();
    caja.classList.remove('dragover')
    document.getElementById('texto_drop').innerHTML = "Click o arrastra tus imagenes aquí.";
});

caja.addEventListener("focusout", e => {
    e.preventDefault();
    caja.classList.remove('dragover')
    document.getElementById('texto_drop').innerHTML = "Click o arrastra tus imagenes aquí.";
});