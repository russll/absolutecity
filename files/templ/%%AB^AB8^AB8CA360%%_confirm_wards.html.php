<?php /* Smarty version 2.6.11, created on 2014-03-15 09:09:55
         compiled from mods/_popups/_confirm_wards.html */ ?>
						<div id="id_confirm_wards_popup" class="aj-box01" align="center" style="display: none; position: fixed; z-index: 4444; max-height: 120px">
							<div class="aj-close"><a href="javascript: void(0);" onclick="oFriends.SHConfirmPopup( 2, 'id_confirm_wards_popup' );"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close_ico.gif"  /></a></div>
							
							<div style="margin: 10px;" align="left"><h3>&nbsp;</h3></div>
							
							<div class="" style="max-height: 120px; margin: 10px; border: none !important;">
								<div>
									<div>
										<form id="id_set_ward_popup_frm" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
wards/chngward" method="get">
										<input id="id_ward_set_id" name="id" type=hidden value="" />
											<fieldset style="border: none !important;">
												<div>
													<div>
														<p><span id="id_friend_add_fio"></span></p>
														<b style="color: #000;">Please confirm you would like to set this as your ward</b>
													</div>
												</div>
											</fieldset>
										</form>
									</div>
								</div>
							</div>
							
							<div class="aj-button" align="left">
								<span class="aj-button01"><a href="javascript: void(0);" onclick="oFriends.SHConfirmPopup( 2, 'id_confirm_wards_popup' );">Cancel</a></span>
								<span class="aj-button02"><a href="javascript: void(0);" onclick="$('#id_set_ward_popup_frm').submit();">Set</a></span>	
							</div>
							<span class="block-bottom">&nbsp;</span>
						</div>