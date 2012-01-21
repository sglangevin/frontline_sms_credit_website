<?php
defined('_JEXEC') OR defined('_VALID_MOS') OR die('...Direct Access to this location is not allowed...');


/**
 * <p>Swedish language file.</p>
 * @copyright (c) 2006 Acajoom Services / All Rights Reserved
 * @author Janne Karlsson<support@ijoobi.com>
 * @version $Id: swedish.php 491 2007-02-01 22:56:07Z divivo $
* @link http://www.ijoobi.com
 */

### General ###
 //acajoom Description
define('_ACA_DESC_NEWS', compa::encodeutf('Acajoom är en mailinglista, nyhetsbrev, auto-respondrar, och ett uppföljningsverktyg för att kommunicera effektivt med dina användare och kunder. ' .
		'Acajoom, Din Kommunikations Partner!'));
define('_ACA_FEATURES', compa::encodeutf('Acajoom, din kommunikationspartner!'));

// Type of lists
define('_ACA_NEWSLETTER', compa::encodeutf('Nyhetsbrev'));
define('_ACA_AUTORESP', compa::encodeutf('Auto-responder'));
define('_ACA_AUTORSS', compa::encodeutf('Auto-RSS'));
define('_ACA_ECARD', compa::encodeutf('eKort'));
define('_ACA_POSTCARD', compa::encodeutf('Postkort'));
define('_ACA_PERF', compa::encodeutf('Prestanda'));
define('_ACA_COUPON', compa::encodeutf('Kupong'));
define('_ACA_CRON', compa::encodeutf('Cron Uppgift'));
define('_ACA_MAILING', compa::encodeutf('Maila'));
define('_ACA_LIST', compa::encodeutf('Lista'));

 //acajoom Menu
define('_ACA_MENU_LIST', compa::encodeutf('List Hanterare'));
define('_ACA_MENU_SUBSCRIBERS', compa::encodeutf('Prenumeranter'));
define('_ACA_MENU_NEWSLETTERS', compa::encodeutf('Nyhetsbrev'));
define('_ACA_MENU_AUTOS', compa::encodeutf('Auto-respondrar'));
define('_ACA_MENU_COUPONS', compa::encodeutf('Kuponger'));
define('_ACA_MENU_CRONS', compa::encodeutf('Cron Uppgifter'));
define('_ACA_MENU_AUTORSS', compa::encodeutf('Auto-RSS'));
define('_ACA_MENU_ECARD', compa::encodeutf('eKort'));
define('_ACA_MENU_POSTCARDS', compa::encodeutf('Postkort'));
define('_ACA_MENU_PERFS', compa::encodeutf('Prestanda'));
define('_ACA_MENU_TAB_LIST', compa::encodeutf('Listor'));
define('_ACA_MENU_MAILING_TITLE', compa::encodeutf('Mail'));
define('_ACA_MENU_MAILING', compa::encodeutf('Mailande för '));
define('_ACA_MENU_STATS', compa::encodeutf('Statistik'));
define('_ACA_MENU_STATS_FOR', compa::encodeutf('Statistik för '));
define('_ACA_MENU_CONF', compa::encodeutf('Konfiguration'));
define('_ACA_MENU_UPDATE', compa::encodeutf('Import'));
define('_ACA_MENU_ABOUT', compa::encodeutf('Om'));
define('_ACA_MENU_LEARN', compa::encodeutf('Utbildningscenter'));
define('_ACA_MENU_MEDIA', compa::encodeutf('Media Hanterare'));
define('_ACA_MENU_HELP', compa::encodeutf('Hjälp'));
define('_ACA_MENU_CPANEL', compa::encodeutf('CPanel'));
define('_ACA_MENU_IMPORT', compa::encodeutf('Importera'));
define('_ACA_MENU_EXPORT', compa::encodeutf('Exportera'));
define('_ACA_MENU_SUB_ALL', compa::encodeutf('Prenumerara Alla'));
define('_ACA_MENU_UNSUB_ALL', compa::encodeutf('Ej Prenumerera Alla'));
define('_ACA_MENU_VIEW_ARCHIVE', compa::encodeutf('Arkiv'));
define('_ACA_MENU_PREVIEW', compa::encodeutf('Förhandsgranska'));
define('_ACA_MENU_SEND', compa::encodeutf('Skicka'));
define('_ACA_MENU_SEND_TEST', compa::encodeutf('Skicka Test E-post'));
define('_ACA_MENU_SEND_QUEUE', compa::encodeutf('Process Kö'));
define('_ACA_MENU_VIEW', compa::encodeutf('Visa'));
define('_ACA_MENU_COPY', compa::encodeutf('Kopiera'));
define('_ACA_MENU_VIEW_STATS', compa::encodeutf('Visa stats'));
define('_ACA_MENU_CRTL_PANEL', compa::encodeutf(' Kontrollpanel'));
define('_ACA_MENU_LIST_NEW', compa::encodeutf(' Skapa en Lista'));
define('_ACA_MENU_LIST_EDIT', compa::encodeutf(' Redigera en Lista'));
define('_ACA_MENU_BACK', compa::encodeutf('Tillbaka'));
define('_ACA_MENU_INSTALL', compa::encodeutf('Installation'));
define('_ACA_MENU_TAB_SUM', compa::encodeutf('Summering'));
define('_ACA_STATUS', compa::encodeutf('Status'));

// messages
define('_ACA_ERROR', compa::encodeutf(' Ett fel inträffade! '));
define('_ACA_SUB_ACCESS', compa::encodeutf('Behörighets rättigheter'));
define('_ACA_DESC_CREDITS', compa::encodeutf('Krediter'));
define('_ACA_DESC_INFO', compa::encodeutf('Information'));
define('_ACA_DESC_HOME', compa::encodeutf('Hemsida'));
define('_ACA_DESC_MAILING', compa::encodeutf('Maillista'));
define('_ACA_DESC_SUBSCRIBERS', compa::encodeutf('Prenumeranter'));
define('_ACA_PUBLISHED', compa::encodeutf('Publicerad'));
define('_ACA_UNPUBLISHED', compa::encodeutf('Opublicerad'));
define('_ACA_DELETE', compa::encodeutf('Radera'));
define('_ACA_FILTER', compa::encodeutf('Filter'));
define('_ACA_UPDATE', compa::encodeutf('Uppdatera'));
define('_ACA_SAVE', compa::encodeutf('Spara'));
define('_ACA_CANCEL', compa::encodeutf('Avbryt'));
define('_ACA_NAME', compa::encodeutf('Namn'));
define('_ACA_EMAIL', compa::encodeutf('E-post'));
define('_ACA_SELECT', compa::encodeutf('Välj'));
define('_ACA_ALL', compa::encodeutf('Alla'));
define('_ACA_SEND_A', compa::encodeutf('Skicka en '));
define('_ACA_SUCCESS_DELETED', compa::encodeutf(' raderades'));
define('_ACA_LIST_ADDED', compa::encodeutf('Lista skapades'));
define('_ACA_LIST_COPY', compa::encodeutf('Lista kopierades'));
define('_ACA_LIST_UPDATED', compa::encodeutf('Lista uppdaterades'));
define('_ACA_MAILING_SAVED', compa::encodeutf('Mailande sparades.'));
define('_ACA_UPDATED_SUCCESSFULLY', compa::encodeutf('uppdaterat.'));

### Subscribers information ###
//subscribe and unsubscribe info
define('_ACA_SUB_INFO', compa::encodeutf('Prenumerations information'));
define('_ACA_VERIFY_INFO', compa::encodeutf('Verifiera länken du la till, viss information saknas.'));
define('_ACA_INPUT_NAME', compa::encodeutf('Namn'));
define('_ACA_INPUT_EMAIL', compa::encodeutf('E-post'));
define('_ACA_RECEIVE_HTML', compa::encodeutf('Mottag HTML?'));
define('_ACA_TIME_ZONE', compa::encodeutf('Tids Zon'));
define('_ACA_BLACK_LIST', compa::encodeutf('Svarta listan'));
define('_ACA_REGISTRATION_DATE', compa::encodeutf('Användares registreringsdatum'));
define('_ACA_USER_ID', compa::encodeutf('Användar ID'));
define('_ACA_DESCRIPTION', compa::encodeutf('Beskrivning'));
define('_ACA_ACCOUNT_CONFIRMED', compa::encodeutf('Ditt konto har aktiverats.'));
define('_ACA_SUB_SUBSCRIBER', compa::encodeutf('Prenumerant'));
define('_ACA_SUB_PUBLISHER', compa::encodeutf('Publicist'));
define('_ACA_SUB_ADMIN', compa::encodeutf('Administratör'));
define('_ACA_REGISTERED', compa::encodeutf('Registrerad'));
define('_ACA_SUBSCRIPTIONS', compa::encodeutf('Prenumerationer'));
define('_ACA_SEND_UNSUBCRIBE', compa::encodeutf('Skicka prenumerera ej meddelande'));
define('_ACA_SEND_UNSUBCRIBE_TIPS', compa::encodeutf('Klicka Ja för att skicka ett prenumerera ej e-post bekräftelse meddelande.'));
define('_ACA_SUBSCRIBE_SUBJECT_MESS', compa::encodeutf('Bekräfta din prenumeration'));
define('_ACA_UNSUBSCRIBE_SUBJECT_MESS', compa::encodeutf('Prenumerera Ej bekräftelse'));
define('_ACA_DEFAULT_SUBSCRIBE_MESS', compa::encodeutf('Hej ! [NAME],<br />' .
		'Bara ett steg till sedan är du inlagd i prenumerationslistan.  Klicka på följande länk för att bekräfta din prenumeration.' .
		'<br /><br />[CONFIRM]<br /><br />Vid frågor kontakta webmaster.'));
define('_ACA_DEFAULT_UNSUBSCRIBE_MESS', compa::encodeutf('Detta är ett bekräftelsemail om att du har valt att inte längre prenumerera hos oss mera.  Vi är självklart ledsna att du valt detta men om du väljer att åter prenumerera hos oss igen så är du välkommen tillbaka.  Om du har några frågor så kontakta vår webmaster.'));

// Acajoom subscribers
define('_ACA_SIGNUP_DATE', compa::encodeutf('Inskrivningsdatum'));
define('_ACA_CONFIRMED', compa::encodeutf('Bekräftad'));
define('_ACA_SUBSCRIB', compa::encodeutf('Prenumerera'));
define('_ACA_HTML', compa::encodeutf('HTML mail'));
define('_ACA_RESULTS', compa::encodeutf('Resultat'));
define('_ACA_SEL_LIST', compa::encodeutf('Välj en lista'));
define('_ACA_SEL_LIST_TYPE', compa::encodeutf('- Välj typ av lista -'));
define('_ACA_SUSCRIB_LIST', compa::encodeutf('Lista på alla prenumeranter'));
define('_ACA_SUSCRIB_LIST_UNIQUE', compa::encodeutf('prenumeranter för : '));
define('_ACA_NO_SUSCRIBERS', compa::encodeutf('Inga prenumeranter hittades i denna lista.'));
define('_ACA_COMFIRM_SUBSCRIPTION', compa::encodeutf('Ett bekräftelsemail har skickats till e-postadressen som du uppgav.  Kolla ditt e-post meddelande och klicka på länken som anges.<br />' .
		'Du behöver bekräfta din e-post för att din prenumeration ska börja gälla.'));
define('_ACA_SUCCESS_ADD_LIST', compa::encodeutf('Du har lagts till i listan över prenumerationer.'));


 // Subcription info
define('_ACA_CONFIRM_LINK', compa::encodeutf('Klicka här för att bekräfta din prenumeration'));
define('_ACA_UNSUBSCRIBE_LINK', compa::encodeutf('Klicka här för att ta bort dig från listan över prenumeranter'));
define('_ACA_UNSUBSCRIBE_MESS', compa::encodeutf('Din e-postadress har tagits bort från listan'));

