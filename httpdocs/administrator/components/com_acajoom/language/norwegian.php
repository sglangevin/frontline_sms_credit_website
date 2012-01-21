<?php
defined('_JEXEC') OR defined('_VALID_MOS') OR die('...Direct Access to this location is not allowed...');

/**
* <p>Norwegian language file.</p>
* @author Irma Rustad <irma@timeoffice.com>
* @version $Id: norwegian.php 491 2007-02-01 22:56:07Z divivo $
* @link http://www.timeoffice.com
*/

### General ###
 //acajoom Description
define('_ACA_DESC_NEWS', compa::encodeutf('Acajoom is a mailing lists, newsletters, auto-responders, and follow up tool to communication effectively with your users and customers.  ' .
		'Acajoom, Your Communication Partner!'));
define('_ACA_FEATURES', compa::encodeutf('Acajoom, your communication partner!'));

// Type of lists
define('_ACA_NEWSLETTER', compa::encodeutf('Nyhetsbrev'));
define('_ACA_AUTORESP', compa::encodeutf('Auto-responder'));
define('_ACA_AUTORSS', compa::encodeutf('Auto-RSS'));
define('_ACA_ECARD', compa::encodeutf('eCard'));
define('_ACA_POSTCARD', compa::encodeutf('Post card'));
define('_ACA_PERF', compa::encodeutf('Performance'));
define('_ACA_COUPON', compa::encodeutf('Coupon'));
define('_ACA_CRON', compa::encodeutf('Cron Task'));
define('_ACA_MAILING', compa::encodeutf('Mailing'));
define('_ACA_LIST', compa::encodeutf('List'));

 //acajoom Menu
define('_ACA_MENU_LIST', compa::encodeutf('Lists'));
define('_ACA_MENU_SUBSCRIBERS', compa::encodeutf('Subscribers'));
define('_ACA_MENU_NEWSLETTERS', compa::encodeutf('Newsletters'));
define('_ACA_MENU_AUTOS', compa::encodeutf('Auto-responders'));
define('_ACA_MENU_COUPONS', compa::encodeutf('Coupons'));
define('_ACA_MENU_CRONS', compa::encodeutf('Cron Tasks'));
define('_ACA_MENU_AUTORSS', compa::encodeutf('Auto-RSS'));
define('_ACA_MENU_ECARD', compa::encodeutf('eCards'));
define('_ACA_MENU_POSTCARDS', compa::encodeutf('Post cards'));
define('_ACA_MENU_PERFS', compa::encodeutf('Performances'));
define('_ACA_MENU_TAB_LIST', compa::encodeutf('Lists'));
define('_ACA_MENU_MAILING_TITLE', compa::encodeutf('Mailings'));
define('_ACA_MENU_MAILING', compa::encodeutf('Mailings for '));
define('_ACA_MENU_STATS', compa::encodeutf('Statistics'));
define('_ACA_MENU_STATS_FOR', compa::encodeutf('Statistics for '));
define('_ACA_MENU_CONF', compa::encodeutf('Configuration'));
define('_ACA_MENU_UPDATE', compa::encodeutf('Import'));
define('_ACA_MENU_ABOUT', compa::encodeutf('About'));
define('_ACA_MENU_LEARN', compa::encodeutf('Education center'));
define('_ACA_MENU_MEDIA', compa::encodeutf('Media Manager'));
define('_ACA_MENU_HELP', compa::encodeutf('Help'));
define('_ACA_MENU_CPANEL', compa::encodeutf('CPanel'));
define('_ACA_MENU_IMPORT', compa::encodeutf('Import'));
define('_ACA_MENU_EXPORT', compa::encodeutf('Export'));
define('_ACA_MENU_SUB_ALL', compa::encodeutf('Subcribe All'));
define('_ACA_MENU_UNSUB_ALL', compa::encodeutf('Unsubcribe All'));
define('_ACA_MENU_VIEW_ARCHIVE', compa::encodeutf('Arkiv '));
define('_ACA_MENU_PREVIEW', compa::encodeutf('Preview'));
define('_ACA_MENU_SEND', compa::encodeutf('Send'));
define('_ACA_MENU_SEND_TEST', compa::encodeutf('Send Test Email'));
define('_ACA_MENU_SEND_QUEUE', compa::encodeutf('Process Queue'));
define('_ACA_MENU_VIEW', compa::encodeutf('View'));
define('_ACA_MENU_COPY', compa::encodeutf('Copy'));
define('_ACA_MENU_VIEW_STATS', compa::encodeutf('View stats'));
define('_ACA_MENU_CRTL_PANEL', compa::encodeutf(' Control Panel'));
define('_ACA_MENU_LIST_NEW', compa::encodeutf(' Create a List'));
define('_ACA_MENU_LIST_EDIT', compa::encodeutf(' Edit a List'));
define('_ACA_MENU_BACK', compa::encodeutf('Back'));
define('_ACA_MENU_INSTALL', compa::encodeutf('Installation'));
define('_ACA_MENU_TAB_SUM', compa::encodeutf('Summary'));
define('_ACA_STATUS', compa::encodeutf('Status'));

// messages
define('_ACA_ERROR', compa::encodeutf(' En feil oppsto! '));
define('_ACA_SUB_ACCESS', compa::encodeutf('Tilgangsrettigheter'));
define('_ACA_DESC_CREDITS', compa::encodeutf('Kreditter'));
define('_ACA_DESC_INFO', compa::encodeutf('Informasjon'));
define('_ACA_DESC_HOME', compa::encodeutf('Hjemmeside'));
define('_ACA_DESC_MAILING', compa::encodeutf('Brevliste'));
define('_ACA_DESC_SUBSCRIBERS', compa::encodeutf('Abonnenter'));
define('_ACA_PUBLISHED', compa::encodeutf('Publisert'));
define('_ACA_UNPUBLISHED', compa::encodeutf('Upublisert'));
define('_ACA_DELETE', compa::encodeutf('Slett'));
define('_ACA_FILTER', compa::encodeutf('Filter'));
define('_ACA_UPDATE', compa::encodeutf('Oppdater'));
define('_ACA_SAVE', compa::encodeutf('Lagre'));
define('_ACA_CANCEL', compa::encodeutf('Avbryt'));
define('_ACA_NAME', compa::encodeutf('Navn'));
define('_ACA_EMAIL', compa::encodeutf('E-post'));
define('_ACA_SELECT', compa::encodeutf('Velg'));
define('_ACA_ALL', compa::encodeutf('Alt'));
define('_ACA_SEND_A', compa::encodeutf('Send en '));
define('_ACA_SUCCESS_DELETED', compa::encodeutf(' slettet ok'));
define('_ACA_LIST_ADDED', compa::encodeutf('Listen ble laget'));
define('_ACA_LIST_COPY', compa::encodeutf('Listen er kopiert'));
define('_ACA_LIST_UPDATED', compa::encodeutf('Listen er oppdatert'));
define('_ACA_MAILING_SAVED', compa::encodeutf('Brevene er lagret.'));
define('_ACA_UPDATED_SUCCESSFULLY', compa::encodeutf('oppdatert ok.'));

### Subscribers information ###
//subscribe and unsubscribe info
define('_ACA_SUB_INFO', compa::encodeutf('Abonnenten\'s informasjon'));
define('_ACA_VERIFY_INFO', compa::encodeutf('Vennligst bekreft lenken du sendte inn, noe informasjon mangler. '));
define('_ACA_INPUT_NAME', compa::encodeutf('Navn'));
define('_ACA_INPUT_EMAIL', compa::encodeutf('EPost'));
define('_ACA_RECEIVE_HTML', compa::encodeutf('Motta HTML?'));
define('_ACA_TIME_ZONE', compa::encodeutf('Tidssone'));
define('_ACA_BLACK_LIST', compa::encodeutf('Svarteliste'));
define('_ACA_REGISTRATION_DATE', compa::encodeutf('Brukerens registreringsdato'));
define('_ACA_USER_ID', compa::encodeutf('Bruker id'));
define('_ACA_DESCRIPTION', compa::encodeutf('Beskrivelse'));
define('_ACA_ACCOUNT_CONFIRMED', compa::encodeutf('Din konto har blitt aktivert.'));
define('_ACA_SUB_SUBSCRIBER', compa::encodeutf('Mottager'));
define('_ACA_SUB_PUBLISHER', compa::encodeutf('Utgiver'));
define('_ACA_SUB_ADMIN', compa::encodeutf('Administrator'));
define('_ACA_REGISTERED', compa::encodeutf('Registrert'));
define('_ACA_SUBSCRIPTIONS', compa::encodeutf('Ditt Abonnement'));
define('_ACA_SEND_UNSUBCRIBE', compa::encodeutf('Send avmeld melding'));
define('_ACA_SEND_UNSUBCRIBE_TIPS', compa::encodeutf('Klikk Ja for å sende en e-post for å bekrefte avmeldingen.'));
define('_ACA_SUBSCRIBE_SUBJECT_MESS', compa::encodeutf('Vennligst bekreft ditt abonnement. '));
define('_ACA_UNSUBSCRIBE_SUBJECT_MESS', compa::encodeutf('Bekreftelse på avmelding'));
define('_ACA_DEFAULT_SUBSCRIBE_MESS', compa::encodeutf('Hi [NAME],<br>' .
		'Kun et steg igjen og du er nyhetsbrev abonnent. Vennligst klikk på denne lenken for bekrefte ditt abonnement' .
		'<br><br>[CONFIRM]<br><br>Har du spørsmål, vennligst kontakt vår web redaktør.'));
