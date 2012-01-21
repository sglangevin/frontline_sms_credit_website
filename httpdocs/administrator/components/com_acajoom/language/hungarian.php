<?php
defined('_JEXEC') OR defined('_VALID_MOS') OR die('...Direct Access to this location is not allowed...');


/**
* <p>Hungarian language file</p>
* @author Joobi Ltd <support@ijoobi.com>
* @version $Id: hungarian.php 401 2006-12-05 15:07:13Z divivo $
* @link http://www.joobiweb.com
*/

### General ###
 //acajoom Description
define('_ACA_DESC_NEWS', compa::encodeutf('Az Acajoom komponens egy hírlevélkezelõ, automatikus válaszoló és ellenõrzõ eszköz a felhasználókkal való kapcsolattartás hatékonysága érdekében.  Acajoom, az Ön kommunikációs partnere!'));
define('_ACA_FEATURES', compa::encodeutf('Acajoom, az Ön kommunikációs partnere!'));

// Type of lists
define('_ACA_NEWSLETTER', compa::encodeutf('Hírlevél'));
define('_ACA_AUTORESP', compa::encodeutf('Automatikus válaszoló'));
define('_ACA_AUTORSS', compa::encodeutf('Automatikus RSS'));
define('_ACA_ECARD', compa::encodeutf('eCard'));
define('_ACA_POSTCARD', compa::encodeutf('Képeslap'));
define('_ACA_PERF', compa::encodeutf('Mûködés'));
define('_ACA_COUPON', compa::encodeutf('Kupon'));
define('_ACA_CRON', compa::encodeutf('Idõzítés feladat'));
define('_ACA_MAILING', compa::encodeutf('Levelezés'));
define('_ACA_LIST', compa::encodeutf('Lista'));

 //acajoom Menu
define('_ACA_MENU_LIST', compa::encodeutf('Listakezelés'));
define('_ACA_MENU_SUBSCRIBERS', compa::encodeutf('Feliratkozók'));
define('_ACA_MENU_NEWSLETTERS', compa::encodeutf('Hírlevelek'));
define('_ACA_MENU_AUTOS', compa::encodeutf('Automatikus válaszolók'));
define('_ACA_MENU_COUPONS', compa::encodeutf('Kuponok'));
define('_ACA_MENU_CRONS', compa::encodeutf('Idõzítés feladatok'));
define('_ACA_MENU_AUTORSS', compa::encodeutf('Automatikus RSS'));
define('_ACA_MENU_ECARD', compa::encodeutf('eKépeslapok'));
define('_ACA_MENU_POSTCARDS', compa::encodeutf('Képeslapok'));
define('_ACA_MENU_PERFS', compa::encodeutf('Mûködések'));
define('_ACA_MENU_TAB_LIST', compa::encodeutf('Listák'));
define('_ACA_MENU_MAILING_TITLE', compa::encodeutf('Levelezések'));
define('_ACA_MENU_MAILING', compa::encodeutf('Levelezés: '));
define('_ACA_MENU_STATS', compa::encodeutf('Statisztika'));
define('_ACA_MENU_STATS_FOR', compa::encodeutf('Statisztika: '));
define('_ACA_MENU_CONF', compa::encodeutf('Beállítás'));
define('_ACA_MENU_UPDATE', compa::encodeutf('Frissítések'));
define('_ACA_MENU_ABOUT', compa::encodeutf('Névjegy'));
define('_ACA_MENU_LEARN', compa::encodeutf('Képzés központ'));
define('_ACA_MENU_MEDIA', compa::encodeutf('Média kezelõ'));
define('_ACA_MENU_HELP', compa::encodeutf('Súgó'));
define('_ACA_MENU_CPANEL', compa::encodeutf('Vezérlõpult'));
define('_ACA_MENU_IMPORT', compa::encodeutf('Import'));
define('_ACA_MENU_EXPORT', compa::encodeutf('Export'));
define('_ACA_MENU_SUB_ALL', compa::encodeutf('Mindet felirat'));
define('_ACA_MENU_UNSUB_ALL', compa::encodeutf('Mindet leirat'));
define('_ACA_MENU_VIEW_ARCHIVE', compa::encodeutf('Archivum'));
define('_ACA_MENU_PREVIEW', compa::encodeutf('Elõnézet'));
define('_ACA_MENU_SEND', compa::encodeutf('Küld'));
define('_ACA_MENU_SEND_TEST', compa::encodeutf('Teszt levél küldés'));
define('_ACA_MENU_SEND_QUEUE', compa::encodeutf('Feladatsor'));
define('_ACA_MENU_VIEW', compa::encodeutf('Megtekintés'));
define('_ACA_MENU_COPY', compa::encodeutf('Másolás'));
define('_ACA_MENU_VIEW_STATS', compa::encodeutf('Megtekintési statisztika'));
define('_ACA_MENU_CRTL_PANEL', compa::encodeutf(' Vezérlõpult'));
define('_ACA_MENU_LIST_NEW', compa::encodeutf(' Új lista'));
define('_ACA_MENU_LIST_EDIT', compa::encodeutf(' Lista szerkesztés'));
define('_ACA_MENU_BACK', compa::encodeutf('Vissza'));
define('_ACA_MENU_INSTALL', compa::encodeutf('Telepítés'));
define('_ACA_MENU_TAB_SUM', compa::encodeutf('Összegzés'));
define('_ACA_STATUS', compa::encodeutf('Állapot'));

// messages
define('_ACA_ERROR', compa::encodeutf(' Hiba történt! '));
define('_ACA_SUB_ACCESS', compa::encodeutf('Hozzáférési jogok'));
define('_ACA_DESC_CREDITS', compa::encodeutf('Készítõk'));
define('_ACA_DESC_INFO', compa::encodeutf('Információ'));
define('_ACA_DESC_HOME', compa::encodeutf('Webhely'));
define('_ACA_DESC_MAILING', compa::encodeutf('Levelezõ lista'));
define('_ACA_DESC_SUBSCRIBERS', compa::encodeutf('Feliratkozók'));
define('_ACA_PUBLISHED', compa::encodeutf('Publikálva'));
define('_ACA_UNPUBLISHED', compa::encodeutf('Visszavonva'));
define('_ACA_DELETE', compa::encodeutf('Törlés'));
define('_ACA_FILTER', compa::encodeutf('Szûrõ'));
define('_ACA_UPDATE', compa::encodeutf('Frissítés'));
define('_ACA_SAVE', compa::encodeutf('Mentés'));
define('_ACA_CANCEL', compa::encodeutf('Mégsem'));
define('_ACA_NAME', compa::encodeutf('Név'));
define('_ACA_EMAIL', compa::encodeutf('Email'));
define('_ACA_SELECT', compa::encodeutf('Válasszon!'));
define('_ACA_ALL', compa::encodeutf('Összes'));
define('_ACA_SEND_A', compa::encodeutf('Küldés: '));
define('_ACA_SUCCESS_DELETED', compa::encodeutf(' sikeresen törölve'));
define('_ACA_LIST_ADDED', compa::encodeutf('A lista sikeresen elkészült'));
define('_ACA_LIST_COPY', compa::encodeutf('A lista sikeresen másolva'));
define('_ACA_LIST_UPDATED', compa::encodeutf('A lista sikeresen frissítve'));
define('_ACA_MAILING_SAVED', compa::encodeutf('A levelezés sikeresen mentve.'));
define('_ACA_UPDATED_SUCCESSFULLY', compa::encodeutf('sikeresen frissítve.'));

### Subscribers information ###
//subscribe and unsubscribe info
define('_ACA_SUB_INFO', compa::encodeutf('Feliratkozói információk'));
define('_ACA_VERIFY_INFO', compa::encodeutf('Ellenõrizze a beküldött linket, néhány információ elveszett.'));
define('_ACA_INPUT_NAME', compa::encodeutf('Név'));
define('_ACA_INPUT_EMAIL', compa::encodeutf('Email'));
define('_ACA_RECEIVE_HTML', compa::encodeutf('HTML formátum?'));
define('_ACA_TIME_ZONE', compa::encodeutf('Idõzóna'));
define('_ACA_BLACK_LIST', compa::encodeutf('Fekete lista'));
define('_ACA_REGISTRATION_DATE', compa::encodeutf('Felhasználói regisztrációs dátum'));
define('_ACA_USER_ID', compa::encodeutf('Felhasználó az'));
define('_ACA_DESCRIPTION', compa::encodeutf('Leírás'));
define('_ACA_ACCOUNT_CONFIRMED', compa::encodeutf('A regisztrációja aktíválva.'));
define('_ACA_SUB_SUBSCRIBER', compa::encodeutf('Feliratkozó'));
define('_ACA_SUB_PUBLISHER', compa::encodeutf('Publikáló'));
define('_ACA_SUB_ADMIN', compa::encodeutf('Adminisztrátor'));
define('_ACA_REGISTERED', compa::encodeutf('Regisztrált'));
define('_ACA_SUBSCRIPTIONS', compa::encodeutf('Feliratkozások'));
define('_ACA_SEND_UNSUBCRIBE', compa::encodeutf('Leiratkozási üzenet küldése'));
define('_ACA_SEND_UNSUBCRIBE_TIPS', compa::encodeutf('Kattintson az Igen-re a leiratkozást megerõsítõ levél elküldéséhez!'));
define('_ACA_SUBSCRIBE_SUBJECT_MESS', compa::encodeutf('Kérjük, erõsítse meg a feliratkozását!'));
define('_ACA_UNSUBSCRIBE_SUBJECT_MESS', compa::encodeutf('Leiratkozás megerõsítése'));
define('_ACA_DEFAULT_SUBSCRIBE_MESS', compa::encodeutf('Kedves [NAME]!<br /><br />Még egy lépést kell megtennie a feliratkozás befejezéséig. Kattintson az alábbi linkre a feliratkozás megerõsítéséhez!<br /><br />[CONFIRM]<br /><br />Bármilyen kérdéssel forduljon az adminisztrátorhoz!<br /><br />Varanka Zoltán<br />(webmester - adminisztrátor)'));
define('_ACA_DEFAULT_UNSUBSCRIBE_MESS', compa::encodeutf('Kedves [NAME]!<br /><br />Ez egy megerõsítõ levél a hírlevél lemondásához. Sajnáljuk a döntését. Természetesen bármikor újra feliratkozhat a listára. Bármilyen kérdéssel forduljon az adminisztrátorhoz!<br /><br />Varanka Zoltán<br />(webmester - adminisztrátor)'));

// Acajoom subscribers
define('_ACA_SIGNUP_DATE', compa::encodeutf('Bejelentkezési dátum'));
define('_ACA_CONFIRMED', compa::encodeutf('Megerõsítve'));
define('_ACA_SUBSCRIB', compa::encodeutf('Feliratkozás'));
define('_ACA_HTML', compa::encodeutf('HTML levelezések'));
define('_ACA_RESULTS', compa::encodeutf('Eredmények'));
define('_ACA_SEL_LIST', compa::encodeutf('Válasszon egy listát!'));
define('_ACA_SEL_LIST_TYPE', compa::encodeutf('- Válasszon egy listatípust! -'));
define('_ACA_SUSCRIB_LIST', compa::encodeutf('Feliratkozók teljes listája'));
define('_ACA_SUSCRIB_LIST_UNIQUE', compa::encodeutf('Feliratkozók : '));
define('_ACA_NO_SUSCRIBERS', compa::encodeutf('Ebben a listában nincsenek feliratkozók.'));
define('_ACA_COMFIRM_SUBSCRIPTION', compa::encodeutf('Küldtünk Önnek egy megerõsítõ levelet. Nézze át a postaládáját és kattintson a levélben levõ linkre.<br />A feliratkozását meg kell erõsítenie a levél segítségével.'));
define('_ACA_SUCCESS_ADD_LIST', compa::encodeutf('Ön sikeresen bekerült a listába.'));


 // Subcription info
