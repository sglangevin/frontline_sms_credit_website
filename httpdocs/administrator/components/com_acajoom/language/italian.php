<?php
defined('_JEXEC') OR defined('_VALID_MOS') OR die('...Direct Access to this location is not allowed...');


/**
* <p>Italian language file.</p>
* @copyright (c) 2006 Acajoom Services / All Rights Reserved
* @author Maria Luisa Rossari <support@ijoobi.com>
* @version $Id: italian.php 491 2007-02-01 22:56:07Z divivo $
* @link http://www.ijoobi.com
*/

### Generale ###
 //Descrizione Acajoom
define('_ACA_DESC_NEWS', compa::encodeutf('Acajoom &egrave; gestione di liste indirizzi, newsletters, risposte automatiche, e tool di comunicazione follow up efficiente con i tuoi utenti e clienti.  ' .
		'Acajoom, il tuo Partner per la Comunicazione!'));
define('_ACA_FEATURES', compa::encodeutf('Acajoom, il tuo Partner per la Comunicazione!'));

// Typi di liste
define('_ACA_NEWSLETTER', compa::encodeutf('Newsletter'));
define('_ACA_AUTORESP', compa::encodeutf('Risposta automatica'));
define('_ACA_AUTORSS', compa::encodeutf('Auto-RSS'));
define('_ACA_ECARD', compa::encodeutf('eCard'));
define('_ACA_POSTCARD', compa::encodeutf('Cartolina'));
define('_ACA_PERF', compa::encodeutf('Prestazioni'));
define('_ACA_COUPON', compa::encodeutf('Buono'));
define('_ACA_CRON', compa::encodeutf('Cronologia'));
define('_ACA_MAILING', compa::encodeutf('Spedizione'));
define('_ACA_LIST', compa::encodeutf('Lista'));

 //Menu Acajoom
define('_ACA_MENU_LIST', compa::encodeutf('Gestione Liste'));
define('_ACA_MENU_SUBSCRIBERS', compa::encodeutf('Iscritti'));
define('_ACA_MENU_NEWSLETTERS', compa::encodeutf('Newsletters'));
define('_ACA_MENU_AUTOS', compa::encodeutf('Risposte automatiche'));
define('_ACA_MENU_COUPONS', compa::encodeutf('Buoni'));
define('_ACA_MENU_CRONS', compa::encodeutf('Cronologia'));
define('_ACA_MENU_AUTORSS', compa::encodeutf('Auto-RSS'));
define('_ACA_MENU_ECARD', compa::encodeutf('eCards'));
define('_ACA_MENU_POSTCARDS', compa::encodeutf('Cartoline'));
define('_ACA_MENU_PERFS', compa::encodeutf('Prestazioni'));
define('_ACA_MENU_TAB_LIST', compa::encodeutf('Liste'));
define('_ACA_MENU_MAILING_TITLE', compa::encodeutf('Invio'));
define('_ACA_MENU_MAILING', compa::encodeutf('Invio'));
define('_ACA_MENU_STATS', compa::encodeutf('Statistiche'));
define('_ACA_MENU_STATS_FOR', compa::encodeutf('Statistiche per '));
define('_ACA_MENU_CONF', compa::encodeutf('Configurazione'));
define('_ACA_MENU_UPDATE', compa::encodeutf('Import'));
define('_ACA_MENU_ABOUT', compa::encodeutf('Info su'));
define('_ACA_MENU_LEARN', compa::encodeutf('Centro di formazione'));
define('_ACA_MENU_MEDIA', compa::encodeutf('Media Manager'));
define('_ACA_MENU_HELP', compa::encodeutf('Aiuto'));
define('_ACA_MENU_CPANEL', compa::encodeutf('CPanel'));
define('_ACA_MENU_IMPORT', compa::encodeutf('Importa'));
define('_ACA_MENU_EXPORT', compa::encodeutf('Esporta'));
define('_ACA_MENU_SUB_ALL', compa::encodeutf('Iscrivi tutti'));
define('_ACA_MENU_UNSUB_ALL', compa::encodeutf('Rimuovi tutti'));
define('_ACA_MENU_VIEW_ARCHIVE', compa::encodeutf('Archivio'));
define('_ACA_MENU_PREVIEW', compa::encodeutf('Anteprima'));
define('_ACA_MENU_SEND', compa::encodeutf('Invio'));
define('_ACA_MENU_SEND_TEST', compa::encodeutf('Test invio Email'));
define('_ACA_MENU_SEND_QUEUE', compa::encodeutf('Coda Processi'));
define('_ACA_MENU_VIEW', compa::encodeutf('Vista'));
define('_ACA_MENU_COPY', compa::encodeutf('Copia'));
define('_ACA_MENU_VIEW_STATS', compa::encodeutf('Vista statistiche'));
define('_ACA_MENU_CRTL_PANEL', compa::encodeutf('Panello di controllo'));
define('_ACA_MENU_LIST_NEW', compa::encodeutf('Crea una lista'));
define('_ACA_MENU_LIST_EDIT', compa::encodeutf('Modifica una lista'));
define('_ACA_MENU_BACK', compa::encodeutf('Indietro'));
define('_ACA_MENU_INSTALL', compa::encodeutf('Installazione'));
define('_ACA_MENU_TAB_SUM', compa::encodeutf('Indice'));
define('_ACA_STATUS', compa::encodeutf('Stato'));

// messaggi
define('_ACA_ERROR', compa::encodeutf('Errore! '));
define('_ACA_SUB_ACCESS', compa::encodeutf('Privilegi di Accesso'));
define('_ACA_DESC_CREDITS', compa::encodeutf('Crediti'));
define('_ACA_DESC_INFO', compa::encodeutf('Informazioni'));
define('_ACA_DESC_HOME', compa::encodeutf('Homepage'));
define('_ACA_DESC_MAILING', compa::encodeutf('Lista di spedizione'));
define('_ACA_DESC_SUBSCRIBERS', compa::encodeutf('Iscritti'));
define('_ACA_PUBLISHED', compa::encodeutf('Pubblicato'));
define('_ACA_UNPUBLISHED', compa::encodeutf('Non Pubblicato'));
define('_ACA_DELETE', compa::encodeutf('Elimina'));
define('_ACA_FILTER', compa::encodeutf('Filtra'));
define('_ACA_UPDATE', compa::encodeutf('Aggiorna'));
define('_ACA_SAVE', compa::encodeutf('Salva'));
define('_ACA_CANCEL', compa::encodeutf('Cancella'));
define('_ACA_NAME', compa::encodeutf('Nome'));
define('_ACA_EMAIL', compa::encodeutf('E-mail'));
define('_ACA_SELECT', compa::encodeutf('Seleziona'));
define('_ACA_ALL', compa::encodeutf('di'));
define('_ACA_SEND_A', compa::encodeutf('Invia a '));
define('_ACA_SUCCESS_DELETED', compa::encodeutf('eliminato con successo'));
define('_ACA_LIST_ADDED', compa::encodeutf('Lista creata con successo'));
define('_ACA_LIST_COPY', compa::encodeutf('Lista copiata con successo'));
define('_ACA_LIST_UPDATED', compa::encodeutf('Lista aggiornata con successo'));
define('_ACA_MAILING_SAVED', compa::encodeutf('Mailing salvata con successo.'));
define('_ACA_UPDATED_SUCCESSFULLY', compa::encodeutf('aggiornato con successo.'));

### Informazioni iscritti ###
//info iscrizione e rimozione
define('_ACA_SUB_INFO', compa::encodeutf('Informazioni Iscritto\'i'));
define('_ACA_VERIFY_INFO', compa::encodeutf('Verifica il link che hai inserito, manca qualche informazione.'));
define('_ACA_INPUT_NAME', compa::encodeutf('Nome'));
define('_ACA_INPUT_EMAIL', compa::encodeutf('Email'));
define('_ACA_RECEIVE_HTML', compa::encodeutf('Ricevi HTML?'));
define('_ACA_TIME_ZONE', compa::encodeutf('Fuso orario'));
define('_ACA_BLACK_LIST', compa::encodeutf('Lista nera'));
define('_ACA_REGISTRATION_DATE', compa::encodeutf('Data di registrazione Utente'));
define('_ACA_USER_ID', compa::encodeutf('Id Utente'));
define('_ACA_DESCRIPTION', compa::encodeutf('Descrizione'));
define('_ACA_ACCOUNT_CONFIRMED', compa::encodeutf('Il tuo profilo &egrave; stato attivato.'));
define('_ACA_SUB_SUBSCRIBER', compa::encodeutf('Iscritto'));
define('_ACA_SUB_PUBLISHER', compa::encodeutf('Editore'));
define('_ACA_SUB_ADMIN', compa::encodeutf('Amministratore'));
define('_ACA_REGISTERED', compa::encodeutf('Registrato'));
define('_ACA_SUBSCRIPTIONS', compa::encodeutf('Iscrizioni'));
define('_ACA_SEND_UNSUBCRIBE', compa::encodeutf('Invia messaggio di cancellazione'));
define('_ACA_SEND_UNSUBCRIBE_TIPS', compa::encodeutf('Clicca Si per inviare una mail di cancellazione messaggio di conferma.'));
define('_ACA_SUBSCRIBE_SUBJECT_MESS', compa::encodeutf('Conferma la tua iscrizione'));
define('_ACA_UNSUBSCRIBE_SUBJECT_MESS', compa::encodeutf('Conferma cancellazione'));
define('_ACA_DEFAULT_SUBSCRIBE_MESS', compa::encodeutf('Ciao [NAME],<br />' .
	'Solo qualche passo e sarai iscritto alla lista.  Clicca sul link seguente per confermare la tua iscrizione.' .
	'<br /><br />[CONFIRM]<br /><br />Per informazioni contatta il webmaster.'));
