<?php /* Smarty version 2.6.11, created on 2014-03-15 08:51:29
         compiled from mods/users/ajax/_options_edit_privacy.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'mods/users/ajax/_options_edit_privacy.html', 3, false),)), $this); ?>
<tr>
    <td width="150"><label>News feed</label></td>
    <td><span class="niceform"><select size="1" name="privacy[news]"><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['privacyArr'],'selected' => $this->_tpl_vars['uinfo']['privacy_news']), $this);?>
</select></span></td>
</tr>
<tr>
    <td width="150"><label>Basic information</label></td>
    <td><span class="niceform"><select size="1" name="privacy[basic]"><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['privacyArr'],'selected' => $this->_tpl_vars['uinfo']['privacy_basic']), $this);?>
</select></span></td>
</tr>
<tr>
    <td width="150"><label>Contact Information</label></td>
    <td><span class="niceform"><select size="1" name="privacy[contact]"><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['privacyArr'],'selected' => $this->_tpl_vars['uinfo']['privacy_contact']), $this);?>
</select></span></td>
</tr>
        
<tr>
    <td width="150"><label>Interests</label></td>
    <td><span class="niceform"><select size="1" name="privacy[pinfo]"><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['privacyArr'],'selected' => $this->_tpl_vars['uinfo']['privacy_pinfo']), $this);?>
</select></span></td>
</tr>

<tr>
    <td width="150"><label>Education/Work</label></td>
    <td><span class="niceform"><select size="1" name="privacy[edu_work]"><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['privacyArr'],'selected' => $this->_tpl_vars['uinfo']['privacy_edu_work']), $this);?>
</select></span></td>
</tr>

<tr>
    <td width="150"><label>Photos</label></td>
    <td><span class="niceform"><select size="1" name="privacy[photo]"><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['privacyArr'],'selected' => $this->_tpl_vars['uinfo']['privacy_photo']), $this);?>
</select></span></td>
</tr>
<tr>
    <td width="150"><label>Videos</label></td>
    <td><span class="niceform"><select size="1" name="privacy[video]"><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['privacyArr'],'selected' => $this->_tpl_vars['uinfo']['privacy_video']), $this);?>
</select></span></td>
</tr>
<tr>
    <td width="150"><label>Journal</label></td>
    <td><span class="niceform"><select size="1" name="privacy[notes]"><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['privacyArr'],'selected' => $this->_tpl_vars['uinfo']['privacy_notes']), $this);?>
</select></span></td>
</tr>
<tr style="height:50px;">
    <td colspan="2" align="right">
        <div class="aj-button">
            <span class="aj-button01"><a href="javascript:oUsers.OptionsCnl('privacy');">Cancel</a></span>
            <span class="aj-button02"><a href="javascript:oUsers.OptionsPrivacySubm();">Save</a></span>
        </div>
    </td>
</tr>