window.onload = ()=>{
    crearCuenta();
    depositar();
}

function crearCuenta(){
    let formElement = document.querySelector("#formCuenta")
    
    formElement.onsubmit = async (e) =>{
        e.preventDefault()
        let formData =  new FormData(formElement);
        let url = "http://localhost/eBanking/backend/controller/Cuenta.php?fun=c"

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

function depositar(){
    let formElement = document.querySelector("#formDeposito");
    formElement.onsubmit = async (e)=>{
        e.preventDefault();
        let formData =  new FormData(formElement);
        let url = "http://localhost/eBanking/backend/controller/Cuenta.php?fun=d";

        let config = {
            method: 'POST',
            body: formData
        }

        let respuesta = await fetch(url, config);
        let datos = await respuesta.json();
        console.log(datos);

        if (datos.sucess){
            alert("Se despositó correctamente");
        }else{
            alert("No se pudo realizar el depósito");
        }
    }
}