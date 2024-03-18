// Funciones de validar y errores
function validarNombre(nombre) {
    return /^[a-zA-Z]+$/.test(nombre);
}

function validarApellido(apellido) {
    return /^[a-zA-Z]+$/.test(apellido);
}

function validarSexo(sexo) {
    return sexo === "H" || sexo === "M";
}

function validarEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

function validarMovil(movil) {
    return /^\d{9}$/.test(movil);
}

function validarLogin(login) {
    return /^[a-zA-Z0-9_]+$/.test(login);
}

function validarPassword(password) {
    return true;
}

function validarActivo(activo) {
    return activo === "S" || activo === "N";
}

function enseñarformulario() {
    var formulario = document.getElementById('formcontenedor');
    formulario.style.display = (formulario.style.display === 'none' || formulario.style.display === '') ? 'block' : 'none';
}

function buscarUsuarios() {
    // Obtener los valores de los campos
    let nombre = document.getElementById("b_nombre").value;
    let apellido1 = document.getElementById("b_apellido1").value;
    let apellido2 = document.getElementById("b_apellido2").value;
    let sexo = document.getElementById("b_sexo").value;
    let mail = document.getElementById("b_mail").value;
    let movil = document.getElementById("b_movil").value;
    let login = document.getElementById("b_login").value;

    if (nombre === "" && apellido1 === "" && apellido2 === "" &&
        sexo === "" && mail === "" && movil === "" && login === "") {
        // Mostrar mensaje de error indicando que al menos un campo debe estar rellenado
        alert("Al menos un campo debe estar rellenado para realizar la búsqueda.");
        return; // Detener la ejecución de la función
    }


    // Definir la estructura de datos para la validación
    let datos = [
        { valor: nombre, validacion: validarNombre, mensaje: "El nombre no es válido." },
        { valor: apellido1, validacion: validarApellido, mensaje: "Los apellidos no son válidos." },
        { valor: apellido2, validacion: validarApellido, mensaje: "Los apellidos no son válidos." },
        { valor: sexo, validacion: validarSexo, mensaje: "El sexo no es válido." },
        { valor: mail, validacion: validarEmail, mensaje: "El correo electrónico no es válido." },
        { valor: movil, validacion: validarMovil, mensaje: "El número de móvil no es válido." },
        { valor: login, validacion: validarLogin, mensaje: "El login no es válido." }
    ];

    // Validar los campos y almacenar mensajes de error
    let mensajesError = [];
    for (let i = 0; i < datos.length; i++) {
        if (datos[i].valor.trim() !== "" && !datos[i].validacion(datos[i].valor)) {
            mensajesError.push(datos[i].mensaje);
        }
    }

    // Mostrar mensajes de error si los hay, de lo contrario, realizar la petición AJAX
    if (mensajesError.length > 0) {
        var section = document.getElementById("secContenidoPagina");
    
        // Crear un elemento <p> para contener los mensajes de error
        var errorParagraph = document.createElement("p");
    
        // Agregar mensajes de error como texto dentro del párrafo
        mensajesError.forEach(function(mensaje, index) {
            if (index > 0) {
                errorParagraph.textContent += '\n';
            }
            errorParagraph.textContent += mensaje;
        });
    
        // Agregar el párrafo de error al final de la sección
        section.appendChild(errorParagraph);
    
        // Eliminar el párrafo después de 5 segundos (5000 milisegundos)
        setTimeout(function() {
            section.removeChild(errorParagraph);
        }, 3000);
    }else {
        // Resto del código para la búsqueda de usuarios
        buscarUsuarios2();
    }
}


function buscarUsuarios2(pagina) {
    let opciones = { method: "GET" };
    let parametros = "controlador=Usuarios&metodo=buscarUsuarios&pagina=" + pagina;
    parametros += "&" + new URLSearchParams(new FormData(document.getElementById("formularioBuscar"))).toString();

    fetch("C_Ajax.php?" + parametros, opciones)
        .then(res => {
            if (res.ok) {
                console.log('respuesta ok');
                return res.text();
            }
        })
        .then(vista => {
            document.getElementById("capaResultadosBusqueda").innerHTML = vista;
        })
        .catch(err => {
            console.log("Error al realizar la petición", err.message);
        });
         
}

function pasarPagina(pagina) {
    buscarUsuarios2(pagina);
    
}

