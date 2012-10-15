<!-- BEGIN: CB_LIST-->
<div class="all_cb"><label><input class="all_cb" type="checkbox" value="1" />{PHP.L.ss_checkall}</label></div>
<div class="checkblocks">
<!-- BEGIN: BLOCK -->
<div class="listblock items">
	<ul>
<!-- BEGIN: ITEM2 -->
		<li class="s_item"><label><input type="checkbox" value="{it.code}"/><i class="s_icon_{it.code}"></i>{it.text}</label>{it.link}</li>
<!-- END: ITEM2 -->
<!-- BEGIN: ITEM -->
		<li class="s_item">{cb}</li>
<!-- END: ITEM -->
	</ul>
</div>
<!-- END: BLOCK -->
</div>
<!-- END: CB_LIST -->

<!-- BEGIN: CB_TPL -->
<input type="hidden" name="{$name}" value="{$value_off}" /><label><input class="ssi" type="checkbox" name="{$name}" value="{$value}"{$checked}{$attrs} /><i class="s_icon_{$name}"></i>{$title}</label>
<!-- END: CB_TPL -->