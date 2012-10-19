<?PHP
/* ====================
[BEGIN_COT_EXT]
Hooks=admin.config.edit.main
[END_COT_EXT]
==================== */

/**
 * Social share extension admin settings
 * Code for compatibility with old Cotonti Siena (prior to 0.9.10)
 *
 * @package social_share
 * @author Andrey Matsovkin
 * @copyright Copyright (c) 2008-2012
 * @license Distributed under BSD License.
 */

defined('COT_CODE') or die('Wrong URL');

if (defined('SOCIAL_SHARE_CONF')) {
	if (!function_exists('cot_admin_config_get_titles')) {
		/**
		 * Helper function that generates selection titles.
		 * (ripped from Cotonti 9.10 for backward compatibility)
		 * @param  string $config_name Current config name
		 * @param  array  $cfg_params  Array of config params
		 * @return array               Selection titles
		 */
		function cot_admin_config_get_titles($config_name, $cfg_params)
		{
			global $L;
			if (isset($L['cfg_'.$config_name.'_params'])
							&& is_array($L['cfg_'.$config_name.'_params']))
			{
				$lang_params_keys = array_keys($L['cfg_'.$config_name.'_params']);
				if (is_numeric($lang_params_keys[0]))
				{
					// Numeric array, simply use it
					$cfg_params_titles = $L['cfg_'.$config_name.'_params'];
				}
				else
				{
					// Associative, match entries
					$cfg_params_titles = array();
					foreach ($cfg_params as $val)
					{
						if (isset($L['cfg_'.$config_name.'_params'][$val]))
						{
							$cfg_params_titles[] = $L['cfg_'.$config_name.'_params'][$val];
						}
						else
						{
							$cfg_params_titles[] = $val;
						}
					}
				}
			}
			else
			{
				$cfg_params_titles = $cfg_params;
			}
			return $cfg_params_titles;
		}
	}
}

?>