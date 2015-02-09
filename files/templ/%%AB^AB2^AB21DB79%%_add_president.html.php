<?php /* Smarty version 2.6.11, created on 2014-04-23 21:04:56
         compiled from mods/_popups/_add_president.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'mods/_popups/_add_president.html', 16, false),)), $this); ?>
												
<div id="id_add_president_popup" class="aj-box02" style="display: none; position: fixed; z-index: 3333; top: 25%; height: 300px;">
	<div class="aj-close"><a href="javascript: void(0);" onclick="oMission.SHPresidentPopup( 2, 'id_add_president_popup' );"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close_ico.gif"  /></a></div>
	<div class="aj-box02-title">
		<h2>Suggest President's info</h2>
		<p>All fields are optional, please enter verified info only </p>
	</div>

	<form id="id_frm_add_president" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
mission/id<?php echo $this->_tpl_vars['mission_i']['id']; ?>
/editpresident" enctype="multipart/form-data" method="post">
		<div class="add-album-form" style="height: 180px;">

			<table>
				<tr>
					<td>
						<p><label>Photo</label></p>
							<input type="hidden" name="mission_id" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['mission_i']['id'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
" />
						<p><img id="id_img_upl_president" src="<?php if ($this->_tpl_vars['mission_i']['is_mine']['pr_p_img']): ?> <?php echo $this->_tpl_vars['fImgDir']; ?>
mission/info/president/<?php echo $this->_tpl_vars['mission_i']['is_mine']['pr_p_img']; ?>
 <?php else: ?> <?php echo $this->_tpl_vars['imgDir']; ?>
no_photo.gif <?php endif; ?>" onclick="$('#id_span_upl_president').click();" style="max-width: 100px; max-height: 100px;" /></p>
						<p style="position: relative;">
							<div id="pr_upl" style="width:100px;background-image: url('/i/upl_aphoto_100.gif'); cursor:pointer;">
<!--								<input type="file" onchange="alert('File selected! It will be uploaded, when you submit changes.')" style="opacity:0; width:100px; height:17px; cursor:pointer;margin-left:-150px;" id="id_link_upl_president" name="president_p_img" />-->
							</div>
							<input type="hidden" id="president_p_img_hi" name="president_p_img" value="" />
							<ul id="sphotos_list" style="display:none;" />

							
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
								<td style="width: 50%"><p><input id="id_mis_pres_first_name" name="AI[first_name]" type="text" value="<?php echo $this->_tpl_vars['mission_i']['is_mine']['pr_first_name']; ?>
" style="width: 90%;" /></p></td>
								<td><p><input id="id_mis_pres_last_name" name="AI[last_name]" type="text" value="<?php echo $this->_tpl_vars['mission_i']['is_mine']['pr_last_name']; ?>
" style="width: 90%;" /></p></td>
							</tr>
						</table>
						<p><label>Phone nr</label> <input class="keyfilter_phone" id="id_mis_pres_phone" name="AI[phone]" type="text" value="<?php echo $this->_tpl_vars['mission_i']['is_mine']['pr_phone']; ?>
" style="width: 50%;" /></p>
						<p><label>Email</label> <input class="mask-email" id="id_mis_pres_email" name="AI[email]" type="text" value="<?php echo $this->_tpl_vars['mission_i']['is_mine']['pr_email']; ?>
" style="width: 50%;" /></p>
					</td>
				</tr>
			</table>
			<div class="upload-photo" style="float: left;">
				<ol id="id_pava_upl_pr_ol" style="display: none;">
					<!-- <li>DSC102659.jpg <a href="#">Remove</a></li> -->
				</ol>
			</div>
		</div>
	</form>
	<div class="aj-button" style="margin-top: 0px; padding-top: 0px;">
		<span class="aj-button01"><a href="javascript: void(0);" onclick="oMission.SHPresidentPopup( 2, 'id_add_president_popup' );">Cancel</a></span>
		<span class="aj-button02"><a href="javascript: void(0);" onclick="oMission.UplPresidentAvatar();">Add</a></span>
	</div>
</div>