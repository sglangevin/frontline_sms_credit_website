<?php
defined('_JEXEC') OR defined('_VALID_MOS') OR die('...Direct Access to this location is not allowed...');


/**
* <p>Danish language file.</p>
* @copyright (c) 2006 Acajoom Services / All Rights Reserved
* @author Joergen Floes<support@ijoobi.com>
* @version $Id: danish.php 491 2007-02-01 22:56:07Z divivo $
* @link http://www.ijoobi.com
*/

### General ###
 //acajoom Description
define('_ACA_DESC_NEWS', compa::encodeutf('Acajoom er forsendelseslister, nyhedsbreve, auto-svar funktion, og opfølgningsværktøj til effektiv kommunikation med dine brugere og kunder.  ' .
		'Acajoom, Din kommunikationspartner!'));
define('_ACA_FEATURES', compa::encodeutf('Acajoom, din kommunikationspartner!'));

// Type of lists
define('_ACA_NEWSLETTER', compa::encodeutf('Nyhedsbrev'));
define('_ACA_AUTORESP', compa::encodeutf('Auto-svar'));
define('_ACA_AUTORSS', compa::encodeutf('Auto-RSS'));
define('_ACA_ECARD', compa::encodeutf('eKort'));
define('_ACA_POSTCARD', compa::encodeutf('Postkort'));
define('_ACA_PERF', compa::encodeutf('Performance'));
define('_ACA_COUPON', compa::encodeutf('Kupon'));
define('_ACA_CRON', compa::encodeutf('Cron opgave'));
define('_ACA_MAILING', compa::encodeutf('Forsendelse'));
define('_ACA_LIST', compa::encodeutf('Liste'));

 //acajoom Menu
define('_ACA_MENU_LIST', compa::encodeutf('Administration af lister'));
define('_ACA_MENU_SUBSCRIBERS', compa::encodeutf('Abonnenter'));
define('_ACA_MENU_NEWSLETTERS', compa::encodeutf('Nyhedsbreve'));
define('_ACA_MENU_AUTOS', compa::encodeutf('Auto-svar'));
define('_ACA_MENU_COUPONS', compa::encodeutf('Kuponer'));
define('_ACA_MENU_CRONS', compa::encodeutf('Cron opgaver'));
define('_ACA_MENU_AUTORSS', compa::encodeutf('Auto-RSS'));
define('_ACA_MENU_ECARD', compa::encodeutf('eKort'));
define('_ACA_MENU_POSTCARDS', compa::encodeutf('Postkort'));
define('_ACA_MENU_PERFS', compa::encodeutf('Performances'));
define('_ACA_MENU_TAB_LIST', compa::encodeutf('Lister'));
define('_ACA_MENU_MAILING_TITLE', compa::encodeutf('Forsendelser'));
define('_ACA_MENU_MAILING', compa::encodeutf('Forsendelse af '));
define('_ACA_MENU_STATS', compa::encodeutf('Statistik'));
define('_ACA_MENU_STATS_FOR', compa::encodeutf('Statistik for '));
define('_ACA_MENU_CONF', compa::encodeutf('Konfiguration'));
define('_ACA_MENU_UPDATE', compa::encodeutf('Import'));
define('_ACA_MENU_ABOUT', compa::encodeutf('Om'));
define('_ACA_MENU_LEARN', compa::encodeutf('Uddannelsescenter'));
define('_ACA_MENU_MEDIA', compa::encodeutf('Media administration'));
define('_ACA_MENU_HELP', compa::encodeutf('Hjælp'));
define('_ACA_MENU_CPANEL', compa::encodeutf('CPanel'));
define('_ACA_MENU_IMPORT', compa::encodeutf('Import'));
define('_ACA_MENU_EXPORT', compa::encodeutf('Export'));
define('_ACA_MENU_SUB_ALL', compa::encodeutf('Abonner på alle'));
define('_ACA_MENU_UNSUB_ALL', compa::encodeutf('Afmeld alle'));
define('_ACA_MENU_VIEW_ARCHIVE', compa::encodeutf('Arkiv'));
define('_ACA_MENU_PREVIEW', compa::encodeutf('Preview'));
define('_ACA_MENU_SEND', compa::encodeutf('Send'));
define('_ACA_MENU_SEND_TEST', compa::encodeutf('Send Test Email'));
define('_ACA_MENU_SEND_QUEUE', compa::encodeutf('Process kø'));
define('_ACA_MENU_VIEW', compa::encodeutf('Se'));
define('_ACA_MENU_COPY', compa::encodeutf('Kopier'));
define('_ACA_MENU_VIEW_STATS', compa::encodeutf('Se statistik'));
define('_ACA_MENU_CRTL_PANEL', compa::encodeutf(' CPanel'));
define('_ACA_MENU_LIST_NEW', compa::encodeutf(' Opret en liste'));
define('_ACA_MENU_LIST_EDIT', compa::encodeutf(' Ret en liste'));
define('_ACA_MENU_BACK', compa::encodeutf('Tilbage'));
define('_ACA_MENU_INSTALL', compa::encodeutf('Installation'));
define('_ACA_MENU_TAB_SUM', compa::encodeutf('Opsummering'));
define('_ACA_STATUS', compa::encodeutf('Status'));

// messages
define('_ACA_ERROR', compa::encodeutf(' Der opstod en fejl! '));
define('_ACA_SUB_ACCESS', compa::encodeutf('Adgangsrettigheder'));
define('_ACA_DESC_CREDITS', compa::encodeutf('Credits'));
define('_ACA_DESC_INFO', compa::encodeutf('Information'));
define('_ACA_DESC_HOME', compa::encodeutf('Hjemmeside'));
define('_ACA_DESC_MAILING', compa::encodeutf('Forsendelsesliste'));
define('_ACA_DESC_SUBSCRIBERS', compa::encodeutf('Modtagere'));
define('_ACA_PUBLISHED', compa::encodeutf('Udgivet'));
define('_ACA_UNPUBLISHED', compa::encodeutf('U-udgivet'));
define('_ACA_DELETE', compa::encodeutf('Slet'));
define('_ACA_FILTER', compa::encodeutf('Filtrer'));
define('_ACA_UPDATE', compa::encodeutf('Opdater'));
define('_ACA_SAVE', compa::encodeutf('Gem'));
define('_ACA_CANCEL', compa::encodeutf('Slet'));
define('_ACA_NAME', compa::encodeutf('Navn'));
define('_ACA_EMAIL', compa::encodeutf('E-mail'));
define('_ACA_SELECT', compa::encodeutf('Vælg'));
define('_ACA_ALL', compa::encodeutf('alle'));
define('_ACA_SEND_A', compa::encodeutf('Send en '));
define('_ACA_SUCCESS_DELETED', compa::encodeutf(' succesfuldt slettet'));
define('_ACA_LIST_ADDED', compa::encodeutf('Liste succesfuldt oprettet'));
define('_ACA_LIST_COPY', compa::encodeutf('Liste succesfuldt kopieret'));
define('_ACA_LIST_UPDATED', compa::encodeutf('List succesfuldt opdateret'));
define('_ACA_MAILING_SAVED', compa::encodeutf('Forsendelse succesfuldt gemt.'));
define('_ACA_UPDATED_SUCCESSFULLY', compa::encodeutf('succesfuldt opdateret.'));

### Subscribers information ###
//subscribe and unsubscribe info
define('_ACA_SUB_INFO', compa::encodeutf('Abonnentens information'));
define('_ACA_VERIFY_INFO', compa::encodeutf('Verificer det link du angav, der mangler noget information.'));
define('_ACA_INPUT_NAME', compa::encodeutf('Navn'));
define('_ACA_INPUT_EMAIL', compa::encodeutf('Email'));
define('_ACA_RECEIVE_HTML', compa::encodeutf('Modtag HTML?'));
define('_ACA_TIME_ZONE', compa::encodeutf('Tidszone'));
define('_ACA_BLACK_LIST', compa::encodeutf('Spær bruger'));
define('_ACA_REGISTRATION_DATE', compa::encodeutf('Bruger registreringsdato'));
define('_ACA_USER_ID', compa::encodeutf('Bruger id'));
define('_ACA_DESCRIPTION', compa::encodeutf('Beskrivelse'));
define('_ACA_ACCOUNT_CONFIRMED', compa::encodeutf('Din konto er blevet aktiveret.'));
define('_ACA_SUB_SUBSCRIBER', compa::encodeutf('Abonnent'));
define('_ACA_SUB_PUBLISHER', compa::encodeutf('Udgiver'));
define('_ACA_SUB_ADMIN', compa::encodeutf('Administrator'));
define('_ACA_REGISTERED', compa::encodeutf('Registreret'));
define('_ACA_SUBSCRIPTIONS', compa::encodeutf('Dit abonnement'));
define('_ACA_SEND_UNSUBCRIBE', compa::encodeutf('Send afmeldingsmeddelelse'));
define('_ACA_SEND_UNSUBCRIBE_TIPS', compa::encodeutf('Klik Ja for at sende en afmeld email meddelelse.'));
define('_ACA_SUBSCRIBE_SUBJECT_MESS', compa::encodeutf('Venligst bekræft dit abonnement'));
define('_ACA_UNSUBSCRIBE_SUBJECT_MESS', compa::encodeutf('Afmeldingsbekræftelse'));
define('_ACA_DEFAULT_SUBSCRIBE_MESS', compa::encodeutf('Hej [NAME],<br />' .
		'Bare et trin mere og du vil blive abonnent af listen.  Venligst klik på det følgende likn for at bekræftige dine abonnementer.' .
		'<br /><br />[CONFIRM]<br /><br />Hvis der er spørgsmål så kontakt webmasteren.'));
define('_ACA_DEFAULT_UNSUBSCRIBE_MESS', compa::encodeutf('Denne email bekræftiger at du er blevet afmeldt fra vores liste.  Vi beklager at du besluttede at afmelde men skulle du beslutte at gentilmelde kan du altid gøre det på vore webside.  Skulle du have nogen spørgsmål da kontakt venligst vores webmaster.'));

// Acajoom subscribers
define('_ACA_SIGNUP_DATE', compa::encodeutf('Tilmeldingsdato'));
define('_ACA_CONFIRMED', compa::encodeutf('Bekræfted'));
define('_ACA_SUBSCRIB', compa::encodeutf('Abonner'));
define('_ACA_HTML', compa::encodeutf('HTML udsendelser'));
define('_ACA_RESULTS', compa::encodeutf('Resultater'));
define('_ACA_SEL_LIST', compa::encodeutf('Vælg en liste'));
define('_ACA_SEL_LIST_TYPE', compa::encodeutf('- Vælg typen af listen -'));
define('_ACA_SUSCRIB_LIST', compa::encodeutf('Liste over alle abonnenter'));
define('_ACA_SUSCRIB_LIST_UNIQUE', compa::encodeutf('abonnenter af : '));
define('_ACA_NO_SUSCRIBERS', compa::encodeutf('Ingen abonnenter fundet til denne liste.'));
define('_ACA_COMFIRM_SUBSCRIPTION', compa::encodeutf('En bekræftelses email er blevet sendt til dig.  Venligst check din email og klik på det angivne link.<br />' .
		'Du skal bekræfte din email for at dit abonnement træder i kraft.'));
