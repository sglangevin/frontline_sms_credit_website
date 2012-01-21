<?php
defined('_JEXEC') OR defined('_VALID_MOS') OR die('...Direct Access to this location is not allowed...');


/**
 * <p>Potuguese language.</p>
 * @copyright (c) 2006 Acajoom Services / All Rights Reserved
 * @author  Ricardo Simões <support@ijoobi.com>
 * @version $Id: portuguese.php 491 2007-02-01 22:56:07Z divivo $
* @link http://www.ijoobi.com
 */

### General ###
 //acajoom Description
define('_ACA_DESC_NEWS', compa::encodeutf('Acajoom é uma ferramenta de listas de mailing, newsletters, auto-respostas, e seguimento, para comunicação eficaz com os seus utilizadores e clientes. ' .
		'Acajoom, O Seu Parceiro De Comunicação!'));
define('_ACA_FEATURES', compa::encodeutf('Acajoom, o seu parceiro de comunicação!'));

// Type of lists
define('_ACA_NEWSLETTER', compa::encodeutf('Newsletter'));
define('_ACA_AUTORESP', compa::encodeutf('Auto-resposta'));
define('_ACA_AUTORSS', compa::encodeutf('Auto-RSS'));
define('_ACA_ECARD', compa::encodeutf('Cartão Electrónico'));
define('_ACA_POSTCARD', compa::encodeutf('Cartão Postal'));
define('_ACA_PERF', compa::encodeutf('Performance'));
define('_ACA_COUPON', compa::encodeutf('Cupão'));
define('_ACA_CRON', compa::encodeutf('Tarefa Cron'));
define('_ACA_MAILING', compa::encodeutf('Mailing'));
define('_ACA_LIST', compa::encodeutf('Lista'));

 //acajoom Menu
define('_ACA_MENU_LIST', compa::encodeutf('Gestão de Listas'));
define('_ACA_MENU_SUBSCRIBERS', compa::encodeutf('Assinantes'));
define('_ACA_MENU_NEWSLETTERS', compa::encodeutf('Newsletters'));
define('_ACA_MENU_AUTOS', compa::encodeutf('Auto-Respostas'));
define('_ACA_MENU_COUPONS', compa::encodeutf('Cupões'));
define('_ACA_MENU_CRONS', compa::encodeutf('Tarefas Cron'));
define('_ACA_MENU_AUTORSS', compa::encodeutf('Auto-RSS'));
define('_ACA_MENU_ECARD', compa::encodeutf('Cartões Electrónicos'));
define('_ACA_MENU_POSTCARDS', compa::encodeutf('Cartões Postais'));
define('_ACA_MENU_PERFS', compa::encodeutf('Performances'));
define('_ACA_MENU_TAB_LIST', compa::encodeutf('Listas'));
define('_ACA_MENU_MAILING_TITLE', compa::encodeutf('Mailings'));
define('_ACA_MENU_MAILING', compa::encodeutf('Mailings para '));
define('_ACA_MENU_STATS', compa::encodeutf('Estatísticas'));
define('_ACA_MENU_STATS_FOR', compa::encodeutf('Estatísticas para '));
define('_ACA_MENU_CONF', compa::encodeutf('Configuração'));
define('_ACA_MENU_UPDATE', compa::encodeutf('Importar'));
define('_ACA_MENU_ABOUT', compa::encodeutf('Sobre'));
define('_ACA_MENU_LEARN', compa::encodeutf('Centro de Educação'));
define('_ACA_MENU_MEDIA', compa::encodeutf('Gestão de Media'));
define('_ACA_MENU_HELP', compa::encodeutf('Ajuda'));
define('_ACA_MENU_CPANEL', compa::encodeutf('Painel de Controlo'));
define('_ACA_MENU_IMPORT', compa::encodeutf('Importar'));
define('_ACA_MENU_EXPORT', compa::encodeutf('Exportar'));
define('_ACA_MENU_SUB_ALL', compa::encodeutf('Subcrever Tudo'));
define('_ACA_MENU_UNSUB_ALL', compa::encodeutf('Não-Subscrever Tudo'));
define('_ACA_MENU_VIEW_ARCHIVE', compa::encodeutf('Arquivo'));
define('_ACA_MENU_PREVIEW', compa::encodeutf('Pré-visualizar'));
define('_ACA_MENU_SEND', compa::encodeutf('Enviar'));
define('_ACA_MENU_SEND_TEST', compa::encodeutf('Enviar Email de Teste'));
define('_ACA_MENU_SEND_QUEUE', compa::encodeutf('Fila de Processamento'));
define('_ACA_MENU_VIEW', compa::encodeutf('Ver'));
define('_ACA_MENU_COPY', compa::encodeutf('Copiar'));
define('_ACA_MENU_VIEW_STATS', compa::encodeutf('Ver Estado'));
define('_ACA_MENU_CRTL_PANEL', compa::encodeutf(' Painel De Controlo'));
define('_ACA_MENU_LIST_NEW', compa::encodeutf(' Criar Lista'));
define('_ACA_MENU_LIST_EDIT', compa::encodeutf(' Editar Lista'));
define('_ACA_MENU_BACK', compa::encodeutf('Retroceder'));
define('_ACA_MENU_INSTALL', compa::encodeutf('Instalar'));
define('_ACA_MENU_TAB_SUM', compa::encodeutf('Sumário'));
define('_ACA_STATUS', compa::encodeutf('Estado'));

// messages
define('_ACA_ERROR', compa::encodeutf(' Ocorreu um erro! '));
define('_ACA_SUB_ACCESS', compa::encodeutf('Direitos de Acesso'));
define('_ACA_DESC_CREDITS', compa::encodeutf('Créditos'));
define('_ACA_DESC_INFO', compa::encodeutf('Informação'));
define('_ACA_DESC_HOME', compa::encodeutf('Página Oficial'));
define('_ACA_DESC_MAILING', compa::encodeutf('Lista de Mailing'));
define('_ACA_DESC_SUBSCRIBERS', compa::encodeutf('Assinantes'));
define('_ACA_PUBLISHED', compa::encodeutf('Publicado'));
define('_ACA_UNPUBLISHED', compa::encodeutf('Não-Publicado'));
define('_ACA_DELETE', compa::encodeutf('Apagar'));
define('_ACA_FILTER', compa::encodeutf('Filtrar'));
define('_ACA_UPDATE', compa::encodeutf('Actualizar'));
define('_ACA_SAVE', compa::encodeutf('Salvar'));
define('_ACA_CANCEL', compa::encodeutf('Cancelar'));
define('_ACA_NAME', compa::encodeutf('Nome'));
define('_ACA_EMAIL', compa::encodeutf('E-mail'));
define('_ACA_SELECT', compa::encodeutf('Selecionar'));
define('_ACA_ALL', compa::encodeutf('Todas as'));
define('_ACA_SEND_A', compa::encodeutf('Enviar a '));
define('_ACA_SUCCESS_DELETED', compa::encodeutf(' apagado com sucesso'));
define('_ACA_LIST_ADDED', compa::encodeutf('Lista criada com sucesso'));
define('_ACA_LIST_COPY', compa::encodeutf('Lista copiada com sucesso'));
define('_ACA_LIST_UPDATED', compa::encodeutf('Lista actualizada com sucesso'));
define('_ACA_MAILING_SAVED', compa::encodeutf('Mailing salvado com sucesso.'));
define('_ACA_UPDATED_SUCCESSFULLY', compa::encodeutf('actualizado com sucesso.'));

### Subscribers information ###
//subscribe and unsubscribe info
define('_ACA_SUB_INFO', compa::encodeutf('Informação do Assinante'));
define('_ACA_VERIFY_INFO', compa::encodeutf('Por favor verifique o link que submeteu, falta alguma informação.'));
define('_ACA_INPUT_NAME', compa::encodeutf('Nome'));
define('_ACA_INPUT_EMAIL', compa::encodeutf('Email'));
define('_ACA_RECEIVE_HTML', compa::encodeutf('Receber em HTML?'));
define('_ACA_TIME_ZONE', compa::encodeutf('Zona de Fuso Horário'));
define('_ACA_BLACK_LIST', compa::encodeutf('Lista Negra'));
define('_ACA_REGISTRATION_DATE', compa::encodeutf('Data de registo do utilizador'));
define('_ACA_USER_ID', compa::encodeutf('ID do Utilizador'));
define('_ACA_DESCRIPTION', compa::encodeutf('Descrição'));
define('_ACA_ACCOUNT_CONFIRMED', compa::encodeutf('A sua conta foi activada.'));
define('_ACA_SUB_SUBSCRIBER', compa::encodeutf('Assinante'));
define('_ACA_SUB_PUBLISHER', compa::encodeutf('Editor'));
define('_ACA_SUB_ADMIN', compa::encodeutf('Administrador'));
define('_ACA_REGISTERED', compa::encodeutf('Registado'));
define('_ACA_SUBSCRIPTIONS', compa::encodeutf('Subscrições'));
define('_ACA_SEND_UNSUBCRIBE', compa::encodeutf('Enviar mensagem de Cancelamento de subscrição'));
define('_ACA_SEND_UNSUBCRIBE_TIPS', compa::encodeutf('Clique SIM para enviar um email de confirmação para cancelamento de subscrição.'));
define('_ACA_SUBSCRIBE_SUBJECT_MESS', compa::encodeutf('Por favor confirme a sua subscrição'));
define('_ACA_UNSUBSCRIBE_SUBJECT_MESS', compa::encodeutf('Confirmação de Cancelamento de Subscrição'));
define('_ACA_DEFAULT_SUBSCRIBE_MESS', compa::encodeutf('Olá [NAME],<br />' .
		'Apenas mais um passo e subscreverá a lista.  Por favor clique no link seguinte para confirmar a sua subscrição.' .
		'<br /><br />[CONFIRM]<br /><br />Para questões é favor contactar o Webmaster.'));
define('_ACA_DEFAULT_UNSUBSCRIBE_MESS', compa::encodeutf('Este é um email de confirmação de que você foi removido da nossa lista.  Lamentamos que tenha decidido cancelar a sua subscrição, caso queira voltar a subscrever pode sempre fazê-lo no nosso site.  Caso tenha alguma questão por favor contacte o nosso Webmaster.'));