define('_ACA_CONFIRM_LINK', compa::encodeutf('Kattintson ide a feliratkozás megerõsítéséhez!'));
define('_ACA_UNSUBSCRIBE_LINK', compa::encodeutf('Kattintson ide a leiratkozáshoz!'));
define('_ACA_UNSUBSCRIBE_MESS', compa::encodeutf('Az Ön email címét eltávolítottuk a listából!'));

define('_ACA_QUEUE_SENT_SUCCESS', compa::encodeutf('Minden levél sikeresen elküldésre került.'));
define('_ACA_MALING_VIEW', compa::encodeutf('Levelezések megtekintése'));
define('_ACA_UNSUBSCRIBE_MESSAGE', compa::encodeutf('Biztosan szeretne leiratkozni a listáról?'));
define('_ACA_MOD_SUBSCRIBE', compa::encodeutf('Feliratkozás'));
define('_ACA_SUBSCRIBE', compa::encodeutf('Feliratkozás'));
define('_ACA_UNSUBSCRIBE', compa::encodeutf('Leiratkozás'));
define('_ACA_VIEW_ARCHIVE', compa::encodeutf('Archívum megtekintése'));
define('_ACA_SUBSCRIPTION_OR', compa::encodeutf(' vagy kattintson ide az Ön információinak a frissítéséhez!'));
define('_ACA_EMAIL_ALREADY_REGISTERED', compa::encodeutf('Ez az email cím már a listában van.'));
define('_ACA_SUBSCRIBER_DELETED', compa::encodeutf('A feliratkozó sikeresen törölve.'));


### UserPanel ###
 //User Menu
define('_UCP_USER_PANEL', compa::encodeutf('Felhasználói vezérlõpult'));
define('_UCP_USER_MENU', compa::encodeutf('Felhasználói menü'));
define('_UCP_USER_CONTACT', compa::encodeutf('Feliratkozásaim'));
 //Acajoom Cron Menu
define('_UCP_CRON_MENU', compa::encodeutf('Idõzítõ feladat kezelõ'));
define('_UCP_CRON_NEW_MENU', compa::encodeutf('Új idõzítés'));
define('_UCP_CRON_LIST_MENU', compa::encodeutf('Idõzítõm listája'));
 //Acajoom Coupon Menu
define('_UCP_COUPON_MENU', compa::encodeutf('Kupon kezelõ'));
define('_UCP_COUPON_LIST_MENU', compa::encodeutf('Kupon lista'));
define('_UCP_COUPON_ADD_MENU', compa::encodeutf('Új kupon hozzáadás'));

### lists ###
// Tabs
define('_ACA_LIST_T_GENERAL', compa::encodeutf('Leírás'));
define('_ACA_LIST_T_LAYOUT', compa::encodeutf('Kialakítás'));
define('_ACA_LIST_T_SUBSCRIPTION', compa::encodeutf('Feliratkozás'));
define('_ACA_LIST_T_SENDER', compa::encodeutf('Infó a küldõrõl'));

define('_ACA_LIST_TYPE', compa::encodeutf('Lista típus'));
define('_ACA_LIST_NAME', compa::encodeutf('Lista név'));
define('_ACA_LIST_ISSUE', compa::encodeutf('Kiadás száma'));
define('_ACA_LIST_DATE', compa::encodeutf('Küldés dátuma'));
define('_ACA_LIST_SUB', compa::encodeutf('Tárgy'));
define('_ACA_ATTACHED_FILES', compa::encodeutf('Csatolt fájlok'));
define('_ACA_SELECT_LIST', compa::encodeutf('Válassza ki a szerkesztendõ listát!'));

// Auto Responder box
define('_ACA_AUTORESP_ON', compa::encodeutf('Lista típus'));
define('_ACA_AUTO_RESP_OPTION', compa::encodeutf('Automatikus válaszoló opciók'));
define('_ACA_AUTO_RESP_FREQ', compa::encodeutf('A feliratkozók kiválaszthatják a gyakoriságot'));
define('_ACA_AUTO_DELAY', compa::encodeutf('Késleltetés (napokban)'));
define('_ACA_AUTO_DAY_MIN', compa::encodeutf('Minimális gyakoriság'));
define('_ACA_AUTO_DAY_MAX', compa::encodeutf('Maximális gyakoriság'));
define('_ACA_FOLLOW_UP', compa::encodeutf('Az automatikus válaszoló beállítása'));
define('_ACA_AUTO_RESP_TIME', compa::encodeutf('A feliratkozók idõt választhatnak'));
define('_ACA_LIST_SENDER', compa::encodeutf('Lista küldõ'));

define('_ACA_LIST_DESC', compa::encodeutf('Lista leírás'));
define('_ACA_LAYOUT', compa::encodeutf('Kialakítás'));
define('_ACA_SENDER_NAME', compa::encodeutf('Küldõ neve'));
define('_ACA_SENDER_EMAIL', compa::encodeutf('Küldõ email címe'));
define('_ACA_SENDER_BOUNCE', compa::encodeutf('Küldõ válasz címe'));
define('_ACA_LIST_DELAY', compa::encodeutf('Késleltetés'));
define('_ACA_HTML_MAILING', compa::encodeutf('HTML levél?'));
define('_ACA_HTML_MAILING_DESC', compa::encodeutf('(ha megváltoztatja ezt, mentenie kell majd visszatérni ehhez a képernyõhöz a változások megtekintésére.)'));
define('_ACA_HIDE_FROM_FRONTEND', compa::encodeutf('Elrejtés a webes felületen?'));
define('_ACA_SELECT_IMPORT_FILE', compa::encodeutf('Válassza ki az importálandó fájlt!'));;
define('_ACA_IMPORT_FINISHED', compa::encodeutf('Az importálás befejezõdött'));
define('_ACA_DELETION_OFFILE', compa::encodeutf('Fájl törlése'));
define('_ACA_MANUALLY_DELETE', compa::encodeutf('meghiusult, kézzel kell törölnie a fájlt'));
define('_ACA_CANNOT_WRITE_DIR', compa::encodeutf('A könyvtár nem írható'));
define('_ACA_NOT_PUBLISHED', compa::encodeutf('A levél nem küldhetõ el, a lista nincs publikálva.'));

//  List info box
define('_ACA_INFO_LIST_PUB', compa::encodeutf('Kattintson ide a lista publikálásához!'));
define('_ACA_INFO_LIST_NAME', compa::encodeutf('Adja meg a lista nevét itt! Ezzel a névvel azonosíthatja a listát!'));
define('_ACA_INFO_LIST_DESC', compa::encodeutf('Adja meg a lista rövid leírását! Ezt a leírást látják a felhasználók.'));
define('_ACA_INFO_LIST_SENDER_NAME', compa::encodeutf('Adja meg a levél küldõjének a nevét! Ezt a nevetlátják a feliratkozók, amikor levelet kapnak a listáról.'));
define('_ACA_INFO_LIST_SENDER_EMAIL', compa::encodeutf('Adja meg azt az email címet, ahonnan az üzenetek küldésre kerülnek.'));
define('_ACA_INFO_LIST_SENDER_BOUNCED', compa::encodeutf('Adja meg azt az email címet,, ahova a feliratkozók válaszolhatnak. Ajánlatos, hogy ez megegyezzen a küldõ email címmel, mivel a spam szûrõk magasabb kockázatként kezelik, ha ezek különbözõek.'));
define('_ACA_INFO_LIST_AUTORESP', compa::encodeutf('Válassza ki a levelezés típusát ehhez a listához!<br />Hírlevél: normál hírlevél<br />Automatikus válaszoló: ez egy lista, amely megadott idõközönként küld levelet.'));
define('_ACA_INFO_LIST_FREQUENCY', compa::encodeutf('A felhasznlók megválaszthatják, hogy milyen gyakran kapjanak levelet. Ez nagy rugalmasságot biztosít.'));
define('_ACA_INFO_LIST_TIME', compa::encodeutf('A felhasználók megválaszthatják, hogy a hát melyik napján kapjanak levelet.'));
define('_ACA_INFO_LIST_MIN_DAY', compa::encodeutf('Milyen legyen az a minimális gyakoriság, amelyet a felhasználók megválaszthatnak, ha be akarják állítani a levelek fogadásának gyakorisságát?'));
define('_ACA_INFO_LIST_DELAY', compa::encodeutf('Adja meg a késleltetést az elõzõ és ezen automatikus válaszoló között!'));
define('_ACA_INFO_LIST_DATE', compa::encodeutf('Adja meg, mikor legyen publikálva a herlevél, ha késleltetettnek lett beállítva!<br /> Formátum: ÉÉÉÉ-HH-NN ÓÓ:PP:MM'));
define('_ACA_INFO_LIST_MAX_DAY', compa::encodeutf('Milyen legyen az a maximális gyakoriság, amelyet a felhasználók megválaszthatnak, ha be akarják állítani a levelek fogadásának gyakorisságát?'));
define('_ACA_INFO_LIST_LAYOUT', compa::encodeutf('Itt adhatja meg a levél kialakítását. Bármilyen kialakítást megadhat.'));
define('_ACA_INFO_LIST_SUB_MESS', compa::encodeutf('Ez a levél kerül elküldésre a felhasználónak az elsõ feliratkozáskor. Bármilyen szöveget meg lehet itt adni.'));
define('_ACA_INFO_LIST_UNSUB_MESS', compa::encodeutf('Ez a levél kerül elküldésre a felhasználónak az leiratkozik. Bármilyen szöveget meg lehet itt adni.'));
define('_ACA_INFO_LIST_HTML', compa::encodeutf('Pipálja ki a kijelölõdobozt, ha HTMLformában akarja a levelet elküldeni. A feliratkozók megadhatják, hogy HTML vagy szöveges formában kívánják-e fogadnia leveleket, amikor egy HTML listára iratkoznak fel.'));
define('_ACA_INFO_LIST_HIDDEN', compa::encodeutf('Kattintson az Igen-re a lista elrejtéséhez a webes felületen, a felhasználók ugyan nem iratkozhatnak fel,de azért meg lehet levelet küldeni.'));
define('_ACA_INFO_LIST_ACA_AUTO_SUB', compa::encodeutf('Szeretné, hogy a felhasználók automatikusan feliratkozzanak erre a listára?<br /><B>Új felhasználók:</B>minden új felhasználó, aki regisztrál, feliratkozó is lesz egyben.<br /><B>Összes felhasználó:</B> minden regisztrált felhasználó feliratkozó is lesz egyben.<br />(támogatja a Community Buildert)'));
define('_ACA_INFO_LIST_ACC_LEVEL', compa::encodeutf('Válassza ki a webes felület hozzáférési szintjét! Ez megjeleníti vagy elrejti a levelezést azon csoportok esetén, amelynek nincs hozzáférési joga, tehát nem tudnak feliratkozni.'));
define('_ACA_INFO_LIST_ACC_USER_ID', compa::encodeutf('Válassza ki a hozzáférési szintjét annak a csoportnak, amelynek engedélyezni szeretmé a szerkesztést. Ez és az e feletti csoport szerkesztheti a levelezést és levelet küldhet ki mind a webes mind az adminisztrációs felületrõl.'));
define('_ACA_INFO_LIST_FOLLOW_UP', compa::encodeutf('Ha szeretné az automatikus válaszolót egy másokba mozgatni, amint eléri az utolsó üzenetet, megadhatja itt a nyomkövetõ automatikus válaszolót.'));
define('_ACA_INFO_LIST_ACA_OWNER', compa::encodeutf('Ez a listát lértehozó személy azonosítója.'));
define('_ACA_INFO_LIST_WARNING', compa::encodeutf('   Ez az utolsó opció csak a lista létrehozásakor elérhetõ.'));
define('_ACA_INFO_LIST_SUBJET', compa::encodeutf(' A levelezés tárgya. Ez a szöveg kerül a levél tárgyába.'));
define('_ACA_INFO_MAILING_CONTENT', compa::encodeutf('Ez az elküldendõ levél törzse.'));
define('_ACA_INFO_MAILING_NOHTML', compa::encodeutf('Adja meg a levél törzsét, amelyet azoknak a feliratkozóknak kell elküldeni, akik csak szöveges levelet fogadnak. <BR/> Megjegyzés: ha üresen hagyja, a html formátumú szövegrész kerül ide szöveges formátumban.'));
define('_ACA_INFO_MAILING_VISIBLE', compa::encodeutf('Kattintson az Igen-re a levelezések megjelenítéséhez a webes felületen.'));
define('_ACA_INSERT_CONTENT', compa::encodeutf('Létezõ tartalom beszúrása'));

