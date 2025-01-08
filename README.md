# **Gestión de Regulaciones**

Este proyecto es una aplicación web diseñada para gestionar regulaciones, registrar comentarios asociados y permitir su publicación. Ofrece una interfaz interactiva para los usuarios y utiliza validaciones para garantizar la calidad de los datos.

## **Características principales**

- **Gestión de regulaciones**:
  - Registro de regulaciones con validación de datos.
  - Asociación de comentarios a regulaciones.
  - Publicación de regulaciones con control de trazabilidad.

- **Validaciones avanzadas**:
  - Verificación de campos obligatorios.
  - Validación de enlaces como URLs válidas.
  - Manejo de errores y mensajes descriptivos para el usuario.

- **Interfaz interactiva**:
  - Alertas y confirmaciones con SweetAlert.
  - Tablas dinámicas para mostrar y manipular datos.
  - Actualizaciones en tiempo real con AJAX.

## **Tecnologías utilizadas**

- **Backend**: 
  - PHP con CodeIgniter.
  - MySQL para la base de datos.

- **Frontend**:
  - HTML5, CSS3 y JavaScript.
  - Bootstrap para diseño responsivo.
  - SweetAlert para alertas interactivas.

- **Otras herramientas**:
  - jQuery para manipulación del DOM y solicitudes AJAX.
  - Git para el control de versiones.

## **Estructura del proyecto**

