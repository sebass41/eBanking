window.onload = async () => {
    let cuentas = await obtenerCuentas();
    mostrarCuentas(cuentas.data);
    console.log(cuentas.data);
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
        tBodyCuentas.appendChild(tr); // Añadir la fila a la tabla
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
    let formElement = document.querySelector("#formTrans")
    
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
            alert(datos.msj)
        }else {
            alert(datos.msj)
        }
    }
}
