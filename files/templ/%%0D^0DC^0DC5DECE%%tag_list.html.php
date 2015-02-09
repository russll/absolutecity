<?php /* Smarty version 2.6.11, created on 2014-04-23 21:00:52
         compiled from mods/_ajax/tag_list.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_str_format', 'mods/_ajax/tag_list.html', 3, false),)), $this); ?>
<?php if ($this->_tpl_vars['ti']): ?>
    <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['ti']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
    <li class="cl_rtags" tid="<?php echo $this->_tpl_vars['ti'][$this->_sections['i']['index']]['id']; ?>
" id="id_tags_li_el_<?php echo $this->_tpl_vars['ti'][$this->_sections['i']['index']]['id']; ?>
" onMouseOver = "$('#id_tags_li_el_<?php echo $this->_tpl_vars['ti'][$this->_sections['i']['index']]['id']; ?>
 .cl_del_link').show();" onMouseOut = "$('#id_tags_li_el_<?php echo $this->_tpl_vars['ti'][$this->_sections['i']['index']]['id']; ?>
 .cl_del_link').hide();"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/albums/tags/<?php echo $this->_tpl_vars['ti'][$this->_sections['i']['index']]['name']; ?>
"><?php echo $this->_tpl_vars['ti'][$this->_sections['i']['index']]['name']; ?>
</a> <?php if ($this->_tpl_vars['IS_USER'] && ! empty ( $this->_tpl_vars['pi'] )): ?><span class="cl_del_link" tid="<?php echo $this->_tpl_vars['ti'][$this->_sections['i']['index']]['id']; ?>
" style="margin-right: 5px;"><a href="javascript: void(0);" onclick="oSystem.SConfPopup( 'oAlbums.DelTag( <?php echo $this->_tpl_vars['ti'][$this->_sections['i']['index']]['id']; ?>
, <?php echo $this->_tpl_vars['pi']['id']; ?>
 );', 'Please confirm you want to remove this tag \'<?php echo smarty_function_html_str_format(array('str' => $this->_tpl_vars['ti'][$this->_sections['i']['index']]['name']), $this);?>
\'?' );">&nbsp&nbsp&nbsp&nbsp</a></span><?php endif; ?></li>
    <?php endfor; endif;  else: ?>
    <li class="emptytag">There aren't any tags</li>
<?php endif; ?>