define('_ACA_DEFAULT_UNSUBSCRIBE_MESS', compa::encodeutf('Dette er en e-post for å bekrefte at du ikke lengre abonnerer på vårt nyhetsbrev. Vi beklager din beslutning og skulle du noen gang ønske å bli abonnent igjen kan du melde deg på via vår nettløsning. Har du spørsmål, vennligst kontakt vår web redaktør.'));

// Acajoom subscribers
define('_ACA_SIGNUP_DATE', compa::encodeutf('Abonnement startdato'));
define('_ACA_CONFIRMED', compa::encodeutf('Bekreftet'));
define('_ACA_SUBSCRIB', compa::encodeutf('Abonner'));
define('_ACA_HTML', compa::encodeutf('HTML brev'));
define('_ACA_RESULTS', compa::encodeutf('Resultater'));
define('_ACA_SEL_LIST', compa::encodeutf('Velg en liste'));
define('_ACA_SEL_LIST_TYPE', compa::encodeutf('- Velg en type liste -'));
define('_ACA_SUSCRIB_LIST', compa::encodeutf('Liste med alle abonnenter'));
define('_ACA_SUSCRIB_LIST_UNIQUE', compa::encodeutf('abonnenter for : '));
define('_ACA_NO_SUSCRIBERS', compa::encodeutf('Ingen abonnenter ble funnet for denne listen.'));
define('_ACA_COMFIRM_SUBSCRIPTION', compa::encodeutf('En e-post for å bekrefte har blitt sent til deg.  Vennligst sjekk din e-post og klikk på linken vi har sent til deg.<br>' .
		'Du må bekrefte din e-post adresse for at abonnementet skal begynne.'));
define('_ACA_SUCCESS_ADD_LIST', compa::encodeutf('Du har blitt lagt til listen.'));


 // Subcription info
define('_ACA_CONFIRM_LINK', compa::encodeutf('Klikk her for å bekrefte ditt abonnement'));
define('_ACA_UNSUBSCRIBE_LINK', compa::encodeutf('Klikk her for å avslutte abonnementet'));
define('_ACA_UNSUBSCRIBE_MESS', compa::encodeutf('Din e-post har blitt fjernet fra listen'));

define('_ACA_QUEUE_SENT_SUCCESS', compa::encodeutf('Alle planlagte brev har blitt sent.'));
define('_ACA_MALING_VIEW', compa::encodeutf('Vis alle utsendelser'));
define('_ACA_UNSUBSCRIBE_MESSAGE', compa::encodeutf('Er du sikker på at du ønsker å avslutte abonnementet?'));
define('_ACA_MOD_SUBSCRIBE', compa::encodeutf('Abonner'));
define('_ACA_SUBSCRIBE', compa::encodeutf('Abonner'));
define('_ACA_UNSUBSCRIBE', compa::encodeutf('Avslutt abonnement'));
define('_ACA_VIEW_ARCHIVE', compa::encodeutf('Vis arkiv'));
define('_ACA_SUBSCRIPTION_OR', compa::encodeutf(' eller klikk her for å oppdatere dine opplysninger'));
define('_ACA_EMAIL_ALREADY_REGISTERED', compa::encodeutf('Denne e-post adressen har allerede blitt registrert. '));
define('_ACA_SUBSCRIBER_DELETED', compa::encodeutf('Abonnenten er slettet.'));


### UserPanel ###
 //User Menu
define('_UCP_USER_PANEL', compa::encodeutf('Bruker kontrollpanel'));
define('_UCP_USER_MENU', compa::encodeutf('User Menu'));
define('_UCP_USER_CONTACT', compa::encodeutf('Mine abonnement'));
 //Acajoom Cron Menu
define('_UCP_CRON_MENU', compa::encodeutf('Cron Task Management'));
define('_UCP_CRON_NEW_MENU', compa::encodeutf('New Cron'));
define('_UCP_CRON_LIST_MENU', compa::encodeutf('List my Cron'));
 //Acajoom Coupon Menu
define('_UCP_COUPON_MENU', compa::encodeutf('Coupons Management'));
define('_UCP_COUPON_LIST_MENU', compa::encodeutf('List of Coupons'));
define('_UCP_COUPON_ADD_MENU', compa::encodeutf('Add a Coupon'));

### lists ###
// Tabs
define('_ACA_LIST_T_GENERAL', compa::encodeutf('Beskrivelse'));
define('_ACA_LIST_T_LAYOUT', compa::encodeutf('Oppsett'));
define('_ACA_LIST_T_SUBSCRIPTION', compa::encodeutf('Abonnement'));
define('_ACA_LIST_T_SENDER', compa::encodeutf('Sender informasjon'));

define('_ACA_LIST_TYPE', compa::encodeutf('Type liste'));
define('_ACA_LIST_NAME', compa::encodeutf('Liste navn'));
define('_ACA_LIST_ISSUE', compa::encodeutf('Utgave #'));
define('_ACA_LIST_DATE', compa::encodeutf('Sende dato'));
define('_ACA_LIST_SUB', compa::encodeutf('Nyhetsbrev tema'));
define('_ACA_ATTACHED_FILES', compa::encodeutf('Tilknyttede filer'));
define('_ACA_SELECT_LIST', compa::encodeutf('Vennligst velg en liste for å forandre den!'));

// Auto Responder box
define('_ACA_AUTORESP_ON', compa::encodeutf('Type of list'));
define('_ACA_AUTO_RESP_OPTION', compa::encodeutf('Auto-responder options'));
define('_ACA_AUTO_RESP_FREQ', compa::encodeutf('Subscribers can choose frequency'));
define('_ACA_AUTO_DELAY', compa::encodeutf('Delay (in days)'));
define('_ACA_AUTO_DAY_MIN', compa::encodeutf('Minimum frequency'));
define('_ACA_AUTO_DAY_MAX', compa::encodeutf('Maximum frequency'));
define('_ACA_FOLLOW_UP', compa::encodeutf('Specify follow up auto-responder'));
define('_ACA_AUTO_RESP_TIME', compa::encodeutf('Subscribers can choose time'));
define('_ACA_LIST_SENDER', compa::encodeutf('List sender'));

define('_ACA_LIST_DESC', compa::encodeutf('List description'));
define('_ACA_LAYOUT', compa::encodeutf('Layout'));
define('_ACA_SENDER_NAME', compa::encodeutf('Sender name'));
define('_ACA_SENDER_EMAIL', compa::encodeutf('Sender email'));
define('_ACA_SENDER_BOUNCE', compa::encodeutf('Sender bounce address'));
define('_ACA_LIST_DELAY', compa::encodeutf('Delay'));
define('_ACA_HTML_MAILING', compa::encodeutf('HTML mailing?'));
define('_ACA_HTML_MAILING_DESC', compa::encodeutf('(if you change this, you\'ll have to save and return to this screen to see the changes.)'));
define('_ACA_HIDE_FROM_FRONTEND', compa::encodeutf('Hide from frontend?'));
define('_ACA_SELECT_IMPORT_FILE', compa::encodeutf('Select a file to import'));;
define('_ACA_IMPORT_FINISHED', compa::encodeutf('Import finished'));
define('_ACA_DELETION_OFFILE', compa::encodeutf('Deletion of file'));
define('_ACA_MANUALLY_DELETE', compa::encodeutf('failed, you should manually delete the file'));
define('_ACA_CANNOT_WRITE_DIR', compa::encodeutf('Cannot write directory'));
define('_ACA_NOT_PUBLISHED', compa::encodeutf('Could not sent the mailing, the list is not published.'));

