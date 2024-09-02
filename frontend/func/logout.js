function cerrarSesion() {
    let url = "http://localhost/eBanking/backend/controller/Usuario.php?fun=lo";
    respuesta = fetch(url);
    
    localStorage.removeItem('ci');
    window.location.href = "../login/login.html";
}
