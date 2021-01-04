# Instalar theme/template automáticamente
> Tendrás 2 maneras de poder hacerlo.

**La primera forma:** _Instalar tema automaticamente (desde admin)_
Esta realiza una instalación desde un .zip en el caso que lo subas comprimido, pero tiene que tener dentro del theme un archivo llamado _install.json_ para que este pueda realizar la instalación correcta, y una vez instalado lo podrás activar.

**La segunda forma:** _Instalar tema automaticamente_
Esta realiza una instalación completamente diferente a la primera, ya que esta no pasa por administración para instalar el theme, esta es automatizada. Siempre y cuando tenga el archivo _install.json_ y si no lo contiene no instalará nada, y si lo tiene, antes de instalar el theme hará una comprobación para saber si existe un theme con ese nombre o no, si no existe la instalará y si existe no hará nada.