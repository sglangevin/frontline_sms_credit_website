<?php
defined('_JEXEC') OR defined('_VALID_MOS') OR die('...Direct Access to this location is not allowed...');

/**
* <p>Spanish language file</p>
* @author Jorge Pasco <servicio@eaid.org>
* @version $Id: spanish.php 491 2007-02-01 22:56:07Z divivo $
* @link http://www.eaid.org
*/

### General ###
 //acajoom Description
define('_ACA_DESC_NEWS', compa::encodeutf('Acajoom es una herramienta para confeccionar listas de correo, boletines, auto-respuestas y seguimientos; que podrá utilizar para comunicarse con sus clientes y usuarios de manera efectiva.  ' .
		'¡Acajoom, su asistente de comunicaciones!'));
define('_ACA_FEATURES', compa::encodeutf('¡Acajoom, su asistente de comunicaciones!'));

// Type of lists
define('_ACA_NEWSLETTER', compa::encodeutf('Boletín'));
define('_ACA_AUTORESP', compa::encodeutf('Auto-respuesta'));
define('_ACA_AUTORSS', compa::encodeutf('Auto-RSS'));
define('_ACA_ECARD', compa::encodeutf('Tarjeta electrónica'));
define('_ACA_POSTCARD', compa::encodeutf('Postal'));
define('_ACA_PERF', compa::encodeutf('Performance'));
define('_ACA_COUPON', compa::encodeutf('Cupón'));
define('_ACA_CRON', compa::encodeutf('Tarea Cron'));
define('_ACA_MAILING', compa::encodeutf('Envío'));
define('_ACA_LIST', compa::encodeutf('Lista'));

 //acajoom Menu
define('_ACA_MENU_LIST', compa::encodeutf('Listas'));
define('_ACA_MENU_SUBSCRIBERS', compa::encodeutf('Suscriptores'));
define('_ACA_MENU_NEWSLETTERS', compa::encodeutf('Boletines'));
define('_ACA_MENU_AUTOS', compa::encodeutf('Auto-respuestas'));
define('_ACA_MENU_COUPONS', compa::encodeutf('Cupones'));
define('_ACA_MENU_CRONS', compa::encodeutf('Tareas Cron'));
define('_ACA_MENU_AUTORSS', compa::encodeutf('Auto-RSS'));
define('_ACA_MENU_ECARD', compa::encodeutf('Tarjetas electrónicass'));
define('_ACA_MENU_POSTCARDS', compa::encodeutf('Postales'));
define('_ACA_MENU_PERFS', compa::encodeutf('Performances'));
define('_ACA_MENU_TAB_LIST', compa::encodeutf('Listas'));
define('_ACA_MENU_MAILING_TITLE', compa::encodeutf('Envíos'));
define('_ACA_MENU_MAILING', compa::encodeutf('Envíos para '));
define('_ACA_MENU_STATS', compa::encodeutf('Estadísticas'));
define('_ACA_MENU_STATS_FOR', compa::encodeutf('Estadísticas para '));
define('_ACA_MENU_CONF', compa::encodeutf('Configuración'));
define('_ACA_MENU_UPDATE', compa::encodeutf('Import'));
define('_ACA_MENU_ABOUT', compa::encodeutf('Acerca de'));
define('_ACA_MENU_LEARN', compa::encodeutf('Centro de aprendizaje'));
define('_ACA_MENU_MEDIA', compa::encodeutf('Gestor multimedia'));
define('_ACA_MENU_HELP', compa::encodeutf('Ayuda'));
define('_ACA_MENU_CPANEL', compa::encodeutf('Panel de control'));
define('_ACA_MENU_IMPORT', compa::encodeutf('Importar'));
define('_ACA_MENU_EXPORT', compa::encodeutf('Exportar'));
define('_ACA_MENU_SUB_ALL', compa::encodeutf('Subcribirse a todo'));
define('_ACA_MENU_UNSUB_ALL', compa::encodeutf('De-subcribirse a todo'));
define('_ACA_MENU_VIEW_ARCHIVE', compa::encodeutf('Archivo'));
define('_ACA_MENU_PREVIEW', compa::encodeutf('Vista previa'));
define('_ACA_MENU_SEND', compa::encodeutf('Enviar'));
define('_ACA_MENU_SEND_TEST', compa::encodeutf('Enviar correo de prueba'));
define('_ACA_MENU_SEND_QUEUE', compa::encodeutf('Cola de procesos'));
define('_ACA_MENU_VIEW', compa::encodeutf('Ver'));
define('_ACA_MENU_COPY', compa::encodeutf('Copiar'));
define('_ACA_MENU_VIEW_STATS', compa::encodeutf('Ver estadísticas'));
define('_ACA_MENU_CRTL_PANEL', compa::encodeutf('Panel de control'));
define('_ACA_MENU_LIST_NEW', compa::encodeutf(' Crear una lista'));
define('_ACA_MENU_LIST_EDIT', compa::encodeutf(' Editar una lista'));
define('_ACA_MENU_BACK', compa::encodeutf('Regresar'));
define('_ACA_MENU_INSTALL', compa::encodeutf('Instalación'));
define('_ACA_MENU_TAB_SUM', compa::encodeutf('Resumen'));
define('_ACA_STATUS', compa::encodeutf('Estado'));

// messages
define('_ACA_ERROR', compa::encodeutf(' ¡Ha ocurrido un error! '));
define('_ACA_SUB_ACCESS', compa::encodeutf('Derechos de acceso'));
define('_ACA_DESC_CREDITS', compa::encodeutf('Créditos'));
define('_ACA_DESC_INFO', compa::encodeutf('Información'));
define('_ACA_DESC_HOME', compa::encodeutf('Página de inicio'));
define('_ACA_DESC_MAILING', compa::encodeutf('Lista de envíos'));
define('_ACA_DESC_SUBSCRIBERS', compa::encodeutf('Suscriptores'));
define('_ACA_PUBLISHED', compa::encodeutf('Publicado'));
define('_ACA_UNPUBLISHED', compa::encodeutf('No Publicado'));
define('_ACA_DELETE', compa::encodeutf('Eliminar'));
define('_ACA_FILTER', compa::encodeutf('Filtrar'));
define('_ACA_UPDATE', compa::encodeutf('Actualizar'));
define('_ACA_SAVE', compa::encodeutf('Guardar'));
define('_ACA_CANCEL', compa::encodeutf('Cancelar'));
define('_ACA_NAME', compa::encodeutf('Nombre'));
define('_ACA_EMAIL', compa::encodeutf('Correo'));
define('_ACA_SELECT', compa::encodeutf('Seleccionar'));
define('_ACA_ALL', compa::encodeutf('todo'));
define('_ACA_SEND_A', compa::encodeutf('Enviar a '));
define('_ACA_SUCCESS_DELETED', compa::encodeutf(' eliminado con éxito'));
define('_ACA_LIST_ADDED', compa::encodeutf('Lista creada con éxito'));
define('_ACA_LIST_COPY', compa::encodeutf('Lista copiada con éxito'));
define('_ACA_LIST_UPDATED', compa::encodeutf('Lista actualizada con éxito'));
define('_ACA_MAILING_SAVED', compa::encodeutf('Envío guardado con éxito.'));
define('_ACA_UPDATED_SUCCESSFULLY', compa::encodeutf('Actualizado con éxito.'));

### Subscribers information ###
//subscribe and unsubscribe info
define('_ACA_SUB_INFO', compa::encodeutf('Información del suscriptor'));
define('_ACA_VERIFY_INFO', compa::encodeutf('Por favor verifique el enlace que envió, alguna información no es correcta o se ha perdido.'));
define('_ACA_INPUT_NAME', compa::encodeutf('Nombre'));
define('_ACA_INPUT_EMAIL', compa::encodeutf('Correo'));
define('_ACA_RECEIVE_HTML', compa::encodeutf('¿Acepta HTML?'));
define('_ACA_TIME_ZONE', compa::encodeutf('Zona horaria'));
define('_ACA_BLACK_LIST', compa::encodeutf('Lista negra'));
define('_ACA_REGISTRATION_DATE', compa::encodeutf('Fecha de registro de usuario'));
define('_ACA_USER_ID', compa::encodeutf('Id de usuario'));
define('_ACA_DESCRIPTION', compa::encodeutf('Descripción'));
define('_ACA_ACCOUNT_CONFIRMED', compa::encodeutf('Su cuenta ha sido activada.'));
define('_ACA_SUB_SUBSCRIBER', compa::encodeutf('Suscriptor'));
define('_ACA_SUB_PUBLISHER', compa::encodeutf('Editor'));
define('_ACA_SUB_ADMIN', compa::encodeutf('Administrador'));
define('_ACA_REGISTERED', compa::encodeutf('Registrado'));
define('_ACA_SUBSCRIPTIONS', compa::encodeutf('Vuestra suscripción'));
define('_ACA_SEND_UNSUBCRIBE', compa::encodeutf('Enviar mensaje para de-suscribirse'));
define('_ACA_SEND_UNSUBCRIBE_TIPS', compa::encodeutf('Seleccione SI para enviar un correo de confirmación a fin de de-suscribirse.'));
define('_ACA_SUBSCRIBE_SUBJECT_MESS', compa::encodeutf('Por favor confirme su suscripción'));
define('_ACA_UNSUBSCRIBE_SUBJECT_MESS', compa::encodeutf('Confirmación de de-suscripción'));
define('_ACA_DEFAULT_SUBSCRIBE_MESS', compa::encodeutf('Saludos [NAME],<br />' .
		'Falta un paso más para confirmar su suscripción en la lista.  Por favor acceda al siguiente enlace a fin de confirmar su suscripción.' .
		'<br /><br />[CONFIRM]<br /><br />Para cualquier consulta contáctese con el administrador.'));
define('_ACA_DEFAULT_UNSUBSCRIBE_MESS', compa::encodeutf('Este es un mensaje que confirma su de-suscripción de nuestra lista.  Sentimos mucho que haya decidido cancelar su suscripción, sin embargo si decide reaanudarla puede hacerlo en nuestro portal web. Si tuviese alguna consulta puede contactar al administrador.'));

// Acajoom Subscribers
define('_ACA_SIGNUP_DATE', compa::encodeutf('Fecha de registro'));
define('_ACA_CONFIRMED', compa::encodeutf('Confirmado'));
define('_ACA_SUBSCRIB', compa::encodeutf('Suscrito'));
define('_ACA_HTML', compa::encodeutf('Correo HTML'));
define('_ACA_RESULTS', compa::encodeutf('Resultados'));
define('_ACA_SEL_LIST', compa::encodeutf('Seleccione una lista'));
define('_ACA_SEL_LIST_TYPE', compa::encodeutf('- Seleccione el tipo de lista -'));
define('_ACA_SUSCRIB_LIST', compa::encodeutf('Lista de todos los suscriptores'));
define('_ACA_SUSCRIB_LIST_UNIQUE', compa::encodeutf('Suscriptores para: '));
define('_ACA_NO_SUSCRIBERS', compa::encodeutf('No se encontraron suscriptores para estas listas.'));
define('_ACA_COMFIRM_SUBSCRIPTION', compa::encodeutf('Un mensaje de confirmación le ha sido enviado.  Por favor revise su correo y seleccione el enlace provisto.<br />' .
		'Necesita confirmar su correo para que su suscripción sea iniciada.'));
define('_ACA_SUCCESS_ADD_LIST', compa::encodeutf('Usted ha sido añadido exitósamente a la lista.'));


 // Subscription info
define('_ACA_CONFIRM_LINK', compa::encodeutf('Acceda aquí para confirmar la suscripción'));
define('_ACA_UNSUBSCRIBE_LINK', compa::encodeutf('Acceda aquí para cancelar manualmente la suscripción a la lista'));
define('_ACA_UNSUBSCRIBE_MESS', compa::encodeutf('Su correo ha sido removido de la lista'));