```plaintext
📦application
 ┣ 📂cache
 ┃ ┗ 📜index.html
 ┣ 📂config
 ┃ ┣ 📜autoload.php
 ┃ ┣ 📜config.php
 ┃ ┣ 📜constants.php
 ┃ ┣ 📜database.php
 ┃ ┣ 📜doctypes.php
 ┃ ┣ 📜foreign_chars.php
 ┃ ┣ 📜ftp_config.php
 ┃ ┣ 📜hooks.php
 ┃ ┣ 📜index.html
 ┃ ┣ 📜ion_auth.php
 ┃ ┣ 📜memcached.php
 ┃ ┣ 📜migration.php
 ┃ ┣ 📜mimes.php
 ┃ ┣ 📜profiler.php
 ┃ ┣ 📜routes.php
 ┃ ┣ 📜smileys.php
 ┃ ┗ 📜user_agents.php
 ┣ 📂controllers
 ┃ ┣ 📜Auth.php
 ┃ ┣ 📜Ciudadania.php
 ┃ ┣ 📜Comentarios.php
 ┃ ┣ 📜Emergency.php
 ┃ ┣ 📜Guia.php
 ┃ ┣ 📜Home.php
 ┃ ┣ 📜index.html
 ┃ ┣ 📜Menu.php
 ┃ ┣ 📜Oficinas.php
 ┃ ┣ 📜PhpSpreadsheet.php
 ┃ ┣ 📜PublicadasController.php
 ┃ ┣ 📜RegulacionController.php
 ┃ ┣ 📜Regulaciones.php
 ┃ ┗ 📜Usuarios.php
 ┣ 📂core
 ┃ ┗ 📜index.html
 ┣ 📂helpers
 ┃ ┣ 📜email_helper.php
 ┃ ┗ 📜index.html
 ┣ 📂hooks
 ┃ ┗ 📜index.html
 ┣ 📂language
 ┃ ┣ 📂english
 ┃ ┃ ┣ 📜auth_lang.php
 ┃ ┃ ┣ 📜index.html
 ┃ ┃ ┗ 📜ion_auth_lang.php
 ┃ ┣ 📂spanish
 ┃ ┃ ┣ 📜auth_lang.php
 ┃ ┃ ┣ 📜db_lang.php
 ┃ ┃ ┣ 📜form_validation_lang.php
 ┃ ┃ ┣ 📜ftp_lang.php
 ┃ ┃ ┣ 📜ion_auth_lang.php
 ┃ ┃ ┗ 📜upload_lang.php
 ┃ ┗ 📜index.html
 ┣ 📂libraries
 ┃ ┣ 📜Blade.php
 ┃ ┣ 📜index.html
 ┃ ┗ 📜Ion_auth.php
 ┣ 📂logs
 ┃ ┗ 📜index.html
 ┣ 📂models
 ┃ ┣ 📜ComentariosModel.php
 ┃ ┣ 📜index.html
 ┃ ┣ 📜Ion_auth_model.php
 ┃ ┣ 📜MenuModel.php
 ┃ ┣ 📜NotificacionesModel.php
 ┃ ┣ 📜OficinaModel.php
 ┃ ┣ 📜PublicadasModel.php
 ┃ ┣ 📜RegulacionCaracteristicaModel.php
 ┃ ┣ 📜RegulacionModel.php
 ┃ ┗ 📜UsuarioModel.php
 ┣ 📂third_party
 ┃ ┗ 📜index.html
 ┣ 📂views
 ┃ ┣ 📂admin
 ┃ ┃ ┣ 📜agregar-oficina.blade.php
 ┃ ┃ ┣ 📜editar-oficina.blade.php
 ┃ ┃ ┗ 📜oficinas.blade.php
 ┃ ┣ 📂auth
 ┃ ┃ ┣ 📂email
 ┃ ┃ ┃ ┣ 📜activate.tpl.php
 ┃ ┃ ┃ ┗ 📜forgot_password.tpl.php
 ┃ ┃ ┣ 📜change_password.php
 ┃ ┃ ┣ 📜create_group.blade.php
 ┃ ┃ ┣ 📜create_user.blade.php
 ┃ ┃ ┣ 📜deactivate_user.php
 ┃ ┃ ┣ 📜edit_group.blade.php
 ┃ ┃ ┣ 📜edit_user.blade.php
 ┃ ┃ ┣ 📜forgot_password.blade.php
 ┃ ┃ ┣ 📜index.blade.php
 ┃ ┃ ┣ 📜login.blade.php
 ┃ ┃ ┣ 📜reset_password.blade.php
 ┃ ┃ ┣ 📜solicitud.blade.php
 ┃ ┃ ┗ 📜temporary_form.blade.php
 ┃ ┣ 📂ciudadania
 ┃ ┃ ┣ 📜consulta-regulaciones.blade.php
 ┃ ┃ ┣ 📜pdf_template.blade.php
 ┃ ┃ ┣ 📜ver_regulacion.blade.php
 ┃ ┃ ┗ 📜ver_regulacion2.blade.php
 ┃ ┣ 📂consejeria
 ┃ ┃ ┣ 📜editar_caracteristicas.blade.php
 ┃ ┃ ┣ 📜editar_materias.blade.php
 ┃ ┃ ┣ 📜editar_naturaleza.blade.php
 ┃ ┃ ┗ 📜regulaciones2.blade.php
 ┃ ┣ 📂emergencia
 ┃ ┃ ┣ 📜editar_caracteristicas.blade.php
 ┃ ┃ ┣ 📜editar_caracteristicas_sujeto.blade.php
 ┃ ┃ ┣ 📜editar_materias.blade.php
 ┃ ┃ ┣ 📜editar_materias_sujeto.blade.php
 ┃ ┃ ┣ 📜editar_naturaleza.blade.php
 ┃ ┃ ┣ 📜editar_naturaleza_sujeto.blade.php
 ┃ ┃ ┣ 📜emergencia-caracter.blade.php
 ┃ ┃ ┗ 📜emergencia-inicio.blade.php
 ┃ ┣ 📂errors
 ┃ ┃ ┣ 📂cli
 ┃ ┃ ┃ ┣ 📜error_404.php
 ┃ ┃ ┃ ┣ 📜error_db.php
 ┃ ┃ ┃ ┣ 📜error_exception.php
 ┃ ┃ ┃ ┣ 📜error_general.php
 ┃ ┃ ┃ ┣ 📜error_php.php
 ┃ ┃ ┃ ┗ 📜index.html
 ┃ ┃ ┣ 📂html
 ┃ ┃ ┃ ┣ 📜error_404.php
 ┃ ┃ ┃ ┣ 📜error_db.php
 ┃ ┃ ┃ ┣ 📜error_exception.php
 ┃ ┃ ┃ ┣ 📜error_general.php
 ┃ ┃ ┃ ┣ 📜error_php.php
 ┃ ┃ ┃ ┗ 📜index.html
 ┃ ┃ ┗ 📜index.html
 ┃ ┣ 📂home
 ┃ ┃ ┣ 📜home-admin.blade.php
 ┃ ┃ ┣ 📜home-consejeria.blade.php
 ┃ ┃ ┗ 📜home-sujeto.blade.php
 ┃ ┣ 📂login
 ┃ ┃ ┣ 📜forgot.blade.php
 ┃ ┃ ┣ 📜login.blade.php
 ┃ ┃ ┗ 📜register.blade.php
 ┃ ┣ 📂menuAdmin
 ┃ ┃ ┣ 📜abrogadas.blade.php
 ┃ ┃ ┣ 📜agregar-sujeto.blade.php
 ┃ ┃ ┣ 📜agregar-unidad.blade.php
 ┃ ┃ ┣ 📜buzon.blade.php
 ┃ ┃ ┣ 📜editar-sujeto.blade.php
 ┃ ┃ ┣ 📜editar-unidad.blade.php
 ┃ ┃ ┣ 📜enviadas.blade.php
 ┃ ┃ ┣ 📜guia.blade.php
 ┃ ┃ ┣ 📜log.blade.php
 ┃ ┃ ┣ 📜modificadas.blade.php
 ┃ ┃ ┣ 📜publicadas.blade.php
 ┃ ┃ ┣ 📜sujeto-obligado.blade.php
 ┃ ┃ ┗ 📜unidades-administrativas.blade.php
 ┃ ┣ 📂menuConsejeria
 ┃ ┃ ┣ 📜abrogadas.blade.php
 ┃ ┃ ┣ 📜buzon.blade.php
 ┃ ┃ ┣ 📜enviadas.blade.php
 ┃ ┃ ┣ 📜guia.blade.php
 ┃ ┃ ┣ 📜log.blade.php
 ┃ ┃ ┗ 📜publicadas.blade.php
 ┃ ┣ 📂menuSujeto
 ┃ ┃ ┣ 📜abrogadas.blade.php
 ┃ ┃ ┣ 📜agregar-unidad.blade.php
 ┃ ┃ ┣ 📜buzon.blade.php
 ┃ ┃ ┣ 📜editar-unidad.blade.php
 ┃ ┃ ┣ 📜emergencia-caracter.blade.php
 ┃ ┃ ┣ 📜emergencia-inicio.blade.php
 ┃ ┃ ┣ 📜enviadas.blade.php
 ┃ ┃ ┣ 📜guia.blade.php
 ┃ ┃ ┣ 📜log.blade.php
 ┃ ┃ ┣ 📜publicadas.blade.php
 ┃ ┃ ┗ 📜unidades-administrativas.blade.php
 ┃ ┣ 📂modal
 ┃ ┃ ┣ 📜comentarios.blade.php
 ┃ ┃ ┣ 📜oficinaHorarios.blade.php
 ┃ ┃ ┣ 📜oficinaRangoHorarios.blade.php
 ┃ ┃ ┣ 📜trazabilidad.blade.php
 ┃ ┃ ┗ 📜unidadesHorarios.blade.php
 ┃ ┣ 📂publicadas
 ┃ ┃ ┣ 📜editar_publi_caract.blade.php
 ┃ ┃ ┗ 📜editar_publi_naturaleza.blade.php
 ┃ ┣ 📂regulaciones
 ┃ ┃ ┣ 📜caracteristicas-regulaciones.blade.php
 ┃ ┃ ┣ 📜editar_caracteristicas.blade.php
 ┃ ┃ ┣ 📜editar_materias.blade.php
 ┃ ┃ ┣ 📜editar_naturaleza.blade.php
 ┃ ┃ ┣ 📜materias-exentas.blade.php
 ┃ ┃ ┣ 📜nat-regulacioes.blade.php
 ┃ ┃ ┗ 📜regulaciones2.blade.php
 ┃ ┣ 📂sujeto
 ┃ ┃ ┣ 📜caracteristicas-regulaciones.blade.php
 ┃ ┃ ┣ 📜editar_caracteristicas.blade.php
 ┃ ┃ ┣ 📜editar_materias.blade.php
 ┃ ┃ ┣ 📜editar_naturaleza.blade.php
 ┃ ┃ ┣ 📜materias-exentas.blade.php
 ┃ ┃ ┣ 📜nat-regulacioes.blade.php
 ┃ ┃ ┗ 📜regulaciones2.blade.php
 ┃ ┣ 📂templates
 ┃ ┃ ┣ 📜estructuraLogin.blade.php
 ┃ ┃ ┣ 📜footer.blade.php
 ┃ ┃ ┣ 📜footerCiudadania.blade.php
 ┃ ┃ ┣ 📜header.blade.php
 ┃ ┃ ┣ 📜header2.blade.php
 ┃ ┃ ┣ 📜header3.blade.php
 ┃ ┃ ┣ 📜master.blade.php
 ┃ ┃ ┣ 📜masterCiudadania.blade.php
 ┃ ┃ ┣ 📜masterForm.blade.php
 ┃ ┃ ┣ 📜masterVerRegulacion.blade.php
 ┃ ┃ ┣ 📜menuAdmin.blade.php
 ┃ ┃ ┣ 📜menuConsejeria.blade.php
 ┃ ┃ ┣ 📜menuSujeto.blade.php
 ┃ ┃ ┣ 📜menu_ciudadania.blade.php
 ┃ ┃ ┣ 📜navbar.blade.php
 ┃ ┃ ┣ 📜navbarAdmin.blade.php
 ┃ ┃ ┣ 📜navbarCiudadania.blade.php
 ┃ ┃ ┣ 📜navbarConsejeria.blade.php
 ┃ ┃ ┗ 📜navbarSujeto.blade.php
 ┃ ┣ 📜index.html
 ┃ ┣ 📜inicio.php
 ┃ ┗ 📜plantilla.php
 ┣ 📜.htaccess
 ┗ 📜index.html


