<?php
/*
/**
* CHRONOFORMS version 3.1 
* Copyright (c) 2008 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
You are not allowed to copy or use or rebrand or sell any code at this page under your own name or any other identity!
* See readme.html.
* Visit http://www.ChronoEngine.com for regular update and information.
**/

/* ensuring that this file is called up from another file */
defined('_JEXEC') or die('Restricted access');
require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );
$mainframe =& JFactory::getApplication('site');
$mainframe->initialise();

class HTML_ChronoContact {
// Procedure for building the table
function showform( $row, $posted ) {
 	global $mainframe;
	$database =& JFactory::getDBO();
	$MyForm =& CFChronoForm::getInstance($row->name);
	$CF_PATH = ($mainframe->isSite()) ? JURI::Base() : $mainframe->getSiteURL();
	if((!empty($MyForm->formrow->name))&&($MyForm->formrow->published)){
		?>
		<?php if (($MyForm->formparams('LoadFiles') == 'Yes')||( trim($MyForm->formparams('validate')) == 'Yes')||($MyForm->formparams('captcha_dataload'))){ ?>	
			<?php JHTML::_('behavior.mootools'); ?>
        <?php } ?>
        <?php ob_start(); ?>
        
        <?php if ($MyForm->formparams('LoadFiles') == 'Yes'){ ?>        	
			<?php if((!trim($MyForm->formrow->theme))||(trim($MyForm->formrow->theme) == 'default')){ ?>
                <!--[if gte IE 6]><link href="<?php echo $CF_PATH.'components/com_chronocontact/themes/default/css/'; ?>style1-ie6.css" rel="stylesheet" type="text/css" /><![endif]-->
                <!--[if gte IE 7]><link href="<?php echo $CF_PATH.'components/com_chronocontact/themes/default/css/'; ?>style1-ie7.css" rel="stylesheet" type="text/css" /><![endif]-->
                <!--[if !IE]> <--><link href="<?php echo $CF_PATH.'components/com_chronocontact/themes/default/css/'; ?>style1.css" rel="stylesheet" type="text/css" /><!--> <![endif]-->
            <?php
            }else{
                $directory = JPATH_SITE.'/components/com_chronocontact/themes/'.trim($MyForm->formrow->theme).'/css/';
                $results = array();
                $handler = opendir($directory);
                while ($file = readdir($handler)) {
                    if ( $file != '.' && $file != '..')
                        $results[] = $file;
                }
                closedir($handler);
                $counter = 0;
                foreach($results as $result){				
                ?>	
                    <link href="<?php echo $CF_PATH.'components/com_chronocontact/themes/'.trim($MyForm->formrow->theme).'/css/'.$result; ?>" rel="stylesheet" type="text/css" />
                <?php
                //$counter++;
                }
            }
            ?>
            <link rel="stylesheet" href="<?php echo $CF_PATH; ?>components/com_chronocontact/css/calendar2.css" type="text/css" />
            <link href="<?php echo $CF_PATH.'components/com_chronocontact/css/'; ?>tooltip.css" rel="stylesheet" type="text/css" />
            <script type="text/javascript" src="<?php echo $CF_PATH; ?>components/com_chronocontact/js/calendar2.js"></script>
            <script src="<?php echo $CF_PATH.'components/com_chronocontact/js/'; ?>livevalidation_standalone.js" type="text/javascript"></script>
            <link href="<?php echo $CF_PATH.'components/com_chronocontact/css/'; ?>consolidated_common.css" rel="stylesheet" type="text/css" />
            <?php			
				include_once(JPATH_SITE.DS.'components'.DS.'com_chronocontact'.DS.'libraries'.DS.'includes'.DS.'JSCustomClasses.php');
            ?>
		<?php } ?>	
		<style type="text/css">
			span.cf_alert {
				background:#FFD5D5 url(<?php echo $CF_PATH.'components/com_chronocontact/css/'; ?>images/alert.png) no-repeat scroll 10px 50%;
				border:1px solid #FFACAD;
				color:#CF3738;
				display:block;
				margin:15px 0pt;
				padding:8px 10px 8px 36px;
			}
		</style>	
		<?php
			if (($posted)&&($MyForm->formparams('captcha_dataload'))){
				include_once(JPATH_SITE.DS.'components'.DS.'com_chronocontact'.DS.'libraries'.DS.'includes'.DS.'JSrepublish.php');
			}
		?>
		<?php if( trim($MyForm->formparams('validate')) == 'Yes'){ ?>	
				<script src="<?php echo $CF_PATH.'components/com_chronocontact/js/'; ?>livevalidation_standalone.js" type="text/javascript"></script>
				<link href="<?php echo $CF_PATH.'components/com_chronocontact/css/'; ?>consolidated_common.css" rel="stylesheet" type="text/css" />
                <?php include_once(JPATH_SITE.DS.'components'.DS.'com_chronocontact'.DS.'libraries'.DS.'includes'.DS.'JSvalidation.php'); ?>
        <?php }  ?>
		
		<?php if(!empty($MyForm->formrow->scriptcode)){ 
			echo "<script type='text/javascript'>\n";
			echo "//<![CDATA[\n";
			eval("?>".$MyForm->formrow->scriptcode);
			echo "//]]>\n";
			echo "</script>\n";				
		}		
		?>
        <?php $header_code = ob_get_clean(); ?>
        <?php
			$document =& JFactory::getDocument();
			$document->addCustomTag($header_code);
		?>
		<?php 
			$actionurl = $MyForm->getAction($MyForm->formrow->name);		
		?>
		<?php
			$session =& JFactory::getSession();
		?>
		<?php if($MyForm->formerrors){ ?>
            <span class="cf_alert"><?php echo '<ol>'.$MyForm->formerrors.'</ol>'; ?></span>
		<?php } ?>
<form name="<?php echo ($MyForm->formname) ? $MyForm->formname : "ChronoContact_".$MyForm->formrow->name; ?>" id="<?php echo "ChronoContact_".$MyForm->formrow->name; ?>" method="<?php echo $MyForm->formparams('formmethod'); ?>"<?php if($MyForm->formparams('uploads') == 'Yes'){ echo ' enctype="multipart/form-data"'; } ?> action="<?php echo $actionurl; ?>" <?php echo $MyForm->formrow->attformtag; ?>>
		
				<?php 
					
					//$html_string = $MyForm->formrow->html;
					/******************** ONLOAD plugins **********************/
					/*
					$ava_plugins = explode(",",$MyForm->formparams('plugins'));
					foreach($ava_plugins as $ava_plugin){
						$query     = "SELECT * FROM #__chrono_contact_plugins WHERE form_id='".$MyForm->formrow->id."' AND (event='ONLOAD' OR event='ONLOADONSUBMIT') AND name='".$ava_plugin."'";
						$database->setQuery( $query );
						$plugins = $database->loadObjectList();
						if(count($plugins)){
							require_once(JPATH_SITE."/components/com_chronocontact/plugins/".$ava_plugin.".php");
							${$ava_plugin} = new $ava_plugin();
							$registry2 = new JRegistry();
							$registry2->loadINI( $plugins[0]->params );
							$params = $registry2->toObject( );
							${$ava_plugin}->onload( 'com_chronocontact', $plugins[0], $params, $html_string );
							
						}
					}		
					*/			
					/**********************************************************/	
					//$MyForm->formrow->html = $html_string;
					$imver = "";					
					if ( trim($MyForm->formparams('imagever')) == 'Yes' ) {
						$imver = '<input name="chrono_verification" style="vertical-align:top;" type="text" id="chrono_verification" value="">
							&nbsp;&nbsp;<img src="'.$CF_PATH
							.'components/com_chronocontact/chrono_verification.php?imtype='.$MyForm->formparams('imtype').'">';
					}
					$MyForm->formrow->html = str_replace('{imageverification}',$imver,$MyForm->formrow->html);
					eval( "?>".$MyForm->formrow->html );
				?>
		<?php echo JHTML::_( 'form.token' ); ?>	
        <?php if($MyForm->pagetype != 'chronocontact'){ ?>
        	<input type="hidden" name="cfreturnurl" value="<?php echo $MyForm->selfURL(); ?>" />
        <?php }	?>
</form>

		<?php if( (trim($MyForm->formparams('validate')) == 'Yes')||($MyForm->formparams('LoadFiles') == 'Yes')){ ?>			
        <?php include_once(JPATH_SITE.DS.'components'.DS.'com_chronocontact'.DS.'libraries'.DS.'includes'.DS.'JSvalidation2.php'); ?>
		<?php } ?>
<!-- You are not allowed to remove or edit the following 3 lines anyway if you didnt buy a license --> 
<div class="chronoform">
<a href="http://www.chronoengine.com">Joomla Professional Work</a>
</div>
<!-- You are not allowed to remove or edit the above 3 lines anyway if you didnt buy a license -->
		<?php
		} else {
		echo "There is no form with this name or may be the form is unpublished, Please check the form and the url and the form management";
		}
	}
	function selfURL() {
		/*$s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
		$protocol = HTML_ChronoContact::strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s;
		$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
		return $protocol."://".$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI'];*/
		$uri =& JURI::getInstance();
		$inbetween = '';
		if($uri->getQuery())$inbetween = '?';
		return $uri->current().$inbetween.$uri->getQuery();
	}
	
	/*function strleft($s1, $s2) {
		return substr($s1, 0, strpos($s1, $s2));
	}*/
}
?>
