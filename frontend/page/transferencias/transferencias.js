window.onload = async ()=>{
    let respuesta = await obtenerTransferencias();
    let transferencias = respuesta.data;
    mostrarTransferencias(transferencias);
}

async function obtenerTransferencias() {
    let url = "http://localhost/eBanking/backend/controller/Transaccion.php?fun=mt";

    let consulta = await fetch(url);
    let datos = await consulta.json();
    let cuentas = datos;
    return cuentas;
}

function mostrarTransferencias(datos) {
    let tBodyCuentas = document.querySelector("#tBodyTrans");
    tBodyCuentas.innerHTML = "";
    datos.forEach(dato => {
        let tr = document.createElement("tr");
        tr.innerHTML += `
            <td>${dato.Id_transaccion}</td>
            <td>${dato.Monto}</td>
            <td>${dato.Concepto}</td>
            <td>${dato.Fecha}</td>
            <td>${dato.Cedula}</td>
            <td>${dato.Cuenta_origen}</td>
            <td>${dato.Cuenta_destino}</td>
        `;
        tBodyCuentas.appendChild(tr); 
    });
}