define('_ACA_QUEUE_SENT_SUCCESS', compa::encodeutf('Alla schemalagda mailningar har skickats iväg.'));
define('_ACA_MALING_VIEW', compa::encodeutf('Visa alla mailningar'));
define('_ACA_UNSUBSCRIBE_MESSAGE', compa::encodeutf('Är du säker på att du inte vill prenumerera hos oss längre?'));
define('_ACA_MOD_SUBSCRIBE', compa::encodeutf('Prenumerera'));
define('_ACA_SUBSCRIBE', compa::encodeutf('Prenumerera'));
define('_ACA_UNSUBSCRIBE', compa::encodeutf('Prenumerera Ej'));
define('_ACA_VIEW_ARCHIVE', compa::encodeutf('Visa arkiv'));
define('_ACA_SUBSCRIPTION_OR', compa::encodeutf(' eller klicka här för att uppdatera din information'));
define('_ACA_EMAIL_ALREADY_REGISTERED', compa::encodeutf('E-postadressen som du angav finns redan.'));
define('_ACA_SUBSCRIBER_DELETED', compa::encodeutf('Prenumerant raderades.'));


### UserPanel ###
 //User Menu
define('_UCP_USER_PANEL', compa::encodeutf('Användar Kontrollpanel'));
define('_UCP_USER_MENU', compa::encodeutf('Användarmeny'));
define('_UCP_USER_CONTACT', compa::encodeutf('Mina Prenumerationer'));
 //Acajoom Cron Menu
define('_UCP_CRON_MENU', compa::encodeutf('Cron Uppgifts Hanterare'));
define('_UCP_CRON_NEW_MENU', compa::encodeutf('NY Cron'));
define('_UCP_CRON_LIST_MENU', compa::encodeutf('Lista min Cron'));
 //Acajoom Coupon Menu
define('_UCP_COUPON_MENU', compa::encodeutf('Kupong Hanterare'));
define('_UCP_COUPON_LIST_MENU', compa::encodeutf('Lista på Kuponger'));
define('_UCP_COUPON_ADD_MENU', compa::encodeutf('Skapa en Kupong'));

### lists ###
// Tabs
define('_ACA_LIST_T_GENERAL', compa::encodeutf('Beskrivning'));
define('_ACA_LIST_T_LAYOUT', compa::encodeutf('Layout'));
define('_ACA_LIST_T_SUBSCRIPTION', compa::encodeutf('Prenumeration'));
define('_ACA_LIST_T_SENDER', compa::encodeutf('Avsändarinformation'));

define('_ACA_LIST_TYPE', compa::encodeutf('List Typ'));
define('_ACA_LIST_NAME', compa::encodeutf('List namn'));
define('_ACA_LIST_ISSUE', compa::encodeutf('Nummer #'));
define('_ACA_LIST_DATE', compa::encodeutf('Sändningsdatum'));
define('_ACA_LIST_SUB', compa::encodeutf('Mailämne'));
define('_ACA_ATTACHED_FILES', compa::encodeutf('Bifogade filer'));
define('_ACA_SELECT_LIST', compa::encodeutf('Välj en lista att redigera!'));

// Auto Responder box
define('_ACA_AUTORESP_ON', compa::encodeutf('Typ av lista'));
define('_ACA_AUTO_RESP_OPTION', compa::encodeutf('Auto-responder val'));
define('_ACA_AUTO_RESP_FREQ', compa::encodeutf('Prenumeranter kan välja frekvens'));
define('_ACA_AUTO_DELAY', compa::encodeutf('Försening (i dagar)'));
define('_ACA_AUTO_DAY_MIN', compa::encodeutf('Minimum frekvens'));
define('_ACA_AUTO_DAY_MAX', compa::encodeutf('Maximum frekvens'));
define('_ACA_FOLLOW_UP', compa::encodeutf('Specificera auto-responder uppföljning'));
define('_ACA_AUTO_RESP_TIME', compa::encodeutf('Prenumeranter kan välja tid'));
define('_ACA_LIST_SENDER', compa::encodeutf('Lista avsändare'));

define('_ACA_LIST_DESC', compa::encodeutf('List beskrivning'));
define('_ACA_LAYOUT', compa::encodeutf('Layout'));
define('_ACA_SENDER_NAME', compa::encodeutf('Avsändarnamn'));
define('_ACA_SENDER_EMAIL', compa::encodeutf('Avsändarens e-post'));
define('_ACA_SENDER_BOUNCE', compa::encodeutf('Avsändarens studsadress'));
define('_ACA_LIST_DELAY', compa::encodeutf('Försening'));
define('_ACA_HTML_MAILING', compa::encodeutf('HTML mail?'));
define('_ACA_HTML_MAILING_DESC', compa::encodeutf('(om du ändrar detta, så behöver du spara och återvända till denna ruta för att se ändringarna.)'));
define('_ACA_HIDE_FROM_FRONTEND', compa::encodeutf('Dölj på framsidan?'));
define('_ACA_SELECT_IMPORT_FILE', compa::encodeutf('Välj en fil att importera'));;
define('_ACA_IMPORT_FINISHED', compa::encodeutf('Importering avslutat'));
define('_ACA_DELETION_OFFILE', compa::encodeutf('Radering av fil'));
define('_ACA_MANUALLY_DELETE', compa::encodeutf('misslyckades, du måste ta bort filen manuellt'));
define('_ACA_CANNOT_WRITE_DIR', compa::encodeutf('Kan inte skriva till mappen'));
define('_ACA_NOT_PUBLISHED', compa::encodeutf('Kunde inte skicka mailen, listan är inte publicerad.'));

//  List info box
define('_ACA_INFO_LIST_PUB', compa::encodeutf('Klicka Ja för att publicera listan'));
define('_ACA_INFO_LIST_NAME', compa::encodeutf('Skriv in namnet på listan här. Du kan identifiera listan med detta namn.'));
define('_ACA_INFO_LIST_DESC', compa::encodeutf('Skriv in en kort beskrivning på listan här. Denna beskrivning kommer att vara synlig för besökare på din hemsida.'));
define('_ACA_INFO_LIST_SENDER_NAME', compa::encodeutf('Skriv in namnet på avsändaren på mailen. Detta namn kommer att vara synligt när prenumeranter mottar meddelanden från denna lista.'));
define('_ACA_INFO_LIST_SENDER_EMAIL', compa::encodeutf('Skriv in e-postadressen från vilken meddelandet kommer att skickas ifrån.'));
define('_ACA_INFO_LIST_SENDER_BOUNCED', compa::encodeutf('Skriv in e-postadressen som användare kan svar till. Det rekomenderas att det är samma som avsändar adressen, eftersom spamfilter kommer att ge ditt meddelande en högre rankning om dom är olika.'));
define('_ACA_INFO_LIST_AUTORESP', compa::encodeutf('Välj typ av mail på denna lista. <br />' .
		'Nyhetsbrev: normalt nyhetsbrev<br />' .
		'Auto-responder: en auto-responder är en lista som sänds automatiskt genom hemsidan vid regelbundna intervaller.'));
define('_ACA_INFO_LIST_FREQUENCY', compa::encodeutf('Aktivera användare genom att ange hur ofta dom ska motta från denna lista.  Det ger mer flexibilitet för användaren.'));
define('_ACA_INFO_LIST_TIME', compa::encodeutf('Låt användaren välja sin önskade tid på dygnet för att motta från listan.'));
define('_ACA_INFO_LIST_MIN_DAY', compa::encodeutf('Definera vad som är den minimala frekvensen en användare kan välja att mottaga listan'));
define('_ACA_INFO_LIST_DELAY', compa::encodeutf('Specificera fördröjningen mellan denna auto-responder och den föregående gången.'));
define('_ACA_INFO_LIST_DATE', compa::encodeutf('Specificera datumet för publicering av nyhetslistan om du vill fördröja publiceringen. <br /> FORMAT : ÅÅÅÅ-MM-DD TT:MM:SS'));
define('_ACA_INFO_LIST_MAX_DAY', compa::encodeutf('Definera vad som är den maximala frekvensen en användare kan välja att mottaga listan'));
define('_ACA_INFO_LIST_LAYOUT', compa::encodeutf('Skriv in layouten på din maillista här. Du kan fylla i vilken layout för din mail här.'));
define('_ACA_INFO_LIST_SUB_MESS', compa::encodeutf('Detta meddelande kommer att skickas till prenumeranten när han eller hon registreras för första gången. Du kan fylla i den text du önskar här.'));
define('_ACA_INFO_LIST_UNSUB_MESS', compa::encodeutf('Detta meddelande kommer att skickas till prenumeranten när han eller hon vill avsäga sig sin prenumeration. Ditt meddelande kan du fylla i här.'));
define('_ACA_INFO_LIST_HTML', compa::encodeutf('Välj kryssrutan om du vill skicka ut ett HTML mail. Prenumeranter kommer att kunna specificera om dom vill motta HTML meddelande, eller endast Text meddelande när dom prenumererar på en HTML lista.'));
define('_ACA_INFO_LIST_HIDDEN', compa::encodeutf('Klicka Ja för att dölja listan på förstasidan, användare kommer inte att kunna prenumerera men du kommer fortfarande att kunna skicka mail.'));
define('_ACA_INFO_LIST_ACA_AUTO_SUB', compa::encodeutf('Vill du med automatik lägga till prenumeranter till denna lista?<br /><B>Nya Användare:</B> kommer att registrera varje ny användare som har registrerat sig på hemsidan.<br /><B>Alla Användare:</B> kommer att registrera varje registrerad användare till databasen.<br />(alla dessa alternativ supportar Community Builder)'));
define('_ACA_INFO_LIST_ACC_LEVEL', compa::encodeutf('Välj förstasidans behörighetsnivå. Detta kommer att visa eller dölja mailen till användargrupper som inte har tillgång till den, så dom inte kan prenumerera på den.'));
define('_ACA_INFO_LIST_ACC_USER_ID', compa::encodeutf('Välj behörighetsnivå på användargrupper som du vill ska kunna redigera. Dessa användargrupper och ovanför kommer att kunna redigera mailen och skicka ut dom, antingen från förstasidan eller från backend.'));
define('_ACA_INFO_LIST_FOLLOW_UP', compa::encodeutf('Om du vill att auto-respondern ska flyttas till en annan så fort den skickat sitt sista meddelande så kan du specificera det här för att följa upp auto-respondern.'));
define('_ACA_INFO_LIST_ACA_OWNER', compa::encodeutf('Detta är ID:en på personen som skapade listan.'));
define('_ACA_INFO_LIST_WARNING', compa::encodeutf(' Detta sista val är endast tillgängligt på slutet vid skapande av listan.'));
define('_ACA_INFO_LIST_SUBJET', compa::encodeutf(' Ämne på mailen.  Detta är ämnet på e-posten som prenumeranten kommer att motta.'));
define('_ACA_INFO_MAILING_CONTENT', compa::encodeutf('Detta är huvudrutan på mailet som kommer att skickas.'));
define('_ACA_INFO_MAILING_NOHTML', compa::encodeutf('Skriv in här huvudtexten på mailet som du vill skicka till prenumeranterna som väljer att motta endast icke HTML mail. <BR/> NOTERA: om du lämnar detta tomt så kommer Acajoom automatiskt att konvertera det från HTML text till endast text.'));
define('_ACA_INFO_MAILING_VISIBLE', compa::encodeutf('Klicka Ja för att visa mailen på förstasidan.'));
define('_ACA_INSERT_CONTENT', compa::encodeutf('Sätt in existerande innehåll'));

// Coupons
define('_ACA_SEND_COUPON_SUCCESS', compa::encodeutf('Kupong skickat!'));
define('_ACA_CHOOSE_COUPON', compa::encodeutf('Välj en kupong'));
define('_ACA_TO_USER', compa::encodeutf(' till denna användare'));

