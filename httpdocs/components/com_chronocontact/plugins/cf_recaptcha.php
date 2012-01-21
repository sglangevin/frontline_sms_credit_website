<?php
defined('_JEXEC') or die('Restricted access');
global $mainframe;
require_once( $mainframe->getPath( 'class', 'com_chronocontact' ) );
// the class name must be the same as the file name without the .php at the end
class cf_recaptcha
{
    //the next four fields must be defined for every plugin
    var $result_TITLE = "ReCaptcha verification";
    var $result_TOOLTIP = "use the popular reCaptcha image verification in your form as simple as adding a {ReCaptcha} text in your form and enabling and configuring the plugin correctly, more details inside!";
    var $plugin_name = "cf_recaptcha"; // must be the same as the class name
    var $event = "ONLOADONSUBMIT"; // must be defined and in Uppercase, should be ONSUBMIT or ONLOAD

    // the next function must exist and will have the backend config code
    function show_conf($row, $id, $form_id, $option)
    {
        global $mainframe;

        require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'plugin.php');
        $helper = new ChronoContactHelperPlugin();
        $doc =& JFactory::getDocument();
        $db =& JFactory::getDBO();

        // identify and initialise the parameters used in this plugin
        $params_array = array(
        	'public_key' => '6LfNoAUAAAAAAKi8QZmjv-QHOvlGtyh509SG3FzG',
        	'private_key' => '6LfNoAUAAAAAABX7Dfw_9Pp4K4KVtKNCUHsIWG7O',
        	'ssl_server' => '0',
            'theme' => 'red',
        	'lang' => 'en',
        	'api_server' => 'http://api.recaptcha.net',
        	'api_secure_server' => 'https://api-secure.recaptcha.net',
        	'verify_server' => 'api-verify.recaptcha.net',
            'onsubmit' => 'before_email');
        $params = $helper->loadParams($row, $params_array);

