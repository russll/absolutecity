<?php /* Smarty version 2.6.11, created on 2014-10-07 05:18:56
         compiled from mods/journal/_wall_list.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'mods/journal/_wall_list.html', 38, false),array('modifier', 'html_substr', 'mods/journal/_wall_list.html', 45, false),array('modifier', 'closetags', 'mods/journal/_wall_list.html', 45, false),array('modifier', 'count_characters', 'mods/journal/_wall_list.html', 48, false),array('modifier', 'nl2br', 'mods/journal/_wall_list.html', 193, false),array('function', 'html_tmpl_time', 'mods/journal/_wall_list.html', 59, false),)), $this); ?>
        <?php $_from = $this->_tpl_vars['mai']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
		<div id="id_journal_mes_<?php echo $this->_tpl_vars['i']['id']; ?>
" mid="<?php echo $this->_tpl_vars['i']['id']; ?>
" class="box001 cl_wall_mes wall_mes_journal"  onMouseOver="$('#id_journal_mes_<?php echo $this->_tpl_vars['i']['id']; ?>
 .tlink').show();" onMouseOut="$('#id_journal_mes_<?php echo $this->_tpl_vars['i']['id']; ?>
 .tlink').hide();">
			<div class="post-box">
				<div class="post-box-bg<?php if (5 == $this->_tpl_vars['i']['ptype']): ?>04<?php elseif (4 == $this->_tpl_vars['i']['ptype']): ?>05<?php elseif (3 == $this->_tpl_vars['i']['ptype']): ?>02<?php elseif (2 == $this->_tpl_vars['i']['ptype']): ?>03<?php elseif (1 == $this->_tpl_vars['i']['ptype']): ?>01<?php else: ?>00<?php endif; ?>" style="min-height: 68px">
				
				<?php if (! empty ( $this->_tpl_vars['i']['ptype'] )): ?><em><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico<?php if (5 == $this->_tpl_vars['i']['ptype']): ?>07_<?php elseif (4 == $this->_tpl_vars['i']['ptype']): ?>06<?php elseif (3 == $this->_tpl_vars['i']['ptype']): ?>05_<?php elseif (2 == $this->_tpl_vars['i']['ptype']): ?>04_<?php elseif (1 == $this->_tpl_vars['i']['ptype']): ?>03<?php endif; ?>.png" /></em><?php endif; ?>
				
				<div class="b-awatar"><a href="javascript: void(0);" onclick="$('#id_dropbox_<?php echo $this->_tpl_vars['i']['id']; ?>
').slideToggle('slow');"><img src="<?php if ($this->_tpl_vars['i']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['i']['fpath']; ?>
/s/s_<?php echo $this->_tpl_vars['i']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m66.jpg<?php endif; ?>" <?php if ($this->_tpl_vars['i']['uid'] == $this->_tpl_vars['UserInfo']['uid']): ?>class="small_avatar"<?php endif; ?>  /></a>
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
            <div class="post-title">
                <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
">
                    <b>
                    <?php if ($this->_tpl_vars['i']['first_name'] || $this->_tpl_vars['i']['last_name']): ?>
                        <?php echo $this->_tpl_vars['i']['first_name']; ?>
 <?php echo $this->_tpl_vars['i']['last_name']; ?>

                    <?php else: ?>
                        <?php echo $this->_tpl_vars['i']['public_name']; ?>

                    <?php endif; ?>
                    </b>
                </a> is going to <?php if ($this->_tpl_vars['i']['ev_title']):  echo $this->_tpl_vars['i']['ev_title'];  endif; ?>
            </div>
            <div class="event-txt">
                <img src="<?php echo $this->_tpl_vars['imgDir']; ?>
event_ico.gif"  /><?php echo $this->_tpl_vars['i']['ev_where']; ?>
, <br/><?php echo ((is_array($_tmp=$this->_tpl_vars['i']['ev_dt'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%B %d, %I:%M %p") : smarty_modifier_date_format($_tmp, "%B %d, %I:%M %p")); ?>
 <br/>
                <b id="id_journal_mes_subj_<?php echo $this->_tpl_vars['i']['id']; ?>
"><?php if ($this->_tpl_vars['i']['subj']):  echo $this->_tpl_vars['i']['subj'];  endif; ?></b><br/>
                                    <?php if ($this->_tpl_vars['i']['story']): ?>
                    <div style="width: 100%; clear:both; padding-top: 3px;" id="id_journal_mes_story_<?php echo $this->_tpl_vars['i']['id']; ?>
">
                        <div id="mes_story_<?php echo $this->_tpl_vars['i']['id']; ?>
_s"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['i']['story'])) ? $this->_run_mod_handler('html_substr', true, $_tmp, 500) : smarty_modifier_html_substr($_tmp, 500)))) ? $this->_run_mod_handler('closetags', true, $_tmp) : smarty_modifier_closetags($_tmp)); ?>
</div>
                        <div id="mes_story_<?php echo $this->_tpl_vars['i']['id']; ?>
_l" style="display:none;"><?php echo $this->_tpl_vars['i']['story']; ?>
</div>

			            <?php if (((is_array($_tmp=$this->_tpl_vars['i']['story'])) ? $this->_run_mod_handler('count_characters', true, $_tmp) : smarty_modifier_count_characters($_tmp)) > 500): ?>
                        <p style="min-height:20px;"><a class="link_expander" sid="<?php echo $this->_tpl_vars['i']['id']; ?>
" style="cursor: pointer; float: right; padding-bottom: 20px;">read more...</a></p>
		                <?php endif; ?>
                    </div>
                    <?php else: ?>
                        <span id="id_journal_mes_story_<?php echo $this->_tpl_vars['i']['id']; ?>
"></span>
		            <?php endif; ?>

            </div>
            <br />
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/journal/_wall_actions.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <p><?php echo smarty_function_html_tmpl_time(array('val' => $this->_tpl_vars['i']['pdate'],'type' => 1), $this);?>
</p>

            <?php elseif (3 == $this->_tpl_vars['i']['mtype']): ?>
            <div class="post-title">
                <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
">
                    <b><?php if ($this->_tpl_vars['i']['first_name'] || $this->_tpl_vars['i']['last_name']):  echo $this->_tpl_vars['i']['first_name']; ?>
 <?php echo $this->_tpl_vars['i']['last_name'];  else:  echo $this->_tpl_vars['i']['public_name'];  endif; ?></b>
                </a>
                <b id="id_journal_mes_subj_<?php echo $this->_tpl_vars['i']['id']; ?>
"><?php if ($this->_tpl_vars['i']['subj']):  echo $this->_tpl_vars['i']['subj'];  endif; ?></b><br/>
                                    <?php if ($this->_tpl_vars['i']['story']): ?>
                    <div style="width: 100%; clear:both; padding-top: 3px;" id="id_journal_mes_story_<?php echo $this->_tpl_vars['i']['id']; ?>
">
                        <div id="mes_story_<?php echo $this->_tpl_vars['i']['id']; ?>
_s"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['i']['story'])) ? $this->_run_mod_handler('html_substr', true, $_tmp, 500) : smarty_modifier_html_substr($_tmp, 500)))) ? $this->_run_mod_handler('closetags', true, $_tmp) : smarty_modifier_closetags($_tmp)); ?>
</div>
                        <div id="mes_story_<?php echo $this->_tpl_vars['i']['id']; ?>
_l" style="display:none;"><?php echo $this->_tpl_vars['i']['story']; ?>
</div>

			            <?php if (((is_array($_tmp=$this->_tpl_vars['i']['story'])) ? $this->_run_mod_handler('count_characters', true, $_tmp) : smarty_modifier_count_characters($_tmp)) > 500): ?>
                        <p style="min-height:20px;"><a class="link_expander" sid="<?php echo $this->_tpl_vars['i']['id']; ?>
" style="cursor: pointer; float: right; padding-bottom: 20px;">read more...</a></p>
		                <?php endif; ?>
                    </div>
                    <?php else: ?>
                        <span id="id_journal_mes_story_<?php echo $this->_tpl_vars['i']['id']; ?>
"></span>
		            <?php endif; ?>
            </div>
            <p>&nbsp;<a href="<?php echo $this->_tpl_vars['i']['l_url']; ?>
" target="_blank"><?php if ($this->_tpl_vars['i']['l_url_label']):  echo $this->_tpl_vars['i']['l_url_label'];  else:  echo $this->_tpl_vars['i']['l_url'];  endif; ?></a></p><br />

            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/journal/_wall_actions.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <p><?php echo smarty_function_html_tmpl_time(array('val' => $this->_tpl_vars['i']['pdate'],'type' => 1), $this);?>
</p>

            <?php elseif (4 == $this->_tpl_vars['i']['mtype']): ?>
            <div class="post-title">
                <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
">
                    <b><?php if ($this->_tpl_vars['i']['first_name'] || $this->_tpl_vars['i']['last_name']):  echo $this->_tpl_vars['i']['first_name']; ?>
 <?php echo $this->_tpl_vars['i']['last_name'];  else:  echo $this->_tpl_vars['i']['public_name'];  endif; ?></b>
                </a>
                <b id="id_journal_mes_subj_<?php echo $this->_tpl_vars['i']['id']; ?>
"><?php if ($this->_tpl_vars['i']['subj']):  echo $this->_tpl_vars['i']['subj'];  endif; ?></b><br/>
                                    <?php if ($this->_tpl_vars['i']['story']): ?>
                    <div style="width: 100%; clear:both; padding-top: 3px;" id="id_journal_mes_story_<?php echo $this->_tpl_vars['i']['id']; ?>
">
                        <div id="mes_story_<?php echo $this->_tpl_vars['i']['id']; ?>
_s"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['i']['story'])) ? $this->_run_mod_handler('html_substr', true, $_tmp, 500) : smarty_modifier_html_substr($_tmp, 500)))) ? $this->_run_mod_handler('closetags', true, $_tmp) : smarty_modifier_closetags($_tmp)); ?>
</div>
                        <div id="mes_story_<?php echo $this->_tpl_vars['i']['id']; ?>
_l" style="display:none;"><?php echo $this->_tpl_vars['i']['story']; ?>
</div>

			            <?php if (((is_array($_tmp=$this->_tpl_vars['i']['story'])) ? $this->_run_mod_handler('count_characters', true, $_tmp) : smarty_modifier_count_characters($_tmp)) > 500): ?>
                        <p style="min-height:20px;"><a class="link_expander" sid="<?php echo $this->_tpl_vars['i']['id']; ?>
" style="cursor: pointer; float: right; padding-bottom: 20px;">read more...</a></p>
		                <?php endif; ?>
                    </div>
                    <?php else: ?>
                        <span id="id_journal_mes_story_<?php echo $this->_tpl_vars['i']['id']; ?>
"></span>
		            <?php endif; ?>
            </div>

            <p style="float: left; margin: none; padding: none;" align="left">
                <?php if ($this->_tpl_vars['i']['p_url']): ?><em><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['juid']; ?>
/albums/id<?php echo $this->_tpl_vars['i']['p_img_aid']; ?>
/id<?php echo $this->_tpl_vars['i']['p_img_1_id']; ?>
"><img src="<?php echo $this->_tpl_vars['i']['p_url']; ?>
" style="max-width: 200px; max-height: 200px;" /></a></em><?php endif; ?>
                <?php if ($this->_tpl_vars['i']['p_path']): ?>
                    <?php if ($this->_tpl_vars['i']['p_img_1']): ?><em><a href="<?php if ($this->_tpl_vars['i']['p_img_aid'] && $this->_tpl_vars['i']['p_img_1_id']):  echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['juid']; ?>
/albums/id<?php echo $this->_tpl_vars['i']['p_img_aid']; ?>
/id<?php echo $this->_tpl_vars['i']['p_img_1_id'];  else: ?>javascript: void(0);<?php endif; ?>" <?php if (! $this->_tpl_vars['i']['p_img_1_id']): ?> style="cursor: default;" <?php endif; ?>><img src="<?php echo $this->_tpl_vars['fImgDir']; ?>
journal/<?php echo $this->_tpl_vars['i']['p_path']; ?>
/<?php echo $this->_tpl_vars['i']['p_img_1']; ?>
" style="max-width: 300px; max-height: 200px;" /></a></em><?php endif; ?>
                    <?php if ($this->_tpl_vars['i']['p_img_2']): ?><em><a href="<?php if ($this->_tpl_vars['i']['p_img_aid'] && $this->_tpl_vars['i']['p_img_2_id']):  echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['juid']; ?>
/albums/id<?php echo $this->_tpl_vars['i']['p_img_aid']; ?>
/id<?php echo $this->_tpl_vars['i']['p_img_2_id'];  else: ?>javascript: void(0);<?php endif; ?>" <?php if (! $this->_tpl_vars['i']['p_img_2_id']): ?> style="cursor: default;" <?php endif; ?>><img src="<?php echo $this->_tpl_vars['fImgDir']; ?>
journal/<?php echo $this->_tpl_vars['i']['p_path']; ?>
/<?php echo $this->_tpl_vars['i']['p_img_2']; ?>
" style="max-width: 300px; max-height: 200px;" /></a></em><?php endif; ?>
                    <?php if ($this->_tpl_vars['i']['p_img_3']): ?><em><a href="<?php if ($this->_tpl_vars['i']['p_img_aid'] && $this->_tpl_vars['i']['p_img_3_id']):  echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['juid']; ?>
/albums/id<?php echo $this->_tpl_vars['i']['p_img_aid']; ?>
/id<?php echo $this->_tpl_vars['i']['p_img_3_id'];  else: ?>javascript: void(0);<?php endif; ?>" <?php if (! $this->_tpl_vars['i']['p_img_3_id']): ?> style="cursor: default;" <?php endif; ?>><img src="<?php echo $this->_tpl_vars['fImgDir']; ?>
journal/<?php echo $this->_tpl_vars['i']['p_path']; ?>
/<?php echo $this->_tpl_vars['i']['p_img_3']; ?>
" style="max-width: 300px; max-height: 200px;" /></a></em><?php endif; ?>
                <?php endif; ?>
            </p>
            <br />
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/journal/_wall_actions.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

            <p><?php echo smarty_function_html_tmpl_time(array('val' => $this->_tpl_vars['i']['pdate'],'type' => 1), $this);?>
</p>

            <?php elseif (5 == $this->_tpl_vars['i']['mtype']): ?>
            <div class="post-title">
                <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
">
                    <b><?php if ($this->_tpl_vars['i']['first_name'] || $this->_tpl_vars['i']['last_name']):  echo $this->_tpl_vars['i']['first_name']; ?>
 <?php echo $this->_tpl_vars['i']['last_name'];  else:  echo $this->_tpl_vars['i']['public_name'];  endif; ?></b>
                </a>
                <b id="id_journal_mes_subj_<?php echo $this->_tpl_vars['i']['id']; ?>
"><?php if ($this->_tpl_vars['i']['subj']):  echo $this->_tpl_vars['i']['subj'];  endif; ?></b><br/>
                                    <?php if ($this->_tpl_vars['i']['story']): ?>
                    <div style="width: 100%; clear:both; padding-top: 3px;" id="id_journal_mes_story_<?php echo $this->_tpl_vars['i']['id']; ?>
">
                        <div id="mes_story_<?php echo $this->_tpl_vars['i']['id']; ?>
_s"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['i']['story'])) ? $this->_run_mod_handler('html_substr', true, $_tmp, 500) : smarty_modifier_html_substr($_tmp, 500)))) ? $this->_run_mod_handler('closetags', true, $_tmp) : smarty_modifier_closetags($_tmp)); ?>
</div>
                        <div id="mes_story_<?php echo $this->_tpl_vars['i']['id']; ?>
_l" style="display:none;"><?php echo $this->_tpl_vars['i']['story']; ?>
</div>

			            <?php if (((is_array($_tmp=$this->_tpl_vars['i']['story'])) ? $this->_run_mod_handler('count_characters', true, $_tmp) : smarty_modifier_count_characters($_tmp)) > 500): ?>
                        <p style="min-height:20px;"><a class="link_expander" sid="<?php echo $this->_tpl_vars['i']['id']; ?>
" style="cursor: pointer; float: right; padding-bottom: 20px;">read more...</a></p>
		                <?php endif; ?>
                    </div>
                    <?php else: ?>
                        <span id="id_journal_mes_story_<?php echo $this->_tpl_vars['i']['id']; ?>
"></span>
		            <?php endif; ?>
            </div>
            <p style="float: left; margin: none; padding: none;" align="left">
                <?php if ($this->_tpl_vars['i']['v_code']): ?><object width="200" height="150"><?php echo $this->_tpl_vars['i']['v_code']; ?>
</object><?php endif; ?>
            </p>
            <br />
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/journal/_wall_actions.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <p><?php echo smarty_function_html_tmpl_time(array('val' => $this->_tpl_vars['i']['pdate'],'type' => 1), $this);?>
</p>

            <?php else: ?>
            <div class="post-title">
                <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
"><b><?php if ($this->_tpl_vars['i']['first_name'] || $this->_tpl_vars['i']['last_name']):  echo $this->_tpl_vars['i']['first_name']; ?>
 <?php echo $this->_tpl_vars['i']['last_name'];  else:  echo $this->_tpl_vars['i']['public_name'];  endif; ?></b></a>
                <b id="id_journal_mes_subj_<?php echo $this->_tpl_vars['i']['id']; ?>
"><?php if ($this->_tpl_vars['i']['subj']):  echo $this->_tpl_vars['i']['subj'];  endif; ?></b>

                    <?php if ($this->_tpl_vars['i']['story']): ?>
                    <div style="width: 100%; clear:both; padding-top: 3px;" id="id_journal_mes_story_<?php echo $this->_tpl_vars['i']['id']; ?>
">
                        <div id="mes_story_<?php echo $this->_tpl_vars['i']['id']; ?>
_s"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['i']['story'])) ? $this->_run_mod_handler('html_substr', true, $_tmp, 500) : smarty_modifier_html_substr($_tmp, 500)))) ? $this->_run_mod_handler('closetags', true, $_tmp) : smarty_modifier_closetags($_tmp)); ?>
</div>
                        <div id="mes_story_<?php echo $this->_tpl_vars['i']['id']; ?>
_l" style="display:none;"><?php echo $this->_tpl_vars['i']['story']; ?>
</div>

			            <?php if (((is_array($_tmp=$this->_tpl_vars['i']['story'])) ? $this->_run_mod_handler('count_characters', true, $_tmp) : smarty_modifier_count_characters($_tmp)) > 500): ?>
                        <p style="min-height:20px;"><a class="link_expander" sid="<?php echo $this->_tpl_vars['i']['id']; ?>
" style="cursor: pointer; float: right; padding-bottom: 20px;">read more...</a></p>
		                <?php endif; ?>
                    </div>
                    <?php else: ?>
                        <span id="id_journal_mes_story_<?php echo $this->_tpl_vars['i']['id']; ?>
"></span>
		            <?php endif; ?>
            </div>
            <br />
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/journal/_wall_actions.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <p>
                <?php echo smarty_function_html_tmpl_time(array('val' => $this->_tpl_vars['i']['pdate'],'type' => 1), $this);?>

            </p>
            <?php endif; ?>


                                        <p><?php if (5 == $this->_tpl_vars['i']['ptype']): ?>private<?php elseif (4 == $this->_tpl_vars['i']['ptype']): ?>only for <?php if ($this->_tpl_vars['i']['first_name3'] && $this->_tpl_vars['i']['last_name3']): ?> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid3']; ?>
"><?php echo $this->_tpl_vars['i']['first_name3']; ?>
 <?php echo $this->_tpl_vars['i']['last_name3']; ?>
</a> <?php else: ?> ... <?php endif; ?>
		   				<?php elseif (3 == $this->_tpl_vars['i']['ptype']): ?>for family<?php elseif (2 == $this->_tpl_vars['i']['ptype']): ?>for friends <?php if ($this->_tpl_vars['i']['pstype']): ?> ( <?php if ($this->_tpl_vars['i']['pstype'] == 5): ?> <?php if ($this->_tpl_vars['uclasses_index'][$this->_tpl_vars['i']['pclass']]): ?> <?php echo $this->_tpl_vars['uclasses_index'][$this->_tpl_vars['i']['pclass']]; ?>
 <?php else: ?> classmates <?php endif; ?> <?php elseif ($this->_tpl_vars['i']['pstype'] == 1): ?> aaronic priesthood <?php elseif ($this->_tpl_vars['i']['pstype'] == 2): ?> young man <?php elseif ($this->_tpl_vars['i']['pstype'] == 3): ?> priesthood holders <?php elseif ($this->_tpl_vars['i']['pstype'] == 4): ?> melchizedek priesthood <?php elseif ($this->_tpl_vars['i']['pstype'] == 7): ?> high priest <?php elseif ($this->_tpl_vars['i']['pstype'] == 12): ?> young woman <?php elseif ($this->_tpl_vars['i']['pstype'] == 100): ?> <?php if ($this->_tpl_vars['UserInfo']['ward_id'] == $this->_tpl_vars['i']['uvid']): ?> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
wards/id<?php echo $this->_tpl_vars['UserInfo']['ward_id']; ?>
"><?php echo $this->_tpl_vars['UserInfo']['ward']; ?>
</a> <?php else: ?> prev ward <?php endif; ?> <?php elseif ($this->_tpl_vars['i']['pstype'] == 101): ?> <?php if ($this->_tpl_vars['UserInfo']['stake_id'] == $this->_tpl_vars['i']['uvid']): ?> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
wards/id<?php echo $this->_tpl_vars['UserInfo']['stake_id']; ?>
"><?php echo $this->_tpl_vars['UserInfo']['stake']; ?>
</a> <?php else: ?> prev stake <?php endif; ?> <?php endif; ?> ) <?php endif; ?>
		   				<?php elseif (1 == $this->_tpl_vars['i']['ptype']): ?>for friends and followers <?php if ($this->_tpl_vars['i']['pstype']): ?> ( <?php if ($this->_tpl_vars['i']['pstype'] == 5): ?> <?php if ($this->_tpl_vars['uclasses_index'][$this->_tpl_vars['i']['pclass']]): ?> <?php echo $this->_tpl_vars['uclasses_index'][$this->_tpl_vars['i']['pclass']]; ?>
 <?php else: ?> classmates <?php endif; ?> <?php elseif ($this->_tpl_vars['i']['pstype'] == 1): ?> aaronic priesthood <?php elseif ($this->_tpl_vars['i']['pstype'] == 2): ?> young man <?php elseif ($this->_tpl_vars['i']['pstype'] == 3): ?> priesthood holders <?php elseif ($this->_tpl_vars['i']['pstype'] == 4): ?> melchizedek priesthood <?php elseif ($this->_tpl_vars['i']['pstype'] == 7): ?> high priest <?php elseif ($this->_tpl_vars['i']['pstype'] == 12): ?> young woman <?php elseif ($this->_tpl_vars['i']['pstype'] == 100): ?> <?php if ($this->_tpl_vars['UserInfo']['ward_id'] == $this->_tpl_vars['i']['uvid']): ?> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
wards/id<?php echo $this->_tpl_vars['UserInfo']['ward_id']; ?>
"><?php echo $this->_tpl_vars['UserInfo']['ward']; ?>
</a> <?php else: ?> prev ward <?php endif; ?> <?php elseif ($this->_tpl_vars['i']['pstype'] == 101): ?> <?php if ($this->_tpl_vars['UserInfo']['stake_id'] == $this->_tpl_vars['i']['uvid']): ?> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
wards/id<?php echo $this->_tpl_vars['UserInfo']['stake_id']; ?>
"><?php echo $this->_tpl_vars['UserInfo']['stake']; ?>
</a> <?php else: ?> prev stake <?php endif; ?> <?php endif; ?> ) <?php endif; ?>
		   				<?php elseif (0 == $this->_tpl_vars['i']['ptype']): ?>for everyone <?php if ($this->_tpl_vars['i']['first_name3'] && $this->_tpl_vars['i']['last_name3'] && $this->_tpl_vars['i']['uvid'] && $this->_tpl_vars['i']['uid'] != $this->_tpl_vars['i']['uvid']): ?> except <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid3']; ?>
"><?php echo $this->_tpl_vars['i']['first_name3']; ?>
 <?php echo $this->_tpl_vars['i']['last_name3']; ?>
</a> <?php endif; ?>
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
no_photo_m56.jpg<?php endif; ?>" <?php if ($this->_tpl_vars['i']['uid'] == $this->_tpl_vars['UserInfo']['uid']): ?>class="small_avatar"<?php endif; ?>  style="width: 56px; height: 56px;" /></a>
						<div>
						<p><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['answ'][$this->_sections['si']['index']]['uid']; ?>
"><?php if ($this->_tpl_vars['answ'][$this->_sections['si']['index']]['first_name'] || $this->_tpl_vars['answ'][$this->_sections['si']['index']]['last_name']):  echo $this->_tpl_vars['answ'][$this->_sections['si']['index']]['first_name'];  else:  echo $this->_tpl_vars['answ'][$this->_sections['si']['index']]['public_name'];  endif; ?></a> <?php if ($this->_tpl_vars['answ'][$this->_sections['si']['index']]['story']):  echo ((is_array($_tmp=$this->_tpl_vars['answ'][$this->_sections['si']['index']]['story'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp));  endif; ?></p>
						<p><span><?php echo smarty_function_html_tmpl_time(array('val' => $this->_tpl_vars['answ'][$this->_sections['si']['index']]['pdate'],'type' => 1), $this);?>
</span></p>
						</div>
					</li>
					<?php endfor; endif; ?>
				<?php endif; ?>
				</ul>

				<?php if (2 < $this->_tpl_vars['i']['cnt_answ']): ?><div id="id_div_show_more_answ_<?php echo $this->_tpl_vars['i']['id']; ?>
" class="tools-link"><a href="javascript: void(0);" onclick="oJournal.GetAnswList( '<?php echo $this->_tpl_vars['i']['uid']; ?>
', '<?php echo $this->_tpl_vars['i']['id']; ?>
', 2, '' );">View all comments</a></div><?php endif; ?>
				
				<div id="id_add_new_answ_inp_<?php echo $this->_tpl_vars['i']['id']; ?>
" class="add-comment-in"><input class="cl_add_answ_inp" mid="<?php echo $this->_tpl_vars['i']['id']; ?>
" type="text" value="Add comment" style="width: 100%;" /></div>
				<form id="id_frm_add_mes_answ_<?php echo $this->_tpl_vars['i']['id']; ?>
" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/journal/geteditansw" method="post">
				<input type="hidden" name="SI[mes_id]" value="<?php echo $this->_tpl_vars['i']['id']; ?>
" /><br />
					<div id="id_add_new_answ_txtar_<?php echo $this->_tpl_vars['i']['id']; ?>
" class="add-comment-in2" style="display: none;">
						<img src="<?php if ($this->_tpl_vars['UserInfo']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['UserInfo']['fpath']; ?>
/a/a_<?php echo $this->_tpl_vars['UserInfo']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m56.jpg<?php endif; ?>"  style="width: 56px; height: 56px;" />
						<textarea id="id_add_new_answ_txtar_b<?php echo $this->_tpl_vars['i']['id']; ?>
" class="expand40-500 cl_answ_story" name="WI[story]" style="width: 85%;"></textarea>
						<div class="add_smile_tab"><a class="nav_attach_smile" onclick="oJournal.AddSmileTab('<?php echo $this->_tpl_vars['i']['id']; ?>
');" mtype="smile" style="cursor: pointer;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
smile_main.gif" alt="" /></a></div>
                                                <div class="share-white-b" style="margin-bottom: 3px; margin-top: 2px;"><a href="javascript: void(0);" onclick="oJournal.AddMesAnsw( '<?php echo $this->_tpl_vars['i']['id']; ?>
' );"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
add_b3_act.gif"  /></a></div>
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

			</div>
		</div>
<?php endforeach; endif; unset($_from); ?>

<?php if ($this->_tpl_vars['show_more']): ?>
<div id="id_div_show_more_mes" class="more-box" align="center" style="margin-left: 0px; padding-left: 0px;">
	<a href="javascript: void(0);" onclick="oJournal.GetList( '<?php echo $this->_tpl_vars['ui']['uid']; ?>
', $('.box001:last').attr('mid') );">More <img src="/i/arr01.gif" alt=""  /></a>
</div>
<?php endif; ?>