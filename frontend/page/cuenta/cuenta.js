window.onload=()=>{
    crearCuenta();
}
function crearCuenta(){

    let formElement = document.querySelector("#form")
    
    formElement.onsubmit = async (e) =>{
        e.preventDefault()
        let formData =  new FormData(formElement);
        let url = "http://localhost/eBanking/backend/controller/Cuenta.php?fun=i"

        let config = {
            method: 'POST',
            body: formData
        }

        if (true){

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