<?php
/**
 * @version 1.5 stable $Id: separator.php 1904 2014-05-20 12:21:09Z ggppdk $
 * @package Joomla
 * @subpackage FLEXIcontent
 * @copyright (C) 2009 Emmanuel Danan - www.vistamedia.fr
 * @license GNU/GPL v2
 * 
 * FLEXIcontent is a derivative work of the excellent QuickFAQ component
 * @copyright (C) 2008 Christoph Lukes
 * see www.schlu.net for more information
 *
 * FLEXIcontent is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

jimport('cms.html.html');      // JHtml
jimport('joomla.form.helper'); // JFormHelper
JFormHelper::loadFieldClass('spacer');   // JFormFieldSpacer

/**
 * Renders the flexicontent 'separator' (header) element
 *
 * @package 	Joomla
 * @subpackage	FLEXIcontent
 * @since		1.5
 */
class JFormFieldSeparator extends JFormFieldSpacer
{
	/**
	 * Element name
	 * @access	protected
	 * @var		string
	 */
	var	$_name = 'separator';
		
	function add_css_js()
	{
		$css = "
		div.pane-sliders ul.adminformlist li select { margin-bottom: 0px;}
		div.pane-sliders ul.adminformlist li fieldset  { margin: 0; padding: 0; }
		
		div.current ul.config-option-list li .fcsep_level3 {
			left: 232px !important;
		}
		
		/*div.controls input, div.controls textarea { min-width: 56%; }*/

		*:not(.form-vertical) > div.control-group div.control-label,
		div.current ul.config-option-list li {
			margin: 0 !important;
			padding: 0 !important;
			max-width: 160px;
			min-width: 120px;
			width: 15%;
			border:0;
		}
		
		fieldset.form-vertical div.control-group {
			margin-bottom: 8px;
		}
		*:not(.form-vertical) > div.control-group div.control-label label.hasTooltip,
		div.current ul.config-option-list li label.hasTooltip {
			display:inline-block;
			
			border-bottom: 1px solid #E9E9E9;
			border-right: 1px solid #E9E9E9;
			color: white;
			border-radius: 3px;
			
			margin: 0px 4% 3px 0 !important;
			padding: 8px !important;
			background-color: #999;
			text-align: right;
			white-space: normal;
			font-weight: normal; 
			font-size: 12px;
			width: 96%;
			box-sizing: border-box;
		}
		
		/*div.current fieldset.radio label {
			min-width:10px!important; padding: 0px 16px 0px 0px!important; margin: 2px 0px 0px 1px!important;
		}
		div fieldset.adminform fieldset.radio label, div fieldset.panelform fieldset.radio label {
			min-width:10px!important; padding: 0px 10px 0px 0px!important; margin: 4px 0px 0px 1px!important;
		}*/
		
		/*div fieldset input, div fieldset textarea, div fieldset img, div fieldset button { margin:5px 2px 2px 0px; }*/
		div fieldset select { margin:0px; }
					
		div.current ul.config-option-list li select { margin-bottom: 0px; font-size:12px;}
		div.current ul.config-option-list li fieldset  { margin: 0; padding: 0; }
		
		.tool-tip { }
		.tip-title { }
		";
		
		$document = JFactory::getDocument();
		
		if (FLEXI_J30GE) $jinput = JFactory::getApplication()->input;
		$option = $jinput->get('option', '', 'cmd');
		$view   = $jinput->get('view', '', 'cmd');
		$controller = $jinput->get('controller', '', 'cmd');
		$component  = $jinput->get('component', '', 'cmd');
		
		if ($option!='com_flexicontent') $document->addStyleDeclaration($css);
		
		// NOTE: this is imported by main Frontend/Backend CSS file
		// so import these only if it is not a flexicontent view
		if ($option!='com_flexicontent') {
			$document->addStyleSheet(JURI::root(true).'/components/com_flexicontent/assets/css/flexi_form.css');  // NOTE: this is imported by main Frontend/Backend CSS file
			$document->addStyleSheet(JURI::root(true).'/components/com_flexicontent/assets/css/flexi_shared.css');  // NOTE: this is imported by main Frontend/Backend CSS file
			// Add flexicontent specific TABBing to non-flexicontent views
			$document->addStyleSheet(JURI::root(true).'/components/com_flexicontent/assets/css/tabber.css');
			$document->addScript(JURI::root(true).'/components/com_flexicontent/assets/js/tabber-minimized.js');
			$document->addScriptDeclaration(' document.write(\'<style type="text/css">.fctabber{display:none;}<\/style>\'); ');
		}
		
		require_once (JPATH_SITE.DS.'components'.DS.'com_flexicontent'.DS.'classes'.DS.'flexicontent.helper.php');
		FLEXI_J30GE ? JHtml::_('behavior.framework', true) : JHTML::_('behavior.mootools');
		flexicontent_html::loadJQuery();
		
		// Add js function to overload the joomla submitform validation
		JHTML::_('behavior.formvalidation');  // load default validation JS to make sure it is overriden
		$document->addScriptVersion(JURI::root(true).'/components/com_flexicontent/assets/js/admin.js', FLEXI_VHASH);
		$document->addScriptVersion(JURI::root(true).'/components/com_flexicontent/assets/js/validate.js', FLEXI_VHASH);
		$document->addStyleSheetVersion(JURI::base(true).'/components/com_flexicontent/assets/css/j3x.css', FLEXI_VHASH);
	}
	
	
	function getLabel() {
		return "";
	}
	
	function getInput()
	{
		static $js_css_added = null;
		if ($js_css_added===null) {
			$this->add_css_js();
			$js_css_added = true;
		}
		
		$node = & $this->element;
		$attributes = get_object_vars($node->attributes());
		$attributes = $attributes['@attributes'];
		
		$level = @$attributes['level'];
		$description = @$attributes['description'];
		$initial_tbl_hidden = @$attributes['initial_tbl_hidden'];
		$value = $this->element['default'];
		
		if (in_array($level, array('tblbreak','tabs_start','tab_open','tab_close','tabs_end')) ) return 'do no use type "'.$level.'" in J1.6+';
		
		static $tab_js_css_added = false;
		
		$class = $level ? 'fcsep_'.$level : '';
		$title = "";
		if ($_class = @$attributes['class']) {
			$class .= ' '.$_class;
		}
		$style = '';
		if ($_style = @$attributes['style']) {
			$style .= ' '.$_style;
		}
		if ($description) {
			$class .= FLEXI_J30GE ? " hasTooltip" : " hasTip";
			$title = flexicontent_html::getToolTip($value, $description, 1, 1);
		}
		
		$pad = '';
		if ($class) $pad .= ' ';
		else if ($level=='level0') $pad .= ' ';
		else if ($level=='level1') $pad .= ' &nbsp; ';
		else if ($level=='level2') $pad .= ' &nbsp; &nbsp; ';
		else if ($level=='level3') $pad .= '';
		return '<div style="'.$style.'" class="'.$class.'" title="'.$title.'" >'.$pad.JText::_($value).'</div><div class="fcclear clear"></div>';
	}
}
