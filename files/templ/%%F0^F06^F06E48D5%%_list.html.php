<?php /* Smarty version 2.6.11, created on 2014-04-23 21:00:32
         compiled from mods/albums/_list.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_str_format', 'mods/albums/_list.html', 47, false),array('modifier', 'truncate', 'mods/albums/_list.html', 47, false),)), $this); ?>
			<?php if ($this->_tpl_vars['al_sys']): ?>
				<div id="id_albums_system_list" class="cl_albums_lists">
					<h2><span></span>System Albums</h2>
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
/albums/id<?php echo $this->_tpl_vars['i']['aid']; ?>
"><img src="<?php if ($this->_tpl_vars['i']['img']['img']):  if ($this->_tpl_vars['i']['img']['fpath'] == 'link'):  echo $this->_tpl_vars['i']['img']['img'];  else:  echo $this->_tpl_vars['fImgDir'];  if (2 == $this->_tpl_vars['i']['type']):  if ('Wall' == $this->_tpl_vars['i']['name']): ?>wall/<?php elseif ('Journal' == $this->_tpl_vars['i']['name']): ?>journal/<?php elseif ('Inbox' == $this->_tpl_vars['i']['name']): ?>inbox/<?php elseif ('Mission' == $this->_tpl_vars['i']['name']): ?>mission/wall/<?php elseif ('Ward' == $this->_tpl_vars['i']['name']): ?>wards/wall/<?php endif;  else: ?>albums/<?php endif;  echo $this->_tpl_vars['i']['img']['fpath']; ?>
/m/m_<?php echo $this->_tpl_vars['i']['img']['img']; ?>
 <?php endif;  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m66.jpg<?php endif; ?>" alt="" style="width: 66px; height: 66px;"/></a></div>
								<div class="post-title2"><b><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
/albums/id<?php echo $this->_tpl_vars['i']['aid']; ?>
"><?php echo $this->_tpl_vars['i']['name']; ?>
</a></b></div>
								<?php if ($this->_tpl_vars['i']['descr']): ?><p><b>Description:</b> <?php echo $this->_tpl_vars['i']['descr']; ?>
</p><?php endif; ?>
							<?php endif; ?>
						</div>
					</div>
					<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?>
				</div>
			<?php endif; ?>
			<div id="id_albums_user_list" class="cl_albums_lists">
				<?php if ($this->_tpl_vars['al'] && $this->_tpl_vars['ui']['global']['photos']): ?>
					<div class="cl_srch_list">
						<h2>User's Albums</h2>
						<div id="id_new_alb_list" class="box002"></div>
						<span id="all_alb_list">
						<?php $_from = $this->_tpl_vars['al']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ak'] => $this->_tpl_vars['i']):
?>
							<div id="id_albums_el_1_<?php echo $this->_tpl_vars['i']['aid']; ?>
" aid="<?php echo $this->_tpl_vars['i']['aid']; ?>
" class="box002 cl_albums_list" onMouseOver="$('#id_albums_el_1_<?php echo $this->_tpl_vars['i']['aid']; ?>
 .cl_del_link').show();" onMouseOut="$('.cl_albums_list .cl_del_link').hide();">
								<div class="post-box" style="min-height: 45px">
									<div class="b-awatar">
										<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
/albums/id<?php echo $this->_tpl_vars['i']['aid']; ?>
">
											<img src="<?php if ($this->_tpl_vars['i']['img']['img']):  if ($this->_tpl_vars['i']['img']['fpath'] == 'link'):  echo $this->_tpl_vars['i']['img']['img'];  else:  echo $this->_tpl_vars['fImgDir'];  if (2 == $this->_tpl_vars['i']['type']):  if ('Wall' == $this->_tpl_vars['i']['name']): ?>wall/<?php elseif ('Journal' == $this->_tpl_vars['i']['name']): ?>journal/<?php elseif ('Mission' == $this->_tpl_vars['i']['name']): ?>mission/wall/<?php elseif ('Ward' == $this->_tpl_vars['i']['name']): ?>wards/wall/<?php endif;  else: ?>albums/<?php endif;  echo $this->_tpl_vars['i']['img']['fpath']; ?>
/m/m_<?php echo $this->_tpl_vars['i']['img']['img']; ?>
 <?php endif;  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m66.jpg<?php endif; ?>"
													alt="" style="width: 66px; height: 66px;" />
										</a>
									</div>

									<div class="post-title2 max398">
										<b><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
/albums/id<?php echo $this->_tpl_vars['i']['aid']; ?>
"><?php echo $this->_tpl_vars['i']['name']; ?>
</a></b> <?php if ($this->_tpl_vars['i']['aptype'] > 0): ?><small style="color:gray;">(Shared for <?php echo $this->_tpl_vars['i']['aptype_t']; ?>
)</small><?php endif; ?>
									</div>
									<p><b>Created:</b> <?php if ($this->_tpl_vars['i']['created']): ?> <?php echo $this->_tpl_vars['i']['created']; ?>
 <?php else: ?> &nbsp; <?php endif; ?></p>
									<?php if ($this->_tpl_vars['i']['descr']): ?><p><b>Description:</b> <?php echo $this->_tpl_vars['i']['descr']; ?>
</p><?php endif; ?>
									<?php if ($this->_tpl_vars['i']['location']): ?><p><b>Location:</b> <?php echo $this->_tpl_vars['i']['location']; ?>
</p><?php endif; ?>
									<?php if ($this->_tpl_vars['i']['cnt_img']): ?><p><b>Photos:</b> <?php echo $this->_tpl_vars['i']['cnt_img']; ?>
</p><?php endif; ?>
									<?php $this->assign('asname', $this->_tpl_vars['i']['name']); ?>
									<?php if ($this->_tpl_vars['IS_USER']): ?><span class="cl_del_link" aid="<?php echo $this->_tpl_vars['i']['aid']; ?>
" style="margin-right: 5px;"><a href="javascript: void(0);" onclick="javascript: oSystem.SConfPopup( 'oAlbums.DelAlbum( <?php echo $this->_tpl_vars['i']['aid']; ?>
, <?php echo $this->_tpl_vars['i']['type']; ?>
 );', 'Please confirm you want to delete album \'<?php echo smarty_function_html_str_format(array('str' => ((is_array($_tmp=$this->_tpl_vars['asname'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 30) : smarty_modifier_truncate($_tmp, 30))), $this);?>
\'?' );">&nbsp&nbsp&nbsp&nbsp</a></span><?php endif; ?></div>
							</div>
						<?php endforeach; endif; unset($_from); ?>
						</span>
					</div>
				<?php elseif (! $this->_tpl_vars['ui']['global']['photos']): ?>
					<div class="cl_srch_list">
						<h2><span></span>User's Albums</h2>
						<div id="id_new_alb_list" class="box002"></div>
						<div class="box001"><div class="post-box"><center><h3>This section is set to private</h3></center></div></div>
					</div>
				<?php else: ?>
					<div class="cl_srch_list">
						<h2><span></span>User's Albums</h2>
						<div id="id_new_alb_list" class="box002"></div>
						<div class="box001"><div class="post-box"><?php if (IS_USER): ?>You don't have any albums<?php else: ?>This member doesn't have any albums<?php endif; ?></div></div>
					</div>
				<?php endif; ?>
			</div>