<?PHP
/* ====================
[BEGIN_COT_EXT]
Hooks=index.tags
Tags=index.tpl:{SOCIAL_SHARE}
[END_COT_EXT]
==================== */

/**
 * Header file for Social share plugin
 *
 * @package social_share
 * @author Andrey Matsovkin
 * @copyright Copyright (c) 2008-2012
 * @license Distributed under BSD License.
 */

if (!defined('COT_CODE') && !defined('COT_PLUG')) { die('Wrong URL ('.array_pop(explode("\\",__FILE__)).').'); }

if (defined('SOCIAL_SHARE')) {
	$code = share_widget_code($cfg['mainurl'],htmlspecialchars($cfg['maintitle'].'. '.$cfg['subtitle'],ENT_QUOTES));
	$t->assign('SOCIAL_SHARE',$code);
}

?>