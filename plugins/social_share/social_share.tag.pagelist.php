<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=page.list.loop
Tags=page.list.tpl:{SOCIAL_SHARE}
[END_COT_EXT]
==================== */

/**
 * Header file for Social share plugin
 *
 * @package social_share
 * @author Andrey Matsovkin
 * @copyright Copyright (c) 2008-2013
 * @license Distributed under BSD License.
 */

if (!defined('COT_CODE') && !defined('COT_PLUG')) { die('Wrong URL ('.array_pop(explode("\\",__FILE__)).').'); }

if (defined('SOCIAL_SHARE')) {
	$code = share_widget_code($cfg['mainurl'].'/'.$page_tags['URL'],$page_tags['SHORTTITLE']);
	if ($socs_cfg['auto_insert'] && !(method_exists('XTemplate','hasTag') && $t->hasTag('SOCIAL_SHARE'))) {
		$t->vars['LIST_ROW_TEXT'] .= $code;
	} else {
		$t->assign('SOCIAL_SHARE',$code);
	}
}

