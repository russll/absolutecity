<?php /* Smarty version 2.6.11, created on 2014-06-23 16:13:27
         compiled from mods/_popups/_add_valbum.html */ ?>
												<div id="id_add_valbum_popup" class="aj-box01" style="display: none; position: fixed; z-index: 3333; max-height: 200px">
													<div class="aj-close"><a href="javascript: void(0);" onclick="oValbums.SHUplPopup( 2, 'id_add_valbum_popup' )"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close_ico.gif"  /></a></div>
													
													<div style="margin: 10px;"><h3>Add a new album</h3></div>
													
													<div class="" style="max-height: 180px; margin: 10px; border: none !important;">
														<div>
															<div>
																<input id="id_friend_add_friend_id" name="fr_id" type="hidden" value="" />
																	<fieldset style="border: none !important;">
																		<div>
																			<table>
																				<tr>
																					<td>
																						<form id="id_frm_add_valbum" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['UserInfo']['uid']; ?>
/valbums/edit" method="post">
																							<table width="80%">
																								<tr>
																									<td width="70px" style="vertical-align: middle"><b>Title: &nbsp</b></td>
																									<td><span ><input id="id_upl_video_title"  style="font-size: 12px; font-family: Arial;" type="text" class="txt" name="AI[name]" value="" width="45px" /></span></td>
																								</tr>
																								
																								<tr>
																									<td width="70px" style="vertical-align: middle"><b>Description: &nbsp</b></td>
																									<td><span><textarea style="font-size: 12px; font-family: Arial;" id="id_upl_video_descr" class="txt"  name="AI[descr]" cols="50" ></textarea></span></td>
																								</tr>
																							</table>
																						</form>
																					</td>
																				</tr>
																			</table>
																		</div>
																	</fieldset>
															</div>
														</div>
													</div>
													
													<div class="aj-button">
														<span class="aj-button01"><a href="javascript: void(0);" onclick="oValbums.SHUplPopup( 2, 'id_add_valbum_popup' );">Cancel</a></span>
														<span class="aj-button02"><a href="javascript: void(0);" onclick="oValbums.AddValbum( 'id_frm_add_valbum' );">Add</a></span>
													</div>
												</div>