        $tables = $db->getTableList();
        $script = $style = "";
        $style .= "
        form .cf_header {
        	text-align:left;
        	font-weight:bold;
        	color:blue;
        	border:1px solid silver;
        	padding:6px;
        	padding-left:30px;
    	}";
         jimport('joomla.html.pane');
        $pane   =& JPane::getInstance('tabs');
?>
<form action="index2.php" method="post" name="adminForm" id="adminForm"
    class="adminForm">
<?php
        echo $pane->startPane("cf_recaptcha");
        echo $pane->startPanel( 'Configure', 'Configure' );
?>
<table border="0" cellpadding="3" cellspacing="0" style='width:400px;'>
    <tr>
        <td colspan='4' class='cf_header' >Your ReCaptcha keys</td>
    </tr>
    <tr style="background-color: #c9c9c9">
<?php
        $tooltip = "Your ReCaptcha public key.";
        echo $helper->createInputTD("ReCaptcha public key",
            'params[public_key]',
            $params->get('public_key'), '', '', $tooltip);
?>
    </tr>
    <tr style="background-color: #c9c9c9">
<?php
        $tooltip = "Your ReCaptcha private key.";
        echo $helper->createInputTD("ReCaptcha private key",
            'params[private_key]',
            $params->get('private_key'), '', '', $tooltip);
?>
    </tr>
    <tr>
        <td colspan='4' class='cf_header' >Custom setup options</td>
    </tr>
    <tr style="background-color: #c9c9c9">
<?php
    $tooltip = "Check yes if you want to use the ReCaptcha SSL server.";
    echo $helper->createYesNoTD('SSL server', 'params[ssl_server]', '', $params->get('ssl_server'),
        '', $tooltip );
?>
    </tr>
    <tr style="background-color: #c9c9c9">
<?php
        $tooltip = "Select one of the ReCaptcha themes.";
        $option_array = array('clean' => 'clean', 'red' => 'red',
            'white' => 'white', 'blackglass' => 'blackglass', 'custom' => 'custom' );
        foreach ($option_array as $k => $v ) {
            $option_array[$k] = JHTML::_('select.option', $k, JText::_($v));
        }
        echo $helper->createSelectTD('Theme',
            'params[theme]', $option_array,
            $params->get('theme'), '', $tooltip );
?>
    </tr>
    <tr style="background-color: #c9c9c9">
<?php
        $tooltip = "Select one of the ReCaptcha supported languages.";
        $option_array = array('en' => 'English', 'nt' => 'Dutch',
            'fr' => 'French', 'de' => 'German', 'pt' => 'Portuguese',
            'ru' => 'Russian', 'es' => 'Spanish', 'tr' => 'Turkish');
        foreach ($option_array as $k => $v ) {
            $option_array[$k] = JHTML::_('select.option', $k, JText::_($v));
        }
        echo $helper->createSelectTD('Language',
            'params[lang]', $option_array,
            $params->get('lang'), '', $tooltip );
?>
    </tr>
</table>
<?php
        echo $pane->endPanel();
        echo $pane->startPanel( 'Advanced', 'advanced' );
?>
<table border="0" cellpadding="3" cellspacing="0" style='width:400px;'>
    <tr>
        <td colspan='4' class='cf_header' >Advanced parameters - do not change</td>
    </tr>
    <tr style="background-color: #c9c9c9">
<?php
        $tooltip = "The full URL of the ReCaptcha standard api server.
        NB You should not normally need to change this.";
        echo $helper->createInputTD("ReCaptcha server",
            'params[api_server]',
            $params->get('api_server'), '', '', $tooltip);
?>
    </tr>
    <tr style="background-color: #c9c9c9">
<?php
        $tooltip = "The full URL of the ReCaptcha SSL api server.
        NB You should not normally need to change this.";
        echo $helper->createInputTD("ReCaptcha secure server",
            'params[api_secure_server]',
            $params->get('api_secure_server'), '', '', $tooltip);
?>
    </tr>
    <tr style="background-color: #c9c9c9">
<?php
        $tooltip = "The full URL of the ReCaptcha verify server.
        NB You should not normally need to change this.";
        echo $helper->createInputTD("ReCaptcha verify server",
            'params[verify_server]',
            $params->get('verify_server'), '', '', $tooltip);
?>
    </tr>
</table>
<?php
        $hidden_array = array (
            'id' => $id,
            'form_id' => $form_id,
            'name' => $this->plugin_name,
            'event' => $this->event,
            'option' => $option,
            'task' => 'save_conf');
        $hidden_array['params[onsubmit]'] = 'before_email';
        echo $helper->createHiddenArray( $hidden_array );

