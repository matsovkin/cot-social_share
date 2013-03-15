<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=admin.config.edit.loop
[END_COT_EXT]
==================== */

/**
 * Social share extension admin settings part
 * (used to set up checkboxlist in config menu)
 *
 * @package social_share
 * @author Andrey Matsovkin
 * @copyright Copyright (c) 2008-2013
 * @license Distributed under BSD License.
 */

defined('COT_CODE') or die('Wrong URL');

if (defined('SOCIAL_SHARE_CONF')) {

	if (in_array($config_name, $checklists_to_track))
	{
		$config_variants = array_map('trim',explode(',',$config_default));
		if ($config_name  === 'services')
		{ // special for SocSocial
			$config_variants = $socs_services;
		}


		$config_type = 'checklistbox';
		if (sizeof($config_variants)) {
			$config_values = array_unique(array_map('trim', explode(',',$config_value)));
			$config_variants_titles = cot_admin_config_get_titles($config_name, $config_variants);
			$def_attr = array('readonly'=>'readonly','id'=>$config_name);
			if (!$cfg['jquery'])
			{
				//$def_attr['onchange'] = 'update_widget();';
				$config_input = extdev_simplelist($config_name, $config_values, $config_variants, $config_variants_titles, $def_attr);
			} else {
				$tmp_checkbox = $R['input_checkbox'];
				$tmp_input = $R['input_text'];
				$R['input_checkbox'] = '<label><input type="checkbox" name="{$name}" value="{$value}"{$checked}{$attrs} /><i class="s_icon_{$name}"></i> {$title}</label>';
				$R['input_text'] = '<div class="all_cb"><label><input class="all_cb" type="checkbox" value="1" /> '.$L['ss_checkall'].'</label></div><input type="text" name="{$name}" value="{$value}" {$attrs} />';
				//$R['input_checklistbox_block'] = '<ul id="ul_{$name}" style="list-style:none;">{$list}</ul>';

				$config_input = extdev_checklistbox($config_name, $config_values, $config_variants, $config_variants_titles);
				$R['input_checkbox'] = $tmp;
				$R['input_text'] = $tmp_input;
			}


		}
/*			switch ($config_type) {
				case 'simplelist':
					$last = $config_variants[sizeof($config_variants)-1];
					$item_list = '';
					foreach ($config_variants as $k=>$item) {
						$config_title = $config_variants_titles[$k];
						$link = cot_rc_link("#$item",$config_title,
										array('onclick'=>"sl_toggle('$item','$config_name');return false;"));
						$item_list .= ($last==$item) ? cot_rc('ss_lastitem',array('item'=>$link)) :
						cot_rc('ss_listitem',array('item'=>$link));
					}
					$config_more .= cot_rc('ss_simplelist',array('info'=>($L['cfg_'.$config_name][2] ? $L['cfg_'.$config_name][2] : 'Select'),'list'=>$item_list ));
					$cl_link = cot_rc_link('#_clear',$L['cfg_'.$config_name][3],array('onclick'=>"sl_clear('$config_name');return false;"));
					$config_more .= cot_rc('ss_listclear',array('clear'=>$cl_link));
					$config_input = cot_inputbox('text', $config_name, $config_value,$def_attr);
					$process_it = true;
					break;
				case 'checklistbox':
					$socs_tpl->parse('CB_TPL');
					$cb_tpl = $socs_tpl->text('CB_TPL');
					foreach ($socs_service_data as $scode=>$sservice) {
						$it = array();
						$R['input_checkbox_'.$scode] = $cb_tpl; // for Cotonti prior version 9.6
						$cb = cot_checkbox(in_array($scode, $config_values), $scode, $sevice_names[$scode],array('class'=>'ssi'),$scode,$cb_tpl);
						$socs_tpl->assign('cb',$cb);
						$socs_tpl->parse('CB_LIST.BLOCK.ITEM');
					}
					$socs_tpl->parse('CB_LIST.BLOCK');
					$socs_tpl->parse('CB_LIST');

					//$def_attr['style'] ='display:none;';
					$config_input = cot_inputbox('text', $config_name, $config_value,$def_attr);
					$config_input .= $socs_tpl->text('CB_LIST');
					$process_it = true;
					break;
				default:
			}*/

	}
	elseif ($config_name === 'sample_block')
	{
		$config_input = '<div class="sample_block" id="sample_block"></div>';
	}
	elseif ($config_name === 'code_block')
	{
		$config_input = cot_textarea($config_name, $config_value, 5 ,120,array('disabled'=>'disabled'));
	}
	$t->assign(array(
				'ADMIN_CONFIG_ROW_CONFIG' => $config_input,
				'ADMIN_CONFIG_ROW_CONFIG_MORE' => $config_more
		));

}

