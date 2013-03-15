<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=admin.config.edit.first
[END_COT_EXT]
==================== */

/**
 * Social share extension admin settings update part
 *
 * @package social_share
 * @author Andrey Matsovkin
 * @copyright Copyright (c) 2008-2013
 * @license Distributed under BSD License.
 */

defined('COT_CODE') or die('Wrong URL');

if (defined('SOCIAL_SHARE_CONF')) {
	if ($a == 'update')
	{
		// filters posted values for «simplelist» params
		$sql = $db->query("SELECT * FROM $db_config
							WHERE config_owner = ? AND config_cat = ? $where_cat",
							array_merge(array($o, $p),$sub_param));
		while ($row = $sql->fetch()) {
			$config_name = $row['config_name'];
			if (in_array($config_name, $checklists_to_track) && $_POST[$config_name])
			{
				$config_variants = array_unique(array_map('trim', explode(',',$row['config_default'])));
				if ($config_name == 'services') // overrides for SocSocial
				{
					$config_variants = $socs_services;
				}
				$config_values = array_unique(array_map('trim', explode(',',$_POST[$config_name])));
				foreach ($config_values as $k => &$v)
				{
					if (!in_array($v, $config_variants)) unset($config_values[$k]);
				}
				$_POST[$config_name] = implode(',', $config_values);
			}
		}
		$sql->closeCursor();
	}
}

