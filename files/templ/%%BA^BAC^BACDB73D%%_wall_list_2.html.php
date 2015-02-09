<?php /* Smarty version 2.6.11, created on 2014-03-15 09:10:14
         compiled from mods/inbox/_wall_list_2.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_tmpl_time', 'mods/inbox/_wall_list_2.html', 7, false),array('modifier', 'dlong', 'mods/inbox/_wall_list_2.html', 18, false),)), $this); ?>
<?php $this->assign('fr_info', $this->_tpl_vars['i']);  if ($this->_tpl_vars['mai'] && ! $this->_tpl_vars['fshow']): ?>
    <?php $_from = $this->_tpl_vars['mai']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
        <div id="id_wall_mes_<?php echo $this->_tpl_vars['i']['id']; ?>
">
        <div class="message-box" aid="<?php echo $this->_tpl_vars['i']['id']; ?>
">
            <p><span><?php echo smarty_function_html_tmpl_time(array('val' => $this->_tpl_vars['i']['pdate'],'type' => 1), $this);?>
 </span></p>
            <?php if ($this->_tpl_vars['UserInfo']['uid'] == $this->_tpl_vars['i']['uid']): ?>
                <i><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
snoska_own.gif" alt=""  /></i>
            <?php endif; ?>
            <!--div class="btext_img"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
"><img src="<?php if ($this->_tpl_vars['i']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['i']['fpath']; ?>
/s/s_<?php echo $this->_tpl_vars['i']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m42.jpg<?php endif; ?>"  style="width: 42px; height: 42px;"  /></a></div-->
            <div<?php if ($this->_tpl_vars['UserInfo']['uid'] != $this->_tpl_vars['i']['uid']): ?> class="light"<?php endif; ?>>
                <!--i><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
snoska.gif" alt=""  /></i-->
                <?php if ($this->_tpl_vars['UserInfo']['uid'] != $this->_tpl_vars['i']['uid']): ?>
                <i><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
snoska_other.gif" alt=""  /></i>
                <?php endif; ?>

                <?php if ($this->_tpl_vars['i']['story']): ?> <?php echo ((is_array($_tmp=$this->_tpl_vars['i']['story'])) ? $this->_run_mod_handler('dlong', true, $_tmp) : smarty_modifier_dlong($_tmp)); ?>
 <?php endif; ?>

		<?php if (3 == $this->_tpl_vars['i']['mtype']): ?>
                <p>&nbsp;<a href="<?php echo $this->_tpl_vars['i']['l_url']; ?>
" target="_blank"><?php if ($this->_tpl_vars['i']['l_url_label']):  echo $this->_tpl_vars['i']['l_url_label'];  else:  echo $this->_tpl_vars['i']['l_url'];  endif; ?></a></p>
		<?php elseif (4 == $this->_tpl_vars['i']['mtype']): ?>
                <p style="vertical-align: top; margin: none; padding: none;">
                    <?php if ($this->_tpl_vars['i']['p_url']): ?><em><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/albums/id<?php echo $this->_tpl_vars['i']['p_img_aid']; ?>
/id<?php echo $this->_tpl_vars['i']['p_img_1_id']; ?>
"><img src="<?php echo $this->_tpl_vars['i']['p_url']; ?>
" style="max-width: 200px; max-height: 200px;" /></a></em><?php endif; ?>
		    <?php if ($this->_tpl_vars['i']['p_path']): ?>
		        <?php if ($this->_tpl_vars['i']['p_img_1']): ?><em><a href="<?php if ($this->_tpl_vars['i']['p_img_aid'] && $this->_tpl_vars['i']['p_img_1_id']):  echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/albums/id<?php echo $this->_tpl_vars['i']['p_img_aid']; ?>
/id<?php echo $this->_tpl_vars['i']['p_img_1_id'];  else: ?>javascript: void(0);<?php endif; ?>"><img src="<?php echo $this->_tpl_vars['fImgDir']; ?>
inbox/<?php echo $this->_tpl_vars['i']['p_path']; ?>
/<?php echo $this->_tpl_vars['i']['p_img_1']; ?>
" style="max-width: 300px; max-height: 200px;" /></a></em><?php endif; ?>
			<?php if ($this->_tpl_vars['i']['p_img_2']): ?><em><a href="<?php if ($this->_tpl_vars['i']['p_img_aid'] && $this->_tpl_vars['i']['p_img_2_id']):  echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/albums/id<?php echo $this->_tpl_vars['i']['p_img_aid']; ?>
/id<?php echo $this->_tpl_vars['i']['p_img_3_id'];  else: ?>javascript: void(0);<?php endif; ?>"><img src="<?php echo $this->_tpl_vars['fImgDir']; ?>
inbox/<?php echo $this->_tpl_vars['i']['p_path']; ?>
/<?php echo $this->_tpl_vars['i']['p_img_2']; ?>
" style="max-width: 300px; max-height: 200px;" /></a></em><?php endif; ?>
			<?php if ($this->_tpl_vars['i']['p_img_3']): ?><em><a href="<?php if ($this->_tpl_vars['i']['p_img_aid'] && $this->_tpl_vars['i']['p_img_3_id']):  echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/albums/id<?php echo $this->_tpl_vars['i']['p_img_aid']; ?>
/id<?php echo $this->_tpl_vars['i']['p_img_3_id'];  else: ?>javascript: void(0);<?php endif; ?>"><img src="<?php echo $this->_tpl_vars['fImgDir']; ?>
inbox/<?php echo $this->_tpl_vars['i']['p_path']; ?>
/<?php echo $this->_tpl_vars['i']['p_img_3']; ?>
" style="max-width: 300px; max-height: 200px;" /></a></em><?php endif; ?>
		    <?php endif; ?>
                </p>
		<?php elseif (5 == $this->_tpl_vars['i']['mtype']): ?>
                <p style="" align="left">
		    <?php if ($this->_tpl_vars['i']['v_code']): ?><object width="200" height="150"><?php echo $this->_tpl_vars['i']['v_code']; ?>
</object><?php endif; ?>
                </p>
		<?php endif; ?>
        </div>
    </div>
   </div>
    <?php endforeach; endif; unset($_from);  elseif (! $this->_tpl_vars['no_absent']): ?>
    <div id="id_div_empty_mes">
        <div class="box001" id="">
            <div class="post-box">
		There aren't any entries
            </div>
        </div>
    </div>
<?php endif; ?>