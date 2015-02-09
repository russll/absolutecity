<?php /* Smarty version 2.6.11, created on 2014-04-13 11:40:44
         compiled from top_blocks/_search.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'top_blocks/_search.html', 5, false),)), $this); ?>
<!-- Search top box -->
<div class="search-top-box">
	<?php if ($this->_tpl_vars['glsrch']): ?><input id="id_glsrch_input" type="hidden" value="<?php echo $this->_tpl_vars['glsrch']; ?>
" /><?php endif; ?>
	<?php if ($this->_tpl_vars['glsrchsubfilt']): ?><input id="id_glsrchsubfilt_input" type="hidden" value="<?php echo $this->_tpl_vars['glsrchsubfilt']; ?>
" /><?php endif; ?>
	<input id="pml" type="hidden" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['pml'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" />
	<input id="pwn" type="hidden" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['pwn'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" />
	<input id="psn" type="hidden" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['psn'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" />
	<?php if (! $this->_tpl_vars['web_search']): ?>
    <form id="id_frm_srch" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
base/search" method="post" onsubmit="javascript: return false;" >
		<div><input id="id_srch_edit" name="SI[bfilt]" type="text" value="<?php if ($this->_tpl_vars['glsrch']):  echo $this->_tpl_vars['glsrch'];  else: ?>Find something...<?php endif; ?>" onclick="this.value='';" onkeypress="javascript: if((event.keyCode == 0x0D) || ((event.ctrlKey) && ((event.keyCode == 0xA) || (event.keyCode == 0x0D) || (event.keyCode == 0xD)))) oSearch.Search('id_frm_srch'); return;" /><a id="id_btn_search" href="javascript: void(0);" onclick="javascript: oSearch.Search('id_frm_srch', 1);"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
find_b2.gif"  /></a></div>
		<div id="id_browse_attach_srch" style="display: none;">
			<input id="id_srch_attach_frm_btype" name="SI[btype]" type="hidden" value="All results" />
		</div>
	</form>
    <?php else: ?>
    <form action="<?php echo $this->_tpl_vars['siteAdr']; ?>
base/search/web" id="fms" method="post">
		<div><input name="q" type="text" value="<?php if ($this->_tpl_vars['q']):  echo $this->_tpl_vars['q'];  else: ?>Find something...<?php endif; ?>" onclick="this.value='';" onkeypress="javascript: if((event.keyCode == 0x0D) || ((event.ctrlKey) && ((event.keyCode == 0xA) || (event.keyCode == 0x0D) || (event.keyCode == 0xD)))) $('#fms').submit(); return;" /><a id="id_btn_search" href="javascript: void(0);" onclick="javascript: $('#fms').submit();"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
find_b2.gif"  /></a></div>
	</form>
    <?php endif; ?>
</div>
<!-- Search top box -->