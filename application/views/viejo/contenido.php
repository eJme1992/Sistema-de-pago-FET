<?php if (($estadoc!=="cerrado") AND ($estadoc !==""))  { ?>
 
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

     google.charts.setOnLoadCallback(drawAnthonyChart);
      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
            <?php 
                    $i=0; 
                    $mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                    foreach ($tabla as $row) { $i=$i+1; 
                    ?>
                    ['<?php echo $mes[$i-1]; ?>',<?php echo $row;?>],
                  <?php  } ?>
          
         
        ]);

        // Set chart options
        var options = {'title':'',
                       'width':500,
                       'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
       function drawAnthonyChart() {

        // Create the data table for Anthony's pizza.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Fisico',  <?php echo $reto["1"]; ?>],
          ['Digital', <?php echo $reto["2"]; ?>],
          ['Video',   <?php echo $reto["3"]; ?>],

        ]);

        // Set options for Anthony's pie chart.
        var options = {title:'',
                       width:400,
                       height:300};

        // Instantiate and draw the chart for Anthony's pizza.
        var chart = new google.visualization.PieChart(document.getElementById('cantidad'));
        chart.draw(data, options);
      }

    </script>
<?php } ?>
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Mi Dashboard</li>
      </ol>
      <!-- Icon Cards-->

      <!-- Area Chart Example-->
        <!--
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-area-chart"></i> Area Chart Example</div>
        <div class="card-body">
          <canvas id="myAreaChart" width="100%" height="30"></canvas>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>
        -->
      <div class="row">
        <div class="col-lg-8">
          <!-- Example Bar Chart Card-->
          <div class="panel panel-body">
            <div class="card-header">
              <i class="fa fa-bars" aria-hidden="true"></i> Participantes por Mes</div>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-8 my-auto">
                   <div id="chart_div"></div>

                </div>
                <div class="col-sm-4 text-center my-auto">
                  <div class="h4 mb-0 text-primary"><?php if (($estadoc!=="cerrado") AND ($estadoc !==""))  { echo $sexo["m"]+$sexo['f']; } ?></div>
                  <div class="small text-muted">Total Participantes </div>
                  <hr>
                  <div class="h4 mb-0 text-warning"><?php if (($estadoc!=="cerrado") AND ($estadoc !==""))  { echo $sexo["m"];} ?></div>
                  <div class="small text-muted">Hombres</div>
                  <hr>
                  <div class="h4 mb-0 text-success"><?php if (($estadoc!=="cerrado") AND ($estadoc !==""))  { echo $sexo["f"];} ?></div>
                  <div class="small text-muted">Mujeres</div>
                </div>
              </div>
            </div>
          <!--  <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
            -->
          </div>
         
        <div class="panel  col-lg-6">
          <!-- Example Pie Chart Card-->
          <div class="card mb-3">
            <div class="panel-header">
              <i class="fa fa-pie-chart"></i> Cantidad de trabajos<hr></div>

            <div class="panel-body">
              <div id="cantidad"></div>
            </div>
          <!--  <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>-->
          </div>
          <!-- Example Notifications Card-->

          </div>
        </div>
      </div>