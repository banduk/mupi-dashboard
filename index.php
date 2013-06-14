<!DOCTYPE html>
<!--[if lt IE 7]>       <html class="no-js lt-ie9 lt-ie8 lt-ie7">   <![endif]-->
<!--[if IE 7]>          <html class="no-js lt-ie9 lt-ie8">          <![endif]-->
<!--[if IE 8]>          <html class="no-js lt-ie9">                 <![endif]-->
<!--[if gt IE 8]><!-->  <html class="no-js">                        <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Relatório</title>
  <meta name="description" content="Mupi escola: Relatório">
  <meta name="viewport" content="width=device-width">
  <link type="text/css" rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link type="text/css" rel="stylesheet" href="assets/css/bootstrap-responsive.min.css">
  <link type="text/css" rel="stylesheet" href="assets/css/font-awesome.min.css">
  <link type="text/css" rel="stylesheet" href="assets/css/style.css">
  <link type="text/css" rel="stylesheet" href="assets/css/DT_bootstrap.css"/>
  <link rel="stylesheet" href="assets/css/responsive-tables.css">
  
  <link rel="stylesheet" href="assets/css/theme.css">


  <script src="assets/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <!--[if IE 7]>
    <link type="text/css" rel="stylesheet" href="assets/css/font-awesome-ie7.min.css"/>
    <![endif]-->

    
  </head>
  <body>
    <?php include 'mixpanel.php'; ?>
    <!-- BEGIN WRAP -->
    <div id="wrap">


      <!-- BEGIN TOP BAR -->
      <div id="top">
        <!-- .navbar -->

        <div class="navbar navbar-inverse navbar-static-top">
          <div class="navbar-inner">
            <div class="container-fluid">
              <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </a>
              <a class="brand" href="index.php">Mupi</a>
            </div>
          </div>
        </div>
        <!-- /.navbar -->
      </div>
      <!-- END TOP BAR -->


      <!-- BEGIN HEADER.head -->
      <header class="head">
        <!-- ."main-bar -->
        <div class="main-bar">
          <div class="container-fluid">
            <div class="row-fluid">
              <div class="span12">
                <h3><i class="icon-home"></i> Relat&oacute;rio </h3>
              </div>
            </div>
            <!-- /.row-fluid -->
          </div>
          <!-- /.container-fluid -->
        </div>
      <!-- /.main-bar -->
      </header>
      <!-- END HEADER.head -->

<!-- BEGIN LEFT  -->
<div id="left">
  <!-- .user-media -->
  <div class="media user-media">
    <a href="" class="user-link">
      <img class="img-polaroid"
        src='http://www.gravatar.com/avatar/<?php echo md5($u_email); ?>' />
    </a>

    <div class="media-body">
      <h5 class="media-heading"><?php $u_name ?></h5>

      <ul class="unstyled user-info">
        <li><strong>Nome</strong><br/>
          <i class="icon-user"></i>
            <?php 
              echo $u_name; 
            ?>
        </li>
        <li><strong>Ultimo Accesso</strong><br/>
          <i class="icon-calendar"></i>
            <?php 
              echo date_format(date_create($u_last), 'd/m/Y H:i:s'); 
            ?>
        </li>
      </ul>
    </div>
  </div>
</div>
<!-- END LEFT -->

<!-- BEGIN MAIN CONTENT -->
<div id="content">
  <!-- .outer -->
  <div class="container-fluid outer">
    <div class="row-fluid">
      <!-- .inner -->
      <div class="span12 inner">
        <div class="tac">
          <ul class="stats_box">
            <li>
              <div class="stat_text">
                <strong>Acessos</strong>
                Lições
                <span class="percent">
                  <?php
                    echo current($totAsArray);
                  ?>
                </span>
              </div>
            </li>
          </ul>
        </div>

        <hr>

        <div class="row-fluid">
            <div class="span12">
                <div class="box">
                    <header>
                        <h5>Tabela de acessos</h5>
                    </header>
 
                    <div id="collapse4" class="body">
                      <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
                        <thead>
                          <tr>
                            <th>Lição</th>
                            <th>Semana começando em</th>
                            <th>Acessos</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            foreach($access as $lesson => $_access)  {
                              if($_access){
                                foreach ($_access as $date => $count) {
                                   if($count != 0)
                                   echo "<tr>"
                                      ."<td>". $lesson . "</td>"
                                      ."<td>". 
                                        date_format(date_create($date), 'd/m')                                        
                                      . "</td>"
                                      ."<td>". $count . "</td>"
                                    ."</tr>"; 
                                }                               
                              }
                            }
                          ?>
                        </tbody>
                      </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row-fluid">
          <div class="span12">
            <div class="box">
              <header>
                <h5>Gráfico de acessos</h5>
              </header>
              <div class="span8" id="acessos" style="height: 250px;"></div>
              <div id="legend" class="span3"></div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.inner -->
    </div>
    <!-- /.row-fluid -->
  </div>
  <!-- /.outer -->
</div>
      <!-- END CONTENT -->

</div>


  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery-1.9.1.min.js"><\/script>')</script>

  <script src="assets/js/vendor/jquery-migrate-1.1.1.min.js"></script>

  <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js"></script>
  <script>window.jQuery.ui || document.write('<script src="assets/js/vendor/jquery-ui-1.10.0.custom.min.js"><\/script>')</script>


  <script src="assets/js/vendor/bootstrap.min.js"></script>

  <script src="assets/js/lib/jquery.tablesorter.min.js"></script>
  <script type="text/javascript" src="assets/js/lib/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="assets/js/lib/DT_bootstrap.js"></script>
  <script src="assets/js/lib/responsive-tables.js"></script>

  <script type="text/javascript">
      $(function() {
          metisTable();
      });
  </script>

  <script src="assets/js/lib/jquery.sparkline.min.js"></script>
  <script src="assets/js/lib/flot/jquery.flot.js"></script>
  <script src="assets/js/lib/flot/jquery.flot.pie.js"></script>
  <script src="assets/js/lib/flot/jquery.flot.selection.js"></script>
  <script src="assets/js/lib/flot/jquery.flot.resize.js"></script>
  <script src="assets/js/lib/flot/jquery.flot.time.js"></script>
  
  <script src="assets/js/main.js"></script>

  <script type="text/javascript">
  $(function() {
    dashboard();    
  });
  </script>
</body>
</html>



