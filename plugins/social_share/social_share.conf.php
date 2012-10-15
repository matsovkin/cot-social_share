<?PHP
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
 * @version 0.1.0
 * @author Andrey Matsovkin
 * @copyright Copyright (c) 2008-2012
 * @license Distributed under BSD License.
 */

defined('COT_CODE') or die('Wrong URL');

if (defined('SOCIAL_SHARE_CONF')) {
	if ($config_name === 'services')  // Part 1
	{ // while creating params config table
		// extending only COT_CONFIG_TYPE_TEXT parameters
		$config_variants = $socs_services;
		$config_type = 'checklistbox';
		if (sizeof($config_variants)) {
			// if no jQuery used - allow only «simplelist» type
			if (!$cfg['jquery'] && $config_type=='checklistbox') $config_type = 'simplelist';
			$config_values = array_unique(array_map('trim', explode(',',$config_value)));
			$config_variants_titles = cot_admin_config_get_titles($config_name, $config_variants);
			$def_attr = array('readonly'=>'readonly','id'=>$config_name);
			if (!$cfg['jquery']) $def_attr['onchange'] = 'update_widget();';
			switch ($config_type) {
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
			}
		}

	}
	elseif ($config_name === 'sample_block')
	{
		$config_input = '';//$config_input = '';
		$config_more = '<div class="sample_block" id="sample_block"></div>';
	}
	elseif ($config_name === 'code_block')
	{
		$config_input = cot_textarea($config_name, $config_value, 5, 40,array('disabled'=>'disabled'));
	}
	if ( $process_it ) {
		$t->assign(array(
						'ADMIN_CONFIG_ROW_CONFIG' => $config_input,
						'ADMIN_CONFIG_ROW_CONFIG_MORE' => $config_more
		));

	}

}

?>