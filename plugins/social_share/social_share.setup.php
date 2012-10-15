<?PHP
/* ====================
[BEGIN_COT_EXT]
Code=social_share
Name=Social share
Description=Allow to share pages with various social services
Version=0.1.1
Date=2012-Oct-14
Author=Andrey Matsovkin
Copyright=Copyright (c) 2008-2012, Andrey Matsovkin
Notes=
Auth_guests=R1
Lock_guests=W2345A
Auth_members=RW1
Lock_members=2345
[END_COT_EXT]

[BEGIN_COT_EXT_CONFIG]
load_type=02:select:0,1:0:Load type
cdn_use=03:select:0,1:0:Source to load share.js lib (43kb) [this site/Yandex CDN]
sep1=04:separator:::Separator
default_lang=07:select:en,ru,be,uk,kk,tt:en:Language of widget if not fit users default
force_lang=08:select:1,0:0:Force default language for widget (always use default)
sep2=09:separator:::Separator
block_type=10:select:button,link,icon,none:button:Widget type
services=13:text:blogger,digg,evernote,delicious,diary,facebook,friendfeed,gbuzz,gplus,greader,juick,liveinternet,linkedin,lj,moikrug,moimir,myspace,odnoklassniki,pinterest,pocket,surfingbird,tutby,twitter,vkontakte,yaru,yazakladki:facebook,twitter,vkontakte,gplus:Used services
sep3=15:separator:::Separator
sample_block=17:text:::Sample block
code_block=18:text:::Code block
[END_COT_EXT_CONFIG]
==================== */

/**
 * Social share plugin for Cotonti CMF
 *
 * @package social_share
 * @version 0.1.0
 * @author Andrey Matsovkin
 * @copyright Copyright (c) 2008-2012
 * @license Distributed under BSD License.
var1=11:select:0,1,2,3,4,5,6:3:Description
var2=12:radio:0,1:1:Enable this
var3=13:string::test:Test string
var4=14:callback:cot_get_editors():markitup:Simple callback
var5=15:separator:::Separator
var6=16:range:0,5:1:Range
var7_multiselect=17:text:0,5:1,2:Text
*/

if (!defined('COT_CODE')) { die('Wrong URL ('.array_pop(explode("\\",__FILE__)).').'); }


?>