// Acajoom subscribers
define('_ACA_SIGNUP_DATE', compa::encodeutf('Data de Subscrição'));
define('_ACA_CONFIRMED', compa::encodeutf('Confirmado'));
define('_ACA_SUBSCRIB', compa::encodeutf('Subscrever'));
define('_ACA_HTML', compa::encodeutf('Mailings em HTML'));
define('_ACA_RESULTS', compa::encodeutf('Resultados'));
define('_ACA_SEL_LIST', compa::encodeutf('Selecione uma Lista'));
define('_ACA_SEL_LIST_TYPE', compa::encodeutf('- Selecione tipo de Lista -'));
define('_ACA_SUSCRIB_LIST', compa::encodeutf('Lista Total de Assinantes'));
define('_ACA_SUSCRIB_LIST_UNIQUE', compa::encodeutf('assinantes para : '));
define('_ACA_NO_SUSCRIBERS', compa::encodeutf('Nenhum assinante encontrado para estas listas.'));
define('_ACA_COMFIRM_SUBSCRIPTION', compa::encodeutf('Foi enviado um email de confirmação para si.  Por favor verifique o seu email e clique no link fornecido.<br />' .
		'O seu email necessita de ser confirmado para que a sua subscrição possa ter efeito.'));
define('_ACA_SUCCESS_ADD_LIST', compa::encodeutf('Você foi adicionado a lista com sucesso.'));


 // Subcription info
define('_ACA_CONFIRM_LINK', compa::encodeutf('Clique aqui para confirmar a sua subscrição'));
define('_ACA_UNSUBSCRIBE_LINK', compa::encodeutf('Clique aqui para remover-se da lista'));
define('_ACA_UNSUBSCRIBE_MESS', compa::encodeutf('O seu email foi removido da lista'));

define('_ACA_QUEUE_SENT_SUCCESS', compa::encodeutf('Todos os mailings agendados foram enviados com sucesso.'));
define('_ACA_MALING_VIEW', compa::encodeutf('Ver todos os mailings'));
define('_ACA_UNSUBSCRIBE_MESSAGE', compa::encodeutf('Tem a certeza que quer remover-se da lista?'));
define('_ACA_MOD_SUBSCRIBE', compa::encodeutf('Subscrever'));
define('_ACA_SUBSCRIBE', compa::encodeutf('Subscrever'));
define('_ACA_UNSUBSCRIBE', compa::encodeutf('Remover subscrição'));
define('_ACA_VIEW_ARCHIVE', compa::encodeutf('Ver arquivo'));
define('_ACA_SUBSCRIPTION_OR', compa::encodeutf(' ou clique aqui para actualizar a sua informação'));
define('_ACA_EMAIL_ALREADY_REGISTERED', compa::encodeutf('Este endereço de email já se encontra registado.'));
define('_ACA_SUBSCRIBER_DELETED', compa::encodeutf('Assinante apagado com sucesso.'));


### UserPanel ###
 //User Menu
define('_UCP_USER_PANEL', compa::encodeutf('Painel de Controlo do Utilizador'));
define('_UCP_USER_MENU', compa::encodeutf('Menu do Utilizador'));
define('_UCP_USER_CONTACT', compa::encodeutf('As minhas subscrições'));
 //Acajoom Cron Menu
define('_UCP_CRON_MENU', compa::encodeutf('Gestão de tarefa Cron'));
define('_UCP_CRON_NEW_MENU', compa::encodeutf('Novo Cron'));
define('_UCP_CRON_LIST_MENU', compa::encodeutf('Listar o meu Cron'));
 //Acajoom Coupon Menu
define('_UCP_COUPON_MENU', compa::encodeutf('Gestão de Cupões'));
define('_UCP_COUPON_LIST_MENU', compa::encodeutf('Lista de Cupões'));
define('_UCP_COUPON_ADD_MENU', compa::encodeutf('Adicionar um Cupão'));

### lists ###
// Tabs
define('_ACA_LIST_T_GENERAL', compa::encodeutf('Descrição'));
define('_ACA_LIST_T_LAYOUT', compa::encodeutf('Layout'));
define('_ACA_LIST_T_SUBSCRIPTION', compa::encodeutf('Subscrição'));
define('_ACA_LIST_T_SENDER', compa::encodeutf('Informação do Remetente'));

define('_ACA_LIST_TYPE', compa::encodeutf('Tipo de Lista'));
define('_ACA_LIST_NAME', compa::encodeutf('Nome da Lista'));
define('_ACA_LIST_ISSUE', compa::encodeutf('Edição N #'));
define('_ACA_LIST_DATE', compa::encodeutf('Data de Envio'));
define('_ACA_LIST_SUB', compa::encodeutf('Assunto do Mailing'));
define('_ACA_ATTACHED_FILES', compa::encodeutf('Ficheiros Anexados'));
define('_ACA_SELECT_LIST', compa::encodeutf('Por favor selecione uma lista para editar!'));

// Auto Responder box
define('_ACA_AUTORESP_ON', compa::encodeutf('Tipo de Lista'));
define('_ACA_AUTO_RESP_OPTION', compa::encodeutf('Opções de Auto-resposta'));
define('_ACA_AUTO_RESP_FREQ', compa::encodeutf('Assinantes podem escolher frequência'));
define('_ACA_AUTO_DELAY', compa::encodeutf('Atraso (em dias)'));
define('_ACA_AUTO_DAY_MIN', compa::encodeutf('Frequência Mínima'));
define('_ACA_AUTO_DAY_MAX', compa::encodeutf('Frequência Máxima'));
define('_ACA_FOLLOW_UP', compa::encodeutf('Especificar seguimento de auto-resposta'));
define('_ACA_AUTO_RESP_TIME', compa::encodeutf('Assinantes podem escolher hora'));
define('_ACA_LIST_SENDER', compa::encodeutf('Remetente da Lista'));

define('_ACA_LIST_DESC', compa::encodeutf('Descrição da Lista'));
define('_ACA_LAYOUT', compa::encodeutf('Layout'));
define('_ACA_SENDER_NAME', compa::encodeutf('Nome do Remetente'));
define('_ACA_SENDER_EMAIL', compa::encodeutf('Email do Remetente'));
define('_ACA_SENDER_BOUNCE', compa::encodeutf('Endereço de bounce do Remetente'));
define('_ACA_LIST_DELAY', compa::encodeutf('Atraso'));
define('_ACA_HTML_MAILING', compa::encodeutf('Mailing em HTML?'));
define('_ACA_HTML_MAILING_DESC', compa::encodeutf('(se modificar isto, você terá de salvar e retornar a este ecran para visualizar as mudanças.)'));
define('_ACA_HIDE_FROM_FRONTEND', compa::encodeutf('Esconder do Sítio-Principal?'));
define('_ACA_SELECT_IMPORT_FILE', compa::encodeutf('Selecione um ficheiro para importação'));;
define('_ACA_IMPORT_FINISHED', compa::encodeutf('Importação terminada'));
define('_ACA_DELETION_OFFILE', compa::encodeutf('Eliminação do ficheiro'));
define('_ACA_MANUALLY_DELETE', compa::encodeutf('falhou, deverá apagar o ficheiro manualmente'));
define('_ACA_CANNOT_WRITE_DIR', compa::encodeutf('Não é possível escrever na directoria'));
define('_ACA_NOT_PUBLISHED', compa::encodeutf('Não foi possível enviar o mailing, a Lista não está publicada.'));

//  List info box
define('_ACA_INFO_LIST_PUB', compa::encodeutf('Clique em SIM para publicar a Lista'));
define('_ACA_INFO_LIST_NAME', compa::encodeutf('Introduza o nome da sua Lista aqui. Poderá identificar a Lista com este nome.'));
define('_ACA_INFO_LIST_DESC', compa::encodeutf('Introduza uma breve descrição da sua Lista aqui. Esta descrição será visível aos visitantes no seu site.'));
define('_ACA_INFO_LIST_SENDER_NAME', compa::encodeutf('Introduza o nome do Remetente do mailing. Este nome será visível quando os assinantes receberem mensagens desta lista.'));
define('_ACA_INFO_LIST_SENDER_EMAIL', compa::encodeutf('Introduza o endereço de email de onde as mensagens serão enviadas.'));
define('_ACA_INFO_LIST_SENDER_BOUNCED', compa::encodeutf('Introduza o endereço de email para onde os utilizadores poderão responder. É altamente recomendado que seja igual ao do remetente, visto que existem filtros de SPAM que poderão atribuir uma probabilidade de SPAM elevada se forem diferentes.'));
define('_ACA_INFO_LIST_AUTORESP', compa::encodeutf('Escolha o tipo de mailings para esta Lista. <br />' .
		'Newsletter: newsletter normal<br />' .
		'Auto-resposta: uma Auto-resposta é uma Lista que é enviada automaticamente através da página web em intervalos regulares.'));
