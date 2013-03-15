<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=pagetags.main
[END_COT_EXT]
==================== */

/**
 * Get data from page tags for further use
 *
 * @package social_share
 * @author Andrey Matsovkin
 * @copyright Copyright (c) 2008-2013
 * @license Distributed under BSD License.
 */

if (!defined('COT_CODE') && !defined('COT_PLUG')) { die('Wrong URL ('.array_pop(explode("\\",__FILE__)).').'); }

if (defined('SOCIAL_SHARE')) {
	global $page_tags;
	$page_tags = array();
	$used_tags = array('URL','TITLE','SHORTTITLE');
	foreach ($used_tags as $key) {
		$page_tags[$key] = $temp_array[$key];
	}
}

