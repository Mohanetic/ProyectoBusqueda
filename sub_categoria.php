<?php
  include("conexion.php");
  $id_categoria = $_GET['id']
?>

<html lang="en" >
<head>
  <title>CSS Search Box</title>
  
  <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css'>

      <link rel="stylesheet" href="css/style.css">
  
</head>

<body>
  
<br /><br /><br />
<div style="border: 2px solid #448996;border-radius: 200px /8px;height: 0px;width:43%;text-align:left;">
  </div>
    <div style="text-align:center;margin-top:-40px"><h2>Sub Categorías</h2></div> 
  <div style="border: 2px solid #448996;border-radius: 200px /8px;height: 0px;width:43%;float:right;margin-top:-37px;">
</div>

<br /><br /><br />
<?php
  $result = mysqli_query($conexion,"SELECT * FROM sub_categoria WHERE id_categoria = '".$id_categoria."'"); 
  while ($row = mysqli_fetch_row($result)){ 
    echo "<div class='categorias'>";  
    echo"<p style='text-align:center;'>$row[1]</p>"; 
    echo "</div>";
   }        
 ?> 
</body>
</html>
