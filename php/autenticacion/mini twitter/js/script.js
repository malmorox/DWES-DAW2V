function habilitarBoton() {
    var tweet = document.getElementById("tweet").value;
    var botonPostear = document.getElementById("boton-postear");
    
    if (tweet.trim() !== "") {
        botonPostear.disabled = false;
    } else {
        botonPostear.disabled = true;
    }
}