define('_ACA_DEFAULT_UNSUBSCRIBE_MESS', compa::encodeutf('Ti confermiamo che sei stato rimosso dalla lista.  Ci dispiace che tu abbia deciso di cancellarti ma se dovessi decidere di iscriverti nuovamente, potrai farlo in qualunque momento dal sito.  Per ogni informazione contatta il nostro webmaster.'));

// Acajoom iscritti
define('_ACA_SIGNUP_DATE', compa::encodeutf('Data firma'));
define('_ACA_CONFIRMED', compa::encodeutf('Confermato'));
define('_ACA_SUBSCRIB', compa::encodeutf('Iscritto'));
define('_ACA_HTML', compa::encodeutf('HTML mailings'));
define('_ACA_RESULTS', compa::encodeutf('Risultati'));
define('_ACA_SEL_LIST', compa::encodeutf('Seleziona una lista'));
define('_ACA_SEL_LIST_TYPE', compa::encodeutf('- Seleziona il tipo di lista -'));
define('_ACA_SUSCRIB_LIST', compa::encodeutf('Lista di tutti gli iscritti'));
define('_ACA_SUSCRIB_LIST_UNIQUE', compa::encodeutf('Iscritti per: '));
define('_ACA_NO_SUSCRIBERS', compa::encodeutf('Nessun iscritto trovato per queste liste.'));
define('_ACA_COMFIRM_SUBSCRIPTION', compa::encodeutf('Ti &egrave; stata inviata una mail di conferma. Per cortesia controlla la posta in arrivo e clicca sul link che trovi nel messaggio per dare conferma.<br />' .
		'La conferma &egrave; necessaria perch&egrave; la tua iscrizione venga attivata.'));
define('_ACA_SUCCESS_ADD_LIST', compa::encodeutf('Sei stato aggiunto alla lista con successo.'));


 // info Iscrizione
define('_ACA_CONFIRM_LINK', compa::encodeutf('Clicca qui per confermare la tua iscrizione'));
define('_ACA_UNSUBSCRIBE_LINK', compa::encodeutf('Clicca qui per rimuoverti dalla lista'));
define('_ACA_UNSUBSCRIBE_MESS', compa::encodeutf('Il tuo indirizzio di email &egrave; stato rimosso dalla lista.'));

define('_ACA_QUEUE_SENT_SUCCESS', compa::encodeutf('Tutte le email previste sono state inviate con successo.'));
define('_ACA_MALING_VIEW', compa::encodeutf('Vista di tutte le liste di invio'));
define('_ACA_UNSUBSCRIBE_MESSAGE', compa::encodeutf('Sei sicuro di volerti rimuovere da questa lista?'));
define('_ACA_MOD_SUBSCRIBE', compa::encodeutf('Iscriviti'));
define('_ACA_SUBSCRIBE', compa::encodeutf('Iscriviti'));
define('_ACA_UNSUBSCRIBE', compa::encodeutf('Cancellati'));
define('_ACA_VIEW_ARCHIVE', compa::encodeutf('Vista archivio'));
define('_ACA_SUBSCRIPTION_OR', compa::encodeutf(' oppure clicca qui per modificare i tuoi dati'));
define('_ACA_EMAIL_ALREADY_REGISTERED', compa::encodeutf('Questo indirizzo di email &egrave; gi&agrave; stato registrato.'));
define('_ACA_SUBSCRIBER_DELETED', compa::encodeutf('Cancellazione avvenuta con successo.'));


### Pannello di controllo utente ###
 //Menu utente
define('_UCP_USER_PANEL', compa::encodeutf('Panello di Controllo utente'));
define('_UCP_USER_MENU', compa::encodeutf('Menu utente'));
define('_UCP_USER_CONTACT', compa::encodeutf('Le mie iscrizioni'));
 //Acajoom Menu Cronologia
define('_UCP_CRON_MENU', compa::encodeutf('Amministrazione cronologia'));
define('_UCP_CRON_NEW_MENU', compa::encodeutf('Nuova cronologia'));
define('_UCP_CRON_LIST_MENU', compa::encodeutf('Lista cronologie'));
 //Acajoom Menu Coupon
define('_UCP_COUPON_MENU', compa::encodeutf('Amministrazione buoni'));
define('_UCP_COUPON_LIST_MENU', compa::encodeutf('Lista buoni'));
define('_UCP_COUPON_ADD_MENU', compa::encodeutf('Aggiungi buono'));

### liste ###
// Tabs
define('_ACA_LIST_T_GENERAL', compa::encodeutf('Descrizione'));
define('_ACA_LIST_T_LAYOUT', compa::encodeutf('Modello'));
define('_ACA_LIST_T_SUBSCRIPTION', compa::encodeutf('Iscrizione'));
define('_ACA_LIST_T_SENDER', compa::encodeutf('Informazioni mittente'));

define('_ACA_LIST_TYPE', compa::encodeutf('Tipo lista'));
define('_ACA_LIST_NAME', compa::encodeutf('Nome lista'));
define('_ACA_LIST_ISSUE', compa::encodeutf('Invio #'));
define('_ACA_LIST_DATE', compa::encodeutf('Data invio'));
define('_ACA_LIST_SUB', compa::encodeutf('Oggetto'));
define('_ACA_ATTACHED_FILES', compa::encodeutf('Allegati'));
define('_ACA_SELECT_LIST', compa::encodeutf('Scegli la lista da modificare!'));

// Box risposta automatica
define('_ACA_AUTORESP_ON', compa::encodeutf('Tipo lista'));
define('_ACA_AUTO_RESP_OPTION', compa::encodeutf('Opzioni risposta automatica'));
define('_ACA_AUTO_RESP_FREQ', compa::encodeutf('Gli iscritti possono scegliere la frequenza'));
define('_ACA_AUTO_DELAY', compa::encodeutf('Dilazione (in giorni)'));
define('_ACA_AUTO_DAY_MIN', compa::encodeutf('Frequenza minima'));
define('_ACA_AUTO_DAY_MAX', compa::encodeutf('Frequenza massima'));
define('_ACA_FOLLOW_UP', compa::encodeutf('Specifica il follow up risposta automatica'));
define('_ACA_AUTO_RESP_TIME', compa::encodeutf('Gli iscritti possono scegliere l\'ora'));
define('_ACA_LIST_SENDER', compa::encodeutf('Lista invio'));

define('_ACA_LIST_DESC', compa::encodeutf('Descrizione lista'));
define('_ACA_LAYOUT', compa::encodeutf('Modello'));
define('_ACA_SENDER_NAME', compa::encodeutf('Nome mittente'));
define('_ACA_SENDER_EMAIL', compa::encodeutf('Email mittente'));
define('_ACA_SENDER_BOUNCE', compa::encodeutf('Indirizzo mittente respinto'));
define('_ACA_LIST_DELAY', compa::encodeutf('Dilazione'));
define('_ACA_HTML_MAILING', compa::encodeutf('invio HTML ?'));
define('_ACA_HTML_MAILING_DESC', compa::encodeutf('(se lo cambi devi salvare e rientrare per vedere le modifiche.)'));
define('_ACA_HIDE_FROM_FRONTEND', compa::encodeutf('Nascondi dal frontend?'));
define('_ACA_SELECT_IMPORT_FILE', compa::encodeutf('Scegli il file da importare'));;
define('_ACA_IMPORT_FINISHED', compa::encodeutf('Importazione completata'));
define('_ACA_DELETION_OFFILE', compa::encodeutf('Cancellazione del file'));
define('_ACA_MANUALLY_DELETE', compa::encodeutf('fallita, devi eliminarlo manualmente'));
define('_ACA_CANNOT_WRITE_DIR', compa::encodeutf('Impossibile modificare la directory'));
define('_ACA_NOT_PUBLISHED', compa::encodeutf('Invio non possibile, la lista non &egrave; pubblicata.'));

//  List info box
define('_ACA_INFO_LIST_PUB', compa::encodeutf('Clicca SI per pubblicare la lista'));
define('_ACA_INFO_LIST_NAME', compa::encodeutf('Inserisci il nome della tua lista qui. Puoi identificare la lista con questo nome.'));
define('_ACA_INFO_LIST_DESC', compa::encodeutf('Inserisci una breve descrizione della tua lista qui. Questa descrizione sar&agrave; visibile ai visitatori del sito.'));
define('_ACA_INFO_LIST_SENDER_NAME', compa::encodeutf('Inserisci il nome del mittente. Questo sar&agrave; il nome visualizzato agli iscritti che ricevono messaggi da questa lista.'));
define('_ACA_INFO_LIST_SENDER_EMAIL', compa::encodeutf('Inserisci l\'indirizzo email mittente.'));
define('_ACA_INFO_LIST_SENDER_BOUNCED', compa::encodeutf('Inserisci l\'indirizzo email mittente respinto. Si raccomanda che sia lo stesso del mittente: se fosse diverso, i filtri spam daranno al messaggio un alto grado di spam.'));
define('_ACA_INFO_LIST_AUTORESP', compa::encodeutf('Scegli il tipo di mailings per questa newsletter. <br />' .
		'Newsletter: newsletter normale<br />' .
		'Auto-responder: un auto-responder &egrave; una newsletter inviata automaticamente attraverso il sito ad intervalli regolari.'));
