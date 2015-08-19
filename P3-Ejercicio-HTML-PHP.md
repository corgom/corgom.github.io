# Desarrollo de aplicaciones web

# Ejercicio

**Keywords**: [HTML5][html5], form, input, post, PHP, ftp, website, url, $_POST[], issset(), [mysqli][mysqli], SQL

## Objetivo

Repasar y aplicar los conceptos y ejercicios ya vistos en clase respecto al tema *Desarrollo de aplicaciones web usando HTML, PHP y MySQL* para avanzar el armado o maquetado de un sitio web funcional online para publicar articulos de un blog.

## Instrucciones

Realiza cada unos de los pasos de forma incremental segun se te indica.

La conexion ftp lo puedes hacer con el cliente ftp de tu preferencia ([FileZilla][1], [CyberDuck][2], etc.). Ya se te proporcionó con anterioridad la información para hacer la conexión a tu sitio ftp, los datos mínimos requeridos son: **url del ftp** (host), **puerto** (port), **usuario** (user) y **contraseña** (password).

Tienes una carpeta local (en tu disco duro o USB) llamada `cms`  o `cmsblog` que debe contener lo que hemos estado trabajando en clase, a esta carpeta de ahora en adelante la llamaremos `CARPETA DE TRABAJO`. Y tienes un carpeta remota ftp que llamaremos `CARPETA PUBLICA`, lo que subas a esa carpeta ftp la puedes ver via un navegador web, apuntado a ella correctamente (más adelante la explicación de como hacer esto).

## Ejercicios que vas a realizar

### ./install.php

1. Borra todo el contenido que tenga tu directorio FTP o `CARPETA PUBLICA`, y sube el *contenido* de tu `CARPETA DE TRABAJO` a dicha `CARPETA PUBLICA`.
   Una vez hecho lo anterior, debes poder visitar tu sitio web apuntando a tu carpeta publica vía http (en vez ftp), que será fiel reflejo de lo que tienes en tu `CARPETA DE TRABAJO` (y que puedes visualizar localmetne usando WAMP):

   ```
   http://[ip_sitio_web]/~corne/[usuario_ftp_sin_@]
   ```

   donde `[usuario_ftp_sin_@]` se corresponde con tu usuario ftp sin la arroba, por ejemplo para ver el sitio web de Jonatan tendríamos:

   ```
   http://[ip_sitio_web]/~corne/jmunoz
   ```

2. Ahora baja el [siguiente archivo][install.php] a tu `CARPETA DE TRABAJO`

