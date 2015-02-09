<?php /* Smarty version 2.6.11, created on 2014-04-13 11:40:45
         compiled from mods/system/_search_list_singles.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'trim', 'mods/system/_search_list_singles.html', 22, false),)), $this); ?>
<div id="id_div_search_singles">
    <?php if ($this->_tpl_vars['srch_res']['singles']): ?>
    <?php $this->assign('singles', $this->_tpl_vars['srch_res']['singles']); ?>
    <?php $this->assign('cnt_singles', $this->_tpl_vars['cnt_all']['singles']); ?>
    <div btype="Singles" class="cl_srch_list">
        <h2><span><?php if (3000 < $this->_tpl_vars['cnt_singles']): ?>>3000<?php elseif (1000 < $this->_tpl_vars['cnt_singles'] && 3000 > $this->_tpl_vars['cnt_singles']): ?>>1000<?php else:  echo $this->_tpl_vars['cnt_singles'];  endif; ?></span>Singles
        </h2>
        <?php if (1000 < $this->_tpl_vars['cnt_singles']): ?>
        <div class="attention-box">More than <?php if (3000 < $this->_tpl_vars['cnt_singles']): ?>3000<?php elseif (1000 < $this->_tpl_vars['cnt_singles'] && 3000 > $this->_tpl_vars['cnt_singles']): ?>1000<?php endif; ?> singles found, you can use filters to refine your search
        </div>
        <?php endif; ?>
        <?php $_from = $this->_tpl_vars['singles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['pk'] => $this->_tpl_vars['p']):
?>
        <div class="box002">
            <div class="post-box">
                <div class="post-box-bg00" style="min-height: 40px">
                    <div class="b-awatar"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['p']['uid']; ?>
"><img src="<?php if ($this->_tpl_vars['p']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['p']['fpath']; ?>
/s/s_<?php echo $this->_tpl_vars['p']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m66.jpg<?php endif; ?>"/></a>
                    </div>

                    <div class="post-title2"><span><a href="#"></a></span><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['p']['uid']; ?>
"><b><?php echo $this->_tpl_vars['p']['first_name']; ?>

                        <?php echo $this->_tpl_vars['p']['last_name']; ?>
</b></a></div>
                    <p><?php if ($this->_tpl_vars['p']['live_in']):  echo ((is_array($_tmp=$this->_tpl_vars['p']['live_in'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp));  endif; ?></p>
                </div>
            </div>
        </div>
        <?php endforeach; endif; unset($_from); ?>

        <?php if (! isset ( $this->_tpl_vars['all_res'] )): ?>
        <span id="pagging">
            <div id="id_div_show_more_mes_singles" class="more-box" align="center" style="margin-left: 0px; padding-left: 0px;">
            <a href="javascript: void(0);" class="cl_search_pagging" pname="singles" page="" pcnt=" <?php echo $this->_tpl_vars['page_singles']*$this->_tpl_vars['data_rcnt']; ?>
" rcnt="<?php echo $this->_tpl_vars['data_rcnt']; ?>
"></a>
            </div>
          <?php echo $this->_tpl_vars['pagging_singles']; ?>

        </span>
        <?php endif; ?>

    </div>

  <?php if (isset ( $this->_tpl_vars['all_res'] )): ?>
    <?php if (( $this->_tpl_vars['pcnt']['singles']+$this->_tpl_vars['data_rcnt'] ) < $this->_tpl_vars['cnt_singles']): ?>
    <div id="id_div_show_more_mes_singles" class="more-box" align="center" style="margin-left: 0px; padding-left: 0px;">
        <a href="javascript: void(0);" class="cl_search_pagging_more" pname="singles" pcnt=" <?php echo $this->_tpl_vars['pcnt']['singles']+$this->_tpl_vars['data_rcnt']; ?>
" rcnt="<?php echo $this->_tpl_vars['data_rcnt']; ?>
">More <img src="/i/arr01.gif"/></a>
    </div>
    <?php endif; ?>
    <?php endif; ?>
    
    <?php endif; ?>
</div>