define('_ACA_INFO_LIST_FREQUENCY', compa::encodeutf('Permitir aos utilizadores escolher quantas vezes recebem a Lista.  Atribui mais flexibilidade ao utilizador.'));
define('_ACA_INFO_LIST_TIME', compa::encodeutf('Deixar que o utilizador escolha a hora preferida do dia para receber a Lista.'));
define('_ACA_INFO_LIST_MIN_DAY', compa::encodeutf('Definir qual é a frequência mínima que o utilizador pode escolher para receber a lista'));
define('_ACA_INFO_LIST_DELAY', compa::encodeutf('Especificar qual o atraso entre esta auto-resposta e a anterior.'));
define('_ACA_INFO_LIST_DATE', compa::encodeutf('Especificar a data para publicação da lista de notícias, caso queira atrasar a publicação. <br /> FORMATO : AAAA-MM-DD HH:MM:SS'));
define('_ACA_INFO_LIST_MAX_DAY', compa::encodeutf('Definir qual é a frequência máxima que o utilizador pode escolher para receber a lista'));
define('_ACA_INFO_LIST_LAYOUT', compa::encodeutf('Introduza o layout da sua lista de mailing aqui. Pode introduzir qualquer layou para o seu mailing aqui.'));
define('_ACA_INFO_LIST_SUB_MESS', compa::encodeutf('Esta mensagem será enviada ao assinante quando ele ou ela se registam pela primeira vez. Pode definir aqui qualquer texto que goste.'));
define('_ACA_INFO_LIST_UNSUB_MESS', compa::encodeutf('Esta mensagem será enviada ao assinante quando ele ou ela cancelarem a subscrição. Pode inserir aqui qualquer mensagem.'));
define('_ACA_INFO_LIST_HTML', compa::encodeutf('Selecione a checkbox se desejar enviar mailing em HTML. Os assinantes poderão especificar se preferem receber mensagens em HTML, ou mensagens de apenas texto aquando da subscrição de uma lista HTML.'));
define('_ACA_INFO_LIST_HIDDEN', compa::encodeutf('Clique SIM para esconder a lista do sítio-principal, os utilizadores não poderão subscrever mas você poderá mesmo assim enviar mailings.'));
define('_ACA_INFO_LIST_ACA_AUTO_SUB', compa::encodeutf('Deseja subscrição automática dos utilizadores para esta lista?<br /><B>Novos Utilizadores:</B> registará cada novo utilizador que se registe no site.<br /><B>Todos os Utilizadores:</B> registará cada utilizador registado na base de dados.<br />(todas aquelas opções suportam Community Builder)'));
define('_ACA_INFO_LIST_ACC_LEVEL', compa::encodeutf('Selecione o nível de acesso do sítio-principal. Isto mostrará ou esconderá o mailing para os grupos de utilizadores que não têm acesso a ele, para que não sejam capazes do o subscrever.'));
define('_ACA_INFO_LIST_ACC_USER_ID', compa::encodeutf('Selecione o nível de acesso do grupo de utilizadores a quem permite edição. Esse grupo de utilizadores e superiores serão capazes de editar o mailing e enviá-lo, quer do sítio-principal quer do sítio de administração.'));
define('_ACA_INFO_LIST_FOLLOW_UP', compa::encodeutf('Se quiser que a auto-resposta mova-se para outra assim que atingir a última mensagem, pode especificar aqui a auto-resposta seguinte.'));
define('_ACA_INFO_LIST_ACA_OWNER', compa::encodeutf('Esta é a ID da pessoa que criou a lista.'));
define('_ACA_INFO_LIST_WARNING', compa::encodeutf('   Esta última opção apenas está disponível uma vez aquando da criação da lista.'));
define('_ACA_INFO_LIST_SUBJET', compa::encodeutf(' Assunto do mailing.  Este é o assunto do email que o assinante receberá.'));
define('_ACA_INFO_MAILING_CONTENT', compa::encodeutf('Este é o corpo do email que você quer enviar.'));
define('_ACA_INFO_MAILING_NOHTML', compa::encodeutf('Introduza o corpo do email que você quer enviar para os assinantes que escolheram receber apenas mailings NÃO-HTML. <BR/> NOTA: se deixar em branco o Acajoom converterá automaticamente o texto HTML para apenas texto.'));
define('_ACA_INFO_MAILING_VISIBLE', compa::encodeutf('Clique SIM para mostrar mailing no sítio-principal.'));
define('_ACA_INSERT_CONTENT', compa::encodeutf('Insira o conteúdo existente'));

// Coupons
define('_ACA_SEND_COUPON_SUCCESS', compa::encodeutf('Cupão enviado com sucesso!'));
define('_ACA_CHOOSE_COUPON', compa::encodeutf('Escolha um cupão'));
define('_ACA_TO_USER', compa::encodeutf(' para este utilizador'));

### Cron options
//drop down frequency(CRON)
define('_ACA_FREQ_CH1', compa::encodeutf('Cada hora'));
define('_ACA_FREQ_CH2', compa::encodeutf('Cada 6 horas'));
define('_ACA_FREQ_CH3', compa::encodeutf('Cada 12 horas'));
define('_ACA_FREQ_CH4', compa::encodeutf('Diariamente'));
define('_ACA_FREQ_CH5', compa::encodeutf('Semanalmente'));
define('_ACA_FREQ_CH6', compa::encodeutf('Mensalmente'));
define('_ACA_FREQ_NONE', compa::encodeutf('Não'));
define('_ACA_FREQ_NEW', compa::encodeutf('Novos utilizadores'));
define('_ACA_FREQ_ALL', compa::encodeutf('Todos os utilizadores'));

//Label CRON form
define('_ACA_LABEL_FREQ', compa::encodeutf('Cron Acajoom?'));
define('_ACA_LABEL_FREQ_TIPS', compa::encodeutf('Clique em SIM se quiser utilizar isto para uma Cron Acajoom, NÃO para qualquer outra tarefa Cron.<br />' .
		'Se clicar em SIM não necessita de especificar o endereço do Cron, este será automaticamente adicionado.'));
define('_ACA_SITE_URL', compa::encodeutf('O endereço URL do seu site'));
define('_ACA_CRON_FREQUENCY', compa::encodeutf('Frequência do Cron'));
define('_ACA_STARTDATE_FREQ', compa::encodeutf('Data de Começo'));
define('_ACA_LABELDATE_FREQ', compa::encodeutf('Especifique Data'));
define('_ACA_LABELTIME_FREQ', compa::encodeutf('Especifique Hora'));
define('_ACA_CRON_URL', compa::encodeutf('URL do Cron'));
define('_ACA_CRON_FREQ', compa::encodeutf('Frequência'));
define('_ACA_TITLE_CRONLIST', compa::encodeutf('Lista Cron'));
define('_NEW_LIST', compa::encodeutf('Criar uma nova lista'));

//title CRON form
define('_ACA_TITLE_FREQ', compa::encodeutf('Editar Cron'));
define('_ACA_CRON_SITE_URL', compa::encodeutf('Por favor introduza um endereço URL válido, começado por http://'));

### Mailings ###
define('_ACA_MAILING_ALL', compa::encodeutf('Todos os mailings'));
define('_ACA_EDIT_A', compa::encodeutf('Editar uma '));
define('_ACA_SELCT_MAILING', compa::encodeutf('Por favor selecione a Lista na caixa de possibilidades com vista a adicionar um novo mailing.'));
define('_ACA_VISIBLE_FRONT', compa::encodeutf('Visível no sítio-principal'));

// mailer
define('_ACA_SUBJECT', compa::encodeutf('Assunto'));
define('_ACA_CONTENT', compa::encodeutf('Conteúdo'));
define('_ACA_NAMEREP', compa::encodeutf('[NAME] = Isto será substituído pelo nome que o assinante introduziu, você estará a enviar emails personalizados ao usar isto.<br />'));
define('_ACA_FIRST_NAME_REP', compa::encodeutf('[FIRSTNAME] = Isto será substituído pelo PRIMEIRO nome que o assinante introduziu.<br />'));
define('_ACA_NONHTML', compa::encodeutf('Versão Não-html'));
define('_ACA_ATTACHMENTS', compa::encodeutf('Anexos'));
define('_ACA_SELECT_MULTIPLE', compa::encodeutf('Carregue na tecla CONTROL (ou COMANDO) para selecionar múltiplos anexos.<br />' .
		'Os ficheiros apresentados nesta lista de anexos estão localizados na directoria de anexos, pode alterar esta localização no painel de controlo em Configuração.'));
define('_ACA_CONTENT_ITEM', compa::encodeutf('Item do Conteúdo'));
define('_ACA_SENDING_EMAIL', compa::encodeutf('A enviar email'));
define('_ACA_MESSAGE_NOT', compa::encodeutf('A Mensagem não pode ser enviada'));
define('_ACA_MAILER_ERROR', compa::encodeutf('Erro no Mailer'));
define('_ACA_MESSAGE_SENT_SUCCESSFULLY', compa::encodeutf('Mensagem enviada com sucesso'));
define('_ACA_SENDING_TOOK', compa::encodeutf('O envio deste mailing foi de'));
define('_ACA_SECONDS', compa::encodeutf('segundos'));
define('_ACA_NO_ADDRESS_ENTERED', compa::encodeutf('Nenhum assinante ou endereço de email fornecido'));
define('_ACA_CHANGE_SUBSCRIPTIONS', compa::encodeutf('Modificar'));
define('_ACA_CHANGE_EMAIL_SUBSCRIPTION', compa::encodeutf('Modificar a sua subscrição'));
define('_ACA_WHICH_EMAIL_TEST', compa::encodeutf('Indique o endereço de email para enviar um teste ou selecione pré-visualizar'));
define('_ACA_SEND_IN_HTML', compa::encodeutf('Enviar em HTML (para mailings html)?'));
define('_ACA_VISIBLE', compa::encodeutf('Visível'));
define('_ACA_INTRO_ONLY', compa::encodeutf('Apenas Introdução'));

// stats
define('_ACA_GLOBALSTATS', compa::encodeutf('Estatísticas Globais'));
define('_ACA_DETAILED_STATS', compa::encodeutf('Estatísticas Detalhadas'));
define('_ACA_MAILING_LIST_DETAILS', compa::encodeutf('Detalhes de Listas'));
define('_ACA_SEND_IN_HTML_FORMAT', compa::encodeutf('Envio em formato HTML'));
define('_ACA_VIEWS_FROM_HTML', compa::encodeutf('Vistos (de emails em html)'));
define('_ACA_SEND_IN_TEXT_FORMAT', compa::encodeutf('Envio em formtato Texto'));
define('_ACA_HTML_READ', compa::encodeutf('Lidos HTML'));
define('_ACA_HTML_UNREAD', compa::encodeutf('Não-Lidos HTML'));
define('_ACA_TEXT_ONLY_SENT', compa::encodeutf('Apenas Texto'));

