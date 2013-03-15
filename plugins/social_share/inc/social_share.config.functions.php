<?php
defined('COT_CODE') or die('Wrong URL');
/**
 * Functions for handle checkbox lists
 *
 * @package Social share
 * @version 0.1.0
 * @author Andrey Matsovkin
 * @copyright Copyright (c) 2008-2013
 * @license Distributed under BSD License.
 */

if (!function_exists('extdev_simplelist'))
{
	$R['input_simplelist'] = '{$input_box}<br/><div id="sl_{$name}" style="display:none;"></div>
	<noscript>{$no_script_tip}</noscript>
	<script>
	document.getElementById("{$name}").setAttribute("readonly","readonly");
	document.getElementById("sl_{$name}").innerHTML = \'{$list_str}{$list}<br/>{$clear_str}{$clear_link}\';
	document.getElementById("sl_{$name}").style.display="";
	</script>';
	$R['input_simplelist_item'] = ' {$item}';
	$R['input_simplelist_delimiter'] = ',';

	/**
	 * Generates «simplelist» form input
	 * @param string $name Name of variable (List)
	 * @param array $values List of selected values
	 * @param array $variants List of all values
	 * @param array $titles List of titles for values
	 * @param mixed $attrs Additional attributes as an associative array or a string
	 * @param string $custom_rc Custom resource string name
	 * @return string
	 */
	function extdev_simplelist($name, $values, $variants, $titles=array(), $attrs='', $custom_rc = '')
	{
		global $R, $L, $cfg;
		$input_attrs = cot_rc_attr_string($attrs);
		$last = $variants[sizeof($variants)-1];
		$item_list = '';
		$rc_name = preg_match('#^(\w+)\[(.*?)\]$#', $name, $mt) ? $mt[1] : $name;
		$rc = empty($custom_rc)
		? (empty($R["input_simplelist_{$rc_name}"]) ? 'input_simplelist' : "input_simplelist_{$rc_name}")
		: $custom_rc;
		if (!isset($R[$rc.'_item']))
		{
			$R[$rc.'_item'] = $R['input_simplelist_item'];
		}
		if (!isset($R[$rc.'_delimiter']))
		{
			$R[$rc.'_delimiter'] = $R['input_simplelist_delimiter'];
		}
		foreach ($variants as $k => $item) {
			$item_attrs = "onclick=\"sl_toggle(\'$item\',\'$name\');return false;\"";
			if ($input_attrs) $item_attrs .= ' '.$input_attrs;
			$link = cot_rc_link("#$item", $titles[$k] ? $titles[$k] : $item , $item_attrs);
			$item_list .= cot_rc($rc.'_item',array('item'=>$link))
			.(($last!=$item) ? cot_rc($rc.'_delimiter') : '');
		}
		return cot_rc($rc,
						array(
										'name' => $name,
										'input_box' => //cot_inputbox('text', $name, implode(',',$values), array('id'=>$name)),
										cot_textarea($name, implode(',',$values), 1, 40,array('id'=>$name)),
										'list_str' => ($L['cfg_'.$name][2] ? $L['cfg_'.$name][2] : 'Select: '),
										'list' => $item_list,
										'clear_link' => cot_rc_link(
														'#_clear',
														$L['cfg_'.$name][3] ? $L['cfg_'.$name][3] : 'Clear list',
														array('onclick'=>"sl_clear(\'$name\');return false;")
										),
										'no_script_tip' => $L['cfg_'.$name][4] ? $L['cfg_'.$name][4] : '(Comma separated values)'
						)
		);
	}
}


if (!function_exists('extdev_checklistbox'))
{
	$R['input_checklistbox_item'] = '<li class="cb_item">{$item}</li>';
	$R['input_checklistbox'] = '<div id="cbl_{$name}" class="listblock items"></div>
	<noscript>{$input_box}{$no_script_tip}</noscript>
	<script>
	document.getElementById("cbl_{$name}").innerHTML = \'{$input_box}<ul id="ul_{$name}" style="list-style:none;">{$list}</ul>\';
	document.getElementById("{$name}").setAttribute("readonly","readonly");
	document.getElementById("{$name}").style.display="none";
	document.getElementById("cbl_{$name}").style.display="";
	</script>';

	function extdev_checklistbox($name,$values,$variants,$titles=array(),$attrs='',$custom_rc = '')
	{
		global $R, $L, $cfg, $version_number;
		$input_attrs = cot_rc_attr_string($attrs);
		$last = $variants[sizeof($variants)-1];
		$item_list = '';
		$rc_name = preg_match('#^(\w+)\[(.*?)\]$#', $name, $mt) ? $mt[1] : $name;
		$rc = empty($custom_rc)
		? (empty($R["input_checklistbox_{$rc_name}"]) ? 'input_checklistbox' : "input_checklistbox_{$rc_name}")
		: $custom_rc;
		if (!isset($R[$rc.'_item']))
		{
			$R[$rc.'_item'] = $R['input_checklistbox_item'];
		}
		if (!isset($R[$rc.'_block']))
		{
			$R[$rc.'_block'] = $R['input_checklistbox_block'];
		}
		$item_list = '';
		$item_attrs = cot_rc_attr_string(array('class'=>'ssi'));
		if ($input_attrs) $item_attrs .= ' '.$input_attrs;
		foreach ($variants as $k => $item) {
			// for Cotonti prior version 9.6
			if ($version_number && $version_number < 96) $R['input_checkbox_'.$item] = $R['input_checkbox'];
			$cb = cot_checkbox(in_array($item, $values), $item, '&nbsp;'.($titles[$k] ? $titles[$k] : $item), $item_attrs, $item);
			$item_list .= cot_rc($rc.'_item', array('item' => $cb));
		}
		return cot_rc($rc, array(
						'name' => $name,
						'list' => str_replace("'", "\'", $item_list),
						'input_box' => cot_inputbox('text', $name, implode(',',$values), array('id'=>$name)),
						'no_script_tip' => $L['cfg_'.$name][4] ? $L['cfg_'.$name][4] : '(Comma separated values)'
		)
		);
	}
}