define('_ACA_QUEUE_SENT_SUCCESS', compa::encodeutf('Todos los mensajes pendientes han sido enviados con éxito.'));
define('_ACA_MALING_VIEW', compa::encodeutf('Ver todos los envíos'));
define('_ACA_UNSUBSCRIBE_MESSAGE', compa::encodeutf('¿Está seguro que desea cancelar su suscripción de esta lista?'));
define('_ACA_MOD_SUBSCRIBE', compa::encodeutf('Suscribirse'));
define('_ACA_SUBSCRIBE', compa::encodeutf('Suscribirse'));
define('_ACA_UNSUBSCRIBE', compa::encodeutf('De-suscribirse'));
define('_ACA_VIEW_ARCHIVE', compa::encodeutf('Ver archivo'));
define('_ACA_SUBSCRIPTION_OR', compa::encodeutf(' o acceda aquí para actualizar su información'));
define('_ACA_EMAIL_ALREADY_REGISTERED', compa::encodeutf('Este correo ha sido registrado previamente.'));
define('_ACA_SUBSCRIBER_DELETED', compa::encodeutf('Suscriptor eliminado con éxito.'));


### UserPanel ###
 //User Menu
define('_UCP_USER_PANEL', compa::encodeutf('Panel de control del usuario'));
define('_UCP_USER_MENU', compa::encodeutf('Menú del usuario'));
define('_UCP_USER_CONTACT', compa::encodeutf('Mis suscripciones'));
 //Acajoom Cron Menu
define('_UCP_CRON_MENU', compa::encodeutf('Administración de tareas Cron'));
define('_UCP_CRON_NEW_MENU', compa::encodeutf('Nueva tarea Cron'));
define('_UCP_CRON_LIST_MENU', compa::encodeutf('Lista de mis tareas Cron'));
 //Acajoom Coupon Menu
define('_UCP_COUPON_MENU', compa::encodeutf('Administración de cupones'));
define('_UCP_COUPON_LIST_MENU', compa::encodeutf('Lista de cupones'));
define('_UCP_COUPON_ADD_MENU', compa::encodeutf('Añadir un cupón'));

### lists ###
// Tabs
define('_ACA_LIST_T_GENERAL', compa::encodeutf('Descripción'));
define('_ACA_LIST_T_LAYOUT', compa::encodeutf('Formato'));
define('_ACA_LIST_T_SUBSCRIPTION', compa::encodeutf('Suscripción'));
define('_ACA_LIST_T_SENDER', compa::encodeutf('Información de remitente'));

define('_ACA_LIST_TYPE', compa::encodeutf('Tipo de lista'));
define('_ACA_LIST_NAME', compa::encodeutf('Nombre de lista'));
define('_ACA_LIST_ISSUE', compa::encodeutf('Edición #'));
define('_ACA_LIST_DATE', compa::encodeutf('Fecha de envío'));
define('_ACA_LIST_SUB', compa::encodeutf('Asunto'));
define('_ACA_ATTACHED_FILES', compa::encodeutf('Archivos adjuntos'));
define('_ACA_SELECT_LIST', compa::encodeutf('¡Por favor seleccione una lista para editar!'));

// Auto Responder box
define('_ACA_AUTORESP_ON', compa::encodeutf('Tipo de lista'));
define('_ACA_AUTO_RESP_OPTION', compa::encodeutf('Opciones de Auto-respuesta'));
define('_ACA_AUTO_RESP_FREQ', compa::encodeutf('Los suscriptores pueden elegir la frecuencia'));
define('_ACA_AUTO_DELAY', compa::encodeutf('Retardo (en días)'));
define('_ACA_AUTO_DAY_MIN', compa::encodeutf('Frecuencia mínima'));
define('_ACA_AUTO_DAY_MAX', compa::encodeutf('Frecuencia máxima'));
define('_ACA_FOLLOW_UP', compa::encodeutf('Especificar seguimiento de auto-respuesta'));
define('_ACA_AUTO_RESP_TIME', compa::encodeutf('Suscriptores pueden elegir el tiempo'));
define('_ACA_LIST_SENDER', compa::encodeutf('Remitentes de lista'));

define('_ACA_LIST_DESC', compa::encodeutf('Descripción de lista'));
define('_ACA_LAYOUT', compa::encodeutf('Formato'));
define('_ACA_SENDER_NAME', compa::encodeutf('Nombre de remitente'));
define('_ACA_SENDER_EMAIL', compa::encodeutf('Correo de remitente'));
define('_ACA_SENDER_BOUNCE', compa::encodeutf('Dirección de respuesta de remitente'));
define('_ACA_LIST_DELAY', compa::encodeutf('Retardo'));
define('_ACA_HTML_MAILING', compa::encodeutf('¿Envío en HTML?'));
define('_ACA_HTML_MAILING_DESC', compa::encodeutf('(si efectúa algún cambio deberá guardarlo y retornar a esta pantalla para poder observar el efecto.)'));
define('_ACA_HIDE_FROM_FRONTEND', compa::encodeutf('¿Esconder en el portal web?'));
define('_ACA_SELECT_IMPORT_FILE', compa::encodeutf('Seleccione un archivo para importar'));;
define('_ACA_IMPORT_FINISHED', compa::encodeutf('Importación finalizada'));
define('_ACA_DELETION_OFFILE', compa::encodeutf('Eliminación de fichero'));
define('_ACA_MANUALLY_DELETE', compa::encodeutf(' falló, usted deberá eliminar el fichero manualmente'));
define('_ACA_CANNOT_WRITE_DIR', compa::encodeutf('no se puede escribir en el directorio'));
define('_ACA_NOT_PUBLISHED', compa::encodeutf('no puede remitirse el envío, la lista no se ha publicado.'));

//  List info box
define('_ACA_INFO_LIST_PUB', compa::encodeutf('Seleccione SI para publicar la lista'));
define('_ACA_INFO_LIST_NAME', compa::encodeutf('Ingrese el nombre de su lista. Usted puede identificar su lista mediante este nombre.'));
define('_ACA_INFO_LIST_DESC', compa::encodeutf('Ingrese una breve descripción de su lista. Esta descripción será visible por los visitantes de su portal.'));
define('_ACA_INFO_LIST_SENDER_NAME', compa::encodeutf('Ingrese el nombre del remitente del envío. Este nombre será visible cuando los suscriptores reciban mensajes de esta lista.'));
define('_ACA_INFO_LIST_SENDER_EMAIL', compa::encodeutf('Ingrese el correo electrónico del cual serán enviados los mensajes.'));
define('_ACA_INFO_LIST_SENDER_BOUNCED', compa::encodeutf('Ingrese el correo electrónico al cual podrán responder los suscriptores. Es áltamente recomendable que sea el mismo del cual ha sido enviado el mensaje puesto que los filtros de spam pueden considerarlo como riesgoso si encuentran diferencias.'));
define('_ACA_INFO_LIST_AUTORESP', compa::encodeutf('Escoja el tipo de envío para esta lista. <br />' .
		'Boletín: boletín normal<br />' .
		'Auto-respuesta: una auto-respuesta es una lista que es enviada automáticamente mediante el portal web a intervalos regulares.'));
define('_ACA_INFO_LIST_FREQUENCY', compa::encodeutf('Permitir a los usuarios seleccionar la frecuencia con la cual recibirán la lista.  Esto les provee flexibilidad de operación.'));
define('_ACA_INFO_LIST_TIME', compa::encodeutf('Permita que el usuario escoja el momento del día en el cual recibirá la lista.'));
define('_ACA_INFO_LIST_MIN_DAY', compa::encodeutf('Defina cual es la frecuencia mínima que el usuario podrá escoger para recibir la lista'));
define('_ACA_INFO_LIST_DELAY', compa::encodeutf('Defina cual es el retardo entre esta auto-respuesta y la anterior.'));
define('_ACA_INFO_LIST_DATE', compa::encodeutf('Especifique la fecha para publicar las nuevas listas si quiere retardar la publicación. <br /> FORMATO : YYYY-MM-DD HH:MM:SS'));
define('_ACA_INFO_LIST_MAX_DAY', compa::encodeutf('Defina cual es la frecuencia máxima que el usuario podrá escoger para recibir la lista'));
define('_ACA_INFO_LIST_LAYOUT', compa::encodeutf('Ingrese el diseño de sus envíos. Puede ingresar cualquier diseño para sus correos.'));
define('_ACA_INFO_LIST_SUB_MESS', compa::encodeutf('Este mensaje será enviado al suscriptor cuando el o ella se registren por primera vez. Puede definir el texto que desee aquí.'));
define('_ACA_INFO_LIST_UNSUB_MESS', compa::encodeutf('Este mensaje será enviado al suscriptor cuando el o ella se de-suscriba. Puede ingresar cualquier mensaje aquí.'));
define('_ACA_INFO_LIST_HTML', compa::encodeutf('Seleccione la casilla de verificación si quiere enviar correos en formato HTML. Los suscriptores pueden especificar si desean recibir mensajes en formato HTML o en texto llano cuando se suscriben a una lista HTML.'));
define('_ACA_INFO_LIST_HIDDEN', compa::encodeutf('Elija SI para esconder la lista en el portal web, los usuarios no serán capaces de suscribirse pero usted podrá seguir enviando listas a los que ya se han registrado.'));
define('_ACA_INFO_LIST_ACA_AUTO_SUB', compa::encodeutf('¿Quiere suscribir usuarios automáticamente a esta lista?<br /><B>Nuevos usuarios:</B> serán registrados todos los nuevos usuarios que se registren a través del portal web.<br /><B>Todos los usuarios:</B> serán registrados todos los usuarios de la base de datos.<br />(todas estas opciones soportan Community Builder)'));
define('_ACA_INFO_LIST_ACC_LEVEL', compa::encodeutf('Seleccione el nivel de acceso del portal web. Esto podrá mostrar u ocultar los envíos a los grupos de usuarios que no tengan acceso a ella, por tanto no tendrán la opción de suscribirse.'));
define('_ACA_INFO_LIST_ACC_USER_ID', compa::encodeutf('Seleccione el nivel de acceso de los grupos de usuarios a los cuales permitirá la edición. Ese grupo y los inmediatamente superiores tendrán la posibilidad de editar los envíos y remitirlos tanto desde el portal web como desde el panel administrativo.'));
define('_ACA_INFO_LIST_FOLLOW_UP', compa::encodeutf('Puede especificar el seguimiento  de la auto-respuesta si usted desea que sea movida a otra una vez que alcance el último mensaje.'));
define('_ACA_INFO_LIST_ACA_OWNER', compa::encodeutf('Esta es la identificación de la persona que creó la lista.'));
define('_ACA_INFO_LIST_WARNING', compa::encodeutf('   Esta última opción estará disponible sólo al momento de la creación de la lista.'));
define('_ACA_INFO_LIST_SUBJET', compa::encodeutf(' Asunto del envío.  Este es el asunto que mostrará el mensaje que el suscriptor reciba.'));
define('_ACA_INFO_MAILING_CONTENT', compa::encodeutf('Este es el cuerpo del mensaje que usted quiere enviar.'));
define('_ACA_INFO_MAILING_NOHTML', compa::encodeutf('Ingrese el cuerpo del mensaje que usted desea enviar a los suscriptores que escogieron secibir sólo mensajes en texto llano. <BR/> NOTE: Si lo deja en blanco Acajoom convertirá automáticamente el HTML a texto llano.'));
define('_ACA_INFO_MAILING_VISIBLE', compa::encodeutf('Seleccione SI para mostrar el mensaje en el portal web.'));
define('_ACA_INSERT_CONTENT', compa::encodeutf('Inserte un contenido existente'));

