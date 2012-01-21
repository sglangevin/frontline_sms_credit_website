<?php
/**
 * @version		$Id: view.html.php 538 2010-08-04 13:08:29Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');

class K2ViewExtraFieldsGroup extends JView
{

	function display($tpl = null) {
	
		JRequest::setVar('hidemainmenu', 1);
		$model = & $this->getModel();
		$extraFieldsGroup = $model->getExtraFieldsGroup();
		JFilterOutput::objectHTMLSafe( $extraFieldsGroup );
		$this->assignRef('row', $extraFieldsGroup);
		(JRequest::getInt('cid'))? $title = JText::_('Edit Extra Field Group') : $title = JText::_('Add Extra Field Group');
		JToolBarHelper::title($title, 'k2.png');
		JToolBarHelper::save();
		JToolBarHelper::apply();
		JToolBarHelper::cancel();
	
		parent::display($tpl);
	}

}
