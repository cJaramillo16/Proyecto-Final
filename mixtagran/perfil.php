<?php
session_start();
if(!isset($_SESSION['logueado']) && $_SESSION['logueado'] == FALSE) {
  header("Location: index.php");
}

include "functions.php";
?>

<!DOCTYPE html>
<html lang="es">  
  <head>    
    <title>Mixtagran</title>    
    <meta charset="UTF-8">
    <meta name="title" content="Photogram">
    <meta name="description" content="Photogram">    
    <link href="css/estilo.css" rel="stylesheet" type="text/css"/> 
    <link href="css/instagram.css" rel="stylesheet" type="text/css"/>  
      
  </head>  
  <body>   

  	<?php

  	if(isset($_GET['username'])) {

  		require "conexion.php";

  		$sqlA = $mysqli->query("SELECT * FROM users WHERE username = '".$_GET['username']."'");
  		$rowA = $sqlA->fetch_array();

  		$sqlB = $mysqli->query("SELECT * FROM publicaciones WHERE user = '".$rowA['id']."' ORDER BY id DESC");
  		$totalp = $sqlB->num_rows;

  	?>

<?php include "header.php"; ?>

<div class="h-content">
	
	<div class="p-top">
		<div class="p-foto"><img src="images/<?php echo $rowA['avatar'];?>" width="180" height="180"></div>
		<div class="p-name">
			<div class="p-user"><?php echo $rowA['username'];?></div>
			<?php if($rowA['verified'] == 1) { ?>
			<div class="p-user"><img src="images/verificado.png"></div>
			<?php } ?>
			<?php if($rowA['id'] == $_SESSION['id']) { ?>
			<div class="p-editar"><button class="button_white">Editar perfil</button></div>		
			<div class="p-config"><img src="images/icons/opciones.png"></div>
			<?php } else { ?>
			<div class="p-editar"><button class="button_blue">Seguir</button></div>
			<?php } ?>
		</div>
		<div class="p-info">
			<div class="p-infor"><b><?php echo $totalp; ?></b> publicaciones</div>
			<div class="p-infor"><b>0</b> seguidores</div>
			<div class="p-infor"><b>0</b> seguidos</div>
		</div>
		<div class="p-nombre"><?php echo $rowA['name'];?></div>
		<div class="p-location">La Paz, Mexico</div>
		<div class="p-description"><?php echo $rowA['bio'];?></div>
	</div>

	<div class="p-mid">

		<?php 
			if($rowA['private_profile'] == 1 AND $rowA['id'] != $_SESSION['id'])
				{echo "Si deseas ver sus fotos o videos sigue a este usuario";}
			else {
		?>

		<?php
		while($rowC = $sqlB->fetch_array()) {
			$sqlD = $mysqli->query("SELECT * FROM archivos WHERE publicacion = '".$rowC['id']."'");
			$rowD = $sqlD->fetch_array();
		?>
			<div class="p-pub <?php echo $rowD['filtro']; ?>" style="background-image: url('archivos/<?php echo $rowD['ruta']; ?>');"></div>
		<?php } ?>

		<?php } ?>


	</div>

</div>

<?php } ?>

  </body>  
</html>