### Cron options
//drop down frequency(CRON)
define('_ACA_FREQ_CH1', compa::encodeutf('Varje timma'));
define('_ACA_FREQ_CH2', compa::encodeutf('Var 6:e timma'));
define('_ACA_FREQ_CH3', compa::encodeutf('Var 12:e timma'));
define('_ACA_FREQ_CH4', compa::encodeutf('Dagligt'));
define('_ACA_FREQ_CH5', compa::encodeutf('Veckovis'));
define('_ACA_FREQ_CH6', compa::encodeutf('Månadsvis'));
define('_ACA_FREQ_NONE', compa::encodeutf('Nej'));
define('_ACA_FREQ_NEW', compa::encodeutf('Nya Användare'));
define('_ACA_FREQ_ALL', compa::encodeutf('Alla Användare'));

//Label CRON form
define('_ACA_LABEL_FREQ', compa::encodeutf('Acajoom Cron?'));
define('_ACA_LABEL_FREQ_TIPS', compa::encodeutf('Klicka Ja om du vill använda detta som ett Acajoom Cron, Nej för någon annan cron uppgift.<br />' .
		'Om du klicka Ja så behöver du inte ange någon Cron Adress, det kommer automatiskt att läggas till.'));
define('_ACA_SITE_URL', compa::encodeutf('Din hemsidas URL'));
define('_ACA_CRON_FREQUENCY', compa::encodeutf('Cron Frekvens'));
define('_ACA_STARTDATE_FREQ', compa::encodeutf('Start Datum'));
define('_ACA_LABELDATE_FREQ', compa::encodeutf('Specificera Datum'));
define('_ACA_LABELTIME_FREQ', compa::encodeutf('Specificera Tid'));
define('_ACA_CRON_URL', compa::encodeutf('Cron URL'));
define('_ACA_CRON_FREQ', compa::encodeutf('Frekvens'));
define('_ACA_TITLE_CRONLIST', compa::encodeutf('Cron Lista'));
define('_NEW_LIST', compa::encodeutf('Skapa en ny lista'));

//title CRON form
define('_ACA_TITLE_FREQ', compa::encodeutf('Redigera Cron'));
define('_ACA_CRON_SITE_URL', compa::encodeutf('Fyll i en giltig hemside url, starta med http://'));

### Mailings ###
define('_ACA_MAILING_ALL', compa::encodeutf('Alla mail'));
define('_ACA_EDIT_A', compa::encodeutf('Redigera ett '));
define('_ACA_SELCT_MAILING', compa::encodeutf('Välj en lista i drop down menyn för att lägga till en ny mail.'));
define('_ACA_VISIBLE_FRONT', compa::encodeutf('Synligt på förstasidan'));

// mailer
define('_ACA_SUBJECT', compa::encodeutf('Ämne'));
define('_ACA_CONTENT', compa::encodeutf('Innehåll'));
define('_ACA_NAMEREP', compa::encodeutf('[NAME] = Detta kommer att ersättas med namnet som prenumeranten uppgav, du skickar personlig e-post när du använder dig av detta.<br />'));
define('_ACA_FIRST_NAME_REP', compa::encodeutf('[FIRSTNAME] = Detta kommer att ersättas med FÖR namnet som prenumeranten uppgav.<br />'));
define('_ACA_NONHTML', compa::encodeutf('Ingen-html version'));
define('_ACA_ATTACHMENTS', compa::encodeutf('Bifogade filer'));
define('_ACA_SELECT_MULTIPLE', compa::encodeutf('Hold kontrollen (eller kommando) för att välja flera bifogade filer.<br />' .
		'Filerna som visas i den bifogade listan finns i en bifogad fil mapp, du kan ändra denna plats i konfigurationspanelen.'));
define('_ACA_CONTENT_ITEM', compa::encodeutf('Innehålls objekt'));
define('_ACA_SENDING_EMAIL', compa::encodeutf('Skickar e-post'));
define('_ACA_MESSAGE_NOT', compa::encodeutf('Meddelandet kunde inte skickas'));
define('_ACA_MAILER_ERROR', compa::encodeutf('Mail fel'));
define('_ACA_MESSAGE_SENT_SUCCESSFULLY', compa::encodeutf('Meddelande skickat'));
define('_ACA_SENDING_TOOK', compa::encodeutf('Sändning av detta mail tog'));
define('_ACA_SECONDS', compa::encodeutf('sekunder'));
define('_ACA_NO_ADDRESS_ENTERED', compa::encodeutf('Ingen e-postadress eller prenumerant angavs'));
define('_ACA_CHANGE_SUBSCRIPTIONS', compa::encodeutf('Ändra'));
define('_ACA_CHANGE_EMAIL_SUBSCRIPTION', compa::encodeutf('Ändra din prenumeration'));
define('_ACA_WHICH_EMAIL_TEST', compa::encodeutf('Indikera en e-postadress för att skicka ett test till eller välj förhandsgranska'));
define('_ACA_SEND_IN_HTML', compa::encodeutf('Skicka i HTML (för html mail)?'));
define('_ACA_VISIBLE', compa::encodeutf('Synlig'));
define('_ACA_INTRO_ONLY', compa::encodeutf('Endast Intro'));

// stats
define('_ACA_GLOBALSTATS', compa::encodeutf('Global status'));
define('_ACA_DETAILED_STATS', compa::encodeutf('Detaljerad stats'));
define('_ACA_MAILING_LIST_DETAILS', compa::encodeutf('List detaljer'));
define('_ACA_SEND_IN_HTML_FORMAT', compa::encodeutf('Skicka i HTML format'));
define('_ACA_VIEWS_FROM_HTML', compa::encodeutf('Visningar (fråm html mail)'));
define('_ACA_SEND_IN_TEXT_FORMAT', compa::encodeutf('Skicka i text format'));
define('_ACA_HTML_READ', compa::encodeutf('HTML läst'));
define('_ACA_HTML_UNREAD', compa::encodeutf('HTML oläst'));
define('_ACA_TEXT_ONLY_SENT', compa::encodeutf('Endast Text'));

// Configuration panel
// main tabs
define('_ACA_MAIL_CONFIG', compa::encodeutf('Mail'));
define('_ACA_LOGGING_CONFIG', compa::encodeutf('Loggar & Status'));
define('_ACA_SUBSCRIBER_CONFIG', compa::encodeutf('Prenumeranter'));
define('_ACA_AUTO_CONFIG', compa::encodeutf('Cron'));
define('_ACA_MISC_CONFIG', compa::encodeutf('Övrig'));
define('_ACA_MAIL_SETTINGS', compa::encodeutf('Mail Inställningar'));
define('_ACA_MAILINGS_SETTINGS', compa::encodeutf('Mail Inställningar'));
define('_ACA_SUBCRIBERS_SETTINGS', compa::encodeutf('Prenumerant Inställningar'));
define('_ACA_CRON_SETTINGS', compa::encodeutf('Cron Inställningar'));
define('_ACA_SENDING_SETTINGS', compa::encodeutf('Sändnings Inställningar'));
define('_ACA_STATS_SETTINGS', compa::encodeutf('Statistik Inställningar'));
define('_ACA_LOGS_SETTINGS', compa::encodeutf('Logg Inställningar'));
define('_ACA_MISC_SETTINGS', compa::encodeutf('Övriga Inställningar'));
// mail settings
define('_ACA_SEND_MAIL_FROM', compa::encodeutf('Från E-post'));
define('_ACA_SEND_MAIL_NAME', compa::encodeutf('Från Namn'));
define('_ACA_MAILSENDMETHOD', compa::encodeutf('Mail metod'));
define('_ACA_SENDMAILPATH', compa::encodeutf('Skicka mail sökväg'));
define('_ACA_SMTPHOST', compa::encodeutf('SMTP värd'));
define('_ACA_SMTPAUTHREQUIRED', compa::encodeutf('SMTP Autentificering krävs'));
define('_ACA_SMTPAUTHREQUIRED_TIPS', compa::encodeutf('Välj ja om din SMTP server kräver autentificering'));
define('_ACA_SMTPUSERNAME', compa::encodeutf('SMTP användarnamn'));
define('_ACA_SMTPUSERNAME_TIPS', compa::encodeutf('Skriv in SMTP användarnamnet när din SMTP server kräver autentificering'));
define('_ACA_SMTPPASSWORD', compa::encodeutf('SMTP lösenord'));
define('_ACA_SMTPPASSWORD_TIPS', compa::encodeutf('Skriv in SMTP lösenord när din SMTP server kräver autentificering'));
define('_ACA_USE_EMBEDDED', compa::encodeutf('Använd inbäddade bilder'));
define('_ACA_USE_EMBEDDED_TIPS', compa::encodeutf('Välj ja om bilderna i bifogat innehålls objekt ska bäddas in i mailet för html meddelanden, eller nej för att använda dig av standardbild tagar som länkas till bilderna på hemsidan.'));
define('_ACA_UPLOAD_PATH', compa::encodeutf('Uppladdning/bifogade filer sökväg'));
define('_ACA_UPLOAD_PATH_TIPS', compa::encodeutf('Du kan specificera en uppladdningsmapp.<br />' .
		'Se till att mappen som du specificerade finns, annars skapa den.'));

// subscribers settings
define('_ACA_ALLOW_UNREG', compa::encodeutf('Tillåt oregistrerade'));
define('_ACA_ALLOW_UNREG_TIPS', compa::encodeutf('Välj Ja om du vill tillåta användare att prenumerera på listor utan att vara registrerade på hemsidan.'));
define('_ACA_REQ_CONFIRM', compa::encodeutf('Kräver bekräftelse'));
define('_ACA_REQ_CONFIRM_TIPS', compa::encodeutf('Välj ja om du kräver att oregistrerade prenumeranter ska bekräfta sin e-postadress.'));
define('_ACA_SUB_SETTINGS', compa::encodeutf('Prenumerations Inställningar'));
define('_ACA_SUBMESSAGE', compa::encodeutf('Prenumerations E-post'));
define('_ACA_SUBSCRIBE_LIST', compa::encodeutf('Prenumerera på en lista'));

define('_ACA_USABLE_TAGS', compa::encodeutf('Användbara taggar'));
define('_ACA_NAME_AND_CONFIRM', compa::encodeutf('<b>[CONFIRM]</b> = Detta skapar en klickbar länk som prenumeranten kan bekräfta sin prenumeration. Detta  <strong>krävs</strong> för att Acajoom ska fungera korrekt.<br />'
.'<br />[NAME] = Detta kommer att ersättas med namnet som prenumeranten uppgav, du skickar personlig e-post om du använder dig av detta.<br />'
.'<br />[FIRSTNAME] = Detta kommer att ersättas med FÖR namnet på prenumeranten, Första namnet DEFINERAS som första namnet som fylls i av prenumeranten.<br />'));
define('_ACA_CONFIRMFROMNAME', compa::encodeutf('Bekräfta från namn'));
define('_ACA_CONFIRMFROMNAME_TIPS', compa::encodeutf('Skriv in från namn som visas i bekräftelse listor.'));
define('_ACA_CONFIRMFROMEMAIL', compa::encodeutf('Bekräfta från e-post'));
define('_ACA_CONFIRMFROMEMAIL_TIPS', compa::encodeutf('Skriv in en e-postadress som visas i bekräftelse listor.'));
define('_ACA_CONFIRMBOUNCE', compa::encodeutf('Studsadress'));
define('_ACA_CONFIRMBOUNCE_TIPS', compa::encodeutf('Skriv in en studsadress som visas i bekräftelse listor.'));
define('_ACA_HTML_CONFIRM', compa::encodeutf('HTML bekräftelse'));
define('_ACA_HTML_CONFIRM_TIPS', compa::encodeutf('Välj ja om bekräftelse listor ska vara html om användaren tillåter html.'));
define('_ACA_TIME_ZONE_ASK', compa::encodeutf('Fråga tidszon'));
define('_ACA_TIME_ZONE_TIPS', compa::encodeutf('Välj ja om du vill fråga om användarnas tidszon.  De köade mailen kommer att skickas enligt turordningen baserat på vilken tidszon man befinner sig i'));

 // Cron Set up
