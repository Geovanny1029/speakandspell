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
          $("#edit_nombre").val(result.info.nombre);
          $("#edit_am").val(result.info.am);
          $("#edit_ap").val(result.info.ap);
          $("#edit_nacimiento").val(result.info.nacimiento);
          $("#edit_direccion").val(result.info.direccion);
          $("#edit_ciudad").val(result.info.ciudad);
          $("#edit_ocupacion").val(result.info.ocupacion);
          $("#edit_estudios").val(result.info.estudios);
          $("#edit_nivel").val(result.nivel.nombre);
          $("#edit_horario").val(result.info.nivel);
          $("#edit_descuento").val(result.info.descuento);
          $("#edit_casa").val(result.info.casa);
          $("#edit_oficina").val(result.info.oficina);
          $("#edit_celular").val(result.info.celular);
          $("#edit_id").val(result.info.id);
          $ruta = result.info.ruta_foto;
          if($ruta == "" || $ruta == null){
             $("#edit_f").text("Alta Foto");
          }else{
             $("#edit_f").text("Cambiar Foto"+result.info.ruta_foto);
          }
        }
      });
    }

//vista id de alumno
function fun_id_alum(id)
    {
      var view_url = 'http://localhost:8000/userse';
    
      $.ajax({
        url: view_url,
        type:"GET", 
        data: {"id":id}, 
        success: function(result){
          //console.log(result);
          $("#id_alum").val(result.info.id);
          $("#pag_nom_alum").text(result.info.nombre+" "+result.info.ap);
          $("#pag_nivel_alum").text(result.nivel.nombre);

          var pago = result.pagos.estatus
          var tipo = result.pagos.tipo
          
          if(tipo == 2){
            if(pago == 1){
              mes = mes(result.pagos.mes+1);
               $("#pag_mes_alum").text(mes);
            }else{
              mes = mes(result.pagos.mes);
               $("#pag_mes_alum").text("Debe "+(result.nivel.costo-result.pagos.monto)+"$ SALDO DEL MES DE "+mes);
            }  
          }else{
            mes = mes(result.pagos.mes);
            $("#pag_mes_alum").text(mes);
          }


        }
      });
    }


function mes($id){
    
  if($id == 1){return "ENERO";}else
  if($id == 2){return "FEBRERO";}else
  if($id == 3){return "MARZO";}else
  if($id == 4){return "ABRIL";}else
  if($id == 5){return "MAYO";}else
  if($id == 6){return "JUNIO";}else
  if($id == 7){return "JULIO";}else
  if($id == 8){return "AGOSTO";}else
  if($id == 9){return "SEPTIEMBRE";}else
  if($id == 10){return "OCTUBRE";}else
  if($id == 11){return "NOVIEMBRE";}else
  if($id == 12){return "DICIEMBRE";}
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

//select dinamico alta usuario horario nivel
  $(document).ready(function(){
    $("#nivel").change(function(){
      var nivel = $(this).val();
      $.get('horario/'+nivel, function(data){
//esta el la peticion get, la cual se divide en tres partes. ruta,variables y funcion
        console.log(data);
          var producto_select = '<option value="">Seleccione Horario</option>'
            for (var i=0; i<data.length;i++)
              producto_select+='<option value="'+data[i].id+'">'+data[i].horario+'</option>';

            $("#horario").html(producto_select);

      });
    });
  });


//select dinamico edit usuario horario nivel
  $(document).ready(function(){
    $("#edit_nivel").change(function(){
      var nivel = $(this).val();
      $.get('user/horario/'+nivel, function(data){
//esta el la peticion get, la cual se divide en tres partes. ruta,variables y funcion
        console.log(data);
          var producto_select = '<option value="">Seleccione Horario</option>'
            for (var i=0; i<data.length;i++)
              producto_select+='<option value="'+data[i].id+'">'+data[i].horario+'</option>';

            $("#edit_horario").html(producto_select);

      });
    });
  });

  $(document).ready(function(){  
    $("#familiard").change(function() {  
        if($("#familiard").is(':checked')) {  
            $("#labelinscripcion").css('display','none'); 
        } else {  
            $("#labelinscripcion").css('display','inline-block'); 
        }  
    });  
  
  });  