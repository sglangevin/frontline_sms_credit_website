<?php
/**
 * @package		My Blog
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

class MYOptionSetup
{
	var $data;
	var $current;

	function create()
	{
		$this->current = 0;
		$this->data = array();
	}

	function add($data)
	{
		$this->data[$this->current][] = $data;
	}

	function add_section($title, $desc='')
	{
	    $this->current++;
		$this->data[$this->current][0] = array('title' => $title, 'desc' => $desc);
	}

	// Generate and return the options
	function get_html()
	{
		$cfgcount	= 0;
		$i        = 1;
		$html     = '<table width="100%" cellpadding="4" cellspacing="4"><tr><td>';
		
		// Draw the anchor at the top
		$html .= '<span style="font-size:110%" >';
        foreach ($this->data as $cfg)
		{
        	$html .= '<a href="#' . strtolower(str_replace(" ","_",$cfg[0]['title'])) . '">' . $cfg[0]['title'] . '</a>';
        
			if($i != count($this->data))
			{
        	    $html .= '&nbsp;|&nbsp;';
			}
        	$i++;
        }
        $html .= '</span>';
        $html .= '</td></tr></table>';
        
        
		$html .= '<table width="100%" border="0" cellspacing="0" cellpadding="4" class="mytable cfgdesc">';
		foreach($this->data  as $cfg)
		{
		    $anchor = strtolower(str_replace(" ","_",$cfg[0]['title']));
			$html .= '<th colspan="3"><a name="' . $anchor .'"></a>'.$cfg[0]['title'].'</th>';
			for($i = 1; $i < count($cfg); $i++)
			{
				$text = "";
				$trclass = ($i & 1) ? ' class="row1" ': '';
				$html .= '<tr '.$trclass.'><td class="leftalign" style="vertical-align:top;" width="10%" valign="top">';
				
				$onclick = isset($cfg[$i]['onclick']) ? ' onclick="'.$cfg[$i]['onclick'].'" ' : '';
				
				switch($cfg[$i]['type'])
				{
					case 'checkbox':
						$html.= '<input '.$onclick.'class="cfgdesc" type="checkbox" name="'.$cfg[$i]['name'].'" value="1" id="'.$cfg[$i]['name'].'" ';

						if($cfg[$i]['value'])
							$html.= ' checked="checked" ';

						$html.= '/>';
						break;

					case 'text':

						$text.= '<div style="clear:both;"></div><div><input '.$onclick.'type="text" value="'.$cfg[$i]['value'].'" name="'.$cfg[$i]['name'].'" id="'.$cfg[$i]['name'].'" class="inputbox"';

						$text .= isset($cfg[$i]['size']) ? ' size="'.$cfg[$i]['size'].'" ' : '';
						$text .= isset($cfg[$i]['maxlength']) ? ' maxlength="'.$cfg[$i]['maxlength'].'" ' : '';

						$text .= '/></div>';

						break;

					case 'textarea':
						$text.= '<div style="clear:both;"></div><div><textarea '.$onclick.'name="'.$cfg[$i]['name'].'" id="'.$cfg[$i]['name'].'" ';

						$text .= isset($cfg[$i]['cols']) ? ' cols="'.$cfg[$i]['cols'].'" ' : '';
						$text .= isset($cfg[$i]['rows']) ? ' rows="'.$cfg[$i]['rows'].'" ' : '';

						$text .= '>'.stripslashes($cfg[$i]['value']).'</textarea></div>';
						break;
					case 'select':
					    if(is_array($cfg[$i]['value'])){
						    $text   .= '<div style="clear:both"></div>'
									.  '<div>'
						            .  '	<select name="' . $cfg[$i]['name'] . '" id="' . $cfg[$i]['name'] . '" class="inputbox"';
							$text   .= ($cfg[$i]['size'] > 1) ? ' multiple="multiple"': '';
							$text   .= ' size="' . $cfg[$i]['size'] . '">';

							foreach($cfg[$i]['value'] as $key => $val){
							    if(is_array($cfg[$i]['selected'])){
							        #Multiple selected values
							        if(in_array($key,$cfg[$i]['selected'])){
										$text   .= '<option value="' . $key .'" selected="selected">' . $val . '</option>';
									}
									else{
									    $text   .= '<option value="' . $key .'">' . $val . '</option>';
									}
								}
								else{
								    #Single selected values
									if($key == $cfg[$i]['selected']){
									    $text   .= '<option value="' . $key .'" selected="selected">' . $val . '</option>';
									}
									else{
									    $text   .= '<option value="' . $key .'">' . $val . '</option>';
									}
								}
							}

							$text   .= '	</select>'
							        .  '</div>';
						}
						else{
						    $text   .= 'Need associative array input of values';
						}
					    break;
					    
					case 'radio':
						break;
					case 'custom':
					    $text   = '<div style="clear:both"></div>' . $cfg[$i]['value'];
					    break;
				}
				$html .= '</td><td width="80%">';
				$html .= '<label class="cfgdesc" for="'.$cfg[$i]['name'].'">'.$cfg[$i]['title'].'<label>'.$text.'<div class="cfgdesc" >'.$cfg[$i]['desc'].'</div>';
				$html .= '</td><td width="10%">&nbsp;</td></tr>';
			}
			$cfgcount ++;
		}
		$html .= '</table>';

		return $html;
	}
}
