<?php /* Smarty version 2.6.11, created on 2014-05-05 06:38:30
         compiled from mods/friends/_subscr_list_ajax.html */ ?>
            <?php if ($this->_tpl_vars['ar_subscr']): ?>
				<?php $_from = $this->_tpl_vars['ar_subscr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sk'] => $this->_tpl_vars['subsc']):
?>
				<div class="box001">
					<div class="post-box">
						<div class="post-box-bg00" style="min-height: 40px">
							<div class="b-awatar"><a href="javascript: void(0);" onclick="javascript: $('#id_dropbox_subsc_<?php echo $this->_tpl_vars['i']['uid']; ?>
').slideToggle('slow');"><img src="<?php if ($this->_tpl_vars['subsc']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['subsc']['fpath']; ?>
/s/s_<?php echo $this->_tpl_vars['subsc']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m66.jpg<?php endif; ?>"  style="width: 66px; height: 66px;" /></a></div>

							<div class="post-title2"><b><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['subsc']['uid']; ?>
"><?php if ($this->_tpl_vars['subsc']['first_name'] || $this->_tpl_vars['subsc']['last_name']):  echo $this->_tpl_vars['subsc']['first_name']; ?>
 <?php echo $this->_tpl_vars['subsc']['last_name'];  else:  echo $this->_tpl_vars['subsc']['public_name'];  endif; ?></a></b></div>
						</div>
						<br />
						<div id="id_dropbox_subsc_<?php echo $this->_tpl_vars['subsc']['uid']; ?>
" class="dropbox00" style="position: absolute">
							<div class="dropbox00-left">
							<div class="dropbox00-right">
								<ul><li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['subsc']['uid']; ?>
">Send a message</a></li></ul>
								<p><a class="user_report" href="javascript:void(0);" onclick="oUsers.ReportUser($(this), '<?php echo $this->_tpl_vars['subsc']['uid']; ?>
');">Report this user</a></p>
							</div>
							</div>
						</div>
					</div>
				</div>
				<?php endforeach; endif; unset($_from); ?>
			<?php endif; ?>

			<?php if ($this->_tpl_vars['ar_subscribition']): ?>
				<?php $_from = $this->_tpl_vars['ar_subscribition']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sk'] => $this->_tpl_vars['subsc']):
?>
				<div class="box001">
					<div class="post-box">
						<div class="post-box-bg00" style="min-height: 40px">
							<div class="b-awatar"><a href="javascript: void(0);" onclick="javascript: $('#id_dropbox_subsc_<?php echo $this->_tpl_vars['i']['wuid']; ?>
').slideToggle('slow');"><img src="<?php if ($this->_tpl_vars['subsc']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['subsc']['fpath']; ?>
/s/s_<?php echo $this->_tpl_vars['subsc']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m66.jpg<?php endif; ?>"  style="width: 66px; height: 66px;" /></a></div>

							<div class="post-title2"><b><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['subsc']['wuid']; ?>
"><?php if ($this->_tpl_vars['subsc']['first_name'] || $this->_tpl_vars['subsc']['last_name']):  echo $this->_tpl_vars['subsc']['first_name']; ?>
 <?php echo $this->_tpl_vars['subsc']['last_name'];  else:  echo $this->_tpl_vars['subsc']['public_name'];  endif; ?></a></b></div>
						</div>
						<br />
						<div id="id_dropbox_subsc_<?php echo $this->_tpl_vars['subsc']['wuid']; ?>
" class="dropbox00" style="position: absolute">
							<div class="dropbox00-left">
							<div class="dropbox00-right">
								<ul><li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['subsc']['wuid']; ?>
">Send a message</a></li></ul>
								<p><a class="user_report" href="javascript:void(0);" onclick="oUsers.ReportUser($(this), '<?php echo $this->_tpl_vars['subsc']['uid']; ?>
');">Report this user</a></p>
							</div>
							</div>
						</div>
					</div>
				</div>
				<?php endforeach; endif; unset($_from); ?>
			<?php endif; ?>