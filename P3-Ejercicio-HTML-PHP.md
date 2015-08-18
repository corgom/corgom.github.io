# Desarrollo de aplicaciones web

# Ejercicio

**Keywords**: HTML5, form, input, post, PHP, ftp, website, url, $_POST[], issset(), MySQL, SQL

## Objetivo

Repasar los conceptos y ejercicios ya vistos en clase para concluir el armado o maquetado de un sitio web funcional online para publicar articulos de un blog.

# Instrucciones

Realiza cada unos de los pasos de forma incremental segun se te indica.

La conexion ftp lo puedes hacer con el cliente ftp de tu preferencia ([FileZilla][1], [CyberDuck][2], etc.). Ya se te proporcionó con anterioridad la información para hacer la conexión a tu sitio ftp, los datos mínimos requeridos son: **url del ftp** (host), **puerto** (port), **usuario** (user) y **contraseña** (password).

# Ejercicios que vas a realizar

1. Borra todo el contenido que tenga tu directorio FTP, y sube el *contenido* de la carpeta actual llamado **cms** o **cmsblog** que hemos estado trabajando en clase a tu directorio FTP.
2. Con el paso anterior has actualizado tu sitio web online.
3. Instala/crea la base de datos requerido por tu sitio web:
    1. Actualiza los datos de configuracion de conexion a tu base de datos MySQL en el archivo `./install.php`
    
       ```php
       $host = "host";
       $pass = "pass";
       ```
       
    2. Asegurate que los datos son correctos, porque sino, marcará error el siguiente paso.
    3. Ejecuta el php `./install.php` (apunta al archivo en un navegador mediante su URL online) para que se realice la creación de la base de datos, tablas y datos de carga inicial.
    3. Y ahora para validar la correcta creacion de la base de datos:
        1. Actualiza la configuracion de la conexion a la basde de datos MySQL en el archivo `./admin.php`
        2. deberás abrir tu página web ./index.php, y tratar de loguearte en la correspondiente pantalla.
        3. Si tu login fue exitoso, este debe redirigirte a la pagina `./admin.php` en donde deberás ver el listado de articulos publicados por cada autor, **que fue hasta donde llegamos en la ultima clase**


* url online: 


[1]: https://filezilla-project.org/ "FileZilla"
[2]: https://cyberduck.io/?l=es "CyberDuck"