3. Instala/crea la base de datos requerido por tu sitio web usando el archivo `./install.php` 
    1. Actualiza la sección de configuracion de conexion a tu base de datos MySQL en el archivo `./install.php` con tus datos de conexion:
    
       ```php
        if (isset($_POST["install"])){

            $dbHost     = "localhost"; # url o direccion de la base ...
            $dbUsuario  = "root";
            $dbPassword = "";
            $dbNombre   = "cmsblog"; # nombre de la base de datos

            ...
       ```
       
       Los datos de conexion usuario actualizados queda como sigue:

       ```php
        if (isset($_POST["install"])){

            $dbHost     = "localhost"; # url o direccion de la base ...
            $dbUsuario  = "corne_[usuario_ftp_sin_@]";
            $dbPassword = "[password_ftp]";
            $dbNombre   = "corne_cmsblog_[usuario_ftp_sin_@]"; # nombre de la base de datos

            ...
       ```

       donde hay que sustituir `[usuario_ftp_sin_@]` y `[password_ftp]` con sus valores respectivos. el valor de `$dbHost` se queda como `localhost` porque la base de datos MySQL que vas a usar es *local* al servidor en donde se ejecutan tus páginas PHP.

       Siguiendo con el ejemplo de Jonatan, tendríamos nuestra sección de configuración actualizado así:

       ```php
        if (isset($_POST["install"])){

            $dbHost     = "localhost"; # url o direccion de la base ...
            $dbUsuario  = "corne_jmunoz";
            $dbPassword = "123456";
            $dbNombre   = "corne_cmsblog_jmunoz"; # nombre de la base de datos

            ...
       ```

       Obvio, el password no es el real.

       Asegurate que los datos son correctos. Si te marca error alguno de los siguientes pasos, regresa a este punto y revisa que todo esté correctamente.

    2. Para ejecutar la instalacion, hay que *correr* el php `./install.php` en el servidor (usando su url completa) para que se realice la creación de la base de datos, tablas y datos de carga inicial, como lo hicimos en clase, la diferencia ahora es que no es `http://localhost/cmsblog/install.php`, sino que hay que apuntar ahora a la url correspondiente: `http://[ip_sitio_web]/~corne/[usuario_ftp_sin_@]/install.php`
    3. Ahora valida que la base de datos se haya creado correctamente:
        1. Actualiza la configuracion de la conexion a la base de datos MySQL en el archivo `./admin.php`, usa los mismos datos de conexión a MySQL que usaste en `./install.php`

        ```php
        <?php

        $db = new mysqli('localhost', 'corne_[usuario_ftp_sin_@]', '[password_ftp]', 'corne_cmsblog_[usuario_ftp_sin_@]'); //con indicacion de nombre de base de datos
        //$db = new mysqli('localhost', 'root', ''); //sin indicacion de nombre de base de datos

        if($db->connect_errno > 0){
            die('No es posible conectarse a la base de datos [' . $db->connect_error . ']');
        }
        ```

        2. Ahora ve a tu sitio web `http://[ip_sitio_web]/~corne/[usuario_ftp_sin_@]/` y logueate en la correspondiente pantalla de *login*.
        3. Si tu login fue exitoso, este debe redirigirte a la pagina `./admin.php` en donde deberás ver el listado de articulos publicados por cada autor, **que fue hasta donde llegamos en la ultima clase**.
        
### ./admin.php

En `./admin.php` actualmente generamos con php una tabla html que contiene los datos consultados de nuestra base de datos. El codigo html generado por php debe ser parecido a (quizás varie en los saltos de linea, pero los tags deben generarse en el orden indicado):

```html
<table>
    <tr>
        <td>aut1</td>
        <td>.</td>
        <td>.</td>
    </tr>
    <tr>
        <td>aut2</td>
        <td>.</td>
        <td>.</td>
    </tr>
    ...
    <tr>
        <td>aut3</td>
        <td>.</td>
        <td>.</td>
    </tr>
</table>
```

### IMG encabezado

1. conseguir/crear imagen para encabezado de blog, medidas: 760px x 150px, puede ser formato jpg, gif o png, que son los formatos que reconocen y pueden mostrar los navegadores por *default*.
2. imagen anterior llamarlo encabezado.png (cambiar la extensión segun el formato elegido) y guardarlo en la carpeta `./imgs/`
3. en `./encabezado.php` incluir tag html `<IMG >` y poner la imagen encabezado.png como en atributo `src`, de manera que obtengas el siguiente resultado al visualizar tu pagina `./admin.php`:

[screenshot]

### index.php

Usando como referencia la consulta a la base de datos MySQL que se hizo en `./admin.php`, modificar `./index.php` de manera que genere el siguiente conjunto de tags HTML intermezclado con el contenido obtenido de la base de datos. El conjunto de tags se debe generar por cada registro regresado por la consulta a MySQL:

```html
<h2>[Titulo del articulo]</h2>
<h3>por: [Autor del articulo]</h3>
<pre><code>
[texto del articulo]
</code></pre>
```

donde dice `[Titulo del articulo]`, `[Autor del articulo]` y `[texto del articulo]` ahí debe aparecer los valores recuperados de la base de datos.



[1]: https://filezilla-project.org/ "FileZilla"
[2]: https://cyberduck.io/?l=es "CyberDuck"
[introHtml]: http://www.desarrolloweb.com/manuales/21/ "Intro HTML"
[html5]: http://www.axtro.es/2011/1/29/12236/manual-de-html5-en-espanol---1-de-3 "HTML 5"
[mysqli]: http://codular.com/php-mysqli "MySQL > mysqli"
[install.php]: 