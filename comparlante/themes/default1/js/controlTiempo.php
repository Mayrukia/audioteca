<?php 
	
	/** Acciones que producen una "Autentificacion", en situacion de no estar autentificado, se redirije a la vista de Ingreso. **/
	@session_start();
	
	if($_SESSION["Tiempo"] != 0)
	{
		$inactiveTime = 6;
		$time = time() - $_SESSION["Tiempo"];
		if($time > $inactiveTime)
		{
			$_SESSION["Tiempo"] = 0;
			echo '<script type="text/javascript"> window.location="'.$baseUrl.'";</script>';
		}
	}
	$_SESSION["Tiempo"] = time()-1;

?>