define('_ACA_INFO_LIST_FREQUENCY', compa::encodeutf('Abilita gli utenti a scegliere quanto spesso vogliono ricevere la newsletter.  Questo offre molta flessibilit&agrave; agli utenti.'));
define('_ACA_INFO_LIST_TIME', compa::encodeutf('Permetti all\'utente di scegliere a che ora del giorno preferisce ricevere la newsletter.'));
define('_ACA_INFO_LIST_MIN_DAY', compa::encodeutf('Definisci qual\'&egrave; la frequenza minima per ricevere la newsletter che un utente pu&ograve; scegliere'));
define('_ACA_INFO_LIST_DELAY', compa::encodeutf('Specifica la dilazione tra questa newsletter automatica e la precedente.'));
define('_ACA_INFO_LIST_DATE', compa::encodeutf('Specifica la data di di pubblicazione della lista delle newsletters che vuoi pubblicare dilazionate. <br /> FORMAT : AAAA-MM-GG HH:MM:SS'));
define('_ACA_INFO_LIST_MAX_DAY', compa::encodeutf('Definisci qual\'&egrave; la frequenza massima per ricevere la newsletter'));
define('_ACA_INFO_LIST_LAYOUT', compa::encodeutf('Inserisci il modello della tua newsletter qui. Puoi inserire qualsiasi modello.'));
define('_ACA_INFO_LIST_SUB_MESS', compa::encodeutf('Questo messaggio verr&agrave; inviato al nuovo iscritto che si registra per la prima volta. Puoi inserire il testo che vuoi qui.'));
define('_ACA_INFO_LIST_UNSUB_MESS', compa::encodeutf('Questo messaggio verr&agrave; inviato all\'iscritto che si rimuove. Puoi inserire il testo che vuoi qui.'));
define('_ACA_INFO_LIST_HTML', compa::encodeutf('Seleziona il checkbox se vuoi inviare in formato HTML. Gli iscritti saranno in grado di specificare se vogliono ricevere in formato HTML o in formato solo Testo quando si iscrivono ad una newsletter.'));
define('_ACA_INFO_LIST_HIDDEN', compa::encodeutf('Clicca SI per nascondere la lista dal frontend, gli utenti non potranno iscriversi ma tu puoi ancora mandare mailings.'));
define('_ACA_INFO_LIST_ACA_AUTO_SUB', compa::encodeutf('Sottoscrivi tutti gli utenti a questa lista?<br /><B>Nuovi Utenti:</B> verr&agrave; inserito ogni nuovo utente che si registra sul sito.<br /><B>Tutti gli utenti:</B> verr&agrave; registrato ogni nuovo utente nel database.<br />(tutte queste opzioni supportano Community Builder)'));
define('_ACA_INFO_LIST_ACC_LEVEL', compa::encodeutf('Determina il livello di accesso dal frontend. Mostra o nasconde la mailing ai gruppi di utenti che non hanno accesso ad essa in modo che possano iscriversi.'));
define('_ACA_INFO_LIST_ACC_USER_ID', compa::encodeutf('Determina il livello di accesso del gruppo di utenti a cui vuoi permettere di poter modificare. Quei gruppi di utenti potranno modificare la newsletter ed inviarla sia dal frontend che dal beckend.'));
define('_ACA_INFO_LIST_FOLLOW_UP', compa::encodeutf('Se vuoi che la risposta automatica recuperi un\'altra volta l\'ultimo messaggio, devi specificare qui la funzione di seguimi.'));
define('_ACA_INFO_LIST_ACA_OWNER', compa::encodeutf('ID della persona che ha creato la lista.'));
define('_ACA_INFO_LIST_WARNING', compa::encodeutf('Quest\'ultima opzione &egrave; disponibile solo una volta durante la creazione della lista.'));
define('_ACA_INFO_LIST_SUBJET', compa::encodeutf('Oggetto della mailing. Questo &egrave; l\'oggetto della email che l\'iscritto ricever&agrave;.'));
define('_ACA_INFO_MAILING_CONTENT', compa::encodeutf('Questo &egrave; il corpo del messaggioche vuoi inviare.'));
define('_ACA_INFO_MAILING_NOHTML', compa::encodeutf('Inserisci qui il corpo del messaggio che vuoi inviare agli iscritti che scelgono di non ricevere in formato HTML. <BR/> NOTA: se lo lasci in bianco Acajoom convertir&agrave; automaticamente l\'HTML in solo testo.'));
define('_ACA_INFO_MAILING_VISIBLE', compa::encodeutf('Clicca SI per visualizzare la mailing dal frontend.'));
define('_ACA_INSERT_CONTENT', compa::encodeutf('Inserisci il contenuto esistente'));

// Coupons
define('_ACA_SEND_COUPON_SUCCESS', compa::encodeutf('Buono inviato con successo!'));
define('_ACA_CHOOSE_COUPON', compa::encodeutf('Scegli il buono'));
define('_ACA_TO_USER', compa::encodeutf(' a questo utente'));

### Cron options
//drop down frequency(CRON)
define('_ACA_FREQ_CH1', compa::encodeutf('Ogni ora'));
define('_ACA_FREQ_CH2', compa::encodeutf('Ogni 6 ore'));
define('_ACA_FREQ_CH3', compa::encodeutf('Ogni 12 ore'));
define('_ACA_FREQ_CH4', compa::encodeutf('Quotidianamente'));
define('_ACA_FREQ_CH5', compa::encodeutf('Settimanalmente'));
define('_ACA_FREQ_CH6', compa::encodeutf('Mensilmente'));
define('_ACA_FREQ_NONE', compa::encodeutf('No'));
define('_ACA_FREQ_NEW', compa::encodeutf('Nuovi utenti'));
define('_ACA_FREQ_ALL', compa::encodeutf('Tutti gli utenti'));

//Label CRON form
define('_ACA_LABEL_FREQ', compa::encodeutf('Cronologia Acajoom?'));
define('_ACA_LABEL_FREQ_TIPS', compa::encodeutf('Clicca SI se vuoi usarlo per una cronologia Acajoom, No per ogni altro tipo di cronologia.<br />'.
	'Se clicchi SI non serve specificare l\'indirizzo, sar&agrave; automaticamente aggiunto.'));
define('_ACA_SITE_URL', compa::encodeutf('URL del tuo sito'));
define('_ACA_CRON_FREQUENCY', compa::encodeutf('Frequenza cronologia'));
define('_ACA_STARTDATE_FREQ', compa::encodeutf('Data di inizio'));
define('_ACA_LABELDATE_FREQ', compa::encodeutf('Specifica la data'));
define('_ACA_LABELTIME_FREQ', compa::encodeutf('Specifica l\'ora'));
define('_ACA_CRON_URL', compa::encodeutf('URL cronologia'));
define('_ACA_CRON_FREQ', compa::encodeutf('Frequenza'));
define('_ACA_TITLE_CRONLIST', compa::encodeutf('Lista cronologia'));
define('_NEW_LIST', compa::encodeutf('Crea una nuova lista'));

//title CRON form
define('_ACA_TITLE_FREQ', compa::encodeutf('Modifica cronologia'));
define('_ACA_CRON_SITE_URL', compa::encodeutf('Inserisci un indirizzo di sito valido, iniziando con http://'));

### Mailings ###
define('_ACA_MAILING_ALL', compa::encodeutf('Tutte le mailings'));
define('_ACA_EDIT_A', compa::encodeutf('Modifica a'));
define('_ACA_SELCT_MAILING', compa::encodeutf('Seleziona una lista nel menu a tendina per aggiungere una nuova mailing.'));
define('_ACA_VISIBLE_FRONT', compa::encodeutf('Visibile nel frontend'));

// mailer
define('_ACA_SUBJECT', compa::encodeutf('Oggetto'));
define('_ACA_CONTENT', compa::encodeutf('Contenuto'));
define('_ACA_NAMEREP', compa::encodeutf('[NAME] = Verr&agrave; sostituito con il cognome della persona iscritta. Serve per personalizzare la mail<br />'));
define('_ACA_FIRST_NAME_REP', compa::encodeutf('[FIRSTNAME] = Verr&agrave; sostituito dal nome dell\'iscritto.<br />'));
define('_ACA_NONHTML', compa::encodeutf('Versione Non-html'));
define('_ACA_ATTACHMENTS', compa::encodeutf('Allegati'));
define('_ACA_SELECT_MULTIPLE', compa::encodeutf('Tieni premuto il tasto controllo  (o comando) per selezionare allegati multipli.<br />' .
		'I documenti visualizzati in questa lista di allegati sono residenti nella cartella degli allegati: puoi cambiare questo percorso nel pannello di controllo.'));
