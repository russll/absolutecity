<?php /* Smarty version 2.6.11, created on 2014-04-09 23:57:30
         compiled from mods/profile/_wall_sm_stat_list.html */ ?>
<?php $this->assign('stats', $this->_tpl_vars['status_new']);  $_from = $this->_tpl_vars['stats']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ssk'] => $this->_tpl_vars['ssi']):
?>
<li>
    <div class="sm-stat-main">
    <img src="<?php echo $this->_tpl_vars['imgDir']; ?>
smile/<?php echo $this->_tpl_vars['ssk']; ?>
.png" />&nbsp;
    <?php if ($this->_tpl_vars['ssi']['cnt'] == 1): ?><span id="text_hide_<?php echo $this->_tpl_vars['ssk']; ?>
_<?php echo $this->_tpl_vars['i']['com_parent']; ?>
"><a href="javascript:void(0);" onclick="$('#popup_user_<?php echo $this->_tpl_vars['ssk']; ?>
_<?php echo $this->_tpl_vars['i']['com_parent']; ?>
').show();$('#text_hide_<?php echo $this->_tpl_vars['ssk']; ?>
_<?php echo $this->_tpl_vars['i']['com_parent']; ?>
').hide();"><?php echo $this->_tpl_vars['ssi']['cnt']; ?>
 person</a> <?php echo $this->_tpl_vars['status'][$this->_tpl_vars['ssk']]['1']; ?>
</span>
                        <?php else: ?><span><a href="javascript:void(0)" onclick="if ($('#popup_users_<?php echo $this->_tpl_vars['ssk']; ?>
_<?php echo $this->_tpl_vars['i']['com_parent']; ?>
').css('display')=='none') $('#popup_users_<?php echo $this->_tpl_vars['ssk']; ?>
_<?php echo $this->_tpl_vars['i']['com_parent']; ?>
').show(); else $('#popup_users_<?php echo $this->_tpl_vars['ssk']; ?>
_<?php echo $this->_tpl_vars['i']['com_parent']; ?>
').hide();"><?php echo $this->_tpl_vars['ssi']['cnt']; ?>
 persons</a> <?php echo $this->_tpl_vars['status'][$this->_tpl_vars['ssk']]['2']; ?>
</span>
    <?php endif; ?>
    </div>

    <div id="popup_user_<?php echo $this->_tpl_vars['ssk']; ?>
_<?php echo $this->_tpl_vars['i']['com_parent']; ?>
" class="popup_person" onmouseover="$('#popup_user_<?php echo $this->_tpl_vars['ssk']; ?>
_<?php echo $this->_tpl_vars['i']['com_parent']; ?>
').show();$('#text_hide_<?php echo $this->_tpl_vars['ssk']; ?>
_<?php echo $this->_tpl_vars['i']['com_parent']; ?>
').hide();" onmouseout="$('#popup_user_<?php echo $this->_tpl_vars['ssk']; ?>
_<?php echo $this->_tpl_vars['i']['com_parent']; ?>
').hide();$('#text_hide_<?php echo $this->_tpl_vars['ssk']; ?>
_<?php echo $this->_tpl_vars['i']['com_parent']; ?>
').show();" style="display:none;">
        <img src="<?php if ($this->_tpl_vars['ssi']['0']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['ssi']['0']['fpath']; ?>
/s/s_<?php echo $this->_tpl_vars['ssi']['0']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m56.jpg<?php endif; ?>" style="padding: 0 0 5px 2px;"/>&nbsp;
        <span><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ssi']['0']['suid']; ?>
"><?php echo $this->_tpl_vars['ssi']['0']['first_name'];  echo $this->_tpl_vars['ssi']['0']['last_name']; ?>
</a> <?php echo $this->_tpl_vars['status'][$this->_tpl_vars['ssk']]['1']; ?>
</span>
    </div>

    <div id="popup_users_<?php echo $this->_tpl_vars['ssk']; ?>
_<?php echo $this->_tpl_vars['i']['com_parent']; ?>
" class="popup_persons" onmouseover="$('#popup_users_<?php echo $this->_tpl_vars['ssk']; ?>
_<?php echo $this->_tpl_vars['i']['com_parent']; ?>
').show();" onmouseout="$('#popup_users_<?php echo $this->_tpl_vars['ssk']; ?>
_<?php echo $this->_tpl_vars['i']['com_parent']; ?>
').hide();" style="display:none;">
    <div class="popup_persns_header">People who <?php echo $this->_tpl_vars['status'][$this->_tpl_vars['ssk']]['2']; ?>
</div>
    <ul class="popup_persns_content">
        <?php $_from = $this->_tpl_vars['ssi']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ssname'] => $this->_tpl_vars['ssindex']):
?>
        <?php if (is_array ( $this->_tpl_vars['ssindex'] )): ?>
        <li>
            <img src="<?php if ($this->_tpl_vars['ssindex']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['ssindex']['fpath']; ?>
/s/s_<?php echo $this->_tpl_vars['ssindex']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m56.jpg<?php endif; ?>" style="padding: 0 0 5px 2px;"/>&nbsp;
            <span><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ssindex']['suid']; ?>
"><?php echo $this->_tpl_vars['ssindex']['first_name'];  echo $this->_tpl_vars['ssindex']['last_name']; ?>
</a></span>
        </li>
        <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?>
    </ul>
    </div>

 </li>
 <?php endforeach; endif; unset($_from); ?>