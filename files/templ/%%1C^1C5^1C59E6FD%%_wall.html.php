<?php /* Smarty version 2.6.11, created on 2014-03-15 09:09:58
         compiled from mods/inbox/_wall.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'mods/inbox/_wall.html', 12, false),array('modifier', 'dlong', 'mods/inbox/_wall.html', 42, false),array('function', 'html_str_format', 'mods/inbox/_wall.html', 18, false),array('function', 'html_tmpl_time', 'mods/inbox/_wall.html', 32, false),)), $this); ?>
<div id="id_inb_wall">
    <h2 id="id_fr_name">
        <?php if ($this->_tpl_vars['ar_fr']):  echo $this->_tpl_vars['fr_info']['first_name']; ?>
 <?php echo $this->_tpl_vars['fr_info']['last_name']; ?>
 <?php else: ?> Select a friend<?php endif; ?>
        <?php if ($this->_tpl_vars['ar_fr']): ?>
        <span class="block_a" style="margin-top:0px; padding-top: 0px; margin-right: 5px; float:right;">
            <a id="blockFr<?php echo $this->_tpl_vars['fr_info']['uid']; ?>
" href="javascript: void(0);" onclick="javascript: oFriends.EditFrActive( <?php echo $this->_tpl_vars['fr_info']['uid']; ?>
, 3 );" <?php if (1 != $this->_tpl_vars['fr_info']['active']): ?>style="display:none"<?php endif; ?>>Block user</a>
            <a id="unblockFr<?php echo $this->_tpl_vars['fr_info']['uid']; ?>
" href="javascript: void(0);" onclick="javascript: oFriends.EditFrActive( <?php echo $this->_tpl_vars['fr_info']['uid']; ?>
, 1 );" <?php if (3 != $this->_tpl_vars['fr_info']['active']): ?>style="display:none"<?php endif; ?>>UnBlock user</a>
        </span>
        <?php endif; ?>
    </h2>

	<?php $this->assign('fname', ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fr_info']['first_name'])) ? $this->_run_mod_handler('cat', true, $_tmp, ' ') : smarty_modifier_cat($_tmp, ' ')))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['fr_info']['last_name']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['fr_info']['last_name']))); ?>
	<?php $this->assign('fname', $this->_tpl_vars['fname']); ?>

      
        <div class="del-message"<?php if ($this->_tpl_vars['fshow']): ?> style="display:none"<?php endif; ?>>
             <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['fr_info']['uid']; ?>
"><img src="<?php if ($this->_tpl_vars['fr_info']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['fr_info']['fpath']; ?>
/s/s_<?php echo $this->_tpl_vars['fr_info']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m42.jpg<?php endif; ?>"  style="width: 42px; height: 42px; float:left;"  /></a>
             <a href="javascript: void(0);" class="del-message-link" style="float:right;" <?php if (! $this->_tpl_vars['mai']): ?> style="display:none"<?php endif; ?> onclick="javascript: oSystem.SConfPopup( 'oIWall.DelMes(\'\', <?php echo $this->_tpl_vars['fr_info']['uid']; ?>
 );', 'Please confirm you want to delete all messages from \'<?php echo smarty_function_html_str_format(array('str' => $this->_tpl_vars['fname']), $this);?>
\'?' );">Delete all messages</a>
        </div>

        <div id="id_div_show_more_mes" class="more-box" align="center" style="margin-left: 0px; padding-left: 0px;<?php if (! ( ( $this->_tpl_vars['pcnt']+$this->_tpl_vars['rcnt'] ) < $this->_tpl_vars['cnt_mes'] )): ?> display:none;<?php endif; ?>">
        <!--a href="javascript: void(0);" onclick="oIWall.GetListMore('<?php echo $this->_tpl_vars['fr_info']['uid']; ?>
');">More <img src="/i/arr01.gif" alt=""  /></a-->
        <a href="javascript: void(0);" style="float:left;" onclick="oIWall.GetListMore('<?php echo $this->_tpl_vars['fr_info']['uid']; ?>
');">View older messages<!--img src="/i/arr01.gif" alt=""  /--></a>
        </div>

    <div id="id_mes_list" <?php if ($this->_tpl_vars['mai'] && ! $this->_tpl_vars['fshow']): ?> style="overflow-y:scroll;width:100%;max-height:800px; margin-bottom:10px; margin-top:10px;"<?php endif; ?> style="position:relative;">
        <?php if ($this->_tpl_vars['mai'] && ! $this->_tpl_vars['fshow']): ?>
	<?php $_from = $this->_tpl_vars['mai']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
        <?php $this->assign('last_id', $this->_tpl_vars['i']['id']); ?>
        <div id="id_wall_mes_<?php echo $this->_tpl_vars['i']['id']; ?>
">
            <div class="message-box" aid="<?php echo $this->_tpl_vars['i']['id']; ?>
">
                <p><span><?php echo smarty_function_html_tmpl_time(array('val' => $this->_tpl_vars['i']['pdate'],'type' => 1), $this);?>
 </span></p>
                <?php if ($this->_tpl_vars['UserInfo']['uid'] == $this->_tpl_vars['i']['uid']): ?>
                    <i class="snoska_own"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
snoska_own.gif" alt=""  /></i>
                <?php endif; ?>
                <div<?php if ($this->_tpl_vars['UserInfo']['uid'] != $this->_tpl_vars['i']['uid']): ?> class="light"<?php endif; ?>>
                    <!--i><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
snoska.gif" alt=""  /></i-->
                   <?php if ($this->_tpl_vars['UserInfo']['uid'] != $this->_tpl_vars['i']['uid']): ?>
                    <i class="snoska_other"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
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
/id<?php echo $this->_tpl_vars['i']['p_img_2_id'];  else: ?>javascript: void(0);<?php endif; ?>"><img src="<?php echo $this->_tpl_vars['fImgDir']; ?>
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
                    <p align="left">
			<?php if ($this->_tpl_vars['i']['v_code']): ?><object width="200" height="150"><?php echo $this->_tpl_vars['i']['v_code']; ?>
</object><?php endif; ?>
                    </p>
		    <?php endif; ?>
                </div>
            </div>
        </div>

	<?php endforeach; endif; unset($_from); ?>
        
	<?php else: ?>
        <div id="id_div_empty_mes">
	    <?php if ($this->_tpl_vars['fshow']): ?>
            <div class="box001">
                <div class="post-box">
		    Select a friend on the right bar to see their messages
                </div>
            </div>
		<?php else: ?>
            <div class="box001" id="">
                <div class="post-box">
		    There aren't any entries
                </div>
            </div>
	    <?php endif; ?>
        </div>
	<?php endif; ?>
    </div>

    <i class="snoska_own"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
snoska_own.gif" alt=""  style="margin-left:15px;" /></i>
    <div class="inbox_bot">
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/inbox/_editor_inbox.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </div>

</div>