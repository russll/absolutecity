<?php /* Smarty version 2.6.11, created on 2014-03-15 09:09:52
         compiled from mods/mission/_list.html */ ?>
<div id="id_srch_res_list">
    <div id="id_div_search_missions">
        <?php if ($this->_tpl_vars['ml']): ?>
        <div class="cl_srch_list">
            <h2><span><?php if (3000 < $this->_tpl_vars['cnt_missions']): ?>>3000<?php elseif (1000 < $this->_tpl_vars['cnt_missions'] && 3000 > $this->_tpl_vars['cnt_missions']): ?>>1000<?php else:  echo $this->_tpl_vars['cnt_missions'];  endif; ?></span>Missions</h2>
            <?php if (1000 < $this->_tpl_vars['cnt_missions']): ?>
            <div class="attention-box">More than <?php if (3000 < $this->_tpl_vars['cnt_missions']): ?>3000<?php elseif (1000 < $this->_tpl_vars['cnt_missions'] && 3000 > $this->_tpl_vars['cnt_missions']): ?>1000<?php endif; ?> missions found, you can use filters to refine your search</div>
            <?php endif; ?>

            <?php $_from = $this->_tpl_vars['ml']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['pk'] => $this->_tpl_vars['i']):
?>
            <div class="box002">
                <div class="post-box">
                    <div class="b-awatar"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/mission/id<?php echo $this->_tpl_vars['i']['id']; ?>
"><img
                            src="<?php if ($this->_tpl_vars['i']['mission_img']):  echo $this->_tpl_vars['fImgDir']; ?>
mission/info/<?php echo $this->_tpl_vars['ui']['fpath']; ?>
/s/s_<?php echo $this->_tpl_vars['i']['mission_img'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_ward_m66.png<?php endif; ?>"/></a>
                    </div>
                    <div class="post-title2">
                        <b><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/mission/id<?php echo $this->_tpl_vars['i']['id']; ?>
" id="mtl_<?php echo $this->_tpl_vars['i']['id']; ?>
"><?php if ($this->_tpl_vars['i']['country'] && $this->_tpl_vars['i']['city']):  echo $this->_tpl_vars['i']['country']; ?>
, <?php echo $this->_tpl_vars['i']['city'];  if ($this->_tpl_vars['i']['region']): ?>, <?php echo $this->_tpl_vars['i']['region'];  endif;  else:  echo $this->_tpl_vars['i']['title'];  endif; ?></a> </b><br>
                        <?php if ($this->_tpl_vars['nwall'] && ! $this->_tpl_vars['i']['served']): ?>
                        <a href="javascript:void(0);"
                           onclick="$('#mis_name').html($('#mtl_<?php echo $this->_tpl_vars['i']['id']; ?>
').text());oMWall.SHConfirmPopup( 1, 'id_confirm_mission_popup', <?php echo $this->_tpl_vars['i']['id']; ?>
 );"
                           style="float:right;">Served this mission?</a>
                        <?php endif; ?>
                    </div>
                    <p> &nbsp </p>

                </div>
            </div>
            <?php endforeach; endif; unset($_from); ?>
        </div>

        <?php if (( $this->_tpl_vars['pcnt']+$this->_tpl_vars['rcnt'] ) < $this->_tpl_vars['cnt_missions']): ?>
        <div id="id_div_show_more_mes_missions" class="more-box" align="center"
             style="margin-left: 0px; padding-left: 0px;">
            <a href="javascript: void(0);" class="cl_search_pagging<?php if ($this->_tpl_vars['nwall']): ?>2<?php endif; ?>" pname="missions"
               pcnt=" <?php echo $this->_tpl_vars['pcnt']+$this->_tpl_vars['rcnt']; ?>
" rcnt="<?php echo $this->_tpl_vars['rcnt']; ?>
">More <img src="<?php echo $this->_tpl_vars['imgDir']; ?>
arr01.gif"/></a>
        </div>
        <?php endif; ?>
    </div>
    <?php else: ?>
    <?php if ($this->_tpl_vars['IS_USER']): ?>
    <h2><span></span>Missions</h2>

    <div class="box001">
        <div class="post-box">There aren't any missions</div>
    </div>
    <?php else: ?>
    <h2><span></span>We're sorry, this member hasn't yet selected their mission</h2>
    <?php endif; ?>
    <?php endif; ?>
</div>

<?php if ($this->_tpl_vars['whatch_list']):  if ($this->_tpl_vars['wtl']): ?>
<div class="cl_srch_list adi_srch">
    <h2>Missions Watching</h2>
    <?php $_from = $this->_tpl_vars['wtl']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
    <div class="box002">
        <div class="post-box">
            <div class="b-awatar">
                <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
mission/id<?php echo $this->_tpl_vars['i']['mission_id']; ?>
"><img
                        src="<?php if ($this->_tpl_vars['i']['mission_img']):  echo $this->_tpl_vars['fImgDir']; ?>
mission/info/<?php echo $this->_tpl_vars['ui']['fpath']; ?>
/s/s_<?php echo $this->_tpl_vars['i']['mission_img'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_ward_m66.png<?php endif; ?>"
                        alt=""/></a>
            </div>
            <div class="post-title2">
                <b><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
mission/id<?php echo $this->_tpl_vars['i']['mission_id']; ?>
"><?php if ($this->_tpl_vars['i']['country'] && $this->_tpl_vars['i']['city']):  echo $this->_tpl_vars['i']['country']; ?>
, <?php echo $this->_tpl_vars['i']['city'];  if ($this->_tpl_vars['i']['region']): ?>, <?php echo $this->_tpl_vars['i']['region'];  endif;  else:  echo $this->_tpl_vars['i']['mission_title'];  endif; ?></a> <br/>(from <?php echo $this->_tpl_vars['i']['start_date']; ?>
)</b>
            </div>
        </div>
    </div>
    <?php endforeach; endif; unset($_from); ?>
</div>
<div style="clear:both;height:10px;">&nbsp;</div>
<?php else: ?>
<h2>Missions Watching</h2>
<div class="box001">
    <div class="post-box">
        There aren't any missions watching
    </div>
</div>
<?php endif;  endif; ?>