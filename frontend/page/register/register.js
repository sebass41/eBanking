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

    let valido = true;
    if (ciElement.value.length !== 8){
        alert("Cédula incorrecta")
        valido = false;
    }
    
    if (passElement.value !== passConfirmElement.value){
        alert("Las contraseñas con coinciden")
        valido = false;
    }
    
    return valido;
}

