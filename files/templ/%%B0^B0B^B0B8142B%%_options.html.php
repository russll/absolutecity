<?php /* Smarty version 2.6.11, created on 2014-03-15 08:51:29
         compiled from mods/users/_options.html */ ?>
<h2>Settings</h2>
<div class="settings-box">
    <h4>Account settings</h4>

    <table class="t-edit-line" id="name_info">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/users/ajax/_options_show_name.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </table>
    <form name="name_info_form" id="name_info_form">
    <table class="t-edit hidden" id="name_edit">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/users/ajax/_options_edit_name.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </table>
    </form>

    <table class="t-edit-line" id="email_info">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/users/ajax/_options_show_email.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </table>
    <form name="email_info_form" id="email_info_form">
    <table class="t-edit hidden" id="email_edit">
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/users/ajax/_options_edit_email.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </table>
    </form>

    <table class="t-edit-line" id="password_info">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/users/ajax/_options_show_password.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </table>
    <form name="pass_info_form" id="pass_info_form">
    <table class="t-edit hidden" id="password_edit">
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/users/ajax/_options_edit_password.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </table>
    </form>

    <table class="t-edit-line" id="question_info">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/users/ajax/_options_show_question.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </table>
    <form name="question_info_form" id="question_info_form">
    <table class="t-edit hidden" id="question_edit">
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/users/ajax/_options_edit_question.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </table>
    </form>

    <h4>Deleting your account</h4>
    <table class="t-edit-line" id="delete_info">
        <tr><td width="150"><a href="javascript:oUsers.OptionsEdit('delete');">Delete my account?</a></td><td>&nbsp;</td><td width="10"><a href="javascript:oUsers.OptionsEdit('delete');"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
arr05.gif"  /></a></td></tr>
    </table>
    <table class="t-edit hidden" id="delete_edit">
        <tr style="height: 50px;">
            <td colspan="2" align="right">
                <form name="delete_info_form" id="delete_info_form">
                    <div class="aj-button">
                        <span class="aj-button01"><a href="javascript:oUsers.OptionsCnl('delete');">No</a></span>
                        <span class="aj-button02"><a href="javascript:oUsers.OptionsDeleteSubm();">Yes</a></span>
                    </div>
                </form>
            </td>
        </tr>
    </table>

    <h4>Notification settings</h4>
    <table id="notify_info" class="t-edit-line">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/users/ajax/_options_show_notify.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </table>
    <form name="notify_info_form" id="notify_info_form">
    <table class="t-edit hidden" id="notify_edit">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/users/ajax/_options_edit_notify.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>    
    </table>
    </form>

    <h4>Privacy settings</h4>
    <table id="privacy_info" class="t-edit-line">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/users/ajax/_options_show_privacy.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </table>
    <form name="privacy_info_form" id="privacy_info_form">
    <table class="t-edit hidden" id="privacy_edit">
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/users/ajax/_options_edit_privacy.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </table>
    </form>
</div>