define('_ACA_CONTENT_ITEM', compa::encodeutf('Contenuti'));
define('_ACA_SENDING_EMAIL', compa::encodeutf('Invio email'));
define('_ACA_MESSAGE_NOT', compa::encodeutf('Il messaggio non pu&ograve; essere inviato'));
define('_ACA_MAILER_ERROR', compa::encodeutf('Errore Mailer'));
define('_ACA_MESSAGE_SENT_SUCCESSFULLY', compa::encodeutf('Messaggio inviato correttamente'));
define('_ACA_SENDING_TOOK', compa::encodeutf('Accettato invio mailing'));
define('_ACA_SECONDS', compa::encodeutf('secondi'));
define('_ACA_NO_ADDRESS_ENTERED', compa::encodeutf('Nessun indirizzo inserito'));
define('_ACA_CHANGE_SUBSCRIPTIONS', compa::encodeutf('Cambia sottoscrizioni'));
define('_ACA_CHANGE_EMAIL_SUBSCRIPTION', compa::encodeutf('Cambia la tua sottoscrizione'));
define('_ACA_WHICH_EMAIL_TEST', compa::encodeutf('Indica a quale indirizzo email vuoi mandare questo test o anteprima'));
define('_ACA_SEND_IN_HTML', compa::encodeutf('Invia in HTML (per html mailings)?'));
define('_ACA_VISIBLE', compa::encodeutf('Visibile'));
define('_ACA_INTRO_ONLY', compa::encodeutf('Solo Intro'));

// stats
define('_ACA_GLOBALSTATS', compa::encodeutf('Statistiche globali'));
define('_ACA_DETAILED_STATS', compa::encodeutf('Dettagli statistiche'));
define('_ACA_MAILING_LIST_DETAILS', compa::encodeutf('Dettagli Mailinglist'));
define('_ACA_SEND_IN_HTML_FORMAT', compa::encodeutf('Inviata in HTML'));
define('_ACA_VIEWS_FROM_HTML', compa::encodeutf('Viste (da html mails)'));
define('_ACA_SEND_IN_TEXT_FORMAT', compa::encodeutf('Inviata in formato testo'));
define('_ACA_HTML_READ', compa::encodeutf('HTML letti'));
define('_ACA_HTML_UNREAD', compa::encodeutf('HTML non letti'));
define('_ACA_TEXT_ONLY_SENT', compa::encodeutf('Solo testo'));

// Configuration panel
// main tabs
define('_ACA_MAIL_CONFIG', compa::encodeutf('Mail'));
define('_ACA_LOGGING_CONFIG', compa::encodeutf('Logs & Statistiche'));
define('_ACA_SUBSCRIBER_CONFIG', compa::encodeutf('Iscritti'));
define('_ACA_AUTO_CONFIG', compa::encodeutf('Cronologia'));
define('_ACA_MISC_CONFIG', compa::encodeutf('Varie'));
define('_ACA_MAIL_SETTINGS', compa::encodeutf('Parametri Mail'));
define('_ACA_MAILINGS_SETTINGS', compa::encodeutf('Parametri Mailings'));
define('_ACA_SUBCRIBERS_SETTINGS', compa::encodeutf('Parametri Iscritti'));
define('_ACA_CRON_SETTINGS', compa::encodeutf('Parametri Cronologia'));
define('_ACA_SENDING_SETTINGS', compa::encodeutf('Parametri Invio'));
define('_ACA_STATS_SETTINGS', compa::encodeutf('Parametri Statistiche'));
define('_ACA_LOGS_SETTINGS', compa::encodeutf('Parametri Logs'));
define('_ACA_MISC_SETTINGS', compa::encodeutf('Parametri vari'));
// mail settings
define('_ACA_SEND_MAIL_FROM', compa::encodeutf('Da Email'));
define('_ACA_SEND_MAIL_NAME', compa::encodeutf('Da Nome'));
define('_ACA_MAILSENDMETHOD', compa::encodeutf('Metodo invio mail'));
define('_ACA_SENDMAILPATH', compa::encodeutf('Percorso Sendmail'));
define('_ACA_SMTPHOST', compa::encodeutf('SMTP host'));
define('_ACA_SMTPAUTHREQUIRED', compa::encodeutf('SMTP autenticazione richiesta'));
define('_ACA_SMTPAUTHREQUIRED_TIPS', compa::encodeutf('Scegli si se il tuo SMTP server richiede autenticazione'));
define('_ACA_SMTPUSERNAME', compa::encodeutf('SMTP nome utente'));
define('_ACA_SMTPUSERNAME_TIPS', compa::encodeutf('Inserisci il nome utente se il tuo SMTP server richiede autenticazione'));
define('_ACA_SMTPPASSWORD', compa::encodeutf('SMTP password'));
define('_ACA_SMTPPASSWORD_TIPS', compa::encodeutf('Inserisic la password se il tuo SMTP server richiede autenticazione'));
define('_ACA_USE_EMBEDDED', compa::encodeutf('Usa immagini incorporate in HTML'));
define('_ACA_USE_EMBEDDED_TIPS', compa::encodeutf('Seleziona si se le immagini del contenuto allegato possono essere inserite nel codice HTML, o no per usare i tag immagine di default del portale.'));
define('_ACA_UPLOAD_PATH', compa::encodeutf('Path Upload/allegati'));
define('_ACA_UPLOAD_PATH_TIPS', compa::encodeutf('Puoi specificare il percorso ad una cartella per l\'upload.<br />' .
	'Assicurati che la cartella esista altrimenti creane una.'));

// subscribers settings
define('_ACA_ALLOW_UNREG', compa::encodeutf('Abilita non registrati'));
define('_ACA_ALLOW_UNREG_TIPS', compa::encodeutf('Seleziona SI se vuoi abilitare gli utenti all\'iscrizione alle newsletters senza registrazione al portale.'));
define('_ACA_REQ_CONFIRM', compa::encodeutf('Richiede conferma'));
define('_ACA_REQ_CONFIRM_TIPS', compa::encodeutf('Seleziona SI se richiedi che un utente non registrato confermi il suo indirizzo email.'));
define('_ACA_SUB_SETTINGS', compa::encodeutf('Parametri Iscrizione'));
define('_ACA_SUBMESSAGE', compa::encodeutf('Messaggio Iscrizione'));
define('_ACA_SUBSCRIBE_LIST', compa::encodeutf('Iscriviti a una newsletter'));

define('_ACA_USABLE_TAGS', compa::encodeutf('Tags abilitati'));
define('_ACA_NAME_AND_CONFIRM', compa::encodeutf('<b>[CONFIRM]</b> = Crea un collegamento cliccabile dove l\'iscritto pu&ograve; confermare la sua richiesta. &Egrave; <strong>richiesto</strong> per far funzionare Acajoom correttamente.<br />'
.'<br />[NAME] = Verr&agrave; sostituito dal cognome delliscritto per personalizzare la mail.<br />'
.'<br />[FIRSTNAME] = Verr&agrave; sostituito dal nome dell\'iscritto, il nome &egrave; DEFINITO come primo nome inserito dall\'iscritto.<br />'));
define('_ACA_CONFIRMFROMNAME', compa::encodeutf('Nome conferma'));
define('_ACA_CONFIRMFROMNAME_TIPS', compa::encodeutf('Inserisci il mome da visualizzare nella lettera di conferma.'));
define('_ACA_CONFIRMFROMEMAIL', compa::encodeutf('Email conferma'));
define('_ACA_CONFIRMFROMEMAIL_TIPS', compa::encodeutf('Inserisci l\'indirizzo email da visualizzare nella lettera di conferma.'));
define('_ACA_CONFIRMBOUNCE', compa::encodeutf('Email conferma respinta'));
define('_ACA_CONFIRMBOUNCE_TIPS', compa::encodeutf('Inserisci l\'indirizzo da visualizzare per la lettera di conferma respinta.'));
define('_ACA_HTML_CONFIRM', compa::encodeutf('Conferma HTML'));
define('_ACA_HTML_CONFIRM_TIPS', compa::encodeutf('Seleziona si per inviare la lettera di conferma in HTML se lutente lo permette.'));
define('_ACA_TIME_ZONE_ASK', compa::encodeutf('Ora locale'));
define('_ACA_TIME_ZONE_TIPS', compa::encodeutf('Scegli SI se vuoi che l\'utente inserisca l\'ora locale. L\'invio delle mail verr&agrave effettuato sulla base dell\'ora locale quando applicabile'));

 // Set up cronologia
define('_ACA_TIME_OFFSET_URL', compa::encodeutf('Clicca qui per settare i parametri di scostamento nel pannello di configurazione globale -> Locale tab'));
define('_ACA_TIME_OFFSET_TIPS', compa::encodeutf('Setta l\'ora del tuo server cosi che i dati registrati e l\'ora siano esatti'));
define('_ACA_TIME_OFFSET', compa::encodeutf('Time offset'));
define('_ACA_CRON_TITLE', compa::encodeutf('Funzione di cronologia'));
define('_ACA_CRON_DESC', compa::encodeutf('<br />Usando la funzione di cronologia puoi assegnare una funzione automatica per il tuo sito Joomla!<br />' .
		'Per farlo ti serve aggiungere nel tuo pannello di controllo crontab il seguente comando:<br />' .
		'<b>' . ACA_JPATH_LIVE . '/index2.php?option=com_acajoom&act=cron</b> ' .
		'<br /><br />Se ti serve aiuto per sistemarlo o hai qualche problema, visita il nostro forum  <a href="http://www.ijoobi.com" target="_blank">http://www.ijoobi.com</a>'));
