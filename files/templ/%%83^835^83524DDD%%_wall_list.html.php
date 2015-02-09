<?php /* Smarty version 2.6.11, created on 2014-10-07 05:11:49
         compiled from mods/wards/_wall_list.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'mods/wards/_wall_list.html', 27, false),array('modifier', 'nl2br', 'mods/wards/_wall_list.html', 38, false),array('modifier', 'dlong', 'mods/wards/_wall_list.html', 88, false),array('function', 'html_tmpl_time', 'mods/wards/_wall_list.html', 33, false),)), $this); ?>
<?php $_from = $this->_tpl_vars['mai']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['mess'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['mess']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['mess']['iteration']++;
?>
	<div id="id_wall_mes_<?php echo $this->_tpl_vars['i']['id']; ?>
" mid="<?php echo $this->_tpl_vars['i']['id']; ?>
" class="box001 cl_wall_mes" onmouseover="$('#tl_<?php echo $this->_tpl_vars['i']['id']; ?>
').show();" onmouseout="$('#tl_<?php echo $this->_tpl_vars['i']['id']; ?>
').hide();">
		<div class="post-box">
			<div class="post-box-bg00" style="min-height: 68px">

				<div class="b-awatar"><a href="javascript: void(0);" onclick="$('#id_dropbox_<?php echo $this->_tpl_vars['i']['id']; ?>
').slideToggle('slow');"><img src="<?php if ($this->_tpl_vars['i']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['i']['fpath']; ?>
/s/s_<?php echo $this->_tpl_vars['i']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m66.jpg<?php endif; ?>" <?php if ($this->_tpl_vars['i']['uid'] == $this->_tpl_vars['UserInfo']['uid']): ?>class="small_avatar"<?php endif; ?> alt="" /></a>
					<!-- Drop00 -->
						<?php if ($this->_tpl_vars['i']['uid'] != $this->_tpl_vars['UserInfo']['uid']): ?>
					<div id="id_dropbox_<?php echo $this->_tpl_vars['i']['id']; ?>
" class="dropbox00">
						<div class="dropbox00-left">
							<div class="dropbox00-right">
								<ul><li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
">Send a message</a></li></ul>
								<p><?php if (! $this->_tpl_vars['i']['relations']['im_friend']): ?><a href="javascript: void(0);" onclick="oFriends.GetFrAjax('<?php echo $this->_tpl_vars['i']['uid']; ?>
', 0)">Add as Friend</a><?php else: ?><a href="javascript: void(0);" onclick="oFriends.SHConfirmPopup(1, 'id_confirm_friends_popup', '<?php echo $this->_tpl_vars['i']['uid']; ?>
')">Unfriend</a><?php endif; ?></p>
																<p><a class="user_report" href="javascript:void(0);" onclick="oUsers.ReportUser($(this), '<?php echo $this->_tpl_vars['i']['uid']; ?>
');">Report this user</a></p>
							</div>
						</div>
					</div>
						<?php endif; ?>
					<!-- Drop00 -->
				</div>

                                <?php if (2 == $this->_tpl_vars['i']['mtype']): ?>
				<div class="post-title"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
"><b><?php if ($this->_tpl_vars['i']['first_name'] || $this->_tpl_vars['i']['last_name']):  echo $this->_tpl_vars['i']['first_name']; ?>
 <?php echo $this->_tpl_vars['i']['last_name'];  else:  echo $this->_tpl_vars['i']['public_name'];  endif; ?></b></a> 
						<?php if ($this->_tpl_vars['i']['ward_from']): ?> from <a href="/wards/id<?php echo $this->_tpl_vars['i']['ward_from_id']; ?>
" ><b><?php echo $this->_tpl_vars['i']['ward_from']; ?>
</b></a> <?php endif; ?> is going to <?php if ($this->_tpl_vars['i']['ev_title']):  echo $this->_tpl_vars['i']['ev_title'];  endif; ?></div>
				<div class="event-txt">
					<img src="<?php echo $this->_tpl_vars['imgDir']; ?>
event_ico.gif" alt="" /><?php echo $this->_tpl_vars['i']['ev_where']; ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['i']['ev_dt'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%B %d, %I:%M %p") : smarty_modifier_date_format($_tmp, "%B %d, %I:%M %p")); ?>

				</div>

				<br />
				    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/wards/_wall_actions.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

				<p><?php echo smarty_function_html_tmpl_time(array('val' => $this->_tpl_vars['i']['pdate'],'type' => 1), $this);?>
</p>
                                <?php elseif (3 == $this->_tpl_vars['i']['mtype']): ?>
				<div class="post-title">
					<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
"><b><?php if ($this->_tpl_vars['i']['first_name'] || $this->_tpl_vars['i']['last_name']):  echo $this->_tpl_vars['i']['first_name']; ?>
 <?php echo $this->_tpl_vars['i']['last_name'];  else:  echo $this->_tpl_vars['i']['public_name'];  endif; ?></b>
					</a><?php if ($this->_tpl_vars['i']['ward_from']): ?> from <a href="/wards/id<?php echo $this->_tpl_vars['i']['ward_from_id']; ?>
" ><b><?php echo $this->_tpl_vars['i']['ward_from']; ?>
</b></a> <?php endif; ?>
                    <?php if ($this->_tpl_vars['i']['story']): ?><p><?php echo ((is_array($_tmp=$this->_tpl_vars['i']['story'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</p><?php endif; ?></div>
				<p>&nbsp;<a href="<?php echo $this->_tpl_vars['i']['l_url']; ?>
" target="_blank"><?php if ($this->_tpl_vars['i']['l_url_label']):  echo $this->_tpl_vars['i']['l_url_label'];  else:  echo $this->_tpl_vars['i']['l_url'];  endif; ?></a></p>

				<br />
				    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/wards/_wall_actions.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

				<p><?php echo smarty_function_html_tmpl_time(array('val' => $this->_tpl_vars['i']['pdate'],'type' => 1), $this);?>
 </p>
                                <?php elseif (4 == $this->_tpl_vars['i']['mtype']): ?>
				<div class="post-title">
					<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
"><b><?php if ($this->_tpl_vars['i']['first_name'] || $this->_tpl_vars['i']['last_name']):  echo $this->_tpl_vars['i']['first_name']; ?>
 <?php echo $this->_tpl_vars['i']['last_name'];  else:  echo $this->_tpl_vars['i']['public_name'];  endif; ?></b></a>
					<?php if ($this->_tpl_vars['i']['ward_from']): ?> from <a href="/wards/id<?php echo $this->_tpl_vars['i']['ward_from_id']; ?>
" ><b><?php echo $this->_tpl_vars['i']['ward_from']; ?>
</b></a> <?php endif; ?>
                    <?php if ($this->_tpl_vars['i']['story']): ?><p><?php echo ((is_array($_tmp=$this->_tpl_vars['i']['story'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</p><?php endif; ?></div>
				<p style="float: left; margin: none; padding: none;" align="left">
									<?php if ($this->_tpl_vars['i']['p_url']): ?><em><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
/albums/id<?php echo $this->_tpl_vars['i']['p_img_aid']; ?>
/id<?php echo $this->_tpl_vars['i']['p_img_1_id']; ?>
"><img src="<?php echo $this->_tpl_vars['i']['p_url']; ?>
" style="max-width: 200px; max-height: 200px;" /></a></em><?php endif; ?>
									<?php if ($this->_tpl_vars['i']['p_path']): ?>
										<?php if ($this->_tpl_vars['i']['p_img_1']): ?><em><a href="<?php if ($this->_tpl_vars['i']['p_img_aid'] && $this->_tpl_vars['i']['p_img_1_id']):  echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
/albums/id<?php echo $this->_tpl_vars['i']['p_img_aid']; ?>
/id<?php echo $this->_tpl_vars['i']['p_img_1_id'];  else: ?>javascript: void(0);<?php endif; ?>" <?php if (! $this->_tpl_vars['i']['p_img_1_id']): ?> style="cursor: default;" <?php endif; ?>><img src="<?php echo $this->_tpl_vars['fImgDir']; ?>
wards/wall/<?php echo $this->_tpl_vars['i']['p_path']; ?>
/<?php echo $this->_tpl_vars['i']['p_img_1']; ?>
" style="max-width: 300px; max-height: 200px;" /></a></em><?php endif; ?>
										<?php if ($this->_tpl_vars['i']['p_img_2']): ?><em><a href="<?php if ($this->_tpl_vars['i']['p_img_aid'] && $this->_tpl_vars['i']['p_img_2_id']):  echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
/albums/id<?php echo $this->_tpl_vars['i']['p_img_aid']; ?>
/id<?php echo $this->_tpl_vars['i']['p_img_2_id'];  else: ?>javascript: void(0);<?php endif; ?>" <?php if (! $this->_tpl_vars['i']['p_img_2_id']): ?> style="cursor: default;" <?php endif; ?>><img src="<?php echo $this->_tpl_vars['fImgDir']; ?>
wards/wall/<?php echo $this->_tpl_vars['i']['p_path']; ?>
/<?php echo $this->_tpl_vars['i']['p_img_2']; ?>
" style="max-width: 300px; max-height: 200px;" /></a></em><?php endif; ?>
										<?php if ($this->_tpl_vars['i']['p_img_3']): ?><em><a href="<?php if ($this->_tpl_vars['i']['p_img_aid'] && $this->_tpl_vars['i']['p_img_3_id']):  echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
/albums/id<?php echo $this->_tpl_vars['i']['p_img_aid']; ?>
/id<?php echo $this->_tpl_vars['i']['p_img_3_id'];  else: ?>javascript: void(0);<?php endif; ?>" <?php if (! $this->_tpl_vars['i']['p_img_3_id']): ?> style="cursor: default;" <?php endif; ?>><img src="<?php echo $this->_tpl_vars['fImgDir']; ?>
wards/wall/<?php echo $this->_tpl_vars['i']['p_path']; ?>
/<?php echo $this->_tpl_vars['i']['p_img_3']; ?>
" style="max-width: 300px; max-height: 200px;" /></a></em><?php endif; ?>
									<?php endif; ?>
				</p>

				<br />
								<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/wards/_wall_actions.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

				<p><?php echo smarty_function_html_tmpl_time(array('val' => $this->_tpl_vars['i']['pdate'],'type' => 1), $this);?>
 </p>
                                <?php elseif (5 == $this->_tpl_vars['i']['mtype']): ?>
				<div class="post-title">
					<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
"><b><?php if ($this->_tpl_vars['i']['first_name'] || $this->_tpl_vars['i']['last_name']):  echo $this->_tpl_vars['i']['first_name']; ?>
 <?php echo $this->_tpl_vars['i']['last_name'];  else:  echo $this->_tpl_vars['i']['public_name'];  endif; ?></b></a>
					<?php if ($this->_tpl_vars['i']['ward_from']): ?> from <a href="/wards/id<?php echo $this->_tpl_vars['i']['ward_from_id']; ?>
" ><b><?php echo $this->_tpl_vars['i']['ward_from']; ?>
</b></a> <?php endif; ?>
                    <?php if ($this->_tpl_vars['i']['story']): ?><p><?php echo ((is_array($_tmp=$this->_tpl_vars['i']['story'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</p><?php endif; ?></div>
				<p style="float: left; margin: none; padding: none;" align="left">
				    <?php if ($this->_tpl_vars['i']['v_code']): ?><object width="200" height="150"><?php echo $this->_tpl_vars['i']['v_code']; ?>
</object><?php endif; ?>
				</p>

				<br />
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/wards/_wall_actions.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

				<p><?php echo smarty_function_html_tmpl_time(array('val' => $this->_tpl_vars['i']['pdate'],'type' => 1), $this);?>
 </p>

                              <?php elseif ($this->_tpl_vars['i']['sub_mtype'] == 1): ?>
                                                <div class="post-title-badge">
                                                    <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
"><b><?php if ($this->_tpl_vars['i']['first_name'] || $this->_tpl_vars['i']['last_name']):  echo $this->_tpl_vars['i']['first_name']; ?>
 <?php echo $this->_tpl_vars['i']['last_name'];  else:  echo $this->_tpl_vars['i']['public_name'];  endif; ?></b></a>
                                                    <?php if ($this->_tpl_vars['i']['uid'] != $this->_tpl_vars['i']['uid3'] && $this->_tpl_vars['i']['ptype'] == 4 && ( $this->_tpl_vars['i']['first_name3'] || $this->_tpl_vars['i']['last_name3'] )): ?> to <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid3']; ?>
"><b><?php echo $this->_tpl_vars['i']['first_name3']; ?>
 <?php echo $this->_tpl_vars['i']['last_name3']; ?>
</b></a><?php endif; ?>
                                                    <?php if ($this->_tpl_vars['i']['uid'] != $this->_tpl_vars['i']['uid4'] && ( $this->_tpl_vars['i']['first_name4'] || $this->_tpl_vars['i']['last_name4'] )): ?> to <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid4']; ?>
"><b><?php echo $this->_tpl_vars['i']['first_name4']; ?>
 <?php echo $this->_tpl_vars['i']['last_name4']; ?>
</b></a><?php endif; ?>
                                                    <p><?php echo smarty_function_html_tmpl_time(array('val' => $this->_tpl_vars['i']['pdate'],'type' => 1), $this);?>
</p>
                                                    <table class="post-badge">
                                                    <td>
                                                        <img class="badge_img" src="<?php echo $this->_tpl_vars['imgDir']; ?>
/badges/<?php echo $this->_tpl_vars['i']['b_img_name']; ?>
.png" alt="<?php echo $this->_tpl_vars['i']['b_img_name']; ?>
"/>
                                                    </td>
                                                    <td>
                                                        <span class="story_badge"><?php if ($this->_tpl_vars['i']['story']):  echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['i']['story'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)))) ? $this->_run_mod_handler('dlong', true, $_tmp) : smarty_modifier_dlong($_tmp));  endif; ?></span>
                                                    </td>
                                                    </table>

                                                    <br/>
                                                    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/wards/_wall_actions.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                                                    <br/>
                                                </div>

                                <?php else: ?>
				<div class="post-title">
					<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
"><b><?php if ($this->_tpl_vars['i']['first_name'] || $this->_tpl_vars['i']['last_name']):  echo $this->_tpl_vars['i']['first_name']; ?>
 <?php echo $this->_tpl_vars['i']['last_name'];  else:  echo $this->_tpl_vars['i']['public_name'];  endif; ?></b></a>
					<?php if ($this->_tpl_vars['i']['ward_from']): ?> from <a href="/wards/id<?php echo $this->_tpl_vars['i']['ward_from_id']; ?>
" ><b><?php echo $this->_tpl_vars['i']['ward_from']; ?>
</b></a> <?php endif; ?>
                    <?php if ($this->_tpl_vars['i']['story']): ?><p><?php echo ((is_array($_tmp=$this->_tpl_vars['i']['story'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</p><?php endif; ?></div>

				<br />
				    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/wards/_wall_actions.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

				<p><?php echo smarty_function_html_tmpl_time(array('val' => $this->_tpl_vars['i']['pdate'],'type' => 1), $this);?>
</p>
                                <?php endif; ?>


				<p>
					<?php if (1 == $this->_tpl_vars['i']['ptype']): ?> for stake  <?php elseif (0 == $this->_tpl_vars['i']['ptype']): ?> for ward <?php endif; ?>
					<?php if ($this->_tpl_vars['i']['stype'] && $this->_tpl_vars['prhs'][$this->_tpl_vars['i']['stype']]): ?> (<?php echo $this->_tpl_vars['prhs'][$this->_tpl_vars['i']['stype']]; ?>
)
                                        <?php elseif ($this->_tpl_vars['i']['stype'] == 5): ?>
                                            <?php if ($this->_tpl_vars['uclasses_index'][$this->_tpl_vars['i']['pclass']]): ?> <?php echo $this->_tpl_vars['uclasses_index'][$this->_tpl_vars['i']['pclass']]; ?>
 <?php else: ?> classmates <?php endif; ?>
                                        <?php endif; ?>
				</p>
			</div>

			<ul id="id_mes_answ_list_<?php echo $this->_tpl_vars['i']['id']; ?>
" class="recomment">
						<?php if ($this->_tpl_vars['i']['answers']): ?>
							<?php $this->assign('answ', $this->_tpl_vars['i']['answers']); ?>
							<?php unset($this->_sections['si']);
$this->_sections['si']['name'] = 'si';
$this->_sections['si']['loop'] = is_array($_loop=$this->_tpl_vars['i']['answers']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
/s/s_<?php echo $this->_tpl_vars['answ'][$this->_sections['si']['index']]['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m56.jpg<?php endif; ?>" <?php if ($this->_tpl_vars['i']['uid'] == $this->_tpl_vars['UserInfo']['uid']): ?>class="small_avatar"<?php endif; ?> alt="" style="width: 56px; height: 56px;" /></a>
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

						<?php if (2 < $this->_tpl_vars['i']['cnt_answ']): ?><div id="id_div_show_more_answ_<?php echo $this->_tpl_vars['i']['id']; ?>
" class="tools-link"><a href="javascript: void(0);" onclick="oWWall.GetAnswList( '<?php echo $this->_tpl_vars['wid']; ?>
', '<?php echo $this->_tpl_vars['i']['id']; ?>
', 2, '' );">View all comments</a></div><?php endif; ?>

			<?php if ($this->_tpl_vars['CAN_EDIT']): ?>
			<div id="id_add_new_answ_inp_<?php echo $this->_tpl_vars['i']['id']; ?>
" class="add-comment-in"><input class="cl_add_answ_inp" mid="<?php echo $this->_tpl_vars['i']['id']; ?>
" type="text" value="Add comment" /></div>
			<form id="id_frm_add_mes_answ_<?php echo $this->_tpl_vars['i']['id']; ?>
" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
wards/id<?php echo $this->_tpl_vars['wid']; ?>
/wall/geteditansw" method="post">
				<input type="hidden" name="SI[mes_id]" value="<?php echo $this->_tpl_vars['i']['id']; ?>
" /><br />
				<div id="id_add_new_answ_txtar_<?php echo $this->_tpl_vars['i']['id']; ?>
" class="add-comment-in2" style="display: none;">
					<img src="<?php if ($this->_tpl_vars['UserInfo']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['UserInfo']['fpath']; ?>
/a/a_<?php echo $this->_tpl_vars['UserInfo']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m56.jpg<?php endif; ?>" alt="" style="width: 56px; height: 56px;" />
					<textarea id="id_add_new_answ_txtar_b<?php echo $this->_tpl_vars['i']['id']; ?>
" class="expand40-500 cl_answ_story" name="WI[story]" maxlength="480"></textarea>
					<div class="add_smile_tab"><a class="nav_attach_smile" onclick="oWWall.AddSmileTab('<?php echo $this->_tpl_vars['i']['id']; ?>
');" mtype="smile" style="cursor: pointer;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
smile_main.gif" alt="" /></a></div>
                                        <div class="share-white-b" style="margin-bottom: 3px; margin-top: 2px;"><a href="javascript: void(0);" onclick="oWWall.AddMesAnsw( '<?php echo $this->_tpl_vars['i']['id']; ?>
' );"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
add_b3_act.gif" alt="" /></a></div>
				</div>
                                <?php $this->assign('type_smile', 'comment'); ?>
                                <div id="show_smile_tab_comment_<?php echo $this->_tpl_vars['i']['id']; ?>
" class="smiley_comment" style="display: none;">
                                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "top_blocks/_smile.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                                </div>

			</form>
			<?php endif; ?>
		</div>
	</div>
<?php endforeach; endif; unset($_from); ?>

<?php if ($this->_tpl_vars['show_more']): ?>
<div id="id_div_show_more_mes" class="more-box" align="center" style="margin-left: 0px; padding-left: 0px;">
	<a href="javascript: void(0);" onclick="oWWall.GetList( '<?php echo $this->_tpl_vars['wid']; ?>
', $('.box001:last').attr('mid'), '<?php echo $this->_tpl_vars['sf_type']; ?>
', '<?php echo $this->_tpl_vars['sf']; ?>
', 1 );">More <img src="/i/arr01.gif" alt="" /></a>
</div>
<?php endif; ?>