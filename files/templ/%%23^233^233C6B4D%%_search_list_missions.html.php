<?php /* Smarty version 2.6.11, created on 2014-04-13 11:40:45
         compiled from mods/system/_search_list_missions.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_tmpl_time', 'mods/system/_search_list_missions.html', 20, false),array('modifier', 'nl2br', 'mods/system/_search_list_missions.html', 26, false),array('modifier', 'dlong', 'mods/system/_search_list_missions.html', 26, false),)), $this); ?>
<div id="id_div_search_missions">
				<?php if ($this->_tpl_vars['srch_res']['missions']): ?>
					<?php if (! $this->_tpl_vars['nwall']): ?>
						<?php $this->assign('missions', $this->_tpl_vars['srch_res']['missions']); ?>
						<?php $this->assign('cnt_messages', $this->_tpl_vars['cnt_all']['missions']); ?>
						<div btype="Missions" class="cl_srch_list">
							<h2><span><?php if (3000 < $this->_tpl_vars['cnt_messages']): ?>>3000<?php elseif (1000 < $this->_tpl_vars['cnt_messages'] && 3000 > $this->_tpl_vars['cnt_messages']): ?>>1000<?php else:  echo $this->_tpl_vars['cnt_messages'];  endif; ?></span>Missions</h2>
					        <?php if (1000 < $this->_tpl_vars['cnt_messages']): ?>
								<div class="attention-box">More than <?php if (3000 < $this->_tpl_vars['cnt_messages']): ?>3000<?php elseif (1000 < $this->_tpl_vars['cnt_messages'] && 3000 > $this->_tpl_vars['cnt_messages']): ?>1000<?php endif; ?> messages found, you can use filters to refine your search</div>
							<?php endif; ?>

							<?php $_from = $this->_tpl_vars['missions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
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
										<?php if ($this->_tpl_vars['mes']['sub_mtype'] == 1): ?>
                                                                                <div class="post-title-badge">
                                                                                    <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['mes']['uid']; ?>
"><b><?php echo $this->_tpl_vars['mes']['first_name']; ?>
 <?php echo $this->_tpl_vars['mes']['last_name']; ?>
</b></a> in <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['mes']['uid']; ?>
/mission/id<?php echo $this->_tpl_vars['mes']['mission_id']; ?>
"><i><?php echo $this->_tpl_vars['mes']['mission_name']; ?>
</i></a><br>
                                                                                    <p><?php echo smarty_function_html_tmpl_time(array('val' => $this->_tpl_vars['mes']['pdate'],'type' => 1), $this);?>
</p>
                                                                                    <table class="post-badge">
                                                                                        <td>
                                                                                            <img class="badge_img" src="<?php echo $this->_tpl_vars['imgDir']; ?>
/badges/<?php echo $this->_tpl_vars['mes']['b_img_name']; ?>
.png" alt="<?php echo $this->_tpl_vars['mes']['b_img_name']; ?>
"/>
                                                                                        </td>
                                                                                        <td>
                                                                                            <span class="story_badge" ><?php if ($this->_tpl_vars['mes']['story']):  echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['mes']['story'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)))) ? $this->_run_mod_handler('dlong', true, $_tmp, 39) : smarty_modifier_dlong($_tmp, 39));  endif; ?></span>
                                                                                        </td>
                                                                                    </table>
                                                                                </div>
                                                                                <?php else: ?>
                                                                                <div class="post-title"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['mes']['uid']; ?>
"><b><?php echo $this->_tpl_vars['mes']['first_name']; ?>
 <?php echo $this->_tpl_vars['mes']['last_name']; ?>
</b></a> in <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['mes']['uid']; ?>
/mission/id<?php echo $this->_tpl_vars['mes']['mission_id']; ?>
"><i><?php echo $this->_tpl_vars['mes']['mission_name']; ?>
</i></a><br> <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['mes']['story'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)))) ? $this->_run_mod_handler('dlong', true, $_tmp) : smarty_modifier_dlong($_tmp)); ?>
</div>
										<p><?php echo smarty_function_html_tmpl_time(array('val' => $this->_tpl_vars['mes']['pdate'],'type' => 1), $this);?>
</p>
                                                                                <?php endif; ?>
                                        <p><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['mes']['uid']; ?>
/mission/id<?php echo $this->_tpl_vars['mes']['mission_id']; ?>
?<?php echo $this->_tpl_vars['mes']['id']; ?>
">show more</a></p>
									</div>
								</div>
							</div>
							<?php endforeach; endif; unset($_from); ?>

                                                    <?php if (! isset ( $this->_tpl_vars['all_res'] )): ?>
                                                    <span id="pagging">
                                                        <div id="id_div_show_more_mes_missions" class="more-box" align="center" style="margin-left: 0px; padding-left: 0px;">
                        					<a href="javascript: void(0);" class="cl_search_pagging" pname="missions" pcnt=" <?php echo $this->_tpl_vars['pcnt']['missions']*$this->_tpl_vars['data_rcnt']; ?>
" rcnt="<?php echo $this->_tpl_vars['data_rcnt']; ?>
" ></a>
                                                        </div>
                                                    <?php echo $this->_tpl_vars['pagging_missions']; ?>

                                                    </span>
                                                    <?php endif; ?>

						</div>

						<?php if (isset ( $this->_tpl_vars['all_res'] )): ?>
                                                <?php if (( $this->_tpl_vars['pcnt']['missions']+$this->_tpl_vars['data_rcnt'] ) < $this->_tpl_vars['cnt_messages']): ?>
						<div id="id_div_show_more_mes_missions" class="more-box" align="center" style="margin-left: 0px; padding-left: 0px;">
							<a href="javascript: void(0);" class="cl_search_pagging_more" pname="missions" pcnt=" <?php echo $this->_tpl_vars['pcnt']['missions']+$this->_tpl_vars['data_rcnt']; ?>
" rcnt="<?php echo $this->_tpl_vars['data_rcnt']; ?>
" >More <img src="/i/arr01.gif"  /></a>
						</div>
						<?php endif; ?>
                                                <?php endif; ?>
                    <?php else: ?>
    						<?php $this->assign('missions', $this->_tpl_vars['srch_res']['missions']); ?>
						<?php $this->assign('cnt_missions', $this->_tpl_vars['cnt_all']['missions']); ?>

						<div btype="Missions" class="cl_srch_list">
							<h2><span><?php if (3000 < $this->_tpl_vars['cnt_missions']): ?>>3000<?php elseif (1000 < $this->_tpl_vars['cnt_missions'] && 3000 > $this->_tpl_vars['cnt_missions']): ?>>1000<?php else:  echo $this->_tpl_vars['cnt_missions'];  endif; ?> </span>Missions</h2>
							<?php if (1000 < $this->_tpl_vars['cnt_missions']): ?>
								<div class="attention-box">More than <?php if (3000 < $this->_tpl_vars['cnt_missions']): ?>3000<?php elseif (1000 < $this->_tpl_vars['cnt_missions'] && 3000 > $this->_tpl_vars['cnt_missions']): ?>1000<?php endif; ?> missions found, you can use filters to refine your search</div>
							<?php endif; ?>

							<?php $_from = $this->_tpl_vars['missions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['mk'] => $this->_tpl_vars['mis']):
?>
							<div class="box002">
								<div class="post-box">
									<div class="post-box-bg00" style="min-height: 40px">
										<div class="b-awatar">
											<a href="#"><img src="<?php if ($this->_tpl_vars['mis']['img']):  echo $this->_tpl_vars['fImgDir']; ?>
mission/<?php echo $this->_tpl_vars['mis']['img'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_ward_m66.png<?php endif; ?>"  /></a>
										</div>
										<div class="post-title2">
											<?php if ($this->_tpl_vars['nwall'] && ! $this->_tpl_vars['mis']['served']): ?><br/>
												<a href="javascript:void(0);" onclick="$('#mis_name').html($('#mtl_<?php echo $this->_tpl_vars['mis']['id']; ?>
').text());oMWall.SHConfirmPopup( 1, 'id_confirm_mission_popup', <?php echo $this->_tpl_vars['mis']['id']; ?>
 );" style="float:right;">Served this mission?</a>
											<?php endif; ?>
											<b><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/mission/id<?php echo $this->_tpl_vars['mis']['id']; ?>
" id="mtl_<?php echo $this->_tpl_vars['mis']['id']; ?>
"><?php if ($this->_tpl_vars['mis']['location']):  echo $this->_tpl_vars['mis']['location'];  else:  echo $this->_tpl_vars['mis']['title'];  endif; ?></a></b>
										</div>
										
									</div>
								</div>
							</div>
							<?php endforeach; endif; unset($_from); ?>

                                                        <?php if (! isset ( $this->_tpl_vars['all_res'] )): ?>
                                                        <span id="pagging">
                                                            <div id="id_div_show_more_mes_missions" class="more-box" align="center" style="margin-left: 0px; padding-left: 0px;">
                                                            	<a href="javascript: void(0);" class="cl_search_pagging" pname="missions" pcnt=" <?php echo $this->_tpl_vars['pcnt']['missions']*$this->_tpl_vars['data_rcnt']; ?>
" rcnt="<?php echo $this->_tpl_vars['data_rcnt']; ?>
" ></a>
                                                            </div>
                                                            <?php echo $this->_tpl_vars['pagging_missions']; ?>

                                                        </span>
                                                        <?php endif; ?>


						</div>

						<?php if (isset ( $this->_tpl_vars['all_res'] )): ?>
						<?php if (( $this->_tpl_vars['pcnt']['missions']+$this->_tpl_vars['data_rcnt'] ) < $this->_tpl_vars['cnt_missions']): ?>
							<div id="id_div_show_more_mes_missions" class="more-box" align="center" style="margin-left: 0px; padding-left: 0px;">
								<a href="javascript: void(0);" class="cl_search_pagging<?php if ($this->_tpl_vars['nwall']): ?>2<?php endif; ?>" pname="missions" pcnt=" <?php echo $this->_tpl_vars['pcnt']['missions']+$this->_tpl_vars['data_rcnt']; ?>
" rcnt="<?php echo $this->_tpl_vars['data_rcnt']; ?>
" >More <img src="/i/arr01.gif"  /></a>
							</div>
						<?php endif; ?>
                                                <?php endif; ?>
                                                <!--
                                                						<?php if (( $this->_tpl_vars['pcnt']['missions']+$this->_tpl_vars['data_rcnt'] ) < $this->_tpl_vars['cnt_missions']): ?>
							<div id="id_div_show_more_mes_missions" class="more-box" align="center" style="margin-left: 0px; padding-left: 0px;">
								<a href="javascript: void(0);" class="cl_search_pagging<?php if ($this->_tpl_vars['nwall']): ?>2<?php endif; ?>" pname="missions" pcnt=" <?php echo $this->_tpl_vars['pcnt']['missions']+$this->_tpl_vars['data_rcnt']; ?>
" rcnt="<?php echo $this->_tpl_vars['data_rcnt']; ?>
" >More <img src="/i/arr01.gif"  /></a>
							</div>
						<?php endif; ?>
                                                -->
					<?php endif; ?>
				<?php endif; ?>
				</div>