// sending settings
define('_ACA_PAUSEX', compa::encodeutf('Pausa in secondi ogni numero configurato di emails'));
define('_ACA_PAUSEX_TIPS', compa::encodeutf('Inserisci un numero di secondi che Acajoom dar&agrave; al SMTP server per inviare i messaggi prima di procedere con il successivo gruppo di messaggi.'));
define('_ACA_EMAIL_BET_PAUSE', compa::encodeutf('Emails tra pause'));
define('_ACA_EMAIL_BET_PAUSE_TIPS', compa::encodeutf('Il numero di emails da inviare prima della pausa.'));
define('_ACA_WAIT_USER_PAUSE', compa::encodeutf('Attesa per input utente'));
define('_ACA_WAIT_USER_PAUSE_TIPS', compa::encodeutf('Se lo script debba aspettare un input utente nella pausa.'));
define('_ACA_SCRIPT_TIMEOUT', compa::encodeutf('Script timeout'));
define('_ACA_SCRIPT_TIMEOUT_TIPS', compa::encodeutf('Il numero di minuti in cui lo script &egrave; in grado di girare (0 per illimitato).'));
// Stats settings
define('_ACA_ENABLE_READ_STATS', compa::encodeutf('Abilita la lettura delle statistiche'));
define('_ACA_ENABLE_READ_STATS_TIPS', compa::encodeutf('Seleziona si se vuoi il registro del numero di viste. Questa tecnica pu&ograve; essere usata solo con HTML mailings'));
define('_ACA_LOG_VIEWSPERSUB', compa::encodeutf('Registro di viste per iscritto'));
define('_ACA_LOG_VIEWSPERSUB_TIPS', compa::encodeutf('Seleziona si se vuoi il registro del numero di viste per iscritto. Questa tecnica pu&ograve; essere usata solo con HTML mailings'));
// Logs settings
define('_ACA_DETAILED', compa::encodeutf('Dettaglio logs'));
define('_ACA_SIMPLE', compa::encodeutf('Logs semplificati'));
define('_ACA_DIAPLAY_LOG', compa::encodeutf('Visualizza logs'));
define('_ACA_DISPLAY_LOG_TIPS', compa::encodeutf('Seleziona SI se vuoi visualizzare i logs mentre si invia.'));
define('_ACA_SEND_PERF_DATA', compa::encodeutf('Dati di funzionamento'));
define('_ACA_SEND_PERF_DATA_TIPS', compa::encodeutf('Seleziona SI se vuoi permettere a Acajoom di inviare reports ANONIMI sulla tua configurazione, il numero degli iscritti ad una lsita ed il tempo necessario per inviare la lista. Questo ci dar&agrave; una idea delle prestazioni Acajoom e CI AIUTER&Agrave; a perfezionare Acajoom per i futuri rilasci.'));
define('_ACA_SEND_AUTO_LOG', compa::encodeutf('Invia il log per la risposta automatica'));
define('_ACA_SEND_AUTO_LOG_TIPS', compa::encodeutf('Seleziona SI se vuoi inviare un log per email ogni volta in cui la coda &egrave elaborata.  ATTENZIONE: questo pu&ograve generare un numero enorme di emails.'));
define('_ACA_SEND_LOG', compa::encodeutf('Log di invio'));
define('_ACA_SEND_LOG_TIPS', compa::encodeutf('Se un log della mailing deve essere inviato all\'indirizzo email dell\'utente che ha spedito la mailing.'));
define('_ACA_SEND_LOGDETAIL', compa::encodeutf('Invia il log dettagliato'));
define('_ACA_SEND_LOGDETAIL_TIPS', compa::encodeutf('I dettagli includono info sul successo o il fallimento invio mail per ogni iscritto e una descrizione delle informazioni. Semplice invia solo la descrizione.'));
define('_ACA_SEND_LOGCLOSED', compa::encodeutf('Invia il log se la connessione &egrave; chiusaS'));
define('_ACA_SEND_LOGCLOSED_TIPS', compa::encodeutf('Con questa opzione l\'utente che ha spedito la lista ricever&agrave; anche un report per email.'));
define('_ACA_SAVE_LOG', compa::encodeutf('Log di salvataggio'));
define('_ACA_SAVE_LOG_TIPS', compa::encodeutf('Se un log della mailing deve essere aggiunto al file di log.'));
define('_ACA_SAVE_LOGDETAIL', compa::encodeutf('Dettaglio log di salvataggio'));
define('_ACA_SAVE_LOGDETAIL_TIPS', compa::encodeutf('I dettagli includono informazioni sul successo o il fallimento invio per ogni iscritto e una descrizione delle informazioni. Semplice invia solo la descrizione.'));
define('_ACA_SAVE_LOGFILE', compa::encodeutf('Dettaglio log di salvataggio'));
define('_ACA_SAVE_LOGFILE_TIPS', compa::encodeutf('File in cui vengono aggiunte le informazioni sui log. Questo file pu&ograve; diventare molto esteso.'));
define('_ACA_CLEAR_LOG', compa::encodeutf('Pulisci log'));
define('_ACA_CLEAR_LOG_TIPS', compa::encodeutf('Pulisce il file di log.'));

### control panel
define('_ACA_CP_LAST_QUEUE', compa::encodeutf('Ultima coda eseguita'));
define('_ACA_CP_TOTAL', compa::encodeutf('Totale'));
define('_ACA_MAILING_COPY', compa::encodeutf('Mailing copiata con successo!'));

// Miscellaneous settings
define('_ACA_SHOW_GUIDE', compa::encodeutf('Mostra guida'));
define('_ACA_SHOW_GUIDE_TIPS', compa::encodeutf('Mostra la guida all\'inizio per aiutare i nuovi utenti a creare una newsletter, una risposta automatica ed a settare i parametri per Acajoom correttamente.'));
define('_ACA_AUTOS_ON', compa::encodeutf('Usa Risposta automatica'));
define('_ACA_AUTOS_ON_TIPS', compa::encodeutf('Scegli NO se non vuoi usare la risposta automatica, tutte le risposte automatiche verranno disattivate.'));
define('_ACA_NEWS_ON', compa::encodeutf('Usa Newsletters'));
define('_ACA_NEWS_ON_TIPS', compa::encodeutf('Scegli NO se non vuoi usare le Newsletters, tutte le opzioni newsletters saranno disattivate.'));
define('_ACA_SHOW_TIPS', compa::encodeutf('Mostra suggerimenti'));
define('_ACA_SHOW_TIPS_TIPS', compa::encodeutf('Mostra i suggerimenti per aiutare gli utenti ad usare Acajoom in modo efficace.'));
define('_ACA_SHOW_FOOTER', compa::encodeutf('Mostra la coda'));
define('_ACA_SHOW_FOOTER_TIPS', compa::encodeutf('Indica se il footer contente il copyright deve essere mostrato oppure no.'));
define('_ACA_SHOW_LISTS', compa::encodeutf('Mostra le liste nel frontend'));
define('_ACA_SHOW_LISTS_TIPS', compa::encodeutf('Quando l\'utente non &grave; registrato mostra la lista di newsletters cui pu&ograve; iscriversi, un bottone di vista archivio newsletter o semplicemente il modulo di login per la registrazione.'));
define('_ACA_CONFIG_UPDATED', compa::encodeutf('I dettagli di configurazione sono stati aggiornati!'));
define('_ACA_UPDATE_URL', compa::encodeutf('Aggiorna URL'));
define('_ACA_UPDATE_URL_WARNING', compa::encodeutf('ATTENZIONE! Non cambiare questa URL a meno che tu ne abbia chiesto l\'autorizzazione al Team Acajoom.<br />'));
define('_ACA_UPDATE_URL_TIPS', compa::encodeutf('Per esempio: http://www.ijoobi.com/update/ (compreso lo slash finale)'));

// modulo
define('_ACA_EMAIL_INVALID', compa::encodeutf('Email immessa non valida.'));
define('_ACA_REGISTER_REQUIRED', compa::encodeutf('Devi prima registrarti per poterti iscrivere ad una newsletter.'));

// Box livello Accessi
define('_ACA_OWNER', compa::encodeutf('Il creatore della lista:'));
define('_ACA_ACCESS_LEVEL', compa::encodeutf('Setta il livello di accesso per la lista'));
define('_ACA_ACCESS_LEVEL_OPTION', compa::encodeutf('Opzioni di livello di accesso'));
define('_ACA_USER_LEVEL_EDIT', compa::encodeutf('Seleziona quale livello di accesso utente &egrave; abilitato a curare l\'edizione di una mailing (dal frontend o dal backend) '));

//  drop down options
define('_ACA_AUTO_DAY_CH1', compa::encodeutf('Quotidianamente'));
define('_ACA_AUTO_DAY_CH2', compa::encodeutf('Quotidianamente no weekend'));
define('_ACA_AUTO_DAY_CH3', compa::encodeutf('Ogni altro giorno'));
define('_ACA_AUTO_DAY_CH4', compa::encodeutf('Ogni altro giorno no weekend'));
define('_ACA_AUTO_DAY_CH5', compa::encodeutf('Settimanalmente'));
define('_ACA_AUTO_DAY_CH6', compa::encodeutf('Bi-settimanalmente'));
define('_ACA_AUTO_DAY_CH7', compa::encodeutf('Mensilmente'));
define('_ACA_AUTO_DAY_CH9', compa::encodeutf('Annualmente'));
define('_ACA_AUTO_OPTION_NONE', compa::encodeutf('No'));
define('_ACA_AUTO_OPTION_NEW', compa::encodeutf('Nuovi Utenti'));
define('_ACA_AUTO_OPTION_ALL', compa::encodeutf('Tutti gli Utenti'));

