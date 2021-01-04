# Instalar theme automáticamente 0.0.0.1-beta
Básicamente este hace una instalación automaticamente, sin acceder 
al panel de adminstración para instalar el theme, pero este debe
estar descomprimido.

Forma para realizar la instalación del theme sin problemas:
* Crean un archivo llamado **install.json** que debe estar dentro del carpeta del theme a instalar y debe estar compuesto de esta manera
``` JSON
{
  "data": {
    "folder": "NOMBRE-DE-CARPETA",
    "name": "NOMBRE-DEL-THEME",
    "author": "NOMBRE-DEL-AUTOR"
  }
}
```
En la parte que dice "**folder**", debe tener el mismo nombre que la carpeta del theme, ej:
carpeta se llama "*mi_nuevo_theme*" entonces se deberá escribir de la misma manera
``` JSON
{
  "data": {
    "folder": "mi_nuevo_theme",
    .....
```

2 - Descargamos el archivo **theme-install.php** y lo suben a la raíz del sitio

3 - Luego buscamos en **header.php**
``` PHP
  $smarty->assign('tsMPs',$tsMP->mensajes);
```
y debajo agregamos
``` PHP
  include TS_ROOT . '/theme-install.php';
```
y eso sería todo por ahora.