<?php /* Smarty version 2.6.11, created on 2014-06-23 16:13:27
         compiled from mods/valbums/_list.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_str_format', 'mods/valbums/_list.html', 41, false),array('modifier', 'truncate', 'mods/valbums/_list.html', 41, false),)), $this); ?>
<?php if ($this->_tpl_vars['al_sys']): ?>
	<div id="id_valbums_system_list" class="cl_valbums_lists">
		<h2><span></span>System video Albums</h2>
		<?php $_from = $this->_tpl_vars['al_sys']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ak'] => $this->_tpl_vars['i']):
?>
			<?php if ('Inbox' != $this->_tpl_vars['i']['name'] || ( 'Inbox' == $this->_tpl_vars['i']['name'] && $this->_tpl_vars['IS_USER'] )): ?>
				<div class="box002">
					<div class="post-box" style="min-height: 45px">
											<?php if (( $this->_tpl_vars['i']['name'] == 'Wall' && $this->_tpl_vars['ui']['global']['news'] == 0 ) || ( $this->_tpl_vars['i']['name'] == 'Journal' && $this->_tpl_vars['ui']['global']['notes'] == 0 )): ?>
						<div class="b-awatar"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
no_photo_m66.jpg" alt="" style="width: 66px; height: 66px;"/></div>
						<div class="post-title2"><b><?php echo $this->_tpl_vars['i']['name']; ?>
</b></div>
						<p>This section is set to private</p>
											<?php else: ?>
						<div class="b-awatar"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
/valbums/id<?php echo $this->_tpl_vars['i']['vaid']; ?>
"><img src="<?php if ($this->_tpl_vars['i']['video_img']):  echo $this->_tpl_vars['i']['video_img'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m66.jpg<?php endif; ?>" alt="" style="width: 66px; height: 66px;" /></a></div>
						<div class="post-title2"><b><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
/valbums/id<?php echo $this->_tpl_vars['i']['vaid']; ?>
"><?php echo $this->_tpl_vars['i']['name']; ?>
</a></b></div>
						<p><b>Description:</b><?php if ($this->_tpl_vars['i']['descr']): ?> <?php echo $this->_tpl_vars['i']['descr']; ?>
 <?php else: ?> &nbsp <?php endif; ?></p>
						<?php if ($this->_tpl_vars['i']['cnt_video']): ?><p><b>Videos:</b> <?php echo $this->_tpl_vars['i']['cnt_video']; ?>
</p><?php endif; ?>
											<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
	</div>
<?php endif; ?>

<div id="id_valbums_user_list" class="cl_valbums_lists">
<?php if ($this->_tpl_vars['al'] && $this->_tpl_vars['ui']['global']['videos']): ?>
	<div class="cl_srch_list">
		<h2>Member's Video Albums</h2>
		<div id="id_new_alb_list" class="box002"></div>
		<span id="all_alb_list">
			<?php $_from = $this->_tpl_vars['al']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ak'] => $this->_tpl_vars['i']):
?>
			<div id="id_valbums_el_1_<?php echo $this->_tpl_vars['i']['vaid']; ?>
" vaid="<?php echo $this->_tpl_vars['i']['vaid']; ?>
" class="box002 cl_valbums_list">
				<div class="post-box" style="min-height: 45px">
					<div class="b-awatar"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
/valbums/id<?php echo $this->_tpl_vars['i']['vaid']; ?>
"><img src="<?php if ($this->_tpl_vars['i']['video_img']):  if (2 == $this->_tpl_vars['i']['type']):  if ('Wall' == $this->_tpl_vars['i']['name']): ?>wall/<?php elseif ('Mission' == $this->_tpl_vars['i']['name']): ?>mission/wall/<?php elseif ('Inbox' == $this->_tpl_vars['i']['name']): ?>inbox/<?php elseif ('Ward' == $this->_tpl_vars['i']['name']): ?>wards/wall/<?php endif;  else:  echo $this->_tpl_vars['i']['video_img'];  endif;  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m66.jpg<?php endif; ?>" alt="" style="width: 66px; height: 66px;" /></a></div>

					<div class="post-title2"><b><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
/valbums/id<?php echo $this->_tpl_vars['i']['vaid']; ?>
"><?php echo $this->_tpl_vars['i']['name']; ?>
</a></b></div>
					<p><b>Created:</b> <?php if ($this->_tpl_vars['i']['created']): ?> <?php echo $this->_tpl_vars['i']['created']; ?>
 <?php else: ?> &nbsp <?php endif; ?></p>
					<p><b>Description:</b><?php if ($this->_tpl_vars['i']['descr']): ?> <?php echo $this->_tpl_vars['i']['descr']; ?>
 <?php else: ?> &nbsp <?php endif; ?></p>
					<?php if ($this->_tpl_vars['i']['cnt_video']): ?><p><b>Videos:</b> <?php echo $this->_tpl_vars['i']['cnt_video']; ?>
</p><?php endif; ?>
					<?php $this->assign('asname', $this->_tpl_vars['i']['name']); ?>
					<?php if ($this->_tpl_vars['IS_USER']): ?><span class="cl_del_link" vaid="<?php echo $this->_tpl_vars['i']['vaid']; ?>
" style="margin-right: 5px;"><a href="javascript: void(0);" onclick="oSystem.SConfPopup( 'oValbums.DelAlbum( <?php echo $this->_tpl_vars['i']['vaid']; ?>
, <?php echo $this->_tpl_vars['i']['type']; ?>
 );', 'Please confirm you want to delete album  \'<?php echo smarty_function_html_str_format(array('str' => ((is_array($_tmp=$this->_tpl_vars['asname'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 30) : smarty_modifier_truncate($_tmp, 30))), $this);?>
\'?' );">&nbsp&nbsp&nbsp&nbsp</a></span><?php endif; ?>
				</div>
			</div>
			<?php endforeach; endif; unset($_from); ?>
		</span>
	</div>

	<?php elseif (! $this->_tpl_vars['ui']['global']['videos']): ?>
	<div class="cl_srch_list">
		<h2><span></span>Member's Video Albums</h2>
		<div id="id_new_alb_list" class="box002"></div>
		<div class="box001"><div class="post-box"><center><h3>This section is set to private</h3></center></div></div>
	</div>
			<?php else: ?>
	<h2><span></span>Member's Video Albums</h2>
	<div id="id_new_alb_list" class="box002"></div>
	<div class="box001">
		<div class="post-box">
			<?php if ($this->_tpl_vars['IS_USER']): ?>You don't have any albums<?php else: ?>This member doesn't have any albums<?php endif; ?>
		</div>
	</div>
			<?php endif; ?>
</div>