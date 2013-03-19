<?php
/**
 * Localization file for Some plugin
 * @version 0.1.0
 * @author Your Name
 * @copyright Copyright (c) 2008-2013
 * @license Distributed under BSD License.
 */

defined('COT_CODE') or die('Wrong URL');

$L['plu_title'] = 'Some plugin';
$L['info_desc'] ='This plugin provides addition functions to Cotonti CMS';

$L['cfg_auto_insert'] = array('Widget code insertion type');
$L['cfg_auto_insert_params'] = array('Manual by editing TPL tags','Automatic');

$L['cfg_load_type'] = array('Loads library ');
$L['cfg_load_type_params'] = array('Only on pages, news, forums','On all pages of site');

$L['cfg_cdn_use'] = array('Source to load share.js lib (43kb)');
$L['cfg_cdn_use_params'] = array('this site','from Yandex CDN');

$L['cfg_default_lang'] = array('Language of widget if not fit users default');
$L['cfg_default_lang_params'] = array('English','Russian','Belorusian','Ukrainian','Kazahstan','Tatarstan');

$L['cfg_force_lang'] = array('Force default language for widget (always use default)');
$L['cfg_force_lang_params'] = array($L['Yes'], $L['No']);

$L['cfg_block_type'] = array('Widget view type');
$L['cfg_block_type_params'] = array('button','link','icon','without pop-up block');

$L['cfg_sample_block'] = array('«Share» widget sample');
$L['cfg_code_block'] = array('Code for widget','This code included here as sample.
	It would be inserted on pages automatically if you use <strong>{SOCIAL_SHARE}</strong>
	or <strong>{PHP.social_share}</strong> tag in your templates.');

if (defined('SOCIAL_SHARE_CONF')){

	$linkslist = array();
	foreach ($socs_service_data as $scode=>$sdata) {
		if ($sevice_names[$scode]) $socs_service_data[$scode]['name'] = $sevice_names[$scode];
		$L['cfg_services_params'][] = $socs_service_data[$scode]['name'];
		$linkslist[] = cot_rc_link($socs_service_data[$scode]['link'],$socs_service_data[$scode]['name'],array('target'=>'_new'));
			}

	$L['cfg_services'] = array('Used social services',$sevice_list,
					'<br />Click on name to toggle item in list: ',
					'Cleared selected');

	$adminhelp = '<p>This extension allow you to add «social share» block on pages of your site.
	With this block users can easy share pages with their favorite services like twitter or facebook.</p>
	<p>For getting «share» widget on pages add <strong>{SOCIAL_SHARE}</strong> tag to tpl files.
	This widget works in these TPLs: pages (page.tpl), news (news.tpl), forum topics (forum.posts.tpl), index page (index.tpl)
	or any other page with <strong>{PHP.social_share}</strong> tag (and load type «all pages» in config).
	</p>
	<p>Widget style and number of used social services you can configure in Extension configuration page.</p>
	<br /><p>Supported services are (click to open in new page): '.implode(', ',$linkslist).'</p>';

	$L['ss_checkall'] = 'clear/select all';

}

