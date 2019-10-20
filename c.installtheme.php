<?php if ( ! defined('TS_HEADER')) exit('No se permite el acceso directo al script');
/**
 * Modelo para el control instalar themes
 *
 * @name    c.installtheme.php
 * @author  Miguel92
 */
class tsInstallTheme {
	function newTheme() {
		global $tsCore;
		//
		if ($_FILES["zip_file"]["name"]) {
			//obtenemos datos de nuestro ZIP
			$nombre = $_FILES["zip_file"]["name"];
			$ruta = $_FILES["zip_file"]["tmp_name"];
			$tipo = $_FILES["zip_file"]["type"];
			// Función descomprimir ficheros en formato ZIP
			$nombresFichZIP = array();
			$zip = new ZipArchive;
			//en la función open se le pasa la ruta de nuestro archivo (alojada en carpeta temporal)
			if ($zip->open($ruta) === TRUE) {
				for($i = 0; $i < $zip->numFiles; $i++) {
					//obtenemos ruta que tendrán los documentos cuando los descomprimamos
					$nombresFichZIP['tmp_name'][$i] = '../../themes/'.$zip->getNameIndex($i);
					//obtenemos nombre del fichero
					$nombresFichZIP['name'][$i] = $zip->getNameIndex($i);
			   }
			   $name = str_replace('/', '', $zip->getNameIndex(0));
				$UrlTheme = $tsCore->settings['url'].'/themes/'.$name;				
				$install = '../../themes/'.$name.'/install.php';				
				$zip->extractTo('../../themes/');
				$zip->close();
				// LEEMOS EL ARCHIVO INSTALL
				$archivo = fopen($install,'r');
        		while ($linea = fgets($archivo)) {
					// echo $linea.'<br/>';
				   $aux[] = $linea;    
				   $numlinea++;
				}
				fclose($archivo);
				echo '<pre>';
				//print_r($aux);
				$ar = array("$", "tema", "'", "[", "]", "'", "nombre", "copy", "=", ";", "  ", "\n", "\r");
				$Autor = str_replace($ar, '', $aux[24]);
				$Nombre = str_replace($ar, '', $aux[12]);
				echo 'Copyright: <b>'.$Autor.'</b><br>';
				echo 'Theme: <b>'.$Nombre.'</b><br>';
				echo 'Enlace: <b>'.$UrlTheme.'</b><br>';
				echo '</pre>';
				db_exec(array(__FILE__, __LINE__), 'query', 'INSERT INTO `w_temas` (`t_name`, `t_url`, `t_path`, `t_copy`) VALUES (\'' . $tsCore->setSecure($Nombre) . '\', \'' . $tsCore->setSecure($UrlTheme) . '\', \'' . $tsCore->setSecure($Nombre) . '\', \'' . $tsCore->setSecure($Autor) . '\')');
			} else return 'Ocurri&oacute; un error al subir el archivo, int&eacute;ntalo m&aacute;s tarde';			
		} else return "1: El theme ha sido instalado correctamente.";
	}
}
