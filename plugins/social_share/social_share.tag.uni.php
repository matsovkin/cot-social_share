<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=header.tags
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

if (defined('SOCIAL_SHARE') && !defined('SOCIAL_SHARE_CONF')) {
	$social_share = social_share();
}

