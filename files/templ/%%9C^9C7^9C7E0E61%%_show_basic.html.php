<?php /* Smarty version 2.6.11, created on 2014-04-04 23:02:17
         compiled from mods/users/ajax/_show_basic.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'mods/users/ajax/_show_basic.html', 7, false),)), $this); ?>
<span class="edit-info" id="basic_edit" style="display:none;"> <?php if ($this->_tpl_vars['IS_USER']): ?> <a href="javascript:oUsers.SettingsBasic();">Edit</a> <?php else: ?> &nbsp <?php endif; ?></span>
<table>
<?php if ($this->_tpl_vars['ui']['gender']): ?>
    <tr><td width="150"><label>Gender</label></td><td><?php if (1 == $this->_tpl_vars['ui']['gender']): ?>Male<?php elseif (2 == $this->_tpl_vars['ui']['gender']): ?>Female<?php endif; ?></td></tr>
<?php endif;  if ($this->_tpl_vars['ui']['dob'] && ! $this->_tpl_vars['ui']['no_dob']): ?>
    <tr><td width="150"><label>Birthday</label></td><td><?php if ($this->_tpl_vars['ui']['dob'] != '0000-00-00'):  echo ((is_array($_tmp=$this->_tpl_vars['ui']['dob'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%B %e, %Y") : smarty_modifier_date_format($_tmp, "%B %e, %Y"));  else: ?>not specified<?php endif; ?></td></tr>
<?php endif;  if ($this->_tpl_vars['ui']['was_born']): ?>
    <tr><td width="150"><label>I was born in</label></td><td><?php echo $this->_tpl_vars['ui']['was_born']; ?>
</td></tr>
<?php endif;  if ($this->_tpl_vars['ui']['live_in']): ?>
    <tr><td width="150"><label>I currently live in</label></td><td><?php echo $this->_tpl_vars['ui']['live_in']; ?>
</td></tr>
<?php endif;  if ($this->_tpl_vars['ui']['fam']): ?>
    <tr><td width="150"><label>Family</label></td><td>
    <?php $_from = $this->_tpl_vars['ui']['fam']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['n'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['n']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['n']['iteration']++;
?>
        <?php $this->assign('ov', $this->_tpl_vars['i']['rel_status']); ?>
        <?php if (! ($this->_foreach['n']['iteration'] <= 1)): ?><br /><?php endif;  echo $this->_tpl_vars['relations'][$this->_tpl_vars['ov']]; ?>
: <?php echo $this->_tpl_vars['i']['name']; ?>

    <?php endforeach; endif; unset($_from); ?>
    </td></tr>
<?php endif;  if ($this->_tpl_vars['ui']['rel_status']): ?>
    <tr><td width="150"><label>Relationship status</label></td><td> <?php $this->assign('ov', $this->_tpl_vars['ui']['rel_status']);  echo $this->_tpl_vars['rel_statuses'][$this->_tpl_vars['ov']]; ?>
</td></tr>
<?php endif;  if ($this->_tpl_vars['ui']['langs']): ?>
     <tr><td width="150"><label>Spoken languages</label></td><td>
     <?php $_from = $this->_tpl_vars['ui']['langs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['n'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['n']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['n']['iteration']++;
 if (! ($this->_foreach['n']['iteration'] <= 1)): ?>, <?php endif;  echo $this->_tpl_vars['spoken_langs'][$this->_tpl_vars['i']];  endforeach; endif; unset($_from); ?>
     </td></tr>
<?php endif; ?>
</table>