// Coupons
define('_ACA_SEND_COUPON_SUCCESS', compa::encodeutf('¡Cupón enviado con éxito!'));
define('_ACA_CHOOSE_COUPON', compa::encodeutf('Seleccione un cupón'));
define('_ACA_TO_USER', compa::encodeutf(' para este usuario'));

### Cron options
//drop down frequency(CRON)
define('_ACA_FREQ_CH1', compa::encodeutf('Cada hora'));
define('_ACA_FREQ_CH2', compa::encodeutf('Cada 6 horas'));
define('_ACA_FREQ_CH3', compa::encodeutf('Cada 12 horas'));
define('_ACA_FREQ_CH4', compa::encodeutf('Diario'));
define('_ACA_FREQ_CH5', compa::encodeutf('Semanal'));
define('_ACA_FREQ_CH6', compa::encodeutf('Mensual'));
define('_ACA_FREQ_NONE', compa::encodeutf('No'));
define('_ACA_FREQ_NEW', compa::encodeutf('Nuevos usuarios'));
define('_ACA_FREQ_ALL', compa::encodeutf('Todos los usuarios'));

//Label CRON form
define('_ACA_LABEL_FREQ', compa::encodeutf('¿Tarea Cron de Acajoom?'));
define('_ACA_LABEL_FREQ_TIPS', compa::encodeutf('Seleccione SI en el caso que desee usar esto para una tarea Cron de Acajoom, NO para cualquier otra tarea Cron.<br />' .
		'Si escoge SI no necesita especificar la dirección de la tarea Cron puesto que será añadida automaticamente.'));
define('_ACA_SITE_URL', compa::encodeutf('Su dirección URL'));
define('_ACA_CRON_FREQUENCY', compa::encodeutf('Frecuencia de tarea Cron'));
define('_ACA_STARTDATE_FREQ', compa::encodeutf('Fecha de inicio'));
define('_ACA_LABELDATE_FREQ', compa::encodeutf('Especifique fecha'));
define('_ACA_LABELTIME_FREQ', compa::encodeutf('Especifique hora'));
define('_ACA_CRON_URL', compa::encodeutf('Dirección URL de tarea Cron'));
define('_ACA_CRON_FREQ', compa::encodeutf('Frecuencia'));
define('_ACA_TITLE_CRONLIST', compa::encodeutf('Lista de tareas Cron'));
define('_NEW_LIST', compa::encodeutf('Cree una nueva lista'));

//title CRON form
define('_ACA_TITLE_FREQ', compa::encodeutf('Editar tareas Cron'));
define('_ACA_CRON_SITE_URL', compa::encodeutf('Por favor ingrese una URL válida que empiece con http://'));

### Mailings ###
define('_ACA_MAILING_ALL', compa::encodeutf('Todos los envíos'));
define('_ACA_EDIT_A', compa::encodeutf('Editar un '));
define('_ACA_SELCT_MAILING', compa::encodeutf('Por favor seleccione una lista del menú desplegable a fin de añadir un nuevo envío.'));
define('_ACA_VISIBLE_FRONT', compa::encodeutf('Visible en el portal web'));

// mailer
define('_ACA_SUBJECT', compa::encodeutf('Asunto'));
define('_ACA_CONTENT', compa::encodeutf('Contenido'));
define('_ACA_NAMEREP', compa::encodeutf('[NAME] = Este campo será reemplazado por el nombre que el suscriptor haya ingresado al registrarse, con ello podrá personalizar sus mensajes.<br />'));
define('_ACA_FIRST_NAME_REP', compa::encodeutf('[FIRSTNAME] = Este campo será reemplazado por el primer nombre del suscriptor.<br />'));
define('_ACA_NONHTML', compa::encodeutf('Version en texto llano'));
define('_ACA_ATTACHMENTS', compa::encodeutf('Archivos adjuntos'));
define('_ACA_SELECT_MULTIPLE', compa::encodeutf('Mantenga presionado CTRL (o command) para seleccionar múltiples archivos adjuntos.<br />' .
		'Los ficheros mostrados en este grupo están localizados en la carpeta de archivos adjuntos, usted puede cambiar la ubicación en el panel de control.'));
define('_ACA_CONTENT_ITEM', compa::encodeutf('Artículos con contenido'));
define('_ACA_SENDING_EMAIL', compa::encodeutf('Enviando correo'));
define('_ACA_MESSAGE_NOT', compa::encodeutf('El mensaje no pudo ser enviado'));
define('_ACA_MAILER_ERROR', compa::encodeutf('Error del proceso de correo'));
define('_ACA_MESSAGE_SENT_SUCCESSFULLY', compa::encodeutf('Mensaje enviado con éxito'));
define('_ACA_SENDING_TOOK', compa::encodeutf('Enviar este mensaje tomará'));
define('_ACA_SECONDS', compa::encodeutf('segundos'));
define('_ACA_NO_ADDRESS_ENTERED', compa::encodeutf('No se ha especificado dirección de correo o suscriptor'));
define('_ACA_CHANGE_SUBSCRIPTIONS', compa::encodeutf('Cambiar'));
define('_ACA_CHANGE_EMAIL_SUBSCRIPTION', compa::encodeutf('Cambiar la suscripción'));
define('_ACA_WHICH_EMAIL_TEST', compa::encodeutf('Indique una dirección de correo donde enviar un mensaje de prueba para comprobar la visualización'));
define('_ACA_SEND_IN_HTML', compa::encodeutf('¿Enviar con formato HTML (para listas html)?'));
define('_ACA_VISIBLE', compa::encodeutf('Visible'));
define('_ACA_INTRO_ONLY', compa::encodeutf('Sólo introducción'));

// stats
define('_ACA_GLOBALSTATS', compa::encodeutf('Estadísticas globales'));
define('_ACA_DETAILED_STATS', compa::encodeutf('Estadísticas detalladas'));
define('_ACA_MAILING_LIST_DETAILS', compa::encodeutf('Estadísticas de listas'));
define('_ACA_SEND_IN_HTML_FORMAT', compa::encodeutf('Enviar con formato HTML'));
define('_ACA_VIEWS_FROM_HTML', compa::encodeutf('Vistas (de correos html)'));
define('_ACA_SEND_IN_TEXT_FORMAT', compa::encodeutf('Enviar como texto llano'));
define('_ACA_HTML_READ', compa::encodeutf('leído HTML'));
define('_ACA_HTML_UNREAD', compa::encodeutf('no leído HTML'));
define('_ACA_TEXT_ONLY_SENT', compa::encodeutf('Texto llano'));

// Configuration panel
// main tabs
define('_ACA_MAIL_CONFIG', compa::encodeutf('Correo'));
define('_ACA_LOGGING_CONFIG', compa::encodeutf('Registro y estadísticas'));
define('_ACA_SUBSCRIBER_CONFIG', compa::encodeutf('Suscriptores'));
define('_ACA_MISC_CONFIG', compa::encodeutf('Otros'));
define('_ACA_MAIL_SETTINGS', compa::encodeutf('Configuración de cuenta de correo'));
define('_ACA_MAILINGS_SETTINGS', compa::encodeutf('Configuración de envíos'));
define('_ACA_SUBCRIBERS_SETTINGS', compa::encodeutf('Configuración de suscriptores'));
define('_ACA_CRON_SETTINGS', compa::encodeutf('Configuración de tareas Cron'));
define('_ACA_SENDING_SETTINGS', compa::encodeutf('Configuración de despachos'));
define('_ACA_STATS_SETTINGS', compa::encodeutf('Configuración de estadísticas'));
define('_ACA_LOGS_SETTINGS', compa::encodeutf('Configuración de registros'));
define('_ACA_MISC_SETTINGS', compa::encodeutf('Otras configuraciones'));
// mail settings
define('_ACA_SEND_MAIL_FROM', compa::encodeutf('Correo de envío'));
define('_ACA_SEND_MAIL_NAME', compa::encodeutf('Nombre de envío'));
define('_ACA_MAILSENDMETHOD', compa::encodeutf('Método de correo'));
define('_ACA_SENDMAILPATH', compa::encodeutf('Ruta de Sendmail'));
define('_ACA_SMTPHOST', compa::encodeutf('Servidor SMTP'));
define('_ACA_SMTPAUTHREQUIRED', compa::encodeutf('Autentificación requerida por SMTP'));
define('_ACA_SMTPAUTHREQUIRED_TIPS', compa::encodeutf('Seleccione SI en el caso que su servidor SMTP requiera autentificación'));
define('_ACA_SMTPUSERNAME', compa::encodeutf('Usuario SMTP'));
define('_ACA_SMTPUSERNAME_TIPS', compa::encodeutf('Ingrese el nombre de usuario para el servidor SMTP'));
define('_ACA_SMTPPASSWORD', compa::encodeutf('Contraseña SMTP'));
define('_ACA_SMTPPASSWORD_TIPS', compa::encodeutf('Ingrese la contraseña para el servidor SMTP'));
define('_ACA_USE_EMBEDDED', compa::encodeutf('Usar imágenes incluídas'));
define('_ACA_USE_EMBEDDED_TIPS', compa::encodeutf('Seleccione SI en el caso que las imágenes adjuntas en los artículos con contenido deban ser incluídas en el correo con formato html. Seleccione NO para usar etiquetas de imágenes que las vincularán con una dirección de su sitio web.'));
define('_ACA_UPLOAD_PATH', compa::encodeutf('Ruta de subida/archivos adjuntos'));
define('_ACA_UPLOAD_PATH_TIPS', compa::encodeutf('Puede especificar un directorio para carga de archivos.<br />' .
		'Asegúrese que el directorio especificado exista de lo contrario créelo.'));

// Suscriptors settings
define('_ACA_ALLOW_UNREG', compa::encodeutf('Permitir no registrados'));
define('_ACA_ALLOW_UNREG_TIPS', compa::encodeutf('Seleccione SI en el caso que desee que sus usuarios se suscriban a las listas sin haberse registrado en su portal web.'));
define('_ACA_REQ_CONFIRM', compa::encodeutf('Requerir confirmación'));
define('_ACA_REQ_CONFIRM_TIPS', compa::encodeutf('Seleccione SI en el caso que requiera que sus suscriptores no registrados confirmen sus direcciones de correo electrónico.'));
define('_ACA_SUB_SETTINGS', compa::encodeutf('Configuración de suscripción'));
define('_ACA_SUBMESSAGE', compa::encodeutf('Correo de suscripción'));
define('_ACA_SUBSCRIBE_LIST', compa::encodeutf('Suscribirse a una lista'));

define('_ACA_USABLE_TAGS', compa::encodeutf('Etiquetas usables'));
define('_ACA_NAME_AND_CONFIRM', compa::encodeutf('<b>[CONFIRM]</b> = Este campo crea un vínculo donde el suscriptor puede confirmar su suscripción, es <strong>requerida</strong> para que Acajoom funcione correctamente.<br />'
.'<br />[NAME] = Este campo será reemplazado por el nombre que el suscriptor haya ingresado al registrarse, con ello podrá personalizar sus mensajes.<br />'
.'<br />[FIRSTNAME] = Este campo será reemplazado por el primer nombre del suscriptor.<br />'));
define('_ACA_CONFIRMFROMNAME', compa::encodeutf('Nombre de remitente en correo de confirmación'));
define('_ACA_CONFIRMFROMNAME_TIPS', compa::encodeutf('Ingrese el nombre para mostrar en la confirmación de listas.'));
define('_ACA_CONFIRMFROMEMAIL', compa::encodeutf('Correo de remitente en confirmación'));
define('_ACA_CONFIRMFROMEMAIL_TIPS', compa::encodeutf('Ingrese la dirección de correo que se mostrará en la confirmación de listas.'));
define('_ACA_CONFIRMBOUNCE', compa::encodeutf('Correo de respuesta'));
define('_ACA_CONFIRMBOUNCE_TIPS', compa::encodeutf('Ingrese la dirección de correo de respuesta en la confirmación de listas.'));
define('_ACA_HTML_CONFIRM', compa::encodeutf('Confirmación de HTML'));
define('_ACA_HTML_CONFIRM_TIPS', compa::encodeutf('Seleccione SI  en el caso que que la confirmación de la lista deba ser html si es que el usuario lo permite.'));
define('_ACA_TIME_ZONE_ASK', compa::encodeutf('Solicitar zona horaria'));
define('_ACA_TIME_ZONE_TIPS', compa::encodeutf('Seleccione SI en el caso que desee preguntar al usuario su zona horaria. Los correos pendientes se basarán en la zona horaria cuando sea aplicable'));

 // Cron Set up
 define('_ACA_AUTO_CONFIG', compa::encodeutf('Tareas Cron'));