// Configuration panel
// main tabs
define('_ACA_MAIL_CONFIG', compa::encodeutf('Mail'));
define('_ACA_LOGGING_CONFIG', compa::encodeutf('Hist. & Estat.'));
define('_ACA_SUBSCRIBER_CONFIG', compa::encodeutf('Assinantes'));
define('_ACA_AUTO_CONFIG', compa::encodeutf('Cron'));
define('_ACA_MISC_CONFIG', compa::encodeutf('Miscelânea'));
define('_ACA_MAIL_SETTINGS', compa::encodeutf('Definições de Mail'));
define('_ACA_MAILINGS_SETTINGS', compa::encodeutf('Definições de Mailings'));
define('_ACA_SUBCRIBERS_SETTINGS', compa::encodeutf('Definições de Assinantes'));
define('_ACA_CRON_SETTINGS', compa::encodeutf('Definições de Cron'));
define('_ACA_SENDING_SETTINGS', compa::encodeutf('Definições de Envio'));
define('_ACA_STATS_SETTINGS', compa::encodeutf('Definições de Estatísticas'));
define('_ACA_LOGS_SETTINGS', compa::encodeutf('Definições de Históricos'));
define('_ACA_MISC_SETTINGS', compa::encodeutf('Definições de Miscelânea'));
// mail settings
define('_ACA_SEND_MAIL_FROM', compa::encodeutf('Email do remetente'));
define('_ACA_SEND_MAIL_NAME', compa::encodeutf('Nome do remetente'));
define('_ACA_MAILSENDMETHOD', compa::encodeutf('Método do Mailer'));
define('_ACA_SENDMAILPATH', compa::encodeutf('Caminho do Sendmail'));
define('_ACA_SMTPHOST', compa::encodeutf('SMTP host'));
define('_ACA_SMTPAUTHREQUIRED', compa::encodeutf('Requer Autenticação SMTP'));
define('_ACA_SMTPAUTHREQUIRED_TIPS', compa::encodeutf('Selecione SIM se o seu servidor SMTP require autenticação'));
define('_ACA_SMTPUSERNAME', compa::encodeutf('nome da conta SMTP'));
define('_ACA_SMTPUSERNAME_TIPS', compa::encodeutf('Introduza o nome da conta para o SMTP quando o seu servidor SMTP requerer autenticação'));
define('_ACA_SMTPPASSWORD', compa::encodeutf('palavra-passe SMTP'));
define('_ACA_SMTPPASSWORD_TIPS', compa::encodeutf('Introduza a palavra-passe para o SMTP quando o seu servidor SMTP requerer autenticação'));
define('_ACA_USE_EMBEDDED', compa::encodeutf('Usar imagens embebidas'));
define('_ACA_USE_EMBEDDED_TIPS', compa::encodeutf('Selecione SIM se as imagens dos items de conteúdo anexo deverão ser embebidas no email para mensagens em html, ou NÃO para usar as tags de imagem por defeito que fazem link para as imagens no site.'));
define('_ACA_UPLOAD_PATH', compa::encodeutf('Caminho de Envio/Anexos'));
define('_ACA_UPLOAD_PATH_TIPS', compa::encodeutf('Pode especificar uma directoria para envio.<br />' .
		'Certifique-se que a directoria que especificar existe, caso contrário crie-a.'));

// subscribers settings
define('_ACA_ALLOW_UNREG', compa::encodeutf('Permitir não-registados'));
define('_ACA_ALLOW_UNREG_TIPS', compa::encodeutf('Selecione SIM se quiser permitir utilizadores susbcreverem listas sem estarem registados no site.'));
define('_ACA_REQ_CONFIRM', compa::encodeutf('Requerer Confirmação'));
define('_ACA_REQ_CONFIRM_TIPS', compa::encodeutf('Selecione SIM se quiser obrigar os utilizadores assinantes não-registados a confirmar o seu endereço de email.'));
define('_ACA_SUB_SETTINGS', compa::encodeutf('Definições de Subscrição'));
define('_ACA_SUBMESSAGE', compa::encodeutf('Email de Subscrição'));
define('_ACA_SUBSCRIBE_LIST', compa::encodeutf('Subscrever uma lista'));

define('_ACA_USABLE_TAGS', compa::encodeutf('Tags utilizáveis'));
define('_ACA_NAME_AND_CONFIRM', compa::encodeutf('<b>[CONFIRM]</b> = Isto cria um link clicável onde o assinante pode confirmar a sua subscrição. Isto é <strong>obrigatório</strong> para que o Acajoom funcione correctamente.<br />'
.'<br />[NAME] = Isto será substituído pelo nome que o assinante introduziu, estará a enviar emails personalizados ao usar isto.<br />'
.'<br />[FIRSTNAME] = Isto será substituído pelo PRIMEIRO nome do assinante, o primeiro nome é DEFINIDO pelo primeiro nome introduzido pelo assinante.<br />'));
define('_ACA_CONFIRMFROMNAME', compa::encodeutf('Confirmar o nome do Remetente'));
define('_ACA_CONFIRMFROMNAME_TIPS', compa::encodeutf('Introduza o nome do remetente a mostrar na confirmação das listas.'));
define('_ACA_CONFIRMFROMEMAIL', compa::encodeutf('Confirmar o email do remetente'));
define('_ACA_CONFIRMFROMEMAIL_TIPS', compa::encodeutf('Introduza o endereço de email do remetente a mostrar na confirmação das listas.'));
define('_ACA_CONFIRMBOUNCE', compa::encodeutf('Endereço de Bounce'));
define('_ACA_CONFIRMBOUNCE_TIPS', compa::encodeutf('Introduza o endereço de bounce do remetente a mostrar na confirmação das listas.'));
define('_ACA_HTML_CONFIRM', compa::encodeutf('Confirmar HTML'));
define('_ACA_HTML_CONFIRM_TIPS', compa::encodeutf('Selecione SIM se as listas de confirmação devem ser em HTML se o utilizador permitir HTML.'));
define('_ACA_TIME_ZONE_ASK', compa::encodeutf('Perguntar Zona de Fuso Horário'));
define('_ACA_TIME_ZONE_TIPS', compa::encodeutf('Selecione SIM se quiser perguntar ao utilizador qual a sua zona de fuso horário. Quando aplicável, os mailings em espera serão enviados baseados na zona de fuso horário'));

 // Cron Set up
define('_ACA_TIME_OFFSET_URL', compa::encodeutf('clique aqui para definir a zona de fuso horário no painel de configuração global do Joomla -> Separador Locale'));
define('_ACA_TIME_OFFSET_TIPS', compa::encodeutf('Defina a zona de fuso horário do seu servidor para que a data e hora guardadas sejam exactas'));
define('_ACA_TIME_OFFSET', compa::encodeutf('Fuso Horário'));
define('_ACA_CRON_TITLE', compa::encodeutf('Definir uma função Con'));
define('_ACA_CRON_DESC', compa::encodeutf('<br />Usar a função Cron automatiza tarefas para o seu site Joomla!<br />' .
		'Para a accionar precisa de adicionar no painel de controlo (separador cron)o seguinte comando:<br />' .
		'<b>' . ACA_JPATH_LIVE . '/index2.php?option=com_acajoom&act=cron</b> ' .
		'<br /><br />Se precisar de ajuda para parametrizar ou tiver problemas por favor consulte o nosso forum <a href="http://www.ijoobi.com" target="_blank">http://www.ijoobi.com</a>'));
// sending settings
define('_ACA_PAUSEX', compa::encodeutf('Pausa x segundos por cada quantidade de emails configurada'));
define('_ACA_PAUSEX_TIPS', compa::encodeutf('Introduza o número de segundos que o Acajoom dará ao servidor de SMTP para enviar as mensagens antes de proceder a novo envio do grupo seguinte de mensagens.'));
define('_ACA_EMAIL_BET_PAUSE', compa::encodeutf('Emails entre pausas'));
define('_ACA_EMAIL_BET_PAUSE_TIPS', compa::encodeutf('Número de emails a enviar antes de fazer pausa.'));
define('_ACA_WAIT_USER_PAUSE', compa::encodeutf('Esperar por acção do utilizador numa pausa'));
define('_ACA_WAIT_USER_PAUSE_TIPS', compa::encodeutf('Caso o script deva esperar por acção do utilizador quando pausado entre conjuntos de mailings.'));
define('_ACA_SCRIPT_TIMEOUT', compa::encodeutf('Tempo de intervalo do Script'));
define('_ACA_SCRIPT_TIMEOUT_TIPS', compa::encodeutf('Número de minutos que o script deverá ter para correr (0 para ilimitados).'));
// Stats settings
define('_ACA_ENABLE_READ_STATS', compa::encodeutf('Activar leitura de estatísticas'));
define('_ACA_ENABLE_READ_STATS_TIPS', compa::encodeutf('Selecione SIM se quiser guardar no histórico o número de visualizações. Esta técnica só pode ser usada com mailings em html'));
define('_ACA_LOG_VIEWSPERSUB', compa::encodeutf('Guardar histórico de visualizações por assinante'));
define('_ACA_LOG_VIEWSPERSUB_TIPS', compa::encodeutf('Selecione SIM se quiser guardar no histórico o número de visualizações por assinante. Esta técnica só pode ser usada com mailings em html'));
// Logs settings
define('_ACA_DETAILED', compa::encodeutf('Históricos detalhados'));
define('_ACA_SIMPLE', compa::encodeutf('Históricos simplificados'));
define('_ACA_DIAPLAY_LOG', compa::encodeutf('Mostrar históricos'));
define('_ACA_DISPLAY_LOG_TIPS', compa::encodeutf('Selecione SIM se quiser mostrar os históricos enquanto envia mailings.'));
define('_ACA_SEND_PERF_DATA', compa::encodeutf('Envio de performance para fora'));
define('_ACA_SEND_PERF_DATA_TIPS', compa::encodeutf('Selecione SIM se quiser permitir ao Acajoom enviar relatórios ANÓNIMOS sobre a sua configuração, número de assinantes de uma lista e o tempo que levou e enviar o mailing. Isto dá-nos uma ideia acerca da performance do Acajoom e AJUDA-NOS a melhorar o Acajoom em futuros desenvolvimentos.'));
define('_ACA_SEND_AUTO_LOG', compa::encodeutf('Histórico de envio para o Auto-resposta'));
define('_ACA_SEND_AUTO_LOG_TIPS', compa::encodeutf('Selecione SIM se quiser enviar um email com histórico cada vez que a fila for processada.  AVISO: isto pode resultar numa grande quantidade de emails.'));
define('_ACA_SEND_LOG', compa::encodeutf('Histórico de envio'));
define('_ACA_SEND_LOG_TIPS', compa::encodeutf('Caso deva ser enviado um email com o histórico do mailing para o endereço de email do utilizador que envioou o mailing.'));
define('_ACA_SEND_LOGDETAIL', compa::encodeutf('Detalhe do histórico de envio'));
define('_ACA_SEND_LOGDETAIL_TIPS', compa::encodeutf('DETALHADO inclúe a informação de sucesso ou falha para cada assinante e um resumo geral da informação. SIMPLES apenas envia o resumo geral.'));
define('_ACA_SEND_LOGCLOSED', compa::encodeutf('Enviar histórico se a conexão for fechada'));
define('_ACA_SEND_LOGCLOSED_TIPS', compa::encodeutf('Com esta opção activada o utilizador que enviou o mailing receberá na mesma o relatório por email.'));
define('_ACA_SAVE_LOG', compa::encodeutf('Salvar Histórico'));
define('_ACA_SAVE_LOG_TIPS', compa::encodeutf('Caso o histórico do mailing deva ser anexado ao ficheiro do histórico.'));
define('_ACA_SAVE_LOGDETAIL', compa::encodeutf('Guardar histórico detalhado'));
define('_ACA_SAVE_LOGDETAIL_TIPS', compa::encodeutf('DETALHADO inclúe a informação de sucesso ou falha para cada assinante e um resumo geral da informação. SIMPLES apenas envia o resumo geral.'));
define('_ACA_SAVE_LOGFILE', compa::encodeutf('Salvar ficheiro de Histórico'));
define('_ACA_SAVE_LOGFILE_TIPS', compa::encodeutf('Ficheiro ao qual a informção de histórico será anexada. Este ficheiro poderá ficar muito grande.'));
define('_ACA_CLEAR_LOG', compa::encodeutf('Limpar Histórico'));
define('_ACA_CLEAR_LOG_TIPS', compa::encodeutf('Limpa o ficheiro de Histórico.'));

