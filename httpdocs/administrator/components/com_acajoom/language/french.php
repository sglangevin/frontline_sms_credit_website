<?php
defined('_JEXEC') OR defined('_VALID_MOS') OR die('...Direct Access to this location is not allowed...');

/**
 * <p>French language file.</p>
 * @copyright (c) 2006 Acajoom Services / All Rights Reserved
 * @author Acajoom Services <support@ijoobi.com>
 * @author Christelle Gesset <support@ijoobi.com>
 * @version $Id: french.php 491 2007-02-01 22:56:07Z divivo $
* @link http://www.ijoobi.com
 */

### General ###
 //acajoom Description
define('_ACA_DESC_NEWS', compa::encodeutf('Acajoom est un gestionaire de listes, infolettres, bulletins, et réponses automatiques pour communiquer effectivement avec vos clients.  ' .
		'Acajoom, votre partenaire de communication'));
define('_ACA_FEATURES', compa::encodeutf('Acajoom, votre partenaire de communication!'));

// Type of lists
define('_ACA_NEWSLETTER', compa::encodeutf('Infolettre'));
define('_ACA_AUTORESP', compa::encodeutf('Réponse automatique'));
define('_ACA_AUTORSS', compa::encodeutf('Auto-RSS'));
define('_ACA_ECARD', compa::encodeutf('eCard'));
define('_ACA_POSTCARD', compa::encodeutf('Carte Postale'));
define('_ACA_PERF', compa::encodeutf('Performance'));
define('_ACA_COUPON', compa::encodeutf('Coupon'));
define('_ACA_CRON', compa::encodeutf('Tâche Cron'));
define('_ACA_MAILING', compa::encodeutf('Courrieling'));
define('_ACA_LIST', compa::encodeutf('Liste'));

 //acajoom Menu
define('_ACA_MENU_LIST', compa::encodeutf('Gestion de Listes'));
define('_ACA_MENU_SUBSCRIBERS', compa::encodeutf('Abonnés'));
define('_ACA_MENU_NEWSLETTERS', compa::encodeutf('Infolettres'));
define('_ACA_MENU_AUTOS', compa::encodeutf('Réponses automatiques'));
define('_ACA_MENU_COUPONS', compa::encodeutf('Coupons'));
define('_ACA_MENU_CRONS', compa::encodeutf('Taches Cron'));
define('_ACA_MENU_AUTORSS', compa::encodeutf('Auto-RSS'));
define('_ACA_MENU_ECARD', compa::encodeutf('eCards'));
define('_ACA_MENU_POSTCARDS', compa::encodeutf('Carte Postales'));
define('_ACA_MENU_PERFS', compa::encodeutf('Performances'));
define('_ACA_MENU_TAB_LIST', compa::encodeutf('Listes'));
define('_ACA_MENU_MAILING_TITLE', compa::encodeutf('Envoie de courriel'));
define('_ACA_MENU_MAILING', compa::encodeutf('Envoie de courriel pour '));
define('_ACA_MENU_STATS', compa::encodeutf('Statistiques'));
define('_ACA_MENU_STATS_FOR', compa::encodeutf('Statistiques pour '));
define('_ACA_MENU_CONF', compa::encodeutf('Configuration'));
define('_ACA_MENU_UPDATE', compa::encodeutf('Importation'));
define('_ACA_MENU_ABOUT', compa::encodeutf('À propos'));
define('_ACA_MENU_LEARN', compa::encodeutf('Centre d\'éducation'));
define('_ACA_MENU_MEDIA', compa::encodeutf('Gestion des Médias'));
define('_ACA_MENU_HELP', compa::encodeutf('Aide'));
define('_ACA_MENU_CPANEL', compa::encodeutf('Paneau de configuration'));
define('_ACA_MENU_IMPORT', compa::encodeutf('Importer'));
define('_ACA_MENU_EXPORT', compa::encodeutf('Exporter'));
define('_ACA_MENU_SUB_ALL', compa::encodeutf('S\'abonner à tout'));////
define('_ACA_MENU_UNSUB_ALL', compa::encodeutf('Se désabonner de tout'));////
define('_ACA_MENU_VIEW_ARCHIVE', compa::encodeutf('Archive'));
define('_ACA_MENU_PREVIEW', compa::encodeutf('Aperçu'));////
define('_ACA_MENU_SEND', compa::encodeutf('Envoyer'));
define('_ACA_MENU_SEND_TEST', compa::encodeutf('Envoyer un Essai'));
define('_ACA_MENU_SEND_QUEUE', compa::encodeutf('File d\'attente de Processus'));
define('_ACA_MENU_VIEW', compa::encodeutf('Aperçu'));
define('_ACA_MENU_COPY', compa::encodeutf('Copier'));
define('_ACA_MENU_VIEW_STATS', compa::encodeutf('Afficher statistiques'));
define('_ACA_MENU_CRTL_PANEL', compa::encodeutf('Tableau de configuration'));
define('_ACA_MENU_LIST_NEW', compa::encodeutf('Créer une liste'));
define('_ACA_MENU_LIST_EDIT', compa::encodeutf(' Éditer une liste'));
define('_ACA_MENU_BACK', compa::encodeutf('Retour'));
define('_ACA_MENU_INSTALL', compa::encodeutf('Installation'));
define('_ACA_MENU_TAB_SUM', compa::encodeutf('Résumer'));
define('_ACA_STATUS', compa::encodeutf('Statut'));
define('_ACA_SENT_MAILING', compa::encodeutf('Message envoyé'));

// messages
define('_ACA_ERROR', compa::encodeutf('Une erreur s\'est produite!'));
define('_ACA_SUB_ACCESS', compa::encodeutf('Droits d\'utilisateur'));
define('_ACA_DESC_CREDITS', compa::encodeutf('Crédits'));
define('_ACA_DESC_INFO', compa::encodeutf('Information'));
define('_ACA_DESC_HOME', compa::encodeutf('Accueil'));
define('_ACA_DESC_MAILING', compa::encodeutf('Liste d\'envoi'));
define('_ACA_DESC_SUBSCRIBERS', compa::encodeutf('Abonnés'));
define('_ACA_PUBLISHED', compa::encodeutf('Publié'));
define('_ACA_UNPUBLISHED', compa::encodeutf('Non publié'));
define('_ACA_DELETE', compa::encodeutf('Effacer'));
define('_ACA_FILTER', compa::encodeutf('Filtrer'));
define('_ACA_UPDATE', compa::encodeutf('Mise à jour'));
define('_ACA_SAVE', compa::encodeutf('Sauvegarder'));
define('_ACA_CANCEL', compa::encodeutf('Annuler'));
define('_ACA_NAME', compa::encodeutf('Nom'));
define('_ACA_EMAIL', compa::encodeutf('Courriel'));
define('_ACA_SELECT', compa::encodeutf('Sélectionner'));
define('_ACA_ALL', compa::encodeutf('Tout'));
define('_ACA_SEND_A', compa::encodeutf('Envoyer un'));
define('_ACA_SUCCESS_DELETED', compa::encodeutf('Supprimé avec succès'));
define('_ACA_LIST_ADDED', compa::encodeutf('Liste créée avec succès'));
define('_ACA_LIST_COPY', compa::encodeutf('Liste copiée avec succès'));
define('_ACA_LIST_UPDATED', compa::encodeutf('Liste mise à jour avec succès.'));
define('_ACA_MAILING_SAVED', compa::encodeutf('Envoie sauvegardé avec succès.'));
define('_ACA_UPDATED_SUCCESSFULLY', compa::encodeutf(' mise à jour avec succès.'));


### Subscribers information ###
//subscribe and unsubscribe info
define('_ACA_SUB_INFO', compa::encodeutf('Informations Abonné'));
define('_ACA_VERIFY_INFO', compa::encodeutf('Veuillez verifier le lien entré, des informations manquent.'));
define('_ACA_INPUT_NAME', compa::encodeutf('Nom'));
define('_ACA_INPUT_EMAIL', compa::encodeutf('Courriel'));
define('_ACA_RECEIVE_HTML', compa::encodeutf('Recevoir du HTML?'));
define('_ACA_TIME_ZONE', compa::encodeutf('Fuseaux horaire'));
define('_ACA_BLACK_LIST', compa::encodeutf('Liste noire'));
define('_ACA_REGISTRATION_DATE', compa::encodeutf('Date d\'enregistrement de l\'utilisateur'));
define('_ACA_USER_ID', compa::encodeutf('Utilisateur id'));
define('_ACA_DESCRIPTION', compa::encodeutf('Description'));
define('_ACA_ACCOUNT_CONFIRMED', compa::encodeutf('Votre compte a été activé.'));
define('_ACA_SUB_SUBSCRIBER', compa::encodeutf('Abonné'));
define('_ACA_SUB_PUBLISHER', compa::encodeutf('Éditeur'));
define('_ACA_SUB_ADMIN', compa::encodeutf('Administrateur'));
define('_ACA_REGISTERED', compa::encodeutf('Enregistré'));
define('_ACA_SUBSCRIPTIONS', compa::encodeutf('Abonnements'));
define('_ACA_SEND_UNSUBCRIBE', compa::encodeutf('Abonnements'));
define('_ACA_SEND_UNSUBCRIBE_TIPS', compa::encodeutf('Cliquez sur Oui pour envoyer un courriel de confimation de désabonnement.'));
define('_ACA_SUBSCRIBE_SUBJECT_MESS', compa::encodeutf('Veuillez confirmer votre abonnement'));
define('_ACA_UNSUBSCRIBE_SUBJECT_MESS', compa::encodeutf('Confirmation de désabonnement'));
define('_ACA_DEFAULT_SUBSCRIBE_MESS', compa::encodeutf('Bonjour [NAME],<br />' .
		'Plus qu\'une étape et vous serez inscrit sur la liste. Cliquez s\'il vous plaît sur le lien suivant pour confirmer votre abonnement.' .
		'<br /><br />[CONFIRM]<br /><br />Pour toutes questions veuillez contacter le webmaster.'));
define('_ACA_DEFAULT_UNSUBSCRIBE_MESS', compa::encodeutf('Ceci un courriel de confirmation de désabonnement à notre liste. Nous sommes désolés que vous ayez décidé de vous désabonner .Si vous décidez de vous ré-inscrire vous pouvez le faire sur notre site. Pour toutes questions veuillez contacter le webmaster.'));

// Acajoom subscribers
define('_ACA_CONFIRMED', compa::encodeutf('Confirmé'));
define('_ACA_SUBSCRIB', compa::encodeutf('Souscrire'));
define('_ACA_HTML', compa::encodeutf('HTML envoies'));///
define('_ACA_RESULTS', compa::encodeutf('Résultats'));
define('_ACA_SEL_LIST', compa::encodeutf('Selectionner une liste'));
define('_ACA_SEL_LIST_TYPE', compa::encodeutf('-Selectionner un type de liste -'));
define('_ACA_SUSCRIB_LIST', compa::encodeutf('Liste de tous les abonnés'));
define('_ACA_SUSCRIB_LIST_UNIQUE', compa::encodeutf('Abonnés pour : '));
define('_ACA_NO_SUSCRIBERS', compa::encodeutf('Aucun abonné n\'a été trouvé pour cette liste.'));

define('_ACA_COMFIRM_SUBSCRIPTION', compa::encodeutf('Un courriel de comfirmation vous a été envoyé. Vérifiez s\'il vous plaît votre courriel et cliquer sur le lien fourni.<br />' .
		'Vous devez confirmer votre courriel pour que votre abonnement puisse prendre effet.'));
define('_ACA_SUCCESS_ADD_LIST', compa::encodeutf('Vous avez été ajoutés avec succès à la liste.'));


 // Subcription info
