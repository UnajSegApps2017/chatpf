Se demuestra que es posible la integración de herramientas de cifrado 
estándar en desarrollos de aplicaciones web utilizando las herramientas 
del framework Yii2 con arquitectura de software Modelo - Vista - 
Controlador. El modelo de capas de seguridad es implementado en 
seguridad física de la gran mayoría de las organizaciones.
Un desarrollo de software que establece correctamente la delegación de 
las acciones a los servicios ya implementados, es más confiable y seguro 
que un sistema desarrollado completamente con fuentes propias que no se 
conocen los niveles de madurez de los procesos.
Se logra cumplir con la confidencialidad de los mensajes del sistema 
Chatpf. En futuras versiones del sistema se puede perseguir el objetivo 
de la integridad de los mensajes. Éste objetivo se cumpliría cifrando el 
encabezado del mensaje en la tabla de mensajes. Si ésto ocurre, se 
necesitaría generar un gestor de nuevos mensajes que descifren el 
encabezado de cada nueva inserción de la tabla de mensajes, para 
reconocer si el mensaje es destinado al usuario olvidado.

INSTALACION:

Situarse en documentroot de Apache con un usuario del grupo http
o apache

$ chmod 777 chatpf -R
$ git clone https://github.com/UnajSegApps2017/chatpf.git
$ sudo systemctl start mysld
$ mysql -u root -p < chatpf/basic/chatpf.sql

ACTIVACION DE YII2:

Cada usuario de Github debe generar su token de segurdad desde el
DashBoard de Github:

          menu usuario->Personal access token->Generate New Token

Porque sera solicitado cuando corra composer

$ cd chatpf/basic
$ composer update
$ php requirements.php

Si el ultimo comando no da error entonces

$ sudo systemctl start httpd

Y lista la webapp en http://<host>/chatpf/basc/web





