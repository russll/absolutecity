<?php /* Smarty version 2.6.11, created on 2014-03-15 09:09:55
         compiled from mods/wards/_list.html */ ?>
<div id="id_srch_res_list">
    <div id="id_div_search_wards">
	<?php if ($this->_tpl_vars['wards_list']): ?>
	<?php if ($this->_tpl_vars['wl']): ?>
        <div class="cl_srch_list">
            <h2><span><?php if (3000 < $this->_tpl_vars['cnt_people']): ?>>3000<?php elseif (1000 < $this->_tpl_vars['cnt_people'] && 3000 > $this->_tpl_vars['cnt_people']): ?>>1000<?php else:  echo $this->_tpl_vars['cnt_people'];  endif; ?></span>Wards/branches</h2>
	    <?php if (1000 < $this->_tpl_vars['cnt_people']): ?>
            <div class="attention-box">More than <?php if (3000 < $this->_tpl_vars['cnt_people']): ?>3000<?php elseif (1000 < $this->_tpl_vars['cnt_people'] && 3000 > $this->_tpl_vars['cnt_people']): ?>1000<?php endif; ?> wards found, you can use filters to refine your search</div>
	    <?php endif; ?>
	    <?php $_from = $this->_tpl_vars['wl']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['pk'] => $this->_tpl_vars['i']):
?>
            <div class="box002">
                <div class="post-box">
                    <div class="b-awatar"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
wards/id<?php echo $this->_tpl_vars['i']['id']; ?>
"><img src="<?php if ($this->_tpl_vars['i']['ward_stake_img']):  echo $this->_tpl_vars['fImgDir']; ?>
wards/info/<?php echo $this->_tpl_vars['ui']['fpath']; ?>
/s/s_<?php echo $this->_tpl_vars['i']['ward_stake_img'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_ward_m66.png<?php endif; ?>"  /></a></div>
                    <div class="post-title2"><b><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
wards/id<?php echo $this->_tpl_vars['i']['id']; ?>
"> <?php if (! empty ( $this->_tpl_vars['i']['title'] )):  echo $this->_tpl_vars['i']['title'];  else:  echo $this->_tpl_vars['i']['ward_title'];  endif; ?></a> <?php if ($this->_tpl_vars['i']['id'] != $this->_tpl_vars['UserInfo']['stake_id'] && $this->_tpl_vars['i']['id'] != $this->_tpl_vars['UserInfo']['ward_id']): ?>(<a href="javascript: oWWall.SHConfirmPopup( 1, 'id_confirm_wards_popup', <?php echo $this->_tpl_vars['i']['id']; ?>
 );">Set as my ward</a>)<?php endif; ?></b></div>
                    <p><?php if (! empty ( $this->_tpl_vars['i']['id_parent'] )): ?> <?php echo $this->_tpl_vars['i']['ward_title']; ?>
 <?php else: ?> &nbsp <?php endif; ?></p>
                </div>
            </div>
	    <?php endforeach; endif; unset($_from); ?>
        </div>

	<?php if (( $this->_tpl_vars['pcnt']+$this->_tpl_vars['rcnt'] ) < $this->_tpl_vars['cnt_wards']): ?>
        <div id="id_div_show_more_mes_wards" class="more-box" align="center" style="margin-left: 0px; padding-left: 0px;">
            <a href="javascript: void(0);" class="cl_search_pagging<?php if ($this->_tpl_vars['nwall']): ?>2<?php endif; ?>" pname="wards" pcnt=" <?php echo $this->_tpl_vars['pcnt']+$this->_tpl_vars['rcnt']; ?>
" rcnt="<?php echo $this->_tpl_vars['rcnt']; ?>
" >More <img src="<?php echo $this->_tpl_vars['imgDir']; ?>
arr01.gif" alt=""  /></a>
        </div>
	<?php endif; ?>
	<?php else: ?>
        <h2><span></span>Wards</h2>
        <div class="box001">
            <div class="post-box">
		There aren't any wards
            </div>
        </div>
    <?php endif;  endif; ?>
    </div>
</div>

<?php if ($this->_tpl_vars['whatch_list']): ?>
<span id="adi_srch">
<?php if ($this->_tpl_vars['wtl']): ?>
    <div class="cl_srch_list adi_srch">
        <h2>Wards Watching</h2>
	    <?php $_from = $this->_tpl_vars['wtl']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
        <div class="box002">
            <div class="post-box">
                <div class="b-awatar">
                    <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
wards/id<?php echo $this->_tpl_vars['i']['wid']; ?>
"><img src="<?php if ($this->_tpl_vars['i']['ward_stake_img']):  echo $this->_tpl_vars['fImgDir']; ?>
wards/info/<?php echo $this->_tpl_vars['ui']['fpath']; ?>
/s/s_<?php echo $this->_tpl_vars['i']['ward_stake_img'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_ward_m66.png<?php endif; ?>"  /></a>
                </div>

                <div class="post-title2">
                    <b><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
wards/id<?php echo $this->_tpl_vars['i']['wid']; ?>
"><?php echo $this->_tpl_vars['i']['ward_title']; ?>
</a> (from <?php echo $this->_tpl_vars['i']['start_date']; ?>
)</b>
                </div>
                <p><?php echo $this->_tpl_vars['i']['stake_title']; ?>
</p>
            </div>
        </div>
	    <?php endforeach; endif; unset($_from); ?>
    </div>
<?php else: ?>
    <h2>Wards Watching</h2>
    <div class="box001">
        <div class="post-box">
	    You aren't watching any wards
        </div>
    </div>
    <?php endif; ?>
</span>
<?php endif; ?>