define('_ACA_CONFIRM_LINK', compa::encodeutf('Cliquez ici pour confirmer votre abonnement.'));
define('_ACA_UNSUBSCRIBE_LINK', compa::encodeutf('Cliquez ici pour vous désabonnez de la liste'));
define('_ACA_UNSUBSCRIBE_MESS', compa::encodeutf('Votre adresse courriel a été supprimée des listes'));
define('_ACA_QUEUE_SENT_SUCCESS', compa::encodeutf('Tous les courriels programmés ont été envoyés avec succès.'));
define('_ACA_MALING_VIEW', compa::encodeutf('Afficher tous les envoies'));
define('_ACA_UNSUBSCRIBE_MESSAGE', compa::encodeutf('Êtes-vous sûr de vouloir vous désabonner de cette liste?'));
define('_ACA_MOD_SUBSCRIBE', compa::encodeutf('S\'abonner'));
define('_ACA_SUBSCRIBE', compa::encodeutf('S\'abonner'));
define('_ACA_UNSUBSCRIBE', compa::encodeutf('Se désabonner'));
define('_ACA_VIEW_ARCHIVE', compa::encodeutf('Voir les archives'));
define('_ACA_SUBSCRIPTION_OR', compa::encodeutf('Cliquer ici pour mettre à jour vos informations'));
define('_ACA_EMAIL_ALREADY_REGISTERED', compa::encodeutf('Cette adresse courriel a déjà été enregistrée.'));
define('_ACA_SUBSCRIBER_DELETED', compa::encodeutf('Abonné supprimé avec succès.'));


### UserPanel ###
 //User Menu
define('_UCP_USER_PANEL', compa::encodeutf('Panneau de configuration Utilisateur'));
define('_UCP_USER_MENU', compa::encodeutf('Menu Utilisateur'));
define('_UCP_USER_CONTACT', compa::encodeutf('Mes Abonnements'));
 //Acajoom Cron Menu
define('_UCP_CRON_MENU', compa::encodeutf('Gestion des Tâches Cron'));
define('_UCP_CRON_NEW_MENU', compa::encodeutf('Nouveau Cron'));
define('_UCP_CRON_LIST_MENU', compa::encodeutf('Liste de mon Cron'));
 //Acajoom Coupon Menu
define('_UCP_COUPON_MENU', compa::encodeutf('Gestion de Coupons'));
define('_UCP_COUPON_LIST_MENU', compa::encodeutf('Liste de mes Coupons'));
define('_UCP_COUPON_ADD_MENU', compa::encodeutf('Ajouter un Coupon'));


### lists ###
// Tabs
define('_ACA_LIST_T_GENERAL', compa::encodeutf('Description'));
define('_ACA_LIST_T_LAYOUT', compa::encodeutf('Disposition'));
define('_ACA_LIST_T_SUBSCRIPTION', compa::encodeutf('Abonnement'));
define('_ACA_LIST_T_SENDER', compa::encodeutf('Informations sur l\'expéditeur'));

define('_ACA_LIST_TYPE', compa::encodeutf('Type de liste'));
define('_ACA_LIST_NAME', compa::encodeutf('Nom de liste'));
define('_ACA_LIST_ISSUE', compa::encodeutf('Publication #'));
define('_ACA_LIST_DATE', compa::encodeutf('Date d\'envoi'));
define('_ACA_LIST_SUB', compa::encodeutf('Titre de la liste'));/////
define('_ACA_HTML_CONTENT', compa::encodeutf('Contenu HTML'));/////
define('_ACA_ATTACHED_FILES', compa::encodeutf('Pièces jointes'));
define('_ACA_SELECT_LIST', compa::encodeutf('Veuillez choisir une liste pour l\'édition!'));

// Auto Responder box
define('_ACA_AUTORESP_ON', compa::encodeutf('Type de liste'));
define('_ACA_AUTO_RESP_OPTION', compa::encodeutf('Options des réponses automatiques'));
define('_ACA_AUTO_RESP_FREQ', compa::encodeutf('Les abonnés peuvent choisir la fréquence'));
define('_ACA_AUTO_DELAY', compa::encodeutf('Délai (en jours)'));
define('_ACA_AUTO_DAY_MIN', compa::encodeutf('Fréquence minimum'));
define('_ACA_AUTO_DAY_MAX', compa::encodeutf('Fréquence maximum'));
define('_ACA_FOLLOW_UP', compa::encodeutf('Spécifiez la réponse automatique suivante'));
define('_ACA_AUTO_RESP_TIME', compa::encodeutf('Les abonnés peuvent choisir le temps'));
define('_ACA_LIST_SENDER', compa::encodeutf('Liste des expéditeurs'));

define('_ACA_LIST_DESC', compa::encodeutf('Description de liste'));
define('_ACA_LAYOUT', compa::encodeutf('Disposition'));
define('_ACA_SENDER_NAME', compa::encodeutf('Nom de l\'expéditeur'));
define('_ACA_SENDER_EMAIL', compa::encodeutf('Courriel de l\'expéditeur'));
define('_ACA_SENDER_BOUNCE', compa::encodeutf('Adresse de retour de l\'expéditeur'));/////
define('_ACA_LIST_DELAY', compa::encodeutf('Délai'));
define('_ACA_HTML_MAILING', compa::encodeutf('Liste d\'envois de courriel HTML?'));
define('_ACA_HTML_MAILING_DESC', compa::encodeutf('(Si vous changez ceci, vous devrez sauvegarder et retourner à cet écran pour voir les changements.)'));
define('_ACA_HIDE_FROM_FRONTEND', compa::encodeutf('Visible du coté client?'));
define('_ACA_SELECT_IMPORT_FILE', compa::encodeutf('Choisissez un fichier à importer'));
define('_ACA_IMPORT_FINISHED', compa::encodeutf('Importation terminée'));
define('_ACA_DELETION_OFFILE', compa::encodeutf('Suppression du fichier'));
define('_ACA_MANUALLY_DELETE', compa::encodeutf('Échoué, vous devriez supprimer manuellement le fichier'));
define('_ACA_CANNOT_WRITE_DIR', compa::encodeutf('Écriture impossible dans le répertoire'));
define('_ACA_NOT_PUBLISHED', compa::encodeutf('Les courriels ne pourront pas être envoyés, la liste n\'est pas publiée.'));

//  List info box
define('_ACA_INFO_LIST_PUB', compa::encodeutf('cliquez Oui pour publier la liste'));
define('_ACA_INFO_LIST_NAME', compa::encodeutf('Entrez le nom de votre liste ici. Vous pourrez ainsi l\'identifier.'));
define('_ACA_INFO_LIST_DESC', compa::encodeutf('Entrez à une brève description de votre liste ici.Cette description sera visible par les visiteurs de votre site.'));
define('_ACA_INFO_LIST_SENDER_NAME', compa::encodeutf('Entrez le nom de l\'expéditeur de l\'envoie. Ce nom sera visible quand les abonnés receveront des messages de cette liste.'));
define('_ACA_INFO_LIST_SENDER_EMAIL', compa::encodeutf('Entrez l\'adresse courriel d\'où les messages seront envoyés.'));
define('_ACA_INFO_LIST_SENDER_BOUNCED', compa::encodeutf('Entrez l\'adresse courriel où les utilisateurs peuvent répondre. Il est fortement recommandé d\'avoir le même courriel que celui de l\'expéditeur, car les filtre de pourriels pourrons considérer votre Infolettre comme un pourriel.'));
define('_ACA_INFO_LIST_AUTORESP', compa::encodeutf('Choisir un type de liste d\'envoie. <br />' .
		'Infolettre:  infolettre normale<br />' .
		'Réponse automatique: Une réponse automatique est une liste qui est envoyée automatiquement par le site Web à intervalles réguliers.'));
define('_ACA_INFO_LIST_FREQUENCY', compa::encodeutf('Permettez aux utilisateurs de choisir combien de fois ils reçoivent la liste. Cela donne plus de flexibilité à l\'utilisateur.'));
define('_ACA_INFO_LIST_TIME', compa::encodeutf('Laissez l\'utilisateur choisir leur horaire préféré pour recevoir la liste.'));
define('_ACA_INFO_LIST_MIN_DAY', compa::encodeutf('Définissez la fréquence minimale que peut choisir un utilisateur pour recevoir la liste'));
define('_ACA_INFO_LIST_DELAY', compa::encodeutf('Spécifiez le delai entre cette réponse automatique et le précédent.'));
define('_ACA_INFO_LIST_DATE', compa::encodeutf('Spécifiez la date de publication de la liste de nouvelles si vous voulez retarder la publication. <br /> FORMAT : YYYY-MM-DD HH:MM:SS'));
define('_ACA_INFO_LIST_MAX_DAY', compa::encodeutf('Définissez la fréquence maximale que peut choisir un utilisateur pour recevoir la liste'));
define('_ACA_INFO_LIST_LAYOUT', compa::encodeutf('Entrez la disposition de votre liste d\'adresses ici. Vous pouvez entrer n\'importe quelle disposition pour votre envoie ici.'));
define('_ACA_INFO_LIST_SUB_MESS', compa::encodeutf('Ce message sera envoyé à l\'abonné quand il ou elle se seront inscrit. Vous pouvez définir n\'importe quel texte ici.'));
define('_ACA_INFO_LIST_UNSUB_MESS', compa::encodeutf('Ce message sera envoyé à l\'abonné quand il ou elle se désabonnera. N\'importe quel message peut être entré ici.'));
define('_ACA_INFO_LIST_HTML', compa::encodeutf('Cocher la case si vous voulez envoyer un envoie HTML. Les abonnés seront capables de spécifier s\'ils veulent recevoir les messages  HTML ou les Textes seulement lorsqu\'ils souscrivent à une liste HTML.'));
define('_ACA_INFO_LIST_HIDDEN', compa::encodeutf('Cliquez sur Oui pour cacher la liste du frontend, les utilisateurs ne pourront plus s\'abonner mais vous pourrez toujours envoyer des envoies.'));
define('_ACA_INFO_LIST_ACA_AUTO_SUB', compa::encodeutf('Voulez-vous assigner automatiquement des utilisateurs à cette liste ? < Br / > <B> Nouveaux Utilisateurs : </B > seront enregistrés tous les nouveaux utilisateurs qui s\'inscrivent sur le site Web. < Br / > < B> Tous les Utilisateurs : </B > enregistrera tous les utilisateurs enregistrés dans la base de données. < Br / > (toute cette option supportent le Community Builder))'));
define('_ACA_INFO_LIST_ACC_LEVEL', compa::encodeutf('Choisissez le niveau d\'accès de frontend. Cela montrera ou cachera le envoie au groupe utilisateurs qui n\'y a pas d\'accès, donc ils ne seront pas capables d\'y souscrire.'));
define('_ACA_INFO_LIST_ACC_USER_ID', compa::encodeutf('Choisissez le niveau d\'accès du groupe utilisateurs que vous voulez permettre d\'éditer. Ce usergroup et ceux au dessus seront capable d\'éditer l\'envoie et le pourront effectuer l\'envoie depuis le frontend et le backend.'));
define('_ACA_INFO_LIST_FOLLOW_UP', compa::encodeutf('Si vous voulez utiliser un autre auto-répondeur une fois le dernier message atteint  vous pouvez spécifier ici  l\'auto-répondeur suivant.'));
define('_ACA_INFO_LIST_ACA_OWNER', compa::encodeutf('C\'est l\'ID de la personne qui a créé la liste.'));
define('_ACA_INFO_LIST_WARNING', compa::encodeutf('Cette dernière option est disponible seulement une fois la liste créée.'));
define('_ACA_INFO_LIST_SUBJET', compa::encodeutf(' Sujet de l\'envoie, c\'est le sujet du courriel que l\'abonné reçevera.'));
define('_ACA_INFO_MAILING_CONTENT', compa::encodeutf('C\'est le corps du courriel que vous voulez envoyer.'));
define('_ACA_INFO_MAILING_NOHTML', compa::encodeutf('Entrez ici le corps du message pour les utilisateurs qui ont choisi de pas recevoir l\'infolettre au format HTML. <BR/> NOTE: si vous laissez cet espace vide, Acajoom convertira automatiquement le texte HTML en text normal.'));/////
define('_ACA_INFO_MAILING_VISIBLE', compa::encodeutf('Cliquez sur Oui pour que le envoie soit visible du frontend.'));
define('_ACA_INSERT_CONTENT', compa::encodeutf('Insérez le contenu existant'));

