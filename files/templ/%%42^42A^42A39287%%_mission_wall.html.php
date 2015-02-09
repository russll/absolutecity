<?php /* Smarty version 2.6.11, created on 2014-04-23 21:04:56
         compiled from top_blocks/_mission_wall.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_select_date', 'top_blocks/_mission_wall.html', 87, false),array('modifier', 'date_format', 'top_blocks/_mission_wall.html', 92, false),)), $this); ?>

<!-- Mission's Message top box -->
<div class="top-box">
<table>
	<tr>
		<td class="top-left">
		    <div class="m-awatar<?php if (! ( $this->_tpl_vars['CAN_EDIT'] && $this->_tpl_vars['IS_USER'] )): ?> no_cursor<?php endif; ?>" <?php if ($this->_tpl_vars['CAN_EDIT'] && $this->_tpl_vars['IS_USER']): ?> onclick="oMission.SHUplPopup(1, 'id_upl_mavatar_popup');" <?php endif; ?>>
		        <div style="width: 100%; height: 100%;">
			    <img src="<?php if ($this->_tpl_vars['mission_i']['is_mine']['mission_img']):  echo $this->_tpl_vars['fImgDir']; ?>
mission/info/<?php echo $this->_tpl_vars['ui']['fpath']; ?>
/a/a_<?php echo $this->_tpl_vars['mission_i']['is_mine']['mission_img'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_ward.png<?php endif; ?>" alt=""  class="big_avatar"/>
                        </div>
	            </div>
		</td>

		<?php if ($this->_tpl_vars['CAN_EDIT']): ?>
		<td class="top-center">

		<div id="id_send_block_mes" class="share cl_send_block">
		<form id="id_frm_add_mes" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
mission/id<?php echo $this->_tpl_vars['mission_id']; ?>
/wall/getedit" method="post">
			<div id="id_send_frm_mes">
				<textarea id="id_send_inp_mes_story" name="WI[story]" maxlength="1000" onclick="if ('Share your thoughts' == this.value) this.value='';">Share your thoughts</textarea>
			</div>
			<div id="id_place_to_attach" style="display: none;">
			</div>
		</form>
                        <div class="share-fix" id="id_main_btn_share"><a class="cl_a_btn_share" href="#"><img class="cl_img_btn_share" src="<?php echo $this->_tpl_vars['imgDir']; ?>
share_b.gif" alt="Share" /></a></div>
			<div id="id_uploaded_mes" class="share-icon">
				<a class="nav_attach_links" mtype="mes" style="cursor: pointer;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
plus_ico.png" alt="" /></a>
				<a class="nav_attach_links" mtype="photo" style="cursor: pointer;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
photo_ico.gif" alt="" />photo</a> &nbsp;
				<a class="nav_attach_links" mtype="video" style="cursor: pointer;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
video_ico.gif" alt="" />video</a> &nbsp;
								<a class="nav_attach_links" mtype="link" style="cursor: pointer;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
link_ico.gif" alt="" />link</a> &nbsp;
                                <a class="nav_attach_links" mtype="badge" onclick="$('#id_send_badge_b_story').val('Enter badge text');$('#id_send_badge_b_story').css('color','#999999');$('#select_badge').attr('src','<?php echo $this->_tpl_vars['imgDir']; ?>
select_badge_ico.gif');$('#id_send_inp_badge_img_val').val(0);" style="cursor: pointer;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
badge_ico.gif" alt="" />badge</a> &nbsp;
                                <a class="nav_attach_smile" onclick="oMWall.AddSmileTab();" style="cursor: pointer;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
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
share_b_act.gif" alt="" /></a></div>

                        <div id="id_uploaded_ev" class="share-icon cl_attached_block" style="display: none;">
				<img src="<?php echo $this->_tpl_vars['imgDir']; ?>
event_ico.gif" alt="" /> <label id="id_uploaded_ev_lable"></label>
			</div>
			<div id="id_uploaded_link" class="uploading cl_attached_block" style="display: none;">
				<ul>
					<li> <a id="id_uploaded_link_lable" href="#"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico_loader_ws.gif" style="border: none; padding-top: 5px;" /></a></li>
				</ul>
			</div>
	            	<div id="id_uploaded_photo_url" class="uploading cl_attached_block" style="display: none;">
				<ul>
					<li><img id="id_img_photo_url" src="<?php echo $this->_tpl_vars['imgDir']; ?>
upload01.gif" alt="" style="max-width: 33px; max-height: 25px;" /> <a id="id_uploaded_photo_url_lable" target="_blank" href="#">Preview image</a></li>
				</ul>
			</div>
			<div id="id_uploaded_photo_choose_file" class="uploading cl_attached_block" style="display: none;">
				<ul id="id_ul_upl_photo">
					<!-- <li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
" alt="" /> <a href="#">DSC102659.jpg</a></li> -->
				</ul>
			</div>
			<div id="id_uploaded_video_code" class="uploading cl_attached_block" style="display: none;">
				<ul>
					<li><img id="id_img_video_code" src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico_loader_ws.gif" alt="" style="max-width: 33px; max-height: 25px;" /> <a id="id_uploaded_video_code_lable" href="#">Embedded video</a></li>
				</ul>
			</div>
			<div id="id_uploaded_video_choose_file" class="uploading cl_attached_block" style="display: none;">
				<ul>
					<li><img id="id_img_video_choose_file" src="<?php echo $this->_tpl_vars['imgDir']; ?>
upload01.gif" alt="" style="max-width: 33px; max-height: 25px;" /> <a id="id_uploaded_video_choose_file_lable" href="#">Uploaded video</a></li>
				</ul>
			</div>
		</div>

		<div id="id_send_block_ev" class="share-white cl_send_block" style="visibility: hidden">
			<div class="share-white-box">
				<div class="share-white-title">
					<span><a class="nav_attach_links" mtype="mes" href="javascript: void(0);"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close_ico.gif" alt="" /></a></span>
					<img src="<?php echo $this->_tpl_vars['imgDir']; ?>
event_ico.gif" alt="" /> Add event
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
                                <div class="share-white-b">
				    <a href="javascript: void(0);" onclick="oMWall.AddEventButton()"><img id="add_event_button" src="<?php echo $this->_tpl_vars['imgDir']; ?>
add_b2.gif" alt="" /></a>
				</div>

			</div>
		</div>

		<div id="id_send_block_link" class="share-white cl_send_block" style="visibility: hidden;">
			<div class="share-white-box">
				<div class="share-white-title">
					<span><a class="nav_attach_links" mtype="mes" href="javascript: void(0);"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close_ico.gif" alt="" /></a></span>
					<img src="<?php echo $this->_tpl_vars['imgDir']; ?>
link_ico.gif" alt="" /> Add link
				</div>
				<div id="id_send_frm_link" class="add-link">
					<input type="hidden" name="WI[mtype]" value="3" />
					<p><label>Enter the URL:</label> <br /><input id="id_send_inp_link_url" class="txt" name="WI[l_url]" type="text" value="" style="height:18px;" /></p>
				</div>
				<div class="share-white-b"><a href="javascript: void(0);" onclick="oMWall.AttachBlock( 'link' );"><img id="link_add_button" src="<?php echo $this->_tpl_vars['imgDir']; ?>
add_b2.gif" alt="" /></a></div>
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
                                <a href="javascript:void(0);" onclick="oMWall.AddBadgeTab();"><img id="select_badge" src="<?php echo $this->_tpl_vars['imgDir']; ?>
select_badge_ico.gif" style="width:70px; height:70px;" alt=""/></a>
                                <span><textarea id="id_send_badge_b_story" class="txt" name="WI[story]" maxlength="112" style="height:64px;" onclick="if ('Enter badge text' == this.value) this.value='';$('.txt').css('color','black');">Enter badge text</textarea></span>
                                <input id="id_send_inp_badge_img_val" type="hidden" name="WI[b_img_name]" value="0" />
                                <input id="id_send_inp_badge_sub_mtype" type="hidden" name="WI[sub_mtype]" value="1" />
                            </div>
                         <!--/form-->
                        </div>
                        <a class="nav_attach_smile" onclick="oMWall.AddSmileTab('badge');" style="cursor: pointer; float: right; margin-top:3px; margin-right: 90px;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
smile_main.gif" alt="" /></a>
                        <div class="share-white-b" style="margin-top:1px;"><a href="javascript: void(0);" onclick="javascript: oMWall.AttachBlock( 'badge' );"><img id="link_add_button" src="<?php echo $this->_tpl_vars['imgDir']; ?>
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
close_ico.gif" alt="" /></a></span>
					<img src="<?php echo $this->_tpl_vars['imgDir']; ?>
photo_ico.gif" alt="" /> Add photo
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
close_ico.gif" alt="" /></a></span>
					<img src="<?php echo $this->_tpl_vars['imgDir']; ?>
photo_ico.gif" alt="" /> Add photo
				</div>
				<div id="id_send_frm_photo_url" class="enter-photo">
                	<input type="hidden" name="WI[mtype]" value="4" />
					<p><label>Enter photo URL:</label><br /><input style="height:18px;" id="id_send_inp_photo_url_link" class="txt" name="WI[p_url]" type="text" value="" /></p>
				</div>
				<div class="share-white-b"><a href="javascript: void(0);" onclick="oMWall.AttachBlock( 'photo_url' );"><img id="send_photo_link" src="<?php echo $this->_tpl_vars['imgDir']; ?>
add_b2.gif" alt="" /></a></div>
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
id<?php echo $this->_tpl_vars['mission_id']; ?>
/wall/chkuplphoto" method="post" enctype="multipart/form-data">

                                    <input type="hidden" name="WI[mtype]" value="4" />
                                    <div id="ufy_plch_list"></div>
				 
					<!-- <input type="submit" value="Choose File" /></p> -->
									</form>
				</div>
				<div class="share-white-b"><a href="javascript: void(0);" onclick="oMWall.UplPhoto( 'photo_choose_file' );"><img  id="ufy_block_ab" src="<?php echo $this->_tpl_vars['imgDir']; ?>
add_b2.gif" alt="" /></a></div>
			</div>
		</div>

		<div id="id_send_block_video" class="share-white cl_send_block" style="visibility: hidden;">
			<div class="share-white-box">
				<div class="share-white-title">
					<span><a class="nav_attach_links" mtype="mes" href="javascript: void(0);"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close_ico.gif" alt="" /></a></span>
					<img src="<?php echo $this->_tpl_vars['imgDir']; ?>
video_ico.gif" alt="" /> Add video
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
close_ico.gif" alt="" /></a></span>
					<img src="<?php echo $this->_tpl_vars['imgDir']; ?>
video_ico.gif" alt="" /> Add video
				</div>
				<div id="id_send_frm_video_code" class="paste-video">
					<input type="hidden" name="WI[mtype]" value="5" />
					<p><label>Paste video embed code:</label> <textarea id="id_send_txt_video_code_link" name="WI[v_code]" class="txt"></textarea></p>
					<input id="id_send_inp_video_code_link" type="hidden" name="WI[v_code]" value="" />
				</div>
				<div class="share-white-b">
					<a href="javascript: void(0);" onclick="oMWall.AttachBlock( 'video_code' );">
						<img id="send_video_code" src="<?php echo $this->_tpl_vars['imgDir']; ?>
add_b2.gif" alt="" />
					</a>
				</div>
			</div>
		</div>

		<div id="id_send_block_video_choose_file" class="share-white cl_send_block" style="visibility: hidden;">
			<div class="share-white-box">
				<div class="share-white-title">
					<span><a class="nav_attach_links" mtype="mes" href="javascript: void(0);"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close_ico.gif" alt="" /></a></span>
					<img src="<?php echo $this->_tpl_vars['imgDir']; ?>
video_ico.gif" alt="" /> Add video
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
				<div class="share-white-b"><a id="id_btn_video_upl" href="javascript: void(0);" onclick="oMWall.GetYTToken();"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
add_b2.gif" alt="" /></a></div>
			</div>
		</div>

		<div class="share-tools">
			<div id="id_share_attention" class="share-attention" style="display: none;">
				You've exceeded the 1000 characters limit for an entry.
			</div>
                        <div id="id_share_attention_badge" class="share-attention" style="display: none;">
				You've exceeded the 112 characters limit for an entry.
                        </div>

			<div id="id_smenu_sharewith" class="everyone" style="display: none;" >
				<div class="everyone-top">&nbsp;</div>
				<div class="everyone-bot">
						<ul>
							<li class="grey"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico02.png" alt="" /><a class="cl_a_share_with" href="javascript: void(0);" onclick="$('#id_add_mes_privacy').val('0'); $('#id_smenu_sharewith').hide();" ptype="0">everyone</a></li>
							<li class="grey"><p><input type="text" value="except these people..." onclick="this.value='';" /></p></li>
							<li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico03.png" alt="" /><a class="cl_a_share_with" href="javascript: void(0);" ptype="1">friends and followers</a></li>
							<li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico04.png" alt="" /><a class="cl_a_share_with" href="javascript: void(0);" ptype="2">only friends</a></li>
							<li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico05.png" alt="" /><a class="cl_a_share_with" href="javascript: void(0);" ptype="3">only family</a></li>
							<li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico06.png" alt="" /><a class="cl_a_share_with" href="javascript: void(0);" ptype="4">only...</a></li>
							<li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico07.png" alt="" /><a class="cl_a_share_with" href="javascript: void(0);" ptype="5">private <?php if ($this->_tpl_vars['IS_USER']):  endif; ?></a></li>
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
			<p id="ward-header-info-stake"><?php echo $this->_tpl_vars['mission_i']['title']; ?>
</p>
			<?php if ($this->_tpl_vars['mission_i']['ucnt']): ?><p id="ward-header-info-ucnt">Served mission: <?php echo $this->_tpl_vars['mission_i']['ucnt']; ?>
</p><?php endif; ?>
		</td>
		<td></td>
		<?php endif; ?>

	</tr>
</table>
</div>
<!-- Mission's Message top box -->