<?php /* Smarty version 2.6.11, created on 2014-04-04 23:02:17
         compiled from mods/users/ajax/_show_church.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'moddate', 'mods/users/ajax/_show_church.html', 5, false),)), $this); ?>
<span class="edit-info" id="church_edit" style="display:none;"> <?php if ($this->_tpl_vars['IS_USER']): ?> <a href="javascript:oUsers.SettingsChurch();">Edit</a> <?php else: ?> &nbsp <?php endif; ?></span>
<table>
<?php if ($this->_tpl_vars['ui']['baptism_date'] != '0000-00-00' || $this->_tpl_vars['ui']['mission'] || $this->_tpl_vars['ui']['ward'] || $this->_tpl_vars['ui']['stake'] || $this->_tpl_vars['ui']['calling']): ?>   
    <?php if ($this->_tpl_vars['ui']['baptism_date'] != '0000-00-00'): ?>
    <tr><td width="150"><label>Date of baptism</label></td><td><?php echo ((is_array($_tmp=$this->_tpl_vars['ui']['baptism_date'])) ? $this->_run_mod_handler('moddate', true, $_tmp) : smarty_modifier_moddate($_tmp)); ?>
</td></tr>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['ui']['mission']): ?>
    <tr><td width="150"><label>Served mission</label></td><td style="padding-right: 20px;">
             <?php $_from = $this->_tpl_vars['ui']['mission']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['n'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['n']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['n']['iteration']++;
 if (($this->_foreach['n']['iteration']-1)): ?><br /><?php endif;  echo $this->_tpl_vars['i']['location'];  if (((is_array($_tmp=$this->_tpl_vars['i']['fdate'])) ? $this->_run_mod_handler('moddate', true, $_tmp) : smarty_modifier_moddate($_tmp)) != '00' && ((is_array($_tmp=$this->_tpl_vars['i']['tdate'])) ? $this->_run_mod_handler('moddate', true, $_tmp) : smarty_modifier_moddate($_tmp)) != '00'): ?>, <?php echo ((is_array($_tmp=$this->_tpl_vars['i']['fdate'])) ? $this->_run_mod_handler('moddate', true, $_tmp) : smarty_modifier_moddate($_tmp)); ?>
 - <?php echo ((is_array($_tmp=$this->_tpl_vars['i']['tdate'])) ? $this->_run_mod_handler('moddate', true, $_tmp) : smarty_modifier_moddate($_tmp));  endif;  endforeach; endif; unset($_from); ?>
        </td></tr>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['ui']['ward']): ?>
    <tr><td width="150"><label>Ward</label></td><td><?php echo $this->_tpl_vars['ui']['ward']; ?>
</td></tr>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['ui']['stake']): ?>
    <tr><td width="150"><label>Stake</label></td><td><?php echo $this->_tpl_vars['ui']['stake']; ?>
</td></tr>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['ui']['calling']): ?>
    <tr><td width="150"><label>My calling</label></td><td>
        <?php $_from = $this->_tpl_vars['ui']['calling']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['n'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['n']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['n']['iteration']++;
 if (($this->_foreach['n']['iteration']-1)): ?>, <?php endif;  echo $this->_tpl_vars['i']['calling'];  if ($this->_tpl_vars['i']['comment']): ?>(<?php echo $this->_tpl_vars['i']['comment']; ?>
)<?php endif;  endforeach; endif; unset($_from); ?>
    </td></tr>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['ui']['priesthood']): ?>
    <tr><td width="150"><label>Are you a priesthood holder?</label></td><td>
       <?php echo $this->_tpl_vars['phl'][$this->_tpl_vars['ui']['priesthood']]; ?>

    </td></tr>

    <?php endif; ?>
    <?php if ($this->_tpl_vars['ui']['class']): ?>
    <tr><td width="150"><label>Sunday School Classes</label></td><td style="padding-right: 20px;">
             <?php $_from = $this->_tpl_vars['ui']['class']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['n'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['n']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['n']['iteration']++;
 if (($this->_foreach['n']['iteration']-1)): ?><br /><?php endif;  echo $this->_tpl_vars['i']['title'];  endforeach; endif; unset($_from); ?>
        </td></tr>
    <?php endif;  else: ?>
    <tr><td width="150"><label>None</label></td><td>&nbsp;</td></tr>
<?php endif; ?>
</table>