define('_ACA_SUCCESS_ADD_LIST', compa::encodeutf('Du er succesfuldt blevet tilføjet til listen.'));


 // Subcription info
define('_ACA_CONFIRM_LINK', compa::encodeutf('Klik her for at bekræfte dit abonnement'));
define('_ACA_UNSUBSCRIBE_LINK', compa::encodeutf('Klik her for at afmelde dig selv fra listen'));
define('_ACA_UNSUBSCRIBE_MESS', compa::encodeutf('Din email adresse er blevet afmeldt fra listen'));

define('_ACA_QUEUE_SENT_SUCCESS', compa::encodeutf('Alle planlagte forsendelser er blevet succesfuldt udsendt.'));
define('_ACA_MALING_VIEW', compa::encodeutf('Se alle forsendelser'));
define('_ACA_UNSUBSCRIBE_MESSAGE', compa::encodeutf('Er du sikker på at du vil afmeldes fra denne liste?'));
define('_ACA_MOD_SUBSCRIBE', compa::encodeutf('Abonner'));
define('_ACA_SUBSCRIBE', compa::encodeutf('Abonner'));
define('_ACA_UNSUBSCRIBE', compa::encodeutf('Afmeld'));
define('_ACA_VIEW_ARCHIVE', compa::encodeutf('Se arkivet'));
define('_ACA_SUBSCRIPTION_OR', compa::encodeutf(' eller klik her for at opdatere dine informationer'));
define('_ACA_EMAIL_ALREADY_REGISTERED', compa::encodeutf('Denne email adresse er allerede blevet registreret.'));
define('_ACA_SUBSCRIBER_DELETED', compa::encodeutf('Abonnent succesfuldt slettet.'));


### UserPanel ###
 //User Menu
define('_UCP_USER_PANEL', compa::encodeutf('Bruger kontrolpanel'));
define('_UCP_USER_MENU', compa::encodeutf('Bruger menu'));
define('_UCP_USER_CONTACT', compa::encodeutf('Mine abonnementer'));
 //Acajoom Cron Menu
define('_UCP_CRON_MENU', compa::encodeutf('Cron opgave administration'));
define('_UCP_CRON_NEW_MENU', compa::encodeutf('Ny Cron'));
define('_UCP_CRON_LIST_MENU', compa::encodeutf('List mine Cron'));
 //Acajoom Coupon Menu
define('_UCP_COUPON_MENU', compa::encodeutf('Kupon administration'));
define('_UCP_COUPON_LIST_MENU', compa::encodeutf('Liste over kuponner'));
define('_UCP_COUPON_ADD_MENU', compa::encodeutf('Tilføj en kupon'));

### lists ###
// Tabs
define('_ACA_LIST_T_GENERAL', compa::encodeutf('Beskrivelse'));
define('_ACA_LIST_T_LAYOUT', compa::encodeutf('Layout'));
define('_ACA_LIST_T_SUBSCRIPTION', compa::encodeutf('Abonnement'));
define('_ACA_LIST_T_SENDER', compa::encodeutf('Afsender information'));

define('_ACA_LIST_TYPE', compa::encodeutf('Liste type'));
define('_ACA_LIST_NAME', compa::encodeutf('Liste navn'));
define('_ACA_LIST_ISSUE', compa::encodeutf('Hændelse #'));
define('_ACA_LIST_DATE', compa::encodeutf('Sendt dato'));
define('_ACA_LIST_SUB', compa::encodeutf('Forsendelsens emne'));
define('_ACA_ATTACHED_FILES', compa::encodeutf('Vedhæftede filer'));
define('_ACA_SELECT_LIST', compa::encodeutf('Vælg en liste der skal rettes!'));

// Auto Responder box
define('_ACA_AUTORESP_ON', compa::encodeutf('Typen af listen'));
define('_ACA_AUTO_RESP_OPTION', compa::encodeutf('Auto-svar muligheder'));
define('_ACA_AUTO_RESP_FREQ', compa::encodeutf('Abonnenterne kan vælge frekvensen'));
define('_ACA_AUTO_DELAY', compa::encodeutf('Forsinkelse (i dage)'));
define('_ACA_AUTO_DAY_MIN', compa::encodeutf('Minimum frekvens'));
define('_ACA_AUTO_DAY_MAX', compa::encodeutf('Maximum frekvens'));
define('_ACA_FOLLOW_UP', compa::encodeutf('Angiv opfølgende auto-svar'));
define('_ACA_AUTO_RESP_TIME', compa::encodeutf('Abonnenter kan bestemme tidspunkt'));
define('_ACA_LIST_SENDER', compa::encodeutf('Liste afsendere'));

define('_ACA_LIST_DESC', compa::encodeutf('Liste beskrivelser'));
define('_ACA_LAYOUT', compa::encodeutf('Layout'));
define('_ACA_SENDER_NAME', compa::encodeutf('Afsender navn'));
define('_ACA_SENDER_EMAIL', compa::encodeutf('Afsender email'));
define('_ACA_SENDER_BOUNCE', compa::encodeutf('Afsenderens svar adresse'));
define('_ACA_LIST_DELAY', compa::encodeutf('Forsinkelse'));
define('_ACA_HTML_MAILING', compa::encodeutf('HTML forsendelse?'));
define('_ACA_HTML_MAILING_DESC', compa::encodeutf('(hvis du ændrer dette, skal du gemme og komme tilbage til dette skærmbillede for at se ændringerne.)'));
define('_ACA_HIDE_FROM_FRONTEND', compa::encodeutf('Skjul fra front-end?'));
define('_ACA_SELECT_IMPORT_FILE', compa::encodeutf('Vælg en fil der skal importeres'));;
define('_ACA_IMPORT_FINISHED', compa::encodeutf('Import afsluttet'));
define('_ACA_DELETION_OFFILE', compa::encodeutf('Sletning af fil'));
define('_ACA_MANUALLY_DELETE', compa::encodeutf('fejlede, du skal slette filen manuelt'));
define('_ACA_CANNOT_WRITE_DIR', compa::encodeutf('Kan ikke skrive i biblioteket'));
define('_ACA_NOT_PUBLISHED', compa::encodeutf('Kunne ikke sende forsendelsen, listen er ikke udgivet.'));

//  List info box
define('_ACA_INFO_LIST_PUB', compa::encodeutf('Klik Ja for at udgive listen'));
define('_ACA_INFO_LIST_NAME', compa::encodeutf('Skriv navnet på din liste her. Du kan identificere listen med dette navn.'));
define('_ACA_INFO_LIST_DESC', compa::encodeutf('Indtast en kort beskrivelse af din liste her. Denne beskrivelse vil være synlig for gæster på din webside.'));
define('_ACA_INFO_LIST_SENDER_NAME', compa::encodeutf('Indtast navnet på afsenderen af brevet. Dette navn vil være synligt når abonnenterne modtager meddelelser fra denne liste.'));
define('_ACA_INFO_LIST_SENDER_EMAIL', compa::encodeutf('Skriv den email adresse som meddelelsen skal sendes fra.'));
define('_ACA_INFO_LIST_SENDER_BOUNCED', compa::encodeutf('Skriv den email adresse hvor bruger kan svare til. Det anbefales at det er den samme som afsenderen af emailen, da spam filtere vil give din meddelelse en højere spam ranking hvis de er forskellige.'));
define('_ACA_INFO_LIST_AUTORESP', compa::encodeutf('Vælg typen af forsendelser på denne liste. <br />' .
		'Nyhedsbrev: normalt nyhedsbrev<br />' .
		'Auto-svar: en auto-svar er en liste som sendes automatisk gennnem websiden på en fast interval.'));
define('_ACA_INFO_LIST_FREQUENCY', compa::encodeutf('Tillad brugerne at vælge hvor ofte de vil modtage fra listen.  Det giver mere fleksibilitet for brugeren.'));
define('_ACA_INFO_LIST_TIME', compa::encodeutf('Lad brugeren vælge deres foretrukne tid på dagen for at modtage denne liste.'));
define('_ACA_INFO_LIST_MIN_DAY', compa::encodeutf('Definer hvad der er den mindste frekvens en bruger kan vælge at modtage fra listen'));
define('_ACA_INFO_LIST_DELAY', compa::encodeutf('Angiv en forsinkelse mellem denne auto-svar og den forrige.'));
define('_ACA_INFO_LIST_DATE', compa::encodeutf('Angiv datoen hvor nyhedslisten skal udgives, hvis du vil forsinke udgivelsen. <br /> FORMAT : YYYY-MM-DD HH:MM:SS'));
define('_ACA_INFO_LIST_MAX_DAY', compa::encodeutf('Definer hvad der er den maksimale frekvens en bruger kan vælge at modtage fra listen'));
define('_ACA_INFO_LIST_LAYOUT', compa::encodeutf('Angiv layout for din forsendelseliste her. Du kan angive et hvilket som helst layout for din forsendelse her.'));
define('_ACA_INFO_LIST_SUB_MESS', compa::encodeutf('Denne meddelelse vil blive sendt til abonnenten når han eller hun registreres første gang. Du kan skrive lige den tekst du vil have her.'));
define('_ACA_INFO_LIST_UNSUB_MESS', compa::encodeutf('Denne meddelelse vil blive sendt til abonnenten når han eller hun afmelder. En hvilken som helst tekst kan indtastes her.'));
define('_ACA_INFO_LIST_HTML', compa::encodeutf('Vælg afkrydsningsboxen hvis du ønsker at sende en HTML udsendelse. Abonnenter vil have mulighed for at angive hvis de ønsker at modtage HTML meddelelsen HTML, eller kun tekst meddelelsen når de abonnerer på en HTML liste.'));
define('_ACA_INFO_LIST_HIDDEN', compa::encodeutf('Klik Ja for at skjule listen fra front-end, brugerne vil ikke have mulighed for at abonnere men du vil stadig have mulighed for at sende udsendelsen.'));
define('_ACA_INFO_LIST_ACA_AUTO_SUB', compa::encodeutf('Vil du have at brugerne automatisk tilmeldes til denne liste?<br /><B>Nye brugere:</B> vil registrere alle nye brugere der registrer sig på websiden.<br /><B>Alle brugere:</B> vil registre alle brugere der er registreret i databasen.<br />(alle disse funktioner understøtter Community Builder)'));
define('_ACA_INFO_LIST_ACC_LEVEL', compa::encodeutf('Vælg front-end adgangsniveauet. Dette vil vise elle skjule udsendelsen for brugergrupper der ikke har adgang til den, så de ikke har mulighed for at abonnere på den.'));
define('_ACA_INFO_LIST_ACC_USER_ID', compa::encodeutf('Vælg adgangsniveauet for den brugergruppe du ønsker skal kunne rette. Denne brugegruppe og overliggende vil kunne rette forsendelserne og sende dem ud, enten fra front-end eller back-end.'));
define('_ACA_INFO_LIST_FOLLOW_UP', compa::encodeutf('Hvis du ønsker at auto-svaret skal flytte til en anden når den når til den sidste meddelelse kan du angive den efterfølgnede auto-svar her.'));
define('_ACA_INFO_LIST_ACA_OWNER', compa::encodeutf('Dette er ID\'et for den person som oprettede listen.'));
define('_ACA_INFO_LIST_WARNING', compa::encodeutf('   Denne sidste mulighed er kun tilgængelig en gang når listen oprettes.'));
define('_ACA_INFO_LIST_SUBJET', compa::encodeutf(' Emnet for brevet.  Dette er emnet på den email som abonnenten vil modtage.'));
define('_ACA_INFO_MAILING_CONTENT', compa::encodeutf('Det er hoveddelen af den email du ønsker at sende.'));
define('_ACA_INFO_MAILING_NOHTML', compa::encodeutf('Indtast hoveddelen af den email du ønsker at sende til abonnenter der vælger kun at modtage ikke-HTML forsendelser. <BR/> NOTE: hvis du lader den være blank vil Acajoom automatisk konvertere HTML teksten til ren tekst.'));
define('_ACA_INFO_MAILING_VISIBLE', compa::encodeutf('Klik Ja for at vise forsendelsen i front-end.'));
define('_ACA_INSERT_CONTENT', compa::encodeutf('Indsæt eksisterende indhold'));

