<?php
if (!defined('COT_CODE') && !defined('COT_PLUG')) {
	die('Wrong URL ('.array_pop(explode("\\",__FILE__)).').');
}

function share_widget_code($url='',$title='',$desc=''){
	global $socs_tpl;
	$socs_tpl->assign(array(
					'share_link'=>$url,
					'share_title'=>$title,
					'share_desc'=>$desc
	));
	$socs_tpl->parse();
	return $socs_tpl->text();
}


function social_share($url='',$title='',$desc=''){
	global $_GET,$cfg,$out;
	if (!$url) {
		$prm = $_GET;
		unset($prm['dc']);
		unset($prm['rwr']);
		unset($prm['d']);
		$main = $prm['e'];
		unset($prm['e']);
		$url = empty($main) ? $cfg['mainurl'].'/' : $cfg['mainurl'].'/'.cot_url($main, $prm);
	}
	if (!$title) {
		$title = $out['fulltitle'];
	}
	if (!$desc) {
		$desc = mb_substr($out['meta_desc'], 0, 140);
	}

	return share_widget_code(($url),($title),($desc));
}

?>