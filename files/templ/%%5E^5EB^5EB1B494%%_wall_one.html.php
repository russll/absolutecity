<?php /* Smarty version 2.6.11, created on 2014-08-17 19:44:30
         compiled from mods/inbox/_wall_one.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_tmpl_time', 'mods/inbox/_wall_one.html', 4, false),)), $this); ?>

<div id="id_wall_mes_<?php echo $this->_tpl_vars['mai']['id']; ?>
">
    <div class="<?php if ($this->_tpl_vars['UserInfo']['uid'] == $this->_tpl_vars['mai']['uid']): ?> message-box <?php else: ?> message-box <?php endif; ?>" aid="<?php echo $this->_tpl_vars['mai']['id']; ?>
">
        <p><span><?php echo smarty_function_html_tmpl_time(array('val' => $this->_tpl_vars['mai']['pdate'],'type' => 1), $this);?>
 </span></p>

            <?php if ($this->_tpl_vars['UserInfo']['uid'] == $this->_tpl_vars['mai']['uid']): ?>
                <i><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
snoska_own.gif" alt=""  /></i>
            <?php endif; ?>
        <!--div class="btext_img"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['mai']['uid']; ?>
"><img src="<?php if ($this->_tpl_vars['mai']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['mai']['fpath']; ?>
/s/s_<?php echo $this->_tpl_vars['mai']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m42.jpg<?php endif; ?>"  style="width: 42px; height: 42px;"  /></a></div-->
        <div<?php if ($this->_tpl_vars['UserInfo']['uid'] != $this->_tpl_vars['mai']['uid']): ?> class="light"<?php endif; ?>>
            <!--i><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
snoska.gif" alt=""  /></i-->
            <?php if ($this->_tpl_vars['UserInfo']['uid'] != $this->_tpl_vars['mai']['uid']): ?>
            <i><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
snoska_other.gif" alt=""  /></i>
            <?php endif; ?>

	    <?php if ($this->_tpl_vars['mai']['story']): ?> <?php echo $this->_tpl_vars['mai']['story']; ?>
 <?php endif; ?>
	    <?php if (3 == $this->_tpl_vars['mai']['mtype']): ?>
            <p>&nbsp;<a href="<?php echo $this->_tpl_vars['mai']['l_url']; ?>
" target="_blank"><?php if ($this->_tpl_vars['mai']['l_url_label']):  echo $this->_tpl_vars['mai']['l_url_label'];  else:  echo $this->_tpl_vars['mai']['l_url'];  endif; ?></a></p>
	    <?php elseif (4 == $this->_tpl_vars['mai']['mtype']): ?>
            <p style="vertical-align: top; margin: none; padding: none;">
                <?php if ($this->_tpl_vars['mai']['p_url']): ?><em><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/albums/id<?php echo $this->_tpl_vars['mai']['p_img_aid']; ?>
/id<?php echo $this->_tpl_vars['mai']['p_img_1_id']; ?>
"><img src="<?php echo $this->_tpl_vars['mai']['p_url']; ?>
" style="max-width: 200px; max-height: 200px;" /></a></em><?php endif; ?>
	        <?php if ($this->_tpl_vars['mai']['p_path']): ?>
	            <?php if ($this->_tpl_vars['mai']['p_img_1']): ?><em><a href="<?php if ($this->_tpl_vars['mai']['p_img_aid'] && $this->_tpl_vars['mai']['p_img_1_id']):  echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/albums/id<?php echo $this->_tpl_vars['mai']['p_img_aid']; ?>
/id<?php echo $this->_tpl_vars['mai']['p_img_1_id'];  else: ?>javascript: void(0);<?php endif; ?>"><img src="<?php echo $this->_tpl_vars['fImgDir']; ?>
inbox/<?php echo $this->_tpl_vars['mai']['p_path']; ?>
/<?php echo $this->_tpl_vars['mai']['p_img_1']; ?>
" style="max-width: 300px; max-height: 200px;" /></a></em><?php endif; ?>
		    <?php if ($this->_tpl_vars['mai']['p_img_2']): ?><em><a href="<?php if ($this->_tpl_vars['mai']['p_img_aid'] && $this->_tpl_vars['mai']['p_img_2_id']):  echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/albums/id<?php echo $this->_tpl_vars['mai']['p_img_aid']; ?>
/id<?php echo $this->_tpl_vars['mai']['p_img_2_id'];  else: ?>javascript: void(0);<?php endif; ?>"><img src="<?php echo $this->_tpl_vars['fImgDir']; ?>
inbox/<?php echo $this->_tpl_vars['mai']['p_path']; ?>
/<?php echo $this->_tpl_vars['mai']['p_img_2']; ?>
" style="max-width: 300px; max-height: 200px;" /></a></em><?php endif; ?>
		    <?php if ($this->_tpl_vars['mai']['p_img_3']): ?><em><a href="<?php if ($this->_tpl_vars['mai']['p_img_aid'] && $this->_tpl_vars['mai']['p_img_3_id']):  echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/albums/id<?php echo $this->_tpl_vars['mai']['p_img_aid']; ?>
/id<?php echo $this->_tpl_vars['mai']['p_img_3_id'];  else: ?>javascript: void(0);<?php endif; ?>"><img src="<?php echo $this->_tpl_vars['fImgDir']; ?>
inbox/<?php echo $this->_tpl_vars['mai']['p_path']; ?>
/<?php echo $this->_tpl_vars['mai']['p_img_3']; ?>
" style="max-width: 300px; max-height: 200px;" /></a></em><?php endif; ?>
		<?php endif; ?>
            </p>
	    <?php elseif (5 == $this->_tpl_vars['mai']['mtype']): ?>
            <p style="" align="left">
	        <?php if ($this->_tpl_vars['mai']['v_code']): ?><object width="200" height="150"><?php echo $this->_tpl_vars['mai']['v_code']; ?>
</object><?php endif; ?>
            </p>
	    <?php endif; ?>
        </div>
    </div>
</div>