<?php /* Smarty version 2.6.11, created on 2014-08-07 16:12:36
         compiled from mods/users/ajax/_edit_interest.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'mods/users/ajax/_edit_interest.html', 8, false),array('modifier', 'trim', 'mods/users/ajax/_edit_interest.html', 8, false),)), $this); ?>
<form method="post" id="interest_info_form">
<table class="t-edit">
    <?php $_from = $this->_tpl_vars['interests_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
    <tr><td width="150"><label><?php echo $this->_tpl_vars['i']; ?>
</label></td><td><textarea name="fm[interests_list][<?php echo $this->_tpl_vars['k']; ?>
]"><?php echo $this->_tpl_vars['fm']['interests_list'][$this->_tpl_vars['k']]['story']; ?>
</textarea></td><td style="width:30px;">&nbsp;</td></tr>
    <?php endforeach; endif; unset($_from); ?>
    <tbody id="interest_list">
    <?php $_from = $this->_tpl_vars['interests']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
    <tr<?php if (1 == count($this->_tpl_vars['interests']) && '' == ((is_array($_tmp=$this->_tpl_vars['fm']['interests']['0'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp))): ?> style="display:none;"<?php endif; ?>>
        <td width="150" style="text-align:right"><input class="txt2" name="fm[interests][]" type="text" value="<?php echo $this->_tpl_vars['fm']['interests'][$this->_tpl_vars['k']]; ?>
" /></td>
        <td><textarea name="fm[interests_story][]"><?php echo $this->_tpl_vars['fm']['interests_story'][$this->_tpl_vars['k']]; ?>
</textarea></td>
        <td style="vertical-align:middle;padding-right:10px;"><a href="javascript:void(0);" onclick="oUsers.SettingsInterestDel( $(this).parent().parent() );"><img src="/i/close_ico3.gif" /></a></td></tr>
    <?php endforeach; endif; unset($_from); ?>
    </tbody>
    <tr><td width="150"></td><td><a href="javascript:void(0);" onclick="oUsers.SettingsInterestAdd();">Add another interest</a></td><td>&nbsp;</td></tr>

    <tr style="height:50px;">
        <td colspan="2" align="right">
            <div class="aj-button">
                <span class="aj-button01"><a href="javascript:void(0);" id="basic_cancel" onclick="oUsers.SettingsInterestCnl();">Cancel</a></span>
                <span class="aj-button02"><a href="javascript:void(0);" id="basic_save" onclick="oUsers.SettingsInterestSubm();">Save</a></span>
            </div>
        </td>
    </tr>
</table>
</form>