// Coupons
define('_ACA_SEND_COUPON_SUCCESS', compa::encodeutf('A kupon sikeresen elküldve!'));
define('_ACA_CHOOSE_COUPON', compa::encodeutf('Válasszon kupont!'));
define('_ACA_TO_USER', compa::encodeutf(' ennek a felhasználónak'));

### Cron options
//drop down frequency(CRON)
define('_ACA_FREQ_CH1', compa::encodeutf('Minden órában'));
define('_ACA_FREQ_CH2', compa::encodeutf('Minden 6 órában'));
define('_ACA_FREQ_CH3', compa::encodeutf('Minden 12 órában'));
define('_ACA_FREQ_CH4', compa::encodeutf('Naponta'));
define('_ACA_FREQ_CH5', compa::encodeutf('Hetente'));
define('_ACA_FREQ_CH6', compa::encodeutf('Havonta'));
define('_ACA_FREQ_NONE', compa::encodeutf('Nem'));
define('_ACA_FREQ_NEW', compa::encodeutf('Új felhasználól'));
define('_ACA_FREQ_ALL', compa::encodeutf('Összes felhasználó'));

//Label CRON form
define('_ACA_LABEL_FREQ', compa::encodeutf('Acajoom idõzítõ?'));
define('_ACA_LABEL_FREQ_TIPS', compa::encodeutf('Kattintson az Igen-re, ha használni szeretné az Acajoom idõzítõtCron, A Nem beállítása más idõzítõ használatát teszi lehetõvé.<br />Ha az Igem-re kattint, nem kell megadnia az idõzítõ címét, ez automatikusan hozzáadódik.'));
define('_ACA_SITE_URL', compa::encodeutf('Az Ön webhelyének URL-je'));
define('_ACA_CRON_FREQUENCY', compa::encodeutf('Idõzítõ gyakoriság'));
define('_ACA_STARTDATE_FREQ', compa::encodeutf('Kezdõ dátum'));
define('_ACA_LABELDATE_FREQ', compa::encodeutf('Adja meg a dátumot!'));
define('_ACA_LABELTIME_FREQ', compa::encodeutf('Adja meg az idõt!'));
define('_ACA_CRON_URL', compa::encodeutf('Idõzítõ URL'));
define('_ACA_CRON_FREQ', compa::encodeutf('Gyakoriság'));
define('_ACA_TITLE_CRONLIST', compa::encodeutf('Idõzítõ lista'));
define('_NEW_LIST', compa::encodeutf('Új lista készítése'));

//title CRON form
define('_ACA_TITLE_FREQ', compa::encodeutf('Idõzítõ szerkesztése'));
define('_ACA_CRON_SITE_URL', compa::encodeutf('Érvényes webhely URL-t adjon meg, kezdje http://-vel!'));

### Mailings ###
define('_ACA_MAILING_ALL', compa::encodeutf('Összes levelezés'));
define('_ACA_EDIT_A', compa::encodeutf('Szerkesztés: '));
define('_ACA_SELCT_MAILING', compa::encodeutf('Válasszon egy listát a legördülõ menüben új levelezés hozzáadásához!'));
define('_ACA_VISIBLE_FRONT', compa::encodeutf('Látható a webes felületen'));

// mailer
define('_ACA_SUBJECT', compa::encodeutf('Tárgy'));
define('_ACA_CONTENT', compa::encodeutf('Tartalom'));
define('_ACA_NAMEREP', compa::encodeutf('[NAME] = A feliratkozó nevére cserélõdik ki ez a kód, ezzel személyre szabhatja a levelet.<br />'));
define('_ACA_FIRST_NAME_REP', compa::encodeutf('[FIRSTNAME] = A feliratkozó vezetéknevére (elsõ név) cserélõdik ki ez a kód.<br />'));
define('_ACA_NONHTML', compa::encodeutf('Nem-html verzió'));
define('_ACA_ATTACHMENTS', compa::encodeutf('Mellékletek'));
define('_ACA_SELECT_MULTIPLE', compa::encodeutf('Tartsa lenyomva a CTRL (vagy a Command) gombot több melléklet kiválasztásához.<br />A mellékletek listájában megjelenõ fájlokat egy külön könyvtárban helyezheti el, ez a könyvtár beállítható a beállítások paneljén.'));
define('_ACA_CONTENT_ITEM', compa::encodeutf('Tartalmi elem'));
define('_ACA_SENDING_EMAIL', compa::encodeutf('Levél küldése'));
define('_ACA_MESSAGE_NOT', compa::encodeutf('A levél nem küldhetõ el'));
define('_ACA_MAILER_ERROR', compa::encodeutf('Levélküldési hiba'));
define('_ACA_MESSAGE_SENT_SUCCESSFULLY', compa::encodeutf('A levél sikeresen elküldve'));
define('_ACA_SENDING_TOOK', compa::encodeutf('A levél elkóldése'));
define('_ACA_SECONDS', compa::encodeutf('másodpercet vett igénybe'));
define('_ACA_NO_ADDRESS_ENTERED', compa::encodeutf('Nincs email cím vagy feliratkozó megadva!'));
define('_ACA_CHANGE_SUBSCRIPTIONS', compa::encodeutf('Változtatás'));
define('_ACA_CHANGE_EMAIL_SUBSCRIPTION', compa::encodeutf('Változtat a feliratkozáson?'));
define('_ACA_WHICH_EMAIL_TEST', compa::encodeutf('Adja meg a tesztelésre használt email címet vagy válassza az elõnézetet!'));
define('_ACA_SEND_IN_HTML', compa::encodeutf('Küldés HTML módban (HTML leveleknél)?'));
define('_ACA_VISIBLE', compa::encodeutf('Látható'));
define('_ACA_INTRO_ONLY', compa::encodeutf('Csak bevezetõ'));

// stats
define('_ACA_GLOBALSTATS', compa::encodeutf('Globalis statisztika'));
define('_ACA_DETAILED_STATS', compa::encodeutf('Részletes statisztika'));
define('_ACA_MAILING_LIST_DETAILS', compa::encodeutf('Lista részletek'));
define('_ACA_SEND_IN_HTML_FORMAT', compa::encodeutf('Küldés HTML formátumban'));
define('_ACA_VIEWS_FROM_HTML', compa::encodeutf('Megtekintve (csak html leveleknél)'));
define('_ACA_SEND_IN_TEXT_FORMAT', compa::encodeutf('Küldés szöveges formátumban'));
define('_ACA_HTML_READ', compa::encodeutf('HTML olvasott'));
define('_ACA_HTML_UNREAD', compa::encodeutf('HTML nem olvasott'));
define('_ACA_TEXT_ONLY_SENT', compa::encodeutf('Csak szöveg'));

// Configuration panel
// main tabs
define('_ACA_MAIL_CONFIG', compa::encodeutf('Levél'));
define('_ACA_LOGGING_CONFIG', compa::encodeutf('Napló-statisztika'));
define('_ACA_SUBSCRIBER_CONFIG', compa::encodeutf('Feliratkozók'));
define('_ACA_MISC_CONFIG', compa::encodeutf('Egyéb'));
define('_ACA_MAIL_SETTINGS', compa::encodeutf('Levél beállítások'));
define('_ACA_MAILINGS_SETTINGS', compa::encodeutf('Levelezési beállítások'));
define('_ACA_SUBCRIBERS_SETTINGS', compa::encodeutf('Feliratkozó beállítások'));
define('_ACA_CRON_SETTINGS', compa::encodeutf('Idõzítõ beállítások'));
define('_ACA_SENDING_SETTINGS', compa::encodeutf('Küldési beállítások'));
define('_ACA_STATS_SETTINGS', compa::encodeutf('Statisztikai beállítások'));
define('_ACA_LOGS_SETTINGS', compa::encodeutf('Napló beállítások'));
define('_ACA_MISC_SETTINGS', compa::encodeutf('Egyéb beállítások'));
// mail settings
define('_ACA_SEND_MAIL_FROM', compa::encodeutf('Küldõ email'));
define('_ACA_SEND_MAIL_NAME', compa::encodeutf('Küldõ név'));
define('_ACA_MAILSENDMETHOD', compa::encodeutf('Levélküldõ mód'));
define('_ACA_SENDMAILPATH', compa::encodeutf('Sendmail útvonal'));
define('_ACA_SMTPHOST', compa::encodeutf('SMTP kiszolgáló'));
define('_ACA_SMTPAUTHREQUIRED', compa::encodeutf('SMTP hitelesítés szükséges'));
define('_ACA_SMTPAUTHREQUIRED_TIPS', compa::encodeutf('Válassza az Igen-t, ha az MTP szerver hitelesítést igényel'));
define('_ACA_SMTPUSERNAME', compa::encodeutf('SMTP felhasználónév'));
define('_ACA_SMTPUSERNAME_TIPS', compa::encodeutf('Adja meg az SMTP felhasználónevet, ha az SMTP szerver hitelesítést igényel!'));
define('_ACA_SMTPPASSWORD', compa::encodeutf('SMTP jelszó'));
define('_ACA_SMTPPASSWORD_TIPS', compa::encodeutf('Adja meg az SMTP jelszót, ha az SMTP szerver hitelesítést igényel!'));
define('_ACA_USE_EMBEDDED', compa::encodeutf('Beágyazott képek'));
define('_ACA_USE_EMBEDDED_TIPS', compa::encodeutf('Válassza az Igen-t, ha a mellékelt képeket be kell ágyazni a levélbe html formátum esetén vagy a Nem-et, ha a képek linkjeit szeretné elküldeni a levélben.'));
define('_ACA_UPLOAD_PATH', compa::encodeutf('Feltöltési/csatolási útvonal'));
define('_ACA_UPLOAD_PATH_TIPS', compa::encodeutf('Megadhatja a feltöltési könyvtárat.<br />Ellenõrizze, hogy a könyvtár létezik-e, ha szükséges hozza létre!'));

// subscribers settings
define('_ACA_ALLOW_UNREG', compa::encodeutf('Nem regisztráltak is'));
define('_ACA_ALLOW_UNREG_TIPS', compa::encodeutf('Válassza az Igen-t, ha a nem regisztrált felhasználók is feliratkozhatnak a listákra.'));
define('_ACA_REQ_CONFIRM', compa::encodeutf('Megerõsítés szükséges'));
define('_ACA_REQ_CONFIRM_TIPS', compa::encodeutf('Válassza az Igen-t, ha a nem regisztrált felhasználóknak meg kell erõsíteniük az email címüket.'));
define('_ACA_SUB_SETTINGS', compa::encodeutf('Feliratkozási beállítások'));
define('_ACA_SUBMESSAGE', compa::encodeutf('Feliratkozó levél'));
define('_ACA_SUBSCRIBE_LIST', compa::encodeutf('Feliratkozás egy listára'));