// Coupons
define('_ACA_SEND_COUPON_SUCCESS', compa::encodeutf('Coupon envoyé avec succès!'));
define('_ACA_CHOOSE_COUPON', compa::encodeutf('Choisissez un coupon'));
define('_ACA_TO_USER', compa::encodeutf(' À cet utilisateur'));

### Cron options
//drop down frequency(CRON)
define('_ACA_FREQ_CH1', compa::encodeutf('Toutes les heures'));
define('_ACA_FREQ_CH2', compa::encodeutf('Toutes les 6 heures'));
define('_ACA_FREQ_CH3', compa::encodeutf('Toutes les 12 heures'));
define('_ACA_FREQ_CH4', compa::encodeutf('Quotidiennement'));
define('_ACA_FREQ_CH5', compa::encodeutf('Toutes les semaines'));
define('_ACA_FREQ_CH6', compa::encodeutf('Toutes les mois'));
define('_ACA_FREQ_NONE', compa::encodeutf('Non'));
define('_ACA_FREQ_NEW', compa::encodeutf('Nouveaux Utilisateurs'));
define('_ACA_FREQ_ALL', compa::encodeutf('Tous les Utilisateurs'));

//Label CRON form
define('_ACA_LABEL_FREQ', compa::encodeutf('Acajoom Cron?'));
define('_ACA_LABEL_FREQ_TIPS', compa::encodeutf('Cliquez sur Oui si vous voulez l\'utiliser pour un Acajoom Cron, Non pour une autre tâche cron.<br />' .
		'Si vous cliquez sur Oui vous ne devez pas spécifier l\'Adresse de Cron, il sera automatiquement ajouté.'));
define('_ACA_SITE_URL', compa::encodeutf('L\'URL de votre site'));
define('_ACA_CRON_FREQUENCY', compa::encodeutf('Fréquence Cron'));
define('_ACA_STARTDATE_FREQ', compa::encodeutf('Date de Début'));
define('_ACA_LABELDATE_FREQ', compa::encodeutf('Date Spécifique'));
define('_ACA_LABELTIME_FREQ', compa::encodeutf('Horaire Spécifique'));
define('_ACA_CRON_URL', compa::encodeutf('Cron URL'));
define('_ACA_CRON_FREQ', compa::encodeutf('Fréquence'));
define('_ACA_TITLE_CRONLIST', compa::encodeutf(' Liste Cron'));
define('_NEW_LIST', compa::encodeutf('Créez une nouvelle liste'));

//title CRON form
define('_ACA_TITLE_FREQ', compa::encodeutf('Édition de vos tâches Cron'));
define('_ACA_CRON_SITE_URL', compa::encodeutf('Veuillez entrez une URL de site valable, commençant avec http://'));

### Envois ###
define('_ACA_MAILING_ALL', compa::encodeutf('Tous les envoie'));
define('_ACA_EDIT_A', compa::encodeutf('Éditer un '));
define('_ACA_SELCT_MAILING', compa::encodeutf('Vous devez choisir une liste dans la liste déroulante pour ajouter un nouveau envoie.'));
define('_ACA_VISIBLE_FRONT', compa::encodeutf('Visible du frontend'));

// courrieler
define('_ACA_SUBJECT', compa::encodeutf('Sujet'));
define('_ACA_CONTENT', compa::encodeutf('Contenu'));
define('_ACA_NAMEREP', compa::encodeutf('[NAME] = Cela sera remplacé par le nom de l\'abonné entré, vous enverrez un courriel personnalisé en l\'utilisant.<br />'));
define('_ACA_FIRST_NAME_REP', compa::encodeutf('[FIRSTNAME] = Cela sera remplacé par le PRÉNOM de l\'abonné entré.<br />'));
define('_ACA_NONHTML', compa::encodeutf('Version texte'));
define('_ACA_ATTACHMENTS', compa::encodeutf('Pièce jointe'));
define('_ACA_SELECT_MULTIPLE', compa::encodeutf('Tenez contrôle (ou commande) pour choisir des pièces jointes multiples.<br />' .
		'Les fichiers montrés dans cette liste de pièces jointes sont placés dans le dossier pièces jointes, vous pouvez changer cet emplacement dans le panneau de configuration.'));
define('_ACA_CONTENT_ITEM', compa::encodeutf('Item de contenu'));//
define('_ACA_SENDING_EMAIL', compa::encodeutf('Envoi de courriel'));
define('_ACA_MESSAGE_NOT', compa::encodeutf('Le message n\'a pas pu être envoyé'));
define('_ACA_MAILER_ERROR', compa::encodeutf('Erreur d\'envoi'));
define('_ACA_MESSAGE_SENT_SUCCESSFULLY', compa::encodeutf('Message envoyé avec succès'));
define('_ACA_SENDING_TOOK', compa::encodeutf('Envoyer cet infolettre '));////took
define('_ACA_SECONDS', compa::encodeutf('secondes'));
define('_ACA_NO_ADDRESS_ENTERED', compa::encodeutf('Aucune adresse courriel ou abonné n\'a été fourni'));
define('_ACA_NO_MAILING_ENTERED', compa::encodeutf('Aucune liste d\'envoie n\'a été fourni'));
define('_ACA_NO_LIST_ENTERED', compa::encodeutf('Aucune liste n\'a été fourni'));
define('_ACA_CHANGE_SUBSCRIPTIONS', compa::encodeutf('Changement'));
define('_ACA_CHANGE_EMAIL_SUBSCRIPTION', compa::encodeutf('Changez votre abonnement'));
define('_ACA_WHICH_EMAIL_TEST', compa::encodeutf('Indiquez l\'adresse électronique à laquelle vous voulez envoyer cet essai ou selectionnez aperçu'));
define('_ACA_SEND_IN_HTML', compa::encodeutf('Envoyer en HTML (pour les listes d\'envois html)?'));
define('_ACA_VISIBLE', compa::encodeutf('Visible'));
define('_ACA_INTRO_ONLY', compa::encodeutf('Intro seulement'));

// stats
define('_ACA_GLOBALSTATS', compa::encodeutf('Statistiques globales'));
define('_ACA_DETAILED_STATS', compa::encodeutf('Statistiques détaillées '));
define('_ACA_MAILING_LIST_DETAILS', compa::encodeutf('Listes détaillées'));
define('_ACA_SEND_IN_HTML_FORMAT', compa::encodeutf('Envoyez au format HTML'));
define('_ACA_VIEWS_FROM_HTML', compa::encodeutf('Vues (de courrier en HTML)'));
define('_ACA_SEND_IN_TEXT_FORMAT', compa::encodeutf('Envoyez au format texte'));
define('_ACA_HTML_READ', compa::encodeutf('lire HTML '));
define('_ACA_HTML_UNREAD', compa::encodeutf('Ne pas lire en HTML '));
define('_ACA_TEXT_ONLY_SENT', compa::encodeutf('Texte uniquement'));

// Configuration panel
// main tabs
define('_ACA_MAIL_CONFIG', compa::encodeutf('Courriel'));
define('_ACA_LOGGING_CONFIG', compa::encodeutf('Logs & Stats'));
define('_ACA_SUBSCRIBER_CONFIG', compa::encodeutf('Abonnés'));
define('_ACA_AUTO_CONFIG', compa::encodeutf('Cron'));
define('_ACA_MISC_CONFIG', compa::encodeutf('Divers'));
define('_ACA_MAIL_SETTINGS', compa::encodeutf('Paramètres de courriel'));/////
define('_ACA_MAILINGS_SETTINGS', compa::encodeutf('Paramètres des Envois'));
define('_ACA_SUBCRIBERS_SETTINGS', compa::encodeutf('Paramètres des Abonnés'));
define('_ACA_CRON_SETTINGS', compa::encodeutf('Paramètres du Cron'));
define('_ACA_SENDING_SETTINGS', compa::encodeutf('Paramètres de l\'envoi'));
define('_ACA_STATS_SETTINGS', compa::encodeutf(' Envoi des Statistiques'));
define('_ACA_LOGS_SETTINGS', compa::encodeutf('Paramètres de connection'));
define('_ACA_MISC_SETTINGS', compa::encodeutf('Paramètres Divers'));
// courriel settings
define('_ACA_SEND_MAIL_FROM', compa::encodeutf('Message de '));
define('_ACA_SEND_MAIL_NAME', compa::encodeutf('De nom'));
define('_ACA_MAILSENDMETHOD', compa::encodeutf('Méthodes d\'envoi'));//Courrieler method
define('_ACA_SENDMAILPATH', compa::encodeutf('chemin d\'envoi des courriels'));///
define('_ACA_SMTPHOST', compa::encodeutf('Hôte SMTP'));
define('_ACA_SMTPAUTHREQUIRED', compa::encodeutf('Authentification SMTP exigée'));
define('_ACA_SMTPAUTHREQUIRED_TIPS', compa::encodeutf('Choisissez oui si votre serveur de SMTP exige l\'authentification'));
define('_ACA_SMTPUSERNAME', compa::encodeutf('nom d\'utilisateur SMTP'));
define('_ACA_SMTPUSERNAME_TIPS', compa::encodeutf('Entrez votre SMTP username quand votre serveur SMTP exige l\'authentification'));
define('_ACA_SMTPPASSWORD', compa::encodeutf('mot de passe SMTP'));
define('_ACA_SMTPPASSWORD_TIPS', compa::encodeutf('Entrez votre SMTP password quand votre serveur SMTP exige l\'authentification'));
define('_ACA_USE_EMBEDDED', compa::encodeutf('Utilisez des images incorporées'));
define('_ACA_USE_EMBEDDED_TIPS', compa::encodeutf('Sélectionnez OUI pour que les images soient directement incluent dans l\'email sans être liées au site web'));
define('_ACA_UPLOAD_PATH', compa::encodeutf('Importer/chemin des pièces jointes'));
define('_ACA_UPLOAD_PATH_TIPS', compa::encodeutf('Vous pouvez spécifier un répertoire d\'importation.<br />' .
		'Vérifiez que le répertoire spécifié exist, sinon créez-le.'));

// subscribers settings
define('_ACA_ALLOW_UNREG', compa::encodeutf('Non enregistrés autorisés'));
define('_ACA_ALLOW_UNREG_TIPS', compa::encodeutf('Sélectionner Oui si vous voulez permettre aux utilisateurs de s\'inscrire à une liste sans être enregistrés sur le site.'));
define('_ACA_REQ_CONFIRM', compa::encodeutf('Confirmation requise'));
define('_ACA_REQ_CONFIRM_TIPS', compa::encodeutf('Sélectionner Oui si vous demandez aux utilisateurs non enregistrés de confirmer leur adresse courriel.'));
define('_ACA_SUB_SETTINGS', compa::encodeutf('Paramètres d\'inscription'));
define('_ACA_SUBMESSAGE', compa::encodeutf('Courriel d\'inscription'));
define('_ACA_SUBSCRIBE_LIST', compa::encodeutf('S\'incrire à une liste'));