define('_ACA_TIME_OFFSET_URL', compa::encodeutf('klicka här för att ställa in offset i den globala konfigurationspanelen -> Lokal tabb'));
define('_ACA_TIME_OFFSET_TIPS', compa::encodeutf('Ställ in din servers tid offset så det inspelade datumet och tiden är exakt'));
define('_ACA_TIME_OFFSET', compa::encodeutf('Tid offset'));
define('_ACA_CRON_TITLE', compa::encodeutf('Ställer in cron funktion'));
define('_ACA_CRON_DESC', compa::encodeutf('<br />Genom att använda cron funktionen så kan du ställa in en automatisk uppgift för din hemsida!<br />' .
		'För att ställa in den så behöver du i din crontab kontrollpanel skriva följande kommando:<br />' .
		'<b>' . ACA_JPATH_LIVE . '/index2.php?option=com_acajoom&act=cron</b> ' .
		'<br /><br />Om du behöver hjälp att ställa in den eller har problem var god och konsultera vårat forum <a href="http://www.ijoobi.com" target="_blank">http://www.ijoobi.com</a>'));
// sending settings
define('_ACA_PAUSEX', compa::encodeutf('Pausa x sekunder varje konfigurerad mängd av mail'));
define('_ACA_PAUSEX_TIPS', compa::encodeutf('Skriv in antalet sekunder som Acajoom kommer att ge SMTP servern tiden att sända ut meddelanden innan den fortsätter med nästa konfigurerade mängd av meddelanden.'));
define('_ACA_EMAIL_BET_PAUSE', compa::encodeutf('Mail mellan pausar'));
define('_ACA_EMAIL_BET_PAUSE_TIPS', compa::encodeutf('Antalet mail att skicka innan den ska pausa.'));
define('_ACA_WAIT_USER_PAUSE', compa::encodeutf('Vänta på användarinmatningsdata vid paus'));
define('_ACA_WAIT_USER_PAUSE_TIPS', compa::encodeutf('Om skriptet ska vänta på användarinmatningsdata när paus sker med mailande.'));
define('_ACA_SCRIPT_TIMEOUT', compa::encodeutf('Skript timeout'));
define('_ACA_SCRIPT_TIMEOUT_TIPS', compa::encodeutf('Antalet minuter som skriptet ska köras.'));
// Stats settings
define('_ACA_ENABLE_READ_STATS', compa::encodeutf('Aktivera läs statistik'));
define('_ACA_ENABLE_READ_STATS_TIPS', compa::encodeutf('Välj ja om du vill logga antalet visningar. Denna teknik kan endast användas med html mailande'));
define('_ACA_LOG_VIEWSPERSUB', compa::encodeutf('Logga visningar per prenumerant'));
define('_ACA_LOG_VIEWSPERSUB_TIPS', compa::encodeutf('Välj ja om du vill logga antalet visningar per prenumerant. Denna teknik kan endast användas med html mailande'));
// Logs settings
define('_ACA_DETAILED', compa::encodeutf('Detaljerade loggar'));
define('_ACA_SIMPLE', compa::encodeutf('Förenklade loggar'));
define('_ACA_DIAPLAY_LOG', compa::encodeutf('Visa loggar'));
define('_ACA_DISPLAY_LOG_TIPS', compa::encodeutf('Välj ja om du vill visa loggar medans du skickar mail.'));
define('_ACA_SEND_PERF_DATA', compa::encodeutf('Sänd ut prestanda'));
define('_ACA_SEND_PERF_DATA_TIPS', compa::encodeutf('Välj ja om du vill tillåta Acajoom att sända ut ANONYMA rapporter om din konfiguration, antalet prenumeranter i en lista och tiden det tog att skicka ut mailen. Detta ger oss en idé om Acajoom prestandan och kommer att HJÄLPA OSS att förbättra Acajoom i framtida utvecklingar.'));
define('_ACA_SEND_AUTO_LOG', compa::encodeutf('Skicka logg för auto-responder'));
define('_ACA_SEND_AUTO_LOG_TIPS', compa::encodeutf('Välj ja om du vill skicka en mail logg varje gång tek kön behandlas.  VARNING: detta kan resultera i stor mängd mail.'));
define('_ACA_SEND_LOG', compa::encodeutf('Skicka logg'));
define('_ACA_SEND_LOG_TIPS', compa::encodeutf('Om en logg av mailandet ska e-postas till användarens e-postadress som skickade mailet.'));
define('_ACA_SEND_LOGDETAIL', compa::encodeutf('Skicka logg detaljer'));
define('_ACA_SEND_LOGDETAIL_TIPS', compa::encodeutf('Detaljerad inkluderar den lyckade eller felaktiga information för varje prenumerant och en överblick utav informationen. Skickar endast en enkel översikt.'));
define('_ACA_SEND_LOGCLOSED', compa::encodeutf('Skicka logg om överföringen stängs'));
define('_ACA_SEND_LOGCLOSED_TIPS', compa::encodeutf(' Med detta val på användaren som skickade mailet så kommer den personen fortfarande få en rapport via e-post.'));
define('_ACA_SAVE_LOG', compa::encodeutf('Spara logg'));
define('_ACA_SAVE_LOG_TIPS', compa::encodeutf('Om en logg på mailen ska tas upp till loggfilen.'));
define('_ACA_SAVE_LOGDETAIL', compa::encodeutf('Spara loggdetaljer'));
define('_ACA_SAVE_LOGDETAIL_TIPS', compa::encodeutf('Detaljerad inkluderar den lyckade eller felaktiga information för varje prenumerant och en överblick utav informationen. Sparar endast en enkel översikt.'));
define('_ACA_SAVE_LOGFILE', compa::encodeutf('Spara loggfil'));
define('_ACA_SAVE_LOGFILE_TIPS', compa::encodeutf('Filen som logg informationen ska tas upp till. Denna fil kan bli riktigt stor.'));
define('_ACA_CLEAR_LOG', compa::encodeutf('Rensa logg'));
define('_ACA_CLEAR_LOG_TIPS', compa::encodeutf('Rensar loggfilen.'));

### control panel
define('_ACA_CP_LAST_QUEUE', compa::encodeutf('Senast körda kö'));
define('_ACA_CP_TOTAL', compa::encodeutf('Totalt'));
define('_ACA_MAILING_COPY', compa::encodeutf('Mailen kopierad!'));

// Miscellaneous settings
define('_ACA_SHOW_GUIDE', compa::encodeutf('Visa guide'));
define('_ACA_SHOW_GUIDE_TIPS', compa::encodeutf('Visar guiden vid start för att hjälpa nya användare skapa ett nyhetsbrev, en auto-responder och att ställa in Acajoom ordentligt.'));
define('_ACA_AUTOS_ON', compa::encodeutf('Använd Auto-respondrar'));
define('_ACA_AUTOS_ON_TIPS', compa::encodeutf('Välj Nej om du inte vill använda Auto-respondrar, alla auto-responder val kommer att inaktiveras.'));
define('_ACA_NEWS_ON', compa::encodeutf('Använd Nyhetsbrev'));
define('_ACA_NEWS_ON_TIPS', compa::encodeutf('Välj Nej om du inte vill använda Nyhetsbrev, alla nyhetsbrevsval kommer att inaktiveras.'));
define('_ACA_SHOW_TIPS', compa::encodeutf('Visa tips'));
define('_ACA_SHOW_TIPS_TIPS', compa::encodeutf('Visa tipsen, för att hjälpa användare att använda Acajoom mer effektivt.'));
define('_ACA_SHOW_FOOTER', compa::encodeutf('Visa sidfot'));
define('_ACA_SHOW_FOOTER_TIPS', compa::encodeutf('Om sidfots copyrights noteringar ska visas.'));
define('_ACA_SHOW_LISTS', compa::encodeutf('Visa listor på förstasidan'));
define('_ACA_SHOW_LISTS_TIPS', compa::encodeutf('När användare inte är registrerade visa en lista på listor som dom kan prenumerera på med arkivknapp för nyhetsbrev eller ett login formulär så dom kan registrera sig.'));
define('_ACA_CONFIG_UPDATED', compa::encodeutf('Konfigurations detaljerna har uppdaterats!'));
define('_ACA_UPDATE_URL', compa::encodeutf('Uppdatera URL'));
define('_ACA_UPDATE_URL_WARNING', compa::encodeutf('VARNING! Ändra inte på denna URL om du inte har blivit tillsagd av Acajoom tekniska team att göra så.<br />'));
define('_ACA_UPDATE_URL_TIPS', compa::encodeutf('Som exempel: http://www.ijoobi.com/update/ (inkludera det avslutande slashen)'));

// module
define('_ACA_EMAIL_INVALID', compa::encodeutf('E-posten som angavs är felaktig.'));
define('_ACA_REGISTER_REQUIRED', compa::encodeutf('Var vänlig och registrera dig på hemsidan innan du kan anmäla dig som prenumerant.'));

// Access level box
define('_ACA_OWNER', compa::encodeutf('Skapare av lista:'));
define('_ACA_ACCESS_LEVEL', compa::encodeutf('Ställ in behörighetsnivå för listan'));
define('_ACA_ACCESS_LEVEL_OPTION', compa::encodeutf('Behörighetsnivå Val'));
define('_ACA_USER_LEVEL_EDIT', compa::encodeutf('Välj vilken användarnivå som tillåter redigering av mailen (antingen från förstasidan eller backend) '));

//  drop down options
define('_ACA_AUTO_DAY_CH1', compa::encodeutf('Daglig'));
define('_ACA_AUTO_DAY_CH2', compa::encodeutf('Daglig ingen helg'));
define('_ACA_AUTO_DAY_CH3', compa::encodeutf('Varannan dag'));
define('_ACA_AUTO_DAY_CH4', compa::encodeutf('Varannan dag ingen helg'));
define('_ACA_AUTO_DAY_CH5', compa::encodeutf('Veckovis'));
define('_ACA_AUTO_DAY_CH6', compa::encodeutf('Varannan vecka'));
define('_ACA_AUTO_DAY_CH7', compa::encodeutf('Månadsvis'));
define('_ACA_AUTO_DAY_CH9', compa::encodeutf('Årligt'));
define('_ACA_AUTO_OPTION_NONE', compa::encodeutf('Nej'));
define('_ACA_AUTO_OPTION_NEW', compa::encodeutf('Nya Användare'));
define('_ACA_AUTO_OPTION_ALL', compa::encodeutf('Alla Användare'));

//
define('_ACA_UNSUB_MESSAGE', compa::encodeutf('Prenumerera Ej E-post'));
define('_ACA_UNSUB_SETTINGS', compa::encodeutf('Prenumerera Ej Inställningar'));
define('_ACA_AUTO_ADD_NEW_USERS', compa::encodeutf('Auto Prenumerera Användare?'));

// Update and upgrade messages
define('_ACA_NO_UPDATES', compa::encodeutf('Det finns förnärvarande inga uppdateringar tillgängliga.'));
define('_ACA_VERSION', compa::encodeutf('Acajoom Version'));
define('_ACA_NEED_UPDATED', compa::encodeutf('Filer som behöver uppdateras:'));
define('_ACA_NEED_ADDED', compa::encodeutf('Filer som behöver läggas till:'));
define('_ACA_NEED_REMOVED', compa::encodeutf('Filer som behöver tas bort:'));
define('_ACA_FILENAME', compa::encodeutf('Filnamn:'));
define('_ACA_CURRENT_VERSION', compa::encodeutf('Nuvarande version:'));
define('_ACA_NEWEST_VERSION', compa::encodeutf('Senaste version:'));
define('_ACA_UPDATING', compa::encodeutf('Uppdaterar'));
define('_ACA_UPDATE_UPDATED_SUCCESSFULLY', compa::encodeutf('Filerna har uppdaterats.'));
define('_ACA_UPDATE_FAILED', compa::encodeutf('Uppdatering misslyckades!'));
define('_ACA_ADDING', compa::encodeutf('Lägger till'));
define('_ACA_ADDED_SUCCESSFULLY', compa::encodeutf('Tillagda.'));
define('_ACA_ADDING_FAILED', compa::encodeutf('Tilläggning misslyckades!'));
define('_ACA_REMOVING', compa::encodeutf('Tar bort'));
define('_ACA_REMOVED_SUCCESSFULLY', compa::encodeutf('Togs bort.'));
define('_ACA_REMOVING_FAILED', compa::encodeutf('Borttagning misslyckades!'));
define('_ACA_INSTALL_DIFFERENT_VERSION', compa::encodeutf('Installera en annan version'));
define('_ACA_CONTENT_ADD', compa::encodeutf('Skapa innehåll'));
define('_ACA_UPGRADE_FROM', compa::encodeutf('Importera data (nyhetsbrev och prenumeranter\' information) från '));
define('_ACA_UPGRADE_MESS', compa::encodeutf('Det finns ingen risk för din existerande data. <br /> Denna process kommer importera data till Acajoom databasen.'));
define('_ACA_CONTINUE_SENDING', compa::encodeutf('Fortsätt skicka'));