// Coupons
define('_ACA_SEND_COUPON_SUCCESS', compa::encodeutf('Kupon sendt succesfuldt!'));
define('_ACA_CHOOSE_COUPON', compa::encodeutf('Vælg en kupon'));
define('_ACA_TO_USER', compa::encodeutf(' til denne bruger'));

### Cron options
//drop down frequency(CRON)
define('_ACA_FREQ_CH1', compa::encodeutf('Hver time'));
define('_ACA_FREQ_CH2', compa::encodeutf('Hver 6 time'));
define('_ACA_FREQ_CH3', compa::encodeutf('Hver 12 time'));
define('_ACA_FREQ_CH4', compa::encodeutf('Dagligt'));
define('_ACA_FREQ_CH5', compa::encodeutf('Ugentligt'));
define('_ACA_FREQ_CH6', compa::encodeutf('Månedslig'));
define('_ACA_FREQ_NONE', compa::encodeutf('Ingen'));
define('_ACA_FREQ_NEW', compa::encodeutf('Nye brugere'));
define('_ACA_FREQ_ALL', compa::encodeutf('Alle brugere'));

//Label CRON form
define('_ACA_LABEL_FREQ', compa::encodeutf('Acajoom Cron?'));
define('_ACA_LABEL_FREQ_TIPS', compa::encodeutf('Klik Ja hvis du ønsker at bruge denne til en Acajomm Cron, Nej for en anden cron opgave.<br />' .
		'Hvis du klikker Ja behøver du ikke angive Cron adressen, den vil automatisk blive tilføjet.'));
define('_ACA_SITE_URL', compa::encodeutf('Din websides URL'));
define('_ACA_CRON_FREQUENCY', compa::encodeutf('Cron Frekvens'));
define('_ACA_STARTDATE_FREQ', compa::encodeutf('Start dato'));
define('_ACA_LABELDATE_FREQ', compa::encodeutf('Angiv dato'));
define('_ACA_LABELTIME_FREQ', compa::encodeutf('Angiv tid'));
define('_ACA_CRON_URL', compa::encodeutf('Cron URL'));
define('_ACA_CRON_FREQ', compa::encodeutf('Frekvens'));
define('_ACA_TITLE_CRONLIST', compa::encodeutf('Cron List'));
define('_NEW_LIST', compa::encodeutf('Opret en ny liste'));

//title CRON form
define('_ACA_TITLE_FREQ', compa::encodeutf('Ret Cron'));
define('_ACA_CRON_SITE_URL', compa::encodeutf('Indtast en gyldig webside URL, startende med http://'));

### Mailings ###
define('_ACA_MAILING_ALL', compa::encodeutf('Alle forsendelser'));
define('_ACA_EDIT_A', compa::encodeutf('Ret en '));
define('_ACA_SELCT_MAILING', compa::encodeutf('Vælg en liste i rullemenuen for at kunne tilføje en ny forsendelse.'));
define('_ACA_VISIBLE_FRONT', compa::encodeutf('Synlig i front-end'));

// mailer
define('_ACA_SUBJECT', compa::encodeutf('Emne'));
define('_ACA_CONTENT', compa::encodeutf('Indhold'));
define('_ACA_NAMEREP', compa::encodeutf('[NAME] = Dette vil blive erstattet med det navn abonnenten har indtastet, du vil sende personaliserede email når du bruger denne.<br />'));
define('_ACA_FIRST_NAME_REP', compa::encodeutf('[FIRSTNAME] = Dette vil blive erstattet med det FØRSTE navn som abonnenten har indtastet.<br />'));
define('_ACA_NONHTML', compa::encodeutf('Ikke-HTML version'));
define('_ACA_ATTACHMENTS', compa::encodeutf('Vedhæftninger'));
define('_ACA_SELECT_MULTIPLE', compa::encodeutf('Hold control (eller ctrl) for at vælge flere vedhæftninger.<br />' .
		'De viste filer i denne vedhæftningsliste er placeret i vedhæftningsfolderen, du kan ændre denne placering i kofigurationspanelet.'));
define('_ACA_CONTENT_ITEM', compa::encodeutf('Indholdsdokument'));
define('_ACA_SENDING_EMAIL', compa::encodeutf('Afsender email'));
define('_ACA_MESSAGE_NOT', compa::encodeutf('Meddelelsen kunne ikke sendes'));
define('_ACA_MAILER_ERROR', compa::encodeutf('Udsendelses fejl'));
define('_ACA_MESSAGE_SENT_SUCCESSFULLY', compa::encodeutf('Meddelelse sendt succesfuldt'));
define('_ACA_SENDING_TOOK', compa::encodeutf('Afsendelsen af denne forsendelse tog'));
define('_ACA_SECONDS', compa::encodeutf('sekunder'));
define('_ACA_NO_ADDRESS_ENTERED', compa::encodeutf('Ingen email adressse eller modtager angivet'));
define('_ACA_CHANGE_SUBSCRIPTIONS', compa::encodeutf('Ændre'));
define('_ACA_CHANGE_EMAIL_SUBSCRIPTION', compa::encodeutf('Ændre dit abonnement'));
define('_ACA_WHICH_EMAIL_TEST', compa::encodeutf('Angiv den email adresse der sendes en test til eller vælg forevisning'));
define('_ACA_SEND_IN_HTML', compa::encodeutf('Send i HTML (for HTML udsendelser)?'));
define('_ACA_VISIBLE', compa::encodeutf('Synlig'));
define('_ACA_INTRO_ONLY', compa::encodeutf('Kun introduktionen'));

// stats
define('_ACA_GLOBALSTATS', compa::encodeutf('Global statistik'));
define('_ACA_DETAILED_STATS', compa::encodeutf('Detaljeret statistik'));
define('_ACA_MAILING_LIST_DETAILS', compa::encodeutf('Liste detaljer'));
define('_ACA_SEND_IN_HTML_FORMAT', compa::encodeutf('Sendt i HTML format'));
define('_ACA_VIEWS_FROM_HTML', compa::encodeutf('Visninger (fra HTML forsendelse)'));
define('_ACA_SEND_IN_TEXT_FORMAT', compa::encodeutf('Send i tekstformat'));
define('_ACA_HTML_READ', compa::encodeutf('HTML læst'));
define('_ACA_HTML_UNREAD', compa::encodeutf('HTML ulæst'));
define('_ACA_TEXT_ONLY_SENT', compa::encodeutf('Kun tekst'));

// Configuration panel
// main tabs
define('_ACA_MAIL_CONFIG', compa::encodeutf('Mail'));
define('_ACA_LOGGING_CONFIG', compa::encodeutf('Logs & Statistikker'));
define('_ACA_SUBSCRIBER_CONFIG', compa::encodeutf('Abonnenter'));
define('_ACA_AUTO_CONFIG', compa::encodeutf('Cron'));
define('_ACA_MISC_CONFIG', compa::encodeutf('Diverse'));
define('_ACA_MAIL_SETTINGS', compa::encodeutf('Brev opsætning'));
define('_ACA_MAILINGS_SETTINGS', compa::encodeutf('Forsendelses opsætning'));
define('_ACA_SUBCRIBERS_SETTINGS', compa::encodeutf('Abonnements opsætning'));
define('_ACA_CRON_SETTINGS', compa::encodeutf('Cron Settings'));
define('_ACA_SENDING_SETTINGS', compa::encodeutf('Afsendelses opsætning'));
define('_ACA_STATS_SETTINGS', compa::encodeutf('Statistik opsætning'));
define('_ACA_LOGS_SETTINGS', compa::encodeutf('Logs Settings'));
define('_ACA_MISC_SETTINGS', compa::encodeutf('Diverse opsætninger'));
// mail settings
define('_ACA_SEND_MAIL_FROM', compa::encodeutf('Afsender Email'));
define('_ACA_SEND_MAIL_NAME', compa::encodeutf('Afsender navn'));
define('_ACA_MAILSENDMETHOD', compa::encodeutf('Afsendelses metode'));
define('_ACA_SENDMAILPATH', compa::encodeutf('Sendmail sti'));
define('_ACA_SMTPHOST', compa::encodeutf('SMTP host'));
define('_ACA_SMTPAUTHREQUIRED', compa::encodeutf('SMTP identifikation kræves'));
define('_ACA_SMTPAUTHREQUIRED_TIPS', compa::encodeutf('Vælg Ja hvis din SMTP server kræver identifikation'));
define('_ACA_SMTPUSERNAME', compa::encodeutf('SMTP brugernavn'));
define('_ACA_SMTPUSERNAME_TIPS', compa::encodeutf('Indtast SMTP brugernavnet når din SMTP server kræver identifikation'));
define('_ACA_SMTPPASSWORD', compa::encodeutf('SMTP kodeord'));
define('_ACA_SMTPPASSWORD_TIPS', compa::encodeutf('Indtast SMTP kodeordet når din SMTP server kræver identifikation'));
define('_ACA_USE_EMBEDDED', compa::encodeutf('Brug indlejrede billeder'));
define('_ACA_USE_EMBEDDED_TIPS', compa::encodeutf('Vælg Ja hvis billederne i det vedhæftede indholdsdokument skal være indlejret i emailen ved HTML meddelelser, eller Nej for at bruge standard billed afmærkninger som linker til billederne på websiden.'));
define('_ACA_UPLOAD_PATH', compa::encodeutf('Upload/vedhæftnings sti'));
define('_ACA_UPLOAD_PATH_TIPS', compa::encodeutf('Du kan angive et upload bibliotek.<br />' .
		'Kontroller at biblioteket du angiver eksisterer, ellers opret det.'));

