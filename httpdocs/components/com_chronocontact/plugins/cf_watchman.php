<?php
defined('_JEXEC') or die('Restricted access');
global $mainframe;
require_once( $mainframe->getPath( 'class', 'com_chronocontact' ) );


// the class name must be the same as the file name without the .php at the end
class cf_watchman
{
    //the next 3 fields must be defined for every plugin
    var $result_TITLE = "Watchman";
    var $result_TOOLTIP = "Open or close your form for different users, or different dates or times.";
    var $plugin_name = "cf_watchman"; // must be the same as the class name
    var $event = "ONLOAD"; // must be defined and in Uppercase, should be ONSUBMIT, ONLOAD or ONLOADONSUBMIT
    // the next function must exist and will have the backend config code

    function show_conf($row, $id, $form_id, $option)
    {
        global $mainframe;

        require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'plugin.php');
        $helper = new ChronoContactHelperPlugin();
        $doc =& JFactory::getDocument();

        // identify and initialise the parameters used in this plugin
        $params_array = array(
        	'redirect_url' => 'index.php',
        	'gid' => '29',
        	'redirect_message_users' => '',
            'open' => '',
            'redirect_message_open' => '',
            'close' => '',
            'redirect_message_close' => '',
            'days' => '1|2|3|4|5|6|0',
            'redirect_message_days' => '',
            'open_time' => '',
            'redirect_message_open_time' => '',
            'close_time' => '',
            'redirect_message_close_time' => '',
            'debug' => '0');

        $params = $helper->loadParams($row, $params_array);

        $style = "";
        if ( $params->get('debug') ) {
            $style .= "div.cf_debug {border:1px solid red; padding:6px; margin-bottom:6px;}";
        }
        $doc->addScript(JURI::base().'components/com_chronocontact/assets/timespinner/timespinner.js');
        $doc->addStylesheet(JURI::base().'components/com_chronocontact/assets/timespinner/timespinner.css');

        $style .= "
        form .cf_header {
        	text-align:left;
        	font-weight:bold;
        	color:blue;
        	border:1px solid silver;
        	padding:6px;
        	padding-left:30px;
    	}";
        $doc->addStyleDeclaration($style);
        jimport('joomla.html.pane');
        $pane   =& JPane::getInstance('tabs');
?>
<form action="index2.php" method="post" name="adminForm" id="adminForm"
        class="adminForm">
<?php
    echo $pane->startPane("cf_watchman");
    echo $pane->startPanel( 'General', 'general' );
?>
    <table border="0" cellpadding="3" cellspacing="0" style='width:400px;'>
        <tr>
            <td colspan='4' class='cf_header' >General settings</td>
        </tr>
        <tr style="background-color: #c9c9c9">
<?php
        $tooltip = "Enter the url for the page you want to redirect to if the form is not available. Default is `index.php`?";
        echo $helper->createInputTD("Redirect url",
            'params[redirect_url]', $params->get('redirect_url'),
            '', '', $tooltip);
?>
        </tr>
        <tr>
            <td colspan='4' class='cf_header' >Plugin debug</td>
        </tr>
        <tr style="background-color: #c9c9c9">
<?php
        $tooltip = "If you set debug to Yes the form will display debug messages instead of re-directing.";
        echo $helper->createYesNoTD("PlugIn debug",
            'params[debug]', '', $params->get('debug'), '', $tooltip);
?>
        </tr>
    </table>
<?php
    echo $pane->endPanel();