### control panel
define('_ACA_CP_LAST_QUEUE', compa::encodeutf('Última fila executada'));
define('_ACA_CP_TOTAL', compa::encodeutf('Total'));
define('_ACA_MAILING_COPY', compa::encodeutf('Mailing copiado com sucesso!'));

// Miscellaneous settings
define('_ACA_SHOW_GUIDE', compa::encodeutf('Mostrar Guia'));
define('_ACA_SHOW_GUIDE_TIPS', compa::encodeutf('Mostra o Guia no início para ajudar novos utilizadores a criar uma newsletter, uma auto-resposta e parametrizar correctamente o Acajoom.'));
define('_ACA_AUTOS_ON', compa::encodeutf('Usar Auto-respostas'));
define('_ACA_AUTOS_ON_TIPS', compa::encodeutf('Selecione NÃO se não quiser usar Auto-respostas, todas as opções de auto-respostas serão desactivadas.'));
define('_ACA_NEWS_ON', compa::encodeutf('Usar Newsletters'));
define('_ACA_NEWS_ON_TIPS', compa::encodeutf('Selecione NÃO se não quiser usar Newsletters, todas as opções de newsletters serão desactivadas.'));
define('_ACA_SHOW_TIPS', compa::encodeutf('Mostrar Dicas'));
define('_ACA_SHOW_TIPS_TIPS', compa::encodeutf('Mostra dicas para ajudar os utilizadores a usar o Acajoom de forma eficaz.'));
define('_ACA_SHOW_FOOTER', compa::encodeutf('Mostrar Rodapé'));
define('_ACA_SHOW_FOOTER_TIPS', compa::encodeutf('Caso deva ou não ser mostrado os direitos de cópia no rodapé.'));
define('_ACA_SHOW_LISTS', compa::encodeutf('Mostrar Listas no sítio-principal'));
define('_ACA_SHOW_LISTS_TIPS', compa::encodeutf('Quando o utilizador não está registado mostra uma lista das listas que pode subscrever através de um botão de arquivo para as newsletters  ou simplesmente um formulário de login para que se possam registar.'));
define('_ACA_CONFIG_UPDATED', compa::encodeutf('Os detalhes da configuração foram actualizados!'));
define('_ACA_UPDATE_URL', compa::encodeutf('URL de Actualização'));
define('_ACA_UPDATE_URL_WARNING', compa::encodeutf('AVISO! Não mude este URL a não ser que lhe seja pedido para o fazer pela equipa técnica do Acajoom.<br />'));
define('_ACA_UPDATE_URL_TIPS', compa::encodeutf('Por exemplo: http://www.ijoobi.com/update/ (inclua a barra no final)'));

// module
define('_ACA_EMAIL_INVALID', compa::encodeutf('O endereço de email introduzido é inválido.'));
define('_ACA_REGISTER_REQUIRED', compa::encodeutf('É necessário registar-se primeiro no site para poder ser assinante de uma lista.'));

// Access level box
define('_ACA_OWNER', compa::encodeutf('Criador da Lista:'));
define('_ACA_ACCESS_LEVEL', compa::encodeutf('Definir nível de acesso para a lista'));
define('_ACA_ACCESS_LEVEL_OPTION', compa::encodeutf('Opções de nível de acesso'));
define('_ACA_USER_LEVEL_EDIT', compa::encodeutf('Selecione que nível de utilizador tem permissão para editar um mailing (quer do sítio-principal quer do sítio de administração) '));

//  drop down options
define('_ACA_AUTO_DAY_CH1', compa::encodeutf('Diariamente'));
define('_ACA_AUTO_DAY_CH2', compa::encodeutf('Diariamente, excepto fim-de-semana'));
define('_ACA_AUTO_DAY_CH3', compa::encodeutf('Dia sim, dia não'));
define('_ACA_AUTO_DAY_CH4', compa::encodeutf('Dia sim, dia não, excepto fim-de-semana'));
define('_ACA_AUTO_DAY_CH5', compa::encodeutf('Semanalmente'));
define('_ACA_AUTO_DAY_CH6', compa::encodeutf('Bi-semanal'));
define('_ACA_AUTO_DAY_CH7', compa::encodeutf('Mensal'));
define('_ACA_AUTO_DAY_CH9', compa::encodeutf('Anual'));
define('_ACA_AUTO_OPTION_NONE', compa::encodeutf('Não'));
define('_ACA_AUTO_OPTION_NEW', compa::encodeutf('Novos Utilizadores'));
define('_ACA_AUTO_OPTION_ALL', compa::encodeutf('Todos os Utilizadores'));

//
define('_ACA_UNSUB_MESSAGE', compa::encodeutf('Email para Não-subscrição'));
define('_ACA_UNSUB_SETTINGS', compa::encodeutf('Definições de Não-subscrição'));
define('_ACA_AUTO_ADD_NEW_USERS', compa::encodeutf('Subscrição automática de Utilizadores?'));

// Update and upgrade messages
define('_ACA_NO_UPDATES', compa::encodeutf('Não existem actualizações disponíveis de momento.'));
define('_ACA_VERSION', compa::encodeutf('Versão Acajoom'));
define('_ACA_NEED_UPDATED', compa::encodeutf('Ficheiros que precisam de ser actualizados:'));
define('_ACA_NEED_ADDED', compa::encodeutf('Ficheiros que precisam de ser adicionados:'));
define('_ACA_NEED_REMOVED', compa::encodeutf('Ficheiros que precisam de ser removidos:'));
define('_ACA_FILENAME', compa::encodeutf('Ficheiro:'));
define('_ACA_CURRENT_VERSION', compa::encodeutf('Versão actual:'));
define('_ACA_NEWEST_VERSION', compa::encodeutf('Última versão:'));
define('_ACA_UPDATING', compa::encodeutf('Actualizando'));
define('_ACA_UPDATE_UPDATED_SUCCESSFULLY', compa::encodeutf('Os ficheiros foram actualizados com sucesso.'));
define('_ACA_UPDATE_FAILED', compa::encodeutf('A Actualização Falhou!'));
define('_ACA_ADDING', compa::encodeutf('Adicionando'));
define('_ACA_ADDED_SUCCESSFULLY', compa::encodeutf('Adicionado com sucesso.'));
define('_ACA_ADDING_FAILED', compa::encodeutf('A Adição Falhou!'));
define('_ACA_REMOVING', compa::encodeutf('Removendo'));
define('_ACA_REMOVED_SUCCESSFULLY', compa::encodeutf('Removido com sucesso.'));
define('_ACA_REMOVING_FAILED', compa::encodeutf('A Remoção Falhou!'));
define('_ACA_INSTALL_DIFFERENT_VERSION', compa::encodeutf('Instale uma versão diferente'));
define('_ACA_CONTENT_ADD', compa::encodeutf('Adicionar conteúdo'));
define('_ACA_UPGRADE_FROM', compa::encodeutf('Importar dados (newsletters e informação de assinantes) de '));
define('_ACA_UPGRADE_MESS', compa::encodeutf('Não existem riscos para os seus dados existentes. <br /> Este processo simplesmente apenas importa dados para a base de dados do Acajoom.'));
define('_ACA_CONTINUE_SENDING', compa::encodeutf('Continuar e enviar'));

// Acajoom message
define('_ACA_UPGRADE1', compa::encodeutf('Você pode facilmente importar os seus utilizadores e newsletters '));
define('_ACA_UPGRADE2', compa::encodeutf(' para o Acajoom no painel de actualizações.'));
define('_ACA_UPDATE_MESSAGE', compa::encodeutf('Está disponível uma nova versão do Acajoom! '));
define('_ACA_UPDATE_MESSAGE_LINK', compa::encodeutf('Clique aqui para actualizar!'));
define('_ACA_CRON_SETUP', compa::encodeutf('Para que as auto-respostas sejam enviadas tem de configurar uma tarefa Cron.'));
define('_ACA_THANKYOU', compa::encodeutf('Obrigado por escolher Acajoom, o Seu Parceiro de Comunicação!'));
define('_ACA_NO_SERVER', compa::encodeutf('Servidor de actualização não disponível, por favor verifique mais tarde.'));
define('_ACA_MOD_PUB', compa::encodeutf('O módulo Acajoom não está publicado.'));
define('_ACA_MOD_PUB_LINK', compa::encodeutf('Clique aqui para o publicar!'));
define('_ACA_IMPORT_SUCCESS', compa::encodeutf('importado com sucesso'));
define('_ACA_IMPORT_EXIST', compa::encodeutf('assinante já está na base de dados'));


