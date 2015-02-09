<?php /* Smarty version 2.6.11, created on 2014-05-05 06:41:37
         compiled from mods/friends/_friends_list_main_ajax.html */ ?>
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
no_photo_m66.jpg<?php endif; ?>" alt="" /></a></div>

            <div class="post-title2"><b><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['fr']['uid']; ?>
"><?php if ($this->_tpl_vars['fr']['first_name'] || $this->_tpl_vars['fr']['last_name']):  echo $this->_tpl_vars['fr']['first_name']; ?>
 <?php echo $this->_tpl_vars['fr']['last_name'];  else:  echo $this->_tpl_vars['fr']['public_name'];  endif; ?></a></b></div>
            <?php if ($this->_tpl_vars['IS_USER']): ?>
            <div style="position:absolute;margin-left: 260px; margin-top: -20px;">
                <?php if ($this->_tpl_vars['ui']['uid'] != $this->_tpl_vars['UserInfo']['uid']): ?>
                <p><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['fr']['uid']; ?>
">Send a message</a></p>
                <p><a href="javascript: void(0);" onclick="javascript: oFriends.SHConfirmPopup(1, 'id_confirm_friends_popup', '<?php echo $this->_tpl_vars['fr']['uid']; ?>
');">Unfriend</a></p><?php endif; ?>
                            </div>
            <?php endif; ?>
        </div>
        <div style="height:50px;">&nbsp;</div>

            </div>
</div>
<?php endforeach; endif; unset($_from);  if (empty ( $this->_tpl_vars['ar_friends'] )): ?>
<div class="box001">
        <div class="post-box">
                There aren't any friends
        </div>
</div>
<?php endif; ?>