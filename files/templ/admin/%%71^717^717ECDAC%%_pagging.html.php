<?php /* Smarty version 2.6.11, created on 2014-05-22 13:14:38
         compiled from mods/_pagging.html */ ?>
<div class="pathwhay">
<?php if ($this->_tpl_vars['lprev']): ?><a href="<?php echo $this->_tpl_vars['lprev']; ?>
" style="color: #004A79; text-decoration: none;">&larr;</a><?php else: ?>&larr;<?php endif; ?>
<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['pages']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<?php if ($this->_tpl_vars['page'] == $this->_tpl_vars['pages'][$this->_sections['i']['index']]['page']): ?>
    <?php if (! $this->_sections['i']['first']):  endif; ?><span style="font-weight: bold;"><?php echo $this->_tpl_vars['pages'][$this->_sections['i']['index']]['page']; ?>
</span>
<?php else: ?>	
    <?php if (! $this->_sections['i']['first']):  endif; ?><a href="<?php echo $this->_tpl_vars['pages'][$this->_sections['i']['index']]['link']; ?>
" style="color: #004A79;"><?php echo $this->_tpl_vars['pages'][$this->_sections['i']['index']]['page']; ?>
</a>
<?php endif; ?> 
<?php endfor; endif; ?>
<?php if ($this->_tpl_vars['lnext']): ?><a href="<?php echo $this->_tpl_vars['lnext']; ?>
" style="color: #004A79; text-decoration: none;">&rarr;</a><?php else: ?>&rarr;<?php endif; ?>
</div>