<?php /* Smarty version 2.6.11, created on 2014-08-22 15:54:29
         compiled from mods/_popups/_upl_wards_avatar.html */ ?>
<div id="id_upl_wavatar_popup" class="aj-box01" style="visibility: hidden; position: fixed; z-index: 3333; max-height: 200px">
	<div id="id_upl_popup_close" class="aj-close"><a href="javascript: void(0);" onclick="oWards.SHUplPopup( 2, 'id_upl_wavatar_popup' )"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close_ico.gif"  /></a></div>

	<div style="margin: 10px;"><h3>Upload photo to Ward's avatar</h3></div>

	<div class="" style="max-height: 180px; margin: 10px; border: none !important;">
		<div>
			<div>
				<input id="id_friend_add_friend_id" name="fr_id" type="hidden" value="" />
				<fieldset style="border: none !important;">
					<div>
						<table>
							<tr>
								<td>
									<div id="id_send_frm_wavatar_choose_file" class="upload-photo">
										<form id="id_frm_upl_wavatar" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
base/ward/uplavatar" method="post" enctype="multipart/form-data">

											<table>
												<tr>
													<td style="width:350px;"><input type="file" name="wa_Filedata" id="wa_Filedata" /></td>
													<td style="height:50px;">&nbsp;<img id="wa_loading_circle" src="/i/ajax-loader.gif" id="id_wavatar_loader_pic" style="display:none; width:35px; padding:3px;" /></td>
												</tr>
												<tr>
													<td colspan="2" id="wa_status_td">Please select a photo and press "Add"</td>
												</tr>
											</table>

																					<div>
												<input id="id_btn_wavatar_upload" type="button" value="Start Upload" onclick="oUplAvatar.startUpload();" style="margin-left: 2px; font-size: 8pt; height: 29px; display: none;" />
																							</div>
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
		<span id="id_upl_popup_cancel" class="aj-button01"><a href="javascript: void(0);" onclick="oWards.SHUplPopup( 2, 'id_upl_wavatar_popup' );">Cancel</a></span>
		<span id="id_upl_popup_add" class="aj-button02"><a href="javascript: void(0);" onclick="oWards.UplAvatar();">Add</a></span>
	</div>

</div>