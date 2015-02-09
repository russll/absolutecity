<?php /* Smarty version 2.6.11, created on 2014-03-15 08:51:29
         compiled from mods/users/ajax/_options_edit_name.html */ ?>
<tr><td width="150"><label>First name</label></td><td><input class="txt3" type="text" value="<?php echo $this->_tpl_vars['uinfo']['first_name']; ?>
" name="first_name" /></td></tr>
<tr><td width="150"><label>Middle name<br />(optional)</label></td><td><input class="txt3" type="text" value="<?php echo $this->_tpl_vars['uinfo']['mid_name']; ?>
"  name="mid_name" /></td></tr>
<tr><td width="150"><label>Last name</label></td><td><input class="txt3" type="text" value="<?php echo $this->_tpl_vars['uinfo']['last_name']; ?>
"  name="last_name" /></td></tr>
<tr style="height:50px;">
    <td colspan="2" align="right">
        <div class="aj-button">
            <span class="aj-button01"><a href="javascript:oUsers.OptionsCnl('name');">Cancel</a></span>
            <span class="aj-button02"><a href="javascript:oUsers.OptionsNameSubm();">Save</a></span>
        </div>
    </td>
</tr>