define('_ACA_USABLE_TAGS', compa::encodeutf('Tags utilisables'));
define('_ACA_NAME_AND_CONFIRM', compa::encodeutf('<b>[CONFIRM]</b> = Ceci crée un lien hypertexte ou les utilisateurs peuvent confirmé leur inscription. Ceci est <strong>requis</strong> pour le bon fonctionnement d\'Acajoom.<br />'
.'<br />[NAME] = Ceci sera remplacé par le nom entré par l\'inscrit, vous enverrez des courriels personnalisés en utilisant ceci.<br />'
.'<br />[FIRSTNAME] = Ceci sera remplacé par le nom de l\'inscrit, le nom est défini comme le premier nom entré par l\'inscrit.<br />'));
define('_ACA_CONFIRMFROMNAME', compa::encodeutf('Confirmation du nom'));
define('_ACA_CONFIRMFROMNAME_TIPS', compa::encodeutf('Entrer le nom qui apparaitra sur la liste des confirmés.'));
define('_ACA_CONFIRMFROMEMAIL', compa::encodeutf('Confirmation de l\'courriel'));
define('_ACA_CONFIRMFROMEMAIL_TIPS', compa::encodeutf('Entrer l\'adress courriel qui apparaitra sur la liste des confirmés.'));
define('_ACA_CONFIRMBOUNCE', compa::encodeutf('Confirmer l\'adresse de rebond'));
define('_ACA_CONFIRMBOUNCE_TIPS', compa::encodeutf('Entrer l\'adresse de rebond à afficher dans les listes de confirmation.'));
define('_ACA_HTML_CONFIRM', compa::encodeutf('Confirmation HTML'));
define('_ACA_HTML_CONFIRM_TIPS', compa::encodeutf('Sélectionner oui si la liste de confirmation doit être en HTML si les utilisateurs autorise le HTML.'));
if(!defined('_ACA_TIME_ZONE')) define('_ACA_TIME_ZONE', compa::encodeutf('Demander le fuseau horaire'));
define('_ACA_TIME_ZONE_TIPS', compa::encodeutf('Sélectionner oui si vous voulez demander le fuseau horaire de l\'utilisateur.  La file d\'attente des courriels sera envoyée en tenant compte du fuseau horaire de l\'utilisateur lorsque cela est applicable'));

 // Cron Set up
define('_ACA_TIME_OFFSET_URL', compa::encodeutf('Cliquer ici pour paramètrer le décalage dans le panneau de configuration globale -> onglet Local'));
define('_ACA_TIME_OFFSET_TIPS', compa::encodeutf('Paramètrer le décalage temporel de votre serveur de sorte que la date et l\'heure enregistrées soient exactes '));
define('_ACA_TIME_OFFSET', compa::encodeutf('Décalage temporel'));
define('_ACA_CRON_TITLE', compa::encodeutf('Installation de la fonction cron'));
define('_ACA_CRON_DESC', compa::encodeutf('<br />En utilisant la fonction CRON vous pouvez paramètrer des taches planifiées pour votre site web Joomla !<br />' .
		'Pour l\'installer, vous devez ajouter dans le panneau de configuration crontab la commande suivante :<br />' .
		'<b>' . ACA_JPATH_LIVE . '/index2.php?option=com_acajoom&act=cron</b> ' .
		'<br /><br />Si vous avez besoin d\'aide pour l\'installation ou que vous avez des difficultés, n\hésitez pas à consulter notre forum <a href="http://www.ijoobi.com" target="_blank">http://www.ijoobi.com</a>'));
// sending settings
define('_ACA_PAUSEX', compa::encodeutf('Pause de x secondes à chaque quantité configurée de courriels'));
define('_ACA_PAUSEX_TIPS', compa::encodeutf('Entrer un nombre en seconde Acajoom donnera au serveur SMTP le temps d\'envoyer les messages avant de procéder à la prochaine quantité de messages configurée.'));
define('_ACA_EMAIL_BET_PAUSE', compa::encodeutf('Courriels entre les pauses'));
define('_ACA_EMAIL_BET_PAUSE_TIPS', compa::encodeutf('Le nombre de courriels à envoyer avant de faire une pause.'));
define('_ACA_WAIT_USER_PAUSE', compa::encodeutf('Attente de l\'entrée utilisateur à la pause'));
define('_ACA_WAIT_USER_PAUSE_TIPS', compa::encodeutf('Si le script doit attendre une entrée utilisateur lors des pauses entre les lots de courriels.'));
define('_ACA_SCRIPT_TIMEOUT', compa::encodeutf('Arrêt du Script'));
define('_ACA_SCRIPT_TIMEOUT_TIPS', compa::encodeutf('Le nombre de minutes où le script doit être capable de tourner.'));
// Stats settings
define('_ACA_ENABLE_READ_STATS', compa::encodeutf('Permettre la lecture des statistiques'));
define('_ACA_ENABLE_READ_STATS_TIPS', compa::encodeutf('Sélectionner Oui si vous vouler noter le nombre de vus. Cette technique peut seulement être utilisée avec les courriels html'));
define('_ACA_LOG_VIEWSPERSUB', compa::encodeutf('Noter le nombre de vus par abonné'));
define('_ACA_LOG_VIEWSPERSUB_TIPS', compa::encodeutf('Sélectionner Oui si vous vouler noter le nombre de vus par abonné. Cette technique peut seulement être utilisée avec les courriels html'));
// Logs settings
define('_ACA_DETAILED', compa::encodeutf('Logs détaillés'));
define('_ACA_SIMPLE', compa::encodeutf('Logs simplifiés'));
define('_ACA_DIAPLAY_LOG', compa::encodeutf('Afficher les logs'));
define('_ACA_DISPLAY_LOG_TIPS', compa::encodeutf('Sélectionner Oui si vous voulez affichez les logs lors de l\'envoi des courriels.'));
define('_ACA_SEND_PERF_DATA', compa::encodeutf('Envoyer les données d\'éxécution'));
define('_ACA_SEND_PERF_DATA_TIPS', compa::encodeutf('Sélectionner oui si vous voulez permettre à Acajoom d\'envoyer des rapports anonymes sur votre configuration, le nombre d\'abonnés à une liste et le temps mis pour envoyer les courriels. Ceci nous donnera une idée sur les performances d\'Acajoom et nous AIDERA à améliorer Acajoom dans les developeements futurs.'));
define('_ACA_SEND_AUTO_LOG', compa::encodeutf('Envoyer les logs pour les réponses automatiques'));
define('_ACA_SEND_AUTO_LOG_TIPS', compa::encodeutf('Sélectionnez oui si vous voulez envoyer an courriel de log à chaque traitement de la liste d\'envois.  AVERTISSEMENT : Cela peut aboutir à un très grand nombre de courriels.'));
define('_ACA_SEND_LOG', compa::encodeutf('Envoyer les logs'));
define('_ACA_SEND_LOG_TIPS', compa::encodeutf('Si une notification de l\'courriel doit être envoyée à l\'adresse courriel de l\'utilisateur qui a envoyé les courriels.'));
define('_ACA_SEND_LOGDETAIL', compa::encodeutf('Envoyer les logs détaillés'));
define('_ACA_SEND_LOGDETAIL_TIPS', compa::encodeutf('Détails inclus l\'information sur le succès ou l\'échec pour chaque abonné et un aperçu de l\'information. Simple envoie seulement l\'aperçu.'));
define('_ACA_SEND_LOGCLOSED', compa::encodeutf('Envoyer une notification si la connexion est interrompue'));
define('_ACA_SEND_LOGCLOSED_TIPS', compa::encodeutf('Avec cette option sur on, l\'utilisateur qui envoie le courrielling recevera encore un rapport par courriel.'));
define('_ACA_SAVE_LOG', compa::encodeutf('Sauvegarder les logs'));
define('_ACA_SAVE_LOG_TIPS', compa::encodeutf('Si un log concernant l\'envoi doit être ajouté au fichier de log.'));
define('_ACA_SAVE_LOGDETAIL', compa::encodeutf('Sauvegarder les logs détaillés'));
define('_ACA_SAVE_LOGDETAIL_TIPS', compa::encodeutf('Détails inclus l\'information sur le succès ou l\'échec pour chaque abonné et un aperçu de l\'information. Simple envoie seulement l\'aperçu.'));
define('_ACA_SAVE_LOGFILE', compa::encodeutf('Sauvegarder les fichiers de logs'));
define('_ACA_SAVE_LOGFILE_TIPS', compa::encodeutf('Fichier auquel les informations sur les logs doivent être ajoutés. Ce fichier peut devenir assez volumineux.'));
define('_ACA_CLEAR_LOG', compa::encodeutf('Clear log'));
define('_ACA_CLEAR_LOG_TIPS', compa::encodeutf('Effacer les fichiers de logs.'));

### control panel
define('_ACA_CP_LAST_QUEUE', compa::encodeutf('Dernière file d\'attente exécutée'));
define('_ACA_CP_TOTAL', compa::encodeutf('Total'));
define('_ACA_MAILING_COPY', compa::encodeutf('Copie réussie des envoies !'));

// Miscellaneous settings
define('_ACA_SHOW_GUIDE', compa::encodeutf('Afficher le guide'));
define('_ACA_SHOW_GUIDE_TIPS', compa::encodeutf('Afficher le guide pour aider les nouveaux utilisateurs à créer une infoletre, une réponse automatique et installer Acajoom proprement.'));
define('_ACA_AUTOS_ON', compa::encodeutf('Utiliser les réponses automatiques'));
define('_ACA_AUTOS_ON_TIPS', compa::encodeutf('Sélectionner Non si vous ne voulez pas utiliser les réponses automatiques, toutes les options des réponses automatiques seront désactivées.'));
define('_ACA_NEWS_ON', compa::encodeutf('Utiliser les Infolettres'));
define('_ACA_NEWS_ON_TIPS', compa::encodeutf('Sélectionner Non si vous ne voulez pas utiliser les Infolettres, toutes les options d\'infolettres seront déseactivées.'));
define('_ACA_SHOW_TIPS', compa::encodeutf('Montrer les astuces'));
define('_ACA_SHOW_TIPS_TIPS', compa::encodeutf('Montrer les astuces, pour aider les utilisateurs à se servir de Acajoom plus efficacement.'));
define('_ACA_SHOW_FOOTER', compa::encodeutf('Montrer le titre de bas de pages'));
define('_ACA_SHOW_FOOTER_TIPS', compa::encodeutf('Si oui ou non le copyright de bas de pages doit être affiché.'));
define('_ACA_SHOW_LISTS', compa::encodeutf('Montrer les listes sur le fontend'));
define('_ACA_SHOW_LISTS_TIPS', compa::encodeutf('Quand les utilisateurs ne sont pas enregistrés,montrer la liste des listes auquelles ils peuvent s\'abonner avec le bouton d\'archive pour les infolettres ou simplement une formulaire de login pour qu\'ils puissent s\'enregistrer.'));
define('_ACA_CONFIG_UPDATED', compa::encodeutf('Les détails de configuration ont été mis à jour !'));
define('_ACA_UPDATE_URL', compa::encodeutf('Mettre à jour l\'URL'));
define('_ACA_UPDATE_URL_WARNING', compa::encodeutf(' AVERTISSEMENT ! Ne changer pas cet URL à moins que vous ayez été invités à le faire par l\'équipe technique d\'Acajoom.<br />'));
define('_ACA_UPDATE_URL_TIPS', compa::encodeutf('Par exemple: http://www.ijoobi.com/update/ (inclus le slash fermant)'));