define('_ACA_TIME_OFFSET_URL', compa::encodeutf('Seleccione para configurar la compensación horaria (offset) en el panel de configuracioón global -> Tabulador Local'));
define('_ACA_TIME_OFFSET_TIPS', compa::encodeutf('Configure la compensación horaria en su servidor a fin que los registros de fecha y hora sean exactos'));
define('_ACA_TIME_OFFSET', compa::encodeutf('Compensación horaria'));
define('_ACA_CRON_DESC', compa::encodeutf('<br />¡Usando la función de tareas Cron podrá configurar la automatización de trabajos para su sitio Joomla!<br />' .
		'Para configurarlo usted necesitará añadir en las tareas Cron de su panel de control el siguiente commando:<br />' .
		'<b>' . ACA_JPATH_LIVE . '/index2.php?option=com_acajoom&act=cron</b> ' .
		'<br /><br />Si usted necesita ayuda para efectuar la configuración o tiene problemas por favor remítase a nuestros foros en <a href="http://www.ijoobi.com" target="_blank">http://www.ijoobi.com</a>'));
// sending settings
define('_ACA_PAUSEX', compa::encodeutf('Detener x segundos cada cierta cantidad de correos'));
define('_ACA_PAUSEX_TIPS', compa::encodeutf('Ingrese el número de segundos que Acajoom deberá dar al servidor SMTP para enviar los mensajes antes de proceder con la siguiente cantidad configurada de mensajes.'));
define('_ACA_EMAIL_BET_PAUSE', compa::encodeutf('Correos entre pausas'));
define('_ACA_EMAIL_BET_PAUSE_TIPS', compa::encodeutf('La cantidad de correos a enviar antes de detener.'));
define('_ACA_WAIT_USER_PAUSE', compa::encodeutf('Esperar por confirmación de usuario en la pausa'));
define('_ACA_WAIT_USER_PAUSE_TIPS', compa::encodeutf('En el caso que el script deba esperar a la confirmación del usuario entre los grupos de mensajes.'));
define('_ACA_SCRIPT_TIMEOUT', compa::encodeutf('Tiempo de espera del Script'));
define('_ACA_SCRIPT_TIMEOUT_TIPS', compa::encodeutf('La cantidad de minutos que el script debe esperar en ejecución (0 para ilimitado).'));
// Stats settings
define('_ACA_ENABLE_READ_STATS', compa::encodeutf('Permitir estadísticas de lectura'));
define('_ACA_ENABLE_READ_STATS_TIPS', compa::encodeutf('Seleccione SI en el caso que desee registrar la cantidad de lecturas. Esta técnica sólo puede ser usada en los envíos html'));
define('_ACA_LOG_VIEWSPERSUB', compa::encodeutf('Registro de lecturas por suscriptor'));
define('_ACA_LOG_VIEWSPERSUB_TIPS', compa::encodeutf('Seleccione SI en el caso que desee registrar el número de lecturas por suscriptor. Esta técnica sólo puede ser usada en los envíos html'));
// Logs settings
define('_ACA_DETAILED', compa::encodeutf('Registros detallados'));
define('_ACA_SIMPLE', compa::encodeutf('Registros simples'));
define('_ACA_DIAPLAY_LOG', compa::encodeutf('Mostrar registros'));
define('_ACA_DISPLAY_LOG_TIPS', compa::encodeutf('Seleccione SI en el caso que desee mostrar los registros mientras procesa sus envíos.'));
define('_ACA_SEND_PERF_DATA', compa::encodeutf('Performance de envíos'));
define('_ACA_SEND_PERF_DATA_TIPS', compa::encodeutf('Seleccione SI en el caso que desee permitir a Acajoom enviar reportes ANÓNIMOS respecto a su configuración, número de suscriptores de una lista y el tiempo que tomó realizar el envío. Esto puede darnos una idea del performance de Acajoom y nos podrá AYUDAR a mejorar Acajoom en entregas futuras.'));
define('_ACA_SEND_AUTO_LOG', compa::encodeutf('Enviar registros para auto-respuestas'));
define('_ACA_SEND_AUTO_LOG_TIPS', compa::encodeutf('Seleccione SI en el caso que desee enviar un correo de registro cada vez que un proceso es ejecutado.  ADVERTENCIA: esto puede desencadenar la generación de una alta cantidad de correos.'));
define('_ACA_SEND_LOG', compa::encodeutf('Enviar Registro'));
define('_ACA_SEND_LOG_TIPS', compa::encodeutf('Si un registro del envío debe ser remitido a la dirección de correo del usuario que programó el mismo.'));
define('_ACA_SEND_LOGDETAIL', compa::encodeutf('Enviar detalles de registro'));
define('_ACA_SEND_LOGDETAIL_TIPS', compa::encodeutf('Detallado: Incluye información detallada del éxito o fracaso por cada suscriptor junto con un resumen global. Simple: Sólo envía el resumen.'));
define('_ACA_SEND_LOGCLOSED', compa::encodeutf('Enviar registro si la conexión se cerró'));
define('_ACA_SEND_LOGCLOSED_TIPS', compa::encodeutf('Con esta opción el usuario que generó el envío podrá recibir un reporte por correo.'));
define('_ACA_SAVE_LOG', compa::encodeutf('Guardar registro'));
define('_ACA_SAVE_LOG_TIPS', compa::encodeutf('Si un registro de envío debe ser guardado en un archivo.'));
define('_ACA_SAVE_LOGDETAIL', compa::encodeutf('Guardar detalles de registro'));
define('_ACA_SAVE_LOGDETAIL_TIPS', compa::encodeutf('Detallado: Incluye información detallada del éxito o fracaso por cada Suscriptor junto con un resumen global. Simple: Sólo envía el resumen.'));
define('_ACA_SAVE_LOGFILE', compa::encodeutf('Archivo de registro'));
define('_ACA_SAVE_LOGFILE_TIPS', compa::encodeutf('Archivo donde la información será guardada. Este archivo puede ser extenso.'));
define('_ACA_CLEAR_LOG', compa::encodeutf('Borrar registros'));
define('_ACA_CLEAR_LOG_TIPS', compa::encodeutf('Limpia el archivo de registros.'));

### control panel
define('_ACA_CP_LAST_QUEUE', compa::encodeutf('Último proceso ejecutado'));
define('_ACA_CP_TOTAL', compa::encodeutf('Total'));
define('_ACA_MAILING_COPY', compa::encodeutf('¡Envío copiado con éxito!'));

// Miscellaneous settings
define('_ACA_SHOW_GUIDE', compa::encodeutf('Mostrar guía'));
define('_ACA_SHOW_GUIDE_TIPS', compa::encodeutf('Muestra la guía cuando inicia el componente a fin de facilitar a los nuevos usuarios la tarea de crear boletines, auto-respuestas y configurar Acajoom correctamente.'));
define('_ACA_AUTOS_ON', compa::encodeutf('Usar Auto-respuestas'));
define('_ACA_AUTOS_ON_TIPS', compa::encodeutf('Seleccione NO en el caso que no desee usar Auto-respuestas, todas las opciones de auto-respuestas serán desactivadas.'));
define('_ACA_NEWS_ON', compa::encodeutf('Usar Boletiness'));
define('_ACA_NEWS_ON_TIPS', compa::encodeutf('Select NO en el caso que no desee usar Boletines, todas las opciones de boletines serán desactivadas.'));
define('_ACA_SHOW_TIPS', compa::encodeutf('Mostrar consejos'));
define('_ACA_SHOW_TIPS_TIPS', compa::encodeutf('Mostrar consejos para ayudar a los usuarios a ejecutar Acajoom con mayor efectividad.'));
define('_ACA_SHOW_FOOTER', compa::encodeutf('Mostrar pie de página'));
define('_ACA_SHOW_FOOTER_TIPS', compa::encodeutf('Decidir si el pie de página con los derechos reservados debe ser o no mostrado.'));
define('_ACA_SHOW_LISTS', compa::encodeutf('Mostrar listas en el portal web'));
define('_ACA_SHOW_LISTS_TIPS', compa::encodeutf('Cuando un usuario no está registrado permite mostrar una lista de las listas a las cuales puede suscribirse con un botón de archivo para boletines o un simple formulario de registro.'));
define('_ACA_CONFIG_UPDATED', compa::encodeutf('¡Los detalles de configuración han sido actualizados!'));
define('_ACA_UPDATE_URL', compa::encodeutf('URL para actualizaciones'));
define('_ACA_UPDATE_URL_WARNING', compa::encodeutf('¡ADVERTENCIA! No cambie esta URL si antes no ha consultado con el equipo técnico de Acajoom.<br />'));
define('_ACA_UPDATE_URL_TIPS', compa::encodeutf('Por ejemplo: http://www.ijoobi.com/update/ (incluya la barra de cierre)'));

// module
define('_ACA_EMAIL_INVALID', compa::encodeutf('El correo ingresado no es válido.'));
define('_ACA_REGISTER_REQUIRED', compa::encodeutf('Por favor regístrese en el portal antes de registrarse en una lista.'));

// Access level box
define('_ACA_OWNER', compa::encodeutf('Creador de la lista:'));
define('_ACA_ACCESS_LEVEL', compa::encodeutf('Defina el nivel de acceso para la lisra'));
define('_ACA_ACCESS_LEVEL_OPTION', compa::encodeutf('Opciones de nivel de acceso'));
define('_ACA_USER_LEVEL_EDIT', compa::encodeutf('Seleccione qué nivel de usuario es permitido para editar un envío (tanto desde el portal como desde el panel de administración) '));

//  drop down options
define('_ACA_AUTO_DAY_CH1', compa::encodeutf('Diario'));
define('_ACA_AUTO_DAY_CH2', compa::encodeutf('Diario menos en fin de semana'));
define('_ACA_AUTO_DAY_CH3', compa::encodeutf('Cualquier otro día'));
define('_ACA_AUTO_DAY_CH4', compa::encodeutf('Cualquier otro día menos en fin de semana'));
define('_ACA_AUTO_DAY_CH5', compa::encodeutf('Semanal'));
define('_ACA_AUTO_DAY_CH6', compa::encodeutf('Cada 2 semanas'));
define('_ACA_AUTO_DAY_CH7', compa::encodeutf('Mensual'));
define('_ACA_AUTO_DAY_CH9', compa::encodeutf('Anual'));
define('_ACA_AUTO_OPTION_NONE', compa::encodeutf('No'));
define('_ACA_AUTO_OPTION_NEW', compa::encodeutf('Nuevos usuarios'));
define('_ACA_AUTO_OPTION_ALL', compa::encodeutf('Todos los usuarios'));

//
define('_ACA_UNSUB_MESSAGE', compa::encodeutf('Correo de de-suscripción'));
define('_ACA_UNSUB_SETTINGS', compa::encodeutf('Ajustes de de-suscripción'));
define('_ACA_AUTO_ADD_NEW_USERS', compa::encodeutf('¿Auto suscribir usuarios?'));

