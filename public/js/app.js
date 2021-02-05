/* FUNCIÓN QUE MUESTRA EL RELOJ */
$(document).ready(function(){
    actualizaReloj();
});
function actualizaReloj(){
    momentoActual = new Date()
    hora = momentoActual.getHours()
    minuto = momentoActual.getMinutes()
    segundo = momentoActual.getSeconds()

    horaImprimible = hora + " : " + minuto + " : " + segundo

    document.getElementById("reloj").innerHTML = horaImprimible;
    setTimeout("actualizaReloj()",1000)
}