// subscribers settings
define('_ACA_ALLOW_UNREG', compa::encodeutf('Tilad uregistrerede'));
define('_ACA_ALLOW_UNREG_TIPS', compa::encodeutf('Vælg Ja hvis du vil tillade brugere at abonnere på lister uden at være registrerede brugere på websiden.'));
define('_ACA_REQ_CONFIRM', compa::encodeutf('Kræv bekræftelse'));
define('_ACA_REQ_CONFIRM_TIPS', compa::encodeutf('Vælg Ja hvis du kræver at uregistrerede abonnenter bekræfter deres email adresse.'));
define('_ACA_SUB_SETTINGS', compa::encodeutf('Abonnerings opsætning'));
define('_ACA_SUBMESSAGE', compa::encodeutf('Abonnerings email'));
define('_ACA_SUBSCRIBE_LIST', compa::encodeutf('Abonner på en liste'));

define('_ACA_USABLE_TAGS', compa::encodeutf('Brugbare markeringer'));
define('_ACA_NAME_AND_CONFIRM', compa::encodeutf('<b>[CONFIRM]</b> = Denne opretter et link hvor abonnenten kan bekræfte sine abonnementer. Denne er <strong>krævet</strong> for at få Acajoom til at fungere korrekt.<br />'
.'<br />[NAME] = Denne vil blive erstattet med navnet på abonnenten, du vil derved sende personaliserede emails ved brug af denne.<br />'
.'<br />[FIRSTNAME] = Dette vil blive erstattet af FORNAVNET på abonnenten, fornavnet er defineret som det første navn indtastet af abonnenten.<br />'));
define('_ACA_CONFIRMFROMNAME', compa::encodeutf('Bekræft AFSENDER navnet'));
define('_ACA_CONFIRMFROMNAME_TIPS', compa::encodeutf('Indtast det afsender navn der vises på bekræftelses listen.'));
define('_ACA_CONFIRMFROMEMAIL', compa::encodeutf('Bekræft AFSENDER email'));
define('_ACA_CONFIRMFROMEMAIL_TIPS', compa::encodeutf('Indtast den afsender email adresse der vises på bekræftelses listen.'));
define('_ACA_CONFIRMBOUNCE', compa::encodeutf('Retur adressen'));
define('_ACA_CONFIRMBOUNCE_TIPS', compa::encodeutf('Indtast retur adressen som vises på bekræftelseslisten.'));
define('_ACA_HTML_CONFIRM', compa::encodeutf('HTML bekræftelse'));
define('_ACA_HTML_CONFIRM_TIPS', compa::encodeutf('Vælg Ja hvis bekræftelses listen skal være HTML hvis brugeren tillader HTML.'));
define('_ACA_TIME_ZONE_ASK', compa::encodeutf('Spørg om tidszone'));
define('_ACA_TIME_ZONE_TIPS', compa::encodeutf('Vælg Ja hvis du ønsker at spørge om brugerens tidzone. De ventende forsendelser vil blive sendt på baggrund af tidszone hvis muligt'));

 // Cron Set up
define('_ACA_TIME_OFFSET_URL', compa::encodeutf('klik her for at sætte offset i det globale konfigurations panel -> Lokal tab'));
define('_ACA_TIME_OFFSET_TIPS', compa::encodeutf('Sæt din servers tids offset så de registrede datoer og tider er eksakte'));
define('_ACA_TIME_OFFSET', compa::encodeutf('Tids offset'));
define('_ACA_CRON_TITLE', compa::encodeutf('Opsætning af cron funktion'));
define('_ACA_CRON_DESC', compa::encodeutf('<br />Ved brug af cron funktionen kan du oprette en automatisk opgave på din Joomla webside!<br />' .
		'For at oprette den skal du tilføje følgende kommando i dit crontab kontrolpanel:<br />' .
		'<b>' . ACA_JPATH_LIVE . '/index2.php?option=com_acajoom&act=cron</b> ' .
		'<br /><br />Hvis du har brug for hjælp til at sætte op eller har problemer så konsulter vores forum <a href="http://www.ijoobi.com" target="_blank">http://www.ijoobi.com</a>'));
// sending settings
define('_ACA_PAUSEX', compa::encodeutf('Pause x sekunder for hvert konfigureret antal emails'));
define('_ACA_PAUSEX_TIPS', compa::encodeutf('Indtast antallet af sekunder som Acajoom vil give SMTP serveren til at sende meddelelserne før der fortsættes med det næste konfigurered antal meddelelser.'));
define('_ACA_EMAIL_BET_PAUSE', compa::encodeutf('Emails mellem pauser'));
define('_ACA_EMAIL_BET_PAUSE_TIPS', compa::encodeutf('Antallet af emails der sendes før der holdes pause.'));
define('_ACA_WAIT_USER_PAUSE', compa::encodeutf('Vent for bruger input under pausen'));
define('_ACA_WAIT_USER_PAUSE_TIPS', compa::encodeutf('Hvad enten scriptet skal vente på bruger input når der er pause mellem et sæt forsendelser.'));
define('_ACA_SCRIPT_TIMEOUT', compa::encodeutf('Script timeout'));
define('_ACA_SCRIPT_TIMEOUT_TIPS', compa::encodeutf('Antallet af minutter scriptet skal kunne køre (0 for uendeligt).'));
// Stats settings
define('_ACA_ENABLE_READ_STATS', compa::encodeutf('Aktiver læse statistik'));
define('_ACA_ENABLE_READ_STATS_TIPS', compa::encodeutf('Vælg Ja hvis du ønsker at logge antallet af visninger. Denne teknik kan kun bruges ved HTML forsendelser'));
define('_ACA_LOG_VIEWSPERSUB', compa::encodeutf('Log visninger per abonnent'));
define('_ACA_LOG_VIEWSPERSUB_TIPS', compa::encodeutf('Vælg Ja hvis du vil logge antallet af visninger per abonnent. Denne teknik kan kun bruges ved HTML forsendelser'));
// Logs settings
define('_ACA_DETAILED', compa::encodeutf('Detaljerede logs'));
define('_ACA_SIMPLE', compa::encodeutf('Simple logs'));
define('_ACA_DIAPLAY_LOG', compa::encodeutf('Vis logs'));
define('_ACA_DISPLAY_LOG_TIPS', compa::encodeutf('Vælg Ja hvis du vil vise logs mens forsendelser sendes.'));
define('_ACA_SEND_PERF_DATA', compa::encodeutf('Afsendelses ydelsen'));
define('_ACA_SEND_PERF_DATA_TIPS', compa::encodeutf('Vælg Ja hvis du ønsker at tillade Acajoom at sende ANONYME rapporter om di konfiguration, antallet af abonnementer på en liste og tiden det tog at sende forsendelsen. Dette vil give os en ide om Acajoom ydelsen og vil HJÆLPE OS	med at forbedre Acajoom i den fremtidige udvikling.'));
define('_ACA_SEND_AUTO_LOG', compa::encodeutf('Send log over auto-svar'));
define('_ACA_SEND_AUTO_LOG_TIPS', compa::encodeutf('Vælg Ja hvis du ønsker at sende en email log hvoer gang en kø er behandlet.  ADVARSEL: dette kan resultere i en stor mængde emails.'));
define('_ACA_SEND_LOG', compa::encodeutf('Send loggen'));
define('_ACA_SEND_LOG_TIPS', compa::encodeutf('Hvad enten en log over forsendelsen skal blive sendt til email adressen på brugeren der sendte forsendelsen.'));
define('_ACA_SEND_LOGDETAIL', compa::encodeutf('Send log detailer'));
define('_ACA_SEND_LOGDETAIL_TIPS', compa::encodeutf('Detailjeret indeholder succes eller fejl information for hver enkelt abonnent og et overblik over informationen. Simpel sender kun overblikket.'));
define('_ACA_SEND_LOGCLOSED', compa::encodeutf('Send log hvis forbindelsen er lukket'));
define('_ACA_SEND_LOGCLOSED_TIPS', compa::encodeutf(' Med dette valg hos brugeren, der sender forsendelsen, vil der stadig blive modtaget en rapport via email.'));
define('_ACA_SAVE_LOG', compa::encodeutf('Gem loggen'));
define('_ACA_SAVE_LOG_TIPS', compa::encodeutf('Om en log over en forsendels bliver tilføjet til logfilen eller ej.'));
define('_ACA_SAVE_LOGDETAIL', compa::encodeutf('Gem detaljeret log'));
define('_ACA_SAVE_LOGDETAIL_TIPS', compa::encodeutf('Detailjeret indeholder succes eller fejl information for hver enkelt abonnent og et overblik over informationen. Simpel gemmer kun overblikket.'));
define('_ACA_SAVE_LOGFILE', compa::encodeutf('Gem logfilen'));
define('_ACA_SAVE_LOGFILE_TIPS', compa::encodeutf('Filen til hvilken log informationen tilføjes. Denne fil kan blive ganske stor.'));
define('_ACA_CLEAR_LOG', compa::encodeutf('Slet loggen'));
define('_ACA_CLEAR_LOG_TIPS', compa::encodeutf('Sletter logfilen.'));

### control panel
define('_ACA_CP_LAST_QUEUE', compa::encodeutf('Sidst udførte kø'));
define('_ACA_CP_TOTAL', compa::encodeutf('Totalt'));
define('_ACA_MAILING_COPY', compa::encodeutf('Forsendelsen kopieret succesfuldt!'));

