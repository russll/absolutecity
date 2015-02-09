<?php /* Smarty version 2.6.11, created on 2014-05-29 02:31:01
         compiled from _footer.html */ ?>
<div class="footer">
	<ul>
		<li><p><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
about_us.html" style="color:#FFF;"><b>About inZion</b></a></p></li>
        <li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
privacy.html">Privacy</a></li>
		<li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
terms.html">Terms</a></li>
        <li>&nbsp;</li>
	</ul>
	<ul>
			<li><p><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
contact_us.html" style="color:#FFF;"><b>Contact Us</b></a></p></li>
		<li><img src="/i/ico_twitter.png" alt="" style="float:left;" /><a href="http://www.twitter.com/inzioncom" target="_blank" style="margin-left:5px;">Follow us</a></li>
        <li><img src="/i/ico_fb.png" alt="" style="margin-left:3px;float:left;" /><a href="http://www.facebook.com/#!/pages/inZioncom-LDS-Social-Networking-and-Messaging-System/114617301897852" style="margin-left:6px;" target="_blank">Like us</a></li>
	</ul>
	<ul>
		<li><p><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
donate.html" style="color:#FFF;"><b>Donate</b></a></p></li>
		<li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
base/index/faq">FAQ</a></li>
                <?php if ($this->_tpl_vars['system_login']): ?>
                <li><a href="javascript:void(0);" onclick="$('#show_invite').show();">Invite friends</a></li>
                <?php endif; ?>
                	</ul>
	<div>© 2014 In Zion, Inc. All rights reserved.</div>
</div>