<?php /* Smarty version 2.6.11, created on 2014-03-15 09:09:58
         compiled from mods/inbox/_editor_inbox.html */ ?>
                <div id="id_inb_top_mes_menu" class="write" style="display: block;">
                      <div id="id_send_block_mes" class="share-icon cl_send_block" style="display:block;">
                        <form id="id_frm_add_mes" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
inbox/getedit" method="post">
                            <div id="id_send_frm_mes" style="min-height:100px !important;">
                                <textarea id="id_send_inp_mes_story" name="WI[story]" class="he_editor he_show" style="display: none;visibility: hidden; width: 500px;height: 100px;" ></textarea>
                            </div>
                            <div id="id_place_to_attach" style="display: none;"></div>
                            <input id="id_add_mes_user_id" type="hidden" name="SI[user_id]" value="<?php echo $this->_tpl_vars['fr_info']['uid']; ?>
" />
                            <input id="id_add_mes_privacy" type="hidden" name="SI[privacy]" value="0" />
                            <input id="id_add_mes_sub_module" type="hidden" name="SI[sub_privacy_module]" value="0" />
                            <input id="id_add_mes_sub_module_val" type="hidden" name="SI[sub_privacy_module_val]" value="0" />
                            <input type="hidden" id="v_code" name="WI[v_code]" value="" />
                        </form>

                         <div id="show_smile_tab" class="smiley" style="display:none; margin-top: -105px;">
                            <?php $this->assign('type_smile', 'inbox'); ?>
                            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "top_blocks/_smile.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                         </div>

                        <div id="id_uploaded_mes" class="cl_attached_block">
                            <span><a class="cl_a_btn_share" href=""><img class="cl_img_btn_share" src="<?php echo $this->_tpl_vars['imgDir']; ?>
share_b.gif" alt="Share" /></a></span>
                        </div>

                        <div id="id_uploaded_link" class="uploading cl_attached_block" style="display: none;">
                            <span style="margin-top: -12px;"><a class="cl_a_btn_share" href="javascript: void(0);" style="color:black;"><img class="cl_img_btn_share" src="<?php echo $this->_tpl_vars['imgDir']; ?>
share_b_act.gif"  /></a></span>
                            <ul class="cl_j_uploaded_block2">
                                <li style="margin-top: -12px;"> <a id="id_uploaded_link_lable" href="javascript:void(0);" style="color:black;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico_loader_ws.gif" style="border: none; padding-top: 5px;" /></a></li>
                            </ul>
                        </div>
                        <div id="id_uploaded_photo_url" class="uploading cl_attached_block" style="display: none;">
                            <span style="margin-top: -12px;"><a class="cl_a_btn_share" href="javascript: void(0);" ><img class="cl_img_btn_share" src="<?php echo $this->_tpl_vars['imgDir']; ?>
share_b_act.gif"  /></a></span>
                            <ul class="cl_j_uploaded_block">
                                <li style="margin-top: -12px;"><img id="id_img_photo_url" src=""  style="max-width: 33px; max-height: 25px;" /> <a id="id_uploaded_photo_url_lable" target="_blank" href="javascript:void(0);" style="color:black;">Preview image</a></li>
                            </ul>
                        </div>
                        <div id="id_uploaded_photo_choose_file" class="uploading cl_attached_block" style="display: none;">
                            <span style="margin-top: -12px;"><a class="cl_a_btn_share" href="javascript: void(0);"><img class="cl_img_btn_share" src="<?php echo $this->_tpl_vars['imgDir']; ?>
share_b_act.gif"  /></a></span>
                            <ul id="id_ul_upl_photo" class="cl_j_uploaded_block"></ul>
                        </div>
                        <div id="id_uploaded_video_code" class="uploading cl_attached_block" style="display: none;">
                            <span style="margin-top: -12px;"><a class="cl_a_btn_share" href="javascript: void(0);" style="color:black;"><img class="cl_img_btn_share" src="<?php echo $this->_tpl_vars['imgDir']; ?>
share_b_act.gif"  /></a></span>
                            <ul class="cl_j_uploaded_block">
                                <li style="margin-top: -12px;"><img id="id_img_video_code" src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico_loader_ws.gif"  style="max-width: 33px; max-height: 25px;" /> <a id="id_uploaded_video_code_lable" href="javascript:void(0);" style="color:black;">Embedded video</a></li>
                            </ul>
                        </div>

                        <div id="id_uploaded_video_choose_file" class="uploading cl_attached_block" style="display: none;">
                            <span style="margin-top: -12px;"><a class="cl_a_btn_share" href="javascript: void(0);" style="color:black;"><img class="cl_img_btn_share" src="<?php echo $this->_tpl_vars['imgDir']; ?>
share_b_act.gif"  /></a></span>
                            <ul class="cl_j_uploaded_block">
                                <li style="margin-top: -12px;"><img id="id_img_video_choose_file" src="<?php echo $this->_tpl_vars['imgDir']; ?>
upload01.gif"  style="max-width: 33px; max-height: 25px;" /> <a id="id_uploaded_video_choose_file_lable" href="javascript:void(0);" style="color:black;">Uploaded video </a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                    <div id="id_send_block_link" class="share-white cl_send_block" style="visibility: hidden; margin:-165px 0 20px 6px;">
                        <div class="share-white-box inbox-sb">
                            <div class="share-white-title">
                                <span><a class="___nav_attach_links" onclick="oIWall.CloseButton();" mtype="mes" href="javascript: void(0);"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close_ico.gif"  /></a></span>
                                <img src="<?php echo $this->_tpl_vars['imgDir']; ?>
