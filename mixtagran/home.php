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
    <title>Mixtagram</title>    
    <meta charset="UTF-8">
    <meta name="title" content="Photogram">
    <meta name="description" content="Photogram">    
    <link href="css/estilo.css" rel="stylesheet" type="text/css">  
    <link href="css/instagram.css" rel="stylesheet" type="text/css">   
  </head>  
  <body>   

<?php
require("conexion.php");

$consultaA = "SELECT confirmed FROM users WHERE username = '".$_SESSION['username']."'";
$resultadoA = $mysqli->query($consultaA);
$row = $resultadoA->fetch_array();

if($row['confirmed'] == 0) {
	
}

$mysqli->close();
?> 

<?php include "header.php"; ?>

<div class="h-content">
	<div class="h-left">

		<?php
		require "conexion.php";

		$sqlA = $mysqli->query("SELECT * FROM publicaciones ORDER BY id DESC");
		while($rowA = $sqlA->fetch_array()) {
			$sqlB = $mysqli->query("SELECT * FROM users WHERE id = '".$rowA['user']."'");
				$rowB = $sqlB->fetch_array();
			$sqlC = $mysqli->query("SELECT * FROM archivos WHERE publicacion = '".$rowA['id']."'");
				$rowC = $sqlC->fetch_array();
		?>

			<div class="hl-cont">
				<div class="hl-top">
					<div class="hl-profile">
						<div class="hl-pic"><img src="images/<?php echo $rowB['avatar']; ?>" width="50" height="50"></div>
					</div>
					<div class="hl-username">
						<div class="hl-name"><?php echo $rowB['username']; ?></div>
						
					</div>
				</div>	
				<div class="hl-middle">
					<img src="archivos/<?php echo $rowC['ruta']; ?>" width="100%" class="<?php echo $rowC['filtro']; ?>">
				</div>	
							
			</div>

		<?php } ?>

	</div>

	<div class="h-right">		

		<div class="hl-menu">
			<div class="hl-icon"><img src="images/icons/lupa.png" width="50"></div>
			<div class="hl-icon"><a href="subir.php"><img src="images/icons/mas.png" width="50" title ="Sube una foto ó video" ></a></div>
			<div class="hl-icon"><img src="images/icons/corazon.png" width="50"></div>
		</div>
		
		<div class="hr-top">
			<div class="hr-profile">
				<div class="hr-pic"><a href="perfil.php?username=<?php echo $_SESSION['username'];?>"><img src="images/<?php datos_usuario($_SESSION['id'],'avatar'); ?>" width="60" height="60"></a></div>
			</div>
				<div class="hr-username">
					<div class="hr-name"><a href="perfil.php?username=<?php echo $_SESSION['username'];?>"><?php echo $_SESSION['username'];?></a></div>
				<div class="hr-nombre"><?php datos_usuario($_SESSION['id'],'name'); ?></div>
			</div>	
		</div>	
	</div>
</div>



  </body>  
</html>