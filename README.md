
# Proyecto: FARMALINK #
## Marco Villuendas Tomás


### Aplicación web y Android, FARMALINK.

Desarrollada en PHP, con un modelo MVC (Modelo-Vista-Controlador) gracias al framework de PHP, **CakePHP**.  <br>

La parte de la maquetación y diseño Web se ha hecho con las últimas técnologias, **HTML5 y CSS3**. 
También existen utilidades con **JQuery** para interactuar con las tablas de datos.

La base de datos esta en **MySQL**.

En Android el desarrollo se realiza en Android Nativo y muestra los datos que se le proporcionan a través de una API disponible en la propia web.


[![CakePHP](http://cakephp.org/img/cake-logo.png)](http://www.cakephp.org)   [![CakePHP](http://piedralibre.files.wordpress.com/2010/10/google_android_logo.jpg)](http://www.cakephp.org)

<br>
> ## Introducción 
<hr>


La aplicación muestra información sobre ofertas que proporcionan farmacias, estas mismas farmacias son las encargadas a traves de un sistema de usuarios, de añadir y gestionar todas esas ofertas que les interese mostrar en la aplicación.

Para ello existe una parte de administración donde las farmacias se darán de alta en la aplicación. El registro de las farmacias esta hecho de forma segura, donde se le piden datos que solo ellas poseen.

Los usuarios tendrán acceso tanto a las ofertas disponibles como al listado de farmacias presentes en la aplicación, de una manera rápida y efectiva, donde podrán buscar filtrando el tipo de ofertas que les interese ya sea por artículos o por la localización de la farmacia.

Expansión:

Se ha añadido una parte en la aplicación que supone una información extra que se le proporciona a los usuarios. Un apartado donde se pueden consultar las farmacias de guardia en su localidad.

Una parte importante donde se añadan distribuidores farmaceuticos, estos tendrán un panel de control similar al de las farmacias, pero con la posibilidad de vender paquetes de productos. Estos paquetes solo podran ser vistos y adquiridos por las farmacias.




> ## Instalación, configuración y desarrollo software
<hr>

La herramienta esta pensada para ser rápida ligera e intuitiva. No requiere ninguna instalación especial, ya sea en web o smartphone. Lo mismo se puede decir de la configuración.

Los requisitos que necesitamos disponer son:

### Web

 Un ordenador con acceso a internet, disponible para todos los sistemas operativos. <br>
 - Recomendamos la utilización de Google Chrome o Mozilla Firefox como navegador web. De igual manera, no debería haber problemas en Internet Explorer u otros navegadores.<br>
 - 1GB RAM de minimo, para el correcto funcionamiento. <br>

### Móvil 
     
Necesitaremos disponer para el acceso a través de un móvil:
     
 - Sistema operativo ANDROID, versión 2.6 o superior.
 - 20MB de espacio en la memoria del dispositivo


> ### Desarrollo


Como antes se ha descrito, la aplicación web se ha desarrollado con el framework CakePHP, que cuenta con un MVC (Modelo-Vista-Controlador). 
CakePHP es un framework o marco de trabajo que facilita el desarrollo de aplicaciones web, utilizando el patrón MVC. Es de código abierto y se distribuye bajo licencia MIT.

Las principales ventajas que hemos encontrado para usar este framework en la aplicación web son: 
- Sistema de plantillas rápido y flexible.
- Validación integrada.
- ORM que facilita las labores básicas de acceso y modificación de datos de la Base de Datos creada. 
- Estructuración y organización de los proyectos de manera que se haga más accesible poder modificar los archivos.
- Componentes propios de seguridad y sesión.
- Ayudas para AJAX, Javascript, forms y más.


La base de datos se ha creado en MySQL.

La parte del diseño y la maquetación se ha realizado con HTML5 y CSS3, poniendo especial enfasis en lograr un diseño accesible e intuitivo sin descuidar su aspecto. El diseño es adaptable (responsivo) para poderse ver en diferentes dispositivos y resoluciones.
Para los campos de busqueda y ordenación de los listados de datos se ha usado funciones en Jquery.

> ## Análisis y Diseño ##
<hr>

Existen dos partes bien diferenciadas en el proyecto, la del usuario y la de farmacias.<br>
El usuario simplemente tendrá acceso a la consulta de datos e información suministrada por la aplicación. <br>
La parte de las farmacias será la encargada de suministrar y gestionar toda la información disponible en la aplicación, ya que tendrán total opción de administración.



> ### Explicación Base de Datos:

**FARMALINK** posee una base de datos práctica y sencilla, 4 tablas con las que administrar y gestionar todos los datos de la aplicación. Destacar que es una base de datos en MySQL.

![Alt text](img/bd.jpg)

Se usan dos tablas para **FARMACIAS y OFERTAS**, donde una farmacia puede tener todo el número de ofertas que desee y obviamente una oferta solo puede ser de una farmacia. Las farmacias tendrán total acceso para editar o eliminar estas ofertas que hayan insertado.
Esas farmacias tendrán una cuenta de **USUARIO**, desde donde podrán editar también la información de su farmacia.

La tabla **IMAGES** gestionará imágenes tanto de farmacias como de ofertas. Habrá un campo de la tabla que diferencia  y controla en cada caso que tipo de imagen es.

Tablas y campos de cada una:


    - Farmacias : id, nombre, dirección, cp, localidad, telefono, email, lat, long, user_id
    
    - Ofertas : id, articulo, descripcion, precio, stock, id_farmacia
    
    - Users : id, username, password, role, created, modified
    
    - Imagenes : id, tipo, data_json, archivo, orden, foreign_id, model, created, modified






> ## Manual de Usuario
<hr>

### Usuario: 
La primera pantalla a la que accede el usuario es desde la que podrá tener acceso a todos los apartados de la aplicación con 1 solo click. 

![Alt text](img/inicio2.jpg)
El campo de busqueda será la parte más importante, ya que desde ese campo podremos buscar ofertas, ya sea buscando por artículos, localidad o código postal. Al rellenar el campo de busqueda aparecera a partir del segundo caracter una lista de sugerencias de que puede querer escribir, facilitando el rellenar rápido y buscar.

***"VER OFERTAS"*** lleva a un listado con todas las ofertas disponibles en la aplicación. En ese listado se puede ver cada oferta de forma individual con la siguiente información *(Artículo, Descripción, Precio, Stock, Farmacia, Imagen)*.
![Alt text](img/panelcontrol2.jpg) 
![Alt text](img/ver_oferta2.jpg)

<br>
***"VER FARMACIAS"*** enlaza a una pagina donde podremos ver un listado de farmacias con sus datos. De igual forma, en ese listado se podrá ver cada farmacia de forma individual, donde se muestra un perfil de farmacia con toda la información.*(Nombre, Dirección, CP, Email, Teléfono y listado con las ofertas actuales que tiene activas la farmacia)*.
![Alt text](img/listadofarmacia2.jpg)

![Alt text](img/ver_farmacia2.jpg)

Una aplicación sencilla y fácil de usar.
<hr>
### Farmacia:
<br>
La administración de las farmacias es algo más complejo, ya que ellas son las encargadas de la administración y de que el sitio al fin y al cabo, funcione.

- El primer paso es el registro del usuario, con su username y contraseña.<br>

- Una vez registrado, tendrán que ingresar todos los datos de la farmacia, incluyendo un campo que solo poseen cada farmacia y es un número que la aplicación será capaz de comprobar y validar para poderse hacer efectivo el registro.

![Alt text](img/registro_farm2.jpg) 
![Alt text](img/login2.jpg) 

- Al registrarse la aplicación le llevará a su panel de control, donde podrá insertar sus primeras ofertas o comprobar los datos que ha suministrado de su farmacia. 

![Alt text](img/ctrl2.jpg) 

- El usuario tendrá acceso a sus datos para poderlos modificar si es necesario.

![Alt text](img/editfarma2.jpg) 