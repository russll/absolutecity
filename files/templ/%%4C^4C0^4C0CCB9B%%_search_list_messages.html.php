<?php /* Smarty version 2.6.11, created on 2014-04-13 11:40:45
         compiled from mods/system/_search_list_messages.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_tmpl_time', 'mods/system/_search_list_messages.html', 16, false),)), $this); ?>
<div id="id_div_search_messages">
				<?php if ($this->_tpl_vars['srch_res']['messages']): ?>
					<?php $this->assign('messages', $this->_tpl_vars['srch_res']['messages']); ?>
					<?php $this->assign('cnt_messages', $this->_tpl_vars['cnt_all']['messages']); ?>
					<div btype="Messages" class="cl_srch_list">
					<h2><span><?php if (3000 < $this->_tpl_vars['cnt_messages']): ?>>3000<?php elseif (1000 < $this->_tpl_vars['cnt_messages'] && 3000 > $this->_tpl_vars['cnt_messages']): ?>>1000<?php else:  echo $this->_tpl_vars['cnt_messages'];  endif; ?></span>Messages</h2>
					<?php if (1000 < $this->_tpl_vars['cnt_messages']): ?>
						<div class="attention-box">More than <?php if (3000 < $this->_tpl_vars['cnt_messages']): ?>3000<?php elseif (1000 < $this->_tpl_vars['cnt_messages'] && 3000 > $this->_tpl_vars['cnt_messages']): ?>1000<?php endif; ?> messages found, you can use filters to refine your search</div>
					<?php endif; ?>
					<?php $_from = $this->_tpl_vars['messages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
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
</b></a> <?php echo $this->_tpl_vars['mes']['story']; ?>
</div>
								<p><?php echo smarty_function_html_tmpl_time(array('val' => $this->_tpl_vars['mes']['pdate'],'type' => 1), $this);?>
</p>
                                <p><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['mes']['uid']; ?>
?<?php echo $this->_tpl_vars['mes']['id']; ?>
">show more</a></p>
							</div>
						</div>
					</div>
					<?php endforeach; endif; unset($_from); ?>

                                        <?php if (! isset ( $this->_tpl_vars['all_res'] )): ?>
                                        <span id="pagging">
                                            <div id="id_div_show_more_mes_messages" class="more-box" align="center" style="margin-left: 0px; padding-left: 0px;">
						<a href="javascript: void(0);" class="cl_search_pagging" pname="messages" pcnt=" <?php echo $this->_tpl_vars['pcnt']['messages']*$this->_tpl_vars['data_rcnt']; ?>
" rcnt="<?php echo $this->_tpl_vars['data_rcnt']; ?>
" ></a>
                                            </div>
                                        <?php echo $this->_tpl_vars['pagging_messages']; ?>

                                        </span>
                                        <?php endif; ?>
                                        
					</div>


                                       <?php if (isset ( $this->_tpl_vars['all_res'] )): ?>
					<?php if (( $this->_tpl_vars['pcnt']['messages']+$this->_tpl_vars['data_rcnt'] ) < $this->_tpl_vars['cnt_messages']): ?>
					<div id="id_div_show_more_mes_messages" class="more-box" align="center" style="margin-left: 0px; padding-left: 0px;">
						<a href="javascript: void(0);" class="cl_search_pagging_more" pname="messages" pcnt=" <?php echo $this->_tpl_vars['pcnt']['messages']+$this->_tpl_vars['data_rcnt']; ?>
" rcnt="<?php echo $this->_tpl_vars['data_rcnt']; ?>
" >More <img src="/i/arr01.gif"  /></a>
					</div>
					<?php endif; ?>
                                        <?php endif; ?>
				<?php endif; ?>
				</div>