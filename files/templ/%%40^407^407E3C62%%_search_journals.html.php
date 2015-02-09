<?php /* Smarty version 2.6.11, created on 2014-10-07 05:06:23
         compiled from mods/system/_search_journals.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'mods/system/_search_journals.html', 8, false),array('modifier', 'html_substr', 'mods/system/_search_journals.html', 20, false),array('modifier', 'closetags', 'mods/system/_search_journals.html', 20, false),array('modifier', 'count_characters', 'mods/system/_search_journals.html', 20, false),array('function', 'html_tmpl_time', 'mods/system/_search_journals.html', 21, false),)), $this); ?>
				<?php if ($this->_tpl_vars['srch_res']['journals']): ?>
					<?php $this->assign('journals', $this->_tpl_vars['srch_res']['journals']); ?>
					<?php $this->assign('cnt_journals', $this->_tpl_vars['cnt_all']['journals']); ?>
					
                                        
                                        <div btype="Journals" class="cl_srch_list">
                                        <?php if (! isset ( $this->_tpl_vars['all_res'] )): ?>
                                            <!--h2><span><?php if ($this->_tpl_vars['cnt_journals'] > 0):  echo $this->_tpl_vars['cnt_journals'];  else:  if (3000 < count($this->_tpl_vars['srch_res']['journals'])): ?>>3000<?php elseif (1000 < count($this->_tpl_vars['srch_res']['journals']) && 3000 > count($this->_tpl_vars['srch_res']['journals'])): ?>>1000<?php else:  echo count($this->_tpl_vars['srch_res']['journals']);  endif;  endif; ?></span>Journals</h2-->
                                            <h2><span><?php if (3000 < $this->_tpl_vars['cnt_journals']): ?>>3000<?php elseif (1000 < $this->_tpl_vars['cnt_journals'] && 3000 > $this->_tpl_vars['cnt_journals']): ?>>1000<?php else:  echo $this->_tpl_vars['cnt_journals'];  endif; ?></span>Journals</h2>
					<?php if (1000 < $this->_tpl_vars['cnt_journals']): ?>
						<div class="attention-box">More than <?php if (3000 < $this->_tpl_vars['cnt_journals']): ?>3000<?php elseif (1000 < $this->_tpl_vars['cnt_journals'] && 3000 > $this->_tpl_vars['cnt_journals']): ?>1000<?php endif; ?> journals found, you can use filters to refine your search</div>
					<?php endif; ?>
                                        <?php endif; ?>

					<?php $_from = $this->_tpl_vars['journals']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['mk'] => $this->_tpl_vars['mes']):
?>
					<div class="box002">
						<div class="post-box">
							<div class="post-box-bg00" style="min-height: 40px">
								<div class="b-awatar"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['mes']['uid']; ?>
"><img src="<?php if ($this->_tpl_vars['mes']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['mes']['fpath']; ?>
/s/s_<?php echo $this->_tpl_vars['mes']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m66.jpg<?php endif; ?>"  /></a></div>		
								<div class="post-title"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['mes']['uid']; ?>
"><b><?php echo $this->_tpl_vars['mes']['first_name']; ?>
 <?php echo $this->_tpl_vars['mes']['last_name']; ?>
</b></a> <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['mes']['story'])) ? $this->_run_mod_handler('html_substr', true, $_tmp, 500) : smarty_modifier_html_substr($_tmp, 500)))) ? $this->_run_mod_handler('closetags', true, $_tmp) : smarty_modifier_closetags($_tmp));  if (((is_array($_tmp=$this->_tpl_vars['mes']['story'])) ? $this->_run_mod_handler('count_characters', true, $_tmp) : smarty_modifier_count_characters($_tmp)) > 500): ?>...<?php endif; ?></div>
								<p><?php echo smarty_function_html_tmpl_time(array('val' => $this->_tpl_vars['mes']['pdate'],'type' => 1), $this);?>
</p>
                                <p><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['mes']['uid']; ?>
/journal?<?php echo $this->_tpl_vars['mes']['id']; ?>
">show more</a></p>
							</div>
						</div>
					</div>
					<?php endforeach; endif; unset($_from); ?>

                                        <?php if (! isset ( $this->_tpl_vars['all_res'] )): ?>
                                        <span id="pagging">
                                            <div id="id_div_show_more_mes_journals" class="more-box" align="center" style="margin-left: 0px; padding-left: 0px;">
						<a href="javascript: void(0);" class="cl_search_pagging" pname="journals" pcnt=" <?php echo $this->_tpl_vars['pcnt']['journals']*$this->_tpl_vars['data_rcnt']; ?>
" rcnt="<?php echo $this->_tpl_vars['data_rcnt']; ?>
" ></a>
                                            </div>
                                        <?php echo $this->_tpl_vars['pagging_journals']; ?>

                                        </span>
                                        <?php endif; ?>

					</div>

					<?php if (isset ( $this->_tpl_vars['all_res'] )): ?>
                                        <?php if (( $this->_tpl_vars['pcnt']['journals']+$this->_tpl_vars['data_rcnt'] ) < $this->_tpl_vars['cnt_journals']): ?>
					<div id="id_div_show_more_mes_journals" class="more-box" align="center" style="margin-left: 0px; padding-left: 0px;">
						<a href="javascript: void(0);" class="cl_search_pagging_more" pname="journals" pcnt=" <?php echo $this->_tpl_vars['pcnt']['journals']+$this->_tpl_vars['data_rcnt']; ?>
" rcnt="<?php echo $this->_tpl_vars['data_rcnt']; ?>
" >More <img src="/i/arr01.gif"  /></a>
					</div>
					<?php endif; ?>
                                        <?php endif; ?>
				<?php endif; ?>