//
define('_ACA_UNSUB_MESSAGE', compa::encodeutf('Messaggio Email di rimozione'));
define('_ACA_UNSUB_SETTINGS', compa::encodeutf('Parametri di rimozione'));
define('_ACA_AUTO_ADD_NEW_USERS', compa::encodeutf('Iscrivi automaticamente Utenti?'));

// Update and upgrade messages
define('_ACA_NO_UPDATES', compa::encodeutf('Non ci sono aggiornamenti disponibili al momento.'));
define('_ACA_VERSION', compa::encodeutf('Versione Acajoom'));
define('_ACA_NEED_UPDATED', compa::encodeutf('Files da aggiornare:'));
define('_ACA_NEED_ADDED', compa::encodeutf('Files da aggiungere:'));
define('_ACA_NEED_REMOVED', compa::encodeutf('Files da rimuovere:'));
define('_ACA_FILENAME', compa::encodeutf('Nome file:'));
define('_ACA_CURRENT_VERSION', compa::encodeutf('Versione attuale:'));
define('_ACA_NEWEST_VERSION', compa::encodeutf('Nuova versione:'));
define('_ACA_UPDATING', compa::encodeutf('Aggiornamento'));
define('_ACA_UPDATE_UPDATED_SUCCESSFULLY', compa::encodeutf('I files sono stati aggiornati con successo.'));
define('_ACA_UPDATE_FAILED', compa::encodeutf('Aggiornamento fallito!'));
define('_ACA_ADDING', compa::encodeutf('Aggiunte'));
define('_ACA_ADDED_SUCCESSFULLY', compa::encodeutf('Aggiunti con successo.'));
define('_ACA_ADDING_FAILED', compa::encodeutf('Aggiunta fallita!'));
define('_ACA_REMOVING', compa::encodeutf('Rimossi'));
define('_ACA_REMOVED_SUCCESSFULLY', compa::encodeutf('Rimossi con successo.'));
define('_ACA_REMOVING_FAILED', compa::encodeutf('Rimozione fallita!'));
define('_ACA_INSTALL_DIFFERENT_VERSION', compa::encodeutf('Installa una versione diversa'));
define('_ACA_CONTENT_ADD', compa::encodeutf('Aggiungi contenuto'));
define('_ACA_UPGRADE_FROM', compa::encodeutf('Importa dati (newsletters e iscritti\' informazioni) da'));
define('_ACA_UPGRADE_MESS', compa::encodeutf('Non c\'&egrave; pericolo nei dati esistenti. <br /> Questo processo impoter&agrave; semplicemente i dati nel database Acajoom.'));
define('_ACA_CONTINUE_SENDING', compa::encodeutf('Continua invio'));

// Acajoom message
define('_ACA_UPGRADE1', compa::encodeutf('Puoi facilmente importare i tuoi utenti e le newsletters da'));
define('_ACA_UPGRADE2', compa::encodeutf('a Acajoom nel pannello aggiornamenti.'));
define('_ACA_UPDATE_MESSAGE', compa::encodeutf('Una nuova versione di Acajoom &egrave; disponibile! '));
define('_ACA_UPDATE_MESSAGE_LINK', compa::encodeutf('Clicca qui per aggiornare!'));
define('_ACA_CRON_SETUP', compa::encodeutf('Perch&egrave; le risposte automatiche possano essere inviate devi settare i parametri della funzione cronologia.'));
define('_ACA_THANKYOU', compa::encodeutf('Grazie per aver scelto Acajoom, il tuo partner nella communicazione!'));
define('_ACA_NO_SERVER', compa::encodeutf('Il server per l\'aggiornamento non &egrave; disponibile, riprova pi&ugrave; tardi.'));
define('_ACA_MOD_PUB', compa::encodeutf('Il modulo Acajoom non &egrave; pubblicato.'));
define('_ACA_MOD_PUB_LINK', compa::encodeutf('Clicca qui per pubblicarlo!'));
define('_ACA_IMPORT_SUCCESS', compa::encodeutf('Importato con successo'));
define('_ACA_IMPORT_EXIST', compa::encodeutf('Iscritto gi&agrave; presente nel database'));