define('_ACA_USABLE_TAGS', compa::encodeutf('Használható címkék'));
define('_ACA_NAME_AND_CONFIRM', compa::encodeutf('<b>[CONFIRM]</b> = Kattintható linket készít, amellyel a feliratkozó megerõsítheti a feliratkozását. Ez <strong>szükséges</strong> az Acajoom megfelelõ mûködéséhez.<br /><br />[NAME] = Lecserélõdik a feliratkozó nevére, személyreszabva a küldött levelet.<br /><br />[FIRSTNAME] = Lecserélõdik a feliratkozó elsõ nevére (vezetéknév).<br />'));
define('_ACA_CONFIRMFROMNAME', compa::encodeutf('Megerõsítõ feladó név'));
define('_ACA_CONFIRMFROMNAME_TIPS', compa::encodeutf('Adja meg a megerõsítõ listában megjelenõ nevet!'));
define('_ACA_CONFIRMFROMEMAIL', compa::encodeutf('Megerõsító feladó email cím'));
define('_ACA_CONFIRMFROMEMAIL_TIPS', compa::encodeutf('Adja meg a megerõsítõ listában megjelenõ email címet!'));
define('_ACA_CONFIRMBOUNCE', compa::encodeutf('Válasz cím'));
define('_ACA_CONFIRMBOUNCE_TIPS', compa::encodeutf('Adja meg a megerõsítõ listában megjelenõ válasz email címet!'));
define('_ACA_HTML_CONFIRM', compa::encodeutf('HTML megerõsítés'));
define('_ACA_HTML_CONFIRM_TIPS', compa::encodeutf('Vélassza az Igen-t, ha a megerõsítõ levelet html formában szeretné elküldeni, ha a feliratjozó lehetõvé teszi a html levél fogadását..'));
define('_ACA_TIME_ZONE_ASK', compa::encodeutf('Rákérdezés az idõzónára'));
define('_ACA_TIME_ZONE_TIPS', compa::encodeutf('Válassza az Igen-t, ha rá szeretne kérdezni a felhasználó idõzónájára. A levél a felhasználónak megfelelõ idõzóna szerinti idõben lesz elküldve, ahol ez alkalmazható.'));

 // Cron Set up
define('_ACA_AUTO_CONFIG', compa::encodeutf('Idõzítõ'));
define('_ACA_TIME_OFFSET_URL', compa::encodeutf('kattintson ide az eltolás beállításához az General Settings oldal Locale fülén'));
define('_ACA_TIME_OFFSET_TIPS', compa::encodeutf('Beállítja a szerver idõeltolását, hogy a felvett dátum és idõ adatok pontosak legyenek'));
define('_ACA_TIME_OFFSET', compa::encodeutf('Idõ eltolás'));
define('_ACA_CRON_DESC', compa::encodeutf('<br />Az idõzítõ funkcióval automatikus feladatot lehet beállítani a Joomla webhelyen!<br />Beállításához az alábbi utasítást kell adni az idõzítõ vezérlõpulthoz:<br /><b>' . ACA_JPATH_LIVE . '/index2.php?option=com_acajoom&act=cron</b> <br /><br />Ha segítségre van szüksége, keresse fel a <a href="http://www.ijoobi.com" target="_blank">http://www.ijoobi.com</a> oldal fórumát!'));
// sending settings
define('_ACA_PAUSEX', compa::encodeutf('Várakozzon x másodpercet minden beállított mennyiségû levélnél'));
define('_ACA_PAUSEX_TIPS', compa::encodeutf('Adja meg azt at idõt másodpercben, ameddig az Acajoom várakozik, mielõtt a következõ adag levelet elküldi.'));
define('_ACA_EMAIL_BET_PAUSE', compa::encodeutf('Levéladagok száma'));
define('_ACA_EMAIL_BET_PAUSE_TIPS', compa::encodeutf('Az egyszerre elküldhetõ levelek száma.'));
define('_ACA_WAIT_USER_PAUSE', compa::encodeutf('Várakozás felhasználói bevitelte'));
define('_ACA_WAIT_USER_PAUSE_TIPS', compa::encodeutf('Két adag levél elküldése közben várakozzon-e a program felhasználói bevitelre?'));
define('_ACA_SCRIPT_TIMEOUT', compa::encodeutf('Idõ kifutás'));
define('_ACA_SCRIPT_TIMEOUT_TIPS', compa::encodeutf('Idõ másodpercben, ameddig a program futhat.'));
// Stats settings
define('_ACA_ENABLE_READ_STATS', compa::encodeutf('Statisztika olvasásának engedélyezése'));
define('_ACA_ENABLE_READ_STATS_TIPS', compa::encodeutf('Válasszon Igen-t, ha szeretné naplózni a megtekintések számát. Ez csak html leveleknél használható'));
define('_ACA_LOG_VIEWSPERSUB', compa::encodeutf('Megtekintések naplózása feliratkozókként'));
define('_ACA_LOG_VIEWSPERSUB_TIPS', compa::encodeutf('Válasszon Igen-t, ha szeretné naplózni a megtekintések számát felhasználókként. Ez csak html leveleknél használható'));
// Logs settings
define('_ACA_DETAILED', compa::encodeutf('Részletes napló'));
define('_ACA_SIMPLE', compa::encodeutf('Egyszerû napló'));
define('_ACA_DIAPLAY_LOG', compa::encodeutf('Napló megjelenítése'));
define('_ACA_DISPLAY_LOG_TIPS', compa::encodeutf('Válassza az Igen-t, ha szeretné megjeleníteni a naplózást a levelek elküldése során.'));
define('_ACA_SEND_PERF_DATA', compa::encodeutf('Küldési mûvelet'));
define('_ACA_SEND_PERF_DATA_TIPS', compa::encodeutf('Válassza az Igen-t, ha szeretne jelentést kapni a beállításokról, a feliratkozók számáról és az elküldés idõtartamáról. Ez informáiót ad az Acajoom mûködésérõl.'));
define('_ACA_SEND_AUTO_LOG', compa::encodeutf('Napló elküldése az automatikus válaszolónak.'));
define('_ACA_SEND_AUTO_LOG_TIPS', compa::encodeutf('Válassza az Igen-t, ha a naplót szeretné elküldeni minden alkalommal, amikor a rendszer levelet küld. Figyelem: ez nagy méretû levelet is jelenthet.'));
define('_ACA_SEND_LOG', compa::encodeutf('Napló küldése'));
define('_ACA_SEND_LOG_TIPS', compa::encodeutf('Küldjön-e naplót a rendszer a levél küldõjének a címére.'));
define('_ACA_SEND_LOGDETAIL', compa::encodeutf('Részletes napló küldése'));
define('_ACA_SEND_LOGDETAIL_TIPS', compa::encodeutf('Információ arról, hogy sikeres volt-e a levél elküldése az egyes feliratkozóknak. Alapban csak áttekintést küld.'));
define('_ACA_SEND_LOGCLOSED', compa::encodeutf('Napló küldése, ha megszakad a kapcsolat'));
define('_ACA_SEND_LOGCLOSED_TIPS', compa::encodeutf('Ezzel az opcióval a küldõ minden esetben jelentést kap az elküldésekrõl.'));
define('_ACA_SAVE_LOG', compa::encodeutf('Napló mentése'));
define('_ACA_SAVE_LOG_TIPS', compa::encodeutf('A levelezés naplóbejegyzése bekerüljön-e a naplófájlba?'));
define('_ACA_SAVE_LOGDETAIL', compa::encodeutf('Részletes napló mentése'));
define('_ACA_SAVE_LOGDETAIL_TIPS', compa::encodeutf('A részletes bejegyzés tartalmazza minden feliratkozóhoz elküldött levél sikerességét vagy meghiúsulását. At egyszerû csak áttekintést ad.'));
define('_ACA_SAVE_LOGFILE', compa::encodeutf('Naplófájl mentése'));
define('_ACA_SAVE_LOGFILE_TIPS', compa::encodeutf('Az a fájl, amibe a naplóbejegyzés kerül.Ez a fájl nagy méretûre is növekedhet.'));
define('_ACA_CLEAR_LOG', compa::encodeutf('Napló törlése'));
define('_ACA_CLEAR_LOG_TIPS', compa::encodeutf('Törli a napló fájl tartalmát.'));

### control panel
define('_ACA_CP_LAST_QUEUE', compa::encodeutf('Utoljára lefuttatott feladat'));
define('_ACA_CP_TOTAL', compa::encodeutf('Összes'));
define('_ACA_MAILING_COPY', compa::encodeutf('A levelezés sikeresen másolva!'));

// Miscellaneous settings
define('_ACA_SHOW_GUIDE', compa::encodeutf('Sorvezetõ használata'));
define('_ACA_SHOW_GUIDE_TIPS', compa::encodeutf('Jelenítse meg a sorvezetõt a használat elején segítve az új felhasználókat egy hírlvél, egy automatikus válaszoló létrehozásában és az Acajoom megfelelõ beállításában.'));
define('_ACA_AUTOS_ON', compa::encodeutf('Automatikus válaszolók használata'));
define('_ACA_AUTOS_ON_TIPS', compa::encodeutf('Válasszon Nem-et, ha nem akarja használni az automatikus válaszokókat, minden automatikus válaszoló kikapcsol.'));
define('_ACA_NEWS_ON', compa::encodeutf('Hírlevelek használata'));
define('_ACA_NEWS_ON_TIPS', compa::encodeutf('Válasszon Nem-t, ha nem akarja használni a hírleveleket, minden hírlevél opció kikapcsol.'));
define('_ACA_SHOW_TIPS', compa::encodeutf('Tippek megjelenítése'));
define('_ACA_SHOW_TIPS_TIPS', compa::encodeutf('Tippek megjelenítése a nagyobb hatékonyság érdekében.'));
define('_ACA_SHOW_FOOTER', compa::encodeutf('Lábléc megjelenítése'));
define('_ACA_SHOW_FOOTER_TIPS', compa::encodeutf('Megjelenjen-e a lábléc a copyright szöveggel.'));
define('_ACA_SHOW_LISTS', compa::encodeutf('Listák megjelenítése a webes felületen'));
define('_ACA_SHOW_LISTS_TIPS', compa::encodeutf('Ha a felhasználó nincs bejelentkezve, megjeleníti a listát illetve bejelentkezhetnek vagy regisztrálhatnak.'));
define('_ACA_CONFIG_UPDATED', compa::encodeutf('A konfigurációs beálítások frissítve!'));
define('_ACA_UPDATE_URL', compa::encodeutf('URL frissítése'));
define('_ACA_UPDATE_URL_WARNING', compa::encodeutf('Figyelem! Ne változtassa meg az URL-t, hacsak nem kért engedélyt az Acajoom technikai csapatától.<br />'));
define('_ACA_UPDATE_URL_TIPS', compa::encodeutf('Például: http://www.ijoobi.com/update/ (tartalmazza a lezáró perjelet)'));

// module
define('_ACA_EMAIL_INVALID', compa::encodeutf('A megadott email cím érvénytelen!'));
define('_ACA_REGISTER_REQUIRED', compa::encodeutf('Regisztráljon a feliratkozás elõtt!'));

// Access level box
define('_ACA_OWNER', compa::encodeutf('Lista készítõ:'));
define('_ACA_ACCESS_LEVEL', compa::encodeutf('Adja meg a lista hozzáférésének a szintjét!'));
define('_ACA_ACCESS_LEVEL_OPTION', compa::encodeutf('Hozzáférési szint opciók'));
define('_ACA_USER_LEVEL_EDIT', compa::encodeutf('Válassza ki, melyik szintnek van engedélyezve a levelezések szerkesztése (a webes vagy az adminisztrációs felületrõl'));

//  drop down options
define('_ACA_AUTO_DAY_CH1', compa::encodeutf('Naponta'));
define('_ACA_AUTO_DAY_CH2', compa::encodeutf('Naponta hétvége kivételével'));
define('_ACA_AUTO_DAY_CH3', compa::encodeutf('Minden másnap'));
define('_ACA_AUTO_DAY_CH4', compa::encodeutf('Minden másnap hétvége kivételével'));
define('_ACA_AUTO_DAY_CH5', compa::encodeutf('Hetente'));
define('_ACA_AUTO_DAY_CH6', compa::encodeutf('Kéthetente'));
define('_ACA_AUTO_DAY_CH7', compa::encodeutf('Havonta'));
define('_ACA_AUTO_DAY_CH9', compa::encodeutf('Évente'));
define('_ACA_AUTO_OPTION_NONE', compa::encodeutf('Nem'));
define('_ACA_AUTO_OPTION_NEW', compa::encodeutf('Új felhasználók'));
define('_ACA_AUTO_OPTION_ALL', compa::encodeutf('Összes felhasználó'));

