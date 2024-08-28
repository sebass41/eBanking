window.onload = () => {
    let usuario = JSON.parse(window.localStorage.getItem("usuario")) || [];
    if (usuario.length === 0) {
        ingresar();
    }
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
        
        let respuesta = await fetch(url, config);
        let datos = await respuesta.json();
        console.log(datos);
        if (datos.sucess){
            console.log(datos);
            guardarSesion(datos);
            window.location.href = "http://localhost/eBanking/frontend/page/principal/principal.html";
        }else{
            console.log("No se pudo iniciar sesion");
        }
    }
}


function guardarSesion(usuario){
    usr = usuario.ci;
    window.localStorage.setItem("usuario", JSON.stringify(usr));
}