// Acajoom\'s Guide
define('_ACA_GUIDE', compa::encodeutf('\'s Wizard'));
define('_ACA_GUIDE_FIRST_ACA_STEP', compa::encodeutf('<p>Acajoom presenta molte caratteristiche e questo wizard ti guider&agrave; attraverso un processo di 4 facili passi will per permetterti di inviare le tue newsletters e risposte automatiche!<p />'));
define('_ACA_GUIDE_FIRST_ACA_STEP_DESC', compa::encodeutf('Prima di tutto, ti serve aggiungere una lista.  Una lista potrebbe essere di due tipi, o una newsletter o una risposta automatica.' .
		' Nella lista definisci i diversi parametri per abilitare l\'invio delle newsletters o delle risposte automatiche: mittente, layout, iscritti\' messaggio di benvenuto, etc...
<br /><br />Puoi organizzare la tua prima lista qui: <a href="index2.php?option=com_acajoom&act=list" >crea una lista</a> e clicca il bottone Nuovo.'));
define('_ACA_GUIDE_FIRST_ACA_STEP_UPGRADE', compa::encodeutf('Acajoom ti fornisce un modo facile per importare tutti i dati da un precedente sistema di newsletter.<br />' .
		' Vai in Aggiornamento nel pannello di controllo e scegli il tuo precedente sistema di newsletters per importare tutte le newsletters e gli iscritti.<br /><br />' .
		'<span style="color:#FF5E00;" >IMPORTANTE: l\'importazione &egrave; LIBERA da rischi e non interessa in alcun modo i dati del tuo precedente sistema di newsletter</span><br />' .
		'Dopo l\'importazione sarai in grado di organizzare i tuoi iscritti e le mailings direttamente da Acajoom.<br /><br />'));
define('_ACA_GUIDE_SECOND_ACA_STEP', compa::encodeutf('Grande, la tua prima lista &egrave; allestita!  Puoi ora scrivere il tuo primo  %s.  Per crearlo vai a: '));
define('_ACA_GUIDE_SECOND_ACA_STEP_AUTO', compa::encodeutf('Amministrazione Risposta Automatica'));
define('_ACA_GUIDE_SECOND_ACA_STEP_NEWS', compa::encodeutf('Amministrazione Newsletter'));
define('_ACA_GUIDE_SECOND_ACA_STEP_FINAL', compa::encodeutf(' e seleziona il tuo %s. <br /> Poi scegli il tuo %s nella lista del menu a tendina.  Crea la tua prima lista di indirizzi cliccando su Nuovo '));

define('_ACA_GUIDE_THRID_ACA_STEP_NEWS', compa::encodeutf('Prima di inviare la tua prima newsletter controlla la configurazione della mail.'.
		'Vai alla <a href="index2.php?option=com_acajoom&act=configuration" >pagina di configurazione</a> per verificare i parametri della mail. <br />'));
define('_ACA_GUIDE_THRID2_ACA_STEP_NEWS', compa::encodeutf('<br />Quando sei pronto torna indietro al menu delle Newsletters, seleziona la tua lista di indirizzi e clicca Invio'));

define('_ACA_GUIDE_THRID_ACA_STEP_AUTOS', compa::encodeutf('Per l\'invio delle tue risposte automatiche devi prima settare una funzione di cronologia sul tuo server. ' .
		' Vai al Cron tab nel pannello di controllo.' .
		' <a href="index2.php?option=com_acajoom&act=configuration" >clicca qui</a> per imparare come organizzare un task di cronologia. <br />'));

define('_ACA_GUIDE_MODULE', compa::encodeutf(' <br />Assicurati di aver pubblicato il modulo Acajoom in modo che gli utenti possano iscriversi alla lista.'));

define('_ACA_GUIDE_FOUR_ACA_STEP_NEWS', compa::encodeutf('Ora puoi anche organizzare una risposta automatica.'));
define('_ACA_GUIDE_FOUR_ACA_STEP_AUTOS', compa::encodeutf('Ora puoi anche organizzare una newsletter.'));

define('_ACA_GUIDE_FOUR_ACA_STEP', compa::encodeutf('<p><br />Voila! Sei pronto per comunicare efficacemente con i tuoi ospiti e utenti. Questo wizard terminer&agrave; non appena avrai inserito una seconda lista o spegnerlo nel <a href="index2.php?option=com_acajoom&act=configuration" >pannello di configurazione</a>.' .
		'<br /><br />  Per ulteriori domande sull\'uso Acajoom, vai al ' .
		'<a target="_blank" href="http://www.ijoobi.com/index.php?option=com_agora&Itemid=60" >forum</a>. ' .
		' Troverai molte informazioni su come comunicare efficacemente con i tuoi iscritti su <a href="http://www.ijoobi.com/" target="_blank" >www.ijoobi.com</a>.' .
		'<p /><br /><b>Grazie per aver scelto di usare Acajoom. Il Tuo Partner per la Comunicazione!</b> '));
define('_ACA_GUIDE_TURNOFF', compa::encodeutf('Il wizard si sta ora spegnendo!'));
define('_ACA_STEP', compa::encodeutf('STEP '));

// Acajoom Install
define('_ACA_INSTALL_CONFIG', compa::encodeutf('Configurazione Acajoom'));
define('_ACA_INSTALL_SUCCESS', compa::encodeutf('Installazione riuscita'));
define('_ACA_INSTALL_ERROR', compa::encodeutf('Errore installatione'));
define('_ACA_INSTALL_BOT', compa::encodeutf('Plugin (Bot)Acajoom'));
define('_ACA_INSTALL_MODULE', compa::encodeutf('Modulo Acajoom'));
//Others
define('_ACA_JAVASCRIPT', compa::encodeutf('!Attenzione! Per un funzionamento corretto deve essere abilitato Javascript.'));
define('_ACA_EXPORT_TEXT', compa::encodeutf('Gli iscritti sono esportati in base alla lista che hai scelto. <br />Iscritti esportati per lista'));
define('_ACA_IMPORT_TIPS', compa::encodeutf('Iscritti importati. Le info nel file devono avere il seguente formato: <br />' .
		'Nome,email,riceviHTML(1/0),confermato(1/0)'));
define('_ACA_SUBCRIBER_EXIT', compa::encodeutf('&egrave; gi&agrave; iscritto'));
define('_ACA_GET_STARTED', compa::encodeutf('Clicca qui per iniziare!'));

//News since 1.0.1
define('_ACA_WARNING_1011', compa::encodeutf('Warning: 1011: Aggiornamento non eseguito a causa di restrizioni del tuo server.'));
define('_ACA_SEND_MAIL_FROM_TIPS', compa::encodeutf('Scegli quale indirizzo viene mostrato come mittente.'));
define('_ACA_SEND_MAIL_NAME_TIPS', compa::encodeutf('Scegli quale nome viene mostrato come mittente.'));
define('_ACA_MAILSENDMETHOD_TIPS', compa::encodeutf('Scegli il sistema di email che vuoi usare: PHP mail function, <span>Sendmail</span> or SMTP Server.'));
define('_ACA_SENDMAILPATH_TIPS', compa::encodeutf('Questa &egrave; la directory del Mail server'));
define('_ACA_LIST_T_TEMPLATE', compa::encodeutf('Template'));
define('_ACA_NO_MAILING_ENTERED', compa::encodeutf('Mailing non fornita'));
define('_ACA_NO_LIST_ENTERED', compa::encodeutf('Lista non fornita'));
define('_ACA_SENT_MAILING', compa::encodeutf('Mailings inviate'));
define('_ACA_SELECT_FILE', compa::encodeutf('Seleziona un file per '));
define('_ACA_LIST_IMPORT', compa::encodeutf('Check sulla lista(e) di cui vuoi associare gli iscritti.'));
define('_ACA_PB_QUEUE', compa::encodeutf('Iscritto inserito ma ci sono problemi a collegarlo/a alla lista(e). Controlla manualmente.'));
define('_ACA_UPDATE_MESS', compa::encodeutf(''));
define('_ACA_UPDATE_MESS1', compa::encodeutf('Aggiornamento importante!'));
define('_ACA_UPDATE_MESS2', compa::encodeutf('Patch and small fixes.'));
define('_ACA_UPDATE_MESS3', compa::encodeutf('Nuova versione.'));
define('_ACA_UPDATE_MESS5', compa::encodeutf('Joomla 1.5 is required to update.'));
define('_ACA_UPDATE_IS_AVAIL', compa::encodeutf(' &egrave; disponibile!'));
define('_ACA_NO_MAILING_SENT', compa::encodeutf('Nessuna mailing inviata!'));
define('_ACA_SHOW_LOGIN', compa::encodeutf('Mostra login form'));
define('_ACA_SHOW_LOGIN_TIPS', compa::encodeutf('Seleziona SI per visualizzare il form di login nel front-end del pannello di controllo Acajoom cos&igrave; l\'utente pu&ograve; registrarsi dal sito.'));
define('_ACA_LISTS_EDITOR', compa::encodeutf('Redattore Descrizione Lista'));
define('_ACA_LISTS_EDITOR_TIPS', compa::encodeutf('Seleziona SI per usare un editor HTML per modificare il campo di descrizione della lista.'));
define('_ACA_SUBCRIBERS_VIEW', compa::encodeutf('Vista iscritti'));

//News since 1.0.2
define('_ACA_FRONTEND_SETTINGS', compa::encodeutf('Parametri Front-end'));
define('_ACA_SHOW_LOGOUT', compa::encodeutf('Mostra il bottone logout'));
define('_ACA_SHOW_LOGOUT_TIPS', compa::encodeutf('Seleziona SI per mostrare il bottone di logout nel front-end Acajoom.'));

//News since 1.0.3 CB integration
define('_ACA_CONFIG_INTEGRATION', compa::encodeutf('Integrazione'));
define('_ACA_CB_INTEGRATION', compa::encodeutf('Integrazione Costruttore Comunit&agrave;'));
define('_ACA_INSTALL_PLUGIN', compa::encodeutf('Plugin Costruttore Comunit&agrave; (Acajoom Integration) '));
define('_ACA_CB_PLUGIN_NOT_INSTALLED', compa::encodeutf('Il Plugin Acajoom per Community Builder non &egrave; ancora installato!'));
define('_ACA_CB_PLUGIN', compa::encodeutf('Registro Liste'));
define('_ACA_CB_PLUGIN_TIPS', compa::encodeutf('Seleziona SI per mostrare le mailing lists nel form di registrazione community builder'));
define('_ACA_CB_LISTS', compa::encodeutf('List IDs'));
define('_ACA_CB_LISTS_TIPS', compa::encodeutf('QUESTO &Egrave; UN CAMPO OBBLIGATORIO. Inserisci il numero delle liste cui vuoi abilitare gli utenti a iscriversi, separate da una virgola ,  (0 mostra tutte le liste)'));
define('_ACA_CB_INTRO', compa::encodeutf('Introduzione'));
define('_ACA_CB_INTRO_TIPS', compa::encodeutf('Il testo che comparir&agrave; prima dell\'elenco. LASCIATO IN BIANCO NON MOSTRA NULLA. Puoi usare i tags HTML per personalizzare il look.'));
define('_ACA_CB_SHOW_NAME', compa::encodeutf('Mostra Nome Lista'));
define('_ACA_CB_SHOW_NAME_TIPS', compa::encodeutf('Seleziona se mostrare oppure no il nome della lista dopo l\'introduzione.'));
define('_ACA_CB_LIST_DEFAULT', compa::encodeutf('Check list by default'));
define('_ACA_CB_LIST_DEFAULT_TIPS', compa::encodeutf('Seleziona se vuoi il check box per ogni lista, checked di default.'));
define('_ACA_CB_HTML_SHOW', compa::encodeutf('Mostra ricevi HTML'));
define('_ACA_CB_HTML_SHOW_TIPS', compa::encodeutf('Settato su SI permette agli utenti di decidere se vogliono ricevere in formato HTML o no. Su NO viene usato di default ricevi html.'));
define('_ACA_CB_HTML_DEFAULT', compa::encodeutf('Ricevi HTML Default '));
define('_ACA_CB_HTML_DEFAULT_TIPS', compa::encodeutf('Setta questa opzione per mostrare html mailing configuration di default. Se Mostra ricevi HTML &egrave; settato su NO, questa opzione sar&agrave; poi di default.'));

// Since 1.0.4
define('_ACA_BACKUP_FAILED', compa::encodeutf('Il backup del file &egrave; fallito! Il file non &egrave stato sostituito.'));
define('_ACA_BACKUP_YOUR_FILES', compa::encodeutf('La precedente versione dei files &egrave; stata archiviata nella seguente directory:'));
define('_ACA_SERVER_LOCAL_TIME', compa::encodeutf('Ora locale del Server'));
define('_ACA_SHOW_ARCHIVE', compa::encodeutf('Mostra il pulsante di archivio'));
define('_ACA_SHOW_ARCHIVE_TIPS', compa::encodeutf('Seleziona S&Igrave; per mostrare il pulsante di archivio nella pagina della lista delle Newsletter'));
define('_ACA_LIST_OPT_TAG', compa::encodeutf('Tags'));
define('_ACA_LIST_OPT_IMG', compa::encodeutf('Immagini'));
define('_ACA_LIST_OPT_CTT', compa::encodeutf('Contenuto'));
define('_ACA_INPUT_NAME_TIPS', compa::encodeutf('Inserisci il tuo nome completo (Nome proprio prima)'));
define('_ACA_INPUT_EMAIL_TIPS', compa::encodeutf('Inserisci il tuo indirizzo email (Assicurati che sia un indirizzo email valido se vuoi ricevere le tue liste.)'));
define('_ACA_RECEIVE_HTML_TIPS', compa::encodeutf('Scegli S&Igrave; se vuoi ricevere le tue liste HTML - NO per ricevere le liste in formato di testo'));
define('_ACA_TIME_ZONE_ASK_TIPS', compa::encodeutf('Specifica il tuo fuso orario.'));

// Since 1.0.5
define('_ACA_FILES', compa::encodeutf('Files'));
define('_ACA_FILES_UPLOAD', compa::encodeutf('Carica'));
define('_ACA_MENU_UPLOAD_IMG', compa::encodeutf('Carica Immagini'));
define('_ACA_TOO_LARGE', compa::encodeutf('Il file &egrave; troppo grande. La massima dimensione permessa &egrave;'));
define('_ACA_MISSING_DIR', compa::encodeutf('La cartella di destinazione non esiste'));
define('_ACA_IS_NOT_DIR', compa::encodeutf('La cartella di destinazione non esiste oppure si tratta di un normale file.'));
define('_ACA_NO_WRITE_PERMS', compa::encodeutf('Non hai i diritti di scrittura sulla cartella'));
define('_ACA_NO_USER_FILE', compa::encodeutf('Non hai selezionato alcun file da caricare.'));
define('_ACA_E_FAIL_MOVE', compa::encodeutf('Impossibile spostare il file.'));
define('_ACA_FILE_EXISTS', compa::encodeutf('Il file di destinazione esiste gi&agrave;.'));
define('_ACA_CANNOT_OVERWRITE', compa::encodeutf('Il file di destinazione esiste gi&agrave; e non puoi sovrascriverlo.'));
define('_ACA_NOT_ALLOWED_EXTENSION', compa::encodeutf('Estensione del file non permessa'));
define('_ACA_PARTIAL', compa::encodeutf('Il file &egrave; stato caricato solo parzialmente.'));
define('_ACA_UPLOAD_ERROR', compa::encodeutf('Errore di caricamento:'));
define('DEV_NO_DEF_FILE', compa::encodeutf('Il file era stato caricato solo parzialmente.'));
define('_ACA_CONTENTREP', compa::encodeutf('[SUBSCRIPTIONS] = Questo verr&agrave; sostituito con i link alle liste sottoscritte.' .
		' Ci&ograve; &egrave; <strong>richiesto</strong> per far funzionare Acajoom correttamente.<br />' .
		'Se inserisci un altro contenuto in questa casella, sar&agrave; visualizzato in tutte le comunicazioni di questa lista.' .
		' <br />Aggiungi il messaggio della tua newsletter alla fine. Acajoom aggiunger&agrave; automaticamente un link perch&egrave; l\'utente possa cambiare le proprie informazioni e un link per cancellarsi dalla lista.'));

// since 1.0.6
define('_ACA_NOTIFICATION', compa::encodeutf('Notifica'));  // shortcut for Email notification
define('_ACA_NOTIFICATIONS', compa::encodeutf('Notifiche'));
define('_ACA_USE_SEF', compa::encodeutf('mailings in SEF'));
define('_ACA_USE_SEF_TIPS', compa::encodeutf('Si raccomanda di scegliere No. Comunque se vuoi che l\'URL inclusa nelle tue mailings usi SEF scegli SI.' .
		' <br /><b>I links lavoreranno allo stesso modo per entrambe le opzioni.  No, assicurer&agrave; che i links nelle mailings lavorerino sempre anche se cambi il tuo SEF.</b> '));
define('_ACA_ERR_NB', compa::encodeutf('Errore #: ERR'));
define('_ACA_ERR_SETTINGS', compa::encodeutf('Errore manipolazione settings'));
define('_ACA_ERR_SEND', compa::encodeutf('Invia report errori'));
define('_ACA_ERR_SEND_TIPS', compa::encodeutf('Se vuoi che Acajoom sia il miglior prodotto seleziona SI.  Questo ci mander&agrave; un report di errore.  Cosi non hai pi&ugrave; bisogno di riportare bugs ;-) <br /> <b>NESSUNA INFORMAZIONE PRIVATA &Egrave; INVIATA</b>. Non sappiamo da quale sito provenga l\'errore. Noi inviamo informazioni solo su Acajoom , il setup PHP e le queries SQL. '));
define('_ACA_ERR_SHOW_TIPS', compa::encodeutf('Scegli SI per visualizzare il numero di errore sullo schermo. Principalmente usato a scopo di ricerca e correzione errori. '));
define('_ACA_ERR_SHOW', compa::encodeutf('Visualizza errori'));
define('_ACA_LIST_SHOW_UNSUBCRIBE', compa::encodeutf('Visualizza link di rimozione'));
define('_ACA_LIST_SHOW_UNSUBCRIBE_TIPS', compa::encodeutf('Seleziona SI per visualizzare i links di rimozione al fondo delle mailings per gli utenti che vogliono cambiare le loro iscrizioni. <br /> NO, disabilita i links e il footer.'));
define('_ACA_UPDATE_INSTALL', compa::encodeutf('<span style="color: rgb(255, 0, 0);">IMPORTANTE!</span> <br />Se stai facendo l\'upgrade di una precedente versione Acajoom devi aggiornare il tuo database cliccando sul seguente bottone (I tuoi dati rimarranno integri)'));
define('_ACA_UPDATE_INSTALL_BTN', compa::encodeutf('Tabelle e configurazione Upgrade'));
define('_ACA_MAILING_MAX_TIME', compa::encodeutf('Tempo massimo di coda'));
define('_ACA_MAILING_MAX_TIME_TIPS', compa::encodeutf('Definisce il tempo massimo per ciascun gruppo di emails inviate. Si raccomanda sia tra 30 secondi e 2 minuti.'));

// virtuemart integration beta
define('_ACA_VM_INTEGRATION', compa::encodeutf('Integrazione VirtueMart'));
define('_ACA_VM_COUPON_NOTIF', compa::encodeutf('ID comunicazione Buono'));
define('_ACA_VM_COUPON_NOTIF_TIPS', compa::encodeutf('Specifica il numero ID della mailing che vuoi usare per inviare buoni ai tuoi clienti.'));
define('_ACA_VM_NEW_PRODUCT', compa::encodeutf('ID comunicazione nuovi prodotti'));
define('_ACA_VM_NEW_PRODUCT_TIPS', compa::encodeutf('Specifica il numero ID della mailing che vuoi usare per inviare la comunicazione di nuovi prodotti.'));

// dalla 1.0.8
// crea forms per iscrizioni
define('_ACA_FORM_BUTTON', compa::encodeutf('Crea form'));
define('_ACA_FORM_COPY', compa::encodeutf('codice HTML'));
define('_ACA_FORM_COPY_TIPS', compa::encodeutf('Copia il codice sorgente HTML nella tua pagina HTML.'));
define('_ACA_FORM_LIST_TIPS', compa::encodeutf('Seleziona la lista che vuoi inserire nel form'));
// messaggi aggiornamento
define('_ACA_UPDATE_MESS4', compa::encodeutf('Pu&ograve;\non pu&ograve; essere aggiornato automaticamente.'));
define('_ACA_WARNG_REMOTE_FILE', compa::encodeutf('Nessun modo per prendere il file remoto.'));
define('_ACA_ERROR_FETCH', compa::encodeutf('Errore di prelievo file.'));

define('_ACA_CHECK', compa::encodeutf('Controllo'));
define('_ACA_MORE_INFO', compa::encodeutf('Informazioni aggiuntive'));
define('_ACA_UPDATE_NEW', compa::encodeutf('Aggiorna alla nuova versione'));
define('_ACA_UPGRADE', compa::encodeutf('Upgrade to higher product'));
define('_ACA_DOWNDATE', compa::encodeutf('Roll back to previous version'));
define('_ACA_DOWNGRADE', compa::encodeutf('Indietro al prodotto di base'));
define('_ACA_REQUIRE_JOOM', compa::encodeutf('Richiede Joomla'));
define('_ACA_TRY_IT', compa::encodeutf('Provalo!'));
define('_ACA_NEWER', compa::encodeutf('Pi&ugrave; nuovo'));
define('_ACA_OLDER', compa::encodeutf('Pi&ugrave; vecchio'));
define('_ACA_CURRENT', compa::encodeutf('Attuale'));

// dalla 1.0.9
define('_ACA_CHECK_COMP', compa::encodeutf('Prova uno degli altri componenti'));
define('_ACA_MENU_VIDEO', compa::encodeutf('Lezioni Video'));
define('_ACA_AUTO_SCHEDULE', compa::encodeutf('Programma'));
define('_ACA_SCHEDULE_TITLE', compa::encodeutf('Regolazione funzione automatica programma'));
define('_ACA_ISSUE_NB_TIPS', compa::encodeutf('Numero di edizione generato automaticamente dal sistema'));
define('_ACA_SEL_ALL', compa::encodeutf('Tutte le newsletters'));
define('_ACA_SEL_ALL_SUB', compa::encodeutf('Tutte le liste'));
define('_ACA_INTRO_ONLY_TIPS', compa::encodeutf('Se spunti questo box sar&agrave; inserita nella newsletter solo l\'introduzione  con un link all\'articolo completo sul tuo sito.'));
define('_ACA_TAGS_TITLE', compa::encodeutf('Tag Contenuto'));
define('_ACA_TAGS_TITLE_TIPS', compa::encodeutf('Copia e incolla questo tag tag nella newsletter dove vuoi che il contenuto relativo venga inserito.'));
define('_ACA_PREVIEW_EMAIL_TEST', compa::encodeutf('Indica l\'indirizzo email a cui inviare il test'));
define('_ACA_PREVIEW_TITLE', compa::encodeutf('Anteprima'));
define('_ACA_AUTO_UPDATE', compa::encodeutf('Nuova notifica aggiornamento'));
define('_ACA_AUTO_UPDATE_TIPS', compa::encodeutf('Seleziona SI se vuoi essere avvisato di nuovi aggiornamenti per il componente. <br />IMPORTANTE!! Si deve attivare Mostra suggerimenti perch&egrave; questa funzione lavori correttamente.'));

// dalls 1.1.0
define('_ACA_LICENSE', compa::encodeutf('Informazioni Licenza'));

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
define('_ACA_REGWARN_NAME', compa::encodeutf('Inserisci il tuo nome.'));
define('_ACA_REGWARN_MAIL', compa::encodeutf('Inserisci un indirizzo e-mail valido.'));

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