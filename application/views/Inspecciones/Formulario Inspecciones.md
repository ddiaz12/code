# Formulario de Inspecciones 

###  si tiene un * al final significa que es un campo obligatorio.
### empezare con el titulo de cada menú.


##### Datos de identificación
- Homoclave (Esa ya esta bien, asi deja la logica)
- Nombre de la inspección* (que contenga un campo para escribir)
- Modalidad (si existe) [Esto se queda tal cual como esta en el codigo]
- Tipo de inspección, verificacion o visita domiciliaria* (Lleva un menú predeterminado con lo siguente:
Asesoria
Asistencia
Control
Corroboración
Otra (si da click en otra, que salga un campo donde diga Especificar otra: y que lo pueda especificar)
Promoción
Supervisión
Vigilancia)
- Sujeto Obligado (esa ya esta bien como esta)
- Ley de Fomento a la Confianza Ciudadana (que esto salga como titulo en negritas, y en un texto mas pequeño despues que diga: ¿La inspección, verificación o visita domiciliaria se encuentra exenta de la Ley de Fomento a la Confianza Ciudadana?* y que abajito de esa pregunta tenga un si o un no, si le da si que salga:Justificar si la inspección, verificación o visita domiciliaria son sujetas para todas o algunas de sus modalidades a suspensión conforme lo establecido en el artículo 1 y 13 de la Ley de Fomento a la Confianza Ciudadana:* y que salga un campo para describir)
- ¿La inspección, verificación o visita domiciliaria va dirigida a personas físicas, morales o ambas?* (Lleva un menú predeterminado con lo siguente:
personas fisicas
personas fisicas con actividad empresarial
personas morales
otras (si selecciona otras que salga: Indicar a quién va dirigida la inspección, verificación o visita domiciliaria y un campo para llenar))
- La inspección, verificación o visita domiciliaria es:* (Lleva un menú predeterminado con lo siguente:
PREVENTIVA (se realiza para prevenir algún impactonegativo)
REACTIVA (como respuesta a un accidente o amenaza particular)
SEGUIMIENTO (se da seguimiento al cumplimiento de alguna obligación en particular))
- Indique si la verificación, inspección o visita domiciliaria se realiza en: * (Lleva un menú predeterminado con lo siguente:
En el domicilio o establecimientos de los Sujetos Regulados
En las oficinas del Sujeto Obligado
Medios electrónicos
Otro (al dar clic en otro que salga otro campo "Otros*" para que especifique)
)
- ¿Cuál es el objetivo de la inspección, verificación o visita domiciliaria? *
- Palabras clave que describan o identifiquen las inspecciones, verificaciones y visitas domiciliarias: *
- Periodicidad en la que se realiza: * (que desplique una lista que contenga:
Anual
Bienal 
Diaria 
Mensual
No aplica 
Semanal 
Semestral 
Trineal o más
Trismestral)
- Especificar qué motiva la inspección, verificación o visita domiciliaria: * (Lleva un menú predeterminado con lo siguente:
Ordinaria 
Extraordinaria
De oficio
A solicitud de parte
Forma parte de un trámite o servicio
Otro (si selecciona otro que salga otro y especifique)
  )
-  Nombre de tramite o servicio  asociado en esta inspección, verificación o visita domiciliaria * (en ese titulo que aparezcan 2 campos donde ponga el Nombre del servicio o tramite y otro del url al que esta relacionado (que solo acepte urls este campo))
- ¿Existe un fundamento jurídico que dé origen a la inspección, verificación o visita domiciliaria? * 2 opciones de si o no, si da si -> (traer el catalogo de la base de datos de la tabla "cat_tipo_ord_jur" para que seleccione el tipo)
  

#### Autoridad Pública
- Información de las autoridades competentes, encargadas de ordenar las inspecciones, verificaciones y visitas domiciliaras 
(Poner un campo que diga buscar oficinas (para que sea un buscador y busque las oficinas existentes) y al lado un boton con el icono de una lupa que diga "mis oficinas" y que ese boton muestre el nombre de las oficinas las oficinas creadas. que solo traiga el nombre de la oficina  de ma_oficina_administrativa)