//
define('_ACA_UNSUB_MESSAGE', compa::encodeutf('Leiratkozó levél'));
define('_ACA_UNSUB_SETTINGS', compa::encodeutf('Leiratkozó beállítások'));
define('_ACA_AUTO_ADD_NEW_USERS', compa::encodeutf('Felhasználók automatikus feliratkozása?'));

// Update and upgrade messages
define('_ACA_NO_UPDATES', compa::encodeutf('Jelenleg nincs elérhetõ frissítés.'));
define('_ACA_VERSION', compa::encodeutf('Acajoom verzió'));
define('_ACA_NEED_UPDATED', compa::encodeutf('Frissítendõ fájlok:'));
define('_ACA_NEED_ADDED', compa::encodeutf('Hozzáadandó fájlok:'));
define('_ACA_NEED_REMOVED', compa::encodeutf('Eltávolítandó fájlok:'));
define('_ACA_FILENAME', compa::encodeutf('Fájlnév:'));
define('_ACA_CURRENT_VERSION', compa::encodeutf('Aktuális verzió:'));
define('_ACA_NEWEST_VERSION', compa::encodeutf('Legfrissebb verzió:'));
define('_ACA_UPDATING', compa::encodeutf('Frissítés'));
define('_ACA_UPDATE_UPDATED_SUCCESSFULLY', compa::encodeutf('A fájlok sikeresen frissítve.'));
define('_ACA_UPDATE_FAILED', compa::encodeutf('A frissítés meghiúsult'));
define('_ACA_ADDING', compa::encodeutf('Hozzáadás'));
define('_ACA_ADDED_SUCCESSFULLY', compa::encodeutf('Sikeresen hozzáadva.'));
define('_ACA_ADDING_FAILED', compa::encodeutf('A hozzáadás meghiúsult!'));
define('_ACA_REMOVING', compa::encodeutf('Eltávolítás'));
define('_ACA_REMOVED_SUCCESSFULLY', compa::encodeutf('Sikeresen eltávolítva.'));
define('_ACA_REMOVING_FAILED', compa::encodeutf('Az eltávolítás meghiúsult!'));
define('_ACA_INSTALL_DIFFERENT_VERSION', compa::encodeutf('Másik verzió telepítése'));
define('_ACA_CONTENT_ADD', compa::encodeutf('Tartalom hozzáadás'));
define('_ACA_UPGRADE_FROM', compa::encodeutf('Adatok importálása (névlevél és feliratkozó információ) : '));
define('_ACA_UPGRADE_MESS', compa::encodeutf('A létezõ adatok nincsenek veszélyben.<br />Ez a mûvelet csak importálja az adatokat az Acajoom adatbázisába.'));
define('_ACA_CONTINUE_SENDING', compa::encodeutf('Küldés folytatása'));

// Acajoom message
define('_ACA_UPGRADE1', compa::encodeutf('Könnyen importálhatja a felhasználókat és a hírleveleket: '));
define('_ACA_UPGRADE2', compa::encodeutf(' az Acajoomba a frissítési panelen.'));
define('_ACA_UPDATE_MESSAGE', compa::encodeutf('Elérhetõ az Acajoom új verziója! '));
define('_ACA_UPDATE_MESSAGE_LINK', compa::encodeutf('Kattintson ide a frissítéshez!'));
define('_ACA_THANKYOU', compa::encodeutf('Köszönjük, hogy az Acajoom-ot, az Ön kommunikációs partnerét választotta!'));
define('_ACA_NO_SERVER', compa::encodeutf('A frissítõ szerver nem érhetõ el, ellenõrizze késõbb!'));
define('_ACA_MOD_PUB', compa::encodeutf('Az Acajoom modul még nincs publikálva!'));
define('_ACA_MOD_PUB_LINK', compa::encodeutf('Kattintson ide a publikáláshoz!'));
define('_ACA_IMPORT_SUCCESS', compa::encodeutf('Sikeresen importálva'));
define('_ACA_IMPORT_EXIST', compa::encodeutf('A feliratkozó már az adatbázisban van'));

// Acajoom's Guide
define('_ACA_GUIDE', compa::encodeutf(' varázsló'));
define('_ACA_GUIDE_FIRST_ACA_STEP', compa::encodeutf('<p>Az Acajoom számtalan sajátsággal rendelkezik, ez a varázsló végig vezeti Önt négy egyszerû lépésen, amellyel el tudja készíteni hírleveleit és automatikus válaszolóit!<p />'));
define('_ACA_GUIDE_FIRST_ACA_STEP_DESC', compa::encodeutf('Elsõ lépésként létre kell hozni egy listát. Egy lista két típus egyike lehet vagy hírlevél vagy automatikus válaszoló. A listában paraméterekkel lehet szabályozni a hírlevelek küldését és és az automatikus válaszolók mûködését: küldõ neve, kialakítás, feliratkozók üdvözlõ üzenetei stb.<br /><br />Itt készítheti el az elsõ listát: <a href="index2.php?option=com_acajoom&act=list" >lista készítés</a> és kattintson a New gombon!'));
define('_ACA_GUIDE_FIRST_ACA_STEP_UPGRADE', compa::encodeutf('Az Acajoom lehetõséget nyújt egy korábbi hírlevél rendszervõl adatok importálására.<br />Menjen a Frissítés panelre és válassza ki azt a hírlevél rendszert, ahonnan importálni szeretné a hírleveleket és a feliratkozókat.<br /><br /><span style="color:#FF5E00;" >Fontos: az importálás nem érinti a korábbi hírlevél rendszer adatait.</span><br />Az importálás után a levelezéseket és a feliratkozókat közvetlenül az Acajoom-ban tudja kezelni.<br /><br />'));
define('_ACA_GUIDE_SECOND_ACA_STEP', compa::encodeutf('Gratulákunk, elkészült az elsõ lista!  Megírhatja az elsõ valamit: %s.  Ehhet menjen ide: '));
define('_ACA_GUIDE_SECOND_ACA_STEP_AUTO', compa::encodeutf('Automatikus válaszoló kezelõ'));
define('_ACA_GUIDE_SECOND_ACA_STEP_NEWS', compa::encodeutf('Hírlevél kezelõ'));
define('_ACA_GUIDE_SECOND_ACA_STEP_FINAL', compa::encodeutf(' és válassza ki: %s. <br />Majd válassza: %s a legördülõ listában. Az elsõ levelezés elkészítéséhez kattintson a New gombra!'));

define('_ACA_GUIDE_THRID_ACA_STEP_NEWS', compa::encodeutf('Mielõtt elküldi az elsõ hírlevelet, be kell állítani a levelezési konfigurációt. Menjen a <a href="index2.php?option=com_acajoom&act=configuration" >beállítások oldalra</a> ellenõrizni a beállításokat. <br />'));
define('_ACA_GUIDE_THRID2_ACA_STEP_NEWS', compa::encodeutf('<br />Ha ez kész, menjen vissza a Hírlevelek menübe és válassza ki a levelet és kattintson a Küldés gombra!'));

define('_ACA_GUIDE_THRID_ACA_STEP_AUTOS', compa::encodeutf('Az elsõ automatikus véálaszoló hasznlatához egy idõzítõt kell beállítania a szerveren. Keresse meg a beállítások panelen az Idõzítõ fület! <a href="index2.php?option=com_acajoom&act=configuration" >Kattintson ide</a> az idõzítõ beállításával kapcsolatps további információkért!<br />'));

define('_ACA_GUIDE_MODULE', compa::encodeutf(' <br />Ellenõrizze, hogy publikálta-e az Acajoom modult, amivel a érdeklõdõk feliratkozhatnak a listára.'));

define('_ACA_GUIDE_FOUR_ACA_STEP_NEWS', compa::encodeutf(' Beállíthatja az automatikus válaszolót is.'));
define('_ACA_GUIDE_FOUR_ACA_STEP_AUTOS', compa::encodeutf(' Beállíthat egy hírlevelet is!'));

define('_ACA_GUIDE_FOUR_ACA_STEP', compa::encodeutf('<p><br />Ön készen áll a hatékony kapcsolatra látogatóival és felhasználóival. Ez a varázsló befejezi mûködését, amint elkészíti a második levelezést vagy kikapcsolhatja <a href="index2.php?option=com_acajoom&act=configuration" >beállítások panelen</a>.<br /><br />Ha kérdése van az Acajoom, használatával kapcsolatban, használja a <a target="_blank" href="http://www.ijoobi.com/index.php?option=com_agora&Itemid=60" >fórumot</a>! Emellett számos információt is talál, hogy kommunikáljon hatékonyan a feliratkozókkal a <a href="http://www.ijoobi.com/" target="_blank">www.ijoobi.com</a> oldalán.<p /><br /><b>Köszönjük, hogy az Acajoom-ot használja. Az Ön kommunikációs partnere!</b> '));
define('_ACA_GUIDE_TURNOFF', compa::encodeutf('A varázsló kikapcsolásra kerül.'));
define('_ACA_STEP', compa::encodeutf('lépés '));

// Acajoom Install
define('_ACA_INSTALL_CONFIG', compa::encodeutf('Acajoom beállítás'));
define('_ACA_INSTALL_SUCCESS', compa::encodeutf('Sikeres telepítés'));
define('_ACA_INSTALL_ERROR', compa::encodeutf('Telepítési hiba'));
define('_ACA_INSTALL_BOT', compa::encodeutf('Acajoom beépülõ (robot)'));
define('_ACA_INSTALL_MODULE', compa::encodeutf('Acajoom modul'));
//Others
define('_ACA_JAVASCRIPT', compa::encodeutf('Figyelem: A Javascript-et engedélyezni kell a megfelelõ mûködéshez.'));
define('_ACA_EXPORT_TEXT', compa::encodeutf('Az exportált feliratkozók a válaszott listán alapulnak.<br />Feliratkozók exportálása listából'));
define('_ACA_IMPORT_TIPS', compa::encodeutf('Feliratkozók importálása. A fájlban levõ tartalomnak az alábbi formátumúnak kell lennie: <br />Name,Email,ReceiveHTML(1/0),<span style="color: rgb(255, 0, 0);">Registered(1/0)</span>'));
define('_ACA_SUBCRIBER_EXIT', compa::encodeutf('már létezõ feliratkozó'));
define('_ACA_GET_STARTED', compa::encodeutf('Kattintson ide az indításhoz!'));

//News since 1.0.1
define('_ACA_WARNING_1011', compa::encodeutf('Figyelem: 1011: A frissítés nem mûködik, mert a szerver visszautasította.'));
define('_ACA_SEND_MAIL_FROM_TIPS', compa::encodeutf('Válassza ki, melyik email cím jelenjen meg küldõként!'));
define('_ACA_SEND_MAIL_NAME_TIPS', compa::encodeutf('Válassza ki, milyen név jelenjen meg küldõként!'));
define('_ACA_MAILSENDMETHOD_TIPS', compa::encodeutf('Válassza ki milyen levélküldõt szeretne jasználni: PHP mail függvény, <span>Sendmail</span> or SMTP szerver.'));
define('_ACA_SENDMAILPATH_TIPS', compa::encodeutf('Ez a levél szerver könyvtára'));
define('_ACA_LIST_T_TEMPLATE', compa::encodeutf('Sablon'));
define('_ACA_NO_MAILING_ENTERED', compa::encodeutf('Nincs levelezés megadva'));
define('_ACA_NO_LIST_ENTERED', compa::encodeutf('Nincs lista megadva'));
define('_ACA_SENT_MAILING', compa::encodeutf('Levelek elküldése'));
define('_ACA_SELECT_FILE', compa::encodeutf('Válasszon egy fájlt: '));
define('_ACA_LIST_IMPORT', compa::encodeutf('Ellenõrizze a listát, amelyhez feliratkozókat szeretne hozzárendelni.'));
define('_ACA_PB_QUEUE', compa::encodeutf('A feliratkozó be lett szúrva de probléma van vele a listához csatolásnál. Ellenõrizze manuálisan!'));
define('_ACA_UPDATE_MESS', compa::encodeutf(''));
define('_ACA_UPDATE_MESS1', compa::encodeutf('A frissítés erõsen ajánlott!'));
define('_ACA_UPDATE_MESS2', compa::encodeutf('Folt és kisebb javítások.'));
define('_ACA_UPDATE_MESS3', compa::encodeutf('Új kiadás.'));
define('_ACA_UPDATE_MESS5', compa::encodeutf('Joomla 1.5 szükséges a frissítéshez.'));
define('_ACA_UPDATE_IS_AVAIL', compa::encodeutf(' elérhetõ!'));
define('_ACA_NO_MAILING_SENT', compa::encodeutf('Nem lett elküldve levél!'));
define('_ACA_SHOW_LOGIN', compa::encodeutf('Bejelentkezési ûrlap megjelenítése'));
define('_ACA_SHOW_LOGIN_TIPS', compa::encodeutf('Válasszon Igen-t, ha szeretné, hogy a bejelentkezési ûrlap megjelenjen az Acajoom webes felületének vezérlõpultján, hogy a felhasználók regisztrálhassanak a webhelyen..'));
define('_ACA_LISTS_EDITOR', compa::encodeutf('Lista leíró szerkesztõ'));
define('_ACA_LISTS_EDITOR_TIPS', compa::encodeutf('Válasszon Igen-t HTML szövegszerkesztõ használatához a a lista leírásának mezõjében.'));
define('_ACA_SUBCRIBERS_VIEW', compa::encodeutf('Feliratkozók megtekintése'));

