window.onload = ()=>{
    insertar();
}

async function insertar(){

    let formElement = document.querySelector("#form")
    
    formElement.onsubmit = async (e) =>{
        e.preventDefault()
        let formData =  new FormData(formElement);
        let url = "http://localhost/eBanking/backend/controller/Usuario.php?fun=i"

        let config = {
            method: 'POST',
            body: formData
        }

        if (validarDatos()){

            let respuesta = await fetch(url, config);
            let datos = await respuesta.json();
            console.log(datos);
            
            if (datos.sucess){
                alert("Se registró correctamente")
            }else {
                alert("No se pudo registrar")
            }
        }

    }
}

function validarDatos(){
    let ciElement = document.querySelector("#ci");
    let passElement = document.querySelector("#pass");
    let passConfirmElement = document.querySelector("#passConfirm");
    let nameElement = document.querySelect("#name");


    let valido = true;
    if (ciElement.value.length !== 8){
        alert("asd")
        valido = false;
    }

    if (passElement.value.length > 7){

        valido = false;
    }

    if (passElement.value !== passConfirmElement.value){
        
        valido = false;
    }

    
    return valido;
}