//  List info box
define('_ACA_INFO_LIST_PUB', compa::encodeutf('Click Yes to publish the list'));
define('_ACA_INFO_LIST_NAME', compa::encodeutf('Enter the name of your list here. You can identify the list with this name.'));
define('_ACA_INFO_LIST_DESC', compa::encodeutf('Enter a brief description of your list here. This description will be visible to visitors at your site.'));
define('_ACA_INFO_LIST_SENDER_NAME', compa::encodeutf('Enter the name of the sender of the mailing. This name will be visible when subscribers receive messages from this list.'));
define('_ACA_INFO_LIST_SENDER_EMAIL', compa::encodeutf('Enter the email address from which the messages will be sent.'));
define('_ACA_INFO_LIST_SENDER_BOUNCED', compa::encodeutf('Enter the email address where users can reply to. It\'s highly recommended to be the same as the sender email, since spam filters will give your message a higher spam ranking if they are different.'));
define('_ACA_INFO_LIST_AUTORESP', compa::encodeutf('Choose the type of mailings for this list. <br>' .
		'Newsletter: normal newsletter<br>' .
		'Auto-responder: an auto-responder is a list which is sent automatically through the website at regular intervals.'));
define('_ACA_INFO_LIST_FREQUENCY', compa::encodeutf('Enable the users to choose how often they receive the list.  It gives more flexibility to the user.'));
define('_ACA_INFO_LIST_TIME', compa::encodeutf('Let the user choose their preferred time of the day to receive the list.'));
define('_ACA_INFO_LIST_MIN_DAY', compa::encodeutf('Define what is the minimum frequency a user can choose to receive the list'));
define('_ACA_INFO_LIST_DELAY', compa::encodeutf('Specify the delay between this auto-responder and the previous one.'));
define('_ACA_INFO_LIST_DATE', compa::encodeutf('Specify the date to publish the news list if you want to delay the publishing. <br> FORMAT : YYYY-MM-DD HH:MM:SS'));
define('_ACA_INFO_LIST_MAX_DAY', compa::encodeutf('Define what is the maximum frequency a user can choose to receive the list'));
define('_ACA_INFO_LIST_LAYOUT', compa::encodeutf('Enter the layout of your mailing list here. You can enter any layout for your mailing here.'));
define('_ACA_INFO_LIST_SUB_MESS', compa::encodeutf('This message will be send to the subscriber when he or she first registers. You can define any text you like in here.'));
define('_ACA_INFO_LIST_UNSUB_MESS', compa::encodeutf('This message will be send to the subscriber when he or she unsubscribes. Any message can be entered here.'));
define('_ACA_INFO_LIST_HTML', compa::encodeutf('Select the checkbox if you wish to send out a HTML mailing. Subscribers will be able to specify if they wish to receive the HTML message, or the Text only message when subscribe to a HTML list.'));
define('_ACA_INFO_LIST_HIDDEN', compa::encodeutf('Click Yes to hide the list from the fontend, users won\'t be able to subscribe but you will be still able to send mailings.'));
define('_ACA_INFO_LIST_ACA_AUTO_SUB', compa::encodeutf('Do you want to automatically subscribe users to this list?<br><B>New Users:</B> will registerer every new users who register on the website.<br><B>All Users:</B> will register every registered users in the database.<br>(all those option support Community Builder)'));
define('_ACA_INFO_LIST_ACC_LEVEL', compa::encodeutf('Select the frontend access level. This will show or hide the mailing to usergroups who don\'t have access to it, so they won\'t be able to subscribe to it.'));
define('_ACA_INFO_LIST_ACC_USER_ID', compa::encodeutf('Select the access level of the usergroup you wish to allow editing. That usergroup and above will be able to edit the mailing and send it out, either from the frontend or backend.'));
define('_ACA_INFO_LIST_FOLLOW_UP', compa::encodeutf('If you want the auto-responder to move to another one once it reaches the last message you can specify here the following up auto-responder.'));
define('_ACA_INFO_LIST_ACA_OWNER', compa::encodeutf('This is the ID of the person who created the list.'));
define('_ACA_INFO_LIST_WARNING', compa::encodeutf('   This last option is available only once at the creation of the list.'));
define('_ACA_INFO_LIST_SUBJET', compa::encodeutf(' Subject of the mailing.  This is the subject of the email the subscriber will received.'));
define('_ACA_INFO_MAILING_CONTENT', compa::encodeutf('This is the body of email you want to send.'));
define('_ACA_INFO_MAILING_NOHTML', compa::encodeutf('Enter here the body of the email you want to send to subscribers who choose to receive only none HTML mailings. <BR/> NOTE: if you leave it blank Acajoom will automatically convert the HTML text into text only.'));
define('_ACA_INFO_MAILING_VISIBLE', compa::encodeutf('Click Yes to show the mailing in the fontend.'));
define('_ACA_INSERT_CONTENT', compa::encodeutf('Insert existing content'));

// Coupons
define('_ACA_SEND_COUPON_SUCCESS', compa::encodeutf('Coupon successfully sent!'));
define('_ACA_CHOOSE_COUPON', compa::encodeutf('Choose a coupon'));
define('_ACA_TO_USER', compa::encodeutf(' to this user'));

### Cron options
//drop down frequency(CRON)
define('_ACA_FREQ_CH1', compa::encodeutf('Every hours'));
define('_ACA_FREQ_CH2', compa::encodeutf('Every 6 hours'));
define('_ACA_FREQ_CH3', compa::encodeutf('Every 12 hours'));
define('_ACA_FREQ_CH4', compa::encodeutf('Daily'));
define('_ACA_FREQ_CH5', compa::encodeutf('Weekly'));
define('_ACA_FREQ_CH6', compa::encodeutf('Monthly'));
define('_ACA_FREQ_NONE', compa::encodeutf('No'));
define('_ACA_FREQ_NEW', compa::encodeutf('New Users'));
define('_ACA_FREQ_ALL', compa::encodeutf('All Users'));

//Label CRON form
define('_ACA_LABEL_FREQ', compa::encodeutf('Acajoom Cron?'));
define('_ACA_LABEL_FREQ_TIPS', compa::encodeutf('Click Yes if you want to use this for an Acajoom Cron, No for any other cron task.<br>' .
		'If you click Yes you don\'t need to specify the Cron Address, it will be automatically added.'));
define('_ACA_SITE_URL', compa::encodeutf('Your site URL'));
define('_ACA_CRON_FREQUENCY', compa::encodeutf('Cron Frequency'));
define('_ACA_STARTDATE_FREQ', compa::encodeutf('Start Date'));
define('_ACA_LABELDATE_FREQ', compa::encodeutf('Specify Date'));
define('_ACA_LABELTIME_FREQ', compa::encodeutf('Specify Time'));
define('_ACA_CRON_URL', compa::encodeutf('Cron URL'));
define('_ACA_CRON_FREQ', compa::encodeutf('Frequency'));
define('_ACA_TITLE_CRONLIST', compa::encodeutf('Cron List'));
define('_NEW_LIST', compa::encodeutf('Create a new list'));

//title CRON form
define('_ACA_TITLE_FREQ', compa::encodeutf('Cron Edit'));
define('_ACA_CRON_SITE_URL', compa::encodeutf('Please enter a valid site url, starting with http://'));

### Mailings ###
define('_ACA_MAILING_ALL', compa::encodeutf('All mailings'));
define('_ACA_EDIT_A', compa::encodeutf('Edit a '));
define('_ACA_SELCT_MAILING', compa::encodeutf('Please select a list in the drop down menu in order to add a new mailing.'));
define('_ACA_VISIBLE_FRONT', compa::encodeutf('Visible in frontend'));

