<?php /* Smarty version 2.6.11, created on 2014-03-15 09:09:49
         compiled from mods/friends/_list.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'mods/friends/_list.html', 18, false),array('function', 'html_str_format', 'mods/friends/_list.html', 21, false),)), $this); ?>
			
<?php if ($this->_tpl_vars['IS_USER']):  if ($this->_tpl_vars['ar_invites'] && $this->_tpl_vars['wh'] == 'invites'): ?>
<div class="cl_srch_list" id="inv_list_all">
    <h2>Invitations</h2>
    <span id="inv_list">
        <?php $_from = $this->_tpl_vars['ar_invites']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ik'] => $this->_tpl_vars['i']):
?>
        <div class="box001" l_frid="<?php echo $this->_tpl_vars['i']['uid']; ?>
">
            <div class="post-box">
                <div n_frid="<?php echo $this->_tpl_vars['i']['uid']; ?>
" class="post-box-bg00" style="min-height: 40px">
                    <div class="b-awatar"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
users/id<?php echo $this->_tpl_vars['i']['uid']; ?>
" ><img src="<?php if ($this->_tpl_vars['i']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['i']['fpath']; ?>
/s/s_<?php echo $this->_tpl_vars['i']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m66.jpg<?php endif; ?>" alt="<?php if ($this->_tpl_vars['i']['first_name'] || $this->_tpl_vars['i']['last_name']):  echo $this->_tpl_vars['i']['first_name']; ?>
 <?php echo $this->_tpl_vars['i']['last_name'];  else:  echo $this->_tpl_vars['i']['public_name'];  endif; ?>" /></a></div>

                    <div class="post-title2">
                        <b><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
"><?php if ($this->_tpl_vars['i']['first_name'] || $this->_tpl_vars['i']['last_name']):  echo $this->_tpl_vars['i']['first_name']; ?>
 <?php echo $this->_tpl_vars['i']['last_name'];  else:  echo $this->_tpl_vars['i']['public_name'];  endif; ?></a></b>
                    </div>
								<?php if ($this->_tpl_vars['i']['mes']): ?><p align="left" style="text-align: left"><?php echo $this->_tpl_vars['i']['mes']; ?>
</p><?php endif; ?>
                    <div class="aj-button" style="left:330px;width:200px;">
			<?php $this->assign('ifull_name', ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['i']['first_name'])) ? $this->_run_mod_handler('cat', true, $_tmp, ' ') : smarty_modifier_cat($_tmp, ' ')))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['i']['last_name']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['i']['last_name']))); ?>
			<?php $this->assign('cifull_name', $this->_tpl_vars['ifull_name']); ?>

                        <span class="aj-button02"><a href="javascript: void(0);" onclick="javascript: oSystem.SConfPopup( 'oFriends.InviteActAjax( <?php echo $this->_tpl_vars['i']['uid']; ?>
, 1, \'<?php echo $this->_tpl_vars['wh']; ?>
\' );', 'Please confirm you want to add <?php echo smarty_function_html_str_format(array('str' => $this->_tpl_vars['cifull_name']), $this);?>
 as a friend?', 'Accept' );">Accept</a></span>
                        <span class="aj-button01"><a href="javascript: void(0);" onclick="javascript: oSystem.SConfPopup( 'oFriends.InviteActAjax( <?php echo $this->_tpl_vars['i']['uid']; ?>
, 2, \'<?php echo $this->_tpl_vars['wh']; ?>
\' );', 'Please confirm you want to reject invitation from <?php echo smarty_function_html_str_format(array('str' => $this->_tpl_vars['cifull_name']), $this);?>
?' );">Decline</a></span>
                    </div>
                </div>
		            </div>
        </div>
	<?php endforeach; endif; unset($_from); ?>
    </span>
</div>
<?php elseif ($this->_tpl_vars['wh'] == 'invites'): ?>
<h2>Invitations</h2>
<div class="box001">
    <div class="post-box">
	There aren't any invitations
    </div>
</div>
<?php endif;  endif; ?>

<?php if ($this->_tpl_vars['ar_friends'] && ! $this->_tpl_vars['wh']): ?>
<div class="cl_srch_list">
    <h2><?php if ($this->_tpl_vars['mutual']): ?>Mutual <?php endif; ?>Friends<span style="font-size:16px;"><?php echo $this->_tpl_vars['cnt_ar_friends']; ?>
</span></h2>
    <div id="id_fr_mlist">
	<?php $_from = $this->_tpl_vars['ar_friends']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['frk'] => $this->_tpl_vars['fr']):
?>
        <div class="box001">
            <div class="post-box">
                <div class="post-box-bg00" style="height:70px;min-height: 70px !important;float:left; width: 300px;">

                    <div class="b-awatar"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['fr']['uid']; ?>
" ><img src="<?php if ($this->_tpl_vars['fr']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['fr']['fpath']; ?>
/s/s_<?php echo $this->_tpl_vars['fr']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m66.jpg<?php endif; ?>" alt="<?php if ($this->_tpl_vars['fr']['first_name'] || $this->_tpl_vars['fr']['last_name']):  echo $this->_tpl_vars['fr']['first_name']; ?>
 <?php echo $this->_tpl_vars['fr']['last_name'];  else:  echo $this->_tpl_vars['fr']['public_name'];  endif; ?>" /></a></div>

                    <div class="post-title2"><b><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['fr']['uid']; ?>
"><?php if ($this->_tpl_vars['fr']['first_name'] || $this->_tpl_vars['fr']['last_name']):  echo $this->_tpl_vars['fr']['first_name']; ?>
 <?php echo $this->_tpl_vars['fr']['last_name'];  else:  echo $this->_tpl_vars['fr']['public_name'];  endif; ?></a></b></div>
                    <?php if ($this->_tpl_vars['IS_USER']): ?>
                    <div style="position:absolute;margin-left: 260px; margin-top: -20px;">
                        <p><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['fr']['uid']; ?>
/friends/?mutual=1"><?php echo $this->_tpl_vars['fr']['mutual']; ?>
 mutual friend(s)</a></p>
                        <p><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['fr']['uid']; ?>
">Send a message</a></p>
                        <p><a href="javascript: void(0);" onclick="javascript: oFriends.SHConfirmPopup(1, 'id_confirm_friends_popup', '<?php echo $this->_tpl_vars['fr']['uid']; ?>
');">Unfriend</a></p>

                        <p id="blockFr<?php echo $this->_tpl_vars['fr']['uid']; ?>
" <?php if ($this->_tpl_vars['fr']['active'] == 3): ?>style="display:none;"<?php endif; ?>><a href="javascript: void(0);" onclick="javascript: oFriends.EditFrActive(<?php echo $this->_tpl_vars['fr']['uid']; ?>
, 3);">Block</a></p>
                        <p id="unblockFr<?php echo $this->_tpl_vars['fr']['uid']; ?>
" <?php if ($this->_tpl_vars['fr']['active'] != 3): ?>style="display:none;"<?php endif; ?>><a href="javascript: void(0);" onclick="javascript: oFriends.EditFrActive(<?php echo $this->_tpl_vars['fr']['uid']; ?>
, 1);">UnBlock</a></p>
			                    </div>
                    <?php endif; ?>
                </div>
                <div style="height:50px;">&nbsp;</div>

                            </div>
        </div>
	<?php endforeach; endif; unset($_from); ?>
    </div>
</div>
<span id="pagging"><?php echo $this->_tpl_vars['pagging']; ?>
</span>

<?php elseif (! $this->_tpl_vars['wh']): ?>
<h2>Friends</h2>
<div class="box001">
    <div class="post-box">
    There aren't any friends
    </div>
</div>
<?php endif; ?>