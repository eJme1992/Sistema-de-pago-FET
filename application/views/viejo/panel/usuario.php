

  <div id="page-wrapper" >
  <div style="margin-top: 2%;">
  <h2> Usuarios Registrados</h2>
     <table class="table table-striped">
    <thead>
      <tr>
        <th>Id</th>
        <th>Nombre de usuario</th>
        <th>Nombre completo</th>
        <th>E-mail</th>
        <th>Telefono</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    
    foreach ($datos as $key ) { ?>
    
      <tr>
        <td><?=$key->id; ?></td>
        <td><?=$key->user_name;?></td>
        <td><?=$key->nombre." ".$key->apellido;?></td>
        <td><?=$key->correo;?></td>
        <td><?=$key->telefono;?></td>
      </tr>
      
      <?php } ?>
    </tbody>
  </table>
  </div>
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    

</body>