function InsertarActualizarUsuarios() {
    let nombre = document.getElementById("nombre").value;
    let apellido1 = document.getElementById("apellido_1").value;
    let apellido2 = document.getElementById("apellido_2").value;
    let sexo = document.getElementById("sexo").value;
    let email = document.getElementById("mail").value;
    let movil = document.getElementById("movil").value;
    let login = document.getElementById("login").value;
    let pass = document.getElementById("pass").value;
    let activo = document.getElementById("activo").value;

    // Validación de campos vacíos
    if (
        nombre.trim() === "" &&
        apellido1.trim() === "" &&
        apellido2.trim() === "" &&
        sexo.trim() === "" &&
        email.trim() === "" &&
        movil.trim() === "" &&
        login.trim() === "" &&
        pass.trim() === "" &&
        activo.trim() === ""
    ) {
        alert("Debes ingresar al menos un valor para realizar la inserción.");
        return;
    }

    let datos = [
        { valor: nombre, validacion: validarNombre, mensaje: "El nombre no es válido." },
        { valor: apellido1, validacion: validarApellido, mensaje: "El primer apellido no es válido." },
        { valor: apellido2, validacion: validarApellido, mensaje: "El segundo apellido no es válido." },
        { valor: sexo, validacion: validarSexo, mensaje: "El sexo no es válido." },
        { valor: email, validacion: validarEmail, mensaje: "El correo electrónico no es válido." },
        { valor: movil, validacion: validarMovil, mensaje: "El número de móvil no es válido." },
        { valor: login, validacion: validarLogin, mensaje: "El login no es válido." },
        { valor: pass, validacion: validarPassword, mensaje: "La contraseña no es válida." },
        { valor: activo, validacion: validarActivo, mensaje: "El estado activo no es válido." },
    ];

    let mensajesError = [];
    for (let i = 0; i < datos.length; i++) {
        if (datos[i].valor.trim() !== "" && !datos[i].validacion(datos[i].valor)) {
            mensajesError.push(datos[i].mensaje);
        }
    }

    if (mensajesError.length > 0) {
        alert(mensajesError.join("\n"));
    } else {
            let opciones = { method: "GET" };
            let parametros = "controlador=Usuarios&metodo=insertarAndUpdaterUsuario";
            parametros += "&" + new URLSearchParams(new FormData(document.getElementById("formularioUsuarios"))).toString();
            fetch("C_Ajax.php?" + parametros, opciones)
                .then(res => {
                    if (res.ok) {
                        console.log('respuesta ok2');
                    }else{
                        throw new Error('La socilitud no fue exitosa')
                    }
                })
         opciones = { method: "GET" };
         parametros = "controlador=Usuarios&metodo=buscarUsuarios";
        parametros += "&" + new URLSearchParams(new FormData(document.getElementById("formularioBuscar"))).toString();

        fetch("C_Ajax.php?" + parametros, opciones)
            .then(res => {
                if (res.ok) {
                    console.log('respuesta ok');
                    return res.text();
                }
            })
            .then(vista => {
                document.getElementById("capaResultadosBusqueda").innerHTML = vista;
            })
            .catch(err => {
                console.log("Error al realizar la petición", err.message);
            });
            document.getElementById("formularioBuscar").reset();   
    }
}






function cargarDatosFormulario(id_Usuario, nombre, apellido1, apellido2, sexo, mail, movil, login, activo) {
   
    var camposLlenos = document.getElementById("id_usuario").value !== "";

   
    if (camposLlenos) {
        document.getElementById("id_usuario").value = "";
        document.getElementById("nombre").value = "";
        document.getElementById("apellido_1").value = "";
        document.getElementById("apellido_2").value = "";
        document.getElementById("sexo").value = "";
        document.getElementById("mail").value = "";
        document.getElementById("movil").value = "";
        document.getElementById("login").value = "";
        document.getElementById("activo").value = "";
    } else {
       
        document.getElementById("id_usuario").value = id_Usuario;
        document.getElementById("nombre").value = nombre;
        document.getElementById("apellido_1").value = apellido1;
        document.getElementById("apellido_2").value = apellido2;
        document.getElementById("sexo").value = sexo;
        document.getElementById("mail").value = mail;
        document.getElementById("movil").value = movil;
        document.getElementById("login").value = login;
        document.getElementById("activo").value = activo;
    }
}

