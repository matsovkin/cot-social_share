/**
 * Clears value of element with Id
 * @param id - ID of input field
 */
function sl_clear(id){
	var el = document.getElementById(id);
	if (el) el.value='';
	update_widget();
}

/**
 * Toggle item in list
 * @param item - item name (string)
 * @param id - ID of target input field
 */
function sl_toggle(item,id){
	var el = document.getElementById(id),
		val = el.value,
		arr = val.split(','),
		exists = false,
		newarr = [];
	for(var i=0; i<arr.length; i++) {
		if (arr[i]==item) exists = true;
		else newarr.push(arr[i]);
	}
	if (!exists) {
		el.value = val ? val + ',' + item : item;
	} else {
		el.value = newarr.join(',');
	}
	update_widget();
}

/**
 * Generates code for «Share» widget, updates widget and show its code
 */
function update_widget(){
	console.log('widget update');
	var ell = document.getElementById('force_lang');
	var eld = document.getElementById('default_lang');
	var elt = document.getElementById('block_type');
	var els = document.getElementById('services');
	var elc = document.getElementById('cdn_use');
	var elsb = document.getElementById('sample_block');
	var elcb = document.getElementById('code_block');
	var lng = (ell && ell.value==1) ? eld.value : lang;
	var wtyp = (elt && elt.value) ? elt.value : 'button';
	var linkIcon = true;
	if (wtyp == 'link') linkIcon = false;
	var sserv = (els && els.value) ? els.value : '';
	var addon = 'data-yasharelink="'+url+'" data-yasharetitle="'+title+'"';
	var lib = (elc && elc.value==1)
			? '<script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>\n'
			: '<script type="text/javascript" src="plugins/social_share/js/share.js" charset="utf-8"></script>\n';
	var code= '<div class="yashare-auto-init" data-yashareL10n="'+lng+'" data-yashareType="'+wtyp+'"\n'+
	'data-yashareQuickServices="'+sserv+'"\n'+addon+'></div>';
	var services = els.value.split(',');
	elsb.innerHTML = '<span id="ya_share_test"></span>';
	var yaShareTest = new Ya.share({
		'element': 'ya_share_test',
		'l10n':lng,
		'link':url,
		'title':title,
		'elementStyle': {'type': wtyp, 'linkIcon': linkIcon, 'border': false, 'quickServices': services},
		'popupStyle': {'copyPasteField': false}//,'codeForBlog':'test'}
	 });
	elcb.innerHTML = lib+code;
}

setTimeout('update_widget()',1000);