#### Información sobre la inspección
- Bien, elemento, objeto o sujeto de inspección, verificación o visita domiciliaria:*
- Indicar si otros Sujetos Obligados participan en la realización de las inspecciones, verificaciones y visitas domiciliarias* (poner 2 opciones de si o no, si si -> preguntar ¿Cuáles Sujetos Obligados? traer el catalogo de la tabla cat_sujeto_obligado Buscar Sujeto Obligado y muestre una lista de los sujetos obligados)
- Derechos del sujeto regulado durante la inspección, verificación o visita domiciliaria (que salga un campo que contenga como descripcion dentro de donde lo vas a llenar "agregar derecho del sujeto regulado" y al lado un boton de agregar con un icono de mas, para ir agregando derechos y los derechos agregados aparezcan abajo con la opcion de quitarlos por si se equivoca)
- Obligaciones que debe cumplir el sujeto regulado (que salga un campo que contenga como descripcion dentro de donde lo vas a llenar "agregar obligaciones" y al lado un boton de agregar con un icono de mas, para ir agregando obligaciones y los obligaciones agregados aparezcan abajo con la opcion de quitarlos por si se equivoca)
- Fundamento Juridico de la existencia de la inspección, verificación o visita domiciliaria* (que haya 3 campos con lo siguiente: Nombre, Articulo y Url (QUE ESTE CAMPO SOLO ACEPTE URL) a la regulacion directa. que eso lo guarde en la tabla de_fundamento 	
ID_Fun
ID_caract
Nombre
Articulo
Link)
- Especificar si el sujeto regulado debe llenar o firmar algún formato para la inspección, verificación o visita domiciliaria: * (poner 2 opciones de si o no y si da si que se habilite un campo para poder cargar archivos pdf, jgp y/o png)


## Más detalles
- ¿Tiene algún costo o pago de derechos, productos y aprovechamientos aplicables?*
(poner 2 opciones de si o no y si da si que despliegue Indicar monto* (que este campo solo acepte numeros) ¿El monto se encuentra fundamentado jurídicamente?* 2 opciones de si o no, si da si que salga un campo del nombre y el url del fundamento juridico (que este campo solo acepte urls))
- Pasos a realizar por el inspector o verificador durante la inspección, verificación o visita domiciliaria: (esto en negritas)
Aproximadamente, ¿Cuánto tiempo lleva la verificación en todas sus etapas –orden, diligencia y resolución-? Indique y desglose lo más posible los pasos realizados:(esto en texto medio gris y que abajo salga un campo para el detalle de lo que pide.)
- Tramites vinculados a la inspección, verificación o visita domiciliaria * (que haya 2 campos uno con el nombre del tramite y URL (que este campo solo acepte URLs))
- Regulaciones que debe cumplir el sujeto obligado: (Que tenga los siguentes camapos Nombre de la regulacion, y URL de dicha regulacion (que solo acepte urls este campo))
- Requisitos o documentos que debe presentar el interesado: (Un campo donde pueda subir archivos pdf, jpg o png)
- ¿Qué tipo de sanciones pueden derivar a partir de esta inspección?* (que esten estos campos para selecionar y que si selecciona cualquier campo que se despliegue un campo para que ponga el URL de dicha sancion (que solo acepte url ese campo)
Clausura definitiva
Clausura temporal
Multa
Otra (si selecciona otra, que se despliegue un campo para que escriba y ese campo es*, tambien otro donde ponga el URL(que solo acepte url ese campo))
Revocación de licencia, permiso, autorización u otro
Suspensión definitiva de actividades
Suspensión temporal de actividades
)
- Timepo aproximado de la inspección, verificación o visita domiciliaria * (que haya dos campos uno Valor del plazo:* que sean numeros enteros desde 1 a infinito y otro campo Unidad de medida:* que despliegue una lista con lo siguente
Días naturales
Días hábiles
Meses
Años
No aplica )
- Formato o formulario, en su caso, que el Sujeto Obligado utiliza. (Que haya 2 campos uno que diga Nombre y otro donde pueda subir la informacion en pdf, png o jpg)
- Facultades, atribuciones y obligaciones del Sujeto Obligado que la realiza:* (que salga un campo que contenga una descripcion dentro de donde lo vas a llenar "agregar Facultades, atribuciones y obligaciones" y al lado un boton de agregar con un icono de mas, para ir agregando derechos y los derechos agregados aparezcan abajo con la opcion de quitarlos por si se equivoca)
- Servidores públicos facultados para realizar la inspección, verificación o visita domiciliaria: (Que haya 2 campos uno que diga Nombre y otro donde este el url directo a su ficha (que solo acepte urls ese campo))

