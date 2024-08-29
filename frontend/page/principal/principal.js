window.onload = async () => {
    let respuesta = await obtenerCuentas();
    let cuentas = respuesta.data;
    mostrarCuentas(cuentas);
    console.log(cuentas);
    mostrarNumCuentas(cuentas);

    transferir();
}

async function actualizarCuentas() {
    let respuesta = await obtenerCuentas();
    let cuentas = respuesta.data;
    mostrarCuentas(cuentas);
    mostrarNumCuentas(cuentas);
}

function mostrarCuentas(datos) {
    let tBodyCuentas = document.querySelector("#tBodyCuentas");
    tBodyCuentas.innerHTML = "";
    datos.forEach(dato => {
        let tr = document.createElement("tr");
        tr.innerHTML += `
            <td>${dato.Num_cuenta}</td>
            <td>${dato.Saldo}</td>
            <td>${dato.Cedula}</td>
        `;
        tBodyCuentas.appendChild(tr); 
    });
}

function mostrarNumCuentas(cuentas) {
    let selectElement = document.querySelector("#cuentaO");

    selectElement.innerHTML = "";
    
    cuentas.forEach(cuenta => {
        let optionElement = document.createElement("option");
        optionElement.value = cuenta.Num_cuenta;
        optionElement.textContent = cuenta.Saldo;
        selectElement.appendChild(optionElement);
    });
}

async function obtenerCuentas() {
    let url = "http://localhost/eBanking/backend/controller/Cuenta.php?fun=m";

    let consulta = await fetch(url);
    let datos = await consulta.json();
    let cuentas = datos;
    return cuentas;
}

function transferir(){
    let formElement = document.querySelector("#formTrans");
    
    formElement.onsubmit = async (e) =>{
        e.preventDefault()
        let formData =  new FormData(formElement);
        let url = "http://localhost/eBanking/backend/controller/Transaccion.php?fun=rt"

        let config = {
            method: 'POST',
            body: formData
        }

        let respuesta = await fetch(url, config);
        let datos = await respuesta.json();
        console.log(datos);
        
        if (datos.sucess){
            alert(datos.msj);
            actualizarCuentas();
        }else {
            alert(datos.msj)
        }
    }
}

function cerrarSesion() {
    let url = "http://localhost/eBanking/backend/controller/Usuario.php?fun=lo";
    respuesta = fetch(url);
    
    localStorage.removeItem('ci');
    window.location.href = "../login/login.html";
}