    echo $pane->startPanel( 'Users', 'users' );
?>
    <table border="0" cellpadding="3" cellspacing="0" style='width:400px;'>
        <tr>
            <td colspan='4' class='cf_header' >Watch user groups</td>
        </tr>
        <tr style="background-color: #c9c9c9">
<?php
        $acl =& JFactory::getACL();
        $gtree = $acl->get_group_children_tree( null, 'USERS', false );
        $tooltip = "Select the groups who can access this form";
        echo $helper->createSelectTD('Groups with access',
            'params[gid][]', $gtree, $params->get('gid'),
           	'size="10" multiple="multiple"', $tooltip );
?>
        </tr>
        <tr style="background-color: #c9c9c9">
<?php
        $tooltip = "Enter a message to show after redirection. if you leave this blank, redirection will be silent.";
        echo $helper->createInputTD("Redirect message",
            'params[redirect_message_users]',
            $params->get('redirect_message_users'), '', '', $tooltip);
?>
        </tr>
    </table>
<?php
    echo $pane->endPanel();
    echo $pane->startPanel( 'Dates and Times', 'date_time' );
?>
    <table border="0" cellpadding="3" cellspacing="0" style='width:400px;'>
        <tr>
            <td colspan='4' class='cf_header' >Watch opening and closing dates</td>
        </tr>
        <tr style="background-color: #c9c9c9">
<?php
        $tooltip = "Select the date when the form opens. Leave blank for always open";
        $config = array('showsTime' => "true");
        echo $helper->createDateTD(
        	'Open date and time', 'params[open]',
            $params->get('open'), '', $tooltip, '', '', $config );
        ?>
        </tr>
        <tr style="background-color: #c9c9c9">
<?php
        $tooltip = "Enter a message to show after redirection. if you leave this blank, redirection will be silent.";
        echo $helper->createInputTD("Redirect message",
            'params[redirect_message_open]',
            $params->get('redirect_message_open'), '', '', $tooltip);
?>
        </tr>
        <tr style="background-color: #c9c9c9">
<?php
        $tooltip = "Select the date when the form closes. Leave blank for always open";
        echo $helper->createDateTD(
            'Close date and time', 'params[close]', $params->get('close'),
            '', $tooltip);
?>
        </tr>
        <tr style="background-color: #c9c9c9">
<?php
        $tooltip = "Enter a message to show after redirection. if you leave this blank, redirection will be silent.";
        echo $helper->createInputTD("Redirect message",
            'params[redirect_message_close]',
            $params->get('redirect_message_close'), '', '', $tooltip);
?>
        </tr>
        <tr>
            <td colspan='4' class='cf_header' >Watch days of the week</td>
        </tr>
        <tr style="background-color: #c9c9c9">
<?php
        $tooltip = "Select the days of the week that you want the form open.";
        $days_array = array('1' => 'MONDAY', '2' => 'TUESDAY',
        	'3' => 'WEDNESDAY', '4' => 'THURSDAY', '5' => 'FRIDAY',
        	'6' => 'SATURDAY', '0' => 'SUNDAY' );
        foreach ( $days_array as $k => $day ) {
            $days_array[$k] = JHTML::_('select.option', $k, JText::_($day));
        }
        echo $helper->createSelectTD('Open days',
            'params[days][]', $days_array,
            $params->get('days'), 'size="7" multiple="multiple"', $tooltip );
?>
        </tr>
        <tr style="background-color: #c9c9c9">
<?php
        $tooltip = "Enter a message to show after redirection. if you leave this blank, redirection will be silent.";
        echo $helper->createInputTD("Redirect message",
            'params[redirect_message_days]', $params->get('redirect_message_days'), '', '', $tooltip);
?>
        </tr>
        <tr>
            <td colspan='4' class='cf_header' >Watch opening and closing times</td>
        </tr>
        <tr style="background-color: #c9c9c9">
<?php
        $tooltip = "Select the time of day that you want the form to open.";
        echo $helper->createTimeTD(
        	'Opening time', 'params[open_time]',
            $params->get('open_time'),
        	'', $tooltip, 'open_time' );
?>
        </tr>
        <tr style="background-color: #c9c9c9">
<?php
        $tooltip = "Enter a message to show after redirection. if you leave this blank, redirection will be silent.";
        echo $helper->createInputTD("Redirect message",
            'params[redirect_message_open_time]',
            $params->get('redirect_message_open_time'), '', '', $tooltip);
?>
        </tr>
        <tr style="background-color: #c9c9c9">
<?php
        $tooltip = "Select the time of day that you want the form to close.";
        echo $helper->createTimeTD(
            'Closing time', 'params[close_time]',
            $params->get('close_time'),
            '', $tooltip, 'close_time' );
?>
        </tr>
        <tr style="background-color: #c9c9c9">
<?php
        $tooltip = "Enter a message to show after redirection. if you leave this blank, redirection will be silent.";
        echo $helper->createInputTD("Redirect message",
            'params[redirect_message_close_time]',
            $params->get('redirect_message_close_time'), '', '', $tooltip);
?>
        </tr>
    </table>
 <?php
    echo $pane->endPanel();
    echo $pane->startPanel( 'Help', 'help' );
?>
    <table border="0" cellpadding="3" cellspacing="0" style='width:400px;'>
        <thead>
            <tr>
                <th colspan='4' class='cf_header' >Configure Watchman Plugin</th>
            </tr>
        </thead>
        <tr>
            <td colspan='4' style='border:1px solid silver; padding:6px;'>
            <div>The plugin will redirect users away form your form unless the
            conditions set here are met.</div>
            <ul><li>You can select user groups; opening and closing dates (and times); days of the week;
            and daily opening and closing times. So, for example, you could set the
            form to be visible to registered users only from 08:00 on 31 Mar 09 to 19:00 on 14 Apr 2009;
            or to be visible only on Tuesdays and Thursdays between 12:00 and 15:00.</li>
            <li>The tests run in the order they are here, and the user will be redirected
            on the first 'failure'.</li>
            <li>If you leave the Redirect url blank users will redirect to the site
            home page.</li>
            <li>If you enter a Redirect message this will be displayed as a system message
            after the redirection (please check that your template shows system messages).
            If you leave the Redirect message empty the redirection will be 'invisible' as though
            the form was not there.</li>
            <li>Once this plugin is configured you must enable it in the Form 'Plugins'' tab.</li>
            </ul>
            </td>
        </tr>
    </table>
<?php
    echo $pane->endPanel();
    echo $pane->endPane();