        echo $pane->endPanel();
        echo $pane->startPanel( 'Help', 'help' );
?>
<table border="0" cellpadding="3" cellspacing="0" style='width:400px;'>
    <thead>
        <tr>
            <th colspan='4' class='cf_header' >Configure ReCaptcha plugin</th>
        </tr>
    </thead>
    <tr>
        <td colspan='4' style='border:1px solid silver; padding:6px;'>
        <div>The plugin allows you to use ReCaptcha form verification with your ChronoForms Form.</div>
        <div><a href="http://recaptcha.net/">ReCAPTCHA</a> is a completely independent verification system
        that is widely used on the Internet - see their site for more information.</div>
        <ul><li>The plugin comes with a pair of global ReCaptcha so that it will work immediately.
        For your own security we strongly recommend that you register at the
        <a href="http://recaptcha.net/">ReCaptcha site</a> and get your
        own keys limited to your site. Registration is simple, free and quick.
        When you have your keys copy and paste them over the keys here and re-save the plugin.
        You may use the same keys with any number of forms on your site.</li>
        <li>You will need to include the ReCaptcha box in your form HTML using <span style='color:blue;'>{ReCaptcha}</span>.
        You can do this using a 'Text' item from the Toolbox with a value of {ReCaptcha}.
        You may need to editt the styling a little to format the box correctly
        (try removing the 'form_element' class from the surrounding div).</li>
        <li>If your form is using SSL and the url has an 'https' prefix, set SSL Server
        to yes - otherwise leave it as No.</li>
        <li>The theme list are those provided as default by ReCaptcha, it is possible to
        develop a custom theme - please see the instructions on the ReCaptcha FAQs and Wiki.</li>
        <li>The languages listed are those provided as default by ReCaptcha, to change or add other
        languages please see the ReCaptcha site.</li>
        <li>You should not need to change the server settings unless ReCaptcha
        make a change in their service.</li>
        <li>Once this plugin is configured you must enable it in the Form 'Plugins'' tab.</li></ul>
        </td>
    </tr>
    </table>
<?php
        echo $pane->endPane();
        echo $pane->endPanel();
?>
<input type="hidden" name="params[onsubmit]" value="before_email" />
</form>
<?php
        if ( $style ) $doc->addStyleDeclaration($style);
        if ( $script ) $doc->addScriptDeclaration($script);
    }

    function onload( $option, $row, $params, $html_string )
    {
        define('RECAPTCHA_API_SERVER', $params->get('api_server'));
        define('RECAPTCHA_API_SECURE_SERVER', $params->get('api_secure_server'));

        $recaptcha_load = "<div id='recaptcha'>".self::recaptcha_get_html($params->get('public_key'))."</div>";

        $script = "
	var RecaptchaOptions = {
		theme : '".$params->get('theme')."',
		lang  : '".$params->get('lang')."'
	};
    		";
        $doc =& JFactory::getDocument();
        $doc->addScriptDeclaration($script);

        $html_string = str_replace("{ReCaptcha}", $recaptcha_load, $html_string);

        return $html_string;
    }
    function onsubmit( $option, $params, $plugin )
    {
        define('RECAPTCHA_VERIFY_SERVER', $params->get('verify_server'));
		$MyForm =& CFChronoForm::getInstance();
		$posted = JRequest::get( 'post' , JREQUEST_ALLOWRAW );
        $resp = self::recaptcha_check_answer(
            $params->get('private_key'),
            $_SERVER["REMOTE_ADDR"],
            JRequest::getVar("recaptcha_challenge_field"),
            JRequest::getVar("recaptcha_response_field") );

        if ( !$resp->is_valid ) {
            global $mainframe;//, $errorfound, $stoprunning;
            $message = "The reCAPTCHA wasn't entered correctly. Go back and try it again<br />
            	( reCAPTCHA said: ".$resp->error." )";

			$MyForm->addErrorMsg($message);
			$MyForm->error_found = true;
			$MyForm->stoprunning = true;
			//$MyForm->showForm($MyForm->formrow->name, $posted);

        }
    }
    // this function must exist and may not be changed unless you need to customize something
    function save_conf( $option )
    {
        require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'plugin.php');
        $helper = new ChronoContactHelperPlugin();
        $helper->save_conf($option);
    }
    //** below here is the ReCaptcha code - you should not need to change this
    //** the functions are called from inside this class using self::functionName()
    /**
     * Gets the challenge HTML (javascript and non-javascript version).
     * This is called from the browser, and the resulting reCAPTCHA HTML widget
     * is embedded within the HTML form it was called from.
     * @param string $pubkey A public key for reCAPTCHA
     * @param string $error The error given by reCAPTCHA (optional, default is null)
     * @param boolean $use_ssl Should the request be made over ssl? (optional, default is false)

     * @return string - The HTML to be embedded in the user's form.
     */
    function recaptcha_get_html($pubkey, $error = null, $use_ssl = false)
    {
        if ( $pubkey == null || $pubkey == '' ) {
            die ("To use reCAPTCHA you must get an API key from
            <a href='http://recaptcha.net/api/getkey'>http://recaptcha.net/api/getkey</a>");
        }

        if ( $use_ssl ) {
            $server = RECAPTCHA_API_SECURE_SERVER;
        } else {
            $server = RECAPTCHA_API_SERVER;
        }

        $errorpart = "";
        if ( $error ) {
            $errorpart = "&amp;error=" . $error;
        }
        return '<script type="text/javascript" src="'. $server . '/challenge?k=' . $pubkey . $errorpart . '"></script>

        <noscript>
            <iframe src="'. $server . '/noscript?k=' . $pubkey . $errorpart . '" height="300" width="500" frameborder="0"></iframe><br/>
            <textarea name="recaptcha_challenge_field" rows="3" cols="40"></textarea>
            <input type="hidden" name="recaptcha_response_field" value="manual_challenge"/>
        </noscript>';
    }
    /**
     * Calls an HTTP POST function to verify if the user's guess was correct
     * @param string $privkey
     * @param string $remoteip
     * @param string $challenge
     * @param string $response
     * @param array $extra_params an array of extra variables to post to the server
     * @return ReCaptchaResponse
     */
    function recaptcha_check_answer ($privkey, $remoteip, $challenge, $response, $extra_params = array())
    {
        if ( $privkey == null || $privkey == '' ) {
            die ("To use reCAPTCHA you must get an API key from
                <a href='http://recaptcha.net/api/getkey'>http://recaptcha.net/api/getkey</a>");
        }

        if ( $remoteip == null || $remoteip == '' ) {
            die ("For security reasons, you must pass the remote ip to reCAPTCHA");
        }

        //discard spam submissions
        if ( $challenge == null || strlen($challenge) == 0
                || $response == null || strlen($response) == 0) {
            $recaptcha_response = new ReCaptchaResponse();
            $recaptcha_response->is_valid = false;
            $recaptcha_response->error = 'incorrect-captcha-sol';
            return $recaptcha_response;
        }
        $response = self::_recaptcha_http_post (RECAPTCHA_VERIFY_SERVER, "/verify",
            array ( 'privatekey' => $privkey,
                    'remoteip' => $remoteip,
                    'challenge' => $challenge,
                    'response' => $response ) + $extra_params
            );

        $answers = explode ("\n", $response [1]);
        $recaptcha_response = new ReCaptchaResponse();

        if (trim ($answers [0]) == 'true') {
            $recaptcha_response->is_valid = true;
        } else {
            $recaptcha_response->is_valid = false;
            $recaptcha_response->error = $answers [1];
        }
        return $recaptcha_response;
    }
    function _recaptcha_http_post($host, $path, $data, $port = 80) {

        $req = self::_recaptcha_qsencode ($data);

        $http_request  = "POST $path HTTP/1.0\r\n";
        $http_request .= "Host: $host\r\n";
        $http_request .= "Content-Type: application/x-www-form-urlencoded;\r\n";
        $http_request .= "Content-Length: " . strlen($req) . "\r\n";
        $http_request .= "User-Agent: reCAPTCHA/PHP\r\n";
        $http_request .= "\r\n";
        $http_request .= $req;

        $response = '';
        if ( false == ( $fs = @fsockopen($host, $port, $errno, $errstr, 10) ) ) {
            die ('Could not open socket');
        }

        fwrite($fs, $http_request);

        while ( !feof($fs) ) {
            $response .= fgets($fs, 1160); // One TCP-IP packet
        }
        fclose($fs);
        $response = explode("\r\n\r\n", $response, 2);

        return $response;
    }
    /**
     * Encodes the given data into a query string format
     * @param $data - array of string elements to be encoded
     * @return string - encoded request
     */
    function _recaptcha_qsencode ($data) {
        $req = "";
        foreach ( $data as $key => $value )
        $req .= $key . '=' . urlencode( stripslashes($value) ) . '&';

        // Cut the last '&'
        $req=substr($req, 0, strlen($req) - 1);
        return $req;
    }
}
/**
 * A ReCaptchaResponse is returned from recaptcha_check_answer()
 */
class ReCaptchaResponse {
    var $is_valid;
    var $error;
}
?>