// Miscellaneous settings
define('_ACA_SHOW_GUIDE', compa::encodeutf('Vis guide'));
define('_ACA_SHOW_GUIDE_TIPS', compa::encodeutf('Viser guidelines i begyndelsen til at hjælpe nye brugere med at oprette et nyhedsbrev, en auto-responder og sætte Acajoom korrekt op.'));
define('_ACA_AUTOS_ON', compa::encodeutf('Brug Auto-svar'));
define('_ACA_AUTOS_ON_TIPS', compa::encodeutf('Vælg Nej hvis du ikke vil bruge Auto-svar, så vil alle auto-svar valgmulighederne blive deaktiveret.'));
define('_ACA_NEWS_ON', compa::encodeutf('Brug nyhedsbreve'));
define('_ACA_NEWS_ON_TIPS', compa::encodeutf('Vælg Nej hvis du ikke ønsker at bruge nyhedsbreve, så vil alle valgmulighederne for nyhedsbreve blive deaktiveret.'));
define('_ACA_SHOW_TIPS', compa::encodeutf('Vis tips'));
define('_ACA_SHOW_TIPS_TIPS', compa::encodeutf('Vis tips for at hjælpe brugerene til at bruge Acajoom mere effektivt.'));
define('_ACA_SHOW_FOOTER', compa::encodeutf('Vis sidebunden'));
define('_ACA_SHOW_FOOTER_TIPS', compa::encodeutf('Om sidebunden med copyright beskeden vil blive vist eller ej.'));
define('_ACA_SHOW_LISTS', compa::encodeutf('Vis lister i front-end'));
define('_ACA_SHOW_LISTS_TIPS', compa::encodeutf('Når en bruger ikke er registreret vises en liste over lister som de kan abonnere på med arkiv knap for nyhedsbreve eller en login formular så de kan registrere sig.'));
define('_ACA_CONFIG_UPDATED', compa::encodeutf('Konfigurationsdetaljerne er blevet opdateret!'));
define('_ACA_UPDATE_URL', compa::encodeutf('Opdater URL'));
define('_ACA_UPDATE_URL_WARNING', compa::encodeutf('ADVARSEL! Ændrer ikke denne URL medmindre du er blevet bedt om at gøre det af det tekniske team fra Acajoom.<br />'));
define('_ACA_UPDATE_URL_TIPS', compa::encodeutf('For eksempel: http://www.ijoobi.com/update/ (inkluder den afsluttende skråstreg)'));

// module
define('_ACA_EMAIL_INVALID', compa::encodeutf('Den indtastede email er ukorrekt.'));
define('_ACA_REGISTER_REQUIRED', compa::encodeutf('Venligst registrer til websiden før du kan vælge en liste.'));

// Access level box
define('_ACA_OWNER', compa::encodeutf('Ejeren af listen:'));
define('_ACA_ACCESS_LEVEL', compa::encodeutf('Sæt adgangsniveau for listen'));
define('_ACA_ACCESS_LEVEL_OPTION', compa::encodeutf('Adgangsniveau mulighederne'));
define('_ACA_USER_LEVEL_EDIT', compa::encodeutf('Vælg hvilket brugerniveau der kræves for at rette en forsendelse (enten fra front-end eller back-end) '));

//  drop down options
define('_ACA_AUTO_DAY_CH1', compa::encodeutf('Dagligt'));
define('_ACA_AUTO_DAY_CH2', compa::encodeutf('Dagligt  ikke weekend'));
define('_ACA_AUTO_DAY_CH3', compa::encodeutf('Hver anden dag'));
define('_ACA_AUTO_DAY_CH4', compa::encodeutf('Hver anden dag ikke weekend'));
define('_ACA_AUTO_DAY_CH5', compa::encodeutf('Ugentligt'));
define('_ACA_AUTO_DAY_CH6', compa::encodeutf('Hver anden uge'));
define('_ACA_AUTO_DAY_CH7', compa::encodeutf('Månedslig'));
define('_ACA_AUTO_DAY_CH9', compa::encodeutf('Årligt'));
define('_ACA_AUTO_OPTION_NONE', compa::encodeutf('Ingen'));
define('_ACA_AUTO_OPTION_NEW', compa::encodeutf('Nye brugere'));
define('_ACA_AUTO_OPTION_ALL', compa::encodeutf('Alle brugere'));

//
define('_ACA_UNSUB_MESSAGE', compa::encodeutf('Afmeld email'));
define('_ACA_UNSUB_SETTINGS', compa::encodeutf('Afmeldings opsætning'));
define('_ACA_AUTO_ADD_NEW_USERS', compa::encodeutf('Automatisk abonner brugere?'));

// Update and upgrade messages
define('_ACA_NO_UPDATES', compa::encodeutf('Der er iøjeblikket ikke nogen opdatering tilgængelig.'));
define('_ACA_VERSION', compa::encodeutf('Acajoom Version'));
define('_ACA_NEED_UPDATED', compa::encodeutf('Filer der skal opdateres:'));
define('_ACA_NEED_ADDED', compa::encodeutf('Filer der skal tilføjes:'));
define('_ACA_NEED_REMOVED', compa::encodeutf('Filer der skal slettes:'));
define('_ACA_FILENAME', compa::encodeutf('Filenavn:'));
define('_ACA_CURRENT_VERSION', compa::encodeutf('Nuværende version:'));
define('_ACA_NEWEST_VERSION', compa::encodeutf('Nyeste version:'));
define('_ACA_UPDATING', compa::encodeutf('Opdaterer'));
define('_ACA_UPDATE_UPDATED_SUCCESSFULLY', compa::encodeutf('Filerne er blevet succesfuldt opdateret.'));
define('_ACA_UPDATE_FAILED', compa::encodeutf('Opdatering fejlede!'));
define('_ACA_ADDING', compa::encodeutf('Tilføjer'));
define('_ACA_ADDED_SUCCESSFULLY', compa::encodeutf('Tilføjet succesfuldt.'));
define('_ACA_ADDING_FAILED', compa::encodeutf('Tilføjelse fejlede!'));
define('_ACA_REMOVING', compa::encodeutf('Fjerner'));
define('_ACA_REMOVED_SUCCESSFULLY', compa::encodeutf('Fjernet succesfuldt.'));
define('_ACA_REMOVING_FAILED', compa::encodeutf('Sletning fejlet!'));
define('_ACA_INSTALL_DIFFERENT_VERSION', compa::encodeutf('Installer en anden version'));
define('_ACA_CONTENT_ADD', compa::encodeutf('Tilføj sideindhold'));
define('_ACA_UPGRADE_FROM', compa::encodeutf('Importer data (nyhedsbreve og abonnenters information) fra '));
define('_ACA_UPGRADE_MESS', compa::encodeutf('Der er ingen risiko for dine eksisterende data. <br /> Denne process vil simpelthen importere dataene i Acajoom databasen.'));
define('_ACA_CONTINUE_SENDING', compa::encodeutf('Fortsæt afsendelse'));

// Acajoom message
define('_ACA_UPGRADE1', compa::encodeutf('Du kan let importere dine brugere og nyhedsbreve fra '));
define('_ACA_UPGRADE2', compa::encodeutf(' til Acajoom i opdaterings panelet.'));
define('_ACA_UPDATE_MESSAGE', compa::encodeutf('En ny version af Acajoom er tilgængelig! '));
define('_ACA_UPDATE_MESSAGE_LINK', compa::encodeutf('Klik her for at opdatere!'));
define('_ACA_CRON_SETUP', compa::encodeutf('For at auto-svarene kan sendes skal du oprette en cron opgave.'));
define('_ACA_THANKYOU', compa::encodeutf('Tak fordi du valgte Acajoom, Din kommunikations partner!'));
define('_ACA_NO_SERVER', compa::encodeutf('Opdaterings server er ikke tilgængelig, venligst check igen senere.'));
define('_ACA_MOD_PUB', compa::encodeutf('Acajoom module er ikke udgivet.'));
define('_ACA_MOD_PUB_LINK', compa::encodeutf('Klik her for at udgive det!'));
define('_ACA_IMPORT_SUCCESS', compa::encodeutf('succesfuldt importeret'));
define('_ACA_IMPORT_EXIST', compa::encodeutf('abonnent allerede i database'));

