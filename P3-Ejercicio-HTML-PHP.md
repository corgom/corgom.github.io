### Desarrollo de aplicaciones web

# Ejercicios prácticos

**Keywords**: [`HTML5`][html5], `form`, `input`, `post`, `PHP`, `ftp`, `website`, `url`, `$_POST[]`, `issset()`, [`mysqli`][mysqli], `SQL`

## Objetivo

Aplicar los conceptos y ejercicios vistos en clase sobre el tema *Desarrollo de aplicaciones web usando HTML, PHP y MySQL*, para publicar un sitio web funcional que permite crear un blog.

## Instrucciones

Realiza cada unos de los pasos de forma incremental segun se te indica.

La conexion ftp lo puedes hacer con el cliente ftp de tu preferencia ([FileZilla][1], [CyberDuck][2], etc.). Ya se te proporcionó con anterioridad la información para hacer la conexión a tu sitio ftp, los datos mínimos requeridos son: **url del ftp** o *host*, **puerto** o *port* (default: 21), **usuario** o *user* y **contraseña** o *password*.

### CARPETA DE TRABAJO

Tienes una carpeta local (en tu disco duro o USB) llamada `cms`  o `cmsblog` que debe contener lo ultimo que trabajamos en clase, a esta carpeta de ahora en adelante la llamaremos **`CARPETA DE TRABAJO`** (que es la carpeta que copiabamos a la ruta `.\wamp\www\` y podíamos visualizar en `http://localhost/cms` usando WAMP).

### CARPETA PUBLICA

Y tienes un carpeta remota ftp que llamaremos **`CARPETA PUBLICA`**. Esta es la carpeta que ves cuando te conectas al servidor ftp, cuyos datos de conexion se te proporcionó en alguna de las clases. Lo que subas a esta carpeta lo puedes ver vía navegador web, apuntado a ella correctamente:

```
http://[ip]/~corne/[usuario_ftp_sin_@]
```

donde `[usuario_ftp_sin_@]` se corresponde con tu usuario ftp pero sin incluir la arroba y lo que viene despues, por ejemplo para ver el sitio web de Jonatan escribimos en el navegador:

```
http://[ip]/~corne/jmunoz
```

![Imgur](http://i.imgur.com/t3MUla6.png)

En el url anterior, unicamente falta sustituir `[ip]` que se corresponde con la IP del servidor ftp mencionado anteriormente.

A la url de tu sitio web le llamaremos de ahora en adelante `WEB SITE`.
   
## Ejercicios

### ./install.php

1. Borra todo el contenido de tu `CARPETA PUBLICA`, y sube el **contenido** de tu `CARPETA DE TRABAJO` a dicha `CARPETA PUBLICA`.
   Una vez hecho lo anterior, visita tu `WEB SITE`, esté será reflejo fiel de tu `CARPETA DE TRABAJO` visto en un navegador web.

2. Baja el archivo php [`install.php`][install.php] a tu `CARPETA DE TRABAJO`, como ya existe un archivo con el mismo nombre, sobre escribe el existente, ya que este nuevo archivo `install.php` tiene algunas correciones respecto al original.

3. Instala o crea las tablas que va a requerir tu sitio web usando el archivo `./install.php` recien bajado.
    1. Actualiza la sección de configuracion de conexion a tu base de datos MySQL en el archivo `./install.php` con tus datos de conexion. Actualmente esa parte contiene esta información:
    
       ```php
        if (isset($_POST["install"])){

            $dbHost     = "localhost"; # url o direccion de la base ...
            $dbUsuario  = "root";
            $dbPassword = "";
            $dbNombre   = "cmsblog"; # nombre de la base de datos

            ...
       ```
       
       Los parametros de conexion actualizados con tus datos queda como sigue:

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

       Asegurate que los datos estén correctos. Si te marca error alguno de los ejercicios posteriores, regresa a este punto y revisa que tus datos estén correctos.

    2. Para ejecutar la instalacion, hay que *correr* el php `./install.php` en el servidor (usando su url completa) para que se realice la creación de la base de datos, tablas y datos de carga inicial, como lo hicimos en clase, la diferencia ahora es que no es `http://localhost/cmsblog/install.php`, sino que hay que apuntar ahora a la url correspondiente: `http://[ip]/~corne/[usuario_ftp_sin_@]/install.php`
    3. Ahora valida que la base de datos se haya creado correctamente:
        1. Actualiza la configuracion de la conexion a la base de datos MySQL en el archivo `./admin.php`, usa los mismos datos de conexión a MySQL que usaste en `./install.php`:

        ```php
        <?php

        $db = new mysqli('localhost', 'corne_[usuario_ftp_sin_@]', '[password_ftp]', 'corne_cmsblog_[usuario_ftp_sin_@]'); //con indicacion de nombre de base de datos
        //$db = new mysqli('localhost', 'root', ''); //sin indicacion de nombre de base de datos

        if($db->connect_errno > 0){
            die('No es posible conectarse a la base de datos [' . $db->connect_error . ']');
        }
        ```

        2. Ahora ve a tu sitio web `http://[ip]/~corne/[usuario_ftp_sin_@]/` y logueate en la correspondiente pantalla de *login*.
        3. Si tu login fue exitoso, este debe redirigirte a la pagina `./admin.php` en donde deberás ver el listado de articulos publicados por cada autor, **que fue hasta donde llegamos en la ultima clase**.
        
### ./admin.php

En `./admin.php` actualmente generamos con php una tabla html que contiene los datos consultados de la tabla `articulo`, y mostramos dos columnas que son `id` y `titulo`. El codigo html generado por php debe ser parecido a (quizás varie en los saltos de linea, pero los tags deben generarse en el orden indicado):

```html
<table>
    <tr>
        <td>1</td>
        <td>silicon valley</td>
    </tr>
    <tr>
        <td>2</td>
        <td>ipad</td>
    </tr>
    ...
    <tr>
        <td>15</td>
        <td>cazafantasmas</td>
    </tr>
</table>
```

Si tu salida html no es así, corrige o completa tu fuente `./admin.php` para que tenga la salida de tags como se indicó anteriormente.

1. El ejercicio consiste en modificar el fuente `./admin.php` de manera que la salida html ahora sea:

   ```html
   <table>
       <tr>
           <td>1</td>
           <td> <a href="articulo_edita.php?id=1"> silicon valley </a> </td>
       </tr>
       <tr>
           <td>2</td>
           <td> <a href="articulo_edita.php?id=2"> ipad </a> </td>
       </tr>
       ...
       <tr>
           <td>15</td>
           <td> <a href="articulo_edita.php?id=15"> cazafantasmas </a> </td>
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
[install.php]: http://corgom.github.io/resources/install.php "Install PHP-MySQL"