// Acajoom message
define('_ACA_UPGRADE1', compa::encodeutf('Du kan enkelt importera dina användare och nyhetsbrev från '));
define('_ACA_UPGRADE2', compa::encodeutf(' till Acajoom i uppdateringspanelen.'));
define('_ACA_UPDATE_MESSAGE', compa::encodeutf('En ny version av Acajoom finns tillgänglig! '));
define('_ACA_UPDATE_MESSAGE_LINK', compa::encodeutf('Klicka här för att uppdatera!'));
define('_ACA_CRON_SETUP', compa::encodeutf('För att autorespondrarna ska skickas så behöver du ställa in en cron uppgift.'));
define('_ACA_THANKYOU', compa::encodeutf('Tack för att du valde Acajoom, Din kommunikationspartner!'));
define('_ACA_NO_SERVER', compa::encodeutf('Uppdatering av Server är inte tillgänglig, var god och försök senare.'));
define('_ACA_MOD_PUB', compa::encodeutf('Acajoom modulen är inte publicerad.'));
define('_ACA_MOD_PUB_LINK', compa::encodeutf('Klicka här för att publicera den!'));
define('_ACA_IMPORT_SUCCESS', compa::encodeutf('Importerades'));
define('_ACA_IMPORT_EXIST', compa::encodeutf('Prenumeranten finns redan i databasen'));


