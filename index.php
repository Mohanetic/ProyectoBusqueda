<?php
  include("conexion.php");
?>

<html lang="en" >
  <head>
    <title>SoloTodoTodo</title>
    
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css'>
    
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/style.css">

  </head>

  <body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">SoloTodoTodo</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Principal <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Alguna wea</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Mas weas</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" method="POST" action="index.php">

          <input name="Buscador" class="form-control mr-sm-2 lolo" type="search" placeholder="Guat ar u lukin 4?" aria-label="Search">
          <input name="Buscar" type="submit" class="btn btn-outline-success my-2 my-sm-0" value="Buscar">

        </form>
      </div>
    </nav>

    <div class="container col-md-12">  
      <div class="row">
        <div class="col-md-12" >  
        <!--Contenido -->
          <?php include("Resultados.php") ?>

        </div>
      </div>
    </div>
    
      <script src="JS/bootstrap.min.js"></script>
      <script src="JS/jquery-3.2.1.min.js"></script>

  </body>
</html>