// Update and upgrade messages
define('_ACA_NO_UPDATES', compa::encodeutf('No hay actualizaciones disponibles.'));
define('_ACA_VERSION', compa::encodeutf('Versión de Acajoom'));
define('_ACA_NEED_UPDATED', compa::encodeutf('Archivos que necesitan ser actualizados:'));
define('_ACA_NEED_ADDED', compa::encodeutf('Archivos que necesitan ser añadidos:'));
define('_ACA_NEED_REMOVED', compa::encodeutf('Archivos que necesitan ser eliminados:'));
define('_ACA_FILENAME', compa::encodeutf('Nombre de archivo:'));
define('_ACA_CURRENT_VERSION', compa::encodeutf('Versión actual:'));
define('_ACA_NEWEST_VERSION', compa::encodeutf('Última Versión:'));
define('_ACA_UPDATING', compa::encodeutf('Actualizando'));
define('_ACA_UPDATE_UPDATED_SUCCESSFULLY', compa::encodeutf('Los archivos han sido actualizados con éxito.'));
define('_ACA_UPDATE_FAILED', compa::encodeutf('¡Actualización fallida!'));
define('_ACA_ADDING', compa::encodeutf('Añadiendo'));
define('_ACA_ADDED_SUCCESSFULLY', compa::encodeutf('Añadido con éxito.'));
define('_ACA_ADDING_FAILED', compa::encodeutf('¡Fallo al añadir!'));
define('_ACA_REMOVING', compa::encodeutf('Eliminando'));
define('_ACA_REMOVED_SUCCESSFULLY', compa::encodeutf('Eliminado con éxito.'));
define('_ACA_REMOVING_FAILED', compa::encodeutf('¡Falló la eliminación!'));
define('_ACA_INSTALL_DIFFERENT_VERSION', compa::encodeutf('Instale una versión diferente'));
define('_ACA_CONTENT_ADD', compa::encodeutf('Añadir contenido'));
define('_ACA_UPGRADE_FROM', compa::encodeutf('Importar datos (información de boletines y suscriptores) de '));
define('_ACA_UPGRADE_MESS', compa::encodeutf('No hay riesgo para la información existente. <br /> Este proceso sólo importará la información a la base de datos de Acajoom.'));
define('_ACA_CONTINUE_SENDING', compa::encodeutf('Continúe el envío'));

// Acajoom message
define('_ACA_UPGRADE1', compa::encodeutf('Puede fácilmente importar sus usuarios y boletines desde '));
define('_ACA_UPGRADE2', compa::encodeutf(' hacia Acajoom en el panel de actualizaciones.'));
define('_ACA_UPDATE_MESSAGE', compa::encodeutf('¡Una nueva versión de Acajoom está disponible! '));
define('_ACA_UPDATE_MESSAGE_LINK', compa::encodeutf('¡Seleccione para actualizar!'));
define('_ACA_CRON_SETUP', compa::encodeutf('Para que las auto-respuestas puedan ser enviadas debe configurar una tarea Cron.'));
define('_ACA_THANKYOU', compa::encodeutf('Gracias por escoger Acajoom, ¡Su asistente de comunicaciones!'));
define('_ACA_NO_SERVER', compa::encodeutf('Servidor de actualizaciones no disponible, por favor inténtelo más tarde.'));
define('_ACA_MOD_PUB', compa::encodeutf('El módulo de Acajoom no está publicado.'));
define('_ACA_MOD_PUB_LINK', compa::encodeutf('¡Presione aquí para publicarlo!'));
define('_ACA_IMPORT_SUCCESS', compa::encodeutf('Importado con éxito'));
define('_ACA_IMPORT_EXIST', compa::encodeutf('Suscriptor ya registrado en la base de datos'));