// Acajoom\'s Guide
define('_ACA_GUIDE', compa::encodeutf('Assistente'));
define('_ACA_GUIDE_FIRST_ACA_STEP', compa::encodeutf('<p>O Acajoom tem muitas caracteristicas grandiosas e este assistente vai guia-lo através de um processo de 4 passos fáceis para que começe a enviar newsletters e auto-respostas!<p />'));
define('_ACA_GUIDE_FIRST_ACA_STEP_DESC', compa::encodeutf('Primeiro, precisa de adicionar uma lista.  Uma lista pode ser de dois tipos, newsletter ou auto-resposta.' .
		'  Na lista você define todos os diferentes parâmetros para activar o envio das suas newsletters ou auto-respostas: nome do remetente, layout, mensagem de boas-vindas aos assinantes\' , etc...
<br /><br />Pode criar a sua primeira lista aqui: <a href="index2.php?option=com_acajoom&act=list" >criar uma lista</a> e clicar no botão novo.'));
define('_ACA_GUIDE_FIRST_ACA_STEP_UPGRADE', compa::encodeutf('O Acajoom proporciona-lhe uma maneira fácil de importar toda a informação de um sistema prévio de newsletter.<br />' .
		' Vá ao painel de Actualizações e escolha o seu sistema prévio de newsletter para importar todas as suas newsletters e assinantes.<br /><br />' .
		'<span style="color:#FF5E00;" >IMPORTANTE: a inmporatação é LIVRE de risco e não afecta de forma alguma a informação do seu sistema prévio de newsletter</span><br />' .
		'Depois da importação será capaz de gerir os seus assinantes e mailings directamente a partir do Acajoom.<br /><br />'));
define('_ACA_GUIDE_SECOND_ACA_STEP', compa::encodeutf('Optimo a sua primeira lista está criada!  Agora pode escrever o seu primeiro %s.  Para criar vá para: '));
define('_ACA_GUIDE_SECOND_ACA_STEP_AUTO', compa::encodeutf('Gestão de Auto-responder'));
define('_ACA_GUIDE_SECOND_ACA_STEP_NEWS', compa::encodeutf('Gestão de Newsletters'));
define('_ACA_GUIDE_SECOND_ACA_STEP_FINAL', compa::encodeutf(' e selecione o seu %s. <br /> Depois escolha o seu %s na lista de possibilidades.  Crie o seu primeiro mailing clicando em NOVO '));

define('_ACA_GUIDE_THRID_ACA_STEP_NEWS', compa::encodeutf('Antes de enviar a sua primeira newsletter poderá querer verificar a configuração de mail.  ' .
		'Vá para <a href="index2.php?option=com_acajoom&act=configuration" >Página de Configuração</a> para verificar as definições de mail. <br />'));
define('_ACA_GUIDE_THRID2_ACA_STEP_NEWS', compa::encodeutf('<br />Quando estiver pronto retroceda para o Menu Newsletters, selecione o seu mailing e clique em ENVIAR'));

define('_ACA_GUIDE_THRID_ACA_STEP_AUTOS', compa::encodeutf('Para que as suas auto-respostas sejam enviadas necessita que primeiro esteja criada uma tarefa Cron no seu servidor. ' .
		' Por favor refira-se ao separador Cron no painel de configuração.' .
		' <a href="index2.php?option=com_acajoom&act=configuration" >clique aqui</a> para aparender como criar uma tarefa Cron. <br />'));

define('_ACA_GUIDE_MODULE', compa::encodeutf(' <br />Certifique também que publicou o módulo Acajoom para que as pessoas possam assinar a lista.'));

define('_ACA_GUIDE_FOUR_ACA_STEP_NEWS', compa::encodeutf(' Pode agora criar uma auto-resposta.'));
define('_ACA_GUIDE_FOUR_ACA_STEP_AUTOS', compa::encodeutf(' Pode agora também criar uma newsletter.'));

define('_ACA_GUIDE_FOUR_ACA_STEP', compa::encodeutf('<p><br />Aí está! Está agora pronto para comunicar de forma eficaz com os seus visitantes e utilizadores. Este assistente terminará assim que você introduzir um segundo mailing ou então pode desliga-lo no <a href="index2.php?option=com_acajoom&act=configuration" >Painel de Configuração</a>.' .
		'<br /><br />  Se tiver alguma questão enquanto usar o Acajoom, por favor refira-se ao ' .
		'<a target="_blank" href="http://www.ijoobi.com/index.php?option=com_agora&Itemid=60" >forum</a>. ' .
		' Encontrará também muita informação sobre como comunicar de forma eficaz com os seus assinantes em <a href="http://www.ijoobi.com/" target="_blank" >www.ijoobi.com</a>.' .
		'<p /><br /><b>Obrigado por usar o Acajoom. O Seu Parceiro de Comunicação!</b> '));
define('_ACA_GUIDE_TURNOFF', compa::encodeutf('O assitente esta agora a ser desligado!'));
define('_ACA_STEP', compa::encodeutf('STEP '));

// Acajoom Install
define('_ACA_INSTALL_CONFIG', compa::encodeutf('Configuração Acajoom'));
define('_ACA_INSTALL_SUCCESS', compa::encodeutf('Instalação com Sucesso'));
define('_ACA_INSTALL_ERROR', compa::encodeutf('Erro na instalação'));
define('_ACA_INSTALL_BOT', compa::encodeutf('Plugin (Bot) Acajoom'));
define('_ACA_INSTALL_MODULE', compa::encodeutf('Módulo Acajoom'));
//Others
define('_ACA_JAVASCRIPT', compa::encodeutf('!Aviso! Para uma correcta operação o Javascript deve estar activado.'));
define('_ACA_EXPORT_TEXT', compa::encodeutf('Os assinantes exportados são baseados na lista que escolheu. <br />Exportar assinantes para lista'));
define('_ACA_IMPORT_TIPS', compa::encodeutf('Importar assinantes. A informação no ficheiro precisa de ter o seguinte formato: <br />' .
		'Nome,email,recebeHTML(1/0),<span style="color: rgb(255, 0, 0);">confirmado(1/0)</span>'));
define('_ACA_SUBCRIBER_EXIT', compa::encodeutf('já é assinante'));
define('_ACA_GET_STARTED', compa::encodeutf('Clique aqui para começar!'));

//News since 1.0.1
define('_ACA_WARNING_1011', compa::encodeutf('Aviso: 1011: A Actualização não funcionará por causa das restrições do seu server.'));
define('_ACA_SEND_MAIL_FROM_TIPS', compa::encodeutf('Escolha que endereço de email será mostrado como remetente.'));
define('_ACA_SEND_MAIL_NAME_TIPS', compa::encodeutf('Escolha que nome se mostrado como remetente.'));
define('_ACA_MAILSENDMETHOD_TIPS', compa::encodeutf('Escolha que mailer deseja usar: PHP mail function, <span>Sendmail</span> ou SMTP Server.'));
define('_ACA_SENDMAILPATH_TIPS', compa::encodeutf('Esta é a directoria do servidor de Mail'));
define('_ACA_LIST_T_TEMPLATE', compa::encodeutf('Tema Padrão'));
define('_ACA_NO_MAILING_ENTERED', compa::encodeutf('Nenhum mailing fornecido'));
define('_ACA_NO_LIST_ENTERED', compa::encodeutf('Nenhuma lista fornecida'));
define('_ACA_SENT_MAILING', compa::encodeutf('Mailings Enviados'));
define('_ACA_SELECT_FILE', compa::encodeutf('Por favor selecione um ficheiro para '));
define('_ACA_LIST_IMPORT', compa::encodeutf('Verifique a(s) lista(s) que você quer que tenha(m) assinantes associados.'));
define('_ACA_PB_QUEUE', compa::encodeutf('Subscriber inserted but problem to connect him/her to the list(s). Please check manually.'));
define('_ACA_UPDATE_MESS', compa::encodeutf(''));
define('_ACA_UPDATE_MESS1', compa::encodeutf('Actualização Altamente Recomendada!'));
define('_ACA_UPDATE_MESS2', compa::encodeutf('Remendo e pequenas correcções.'));
define('_ACA_UPDATE_MESS3', compa::encodeutf('Novo lançamento.'));
define('_ACA_UPDATE_MESS5', compa::encodeutf('É obrigatório Joomla 1.5 para actualizar.'));
define('_ACA_UPDATE_IS_AVAIL', compa::encodeutf(' está disponível!'));
define('_ACA_NO_MAILING_SENT', compa::encodeutf('Nenhum mailing enviado!'));
define('_ACA_SHOW_LOGIN', compa::encodeutf('Mostra formulário de login'));
define('_ACA_SHOW_LOGIN_TIPS', compa::encodeutf('Selecione SIM para mostrar um formulário de login no sítio-principal do Painel de Controlo do Acajoom para que o utilizador possa registar-se no site.'));
define('_ACA_LISTS_EDITOR', compa::encodeutf('Editor de Descrição da Lista'));
define('_ACA_LISTS_EDITOR_TIPS', compa::encodeutf('Selecione SIM para usar um editor HTML para editar o campo Descrição da Lista.'));
define('_ACA_SUBCRIBERS_VIEW', compa::encodeutf('Ver assinantes'));

//News since 1.0.2
define('_ACA_FRONTEND_SETTINGS', compa::encodeutf('Definiçoes do Sítio-Principal'));
define('_ACA_SHOW_LOGOUT', compa::encodeutf('Mostra botão de logout'));
define('_ACA_SHOW_LOGOUT_TIPS', compa::encodeutf('Selecione SIM para mostrar um botão de logout no front-end do painal de controlo do Acajoom.'));

//News since 1.0.3 CB integration
define('_ACA_CONFIG_INTEGRATION', compa::encodeutf('Integração'));
define('_ACA_CB_INTEGRATION', compa::encodeutf('Integração com o Community Builder'));
define('_ACA_INSTALL_PLUGIN', compa::encodeutf('Plugin Community Builder (Integração Acajoom) '));
define('_ACA_CB_PLUGIN_NOT_INSTALLED', compa::encodeutf('O plugin Acajoom para o Community Builder ainda não está instalado!'));
define('_ACA_CB_PLUGIN', compa::encodeutf('Listas aquando do registo'));
define('_ACA_CB_PLUGIN_TIPS', compa::encodeutf('Selecione SIM para mostrar as listas de mailing no formulário de registo do community builder'));
define('_ACA_CB_LISTS', compa::encodeutf('Listas de IDs'));
define('_ACA_CB_LISTS_TIPS', compa::encodeutf('ESTE CAMPO É OBRIGATÓRIO. Introduza o número de ID das listas que você quer permitir aos utilizadores assinar separados por vírgula ,  (0 mostra todas as listas)'));
define('_ACA_CB_INTRO', compa::encodeutf('Texto de Introdução'));
define('_ACA_CB_INTRO_TIPS', compa::encodeutf('Um texto aparecerá antes da listagem. DEIXE EM BRANCO PARA NÃO MOSTRAR NADA.  Use cb_pretext para layout CSS.'));
define('_ACA_CB_SHOW_NAME', compa::encodeutf('Mostra Nome da Lista'));
define('_ACA_CB_SHOW_NAME_TIPS', compa::encodeutf('Selecione se deve ou não mostrar o nome da lista depois da introdução.'));
define('_ACA_CB_LIST_DEFAULT', compa::encodeutf('Verifica lista por defeito'));
define('_ACA_CB_LIST_DEFAULT_TIPS', compa::encodeutf('Selecione se quer ou não, ter uma caixa de verificação para cada lista verificado por defeito.'));
define('_ACA_CB_HTML_SHOW', compa::encodeutf('Mostra Receber HTML'));
define('_ACA_CB_HTML_SHOW_TIPS', compa::encodeutf('Escolha SIM para permitir aos utilizadores decidir se querem ou não, receber emails em HTML. Escolha NÃO para usar o receber HTML por defeito.'));
define('_ACA_CB_HTML_DEFAULT', compa::encodeutf('Receber HTML por defeito'));
define('_ACA_CB_HTML_DEFAULT_TIPS', compa::encodeutf('Escolha esta opção para mostrar a configuração de mail em HTML por defeito. Se o Mostra Receber Html estiver para NÃO então esta será a opção por defeitot.'));

// Since 1.0.4
define('_ACA_BACKUP_FAILED', compa::encodeutf('Não foi possível efectuar a cópia de segurança do ficheiro! O ficheiro não foi substituído.'));
define('_ACA_BACKUP_YOUR_FILES', compa::encodeutf('Foi efectuada uma cópia de segurança dos ficheiros da versão antiga na seguinte directória:'));
define('_ACA_SERVER_LOCAL_TIME', compa::encodeutf('Hora local do Servidor'));
define('_ACA_SHOW_ARCHIVE', compa::encodeutf('Mostrar botão de Arquivo'));
define('_ACA_SHOW_ARCHIVE_TIPS', compa::encodeutf('Selecione SIM para mostrar o botão de Arquivo no front-end das listas de Newsletter'));
define('_ACA_LIST_OPT_TAG', compa::encodeutf('Tags'));
define('_ACA_LIST_OPT_IMG', compa::encodeutf('Imagens'));
define('_ACA_LIST_OPT_CTT', compa::encodeutf('Conteúdo'));
define('_ACA_INPUT_NAME_TIPS', compa::encodeutf('Introduza o seu nome completo (primeiro nome primeiro)'));
define('_ACA_INPUT_EMAIL_TIPS', compa::encodeutf('Introduza o seu endereço de email (Certifique-se de que este é um endereço de email válido para que possa receber as nossas Newsletters.)'));
define('_ACA_RECEIVE_HTML_TIPS', compa::encodeutf('Escolha SIM se quiser receber mails em HTML - NÃO para receber mails em apenas texto'));
define('_ACA_TIME_ZONE_ASK_TIPS', compa::encodeutf('Especifique a sua zona de fuso horário.'));


// Since 1.0.5
define('_ACA_FILES', compa::encodeutf('Ficheiros'));
define('_ACA_FILES_UPLOAD', compa::encodeutf('Envio'));
define('_ACA_MENU_UPLOAD_IMG', compa::encodeutf('Envio de Imagens'));
define('_ACA_TOO_LARGE', compa::encodeutf('Tamanho do ficheiro demasiado grande. O tamanho máximo permitido é'));
define('_ACA_MISSING_DIR', compa::encodeutf('O directório de destino não existe'));
define('_ACA_IS_NOT_DIR', compa::encodeutf('O directório de destino não existe ou é um ficheiro regular.'));
define('_ACA_NO_WRITE_PERMS', compa::encodeutf('O directório de destino não tem permissão de escrita.'));
define('_ACA_NO_USER_FILE', compa::encodeutf('Não selecionou nenhum ficheiro para envio.'));
define('_ACA_E_FAIL_MOVE', compa::encodeutf('Impossível mover o ficheiro.'));
define('_ACA_FILE_EXISTS', compa::encodeutf('O ficheiro destino já existe.'));
define('_ACA_CANNOT_OVERWRITE', compa::encodeutf('O ficheiro destino já existe e não pode ser sobreposto.'));
define('_ACA_NOT_ALLOWED_EXTENSION', compa::encodeutf('Extensão de ficheiro não permitida.'));
define('_ACA_PARTIAL', compa::encodeutf('O ficheiro foi enviado apenas parcialmente.'));
define('_ACA_UPLOAD_ERROR', compa::encodeutf('Erro de envio:'));
define('DEV_NO_DEF_FILE', compa::encodeutf('O ficheiro foi enviado apenas parcialmente.'));
define('_ACA_CONTENTREP', compa::encodeutf('[SUBSCRIPTIONS] = Isto será substiuído pelos links de subscrição.' .
		' Isto é <strong>obrigatório</strong> para que o Acajoom funcione correctamente.<br />' .
		'Se colocar algum outro conteúdo nesta caixa o mesmo será mostrado em todos os mailings correspondentes a esta Lista.' .
		' <br />Adicione a sua mensagem de subscrição no final.  O Acajoom adicionará automaticamente um link para que o assinante altere a informação dele, e um link para remover-se da Lista.'));

// since 1.0.6
define('_ACA_NOTIFICATION', compa::encodeutf('Notificação'));  // shortcut for Email notification
define('_ACA_NOTIFICATIONS', compa::encodeutf('Notificações'));
define('_ACA_USE_SEF', compa::encodeutf('SEF nos mailings'));
define('_ACA_USE_SEF_TIPS', compa::encodeutf('É recomendado que escolha NÃO.  No entanto se desejar que o URL incluído nos seus mailings use SEF então escolha SIM.' .
		' <br /><b>Os links funcionarão de igual forma para ambas as opções.  NÃO, assegurará que os links nos mailings funcionarão sempre mesmo que altere o seu SEF.</b> '));
define('_ACA_ERR_NB', compa::encodeutf('Erro #: ERR'));
define('_ACA_ERR_SETTINGS', compa::encodeutf('Definições de manuseamento de Erros'));
define('_ACA_ERR_SEND', compa::encodeutf('Enviar relatório de erros'));
define('_ACA_ERR_SEND_TIPS', compa::encodeutf('Se deseja que o Acajoom seja um produto melhor por favor selecione SIM.  Isto envia-nos um relatório de erros.  Por isso nunca mais necessita de reportar bugs ;-) <br /> <b>NENHUMA INFORMAÇÃO PRIVADA É ENVIADA</b>.  Nós nem sequer saberemos a que site pertençe o erro. Apenas enviamos informação sobre o Acajoom , a instalação PHP e queries SQL. '));
define('_ACA_ERR_SHOW_TIPS', compa::encodeutf('Escolha SIM para mostrar o número do erro no ecrán.  Usado principalmente para efeitos de debuging. '));
define('_ACA_ERR_SHOW', compa::encodeutf('Mostra erros'));
define('_ACA_LIST_SHOW_UNSUBCRIBE', compa::encodeutf('Mostra links de remoção'));
define('_ACA_LIST_SHOW_UNSUBCRIBE_TIPS', compa::encodeutf('Selecione SIM para mostrar links de remoção no rodapé dos mailings para que os utilizadores possam mudar as suas subscrições. <br /> NÃO, desactiva os links e rodapé.'));
define('_ACA_UPDATE_INSTALL', compa::encodeutf('<span style="color: rgb(255, 0, 0);">NOTÍCIA IMPORTANTE!</span> <br />Se está a fazer uma actualização a partir de uma versão anterior do Acajoom, precisa de actualizar a estrutura da sua base de dados clicando no botão seguinte (A sua informação ficará íntegra)'));
define('_ACA_UPDATE_INSTALL_BTN', compa::encodeutf('Actualizar tabelas e configuração'));
define('_ACA_MAILING_MAX_TIME', compa::encodeutf('Tempo máximo da fila'));
define('_ACA_MAILING_MAX_TIME_TIPS', compa::encodeutf('Define o tempo máximo para cada conjunto de emails enviados pela fila. Recomendado entre 30s e 2mins.'));

// virtuemart integration beta
define('_ACA_VM_INTEGRATION', compa::encodeutf('Integração com VirtueMart'));
define('_ACA_VM_COUPON_NOTIF', compa::encodeutf('Notificação de ID do Cupão'));
define('_ACA_VM_COUPON_NOTIF_TIPS', compa::encodeutf('Especifica o número de ID do mailing que quiser usar para enviar cupões para os seus clientes.'));
define('_ACA_VM_NEW_PRODUCT', compa::encodeutf('Notificação de ID de novos produtos'));
define('_ACA_VM_NEW_PRODUCT_TIPS', compa::encodeutf('Especifica o número de ID do mailing que quiser usar para enviar notificação de novos produtos.'));


// since 1.0.8
// create forms for subscriptions
define('_ACA_FORM_BUTTON', compa::encodeutf('Criar Formulário'));
define('_ACA_FORM_COPY', compa::encodeutf('Código HTML'));
define('_ACA_FORM_COPY_TIPS', compa::encodeutf('Copie o código HTML gerado para a sua página HTML.'));
define('_ACA_FORM_LIST_TIPS', compa::encodeutf('Selecione a lista que quer incluir neste formulário'));
// update messages
define('_ACA_UPDATE_MESS4', compa::encodeutf('Não pode ser actualizado automaticamente.'));
define('_ACA_WARNG_REMOTE_FILE', compa::encodeutf('Não há maneira de conseguir o ficheiro remoto.'));
define('_ACA_ERROR_FETCH', compa::encodeutf('Erro de acesso ao ficheiro.'));

define('_ACA_CHECK', compa::encodeutf('Verificar'));
define('_ACA_MORE_INFO', compa::encodeutf('Mais informação'));
define('_ACA_UPDATE_NEW', compa::encodeutf('Actualizar para nova versão'));
define('_ACA_UPGRADE', compa::encodeutf('Upgrade para produto mais elevado'));
define('_ACA_DOWNDATE', compa::encodeutf('Voltar a instalar versão anterior'));
define('_ACA_DOWNGRADE', compa::encodeutf('Voltar para o produto básico'));
define('_ACA_REQUIRE_JOOM', compa::encodeutf('Requere Joomla'));
define('_ACA_TRY_IT', compa::encodeutf('Experimentar!'));
define('_ACA_NEWER', compa::encodeutf('Novo'));
define('_ACA_OLDER', compa::encodeutf('Antigo'));
define('_ACA_CURRENT', compa::encodeutf('Actual'));

// since 1.0.9
define('_ACA_CHECK_COMP', compa::encodeutf('Experimentar um dos outros componentes'));
define('_ACA_MENU_VIDEO', compa::encodeutf('Tutoriais Video'));
define('_ACA_AUTO_SCHEDULE', compa::encodeutf('Temporizador'));
define('_ACA_SCHEDULE_TITLE', compa::encodeutf('Definições de funções automáticas temporizadas'));
define('_ACA_ISSUE_NB_TIPS', compa::encodeutf('Atribuir número automaticamente gerado pelo sistema'));
define('_ACA_SEL_ALL', compa::encodeutf('Todos os mailings'));
define('_ACA_SEL_ALL_SUB', compa::encodeutf('Todas as listas'));
define('_ACA_INTRO_ONLY_TIPS', compa::encodeutf('Se assinalar esta caixa apenas a introdução do artigo será inserida no mailing com um link LER MAIS para a leitura completa do mesmo no seu site.'));
define('_ACA_TAGS_TITLE', compa::encodeutf('Tag de conteúdo'));
define('_ACA_TAGS_TITLE_TIPS', compa::encodeutf('Copie e cole esta tag para o seu mailing, no sítio onde quer colocar o conteúdo.'));
define('_ACA_PREVIEW_EMAIL_TEST', compa::encodeutf('Indica o endereço de email para onde enviar um teste'));
define('_ACA_PREVIEW_TITLE', compa::encodeutf('Pré-visualizar'));
define('_ACA_AUTO_UPDATE', compa::encodeutf('Nova notificação de actualização'));
define('_ACA_AUTO_UPDATE_TIPS', compa::encodeutf('Selecione SIM se quiser ser notificado de novas actualizações para o seu componente. <br />IMPORTANTE!! Mostrar Dicas tem de estar activado para que esta função funcione.'));

// since 1.1.0
define('_ACA_LICENSE', compa::encodeutf('Informação de Licenceamento'));


// since 1.1.1
define('_ACA_NEW', compa::encodeutf('Novo'));
define('_ACA_SCHEDULE_SETUP', compa::encodeutf('Para que as auto-respostas sejam enviadas tem de definir uma agenda na configuração.'));
define('_ACA_SCHEDULER', compa::encodeutf('Agendador'));
define('_ACA_ACAJOOM_CRON_DESC', compa::encodeutf('se não tem acesso à administração de tarefas cron no seu website, pode registar-se para uma Conta Tarefa Cron Acajoom Grátis em:'));
define('_ACA_CRON_DOCUMENTATION', compa::encodeutf('Pode encontrar mais informação sobre como definir o Agendador Acajoom no url seguinte:'));
define('_ACA_CRON_DOC_URL', compa::encodeutf('<a href="http://www.ijoobi.com/index.php?option=com_content&view=article&id=4249&catid=29&Itemid=72"
 target="_blank">http://www.ijoobi.com/index.php?option=com_content&Itemid=72&view=category&layout=blog&id=29&limit=60</a>'));
define( '_ACA_QUEUE_PROCESSED', compa::encodeutf('Fila processada com sucesso...'));
define( '_ACA_ERROR_MOVING_UPLOAD', compa::encodeutf('Erro ao mover ficheiro importado'));

//since 1.1.4
define( '_ACA_SCHEDULE_FREQUENCY', compa::encodeutf('Frequência do Agenda'));
define( '_ACA_CRON_MAX_FREQ', compa::encodeutf('Frequência Máxima da Agenda'));
define( '_ACA_CRON_MAX_FREQ_TIPS', compa::encodeutf('Especifica a frequência máxima que a agenda pode ser executada ( em minutos ).  Isto limitará a atenda mesmo que a tarefa cron esteja definida com maior frequência.'));
define( '_ACA_CRON_MAX_EMAIL', compa::encodeutf('Máximo de emails por tarefa'));
define( '_ACA_CRON_MAX_EMAIL_TIPS', compa::encodeutf('Especifica o número máximo de emails enviados por tarefa (0 ilimitados).'));
define( '_ACA_CRON_MINUTES', compa::encodeutf(' minutos'));
define( '_ACA_SHOW_SIGNATURE', compa::encodeutf('Mostra rodapé do email'));
define( '_ACA_SHOW_SIGNATURE_TIPS', compa::encodeutf('Caso queira ou não promover o Acajoom no rodapé dos emails.'));
define( '_ACA_QUEUE_AUTO_PROCESSED', compa::encodeutf('Auto-respostas processadas com successo...'));
define( '_ACA_QUEUE_NEWS_PROCESSED', compa::encodeutf('Newsletters agendadas processadas com sucesso...'));
define( '_ACA_MENU_SYNC_USERS', compa::encodeutf('Sincronizar Utilizadores'));
define( '_ACA_SYNC_USERS_SUCCESS', compa::encodeutf('Sincronização de Utilizadores processada com sucesso!'));

// compatibility with Joomla 15
if (!defined('_BUTTON_LOGOUT')) define( '_BUTTON_LOGOUT', compa::encodeutf('Sair'));
if (!defined('_CMN_YES')) define( '_CMN_YES', compa::encodeutf('Sim'));
if (!defined('_CMN_NO')) define( '_CMN_NO', compa::encodeutf('Não'));
if (!defined('_HI')) define( '_HI', compa::encodeutf('Olá'));
if (!defined('_CMN_TOP')) define( '_CMN_TOP', compa::encodeutf('Topo'));
if (!defined('_CMN_BOTTOM')) define( '_CMN_BOTTOM', compa::encodeutf('Fundo'));
//if (!defined('_BUTTON_LOGOUT')) define( '_BUTTON_LOGOUT', compa::encodeutf('Logout'));

// For include title only or full article in content item tab in newsletter edit - p0stman911
define('_ACA_TITLE_ONLY_TIPS', compa::encodeutf('Se selecionar isto apenas o título do artigo será inserido no mailing como link para o artigo completo no seu site.'));
define('_ACA_TITLE_ONLY', compa::encodeutf('Apenas Título'));
define('_ACA_FULL_ARTICLE_TIPS', compa::encodeutf('Se selecionar isto o artigo completo será inserido no mailing'));
define('_ACA_FULL_ARTICLE', compa::encodeutf('Artigo Completo'));
define('_ACA_CONTENT_ITEM_SELECT_T', compa::encodeutf('Selecione um item de conteúdo para ser adicionado à mensagem. <br />Copie e cole o<b>content tag</b> para o mailing.  Pode escolher ter a totalidade do texto, apenas introdução, ou apenas título com (0, 1, ou 2 respectivamente). '));
define('_ACA_SUBSCRIBE_LIST2', compa::encodeutf('Lista(s) de Mailing'));

// smart-newsletter function
define('_ACA_AUTONEWS', compa::encodeutf('Smart-Newsletter'));
define('_ACA_MENU_AUTONEWS', compa::encodeutf('Smart-Newsletters'));
define('_ACA_AUTO_NEWS_OPTION', compa::encodeutf('Opções da Smart-Newsletter'));
define('_ACA_AUTONEWS_FREQ', compa::encodeutf('Frequência da Newsletter'));
define('_ACA_AUTONEWS_FREQ_TIPS', compa::encodeutf('Especifica a frequência com que deseja enviar as smart-newsletter.'));
define('_ACA_AUTONEWS_SECTION', compa::encodeutf('Secção de Artigos'));
define('_ACA_AUTONEWS_SECTION_TIPS', compa::encodeutf('Especifica a secção de que quer escolher os artigos.'));
define('_ACA_AUTONEWS_CAT', compa::encodeutf('Categoria do Artigo'));
define('_ACA_AUTONEWS_CAT_TIPS', compa::encodeutf('Especifica a categoria de que quer escolher os artigos (TODAS para todos os artigos naquela secção).'));
define('_ACA_SELECT_SECTION', compa::encodeutf('Selecione secção'));
define('_ACA_SELECT_CAT', compa::encodeutf('Todas as Categorias'));
define('_ACA_AUTO_DAY_CH8', compa::encodeutf('Quaternalmente'));
define('_ACA_AUTONEWS_STARTDATE', compa::encodeutf('Data de começo'));
define('_ACA_AUTONEWS_STARTDATE_TIPS', compa::encodeutf('Especifica a data para começar a enviar a Smart Newsletter.'));
define('_ACA_AUTONEWS_TYPE', compa::encodeutf('Renderização do Conteúdo'));// how we see the content which is included in the newsletter
define('_ACA_AUTONEWS_TYPE_TIPS', compa::encodeutf('Artigo Completo: will include the entire article in the newsletter.<br />' .
		'Apenas Introdução: será incluida apenas a introdução do artigo na newsletter.<br/>' .
		'Apenas Título: será incluido apenas o título do artigo na newsletter.'));
define('_ACA_TAGS_AUTONEWS', compa::encodeutf('[SMARTNEWSLETTER] = Isto será substituído pela Smart-newsletter.'));

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

define( '_ACA_MAIL_FORMAT', compa::encodeutf('Formato de codificação'));
define( '_ACA_MAIL_FORMAT_TIPS', compa::encodeutf('Que formato utiliza para codificar os mailings, somente texto ou MIME'));
define( '_ACA_ACAJOOM_CRON_DESC_ALT', compa::encodeutf('If you do not have access to a cron task manager on your website, you can use the Free jCron component to create a cron task from your website.'));

//since 1.3.1
define('_ACA_SHOW_AUTHOR', compa::encodeutf('Mostrar nome do autor'));
define('_ACA_SHOW_AUTHOR_TIPS', compa::encodeutf('Seleccione Sim se pretende adicionar o nome do autor quando adiciona um artigo ao Mailing'));

//since 1.3.5
define('_ACA_REGWARN_NAME', compa::encodeutf('Por favor, informe seu nome.'));
define('_ACA_REGWARN_MAIL', compa::encodeutf('Por favor, informe um endereço de e-mail válido.'));

//since 1.5.6
define('_ACA_ADDEMAILREDLINK_TIPS', compa::encodeutf('Se seleccionar Sim o e-mail do utilizador será adicionado como parametro no final do url redireccionado (o link redireccionado para o seu modulo or para um formulário Acajoom externo).<br/>Pode ser útil se pretender executar scripts especiais na sua página redireccionada.'));
define('_ACA_ADDEMAILREDLINK', compa::encodeutf('Adicionar e-mail para redireccionar link'));

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
define('_ACA_REDIRECTCONFIRMATION', compa::encodeutf('URL redireccionado'));
define('_ACA_REDIRECTCONFIRMATION_TIPS', compa::encodeutf('Se requer um e-mail de confirmação, o utilizador quando confirmar será remetido para este URL.'));

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