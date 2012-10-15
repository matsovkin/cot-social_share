<?PHP
/* ====================
[BEGIN_COT_EXT]
Hooks=admin.config.edit.first
[END_COT_EXT]
==================== */

/**
 * Social share extension admin settings update part
 *
 * @package social_share
 * @version 0.1.0
 * @author Andrey Matsovkin
 * @copyright Copyright (c) 2008-2012
 * @license Distributed under BSD License.
 */

defined('COT_CODE') or die('Wrong URL');

if (defined('SOCIAL_SHARE_CONF')) {
	if ($a == 'update')
	{
		// filters posted values for «multiselect» params
		foreach ($_POST as $param=>$value){
			if ($param== 'services')
			{
				$sql = $db->query("SELECT * FROM $db_config
								WHERE config_owner = ? AND config_cat = ? AND config_name = ? $where_cat",
								array_merge(array($o, $p,$param),$sub_param));
				while ($row = $sql->fetch()) {
					$config_variants = $socs_services;
					$config_values = array_unique(array_map('trim', explode(',',$value)));
					// filters unknown values
					foreach ($config_values as $k => &$v) {
						if (!in_array($v, $config_variants)) unset($config_values[$k]);
					}
					$_POST[$param] = implode(',',$config_values);
				}
				$sql->closeCursor();
			}
		}
	}
}

?>