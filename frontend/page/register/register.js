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
                window.location.href = "../login/login.html";
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
    let errorCiElement = document.querySelector("#error-ci");
    let errorPassElement = document.querySelector("#error-password");


    let valido = true;
    if (!validarCI(ciElement.value)){
        errorCiElement.style.display = 'inline';
        valido = false;
    }

    if (!validarPass(passElement)){
        errorPassElement.style.display = 'inline';
        valido = false;
    }

      if (passElement.value !== passConfirmElement.value){
        ciElement.style.display = 'inline';
        valido = false;
      }

    
    return valido;
}


function validarCI(ci) {
  ci = ci.replace(/[.-]/g, '');

  if (ci.length !== 8) {
      return false;
  }

  const coeficientes = [2, 9, 8, 7, 6, 3, 4];
  let suma = 0;

  for (let i = 0; i < 7; i++) {
      suma += parseInt(ci[i]) * coeficientes[i];
  }

  const digitoVerificador = (10 - (suma % 10)) % 10;

  return digitoVerificador === parseInt(ci[7]);
}

function validarPass(password) {
  if (password.length <= 8) {
      return false;
  }

  var hasNumber = /\d/.test(password);

  var hasUpperCase = /[A-Z]/.test(password);

  return hasNumber && hasUpperCase;
}
