<?php /* Smarty version 2.6.11, created on 2014-08-07 16:18:33
         compiled from mods/profile/_tags_list.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_str_format', 'mods/profile/_tags_list.html', 13, false),array('function', 'html_tmpl_time', 'mods/profile/_tags_list.html', 86, false),array('modifier', 'truncate', 'mods/profile/_tags_list.html', 13, false),array('modifier', 'date_format', 'mods/profile/_tags_list.html', 73, false),array('modifier', 'nl2br', 'mods/profile/_tags_list.html', 79, false),)), $this); ?>
<?php if ('tags_list' == $this->_tpl_vars['ttype']): ?>

<?php if ($this->_tpl_vars['ar_tags']): ?>
<div class="cl_srch_list">
    <h2>Tags List</h2>
    <?php $_from = $this->_tpl_vars['ar_tags']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tk'] => $this->_tpl_vars['tags']):
?>
    <div class="box001 cl_tags_list_els" tid="<?php echo $this->_tpl_vars['tags']['id']; ?>
" id="id_tags_menu_list_<?php echo $this->_tpl_vars['tags']['id']; ?>
">
        <div class="post-box-bg00" style="min-height: 40px;">
            <div class="post-title2" style="padding-left: 0px; margin-left: 0px;">
                <b><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/tags/id<?php echo $this->_tpl_vars['tags']['id']; ?>
"><?php echo $this->_tpl_vars['tags']['name']; ?>
</a></b>
		<?php if ($this->_tpl_vars['tags']['cnt_mes']): ?><span style="float: right;"><?php echo $this->_tpl_vars['tags']['cnt_mes']; ?>
</span><?php endif; ?>
		<?php $this->assign('tsname', $this->_tpl_vars['tags']['name']); ?>
		<?php if ($this->_tpl_vars['IS_USER']): ?><span class="cl_del_link" tid="<?php echo $this->_tpl_vars['tags']['id']; ?>
" style="margin-right: 5px;"><a href="javascript: void(0);" onclick="javascript: oSystem.SConfPopup( 'oUsers.DeleteTag( <?php echo $this->_tpl_vars['tags']['id']; ?>
 );', 'Please confirm you want to delete tag \'<?php echo smarty_function_html_str_format(array('str' => ((is_array($_tmp=$this->_tpl_vars['tsname'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 30) : smarty_modifier_truncate($_tmp, 30))), $this);?>
\'?' );">&nbsp&nbsp&nbsp&nbsp</a></span><?php endif; ?>
            </div>
        </div>
    </div>
    <?php endforeach; endif; unset($_from); ?>
</div>
<?php else: ?>
<h2>Tags List</h2>
<div class="box001">
    <div class="post-box">
	There aren't any tags
    </div>
</div>
<?php endif;  endif; ?>


<?php $this->assign('auto_show_act', 1);  if ('tags_mes_list' == $this->_tpl_vars['ttype']): ?>
<h2>Messages List From "<?php echo $this->_tpl_vars['ti']['name']; ?>
"</h2>
<?php if ($this->_tpl_vars['ar_tags_msg']):  $this->assign('ind', 0);  $this->assign('m_ind', 0);  $this->assign('w_ind', 0); ?>

<?php $_from = $this->_tpl_vars['ar_tags_msg']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k2'] => $this->_tpl_vars['i2']):
 if ($this->_tpl_vars['i2']): ?>
<div id="id_tags_list_<?php if ($this->_tpl_vars['k2'] == 'wall'): ?>2<?php elseif ($this->_tpl_vars['k2'] == 'journal'): ?>5<?php elseif ($this->_tpl_vars['k2'] == 'mission'): ?>3<?php elseif ($this->_tpl_vars['k2'] == 'wards'): ?>4<?php endif; ?>" class="cl_tags_list">
     <h2><?php if ($this->_tpl_vars['k2'] == 'wall'): ?>Profile Wall Messages<?php elseif ($this->_tpl_vars['k2'] == 'journal'): ?>Journal Wall Messages<?php elseif ($this->_tpl_vars['k2'] == 'mission'): ?>Mission Wall Messages<?php elseif ($this->_tpl_vars['k2'] == 'wards'): ?>Wards Wall Messages<?php endif; ?></h2>

    <?php $_from = $this->_tpl_vars['i2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i3']):
?>
    <?php $this->assign('i', $this->_tpl_vars['i3']['mes']); ?>
    <?php $this->assign('ind', $this->_tpl_vars['ind']+1); ?>
    <div id="id_tags_mes_<?php echo $this->_tpl_vars['i']['id']; ?>
" tid="<?php echo $this->_tpl_vars['i']['id']; ?>
" class="box001 cl_tags_list_els">
        <div class="post-box">
            <div class="post-box-bg<?php if (5 == $this->_tpl_vars['i']['ptype']): ?>04<?php elseif (4 == $this->_tpl_vars['i']['ptype']): ?>05<?php elseif (3 == $this->_tpl_vars['i']['ptype']): ?>02<?php elseif (2 == $this->_tpl_vars['i']['ptype']): ?>03<?php elseif (1 == $this->_tpl_vars['i']['ptype']): ?>01<?php else: ?>00<?php endif; ?>" style="min-height: 68px">

		<?php if (! empty ( $this->_tpl_vars['i']['ptype'] )): ?><em><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico<?php if (5 == $this->_tpl_vars['i']['ptype']): ?>07_<?php elseif (4 == $this->_tpl_vars['i']['ptype']): ?>06<?php elseif (3 == $this->_tpl_vars['i']['ptype']): ?>05_<?php elseif (2 == $this->_tpl_vars['i']['ptype']): ?>04_<?php elseif (1 == $this->_tpl_vars['i']['ptype']): ?>03<?php endif; ?>.png"  /></em><?php endif; ?>

                <div class="b-awatar"><a href="javascript: void(0);" onclick="javascript: $('#id_dropbox_<?php echo $this->_tpl_vars['i']['id']; ?>
').slideToggle('slow');"><img src="<?php if ($this->_tpl_vars['i']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['i']['fpath']; ?>
/s/s_<?php echo $this->_tpl_vars['i']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m66.jpg<?php endif; ?>"  /></a>
                    <!-- Drop00 -->
		    <?php if ($this->_tpl_vars['i']['uid'] != $this->_tpl_vars['UserInfo']['uid']): ?>
                    <div id="id_dropbox_<?php echo $this->_tpl_vars['i']['id']; ?>
" class="dropbox00">
                        <div class="dropbox00-left">
                            <div class="dropbox00-right">
                                <ul><li><a href="#">Send a message</a></li></ul>
                                <p><?php if (! $this->_tpl_vars['i']['relations']['im_friend']): ?><a href="javascript: void(0);" onclick="javascript: oFriends.GetFrAjax('<?php echo $this->_tpl_vars['i']['uid']; ?>
', 0)">Add as Friend</a><?php else: ?><a href="javascript: void(0);" onclick="javascript: oFriends.SHConfirmPopup(1, 'id_confirm_friends_popup', '<?php echo $this->_tpl_vars['i']['uid']; ?>
')">Unfriend</a><?php endif; ?></p>
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
 <?php echo $this->_tpl_vars['i']['last_name'];  else:  echo $this->_tpl_vars['i']['public_name'];  endif; ?></b></a> is going to <?php if ($this->_tpl_vars['i']['ev_title']):  echo $this->_tpl_vars['i']['ev_title'];  endif; ?></div>
                <div class="event-txt">
                    <img src="<?php echo $this->_tpl_vars['imgDir']; ?>
event_ico.gif"  /><?php echo $this->_tpl_vars['i']['ev_where']; ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['i']['ev_dt'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%B %d, %I:%M %p") : smarty_modifier_date_format($_tmp, "%B %d, %I:%M %p")); ?>
 <br><br>
                    <div>
                        <?php if ($this->_tpl_vars['i']['ev_img']): ?><img src="<?php echo $this->_tpl_vars['siteAdr']; ?>
f/wall/<?php echo $this->_tpl_vars['i']['uid']; ?>
/t/<?php echo $this->_tpl_vars['i']['ev_img']; ?>
"  align="left"/><?php endif; ?>
                        <?php if ($this->_tpl_vars['i']['ev_descr']): ?><span style="text-align:left; font-style: italic; display:block;  min-height: 20px !important;"><?php echo $this->_tpl_vars['i']['ev_descr']; ?>
</span><?php endif; ?>
                    </div>
                    <?php if ($this->_tpl_vars['k2'] == 'journal' && $this->_tpl_vars['i']['subj']): ?><b><?php echo $this->_tpl_vars['i']['subj']; ?>
</b><br><?php endif; ?>
                    <?php echo ((is_array($_tmp=$this->_tpl_vars['i']['story'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>

                </div>
                <br />
		                        <p><?php echo smarty_function_html_tmpl_time(array('val' => $this->_tpl_vars['i']['pdate'],'type' => 1), $this);?>
 <?php if ($this->_tpl_vars['IS_USER']): ?><span class="cl_del_link" tid="<?php echo $this->_tpl_vars['i']['id']; ?>
" style="margin-right: 5px;"><a href="javascript: void(0);" onclick="javascript: oSystem.SConfPopup( 'oUsers.DelTagFromMesg( <?php echo $this->_tpl_vars['ti']['id']; ?>
, <?php echo $this->_tpl_vars['i']['id']; ?>
);', 'Please confirm you want to delete tag  from this message?' );">&nbsp&nbsp&nbsp&nbsp</a></span><?php endif; ?></p>


                <?php elseif (3 == $this->_tpl_vars['i']['mtype']): ?>
                <div class="post-title"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
"><b><?php if ($this->_tpl_vars['i']['first_name'] || $this->_tpl_vars['i']['last_name']):  echo $this->_tpl_vars['i']['first_name']; ?>
 <?php echo $this->_tpl_vars['i']['last_name'];  else:  echo $this->_tpl_vars['i']['public_name'];  endif; ?></b></a> <?php if ($this->_tpl_vars['k2'] == 'journal' && $this->_tpl_vars['i']['subj']): ?><b><?php echo $this->_tpl_vars['i']['subj']; ?>
</b><br><?php endif; ?> <?php if ($this->_tpl_vars['i']['story']):  echo ((is_array($_tmp=$this->_tpl_vars['i']['story'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp));  endif; ?></div>
                <br />
	         	                <p>&nbsp;<a href="<?php echo $this->_tpl_vars['i']['l_url']; ?>
" target="_blank"><?php if ($this->_tpl_vars['i']['l_url_label']):  echo $this->_tpl_vars['i']['l_url_label'];  else:  echo $this->_tpl_vars['i']['l_url'];  endif; ?></a></p>
                <p><?php echo smarty_function_html_tmpl_time(array('val' => $this->_tpl_vars['i']['pdate'],'type' => 1), $this);?>
 <?php if ($this->_tpl_vars['IS_USER']): ?><span class="cl_del_link" tid="<?php echo $this->_tpl_vars['i']['id']; ?>
" style="margin-right: 5px;"><a href="javascript: void(0);" onclick="javascript: oSystem.SConfPopup( 'oUsers.DelTagFromMesg( <?php echo $this->_tpl_vars['ti']['id']; ?>
, <?php echo $this->_tpl_vars['i']['id']; ?>
);', 'Please confirm you want to delete tag from this message?' );">&nbsp&nbsp&nbsp&nbsp</a></span><?php endif; ?></p>


                <?php elseif (4 == $this->_tpl_vars['i']['mtype']): ?>
                <div class="post-title"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
"><b><?php if ($this->_tpl_vars['i']['first_name'] || $this->_tpl_vars['i']['last_name']):  echo $this->_tpl_vars['i']['first_name']; ?>
 <?php echo $this->_tpl_vars['i']['last_name'];  else:  echo $this->_tpl_vars['i']['public_name'];  endif; ?></b></a> <?php if ($this->_tpl_vars['k2'] == 'journal' && $this->_tpl_vars['i']['subj']): ?><b><?php echo $this->_tpl_vars['i']['subj']; ?>
</b><br><?php endif; ?> <?php if ($this->_tpl_vars['i']['story']):  echo ((is_array($_tmp=$this->_tpl_vars['i']['story'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp));  endif; ?></div>

                <p style="float: left; margin: none; padding: none;" align="left">
		<?php if ($this->_tpl_vars['i']['p_url']): ?><em><a href="javascript: void(0);"><img src="<?php echo $this->_tpl_vars['i']['p_url']; ?>
" style="max-width: 200px; max-height: 200px;" /></a></em><?php endif; ?>
		<?php if ($this->_tpl_vars['i']['p_path']): ?>
             
                    <?php if ($this->_tpl_vars['k2'] == 'journal'): ?>
		        <?php if ($this->_tpl_vars['i']['p_img_1']): ?><em><a href="<?php if ($this->_tpl_vars['i']['p_img_aid'] && $this->_tpl_vars['i']['p_img_1_id']):  echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['juid']; ?>
/albums/id<?php echo $this->_tpl_vars['i']['p_img_aid']; ?>
/id<?php echo $this->_tpl_vars['i']['p_img_1_id'];  else: ?>javascript: void(0);<?php endif; ?>"><img src="<?php echo $this->_tpl_vars['fImgDir'];  echo $this->_tpl_vars['k2']; ?>
/<?php echo $this->_tpl_vars['i']['p_path']; ?>
/<?php echo $this->_tpl_vars['i']['p_img_1']; ?>
" style="max-width: 300px; max-height: 200px;" /></a></em><?php endif; ?>
		        <?php if ($this->_tpl_vars['i']['p_img_2']): ?><em><a href="<?php if ($this->_tpl_vars['i']['p_img_aid'] && $this->_tpl_vars['i']['p_img_2_id']):  echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['juid']; ?>
/albums/id<?php echo $this->_tpl_vars['i']['p_img_aid']; ?>
/id<?php echo $this->_tpl_vars['i']['p_img_2_id'];  else: ?>javascript: void(0);<?php endif; ?>"><img src="<?php echo $this->_tpl_vars['fImgDir'];  echo $this->_tpl_vars['k2']; ?>
/<?php echo $this->_tpl_vars['i']['p_path']; ?>
/<?php echo $this->_tpl_vars['i']['p_img_2']; ?>
" style="max-width: 300px; max-height: 200px;" /></a></em><?php endif; ?>
		        <?php if ($this->_tpl_vars['i']['p_img_3']): ?><em><a href="<?php if ($this->_tpl_vars['i']['p_img_aid'] && $this->_tpl_vars['i']['p_img_3_id']):  echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['juid']; ?>
/albums/id<?php echo $this->_tpl_vars['i']['p_img_aid']; ?>
/id<?php echo $this->_tpl_vars['i']['p_img_3_id'];  else: ?>javascript: void(0);<?php endif; ?>"><img src="<?php echo $this->_tpl_vars['fImgDir'];  echo $this->_tpl_vars['k2']; ?>
/<?php echo $this->_tpl_vars['i']['p_path']; ?>
/<?php echo $this->_tpl_vars['i']['p_img_3']; ?>
" style="max-width: 300px; max-height: 200px;" /></a></em><?php endif; ?>
		    <?php elseif ($this->_tpl_vars['k2'] == 'wall'): ?>
                        <?php if ($this->_tpl_vars['i']['p_img_1']): ?><em><a href="<?php if ($this->_tpl_vars['i']['p_img_aid'] && $this->_tpl_vars['i']['p_img_1_id']):  echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['wuid']; ?>
/albums/id<?php echo $this->_tpl_vars['i']['p_img_aid']; ?>
/id<?php echo $this->_tpl_vars['i']['p_img_1_id'];  else: ?>javascript: void(0);<?php endif; ?>"><img src="<?php echo $this->_tpl_vars['fImgDir'];  echo $this->_tpl_vars['k2']; ?>
/<?php echo $this->_tpl_vars['i']['p_path']; ?>
/<?php echo $this->_tpl_vars['i']['p_img_1']; ?>
" style="max-width: 300px; max-height: 200px;" /></a></em><?php endif; ?>
		        <?php if ($this->_tpl_vars['i']['p_img_2']): ?><em><a href="<?php if ($this->_tpl_vars['i']['p_img_aid'] && $this->_tpl_vars['i']['p_img_2_id']):  echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['wuid']; ?>
/albums/id<?php echo $this->_tpl_vars['i']['p_img_aid']; ?>
/id<?php echo $this->_tpl_vars['i']['p_img_2_id'];  else: ?>javascript: void(0);<?php endif; ?>"><img src="<?php echo $this->_tpl_vars['fImgDir'];  echo $this->_tpl_vars['k2']; ?>
/<?php echo $this->_tpl_vars['i']['p_path']; ?>
/<?php echo $this->_tpl_vars['i']['p_img_2']; ?>
" style="max-width: 300px; max-height: 200px;" /></a></em><?php endif; ?>
		        <?php if ($this->_tpl_vars['i']['p_img_3']): ?><em><a href="<?php if ($this->_tpl_vars['i']['p_img_aid'] && $this->_tpl_vars['i']['p_img_3_id']):  echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['wuid']; ?>
/albums/id<?php echo $this->_tpl_vars['i']['p_img_aid']; ?>
/id<?php echo $this->_tpl_vars['i']['p_img_3_id'];  else: ?>javascript: void(0);<?php endif; ?>"><img src="<?php echo $this->_tpl_vars['fImgDir'];  echo $this->_tpl_vars['k2']; ?>
/<?php echo $this->_tpl_vars['i']['p_path']; ?>
/<?php echo $this->_tpl_vars['i']['p_img_3']; ?>
" style="max-width: 300px; max-height: 200px;" /></a></em><?php endif; ?>
		    <?php elseif ($this->_tpl_vars['k2'] == 'mission'): ?>
                        <?php if ($this->_tpl_vars['i']['p_img_1']): ?><em><a href="<?php if ($this->_tpl_vars['i']['p_img_aid'] && $this->_tpl_vars['i']['p_img_1_id']):  echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
/albums/id<?php echo $this->_tpl_vars['i']['p_img_aid']; ?>
/id<?php echo $this->_tpl_vars['i']['p_img_1_id'];  else: ?>javascript: void(0);<?php endif; ?>"><img src="<?php echo $this->_tpl_vars['fImgDir'];  echo $this->_tpl_vars['k2']; ?>
/wall/<?php echo $this->_tpl_vars['i']['p_path']; ?>
/<?php echo $this->_tpl_vars['i']['p_img_1']; ?>
" style="max-width: 300px; max-height: 200px;" /></a></em><?php endif; ?>
		        <?php if ($this->_tpl_vars['i']['p_img_2']): ?><em><a href="<?php if ($this->_tpl_vars['i']['p_img_aid'] && $this->_tpl_vars['i']['p_img_2_id']):  echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
/albums/id<?php echo $this->_tpl_vars['i']['p_img_aid']; ?>
/id<?php echo $this->_tpl_vars['i']['p_img_2_id'];  else: ?>javascript: void(0);<?php endif; ?>"><img src="<?php echo $this->_tpl_vars['fImgDir'];  echo $this->_tpl_vars['k2']; ?>
/wall/<?php echo $this->_tpl_vars['i']['p_path']; ?>
/<?php echo $this->_tpl_vars['i']['p_img_2']; ?>
" style="max-width: 300px; max-height: 200px;" /></a></em><?php endif; ?>
		        <?php if ($this->_tpl_vars['i']['p_img_3']): ?><em><a href="<?php if ($this->_tpl_vars['i']['p_img_aid'] && $this->_tpl_vars['i']['p_img_3_id']):  echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
/albums/id<?php echo $this->_tpl_vars['i']['p_img_aid']; ?>
/id<?php echo $this->_tpl_vars['i']['p_img_3_id'];  else: ?>javascript: void(0);<?php endif; ?>"><img src="<?php echo $this->_tpl_vars['fImgDir'];  echo $this->_tpl_vars['k2']; ?>
/wall/<?php echo $this->_tpl_vars['i']['p_path']; ?>
/<?php echo $this->_tpl_vars['i']['p_img_3']; ?>
" style="max-width: 300px; max-height: 200px;" /></a></em><?php endif; ?>
                    <?php elseif ($this->_tpl_vars['k2'] == 'wards'): ?>
                        <?php if ($this->_tpl_vars['i']['p_img_1']): ?><em><a href="<?php if ($this->_tpl_vars['i']['p_img_aid'] && $this->_tpl_vars['i']['p_img_1_id']):  echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
/albums/id<?php echo $this->_tpl_vars['i']['p_img_aid']; ?>
/id<?php echo $this->_tpl_vars['i']['p_img_1_id'];  else: ?>javascript: void(0);<?php endif; ?>"><img src="<?php echo $this->_tpl_vars['fImgDir'];  echo $this->_tpl_vars['k2']; ?>
/wall/<?php echo $this->_tpl_vars['i']['p_path']; ?>
/<?php echo $this->_tpl_vars['i']['p_img_1']; ?>
" style="max-width: 300px; max-height: 200px;" /></a></em><?php endif; ?>
		        <?php if ($this->_tpl_vars['i']['p_img_2']): ?><em><a href="<?php if ($this->_tpl_vars['i']['p_img_aid'] && $this->_tpl_vars['i']['p_img_2_id']):  echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
/albums/id<?php echo $this->_tpl_vars['i']['p_img_aid']; ?>
/id<?php echo $this->_tpl_vars['i']['p_img_2_id'];  else: ?>javascript: void(0);<?php endif; ?>"><img src="<?php echo $this->_tpl_vars['fImgDir'];  echo $this->_tpl_vars['k2']; ?>
/wall/<?php echo $this->_tpl_vars['i']['p_path']; ?>
/<?php echo $this->_tpl_vars['i']['p_img_2']; ?>
" style="max-width: 300px; max-height: 200px;" /></a></em><?php endif; ?>
		        <?php if ($this->_tpl_vars['i']['p_img_3']): ?><em><a href="<?php if ($this->_tpl_vars['i']['p_img_aid'] && $this->_tpl_vars['i']['p_img_3_id']):  echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
/albums/id<?php echo $this->_tpl_vars['i']['p_img_aid']; ?>
/id<?php echo $this->_tpl_vars['i']['p_img_3_id'];  else: ?>javascript: void(0);<?php endif; ?>"><img src="<?php echo $this->_tpl_vars['fImgDir'];  echo $this->_tpl_vars['k2']; ?>
/wall/<?php echo $this->_tpl_vars['i']['p_path']; ?>
/<?php echo $this->_tpl_vars['i']['p_img_3']; ?>
" style="max-width: 300px; max-height: 200px;" /></a></em><?php endif; ?>
		    <?php endif; ?>
                <?php endif; ?>
                </p>

                <br />
		
                <p><?php echo smarty_function_html_tmpl_time(array('val' => $this->_tpl_vars['i']['pdate'],'type' => 1), $this);?>
 <?php if ($this->_tpl_vars['IS_USER']): ?><span class="cl_del_link" tid="<?php echo $this->_tpl_vars['i']['id']; ?>
" style="margin-right: 5px;"><a href="javascript: void(0);" onclick="javascript: oSystem.SConfPopup( 'oUsers.DelTagFromMesg( <?php echo $this->_tpl_vars['ti']['id']; ?>
, <?php echo $this->_tpl_vars['i']['id']; ?>
);', 'Please confirm you want to delete tag from this message?' );">&nbsp&nbsp&nbsp&nbsp</a></span><?php endif; ?></p>
				                    <?php elseif (5 == $this->_tpl_vars['i']['mtype']): ?>
                <div class="post-title"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
"><b><?php if ($this->_tpl_vars['i']['first_name'] || $this->_tpl_vars['i']['last_name']):  echo $this->_tpl_vars['i']['first_name']; ?>
 <?php echo $this->_tpl_vars['i']['last_name'];  else:  echo $this->_tpl_vars['i']['public_name'];  endif; ?></b></a> <?php if ($this->_tpl_vars['k2'] == 'journal' && $this->_tpl_vars['i']['subj']): ?><b><?php echo $this->_tpl_vars['i']['subj']; ?>
</b><br><?php endif; ?> <?php if ($this->_tpl_vars['i']['story']):  echo ((is_array($_tmp=$this->_tpl_vars['i']['story'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp));  endif; ?></div>
                <p style="float: left; margin: none; padding: none;" align="left">
		    <?php if ($this->_tpl_vars['i']['v_code']): ?><object width="200" height="150"><?php echo $this->_tpl_vars['i']['v_code']; ?>
</object><?php endif; ?>
                </p>

                <br />
	        
                <p><?php echo smarty_function_html_tmpl_time(array('val' => $this->_tpl_vars['i']['pdate'],'type' => 1), $this);?>
 <?php if ($this->_tpl_vars['IS_USER']): ?><span class="cl_del_link" tid="<?php echo $this->_tpl_vars['i']['id']; ?>
" style="margin-right: 5px;"><a href="javascript: void(0);" onclick="javascript: oSystem.SConfPopup( 'oUsers.DelTagFromMesg( <?php echo $this->_tpl_vars['ti']['id']; ?>
, <?php echo $this->_tpl_vars['i']['id']; ?>
);', 'Please confirm you want to delete tag from this message?' );">&nbsp&nbsp&nbsp&nbsp</a></span><?php endif; ?></p>
		<?php else: ?>
                <div class="post-title"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
"><b><?php if ($this->_tpl_vars['i']['first_name'] || $this->_tpl_vars['i']['last_name']):  echo $this->_tpl_vars['i']['first_name']; ?>
 <?php echo $this->_tpl_vars['i']['last_name'];  else:  echo $this->_tpl_vars['i']['public_name'];  endif; ?></b></a> <?php if ($this->_tpl_vars['k2'] == 'journal' && $this->_tpl_vars['i']['subj']): ?><b><?php echo $this->_tpl_vars['i']['subj']; ?>
</b><br><?php endif; ?> <?php if ($this->_tpl_vars['i']['story']):  echo ((is_array($_tmp=$this->_tpl_vars['i']['story'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp));  endif; ?></div>
                <br />
		                <p><?php echo smarty_function_html_tmpl_time(array('val' => $this->_tpl_vars['i']['pdate'],'type' => 1), $this);?>
 <?php if ($this->_tpl_vars['IS_USER']): ?><span class="cl_del_link" tid="<?php echo $this->_tpl_vars['i']['id']; ?>
" style="margin-right: 5px;"><a href="javascript: void(0);" onclick="javascript: oSystem.SConfPopup( 'oUsers.DelTagFromMesg( <?php echo $this->_tpl_vars['ti']['id']; ?>
, <?php echo $this->_tpl_vars['i']['id']; ?>
);', 'Please confirm you want to delete tag from this message?' );">&nbsp&nbsp&nbsp&nbsp</a></span><?php endif; ?></p>
		<?php endif; ?>
                <p>
                <?php if ($this->_tpl_vars['k2'] != 'wards'): ?>
                    <?php if (5 == $this->_tpl_vars['i']['ptype']): ?>
                    private
                    <?php elseif (4 == $this->_tpl_vars['i']['ptype']): ?>
                    only for <?php if ($this->_tpl_vars['i']['first_name3'] && $this->_tpl_vars['i']['last_name3']): ?> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid3']; ?>
"><?php echo $this->_tpl_vars['i']['first_name3']; ?>
 <?php echo $this->_tpl_vars['i']['last_name3']; ?>
</a> <?php else: ?> ... <?php endif; ?>
                    <?php elseif (3 == $this->_tpl_vars['i']['ptype']): ?>
                    For family
                    <?php elseif (2 == $this->_tpl_vars['i']['ptype']): ?>
                    For friends <?php if ($this->_tpl_vars['i']['pstype']): ?> ( <?php if ($this->_tpl_vars['i']['pstype'] == 5): ?> <?php if ($this->_tpl_vars['uclasses_index'][$this->_tpl_vars['i']['pclass']]): ?> <?php echo $this->_tpl_vars['uclasses_index'][$this->_tpl_vars['i']['pclass']]; ?>
 <?php else: ?> Classmates <?php endif; ?> <?php elseif ($this->_tpl_vars['i']['pstype'] == 1): ?> Aaronic priesthood <?php elseif ($this->_tpl_vars['i']['pstype'] == 2): ?> Young man <?php elseif ($this->_tpl_vars['i']['pstype'] == 3): ?> Priesthood holders <?php elseif ($this->_tpl_vars['i']['pstype'] == 4): ?> Melchizedek priesthood <?php elseif ($this->_tpl_vars['i']['pstype'] == 7): ?> high priest <?php elseif ($this->_tpl_vars['i']['pstype'] == 12): ?> Young woman <?php elseif ($this->_tpl_vars['i']['pstype'] == 100): ?> <?php if ($this->_tpl_vars['UserInfo']['ward_id'] == $this->_tpl_vars['i']['uvid']): ?> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
wards/id<?php echo $this->_tpl_vars['UserInfo']['ward_id']; ?>
"><?php echo $this->_tpl_vars['UserInfo']['ward']; ?>
</a> <?php else: ?> prev ward <?php endif; ?> <?php elseif ($this->_tpl_vars['i']['pstype'] == 101): ?> <?php if ($this->_tpl_vars['UserInfo']['stake_id'] == $this->_tpl_vars['i']['uvid']): ?> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
wards/id<?php echo $this->_tpl_vars['UserInfo']['stake_id']; ?>
"><?php echo $this->_tpl_vars['UserInfo']['stake']; ?>
</a> <?php else: ?> prev stake <?php endif; ?> <?php endif; ?> ) <?php endif; ?>
                    <?php elseif (1 == $this->_tpl_vars['i']['ptype']): ?>
                    For friends and followers <?php if ($this->_tpl_vars['i']['pstype']): ?> ( <?php if ($this->_tpl_vars['i']['pstype'] == 5): ?> <?php if ($this->_tpl_vars['uclasses_index'][$this->_tpl_vars['i']['pclass']]): ?> <?php echo $this->_tpl_vars['uclasses_index'][$this->_tpl_vars['i']['pclass']]; ?>
 <?php else: ?> Classmates <?php endif; ?> <?php elseif ($this->_tpl_vars['i']['pstype'] == 1): ?> Aaronic priesthood <?php elseif ($this->_tpl_vars['i']['pstype'] == 2): ?> Young man <?php elseif ($this->_tpl_vars['i']['pstype'] == 3): ?> Priesthood holders <?php elseif ($this->_tpl_vars['i']['pstype'] == 4): ?> Melchizedek priesthood <?php elseif ($this->_tpl_vars['i']['pstype'] == 7): ?> high priest <?php elseif ($this->_tpl_vars['i']['pstype'] == 12): ?> Young woman <?php elseif ($this->_tpl_vars['i']['pstype'] == 100): ?> <?php if ($this->_tpl_vars['UserInfo']['ward_id'] == $this->_tpl_vars['i']['uvid']): ?> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
wards/id<?php echo $this->_tpl_vars['UserInfo']['ward_id']; ?>
"><?php echo $this->_tpl_vars['UserInfo']['ward']; ?>
</a> <?php else: ?> prev ward <?php endif; ?> <?php elseif ($this->_tpl_vars['i']['pstype'] == 101): ?> <?php if ($this->_tpl_vars['UserInfo']['stake_id'] == $this->_tpl_vars['i']['uvid']): ?> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
wards/id<?php echo $this->_tpl_vars['UserInfo']['stake_id']; ?>
"><?php echo $this->_tpl_vars['UserInfo']['stake']; ?>
</a> <?php else: ?> prev stake <?php endif; ?> <?php endif; ?> ) <?php endif; ?>
                    <?php elseif (0 == $this->_tpl_vars['i']['ptype']): ?>
                    For everyone <?php if ($this->_tpl_vars['i']['first_name3'] && $this->_tpl_vars['i']['last_name3'] && $this->_tpl_vars['i']['uvid'] && $this->_tpl_vars['i']['uid'] != $this->_tpl_vars['i']['uvid']): ?> except <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid3']; ?>
"><?php echo $this->_tpl_vars['i']['first_name3']; ?>
 <?php echo $this->_tpl_vars['i']['last_name3']; ?>
</a> <?php endif; ?>
                    <?php endif; ?>
                <?php else: ?>
                    <?php if (1 == $this->_tpl_vars['i']['ptype']): ?> for stake <?php elseif (0 == $this->_tpl_vars['i']['ptype']): ?> for ward <?php endif; ?>
                    <?php if ($this->_tpl_vars['i']['stype'] && $this->_tpl_vars['prhs'][$this->_tpl_vars['i']['stype']]): ?> (<?php echo $this->_tpl_vars['prhs'][$this->_tpl_vars['i']['stype']]; ?>
)
                    <?php elseif ($this->_tpl_vars['i']['stype'] == 5): ?>
                    <?php if ($this->_tpl_vars['uclasses_index'][$this->_tpl_vars['i']['pclass']]): ?> <?php echo $this->_tpl_vars['uclasses_index'][$this->_tpl_vars['i']['pclass']]; ?>
 <?php else: ?> Classmates <?php endif; ?>
                    <?php endif; ?>
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
no_photo_m56.jpg<?php endif; ?>"  style="width: 56px; height: 56px;" /></a>
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
        </div>
    </div>
    <?php endforeach; endif; unset($_from); ?>
</div>
<?php endif;  endforeach; endif; unset($_from); ?>

<div class="box001" style="display:none;" id="no_items">
    <div class="post-box">
	There aren't any entries
    </div>
</div>

<?php else: ?>
<div class="box001">
    <div class="post-box">
	<?php if (IS_USER): ?>There aren't any entries<?php else: ?>No Access<?php endif; ?>
    </div>
</div>
<?php endif;  endif; ?>