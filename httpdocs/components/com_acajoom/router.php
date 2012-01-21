<?php
defined('_JEXEC') OR defined('_VALID_MOS') OR die('...Direct Access to this location is not allowed...');

function AcajoomBuildRoute( &$query )
{
	$segments = array();

	if (isset($query['act'])) {
		$segments[] = $query['act'];
		unset( $query['act'] );
	}
	if (isset($query['task'])) {
		$segments[] = $query['task'];
		unset( $query['task'] );
	}
	
	if(!empty($query)){
		foreach($query as $name => $value){
			if($name != 'option'){
				$segments[] = $name.':'.$value;
			}else{
				$newQuery[$name] = $value;
			}
		}
		$query = $newQuery;
	}

	return $segments;
}

function AcajoomParseRoute( $segments )
{
	$vars = array();

	if(!empty($segments)){
		$i = 0;
		foreach($segments as $name){
			if(strpos($name,':')){
				list($arg,$val) = explode(':',$name);
				$vars[$arg] = $val;
			}else{
				$i++;
				if($i == 1) $vars['act'] = $name;
				elseif($i == 2) $vars['task'] = $name;
			}
		}
	}

	return $vars;
}