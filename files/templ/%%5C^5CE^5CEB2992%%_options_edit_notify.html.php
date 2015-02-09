<?php /* Smarty version 2.6.11, created on 2014-03-15 08:51:29
         compiled from mods/users/ajax/_options_edit_notify.html */ ?>
<tr><td width="150"><label>Send notifications to</label></td><td><input style="margin-bottom:0" class="txt3" type="text" id="email_notify" name="notify[email]" value="<?php echo $this->_tpl_vars['uinfo']['notify_email']; ?>
" /></td></tr>
<tr>
    <td width="150"><label style="margin-top:0">News feed activity</label></td>
    <td><b class="jNice"><input type="checkbox" id="notify_news" name="notify[news]" <?php if ($this->_tpl_vars['uinfo']['notify_news']): ?>checked<?php endif; ?> /></b></td>
</tr>
<tr>
    <td width="150"><label style="margin-top:0">Ward activity</label></td>
    <td><b class="jNice"><input type="checkbox" id="notify_ward" name="notify[ward]" <?php if ($this->_tpl_vars['uinfo']['notify_ward']): ?>checked<?php endif; ?> /></b></td>
</tr>
<tr>
    <td width="150"><label style="margin-top:0">Photo album activity</label></td>
    <td><b class="jNice"><input type="checkbox" id="notify_photo" name="notify[photo]" <?php if ($this->_tpl_vars['uinfo']['notify_photo']): ?>checked<?php endif; ?> /></b></td>
</tr>
<tr>
    <td width="150"><label style="margin-top:0">Videos activity</label></td>
    <td><b class="jNice"><input type="checkbox"  id="notify_video" name="notify[video]" <?php if ($this->_tpl_vars['uinfo']['notify_video']): ?>checked<?php endif; ?> /></b></td>
</tr>
        
<tr style="height:50px;">
    <td colspan="2" align="right">
        <div class="aj-button">
            <span class="aj-button01"><a href="javascript:oUsers.OptionsCnl('notify');">Cancel</a></span>
            <span class="aj-button02"><a href="javascript:oUsers.OptionsNotifySubm();">Save</a></span>
        </div>
    </td>
</tr>	