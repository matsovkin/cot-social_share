<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=forums.posts.tags
Tags=forum.posts.tpl:{SOCIAL_SHARE}
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
	$code = share_widget_code($cfg['mainurl'].'/'.cot_url('forums', "m=posts&q=$q"),htmlspecialchars($rowt['ft_title']));
	if ($socs_cfg['auto_insert'] && (method_exists('XTemplate','hasTag') && !$t->hasTag('SOCIAL_SHARE'))) {
		// no way to auto insert
	} else {
		$t->assign('SOCIAL_SHARE',$code);
	}
}

