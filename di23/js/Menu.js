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

let divCapaResultadosBusquedaVisible = false;

function enviarMenu() {
    // Obtén el elemento select
    let selectRoles = document.getElementById('roles');
    let selectUsuarios = document.getElementById('usuarios');

    // Obtén el valor seleccionado
    let valorSeleccionadoRoles = selectRoles.value;
    let valorSeleccionadoUsuarios = selectUsuarios.value;



    let capaResultadosBusqueda = document.getElementById("capaResultadosBusqueda");

    // Si el formulario ya está visible, ocúltalo
    // if (capaResultadosBusqueda.innerHTML.trim() !== '') {
    //     capaResultadosBusqueda.innerHTML = '';
    //     return;
    // }

    
    if(!divCapaResultadosBusquedaVisible){
        if (valorSeleccionadoRoles == '' && valorSeleccionadoUsuarios == '') {
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
                    capaResultadosBusqueda.innerHTML = vista;
                })
                .catch(error => {
                    console.log('Error: ', error.message);
                });
        }else if (valorSeleccionadoRoles != 0 && valorSeleccionadoUsuarios == '') {
            let opciones = { method: "GET" };
            let parametros = "controlador=Menu&metodo=getListaMenuRoles&id_rol=" + valorSeleccionadoRoles;
            fetch("C_Ajax.php?" + parametros, opciones)
                .then(res => {
                    if (res.ok) {
                        return res.text();  
                    } else {
                        throw new Error('Network response was not ok');
                    }
                })
                .then(vista => {
                    capaResultadosBusqueda.innerHTML = vista;
                })
                .catch(error => {
                    console.log('Error: ', error.message);
                });
        }else if (valorSeleccionadoRoles == '' && valorSeleccionadoUsuarios != 0) {
            let opciones = { method: "GET" };
            let parametros = "controlador=Menu&metodo=getListaMenuUsuarios&id_usuario=" + valorSeleccionadoUsuarios;
            fetch("C_Ajax.php?" + parametros, opciones)
                .then(res => {
                    if (res.ok) {
                        return res.text();  
                    } else {
                        throw new Error('Network response was not ok');
                    }
                })
                .then(vista => {
                    capaResultadosBusqueda.innerHTML = vista;
                })
                .catch(error => {
                    console.log('Error: ', error.message);
                });
        }else if (valorSeleccionadoRoles != 0 && valorSeleccionadoUsuarios != 0) {
                let opciones = { method: "GET" };
                let parametros = "controlador=Menu&metodo=getListaUsuariosRoles&id_rol=" + valorSeleccionadoRoles + "&id_usuario=" + valorSeleccionadoUsuarios;
                fetch("C_Ajax.php?" + parametros, opciones)
                    .then(res => {
                        if (res.ok) {
                            return res.text();  
                        } else {
                            throw new Error('Network response was not ok');
                        }
                    })
                    .then(vista => {
                        capaResultadosBusqueda.innerHTML = vista;
                    })
                    .catch(error => {
                        console.log('Error: ', error.message);
                    });


            }
        capaResultadosBusqueda.style.display = 'block';
    } else {
        capaResultadosBusqueda.style.display = 'none';
        capaResultadosBusqueda.innerHTML = "";
        divCapaResultadosBusquedaVisible=true;
    }
}

function setPermisoRol(id_permiso , id_rol , accion){
    let opciones = { method: "GET" };
    let parametros = "controlador=Menu&metodo=setPermisoRol&id_permiso=" + id_permiso + "&id_rol=" + id_rol + "&accion=" + accion;
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

function setPermisoUsuario(id_permiso , id_usuario , accion){
    let opciones = { method: "GET" };
    let parametros = "controlador=Menu&metodo=setPermisoUsuario&id_permiso=" + id_permiso + "&id_usuario=" + id_usuario + "&accion=" + accion;
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


function cargarMenu(id_menu){
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

function setRolUsuarioInsertDelete(id_rol, id_usuario, accion) {
    let opciones = { method: "GET" };
    let parametros = "controlador=Menu&metodo=setRolUsuarioInsertDelete&id_rol=" + id_rol + "&id_usuario=" + id_usuario + "&accion=" + accion;
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
    cargarMenu();
}

function borrarMenu(id_menu) {
    if (!confirm("¿Está seguro de que desea eliminar este menú?")) {
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
        cargarMenu();
    }  
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
    parametros += "&" + new URLSearchParams(new FormData(document.getElementById("menuEditarPermisos" + id_permiso))).toString();
    
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
    if(confirm("¿Está seguro de que desea eliminar este permiso?")){
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
    
}

