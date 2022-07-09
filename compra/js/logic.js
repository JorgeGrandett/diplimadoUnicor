function sumar (pos) {

    var precio = document.getElementById("prec"+pos).value;
    var cantidad = document.getElementById("cant"+pos).value;

    precio = parseInt(precio, 10);
    cantidad = parseInt(cantidad, 10);
    cantidad++;

    document.getElementById("cant"+pos).value = (cantidad);

    document.getElementById("impo"+pos).value = (precio*cantidad);

    actualizarBase();
}

function restar (pos) {
    var precio = document.getElementById("prec"+pos).value;
    var cantidad = document.getElementById("cant"+pos).value;

    precio = parseInt(precio, 10);
    cantidad = parseInt(cantidad, 10);
    if(cantidad > 0) {
        cantidad--; 
    }

    document.getElementById("cant"+pos).value = (cantidad);

    document.getElementById("impo"+pos).value = (precio*cantidad);

    actualizarBase();
}

function actualizarBase () {
    var resume_table = document.getElementById("tabla1");
    var cont = 0;

    for (var i = 1, row; row = resume_table.rows[i]; i++) {
        var importe = document.getElementById("impo"+i).value;
        cont += parseInt(importe, 10);
    }

    document.getElementById("base").value = cont;

    document.getElementById("iva").value = (cont*0.19);

    document.getElementById("total").value = (cont+(cont*0.19));

}