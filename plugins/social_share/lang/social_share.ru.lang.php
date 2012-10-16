<?PHP
/**
 * Localization file for Social share
 * @version 0.1.0
 * @author Andrey Matsovkin
 * @copyright Copyright (c) 2008-2012
 * @license Distributed under BSD License.
 */

defined('COT_CODE') or die('Wrong URL');

$L['plu_title'] = '«Поделиться» в соц.сетях'; // для заголовка страницы
$L['info_desc'] ='Добавляет блок «Поделиться», позволяющий рассказать о странице в соцсетях';

$L['cfg_services'] = array('Используемые соц.сервисы',$sevice_list,
				'<br />Нажимайте на название, чтобы добавить или удалить из списка: ',
				'Сбросить выбранные');

$L['cfg_load_type'] = array('Загружать библиотеку');
$L['cfg_load_type_params'] = array('Только на страницах статей, новостей, форумов','На всех страницах сайта');

$L['cfg_cdn_use'] = array('Откуда загружать библиотеку share.js (43 Кб)');
$L['cfg_cdn_use_params'] = array('с этого сайта','из CDN Яндекса');

$L['cfg_default_lang'] = array('Язык виджета, если не соответствует языку пользователя');
$L['cfg_default_lang_params'] = array('Английский','Русский','Белорусский','Украинский','Казахский','Татарский');

$L['cfg_force_lang'] = array('Принудительно установить выбранный язык для всех');
$L['cfg_force_lang_params'] = array($L['Yes'], $L['No']);

$L['cfg_sample_block'] = array('Пример блока «Поделиться»');
$L['cfg_code_block'] = array('Код используемый для вставки','Данный код приведен здесь для примера.
				Он будет автоматически внедрен на страницы, если вы используете тэг <strong>{SOCIAL_SHARE}</strong> или <strong>{PHP.social_share}</strong> в своих шаблонах.');

$L['cfg_block_type'] = array('Внешний вид блока');
$L['cfg_block_type_params'] = array('кнопка','ссылка','значек без текста','без всплывающего окна');

if (defined('SOCIAL_SHARE_CONF')){

	$sevice_names = array(
					'blogger' => 'Blogger',
					'digg' => 'Digg',
					'evernote' => 'Evernote',
					'delicious' => 'delicious',
					'diary' => 'Diary',
					'facebook' => 'Facebook',
					'friendfeed' => 'FriendFeed',
					'gbuzz' => 'Google Buzz',
					'gplus' => 'Google+',
					'greader' => 'Google Reader',
					'juick' => 'Juick',
					'liveinternet' => 'LiveInternet',
					'linkedin' => 'LinkedIn',
					'lj' => 'Живой Журнал',
					'moikrug' => 'Мой круг',
					'moimir' => 'Мой мир',
					'myspace' => 'MySpace',
					'odnoklassniki' => 'Одноклассники',
					'pinterest' => 'Pinterest',
					'pocket' => 'Pocket',
					'surfingbird' => 'Surfingbird',
					'tutby' => 'Я.тут!',
					'twitter' => 'Twitter',
					'vkontakte' =>'ВКонтакте',
					'yaru' => 'Я.ру',
					'yazakladki' => 'Яндекс.закладки',
	);

	$linkslist = array();
	foreach ($socs_service_data as $scode=>$sdata) {
		if ($sevice_names[$scode]) $socs_service_data[$scode]['name'] = $sevice_names[$scode];
		$L['cfg_services_params'][] = $socs_service_data[$scode]['name'];
		$linkslist[] = cot_rc_link($socs_service_data[$scode]['link'],$socs_service_data[$scode]['name'],array('target'=>'_new'));
	}

	$adminhelp = '<p>Расширение позволяет разместить блок «Поделиться» на страницах вашего сайта.
	Этот блок позволит пользователям с легкостью делиться ссылками на ваш сайт в социальных сетях, таких как: одноклассники, вКонтакте, Твиттер и другими.</p>
	<p>Для вставки «блока» на страницы добавьте тег <strong>{SOCIAL_SHARE}</strong> в шаблонах сайта.
	Работает в шаблоне страниц (page.tpl), новостей (news.tpl), тем форума (forum.posts.tpl), на главной странице (index.tpl).
	<br />Для остальных страниц можно использовать «функциональный тег» <strong>{PHP.social_share}</strong>, не забыв при этом выставить
	параметр «загружать библиотеку на всех страницах» в меню натроек расширения.
	</p>
	<p>Внешний вид блока и необходимые сервисы вы можете настроить в разделе конфигурирования расширения.</p>
	<br /><p>Поддерживаемые сервисы (нажмите на название для открытия страницы сервиса в новом окне):<br /> '.implode(', ',$linkslist).'</p>';

	$L['ss_checkall'] = 'очистить/выделить все';
}

?>