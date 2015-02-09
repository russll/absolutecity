<?php /* Smarty version 2.6.11, created on 2014-04-04 23:02:17
         compiled from mods/users/ajax/_show_contacts.html */ ?>
<span class="edit-info" id="contacts_edit" style="display:none;"> <?php if ($this->_tpl_vars['IS_USER']): ?> <a href="javascript:oUsers.SettingsContacts();">Edit</a> <?php else: ?> &nbsp <?php endif; ?></span>
<table>
    <tr><td width="150"><label>Real name</label></td><td><?php echo $this->_tpl_vars['ui']['first_name']; ?>
 <?php echo $this->_tpl_vars['ui']['last_name']; ?>
</td></tr>
    <tr><td width="150"><label>Email</label></td><td><?php echo $this->_tpl_vars['ui']['email']; ?>
</td></tr>
    <?php if ($this->_tpl_vars['ui']['im']): ?>
    <tr><td width="150" valign="top"><label>IM Screen name</label></td><td>
    <?php $_from = $this->_tpl_vars['ui']['im']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['n'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['n']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['n']['iteration']++;
?>
        <?php $this->assign('ov', $this->_tpl_vars['i']['im_type']); ?>
        <?php if (! ($this->_foreach['n']['iteration'] <= 1)): ?><br /><?php endif;  echo $this->_tpl_vars['ims'][$this->_tpl_vars['ov']]; ?>
: <?php echo $this->_tpl_vars['i']['im_name']; ?>

    <?php endforeach; endif; unset($_from); ?>
        </td></tr>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['ui']['mob_phone']): ?>
    <tr><td width="150"><label>Mobile phone</label></td><td><?php echo $this->_tpl_vars['ui']['mob_phone']; ?>
</td></tr>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['ui']['land_phone']): ?>
    <tr><td width="150"><label>Land phone</label></td><td><?php echo $this->_tpl_vars['ui']['land_phone']; ?>
</td></tr>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['ui']['address']): ?>
    <tr><td width="150"><label>Address</label></td><td><?php echo $this->_tpl_vars['ui']['address']; ?>
</td></tr>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['ui']['city']): ?>
    <tr><td width="150"><label>City/town</label></td><td><?php echo $this->_tpl_vars['ui']['city']; ?>
</td></tr>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['ui']['state']): ?>
        <tr><td width="150"><label>State/Province</label></td><td><?php echo $this->_tpl_vars['ui']['state']; ?>
</td></tr>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['ui']['zip']): ?>
    <tr><td width="150"><label>Zip</label></td><td><?php echo $this->_tpl_vars['ui']['zip']; ?>
</td></tr>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['ui']['country']): ?>
    <tr><td width="150"><label>Country</label></td><td><?php $this->assign('ov', $this->_tpl_vars['ui']['country']);  echo $this->_tpl_vars['countries'][$this->_tpl_vars['ov']]; ?>
</td></tr>
    <?php endif; ?>
</table>