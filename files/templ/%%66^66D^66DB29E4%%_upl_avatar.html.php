<?php /* Smarty version 2.6.11, created on 2014-03-15 08:51:13
         compiled from mods/_popups/_upl_avatar.html */ ?>
<div id="id_upl_avatar_popup" class="aj-box01" style="visibility: hidden; position: fixed; z-index: 3333; max-height: 200px">
	<div id="id_upl_popup_close" class="aj-close"><a href="javascript: void(0);" onclick="oUsers.SHUplPopup( 2, 'id_upl_avatar_popup' )"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close_ico.gif"  /></a></div>

	<div style="margin: 10px;"><h3>Upload a photo to avatar</h3></div>

	<div class="" style="max-height: 180px; margin: 10px; border: none !important;">
		<div>
			<div>
				<input id="id_friend_add_friend_id" name="fr_id" type="hidden" value="" />
				<fieldset style="border: none !important;">
					<div>
						<table>
							<tr>
								<td>
									<div id="id_send_frm_avatar_choose_file" class="upload-photo">
										<form id="id_frm_upl_avatar" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
security/users/uplavatar" method="post" enctype="multipart/form-data">

											<table>
												<tr>
													<td style="width:350px;"><input type="file" name="Filedata" id="Filedata" /></td>
													<td style="height:50px;">&nbsp;<img id="loading_circle" src="/i/ajax-loader.gif" id="id_avatar_loader_pic" style="display:none; width:35px; padding:3px;" /></td>
												</tr>
												<tr>
													<td colspan="2" id="status_td">Please select a photo and press "Add"</td>
												</tr>
											</table>

											
										</form>
									</div>
								</td>
							</tr>
						</table>
					</div>
				</fieldset>
			</div>
		</div>
	</div>

	<div class="aj-button">
		<span id="id_upl_popup_cancel" class="aj-button01"><a href="javascript: void(0);" onclick="oUsers.SHUplPopup( 2, 'id_upl_avatar_popup' );">Cancel</a></span>
		<span id="id_upl_popup_add" class="aj-button02"><a href="javascript: void(0);" >Add</a></span>
	</div>

</div>