// mailer
define('_ACA_SUBJECT', compa::encodeutf('Subject'));
define('_ACA_CONTENT', compa::encodeutf('Content'));
define('_ACA_NAMEREP', compa::encodeutf('[NAME] = This will be replaced by the name the subscriber entered, you\'ll be sending personalized email when using this.<br>'));
define('_ACA_FIRST_NAME_REP', compa::encodeutf('[FIRSTNAME] = This will be replaced by the FIRST name of the subscriber entered.<br>'));
define('_ACA_NONHTML', compa::encodeutf('Non-html version'));
define('_ACA_ATTACHMENTS', compa::encodeutf('Attachments'));
define('_ACA_SELECT_MULTIPLE', compa::encodeutf('Hold control (or command) to select multiple attachments.<br>' .
		'The files displayed in this attachement list are located in the attachement folder, you can change this location in the configuration panel.'));
define('_ACA_CONTENT_ITEM', compa::encodeutf('Content item'));
define('_ACA_SENDING_EMAIL', compa::encodeutf('Sending email'));
define('_ACA_MESSAGE_NOT', compa::encodeutf('Message could not be sent'));
define('_ACA_MAILER_ERROR', compa::encodeutf('Mailer error'));
define('_ACA_MESSAGE_SENT_SUCCESSFULLY', compa::encodeutf('Message sent successfully'));
define('_ACA_SENDING_TOOK', compa::encodeutf('Sending this mailing took'));
define('_ACA_SECONDS', compa::encodeutf('seconds'));
define('_ACA_NO_ADDRESS_ENTERED', compa::encodeutf('No email address or subscriber provided'));
define('_ACA_CHANGE_SUBSCRIPTIONS', compa::encodeutf('Endre'));
define('_ACA_CHANGE_EMAIL_SUBSCRIPTION', compa::encodeutf('Endre ditt abonnement'));
define('_ACA_WHICH_EMAIL_TEST', compa::encodeutf('Indicate the email address to send a test to or select preview'));
define('_ACA_SEND_IN_HTML', compa::encodeutf('Send in HTML (for html mailings)?'));
define('_ACA_VISIBLE', compa::encodeutf('Visible'));
define('_ACA_INTRO_ONLY', compa::encodeutf('Intro only'));

// stats
define('_ACA_GLOBALSTATS', compa::encodeutf('Global stats'));
define('_ACA_DETAILED_STATS', compa::encodeutf('Detailed stats'));
define('_ACA_MAILING_LIST_DETAILS', compa::encodeutf('List details'));
define('_ACA_SEND_IN_HTML_FORMAT', compa::encodeutf('Send in HTML format'));
define('_ACA_VIEWS_FROM_HTML', compa::encodeutf('Views (from html mails)'));
define('_ACA_SEND_IN_TEXT_FORMAT', compa::encodeutf('Send in text format'));
define('_ACA_HTML_READ', compa::encodeutf('HTML read'));
define('_ACA_HTML_UNREAD', compa::encodeutf('HTML unread'));
define('_ACA_TEXT_ONLY_SENT', compa::encodeutf('Text only'));

// Configuration panel
// main tabs
define('_ACA_MAIL_CONFIG', compa::encodeutf('Mail'));
define('_ACA_LOGGING_CONFIG', compa::encodeutf('Logs & Stats'));
define('_ACA_SUBSCRIBER_CONFIG', compa::encodeutf('Subscribers'));
define('_ACA_AUTO_CONFIG', compa::encodeutf('Cron'));
define('_ACA_MISC_CONFIG', compa::encodeutf('Miscellaneous'));
define('_ACA_MAIL_SETTINGS', compa::encodeutf('Mail Settings'));
define('_ACA_MAILINGS_SETTINGS', compa::encodeutf('Mailings Settings'));
define('_ACA_SUBCRIBERS_SETTINGS', compa::encodeutf('Subscribers Settings'));
define('_ACA_CRON_SETTINGS', compa::encodeutf('Cron Settings'));
define('_ACA_SENDING_SETTINGS', compa::encodeutf('Sending Settings'));
define('_ACA_STATS_SETTINGS', compa::encodeutf('Statistics Settings'));
define('_ACA_LOGS_SETTINGS', compa::encodeutf('Logs Settings'));
define('_ACA_MISC_SETTINGS', compa::encodeutf('Miscellaneous Settings'));
// mail settings
define('_ACA_SEND_MAIL_FROM', compa::encodeutf('From Email'));
define('_ACA_SEND_MAIL_NAME', compa::encodeutf('From Name'));
define('_ACA_MAILSENDMETHOD', compa::encodeutf('Mailer method'));
define('_ACA_SENDMAILPATH', compa::encodeutf('Sendmail path'));
define('_ACA_SMTPHOST', compa::encodeutf('SMTP host'));
define('_ACA_SMTPAUTHREQUIRED', compa::encodeutf('SMTP Authentication required'));
define('_ACA_SMTPAUTHREQUIRED_TIPS', compa::encodeutf('Select yes if your SMTP server requires authentication'));
define('_ACA_SMTPUSERNAME', compa::encodeutf('SMTP username'));
define('_ACA_SMTPUSERNAME_TIPS', compa::encodeutf('Enter the SMTP username when your SMTP server requires authentication'));
define('_ACA_SMTPPASSWORD', compa::encodeutf('SMTP password'));
define('_ACA_SMTPPASSWORD_TIPS', compa::encodeutf('Enter the SMTP password when your SMTP server requires authentication'));
define('_ACA_USE_EMBEDDED', compa::encodeutf('Use embedded images'));
define('_ACA_USE_EMBEDDED_TIPS', compa::encodeutf('Select yes if the images in attached content items should be embedded in the email for html messages, or no to use default image tags that link to the images on the site.'));
define('_ACA_UPLOAD_PATH', compa::encodeutf('Upload/attachements path'));
define('_ACA_UPLOAD_PATH_TIPS', compa::encodeutf('You can specify an upload directory.<br>' .
		'Make sure that the directory you specify exist, otherwise create it.'));

// subscribers settings
define('_ACA_ALLOW_UNREG', compa::encodeutf('Allow unregistered'));
define('_ACA_ALLOW_UNREG_TIPS', compa::encodeutf('Select Yes if you want to allow users to subscribe to lists without registering at the site.'));
define('_ACA_REQ_CONFIRM', compa::encodeutf('Require confirmation'));
define('_ACA_REQ_CONFIRM_TIPS', compa::encodeutf('Select yes if you require that unregistered subscribers confirm their email address.'));
define('_ACA_SUB_SETTINGS', compa::encodeutf('Subscribe Settings'));
define('_ACA_SUBMESSAGE', compa::encodeutf('Subscribe Email'));
define('_ACA_SUBSCRIBE_LIST', compa::encodeutf('Subscribe to a list'));

define('_ACA_USABLE_TAGS', compa::encodeutf('Usable tags'));
define('_ACA_NAME_AND_CONFIRM', compa::encodeutf('<b>[CONFIRM]</b> = This creates a clickable link where the subscriber can confirm their subscription. This is <strong>required</strong> to make Acajoom work properly.<br>'
.'<br>[NAME] = This will be replaced by the name the subscriber entered, you\'ll be sending personalized email when using this.<br>'
.'<br>[FIRSTNAME] = This will be replaced by the FIRST name of the subscriber, First name is DEFINEd as the first name entered by the subscriber.<br>'));
define('_ACA_CONFIRMFROMNAME', compa::encodeutf('Confirm from name'));
define('_ACA_CONFIRMFROMNAME_TIPS', compa::encodeutf('Enter the from name to display on confirmation lists.'));
define('_ACA_CONFIRMFROMEMAIL', compa::encodeutf('Confirm from email'));
define('_ACA_CONFIRMFROMEMAIL_TIPS', compa::encodeutf('Enter the email address to display on confirmation lists.'));
define('_ACA_CONFIRMBOUNCE', compa::encodeutf('Bounce address'));
define('_ACA_CONFIRMBOUNCE_TIPS', compa::encodeutf('Enter the bounce address to display on confirmation lists.'));
define('_ACA_HTML_CONFIRM', compa::encodeutf('HTML confirm'));
define('_ACA_HTML_CONFIRM_TIPS', compa::encodeutf('Select yes if confirmation lists should be html if the user allows html.'));
define('_ACA_TIME_ZONE_ASK', compa::encodeutf('Ask time zone'));
define('_ACA_TIME_ZONE_TIPS', compa::encodeutf('Select yes if you want to ask the user\'s time zone. The queued mailings will be sent based on time zone when applicable'));

 // Cron Set up
