function cargarDatosMenu(id_menu) {
    let formularioAyuda = document.getElementById("formularioAyuda" + id_menu);
    let pruebaElement = document.getElementById("prueba" + id_menu);

    if (id_menu) {
        let parametros = "controlador=Menu&metodo=getMenuId&id_menu=" + id_menu; 
        parametros += "&" + new URLSearchParams(new FormData(formularioAyuda)).toString();
    
        fetch("C_Ajax.php?" + parametros)
            .then(res => {
                if (res.ok) {
                    return res.text();  
                } else {
                    throw new Error('Network response was not ok');
                }
            })
            .then(data => {
                pruebaElement.innerHTML = data;
                if (formularioAyuda.style.display == 'none') {
                    formularioAyuda.style.display = 'block';
                } else {
                    formularioAyuda.style.display = 'none';
                    pruebaElement.innerHTML = ""; 
                }
            })
            .catch(error => {
                console.log('Error: ', error.message);
            });
    }
}



function enviarMenu() {
    let opciones = { method: "GET" };
    let parametros = "controlador=Menu&metodo=getListaMenu";
    parametros += "&" + new URLSearchParams(new FormData(document.getElementById("mirarMenu"))).toString();
    fetch("C_Ajax.php?" + parametros, opciones)
        .then(res => {
            if (res.ok) {
                return res.text(); 
            } else {
                throw new Error('Network response was not ok');
            }
        })   
        .then(vista => {
            document.getElementById("capaResultadosBusqueda").innerHTML = vista;
        })
        .catch(error => {
            console.log('Error: ', error.message);
        });
}

function cargarMenu(){
    opciones = {method: "GET"};
    parametros ="controlador=Menu&metodo=buscarMenu";
    fetch("C_Ajax.php?" + parametros,opciones)
        .then(res => {
            if (res.ok) {
                console.log('respuesta ok');
                return res.text();
            }
        }).then(vista => {
            document.getElementById("newMenu").innerHTML = vista;
        }).catch(err =>{
            console.log("Error al realizar la peticion" , err.message);
        });

}

function actualizarMenu() {
   
    var id_menu = document.getElementById('id_menu').value;
    var titulo = document.getElementById('titulo').value;
    var id_padre = document.getElementById('id_padre').value;
    var accion = document.getElementById('accion').value;
    var orden = document.getElementById('orden').value;
    var privado = document.getElementById('privado').value;

    var parametros = "controlador=Menu&metodo=insertarAndUpdaterMenu";
    parametros += "&id_menu=" + id_menu;
    parametros += "&titulo=" + titulo;
    parametros += "&id_padre=" + id_padre;
    parametros += "&accion=" + accion;
    parametros += "&orden=" + orden;
    parametros += "&privado=" + privado;

  
    fetch("C_Ajax.php?" + parametros, { method: "GET" })
        .then(res => {
            if (res.ok) {
                return res.text();  
            } else {
                throw new Error('Network response was not ok');
            }
        })
        .catch(error => {
            console.log('Error: ', error.message);
        });
enviarMenu();
cargarMenu();
}

function crearOpcionMenu(id_menu) {
    let formularioAyuda = document.getElementById("formularioAyuda" + id_menu);
    let pruebaElement = document.getElementById("prueba" + id_menu);

    if (formularioAyuda.style.display == 'none') {
        formularioAyuda.style.display = 'block';
    } else {
        formularioAyuda.style.display = 'none';
        pruebaElement.innerHTML = ""; // Limpiar el contenido de pruebaElement
        return;
    }

    let opciones = { method: "GET" };
    let parametros = "controlador=Menu&metodo=crearOpcionesMenu&id_menu=" + id_menu;
    parametros += "&" + new URLSearchParams(new FormData(formularioAyuda)).toString();

    fetch("C_Ajax.php?" + parametros, opciones)
        .then(res => {
            if (res.ok) {
                console.log('respuesta ok');
                return res.text();
            }
        }).then(vista => {
            pruebaElement.innerHTML = vista;
        }).catch(err => {
            console.log("Error al realizar la petición", err.message);
        });
}