//News since 1.0.2
define('_ACA_FRONTEND_SETTINGS', compa::encodeutf('Webes beállítások'));
define('_ACA_SHOW_LOGOUT', compa::encodeutf('Kijelentkezés gomb megjelenítése'));
define('_ACA_SHOW_LOGOUT_TIPS', compa::encodeutf('Válassza az Igen-t, ha meg akarja jeleníteni a Kijelentkezés gombot az AcaJoom vezérlõpult webes felületén.'));

//News since 1.0.3 CB integration
define('_ACA_CONFIG_INTEGRATION', compa::encodeutf('Integráció'));
define('_ACA_CB_INTEGRATION', compa::encodeutf('Community Builder integráció'));
define('_ACA_INSTALL_PLUGIN', compa::encodeutf('Community Builder beépülõ (Acajoom integráció) '));
define('_ACA_CB_PLUGIN_NOT_INSTALLED', compa::encodeutf('Az Acajoom beépülõ a Community Builderbe még nincs telepítve!'));
define('_ACA_CB_PLUGIN', compa::encodeutf('Listák regisztráláskor'));
define('_ACA_CB_PLUGIN_TIPS', compa::encodeutf('Válassza az Igen-t, ha a levelezõ listákat meg akarja jeleníteni a Community Builder regisztrációs ûrlapján'));
define('_ACA_CB_LISTS', compa::encodeutf('Lista azonosítók'));
define('_ACA_CB_LISTS_TIPS', compa::encodeutf('EZ KÖTELEZÕ MEZÕ. Adja meg a listák azonosítóját vesszõvel elválasztva, amely ekre a felhasználó feliratkozhat . (0 az összes listát megjeleníti)'));
define('_ACA_CB_INTRO', compa::encodeutf('Bevezetõ szöveg'));
define('_ACA_CB_INTRO_TIPS', compa::encodeutf('A lista elõtt megjelenõ szöveg. HAGYJA ÜRESEN, HA NEM AKAR MEGJELENÍTENI SEMMIT!. Használja a cb_pretext-et a CSS-hez!.'));
define('_ACA_CB_SHOW_NAME', compa::encodeutf('Listanév megjelenítése'));
define('_ACA_CB_SHOW_NAME_TIPS', compa::encodeutf('Döntse el, hogy szeretné-e megjeleníteni a listaneveket a bevezetõ után!'));
define('_ACA_CB_LIST_DEFAULT', compa::encodeutf('Listák bejelölése alapértelmezésként'));
define('_ACA_CB_LIST_DEFAULT_TIPS', compa::encodeutf('Döntse el, hogy szeretné-e alapértelmezésként bejelölni minden listát!'));
define('_ACA_CB_HTML_SHOW', compa::encodeutf('HTML formátumban?'));
define('_ACA_CB_HTML_SHOW_TIPS', compa::encodeutf('Válassza az Igen-t, ha a felhasználók eldönthetik, hogy szeretnének-e HTML leveleket vagy sem. Állítsa Nem-re, ha alapértelmezésként HTML levelet akar használni!'));
define('_ACA_CB_HTML_DEFAULT', compa::encodeutf('Alapértelmezetten HTML formátumban?'));
define('_ACA_CB_HTML_DEFAULT_TIPS', compa::encodeutf('Állítsa be ezt a lehetõséget az alapértelmezett HTML levelezési beállítások megjelenítéséhez! Ha a HTML formátumban? bejegyzés Nem, akkor ez az opció lesz az alapértelmezett.'));

// Since 1.0.4
define('_ACA_BACKUP_FAILED', compa::encodeutf('A fájlrõl nem készíthetõ biztonsági másolat! A fájl nem került lecserélésre.'));
define('_ACA_BACKUP_YOUR_FILES', compa::encodeutf('A fájlok régebbi verziója mentésre került a következõ könyvtárban:'));
define('_ACA_SERVER_LOCAL_TIME', compa::encodeutf('Helyi szerver idõ'));
define('_ACA_SHOW_ARCHIVE', compa::encodeutf('Archívum gomb megjelenítése'));
define('_ACA_SHOW_ARCHIVE_TIPS', compa::encodeutf('Válasszon Igen-t a hírlevelek listájának végén az Archívum gomb megjelenítéséhez'));
define('_ACA_LIST_OPT_TAG', compa::encodeutf('Kódok'));
define('_ACA_LIST_OPT_IMG', compa::encodeutf('Képek'));
define('_ACA_LIST_OPT_CTT', compa::encodeutf('Tartalom'));
define('_ACA_INPUT_NAME_TIPS', compa::encodeutf('Adja meg a teljes nevét (a keresztnevével kezdje)!'));
define('_ACA_INPUT_EMAIL_TIPS', compa::encodeutf('Adja meg az email címét! Ellenõrizze, hogy ez egy valódi email cím, ha valóban szeretne hírleveletet kapni!'));
define('_ACA_RECEIVE_HTML_TIPS', compa::encodeutf('Válasszon Igen-t, ha HTML hírleveleket szeretne kapni - vagy Nem-et, ha csak szöveges hírleveleket.'));
define('_ACA_TIME_ZONE_ASK_TIPS', compa::encodeutf('Adja meg az idõzónáját!'));

// Since 1.0.5
define('_ACA_FILES', compa::encodeutf('Fájlok'));
define('_ACA_FILES_UPLOAD', compa::encodeutf('Feltöltés'));
define('_ACA_MENU_UPLOAD_IMG', compa::encodeutf('Képek feltöltése'));
define('_ACA_TOO_LARGE', compa::encodeutf('A fájl mérete túl nagy. A maximális méret:'));
define('_ACA_MISSING_DIR', compa::encodeutf('A célkönyvtár nem létezik'));
define('_ACA_IS_NOT_DIR', compa::encodeutf('A célkönyvtár nem létezik vagy pedig egy szabályos fájl.'));
define('_ACA_NO_WRITE_PERMS', compa::encodeutf('A célkönyvtáron nincs írási jog.'));
define('_ACA_NO_USER_FILE', compa::encodeutf('Nem válaszotta ki a feltöltendõ fájlt!'));
define('_ACA_E_FAIL_MOVE', compa::encodeutf('A fájl nem helyezhetõ át!'));
define('_ACA_FILE_EXISTS', compa::encodeutf('A célfájl már létezik.'));
define('_ACA_CANNOT_OVERWRITE', compa::encodeutf('A célfájl már létezik vagy nem írható felül.'));
define('_ACA_NOT_ALLOWED_EXTENSION', compa::encodeutf('Nem engedélyezett fájlkiterjesztés.'));
define('_ACA_PARTIAL', compa::encodeutf('A fájl csak részben került feltöltésre.'));
define('_ACA_UPLOAD_ERROR', compa::encodeutf('Feltöltési hiba:'));
define('DEV_NO_DEF_FILE', compa::encodeutf('A fájl csak részben került feltöltésre.'));

// already exist but modified  added a <br/ on first line and added [SUBSCRIPTIONS] line>
define('_ACA_CONTENTREP', compa::encodeutf('[SUBSCRIPTIONS] = Ez lecserélésre kerül a feliratkozási linkekkel. Ez <strong>szükséges</strong> az Acajoom helyes mûködéséhez.<br />Ha bármilyen más tartalmat helyez el ebben a dobozban, ez a lista összes levelezésében meg fog jelenni.<br />Tegye a saját feiratkozási üzeneteit a végére Az Acajoom automatikusan hozzáadja a feliratkozás megváltoztatásához és a leiratkozáshoz szükséges linkeket.'));

// since 1.0.6
define('_ACA_NOTIFICATION', compa::encodeutf('Értesítés'));  // shortcut for Email notification
define('_ACA_NOTIFICATIONS', compa::encodeutf('Értesítések'));
define('_ACA_USE_SEF', compa::encodeutf('SEF a levelezésben'));
define('_ACA_USE_SEF_TIPS', compa::encodeutf('Ajánlott a nem választása. Ha szeretné, hogy a levelezésben használt URL használja a SEF-et, akkor válassza az igent!<br /><b>A linkek mindegyik opcióhoz ugyanúgy mûködnek. Nem biztos, hogy a levelezésben a linkek mindig mûködnek, ha megváltozik a SEF.</b> '));
define('_ACA_ERR_SETTINGS', compa::encodeutf('Hibakezelõ beállítások'));
define('_ACA_ERR_SEND', compa::encodeutf('Hiba jelentés küldése'));
define('_ACA_ERR_SEND_TIPS', compa::encodeutf('Ha szeretné, hogy az Acajoom jobb termékké váljon, válassza az Igen-t! Ez hibajelentést küld a fejlesztõknek. Így nem szükséges hibakutatást végeznie.<br /> <b>SEMMILYEN MAGÁNJELLEGÛ INFORMÁCIÓNEM KERÜL ELKÜLDÉSRE</b>. Még azt sem fogják tudni, melyik webhelyrõl érkezik a hibajelentés. Csak az Acojoomról kapnak informciót, a PHP beállításokról és az SQL lekérdezésekrõl. '));
define('_ACA_ERR_SHOW_TIPS', compa::encodeutf('Válasszon Igen-t a hiba sorszámának megjelenítéséhez a képernyõn. Fõleg hibakeresésre lehet használni. '));
define('_ACA_ERR_SHOW', compa::encodeutf('Hibák megjelenítése'));
define('_ACA_LIST_SHOW_UNSUBCRIBE', compa::encodeutf('Leiratkozási linkek megtekintése'));
define('_ACA_LIST_SHOW_UNSUBCRIBE_TIPS', compa::encodeutf('Válasszon Igen-t a leiratkozáso linkek megjelenítéséhez  a levél alján, ahol a felhasználók megváltoztathatják a feliratkozásaikat. <br /> A Nem letiltja a láblécet és a linkeket.'));
define('_ACA_UPDATE_INSTALL', compa::encodeutf('<span style="color: rgb(255, 0, 0);">FONTOS MEGJEGYZÉS!</span> <br />Ha korábbi Acajoom verzióról frissít, frissíteni kell az adatbázis struktúrát is a következõ gombra kattintva (az adatok integritása megmarad)'));
define('_ACA_UPDATE_INSTALL_BTN', compa::encodeutf('A táblák és a beállítások frissítése'));
define('_ACA_MAILING_MAX_TIME', compa::encodeutf('Maximális várakozási idõ'));
define('_ACA_MAILING_MAX_TIME_TIPS', compa::encodeutf('Megadja azt a maximális idõt, ameddig a leveleknek várakozniuk kell asorban. Az ajánlott érték 30 másodperc és 2 perc közöztt van.'));