// module
define('_ACA_EMAIL_INVALID', compa::encodeutf('Le courriel entré est invalide.'));
define('_ACA_REGISTER_REQUIRED', compa::encodeutf('Merci de vous enregistrer sur le site avant de pouvoir vous abonner à une liste.'));
define('_ACA_SIGNUP_DATE', compa::encodeutf('Date d\'inscription'));

// Access level box
define('_ACA_OWNER', compa::encodeutf('Créateur de la liste :'));
define('_ACA_ACCESS_LEVEL', compa::encodeutf('Mettez un niveau d\'accès pour la liste '));
define('_ACA_ACCESS_LEVEL_OPTION', compa::encodeutf('Options du niveau d\'accès'));
define('_ACA_USER_LEVEL_EDIT', compa::encodeutf('Sélectionner quel niveau d\'utilisateur est autorisé à éditer un envoi	(soit frontend soit backend) '));

//  drop down options
define('_ACA_AUTO_DAY_CH1', compa::encodeutf('Journalier'));
define('_ACA_AUTO_DAY_CH2', compa::encodeutf('Journalier pas le weekend'));
define('_ACA_AUTO_DAY_CH3', compa::encodeutf('Tous les autres jours'));
define('_ACA_AUTO_DAY_CH4', compa::encodeutf('Tous les autres jours pas le weekend'));
define('_ACA_AUTO_DAY_CH5', compa::encodeutf('Hebdomadaire'));
define('_ACA_AUTO_DAY_CH6', compa::encodeutf('Bi-hebdomadaire'));
define('_ACA_AUTO_DAY_CH7', compa::encodeutf('Mensuel'));
define('_ACA_AUTO_DAY_CH9', compa::encodeutf('Annuel'));
define('_ACA_AUTO_OPTION_NONE', compa::encodeutf('Non'));
define('_ACA_AUTO_OPTION_NEW', compa::encodeutf('Nouvel Utilisateurs'));
define('_ACA_AUTO_OPTION_ALL', compa::encodeutf('Tous les utilisations'));

//
define('_ACA_UNSUB_MESSAGE', compa::encodeutf('Se désincrire des courriels'));
define('_ACA_UNSUB_SETTINGS', compa::encodeutf('Paramètres de désincription'));
define('_ACA_AUTO_ADD_NEW_USERS', compa::encodeutf('Inscription automatique des utilisateurs?'));

// Update and upgrade messages
define('_ACA_VERSION', compa::encodeutf('Version d\'Acajoom'));
define('_ACA_NO_UPDATES', compa::encodeutf('Il n\'y a pas actuellement de mises à jours disponibles.'));
define('_ACA_NEED_UPDATED', compa::encodeutf('Fichiers qui ont besoin d\'être mis à jour :'));
define('_ACA_NEED_ADDED', compa::encodeutf('Fichiers qui ont besoin d\'être ajoutés :'));
define('_ACA_NEED_REMOVED', compa::encodeutf('Fichiers qui ont besoin d\'être supprimés :'));
define('_ACA_FILENAME', compa::encodeutf('Nom di fichier :'));
define('_ACA_CURRENT_VERSION', compa::encodeutf('Version actuelle :'));
define('_ACA_NEWEST_VERSION', compa::encodeutf('Version la plus récente :'));
define('_ACA_UPDATING', compa::encodeutf('Mettre à jour'));
define('_ACA_UPDATE_UPDATED_SUCCESSFULLY', compa::encodeutf('Les fichiers ont été mis à jour avec succès.'));
define('_ACA_UPDATE_FAILED', compa::encodeutf('La mise à jour à échoué !'));
define('_ACA_ADDING', compa::encodeutf('Ajouter'));
define('_ACA_ADDED_SUCCESSFULLY', compa::encodeutf('Ajouter avec succès.'));
define('_ACA_ADDING_FAILED', compa::encodeutf('L\'ajout a échoué !'));
define('_ACA_REMOVING', compa::encodeutf('Supprimer'));
define('_ACA_REMOVED_SUCCESSFULLY', compa::encodeutf('Supprimer avec succès.'));
define('_ACA_REMOVING_FAILED', compa::encodeutf('La suppression a échoué!'));
define('_ACA_INSTALL_DIFFERENT_VERSION', compa::encodeutf('Installer une version différente'));
define('_ACA_CONTENT_ADD', compa::encodeutf('Ajouter un contenu'));
define('_ACA_UPGRADE_FROM', compa::encodeutf('Importer des données (informations sur les infolettres and les abonnés) de '));
define('_ACA_UPGRADE_MESS', compa::encodeutf('Il n\'y a aucun risque pour vos données existantes. <br /> Le processus va simplement importer les données dans la base de données de Acajoom.'));
define('_ACA_CONTINUE_SENDING', compa::encodeutf('Continuer l\'envoi'));

// Acajoom message
define('_ACA_UPGRADE1', compa::encodeutf('Vous pouvez facilement importer vos utilisateurs et vos infolettres de '));
define('_ACA_UPGRADE2', compa::encodeutf(' vers Acajoom dans le panneau de mise à jour.'));
define('_ACA_UPDATE_MESSAGE', compa::encodeutf('Une nouvelle version de Acajoom est disponible. '));
define('_ACA_UPDATE_MESSAGE_LINK', compa::encodeutf('Une nouvelle version de Acajoom est disponible. Cliquer ici pour mettre à jour !'));
define('_ACA_CRON_SETUP', compa::encodeutf('Pour utiliser les réponses automatiques, vous avec besoin d\'installer une tâche cron.'));
define('_ACA_THANKYOU', compa::encodeutf('Merci d\'avoir choisi Acajoom, Votre partenaire de communication !'));
define('_ACA_NO_SERVER', compa::encodeutf('Le serveur de mise à jour n\'est pas disponible, merci de revenir un peu plus tard.'));
define('_ACA_MOD_PUB', compa::encodeutf('Le module Acajoom n\'est pas publié.'));
define('_ACA_MOD_PUB_LINK', compa::encodeutf('Cliquez ici pour le publier!'));
define('_ACA_IMPORT_SUCCESS', compa::encodeutf('Importer avec succès'));
define('_ACA_IMPORT_EXIST', compa::encodeutf('Utilisateur déjà présent dans la base de données'));


