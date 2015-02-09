<?php /* Smarty version 2.6.11, created on 2014-04-13 11:40:45
         compiled from mods/system/_search_list_people.html */ ?>
<div id="id_div_search_people">
				<?php if ($this->_tpl_vars['srch_res']['people']): ?>
					<?php $this->assign('people', $this->_tpl_vars['srch_res']['people']); ?>
					<?php $this->assign('cnt_people', $this->_tpl_vars['cnt_all']['people']); ?>
					<div btype="People" class="cl_srch_list">
					<h2><span><?php if (3000 < $this->_tpl_vars['cnt_people']): ?>>3000<?php elseif (1000 < $this->_tpl_vars['cnt_people'] && 3000 > $this->_tpl_vars['cnt_people']): ?>>1000<?php else:  echo $this->_tpl_vars['cnt_people'];  endif; ?></span>People</h2>
					<?php if (1000 < $this->_tpl_vars['cnt_people']): ?>
						<div class="attention-box">More than <?php if (3000 < $this->_tpl_vars['cnt_people']): ?>3000<?php elseif (1000 < $this->_tpl_vars['cnt_people'] && 3000 > $this->_tpl_vars['cnt_people']): ?>1000<?php endif; ?> people found, you can use filters to refine your search</div>
					<?php endif; ?>
					<?php $_from = $this->_tpl_vars['people']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
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
no_photo_m66.jpg<?php endif; ?>"  /></a></div>

								<div class="post-title2"><?php if ($this->_tpl_vars['p']['mutual'] > 0): ?><span><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['p']['uid']; ?>
/friends?mutual=1"><?php echo $this->_tpl_vars['p']['mutual']; ?>
 mutual friend(s)</a></span><?php endif; ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['p']['uid']; ?>
"><b><?php echo $this->_tpl_vars['p']['first_name']; ?>
 <?php echo $this->_tpl_vars['p']['last_name']; ?>
</b></a></div>
								<p><?php if ($this->_tpl_vars['p']['city']):  echo $this->_tpl_vars['p']['city'];  if ($this->_tpl_vars['p']['country']): ?>, <?php endif;  endif;  if ($this->_tpl_vars['p']['country']):  echo $this->_tpl_vars['countries'][$this->_tpl_vars['p']['country']];  endif; ?></p>
							</div>
						</div>
					</div>
					<?php endforeach; endif; unset($_from); ?>
                                        
                                        <?php if (! isset ( $this->_tpl_vars['all_res'] )): ?>
                                        <span id="pagging">
                                            <div id="id_div_show_more_mes_people" class="more-box" align="center" style="margin-left: 0px; padding-left: 0px;" >
						<a href="javascript: void(0);" class="cl_search_pagging" pname="people" pcnt=" <?php echo $this->_tpl_vars['pcnt']['people']+$this->_tpl_vars['data_rcnt']; ?>
" rcnt="<?php echo $this->_tpl_vars['data_rcnt']; ?>
" ></a>
                                            </div>
                                        <?php echo $this->_tpl_vars['pagging_people']; ?>

                                        </span>
                                        <?php endif; ?>

					</div>
                                       
                                        <?php if (isset ( $this->_tpl_vars['all_res'] )): ?>
					<?php if (( $this->_tpl_vars['pcnt']['people']+$this->_tpl_vars['data_rcnt'] ) < $this->_tpl_vars['cnt_people']): ?>
					<div id="id_div_show_more_mes_people" class="more-box" align="center" style="margin-left: 0px; padding-left: 0px;">
						<a href="javascript: void(0);" class="cl_search_pagging_more" pname="people" pcnt=" <?php echo $this->_tpl_vars['pcnt']['people']+$this->_tpl_vars['data_rcnt']; ?>
" rcnt="<?php echo $this->_tpl_vars['data_rcnt']; ?>
" >More <img src="/i/arr01.gif"  /></a>
					</div>
					<?php endif; ?>
                                        <?php endif; ?>
				<?php endif; ?>
				</div>