// Acajoom\'s Guide
define('_ACA_GUIDE', compa::encodeutf(' Asistente'));
define('_ACA_GUIDE_FIRST_ACA_STEP', compa::encodeutf('<p>¡Acajoom cuenta con grandes funcionalidades y este asistente lo guiará en un simple proceso de cuatro pasos para que pueda empezar a enviar sus boletines y auto-respuestas!<p />'));
define('_ACA_GUIDE_FIRST_ACA_STEP_DESC', compa::encodeutf('Primero: usted necesita añadir una lista.  Una lista puede ser de dos tipos: boletín o auto-respuesta.' .
		'  En la lista usted define todos los parámetros para hacer posible el envío de sus boletínes o auto-respuestas: nombre del remitente, diseño, mensaje de bienvenida a los suscriptores, etc...
<br /><br />Usted puede crear su primera lista aquí: <a href="index2.php?option=com_acajoom&act=list" >crear una lista</a> y seleccionar el botón "Nuevo".'));
define('_ACA_GUIDE_FIRST_ACA_STEP_UPGRADE', compa::encodeutf('Acajoom le brinda la facilidad de importar toda la información de sistemas de boletines anteriores.<br />' .
		' Vaya al panel de actualizaciones y escoja su antiguo sistema de boletines para importar los datos completos de usuarios y contenidos.<br /><br />' .
		'<span style="color:#FF5E00;" >IMPORTANTE: La importación esta libre de riesgos y no afectará de ninguna manera la información de su anterior sistema</span><br />' .
		'Luego de la importación usted podrá manejar sus suscriptores y envíos directamente en Acajoom.<br /><br />'));
define('_ACA_GUIDE_SECOND_ACA_STEP', compa::encodeutf('¡Felicitaciones su primera lista ha sido creada!  Ahora podrá usted escribir su primer %s.  Para crearlo vaya a: '));
define('_ACA_GUIDE_SECOND_ACA_STEP_AUTO', compa::encodeutf('Manejador de Auto-respuestas'));
define('_ACA_GUIDE_SECOND_ACA_STEP_NEWS', compa::encodeutf('Manejador de boletines'));
define('_ACA_GUIDE_SECOND_ACA_STEP_FINAL', compa::encodeutf(' y seleccione su %s. <br /> Luego seleccione su %s en la lista desplegable.  Cree su primer envío seleccionando "Nuevo"'));

define('_ACA_GUIDE_THRID_ACA_STEP_NEWS', compa::encodeutf('Antes de enviar su primer boletín puede necesitar revisar la configuración de correo.  ' .
		'Vaya a la <a href="index2.php?option=com_acajoom&act=configuration" >página de configuraciones</a> para verificar sus parámetros de correo. <br />'));
define('_ACA_GUIDE_THRID2_ACA_STEP_NEWS', compa::encodeutf('<br />Cuando este listo regrese al menú de boletines seleccione su envío y presione enviar'));

define('_ACA_GUIDE_THRID_ACA_STEP_AUTOS', compa::encodeutf('Para que su auto-respuesta sea enviada primero debe configurar una tarea Cron en su servidor. ' .
		' Por favor refiérase al tabulador Cron en el panel de configuración.' .
		' <a href="index2.php?option=com_acajoom&act=configuration" >presione aquí</a> para aprender acerca de configaciones de tareas Cron. <br />'));

define('_ACA_GUIDE_MODULE', compa::encodeutf(' <br />Asegúrese de haber publicado su módulo de Acajoom para que las personas puedan registrarse en sus listas.'));

define('_ACA_GUIDE_FOUR_ACA_STEP_NEWS', compa::encodeutf(' Ahora también puede configurar auto-respuestas.'));
define('_ACA_GUIDE_FOUR_ACA_STEP_AUTOS', compa::encodeutf(' Ahora también puede configurar un boletín.'));

define('_ACA_GUIDE_FOUR_ACA_STEP', compa::encodeutf('<p><br />¡Voila! Está listo para comunicarse efectivamente con sus usuarios. Este asistente terminará tan pronto como usted haya ingresado un segundo envío o lo haya desactivado en el <a href="index2.php?option=com_acajoom&act=configuration" >panel de control</a>.' .
		'<br /><br />  Si tuviera alguna consulta acerca de del uso de Acajoom, por favor refiérase a este ' .
		'<a target="_blank" href="http://www.ijoobi.com/index.php?option=com_agora&Itemid=60" >foro</a>. ' .
		' Usted podrá encontrar gran cantidad de información acerca de cómo comunicarse efectivamente con sus suscriptores en <a href="http://www.ijoobi.com/" target="_blank" >www.ijoobi.com</a>.' .
		'<p /><br /><b>Gracias por usar Acajoom. ¡Su asistente de comunicaciones!</b> '));
define('_ACA_GUIDE_TURNOFF', compa::encodeutf('El asistente ha sido desactivado!'));
define('_ACA_STEP', compa::encodeutf('PASO '));

// Acajoom Install
define('_ACA_INSTALL_CONFIG', compa::encodeutf('Configuración Acajoom'));
define('_ACA_INSTALL_SUCCESS', compa::encodeutf('Instalado con éxito'));
define('_ACA_INSTALL_ERROR', compa::encodeutf('¡Error en la instalación'));
define('_ACA_INSTALL_BOT', compa::encodeutf('Plugin Acajoom (Bot)'));
define('_ACA_INSTALL_MODULE', compa::encodeutf('Módulo Acajoom'));
//Others
define('_ACA_JAVASCRIPT', compa::encodeutf('!Advertencia! Javascript debe estar habilitado para permitir una correcta operación.'));
define('_ACA_EXPORT_TEXT', compa::encodeutf('La exportación de suscriptores estará basada en la lista que usted escoja. <br />Exportar suscriptores a lista'));
define('_ACA_IMPORT_TIPS', compa::encodeutf('Importar suscriptores. La información en el archivo necesita tener el siguiente formato: <br />' .
		'Nombre,correo,recibeHTML(1/0),<span style="color: rgb(255, 0, 0);">confirmado(1/0)</span>'));
define('_ACA_SUBCRIBER_EXIT', compa::encodeutf('es ya un suscriptor'));
define('_ACA_GET_STARTED', compa::encodeutf('¡Presione aquí para iniciar!'));

//News since 1.0.1
define('_ACA_WARNING_1011', compa::encodeutf('Advertencia: 1011: La actualización no funcionará por restricciones de su servidor.'));
define('_ACA_SEND_MAIL_FROM_TIPS', compa::encodeutf('Elija la dirección de correo que mostrará el remitente.'));
define('_ACA_SEND_MAIL_NAME_TIPS', compa::encodeutf('Elija el nombre que mostrará el remitente.'));
define('_ACA_MAILSENDMETHOD_TIPS', compa::encodeutf('Elija el mensajero que desea usar: función de correo PHP, <span>Sendmail</span> o servidor SMTP.'));
define('_ACA_SENDMAILPATH_TIPS', compa::encodeutf('Este es el directorio del servidor de correo'));
define('_ACA_LIST_T_TEMPLATE', compa::encodeutf('Plantilla'));
define('_ACA_NO_MAILING_ENTERED', compa::encodeutf('No se ha provisto envío'));
define('_ACA_NO_LIST_ENTERED', compa::encodeutf('No se ha provisto lista'));
define('_ACA_SENT_MAILING', compa::encodeutf('Envíos completados'));
define('_ACA_SELECT_FILE', compa::encodeutf('Por favor seleccione un archivo para '));
define('_ACA_LIST_IMPORT', compa::encodeutf('Revise la lista(s) a las cuales desea que sean asociados sus suscriptores.'));
define('_ACA_PB_QUEUE', compa::encodeutf('Suscriptor insertado pero presenta problemas al conectarlo/la a la lista(s). Por favor revise manualmente.'));
define('_ACA_UPDATE_MESS1', compa::encodeutf('¡Actualización áltamente recomendada!'));
define('_ACA_UPDATE_MESS2', compa::encodeutf('Parches y pequeñas reparaciones.'));
define('_ACA_UPDATE_MESS3', compa::encodeutf('Nueva entrega.'));
define('_ACA_UPDATE_MESS5', compa::encodeutf('Es requerido Joomla 1.5 para actualizar.'));
define('_ACA_UPDATE_IS_AVAIL', compa::encodeutf(' está disponible!'));
define('_ACA_NO_MAILING_SENT', compa::encodeutf('¡No se procesó envío!'));
define('_ACA_SHOW_LOGIN', compa::encodeutf('Mostrar formulario de ingreso'));
define('_ACA_SHOW_LOGIN_TIPS', compa::encodeutf('Seleccione SI para mostrar el formulario de ingreso en el panel de control de Acajoom del portal web a fin que los usuarios se registren.'));
define('_ACA_LISTS_EDITOR', compa::encodeutf('Editor de descripción de lista'));
define('_ACA_LISTS_EDITOR_TIPS', compa::encodeutf('Seleccione SI para usar un editor HTML a fin de modificar el campo descriptivo de la lista.'));
define('_ACA_SUBCRIBERS_VIEW', compa::encodeutf('Ver suscriptores'));

//News since 1.0.2
define('_ACA_FRONTEND_SETTINGS', compa::encodeutf('Configuración en portal web'));
define('_ACA_SHOW_LOGOUT', compa::encodeutf('Mostrar botón de salida'));
define('_ACA_SHOW_LOGOUT_TIPS', compa::encodeutf('Seleccione SI a fin de mostrar el botón de salida en el panel de control de Acajoom en el portal web.'));

//News since 1.0.3 CB integration
define('_ACA_CONFIG_INTEGRATION', compa::encodeutf('Integración'));
define('_ACA_CB_INTEGRATION', compa::encodeutf('Integración con Community Builder'));
define('_ACA_INSTALL_PLUGIN', compa::encodeutf('Plugin de Community Builder Plugin (Integración con Acajoom) '));
define('_ACA_CB_PLUGIN_NOT_INSTALLED', compa::encodeutf('¡El plugin Acajoom para Community Builder no ha sido instalado!'));
define('_ACA_CB_PLUGIN', compa::encodeutf('Listas al registrarse'));
define('_ACA_CB_PLUGIN_TIPS', compa::encodeutf('Seleccione SI a fin de mostrar las listas de correo al momento de registrarse con el formulario de Community Builder'));
define('_ACA_CB_LISTS', compa::encodeutf('IDs de listas'));
define('_ACA_CB_LISTS_TIPS', compa::encodeutf('ESTE ES UN CAMPO REQUERIDO. Ingrese el número identificador de las listas a las cuales desea que sus usuarios tengan acceso de suscripción separadas por comas (0 mostrará todas las listas)'));
define('_ACA_CB_INTRO', compa::encodeutf('Texto introductorio'));
define('_ACA_CB_INTRO_TIPS', compa::encodeutf('Texto que aparecerá antes de las listas. DÉJELO EN BLANCO PARA NO MOSTRAR NADA.  Usted puede usar etiquetas HTML para dar efectos visuales.'));
define('_ACA_CB_SHOW_NAME', compa::encodeutf('Mostrar nombres de listas'));
define('_ACA_CB_SHOW_NAME_TIPS', compa::encodeutf('Seleciónelo en el caso que desee o no mostrar el nombre de la lista luego de la introducción.'));
define('_ACA_CB_LIST_DEFAULT', compa::encodeutf('Activar listas por defecto'));
define('_ACA_CB_LIST_DEFAULT_TIPS', compa::encodeutf('Seleciónelo en el caso que desee o no mostrar activada la casilla de verificación por defecto.'));
define('_ACA_CB_HTML_SHOW', compa::encodeutf('Mostrar aceptación de HTML'));
define('_ACA_CB_HTML_SHOW_TIPS', compa::encodeutf('Seleccione SI para permitir a los usuarios la selección de correos con formato HTML. Seleccione NO para definir HTML por defecto.'));
define('_ACA_CB_HTML_DEFAULT', compa::encodeutf('Recibir HTML por defecto'));
define('_ACA_CB_HTML_DEFAULT_TIPS', compa::encodeutf('Configure esta opción para mostrar que los correos serán enviados en html por defecto. En el caso que "mostrar recepción como HTML" esté configurado en NO entonces esta será la opción por defecto.'));

// Since 1.0.4
define('_ACA_BACKUP_FAILED', compa::encodeutf('¡No pudo realizarse la copia de seguridad del archivo! El archivo no fue reemplazado.'));
define('_ACA_BACKUP_YOUR_FILES', compa::encodeutf('La versión antigua de los archivos ha sido guardada en el siguiente directorio:'));
define('_ACA_SERVER_LOCAL_TIME', compa::encodeutf('Hora local del servidor'));
define('_ACA_SHOW_ARCHIVE', compa::encodeutf('Mostrar botón de Archivo'));
define('_ACA_SHOW_ARCHIVE_TIPS', compa::encodeutf('Seleccione SI a fin de mostrar el botón de archivo en la sección de la lista ubicada en el portal web'));
define('_ACA_LIST_OPT_TAG', compa::encodeutf('Etiquetas'));
define('_ACA_LIST_OPT_IMG', compa::encodeutf('Imágenes'));
define('_ACA_LIST_OPT_CTT', compa::encodeutf('Contenido'));
define('_ACA_INPUT_NAME_TIPS', compa::encodeutf('Ingrese su nombre completo (nombre de pila al inicio)'));
define('_ACA_INPUT_EMAIL_TIPS', compa::encodeutf('ingrese su correo electrónico (asegúrese que es una dirección válida si desea recibir nuestros envíos.)'));
define('_ACA_RECEIVE_HTML_TIPS', compa::encodeutf('Seleccione SI a fin de recibir envíos HTML - Seleccione NO para recibir los envíos en texto llano'));
define('_ACA_TIME_ZONE_ASK_TIPS', compa::encodeutf('Especifique su zona horaria.'));

// Since 1.0.5
define('_ACA_FILES', compa::encodeutf('Archivos'));
define('_ACA_FILES_UPLOAD', compa::encodeutf('Cargar'));
define('_ACA_MENU_UPLOAD_IMG', compa::encodeutf('Cargar imágenes'));
define('_ACA_TOO_LARGE', compa::encodeutf('Archivo demasiado grande. El máximo tamaño permitido es'));
define('_ACA_MISSING_DIR', compa::encodeutf('El directorio de destino no existe'));
define('_ACA_IS_NOT_DIR', compa::encodeutf('El directorio de destino no existe o es un archivo regular.'));
define('_ACA_NO_WRITE_PERMS', compa::encodeutf('El directorio de destino no tiene permisos de escritura.'));
define('_ACA_NO_USER_FILE', compa::encodeutf('No ha seleccionado ningún archivo para cargar.'));
define('_ACA_E_FAIL_MOVE', compa::encodeutf('Imposible mover el archivo.'));
define('_ACA_FILE_EXISTS', compa::encodeutf('El archivo de destino ya existe.'));
define('_ACA_CANNOT_OVERWRITE', compa::encodeutf('El archivo de destino ya existe y no puede ser sobreescrito.'));
define('_ACA_NOT_ALLOWED_EXTENSION', compa::encodeutf('La extensión del archivo no está permitida.'));
define('_ACA_PARTIAL', compa::encodeutf('El archivo fue parcialmente cargado.'));
define('_ACA_UPLOAD_ERROR', compa::encodeutf('Error de carga:'));
define('DEV_NO_DEF_FILE', compa::encodeutf('El archivo fue parcialmente cargado.'));

// already exist but modified  added a <br/ on first line and added [SUBSCRIPTIONS] line>
define('_ACA_CONTENTREP', compa::encodeutf('[SUBSCRIPTIONS] = Este campo será reemplazado con el enlace de suscripción.' .
		' Esto es <strong>requerido</strong> para que Acajoom trabaje correctamente.<br />' .
		'Si usted coloca cualquier otro contenido en esta area, el mismo será mostrado en todos los envíos correspondientes a esta lista.' .
		' <br />Añada su mensaje de suscripción al final.  Acajoom añadirá automáticamente un enlace para que el suscriptor cambie su información y otro enlace para de-suscribirse de la lista.'));

// since 1.0.6
define('_ACA_NOTIFICATION', compa::encodeutf('Notificación'));  // shortcut for Email notification
define('_ACA_NOTIFICATIONS', compa::encodeutf('Notificaciones'));
define('_ACA_USE_SEF', compa::encodeutf('SEF en envíos'));
define('_ACA_USE_SEF_TIPS', compa::encodeutf('Es recomendable que usted elija NO.  Sin embargo si usted desea que las URL incluídas en su envío usen SEF seleccione SI.' .
		' <br /><b>Los enlaces trabajarán en cualquira de las opciones.  No podemos asegurar que los enlaces trabajarán siempre si usted cambia su SEF.</b> '));
define('_ACA_ERR_NB', compa::encodeutf('Error #: ERR'));
define('_ACA_ERR_SETTINGS', compa::encodeutf('Error manejando la configuración'));
define('_ACA_ERR_SEND', compa::encodeutf('Enviar reportes de error'));
define('_ACA_ERR_SEND_TIPS', compa::encodeutf('Si usted desea que Acajoom sea un mejor producto por favor seleccione SI.  Esto permitirá que nos envíe un reporte de error. Sin embargo usted no necesitará enviar nunca más reportes de errores ;-) <br /> <b>NINGUNA INFORMACIÓN PRIVADA ES ENVIADA</b>.  Nunca sabremos de que portal web proviene el error. Nosotros sólo enviamos información sobre Acajoom, la configuración PHP y las consultas SQL. '));
define('_ACA_ERR_SHOW_TIPS', compa::encodeutf('Seleccione SI para mostrar el número de error en su pantalla.  Principalmente usado para correción de fallas. '));
define('_ACA_ERR_SHOW', compa::encodeutf('Mostrar errores'));
define('_ACA_LIST_SHOW_UNSUBCRIBE', compa::encodeutf('Mostrar enlaces de de-suscripción'));
define('_ACA_LIST_SHOW_UNSUBCRIBE_TIPS', compa::encodeutf('Seleccione SI para mostrar los enlaces de de-suscripción al final de los envíos para que los usuarios puedan cambiar sus suscripciones. <br /> No desactive el pie de página y los vínculos.'));
define('_ACA_UPDATE_INSTALL', compa::encodeutf('<span style="color: rgb(255, 0, 0);">¡NOTICIA IMPORTANTE!</span> <br />Si usted está actualizando de una versión previamente instalada de Acajoom, necesitará actualizar la estructura de su base de datos presionando el siguiente botón (Su información se mantendrá íntegra)'));
define('_ACA_UPDATE_INSTALL_BTN', compa::encodeutf('Actualizar tablas y configuración'));
define('_ACA_MAILING_MAX_TIME', compa::encodeutf('Máximo tiempo de espera'));
define('_ACA_MAILING_MAX_TIME_TIPS', compa::encodeutf('Defina el máximo periodo de tiempo para cada grupo de correos enviados por el proceso. Se recomienda que sea entre 30s y 2mins.'));

// virtuemart integration beta
define('_ACA_VM_INTEGRATION', compa::encodeutf('Integración con VirtueMart'));
define('_ACA_VM_COUPON_NOTIF', compa::encodeutf('ID de notificación de cupón'));
define('_ACA_VM_COUPON_NOTIF_TIPS', compa::encodeutf('Especifique el número de ID del envío que usted desea usar para remitir cupones a sus compradores.'));
define('_ACA_VM_NEW_PRODUCT', compa::encodeutf('ID de Notificación de nuevos productos'));
define('_ACA_VM_NEW_PRODUCT_TIPS', compa::encodeutf('Especifique el número de ID del envío que usted desea usar para notificar la existencia de nuevos productos.'));

// since 1.0.8
// create forms for Suscripcións
define('_ACA_FORM_BUTTON', compa::encodeutf('Crear formulario'));
define('_ACA_FORM_COPY', compa::encodeutf('Código HTML'));
define('_ACA_FORM_COPY_TIPS', compa::encodeutf('Copie el código HTML generado en su página HTML.'));
define('_ACA_FORM_LIST_TIPS', compa::encodeutf('Seleccione la lista que desea incluir en el formulario'));
// update messages
define('_ACA_UPDATE_MESS4', compa::encodeutf('No puede ser actualizado automáticamente.'));
define('_ACA_WARNG_REMOTE_FILE', compa::encodeutf('No hay forma de recuperar el archivo remoto.'));
define('_ACA_ERROR_FETCH', compa::encodeutf('Error recuperando archivo.'));

define('_ACA_CHECK', compa::encodeutf('Revisar'));
define('_ACA_MORE_INFO', compa::encodeutf('Más información'));
define('_ACA_UPDATE_NEW', compa::encodeutf('Actualizar a nueva versión'));
define('_ACA_UPGRADE', compa::encodeutf('Actualizar a un producto mayor'));
define('_ACA_DOWNDATE', compa::encodeutf('Regresar a la versión previa'));
define('_ACA_DOWNGRADE', compa::encodeutf('Regresar al producto básico'));
define('_ACA_REQUIRE_JOOM', compa::encodeutf('Requiere Joomla'));
define('_ACA_TRY_IT', compa::encodeutf('¡Puébelo!'));
define('_ACA_NEWER', compa::encodeutf('Nuevo'));
define('_ACA_OLDER', compa::encodeutf('Antiguo'));
define('_ACA_CURRENT', compa::encodeutf('Actual'));

// since 1.0.9
define('_ACA_CHECK_COMP', compa::encodeutf('Pruebe uno de los otros componentes'));
define('_ACA_MENU_VIDEO', compa::encodeutf('Video tutoriales'));
define('_ACA_AUTO_SCHEDULE', compa::encodeutf('Programación'));
define('_ACA_SCHEDULE_TITLE', compa::encodeutf('Configuración de la función de programación automática'));
define('_ACA_ISSUE_NB_TIPS', compa::encodeutf('Número de publicación generado automáticamente por el sistema'));
define('_ACA_SEL_ALL', compa::encodeutf('Todos los envíos'));
define('_ACA_SEL_ALL_SUB', compa::encodeutf('Todas las listas'));
define('_ACA_INTRO_ONLY_TIPS', compa::encodeutf('Si usted selecciona esta opción, sólo la introducción del artículo será insertada en el envío junto con un enlace de "leer más" que lo dirigirpa hacia el artículo completo en el portal web.'));
define('_ACA_TAGS_TITLE', compa::encodeutf('Etiqueta de contenido'));
define('_ACA_TAGS_TITLE_TIPS', compa::encodeutf('Copie y pegue esta etiqueta dentro del envío en el cual desea que el contenido sea colocado.'));
define('_ACA_PREVIEW_EMAIL_TEST', compa::encodeutf('Indique la dirección a la cual se enviará el correo de prueba.'));
define('_ACA_PREVIEW_TITLE', compa::encodeutf('Vista previa'));
define('_ACA_AUTO_UPDATE', compa::encodeutf('Notificación de nuevas actualizaciones'));
define('_ACA_AUTO_UPDATE_TIPS', compa::encodeutf('Seleccione SI en el caso que desee ser notificado de nuevas actualizaciones para su componente. <br />¡IMPORTANTE!! Mostar consejos necesita estar activado para que esta función trabaje correctamente.'));

// since 1.1.0
define('_ACA_LICENSE', compa::encodeutf('Información de Licencia'));


// since 1.1.1
define('_ACA_NEW', compa::encodeutf('New'));
define('_ACA_SCHEDULE_SETUP', compa::encodeutf('In order for the autoresponders to be sent you need to setup scheduler in the configuration.'));
define('_ACA_SCHEDULER', compa::encodeutf('Scheduler'));
define('_ACA_ACAJOOM_CRON_DESC', compa::encodeutf('if you do not have access to a cron task manager on your website, you can register for a Free Acajoom Cron account at:'));
define('_ACA_CRON_DOCUMENTATION', compa::encodeutf('You can find further information on setting up the Acajoom Scheduler at the following url:'));
define('_ACA_CRON_DOC_URL', compa::encodeutf('<a href="http://www.ijoobi.com/index.php?option=com_content&view=article&id=4249&catid=29&Itemid=72"
 target="_blank">http://www.ijoobi.com/index.php?option=com_content&Itemid=72&view=category&layout=blog&id=29&limit=60</a>'));
define( '_ACA_QUEUE_PROCESSED', compa::encodeutf('Queue processed succefully...'));
define( '_ACA_ERROR_MOVING_UPLOAD', compa::encodeutf('Error moving imported file'));

//since 1.1.4
define( '_ACA_SCHEDULE_FREQUENCY', compa::encodeutf('Scheduler frequency'));
define( '_ACA_CRON_MAX_FREQ', compa::encodeutf('Scheduler max frequency'));
define( '_ACA_CRON_MAX_FREQ_TIPS', compa::encodeutf('Specify the maximum frequency the scheduler can run ( in minutes ).  This will limit the scheduler even if the cron task is set up more frequently.'));
define( '_ACA_CRON_MAX_EMAIL', compa::encodeutf('Maximum emails per task'));
define( '_ACA_CRON_MAX_EMAIL_TIPS', compa::encodeutf('Specify the maximum number of emails sent per task (0 unlimited).'));
define( '_ACA_CRON_MINUTES', compa::encodeutf(' minutes'));
define( '_ACA_SHOW_SIGNATURE', compa::encodeutf('Show email footer'));
define( '_ACA_SHOW_SIGNATURE_TIPS', compa::encodeutf('Whether or not you want to promote Acajoom in the footer of the emails.'));
define( '_ACA_QUEUE_AUTO_PROCESSED', compa::encodeutf('Auto-responders processed successfully...'));
define( '_ACA_QUEUE_NEWS_PROCESSED', compa::encodeutf('Scheduled newsletters processed successfully...'));
define( '_ACA_MENU_SYNC_USERS', compa::encodeutf('Sync Users'));
define( '_ACA_SYNC_USERS_SUCCESS', compa::encodeutf('Users Synchronization Successful!'));

// compatibility with Joomla 15
if (!defined('_BUTTON_LOGOUT')) define( '_BUTTON_LOGOUT', compa::encodeutf('Logout'));
if (!defined('_CMN_YES')) define( '_CMN_YES', compa::encodeutf('Yes'));
if (!defined('_CMN_NO')) define( '_CMN_NO', compa::encodeutf('No'));
if (!defined('_HI')) define( '_HI', compa::encodeutf('Hi'));
if (!defined('_CMN_TOP')) define( '_CMN_TOP', compa::encodeutf('Top'));
if (!defined('_CMN_BOTTOM')) define( '_CMN_BOTTOM', compa::encodeutf('Bottom'));
//if (!defined('_BUTTON_LOGOUT')) define( '_BUTTON_LOGOUT', compa::encodeutf('Logout'));

// For include title only or full article in content item tab in newsletter edit - p0stman911
define('_ACA_TITLE_ONLY_TIPS', compa::encodeutf('If you select this only the title of the article will be inserted into the mailing as a link to the complete article on your site.'));
define('_ACA_TITLE_ONLY', compa::encodeutf('Title Only'));
define('_ACA_FULL_ARTICLE_TIPS', compa::encodeutf('If you select this the complete article will be inserted into the mailing'));
define('_ACA_FULL_ARTICLE', compa::encodeutf('Full Article'));
define('_ACA_CONTENT_ITEM_SELECT_T', compa::encodeutf('Select a content item to append to the message. <br />Copy and paste the <b>content tag</b> into the mailing.  You can choose to have the full text, intro only, or title only with (0, 1, or 2 respectively). '));
define('_ACA_SUBSCRIBE_LIST2', compa::encodeutf('Mailing list(s)'));

// smart-newsletter function
define('_ACA_AUTONEWS', compa::encodeutf('Smart-Newsletter'));
define('_ACA_MENU_AUTONEWS', compa::encodeutf('Smart-Newsletters'));
define('_ACA_AUTO_NEWS_OPTION', compa::encodeutf('Smart-Newsletter options'));
define('_ACA_AUTONEWS_FREQ', compa::encodeutf('Newsletter Frequency'));
define('_ACA_AUTONEWS_FREQ_TIPS', compa::encodeutf('Specify the frequency at which you want to send the smart-newsletter.'));
define('_ACA_AUTONEWS_SECTION', compa::encodeutf('Article Section'));
define('_ACA_AUTONEWS_SECTION_TIPS', compa::encodeutf('Specify the section you want to choose the articles from.'));
define('_ACA_AUTONEWS_CAT', compa::encodeutf('Article Category'));
define('_ACA_AUTONEWS_CAT_TIPS', compa::encodeutf('Specify the category you want to choose the articles from (All for all article in that section).'));
define('_ACA_SELECT_SECTION', compa::encodeutf('All Sections'));
define('_ACA_SELECT_CAT', compa::encodeutf('All Categories'));
define('_ACA_AUTO_DAY_CH8', compa::encodeutf('Quaterly'));
define('_ACA_AUTONEWS_STARTDATE', compa::encodeutf('Start date'));
define('_ACA_AUTONEWS_STARTDATE_TIPS', compa::encodeutf('Specify the date you want to start sending the Smart Newsletter.'));
define('_ACA_AUTONEWS_TYPE', compa::encodeutf('Content rendering'));// how we see the content which is included in the newsletter
define('_ACA_AUTONEWS_TYPE_TIPS', compa::encodeutf('Full Article: will include the entire article in the newsletter.<br />' .
		'Intro only: will include only the introduction of the article in the newsletter.<br/>' .
		'Title only: will include only the title of the article in the newsletter.'));
define('_ACA_TAGS_AUTONEWS', compa::encodeutf('[SMARTNEWSLETTER] = This will be replaced by the Smart-newsletter.'));

//since 1.1.3
define('_ACA_MALING_EDIT_VIEW', compa::encodeutf('Create / View Mailings'));
define('_ACA_LICENSE_CONFIG', compa::encodeutf('License'));
define('_ACA_ENTER_LICENSE', compa::encodeutf('Enter license'));
define('_ACA_ENTER_LICENSE_TIPS', compa::encodeutf('Enter your license number and save it.'));
define('_ACA_LICENSE_SETTING', compa::encodeutf('License settings'));
define('_ACA_GOOD_LIC', compa::encodeutf('Your license is valid.'));
define('_ACA_NOTSO_GOOD_LIC', compa::encodeutf('Your license is not valid: '));
define('_ACA_PLEASE_LIC', compa::encodeutf('Please contact Acajoom support to upgrade your license ( license@ijoobi.com ).'));

define('_ACA_DESC_PLUS', compa::encodeutf('Acajoom Plus is the first sequencial auto-responders for Joomla CMS.  ' . _ACA_FEATURES));
define('_ACA_DESC_PRO', compa::encodeutf('Acajoom PRO the ultimate mailing system for Joomla CMS.  ' . _ACA_FEATURES));

//since 1.1.4
define('_ACA_ENTER_TOKEN', compa::encodeutf('Enter token'));
define('_ACA_ENTER_TOKEN_TIPS', compa::encodeutf('Please enter your token number you received by email when you purchased Acajoom. '));
define('_ACA_ACAJOOM_SITE', compa::encodeutf('Acajoom site:'));
define('_ACA_MY_SITE', compa::encodeutf('My site:'));
define( '_ACA_LICENSE_FORM', compa::encodeutf(' ' .
 		'Click here to go to the license form.</a>'));
define('_ACA_PLEASE_CLEAR_LICENSE', compa::encodeutf('Please clear the license field so it is empty and try again.<br />  If the problem persists, '));
define( '_ACA_LICENSE_SUPPORT', compa::encodeutf('If you still have questions, ' . _ACA_PLEASE_LIC));
define( '_ACA_LICENSE_TWO', compa::encodeutf('you can get your license manual by entering the token number and site URL (which is highlighted in green at the top of this page) in the License form. '
			. _ACA_LICENSE_FORM . '<br /><br/>' . _ACA_LICENSE_SUPPORT));
define('_ACA_ENTER_TOKEN_PATIENCE', compa::encodeutf('After saving your token a license will be generated automatically. ' .
		' Usually the token is validated in 2 minutes.  However, in some cases it can take up to 15 minutes.<br />' .
		'<br />Check back this control panel in few minutes.  <br /><br />' .
						     'If you didn\'t receive a valid license key in 15 minutes, '. _ACA_LICENSE_TWO));
define( '_ACA_ENTER_NOT_YET', compa::encodeutf('Your token has not yet been validated.'));
define( '_ACA_UPDATE_CLICK_HERE', compa::encodeutf('Pleae visit <a href="http://www.ijoobi.com" target="_blank">www.ijoobi.com</a> to download the newest version.'));
define( '_ACA_NOTIF_UPDATE', compa::encodeutf('To be notified of new updates enter your email address and click subscribe '));

define('_ACA_THINK_PLUS', compa::encodeutf('If you want more out of your mailing system think Plus!'));
define('_ACA_THINK_PLUS_1', compa::encodeutf('Sequential auto-responders'));
define('_ACA_THINK_PLUS_2', compa::encodeutf('Schedule the delivery of your newsletter for a predefined date'));
define('_ACA_THINK_PLUS_3', compa::encodeutf('No more server limitation'));
define('_ACA_THINK_PLUS_4', compa::encodeutf('and much more...'));


//since 1.2.2
define( '_ACA_LIST_ACCESS', compa::encodeutf('List Access'));
define( '_ACA_INFO_LIST_ACCESS', compa::encodeutf('Specify what group of users can view and subscribe to this list'));
define( 'ACA_NO_LIST_PERM', compa::encodeutf('You don\'t have enough permission to subscribe to this list'));

//Archive Configuration
 define('_ACA_MENU_TAB_ARCHIVE', compa::encodeutf('Archive'));
 define('_ACA_MENU_ARCHIVE_ALL', compa::encodeutf('Archive All'));

//Archive Lists
 define('_FREQ_OPT_0', compa::encodeutf('None'));
 define('_FREQ_OPT_1', compa::encodeutf('Every Week'));
 define('_FREQ_OPT_2', compa::encodeutf('Every 2 Weeks'));
 define('_FREQ_OPT_3', compa::encodeutf('Every Month'));
 define('_FREQ_OPT_4', compa::encodeutf('Every Quarter'));
 define('_FREQ_OPT_5', compa::encodeutf('Every Year'));
 define('_FREQ_OPT_6', compa::encodeutf('Other'));

define('_DATE_OPT_1', compa::encodeutf('Created date'));
define('_DATE_OPT_2', compa::encodeutf('Modified date'));

define('_ACA_ARCHIVE_TITLE', compa::encodeutf('Setting up auto-archive frequency'));
define('_ACA_FREQ_TITLE', compa::encodeutf('Archive frequency'));
define('_ACA_FREQ_TOOL', compa::encodeutf('Define how often you want the Archive Manager to arhive your website content.'));
define('_ACA_NB_DAYS', compa::encodeutf('Number of days'));
define('_ACA_NB_DAYS_TOOL', compa::encodeutf('This is only for the Other option! Please specify the number of days between each Archive.'));
define('_ACA_DATE_TITLE', compa::encodeutf('Date type'));
define('_ACA_DATE_TOOL', compa::encodeutf('Define if the archived should be done on the created date or modified date.'));

define('_ACA_MAINTENANCE_TAB', compa::encodeutf('Maintenance settings'));
define('_ACA_MAINTENANCE_FREQ', compa::encodeutf('Maintenance frequency'));
define( '_ACA_MAINTENANCE_FREQ_TIPS', compa::encodeutf('Specify the frequency at which you want the maintenance routine to run.'));
define( '_ACA_CRON_DAYS', compa::encodeutf('hour(s)'));

define( '_ACA_LIST_NOT_AVAIL', compa::encodeutf('There is no list available.'));
define( '_ACA_LIST_ADD_TAB', compa::encodeutf('Add/Edit'));

define( '_ACA_LIST_ACCESS_EDIT', compa::encodeutf('Mailing Add/Edit Access'));
define( '_ACA_INFO_LIST_ACCESS_EDIT', compa::encodeutf('Specify what group of users can add or edit a new mailing for this list'));
define( '_ACA_MAILING_NEW_FRONT', compa::encodeutf('Createa New Mailing'));

define('_ACA_AUTO_ARCHIVE', compa::encodeutf('Auto-Archive'));
define('_ACA_MENU_ARCHIVE', compa::encodeutf('Auto-Archive'));

//Extra tags:
define('_ACA_TAGS_ISSUE_NB', compa::encodeutf('[ISSUENB] = This will be replaced by the issue number of  the newsletter.'));
define('_ACA_TAGS_DATE', compa::encodeutf('[DATE] = This will be replaced by the sent date.'));
define('_ACA_TAGS_CB', compa::encodeutf('[CBTAG:{field_name}] = This will be replaced by the value taken from the Community Builder field: eg. [CBTAG:firstname] '));
define( '_ACA_MAINTENANCE', compa::encodeutf('Joobi Care'));


define('_ACA_THINK_PRO', compa::encodeutf('When you have professional needs, you use professional components!'));
define('_ACA_THINK_PRO_1', compa::encodeutf('Smart-Newsletters'));
define('_ACA_THINK_PRO_2', compa::encodeutf('Define access level for your list'));
define('_ACA_THINK_PRO_3', compa::encodeutf('Define who can edit/add mailings'));
define('_ACA_THINK_PRO_4', compa::encodeutf('More tags: add your CB fields'));
define('_ACA_THINK_PRO_5', compa::encodeutf('Joomla contents Auto-archive'));
define('_ACA_THINK_PRO_6', compa::encodeutf('Database optimization'));

define('_ACA_LIC_NOT_YET', compa::encodeutf('Your license is not yet valid.  Please check the license Tab in the configuration panel.'));
define('_ACA_PLEASE_LIC_GREEN', compa::encodeutf('Make sure to provide the green information at the top of the tab to our support team.'));

define('_ACA_FOLLOW_LINK', compa::encodeutf('Get Your License'));
define( '_ACA_FOLLOW_LINK_TWO', compa::encodeutf('You can get your license by entering the token number and site URL (which is highlighted in green at the top of this page) in the License form. '));
define( '_ACA_ENTER_TOKEN_TIPS2', compa::encodeutf(' Then click on Apply button in the top right menu.'));
define( '_ACA_ENTER_LIC_NB', compa::encodeutf('Enter your License'));
define( '_ACA_UPGRADE_LICENSE', compa::encodeutf('Upgrade Your License'));
define( '_ACA_UPGRADE_LICENSE_TIPS', compa::encodeutf('If you received a token to upgrade your license please enter it here, click Apply and proceed to number <b>2</b> to get your new license number.'));

define( '_ACA_MAIL_FORMAT', compa::encodeutf('Encoding format'));
define( '_ACA_MAIL_FORMAT_TIPS', compa::encodeutf('What format do you want to use for encoding your mailings, Text only or MIME'));
define( '_ACA_ACAJOOM_CRON_DESC_ALT', compa::encodeutf('If you do not have access to a cron task manager on your website, you can use the Free jCron component to create a cron task from your website.'));

//since 1.3.1
define('_ACA_SHOW_AUTHOR', compa::encodeutf('Show Author\'s Name'));
define('_ACA_SHOW_AUTHOR_TIPS', compa::encodeutf('Select Yes if you want to add the name of the author when you add an article in the Mailing'));

//since 1.3.5
define('_ACA_REGWARN_NAME', compa::encodeutf('Escriba su nombre.'));
define('_ACA_REGWARN_MAIL', compa::encodeutf('Escriba su e-mail.'));

//since 1.5.6
define('_ACA_ADDEMAILREDLINK_TIPS', compa::encodeutf('If you select Yes, the e-mail of the user will be added as a parameter at the end of your redirect URL (the redirect link for your module or for an external Acajoom form).<br/>That can be useful if you want to execute a special script in your redirect page.'));
define('_ACA_ADDEMAILREDLINK', compa::encodeutf('Add e-mail to the redirect link'));

//since 1.6.3
define('_ACA_ITEMID', compa::encodeutf('ItemId'));
define('_ACA_ITEMID_TIPS', compa::encodeutf('This ItemId will be added to your Acajoom links.'));

//since 1.6.5
define('_ACA_SHOW_JCALPRO', compa::encodeutf('jCalPRO'));
define('_ACA_SHOW_JCALPRO_TIPS', compa::encodeutf('Show the integration tab for jCalPRO <br/>(only if jCalPRO is installed on your website!)'));
define('_ACA_JCALTAGS_TITLE', compa::encodeutf('jCalPRO Tag:'));
define('_ACA_JCALTAGS_TITLE_TIPS', compa::encodeutf('Copy and paste this tag into the mailing where you want to have the event to be placed.'));
define('_ACA_JCALTAGS_DESC', compa::encodeutf('Description:'));
define('_ACA_JCALTAGS_DESC_TIPS', compa::encodeutf('Select Yes if you want to insert the description of the event'));
define('_ACA_JCALTAGS_START', compa::encodeutf('Start date:'));
define('_ACA_JCALTAGS_START_TIPS', compa::encodeutf('Select Yes if you want to insert the start date of the event'));
define('_ACA_JCALTAGS_READMORE', compa::encodeutf('Read more:'));
define('_ACA_JCALTAGS_READMORE_TIPS', compa::encodeutf('Select Yes if you want to insert a <b>read more link</b> for this event'));
define('_ACA_REDIRECTCONFIRMATION', compa::encodeutf('Redirect URL'));
define('_ACA_REDIRECTCONFIRMATION_TIPS', compa::encodeutf('If you require a confirmation e-mail, the user will be confirmed and redirected to this URL if he clicks on the confirmation link.'));

//since 2.0.0 compatibility with Joomla 1.5
if(!defined('_CMN_SAVE') and defined('CMN_SAVE')) define('_CMN_SAVE',CMN_SAVE);
if(!defined('_CMN_SAVE')) define('_CMN_SAVE','Save');
if(!defined('_NO_ACCOUNT')) define('_NO_ACCOUNT','No account yet?');
if(!defined('_CREATE_ACCOUNT')) define('_CREATE_ACCOUNT','Register');
if(!defined('_NOT_AUTH')) define('_NOT_AUTH','You are not authorised to view this resource.');

//since 3.0.0
define('_ACA_DISABLETOOLTIP', compa::encodeutf('Disable Tooltip'));
define('_ACA_DISABLETOOLTIP_TIPS', compa::encodeutf('Disable the tooltip on the frontend'));
define('_ACA_MINISENDMAIL', compa::encodeutf('Use Mini SendMail'));
define('_ACA_MINISENDMAIL_TIPS', compa::encodeutf('If your server use Mini SendMail, select this option to don\'t add the name of the user in the header of the e-mail'));

//Since 3.1.5
define('_ACA_READMORE','Read more...');
define('_ACA_VIEWARCHIVE','Click here');