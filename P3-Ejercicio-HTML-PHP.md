# Desarrollo de aplicaciones web

# Ejercicio

**Keywords**: [HTML5][html5], form, input, post, PHP, ftp, website, url, $_POST[], issset(), [mysqli][mysqli], SQL

## Objetivo

Repasar los conceptos y ejercicios ya vistos en clase para concluir el armado o maquetado de un sitio web funcional online para publicar articulos de un blog.

## Instrucciones

Realiza cada unos de los pasos de forma incremental segun se te indica.

La conexion ftp lo puedes hacer con el cliente ftp de tu preferencia ([FileZilla][1], [CyberDuck][2], etc.). Ya se te proporcionó con anterioridad la información para hacer la conexión a tu sitio ftp, los datos mínimos requeridos son: **url del ftp** (host), **puerto** (port), **usuario** (user) y **contraseña** (password).

## Ejercicios que vas a realizar

### ./install.php

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
        2. Deberás abrir tu página web ./index.php, y tratar de loguearte en la correspondiente pantalla.
        3. Si tu login fue exitoso, este debe redirigirte a la pagina `./admin.php` en donde deberás ver el listado de articulos publicados por cada autor, **que fue hasta donde llegamos en la ultima clase**
        
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
