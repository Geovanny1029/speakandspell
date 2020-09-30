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
function fun_id_alum(id,nivel)
    {
      var view_url = 'http://localhost:8000/userse';
    
      $.ajax({
        url: view_url,
        type:"GET", 
        data: {"id":id,"nivel":nivel}, 
        success: function(result){
          //console.log(result);
          $("#id_alum").val(result.info.id);
          $("#pag_nom_alum").text(result.info.nombre+" "+result.info.ap);
          $("#pag_nivel_alum").text(result.nivel.nombre);
          mes1 = "";
          if(result.pagosins.monto == 0){data = 500;}else{data = 500-result.pagosins.monto;}
          $("#debeinsc").attr('max',data);
          $("#pago").attr('max',result.diferenciapago);
          $("#debeinsc").val("");
          $("#pago").val("");
          
  
          var mes_inicio = result.mes_finicio;
          var mes_final = result.mes_fin;
          var mes_hoy = result.mes_hoy;
          var insc = result.pagosins.estatus;

          //pago inscripcion if si debe inscripcion de lo contrario no asoma campo
            if(insc == 2){
                $("#showpagoinsc").show();
                $("#pag_deuda_insc").text("saldo: "+(500-result.pagosins.monto));
              
            }else{
              $("#showpagoinsc").hide();
            }

          // pagos colegiatura si no se encuentra ningun registro de pago de colegiatura se paga el primer mes
          if(result.pagos == null){
            if(mes_inicio<=mes_hoy){var mespago = mes_hoy;}else{var mespago = mes_inicio;}
              mes1 = mes(mespago);
              $("#showpago1").show();
              $("#showpago2").hide();
              $("#btnpagar").show()
              $("#pag_mes_alum").text(mes1);
          }else{
            var pago = result.pagos.estatus;
            // si el ultimo registro es igual a final de mes del curso 
            if(mes_final == result.pagos.mes && pago == 1 ){
              $("#showpago1").hide();
              $("#showpago2").show();
              $("#btnpagar").hide();
              $("#pago_completo").text("EL alumno ha pagado completo el curso");
            }else
            {
          //si el tipo es colegiatura
            //si tiene pagado el ultimo mes pone fecha siguiente
              if(pago == 1){
                mes1 = mes(result.pagos.mes+1);
                 $("#showpago1").show();
                 $("#showpago2").hide();
                  $("#btnpagar").show();
                 $("#pag_mes_alum").text(mes1);
              }else// si no debe colegiatura y le dice cuanto debe
              {
                mes1 = mes(result.pagos.mes);
                $("#showpago1").show();
                 $("#showpago2").hide();
                 $("#btnpagar").show();
                 $("#pag_mes_alum").text("Debe "+(result.nivel.costo-result.pagos.monto)+"$ SALDO DEL MES DE "+mes1);
              }  
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
  if($id == 12){return "DICIEMBRE";}else
  if($id == 13){return "ENERO";}else
  if($id == 14){return "FEBRERO";}else
  if($id == 15){return "MARZO";}else
  if($id == 16){return "ABRIL";}else
  if($id == 17){return "MAYO";}else
  if($id == 18){return "JUNIO";}else
  if($id == 19){return "JULIO";}else
  if($id == 20){return "AGOSTO";}else
  if($id == 21){return "SEPTIEMBRE";}else
  if($id == 22){return "OCTUBRE";}else
  if($id == 23){return "NOVIEMBRE";}else
  if($id == 24){return "DICIEMBRE";}
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

//vista editar ultimo pago por equivocacion
function cambiarpago(id)
    {
      $.ajax({
        url: '/lastpago',
        type:"GET", 
        data: {"id":id}, 
        success: function(result){
          //console.log(result);
          $("#lastpagoup").val(result.info.monto);
          $("#id_alumlastp").val(result.info.id);
          $("#lastpagoup").attr('max',result.maxp.costo);

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

//select dinamico alta usuario horario nivel
  $(document).ready(function(){
    $("#nivelc").change(function(){
      var nivel = $(this).val();
      $.get('/user/horario/'+nivel, function(data){
//esta el la peticion get, la cual se divide en tres partes. ruta,variables y funcion
        console.log(data);
          var producto_select = '<option value="">Seleccione Horario</option>'
            for (var i=0; i<data.length;i++)
              producto_select+='<option value="'+data[i].id+'">'+data[i].horario+'</option>';

            $("#horarioc").html(producto_select);

      });
    });
  });




//select dinamico para agregar max y min en colegiatura e inscripcion
  $(document).ready(function(){
    $("#horario").change(function(){
      var nivel = $(this).val();
      $.get('horariomax/'+nivel, function(data){
//esta el la peticion get, la cual se divide en tres partes. ruta,variables y funcion
        console.log(data);
           $("#colegio").attr('max',data);
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


//vista deudores
function muestralistadeu()
    {
      var mes = $("#nivellist").val();

     var view_url = 'http://localhost:8000/ListarxDeudores';
      $.ajax({
        url: view_url,
        type:"GET", 
        data: {"mes":mes}, 
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

$("#cambiodenivel").click(function() {

event.preventDefault();
var nivel = $("#horarioc").val();
var alumno = $("#nam_id").val();
var cursoanterior = $("#cursoanter").val();

  if(cursoanterior == nivel){
    alert("El alumno ya termino este nivel selecciona otro");
  }else{
    $.ajax({
        url: '/userchangelevel',
        data: {"nivel": nivel, "alumno": alumno },
        type: 'post',
        beforeSend: function (xhr) { // Add this line
        xhr.setRequestHeader('X-CSRF-Token', $('[name="_token"]').val());
        }, 
        success: function(result)
        {
          alert(result);
          $('#modalcambionivel').modal('hide');
           location.reload(true);
        }
    });
  }

});


$("#editlastpago").click(function() {

event.preventDefault();
var montopago = $("#lastpagoup").val();
var lastpago = $("#id_alumlastp").val();
var colegiatura = $("#id_costocr").val();

  if(montopago <= colegiatura){
    $.ajax({
        url: '/editlastpago',
        data: {"lastpago": lastpago,"montopago":montopago},
        type: 'post',
        beforeSend: function (xhr) { // Add this line
        xhr.setRequestHeader('X-CSRF-Token', $('[name="_token"]').val());
        }, 
        success: function(result)
        {
          alert(result);
          $('#editNModalpe').modal('hide');
           location.reload(true);
        }
    });
  }else{
    alert("El monto debe ser menor o igual a: "+colegiatura);
  }

});