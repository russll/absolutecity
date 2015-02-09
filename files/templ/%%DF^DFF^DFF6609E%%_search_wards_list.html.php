<?php /* Smarty version 2.6.11, created on 2014-04-09 23:03:58
         compiled from mods/system/_search_wards_list.html */ ?>
<div id="id_div_search_wards">
    <?php $this->assign('wards', $this->_tpl_vars['srch_res']['wards']); ?>
    <?php $this->assign('cnt_wards', $this->_tpl_vars['cnt_all']['wards']); ?>

    <?php if (! $this->_tpl_vars['nwall']): ?>
        <h2><span><?php if (3000 < $this->_tpl_vars['cnt_messages']): ?>>3000<?php elseif (1000 < $this->_tpl_vars['cnt_messages'] && 3000 > $this->_tpl_vars['cnt_messages']): ?>>1000<?php else:  echo $this->_tpl_vars['cnt_messages'];  endif; ?></span>Wards/branches</h2>

        <?php if (1000 < $this->_tpl_vars['cnt_messages']): ?>
        <div class="attention-box">More than <?php if (3000 < $this->_tpl_vars['cnt_messages']): ?>3000<?php elseif (1000 < $this->_tpl_vars['cnt_messages'] && 3000 > $this->_tpl_vars['cnt_messages']): ?>1000<?php endif; ?> wards found, you can use filters to refine your searchå</div>
        <?php endif; ?>
    <?php endif; ?>
    <div btype="Wards" class="cl_srch_list">
        <?php $_from = $this->_tpl_vars['wards']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['mk'] => $this->_tpl_vars['wa']):
?>
        <div class="box002">
            <div class="post-box">
                <div class="post-box-bg00" style="min-height: 40px">
                    <div class="b-awatar"><a href="#"><img
                                src="<?php if ($this->_tpl_vars['wa']['img']):  echo $this->_tpl_vars['fImgDir']; ?>
wards/<?php echo $this->_tpl_vars['wa']['img'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_ward_m66.png<?php endif; ?>"/></a></div>
                    <div class="post-title2">
                        <b>
                            <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
wards/id<?php echo $this->_tpl_vars['wa']['id']; ?>
"><?php if (! empty ( $this->_tpl_vars['wa']['title'] )):  echo $this->_tpl_vars['wa']['title']; ?>
 <?php else:  echo $this->_tpl_vars['wa']['ward_title']; ?>
 <?php endif; ?></a>
                            <?php if ($this->_tpl_vars['wa']['id'] != $this->_tpl_vars['UserInfo']['stake_id'] && $this->_tpl_vars['wa']['id'] != $this->_tpl_vars['UserInfo']['ward_id']): ?></a>
                            (<a href="javascript: oWWall.SHConfirmPopup( 1, 'id_confirm_wards_popup', <?php echo $this->_tpl_vars['wa']['id']; ?>
 );">Set as my ward</a>)
                            <?php endif; ?>
                        </b>
                    </div>
                    <p><?php if (! empty ( $this->_tpl_vars['wa']['id_parent'] )): ?> <?php echo $this->_tpl_vars['wa']['ward_title']; ?>
 <?php else: ?> &nbsp <?php endif; ?></p></div>
            </div>
        </div>
        <?php endforeach; endif; unset($_from); ?>
    </div>

    <?php if (( $this->_tpl_vars['pcnt']+$this->_tpl_vars['data_rcnt'] ) < $this->_tpl_vars['cnt_wards']): ?>
    <div id="id_div_show_more_mes_wards" class="more-box" align="center" style="margin-left: 0px; padding-left: 0px;">
        <a href="javascript: void(0);" class="cl_search_pagging" pname="wards" pcnt=" <?php echo $this->_tpl_vars['pcnt']+$this->_tpl_vars['data_rcnt']; ?>
" rcnt="<?php echo $this->_tpl_vars['data_rcnt']; ?>
">More <img src="/i/arr01.gif"/></a>
    </div>
    <?php endif; ?>
</div>