// Acajoom's Guide
define('_ACA_GUIDE', compa::encodeutf('\'s Wizard'));
define('_ACA_GUIDE_FIRST_ACA_STEP', compa::encodeutf('<p>Acajoom har många stora fördelar och denna wizard kommer att guida dig igenom fyra enkla steg för att hjälpa dig att komma igång med sändning av ditt nyhetsbrev och auto-respondrar!<p />'));
define('_ACA_GUIDE_FIRST_ACA_STEP_DESC', compa::encodeutf('Första, du behöver skapa en lista.  En lista kan vara av två typer, antingen ett nyhetsbrev eller en auto-responder.' .
		'  I listan som du definerar alla möjliga parametrar för att aktivera sändning av ditt nyhetsbrev eller auto-respondrar: avsändarens namn, layout, prenumeranter\' välkomst meddelande, etc...
<br /><br />Du kan ställa in din första lista här: <a href="index2.php?option=com_acajoom&act=list" >skapa en lista</a> och klicka på Ny knappen.'));
define('_ACA_GUIDE_FIRST_ACA_STEP_UPGRADE', compa::encodeutf('Acajoom tillhandahåller dig med en enkel väg genom att importera all data från ett tidigare nyhetsbrevssystem.<br />' .
		' Gå till Uppdaterapanelen och välj ditt tidigare nyhetsbrevssystem att importera alla dina nyhetsbrev och prenumeranter.<br /><br />' .
		'<span style="color:#FF5E00;" >VIKTIGT: importeringen är riskfri och påverkar inte på något sett data från ditt tidigare nyhetsbrevssystem</span><br />' .
		'Efter importering så kommer du ha möjlighet att hantera dina prenumeranter och mailen direkt genom Acajoom.<br /><br />'));
define('_ACA_GUIDE_SECOND_ACA_STEP', compa::encodeutf('Kanon din första lista är inställd!  Du kan nu skriva din första %s.  För att skapa den gå till: '));
define('_ACA_GUIDE_SECOND_ACA_STEP_AUTO', compa::encodeutf('Auto-responder Hanterare'));
define('_ACA_GUIDE_SECOND_ACA_STEP_NEWS', compa::encodeutf('Nyhetsbrevs Hanterare'));
define('_ACA_GUIDE_SECOND_ACA_STEP_FINAL', compa::encodeutf(' och välj din %s. <br /> Sedan så väljer du din %s i drop down listan.  Skapa din första mail genom att klicka på Ny '));

define('_ACA_GUIDE_THRID_ACA_STEP_NEWS', compa::encodeutf('Innan du skickar ditt första nyhetsbrev så ska du kolla genom mail konfigurationen.  ' .
		'Gå till <a href="index2.php?option=com_acajoom&act=configuration" >konfigurations sidan</a> för att verifiera mail inställningarna. <br />'));
define('_ACA_GUIDE_THRID2_ACA_STEP_NEWS', compa::encodeutf('<br />När du är klar gå tillbaka till Nyhetsbrevs menyn, välj din mail och klicka sedan på Skicka'));

define('_ACA_GUIDE_THRID_ACA_STEP_AUTOS', compa::encodeutf('För att dina auto-respondrar ska sändas så behöver du först ställa in en cron uppgift på din server. ' .
		' Referera till Cron tabben i konfigurationspanelen.' .
		' <a href="index2.php?option=com_acajoom&act=configuration" >klicka här</a> för att lära dig om hur man ställer in en cron uppgift. <br />'));

define('_ACA_GUIDE_MODULE', compa::encodeutf(' <br />Kolla även upp att du har publicerat Acajoom modulen så personer kan skriva in sig för prenumerationer.'));

define('_ACA_GUIDE_FOUR_ACA_STEP_NEWS', compa::encodeutf(' Du kan nu också ställa in en auto-responder.'));
define('_ACA_GUIDE_FOUR_ACA_STEP_AUTOS', compa::encodeutf(' Du kan nu också ställa in ett nyhetsbrev.'));

define('_ACA_GUIDE_FOUR_ACA_STEP', compa::encodeutf('<p><br />Voila! Du är nu redo för att effektivt kommunicera med dina besökare och användare. Denna wizard kommer att avslutas när du har fixat din andra omgång med mail eller så kan du stänga av det i <a href="index2.php?option=com_acajoom&act=configuration" >konfigurationspanelen</a>.' .
		'<br /><br />  Om du har några frågor medans du använder Acajoom, refera till ' .
		'<a target="_blank" href="http://www.ijoobi.com/index.php?option=com_agora&Itemid=60" >forum</a>. ' .
		' Du hittar även massor med information på hur du kommunicerar effektivt med dina prenumeranter på <a href="http://www.ijoobi.com/" target="_blank">www.ijoobi.com</a>.' .
		'<p /><br /><b>Tack för att du använder Acajoom. Din Kommunikations Partner!</b> '));
define('_ACA_GUIDE_TURNOFF', compa::encodeutf('Wizarden stängs nu av!'));
define('_ACA_STEP', compa::encodeutf('STEG '));

// Acajoom Install
define('_ACA_INSTALL_CONFIG', compa::encodeutf('Acajoom Konfiguration'));
define('_ACA_INSTALL_SUCCESS', compa::encodeutf('Installerades'));
define('_ACA_INSTALL_ERROR', compa::encodeutf('Installations Fel'));
define('_ACA_INSTALL_BOT', compa::encodeutf('Acajoom Plugin (Bot)'));
define('_ACA_INSTALL_MODULE', compa::encodeutf('Acajoom Modul'));
//Others
define('_ACA_JAVASCRIPT', compa::encodeutf('!Varning! Javascript måste vara aktiverat för en fungerande operation.'));
define('_ACA_EXPORT_TEXT', compa::encodeutf('Prenumeranterna som exporterades baseras på listan som du angav. <br />Exportera prenumeranter för lista'));
define('_ACA_IMPORT_TIPS', compa::encodeutf('Importera prenumeranter. Informationen i filen behöver vara i följande format: <br />' .
		'Namn,e-post,mottaHTML(1/0),<span style="color: rgb(255, 0, 0);">bekräftad(1/0)</span>'));
define('_ACA_SUBCRIBER_EXIT', compa::encodeutf('är redan en prenumerant'));
define('_ACA_GET_STARTED', compa::encodeutf('Klicka här för att köra igång!'));

//News since 1.0.1
define('_ACA_WARNING_1011', compa::encodeutf('Varning: 1011: Uppdatera kommer inte att fungera på grund av dina server restrektioner.'));
define('_ACA_SEND_MAIL_FROM_TIPS', compa::encodeutf('Välj vilken e-postadress som ska visas som avsändare.'));
define('_ACA_SEND_MAIL_NAME_TIPS', compa::encodeutf('Välj vilket namn som ska visas som avsändare.'));
define('_ACA_MAILSENDMETHOD_TIPS', compa::encodeutf('Välj vilken mail som du vill ska användas: PHP mail funktion, <span>Sendmail</span> eller SMTP Server.'));
define('_ACA_SENDMAILPATH_TIPS', compa::encodeutf('Detta är mappen till Mailservern'));
define('_ACA_LIST_T_TEMPLATE', compa::encodeutf('Mall'));
define('_ACA_NO_MAILING_ENTERED', compa::encodeutf('Inget mailande tillhandahålls'));
define('_ACA_NO_LIST_ENTERED', compa::encodeutf('Ingen lista tillhandahålls'));
define('_ACA_SENT_MAILING', compa::encodeutf('Skickade mail'));
define('_ACA_SELECT_FILE', compa::encodeutf('Välj en fil att '));
define('_ACA_LIST_IMPORT', compa::encodeutf('Kolla lista(or) som du vill att prenumeranter ska associeras med.'));
define('_ACA_PB_QUEUE', compa::encodeutf('Prenumerant inlagd men problem att ansluta han/henne till lista(or). Kolla manuellt.'));
define('_ACA_UPDATE_MESS', compa::encodeutf(''));
define('_ACA_UPDATE_MESS1', compa::encodeutf('Uppdatering rekommenderas Mycket!'));
define('_ACA_UPDATE_MESS2', compa::encodeutf('Patch och små åtgärder.'));
define('_ACA_UPDATE_MESS3', compa::encodeutf('Ny utgåva.'));
define('_ACA_UPDATE_MESS5', compa::encodeutf('Joomla 1.5 behövs för att kunna uppdatera.'));
define('_ACA_UPDATE_IS_AVAIL', compa::encodeutf(' fins tillgänglig!'));
define('_ACA_NO_MAILING_SENT', compa::encodeutf('Inga mail skickade!'));
define('_ACA_SHOW_LOGIN', compa::encodeutf('Visa logga in formulär'));
define('_ACA_SHOW_LOGIN_TIPS', compa::encodeutf('Välj Ja för att visa ett logga in formulär i förstaside Acajoom kontrollpanelen så att användare kan registrera sig på hemsidan.'));
define('_ACA_LISTS_EDITOR', compa::encodeutf('Listans Beskrivnings Redigerare'));
define('_ACA_LISTS_EDITOR_TIPS', compa::encodeutf('Välj Ja för att använda en HTML redigerare för att redigera listans beskrivningsfält.'));
define('_ACA_SUBCRIBERS_VIEW', compa::encodeutf('Visa prenumeranter'));

//News since 1.0.2
define('_ACA_FRONTEND_SETTINGS', compa::encodeutf('Förstaside Inställningar'));
define('_ACA_SHOW_LOGOUT', compa::encodeutf('Visa logga ut knapp'));
define('_ACA_SHOW_LOGOUT_TIPS', compa::encodeutf('Välj Ja för att visa en logga ut knapp På förstasidans Acajoom kontrollpanel.'));

//News since 1.0.3 CB integration
define('_ACA_CONFIG_INTEGRATION', compa::encodeutf('Integration'));
define('_ACA_CB_INTEGRATION', compa::encodeutf('Community Builder Integrering'));
define('_ACA_INSTALL_PLUGIN', compa::encodeutf('Community Builder Plugin (Acajoom
Integrering) '));
define('_ACA_CB_PLUGIN_NOT_INSTALLED', compa::encodeutf('Acajoom Plugin för Community Builder är ännu inte installerad!'));
define('_ACA_CB_PLUGIN', compa::encodeutf('Listor vid registrering'));
define('_ACA_CB_PLUGIN_TIPS', compa::encodeutf('Välj Ja för att visa maillistor i community builders registrerings formulär'));
define('_ACA_CB_LISTS', compa::encodeutf('List ID:er'));
define('_ACA_CB_LISTS_TIPS', compa::encodeutf('DETTA ÄR ETT OBLIGATORISKT FÄLT. Skriv in id nummer på listor som du vill att användare ska ha tillåtelse att prenumerera på separera med kommatecken,  (0 visa alla listor)'));
define('_ACA_CB_INTRO', compa::encodeutf('Introduktionstext'));
define('_ACA_CB_INTRO_TIPS', compa::encodeutf('En text som visas kommer att visas före listorna. LÄMNA TOMT FÖR ATT INTE VISA NÅGONTING. Använd cb_förtext för CSS layout.'));
define('_ACA_CB_SHOW_NAME', compa::encodeutf('Visa Listnamn'));
define('_ACA_CB_SHOW_NAME_TIPS', compa::encodeutf('Välj om namnet på listan ska visas efter introduktionen.'));
define('_ACA_CB_LIST_DEFAULT', compa::encodeutf('Kolla lista som standard'));
define('_ACA_CB_LIST_DEFAULT_TIPS', compa::encodeutf('Välj om du vill att kryssrutan för varje lista ska kollas som standard.'));
define('_ACA_CB_HTML_SHOW', compa::encodeutf('Visa Mottag HTML'));
define('_ACA_CB_HTML_SHOW_TIPS', compa::encodeutf('Ställ in till Ja för att tillåta användare att besluta om dom ska ha HTML e-post eller inte. Ställ in till Nej för att använda mottag html som standard.'));
define('_ACA_CB_HTML_DEFAULT', compa::encodeutf('Standard Mottag HTML'));
define('_ACA_CB_HTML_DEFAULT_TIPS', compa::encodeutf('Ställ in detta alternativ för att visa standard html mail konfiguration. Om Visa Mottag HTML är inställt till Nej så kommer detta val att vara standard.'));

// Since 1.0.4
define('_ACA_BACKUP_FAILED', compa::encodeutf('Kunde inte göra en backup på filen! Filen ersattes inte.'));
define('_ACA_BACKUP_YOUR_FILES', compa::encodeutf('De äldre versionsfilerna har backats upp till följande mapp:'));
define('_ACA_SERVER_LOCAL_TIME', compa::encodeutf('Server lokaltid'));
define('_ACA_SHOW_ARCHIVE', compa::encodeutf('Visa arkivknapp'));
define('_ACA_SHOW_ARCHIVE_TIPS', compa::encodeutf('Välj Ja för att visa arkivknappen på förstasidan i Nyhetsbrevslistan'));
define('_ACA_LIST_OPT_TAG', compa::encodeutf('Taggar'));
define('_ACA_LIST_OPT_IMG', compa::encodeutf('Bilder'));
define('_ACA_LIST_OPT_CTT', compa::encodeutf('Innehåll'));
define('_ACA_INPUT_NAME_TIPS', compa::encodeutf('Fyll i ditt fullständiga namn (förnamnet först)'));
define('_ACA_INPUT_EMAIL_TIPS', compa::encodeutf('Fyll i din e-postadress (Var noga med att detta är en giltig e-postadress om du vill mottaga våra nyhetsbrev.)'));
define('_ACA_RECEIVE_HTML_TIPS', compa::encodeutf('Välj Ja om du vill mottaga HTML mail - Nej för att mottaga endast Text mail'));
define('_ACA_TIME_ZONE_ASK_TIPS', compa::encodeutf('Specificera din tidszon.'));

// Since 1.0.5
define('_ACA_FILES', compa::encodeutf('Filer'));
define('_ACA_FILES_UPLOAD', compa::encodeutf('Ladda Upp'));
define('_ACA_MENU_UPLOAD_IMG', compa::encodeutf('Ladda Upp Bilder'));
define('_ACA_TOO_LARGE', compa::encodeutf('Filstorleken är för stor. Den tillåtna maximala storleken är'));
define('_ACA_MISSING_DIR', compa::encodeutf('Destinations mappen existerar inte'));
define('_ACA_IS_NOT_DIR', compa::encodeutf('Destinations mappen existerar inte eller är inte en ordinär fil.'));
define('_ACA_NO_WRITE_PERMS', compa::encodeutf('Destinations mappen är skrivskyddad.'));
define('_ACA_NO_USER_FILE', compa::encodeutf('Du har inte valt en fil att ladda upp.'));
define('_ACA_E_FAIL_MOVE', compa::encodeutf('Omöjligt att flytta filen.'));
define('_ACA_FILE_EXISTS', compa::encodeutf('Destinationsfilen finns redan.'));
define('_ACA_CANNOT_OVERWRITE', compa::encodeutf('Destinationsfilen finns redan och kan därför inte skrivas över.'));
define('_ACA_NOT_ALLOWED_EXTENSION', compa::encodeutf('Filändelsen är inte tillåten.'));
define('_ACA_PARTIAL', compa::encodeutf('Filen laddades delvis bara upp.'));
define('_ACA_UPLOAD_ERROR', compa::encodeutf('Uppladdningsfel:'));
define('DEV_NO_DEF_FILE', compa::encodeutf('Filen laddades delvis bara upp.'));

define('_ACA_CONTENTREP', compa::encodeutf('[SUBSCRIPTIONS] = Detta kommer att ersättas med prenumerationslänkar.' .
		'Detta är <strong>nödvändigt</strong> för att Acajoom ska fungera korrekt.<br />' .
		'Om du placerar annat innehåll i denna ruta så kommer det att visas i alla mail som hänvisas till denna lista.' .
		' <br />Infoga ditt prenumerations meddelande i slutet.  Acajoom kommer automatiskt att lägga till en länk för prenumeranten att ändra sin information och en länk för att sluta prenumera från listan.'));

// since 1.0.6
define('_ACA_NOTIFICATION', compa::encodeutf('Meddelande'));  // shortcut for Email notification
define('_ACA_NOTIFICATIONS', compa::encodeutf('Meddelanden'));
define('_ACA_USE_SEF', compa::encodeutf('SEF i mail'));
define('_ACA_USE_SEF_TIPS', compa::encodeutf('Det är rekommenderat att du väljer Nej.  Men om du vill att URL,en ska inkluderas i din mail för att använda SEF välj då Ja.' .
		' <br /><b>Länkarna fungerar på samma sett oavsett val.  Nej kommer att försäkra dig att länkarna i mailen kommer alltid att fungera även om du ändrar din SEF.</b> '));
define('_ACA_ERR_NB', compa::encodeutf('Fel #: ERR'));
define('_ACA_ERR_SETTINGS', compa::encodeutf('Felhanterings inställningar'));
define('_ACA_ERR_SEND', compa::encodeutf('Skicka felrapport'));
define('_ACA_ERR_SEND_TIPS', compa::encodeutf('Om du vill att Acajoom ska bli en bättre produkt välj JA.  Detta kommer att sända oss en felrapport.  Så du behöver inte själv rapportera buggar längre ;-) <br /> <b>INGEN PRIVAT INFORMATION KOMMER ATT SKICKAS</b>.  Vi vet inte ens från vilken hemsida felet kommer ifrån. Vi skickar endast information om Acajoom, PHP inställningarna och SQL frågor. '));
define('_ACA_ERR_SHOW_TIPS', compa::encodeutf('Välj Ja för att visa felnummer på skärmen.  Används oftast för att avbuggnings syfte. '));
define('_ACA_ERR_SHOW', compa::encodeutf('Visa fel'));
define('_ACA_LIST_SHOW_UNSUBCRIBE', compa::encodeutf('Visa prenumerera Inte länkar'));
define('_ACA_LIST_SHOW_UNSUBCRIBE_TIPS', compa::encodeutf('Välj Ja för att visa prenumerera Inte länkar i botten av mailen för användare för möjligheten att ändra sina prenumerationer. <br /> Nej avaktivera footer och länkar.'));
define('_ACA_UPDATE_INSTALL', compa::encodeutf('<span style="color: rgb(255, 0, 0);">VIKTIGT MEDDELANDE!</span> <br />Om du uppgraderar från en tidigare version av Acajoom installation så behöver du även uppgradera din databas struktur genom att klicka på följande knapp (Din data kommer fortfarande att vara fullständig)'));
define('_ACA_UPDATE_INSTALL_BTN', compa::encodeutf('Uppgradera tabeller och konfiguration'));
define('_ACA_MAILING_MAX_TIME', compa::encodeutf('Max kötid'));
define('_ACA_MAILING_MAX_TIME_TIPS', compa::encodeutf('Definera den maximala tiden för varje mailutskick skickad av kön. Rekommenderat mellan 30 s och 2 min.'));

// virtuemart integration beta
define('_ACA_VM_INTEGRATION', compa::encodeutf('VirtueMart Integrering'));
define('_ACA_VM_COUPON_NOTIF', compa::encodeutf('Kupong meddelande ID'));
define('_ACA_VM_COUPON_NOTIF_TIPS', compa::encodeutf('Specificera ID numret av mail som du vill använda för att skicka kuponger till dina köpare.'));
define('_ACA_VM_NEW_PRODUCT', compa::encodeutf('Ny produkt meddelande ID'));
define('_ACA_VM_NEW_PRODUCT_TIPS', compa::encodeutf('Specificera ID numret av mail som du vill använda för att skicka ny produkt meddelande.'));

// since 1.0.8
// create forms for subscriptions
define('_ACA_FORM_BUTTON', compa::encodeutf('Skapa formulär'));
define('_ACA_FORM_COPY', compa::encodeutf('HTML kod'));
define('_ACA_FORM_COPY_TIPS', compa::encodeutf('Kopiera den generade HTML koden till din HTML sida.'));
define('_ACA_FORM_LIST_TIPS', compa::encodeutf('Välj listan som du vill inkludera i formläret'));
// update messages
define('_ACA_UPDATE_MESS4', compa::encodeutf('Det kan inte uppdateras automatiskt.'));
define('_ACA_WARNG_REMOTE_FILE', compa::encodeutf('Ingen möjlighet att komma åt den fjärranvända filen.'));
define('_ACA_ERROR_FETCH', compa::encodeutf('Fel vid hämtning av fil.'));

define('_ACA_CHECK', compa::encodeutf('Kolla'));
define('_ACA_MORE_INFO', compa::encodeutf('Mer info'));
define('_ACA_UPDATE_NEW', compa::encodeutf('Uppdatera till en nyare version'));
define('_ACA_UPGRADE', compa::encodeutf('Uppgradera till en högre produkt'));
define('_ACA_DOWNDATE', compa::encodeutf('Återgå till föregående version'));
define('_ACA_DOWNGRADE', compa::encodeutf('Tillbaka till standard produkten'));
define('_ACA_REQUIRE_JOOM', compa::encodeutf('Behöver Joomla'));
define('_ACA_TRY_IT', compa::encodeutf('Prova på!'));
define('_ACA_NEWER', compa::encodeutf('Nyare'));
define('_ACA_OLDER', compa::encodeutf('Äldre'));
define('_ACA_CURRENT', compa::encodeutf('Nuvarande'));

// since 1.0.9
define('_ACA_CHECK_COMP', compa::encodeutf('Prova någon annan komponent'));
define('_ACA_MENU_VIDEO', compa::encodeutf('Video undervisning'));
define('_ACA_AUTO_SCHEDULE', compa::encodeutf('Schema'));
define('_ACA_SCHEDULE_TITLE', compa::encodeutf('Automatiska schemafunktions inställningar'));
define('_ACA_ISSUE_NB_TIPS', compa::encodeutf('Utfärdar nummer generades automatiskt av systemet'));
define('_ACA_SEL_ALL', compa::encodeutf('Alla mail'));
define('_ACA_SEL_ALL_SUB', compa::encodeutf('Alla listor'));
define('_ACA_INTRO_ONLY_TIPS', compa::encodeutf('Om du markerar denna ruta så kommer endast introduktionen av artikeln att sättas in i mailet med en läs mer länk för att se hela artikeln på din sida.'));
define('_ACA_TAGS_TITLE', compa::encodeutf('Innehållstagg'));
define('_ACA_TAGS_TITLE_TIPS', compa::encodeutf('Kopiera och klistra denna tagg i ditt mail där du vill ha innehållet placerat.'));
define('_ACA_PREVIEW_EMAIL_TEST', compa::encodeutf('Markera emailadressen att skicka testet till'));
define('_ACA_PREVIEW_TITLE', compa::encodeutf('Förhandsgranska'));
define('_ACA_AUTO_UPDATE', compa::encodeutf('Nytt uppdaterings meddelande'));
define('_ACA_AUTO_UPDATE_TIPS', compa::encodeutf('Välj Ja om du vill bli meddelad vid nya uppdateringar för din komponent. <br />VIKTIGT!! Visa tips behöver vara på för att denna funktion ska fungera.'));

// since 1.1.0
define('_ACA_LICENSE', compa::encodeutf('Licens Information'));


// since 1.1.1
define('_ACA_NEW', compa::encodeutf('Ny'));
define('_ACA_SCHEDULE_SETUP', compa::encodeutf('För att autorespondrarna ska skickas så behöver du ställa in schemat i konfigurationen.'));
define('_ACA_SCHEDULER', compa::encodeutf('Schema'));
define('_ACA_ACAJOOM_CRON_DESC', compa::encodeutf('om du inte har tillgång till cron hanteraren på din hemsida, så kan du registrera dig för ett fritt Acajoom Cron konto hos:'));
define('_ACA_CRON_DOCUMENTATION', compa::encodeutf('Du kan hitta ytterliggare information om att ställa in Acajoom Schemat vid följande url:'));
define('_ACA_CRON_DOC_URL', compa::encodeutf('<a href="http://www.ijoobi.com/index.php?option=com_content&view=article&id=4249&catid=29&Itemid=72"
 target="_blank">http://www.ijoobi.com/index.php?option=com_content&Itemid=72&view=category&layout=blog&id=29&limit=60</a>'));
define( '_ACA_QUEUE_PROCESSED', compa::encodeutf('Kö behandling lyckades...'));
define( '_ACA_ERROR_MOVING_UPLOAD', compa::encodeutf('Fel vid flytt av importerad fil'));

//since 1.1.4
define( '_ACA_SCHEDULE_FREQUENCY', compa::encodeutf('Schema frekvens'));
define( '_ACA_CRON_MAX_FREQ', compa::encodeutf('Schemats maximala frekvens'));
define( '_ACA_CRON_MAX_FREQ_TIPS', compa::encodeutf('Specificera den maximala frekvensen som schemat kan köra ( i minuter ).  Detta kommer att begränsa schemat även om cron hanteraren är uppsatt mer frekvent.'));
define( '_ACA_CRON_MAX_EMAIL', compa::encodeutf('Maximala antalet mail per uppgift'));
define( '_ACA_CRON_MAX_EMAIL_TIPS', compa::encodeutf('Specificera det maximala antalet mail sända per uppgift (0 obegränsat).'));
define( '_ACA_CRON_MINUTES', compa::encodeutf(' minuter'));
define( '_ACA_SHOW_SIGNATURE', compa::encodeutf('Visa mailfooter'));
define( '_ACA_SHOW_SIGNATURE_TIPS', compa::encodeutf('Oavsett om du vill eller inte vill promota Acajoom i footern av dina mail.'));
define( '_ACA_QUEUE_AUTO_PROCESSED', compa::encodeutf('Auto-responder behandling lyckades...'));
define( '_ACA_QUEUE_NEWS_PROCESSED', compa::encodeutf('Schemalagd nyhetsbrevsbehandling lyckades...'));
define( '_ACA_MENU_SYNC_USERS', compa::encodeutf('Synkronisera Användare'));
define( '_ACA_SYNC_USERS_SUCCESS', compa::encodeutf('Användar Synkroniseringen Lyckades!'));

// compatibility with Joomla 15
if (!defined('_BUTTON_LOGOUT')) define( '_BUTTON_LOGOUT', compa::encodeutf('Logga Ut'));
if (!defined('_CMN_YES')) define( '_CMN_YES', compa::encodeutf('Ja'));
if (!defined('_CMN_NO')) define( '_CMN_NO', compa::encodeutf('Nej'));
if (!defined('_HI')) define( '_HI', compa::encodeutf('Hej'));
if (!defined('_CMN_TOP')) define( '_CMN_TOP', compa::encodeutf('Topp'));
if (!defined('_CMN_BOTTOM')) define( '_CMN_BOTTOM', compa::encodeutf('Botten'));
//if (!defined('_BUTTON_LOGOUT')) define( '_BUTTON_LOGOUT', compa::encodeutf('Logout'));

// For include title only or full article in content item tab in newsletter edit - p0stman911
define('_ACA_TITLE_ONLY_TIPS', compa::encodeutf('Om du väljer detta så kommer endast titeln i artikeln att sättas in i mailet som en länk till den kompletta artikeln på din sida.'));
define('_ACA_TITLE_ONLY', compa::encodeutf('Endast Titel'));
define('_ACA_FULL_ARTICLE_TIPS', compa::encodeutf('Om du väljer detta så kommer hela artiklen att sättas in i mailet'));
define('_ACA_FULL_ARTICLE', compa::encodeutf('Hel Artikel'));
define('_ACA_CONTENT_ITEM_SELECT_T', compa::encodeutf('Välj ett innehållsobjekt att visas i meddelandet. <br />Kopiera och klistra <b>innehålls taggen</b> i mailet.  Du kan välja att ha hela texten, endast intro, eller endast titel med (0, 1, eller 2 var för sig). '));
define('_ACA_SUBSCRIBE_LIST2', compa::encodeutf('Mail lista(or)'));

// smart-newsletter function
define('_ACA_AUTONEWS', compa::encodeutf('Smart-Nyhetsbrev'));
define('_ACA_MENU_AUTONEWS', compa::encodeutf('Smart-Nyhetsbrev'));
define('_ACA_AUTO_NEWS_OPTION', compa::encodeutf('Smart-Nyhetsbrevs val'));
define('_ACA_AUTONEWS_FREQ', compa::encodeutf('Nyhetsbrevs Frekvens'));
define('_ACA_AUTONEWS_FREQ_TIPS', compa::encodeutf('Specificera frekvensen som du vill skicka smart-nyhetsbrevet.'));
define('_ACA_AUTONEWS_SECTION', compa::encodeutf('Artikel Sektion'));
define('_ACA_AUTONEWS_SECTION_TIPS', compa::encodeutf('Specificera sektionen som du vill välja artiklar ifrån.'));
define('_ACA_AUTONEWS_CAT', compa::encodeutf('Artikel Kategori'));
define('_ACA_AUTONEWS_CAT_TIPS', compa::encodeutf('Specificera kategorin som du vill välja artiklar ifrån (Alla för alla artiklar i den sektionen).'));
define('_ACA_SELECT_SECTION', compa::encodeutf('Välj en sektion'));
define('_ACA_SELECT_CAT', compa::encodeutf('Alla Kategorier'));
define('_ACA_AUTO_DAY_CH8', compa::encodeutf('Kvartalsvis'));
define('_ACA_AUTONEWS_STARTDATE', compa::encodeutf('Start datum'));
define('_ACA_AUTONEWS_STARTDATE_TIPS', compa::encodeutf('Specificera datumet som du vill starta sändning av Smart Nyhetsbrev.'));
define('_ACA_AUTONEWS_TYPE', compa::encodeutf('Innehålls återgivning'));// how we see the content which is included in the newsletter
define('_ACA_AUTONEWS_TYPE_TIPS', compa::encodeutf('Hel Artikel: kommer att inkludera hela artikeln i nyhetsbrevet.<br />' .
		'Endast Intro: kommer endast att inkludera introduktionen av artikeln i nyhetsbrevet.<br/>' .
		'Endast Titel: kommer endast att inkludera titeln på artikeln i nyhetsbrevet.'));
define('_ACA_TAGS_AUTONEWS', compa::encodeutf('[SMARTNYHETSBREV] = Detta kommer att ersättas med Smart-nyhetsbrevet.'));

//since 1.1.3
define('_ACA_MALING_EDIT_VIEW', compa::encodeutf('Skapa / Visa Mail'));
define('_ACA_LICENSE_CONFIG', compa::encodeutf('Licens'));
define('_ACA_ENTER_LICENSE', compa::encodeutf('Fyll i licens'));
define('_ACA_ENTER_LICENSE_TIPS', compa::encodeutf('Fyll i ditt licensnummer och tryck på spara.'));
define('_ACA_LICENSE_SETTING', compa::encodeutf('Licensinställningar'));
define('_ACA_GOOD_LIC', compa::encodeutf('Din licens är giltig.'));
define('_ACA_NOTSO_GOOD_LIC', compa::encodeutf('Din licens är inte giltig: '));
define('_ACA_PLEASE_LIC', compa::encodeutf('Kontakta Acajoom support för att uppgradera din licens ( license@ijoobi.com ).'));

define('_ACA_DESC_PLUS', compa::encodeutf('Acajoom Plus är den första auto-responder sekvensen för Joomla CMS.  ' . _ACA_FEATURES));
define('_ACA_DESC_PRO', compa::encodeutf('Acajoom PRO är det ultimata mailsystemet för Joomla CMS.  ' . _ACA_FEATURES));

//since 1.1.4
define('_ACA_ENTER_TOKEN', compa::encodeutf('Fyll i bevis'));
define('_ACA_ENTER_TOKEN_TIPS', compa::encodeutf('Var vänlig och fyll i ditt bevisnummer som du mottog via mail när du köpte Acajoom. '));
define('_ACA_ACAJOOM_SITE', compa::encodeutf('Acajoom sidan:'));
define('_ACA_MY_SITE', compa::encodeutf('Min sida:'));
define( '_ACA_LICENSE_FORM', compa::encodeutf(' ' .
 		'Klicka här för att fortsätta till licensformuläret.</a>'));
define('_ACA_PLEASE_CLEAR_LICENSE', compa::encodeutf('Töm licensfältet och prova på nytt igen.<br />  Om problemet kvarstår, '));
define( '_ACA_LICENSE_SUPPORT', compa::encodeutf('Om du fortfarande har frågor, ' . _ACA_PLEASE_LIC));
define( '_ACA_LICENSE_TWO', compa::encodeutf('du kan få din licensmanual genom att fylla i bevisnumret och sidans URL (som är belyst i grönt i toppen av denna sida) i Licensformuläret. '
			. _ACA_LICENSE_FORM . '<br /><br/>' . _ACA_LICENSE_SUPPORT));
define('_ACA_ENTER_TOKEN_PATIENCE', compa::encodeutf('Efter att du sparat ditt bevis så kommer en licens att automatiskt genereras. ' .
		' Vanligtvis så är blir beviset validerat inom 2 minuter.  Men, i vissa fall så kan det ta upp till 15 minuter.<br />' .
		'<br />Återkom till denna kontrollpanel om ett par minuter.  <br /><br />' .
		'Om du inte mottagit en giltig licensnyckel inom 15 minuter, '. _ACA_LICENSE_TWO));
define( '_ACA_ENTER_NOT_YET', compa::encodeutf('Ditt bevis har ännu inte blivit validerat.'));
define( '_ACA_UPDATE_CLICK_HERE', compa::encodeutf('Besök <a href="http://www.ijoobi.com" target="_blank">www.ijoobi.com</a> för att ladda ner den senaste versionen.'));
define( '_ACA_NOTIF_UPDATE', compa::encodeutf('För att bli meddelad om nya uppdateringar skriv in din emailadress och klicka på prenumerera '));

define('_ACA_THINK_PLUS', compa::encodeutf('Om du vill få ut mer av mailsystemet tänk då på Plus!'));
define('_ACA_THINK_PLUS_1', compa::encodeutf('Auto-responder Sekvens'));
define('_ACA_THINK_PLUS_2', compa::encodeutf('Schemalägg leveransen av ditt nyhetsbrev med ett fördefinerat datum'));
define('_ACA_THINK_PLUS_3', compa::encodeutf('Ingen mer serverbegränsning'));
define('_ACA_THINK_PLUS_4', compa::encodeutf('och mycket mer...'));


//since 1.2.2
define( '_ACA_LIST_ACCESS', compa::encodeutf('List Åtkomst'));
define( '_ACA_INFO_LIST_ACCESS', compa::encodeutf('Specificera vilken grupp av användare som kan se och prenumerera på denna lista'));
define( 'ACA_NO_LIST_PERM', compa::encodeutf('Du har inte tillräcklig behörighet för att prenumerera på denna lista'));

//Archive Configuration
 define('_ACA_MENU_TAB_ARCHIVE', compa::encodeutf('Arkivera'));
 define('_ACA_MENU_ARCHIVE_ALL', compa::encodeutf('Arkivera Alla'));

//Archive Lists
 define('_FREQ_OPT_0', compa::encodeutf('Inga'));
 define('_FREQ_OPT_1', compa::encodeutf('Varje Vecka'));
 define('_FREQ_OPT_2', compa::encodeutf('Varannan Vecka'));
 define('_FREQ_OPT_3', compa::encodeutf('Varje Månad'));
 define('_FREQ_OPT_4', compa::encodeutf('Varje Kvartal'));
 define('_FREQ_OPT_5', compa::encodeutf('Varje År'));
 define('_FREQ_OPT_6', compa::encodeutf('Annat'));

define('_DATE_OPT_1', compa::encodeutf('Skapar datum'));
define('_DATE_OPT_2', compa::encodeutf('Ändrings datum'));

define('_ACA_ARCHIVE_TITLE', compa::encodeutf('Ställer in auto-arkiv frekvensen'));
define('_ACA_FREQ_TITLE', compa::encodeutf('Arkiv frekvens'));
define('_ACA_FREQ_TOOL', compa::encodeutf('Definera hur ofta som du vill att Arkiv Hanteraren ska arkivera din hemsidas innehåll.'));
define('_ACA_NB_DAYS', compa::encodeutf('Antal dagar'));
define('_ACA_NB_DAYS_TOOL', compa::encodeutf('Detta är endast för Annat alternativet! Specificera antalet dagar mellan varje arkivering.'));
define('_ACA_DATE_TITLE', compa::encodeutf('Datumtyp'));
define('_ACA_DATE_TOOL', compa::encodeutf('Definera om arkiveringen ska ske vis skapardatumet eller vid ändringsdatumet.'));

define('_ACA_MAINTENANCE_TAB', compa::encodeutf('Underhållsinställningar'));
define('_ACA_MAINTENANCE_FREQ', compa::encodeutf('Underhållsfrekvens'));
define( '_ACA_MAINTENANCE_FREQ_TIPS', compa::encodeutf('Specificera frekvensen som du vill att underhållsrutinen ska köras.'));
define( '_ACA_CRON_DAYS', compa::encodeutf('timme(ar)'));

define( '_ACA_LIST_NOT_AVAIL', compa::encodeutf('Det finns ingen lista tillgänglig.'));
define( '_ACA_LIST_ADD_TAB', compa::encodeutf('Skapa/Redigera'));

define( '_ACA_LIST_ACCESS_EDIT', compa::encodeutf('Mail Skapa/Redigera Åtkomst'));
define( '_ACA_INFO_LIST_ACCESS_EDIT', compa::encodeutf('Specificera vilken grupp av användare som kan redigera nya mail för denna lista'));
define( '_ACA_MAILING_NEW_FRONT', compa::encodeutf('Skapa en Ny Mail'));

define('_ACA_AUTO_ARCHIVE', compa::encodeutf('Auto-Arkiv'));
define('_ACA_MENU_ARCHIVE', compa::encodeutf('Auto-Arkiv'));

//Extra tags:
define('_ACA_TAGS_ISSUE_NB', compa::encodeutf('[ISSUENB] = Detta kommer att ersättas av utgåvonumret på nyhetsbrevet.'));
define('_ACA_TAGS_DATE', compa::encodeutf('[DATE] = Detta kommer att ersättas av sändningsdatum.'));
define('_ACA_TAGS_CB', compa::encodeutf('[CBTAG:{field_name}] = Detta kommer att ersättas av värdet som kommer från Community Builder fältet: ex. [CBTAG:firstname] '));
define( '_ACA_MAINTENANCE', compa::encodeutf('Joobi Care'));


define('_ACA_THINK_PRO', compa::encodeutf('När du har professionella önskemål, så använder du professionella komponenter!'));
define('_ACA_THINK_PRO_1', compa::encodeutf('Smart-Nyhetsbrev'));
define('_ACA_THINK_PRO_2', compa::encodeutf('Definera åtkomstnivå för din lista'));
define('_ACA_THINK_PRO_3', compa::encodeutf('Definera vem som kan redigera/skapa mail'));
define('_ACA_THINK_PRO_4', compa::encodeutf('Mera taggar: skapa ditt CB fält'));
define('_ACA_THINK_PRO_5', compa::encodeutf('Joomla innehålls Auto-arkiv'));
define('_ACA_THINK_PRO_6', compa::encodeutf('Databasoptimering'));

define('_ACA_LIC_NOT_YET', compa::encodeutf('Din licens är ännu inte giltig.  Var vänlig och undersök licensfliken i konfigurationspanelen.'));
define('_ACA_PLEASE_LIC_GREEN', compa::encodeutf('Var noga med att ange den gröna informationen vid toppen av fliken till vårat supportteam.'));

define('_ACA_FOLLOW_LINK', compa::encodeutf('Skaffa Din Licens'));
define( '_ACA_FOLLOW_LINK_TWO', compa::encodeutf('Du kan få din licens genom att fylla i bevisnumret och sidans URL (som belyses med grönt i toppen på denna sida) i Licensformuläret. '));
define( '_ACA_ENTER_TOKEN_TIPS2', compa::encodeutf(' Klicka sedan på Lägg till knappen i den övre högra menyn.'));
define( '_ACA_ENTER_LIC_NB', compa::encodeutf('Fyll i Din Licens'));
define( '_ACA_UPGRADE_LICENSE', compa::encodeutf('Uppgradera Din Licens'));
define( '_ACA_UPGRADE_LICENSE_TIPS', compa::encodeutf('Om du mottagit ett bevis för uppgradering av din licens var då vänlig och fyll i den här, klicka på Lägg till och fortsätt till nummer <b>2</b> för att få ditt nya licensnummer.'));

define( '_ACA_MAIL_FORMAT', compa::encodeutf('Kodformat'));
define( '_ACA_MAIL_FORMAT_TIPS', compa::encodeutf('Vilket format vill du använda för att koda dina mail, Endast text eller MIME'));
define( '_ACA_ACAJOOM_CRON_DESC_ALT', compa::encodeutf('Om du inte har tillgång till en cronjobbs hanteraren på din hemsida, så kan du använda den Fria jCron komponenten för att skapa ett cron jobb från din hemsida.'));

//since 1.3.1
define('_ACA_SHOW_AUTHOR', compa::encodeutf('Visa Författarens Namn'));
define('_ACA_SHOW_AUTHOR_TIPS', compa::encodeutf('Välj Ja om du vill infoga författarens namn när du lägger till en artikel till Mailen'));

//since 1.3.5
define('_ACA_REGWARN_NAME', compa::encodeutf('Ange ditt namn.'));
define('_ACA_REGWARN_MAIL', compa::encodeutf('Ange en giltig e-postadress.'));

//since 1.5.6
define('_ACA_ADDEMAILREDLINK_TIPS', compa::encodeutf('Om du väljer Ja, så kommer e-postmeddelandet av användaren att infogas som en parameter i slutet av din omdirigerade URL (den omdirigerade länken till din modul eller till ett externt Acajoom formulär).<br/>Det kan vara användbart om du vill köra ett speciellt skript i din omdirigerade sida.'));
define('_ACA_ADDEMAILREDLINK', compa::encodeutf('Infoga e-post till den omdirigerade länken'));

//since 1.6.3
define('_ACA_ITEMID', compa::encodeutf('ObjektId'));
define('_ACA_ITEMID_TIPS', compa::encodeutf('Detta ObjektId kommer att infogas till dina Acajoom länkar.'));

//since 1.6.5
define('_ACA_SHOW_JCALPRO', compa::encodeutf('jCalPRO'));
define('_ACA_SHOW_JCALPRO_TIPS', compa::encodeutf('Visa integrerings tabb för jCalPRO <br/>(endast om jCalPRO är installerad på din hemsida!)'));
define('_ACA_JCALTAGS_TITLE', compa::encodeutf('jCalPRO Tagg:'));
define('_ACA_JCALTAGS_TITLE_TIPS', compa::encodeutf('Kopiera och klistra in denna tagg i mailet mailing där du vill ha händelsen placerad.'));
define('_ACA_JCALTAGS_DESC', compa::encodeutf('Beskrivning:'));
define('_ACA_JCALTAGS_DESC_TIPS', compa::encodeutf('Välj Ja om du vill infoga beskrivning på händelsen'));
define('_ACA_JCALTAGS_START', compa::encodeutf('Start datum:'));
define('_ACA_JCALTAGS_START_TIPS', compa::encodeutf('Välj Ja om du vill infoga ett startdatum på händelsen'));
define('_ACA_JCALTAGS_READMORE', compa::encodeutf('Läs mer:'));
define('_ACA_JCALTAGS_READMORE_TIPS', compa::encodeutf('Välj Ja om du vill infoga en <b>läs mer länk</b> för denna händelse'));
define('_ACA_REDIRECTCONFIRMATION', compa::encodeutf('Omdirigera URL'));
define('_ACA_REDIRECTCONFIRMATION_TIPS', compa::encodeutf('Om du kräver ett bekräftelse e-postmeddelande, så kommer användaren att bli bekräftat och omdirigerad till denna URL om han/hon klickar på bekräftelselänken.'));

//since 2.0.0 compatibility with Joomla 1.5
if(!defined('_CMN_SAVE') and defined('CMN_SAVE')) define('_CMN_SAVE',CMN_SAVE);
if(!defined('_CMN_SAVE')) define('_CMN_SAVE','para');
if(!defined('_NO_ACCOUNT')) define('_NO_ACCOUNT','Inget konto ännu?');
if(!defined('_CREATE_ACCOUNT')) define('_CREATE_ACCOUNT','Registrera');
if(!defined('_NOT_AUTH')) define('_NOT_AUTH','Du har inte tillåtelse att se på den här källan.');

//since 3.0.0
define('_ACA_DISABLETOOLTIP','Disable Tooltip');
define('_ACA_DISABLETOOLTIP_TIPS', 'Disable the tooltip on the frontend');
define('_ACA_MINISENDMAIL', 'Use Mini SendMail');
define('_ACA_MINISENDMAIL_TIPS', 'If your server uses Mini SendMail, select this option to do not add the name of the user in the header of the e-mail');

//Since 3.1.5
define('_ACA_READMORE','Read more...');
define('_ACA_VIEWARCHIVE','Click here');