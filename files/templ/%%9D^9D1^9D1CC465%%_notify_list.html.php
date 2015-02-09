<?php /* Smarty version 2.6.11, created on 2014-04-04 23:00:24
         compiled from mods/users/_notify_list.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'mods/users/_notify_list.html', 1, false),array('function', 'html_str_format', 'mods/users/_notify_list.html', 41, false),array('function', 'html_tmpl_time', 'mods/users/_notify_list.html', 50, false),array('modifier', 'cat', 'mods/users/_notify_list.html', 6, false),array('modifier', 'truncate', 'mods/users/_notify_list.html', 29, false),)), $this); ?>
		<?php echo smarty_function_config_load(array('file' => "notify.conf"), $this);?>

		<?php if (! $this->_tpl_vars['ajax']): ?><h2><span id="ntypeName">All notifications</span>  <?php if ($this->_tpl_vars['cnt_ar_notify']): ?><span><?php echo $this->_tpl_vars['cnt_ar_notify']; ?>
</span><?php endif; ?></h2><?php endif; ?>
			<div id="id_notify_mlist" class="main_notify">
			<?php if ($this->_tpl_vars['ar_notify']): ?>
			<?php $_from = $this->_tpl_vars['ar_notify']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
				<?php $this->assign('ntype', ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp='nf_')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['i']['wtype']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['i']['wtype'])))) ? $this->_run_mod_handler('cat', true, $_tmp, '_') : smarty_modifier_cat($_tmp, '_')))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['i']['type']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['i']['type']))); ?>
                                <?php $this->assign('fname', ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['i']['first_name'])) ? $this->_run_mod_handler('cat', true, $_tmp, ' ') : smarty_modifier_cat($_tmp, ' ')))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['i']['last_name']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['i']['last_name']))); ?>

				
				<div class="notific" swtype="<?php echo $this->_tpl_vars['i']['wtype']; ?>
" sntype="<?php echo $this->_tpl_vars['i']['type']; ?>
" <?php if (50 == $this->_tpl_vars['i']['type'] && IS_USER): ?> n_frid="<?php echo $this->_tpl_vars['i']['uid']; ?>
" <?php endif; ?> style="min-height: 80px;">
					<div class="notific-box">
						<?php if (3 == $this->_tpl_vars['i']['wtype'] || 4 == $this->_tpl_vars['i']['wtype']): ?>
						<?php $this->assign('p_img', $this->_tpl_vars['i']['img']); ?>
						<?php $this->assign('v_img', $this->_tpl_vars['i']['video_img']); ?>
						
							<?php if ($this->_tpl_vars['p_img']['img'] || $this->_tpl_vars['i']['video_img']): ?>
							<div class="notific-right">
								<?php if ($this->_tpl_vars['p_img']['img']): ?>
									<span><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['p_img']['uid']; ?>
/albums/id<?php echo $this->_tpl_vars['p_img']['aid']; ?>
/id<?php echo $this->_tpl_vars['p_img']['id']; ?>
"><img src="<?php echo $this->_tpl_vars['fImgDir'];  if (2 == $this->_tpl_vars['p_img']['atype']):  if ('Wall' == $this->_tpl_vars['p_img']['aname']): ?>wall/<?php elseif ('Journal' == $this->_tpl_vars['p_img']['aname']): ?>journal/<?php elseif ('Mission' == $this->_tpl_vars['p_img']['name']): ?>mission/wall/<?php elseif ('Ward' == $this->_tpl_vars['p_img']['aname']): ?>wards/wall/<?php endif;  else: ?>albums/<?php endif;  echo $this->_tpl_vars['p_img']['fpath']; ?>
/a/a_<?php echo $this->_tpl_vars['p_img']['img']; ?>
"  style="max-width: 99px; max-height: 66px;"  /></a></span>
								<?php elseif ($this->_tpl_vars['v_img']['video_img']): ?>
									<span><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['v_img']['uid']; ?>
/valbums/id<?php echo $this->_tpl_vars['v_img']['aid']; ?>
/id<?php echo $this->_tpl_vars['v_img']['id']; ?>
"><img src="<?php echo $this->_tpl_vars['v_img']['video_img']; ?>
"  style="max-width: 99px; max-height: 66px;"  /></a></span>
								<?php endif; ?>
							</div>
							<?php endif; ?>
						<?php endif; ?>
						<div class="b-awatar"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
"><img src="<?php if ($this->_tpl_vars['i']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['i']['fpath']; ?>
/s/s_<?php echo $this->_tpl_vars['i']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m66.jpg<?php endif; ?>"  /></a></div>

                                                <?php if (! $this->_tpl_vars['i']['to_uid']): ?>
                                                    <div class="notific-title"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
"><b><?php echo $this->_tpl_vars['i']['first_name']; ?>
 <?php echo $this->_tpl_vars['i']['last_name']; ?>
</b></a> <?php echo $this->_config[0]['vars'][$this->_tpl_vars['ntype']]; ?>
 <?php if ($this->_tpl_vars['i']['link'] && $this->_tpl_vars['i']['link_txt']): ?> <a href="<?php echo $this->_tpl_vars['i']['link']; ?>
"> <?php echo ((is_array($_tmp=$this->_tpl_vars['i']['link_txt'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 50, "...", true) : smarty_modifier_truncate($_tmp, 50, "...", true)); ?>
</a> <?php endif; ?></div>
						<?php else: ?>
                                                    <?php $this->assign('ntype_ext', ((is_array($_tmp=((is_array($_tmp='enf_1')) ? $this->_run_mod_handler('cat', true, $_tmp, '_') : smarty_modifier_cat($_tmp, '_')))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['i']['type']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['i']['type']))); ?>
                                                    <div class="notific-title">
                                                        <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
"><b><?php echo $this->_tpl_vars['i']['first_name']; ?>
 <?php echo $this->_tpl_vars['i']['last_name']; ?>
</b></a> <?php echo $this->_config[0]['vars'][$this->_tpl_vars['ntype_ext']]; ?>
 <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['to_uid'];  if ($this->_tpl_vars['i']['notify_pos'] == 2): ?>/journal/<?php endif; ?>"><?php echo ((is_array($_tmp=$this->_tpl_vars['i']['to_first_name'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 25, "...") : smarty_modifier_truncate($_tmp, 25, "...")); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['i']['to_last_name'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 25, "...") : smarty_modifier_truncate($_tmp, 25, "...")); ?>
</a> <?php if ($this->_tpl_vars['i']['notify_pos'] == 2): ?>journal<?php else: ?>wall<?php endif; ?> <?php if ($this->_tpl_vars['i']['link'] && $this->_tpl_vars['i']['link_txt']): ?> <a href="<?php echo $this->_tpl_vars['i']['link']; ?>
"> <?php echo ((is_array($_tmp=$this->_tpl_vars['i']['link_txt'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 10, "...", true) : smarty_modifier_truncate($_tmp, 10, "...", true)); ?>
</a> <?php endif; ?>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (50 == $this->_tpl_vars['i']['type'] && IS_USER): ?>
                                                        <div id="i_frid<?php echo $this->_tpl_vars['i']['uid']; ?>
" style="padding-left: 90px; padding-top:10px;">
								<div class="notific-txt2">&nbsp;</div>
								<div class="notific-button">
									<span class="notific-button02"><a href="javascript: void(0);" onclick="var ntxt = $('#id_ntxt').val(); if (!ntxt) ntxt = ''; else ntxt = ntxt.replace('\'', ''); oSystem.SConfPopup( 'oFriends.InviteActAjax( <?php echo $this->_tpl_vars['i']['uid']; ?>
, 1, \''+ntxt+'\' );', 'Please confirm you would like to add <?php echo smarty_function_html_str_format(array('str' => $this->_tpl_vars['fname']), $this);?>
 into your friends list?', 'Accept' );">Accept</a></span>
									<span class="notific-button01"><a href="javascript: void(0);" onclick="var ntxt = $('#id_ntxt').val(); if (!ntxt) ntxt = ''; else ntxt = ntxt.replace('\'', ''); oSystem.SConfPopup( 'oFriends.InviteActAjax( <?php echo $this->_tpl_vars['i']['uid']; ?>
, 2, \''+ntxt+'\' );', 'Please confirm you want to reject invitation from <?php echo smarty_function_html_str_format(array('str' => $this->_tpl_vars['fname']), $this);?>
?' );">Decline</a></span>
									                                                                        <input type="hidden" name="id_ntxt" id="id_ntxt" value="" />
								</div>
                                                        </div>
						<?php else: ?>
							<div class="notific-txt">
								<?php echo ((is_array($_tmp=$this->_tpl_vars['i']['info'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 255, "...", true) : smarty_modifier_truncate($_tmp, 255, "...", true)); ?>

								<span><?php echo smarty_function_html_tmpl_time(array('val' => $this->_tpl_vars['i']['dt'],'type' => 1), $this);?>
</span>
							</div>
						<?php endif; ?>
					</div>
				<div class="clear">&nbsp;</div>	
				</div>
			<?php endforeach; endif; unset($_from); ?>	
			</div>
			
			<?php if (( $this->_tpl_vars['pcnt']+$this->_tpl_vars['rcnt'] ) < $this->_tpl_vars['cnt_ar_notify']): ?>
			<div id="id_div_show_more_mes" class="more-box" align="center" style="margin-left: 0px; padding-left: 0px;">
				<a href="javascript: void(0);" onclick="oUsers.GetNotifyList( '<?php echo $this->_tpl_vars['pcnt']+$this->_tpl_vars['rcnt']; ?>
', '<?php echo $this->_tpl_vars['rcnt']; ?>
' );">More <img src="/i/arr01.gif"  /></a>
			</div>
			<?php endif; ?>
			
			<?php endif; ?>