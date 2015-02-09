<?php /* Smarty version 2.6.11, created on 2014-08-22 15:54:29
         compiled from mods/_popups/_add_bishopric.html */ ?>
												
<div id="id_add_bishopric_popup" class="aj-box02" style="display: none; position: fixed; z-index: 3333; top: 10%; height: 455px;">
	<div class="aj-close"><a href="javascript: void(0);" onclick="oWards.SHBishopricPopup( 2, 'id_add_bishopric_popup' );"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close_ico.gif"  /></a></div>
	<div class="aj-box02-title">
		<h2>Suggest a Bishopric's info</h2>
		<p>All fields are optional, please enter verified info only</p>
	</div>

	<form id="id_frm_add_bishopric" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
wards/id<?php echo $this->_tpl_vars['ward_i']['id']; ?>
/editbishopric" method="post" enctype="multipart/form-data">
		<div class="add-album-form" style="height: 335px;">

			<h3 class="cl_bishopric_info_h3" sinfo="bishop"><a href="#">Suggest a Bishop's info</a><span><a sinfo="bishop" style="cursor: pointer;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
arr05.gif"  /></a></span></h3><br />
			<div sinfo="bishop">
				<table>
					<tr>
						<td>
							<p><label>Photo</label></p>

							<p><img id="id_img_upl_bishopric" src="<?php if ($this->_tpl_vars['ward_i']['bishopric']['p_img']): ?> <?php echo $this->_tpl_vars['fImgDir']; ?>
wards/info/bishopric/<?php echo $this->_tpl_vars['ward_i']['bishopric']['p_img']; ?>
 <?php else: ?> <?php echo $this->_tpl_vars['imgDir']; ?>
no_photo.gif <?php endif; ?>" onclick="$('#id_span_upl_bishopric').click();" style="max-width: 100px; max-height: 100px;" /></p>
							<p style="position: relative; width:100px;">
																<div id="bsprc_upl" style="width:100px;background-image: url('/i/upl_aphoto_100.gif'); cursor:pointer;">
<!--								<input type="file" onchange="alert('File selected! It will be uploaded, when you submit changes.')" style="opacity:0; width:100px; height:17px; cursor:pointer;margin-left:-150px;" id="id_link_upl_bishopric" name="bishop_p_img" />-->
									<input type="hidden" id="bishop_p_img_hi" name="bishop_p_img" />
							</div>
							</p>
						</td>
						<td style="width: 20px;">&nbsp</td>
						<td style="height: 150px; vertical-align: top;">
							<table style="width: 80%;">
								<tr>
									<td style="width: 50%"><p><label>First name</label></p></td>
									<td><p><label>Last name</label></p></td>
								</tr>
								<tr>
									<td style="width: 50%"><p><input id="id_bishopric_pres_first_name" name="AI[first_name]" type="text" value="<?php echo $this->_tpl_vars['ward_i']['bishopric']['first_name']; ?>
" style="width: 90%;" /></p></td>
									<td><p><input id="id_bishopric_pres_last_name" name="AI[last_name]" type="text" value="<?php echo $this->_tpl_vars['ward_i']['bishopric']['last_name']; ?>
" style="width: 90%;" /></p></td>
								</tr>
							</table>
							<p><label>Phone nr</label> <input class="keyfilter_phone" id="id_bishopric_pres_phone" name="AI[phone]" type="text" value="<?php echo $this->_tpl_vars['ward_i']['bishopric']['phone']; ?>
" style="width: 50%;" /></p>
							<p><label>Email</label> <input  class="mask-email" id="id_bishopric_pres_email" name="AI[email]" type="text" value="<?php echo $this->_tpl_vars['ward_i']['bishopric']['email']; ?>
" style="width: 50%;" /></p>
						</td>
					</tr>
				</table>
				<div class="upload-photo" style="float: left;">
					<ol id="id_bava_upl_pr_ol" style="display: none;">
						<!-- <li>DSC102659.jpg <a href="#">Remove</a></li> -->
					</ol>
				</div>
				<br />
			</div>

			<h3 class="cl_bishopric_info_h3" sinfo="cperson"><a href="#">Suggest a Contact Person for appointments with bishop</a><span><a sinfo="cperson" style="cursor: pointer;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
