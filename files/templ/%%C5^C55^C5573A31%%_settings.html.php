<?php /* Smarty version 2.6.11, created on 2014-04-04 23:02:17
         compiled from mods/users/_settings.html */ ?>
    <script type="text/javascript" src="/j/jquery.scrollTo.js"></script>
    <script language="javascript">
    <?php if ($this->_tpl_vars['ed_basic']): ?>
    <?php echo '
    $(document).ready(function() {
        oUsers.SettingsBasic();
        jQuery.scrollTo(\'#basic_info\', 100);
    });
    '; ?>

    <?php endif; ?>
    <?php if ($this->_tpl_vars['ed_contact']): ?>
    <?php echo '
    $(document).ready(function() {
        oUsers.SettingsContacts();
        jQuery.scrollTo(\'#contacts_info\', 100);
    });
    '; ?>

    <?php endif; ?>
    <?php if ($this->_tpl_vars['ed_inerest']): ?>
    <?php echo '
    $(document).ready(function() {
        oUsers.SettingsInterest();
        jQuery.scrollTo(\'#interest_info\', 100);
    });
    '; ?>

    <?php endif; ?>
    <?php if ($this->_tpl_vars['ed_work']): ?>
    <?php echo '
    $(document).ready(function() {
        oUsers.SettingsEdu();
        jQuery.scrollTo(\'#edu_info\', 100);
    });
    '; ?>

    <?php endif; ?>
    <?php if ($this->_tpl_vars['ed_mission']): ?>
    <?php echo '
    $(document).ready(function() {
        oUsers.SettingsChurch();
        jQuery.scrollTo(\'#church_info\', 100);
    });
    '; ?>

    <?php endif; ?>
    </script>
<h2>My Info</h2>

<div class="my-info-box">
    <h4>Basic information</h4>
    <div id="basic_info" class="hb_box" onmouseover="$('#basic_edit').css('display', 'block');" onmouseout="$('#basic_edit').css('display', 'none');">
		<?php if ($this->_tpl_vars['basic_denied']): ?><center><h3>This section is set to private</h3></center><?php else:  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/users/ajax/_show_basic.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?>
    </div>


    <h4>Contact information</h4>
    <div id="contacts_info" class="hb_box" onmouseover="$('#contacts_edit').css('display', 'block');" onmouseout="$('#contacts_edit').css('display', 'none');">
    <?php if ($this->_tpl_vars['contact_denied']): ?><center><h3>This section is set to private</h3></center><?php else:  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/users/ajax/_show_contacts.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?>
    </div>


    <h4>Church-related information</h4>
    <div id="church_info" class="hb_box" onmouseover="$('#church_edit').css('display', 'block');" onmouseout="$('#church_edit').css('display', 'none');">
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/users/ajax/_show_church.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </div>


    <h4>Interests information</h4>
    <div id="interest_info" class="hb_box" onmouseover="$('#interest_edit').css('display', 'block');" onmouseout="$('#interest_edit').css('display', 'none');">
    <?php if ($this->_tpl_vars['pinfo_denied']): ?><center><h3>This section is set to private</h3></center><?php else:  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/users/ajax/_show_interest.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?>
    </div>

    <h4>Education/Work information</h4>
    <div id="edu_info" class="hb_box" onmouseover="$('#edu_edit').css('display', 'block');" onmouseout="$('#edu_edit').css('display', 'none');">
    <?php if ($this->_tpl_vars['edu_denied']): ?><center><h3>This section is set to private</h3></center><?php else:  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/users/ajax/_show_edu.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?>
    </div>
	
</div>