define('_ACA_TIME_OFFSET_URL', compa::encodeutf('click here to set up the offset in the global configuration panel -> Locale tab'));
define('_ACA_TIME_OFFSET_TIPS', compa::encodeutf('Set up your server time offset so that recorded date and time are exact'));
define('_ACA_TIME_OFFSET', compa::encodeutf('Time offset'));
define('_ACA_CRON_TITLE', compa::encodeutf('Setting up cron function'));
define('_ACA_CRON_DESC', compa::encodeutf('<br>Using the cron function you can setup an automated task for your Joomla website!<br>' .
		'To set it up you need to add in your control panel crontab the following command:<br>' .
		'<b>' . ACA_JPATH_LIVE . '/index2.php?option=com_acajoom&act=cron</b> ' .
		'<br><br>If you need help setting it up or have problems please consult our forum <a href="http://www.ijoobi.com" target="_blank">http://www.ijoobi.com</a>'));
// sending settings
define('_ACA_PAUSEX', compa::encodeutf('Pause x seconds every configured amount of emails'));
define('_ACA_PAUSEX_TIPS', compa::encodeutf('Enter a number of seconds Acajoom will give the SMTP server the time to send out the messages before proceeding with the next configured amount of messages.'));
define('_ACA_EMAIL_BET_PAUSE', compa::encodeutf('Emails between pauses'));
define('_ACA_EMAIL_BET_PAUSE_TIPS', compa::encodeutf('The number of emails to send before pausing.'));
define('_ACA_WAIT_USER_PAUSE', compa::encodeutf('Wait for user input at pause'));
define('_ACA_WAIT_USER_PAUSE_TIPS', compa::encodeutf('Whether the script should wait for user input when paused between sets of mailings.'));
define('_ACA_SCRIPT_TIMEOUT', compa::encodeutf('Script timeout'));
define('_ACA_SCRIPT_TIMEOUT_TIPS', compa::encodeutf('The number of minutes the script should be able to run (0 for unlimited).'));
// Stats settings
define('_ACA_ENABLE_READ_STATS', compa::encodeutf('Enable read statistics'));
define('_ACA_ENABLE_READ_STATS_TIPS', compa::encodeutf('Select yes if you want to log the number of views. This technique can only be used with html mailings'));
define('_ACA_LOG_VIEWSPERSUB', compa::encodeutf('Log views per subscriber'));
define('_ACA_LOG_VIEWSPERSUB_TIPS', compa::encodeutf('Select yes if you want to log the number of views per subscriber. This technique can only be used with html mailings'));
// Logs settings
define('_ACA_DETAILED', compa::encodeutf('Detailed logs'));
define('_ACA_SIMPLE', compa::encodeutf('Simplified logs'));
define('_ACA_DIAPLAY_LOG', compa::encodeutf('Display logs'));
define('_ACA_DISPLAY_LOG_TIPS', compa::encodeutf('Select yes if you want to display the logs while sending mailings.'));
define('_ACA_SEND_PERF_DATA', compa::encodeutf('Send out performance'));
define('_ACA_SEND_PERF_DATA_TIPS', compa::encodeutf('Select yes if you want to allow Acajoom to send out ANONYMOUS reports about your configuration, the number of subscribers to a list and the time it took to send the mailing. This will give us an idea about Acajoom performance and will HELP US	improve Acajoom in future developments.'));
define('_ACA_SEND_AUTO_LOG', compa::encodeutf('Send log for auto-responder'));
define('_ACA_SEND_AUTO_LOG_TIPS', compa::encodeutf('Select yes if you want to send an email log each time teh queue is processed.  WARMING: this can resuLt in a large among of emails.'));
define('_ACA_SEND_LOG', compa::encodeutf('Send log'));
define('_ACA_SEND_LOG_TIPS', compa::encodeutf('Whether a log of the mailing should be emailed to the email address of the user who sent the mailing.'));
define('_ACA_SEND_LOGDETAIL', compa::encodeutf('Send log detail'));
define('_ACA_SEND_LOGDETAIL_TIPS', compa::encodeutf('Detailed includes the success or failure information for each subscriber and an overview of the information. Simple only sends the overview.'));
define('_ACA_SEND_LOGCLOSED', compa::encodeutf('Send log if connection closed'));
define('_ACA_SEND_LOGCLOSED_TIPS', compa::encodeutf(' With this option on the user who sent the mailing will still receive a report by email.'));
define('_ACA_SAVE_LOG', compa::encodeutf('Save log'));
define('_ACA_SAVE_LOG_TIPS', compa::encodeutf('Whether a log of the mailing should be appended to the log file.'));
define('_ACA_SAVE_LOGDETAIL', compa::encodeutf('Save log detail'));
define('_ACA_SAVE_LOGDETAIL_TIPS', compa::encodeutf('Detailed includes the success or failure information for each subscriber and an overview of the information. Simple only saves the overview.'));
define('_ACA_SAVE_LOGFILE', compa::encodeutf('Save log file'));
define('_ACA_SAVE_LOGFILE_TIPS', compa::encodeutf('File to which log information is appended. This file could become rather large.'));
define('_ACA_CLEAR_LOG', compa::encodeutf('Clear log'));
define('_ACA_CLEAR_LOG_TIPS', compa::encodeutf('Clears the log file.'));

### control panel
define('_ACA_CP_LAST_QUEUE', compa::encodeutf('Last executed queue'));
define('_ACA_CP_TOTAL', compa::encodeutf('Total'));
define('_ACA_MAILING_COPY', compa::encodeutf('Mailing successfully copied!'));

// Miscellaneous settings
define('_ACA_SHOW_GUIDE', compa::encodeutf('Show guide'));
define('_ACA_SHOW_GUIDE_TIPS', compa::encodeutf('Show the guide at the starts to help new users to create a newsletter, an auto-responder and setup Acajoom properly.'));
define('_ACA_AUTOS_ON', compa::encodeutf('Use Auto-responders'));
define('_ACA_AUTOS_ON_TIPS', compa::encodeutf('Select No if you don\'t want to use Auto-responders, all the auto-responders option will be desactivated.'));
define('_ACA_NEWS_ON', compa::encodeutf('Use Newsletters'));
define('_ACA_NEWS_ON_TIPS', compa::encodeutf('Select No if you don\'t want to use Newsletters, all the newsletters option will be desactivated.'));
define('_ACA_SHOW_TIPS', compa::encodeutf('Show tips'));
define('_ACA_SHOW_TIPS_TIPS', compa::encodeutf('Show the tips, to help users use Acajoom more effectively.'));
define('_ACA_SHOW_FOOTER', compa::encodeutf('Show the footer'));
define('_ACA_SHOW_FOOTER_TIPS', compa::encodeutf('Whether or not the footer copyright notice should be displayed.'));
define('_ACA_SHOW_LISTS', compa::encodeutf('Show lists in frontend'));
define('_ACA_SHOW_LISTS_TIPS', compa::encodeutf('When user are not registered show a list of the lists they can subscribe to with archive button for newsletter or simply a login form so that they register.'));
define('_ACA_CONFIG_UPDATED', compa::encodeutf('The configuration details have been updated!'));
define('_ACA_UPDATE_URL', compa::encodeutf('Update URL'));
define('_ACA_UPDATE_URL_WARNING', compa::encodeutf('WARNING! Do not change this URL unless you have been asked to do so by Acajoom technical team.<br>'));
define('_ACA_UPDATE_URL_TIPS', compa::encodeutf('For example: http://www.ijoobi.com/update/ (include the closing slash)'));

// module
define('_ACA_EMAIL_INVALID', compa::encodeutf('The email entered is invalid.'));
define('_ACA_REGISTER_REQUIRED', compa::encodeutf('Please register to the site before you can sign for a list.'));

// Access level box
define('_ACA_OWNER', compa::encodeutf('Creator of the list:'));
define('_ACA_ACCESS_LEVEL', compa::encodeutf('Set access level for the list'));
define('_ACA_ACCESS_LEVEL_OPTION', compa::encodeutf('Access level Options'));
define('_ACA_USER_LEVEL_EDIT', compa::encodeutf('Select which user level is allowed to edit a mailing (either from frontend or backend) '));

