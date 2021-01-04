<?php 

/**
 * @author Miguel92
 * @copyright 2021
 * @name Theme Install
 * @purpose: Instalar un theme/template sin acceder a la administración
 * @version 0.0.0.1-beta
*/

# Buscaremos la ruta de la carpeta "themes"
$themes = opendir( TS_ROOT . "/themes" );

# Luego revisaremos las carpetas existentes
while ($carpeta = readdir($themes)) {
	if($carpeta == '.' || $carpeta == '..') continue;
   # Buscamos el archivo .json por carpeta
   $theme = opendir(TS_ROOT . '/themes/' . $carpeta);
	$archivo = $tsCore->settings['url'] . "/themes/" . $carpeta;
   while ($json = readdir($theme)) {
		if($json == 'install.json'):
			# Decodificamos el json y obtenemos el contenido
   		$decode = json_decode(file_get_contents($archivo.'/'.$json), true);
   		# Buscamos si existe el theme
   		$path = $decode['data']['folder'];
   		$sql = db_exec('num_rows', db_exec(array(__FILE__, __LINE__), 'query', "SELECT t_path FROM w_temas WHERE t_path = '{$path}'"));
   		# Ya que no existe, lo instalamos.
   		if($sql == 0):
   			$inf = $decode['data'];
   			$url = $tsCore->settings['url'] . "/themes/" . $inf['folder'];
   			# Insertamos los datos del nuevo theme
   			db_exec(array(__FILE__, __LINE__), 'query', "INSERT INTO w_temas (t_name, t_url, t_path, t_copy) VALUES('{$inf['name']}', '{$url}', '{$inf['folder']}', '{$inf['author']}')");
   		endif;

   	endif;
   }

}