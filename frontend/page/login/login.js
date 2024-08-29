window.onload = () => {
    ingresar();
};
async function ingresar(){
    let formElement = document.querySelector("#login");
    formElement.onsubmit = async (e) =>{
        e.preventDefault()
        let formData =  new FormData(formElement);
        let url = "http://localhost/eBanking/backend/controller/Usuario.php?fun=l";

        let config = {
            method: 'POST',
            body: formData
        }
        
        let consulta = await fetch(url, config);
        let respuesta = await consulta.json();
        console.log(respuesta);
        if (respuesta.sucess){
            datos = respuesta.data[0];
            guardarSesion(datos);
            window.location.href = "http://localhost/eBanking/frontend/page/principal/principal.html";
        }else{
            alert(respuesta.msj);
        }
    }
}


function guardarSesion(datos) {
    localStorage.setItem('ci', datos.Cedula);
}