// Acajoom\'s Guide
define('_ACA_GUIDE', compa::encodeutf('\'s Wizard'));
define('_ACA_GUIDE_FIRST_ACA_STEP', compa::encodeutf('<p>Acajoom har mange gode faciliteter og denne wizard til at guide dig gennem en simpel fire trins process til at få dig igang med at sende dine nyhedsbreve og auto-svar!<p />'));
define('_ACA_GUIDE_FIRST_ACA_STEP_DESC', compa::encodeutf('Først, skal du tilføje en liste.  En liste kan være af to forskellige typer, enten et nyhedsbrev eller en auto-svar.' .
		'  I listen definerer du alle de forskellige parametre for at aktivere afsendelsen af dit nyhedsbrev eller auto-svar: afsendernavn, layout, abonnenternes velkomst meddelelse, etc...
<br /><br />Du kan oprette din første liste  her: <a href="index2.php?option=com_acajoom&act=list" >Opret en liste</a> og klik på Ny knappen.'));
define('_ACA_GUIDE_FIRST_ACA_STEP_UPGRADE', compa::encodeutf('Acajoom giver dig en let måde at importere alle data fra et tidligere nyhedsbrevssystem.<br />' .
		' Gå til opdaterings panelet og vælg dit tidligere nyhedsbrevssystem for at importere all dine nyhedsbreve og abonnenter.<br /><br />' .
		'<span style="color:#FF5E00;" >VIGTIGT: importen er risikofri og påvirker ikke på nogen måde data i dit tidligere nyhedsbrevsystem</span><br />' .
		'Efter importen vil du kunne administre abonnenter og forsendelser direkte i Acajoom.<br /><br />'));
define('_ACA_GUIDE_SECOND_ACA_STEP', compa::encodeutf('Godt din første liste er oprettet!  Du kan nu skrive dit første %s.  For at oprette det gå til: '));
define('_ACA_GUIDE_SECOND_ACA_STEP_AUTO', compa::encodeutf('Auto-svar administration'));
define('_ACA_GUIDE_SECOND_ACA_STEP_NEWS', compa::encodeutf('Nyhedsbrevs administration'));
define('_ACA_GUIDE_SECOND_ACA_STEP_FINAL', compa::encodeutf(' og vælg din %s. <br /> Derefter vælger du %s i drop down listen.  Opret din første forsendelse ved at klikke Ny '));

define('_ACA_GUIDE_THRID_ACA_STEP_NEWS', compa::encodeutf('Før du sender dit første nyhedsbrev vil du måske checke mail konfigurationen.  ' .
		'Gå til <a href="index2.php?option=com_acajoom&act=configuration" >konfigurationssiden</a> for at kontrollere mail opsætningen. <br />'));
define('_ACA_GUIDE_THRID2_ACA_STEP_NEWS', compa::encodeutf('<br />Når du er klar til at gå tilbage til Nyhedsbrev menuen, vælg da dit brev og klik send'));

define('_ACA_GUIDE_THRID_ACA_STEP_AUTOS', compa::encodeutf('For at dit auto-svar kan sendes skal du først oprette en cron opgave på din server. ' .
		' Venligst benyt Cron fanebladet i kontrolpanelet.' .
		' <a href="index2.php?option=com_acajoom&act=configuration" >klik her</a> for at lære hvordan man opretter en cron opgave. <br />'));

define('_ACA_GUIDE_MODULE', compa::encodeutf(' <br />Kontroller at du har publiceret Acajoom modulet så brugerne kan tilmelde sig listen.'));

define('_ACA_GUIDE_FOUR_ACA_STEP_NEWS', compa::encodeutf(' Du kan nu også oprette et auto-svar.'));
define('_ACA_GUIDE_FOUR_ACA_STEP_AUTOS', compa::encodeutf(' Du kan nu også oprette et nyhedsbrev.'));

define('_ACA_GUIDE_FOUR_ACA_STEP', compa::encodeutf('<p><br />Flot! Nu er du klar til effektivt at kommunikere med dine besøgende og brugere. Denne wizard vil blive afsluttet så snart du har indtastet din anden forsendelse eller du slå den fra i <a href="index2.php?option=com_acajoom&act=configuration" >konfigurations panelet</a>.' .
		'<br /><br />  Hvis du har nogle spørgsmål når du bruger Acajoom, så kontakt venligst vores ' .
		'<a target="_blank" href="http://www.ijoobi.com/index.php?option=com_agora&Itemid=60" >forum</a>. ' .
		' Du kan også finde en mængde information om hvordan man effektivt kommunikerer med sine abonnenter på <a href="http://www.ijoobi.com/" target="_blank" >www.ijoobi.com</a>.' .
		'<p /><br /><b>Tak fordi du bruger Acajoom. Din kommunications partner!</b> '));
define('_ACA_GUIDE_TURNOFF', compa::encodeutf('Wizarden er nu slået fra!'));
define('_ACA_STEP', compa::encodeutf('TRIN '));

// Acajoom Install
define('_ACA_INSTALL_CONFIG', compa::encodeutf('Acajoom konfiguration'));
define('_ACA_INSTALL_SUCCESS', compa::encodeutf('Succesfuldt Installeret'));
define('_ACA_INSTALL_ERROR', compa::encodeutf('Installations fejl'));
define('_ACA_INSTALL_BOT', compa::encodeutf('Acajoom Plugin (Bot)'));
define('_ACA_INSTALL_MODULE', compa::encodeutf('Acajoom modul'));
//Others
define('_ACA_JAVASCRIPT', compa::encodeutf('!Advarsel! Javascript skal være aktiveret for korrekt funktion.'));
define('_ACA_EXPORT_TEXT', compa::encodeutf('De abonnenter der er eksporteret er baseret på den liste du valgte. <br />Export abonnenter for liste'));
define('_ACA_IMPORT_TIPS', compa::encodeutf('Import subscribers. The information in the file need to be to the following format: <br />' .
		'Name,email,receiveHTML(0/1),<span style="color: rgb(255, 0, 0);">confirmed(0/1)</span>'));
define('_ACA_SUBCRIBER_EXIT', compa::encodeutf('er allerede en abonnent'));
define('_ACA_GET_STARTED', compa::encodeutf('Klik her for at komme igang!'));

//News since 1.0.1
define('_ACA_WARNING_1011', compa::encodeutf('Advarsel: 1011: Opdatering vil ikke fungere på grund af din servers begrænsninger.'));
define('_ACA_SEND_MAIL_FROM_TIPS', compa::encodeutf('Vælg den email adresse der vil blive vist som afsender.'));
define('_ACA_SEND_MAIL_NAME_TIPS', compa::encodeutf('Vælg det navn der vil blive vist som afsender.'));
define('_ACA_MAILSENDMETHOD_TIPS', compa::encodeutf('Vælg den afsendelsesfunktion du ønsker at bruge: PHP mail, <span>Sendmail</span> eller SMTP server.'));
define('_ACA_SENDMAILPATH_TIPS', compa::encodeutf('Dette er biblioteket på mail serveren'));
define('_ACA_LIST_T_TEMPLATE', compa::encodeutf('Skabelon'));
define('_ACA_NO_MAILING_ENTERED', compa::encodeutf('Ingen forsendelser udvalgt'));
define('_ACA_NO_LIST_ENTERED', compa::encodeutf('Ingen liste udvalgt'));
define('_ACA_SENT_MAILING', compa::encodeutf('Afsendte forsendelser'));
define('_ACA_SELECT_FILE', compa::encodeutf('Vælg venligst en fil til '));
define('_ACA_LIST_IMPORT', compa::encodeutf('Marker de lister du ønsker abonnenterne tilknyttet til.'));
define('_ACA_PB_QUEUE', compa::encodeutf('Abonnent oprettet men problem med at forbinde ham/hende med listerne. Vælg dem venligst manuelt.'));
define('_ACA_UPDATE_MESS', compa::encodeutf(''));
define('_ACA_UPDATE_MESS1', compa::encodeutf('Opdatering kraftigt anbefalet!'));
define('_ACA_UPDATE_MESS2', compa::encodeutf('Rettelse og små fixes.'));
define('_ACA_UPDATE_MESS3', compa::encodeutf('Ny udgave.'));
define('_ACA_UPDATE_MESS5', compa::encodeutf('Joomla 1.5 er krævet for at opdatere.'));
define('_ACA_UPDATE_IS_AVAIL', compa::encodeutf(' er tilgængelig!'));
define('_ACA_NO_MAILING_SENT', compa::encodeutf('Ingen forsendelser afsendt!'));
define('_ACA_SHOW_LOGIN', compa::encodeutf('Vis login formular'));
define('_ACA_SHOW_LOGIN_TIPS', compa::encodeutf('Vælg Ja for at vise en login formular i Acajoom front-end kontrolpanelet så brugeren kan registrere sig til websiden.'));
define('_ACA_LISTS_EDITOR', compa::encodeutf('List Description Editor'));
define('_ACA_LISTS_EDITOR_TIPS', compa::encodeutf('Vælg Ja for at bruge en HTML editor til at rette i listens beskrivelses felt.'));
define('_ACA_SUBCRIBERS_VIEW', compa::encodeutf('Vis abonnenter'));

//News since 1.0.2
define('_ACA_FRONTEND_SETTINGS', compa::encodeutf('Front-end opsætning'));
define('_ACA_SHOW_LOGOUT', compa::encodeutf('Vis logout knap'));
define('_ACA_SHOW_LOGOUT_TIPS', compa::encodeutf('Vælg Ja for at vise logout knappen i Acajoom front-end kontrolpanelet.'));

//News since 1.0.3 CB integration
define('_ACA_CONFIG_INTEGRATION', compa::encodeutf('Integration'));
define('_ACA_CB_INTEGRATION', compa::encodeutf('Community Builder Integration'));
define('_ACA_INSTALL_PLUGIN', compa::encodeutf('Community Builder Plugin (Acajoom Integration) '));
define('_ACA_CB_PLUGIN_NOT_INSTALLED', compa::encodeutf('Acajoom Plugin for Community Builder er ikke installeret endnu!'));
define('_ACA_CB_PLUGIN', compa::encodeutf('Lister ved registringen'));
define('_ACA_CB_PLUGIN_TIPS', compa::encodeutf('Vælg Ja for at vise forsendelseslisten i Community Builder registreringsformularen'));
define('_ACA_CB_LISTS', compa::encodeutf('List ID'));
define('_ACA_CB_LISTS_TIPS', compa::encodeutf('DETTE ER ET PÅKRÆVET FELT. Indtast ID nummeret på den liste du ønsker at tillade brugerne at abonnere på adskildt med komma ,  (0 = vis alle listerne)'));
define('_ACA_CB_INTRO', compa::encodeutf('Introduktions tekst'));
define('_ACA_CB_INTRO_TIPS', compa::encodeutf('En tekst der vil fremkomme før oversikten. LAD DEN VÆRE BLANK FOR IKKE AT VISE NOGET.  Du kan bruge HTML tags til at tilrette udseendet.'));
define('_ACA_CB_SHOW_NAME', compa::encodeutf('Vis liste navn'));
define('_ACA_CB_SHOW_NAME_TIPS', compa::encodeutf('Vælg om navnet på listen vises eller ej efter introduktionen.'));
define('_ACA_CB_LIST_DEFAULT', compa::encodeutf('Marker listen som standard'));
define('_ACA_CB_LIST_DEFAULT_TIPS', compa::encodeutf('Vælg om afkrydsningsboxen for hver enkelt liste er markeret som standard eller ej.'));
define('_ACA_CB_HTML_SHOW', compa::encodeutf('Vis modtag HTML'));
define('_ACA_CB_HTML_SHOW_TIPS', compa::encodeutf('Sæt til Ja for at tillade brugere at vælge om de vil have HTML emails eller ej. Sæt til Nej for at bruge standard Modtag HTML.'));
define('_ACA_CB_HTML_DEFAULT', compa::encodeutf('Standard Modtag HTML'));
define('_ACA_CB_HTML_DEFAULT_TIPS', compa::encodeutf('Sæt denne valgmulighed for vise standard HTML forsendelses konfigurationen. Hvis Vis modtag HTML er sat til Nej så vil denne valgmulighed være standard.'));

// Since 1.0.4
define('_ACA_BACKUP_FAILED', compa::encodeutf('Kunne ikke sikkerhedskopiere filen! Filen blev ikke erstattet.'));
define('_ACA_BACKUP_YOUR_FILES', compa::encodeutf('Den gamle versio af filerne er blevet sikkerhedskopiere ind i følgende bibliotek:'));
define('_ACA_SERVER_LOCAL_TIME', compa::encodeutf('Server lokal tid'));
define('_ACA_SHOW_ARCHIVE', compa::encodeutf('Vis arkiv knap'));
define('_ACA_SHOW_ARCHIVE_TIPS', compa::encodeutf('Vælg Ja for at vise en arkiv knap i front-end på Nyhedsbrev listen'));
define('_ACA_LIST_OPT_TAG', compa::encodeutf('Tags'));
define('_ACA_LIST_OPT_IMG', compa::encodeutf('Billeder'));
define('_ACA_LIST_OPT_CTT', compa::encodeutf('Indhold'));
define('_ACA_INPUT_NAME_TIPS', compa::encodeutf('Indtast hele dit navn (fornavn først)'));
define('_ACA_INPUT_EMAIL_TIPS', compa::encodeutf('Indtast din email adresse (Vær sikker på at dette er en gyldig email adresse hvis du vil modtage vores forsendelser.)'));
define('_ACA_RECEIVE_HTML_TIPS', compa::encodeutf('Vælg Ja hvis du ønsker at modtage HTML forsendelser - Ikke at modtage kun tekst forsendelser'));
define('_ACA_TIME_ZONE_ASK_TIPS', compa::encodeutf('Angiv din tidszone.'));

// Since 1.0.5
define('_ACA_FILES', compa::encodeutf('Filer'));
define('_ACA_FILES_UPLOAD', compa::encodeutf('Upload'));
define('_ACA_MENU_UPLOAD_IMG', compa::encodeutf('Upload billeder'));
define('_ACA_TOO_LARGE', compa::encodeutf('Fil størrelsen er for stor. Den maksimalt tilladte størrelse er'));
define('_ACA_MISSING_DIR', compa::encodeutf('Destinations biblioteket findes ikke'));
define('_ACA_IS_NOT_DIR', compa::encodeutf('Destinations bibliotektet findes ikke eller er ikke en regulær fil.'));
define('_ACA_NO_WRITE_PERMS', compa::encodeutf('Der er ikke skrive rettigheder i destinations biblioteket.'));
define('_ACA_NO_USER_FILE', compa::encodeutf('Du har ikke valgt nogen fil at uploade.'));
define('_ACA_E_FAIL_MOVE', compa::encodeutf('Umuligt at flytte filen.'));
define('_ACA_FILE_EXISTS', compa::encodeutf('Destinations filen findes allerede.'));
define('_ACA_CANNOT_OVERWRITE', compa::encodeutf('Destinations filen findes allerede og kunne ikke overskrives.'));
define('_ACA_NOT_ALLOWED_EXTENSION', compa::encodeutf('Fil extention er ikke tilladt.'));
define('_ACA_PARTIAL', compa::encodeutf('Filen blev kun delvist uploaded.'));
define('_ACA_UPLOAD_ERROR', compa::encodeutf('Upload fejl:'));
define('DEV_NO_DEF_FILE', compa::encodeutf('Filen blev kun delvist uploaded.'));

// already exist but modified  added a <br/ on first line and added [SUBSCRIPTIONS] line>
define('_ACA_CONTENTREP', compa::encodeutf('[SUBSCRIPTIONS] = Dette vil blive erstattet med abonnement links.' .
		' Dette er <strong>krævet</strong> for at Acajoom kan fungere korrekt.<br />' .
		'Hvis du andet indhold i denne box vildet blive vist i alle forsendelser som hører til denne liste.' .
		' <br />Tilføj din abonnements besked i slutningen.  Acajoom vil automatisk tilføje en link til abonnenten så de kan ændre deres information og en link til afmelding fra listen.'));

// since 1.0.6
define('_ACA_NOTIFICATION', compa::encodeutf('Notification'));  // shortcut for Email notification
define('_ACA_NOTIFICATIONS', compa::encodeutf('Notificationer'));
define('_ACA_USE_SEF', compa::encodeutf('SEF i forsendelser'));
define('_ACA_USE_SEF_TIPS', compa::encodeutf('Det anbefales at du vælger Nej.  Hvis du ønsker URLen inkluderet i din forsendelse for at bruge SEF da vælg Ja.' .
		' <br /><b>Linkene vil fungere på samme måde uanset hviken du vælger.  Nej vil sikre at links i forsendelser altid vil fungere selv hvis du ændrer din SEF.</b> '));
define('_ACA_ERR_NB', compa::encodeutf('Fejl #: ERR'));
define('_ACA_ERR_SETTINGS', compa::encodeutf('Fejlhåndterings opsætning'));
define('_ACA_ERR_SEND', compa::encodeutf('Send fejlrapport'));
define('_ACA_ERR_SEND_TIPS', compa::encodeutf('Hvis du vil have Acajoom til at blive et bedre produkt så vælg venligst Ja.  Det vil sende os en fejlrapport.  Så du behøver ikke engang at rapportere fejl mere ;-) <br /> <b>INGEN PRIVATE INFORMATIONER BLIVER SENDT</b>.  Vi vil end ikke vide fra hvilken webside fejlen er sendt fra. Vi sender kun informationer om Acajoom, PHP opsætningen og SQL forespørgsler. '));
define('_ACA_ERR_SHOW_TIPS', compa::encodeutf('Vælg Ja for at vise antallet af fejl på skærmen.  Primært anvendt for at kunne debuging løsningen. '));
define('_ACA_ERR_SHOW', compa::encodeutf('Vis fejl'));
define('_ACA_LIST_SHOW_UNSUBCRIBE', compa::encodeutf('Vis afmeldings links'));
define('_ACA_LIST_SHOW_UNSUBCRIBE_TIPS', compa::encodeutf('Vælg Ja for at vise afmeldings links i bunde af forsendelsen så brugerne kan ændre deres abonnementer. <br /> Nej vil slå sidefoden og links fra.'));
define('_ACA_UPDATE_INSTALL', compa::encodeutf('<span style="color: rgb(255, 0, 0);">VIGTIG BEMÆRKNING!</span> <br />Hvis du opgraderer fra en tidligere Acajoom installation skal du opgradere din database struktur ved at klikke på følgende knap (Dine data vil forblive uændret)'));
define('_ACA_UPDATE_INSTALL_BTN', compa::encodeutf('Opgrader tabeller og konfiguration'));
define('_ACA_MAILING_MAX_TIME', compa::encodeutf('Maks. kø tid'));
define('_ACA_MAILING_MAX_TIME_TIPS', compa::encodeutf('Definer den maksimale tid for hver sæt af emails der sendes af køen. Anbefales mellem 30 sek og 2 min.'));

// virtuemart integration beta
define('_ACA_VM_INTEGRATION', compa::encodeutf('VirtueMart Integration'));
define('_ACA_VM_COUPON_NOTIF', compa::encodeutf('Kupon notifications ID'));
define('_ACA_VM_COUPON_NOTIF_TIPS', compa::encodeutf('Angiv ID nummeret på den forsendelse du ønsker at bruge til at sende kuponner til dine handlende.'));
define('_ACA_VM_NEW_PRODUCT', compa::encodeutf('Ny produkt notification ID'));
define('_ACA_VM_NEW_PRODUCT_TIPS', compa::encodeutf('Angiv ID nummeret på den forsendelse du ønsker at sende som ny produkt notification.'));

// since 1.0.8
// create forms for subscriptions
define('_ACA_FORM_BUTTON', compa::encodeutf('Opret formular'));
define('_ACA_FORM_COPY', compa::encodeutf('HTML kode'));
define('_ACA_FORM_COPY_TIPS', compa::encodeutf('Kopier den genererede HTML kode ind i din HTML side.'));
define('_ACA_FORM_LIST_TIPS', compa::encodeutf('Vælg den liste du vil inkludere i formularen'));
// update messages
define('_ACA_UPDATE_MESS4', compa::encodeutf('Den kan ikke opdateres automatisk.'));
define('_ACA_WARNG_REMOTE_FILE', compa::encodeutf('Der er ingen måde at hente den remote fil.'));
define('_ACA_ERROR_FETCH', compa::encodeutf('Fejl under henting af fil.'));

define('_ACA_CHECK', compa::encodeutf('Check'));
define('_ACA_MORE_INFO', compa::encodeutf('Mere information'));
define('_ACA_UPDATE_NEW', compa::encodeutf('Opgrader til nyere version'));
define('_ACA_UPGRADE', compa::encodeutf('Opgrader til højere produkt'));
define('_ACA_DOWNDATE', compa::encodeutf('Rul tilbage til den tidligere version'));
define('_ACA_DOWNGRADE', compa::encodeutf('Tilbage til det grundlæggende produkt'));
define('_ACA_REQUIRE_JOOM', compa::encodeutf('Kræv Joomla'));
define('_ACA_TRY_IT', compa::encodeutf('Prøv det!'));
define('_ACA_NEWER', compa::encodeutf('Nyere'));
define('_ACA_OLDER', compa::encodeutf('Ældre'));
define('_ACA_CURRENT', compa::encodeutf('Gældende'));

// since 1.0.9
define('_ACA_CHECK_COMP', compa::encodeutf('Prøv en af de andre komponenter'));
define('_ACA_MENU_VIDEO', compa::encodeutf('Video uddannelse'));
define('_ACA_AUTO_SCHEDULE', compa::encodeutf('Plan'));
define('_ACA_SCHEDULE_TITLE', compa::encodeutf('Automatisk planlægningsfunktions opsætning'));
define('_ACA_ISSUE_NB_TIPS', compa::encodeutf('Problem nummer genereret automatisk af systemet'));
define('_ACA_SEL_ALL', compa::encodeutf('Alle forsendelser'));
define('_ACA_SEL_ALL_SUB', compa::encodeutf('Alle lister'));
define('_ACA_INTRO_ONLY_TIPS', compa::encodeutf('Hvis du vælger denne box er det kun intoduktionen til artiklen der vil bliv indsat i forsendelsen med en "læs mere" link til den komplette artikel på din webside.'));
define('_ACA_TAGS_TITLE', compa::encodeutf('Placeringsmærker'));
define('_ACA_TAGS_TITLE_TIPS', compa::encodeutf('Klip og klister denne markering in i forsendelse der hvor du vil have indholdet placeret.'));
define('_ACA_PREVIEW_EMAIL_TEST', compa::encodeutf('Angiv den email adresse som testen skal sendes til'));
define('_ACA_PREVIEW_TITLE', compa::encodeutf('Preview'));
define('_ACA_AUTO_UPDATE', compa::encodeutf('Ny opdaterings besked'));
define('_ACA_AUTO_UPDATE_TIPS', compa::encodeutf('Vælg Ja hvis du vil have besked om nye opdateringer til din komponent. <br />VIGTIGT!! Vis tips skal være slået til for at denne funktion vil virke.'));

// since 1.1.0
define('_ACA_LICENSE', compa::encodeutf('Licens information'));

// since 1.1.1
define('_ACA_NEW', compa::encodeutf('Ny'));
define('_ACA_SCHEDULE_SETUP', compa::encodeutf('For at auto-svaret kan blive send skal du opsætte din scheduler i konfigurationen.'));
define('_ACA_SCHEDULER', compa::encodeutf('Scheduler'));
define('_ACA_ACAJOOM_CRON_DESC', compa::encodeutf('Hvis du ikke har adgang til en cron opgave adminstrator på din webside, kan du registrere dig til en fri Acajoom Cron konto på:'));
define('_ACA_CRON_DOCUMENTATION', compa::encodeutf('Du kan finde yderligere information om opsætningen af Acajoom scheduleren på følgende url:'));
define('_ACA_CRON_DOC_URL', compa::encodeutf('<a href="http://www.ijoobi.com/index.php?option=com_content&view=article&id=4249&catid=29&Itemid=72"
 target="_blank">http://www.ijoobi.com/index.php?option=com_content&Itemid=72&view=category&layout=blog&id=29&limit=60</a>'));
define( '_ACA_QUEUE_PROCESSED', compa::encodeutf('Køen behandlet succesfuldt...'));
define( '_ACA_ERROR_MOVING_UPLOAD', compa::encodeutf('Fejl ved flytning af importeret fil'));

//since 1.1.4
define( '_ACA_SCHEDULE_FREQUENCY', compa::encodeutf('Scheduler frekvens'));
define( '_ACA_CRON_MAX_FREQ', compa::encodeutf('Scheduler max frekvens'));
define( '_ACA_CRON_MAX_FREQ_TIPS', compa::encodeutf('Specificer den maximale frekvens som scheduleren kan køre med ( i minuter ).  Dette vil begrænse scheduleren selv om cron opgaverne er opsat til oftere.'));
define( '_ACA_CRON_MAX_EMAIL', compa::encodeutf('Maximum emails per opgave'));
define( '_ACA_CRON_MAX_EMAIL_TIPS', compa::encodeutf('Angiv det maximale antal emails der sendes per opgave (0 ubegrænset).'));
define( '_ACA_CRON_MINUTES', compa::encodeutf(' minuter'));
define( '_ACA_SHOW_SIGNATURE', compa::encodeutf('Vis email sidefoden'));
define( '_ACA_SHOW_SIGNATURE_TIPS', compa::encodeutf('Hvad enten du vil eller ikke vil fremhæve Acajoom i bunden af emailene.'));
define( '_ACA_QUEUE_AUTO_PROCESSED', compa::encodeutf('Auto-svarene er behandlet succesfuldt...'));
define( '_ACA_QUEUE_NEWS_PROCESSED', compa::encodeutf('Planlagte nyhedsbreve er behandlet succesfuldt...'));
define( '_ACA_MENU_SYNC_USERS', compa::encodeutf('Synkroniser brugere'));
define( '_ACA_SYNC_USERS_SUCCESS', compa::encodeutf('Brugere synkroniseret succesfuldt!'));

// compatibility with Joomla 15
if (!defined('_BUTTON_LOGOUT')) define( '_BUTTON_LOGOUT', compa::encodeutf('Logout'));
if (!defined('_CMN_YES')) define( '_CMN_YES', compa::encodeutf('Ja'));
if (!defined('_CMN_NO')) define( '_CMN_NO', compa::encodeutf('Nej'));
if (!defined('_HI')) define( '_HI', compa::encodeutf('Hej'));
if (!defined('_CMN_TOP')) define( '_CMN_TOP', compa::encodeutf('Top'));
if (!defined('_CMN_BOTTOM')) define( '_CMN_BOTTOM', compa::encodeutf('Bund'));
//if (!defined('_BUTTON_LOGOUT')) define( '_BUTTON_LOGOUT', compa::encodeutf('Logout'));

// For include title only or full article in content item tab in newsletter edit - p0stman911
define('_ACA_TITLE_ONLY_TIPS', compa::encodeutf('Hvis du markerer denne så vil kun titlen af artiklen blive indsat i forsendelsen som en link til den komplette artikel på din webside.'));
define('_ACA_TITLE_ONLY', compa::encodeutf('Kun titel'));
define('_ACA_FULL_ARTICLE_TIPS', compa::encodeutf('Hvis du markerer denne vil den komplette artikel blive indsat i forsendelsen'));
define('_ACA_FULL_ARTICLE', compa::encodeutf('Fuld artikel'));
define('_ACA_CONTENT_ITEM_SELECT_T', compa::encodeutf('Vælg det indhold der skal vedlægges til meddelelsen. <br />Klip og klistre <b>content tag</b> ind i forsendelsen.  Du kan vælge at have hele teksten, kun introduktionen, eller kun titlen med (0, 1, eller 2 respektivt). '));
define('_ACA_SUBSCRIBE_LIST2', compa::encodeutf('Forsendelseslister'));

// smart-newsletter function
define('_ACA_AUTONEWS', compa::encodeutf('Smart-Nyhedsbrev'));
define('_ACA_MENU_AUTONEWS', compa::encodeutf('Smart-Nyhedsbreve'));
define('_ACA_AUTO_NEWS_OPTION', compa::encodeutf('Smart-Nyhedsbrev valg'));
define('_ACA_AUTONEWS_FREQ', compa::encodeutf('Nyhedsbrevs frekvens'));
define('_ACA_AUTONEWS_FREQ_TIPS', compa::encodeutf('Angiv frekvensen for hvor ofte du vil sende Smart-nyhedsbrevet.'));
define('_ACA_AUTONEWS_SECTION', compa::encodeutf('Artikel sektion'));
define('_ACA_AUTONEWS_SECTION_TIPS', compa::encodeutf('Angiv den sektion du vil vælge artikler fra.'));
define('_ACA_AUTONEWS_CAT', compa::encodeutf('Artikel kategori'));
define('_ACA_AUTONEWS_CAT_TIPS', compa::encodeutf('Angiv den kategori du vil vælge artikler fra (Alle for alle artikler i den sektion).'));
define('_ACA_SELECT_SECTION', compa::encodeutf('Vælg en sektion'));
define('_ACA_SELECT_CAT', compa::encodeutf('Alle kategorier'));
define('_ACA_AUTO_DAY_CH8', compa::encodeutf('Kvartalsvis'));
define('_ACA_AUTONEWS_STARTDATE', compa::encodeutf('Start dato'));
define('_ACA_AUTONEWS_STARTDATE_TIPS', compa::encodeutf('Angiv den dato du vil starte med at sende dit Smart-Nyhedsbrev.'));
define('_ACA_AUTONEWS_TYPE', compa::encodeutf('Indholdet behandles'));// how we see the content which is included in the newsletter
define('_ACA_AUTONEWS_TYPE_TIPS', compa::encodeutf('Fuld artikel: Vil inkludere hele artiklen i nyhedsbrevet.<br />' .
		'Kun intro: Vil kun inkludere introduktionen til artiklen i nyhedsbrevet.<br/>' .
		'Kun titel: Vil kun inkludere titlen til artiklen i nyhedsbrevet.'));
define('_ACA_TAGS_AUTONEWS', compa::encodeutf('[SMARTNEWSLETTER] = Dette vil blive udskiftet med Smart-Nyhedsbrevet.'));

//since 1.1.3
define('_ACA_MALING_EDIT_VIEW', compa::encodeutf('Opret / Se forsendelser'));
define('_ACA_LICENSE_CONFIG', compa::encodeutf('Licens'));
define('_ACA_ENTER_LICENSE', compa::encodeutf('Indtast licens'));
define('_ACA_ENTER_LICENSE_TIPS', compa::encodeutf('Indtast dit licens nummer og gem det.'));
define('_ACA_LICENSE_SETTING', compa::encodeutf('Licens opsætning'));
define('_ACA_GOOD_LIC', compa::encodeutf('Din licens er gyldig.'));
define('_ACA_NOTSO_GOOD_LIC', compa::encodeutf('Din licens er ugyldig: '));
define('_ACA_PLEASE_LIC', compa::encodeutf('Venligst kontakt Acajoom support for at opgradere din licens ( license@ijoobi.com ).'));

define('_ACA_DESC_PLUS', compa::encodeutf('Acajoom Plus er den første sekvensielle auto-svar til Joomla CMS.  ' . _ACA_FEATURES));
define('_ACA_DESC_PRO', compa::encodeutf('Acajoom PRO det ultimative mailing system til Joomla CMS.  ' . _ACA_FEATURES));

//since 1.1.4
define('_ACA_ENTER_TOKEN', compa::encodeutf('Indtast token'));
define('_ACA_ENTER_TOKEN_TIPS', compa::encodeutf('Venligst indtast det token nummer du modtog på email da du købte Acajoom.'));
define('_ACA_ACAJOOM_SITE', compa::encodeutf('Acajoom website:'));
define('_ACA_MY_SITE', compa::encodeutf('Mit website:'));
define( '_ACA_LICENSE_FORM', compa::encodeutf(' ' .
 		'Klik her for at gå til licens formularen.</a>'));
define('_ACA_PLEASE_CLEAR_LICENSE', compa::encodeutf('Venligst slet licens feltet så det er tomt og prøv igen.<br />  Hvis problemet fortsætter, '));
define( '_ACA_LICENSE_SUPPORT', compa::encodeutf('Hvis du stadig har spørgsmål, ' . _ACA_PLEASE_LIC));
define( '_ACA_LICENSE_TWO', compa::encodeutf('du kan få din licens manuelt ved at indtaste token nummeret og website URL (som er fremhævet i grønt øverst på denne side) i licens formularen. '
			. _ACA_LICENSE_FORM . '<br /><br/>' . _ACA_LICENSE_SUPPORT));
define('_ACA_ENTER_TOKEN_PATIENCE', compa::encodeutf('Efter at have gemt din token vil en licens blive genereret automatisk. ' .
		' Normalt bliver token valideret i 2 minutter.  Uanset, in nogle tilfælde kan det tage op til 15 minuter.<br />' .
		'<br />Kontroller dette kontrolpanel om få minutter.  <br /><br />' .
						'Hvis du ikke modtog en valid licenskode inden for 15 minuter, '. _ACA_LICENSE_TWO));
define( '_ACA_ENTER_NOT_YET', compa::encodeutf('Din token er endnu ikke blivet valideret.'));
define( '_ACA_UPDATE_CLICK_HERE', compa::encodeutf('Venligst besøg <a href="http://www.ijoobi.com" target="_blank">www.ijoobi.com</a> for at downloade den nyeste version.'));
define( '_ACA_NOTIF_UPDATE', compa::encodeutf('For at blive notificeret om nye opdatering skal du indtaste din email adresse og klikke abonner '));


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
define('_ACA_REGWARN_NAME', compa::encodeutf('Angiv dit navn.'));
define('_ACA_REGWARN_MAIL', compa::encodeutf('Angiv en gyldig e-mailadresse.'));


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
if(!defined('_CMN_SAVE')) define('_CMN_SAVE', 'Save');
if(!defined('_NO_ACCOUNT')) define('_NO_ACCOUNT', 'No account yet?');
if(!defined('_CREATE_ACCOUNT')) define('_CREATE_ACCOUNT', 'Register');
if(!defined('_NOT_AUTH')) define('_NOT_AUTH','You are not authorised to view this resource.');

//since 3.0.0
define('_ACA_DISABLETOOLTIP', compa::encodeutf('Disable Tooltip'));
define('_ACA_DISABLETOOLTIP_TIPS', compa::encodeutf('Disable the tooltip on the frontend'));
define('_ACA_MINISENDMAIL', compa::encodeutf('Use Mini SendMail'));
define('_ACA_MINISENDMAIL_TIPS', compa::encodeutf('If your server use Mini SendMail, select this option to don\'t add the name of the user in the header of the e-mail'));

//Since 3.1.5
define('_ACA_READMORE','Read more...');
define('_ACA_VIEWARCHIVE','Click here');