//  drop down options
define('_ACA_AUTO_DAY_CH1', compa::encodeutf('Daily'));
define('_ACA_AUTO_DAY_CH2', compa::encodeutf('Daily  no weekend'));
define('_ACA_AUTO_DAY_CH3', compa::encodeutf('Every other day'));
define('_ACA_AUTO_DAY_CH4', compa::encodeutf('Every other day no weekend'));
define('_ACA_AUTO_DAY_CH5', compa::encodeutf('Weekly'));
define('_ACA_AUTO_DAY_CH6', compa::encodeutf('Bi-weekly'));
define('_ACA_AUTO_DAY_CH7', compa::encodeutf('Monthly'));
define('_ACA_AUTO_DAY_CH9', compa::encodeutf('Yearly'));
define('_ACA_AUTO_OPTION_NONE', compa::encodeutf('No'));
define('_ACA_AUTO_OPTION_NEW', compa::encodeutf('New Users'));
define('_ACA_AUTO_OPTION_ALL', compa::encodeutf('All Users'));

//
define('_ACA_UNSUB_MESSAGE', compa::encodeutf('Unsubscribe Email'));
define('_ACA_UNSUB_SETTINGS', compa::encodeutf('Unsubscribe Settings'));
define('_ACA_AUTO_ADD_NEW_USERS', compa::encodeutf('Auto Subscribe Users?'));

// Update and upgrade messages
define('_ACA_NO_UPDATES', compa::encodeutf('There are currently no update available.'));
define('_ACA_VERSION', compa::encodeutf('Acajoom Version'));
define('_ACA_NEED_UPDATED', compa::encodeutf('Files that need to be updated:'));
define('_ACA_NEED_ADDED', compa::encodeutf('Files that need to be added:'));
define('_ACA_NEED_REMOVED', compa::encodeutf('Files that need to be removed:'));
define('_ACA_FILENAME', compa::encodeutf('Filename:'));
define('_ACA_CURRENT_VERSION', compa::encodeutf('Current version:'));
define('_ACA_NEWEST_VERSION', compa::encodeutf('Newest version:'));
define('_ACA_UPDATING', compa::encodeutf('Updating'));
define('_ACA_UPDATE_UPDATED_SUCCESSFULLY', compa::encodeutf('The files have been updated successfully.'));
define('_ACA_UPDATE_FAILED', compa::encodeutf('Update failed!'));
define('_ACA_ADDING', compa::encodeutf('Adding'));
define('_ACA_ADDED_SUCCESSFULLY', compa::encodeutf('Added successfully.'));
define('_ACA_ADDING_FAILED', compa::encodeutf('Adding failed!'));
define('_ACA_REMOVING', compa::encodeutf('Removing'));
define('_ACA_REMOVED_SUCCESSFULLY', compa::encodeutf('Removed successfully.'));
define('_ACA_REMOVING_FAILED', compa::encodeutf('Removing failed!'));
define('_ACA_INSTALL_DIFFERENT_VERSION', compa::encodeutf('Install a different version'));
define('_ACA_CONTENT_ADD', compa::encodeutf('Add content'));
define('_ACA_UPGRADE_FROM', compa::encodeutf('Import data (newsletters and subscribers\' information) from '));
define('_ACA_UPGRADE_MESS', compa::encodeutf('There are no risk to your existing data. <br> This process will simply import the data to the Acajoom database.'));
define('_ACA_CONTINUE_SENDING', compa::encodeutf('Continue sending'));

// Acajoom message
define('_ACA_UPGRADE1', compa::encodeutf('You can easily import your users and newsletters from '));
define('_ACA_UPGRADE2', compa::encodeutf(' to Acajoom in the updates panel.'));
define('_ACA_UPDATE_MESSAGE', compa::encodeutf('A new version of Acajoom is available! '));
define('_ACA_UPDATE_MESSAGE_LINK', compa::encodeutf('Click here to update!'));
define('_ACA_CRON_SETUP', compa::encodeutf('In order for the autoresponders to be sent you need to setup a cron task.'));
define('_ACA_THANKYOU', compa::encodeutf('Thank you for choosing Acajoom, Your communication partner!'));
define('_ACA_NO_SERVER', compa::encodeutf('Update Server not available, please check back later.'));
define('_ACA_MOD_PUB', compa::encodeutf('Acajoom module is not published.'));
define('_ACA_MOD_PUB_LINK', compa::encodeutf('Click here to publish it!'));
define('_ACA_IMPORT_SUCCESS', compa::encodeutf('successfully imported'));
define('_ACA_IMPORT_EXIST', compa::encodeutf('subscriber already in database'));

