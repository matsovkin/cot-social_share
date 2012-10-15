<?PHP
/* ====================
[BEGIN_COT_EXT]
Hooks=admin.config.edit.tags
[END_COT_EXT]
==================== */

/**
 * Social share extension admin settings JS include part
 *
 * @package social_share
 * @version 0.1.0
 * @author Andrey Matsovkin
 * @copyright Copyright (c) 2008-2012
 * @license Distributed under BSD License.
 */

defined('COT_CODE') or die('Wrong URL');

if (defined('SOCIAL_SHARE_CONF')) {
	if ($cfg['jquery']) cot_rc_link_footer($cfg['plugins_dir'].'/social_share/js/social_share.admin.js');
	else cot_rc_link_footer($cfg['plugins_dir'].'/social_share/js/social_share.admin.nojquery.js');
}

?>