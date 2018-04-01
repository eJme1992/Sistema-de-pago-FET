<!--
<script>
  function realizaProceso( año,inicio,cierre,premiacion) {
    var msj = "1";
     if (msj==="1"){
        var parametros = {
        "año": año,
        "inicio": inicio,
        "cierre": cierre,
        "premiacion": premiacion
      };
      
      $.ajax( {
        data: parametros, //datos que se envian a traves de ajax
        url: '<?= base_url(); ?>Panel/crear/', //archivo que recibe la peticion
        type: 'post', //método de envio
        beforeSend: function () {
          $( "#resultado" ).html( "<div class='center-block alert alert-success'> Procesando, espere por favor...</div>" );
        },
     success: function(response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
               var str = response;
               var json = JSON.parse(str);
               if (json.status=="ok"){
                $("#resultado").html("<div class='center-block alert alert-success'> " + json.mensaje + ".</div>");
                        
               console.log(response);}
               else{
               $("#resultado").html(json.error);    
               }             
               }
      } );
  }else{ swal("¡Error! ",  msj  , "error");}
    
    
    }
    
    </script>
-->



<!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.html">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Crear concurso</li>
      </ol>
      <div class="row">
          
          
        
          <h2>Crear concurso</h2>
          <p>Aquí podrás crear concursos</p>
       
          
               
 <div class="panel panel-register mx-auto mt-1">
      <div class="panel-header">Datos del concurso</div>
      <div class="panel-body">
          <!-- onSubmit="realizaProceso($('#año').val(),$('#inicio').val(),$('#cierre').val(),$('#premiacion').val(),);"-->
          <form  action="<?= base_url(); ?>Panel/editar/" method="POST">
        
              <div class="col-md-6" style="margin-top:2%;">
                <label for="exampleInputName">Año</label>
                <input value="<?php echo $valores->año;?>"  class="form-control"  required id="año" name="año" type="number" aria-describedby="nameHelp" placeholder="Ingresa el año">
              </div>
             
           
          
              <div class="col-md-6" style="margin-top:2%;">
                <label for="exampleInputLastName">Fecha de Inicio</label>
                <input value="<?php echo $valores->fecha_inicio;?>" class="form-control"  required  id="inicio" name="inicio" type="date" aria-describedby="nameHelp" placeholder="Selecciona la fecha de inicio">
              </div>
           
        
              <div class="col-md-6" style="margin-top:2%;">
                <label for="exampleInputName">Fecha de cierre</label>
                <input value="<?php echo $valores->fecha_final;?>" class="form-control"  required  id="cierre" name="cierre" type="date" aria-describedby="nameHelp" placeholder="Selecciona la fecha de cierre" >
              </div>
              <div class="col-md-6" style="margin-top:2%;">
                <label for="exampleInputLastName">Fecha de premiación</label>
                <input value="<?php echo $valores->fecha_premiacion;?>"  class="form-control"  required   id="premiacion" name="premiacion" type="date" aria-describedby="nameHelp" placeholder="Selecciona la fecha de premiación">
              </div>
              <input type="hidden" name="id" id="id" value="<?php echo $valores->id;?>">
            <div id="resultado"></div>
      
          <div class="col-md-6" style="margin-top:2%;">
              <input type="submit" class="btn btn-primary btn-block" value="Guardar">
          </div>
          <div class="col-md-6" style="margin-top:2%;">
              <a class="btn btn-primary btn-block" href="<?=base_url();?>concurso">Volver</a>
          </div>        
        
            
        </form>

      </div>
    </div>
          
          
          
          
          
          
          
          
          
      </div>