link_ico.gif"  /> Add link
                            </div>
                            <div id="id_send_frm_link" class="add-link">
                                <input type="hidden" name="WI[mtype]" value="3" />
                                <p><label>Enter the URL:</label> <br /><input id="id_send_inp_link_url" class="txt" name="WI[l_url]" type="text" value="" style="height:18px;" /></p>
                            </div>
                            <div class="share-white-b" style="padding-right: 10px; height:8px !important;"><a href="javascript: void(0);" onclick="javascript: oIWall.AttachBlock( 'link' );"><img id="link_add_button" src="<?php echo $this->_tpl_vars['imgDir']; ?>
add_b2.gif"  /></a></div>
                        </div>
                    </div>

                    <div id="id_send_block_photo" class="share-white cl_send_block" style="visibility: hidden; margin:-165px 0 20px 6px;">
                        <div class="share-white-box inbox-sb">
                            <div class="share-white-title">
                                <span><a class="___nav_attach_links" onclick="oIWall.CloseButton();" mtype="mes" href="javascript: void(0);"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
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

                    <div id="id_send_block_photo_url" class="share-white cl_send_block" style="visibility: hidden; margin:-165px 0 20px 6px;">
                        <div class="share-white-box inbox-sb">
                            <div class="share-white-title">
                                <span><a class="___nav_attach_links" onclick="oIWall.CloseButton();" mtype="mes" href="javascript: void(0);"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close_ico.gif"  /></a></span>
                                <img src="<?php echo $this->_tpl_vars['imgDir']; ?>
photo_ico.gif"  /> Add photo
                            </div>
                            <div id="id_send_frm_photo_url" class="enter-photo">
                                <input type="hidden" name="WI[mtype]" value="4" />
                                <p><label>Enter photo URL:</label><br /><input style="height:18px;" id="id_send_inp_photo_url_link" class="txt" name="WI[p_url]" type="text" value="" /></p>
                            </div>
                            <div class="share-white-b" style="padding-right: 10px; height:8px !important;"><a href="javascript: void(0);" onclick="javascript: oIWall.AttachBlock( 'photo_url' );"><img id="send_photo_link" src="<?php echo $this->_tpl_vars['imgDir']; ?>
add_b2.gif"  /></a></div>
                        </div>
                    </div>



                    <div id="id_send_block_photo_choose_file" class="share-white cl_send_block" style="visibility: hidden; margin:-165px 0 20px 6px;">
                        <div class="cl_div_cover" style="display: none; background-color: gray; position: absolute; z-index:1500; width: 100%; height: 100%;" ></div>
                        <div class="share-white-box inbox-sb">
                            <div class="share-white-title">
                                <span><a class="___nav_attach_links"  onclick="oIWall.CloseButton();" mtype="mes" href="javascript: void(0);"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close_ico.gif"  /></a></span>
                                <span style="float:left; padding-right: 10px;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
photo_ico.gif"  /> <b>Add photo:</b> Please select up to 3 photos and press "Add" </span><div style="display:inline;" id="ufy_plch"></div>
                            </div>
                            <div id="id_send_frm_photo_choose_file" class="upload-photo" style="margin-top: -15px;">
                                <form id="form1" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/inbox/chkuplphoto" method="post" enctype="multipart/form-data">

                                    <input type="hidden" name="WI[mtype]" value="4" />
                                    <div id="ufy_plch_list"></div>
                                                                    </form>
                            </div>
                            <div class="share-white-b" style="padding-right: 10px; height:8px !important;"><a href="javascript: void(0);" onclick="javascript: oIWall.UplPhoto( 'photo_choose_file' );"><img id="ufy_block_ab" src="<?php echo $this->_tpl_vars['imgDir']; ?>
add_b2.gif"  /></a></div>
                        </div>
                    </div>

                    <div id="id_send_block_video" class="share-white cl_send_block" style="visibility: hidden; margin:-165px 0 20px 6px;">
                        <div class="share-white-box inbox-sb">
                            <div class="share-white-title">
                                <span><a class="___nav_attach_links" onclick="oIWall.CloseButton();" mtype="mes" href="javascript: void(0);"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close_ico.gif"  /></a></span>
                                <img src="<?php echo $this->_tpl_vars['imgDir']; ?>
video_ico.gif"  /> Add video
                            </div>
                            <div class="grey-b">
							                                <a class="nav_attach_links" mtype="video_code" href="javascript: void(0);"><span>Embed code</span>Paste code from sites <br />like Youtbe, Vimeo</a>
                            </div>
                        </div>
                    </div>

                    <div id="id_send_block_video_code" class="share-white cl_send_block" style="visibility: hidden; margin:-165px 0 20px 6px;">
                        <div class="share-white-box inbox-sb">
                            <div class="share-white-title">
                                <span><a class="___nav_attach_links"  onclick="oIWall.CloseButton();" mtype="mes" href="javascript: void(0);"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close_ico.gif"  /></a></span>
                                <img src="<?php echo $this->_tpl_vars['imgDir']; ?>
video_ico.gif"  /> Add video
                            </div>
                            <div id="id_send_frm_video_code" class="paste-video">
                                <input type="hidden" name="WI[mtype]" value="5" />
                                <p><label>Paste video embed code:</label> <textarea id="id_send_txt_video_code_link" name="WI[v_code]" class="txt" style="border: 1px solid; height: 45px; width: 470px;"></textarea></p>

                            </div>
                            <div class="share-white-b" style="padding-right: 10px; height:8px !important;"><a href="javascript: void(0);" onclick="javascript: oIWall.AttachBlock( 'video_code' );"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
add_b2.gif"  /></a></div>
                        </div>
                    </div>
