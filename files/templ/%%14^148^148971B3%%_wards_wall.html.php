<?php /* Smarty version 2.6.11, created on 2014-08-22 15:54:29
         compiled from top_blocks/_wards_wall.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_select_date', 'top_blocks/_wards_wall.html', 86, false),array('modifier', 'date_format', 'top_blocks/_wards_wall.html', 91, false),)), $this); ?>
<!-- Ward's Message top box -->
<div class="top-box">
<table>
	<tr>
		<td class="top-left">
                    <div class="m-awatar">
                        <?php if ($this->_tpl_vars['ward_i']['im_member']): ?><a href="javascript: void(0);" onclick="javascript: oUsers.SHUplPopup(1, 'id_upl_wavatar_popup');"><?php endif; ?><div style="width: 100%; height: 100%;" ><img src="<?php if ($this->_tpl_vars['ward_i']['my_ward_stake_img']):  echo $this->_tpl_vars['fImgDir']; ?>
wards/info/<?php echo $this->_tpl_vars['ui']['fpath']; ?>
/a/a_<?php echo $this->_tpl_vars['ward_i']['my_ward_stake_img'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_ward.png<?php endif; ?>"   class="big_avatar"/></div><?php if ($this->_tpl_vars['ward_i']['im_member']): ?></a><?php endif; ?>
                    </div>
		</td>

		<?php if ($this->_tpl_vars['CAN_EDIT']): ?>
		<td class="top-center">
		<div id="id_send_block_mes" class="share cl_send_block">
		<form id="id_frm_add_mes" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
wards/id<?php echo $this->_tpl_vars['wid']; ?>
/wall/getedit" method="post">
			<div id="id_send_frm_mes">
			    <textarea id="id_send_inp_mes_story" name="WI[story]" maxlength="1000" onclick="if ('Share your thoughts' == this.value) this.value='';">Share your thoughts</textarea>
			</div>
                        <input id="id_add_mes_privacy" type="hidden" name="SI[privacy]" value="0" />
                        <input id="id_add_mes_sub_module" type="hidden" name="SI[sub_privacy_module]" value="0" />
                        <input id="id_add_mes_sub_module_val" type="hidden" name="SI[sub_privacy_module_val]" value="0" />
                        <input id="id_add_mes_sub_class" type="hidden" name="SI[sub_privacy_class]" value="0" />

                        <div id="id_place_to_attach" style="display: none;"></div>
		</form>
                        <div class="share-fix" id="id_main_btn_share"><a class="cl_a_btn_share" href="#"><img class="cl_img_btn_share" src="<?php echo $this->_tpl_vars['imgDir']; ?>
share_b.gif" alt="Share" /></a></div>
			<div id="id_uploaded_mes" class="share-icon">
				<a class="nav_attach_links" mtype="mes" style="cursor: pointer;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
plus_ico.png"  /></a>
				<a class="nav_attach_links" mtype="photo" style="cursor: pointer;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
photo_ico.gif"  />photo</a> &nbsp;
				<a class="nav_attach_links" mtype="video" style="cursor: pointer;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
video_ico.gif"  />video</a> &nbsp;
				<a class="nav_attach_links" mtype="ev" style="cursor: pointer;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
event_ico.gif"  />event</a> &nbsp;
				<a class="nav_attach_links" mtype="link" style="cursor: pointer;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
link_ico.gif"  />link</a> &nbsp;
                                <a class="nav_attach_links" mtype="badge" onclick="$('#id_send_badge_b_story').val('Enter badge text');$('#id_send_badge_b_story').css('color','#999999');$('#select_badge').attr('src','<?php echo $this->_tpl_vars['imgDir']; ?>
select_badge_ico.gif');$('#id_send_inp_badge_img_val').val(0);" style="cursor: pointer;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
badge_ico.gif" alt="" />badge</a> &nbsp;
                                <a class="nav_attach_smile" onclick="oWWall.AddSmileTab();" style="cursor: pointer;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
smile_main.gif" alt="" /></a>
 			</div>
                        <div id="show_smile_tab" class="smiley" style="display: none;">
                        <?php $this->assign('type_smile', 'board'); ?>
                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "top_blocks/_smile.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                        </div>

                        <div class="id_uploaded_block share-fix"><a class="cl_a_btn_share" href="javascript: void(0);" ><img class="cl_img_btn_share" src="<?php echo $this->_tpl_vars['imgDir']; ?>
share_b_act.gif"  /></a></div>
			<div id="id_uploaded_ev" class="share-icon cl_attached_block" style="display: none;">
				<img src="<?php echo $this->_tpl_vars['imgDir']; ?>
event_ico.gif"  class="id_uploaded_block_img"/> <label id="id_uploaded_ev_lable"></label>
			</div>
			<div id="id_uploaded_link" class="uploading cl_attached_block" style="display: none;">
				<ul>
					<li> <a id="id_uploaded_link_lable" href="#"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico_loader_ws.gif" class="id_uploaded_block_img" style="border: none; padding-top: 5px;" /></a></li>
				</ul>
			</div>
	      	      	<div id="id_uploaded_photo_url" class="uploading cl_attached_block" style="display: none;">
				<ul class="id_uploaded_image">
					<li><img id="id_img_photo_url" src="<?php echo $this->_tpl_vars['imgDir']; ?>
upload01.gif"  class="id_uploaded_block_img" style="max-width: 33px; max-height: 25px;" /> <a id="id_uploaded_photo_url_lable" target="_blank" href="#">Preview image</a></li>
				</ul>
			</div>
			<div id="id_uploaded_photo_choose_file" class="uploading cl_attached_block" style="display: none;">
				<ul id="id_ul_upl_photo">
					<!-- <li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
"  /> <a href="#">DSC102659.jpg</a></li> -->
				</ul>
			</div>
			<div id="id_uploaded_video_code" class="uploading cl_attached_block" style="display: none;">
				<ul class="id_uploaded_image">
					<li><img id="id_img_video_code" src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico_loader_ws.gif"  style="max-width: 33px; max-height: 25px;" /> <a style="cursor:default;" id="id_uploaded_video_code_lable" >Embedded video</a></li>
				</ul>
			</div>
			<div id="id_uploaded_video_choose_file" class="uploading cl_attached_block" style="display: none;">
				<ul>
					<li><img id="id_img_video_choose_file" src="<?php echo $this->_tpl_vars['imgDir']; ?>
upload01.gif"  style="max-width: 33px; max-height: 25px;" /> <a id="id_uploaded_video_choose_file_lable" href="#">Uploaded video</a></li>
				</ul>
			</div>
		</div>

		<div id="id_send_block_ev" class="share-white cl_send_block" style="visibility: hidden">
			<div class="share-white-box">
				<div class="share-white-title">
					<span><a class="nav_attach_links" mtype="mes" href="javascript: void(0);"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close_ico.gif"  /></a></span>
					<img src="<?php echo $this->_tpl_vars['imgDir']; ?>
event_ico.gif"  /> Add event
				</div>

				<div id="id_send_frm_ev" class="add-event" style="margin-top:-5px;padding-top:0px;">
				<input type="hidden" name="WI[mtype]" value="2" /><br />
				<table>
                    <tr><td align="right">Title:</td><td><input id="id_send_inp_ev_title" maxlength="30" class="txt" name="WI[ev_title]" style="height:18px;" type="text" value="" /></td></tr>
					<tr><td align="right">Where:</td><td><input id="id_send_inp_ev_where" maxlength="40"  class="txt" name="WI[ev_where]" style="height:18px;" type="text" value="" /></td></tr>
					<tr>
						<td align="right">Time:</td>
						<td>
							<h3 class="jNice"><span class="niceform"><?php echo smarty_function_html_select_date(array('month_extra' => "class='cl_ev_dt' size='1'",'display_years' => false,'display_days' => false), $this);?>
</span></h3>
							<h3 class="jNice"><span class="niceform"><?php echo smarty_function_html_select_date(array('day_extra' => "class='cl_ev_dt' size='1'",'display_years' => false,'display_months' => false), $this);?>
</span></h3>

		                    <h3 class="jNice"><span class="niceform"><input id="id_time_hour_min_meridian" size="1" class="txt" value="11:30 am" style="margin-left: 0px; width: 75px; margin-top: 1px; height:17px;" /></span></h3>

							<?php $this->assign('cur_year', ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y") : smarty_modifier_date_format($_tmp, "%Y"))); ?>
							<select class="cl_ev_dt" name="Date_Year" style="display: none;">
								<option selected="selected" value="<?php echo $this->_tpl_vars['cur_year']; ?>
"><?php echo $this->_tpl_vars['cur_year']; ?>
</option>
							</select>
							<input id="id_send_inp_ev_dt" type="hidden" name="WI[ev_dt]" value="" />
						</td>
					</tr>
				</table>
				</div>
                                <div class="share-white-b"">
				    <a href="javascript: void(0);" onclick="javascript: oWWall.AddEventButton()"><img id="add_event_button" src="<?php echo $this->_tpl_vars['imgDir']; ?>
add_b2.gif"  /></a>
				</div>

			</div>
		</div>

		<div id="id_send_block_link" class="share-white cl_send_block" style="visibility: hidden;">
			<div class="share-white-box">
				<div class="share-white-title">
					<span><a class="nav_attach_links" mtype="mes" href="javascript: void(0);"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close_ico.gif"  /></a></span>
					<img src="<?php echo $this->_tpl_vars['imgDir']; ?>
link_ico.gif"  /> Add link
				</div>
				<div id="id_send_frm_link" class="add-link">
					<input type="hidden" name="WI[mtype]" value="3" />
					<p><label>Enter the URL:</label> <br /><input id="id_send_inp_link_url" class="txt" name="WI[l_url]" type="text" value="" style="height:18px;" /></p>
				</div>
				<div class="share-white-b"><a href="javascript: void(0);" onclick="javascript: oWWall.AttachBlock( 'link' );"><img id="link_add_button" src="<?php echo $this->_tpl_vars['imgDir']; ?>
add_b2.gif"  /></a></div>
			</div>
		</div>

                <!--  Badge -->
                <div id="id_send_block_badge" class="share-white cl_send_block" style="visibility: hidden;">
                    <div class="share-white-box">
                        <div class="share-white-title">
                            <span><a class="nav_attach_links" mtype="mes" href="javascript: void(0);" onclick="$('#id_send_badge_b_story').val('Enter badge text');$('#id_send_badge_b_story').css('color','#999999');$('#select_badge').attr('src','<?php echo $this->_tpl_vars['imgDir']; ?>
select_badge_ico.gif');$('#id_send_inp_badge_img_val').val(0);"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close_ico.gif" alt="" /></a></span>
                            <img src="<?php echo $this->_tpl_vars['imgDir']; ?>
badge_ico.gif" alt="" /> Add badge
                        </div>

                        <div id="id_send_frm_badge" class="add-badge">
                         <!--form id="id_frm_badge_mes" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/wall/getedit" method="post"-->
                            <div id="id_send_frm_badge_mes">
                                <a href="javascript:void(0);" onclick="oWWall.AddBadgeTab();"><img id="select_badge" src="<?php echo $this->_tpl_vars['imgDir']; ?>
select_badge_ico.gif" style="width:70px; height:70px;" alt=""/></a>
                                <span><textarea id="id_send_badge_b_story" class="txt" name="WI[story]" maxlength="112" style="height:64px;" onclick="if ('Enter badge text' == this.value) this.value='';$('.txt').css('color','black');">Enter badge text</textarea></span>
                                <input id="id_send_inp_badge_img_val" type="hidden" name="WI[b_img_name]" value="0" />
                                <input id="id_send_inp_badge_sub_mtype" type="hidden" name="WI[sub_mtype]" value="1" />
                            </div>
                         <!--/form-->
                        </div>
                        <a class="nav_attach_smile" onclick="oWWall.AddSmileTab('badge');" style="cursor: pointer; float: right; margin-top:3px; margin-right: 90px;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
smile_main.gif" alt="" /></a>
                        <div class="share-white-b" style="margin-top:1px;"><a href="javascript: void(0);" onclick="javascript: oWWall.AttachBlock( 'badge' );"><img id="link_add_button" src="<?php echo $this->_tpl_vars['imgDir']; ?>
add_b2.gif" style="float:right;" alt="" /></a></div>
                    </div>

                    <div id="show_badge_tab" class="badge_tab" style="display: none;">
                    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "top_blocks/_badge.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                    </div>

                    <div id="show_smile_tab_badge" class="smiley" style="display: none;">
                        <?php $this->assign('type_smile', 'badge'); ?>
                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "top_blocks/_smile.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                    </div>

                </div>
                <!--  Badge  -->

		<div id="id_send_block_photo" class="share-white cl_send_block" style="visibility: hidden;">
			<div class="share-white-box">
				<div class="share-white-title">
					<span><a class="nav_attach_links" mtype="mes" href="javascript: void(0);"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close_ico.gif"  /></a></span>
					<img src="<?php echo $this->_tpl_vars['imgDir']; ?>
photo_ico.gif"  /> Add photo
				</div>
				<div class="grey-b">
					<a class="nav_attach_links" mtype="photo_choose_file" href="javascript: void(0);"><span>Upload photo</span>Upload photo from <br />your computer</a>
					<a class="nav_attach_links" mtype="photo_url" href="javascript: void(0);"><span>Enter photo URL</span>Enter the web address <br />of the photo</a>
				</div>
			</div>
		</div>

		<div id="id_send_block_photo_url" class="share-white cl_send_block" style="visibility: hidden;">
			<div class="share-white-box">
				<div class="share-white-title">
					<span><a class="nav_attach_links" mtype="mes" href="javascript: void(0);"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close_ico.gif"  /></a></span>
					<img src="<?php echo $this->_tpl_vars['imgDir']; ?>
photo_ico.gif"  /> Add photo
				</div>
				<div id="id_send_frm_photo_url" class="enter-photo">
                	<input type="hidden" name="WI[mtype]" value="4" />
                        <p><label>Enter photo URL:</label><br /><input style="height:18px;" id="id_send_inp_photo_url_link" class="txt" name="WI[p_url]" type="text" value="" style="height:18px;" /></p>
				</div>
				<div class="share-white-b"><a href="javascript: void(0);" onclick="javascript: oWWall.AttachBlock( 'photo_url' );"><img id="send_photo_link" src="<?php echo $this->_tpl_vars['imgDir']; ?>
add_b2.gif"  /></a></div>
			</div>
		</div>

		<div id="id_send_block_photo_choose_file" class="share-white cl_send_block" style="visibility: hidden;">
			<div class="cl_div_cover" style="display: none; background-color: gray; position: absolute; z-index:1500; width: 100%; height: 100%;" ></div>
			<div class="share-white-box">
				<div class="share-white-title">
					<span><a class="nav_attach_links" mtype="mes" href="javascript: void(0);"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close_ico.gif"  /></a></span>
					<span style="float:left; padding-right: 10px;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
photo_ico.gif"  /> <b>Add photo:</b> Please select up to 3 photos and press "Add" </span><div style="display:inline;" id="ufy_plch"></div>
				</div>
				<div id="id_send_frm_photo_choose_file" class="upload-photo" style="margin-top: -15px;">
				<form id="form1" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['wid']; ?>
/wall/chkuplphoto" method="post" enctype="multipart/form-data">

                                  	<input type="hidden" name="WI[mtype]" value="4" />
                                       <div id="ufy_plch_list"></div>
				
                                         <input id="id_btn_photo_upload" type="button" value="Start Upload" onclick="javascript: oUplPhoto.startUpload();" style="margin-left: 2px; font-size: 8pt; height: 29px; display: none;" />

					<!-- <input type="submit" value="Choose File" /></p> -->
									</form>
				</div>
				<div class="share-white-b"><a href="javascript: void(0);" onclick="javascript: oWWall.UplPhoto( 'photo_choose_file' );"><img id="ufy_block_ab" src="<?php echo $this->_tpl_vars['imgDir']; ?>
add_b2.gif"  /></a></div>
			</div>
		</div>

		<div id="id_send_block_video" class="share-white cl_send_block" style="visibility: hidden;">
			<div class="share-white-box">
				<div class="share-white-title">
					<span><a class="nav_attach_links" mtype="mes" href="javascript: void(0);"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close_ico.gif"  /></a></span>
					<img src="<?php echo $this->_tpl_vars['imgDir']; ?>
video_ico.gif"  /> Add video
				</div>
				<div class="grey-b">
										<a class="nav_attach_links" mtype="video_code" href="javascript: void(0);"><span>Embed code</span>Paste code from sites <br />like Youtbe, Vimeo</a>
				</div>
			</div>
		</div>

		<div id="id_send_block_video_code" class="share-white cl_send_block" style="visibility: hidden;">
			<div class="share-white-box">
				<div class="share-white-title">
					<span><a class="nav_attach_links" mtype="mes" href="javascript: void(0);"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close_ico.gif"  /></a></span>
					<img src="<?php echo $this->_tpl_vars['imgDir']; ?>
video_ico.gif"  /> Add video
				</div>
				<div id="id_send_frm_video_code" class="paste-video">
					<input type="hidden" name="WI[mtype]" value="5" />
					<p><label>Paste video embed code:</label> <textarea id="id_send_txt_video_code_link" name="WI[v_code]" class="txt"></textarea></p>
					<input id="id_send_inp_video_code_link" type="hidden" name="WI[v_code]" value="" />
				</div>
				<div class="share-white-b">
					<a href="javascript: void(0);" onclick="javascript: oWWall.AttachBlock( 'video_code' );">
						<img id="send_video_code" src="<?php echo $this->_tpl_vars['imgDir']; ?>
add_b2.gif"  /></a>
				</div>
			</div>
		</div>

		<div id="id_send_block_video_choose_file" class="share-white cl_send_block" style="visibility: hidden;">
			<div class="share-white-box">
				<div class="share-white-title">
					<span><a class="nav_attach_links" mtype="mes" href="javascript: void(0);"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close_ico.gif"  /></a></span>
					<img src="<?php echo $this->_tpl_vars['imgDir']; ?>
video_ico.gif"  /> Add video
				</div>
				<div class="upload-photo">
					<div id="stat" style="font-size:12px; padding:8px;"></div>

					<p><label>Upload video from your computer:</label>

					<form action="" id="id_frm_video_upl" name="form" target="yt_frame" method="post" enctype="multipart/form-data">
					    <input type="hidden" id="token" name="token" value="" />
					    <input type="file" name="file1" onselect="" id="file1" value="Choose File" />
				    </form>
					<iframe name="yt_frame" id="yt_frame" style="display: none;" onload=""></iframe>
										<p><span>no file selected</span></p>
					<ul style="display: none;">
						<li>baby.mov <a href="#">Remove</a></li>
					</ul>
				</div>
				<div id="id_send_frm_video_choose_file" class="upload-photo">
					<input type="hidden" name="WI[mtype]" value="5" />
				    <input id="id_send_inp_video_choose_file_v_unid" name="WI[v_file]" type="hidden" value="" />
				</div>
				<div class="share-white-b"><a id="id_btn_video_upl" href="javascript: void(0);" onclick="oWWall.GetYTToken();"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
add_b2.gif"  /></a></div>
			</div>
		</div>

		<div class="share-tools">
			<div id="id_share_attention" class="share-attention" style="display: none;">
				You've exceeded the 1000 characters limit for an entry.
			</div>
                        <div id="id_share_attention_badge" class="share-attention" style="display: none;">
				You've exceeded the 112 characters limit for an entry.
                        </div>

			
			<div id="id_share_with">
				Share with &nbsp;<img src="<?php echo $this->_tpl_vars['imgDir']; ?>
user_ico01.gif"  />
				<a id="id_a_share_with" href="javascript: void(0);" class="open-drop02" onclick="javascript: $('#id_smenu_sharewith').slideToggle('fast');" ><?php if ($this->_tpl_vars['UserInfo']['ward_id']): ?>my ward<?php else: ?>my stake<?php endif; ?></a> <img src="<?php echo $this->_tpl_vars['imgDir']; ?>
arr02.gif"  onclick="javascript: $('#id_smenu_sharewith').slideToggle('fast');"  />
				<span style="float:right;" id="hspan""></span>
			</div>

			<div id="id_smenu_sharewith" class="everyone" style="display: none;">
				<div class="everyone-top">&nbsp;</div>
				<div class="everyone-bot">
						<ul>
							<li class="grey">
								<img src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico01ward.png"  />
								<a class="cl_a_share_with" href="javascript: void(0);" ptype="0">my ward</a>
								<ul id="id_ssmenu_0" class="cl_ssmenu" style="display: none;">
																		<li><a class="cl_wsub_menu" parent="my ward" href="javascript: void(0);" submodule_val="1" submodule="priesthood">aaronic priesthood</a></li>
									<li><a class="cl_wsub_menu" parent="my ward" href="javascript: void(0);" submodule_val="2" submodule="priesthood">young man</a></li>
									<li><a class="cl_wsub_menu" parent="my ward" href="javascript: void(0);" submodule_val="12" submodule="priesthood">young woman</a></li>
									<li><a class="cl_wsub_menu" parent="my ward" href="javascript: void(0);" submodule_val="4" submodule="priesthood">melchizedek priesthood</a></li>
                                                                        <li><a class="cl_wsub_menu" parent="my ward" href="javascript: void(0);" submodule_val="7" submodule="priesthood">high priest</a></li>
		                                                        
                                                                        <!--<?php if ($this->_tpl_vars['UserInfo']['priesthood']): ?><li><a class="cl_wsub_menu" parent="my ward" href="javascript: void(0);" submodule_val="<?php echo $this->_tpl_vars['UserInfo']['priesthood']; ?>
" submodule="priesthood">same class</a></li><?php endif; ?>-->
                                                                        <?php if ($this->_tpl_vars['cnt_uclasses']): ?><hr color ="#dcdcdc" style="width:100%; height: 1px; margin:2px;" />
                                                                        <?php $_from = $this->_tpl_vars['uclasses']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                                                        <li><a class="cl_wsub_menu" parent="my ward" href="javascript: void(0);" submodule_val="5" submodule="priesthood" submodule_class="<?php echo $this->_tpl_vars['item']['class_id']; ?>
"><?php echo $this->_tpl_vars['item']['title']; ?>
</a></li>
                                                                        <?php endforeach; endif; unset($_from); ?>
                                                                        <?php endif; ?>
                                                                       
								</ul>
							</li>
							<li>
								<img src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico02ward.png"  />
								<a class="cl_a_share_with" href="javascript: void(0);" ptype="1">my stake</a>
								<ul id="id_ssmenu_1" class="cl_ssmenu" style="display: none;">
																		<li><a class="cl_wsub_menu" parent="my stake" href="javascript: void(0);" submodule_val="1" submodule="priesthood">aaronic priesthood</a></li>
									<li><a class="cl_wsub_menu" parent="my stake" href="javascript: void(0);" submodule_val="2" submodule="priesthood">young man</a></li>
									<li><a class="cl_wsub_menu" parent="my stake" href="javascript: void(0);" submodule_val="12" submodule="priesthood">young woman</a></li>
									<li><a class="cl_wsub_menu" parent="my stake" href="javascript: void(0);" submodule_val="4" submodule="priesthood">melchizedek priesthood</a></li>
                                                                        <li><a class="cl_wsub_menu" parent="my stake" href="javascript: void(0);" submodule_val="7" submodule="priesthood">high priest</a></li>

                                                                        <?php if ($this->_tpl_vars['cnt_uclasses'] != 0): ?><hr color ="#dcdcdc" style="width:100%; height: 1px; margin:2px;" />
                                                                        <?php $_from = $this->_tpl_vars['uclasses']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                                                        <li><a class="cl_wsub_menu" parent="my ward" href="javascript: void(0);" submodule_val="5" submodule="priesthood" submodule_class="<?php echo $this->_tpl_vars['item']['class_id']; ?>
"><?php echo $this->_tpl_vars['item']['title']; ?>
</a></li>
                                                                        <?php endforeach; endif; unset($_from); ?>
                                                                        <?php endif; ?>
                                                                        
	 							</ul>
							</li>

													</ul>
				</div>
			</div>
		</div>
		</td>

		<td class="top-right">
		    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "top_blocks/_notify_mini.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</td>
		<?php else: ?>
		<td class="ward-header-info"><br />
			<p id="ward-header-info-stake"><?php if (! empty ( $this->_tpl_vars['ward_i']['id_parent'] )):  echo $this->_tpl_vars['ward_i']['ward_title'];  else:  echo $this->_tpl_vars['ward_i']['title'];  endif; ?></p>
			<p id="ward-header-info-ward"><?php if (! empty ( $this->_tpl_vars['ward_i']['id_parent'] )):  echo $this->_tpl_vars['ward_i']['title'];  endif; ?></p>
			<?php if ($this->_tpl_vars['ward_i']['ucnt']): ?><p id="ward-header-info-ucnt"><?php echo $this->_tpl_vars['ward_i']['ucnt']; ?>
</p><?php endif; ?>
			<p id="ward-header-info-country"><?php echo $this->_tpl_vars['ward_i']['country'];  if ($this->_tpl_vars['ward_i']['region']): ?>, <?php echo $this->_tpl_vars['ward_i']['region'];  endif; ?>, <?php echo $this->_tpl_vars['ward_i']['city']; ?>
</p>
                        <?php if ($this->_tpl_vars['ward_i']['more']): ?><p id="ward-header-info-adress"><?php echo $this->_tpl_vars['ward_i']['more']; ?>
</p><?php endif; ?>
		</td>
		<td></td>
		<?php endif; ?>

	</tr>
</table>
</div>
<!-- Ward's Message top box -->