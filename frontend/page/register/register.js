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
   /* if (validate_ci(ciElement.value)){
        alert("Ingrese una cedula valida")
        valido = false;
    }*/

    if (passElement.value.length > 7){

        valido = false;
    }

    if (passElement.value !== passConfirmElement.value){
        
        valido = false;
    }

    
    return valido;
}

/*
function validation_digit(ci){
    var a = 0;
    var i = 0;
    if(ci.length <= 6){
      for(i = ci.length; i < 7; i++){
        ci = '0' + ci;
      }
    }
    for(i = 0; i < 7; i++){
      a += (parseInt("2987634"[i]) * parseInt(ci[i])) % 10;
    }
    if(a%10 === 0){
      return 0;
    }else{
      return 10 - a % 10;
    }
  }
  
  function validate_ci(ci){
    ci = clean_ci(ci);
    var dig = ci[ci.length - 1];
    ci = ci.replace(/[0-9]$/, '');
    return (dig == validation_digit(ci));
  }
  
*/