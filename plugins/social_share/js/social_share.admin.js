/**
 * Clears value of element with Id
 * @param id - ID of input field
 */
function sl_clear(id){
	var el = document.getElementById(id);
	if (el) el.value='';
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
}

/**
 * Generates code for «Share» widget, updates widget and show its code
 */
function update_widget(){
	var lng = $('#force_lang').val()==1 ? $('#default_lang').val() : lang;
	var wtyp = $('#block_type').val() ? $('#block_type').val() : 'button';
	var linkIcon = true;
	if (wtyp == 'link') linkIcon = false;
	var sserv = ($('#services').val()) ? $('#services').val() : '';
	var addon = 'data-yasharelink="'+url+'" data-yasharetitle="'+title+'"';
	var lib = ($('#cdn_use').val()==1)
			? '<script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>\n'
			: '<script type="text/javascript" src="plugins/social_share/js/share.js" charset="utf-8"></script>\n';
	var code= '<div class="yashare-auto-init" data-yashareL10n="'+lng+'" data-yashareType="'+wtyp+'"\n'+
	'data-yashareQuickServices="'+sserv+'"\n'+addon+'></div>';
	var services = $('#services').val().split(',');
	$('#ya_share_test').remove();
	$('#sample_block').append('<span id="ya_share_test"></span>');
	var yaShareTest = new Ya.share({
		'element': 'ya_share_test',
		'l10n':lng,
		'link':url,
		'title':title,
		'elementStyle': {'type': wtyp, 'linkIcon': linkIcon, 'border': false, 'quickServices': services},
		'popupStyle': {'copyPasteField': false}//,'codeForBlog':'test'}
	 });
	$('#code_block').text(lib+code);
}

/**
 * Making config dialog «internal mechanics»
 */
function make_conf_magic(){
	update_widget();
	// tracks linking checkboxes and original hidden control
	$('input.ssi').bind('change',function(){
		var code = $(this).attr('name');
		if ($(this).is(':checked')) {
			$('#services').val( $('#services').val() ? $('#services').val()+','+code : code);
		} else {
			var newlist = $.map( $('#services').val().split(','), function(val,idx){
				return val==code ? null : val;
			});
			$('#services').val( newlist.join(','));
		}
	});
	// force rebiuld widget for changed values
	$('#force_lang, #default_lang, #block_type, input.ssi, #cdn_use').
		bind('change',function(){
			update_widget();
		});
	// check/uncheck all
	$('input.all_cb').bind('change',function(){
		$('.ssi').prop('checked',$(this).prop('checked'));
		$('.ssi').trigger('change');
	});
	// hide reset buttons
	$('#sample_block').parents('tr').find('td').eq(2).html('');
	$('#code_block').parents('tr').find('td').eq(2).html('');
}
$(function() {
	make_conf_magic();
	ajaxSuccessHandlers.push(function (){
		make_conf_magic(); // after pressing reset or update button
	});
});