## Información de la Autoridad Pública y Contacto
- Números telefónicos
- Direccion y correo electronico de los órganos internos de control o equivalentes para realizar denuncias
- Señalamiento de los medios de impugnación con los que cuenta el interesado que se inconforme con la inspección, verificación o visita domiciliaria:* (Nombre de la regulacion, articulo, parrafo numero o numeral y URL de dicha regulacion (que este campo solo acepte url))

## Estadísticas
- ¿Cuántas inspecciones se realizaron en el año anterior durante los siguientes meses?* (y que salgan los meses como ya esta en el codigo)
- ¿Cuántas inspecciones derivaron en sanción en el año inmediato anterior?* (que tenga un campo donde solo permita poner un numero entero)


## Información adicional
- Información que se consideré útil para que el interesado realice la inspección, verificación o visita domiciliaria.(que este un campo para que se pueda llenar)

## No publicidad
- ¿Permitir que todos los datos de la inspección, verificación o visita domiciliaria sea pública?* (si o no, si le da no que salga un mensaje emergente con lo siguiente : "Conforme a lo dispuesto en la Estrategia Nacional de Mejora Regulatoria, respecto a la clasificación de la información registrada del Registro Nacional de Visitas Domiciliarias, los sujetos obligados podrán determinar la publicación parcial o total de la información de sus inspectores, verificadores o visitadores, así como también de sus inspecciones, verificaciones y visitas domiciliarias, a fin de mantener la integridad o seguridad del servidor público y se consigan lograr los objetivos que se pretenden alcanzar por la inspección, verificación o visita domiciliaria.

Conforme a lo anterior, los datos que determine el sujeto obligado que no pueden formar parte de la esfera pública, la autoridad o encargado de mejora regulatoria no compartirá dicha información a otras autoridades y se abstendrá de publicarla en el portal ciudadano, siempre y cuando la autoridad o encargado de mejora regulatoria así lo determine." y un boton de aceptar para quitar la ventanita y aparezca lo siguiente:
- Cargar un documento por medio del cual el sujeto obligado justifique que no se puede publicar la información de sus inspectores, verificadores y visitadores y/o inspecciones, verificaciones y visitas domiciliarias.* (que acepte pdf, jpg o png)
- #### Determina la información de la ficha de la inspección, verificación o visita domiciliaria que no se puede publicar en el portal ciudadano:
(Que en cada uno de esos titulos aparezcan los titulos de los campos que estan el el formulario y en cada menú para que el que este llenando el formulario seleccione que se ocultar y que no (si no esta seleccionado que se muestre y si si que no se muestre))
- Datos de identificación de la inspección
- Contacto de la Autoridad Pública
- Información sobre la inspección
- Más detalles
- Información de la Autoridad Pública
- Estadística)

## Emergencias
- ¿La inspección es requerida para atender una situación de emergencia? (que salga un boton de si o no, si si que aparezca un mensaje emergente con lo siguiente "Con fundamento en el artículo 56, de la Sección IV, Capítulo I, Título Tercero de la Ley General de Mejora Regulatoria, los sujetos obligados podrán registrar una inspección, verificación o visita domiciliaria y/o inspectores, verificadores o visitadores para atender una situación de emergencia en los cinco días hábiles posteriores a su habilitación.

Al respecto, el sujeto obligado deberá informar y justificar a la autoridad o encargado de mejora regulatoria correspondiente las razones para habilitar a nuevos inspectores y/o inspecciones para atender las situaciones de emergencia." y con un boton de aceptar cuando lo haya leido.
despues que aparezcan los siguentes campos 
- Justificar las razones por las cuales se habilita una inspección para atender una situación de emergencia
- Cargar el oficio o acta de declaración de emergencia.* (que pueda subir pdf, jpg o png))