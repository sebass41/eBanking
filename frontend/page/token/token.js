window.onload = async ()=>{
    token = await obtenerToken();
    console.log(token);

    document.getElementById("copiarToken").addEventListener("click", ()=>{
        navigator.clipboard.writeText(token);
        alert("Token copiado al portapapeles");
    })
}

async function obtenerToken(){
    let url = "http://localhost/eBanking/backend/controller/Transaccion.php?fun=g";
    let consulta = await fetch(url);
    let datos = await consulta.json();
    return datos.data;
}

/*function mostrarToken(token){
    let pElementToken = document.getElementById("token");
    pElementToken.innerHTML = token;
}*/

