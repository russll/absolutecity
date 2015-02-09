<?php /* Smarty version 2.6.11, created on 2014-04-04 23:02:17
         compiled from mods/users/ajax/_show_interest.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'nl2br', 'mods/users/ajax/_show_interest.html', 5, false),array('modifier', 'dlong', 'mods/users/ajax/_show_interest.html', 5, false),)), $this); ?>
<span class="edit-info" id="interest_edit" style="display:none;"> <?php if ($this->_tpl_vars['IS_USER']): ?> <a href="javascript:oUsers.SettingsInterest();">Edit</a> <?php else: ?> &nbsp <?php endif; ?></span>
<table>
    <?php if ($this->_tpl_vars['ui']['interests']): ?>
        <?php $_from = $this->_tpl_vars['ui']['interests']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
        <tr><td width="150"><label><?php echo $this->_tpl_vars['i']['title']; ?>
</label></td><td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['i']['story'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)))) ? $this->_run_mod_handler('dlong', true, $_tmp) : smarty_modifier_dlong($_tmp)); ?>
</td><td style="width:25px;"></td></tr>
        <?php endforeach; endif; unset($_from); ?>
    <?php else: ?>
    <tr><td width="150"><label>None</label></td><td>&nbsp;</td></tr>
    <?php endif; ?>
</table>