// virtuemart integration beta
define('_ACA_VM_INTEGRATION', compa::encodeutf('VirtueMart integráció'));
define('_ACA_VM_COUPON_NOTIF', compa::encodeutf('Kupon értesítési azonosító'));
define('_ACA_VM_COUPON_NOTIF_TIPS', compa::encodeutf('Megadja a levelezés azonosítószámát, amit kuponok küldésekor szeretne használni.'));
define('_ACA_VM_NEW_PRODUCT', compa::encodeutf('Új termék értesítés azonosító'));
define('_ACA_VM_NEW_PRODUCT_TIPS', compa::encodeutf('Megadja a levelezés azonosítószámát, amit új termék értesítésnél szeretne használni.'));

// since 1.0.8
// create forms for subscriptions
define('_ACA_FORM_BUTTON', compa::encodeutf('Ûrlap létrehozása'));
define('_ACA_FORM_COPY', compa::encodeutf('HTML kód'));
define('_ACA_FORM_COPY_TIPS', compa::encodeutf('Másolja a generált HTML kódot a HTML oldalra!'));
define('_ACA_FORM_LIST_TIPS', compa::encodeutf('Válassza ki a listából az ûrlapba beszúrandó tartalmat!'));
// update messages
define('_ACA_UPDATE_MESS4', compa::encodeutf('Nem frissíthetõ automatikusan.'));
define('_ACA_WARNG_REMOTE_FILE', compa::encodeutf('Távoli fájl nem érhetõ el.'));
define('_ACA_ERROR_FETCH', compa::encodeutf('Hiba a fájl elérésekor.'));

define('_ACA_CHECK', compa::encodeutf('Ellenõrzés'));
define('_ACA_MORE_INFO', compa::encodeutf('További infó'));
define('_ACA_UPDATE_NEW', compa::encodeutf('Frissítés újabb verzióra'));
define('_ACA_UPGRADE', compa::encodeutf('Frissítés a legfrissebb termékre'));
define('_ACA_DOWNDATE', compa::encodeutf('Visszaállás elõzõ verzióra'));
define('_ACA_DOWNGRADE', compa::encodeutf('Vissza az alaptermékre'));
define('_ACA_REQUIRE_JOOM', compa::encodeutf('Joomla szükséges'));
define('_ACA_TRY_IT', compa::encodeutf('Próbálja ki!'));
define('_ACA_NEWER', compa::encodeutf('Újabb'));
define('_ACA_OLDER', compa::encodeutf('Régebbi'));
define('_ACA_CURRENT', compa::encodeutf('Aktuális'));

// since 1.0.9
define('_ACA_CHECK_COMP', compa::encodeutf('Próbáljon ki egyet a többi komponens közül!'));
define('_ACA_MENU_VIDEO', compa::encodeutf('Videó bemutatók'));
define('_ACA_SCHEDULE_TITLE', compa::encodeutf('Automatikus idõbeállító funkció beállítása'));
define('_ACA_ISSUE_NB_TIPS', compa::encodeutf('A kiadás számának automatikus generálása'));
define('_ACA_SEL_ALL', compa::encodeutf('Összes levelezés'));
define('_ACA_SEL_ALL_SUB', compa::encodeutf('Összes lista'));
define('_ACA_INTRO_ONLY_TIPS', compa::encodeutf('Ha kipipálja ezt a dobozt, csak a cikk bevezetõ szövege kerül be a levélbe egy Tovább linkkel.'));
define('_ACA_TAGS_TITLE', compa::encodeutf('Tartalom kód'));
define('_ACA_TAGS_TITLE_TIPS', compa::encodeutf('Vágólapon keresztül tegye ezt a kódot a levél, ahol a tartalmat szeretné elhelyezni.'));
define('_ACA_PREVIEW_EMAIL_TEST', compa::encodeutf('Jelzi az email címet, ahova a tesztet el kell küldeni'));
define('_ACA_PREVIEW_TITLE', compa::encodeutf('Elõnézet'));
define('_ACA_AUTO_UPDATE', compa::encodeutf('Új frissítési értesítés'));
define('_ACA_AUTO_UPDATE_TIPS', compa::encodeutf('Válasszon Igen-t, ha szeretne értesítést a komponens frissítésérõl! <br />FONTOS! A tippek megjelenítése szükséges ennek afunkciónak a mûködéséhez.'));

// since 1.1.0
define('_ACA_LICENSE', compa::encodeutf('Licensz információ'));

