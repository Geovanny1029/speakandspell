$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
});

//vista editar usuario
function fun_edit(id)
    {
      var view_url = 'http://localhost:8000/userse';
    
      $.ajax({
        url: view_url,
        type:"GET", 
        data: {"id":id}, 
        success: function(result){
          //console.log(result);
          $("#edit_nombre").val(result.nombre);
          $("#edit_am").val(result.am);
          $("#edit_ap").val(result.ap);
          $("#edit_nacimiento").val(result.nacimiento);
          $("#edit_direccion").val(result.direccion);
          $("#edit_ciudad").val(result.ciudad);
          $("#edit_ocupacion").val(result.ocupacion);
          $("#edit_estudios").val(result.estudios);
          $("#edit_nivel").val(result.nivel);
          $("#edit_descuento").val(result.descuento);
          $("#edit_casa").val(result.casa);
          $("#edit_oficina").val(result.oficina);
          $("#edit_celular").val(result.celular);
          $("#edit_id").val(result.id);
          $ruta = result.ruta_foto;
          if($ruta == "" || $ruta == null){
             $("#edit_f").text("Alta Foto");
          }else{
             $("#edit_f").text("Cambiar Foto"+result.ruta_foto);
          }
        }
      });
    }


//vista editar nivel
function fun_edit_nivel(id)
    {
      var view_url = $("#editarN").val();
    
      $.ajax({
        url: view_url,
        type:"GET", 
        data: {"id":id}, 
        success: function(result){
          //console.log(result);
          $("#edit_nombren").val(result.nombre);
          $("#edit_horario").val(result.horario);
          $("#edit_finicio").val(result.finicio);
          $("#edit_ffin").val(result.ffin);
          $("#edit_costo").val(result.costo);
          $("#editn_id").val(result.id);
        }
      });
    }

  $("#nivel").change(function (event){
    $.get("horario/"+event.target.value+"",function(response,nivel){
      for (var i = 0; i < response.length; i++) {
        $("#horario").append("<option value ='"+response[$i].id+"'>"+response[$i].nombre+"</option>");
      }
    });
  });