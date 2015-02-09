<?php /* Smarty version 2.6.11, created on 2014-05-22 13:14:38
         compiled from mods/Security/Users.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'mods/Security/Users.html', 31, false),)), $this); ?>
<div class="content">
	<div id="leftbar">
	  <h1>&nbsp;</h1>
	</div>
    
	<div id="rightbar">
        <div style="padding-bottom:10px;">
            Search users: <input type="text" id="str" name="str" value="<?php echo $this->_tpl_vars['str']; ?>
" />
            <input type="button" value="Search" onclick="Go('<?php echo $this->_tpl_vars['siteAdr']; ?>
security/users/indexadmin?str='+$('#str').val());" />
            <?php if ($this->_tpl_vars['str']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
security/users/indexadmin">Clear</a><?php endif; ?>
        </div>
        <div style="padding-bottom:10px;padding-left:130px;">
            Search users IP addresses: <input type="text" id="ipstr" name="str" value="<?php echo $this->_tpl_vars['ip_str']; ?>
" />
            <input type="button" value="Search" onclick="Go('<?php echo $this->_tpl_vars['siteAdr']; ?>
security/users/indexadmin?ipstr='+$('#ipstr').val());" />
            <?php if ($this->_tpl_vars['ip_str']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
security/users/indexadmin">Clear</a><?php endif; ?>
        </div>

		<table class="table01">
            <tr>
                <th style="width:30px;">ID</th>
				<th style="width:120px;">Email</th>
				<th style="width:120px;">Name</th>
				<th style="width:120px;">IP address</th>
				<th style="width:40px;">Status</th>
				<th></th>
				<th style="width:200px;text-align:center; font-weight: normal;">Actions</th>
			</tr>
			<?php $_from = $this->_tpl_vars['pl']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
			<tr class="td01">
			 	<td class="green-txt"><?php echo $this->_tpl_vars['i']['uid']; ?>
</td>
                                <td class="green-txt"><p><a href="mailto:<?php echo $this->_tpl_vars['i']['email']; ?>
" style="color:#230022;font-size:11px;"><?php echo ((is_array($_tmp=$this->_tpl_vars['i']['email'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 20) : smarty_modifier_truncate($_tmp, 20)); ?>
</a></p></td>
				<td class="green-txt"><?php echo $this->_tpl_vars['i']['first_name']; ?>
 <?php echo $this->_tpl_vars['i']['last_name']; ?>
</td>
				<td class="green-txt"><?php echo $this->_tpl_vars['i']['last_ip']; ?>
</td>
				<td class="green-txt"><?php if ($this->_tpl_vars['i']['is_deleted']): ?><font color="red">Deleted</font><?php elseif ($this->_tpl_vars['i']['rchecksum']): ?><font color="blue">Not active</font><?php else: ?>Active<?php endif; ?></td>
				<td class="green-txt"><?php if ($this->_tpl_vars['i']['login'] != 'admin'):  if ($this->_tpl_vars['i']['active']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
security/users/active/?uid=<?php echo $this->_tpl_vars['i']['uid']; ?>
">Active</a><?php else: ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
security/users/active/?uid=<?php echo $this->_tpl_vars['i']['uid']; ?>
" style="color: red;">Not active</a><?php endif;  else: ?><b>Active</b><?php endif; ?></td>
                                <td style="text-align:center"><a href="/id<?php echo $this->_tpl_vars['i']['uid']; ?>
" style="color: #004A79;" target="_blank">Show</a><?php if ($this->_tpl_vars['i']['uid'] != 1 && ! $this->_tpl_vars['i']['is_deleted']): ?>|<a href="javascript: CGo('<?php echo $this->_tpl_vars['siteAdr']; ?>
security/users/del/?uid=<?php echo $this->_tpl_vars['i']['uid']; ?>
', 'Do yo want to delete this user?');" style="color: #004A79;">Delete</a><?php endif; ?>| <?php if ($this->_tpl_vars['i']['uid'] != 1 && ! $this->_tpl_vars['i']['is_deleted']): ?>|<a <?php if ($this->_tpl_vars['i']['ip_block']): ?>href="javascript: CGo('<?php echo $this->_tpl_vars['siteAdr']; ?>
security/users/block/?uid=<?php echo $this->_tpl_vars['i']['uid']; ?>
', 'Do yo want to unblock this user?');"<?php else: ?>href="javascript: CGo('<?php echo $this->_tpl_vars['siteAdr']; ?>
security/users/block/?uid=<?php echo $this->_tpl_vars['i']['uid']; ?>
', 'Do yo want to block this user?');"<?php endif; ?> style="color: #004A79;"><?php if ($this->_tpl_vars['i']['ip_block']): ?>Unblock<?php else: ?>Block<?php endif; ?></a><?php endif; ?>|<a href="javascript: CGo('<?php echo $this->_tpl_vars['siteAdr']; ?>
security/users/loginas/?uid=<?php echo $this->_tpl_vars['i']['uid']; ?>
', 'Выполнить вход под пользователем? При этом вы выйдете из админки?');">Enter</a>
                                </td>
			</tr>
            <?php endforeach; endif; unset($_from); ?>
			
		</table>
		<?php echo $this->_tpl_vars['pagging']; ?>

		
	</div>
</div>