arr05.gif"  /></a></span></h3><br />
			<div sinfo="cperson" style="display: none;">
				<table>
					<tr>
						<td style="width: 20px;">&nbsp</td>
						<td style="height: 150px; vertical-align: top;">
							<table style="width: 80%;">
								<tr>
									<td style="width: 50%"><p><label>First name</label></p></td>
									<td><p><label>Last name</label></p></td>
								</tr>
								<tr>
									<td style="width: 50%"><p><input id="id_bishopric_pres_first_name" name="CPI[cp_first_name]" type="text" value="<?php echo $this->_tpl_vars['ward_i']['bishopric']['cp_first_name']; ?>
" style="width: 90%;" /></p></td>
									<td><p><input id="id_bishopric_pres_last_name" name="CPI[cp_last_name]" type="text" value="<?php echo $this->_tpl_vars['ward_i']['bishopric']['cp_last_name']; ?>
" style="width: 90%;" /></p></td>
								</tr>
							</table>
							<p><label>Phone nr</label> <input class="keyfilter_phone" id="id_bishopric_pres_phone" name="CPI[cp_phone]" type="text" value="<?php echo $this->_tpl_vars['ward_i']['bishopric']['cp_phone']; ?>
" style="width: 50%;" /></p>
							<p><label>Email</label> <input class="mask-email" id="id_bishopric_pres_email" name="CPI[cp_email]" type="text" value="<?php echo $this->_tpl_vars['ward_i']['bishopric']['cp_email']; ?>
" style="width: 50%;" /></p>
						</td>
					</tr>
				</table>
				<br />
			</div>

			<h3 class="cl_bishopric_info_h3" sinfo="fcounselor"><a href="#">Suggest a First Counselor's info</a><span><a sinfo="fcounselor" style="cursor: pointer;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
arr05.gif"  /></a></span></h3><br />
			<div sinfo="fcounselor" style="display: none;">
				<table>
					<tr>
						<td style="width: 20px;">&nbsp</td>
						<td style="height: 150px; vertical-align: top;">
							<table style="width: 80%;">
								<tr>
									<td style="width: 50%"><p><label>First name</label></p></td>
									<td><p><label>Last name</label></p></td>
								</tr>
								<tr>
									<td style="width: 50%"><p><input id="id_bishopric_pres_first_name" name="FCI[fc_first_name]" type="text" value="<?php echo $this->_tpl_vars['ward_i']['bishopric']['fc_first_name']; ?>
" style="width: 90%;" /></p></td>
									<td><p><input id="id_bishopric_pres_last_name" name="FCI[fc_last_name]" type="text" value="<?php echo $this->_tpl_vars['ward_i']['bishopric']['fc_last_name']; ?>
" style="width: 90%;" /></p></td>
								</tr>
							</table>
							<p><label>Phone nr</label> <input class="keyfilter_phone" id="id_bishopric_pres_phone" name="FCI[fc_phone]" type="text" value="<?php echo $this->_tpl_vars['ward_i']['bishopric']['fc_phone']; ?>
" style="width: 50%;" /></p>
							<p><label>Email</label> <input class="mask-email" id="id_bishopric_pres_email" name="FCI[fc_email]" type="text" value="<?php echo $this->_tpl_vars['ward_i']['bishopric']['fc_email']; ?>
" style="width: 50%;" /></p>
						</td>
					</tr>
				</table>
				<br />
			</div>

			<h3 class="cl_bishopric_info_h3" sinfo="scounselor"><a href="#">Suggest a Second Counselor's info</a><span><a sinfo="scounselor" style="cursor: pointer;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
arr05.gif"  /></a></span></h3><br />
			<div sinfo="scounselor" style="display: none;">
				<table>
					<tr>
						<td style="width: 20px;">&nbsp</td>
						<td style="height: 150px; vertical-align: top;">
							<table style="width: 80%;">
								<tr>
									<td style="width: 50%"><p><label>First name</label></p></td>
									<td><p><label>Last name</label></p></td>
								</tr>
								<tr>
									<td style="width: 50%"><p><input id="id_bishopric_pres_first_name" name="SCI[sc_first_name]" type="text" value="<?php echo $this->_tpl_vars['ward_i']['bishopric']['sc_first_name']; ?>
" style="width: 90%;" /></p></td>
									<td><p><input id="id_bishopric_pres_last_name" name="SCI[sc_last_name]" type="text" value="<?php echo $this->_tpl_vars['ward_i']['bishopric']['sc_last_name']; ?>
" style="width: 90%;" /></p></td>
								</tr>
							</table>
							<p>
								<label>Phone nr</label>
								<input class="keyfilter_phone" id="id_bishopric_pres_phone" name="SCI[sc_phone]" type="text" value="<?php echo $this->_tpl_vars['ward_i']['bishopric']['sc_phone']; ?>
