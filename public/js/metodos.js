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


//vista editar usuario
function fun_ChangeUser(id)
    {
      var view_url = 'http://localhost:8000/usersChangeView';
    
      $.ajax({
        url: view_url,
        type:"GET", 
        data: {"id":id}, 
        success: function(result){
          console.log(result);
          $("#edit_nombre_user").val(result.nombre_completo);
          $("#edit_email").val(result.email);
          $("#edit_user").val(result.name);
          $("#edit_contraseña").val(result.backub_contraseña);
          $("#change_id").val(result.id);
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

          var pago = result.pagos.estatus;
          var tipo = result.pagos.tipo;
          var mes_inicio = result.mes_finicio;
          var mes_final = result.mes_fin;

          // si el ultimo registro es igual a final de mes del curso 
          if(mes_final == result.pagos.mes && pago == 1 ){
            $("#showpago1").hide();
            $("#showpago2").show();
            $("#pago_completo").text("EL alumno ha pagado completo el curso");
          }else
          {//si el tipo es colegiatura
            if(tipo == 2){
             
              //si tiene pagado el ultimo mes pone fecha siguiente
              if(pago == 1){
                mes = mes(result.pagos.mes+1);
                 $("#showpago1").show();
                 $("#showpago2").hide();
                 $("#pag_mes_alum").text(mes);
              }else// si no debe colegiatura y le dice cuanto debe
              {
                mes = mes(result.pagos.mes);
                $("#showpago1").show();
                 $("#showpago2").hide();
                 $("#pag_mes_alum").text("Debe "+(result.nivel.costo-result.pagos.monto)+"$ SALDO DEL MES DE "+mes);
              }  
            }else{
              //si no paga mes ya que el ultimo registro que agarro es inscripcion
              mes = mes(mes_inicio);
              $("#showpago1").show();
              $("#showpago2").hide();
              $("#pag_mes_alum").text(mes);
            }
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


//select dinamico listar alumno horario nivel
  $(document).ready(function(){
    $("#nivellist").change(function(){
      var nivel = $(this).val();
      $.get('user/horario/'+nivel, function(data){
//esta el la peticion get, la cual se divide en tres partes. ruta,variables y funcion
        console.log(data);
          var producto_select = '<option value="">Seleccione Horario</option>'
            for (var i=0; i<data.length;i++)
              producto_select+='<option value="'+data[i].id+'">'+data[i].horario+'</option>';

            $("#horariolist").html(producto_select);

      });
    });
  });

//casilla Familiar directo
  $(document).ready(function(){  
    $("#familiard").change(function() {  
        if($("#familiard").is(':checked')) {  
            $("#labelinscripcion").css('display','none'); 
        } else {  
            $("#labelinscripcion").css('display','inline-block'); 
        }  
    });  
  
  });  

  //vista editar nivel
function muestra()
    {
      var fecha = $("#fechaCorte").val();

     var view_url = 'http://localhost:8000/corteC';
      $.ajax({
        url: view_url,
        type:"GET", 
        data: {"fecha":fecha}, 
        success: function(result){
          // console.log(resultado);
          var resultado = result.length;

          html = "";
          if(resultado != 0){
            html += "<table  class='table table-striped' id='tablacorte'> <thead><th><center>Matricula</center></th> <th><center>Alumno</center></th> <th><center>Concepto</center></th> <th><center>Cantidad</center></th> </thead> <tbody>";
            var pago = 0;
            for(i=0;i<result.length;i++){
              pago = pago + result[i].monto;
              if(result[i].tipo == 1){var tipo = "INSCRIPCION";}else{var tipo = "COLEGIATURA";}
              var nombreCompleto = result[i].alumnop.nombre+" "+result[i].alumnop.ap+" "+result[i].alumnop.am;
              html+="<tr><td>"+result[i].alumnop.id+"</td> <td>"+nombreCompleto+"</td> <td>"+tipo+"</td> <td> $"+result[i].monto+"</td></tr>";
              
            }
            html+="<tr><td></td> <td></td> <td></td> <td></td></tr> <tr><td></td> <td></td> <td><b>Total:</b></td> <td><b>$"+pago+"</b></td></tr>";
          }else{
            html+= "<h2>No se encontro ningun Registro</h2>";
          }

          html+="</tbody> </table>";
        $("#corte").html(html);

        }
      });
    }


  //vista editar nivel
function muestralista()
    {
      var horario = $("#horariolist").val();

     var view_url = 'http://localhost:8000/ListarUser';
      $.ajax({
        url: view_url,
        type:"GET", 
        data: {"horario":horario}, 
        success: function(result){
          // console.log(resultado);
          var resultado = result.length;

          html = "";
          if(resultado != 0){
             html+="<div class = 'row'> <a href='/nivellista/"+horario+"' data-lity class='btn btn-success' >Generar Lista</a></div>";
            html += "<table  class='table table-striped' id='tablalistaxnivel'> <thead><th><center>Matricula</center></th> <th><center>Nombre(s)</center></th> <th><center>Apellido Paterno</center></th> <th><center>Appelido Materno</center></th> </thead> <tbody>";
            var pago = 0;
            for(i=0;i<result.length;i++){
              html+="<tr><td>"+result[i].id+"</td> <td>"+result[i].nombre+"</td> <td>"+result[i].ap+"</td> <td> "+result[i].am+"</td></tr>";
            }
          }else{
            html+= "<h2>No se encontro ningun Registro</h2>";
          }

          html+="</tbody> </table>";
         
        $("#listarNivel").html(html);

        }
      });
    }