    $hidden_array = array (
        'id' => $id,
        'form_id' => $form_id,
        'name' => $this->plugin_name,
        'event' => $this->event,
        'option' => $option,
        'task' => 'save_conf');
    echo $helper->createHiddenArray( $hidden_array );
?>
</form>
<?php
    }

    function onload( $option, $row, $params, $html_string )
    {
        global $mainframe;
        $user =& JFactory::getUser();
        if ( $params->get('debug') ) {
            $style = "div.cf_debug {border:1px solid red; padding:6px;}";
            $doc =& JFactory::getDocument();
            $doc->addStyleDeclaration($style);
        }
        $redirected = false;
        if ( $params->get('debug') ) {
            echo "<div class='cf_debug' ><strong>Debug information</strong></div>
            	<div class='cf_debug' >Params: ".print_r($params, true)."</div>";
        }

        if ( !$params->get('redirect_url') ) {
            $params->set('redirect_url', 'index.php');
        }
        // Check user groups
        if (!is_array($params->get('gid')) ) {
            $params->set('gid', array($params->get('gid')));
        }
        if ( !in_array($user->gid, $params->get('gid'))
                && !($user->guest && in_array('29', $params->get('gid'))) ) {
            if ( $user->guest ) {
                $gid = 'user: guest';
            } else {
                $gid = 'user: '.$user->gid;
            }
            $redirected = self::redirect('users', $params, 'User groups ('.implode(', ', $params->get('gid')).' ['.$gid.'])');
        }
        // Check opening date & time
        if ( $params->get('open') && strtotime($params->get('open')) > time() ) {
            $redirected = self::redirect('open', $params, 'Open date ('.$params->get('open').')');
        }
        // Check closing date & time
        if ( $params->get('close') && strtotime($params->get('close')) < time() ) {
            $redirected = self::redirect('close', $params, 'Close date ('.$params->get('close').')');
        }
        // Check day of the week
        echo 'date("w"): '.print_r(date("w"), true ).'</div>';
        if ( $params->get('days') && !in_array( date('w'), $params->get('days')) ) {
            $redirected = self::redirect('days', $params, 'Days of the week ('.implode(', ', $params->get('days')).') '.date('w').'');
        }
        // Check opening time
        $open_minutes  = self::getMinutes($params->get('open_time'));
        $close_minutes = self::getMinutes($params->get('close_time'));
        $now_minutes   = self::getMinutes(date('H:i'));
        if ( $open_minutes != 0 && $now_minutes < $open_minutes ) {
            $redirected = self::redirect('open_time', $params, 'Daily open('.$params->get('open_time').')');
        }
        if ( $close_minutes != 0 && $now_minutes > $close_minutes ) {
            $redirected = self::redirect('close_time', $params, 'Daily open('.$params->get('close_time').')');
        }
        // show debug 'no redirection message'
        if ( $params->get('debug') && !$redirected ) {
            echo "<div class='cf_debug' >No redirection - form is available.</div>";
        }

        return $html_string;
	}
	function redirect($label, $params, $type='' )
	{
		global $mainframe;
        $redirect = "";
        if ( $params->get($label) ) {
            $redirect = "redirect_message_$label";
            $redirect = $params->get($redirect);
        }
        if ( !$params->get('debug') ) {
            $mainframe->redirect( $params->get('redirect_url'), $redirect);
            return false;
        } else {
            echo "<div class='cf_debug' >$type<br />Redirecting Now !!!! to $params->get('redirect_url') with message: ".$redirect." </div>";
            return true;
        }
	}
	function getMinutes($time)
	{
	    $time_array = explode(':', $time);
	    if ( !isset($time_array[1]) ) {
	        $time_array[1] = 0;
	    }
	    return $time_array[0] * 60 + $time_array[1];
	}
    // this function must exist and may not be changed unless you need to customize something
    function save_conf( $option )
    {
        require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'plugin.php');
        $helper = new ChronoContactHelperPlugin();
        $helper->save_conf($option);
    }
}
?>