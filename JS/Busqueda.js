function Busqueda(clicked_id){

    var id = clicked_id;

     $.ajax({
            url: "resultados_dom.php",
            method: "POST",
            data: { id: id },
            success: function(data) {
               $('#Contenedor').load('InfoSalaUrg.php');
            }
        });   

};