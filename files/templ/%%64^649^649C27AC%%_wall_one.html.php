<?php /* Smarty version 2.6.11, created on 2014-04-23 21:03:58
         compiled from mods/profile/_wall_one.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'mods/profile/_wall_one.html', 25, false),array('modifier', 'nl2br', 'mods/profile/_wall_one.html', 31, false),array('modifier', 'dlong', 'mods/profile/_wall_one.html', 101, false),array('function', 'html_tmpl_time', 'mods/profile/_wall_one.html', 37, false),)), $this); ?>
		<div id="id_wall_mes_<?php echo $this->_tpl_vars['mai']['com_parent']; ?>
" mid="<?php echo $this->_tpl_vars['mai']['com_parent']; ?>
" class="box001 cl_wall_mes" onmouseover="$('#tl_<?php echo $this->_tpl_vars['mai']['com_parent']; ?>
').show();" onmouseout="$('#tl_<?php echo $this->_tpl_vars['mai']['com_parent']; ?>
').hide();">
			<div class="post-box">
				<div class="post-box-bg<?php if (5 == $this->_tpl_vars['mai']['ptype']): ?>04<?php elseif (4 == $this->_tpl_vars['mai']['ptype']): ?>05<?php elseif (3 == $this->_tpl_vars['mai']['ptype']): ?>02<?php elseif (2 == $this->_tpl_vars['mai']['ptype']): ?>03<?php elseif (1 == $this->_tpl_vars['mai']['ptype']): ?>01<?php else: ?>00<?php endif; ?>" style="min-height: 68px">
				<?php if (! empty ( $this->_tpl_vars['mai']['ptype'] )): ?><em><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico<?php if (5 == $this->_tpl_vars['mai']['ptype']): ?>07_<?php elseif (4 == $this->_tpl_vars['mai']['ptype']): ?>06<?php elseif (3 == $this->_tpl_vars['mai']['ptype']): ?>05_<?php elseif (2 == $this->_tpl_vars['mai']['ptype']): ?>04_<?php elseif (1 == $this->_tpl_vars['mai']['ptype']): ?>03<?php endif; ?>.png"  /></em><?php endif; ?>

				<div class="b-awatar"><a href="javascript: void(0);" onclick="$('#id_dropbox_<?php echo $this->_tpl_vars['mai']['com_parent']; ?>
').slideToggle('slow');"><img src="<?php if ($this->_tpl_vars['mai']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['mai']['fpath']; ?>
/s/s_<?php echo $this->_tpl_vars['mai']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m66.jpg<?php endif; ?>"  <?php if ($this->_tpl_vars['mai']['uid'] == $this->_tpl_vars['UserInfo']['uid']): ?>class="small_avatar"<?php endif; ?>/></a>
				<!-- Drop00 -->
				<?php if ($this->_tpl_vars['mai']['uid'] != $this->_tpl_vars['UserInfo']['uid']): ?>
				<div id="id_dropbox_<?php echo $this->_tpl_vars['mai']['com_parent']; ?>
" class="dropbox00">
					<div class="dropbox00-left">
					<div class="dropbox00-right">
						<ul><li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['mai']['uid']; ?>
">Send a message</a></li></ul>
						<p><?php if (! $this->_tpl_vars['mai']['relations']['im_friend']): ?><a href="javascript: void(0);" onclick="oFriends.GetFrAjax('<?php echo $this->_tpl_vars['mai']['uid']; ?>
', 0)">Add as Friend</a><?php else: ?><a href="javascript: void(0);" onclick="oFriends.SHConfirmPopup(1, 'id_confirm_friends_popup', '<?php echo $this->_tpl_vars['mai']['uid']; ?>
')">Unfriend</a><?php endif; ?></p>
												<p><a  class="user_report" href="javascript:void(0);" onclick="oUsers.ReportUser($(this), '<?php echo $this->_tpl_vars['mai']['uid']; ?>
');">Report this user</a></p>
					</div>
					</div>
				</div>
				<?php endif; ?>
			<!-- Drop00 -->
					</div>
					<?php if (2 == $this->_tpl_vars['mai']['mtype']): ?>
						<div class="post-title"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['mai']['uid']; ?>
"><b><?php if ($this->_tpl_vars['mai']['first_name'] || $this->_tpl_vars['mai']['last_name']):  echo $this->_tpl_vars['mai']['first_name']; ?>
 <?php echo $this->_tpl_vars['mai']['last_name'];  else:  echo $this->_tpl_vars['mai']['public_name'];  endif; ?></b></a> is going to <?php if ($this->_tpl_vars['mai']['ev_title']):  echo $this->_tpl_vars['mai']['ev_title'];  endif; ?></div>
						<div class="event-txt">
							<img src="<?php echo $this->_tpl_vars['imgDir']; ?>
event_ico.gif"  /><?php echo ((is_array($_tmp=$this->_tpl_vars['mai']['ev_dt'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%B %d, %I:%M %p") : smarty_modifier_date_format($_tmp, "%B %d, %I:%M %p")); ?>
 <br><br>
							<div>
								<?php if ($this->_tpl_vars['mai']['ev_where']): ?><span style="text-align:left; display:block; height: 20px;"><?php echo $this->_tpl_vars['mai']['ev_where']; ?>
</span><?php endif; ?>
								<?php if ($this->_tpl_vars['mai']['ev_img'] != 'none' && $this->_tpl_vars['mai']['ev_img'] != ''): ?><img src="<?php echo $this->_tpl_vars['siteAdr']; ?>
files/images/wall/<?php echo $this->_tpl_vars['mai']['fpath']; ?>
/t/<?php echo $this->_tpl_vars['mai']['ev_img']; ?>
"  align="left"/><?php endif; ?>
								<?php if ($this->_tpl_vars['mai']['ev_descr']): ?><span style="text-align:left; font-style: italic; display:block; height: 20px;"><?php echo $this->_tpl_vars['mai']['ev_descr']; ?>
</span><?php endif; ?>
							</div>
                            <p><?php if ($this->_tpl_vars['mai']['story']):  echo ((is_array($_tmp=$this->_tpl_vars['mai']['story'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp));  endif; ?></p>
						</div>
						
						<br />
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/profile/_wall_actions_one.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						
						<p><?php echo smarty_function_html_tmpl_time(array('val' => $this->_tpl_vars['mai']['pdate'],'type' => 1), $this);?>
</p>					
				    <?php elseif (3 == $this->_tpl_vars['mai']['mtype']): ?>
						<div class="post-title"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['mai']['uid']; ?>
"><b><?php if ($this->_tpl_vars['mai']['first_name'] || $this->_tpl_vars['mai']['last_name']):  echo $this->_tpl_vars['mai']['first_name']; ?>
 <?php echo $this->_tpl_vars['mai']['last_name'];  else:  echo $this->_tpl_vars['mai']['public_name'];  endif; ?></b></a><?php if ($this->_tpl_vars['mai']['uid'] != $this->_tpl_vars['mai']['uid3'] && $this->_tpl_vars['mai']['ptype'] == 4 && ( $this->_tpl_vars['mai']['first_name3'] || $this->_tpl_vars['mai']['last_name3'] )): ?> to <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['mai']['uid3']; ?>
"><b><?php echo $this->_tpl_vars['mai']['first_name3']; ?>
 <?php echo $this->_tpl_vars['mai']['last_name3']; ?>
</b></a><?php endif; ?>
                            <?php if ($this->_tpl_vars['mai']['story']): ?><p><?php echo ((is_array($_tmp=$this->_tpl_vars['mai']['story'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</p><?php endif; ?></div>
						<p>&nbsp;<a href="<?php echo $this->_tpl_vars['mai']['l_url']; ?>
" target="_blank"><?php if ($this->_tpl_vars['mai']['l_url_label']):  echo $this->_tpl_vars['mai']['l_url_label'];  else:  echo $this->_tpl_vars['mai']['l_url'];  endif; ?></a></p>
						
						<br />
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/profile/_wall_actions_one.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						
						<p><?php echo smarty_function_html_tmpl_time(array('val' => $this->_tpl_vars['mai']['pdate'],'type' => 1), $this);?>
</p>                    
				    <?php elseif (4 == $this->_tpl_vars['mai']['mtype']): ?>
						<div class="post-title"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['mai']['uid']; ?>
"><b><?php if ($this->_tpl_vars['mai']['first_name'] || $this->_tpl_vars['mai']['last_name']):  echo $this->_tpl_vars['mai']['first_name']; ?>
 <?php echo $this->_tpl_vars['mai']['last_name'];  else:  echo $this->_tpl_vars['mai']['public_name'];  endif; ?></b></a><?php if ($this->_tpl_vars['mai']['uid'] != $this->_tpl_vars['mai']['uid3'] && $this->_tpl_vars['mai']['ptype'] == 4 && ( $this->_tpl_vars['mai']['first_name3'] || $this->_tpl_vars['mai']['last_name3'] )): ?> to <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['mai']['uid3']; ?>
"><b><?php echo $this->_tpl_vars['mai']['first_name3']; ?>
 <?php echo $this->_tpl_vars['mai']['last_name3']; ?>
</b></a><?php endif; ?>
                            <?php if ($this->_tpl_vars['mai']['story']): ?><p><?php echo ((is_array($_tmp=$this->_tpl_vars['mai']['story'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</p><?php endif; ?></div>
						<p style="float: left; margin: none; padding: none;" align="left">
							                                                        <?php if ($this->_tpl_vars['mai']['p_url']): ?><em><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['mai']['uid']; ?>
/albums/id<?php echo $this->_tpl_vars['mai']['p_img_aid']; ?>
/id<?php echo $this->_tpl_vars['mai']['p_img_1_id']; ?>
"><img src="<?php echo $this->_tpl_vars['mai']['p_url']; ?>
" style="max-width: 200px; max-height: 200px;" /></a></em><?php endif; ?>
							<?php if ($this->_tpl_vars['mai']['p_path']): ?>
								<?php if ($this->_tpl_vars['mai']['p_img_1']): ?><a href=" <?php if ($this->_tpl_vars['mai']['p_img_aid'] && $this->_tpl_vars['mai']['p_img_1_id']): ?> <?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['mai']['uid']; ?>
/albums/id<?php echo $this->_tpl_vars['mai']['p_img_aid']; ?>
/id<?php echo $this->_tpl_vars['mai']['p_img_1_id']; ?>
 <?php else: ?> javascript: void(0); <?php endif; ?> " <?php if (! $this->_tpl_vars['mai']['p_img_1_id']): ?> style="cursor: default;" <?php endif; ?>><img src="<?php echo $this->_tpl_vars['fImgDir']; ?>
wall/<?php echo $this->_tpl_vars['mai']['p_path']; ?>
/<?php echo $this->_tpl_vars['mai']['p_img_1']; ?>
" style="max-width: 300px; max-height: 200px;" /></a><?php endif; ?>
								<?php if ($this->_tpl_vars['mai']['p_img_2']): ?><a href=" <?php if ($this->_tpl_vars['mai']['p_img_aid'] && $this->_tpl_vars['mai']['p_img_2_id']): ?> <?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['mai']['uid']; ?>
/albums/id<?php echo $this->_tpl_vars['mai']['p_img_aid']; ?>
/id<?php echo $this->_tpl_vars['mai']['p_img_2_id']; ?>
 <?php else: ?> javascript: void(0); <?php endif; ?> " <?php if (! $this->_tpl_vars['mai']['p_img_2_id']): ?> style="cursor: default;" <?php endif; ?>><img src="<?php echo $this->_tpl_vars['fImgDir']; ?>
wall/<?php echo $this->_tpl_vars['mai']['p_path']; ?>
/<?php echo $this->_tpl_vars['mai']['p_img_2']; ?>
" style="max-width: 300px; max-height: 200px;" /></a><?php endif; ?>
								<?php if ($this->_tpl_vars['mai']['p_img_3']): ?><a href=" <?php if ($this->_tpl_vars['mai']['p_img_aid'] && $this->_tpl_vars['mai']['p_img_3_id']): ?> <?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['mai']['uid']; ?>
/albums/id<?php echo $this->_tpl_vars['mai']['p_img_aid']; ?>
/id<?php echo $this->_tpl_vars['mai']['p_img_3_id']; ?>
 <?php else: ?> javascript: void(0); <?php endif; ?> " <?php if (! $this->_tpl_vars['mai']['p_img_3_id']): ?> style="cursor: default;" <?php endif; ?>><img src="<?php echo $this->_tpl_vars['fImgDir']; ?>
wall/<?php echo $this->_tpl_vars['mai']['p_path']; ?>
/<?php echo $this->_tpl_vars['mai']['p_img_3']; ?>
" style="max-width: 300px; max-height: 200px;" /></a><?php endif; ?>
							<?php endif; ?>
						</p>
						
						<br />
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/profile/_wall_actions_one.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						
						<p><?php echo smarty_function_html_tmpl_time(array('val' => $this->_tpl_vars['mai']['pdate'],'type' => 1), $this);?>
</p>                    
					<?php elseif (5 == $this->_tpl_vars['mai']['mtype']): ?>
						<div class="post-title"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['mai']['uid']; ?>
"><b><?php if ($this->_tpl_vars['mai']['first_name'] || $this->_tpl_vars['mai']['last_name']):  echo $this->_tpl_vars['mai']['first_name']; ?>
 <?php echo $this->_tpl_vars['mai']['last_name'];  else:  echo $this->_tpl_vars['mai']['public_name'];  endif; ?></b></a><?php if ($this->_tpl_vars['mai']['uid'] != $this->_tpl_vars['mai']['uid3'] && $this->_tpl_vars['mai']['ptype'] == 4 && ( $this->_tpl_vars['mai']['first_name3'] || $this->_tpl_vars['mai']['last_name3'] )): ?> to <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['mai']['uid3']; ?>
"><b><?php echo $this->_tpl_vars['mai']['first_name3']; ?>
 <?php echo $this->_tpl_vars['mai']['last_name3']; ?>
</b></a><?php endif; ?>
                            <?php if ($this->_tpl_vars['mai']['story']): ?><p><?php echo ((is_array($_tmp=$this->_tpl_vars['mai']['story'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</p><?php endif; ?></div>
						<p style="float: left; margin: none; padding: none;" align="left">
							<?php if ($this->_tpl_vars['mai']['v_code']): ?><object width="200" height="150"><?php echo $this->_tpl_vars['mai']['v_code']; ?>
</object><?php endif; ?>
						</p>
						
						<br />
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/profile/_wall_actions_one.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						
						<p><?php echo smarty_function_html_tmpl_time(array('val' => $this->_tpl_vars['mai']['pdate'],'type' => 1), $this);?>
</p>					
					<?php elseif ($this->_tpl_vars['mai']['sub_mtype'] == 1): ?>
                                                <div class="post-title-badge">
                                                    <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['mai']['uid']; ?>
"><b><?php if ($this->_tpl_vars['mai']['first_name'] || $this->_tpl_vars['mai']['last_name']):  echo $this->_tpl_vars['mai']['first_name']; ?>
 <?php echo $this->_tpl_vars['mai']['last_name'];  else:  echo $this->_tpl_vars['mai']['public_name'];  endif; ?></b></a>
                                                    <?php if ($this->_tpl_vars['mai']['uid'] != $this->_tpl_vars['mai']['uid3'] && $this->_tpl_vars['mai']['ptype'] == 4 && ( $this->_tpl_vars['mai']['first_name3'] || $this->_tpl_vars['mai']['last_name3'] )): ?> to <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid3']; ?>
"><b><?php echo $this->_tpl_vars['mai']['first_name3']; ?>
 <?php echo $this->_tpl_vars['mai']['last_name3']; ?>
</b></a><?php endif; ?>
                                                    <?php if ($this->_tpl_vars['mai']['uid'] != $this->_tpl_vars['mai']['uid4'] && ( $this->_tpl_vars['mai']['first_name4'] || $this->_tpl_vars['mai']['last_name4'] )): ?> to <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid4']; ?>
"><b><?php echo $this->_tpl_vars['mai']['first_name4']; ?>
 <?php echo $this->_tpl_vars['mai']['last_name4']; ?>
</b></a><?php endif; ?>
                                                    <p><?php echo smarty_function_html_tmpl_time(array('val' => $this->_tpl_vars['mai']['pdate'],'type' => 1), $this);?>
</p>
                              			            <p>
                                                    <?php if (5 == $this->_tpl_vars['mai']['ptype']): ?>
                                                            private
                                                        <?php elseif (4 == $this->_tpl_vars['mai']['ptype']): ?>
                                                            only for <?php if ($this->_tpl_vars['u3']['first_name'] && $this->_tpl_vars['u3']['last_name']): ?> <?php echo $this->_tpl_vars['u3']['first_name']; ?>
 <?php echo $this->_tpl_vars['u3']['last_name']; ?>
 <?php else: ?> ... <?php endif; ?>
                                                        <?php elseif (3 == $this->_tpl_vars['mai']['ptype']): ?>
                                                            For family
                                                        <?php elseif (2 == $this->_tpl_vars['mai']['ptype']): ?>
                                                            For friends <?php if ($this->_tpl_vars['mai']['pstype']): ?> ( <?php if ($this->_tpl_vars['mai']['pstype'] == 5): ?> <?php if ($this->_tpl_vars['uclasses_index'][$this->_tpl_vars['mai']['pclass']]): ?> <?php echo $this->_tpl_vars['uclasses_index'][$this->_tpl_vars['mai']['pclass']]; ?>
 <?php else: ?> Classmates <?php endif; ?> <?php elseif ($this->_tpl_vars['mai']['pstype'] == 1): ?> Aaronic priesthood <?php elseif ($this->_tpl_vars['mai']['pstype'] == 2): ?> Young man <?php elseif ($this->_tpl_vars['mai']['pstype'] == 3): ?> Priesthood holders <?php elseif ($this->_tpl_vars['mai']['pstype'] == 4): ?> Melchizedek priesthood <?php elseif ($this->_tpl_vars['mai']['pstype'] == 7): ?> high priest <?php elseif ($this->_tpl_vars['mai']['pstype'] == 12): ?> Young woman <?php elseif ($this->_tpl_vars['mai']['pstype'] == 100): ?> <?php if ($this->_tpl_vars['UserInfo']['ward_id'] == $this->_tpl_vars['mai']['uvid']): ?> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
wards/id<?php echo $this->_tpl_vars['UserInfo']['ward_id']; ?>
"><?php echo $this->_tpl_vars['UserInfo']['ward']; ?>
</a> <?php else: ?> prev ward <?php endif; ?> <?php elseif ($this->_tpl_vars['mai']['pstype'] == 101): ?> <?php if ($this->_tpl_vars['UserInfo']['stake_id'] == $this->_tpl_vars['mai']['uvid']): ?> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
wards/id<?php echo $this->_tpl_vars['UserInfo']['stake_id']; ?>
"><?php echo $this->_tpl_vars['UserInfo']['stake']; ?>
</a> <?php else: ?> prev stake <?php endif; ?> <?php endif; ?> ) <?php endif; ?>
                                                        <?php elseif (1 == $this->_tpl_vars['mai']['ptype']): ?>
                                                            For friends and followers <?php if ($this->_tpl_vars['mai']['pstype']): ?> ( <?php if ($this->_tpl_vars['mai']['pstype'] == 5): ?> <?php if ($this->_tpl_vars['uclasses_index'][$this->_tpl_vars['mai']['pclass']]): ?> <?php echo $this->_tpl_vars['uclasses_index'][$this->_tpl_vars['mai']['pclass']]; ?>
 <?php else: ?> Classmates <?php endif; ?> <?php elseif ($this->_tpl_vars['mai']['pstype'] == 1): ?> Aaronic priesthood <?php elseif ($this->_tpl_vars['mai']['pstype'] == 2): ?> Young man <?php elseif ($this->_tpl_vars['mai']['pstype'] == 3): ?> Priesthood holders <?php elseif ($this->_tpl_vars['mai']['pstype'] == 4): ?> Melchizedek priesthood <?php elseif ($this->_tpl_vars['mai']['pstype'] == 7): ?> high priest <?php elseif ($this->_tpl_vars['mai']['pstype'] == 12): ?> Young woman <?php elseif ($this->_tpl_vars['mai']['pstype'] == 100): ?> <?php if ($this->_tpl_vars['UserInfo']['ward_id'] == $this->_tpl_vars['mai']['uvid']): ?> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
wards/id<?php echo $this->_tpl_vars['UserInfo']['ward_id']; ?>
"><?php echo $this->_tpl_vars['UserInfo']['ward']; ?>
</a> <?php else: ?> prev ward <?php endif; ?> <?php elseif ($this->_tpl_vars['mai']['pstype'] == 101): ?> <?php if ($this->_tpl_vars['UserInfo']['stake_id'] == $this->_tpl_vars['mai']['uvid']): ?> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
wards/id<?php echo $this->_tpl_vars['UserInfo']['stake_id']; ?>
"><?php echo $this->_tpl_vars['UserInfo']['stake']; ?>
</a> <?php else: ?> prev stake <?php endif; ?> <?php endif; ?> ) <?php endif; ?>
                                                        <?php elseif (0 == $this->_tpl_vars['mai']['ptype']): ?>
                                                            For everyone <?php if ($this->_tpl_vars['mai']['first_name3'] && $this->_tpl_vars['mai']['last_name3'] && $this->_tpl_vars['mai']['uvid']): ?> except <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['mai']['uid3']; ?>
"><?php echo $this->_tpl_vars['mai']['first_name3']; ?>
 <?php echo $this->_tpl_vars['mai']['last_name3']; ?>
</a> <?php endif; ?>
                                                    <?php endif; ?>
                                                    </p>
                                                    <table class="post-badge">
                                                        <td>
                                                            <img class="badge_img" src="<?php echo $this->_tpl_vars['imgDir']; ?>
/badges/<?php echo $this->_tpl_vars['mai']['b_img_name']; ?>
.png" alt="<?php echo $this->_tpl_vars['mai']['b_img_name']; ?>
"/>
                                                        </td>
                                                        <td style="max-width: 280px;">
                                                            <span class="story_badge"><?php if ($this->_tpl_vars['mai']['story']):  echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['mai']['story'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)))) ? $this->_run_mod_handler('dlong', true, $_tmp, 35) : smarty_modifier_dlong($_tmp, 35));  endif; ?></span>
                                                        </td>
                                                    </table>
                                                <br/>
                                                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/profile/_wall_actions_one.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                                                <br/>
                                                </div>
                                        
					<?php else: ?>
						<div class="post-title"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['mai']['uid']; ?>
"><b><?php if ($this->_tpl_vars['mai']['first_name'] || $this->_tpl_vars['mai']['last_name']):  echo $this->_tpl_vars['mai']['first_name']; ?>
 <?php echo $this->_tpl_vars['mai']['last_name'];  else:  echo $this->_tpl_vars['mai']['public_name'];  endif; ?></b></a><?php if ($this->_tpl_vars['mai']['uid'] != $this->_tpl_vars['mai']['uid3'] && $this->_tpl_vars['mai']['ptype'] == 4 && ( $this->_tpl_vars['mai']['first_name3'] || $this->_tpl_vars['mai']['last_name3'] )): ?> to <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['mai']['uid3']; ?>
"><b><?php echo $this->_tpl_vars['mai']['first_name3']; ?>
 <?php echo $this->_tpl_vars['mai']['last_name3']; ?>
</b></a><?php endif; ?>
                            <?php if ($this->_tpl_vars['mai']['story']): ?><p><?php echo ((is_array($_tmp=$this->_tpl_vars['mai']['story'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</p><?php endif; ?>
                                                </div>

						<br />
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/profile/_wall_actions_one.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

						<p><?php echo smarty_function_html_tmpl_time(array('val' => $this->_tpl_vars['mai']['pdate'],'type' => 1), $this);?>
</p>
					<?php endif; ?>
                                        
                                        <?php if (! isset ( $this->_tpl_vars['mai']['sub_mtype'] )): ?>
						<p>
                                                    <?php if (5 == $this->_tpl_vars['mai']['ptype']): ?>
                                                            private
                                                        <?php elseif (4 == $this->_tpl_vars['mai']['ptype']): ?>
                                                            only for <?php if ($this->_tpl_vars['u3']['first_name'] && $this->_tpl_vars['u3']['last_name']): ?> <?php echo $this->_tpl_vars['u3']['first_name']; ?>
 <?php echo $this->_tpl_vars['u3']['last_name']; ?>
 <?php else: ?> ... <?php endif; ?>
                                                        <?php elseif (3 == $this->_tpl_vars['mai']['ptype']): ?>
                                                            For family
                                                        <?php elseif (2 == $this->_tpl_vars['mai']['ptype']): ?>
                                                            For friends <?php if ($this->_tpl_vars['mai']['pstype']): ?> ( <?php if ($this->_tpl_vars['mai']['pstype'] == 5): ?> <?php if ($this->_tpl_vars['uclasses_index'][$this->_tpl_vars['mai']['pclass']]): ?> <?php echo $this->_tpl_vars['uclasses_index'][$this->_tpl_vars['mai']['pclass']]; ?>
 <?php else: ?> Classmates <?php endif; ?> <?php elseif ($this->_tpl_vars['mai']['pstype'] == 1): ?> Aaronic priesthood <?php elseif ($this->_tpl_vars['mai']['pstype'] == 2): ?> Young man <?php elseif ($this->_tpl_vars['mai']['pstype'] == 3): ?> Priesthood holders <?php elseif ($this->_tpl_vars['mai']['pstype'] == 4): ?> Melchizedek priesthood <?php elseif ($this->_tpl_vars['mai']['pstype'] == 7): ?> high priest <?php elseif ($this->_tpl_vars['mai']['pstype'] == 12): ?> Young woman <?php elseif ($this->_tpl_vars['mai']['pstype'] == 100): ?> <?php if ($this->_tpl_vars['UserInfo']['ward_id'] == $this->_tpl_vars['mai']['uvid']): ?> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
wards/id<?php echo $this->_tpl_vars['UserInfo']['ward_id']; ?>
"><?php echo $this->_tpl_vars['UserInfo']['ward']; ?>
</a> <?php else: ?> prev ward <?php endif; ?> <?php elseif ($this->_tpl_vars['mai']['pstype'] == 101): ?> <?php if ($this->_tpl_vars['UserInfo']['stake_id'] == $this->_tpl_vars['mai']['uvid']): ?> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
wards/id<?php echo $this->_tpl_vars['UserInfo']['stake_id']; ?>
"><?php echo $this->_tpl_vars['UserInfo']['stake']; ?>
</a> <?php else: ?> prev stake <?php endif; ?> <?php endif; ?> ) <?php endif; ?>
                                                        <?php elseif (1 == $this->_tpl_vars['mai']['ptype']): ?>
                                                            For friends and followers <?php if ($this->_tpl_vars['mai']['pstype']): ?> ( <?php if ($this->_tpl_vars['mai']['pstype'] == 5): ?> <?php if ($this->_tpl_vars['uclasses_index'][$this->_tpl_vars['mai']['pclass']]): ?> <?php echo $this->_tpl_vars['uclasses_index'][$this->_tpl_vars['mai']['pclass']]; ?>
 <?php else: ?> Classmates <?php endif; ?> <?php elseif ($this->_tpl_vars['mai']['pstype'] == 1): ?> Aaronic priesthood <?php elseif ($this->_tpl_vars['mai']['pstype'] == 2): ?> Young man <?php elseif ($this->_tpl_vars['mai']['pstype'] == 3): ?> Priesthood holders <?php elseif ($this->_tpl_vars['mai']['pstype'] == 4): ?> Melchizedek priesthood <?php elseif ($this->_tpl_vars['mai']['pstype'] == 7): ?> high priest <?php elseif ($this->_tpl_vars['mai']['pstype'] == 12): ?> Young woman <?php elseif ($this->_tpl_vars['mai']['pstype'] == 100): ?> <?php if ($this->_tpl_vars['UserInfo']['ward_id'] == $this->_tpl_vars['mai']['uvid']): ?> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
wards/id<?php echo $this->_tpl_vars['UserInfo']['ward_id']; ?>
"><?php echo $this->_tpl_vars['UserInfo']['ward']; ?>
</a> <?php else: ?> prev ward <?php endif; ?> <?php elseif ($this->_tpl_vars['mai']['pstype'] == 101): ?> <?php if ($this->_tpl_vars['UserInfo']['stake_id'] == $this->_tpl_vars['mai']['uvid']): ?> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
wards/id<?php echo $this->_tpl_vars['UserInfo']['stake_id']; ?>
"><?php echo $this->_tpl_vars['UserInfo']['stake']; ?>
</a> <?php else: ?> prev stake <?php endif; ?> <?php endif; ?> ) <?php endif; ?>
                                                        <?php elseif (0 == $this->_tpl_vars['mai']['ptype']): ?>
                                                            For everyone <?php if ($this->_tpl_vars['mai']['first_name3'] && $this->_tpl_vars['mai']['last_name3'] && $this->_tpl_vars['mai']['uvid']): ?> except <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['mai']['uid3']; ?>
"><?php echo $this->_tpl_vars['mai']['first_name3']; ?>
 <?php echo $this->_tpl_vars['mai']['last_name3']; ?>
</a> <?php endif; ?>
                                                    <?php endif; ?>
                                                </p>
                                         <?php endif; ?>
				</div>
                                <ul id="id_mes_sts_list_<?php echo $this->_tpl_vars['mai']['com_parent']; ?>
" class="sm-stat">
                                <?php if ($this->_tpl_vars['mai']['status']): ?>
                                    <?php $this->assign('stats', $this->_tpl_vars['mai']['status']); ?>
                                    <?php $_from = $this->_tpl_vars['stats']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ssk'] => $this->_tpl_vars['ssi']):
?>
                                    <li>
                                        <div class="sm-stat-main">
                                            <img src="<?php echo $this->_tpl_vars['imgDir']; ?>
smile/<?php echo $this->_tpl_vars['ssk']; ?>
.png" />&nbsp;
                                            <?php if ($this->_tpl_vars['ssi']['cnt'] == 1): ?><span id="text_hide_<?php echo $this->_tpl_vars['ssk']; ?>
_<?php echo $this->_tpl_vars['mai']['com_parent']; ?>
"><a href="javascript:void(0);" onclick="$('#popup_user_<?php echo $this->_tpl_vars['ssk']; ?>
_<?php echo $this->_tpl_vars['mai']['com_parent']; ?>
').show();$('#text_hide_<?php echo $this->_tpl_vars['ssk']; ?>
_<?php echo $this->_tpl_vars['mai']['com_parent']; ?>
').hide();"><?php echo $this->_tpl_vars['ssi']['cnt']; ?>
 person</a> <?php echo $this->_tpl_vars['status'][$this->_tpl_vars['ssk']]['1']; ?>
</span>
                                            <?php else: ?><span><a href="javascript:void(0)" onclick="if ($('#popup_users_<?php echo $this->_tpl_vars['ssk']; ?>
_<?php echo $this->_tpl_vars['mai']['com_parent']; ?>
').css('display')=='none') $('#popup_users_<?php echo $this->_tpl_vars['ssk']; ?>
_<?php echo $this->_tpl_vars['mai']['com_parent']; ?>
').show(); else $('#popup_users_<?php echo $this->_tpl_vars['ssk']; ?>
_<?php echo $this->_tpl_vars['mai']['com_parent']; ?>
').hide();"><?php echo $this->_tpl_vars['ssi']['cnt']; ?>
 persons</a> <?php echo $this->_tpl_vars['status'][$this->_tpl_vars['ssk']]['2']; ?>
</span>
                                            <?php endif; ?>
                                        </div>
                                    <div id="popup_user_<?php echo $this->_tpl_vars['ssk']; ?>
_<?php echo $this->_tpl_vars['mai']['com_parent']; ?>
" class="popup_person" onmouseover="$('#popup_user_<?php echo $this->_tpl_vars['ssk']; ?>
_<?php echo $this->_tpl_vars['mai']['com_parent']; ?>
').show();$('#text_hide_<?php echo $this->_tpl_vars['ssk']; ?>
_<?php echo $this->_tpl_vars['mai']['com_parent']; ?>
').hide();" onmouseout="$('#popup_user_<?php echo $this->_tpl_vars['ssk']; ?>
_<?php echo $this->_tpl_vars['mai']['com_parent']; ?>
').hide();$('#text_hide_<?php echo $this->_tpl_vars['ssk']; ?>
_<?php echo $this->_tpl_vars['mai']['com_parent']; ?>
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
_<?php echo $this->_tpl_vars['mai']['com_parent']; ?>
" class="popup_persons" onmouseover="$('#popup_users_<?php echo $this->_tpl_vars['ssk']; ?>
_<?php echo $this->_tpl_vars['mai']['com_parent']; ?>
').show();" onmouseout="$('#popup_users_<?php echo $this->_tpl_vars['ssk']; ?>
_<?php echo $this->_tpl_vars['mai']['com_parent']; ?>
').hide();" style="display:none;">
                                    <?php if (( $this->_tpl_vars['ssi']['cnt'] > 5 )): ?>
                                        <div class="popup_persns_header" style="color:#808080;">People who <?php echo $this->_tpl_vars['status'][$this->_tpl_vars['ssk']]['2']; ?>
 <i>(last 5 persons)</i></div>
                                    <?php else: ?>
                                        <div class="popup_persns_header" style="color:#808080;">People who <?php echo $this->_tpl_vars['status'][$this->_tpl_vars['ssk']]['2']; ?>
</div>
                                    <?php endif; ?>
                                    <ul class="popup_persns_content">
                                    <?php $this->assign('cnt_stat', $this->_tpl_vars['ssi']['cnt']); ?>
                                    <?php if (( $this->_tpl_vars['cnt_stat']-1 ) < 5): ?>
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
"><?php echo $this->_tpl_vars['ssindex']['first_name']; ?>
&nbsp;<?php echo $this->_tpl_vars['ssindex']['last_name']; ?>
</a></span>
                                        </li>
                                        <?php endif; ?>
                                       <?php endforeach; endif; unset($_from); ?>
                                   <?php else: ?>
                                        <?php unset($this->_sections['ssindex']);
$this->_sections['ssindex']['start'] = (int)$this->_tpl_vars['cnt_stat']-6;
$this->_sections['ssindex']['name'] = 'ssindex';
$this->_sections['ssindex']['max'] = (int)5;
$this->_sections['ssindex']['loop'] = is_array($_loop=$this->_tpl_vars['ssi']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['ssindex']['show'] = true;
if ($this->_sections['ssindex']['max'] < 0)
    $this->_sections['ssindex']['max'] = $this->_sections['ssindex']['loop'];
$this->_sections['ssindex']['step'] = 1;
if ($this->_sections['ssindex']['start'] < 0)
    $this->_sections['ssindex']['start'] = max($this->_sections['ssindex']['step'] > 0 ? 0 : -1, $this->_sections['ssindex']['loop'] + $this->_sections['ssindex']['start']);
else
    $this->_sections['ssindex']['start'] = min($this->_sections['ssindex']['start'], $this->_sections['ssindex']['step'] > 0 ? $this->_sections['ssindex']['loop'] : $this->_sections['ssindex']['loop']-1);
if ($this->_sections['ssindex']['show']) {
    $this->_sections['ssindex']['total'] = min(ceil(($this->_sections['ssindex']['step'] > 0 ? $this->_sections['ssindex']['loop'] - $this->_sections['ssindex']['start'] : $this->_sections['ssindex']['start']+1)/abs($this->_sections['ssindex']['step'])), $this->_sections['ssindex']['max']);
    if ($this->_sections['ssindex']['total'] == 0)
        $this->_sections['ssindex']['show'] = false;
} else
    $this->_sections['ssindex']['total'] = 0;
if ($this->_sections['ssindex']['show']):

            for ($this->_sections['ssindex']['index'] = $this->_sections['ssindex']['start'], $this->_sections['ssindex']['iteration'] = 1;
                 $this->_sections['ssindex']['iteration'] <= $this->_sections['ssindex']['total'];
                 $this->_sections['ssindex']['index'] += $this->_sections['ssindex']['step'], $this->_sections['ssindex']['iteration']++):
$this->_sections['ssindex']['rownum'] = $this->_sections['ssindex']['iteration'];
$this->_sections['ssindex']['index_prev'] = $this->_sections['ssindex']['index'] - $this->_sections['ssindex']['step'];
$this->_sections['ssindex']['index_next'] = $this->_sections['ssindex']['index'] + $this->_sections['ssindex']['step'];
$this->_sections['ssindex']['first']      = ($this->_sections['ssindex']['iteration'] == 1);
$this->_sections['ssindex']['last']       = ($this->_sections['ssindex']['iteration'] == $this->_sections['ssindex']['total']);
?>
                                        <li>
                                            <img src="<?php if ($this->_tpl_vars['ssindex']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['ssi'][$this->_sections['ssindex']['index']]['fpath']; ?>
/s/s_<?php echo $this->_tpl_vars['ssi'][$this->_sections['ssindex']['index']]['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m56.jpg<?php endif; ?>" style="padding: 0 0 5px 2px;"/>&nbsp;
                                            <span><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ssi'][$this->_sections['ssindex']['index']]['suid']; ?>
"><?php echo $this->_tpl_vars['ssi'][$this->_sections['ssindex']['index']]['first_name']; ?>
&nbsp;<?php echo $this->_tpl_vars['ssi'][$this->_sections['ssindex']['index']]['last_name']; ?>
</a></span>
                                        </li>
                                        <?php endfor; endif; ?>
                                   <?php endif; ?>
                                   </ul>
                                   </div>
                                   </li>
                            <?php endforeach; endif; unset($_from); ?>
                            <?php endif; ?>
                            </ul>

                               <ul id="id_mes_answ_list_<?php echo $this->_tpl_vars['mai']['com_parent']; ?>
" class="recomment">
				<?php if ($this->_tpl_vars['mai']['answers']): ?>
					<?php $this->assign('answ', $this->_tpl_vars['mai']['answers']); ?>
					<?php unset($this->_sections['si']);
$this->_sections['si']['name'] = 'si';
$this->_sections['si']['loop'] = is_array($_loop=$this->_tpl_vars['mai']['answers']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['si']['show'] = true;
$this->_sections['si']['max'] = $this->_sections['si']['loop'];
$this->_sections['si']['step'] = 1;
$this->_sections['si']['start'] = $this->_sections['si']['step'] > 0 ? 0 : $this->_sections['si']['loop']-1;
if ($this->_sections['si']['show']) {
    $this->_sections['si']['total'] = $this->_sections['si']['loop'];
    if ($this->_sections['si']['total'] == 0)
        $this->_sections['si']['show'] = false;
} else
    $this->_sections['si']['total'] = 0;
if ($this->_sections['si']['show']):

            for ($this->_sections['si']['index'] = $this->_sections['si']['start'], $this->_sections['si']['iteration'] = 1;
                 $this->_sections['si']['iteration'] <= $this->_sections['si']['total'];
                 $this->_sections['si']['index'] += $this->_sections['si']['step'], $this->_sections['si']['iteration']++):
$this->_sections['si']['rownum'] = $this->_sections['si']['iteration'];
$this->_sections['si']['index_prev'] = $this->_sections['si']['index'] - $this->_sections['si']['step'];
$this->_sections['si']['index_next'] = $this->_sections['si']['index'] + $this->_sections['si']['step'];
$this->_sections['si']['first']      = ($this->_sections['si']['iteration'] == 1);
$this->_sections['si']['last']       = ($this->_sections['si']['iteration'] == $this->_sections['si']['total']);
?>
					<li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['answ'][$this->_sections['si']['index']]['uid']; ?>
"><img src="<?php if ($this->_tpl_vars['answ'][$this->_sections['si']['index']]['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['answ'][$this->_sections['si']['index']]['fpath']; ?>
/a/a_<?php echo $this->_tpl_vars['answ'][$this->_sections['si']['index']]['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m56.jpg<?php endif; ?>"  style="width: 56px; height: 56px;" /></a>
						<div>
						<p><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['answ'][$this->_sections['si']['index']]['uid']; ?>
"><?php if ($this->_tpl_vars['answ'][$this->_sections['si']['index']]['first_name'] || $this->_tpl_vars['answ'][$this->_sections['si']['index']]['last_name']):  echo $this->_tpl_vars['answ'][$this->_sections['si']['index']]['first_name']; ?>
 <?php echo $this->_tpl_vars['answ'][$this->_sections['si']['index']]['last_name'];  else:  echo $this->_tpl_vars['answ'][$this->_sections['si']['index']]['public_name'];  endif; ?></a> <?php if ($this->_tpl_vars['answ'][$this->_sections['si']['index']]['story']):  echo ((is_array($_tmp=$this->_tpl_vars['answ'][$this->_sections['si']['index']]['story'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp));  endif; ?></p>
						<p><span><?php echo smarty_function_html_tmpl_time(array('val' => $this->_tpl_vars['answ'][$this->_sections['si']['index']]['pdate'],'type' => 1), $this);?>
</span></p>
						</div>
					</li>
					<?php endfor; endif; ?>
				<?php endif; ?>
				</ul>

				<?php if (2 < $this->_tpl_vars['mai']['cnt_answ']): ?><div id="id_div_show_more_answ_<?php echo $this->_tpl_vars['mai']['com_parent']; ?>
" class="tools-link"><a href="javascript: void(0);" onclick="oWall.GetAnswList( '<?php echo $this->_tpl_vars['mai']['uid']; ?>
', '<?php echo $this->_tpl_vars['i']['com_parent']; ?>
', 2, '' );">View all comments</a></div><?php endif; ?>
				
				<div id="id_add_new_answ_inp_<?php echo $this->_tpl_vars['mai']['com_parent']; ?>
" class="add-comment-in"><input class="cl_add_answ_inp" mid="<?php echo $this->_tpl_vars['mai']['com_parent']; ?>
" type="text" value="Add comment" /></div>
				<form id="id_frm_add_mes_answ_<?php echo $this->_tpl_vars['mai']['com_parent']; ?>
" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/wall/geteditansw" method="post">
				<input type="hidden" name="SI[mes_id]" value="<?php echo $this->_tpl_vars['mai']['com_parent']; ?>
" /><br />
					<div id="id_add_new_answ_txtar_<?php echo $this->_tpl_vars['mai']['com_parent']; ?>
" class="add-comment-in2" style="display: none;">
						<img src="<?php if ($this->_tpl_vars['UserInfo']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['UserInfo']['fpath']; ?>
/a/a_<?php echo $this->_tpl_vars['UserInfo']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m56.jpg<?php endif; ?>"  style="width: 56px; height: 56px;" />
						<textarea id="id_add_new_answ_txtar_b_<?php echo $this->_tpl_vars['mai']['com_parent']; ?>
" class="cl_answ_story" name="WI[story]" maxlength="480"></textarea>

                                                <div class="add_smile_tab"><a class="nav_attach_smile" onclick="oWall.AddSmileTab('<?php echo $this->_tpl_vars['mai']['com_parent']; ?>
');" mtype="smile" style="cursor: pointer;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
smile_main.gif" alt="" /></a></div>
                                                <div class="share-white-b" style="margin-bottom: 3px; margin-top: 2px;"><a href="javascript: void(0);" onclick="oWall.AddMesAnsw( '<?php echo $this->_tpl_vars['mai']['com_parent']; ?>
' );"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
add_b3_act.gif"  /></a></div>
					</div>
                                        <?php $this->assign('type_smile', 'just_comment'); ?>
                                        <div id="show_smile_tab_comment_<?php echo $this->_tpl_vars['mai']['com_parent']; ?>
" class="smiley_comment" style="display: none;">
                                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "top_blocks/_smile.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                                        </div>

				</form>

			</div>
		</div>