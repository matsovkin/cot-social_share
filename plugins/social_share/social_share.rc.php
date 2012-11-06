<?PHP
/* ====================
[BEGIN_COT_EXT]
Hooks=rc
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
$plug_name = 'social_share';

// to use outside hook code
global $socs_services, $socs_cfg, $socs_service_data, $sevice_names,
	$socs_tpl, $rc_link_func, $checklists_to_track, $version_number;
$socs_cfg = $cfg['plugin'][$plug_name]; // get plug conf

$rc_link_func = 'cot_rc_link_footer';
$rc_embed_func = 'cot_rc_embed_footer';

if ((empty($_GET['e']) && !defined('COT_ADMIN'))
				|| $_GET['e'] == 'page'
				|| $_GET['e'] == 'forums'
				|| $_GET['e']=='social_share'
				|| $socs_cfg['load_type']) {
	define('SOCIAL_SHARE',true);

}
if (defined('COT_ADMIN') && // in plugin config page
				(($_GET['n']=='edit' && $_GET['o']=='plug' && $_GET['m']=='config'	&& $_GET['p']==$plug_name)
								|| ($_GET['pl']==$plug_name) )) {

	define('SOCIAL_SHARE_CONF',true);
	define('EXTDEV_OFF',true); // switch off ExtDev if exists
	$checklists_to_track[] = 'services';

	$version_number = str_replace('.','',$cfg['version']);
	// tracks buggy admin theme template
	// used header cot_rc functions instead footer versions for Cotonti prior v.9.8
	if ($version_number < 98) {
		$rc_link_func = 'cot_rc_add_file';
		$rc_embed_func = 'cot_rc_embed';
	}
	require_once cot_incfile($plug_name, 'plug','config.functions');
}

if (defined('SOCIAL_SHARE') || defined('SOCIAL_SHARE_CONF')) { // common code
	class_exists('XTemplate') || require $cfg['system_dir'] . '/cotemplate.php';

	// used services
	$socs_services = array('blogger','digg','evernote','delicious','diary',
					'facebook','friendfeed','gplus','greader',
					'juick','liveinternet','linkedin','lj','moikrug',
					'moimir','myspace','odnoklassniki','pinterest',
					'surfingbird','tutby','twitter',
					'vkontakte','yaru','yazakladki'
	);

	$lang_comp = array('be'=>'be',	'kz'=>'kk',	'ru'=>'ru',	'uk'=>'uk');
	if ($socs_cfg['force_lang']) { // setup widget lang
		$socs_cfg['lang'] = $socs_cfg['default_lang'];
	} else {
		$socs_cfg['lang'] = $lang_comp[$usr['lang']] ? $lang_comp[$usr['lang']] : $socs_cfg['default_lang'];
	}

	if ($socs_cfg['cdn_use']) { // loads lib
		$rc_link_func('//yandex.st/share/share.js');
	} else $rc_link_func($cfg['plugins_dir'] . '/social_share/js/share.js');
	require_once cot_incfile($plug_name, 'plug');

}

if (defined('SOCIAL_SHARE')) {
	$socs_tpl = new XTemplate(cot_tplfile($plug_name, 'plug'));
}

if (defined('SOCIAL_SHARE_CONF')) { // only for config part
	cot_rc_link_file($cfg['plugins_dir'] . '/social_share/tpl/social_share.css');

	$ttl = htmlspecialchars($cfg['maintitle'].'. '.$cfg['subtitle'],ENT_QUOTES);
	cot_rc_embed("var url='{$cfg['mainurl']}', title='$ttl', lang='{$socs_cfg['lang']}';");

	if ($cfg['jquery']) $rc_link_func($cfg['plugins_dir'].'/social_share/js/social_share.admin.js');
	else $rc_link_func($cfg['plugins_dir'].'/social_share/js/social_share.admin.nojquery.js');

	$all_services_data = array(
					'blogger' => array('link'=>'http://www.blogger.com/','name'=>'Blogger'),
					'digg' => array('link'=>'http://www.digg.com/','name'=>'Digg'),
					'evernote' => array('link'=>'http://www.evernote.com/','name'=>'Evernote'),
					'delicious' => array('link'=>'http://www.delicious.com/','name'=>'delicious'),
					'diary' => array('link'=>'http://www.diary.ru/','name'=>'Diary'),
					'facebook' => array('link'=>'http://facebook.com','name'=>'Facebook'),
					'friendfeed' => array('link'=>'https://friendfeed.com/','name'=>'FriendFeed'),
					'gbuzz' => array('link'=>'http://www.google.com/buzz','name'=>'Google Buzz'),
					'gplus' => array('link'=>'https://plus.google.com/','name'=>'Google+'),
					'greader' => array('link'=>'https://reader.google.com/','name'=>'Google Reader'),
					'juick' => array('link'=>'http://juick.com/','name'=>'Juick'),
					'liveinternet' => array('link'=>'http://www.liveinternet.ru/','name'=>'LiveInternet'),
					'linkedin' => array('link'=>'http://www.linkedin.com/','name'=>'LinkedIn'),
					'lj' => array('link'=>'http://www.livejournal.com/','name'=>'LiveJournal'),
					'moikrug' => array('link'=>'http://moikrug.ru/','name'=>'MoiKrug'),
					'moimir' => array('link'=>'http://my.mail.ru/','name'=>'MoiMir'),
					'myspace' => array('link'=>'http://www.myspace.com/','name'=>'MySpace'),
					'odnoklassniki' => array('link'=>'http://odnoklassniki.ru','name'=>'Odnoklassniki'),
					'pinterest' => array('link'=>'http://pinterest.com/','name'=>'Pinterest'),
					'pocket' => array('link'=>'','name'=>'Pocket'),
					'surfingbird' => array('link'=>'http://surfingbird.ru/','name'=>'Surfingbird'),
					'tutby' => array('link'=>'http://i.tut.by/','name'=>'Tut.by'),
					'twitter' => array('link'=>'http://twitter.com/','name'=>'Twitter'),
					'vkontakte' => array('link'=>'http://vk.com','name'=>'VK.com'),
					'yaru' => array('link'=>'http://my.ya.ru/','name'=>'ya.ru'),
					'yazakladki' => array('link'=>'http://zakladki.yandex.ru/','name'=>'yandex.zakladki'),
	);

	$socs_service_data = array();
	foreach ($socs_services as $sservice) {
		if ($all_services_data[$sservice]) {
			$socs_service_data[$sservice] = $all_services_data[$sservice];
			$sevice_names[$sservice] = $all_services_data[$sservice]['name'];
		}
	}

}

?>