// Acajoom's Guide
define('_ACA_GUIDE', compa::encodeutf('\'s User Guide'));
define('_ACA_GUIDE_FIRST_ACA_STEP', compa::encodeutf('<p>Acajoom a plein de caractéristiques et ce tutotrial vous guidera au travers d\'un processus en quatre étapes pour vous permettre d\'envoyer d\'infolettres et des réponses automatiques!<p />'));
define('_ACA_GUIDE_FIRST_ACA_STEP_DESC', compa::encodeutf('Premièrement, vous avez besoin d\'ajouter une liste. Une liste peut être de deux types, soit une infolettre soit une réponse automatique.' .
		'  Dans une liste, you définissez tous les différents paramètres permettant l\'envoi de vos infolettres ou de vos réponses automatiques : nom de l\'expéditeur, la disposition, les abonnés\' le message de bienvenue, etc...
<br /><br />Vous pouvez créer votre première liste ici : <a href="index2.php?option=com_acajoom&act=list" >Créer une liste</a> et cliquer sur le Nouveau bouton.'));
define('_ACA_GUIDE_FIRST_ACA_STEP_UPGRADE', compa::encodeutf('Acajoom vous fournit un moyen facile d\'importer toutes vos données d\'une version antérieure de système d\'infolettres.<br />' .
		' Allez dans le panneau d\'importation et choisissez votre ancien système d\'infolettres pour importer toutes vos infolettres et tous vos abonnés.<br /><br />' .
		'<span style="color:#FF5E00;" >IMPORTANT: L\'import ne présente AUCUN risque et n\'affectera d\'aucune manière les données de votre ancien système d\'infolettres</span><br />' .
		'Après l\'import, vous pourrez gérer vos abonnés et l\'envoi des courriels directement à partir de Acajoom.<br /><br />'));
define('_ACA_GUIDE_SECOND_ACA_STEP', compa::encodeutf('Super votre première liste est créée !  Vous pouvez maintenant écrire votre première %s.  Pour la créer, aller dans : '));
define('_ACA_GUIDE_SECOND_ACA_STEP_AUTO', compa::encodeutf('Gestion des réponses automatiques'));
define('_ACA_GUIDE_SECOND_ACA_STEP_NEWS', compa::encodeutf('Gestion d\'infolettres'));
define('_ACA_GUIDE_SECOND_ACA_STEP_FINAL', compa::encodeutf(' et sélectionner votre %s. <br /> Ensuite choisissez %s dans le menu déroulant.  Créer votre premier envoie en cliquant sur Nouveau '));

define('_ACA_GUIDE_THRID_ACA_STEP_NEWS', compa::encodeutf('Avant d\envoyer votre première infolettre vous voudrez peut-être vérifier la configuration des courriels.  ' .
		'Allez à la <a href="index2.php?option=com_acajoom&act=configuration" >page de configuration</a> pour vérifier les paramètres des courriels. <br />'));
define('_ACA_GUIDE_THRID2_ACA_STEP_NEWS', compa::encodeutf('<br />Quand vous êtes prêt, retourner au menu Infolettres, sélectionner votre courriel et cliquez sur Envoyer'));

define('_ACA_GUIDE_THRID_ACA_STEP_AUTOS', compa::encodeutf('Pour l\'envoi des réponses automatiques vous avez besoin premièrement d\'installer une tâche cron sur votre serveur. ' .
		' Merci de vous référer au Cron tab dans le panneau de configuration.' .
		' <a href="index2.php?option=com_acajoom&act=configuration" >Cliquez ici</a> pour apprendre comment installer une tâche cron. <br />'));

define('_ACA_GUIDE_MODULE', compa::encodeutf(' <br />Assurer vous également d\'avoir publié le module Acajoom pour que les utilisateurs puissent s\'inscrire sur les listes.'));

define('_ACA_GUIDE_FOUR_ACA_STEP_NEWS', compa::encodeutf(' Vous pouvez maintemant également créer une réponse automatique.'));
define('_ACA_GUIDE_FOUR_ACA_STEP_AUTOS', compa::encodeutf(' Vous pouvez maintemant également créer une infolettre.'));

define('_ACA_GUIDE_FOUR_ACA_STEP', compa::encodeutf('<p><br />Voila! Vous êtes prêt à communiquer efficacement avec vos visiteurs et vos utilisateurs. Ce tutoriel se terminera dès que vous aurez entré un second courriel ou vous pouvez l\arrêter dans le panneau de configuration.' .
		'<br /><br />  Si vous avez des questions sur l\'utilisation de Acajoom, merci de vous référer à la ' .
		'<a target="_blank"  href="http://www.ijoobi.com/index.php?option=com_content&Itemid=72&view=category&layout=blog&id=29&limit=60" >documentation</a>. ' .
		' Vous pouvez aussi trouver de nombreuses informations sur comment communiquer efficacement avec vos abonnés sur <a href="http://www.ijoobi.com/" target="_blank"">www.ijoobi.com</a>.' .
		'<p /><br /><b>Merci d\'utiliser Acajoom. Votre Partenaire de Communication !</b> '));
define('_ACA_GUIDE_TURNOFF', compa::encodeutf('Le guide est maintenant arrêté !'));
define('_ACA_STEP', compa::encodeutf('STEP '));

// Acajoom Install
define('_ACA_INSTALL_CONFIG', compa::encodeutf('Configuration Acajoom'));
define('_ACA_INSTALL_SUCCESS', compa::encodeutf('Installation réussie'));
define('_ACA_INSTALL_ERROR', compa::encodeutf('Erreur d installation'));
define('_ACA_INSTALL_BOT', compa::encodeutf('Plugin Acajoom (Bot)'));
define('_ACA_INSTALL_MODULE', compa::encodeutf('Module Acajoom Module'));
//Others
define('_ACA_JAVASCRIPT', compa::encodeutf('! Attention ! Javascript doit être activé pour une bonne opération.'));
define('_ACA_EXPORT_TEXT', compa::encodeutf('L\'exportation des abonnés est basé sur la liste que vous avez choisie. <br />Exporter les abonnés de la liste'));
define('_ACA_IMPORT_TIPS', compa::encodeutf('Importation des abonnés. Les informations dans le fichier nécessitent d\'être au format suivant : <br />' .
		'Name,courriel,receiveHTML(1/0),<span style="color: rgb(255, 0, 0);">confirmed(1/0)</span>'));
define('_ACA_SUBCRIBER_EXIT', compa::encodeutf('est déjà un abonné'));
define('_ACA_GET_STARTED', compa::encodeutf('Cliquez ici pour commencer !'));

//News since 1.0.1
define('_ACA_WARNING_1011', compa::encodeutf('Avertissement: 1011: La mise à jour ne fonctionnera pas à cause des restrictions sur votre serveur.'));
define('_ACA_SEND_MAIL_FROM_TIPS', compa::encodeutf(' Choisissez l\'adresse courriel qui apparaîtra comme expéditeur. '));
define('_ACA_SEND_MAIL_NAME_TIPS', compa::encodeutf(' Choisissez le nom qui apparaitra comme expéditeur.'));
define('_ACA_MAILSENDMETHOD_TIPS', compa::encodeutf('Choisissez quel type de serveur vous désirez utiliser : Fonction PHP MAIL, <span>Sendmail</span> or Serveur SMTP.'));
define('_ACA_SENDMAILPATH_TIPS', compa::encodeutf('Ceci est le répertoire du serveur Courriel'));
define('_ACA_LIST_T_TEMPLATE', compa::encodeutf('Template'));
if(!defined('_ACA_NO_MAILING_ENTERED')) define('_ACA_NO_MAILING_ENTERED', compa::encodeutf('Pas de courriel fourni'));
if(!defined('_ACA_NO_LIST_ENTERED')) define('_ACA_NO_LIST_ENTERED', compa::encodeutf('Pas de liste fournie'));
if(!defined('_ACA_SENT_MAILING')) define('_ACA_SENT_MAILING', compa::encodeutf('Courriels envoyés'));
define('_ACA_SELECT_FILE', compa::encodeutf('Merci de sélectionner un fichier '));
define('_ACA_LIST_IMPORT', compa::encodeutf(' Vérifier les listes auxquelles vous voulez que les abonnés soient associés.'));
define('_ACA_PB_QUEUE', compa::encodeutf(' Abonné inséré mais un problème est survenu pour le/la relier aux listes. Merci de vérifier manuellement.'));
define('_ACA_UPDATE_MESS', compa::encodeutf(''));
define('_ACA_UPDATE_MESS1', compa::encodeutf('Mise à jour hautement recommandée!'));
define('_ACA_UPDATE_MESS2', compa::encodeutf('Rustine(patch) et petites corrections.'));
define('_ACA_UPDATE_MESS3', compa::encodeutf('Nouvelle version.'));
define('_ACA_UPDATE_MESS5', compa::encodeutf('Joomla 1.5 est requis pour mettre à jour.'));
define('_ACA_UPDATE_IS_AVAIL', compa::encodeutf(' est disponible ! '));
define('_ACA_NO_MAILING_SENT', compa::encodeutf('Aucun courriel envoyé ! '));
define('_ACA_SHOW_LOGIN', compa::encodeutf('Afficher le formulaire d\'enregistrement'));
define('_ACA_SHOW_LOGIN_TIPS', compa::encodeutf('Sélectionner Oui pour montrer le formulaire d\'enregistrement depuis le front-end du panneau de configuration dÕAcajoom pour permettre aux utilisateurs de sÕenregistrer sur le site web.'));
define('_ACA_LISTS_EDITOR', compa::encodeutf('Éditeur de description des listes'));
define('_ACA_LISTS_EDITOR_TIPS', compa::encodeutf('Sélectionner Oui pour utiliser un éditeur HTML pour éditer le champ description des listes.'));
define('_ACA_SUBCRIBERS_VIEW', compa::encodeutf('Voir les abonnés'));

//News since 1.0.2
define('_ACA_FRONTEND_SETTINGS', compa::encodeutf('Paramètres du front-end'));
define('_ACA_SHOW_LOGOUT', compa::encodeutf('Montrer le bouton de déconnexion'));
define('_ACA_SHOW_LOGOUT_TIPS', compa::encodeutf('Sélectionner Oui pour afficher un bouton de déconnexion dans le panneau de configuration du Front End d\'Acajoom.'));

//News since 1.0.3 CB integration
define('_ACA_CONFIG_INTEGRATION', compa::encodeutf('Intégration'));
define('_ACA_CB_INTEGRATION', compa::encodeutf('Intégration de Community Builder'));
define('_ACA_INSTALL_PLUGIN', compa::encodeutf('Plugin de Community Builder (Intégration d\'Acajoom) '));
define('_ACA_CB_PLUGIN_NOT_INSTALLED', compa::encodeutf('Le plugin pour Community Builder d\'Acajoom n\'est pas encore installé !'));
define('_ACA_CB_PLUGIN', compa::encodeutf('Listes à l\'enregistrement'));
define('_ACA_CB_PLUGIN_TIPS', compa::encodeutf('Sélectionner Oui pour afficher les listes d\'envoi dans le formulaire d\'enregistrement de Community builder'));
define('_ACA_CB_LISTS', compa::encodeutf('Listes des identifiants'));
define('_ACA_CB_LISTS_TIPS', compa::encodeutf('Ceci est un champ obligatoire. Entrez l\'identifiant numérique des listes auxquelles vous souhaitez permettre aux utilisateurs de s\'abonner, separés par une virgule ,  (0 montrer toutes les listes)'));
define('_ACA_CB_INTRO', compa::encodeutf('Texte d\'introduction'));
define('_ACA_CB_INTRO_TIPS', compa::encodeutf('Le texte qui apparaitra avant les listes. Laisser vide pour ne rien n\'afficher. Utiliser cb_pretext pour la disposition CSS.'));
define('_ACA_CB_SHOW_NAME', compa::encodeutf('Afficher le nom des listes'));
define('_ACA_CB_SHOW_NAME_TIPS', compa::encodeutf('Sélectionner si afficher ou non le nom des listes après l\'introduction.'));
define('_ACA_CB_LIST_DEFAULT', compa::encodeutf('Vérifier les listes par défaut'));
define('_ACA_CB_LIST_DEFAULT_TIPS', compa::encodeutf('Selectionner si oui ou non vous voulez les checkbox pour chaque liste choisie par défaut.'));
define('_ACA_CB_HTML_SHOW', compa::encodeutf('Montrer recevoir en HTML'));
define('_ACA_CB_HTML_SHOW_TIPS', compa::encodeutf('Mettez Oui si vous autoriser les utilisateurs à choisir si ils veulent ou non recevoir les courriels en HTML. Mettre Non pour utiliser par default recevoir les courriels en html.'));
define('_ACA_CB_HTML_DEFAULT', compa::encodeutf('Recevoir en HTML par défaut'));
define('_ACA_CB_HTML_DEFAULT_TIPS', compa::encodeutf('Renseignez cette option pour afficher la configuration des envois en HTML par défaut. Si Recevoir en HTML par défaut est positionné sur Non alors cette option sera par défaut.'));

// Since 1.0.4
define('_ACA_BACKUP_FAILED', compa::encodeutf('Les fichiers n\'ont pas pu être sauvegardés ! Fichiers non remplacés.'));
define('_ACA_BACKUP_YOUR_FILES', compa::encodeutf('L\'ancienne version des fichiers a été sauvegardée dans le répertoire suivant :'));
define('_ACA_SERVER_LOCAL_TIME', compa::encodeutf('Serveur local de temps'));
define('_ACA_SHOW_ARCHIVE', compa::encodeutf('Montrer le bouton Archive'));
define('_ACA_SHOW_ARCHIVE_TIPS', compa::encodeutf('Sélectionnez Oui pour montrer le bouton Archive dans le listing des Infolettres du front end'));
define('_ACA_LIST_OPT_TAG', compa::encodeutf('Tags'));
define('_ACA_LIST_OPT_IMG', compa::encodeutf('Images'));
define('_ACA_LIST_OPT_CTT', compa::encodeutf('Contenu'));
define('_ACA_INPUT_NAME_TIPS', compa::encodeutf('Entrez votre nom complet (Prénom en premier)'));
define('_ACA_INPUT_EMAIL_TIPS', compa::encodeutf('Entrez votre addresse courriel (Vérifiez que l\'adresse courriel est valide si vous voulez recevoir nos courriels.)'));
define('_ACA_RECEIVE_HTML_TIPS', compa::encodeutf('Choisissez Oui si vous voulez recevoir les courriels au format HTML - Non pour recevoir seulement les courriels au format texte'));
define('_ACA_TIME_ZONE_ASK_TIPS', compa::encodeutf('Spécifiez votre fuseau horaire.'));

// Since 1.0.5
define('_ACA_FILES', compa::encodeutf('Fichiers'));
define('_ACA_FILES_UPLOAD', compa::encodeutf('Importer'));
define('_ACA_MENU_UPLOAD_IMG', compa::encodeutf('Importer Images'));
define('_ACA_TOO_LARGE', compa::encodeutf('La taille du fichier est trop importante. Le maximum autorisé est '));
define('_ACA_MISSING_DIR', compa::encodeutf('Le répertoire de destination n\'existe pas'));
define('_ACA_IS_NOT_DIR', compa::encodeutf('Le répertoire de destination n\'existe pas ou est un fichier.'));
define('_ACA_NO_WRITE_PERMS', compa::encodeutf('Le répertoire de destination n\'a pas les droits en écriture.'));
define('_ACA_NO_USER_FILE', compa::encodeutf('Vous n\'avez pas sélectionné de fichiers pour l\'importation.'));
define('_ACA_E_FAIL_MOVE', compa::encodeutf('Impossible de déplacer le fichier.'));
define('_ACA_FILE_EXISTS', compa::encodeutf('Le répertoire de destination existe déjà.'));
define('_ACA_CANNOT_OVERWRITE', compa::encodeutf('Le répertoire de destination existe déjà et il est impossible de l\'écraser.'));
define('_ACA_NOT_ALLOWED_EXTENSION', compa::encodeutf('L\'extention du fichier n\'est pas autorisé.'));
define('_ACA_PARTIAL', compa::encodeutf('Le fichier a été partiellement importé.'));
define('_ACA_UPLOAD_ERROR', compa::encodeutf('Erreur d\'importation :'));
define('DEV_NO_DEF_FILE', compa::encodeutf('Le fichier a été partiellement importé.'));
define('_ACA_CONTENTREP', compa::encodeutf('[SUBSCRIPTIONS] = Ceci sera remplacé par les liens de souscription.' .
		' Ceci est <strong>nécessaire</strong> pour qu\'Acajoom fonctionne correctement.<br />' .
		'Si vous placez n\'importe quel autre contenu dans ce cadre il sera affiché dans tous les envois correspondants à cette liste.' .
		' <br />Ajouter votre message de souscription à la fin.  Acajoom ajoutera automatiquement un lien pour que les utilisateurs puissent modifier leurs informations et un lien pour se désabonner de la liste.'));

// since 1.0.6
define('_ACA_NOTIFICATION', compa::encodeutf('Notification'));  // shortcut for Courriel notification
define('_ACA_NOTIFICATIONS', compa::encodeutf('Notifications'));
define('_ACA_USE_SEF', compa::encodeutf('SEF dans les envois'));
define('_ACA_USE_SEF_TIPS', compa::encodeutf('Il est recommandé de choisir non. Cependant si vous voulez que l\'url incluse dans vos envois utilise  SEF alors choississez Oui.' .
		' <br /><b>Les liens fonctionneront de la même manière pour l\'une ou l\'autre des options .  Rien n\'assurera que les liens dans les envois fonctionneront toujours si vous changez votre SEF.</b> '));
define('_ACA_ERR_NB', compa::encodeutf('Erreur #: ERR'));
define('_ACA_ERR_SETTINGS', compa::encodeutf('Paramètres de gestion des erreurs'));
define('_ACA_ERR_SEND', compa::encodeutf('Envoyer un rapport d\'erreur'));
define('_ACA_ERR_SEND_TIPS', compa::encodeutf('Si vous voulez qu\'Acajoom s\'améliore, sélectionnez Oui.  Cela nous enverra un rapport d\'erreur.  Ainsi vous même n\'avez plus besoin de rapporter les bugs  ;-) <br /> <b>AUCUNE INFORMATION PRIVEE N\'EST ENVOYEE</b>.  Nous ne savons même pas de quel site Web,  l\'erreur provient . Nous envoyons seulement des informations sur Acajoom, l\'installation PHP et les requêtes SQL. '));
define('_ACA_ERR_SHOW_TIPS', compa::encodeutf('Choississez Oui pour afficher le nombre d\'erreurs à l\'écran.  Principalement utiliser dans le but de débugger. '));
define('_ACA_ERR_SHOW', compa::encodeutf('Afficher erreurs'));
define('_ACA_LIST_SHOW_UNSUBCRIBE', compa::encodeutf('Afficher les liens de désabonnement'));
define('_ACA_LIST_SHOW_UNSUBCRIBE_TIPS', compa::encodeutf('Sélectionner Oui pour afficher les liens de désabonnement en bas des courriels pour permettre aux utilisateurs de modifier leurs inscriptions. <br /> Non désactive le bas de page et les liens.'));
define('_ACA_UPDATE_INSTALL', compa::encodeutf('<span style="color: rgb(255, 0, 0);">IMPORTANT AVERTISSEMENT!</span> <br />Si vous mettez à jour votre précendente installation d\'Acajoom, vous avez besoin de mettre à jour votre structure de base de données en cliquant sur le bouton suivant (Vos données resteront en intégralité)'));
define('_ACA_UPDATE_INSTALL_BTN', compa::encodeutf('Mettre à jour les tables et la configuration'));
define('_ACA_MAILING_MAX_TIME', compa::encodeutf('Délai d\'attente maximum '));
define('_ACA_MAILING_MAX_TIME_TIPS', compa::encodeutf('Définissez le temps maximum pour que chaque lot de courriels soit envoyé par la file d\'attente . Recommander entre 30s et 2mins.'));

// virtuemart integration beta
define('_ACA_VM_INTEGRATION', compa::encodeutf('Integration à VirtueMart'));
define('_ACA_VM_COUPON_NOTIF', compa::encodeutf('Identifiant de notification du coupon'));
define('_ACA_VM_COUPON_NOTIF_TIPS', compa::encodeutf('Spécifiez le numéro d\'identifiant de la liste que vous voulez utiliser pour envoyer les coupons à vos clients.'));
define('_ACA_VM_NEW_PRODUCT', compa::encodeutf('Identifiant de notification de nouveaux produits'));
define('_ACA_VM_NEW_PRODUCT_TIPS', compa::encodeutf('Spécifiez le numéro d\'identifiant de la liste que vous voulez utiliser pour envoyer la notification de nouveaux produits.'));


// since 1.0.8
// create forms for subscriptions
define('_ACA_FORM_BUTTON', compa::encodeutf('Créer un formulaire'));
define('_ACA_FORM_COPY', compa::encodeutf('Code HTML'));
define('_ACA_FORM_COPY_TIPS', compa::encodeutf('Copiez le code HTML générer dans votre page HTML.'));
define('_ACA_FORM_LIST_TIPS', compa::encodeutf('Sélectionnez la liste que vous voulez inclure dans votre formulaire'));
// update messages
define('_ACA_UPDATE_MESS4', compa::encodeutf('Ceci ne peut pas être mis à jour automatiquement.'));
define('_ACA_WARNG_REMOTE_FILE', compa::encodeutf('Aucun moyen d\'obtenir le dossier à distance .'));
define('_ACA_ERROR_FETCH', compa::encodeutf('Erreur lors de la recherche du fichier.'));

define('_ACA_CHECK', compa::encodeutf('Vérifier'));
define('_ACA_MORE_INFO', compa::encodeutf('Plus d\'informations'));
define('_ACA_UPDATE_NEW', compa::encodeutf('Passer à la nouvelle version'));
define('_ACA_UPGRADE', compa::encodeutf('Passer à un produit avancé'));
define('_ACA_DOWNDATE', compa::encodeutf('Retour à la version précedente'));
define('_ACA_DOWNGRADE', compa::encodeutf('Retour au produit de base'));
define('_ACA_REQUIRE_JOOM', compa::encodeutf('Requiert Joomla'));
define('_ACA_TRY_IT', compa::encodeutf('Essayez le !'));
define('_ACA_NEWER', compa::encodeutf('Nouveau'));
define('_ACA_OLDER', compa::encodeutf('Ancien'));
define('_ACA_CURRENT', compa::encodeutf('Courant'));

// since 1.0.9
define('_ACA_CHECK_COMP', compa::encodeutf('Essayer un des autres composants'));
define('_ACA_MENU_VIDEO', compa::encodeutf('Tutoriels Vidéo'));
define('_ACA_AUTO_SCHEDULE', compa::encodeutf('Plannification'));
define('_ACA_SCHEDULE_TITLE', compa::encodeutf('Paramètres de la fonction de plannification automatique'));
define('_ACA_ISSUE_NB_TIPS', compa::encodeutf('Nombre de questions générées automatiquement par le système '));
define('_ACA_SEL_ALL', compa::encodeutf('Tous les envoies'));
define('_ACA_SEL_ALL_SUB', compa::encodeutf('Toutes les listes'));
define('_ACA_INTRO_ONLY_TIPS', compa::encodeutf('Si vous cochez cette case seul l\'introduction de votre article sera inséré dans vos envois avec un lien \'lire plus\' vers l\'article entier sur votre site web.'));
define('_ACA_TAGS_TITLE', compa::encodeutf('Tag Contenu'));
define('_ACA_TAGS_TITLE_TIPS', compa::encodeutf('Copiez et collez ce tag dans vos envois à l\'endroit où vous voulez placer le contenu.'));
define('_ACA_PREVIEW_EMAIL_TEST', compa::encodeutf('Indiquez l\'adresse courriel pour envoyer un courriel de test'));
define('_ACA_PREVIEW_TITLE', compa::encodeutf('Aperçu'));
define('_ACA_AUTO_UPDATE', compa::encodeutf('Notification de nouvelle mise à jour'));
define('_ACA_AUTO_UPDATE_TIPS', compa::encodeutf('Sélectionnez Oui si vous voulez être averti des nouvelles mises à jour pour votre composant. <br />IMPORTANT!! Afficher tips doit être activé pour que cela fonctionne.'));

// since 1.1.0
define('_ACA_LICENSE', compa::encodeutf('Information sur la license'));


// since 1.1.1
define('_ACA_NEW', compa::encodeutf('Nouveau'));
define('_ACA_SCHEDULE_SETUP', compa::encodeutf('Pour envoyer des réponses automatiques, vous avez besoin d\'installer le planificateur dans la configuration.'));
define('_ACA_SCHEDULER', compa::encodeutf('Programmateur'));
define('_ACA_ACAJOOM_CRON_DESC', compa::encodeutf('Si vous n\'avez pas accès au gestionnaire des tâches Cron de votre site internet, vous pouvez vous enregistrer à un compte libre d\'Acajoom Cron à :'));
define('_ACA_CRON_DOCUMENTATION', compa::encodeutf('Vous pouvez trouvez des informations supplémentaires sur l\'installation du planificateur d\'Acajoom à l\'adresse suivante :'));
define('_ACA_CRON_DOC_URL', compa::encodeutf('<a href="http://www.ijoobi.com/index.php?option=com_content&view=article&id=4249&catid=29&Itemid=72"
 target="_blank">http://www.ijoobi.com/index.php?option=com_content&Itemid=72&view=category&layout=blog&id=29&limit=60</a>'));
define( '_ACA_QUEUE_PROCESSED', compa::encodeutf('File d\'attente traitée avec succès...'));
define( '_ACA_ERROR_MOVING_UPLOAD', compa::encodeutf('Erreur lors du déplacement du fichier importé'));

//since 1.1.4
define( '_ACA_SCHEDULE_FREQUENCY', compa::encodeutf('Fréquence du planificateur'));
define( '_ACA_CRON_MAX_FREQ', compa::encodeutf('Fréquence maximum du planificateur'));
define( '_ACA_CRON_MAX_FREQ_TIPS', compa::encodeutf('Spécifier la fréquence maximum à laquelle le planificateur peut fonctionner ( en minutes ).  Cela va limiter le planificateur même si la tâche cron est plus fréquente.'));
define( '_ACA_CRON_MAX_EMAIL', compa::encodeutf('Courriels maximum par tâche'));
define( '_ACA_CRON_MAX_EMAIL_TIPS', compa::encodeutf('Spécifier le nombre maximum de courriels envoyés par tâche (0 illimité).'));
define( '_ACA_CRON_MINUTES', compa::encodeutf(' minutes'));
define( '_ACA_SHOW_SIGNATURE', compa::encodeutf('Montrer le pied de page du courriel'));
define( '_ACA_SHOW_SIGNATURE_TIPS', compa::encodeutf('Si vous voulez ou non promouvoir Acajoom dans le pied de page de vos courriels.'));
define( '_ACA_QUEUE_AUTO_PROCESSED', compa::encodeutf('Réponses automatiques traitées avec succès...'));
define( '_ACA_QUEUE_NEWS_PROCESSED', compa::encodeutf('Infolettres programmées traitées avec succès...'));
define( '_ACA_MENU_SYNC_USERS', compa::encodeutf('Synchronisation des utilisateurs'));
define( '_ACA_SYNC_USERS_SUCCESS', compa::encodeutf('Synchronisation des utilisateurs réussie!'));

// compatibility with Joomla 15
if (!defined('_BUTTON_LOGOUT')) define( '_BUTTON_LOGOUT', compa::encodeutf('Déconnexion'));
if (!defined('_CMN_YES')) define( '_CMN_YES', compa::encodeutf('Oui'));
if (!defined('_CMN_NO')) define( '_CMN_NO', compa::encodeutf('Non'));
if (!defined('_HI')) define( '_HI', compa::encodeutf('Salut'));
if (!defined('_CMN_TOP')) define( '_CMN_TOP', compa::encodeutf('Haut'));
if (!defined('_CMN_BOTTOM')) define( '_CMN_BOTTOM', compa::encodeutf('Bas'));
//if (!defined('_BUTTON_LOGOUT')) define( '_BUTTON_LOGOUT', compa::encodeutf('Déconnexion'));

// For include title only or full article in content item tab in infolettre edit - p0stman911
define('_ACA_TITLE_ONLY_TIPS', compa::encodeutf('Si vous sélectionnez ceci seul le titre de l\'article sera inséré dans l\'envoi comme lien vers l\'article entier sur votre site.'));
define('_ACA_TITLE_ONLY', compa::encodeutf('Titre seul'));
define('_ACA_FULL_ARTICLE_TIPS', compa::encodeutf('Si vous sélectionnez ceci l\'article entier sera inséré dans votre envoi'));
define('_ACA_FULL_ARTICLE', compa::encodeutf('Article entier'));
define('_ACA_CONTENT_ITEM_SELECT_T', compa::encodeutf('Sélectionnez un article à insérer dans votre message. <br />Copier et coller le <b>tag de contenu</b> dans votre Infolettre.  Vous pouvez choisir d\'avoir le text entier, une introduction seulement, ou le titre seulement avec (0, 1, ou 2 respectivement). '));
define('_ACA_SUBSCRIBE_LIST2', compa::encodeutf('Liste(s) d\'envois'));

// smart-infolettre function
define('_ACA_AUTONEWS', compa::encodeutf('Smart-Infolettre'));
define('_ACA_MENU_AUTONEWS', compa::encodeutf('Smart-Infolettres'));
define('_ACA_AUTO_NEWS_OPTION', compa::encodeutf('Options Smart-Infolettre'));
define('_ACA_AUTONEWS_FREQ', compa::encodeutf('Fréquence des Infolettres'));
define('_ACA_AUTONEWS_FREQ_TIPS', compa::encodeutf('Spécifiez la fréquence à laquelle vous voulez envoyer les smart-infolettre.'));
define('_ACA_AUTONEWS_SECTION', compa::encodeutf('Section Article'));
define('_ACA_AUTONEWS_SECTION_TIPS', compa::encodeutf('Spécifiez la section à partir de laquelle vous voulez choisir les articles.'));
define('_ACA_AUTONEWS_CAT', compa::encodeutf('Catégorie Article'));
define('_ACA_AUTONEWS_CAT_TIPS', compa::encodeutf('Spécifiez la catégorie à partir de laquelle vous voulez choisir les articles (Toutes pour tous les articles de la section).'));
define('_ACA_SELECT_SECTION', compa::encodeutf('Sélectionner une section'));
define('_ACA_SELECT_CAT', compa::encodeutf('Toutes les categories'));
define('_ACA_AUTO_DAY_CH8', compa::encodeutf('Trimestriel'));
define('_ACA_AUTONEWS_STARTDATE', compa::encodeutf('Date de début'));
define('_ACA_AUTONEWS_STARTDATE_TIPS', compa::encodeutf('Spécifiez la date à laquelle vous souhaitez débuter les envois de Smart Infolettre.'));
define('_ACA_AUTONEWS_TYPE', compa::encodeutf('Rendu du contenu'));// how we see the content which is included in the infolettre
define('_ACA_AUTONEWS_TYPE_TIPS', compa::encodeutf('Article Entier: inclura l\'article entier dans la infolettre.<br />' .
		'Intro seulement: inclura seulement l\'introduction de l\'article dans la infolettre.<br/>' .
		'Titre seulement: inclura seulement le titre de l\'article dans la infolettre.'));
define('_ACA_TAGS_AUTONEWS', compa::encodeutf('[SMARTNEWSLETTER] = Ceci sera remplacé par la Smart-infolettre.'));

//since 1.1.3
define('_ACA_MALING_EDIT_VIEW', compa::encodeutf('Créer / Voir les Envois'));
define('_ACA_LICENSE_CONFIG', compa::encodeutf('License'));
define('_ACA_ENTER_LICENSE', compa::encodeutf('Enter license'));
define('_ACA_ENTER_LICENSE_TIPS', compa::encodeutf('Enter your license number and save it.'));
define('_ACA_LICENSE_SETTING', compa::encodeutf('License settings'));
define('_ACA_GOOD_LIC', compa::encodeutf('Your license is valid.'));
define('_ACA_NOTSO_GOOD_LIC', compa::encodeutf('Your license is not valid: '));
define('_ACA_PLEASE_LIC', compa::encodeutf('Please contact Acajoom support to upgrade your license ( license@ijoobi.com ).'));

define('_ACA_DESC_PLUS', compa::encodeutf('Acajoom Plus is the first sequencial auto-responders for Joomla CMS.  ' . _ACA_FEATURES));
define('_ACA_DESC_PRO', compa::encodeutf('Acajoom PRO the ultimate envoie system for Joomla CMS.  ' . _ACA_FEATURES));

//since 1.1.4
define('_ACA_ENTER_TOKEN', compa::encodeutf('Enter token'));
define('_ACA_ENTER_TOKEN_TIPS', compa::encodeutf('Please enter your token number you received by courriel when you purchased Acajoom. '));
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
define( '_ACA_NOTIF_UPDATE', compa::encodeutf('To be notified of new updates enter your courriel address and click subscribe '));

define('_ACA_THINK_PLUS', compa::encodeutf('If you want more out of your envoie system think Plus!'));
define('_ACA_THINK_PLUS_1', compa::encodeutf('Sequential auto-responders'));
define('_ACA_THINK_PLUS_2', compa::encodeutf('Schedule the delivery of your infolettre for a predefined date'));
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
 define('_FREQ_OPT_0', compa::encodeutf('Aucune'));
 define('_FREQ_OPT_1', compa::encodeutf('Hebdomadaire'));
 define('_FREQ_OPT_2', compa::encodeutf('Toutes les 2 semaines'));
 define('_FREQ_OPT_3', compa::encodeutf('Mensuel'));
 define('_FREQ_OPT_4', compa::encodeutf('Saisonnier'));
 define('_FREQ_OPT_5', compa::encodeutf('Annuel'));
 define('_FREQ_OPT_6', compa::encodeutf('autres'));

define('_DATE_OPT_1', compa::encodeutf('Date de création'));
define('_DATE_OPT_2', compa::encodeutf('Date de modification'));

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

define( '_ACA_LIST_ACCESS_EDIT', compa::encodeutf('Ajouter/Editer un Courrieling'));
define( '_ACA_INFO_LIST_ACCESS_EDIT', compa::encodeutf('Specify what group of users can add or edit a new envoie for this list'));
define( '_ACA_MAILING_NEW_FRONT', compa::encodeutf('Créer un nouveau Courrieling'));

define('_ACA_AUTO_ARCHIVE', compa::encodeutf('Auto-Archive'));
define('_ACA_MENU_ARCHIVE', compa::encodeutf('Auto-Archive'));

//Extra tags:
define('_ACA_TAGS_ISSUE_NB', compa::encodeutf('[ISSUENB] = This will be replaced by the issue number of  the infolettre.'));
define('_ACA_TAGS_DATE', compa::encodeutf('[DATE] = This will be replaced by the sent date.'));
define('_ACA_TAGS_CB', compa::encodeutf('[CBTAG:{field_name}] = This will be replaced by the value taken from the Community Builder field: eg. [CBTAG:firstname] '));
define( '_ACA_MAINTENANCE', compa::encodeutf('Joobi Care'));


define('_ACA_THINK_PRO', compa::encodeutf('When you have professional needs, you use professional components!'));
define('_ACA_THINK_PRO_1', compa::encodeutf('Smart-Infolettres'));
define('_ACA_THINK_PRO_2', compa::encodeutf('Define access level for your list'));
define('_ACA_THINK_PRO_3', compa::encodeutf('Define who can edit/add envoies'));
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
define( '_ACA_MAIL_FORMAT_TIPS', compa::encodeutf('What format do you want to use for encoding your envoies, Text only or MIME'));
define( '_ACA_ACAJOOM_CRON_DESC_ALT', compa::encodeutf('If you do not have access to a cron task manager on your website, you can use the Free jCron component to create a cron task from your website.'));


//since 1.3.1
define('_ACA_SHOW_AUTHOR', compa::encodeutf('Afficher l\'auteur de l\'article'));
define('_ACA_SHOW_AUTHOR_TIPS', compa::encodeutf('Cliquez sur Oui si vous voulez ajouter le nom de l\'auteur des articles insérés dans les Envois'));

//since 1.3.5
define('_ACA_REGWARN_NAME', compa::encodeutf('Saisissez votre nom.'));
define('_ACA_REGWARN_MAIL', compa::encodeutf('Saisissez une adresse courriel valide.'));

//since 1.5.6
define('_ACA_ADDEMAILREDLINK_TIPS', compa::encodeutf('If you select Yes, the courriel of the user will be added as a parameter at the end of your redirect URL (the redirect link for your module or for an external Acajoom form).<br/>That can be usefull if you want to execute a special script in your redirect page.'));
define('_ACA_ADDEMAILREDLINK', compa::encodeutf('Add courriel to the redirect link'));

//since 1.6.3
define('_ACA_ITEMID', compa::encodeutf('ItemId'));
define('_ACA_ITEMID_TIPS', compa::encodeutf('Cet Itemid va être ajouté aux liens d\'Acajoom'));

//since 1.6.5
define('_ACA_SHOW_JCALPRO', compa::encodeutf('jCalPRO'));
define('_ACA_SHOW_JCALPRO_TIPS', compa::encodeutf('Afficher le tab pour ajouter des évènements du composant jCalPro <br/>(uniquement si jcalPro est installé sur votre site!)'));
define('_ACA_JCALTAGS_TITLE', compa::encodeutf('jCalPRO Tag:'));
define('_ACA_JCALTAGS_TITLE_TIPS', compa::encodeutf('Copier/coller ce tag dans votre Infolettre et il sera remplacé par l\'évènement sélectionné'));
define('_ACA_JCALTAGS_DESC', compa::encodeutf('Description :'));
define('_ACA_JCALTAGS_DESC_TIPS', compa::encodeutf('Sélectionnez OUI si vous voulez que la description de l\'évènement soit ajoutée'));
define('_ACA_JCALTAGS_START', compa::encodeutf('Date de début:'));
define('_ACA_JCALTAGS_START_TIPS', compa::encodeutf('Sélectionnez OUI si vous voulez que la date de début de l\'évènement soit ajoutée'));
define('_ACA_JCALTAGS_READMORE', compa::encodeutf('Lire la suite:'));
define('_ACA_JCALTAGS_READMORE_TIPS', compa::encodeutf('Sélectionnez OUI si vous voulez qu\'un lien pour lire la suite de de l\'évènement soit ajouté'));
define('_ACA_REDIRECTCONFIRMATION', compa::encodeutf('Redirect URL'));
define('_ACA_REDIRECTCONFIRMATION_TIPS', compa::encodeutf('If you require a confirmation courriel, the user will be confirmed and redirected to this URL if he clicks on the confirmation link.'));

//since 2.0.0 compatibility with Joomla 1.5
if(!defined('_CMN_SAVE') and defined('CMN_SAVE')) define('_CMN_SAVE',CMN_SAVE);
if(!defined('_CMN_SAVE')) define('_CMN_SAVE','Enregistrer');
if(!defined('_NO_ACCOUNT')) define('_NO_ACCOUNT','Pas encore de compte&nbsp;?');
if(!defined('_CREATE_ACCOUNT')) define('_CREATE_ACCOUNT','Enregistrez-vous');
if(!defined('_NOT_AUTH')) define('_NOT_AUTH','Vous n\'êtes pas autorisé à voir cette ressource.');

//since 3.0.0
define('_ACA_DISABLETOOLTIP', compa::encodeutf('Disable Tooltip'));
define('_ACA_DISABLETOOLTIP_TIPS', compa::encodeutf('Disable the tooltip on the frontend'));
define('_ACA_MINISENDMAIL', compa::encodeutf('Use Mini SendCourriel'));
define('_ACA_MINISENDMAIL_TIPS', compa::encodeutf('If your server uses Mini SendCourriel, select this option to don\'t add the name of the user in the header of the courriel'));

//Since 3.1.5
define('_ACA_READMORE','Lire la suite...');
define('_ACA_VIEWARCHIVE','Cliquez ici');