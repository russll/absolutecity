<?php /* Smarty version 2.6.11, created on 2014-03-15 09:09:42
         compiled from mods/adtmpl/_tags_leftcolumn.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_str_format', 'mods/adtmpl/_tags_leftcolumn.html', 6, false),)), $this); ?>
<h2><?php if ($this->_tpl_vars['IS_USER']): ?><span><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['UserInfo']['uid']; ?>
/tags">Edit</a></span><?php endif; ?> Tags</h2>
<ul class="list02">
	<?php if ($this->_tpl_vars['j_ctags']): ?>
	<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['j_ctags']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
		<?php if ($this->_tpl_vars['j_ctags'][$this->_sections['i']['index']]['type'] != 2): ?>
		<li class="cl_rtags" tid="<?php echo $this->_tpl_vars['j_ctags'][$this->_sections['i']['index']]['id']; ?>
" id="id_tags_li_el_<?php echo $this->_tpl_vars['j_ctags'][$this->_sections['i']['index']]['id']; ?>
" onMouseOver="$('#id_tags_li_el_<?php echo $this->_tpl_vars['j_ctags'][$this->_sections['i']['index']]['id']; ?>
 .cl_del_link').show();" onMouseOut="$('#id_tags_li_el_<?php echo $this->_tpl_vars['j_ctags'][$this->_sections['i']['index']]['id']; ?>
 .cl_del_link').hide();"><span><?php if ($this->_tpl_vars['j_ctags'][$this->_sections['i']['index']]['cnt_mes']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/tags/id<?php echo $this->_tpl_vars['j_ctags'][$this->_sections['i']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['j_ctags'][$this->_sections['i']['index']]['cnt_mes']; ?>
</a><?php endif; ?></span> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/tags/id<?php echo $this->_tpl_vars['j_ctags'][$this->_sections['i']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['j_ctags'][$this->_sections['i']['index']]['name']; ?>
</a> <?php if ($this->_tpl_vars['IS_USER']): ?><span class="cl_del_link" tid="<?php echo $this->_tpl_vars['j_ctags'][$this->_sections['i']['index']]['id']; ?>
" style="margin-right: 5px;"><a href="javascript: void(0);" onclick="javascript: oSystem.SConfPopup( 'oUsers.DeleteTag( <?php echo $this->_tpl_vars['j_ctags'][$this->_sections['i']['index']]['id']; ?>
 );', 'Please confirm you want to remove this tag \'<?php echo smarty_function_html_str_format(array('str' => $this->_tpl_vars['j_ctags'][$this->_sections['i']['index']]['name']), $this);?>
\'?' );">&nbsp&nbsp&nbsp&nbsp</a></span><?php endif; ?></li>
		<?php else: ?>
		<li><span><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/tags/id<?php echo $this->_tpl_vars['j_ctags'][$this->_sections['i']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['j_ctags'][$this->_sections['i']['index']]['cnt_mes']; ?>
</a></span> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/tags/id<?php echo $this->_tpl_vars['j_ctags'][$this->_sections['i']['index']]['id']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
heart_ico.gif" title="Favorites" alt="Favorites" /></a></li>
		<?php endif; ?>
	<?php endfor; endif; ?>
	<?php endif; ?>
</ul>