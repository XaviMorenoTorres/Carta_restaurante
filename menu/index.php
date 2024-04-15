<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/styles.css">
    <title>Menu</title>
    <script src="https://kit.fontawesome.com/7822954312.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" href="img/logo.png">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tilt+Neon&display=swap" rel="stylesheet">
</head>
<body class="fondo">
<?php
if (file_exists('xml/menu.xml')) {
    $menus = simplexml_load_file('xml/menu.xml');
    
} else {
    exit('Error abriendo test.xml.');
    die();
}
?>
  <!-- barra de navegación -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
  <a href="index.php"><img id="logo" src="img/logo.png" ></a>
    <a class="navbar-brand" href="index.php">MENU</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php
        $aux=[];
        foreach($menus->menu as $fila){
            if(!in_array((string)$fila['plato'],$aux)){
                echo '<li class="nav-item">';
                if (isset($_GET['plato']) && $_GET['plato']==(string)$fila['plato']) {
                    echo '<a class="nav-link active" href="?plato='.$fila['plato'].'">'.$fila['plato'].'</a>';
                }
                else {
                    echo '<a class="nav-link" href="?plato='.$fila['plato'].'">'.$fila['plato'].'</a>';
                }
                echo '</li>';
                array_push($aux,(string)$fila['plato']);
            }
        }
        ?>
        
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- slider -->
<div id="carouselExampleIndicators" class="carousel slide">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="./img/foto1.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="./img/foto2.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="./img/foto3.jpg" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<!-- tabla -->
<div>
  <div>
    <table class="table">
      <thead class="thead-light">
        <tr>
          <th scope="col" width="10%" class="titulo1">Plato</th>
          <th scope="col" width="10%" class="titulo2">Precio</th>
          <th scope="col" width="15%" class="titulo3">Ingredientes</th>
          <th scope="col" width="10%" class="titulo4">Calorias</th>
          <th scope="col" width="40%%"class="hidden titulo">Descripción</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if (isset($_GET['plato'])) {
            foreach($menus->menu as $fila){
                if ($_GET['plato']==$fila['plato']) {
                    echo '<tr>';
                    echo '<td>'.$fila->title.'</td>';
                    echo '<td>'.$fila->description.'</td>';                    
                    echo '<td class="hidden">';
                    foreach($fila->ingredientes->caracteristicas as $ign) {
                      if ($ign =='Carne') {
                        echo '<i class="fa-solid fa-bacon" style="color: #e73636;"></i>  ';
                      }
                      elseif ($ign =='Lacteo') {
                        echo '<i class="fa-solid fa-cheese fa-flip-horizontal" style="color: #ece636;"></i>  ';
                      }
                      elseif ($ign =='Vegano') {
                        echo '<i class="fa-solid fa-wheat-awn" style="color: #4fe360;"></i>  ';
                      }
                      elseif ($ign =='Pescado') {
                        echo '<i class="fa-solid fa-fish" style="color: #5d8fe5;"></i>  ';
                      }
                    }
                    echo '</td>';
                    echo '<td>'.$fila->calorias.'</td>';
                    echo '<td>'.$fila->descripcion.'</td>';
                    echo '</tr>';
                }
            }
        }else {
            foreach($menus->menu as $fila){
                echo '<tr>';
                echo '<td>'.$fila->title.'</td>';
                echo '<td>'.$fila->description.'</td>';
                
                echo '<td class="hidden">';
                foreach($fila->ingredientes->caracteristicas as $ign) {
                  if ($ign =='Carne') {
                    echo '<i class="fa-solid fa-bacon" style="color: #e73636;"></i>  ';
                  }
                  elseif ($ign =='Lacteo') {
                    echo '<i class="fa-solid fa-cheese fa-flip-horizontal" style="color: #ece636;"></i>  ';
                  }
                  elseif ($ign =='Vegano') {
                    echo '<i class="fa-solid fa-wheat-awn" style="color: #4fe360;"></i>  ';
                  }
                  elseif ($ign =='Pescado') {
                    echo '<i class="fa-solid fa-fish" style="color: #5d8fe5;"></i>  ';
                  }
                }
                echo '</td>';
                echo '<td>'.$fila->calorias.'</td>';
                echo '<td>'.$fila->descripcion.'</td>';
                echo '</tr>';
            }
        }
        ?>

      </tbody>
    </table>
  </div>
</div>


</body>
</html>