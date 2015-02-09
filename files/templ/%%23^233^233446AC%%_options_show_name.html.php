<?php /* Smarty version 2.6.11, created on 2014-03-15 08:51:29
         compiled from mods/users/ajax/_options_show_name.html */ ?>
<tr>
    <td width="150"><label>Name</label></td>
    <td><?php echo $this->_tpl_vars['uinfo']['first_name']; ?>
 <?php echo $this->_tpl_vars['uinfo']['mid_name']; ?>
 <?php echo $this->_tpl_vars['uinfo']['last_name']; ?>
</td>
    <td width="10"><a href="javascript:oUsers.OptionsEdit('name');"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
arr05.gif" alt="" /></a></td>
</tr>