// since 1.1.1
define('_ACA_NEW', compa::encodeutf('Új'));
define('_ACA_SCHEDULE_SETUP', compa::encodeutf('Az automatikus válaszoló mûködéséhez be kell állítani az idõzítõt a beállításoknál..'));
define('_ACA_SCHEDULER', compa::encodeutf('Idõzítõ'));
define('_ACA_ACAJOOM_CRON_DESC', compa::encodeutf('ha nincs hozzáférése a webhelyen az idõzítõ feladat kezelõhöz, regisztrálhat egy ingyenes Acajoom idõzítõt itt:'));
define('_ACA_CRON_DOCUMENTATION', compa::encodeutf('Az Acajoom idõzítõ beállításaihoz további információkat itt talál:'));
define('_ACA_CRON_DOC_URL', compa::encodeutf('<a href="http://www.ijoobi.com/index.php?option=com_content&view=article&id=4249&catid=29&Itemid=72"
 target="_blank">http://www.ijoobi.com/index.php?option=com_content&Itemid=72&view=category&layout=blog&id=29&limit=60</a>'));
define( '_ACA_QUEUE_PROCESSED', compa::encodeutf('A feladatsor sikeresen feldolgozásra került...'));
define( '_ACA_ERROR_MOVING_UPLOAD', compa::encodeutf('Hiba az importált fájl mozgatása közben'));

//since 1.1.2
define( '_ACA_SCHEDULE_FREQUENCY', compa::encodeutf('Idõzítõ gyakoriság'));
define( '_ACA_CRON_MAX_FREQ', compa::encodeutf('Idõzítõ maximális gyakoriság'));
define( '_ACA_CRON_MAX_FREQ_TIPS', compa::encodeutf('Adja meg azt a maximális gykoriságot, amikor az idõzítõ fut (percekben).  Ez korlázozza az idõzítõt még akkor is, ha az idõzítõ feladat gyakorisága ennél rövidebb idõre van beállítva.'));
define( '_ACA_CRON_MAX_EMAIL', compa::encodeutf('Feladatonkénti maximális levélszám'));
define( '_ACA_CRON_MAX_EMAIL_TIPS', compa::encodeutf('Megadja meg a feladatonként elküldhetõ levelek maximális számát (0 - korlátlan).'));
define( '_ACA_CRON_MINUTES', compa::encodeutf(' perc'));
define( '_ACA_SHOW_SIGNATURE', compa::encodeutf('Levél lábléc megjelenítése'));
define( '_ACA_SHOW_SIGNATURE_TIPS', compa::encodeutf('Megjelenjen-e az Acajoom-ot népszerûsítõ lábléc a levelekben.'));
define( '_ACA_QUEUE_AUTO_PROCESSED', compa::encodeutf('Az automatikus válaszolók feladatai sikeresen feldolgozva...'));
define( '_ACA_QUEUE_NEWS_PROCESSED', compa::encodeutf('Az idõzített hírlevelek feldolgozása sikeres...'));
define( '_ACA_MENU_SYNC_USERS', compa::encodeutf('Felhasználók szinkronizásása'));
define( '_ACA_SYNC_USERS_SUCCESS', compa::encodeutf('A felhasználók szinkronizásása sikeres!'));

// compatibility with Joomla 15
if (!defined('_BUTTON_LOGOUT')) define( '_BUTTON_LOGOUT', compa::encodeutf('Kijelentkezés'));
if (!defined('_CMN_YES')) define( '_CMN_YES', compa::encodeutf('Igen'));
if (!defined('_CMN_NO')) define( '_CMN_NO', compa::encodeutf('Nem'));
if (!defined('_HI')) define( '_HI', compa::encodeutf('Üdvözöljük'));
if (!defined('_CMN_TOP')) define( '_CMN_TOP', compa::encodeutf('Felül'));
if (!defined('_CMN_BOTTOM')) define( '_CMN_BOTTOM', compa::encodeutf('Lent'));
//if (!defined('_BUTTON_LOGOUT')) define( '_BUTTON_LOGOUT', compa::encodeutf('Kijelentkezés'));

// For include title only or full article in content item tab in newsletter edit - p0stman911
define('_ACA_TITLE_ONLY_TIPS', compa::encodeutf('Ha ezt kijelöli, csak a teljes cikkre mutató cikk cím kerül be linkként a levélbe.'));
define('_ACA_TITLE_ONLY', compa::encodeutf('Csak cím'));
define('_ACA_FULL_ARTICLE_TIPS', compa::encodeutf('Ha ezt kijelöli, a levélbe a cikk teljes tartalma bekerül'));
define('_ACA_FULL_ARTICLE', compa::encodeutf('Teljes cikk'));
define('_ACA_CONTENT_ITEM_SELECT_T', compa::encodeutf('Válasszon ki egy tartalmi elemet, amely bekerül a levélba.<br />Vágólapon keresztül helyezze el a <b>tartalom kódot</b> a levélbe!  Választhatja a teljes szöveget, csak a bevezetõt vagy csak a címet (0, 1, vagy 2). '));
define('_ACA_SUBSCRIBE_LIST2', compa::encodeutf('Levelezõ listák'));

// smart-newsletter function
define('_ACA_AUTONEWS', compa::encodeutf('Gyors hírlevél'));
define('_ACA_MENU_AUTONEWS', compa::encodeutf('Gyors hírlevelek'));
define('_ACA_AUTO_NEWS_OPTION', compa::encodeutf('Gyors hírlevél opciók'));
define('_ACA_AUTONEWS_FREQ', compa::encodeutf('Hírlevél gyakoriság'));
define('_ACA_AUTONEWS_FREQ_TIPS', compa::encodeutf('Adja meg azt a gyakoriságot, ami szerint küldeni szeretné a gyors hírleveleket!'));
define('_ACA_AUTONEWS_SECTION', compa::encodeutf('Cikk szekció'));
define('_ACA_AUTONEWS_SECTION_TIPS', compa::encodeutf('Válassza ki a szekciót, amelybõl cikket szeretne kijelölni!'));
define('_ACA_AUTONEWS_CAT', compa::encodeutf('Cikk kategória'));
define('_ACA_AUTONEWS_CAT_TIPS', compa::encodeutf('Válassza ki a kategóriát, amelybõl cikket szeretne kijelölni (Mind - összes cikk az adott szekcióból)!'));
define('_ACA_SELECT_SECTION', compa::encodeutf('Válasszon szekciót!'));
define('_ACA_SELECT_CAT', compa::encodeutf('Összes kategória'));
define('_ACA_AUTO_DAY_CH8', compa::encodeutf('Negyedévente'));
define('_ACA_AUTONEWS_STARTDATE', compa::encodeutf('Kezdõ dátum'));
define('_ACA_AUTONEWS_STARTDATE_TIPS', compa::encodeutf('Adja meg azt a kezdõ dátumot, amitõl a gyors hírleveleket küldeni szeretné!'));
define('_ACA_AUTONEWS_TYPE', compa::encodeutf('Tartalom összeállítás'));// how we see the content which is included in the newsletter
define('_ACA_AUTONEWS_TYPE_TIPS', compa::encodeutf('Teljes cikk: a teljes cikk bekerül a levélbe<br />' .		'Csak bevezetõ: csak a cikk bevezetõje kerül be a levélbe<br/>' .		'Csak cím: csak a cikk címe kerül be a levélbe'));
define('_ACA_TAGS_AUTONEWS', compa::encodeutf('[SMARTNEWSLETTER] = Ezt a gyors hírlevél cseréli le.'));

//since 1.1.3
define('_ACA_MALING_EDIT_VIEW', compa::encodeutf('Levelezés létrehozás / megtekintés'));
define('_ACA_LICENSE_CONFIG', compa::encodeutf('Licensz'));
define('_ACA_ENTER_LICENSE', compa::encodeutf('Adja meg a licensz kódot!'));
define('_ACA_ENTER_LICENSE_TIPS', compa::encodeutf('Írja be a licensz kódot és mentse el.'));
define('_ACA_LICENSE_SETTING', compa::encodeutf('Licensz beállítások'));
define('_ACA_GOOD_LIC', compa::encodeutf('Érvényes licensz.'));
define('_ACA_NOTSO_GOOD_LIC', compa::encodeutf('Nem érvényes licensz: '));
define('_ACA_PLEASE_LIC', compa::encodeutf('Vegye fel a kapcsolatot az Acajoom támogatóival a licensz frissítése érdekében  ( license@ijoobi.com ).'));
define('_ACA_DESC_PLUS', compa::encodeutf('Az Acajoom Plus az elsõ szekvenciális automatikus válaszoló komponens Joomla rendszerre.  ' . _ACA_FEATURES));
define('_ACA_DESC_PRO', compa::encodeutf('Az Acajoom PRO egy fejlett hírlevélküldõ rendszer Joomla rendszerre.  ' . _ACA_FEATURES));

//since 1.1.4
define('_ACA_ENTER_TOKEN', compa::encodeutf('Adja meg az azonosítót!'));

define('_ACA_ENTER_TOKEN_TIPS', compa::encodeutf('Adja meg azt az azonosítót, amit emailben kapott meg az Acajoom megvásárlásakor!<br />Ezután mentsen! Az Acajoom automatikusan kapcsolódik a szerverhez egy licenszszám lekéréséhez.'));

define('_ACA_ACAJOOM_SITE', compa::encodeutf('Acajoom webhely:'));
define('_ACA_MY_SITE', compa::encodeutf('Webhelyem:'));

define( '_ACA_LICENSE_FORM', compa::encodeutf(' ' .	'Kattintson ide a licensz ûrlaphoz ugráshoz!</a>'));
define('_ACA_PLEASE_CLEAR_LICENSE', compa::encodeutf('Törölje a licensz mezõt ás próbálja meg újra!<br />Ha a probléma továbba is fennáll, '));

define( '_ACA_LICENSE_SUPPORT', compa::encodeutf('A még mindig van kérdése, ' . _ACA_PLEASE_LIC));

define( '_ACA_LICENSE_TWO', compa::encodeutf('a Licensz ûrlapon lekérheti a licenszet kézi módszerrel is az azonosító és a saját webhely URL megadásával (amelyik zöld színnek jelenik meg ennek az oldalnak a felsõ részén). ' . _ACA_LICENSE_FORM . '<br /><br/>' . _ACA_LICENSE_SUPPORT));

define('_ACA_ENTER_TOKEN_PATIENCE', compa::encodeutf('Az azonosító mentése után automatikusan egy licensz kód generálódik. Az azonosító általában 2 percen belül ellenõrzésre kerül, de bizonyos esetekben 15 percig is eltarthat..<br /><br />Térjen vissza erre az ellenõrzésre néhány perc mulva!<br /><br />Ha nem kap érvényes licensz kódot 15 percen belül, '. _ACA_LICENSE_TWO));


define( '_ACA_ENTER_NOT_YET', compa::encodeutf('A megadott azonosító még nem lett ellenõrizve.'));
define( '_ACA_UPDATE_CLICK_HERE', compa::encodeutf('Látogasson el a <a href="http://www.ijoobi.com" target="_blank">www.ijoobi.com</a> oldalra a legfrissebb verzió letöltéséhez.'));
define( '_ACA_NOTIF_UPDATE', compa::encodeutf('Ahhoz, hogy értesüljön az új frissítésekrõl, adja meg az email címét és kattintson a Feliratkozás linkre!'));

define('_ACA_THINK_PLUS', compa::encodeutf('Ha többet szeretne kihozni levelezõ rendszerébõl, gondoljon a Plus verzióra!'));
define('_ACA_THINK_PLUS_1', compa::encodeutf('Szekvenciális automatikus válaszolók'));
define('_ACA_THINK_PLUS_2', compa::encodeutf('Hírlevél idõzítése egy elõre megadott idõpontra!'));
define('_ACA_THINK_PLUS_3', compa::encodeutf('Nincs többé szerver korlát'));
define('_ACA_THINK_PLUS_4', compa::encodeutf('És sok más egyéb...'));

//since 1.2.2
define( '_ACA_LIST_ACCESS', compa::encodeutf('Lista hozzáférés'));
define( '_ACA_INFO_LIST_ACCESS', compa::encodeutf('Adja meg, hogy milyen felhasználócsoportok láthatják és iratkozhatnak fel erre a listára!'));
define( 'ACA_NO_LIST_PERM', compa::encodeutf('Nincs jogosultsága feliratkozni erre a listára!'));

//Archive Configuration
 define('_ACA_MENU_TAB_ARCHIVE', compa::encodeutf('Archívál'));
 define('_ACA_MENU_ARCHIVE_ALL', compa::encodeutf('Mindet archívál'));

//Archive Lists
 define('_FREQ_OPT_0', compa::encodeutf('Nincs'));
 define('_FREQ_OPT_1', compa::encodeutf('Hetente'));
 define('_FREQ_OPT_2', compa::encodeutf('Két hetente'));
 define('_FREQ_OPT_3', compa::encodeutf('Havonta'));
 define('_FREQ_OPT_4', compa::encodeutf('Negyed évente'));
 define('_FREQ_OPT_5', compa::encodeutf('Évente'));
 define('_FREQ_OPT_6', compa::encodeutf('Egyéb'));

define('_DATE_OPT_1', compa::encodeutf('Létrehozás dátum'));
define('_DATE_OPT_2', compa::encodeutf('Módosítás dátum'));

define('_ACA_ARCHIVE_TITLE', compa::encodeutf('Automatikus archíválás gyakoriságának beállítása'));
define('_ACA_FREQ_TITLE', compa::encodeutf('Archíválási gyakoriság'));
define('_ACA_FREQ_TOOL', compa::encodeutf('Adja meg, hogy milyen gyakran arhíválja az Archívum kezelõ a webhelye tartalmát!.'));
define('_ACA_NB_DAYS', compa::encodeutf('Napok száma'));
define('_ACA_NB_DAYS_TOOL', compa::encodeutf('Ez csak az Egyéb opcióra vonatkozik! Adja meg a napok számát két archíválás között!'));
define('_ACA_DATE_TITLE', compa::encodeutf('Dátum típus'));
define('_ACA_DATE_TOOL', compa::encodeutf('Adja meg, hogy a létrehozás dátuma vagy a módosítás dátuma alapján archíváljon!'));

define('_ACA_MAINTENANCE_TAB', compa::encodeutf('Karbantartási beállítások'));
define('_ACA_MAINTENANCE_FREQ', compa::encodeutf('Karbantartási gyakoriság'));
define( '_ACA_MAINTENANCE_FREQ_TIPS', compa::encodeutf('Adja meg azt a gyakoriságot, amikor a karbantartási mûvelet lefut!'));
define( '_ACA_CRON_DAYS', compa::encodeutf('óra'));

define( '_ACA_LIST_NOT_AVAIL', compa::encodeutf('Jelenleg nincs elérhetõ lista.'));
define( '_ACA_LIST_ADD_TAB', compa::encodeutf('Hozzáad/szerkeszt'));

define( '_ACA_LIST_ACCESS_EDIT', compa::encodeutf('Levelezés hozzáférés hozzáadás/szerkesztés'));
define( '_ACA_INFO_LIST_ACCESS_EDIT', compa::encodeutf('Adja meg azt a felhasználói csoportot, amely bõvítheti vagy szerkesztheti ehhez az listához tartozó levelezéseket!'));
define( '_ACA_MAILING_NEW_FRONT', compa::encodeutf('Új levelezés létrehozás'));

define('_ACA_AUTO_ARCHIVE', compa::encodeutf('Auto-Archívál'));
define('_ACA_MENU_ARCHIVE', compa::encodeutf('Auto-Archívál'));

//Extra tags:
define('_ACA_TAGS_ISSUE_NB', compa::encodeutf('[ISSUENB] = Lecserélõdik a hírlevél kiadás számára.'));
define('_ACA_TAGS_DATE', compa::encodeutf('[DATE] = Lecserélõdik a küldés dátumára.'));
define('_ACA_TAGS_CB', compa::encodeutf('[CBTAG:{field_name}] = Lecserélõdik a Community Builder mezõjének értékére: pl.: [CBTAG:firstname] '));
define( '_ACA_MAINTENANCE', compa::encodeutf('Joobi Care'));

define('_ACA_THINK_PRO', compa::encodeutf('Professzionális igényekhez professzionális komponensek!'));
define('_ACA_THINK_PRO_1', compa::encodeutf('Okos hírlevelek'));
define('_ACA_THINK_PRO_2', compa::encodeutf('Adja meg a hozzáférés szintjét a listához!'));
define('_ACA_THINK_PRO_3', compa::encodeutf('Adja meg, hogy ki szerkeszthet/adhat hozzá levelezést!'));
define('_ACA_THINK_PRO_4', compa::encodeutf('További adatok: adja hozzá saját CB mezõit!'));
define('_ACA_THINK_PRO_5', compa::encodeutf('A Joomla tartalmaz Auto-archiválást!'));
define('_ACA_THINK_PRO_6', compa::encodeutf('Adatbázis optimalizálás'));

define('_ACA_LIC_NOT_YET', compa::encodeutf('Az Ön licensze még nem érvényes. Ellenõrizze a Licensz fület a konfigurációs panelen!'));
define('_ACA_PLEASE_LIC_GREEN', compa::encodeutf('Ügyeljen, hogy friss és valódi információkat adjon támogató csoportunknak ennek a fülnek a tetején!'));

define('_ACA_FOLLOW_LINK', compa::encodeutf('Licensz kérés'));
define( '_ACA_FOLLOW_LINK_TWO', compa::encodeutf('Kérheti licenszét azonosítója és webhelyének URL-je megadásával (amelyik zöld színnel jelenik meg az oldal tetején) a Licensz ûrlapban.'));
define( '_ACA_ENTER_TOKEN_TIPS2', compa::encodeutf(' Majd kattintson az Alkalmaz gombon a jobb felsõ menüben!'));
define( '_ACA_ENTER_LIC_NB', compa::encodeutf('Írja be a licenszét!'));
define( '_ACA_UPGRADE_LICENSE', compa::encodeutf('Licensz frissítése'));
define( '_ACA_UPGRADE_LICENSE_TIPS', compa::encodeutf('Ha kapott azonosítót a licensz frissítéséhez, azt itt adja meg, majd kattintson az Alkalmaz gombon és folytassa a <b>2.</b> lépéssel licensz számának lekéréséhez!'));

define( '_ACA_MAIL_FORMAT', compa::encodeutf('Kódolási formátum'));
define( '_ACA_MAIL_FORMAT_TIPS', compa::encodeutf('Milyen kódolási formát szeretne használni levelezéseiben: csak szöveges vagy MIME'));
define( '_ACA_ACAJOOM_CRON_DESC_ALT', compa::encodeutf('Ha nincs hozzáférése a webhelyén idõzítõ kezelõhöz, használhatja az ingyenes jCron komponenst az idõzítési feladatok megoldására!'));

//since 1.3.1
define('_ACA_SHOW_AUTHOR', compa::encodeutf('A szerzõ nevének megjelenítése'));
define('_ACA_SHOW_AUTHOR_TIPS', compa::encodeutf('Válasszon Igen-t, ha a szerzõ nevét is el szeretné helyezni a levélbe elhelyezett cikknél!'));

//since 1.3.5
define('_ACA_REGWARN_NAME', compa::encodeutf('Adja meg a nevét!'));
define('_ACA_REGWARN_MAIL', compa::encodeutf('Érvényes email címet adjon meg!'));

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