function crearMenuNuevo() {
    
    var id_menu = document.getElementById('id_menu').value;
    var titulo = document.getElementById('titulo').value;
    var id_padre = document.getElementById('id_padre').value;
    var accion = document.getElementById('accion').value;
    var orden = document.getElementById('orden').value;
    var privado = document.getElementById('privado').value;

   
     var parametros = "controlador=Menu&metodo=insertarnuevaOpcionMenu";
     parametros += "&id_menu=" + id_menu;
     parametros += "&titulo=" + titulo;
     parametros += "&id_padre=" + id_padre;
     parametros += "&accion=" + accion;
     parametros += "&orden=" + orden;
     parametros += "&privado=" + privado;

     fetch("C_Ajax.php?" + parametros, { method: "GET" })
        .then(res => {
            if (res.ok) {
                return res.text(); 
            } else {
                throw new Error('Network response was not ok');
            }
        }).then(data => {
            console.log(data);  // Imprime la respuesta del servidor
        })
        .catch(error => {
            console.log('Error: ', error.message);
        });
    enviarMenu();
    cargarMenu();
}

function borrarMenu(id_menu) {
    let opciones = { method: "GET" };
    let parametros = "controlador=Menu&metodo=borrarMenu&id_menu=" + id_menu;
    fetch("C_Ajax.php?" + parametros, opciones)
        .then(res => {
            if (res.ok) {
                return res.text();  
            } else {
                throw new Error('Network response was not ok');
            }
        }).then(data => {
            console.log(data);  // Imprime la respuesta del servidor
        })
        .catch(error => {
            console.log('Error: ', error.message);
        });
    enviarMenu();
    cargarMenu();
}

function permisosMenu(id_menu){
    let opciones = { method: "GET" };
    let parametros = "controlador=Menu&metodo=permisosMenu&id_menu=" + id_menu;
    fetch("C_Ajax.php?" + parametros, opciones)
        .then(res => {
            if (res.ok) {
                return res.text();  
            } else {
                throw new Error('Network response was not ok');
            }
        }).then(data => {
      
            let permisosDiv = document.getElementById('permisos' + id_menu); 

       
            if (permisosDiv.innerHTML.trim() !== '') {
                permisosDiv.innerHTML = '';
            } else {
             
                permisosDiv.innerHTML = data;
            }
        })
        .catch(error => {
            console.log('Error: ', error.message);
        });
}

function editarPermisosMenu(id_permiso){ 
    let opciones = { method: "GET" };
    let parametros = "controlador=Menu&metodo=editarPermisosMenu&id_permiso=" + id_permiso;
    parametros += "&" + new URLSearchParams(new FormData(document.getElementById("menuEditarPermisos"))).toString();
    
    fetch("C_Ajax.php?" + parametros, opciones)
        .then(res => {
            if (res.ok) {
                return res.text();  
            } else {
                throw new Error('Network response was not ok');
            }
        }).then(data => {
            console.log(data);
            let permisosDiv = document.getElementById('EditarPermisos' + id_permiso);
            // Si el div ya tiene contenido, lo vaciamos. Si no, cargamos los datos en él.
            if (permisosDiv.innerHTML.trim() !== '') {
                permisosDiv.innerHTML = '';
            } else {
                permisosDiv.innerHTML = data;
            }
        })
        .catch(error => {
            console.log('Error: ', error.message);
        });
}
function eliminarPermisos(id_menu){
    let opciones = { method: "GET" };
    let parametros = "controlador=Menu&metodo=eliminarPermisos&id_permiso=" + id_menu;
    fetch("C_Ajax.php?" + parametros, opciones)
        .then(res => {
            if (res.ok) {
                return res.text();  
            } else {
                throw new Error('Network response was not ok');
            }
        }).then(data => {
            console.log(data);  // Imprime la respuesta del servidor
        })
        .catch(error => {
            console.log('Error: ', error.message);
        });
}