// Acajoom\'s Guide
define('_ACA_GUIDE', compa::encodeutf('\'s Wizard'));
define('_ACA_GUIDE_FIRST_ACA_STEP', compa::encodeutf('<p>Acajoom has many great features and this wizard will guide you through a four easy steps process to get you started sending your newsletters and auto-responders!<p />'));
define('_ACA_GUIDE_FIRST_ACA_STEP_DESC', compa::encodeutf('First, you need to add a list.  A list could be of two types, either a newsletter or an auto-responder.' .
		'  In the list you define all the different parameters to enable the sending of your newsletters or auto-responders: sender name, layout, subscribers\' welcome message, etc...
<br><br>You can set up your first list  here: <a href="index2.php?option=com_acajoom&act=list" >create a list</a> and click the New button.'));
define('_ACA_GUIDE_FIRST_ACA_STEP_UPGRADE', compa::encodeutf('Acajoom provides you with an easy way to import all data from a previous newsletter system.<br>' .
		' Go to the Updates panel and choose your previous newsletter system to import the all your newsletters and subscribers.<br><br>' .
		'<span style="color:#FF5E00;" >IMPORTANT: the import is risk FREE and doesn\'t affect in any way the data of your previous newsletter system</span><br>' .
		'After the import you will be able to manage your subscribers and mailings directly from Acajoom.<br><br>'));
define('_ACA_GUIDE_SECOND_ACA_STEP', compa::encodeutf('Great your first list is setup!  You can now write your first %s.  To create it go to: '));
define('_ACA_GUIDE_SECOND_ACA_STEP_AUTO', compa::encodeutf('Auto-responder Management'));
define('_ACA_GUIDE_SECOND_ACA_STEP_NEWS', compa::encodeutf('Newsletter Management'));
define('_ACA_GUIDE_SECOND_ACA_STEP_FINAL', compa::encodeutf(' and select your %s. <br> Then choose your %s in the drop down list.  Create your first mailing by clicking New '));

define('_ACA_GUIDE_THRID_ACA_STEP_NEWS', compa::encodeutf('Before you send your first newsletter you may want to check the mail configuration.  ' .
		'Go to the <a href="index2.php?option=com_acajoom&act=configuration" >configuration page</a> to verify the mail settings. <br>'));
define('_ACA_GUIDE_THRID2_ACA_STEP_NEWS', compa::encodeutf('<br>When you are ready go back to the Newsletters menu, select your mailing and click Send'));

define('_ACA_GUIDE_THRID_ACA_STEP_AUTOS', compa::encodeutf('For your auto-responders to be sent you first need to set up a cron task on your server. ' .
		' Please refer to the Cron tab in the configuration panel.' .
		' <a href="index2.php?option=com_acajoom&act=configuration" >click here</a> to learn about setting up a cron task. <br>'));

define('_ACA_GUIDE_MODULE', compa::encodeutf(' <br>Make also sure that you have published Acajoom module so that people can sign up for the list.'));

define('_ACA_GUIDE_FOUR_ACA_STEP_NEWS', compa::encodeutf(' You can now also set up an auto-responder.'));
define('_ACA_GUIDE_FOUR_ACA_STEP_AUTOS', compa::encodeutf(' You can now also set up a newsletter.'));

define('_ACA_GUIDE_FOUR_ACA_STEP', compa::encodeutf('<p><br>Voila! You are ready to effectively communicate with you visitors and users. This wizard will end as soon as you have entered a second mailing or you can turn it off in the <a href="index2.php?option=com_acajoom&act=configuration" >configuration panel</a>.' .
		'<br><br>  If you have any question while using Acajoom, please refer to the ' .
		'<a target="_blank" href="http://www.ijoobi.com/index.php?option=com_content&Itemid=72&view=category&layout=blog&id=29&limit=60" >documentation</a>. ' .
		' You will also find lots of information on how to communicate effectively with your subscribers on <a href="http://www.ijoobi.com/" target="_blank" >www.ijoobi.com</a>.' .
		'<p /><br><b>Thank you for using Acajoom. Your Communication Partner!</b> '));
define('_ACA_GUIDE_TURNOFF', compa::encodeutf('The wizard is now being turned off!'));
define('_ACA_STEP', compa::encodeutf('STEP '));

// Acajoom Install
define('_ACA_INSTALL_CONFIG', compa::encodeutf('Acajoom Configuration'));
define('_ACA_INSTALL_SUCCESS', compa::encodeutf('Succesful Install'));
define('_ACA_INSTALL_ERROR', compa::encodeutf('Installation Error'));
define('_ACA_INSTALL_BOT', compa::encodeutf('Acajoom Plugin (Bot)'));
define('_ACA_INSTALL_MODULE', compa::encodeutf('Acajoom Module'));
//Others
define('_ACA_JAVASCRIPT', compa::encodeutf('!Warning! Javascript must be enabled for proper operation.'));
define('_ACA_EXPORT_TEXT', compa::encodeutf('The subscribers exported is based on the list you have chosen. <br>Export subscribers for list'));
define('_ACA_IMPORT_TIPS', compa::encodeutf('Import subscribers. The information in the file need to be to the following format: <br>' .
		'Name,email,receiveHTML(0/1),<span style="color: rgb(255, 0, 0);">confirmed(0/1)</span>'));
define('_ACA_SUBCRIBER_EXIT', compa::encodeutf('is already a subscriber'));
define('_ACA_GET_STARTED', compa::encodeutf('Click here to get started!'));

//News since 1.0.1
define('_ACA_WARNING_1011', compa::encodeutf('Warning: 1011: Update will not work because of your server restrictions.'));
define('_ACA_SEND_MAIL_FROM_TIPS', compa::encodeutf('Choose which email address will show as the sender.'));
define('_ACA_SEND_MAIL_NAME_TIPS', compa::encodeutf('Choose what name will show as the sender.'));
define('_ACA_MAILSENDMETHOD_TIPS', compa::encodeutf('Choose which mailer you wish to use: PHP mail function, <span>Sendmail</span> or SMTP Server.'));
define('_ACA_SENDMAILPATH_TIPS', compa::encodeutf('This is the directory of the Mail server'));
define('_ACA_LIST_T_TEMPLATE', compa::encodeutf('Template'));
define('_ACA_NO_MAILING_ENTERED', compa::encodeutf('No mailing provided'));
define('_ACA_NO_LIST_ENTERED', compa::encodeutf('No list provided'));
define('_ACA_SENT_MAILING', compa::encodeutf('Sent mailings'));
define('_ACA_SELECT_FILE', compa::encodeutf('Please select a file to '));
define('_ACA_LIST_IMPORT', compa::encodeutf('Check the list(s) you want the subscribers to be associated with.'));
define('_ACA_PB_QUEUE', compa::encodeutf('Subscriber inserted but problem to connect him/her to the list(s). Please check manually.'));
define('_ACA_UPDATE_MESS1', compa::encodeutf('Update Highly recommanded!'));
define('_ACA_UPDATE_MESS2', compa::encodeutf('Patch and small fixes.'));
define('_ACA_UPDATE_MESS3', compa::encodeutf('New release.'));
define('_ACA_UPDATE_MESS5', compa::encodeutf('Joomla 1.5 is required to update.'));
define('_ACA_UPDATE_IS_AVAIL', compa::encodeutf(' is available!'));
define('_ACA_NO_MAILING_SENT', compa::encodeutf('No mailing sent!'));
define('_ACA_SHOW_LOGIN', compa::encodeutf('Show login form'));
define('_ACA_SHOW_LOGIN_TIPS', compa::encodeutf('Select Yes to show a login form in the front-end Acajoom control panel so that user can register to the website.'));
define('_ACA_LISTS_EDITOR', compa::encodeutf('List Description Editor'));
define('_ACA_LISTS_EDITOR_TIPS', compa::encodeutf('Select Yes to use an HTML editor to edit the list description field.'));
define('_ACA_SUBCRIBERS_VIEW', compa::encodeutf('View subscribers'));

//News since 1.0.2
define('_ACA_FRONTEND_SETTINGS', compa::encodeutf('Front-end Settings'));
define('_ACA_SHOW_LOGOUT', compa::encodeutf('Show logout button'));
define('_ACA_SHOW_LOGOUT_TIPS', compa::encodeutf('Select Yes to show a logout button in the front-end Acajoom control panel.'));

//News since 1.0.3 CB integration
define('_ACA_CONFIG_INTEGRATION', compa::encodeutf('Integration'));
define('_ACA_CB_INTEGRATION', compa::encodeutf('Community Builder Integration'));
define('_ACA_INSTALL_PLUGIN', compa::encodeutf('Community Builder Plugin (Acajoom Integration) '));
define('_ACA_CB_PLUGIN_NOT_INSTALLED', compa::encodeutf('Acajoom Plugin for Community Builder is not yet installed!'));
define('_ACA_CB_PLUGIN', compa::encodeutf('Lists at registration'));
define('_ACA_CB_PLUGIN_TIPS', compa::encodeutf('Select Yes to show the mailing lists in the community builder registration form'));
define('_ACA_CB_LISTS', compa::encodeutf('List IDs'));
define('_ACA_CB_LISTS_TIPS', compa::encodeutf('THIS IS A REQUIRED FIELD. Enter the id number of the lists you wish to allow users to subscribe to seperated by a comma ,  (0 show all the lists)'));
define('_ACA_CB_INTRO', compa::encodeutf('Introduction text'));
define('_ACA_CB_INTRO_TIPS', compa::encodeutf('A text that appear will appear before the listing. LEAVE BLANK TO NOT SHOW NOTHING.  You can use HTML tags to customize the look and feel.'));
define('_ACA_CB_SHOW_NAME', compa::encodeutf('Show List Name'));
define('_ACA_CB_SHOW_NAME_TIPS', compa::encodeutf('Select whether or not to show the name of the list after the introduction.'));
define('_ACA_CB_LIST_DEFAULT', compa::encodeutf('Check list by default'));
define('_ACA_CB_LIST_DEFAULT_TIPS', compa::encodeutf('Select whether or not to you want the check box for each list checked by default.'));
define('_ACA_CB_HTML_SHOW', compa::encodeutf('Show Receive HTML'));
define('_ACA_CB_HTML_SHOW_TIPS', compa::encodeutf('Set to Yes to allow users to decide whether they want HTML emails or not. Set to No to use default receive html.'));
define('_ACA_CB_HTML_DEFAULT', compa::encodeutf('Default Receive HTML'));
define('_ACA_CB_HTML_DEFAULT_TIPS', compa::encodeutf('Set this option to show the default html mailing configuration. If the Show Receive HTML is set to No then this option will be the default.'));

// Since 1.0.4
define('_ACA_BACKUP_FAILED', compa::encodeutf('Could not backup the file! File not replaced.'));
define('_ACA_BACKUP_YOUR_FILES', compa::encodeutf('The old version of the files have been backed up into the following directory:'));
define('_ACA_SERVER_LOCAL_TIME', compa::encodeutf('Server local time'));
define('_ACA_SHOW_ARCHIVE', compa::encodeutf('Show archive button'));
define('_ACA_SHOW_ARCHIVE_TIPS', compa::encodeutf('Select YES to show the archive button in the front end on the Newsletter listing'));
define('_ACA_LIST_OPT_TAG', compa::encodeutf('Tags'));
define('_ACA_LIST_OPT_IMG', compa::encodeutf('Images'));
define('_ACA_LIST_OPT_CTT', compa::encodeutf('Content'));
define('_ACA_INPUT_NAME_TIPS', compa::encodeutf('Enter your full name (firstname first)'));
define('_ACA_INPUT_EMAIL_TIPS', compa::encodeutf('Enter your email address (Make sure this is a valid email address if you want to receive our mailings.)'));
define('_ACA_RECEIVE_HTML_TIPS', compa::encodeutf('Choose Yes if you want to receive HTML mailings - No to receive Text only mailings'));
define('_ACA_TIME_ZONE_ASK_TIPS', compa::encodeutf('Specify your time zone.'));

// Since 1.0.5
define('_ACA_FILES', compa::encodeutf('Files'));
define('_ACA_FILES_UPLOAD', compa::encodeutf('Upload'));
define('_ACA_MENU_UPLOAD_IMG', compa::encodeutf('Upload Images'));
define('_ACA_TOO_LARGE', compa::encodeutf('File size too large. The maximum permitted size is'));
define('_ACA_MISSING_DIR', compa::encodeutf('Destination directory doesn\'t exist'));
define('_ACA_IS_NOT_DIR', compa::encodeutf('The destination directory doesn\'t exist or is a regular file.'));
define('_ACA_NO_WRITE_PERMS', compa::encodeutf('The destination directory doesn\'t have write perms.'));
define('_ACA_NO_USER_FILE', compa::encodeutf('You haven\'t selected any file for uploading.'));
define('_ACA_E_FAIL_MOVE', compa::encodeutf('Impossible to move the file.'));
define('_ACA_FILE_EXISTS', compa::encodeutf('The destination file already exists.'));
define('_ACA_CANNOT_OVERWRITE', compa::encodeutf('The destination file already exists and could not be overwritten.'));
define('_ACA_NOT_ALLOWED_EXTENSION', compa::encodeutf('File extension not permitted.'));
define('_ACA_PARTIAL', compa::encodeutf('The file was only partially uploaded.'));
define('_ACA_UPLOAD_ERROR', compa::encodeutf('Upload error:'));
define('DEV_NO_DEF_FILE', compa::encodeutf('The file was only partially uploaded.'));

// already exist but modified  added a <br/ on first line and added [SUBSCRIPTIONS] line>
define('_ACA_CONTENTREP', compa::encodeutf('[SUBSCRIPTIONS] = This will be replaced with the subscription links.' .
		' This is <strong>required</strong> to make Acajoom work properly.<br>' .
		'If you place any other content in this box it will be display in all mailings corresponding to this list.' .
		' <br>Add your subscription message at the end.  Acajoom will automatically add a link for the subscriber to change their information and a link to unsubscribe from the list.'));

// since 1.0.6
define('_ACA_NOTIFICATION', compa::encodeutf('Notification'));  // shortcut for Email notification
define('_ACA_NOTIFICATIONS', compa::encodeutf('Notifications'));
define('_ACA_USE_SEF', compa::encodeutf('SEF in mailings'));
define('_ACA_USE_SEF_TIPS', compa::encodeutf('It is recommended that you choose No.  However if you want the URL included in your mailings to use SEF then choose Yes.' .
		' <br><b>The links will works the same for either options.  No will insure that the links in the mailings will always works even if you change your SEF.</b> '));
define('_ACA_ERR_NB', compa::encodeutf('Error #: ERR'));
define('_ACA_ERR_SETTINGS', compa::encodeutf('Error handeling settings'));
define('_ACA_ERR_SEND', compa::encodeutf('Send error report'));
define('_ACA_ERR_SEND_TIPS', compa::encodeutf('If you want Acajoom be a better product please select YES.  This will send us an error report.  So you even dont need to report bugs anymore ;-) <br> <b>NO PRIVATE INFORMATION IS SENT</b>.  We dont even know from what website the error is coming from. We send only information about Acajoom, the PHP setup and SQL queries. '));
define('_ACA_ERR_SHOW_TIPS', compa::encodeutf('Choose Yes to show error number on the screen.  Mainly used for debuging purpose. '));
define('_ACA_ERR_SHOW', compa::encodeutf('Show errors'));
define('_ACA_LIST_SHOW_UNSUBCRIBE', compa::encodeutf('Show unsubscribe links'));
define('_ACA_LIST_SHOW_UNSUBCRIBE_TIPS', compa::encodeutf('Select Yes to show the unsubscribe links at the bottom of the mailings for users to change their subscriptions. <br> No disable the footer and links.'));
define('_ACA_UPDATE_INSTALL', compa::encodeutf('<span style="color: rgb(255, 0, 0);">IMPORTANT NOTICE!</span> <br>If you are upgrading from a previous Acajoom install you need to upgrade your database structure by clicking on the following button (Your data will stay in integrity)'));
define('_ACA_UPDATE_INSTALL_BTN', compa::encodeutf('Upgrade tables and configuration'));
define('_ACA_MAILING_MAX_TIME', compa::encodeutf('Max queue time'));
define('_ACA_MAILING_MAX_TIME_TIPS', compa::encodeutf('Define the maximum time for each set of emails sent by the queue. Recommanded between 30s and 2mins.'));

// virtuemart integration beta
define('_ACA_VM_INTEGRATION', compa::encodeutf('VirtueMart Integration'));
define('_ACA_VM_COUPON_NOTIF', compa::encodeutf('Coupon notification ID'));
define('_ACA_VM_COUPON_NOTIF_TIPS', compa::encodeutf('Specify the ID number of the mailing you want to use to send coupons to your shoppers.'));
define('_ACA_VM_NEW_PRODUCT', compa::encodeutf('New products notification ID'));
define('_ACA_VM_NEW_PRODUCT_TIPS', compa::encodeutf('Specify the ID number of the mailing you want to use to send new products notification.'));

// since 1.0.8
// create forms for subscriptions
define('_ACA_FORM_BUTTON', compa::encodeutf('Create form'));
define('_ACA_FORM_COPY', compa::encodeutf('HTML code'));
define('_ACA_FORM_COPY_TIPS', compa::encodeutf('Copy the generated HTML code into your HTML page.'));
define('_ACA_FORM_LIST_TIPS', compa::encodeutf('Select the list you want to include in the form'));
// update messages
define('_ACA_UPDATE_MESS4', compa::encodeutf('It can\'t be updated automatically.'));
define('_ACA_WARNG_REMOTE_FILE', compa::encodeutf('No way to get remote file.'));
define('_ACA_ERROR_FETCH', compa::encodeutf('Error fetching file.'));

define('_ACA_CHECK', compa::encodeutf('Check'));
define('_ACA_MORE_INFO', compa::encodeutf('More info'));
define('_ACA_UPDATE_NEW', compa::encodeutf('Update to newer version'));
define('_ACA_UPGRADE', compa::encodeutf('Upgrade to higher product'));
define('_ACA_DOWNDATE', compa::encodeutf('Roll back to previous version'));
define('_ACA_DOWNGRADE', compa::encodeutf('Back to basic product'));
define('_ACA_REQUIRE_JOOM', compa::encodeutf('Require Joomla'));
define('_ACA_TRY_IT', compa::encodeutf('Try it!'));
define('_ACA_NEWER', compa::encodeutf('Newer'));
define('_ACA_OLDER', compa::encodeutf('Older'));
define('_ACA_CURRENT', compa::encodeutf('Current'));

// since 1.0.9
define('_ACA_CHECK_COMP', compa::encodeutf('Try one of the other components'));
define('_ACA_MENU_VIDEO', compa::encodeutf('Video tutorials'));
define('_ACA_AUTO_SCHEDULE', compa::encodeutf('Schedule'));
define('_ACA_SCHEDULE_TITLE', compa::encodeutf('Automatic schedule function setting'));
define('_ACA_ISSUE_NB_TIPS', compa::encodeutf('Issue number generated automatically by the system'));
define('_ACA_SEL_ALL', compa::encodeutf('All mailings'));
define('_ACA_SEL_ALL_SUB', compa::encodeutf('All lists'));
define('_ACA_INTRO_ONLY_TIPS', compa::encodeutf('If you check this box only the introduction of the article will be inserted into the mailing with a read more link to the complete article on your site.'));
define('_ACA_TAGS_TITLE', compa::encodeutf('Content tag'));
define('_ACA_TAGS_TITLE_TIPS', compa::encodeutf('Copy and paste this tag into the mailing where you want to have the content to be placed.'));
define('_ACA_PREVIEW_EMAIL_TEST', compa::encodeutf('Indicate the email address to send a test to'));
define('_ACA_PREVIEW_TITLE', compa::encodeutf('Preview'));
define('_ACA_AUTO_UPDATE', compa::encodeutf('New update notification'));
define('_ACA_AUTO_UPDATE_TIPS', compa::encodeutf('Select Yes if you want to be notified of new updates for your component. <br />IMPORTANT!! Show tips needs to be on for this function to work.'));

// since 1.1.0
define('_ACA_LICENSE', compa::encodeutf('License Information'));


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
define('_ACA_REGWARN_NAME', compa::encodeutf('Navnet ditt.'));
define('_ACA_REGWARN_MAIL', compa::encodeutf('Gyldig e-postadresse.'));

//since 1.5.6
define('_ACA_ADDEMAILREDLINK_TIPS', compa::encodeutf('If you select Yes, the e-mail of the user will be added as a parameter at the end of your redirect URL (the redirect link for your module or for an external Acajoom form).<br/>That can be usefull if you want to execute a special script in your redirect page.'));
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