<?php /* Smarty version 2.6.11, created on 2014-11-30 13:30:45
         compiled from mods/users/ajax/_edit_contacts.html */ ?>
<form method="post" id="contacts_info_form">
<table class="t-edit">
    <tr><td width="150"><label>Real name</label></td><td><p id="contacts_name_b"><?php echo $this->_tpl_vars['fm']['first_name']; ?>
 <?php echo $this->_tpl_vars['fm']['last_name']; ?>
 &nbsp; <a href="javascript:void(0);" onclick="oUsers.SettingsContactsEditName();">Change</a></p>
            <input type="hidden" id="edit_name" name="fm[edit_name]" value="0" >
            <table id="contacts_name" style="margin:0; padding: 0;display:none;" cellpadding="0" cellspacing="0">
            <tr>
                <td><label>First name</label></td>
                <td><input class="txt" type="text" name="fm[first_name]" value="<?php echo $this->_tpl_vars['fm']['first_name']; ?>
"  /></td>
            </tr>
            <tr>
                <td><label>Last name</label></td>
                <td><input class="txt" type="text" name="fm[last_name]" value="<?php echo $this->_tpl_vars['fm']['last_name']; ?>
"  /></td>
            </tr>
            <tr><td></td><td><a href="javascript:void(0);" onclick="oUsers.SettingsContactsNoEditName();">Cancel</a></td></tr>
            </table>
        </td></tr>
    <tr><td width="150"><label>Email</label></td><td><p id="contacts_email_b"><?php echo $this->_tpl_vars['fm']['email']; ?>
 &nbsp; <a href="javascript:void(0);" onclick="oUsers.SettingsContactsEditEmail();">Change</a></p>
            <input type="hidden" id="edit_email" name="fm[edit_email]" value="0" >
            <table id="contacts_email" style="margin:0; padding: 0;display:none;" cellpadding="0" cellspacing="0">
            <tr>
                <td><input class="txt" type="text" name="fm[email]" value="<?php echo $this->_tpl_vars['fm']['email']; ?>
"  /></td>
            </tr>
            <tr><td><a href="javascript:void(0);" onclick="oUsers.SettingsContactsNoEditEmail();">Cancel</a></td></tr>
            </table>

        </td></tr>
    <tr>
        <td width="150"><label>IM Screen name</label></td>
        <td>
            <table id="contacts_im" style="margin:0; padding: 0;" cellpadding="0" cellspacing="0">
            <?php $_from = $this->_tpl_vars['im']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
            <tr>
                <td><input class="txt3" type="text" name="fm[im_name][]" value="<?php echo $this->_tpl_vars['fm']['im_name'][$this->_tpl_vars['k']]; ?>
" /></td>
                <td><span class="niceform"><select name="fm[im_type][]" size="1">
                    <option value="0">Select</option>
                    <?php $_from = $this->_tpl_vars['ims']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k2'] => $this->_tpl_vars['i2']):
?>
                    <option value="<?php echo $this->_tpl_vars['k2']; ?>
"<?php if ($this->_tpl_vars['k2'] == $this->_tpl_vars['fm']['im_type'][$this->_tpl_vars['k']]): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['i2']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                    </select></span></td>
                <td><div style="margin-top: 3px;"><a href="javascript:void(0);" onclick="oUsers.SettingsContactsDelIm( $(this).parent().parent().parent() );">Clear</a></div></td>
            </tr>
            <?php endforeach; endif; unset($_from); ?>
            </table>
            <div><a href="javascript:oUsers.SettingsContactsAddIm();">Add another IM</a></div>
        </td>
    </tr>
    <tr><td width="150"><label>Mobile phone</label></td><td><input class="txt" type="text" name="fm[mob_phone]" value="<?php echo $this->_tpl_vars['fm']['mob_phone']; ?>
"  /></td></tr>
    <tr><td width="150"><label>Land phone</label></td><td><input class="txt" type="text" name="fm[land_phone]" value="<?php echo $this->_tpl_vars['fm']['land_phone']; ?>
"  /></td></tr>
    <tr><td width="150"><label>Address</label></td><td><input class="txt" type="text" name="fm[address]" value="<?php echo $this->_tpl_vars['fm']['address']; ?>
"  /></td></tr>
    <tr><td width="150"><label>City/town</label></td><td><input class="txt" type="text" name="fm[city]" value="<?php echo $this->_tpl_vars['fm']['city']; ?>
"  /></td></tr>
    <tr><td width="150"><label>State/Province</label></td><td><input class="txt" type="text" name="fm[state]" value="<?php echo $this->_tpl_vars['fm']['state']; ?>
"  /></td></tr>
    <tr><td width="150"><label>Zip</label></td><td><input class="txt" type="text" name="fm[zip]" value="<?php echo $this->_tpl_vars['fm']['zip']; ?>
"  /></td></tr>
    <tr>
        <td width="150"><label>Country</label></td>
        <td><span class="niceform"><select name="fm[country]" size="1" style="width:245px;">
            <?php $_from = $this->_tpl_vars['countries']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                <option value="<?php echo $this->_tpl_vars['k']; ?>
"<?php if ($this->_tpl_vars['k'] == $this->_tpl_vars['fm']['country']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['i']; ?>
</option>
            <?php endforeach; endif; unset($_from); ?>
            </select></span></td>
    </tr>
    <tr style="height:50px;">
        <td colspan="2" align="right">
            <div class="aj-button">
                    <span class="aj-button01"><a href="javascript:void(0);" id="contacts_cancel" onclick="oUsers.SettingsContactsCnl();">Cancel</a></span>
                    <span class="aj-button02"><a href="javascript:void(0);" id="contacts_save" onclick="oUsers.SettingsContactsSubm();">Save</a></span>
            </div>
        </td>
    </tr>
</table>
</form>