" style="width: 50%;" />
							</p>
							<p><label>Email</label> <input class="mask-email" class="mask-email" id="id_bishopric_pres_email" name="SCI[sc_email]" type="text" value="<?php echo $this->_tpl_vars['ward_i']['bishopric']['sc_email']; ?>
" style="width: 50%;" /></p>
						</td>
					</tr>
				</table>
				<br />
			</div>

			<h3 class="cl_bishopric_info_h3" sinfo="exsecretary"><a href="#">Suggest a Ward Executive Secretary's info</a><span><a sinfo="exsecretary" style="cursor: pointer;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
arr05.gif"  /></a></span></h3><br />
			<div sinfo="exsecretary" style="display: none;">
				<table>
					<tr>
						<td style="width: 20px;">&nbsp</td>
						<td style="height: 150px; vertical-align: top;">
							<table style="width: 80%;">
								<tr>
									<td style="width: 50%"><p><label>First name</label></p></td>
									<td><p><label>Last name</label></p></td>
								</tr>
								<tr>
									<td style="width: 50%"><p><input id="id_bishopric_pres_first_name" name="ESI[es_first_name]" type="text" value="<?php echo $this->_tpl_vars['ward_i']['bishopric']['es_first_name']; ?>
" style="width: 90%;" /></p></td>
									<td><p><input id="id_bishopric_pres_last_name" name="ESI[es_last_name]" type="text" value="<?php echo $this->_tpl_vars['ward_i']['bishopric']['es_last_name']; ?>
" style="width: 90%;" /></p></td>
								</tr>
							</table>
							<p><label>Phone nr</label> <input class="keyfilter_phone" id="id_bishopric_pres_phone" name="ESI[es_phone]" type="text" value="<?php echo $this->_tpl_vars['ward_i']['bishopric']['es_phone']; ?>
" style="width: 50%;" /></p>
							<p><label>Email</label> <input class="mask-email" id="id_bishopric_pres_email" name="ESI[es_email]" type="text" value="<?php echo $this->_tpl_vars['ward_i']['bishopric']['es_email']; ?>
" style="width: 50%;" /></p>
						</td>
					</tr>
				</table>
				<br />
			</div>

			<h3 class="cl_bishopric_info_h3" sinfo="wclerk"><a href="#">Suggest a Ward Clerk's info</a><span><a sinfo="wclerk" style="cursor: pointer;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
arr05.gif"  /></a></span></h3><br />
			<div sinfo="wclerk" style="display: none;">
				<table>
					<tr>
						<td style="width: 20px;">&nbsp</td>
						<td style="height: 150px; vertical-align: top;">
							<table style="width: 80%;">
								<tr>
									<td style="width: 50%"><p><label>First name</label></p></td>
									<td><p><label>Last name</label></p></td>
								</tr>
								<tr>
									<td style="width: 50%"><p><input id="id_bishopric_pres_first_name" name="WCI[wc_first_name]" type="text" value="<?php echo $this->_tpl_vars['ward_i']['bishopric']['wc_first_name']; ?>
" style="width: 90%;" /></p></td>
									<td><p><input id="id_bishopric_pres_last_name" name="WCI[wc_last_name]" type="text" value="<?php echo $this->_tpl_vars['ward_i']['bishopric']['wc_last_name']; ?>
" style="width: 90%;" /></p></td>
								</tr>
							</table>
							<p><label>Phone nr</label> <input class="keyfilter_phone" id="id_bishopric_pres_phone" name="WCI[wc_phone]" type="text" value="<?php echo $this->_tpl_vars['ward_i']['bishopric']['wc_phone']; ?>
" style="width: 50%;" /></p>
							<p><label>Email</label> <input class="mask-email" id="id_bishopric_pres_email" name="WCI[wc_email]" type="text" value="<?php echo $this->_tpl_vars['ward_i']['bishopric']['wc_email']; ?>
" style="width: 50%;" /></p>
						</td>
					</tr>
				</table>
				<br />
			</div>

		</div>
	</form>
	<div class="aj-button" style="margin-top: 0px; padding-top: 0px;">
		<span class="aj-button01"><a href="javascript: void(0);" onclick="oWards.SHBishopricPopup( 2, 'id_add_bishopric_popup' );">Cancel</a></span>
		<span class="aj-button02"><a href="javascript: void(0);" onclick="oWards.UplBishopricAvatar();">Add</a></span>
	</div>
</div>