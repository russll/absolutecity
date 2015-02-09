<?php /* Smarty version 2.6.11, created on 2014-03-15 08:51:13
         compiled from mods/_popups/_confirm_friends.html */ ?>
						<div id="id_confirm_friends_popup" class="aj-box01" align="center" style="display: none; position: fixed; z-index: 4444; max-height: 120px">
							<div class="aj-close"><a href="javascript: void(0);" onclick="oFriends.SHConfirmPopup( 2, 'id_confirm_friends_popup' );"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close_ico.gif"  /></a></div>
							
							<div style="margin: 10px;" align="left"><h3>&nbsp;</h3></div>
							
							<div class="" style="max-height: 120px; margin: 10px; border: none !important;">
								<div>
									<div>
										<form id="id_del_friend_popup_frm" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
base/friends/edit?action=del" method="post">
										<input id="id_friend_del_friend_id" name="fr_id" type=hidden value="" />
											<fieldset style="border: none !important;">
												<div>
													<div>
														<p><span id="id_friend_add_fio"></span></p>
														<b>Please confirm you want to unfriend this member.</b>
													</div>
												</div>
											</fieldset>
										</form>
									</div>
								</div>
							</div>
							
							<div class="aj-button" align="left">
								<span class="aj-button01"><a href="javascript: void(0);" onclick="oFriends.SHConfirmPopup( 2, 'id_confirm_friends_popup' );">Cancel</a></span>
								<span class="aj-button02"><a href="javascript: void(0);" onclick="$('#id_del_friend_popup_frm').submit();">Remove</a></span>	
							</div>
							<span class="block-bottom">&nbsp;</span>
						</div>