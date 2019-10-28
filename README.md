# Instalar theme automáticamente RC 0.2.7
Básicamente lo que debe hacer es instalar el theme automáticamente, sin necesidad de escribir el nombre de la carpeta del theme para que este se instale, ya que de este modo lo hará todo por ti y ya quedaría a tu disposición si lo activan o no!

1 - Subimos el **c.installtheme.php** a inc/class/

2 - Luego buscamos en inc/php/ajax/**ajax.admin.php**
``` PHP
      'admin-nicks-change' => array('n' => 4, 'p' => ''),
      'admin-blacklist-delete' => array('n' => 4, 'p' => ''),
      'admin-badwords-delete' => array('n' => 4, 'p' => ''),
```
y debajo agregar
``` PHP
       'admin-tema' => array('n' => 2, 'p' => 'tema'),
       'admin-instalar-tema' => array('n' => 2, 'p' => ''),
```
más abajo buscamos
``` PHP
       case 'admin-badwords-delete':
	 //<---
	   echo $tsAdmin->deleteBadWord();
	 //--->
        break;
```
y debajo pegamos
``` PHP
      case 'admin-tema':
	 //<---
	     $smarty->assign("tsTemas",$tsAdmin->getTemas());
	 //--->
       break;
        case 'admin-instalar-tema':
         //<--
            include("../class/c.installtheme.php");
            $tsInstallTheme = new tsInstallTheme();
            echo $tsInstallTheme->newTheme();
          //-->
        break;
```
3 - Subimos el **installTheme.js** a SUTHEME/js

4 - Luego ir a SUTHEME/templates/admin_mods/m.admin_temas.tpl y debajo de
``` HTML
<input type="button"  onclick="location.href = '{$tsConfig.url}/admin/temas?act=nuevo'"value="Instalar nuevo tema" class="btn_g btnOk" style="margin-left:280px;">
```
pegamos esto
``` HTML
   <div id="form_upload">
      <form id="New_upload" name="theme" action="{$tsConfig.url}/admin-instalar-tema.php" method="post" enctype="multipart/form-data">
         <div id="Select_file">
            <a href="#" onclick="javascript: void(0);"class="btn btn-success btn-sm">Seleccionar archivo<input type="file" name="zip_file" id="New_file" /></a>
         </div>
         <div class="install">
            <div class="result_text"></div>
            <input type="submit" value="Subir archivo" id="start_upload" class="Fbtn btn btn-info btn-sm" style="display: none;" />
         </div>
      </form>
      <div id="progress"><div id="bar"></div><div id="percent">0%</div></div><div id="message"></div>
   </div>
   <script src="{$tsConfig.js}/installTheme.js?{$smarty.now}"></script>
```
5 - Por último en admin.css agregaremos esto al final
``` CSS
/************* UPLOAD PROGRESS ************/
#form_upload {
  position: relative;
  margin-bottom: 10px;
} 
#form_upload form #Select_file {
  position: relative;
}
#form_upload form #Select_file #New_file {
  position: absolute;
  height: 53px;
  width: 100%px;
  left: 0;
  top: 0;
  opacity: 0;
}
#form_upload form .install {
    position: absolute;
    width: 400px;
    z-index: 99;
    top: -4px;
    right: 0;
}
#form_upload form .install .result_text {
    display: block;
    font-weight: 600;
    padding: 2px 6px;
}
#form_upload form .install #start_upload {
    float: right;
    margin: -2.3em 6px 10px 6px;
}
#form_upload form #Select_file .list_text {
  width: auto;
  margin: 6px;
  background-color: #3F7B13;
  border-radius: 6px;
  color: #EEE;
  padding: 8px 0;
  display: block;
  text-transform: uppercase;
  font-weight: 800;
}
#form_upload form #Select_file .list_text:hover {
  background-color: #3F7B13CC;
}
#form_upload form #Select_file .result_text {
  margin: 5px;
  display: none;
  color: #333;
  padding: 8px;
}
#form_upload form input[type="submit"] {
  width: 30%;
  display: inline-block;
  margin: 0;
  margin-bottom: 7px;
}
#form_upload #message.upload_ok {
  padding: 5px;
  border: solid 1px #92D38C;
  margin-bottom: 10px;
  color: green;
  background: #E8FFE7;
  border-radius: 5px;
}
#form_upload #message.upload_error {
  padding: 5px;
  border: solid 1px #D38C8C;
  margin-bottom: 10px;
  color: #CC2C2C;
  background: #FFE7E7;
  border-radius: 5px;
}
#form_upload #progress {
  display:none;
    width: 400px;
  margin: 10px 0;
  height: 23px;
  position: relative;
  background: #333;
}
#form_upload #progress #bar {
  height: 100%;
  width: 0%;
  position: absolute;
  left: 0;
  top: 0;
  background: #73c822;
  box-shadow: inset 0 0 13px rgba(0, 0, 0, 0.5);
  transition: all 0.3s ease-in-out;
  z-index: 2;
}

#form_upload #progress #percent {
  position: relative;
  z-index: 3;
  color: white;
  font-weight: bold;
  text-align: center;
}
```
