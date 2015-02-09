<?php /* Smarty version 2.6.11, created on 2014-03-15 09:09:42
         compiled from top_blocks/_journal.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_select_date', 'top_blocks/_journal.html', 249, false),array('modifier', 'date_format', 'top_blocks/_journal.html', 254, false),)), $this); ?>

<div class="tlink2">
    <div id="id_tags_menu_0" class="tagsbox" style="display:none;">
        <div class="tagsbox-top">Tags:</div>

        <div class="tagsbox-bot">
            <span id="tml_sample"><li id="stag_[id]" class="tgtext"><a href="javascript:void(0);">[name]</a> <span class="cl_del_link2" style="display: block;"><a href="javascript: void(0);" class="dl_tag" onclick="oUsers.DelTempTag( [id] );" > <span style="width: 13px;display: inline-block"></span> </a></span></li></span>
            <ul id="id_tags_menu_list_0"></ul>
            <p><input id="id_inp_tag_name_0" type="text" value="Add tag" onclick="this.value='';" /> <a href="javascript: void(0);" onclick="oUsers.AddTempTag( 'id_inp_tag_name_0', 'id_tags_menu_list_0' );"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
add_b.gif" alt="Add tag" /></a></p>
        </div>
    </div>
</div>

<div class="top-box">
    <table>
        <tr>
            <td class="top-left">
                <div class="m-awatar">
                    <a href="javascript: void(0);" <?php if (IS_USER): ?> onclick="oUsers.SHUplPopup(1, 'id_upl_avatar_popup');" <?php endif; ?>><div style="width: 100%; height: 100%;"><img src="<?php if ($this->_tpl_vars['ui']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['ui']['fpath']; ?>
/a/a_<?php echo $this->_tpl_vars['ui']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo.jpg<?php endif; ?>"  class="big_avatar" alt="" /></div></a>
		    <?php if ($this->_tpl_vars['IS_USER']): ?>
                    <span><a href="#" class="open-drop01"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
arr03.png" alt="" />I want to</a></span>
                    <div class="dropbox01">
                        <div class="dropbox01-left">
                            <div class="dropbox01-right">
                                <ul>
                                    <li><a href="javascript: oUsers.ChangeAppear(1);" class="appear_offline" style="display:<?php if (! $this->_tpl_vars['UserInfo']['appear_offline']): ?>inline<?php else: ?>none<?php endif; ?>">Appear offline</a><a href="javascript: oUsers.ChangeAppear(0);" class="appear_online" style="display:<?php if ($this->_tpl_vars['UserInfo']['appear_offline']): ?>inline<?php else: ?>none<?php endif; ?>">Appear online</a></li>
                                    <li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?logout=1">Sign out</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
		   <?php endif; ?>
                </div>
            </td>

            <td class="top-center">

		<?php if ($this->_tpl_vars['IS_USER']): ?>

                <div class="writej" id="wj_block">
                    
                    <div id="id_send_block_mes" class="share-icon cl_send_block">
                        <form id="id_frm_add_mes" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/journal/getedit" method="post">
                            <div id="id_send_frm_mes" style="min-height:100px !important;">
                                <textarea id="id_send_inp_mes_story" name="WI[story]" class="he_editor he_show" style="display: none;visibility: hidden;width: 718px;height: 20px;" onclick="if('Share your thoughts' == this.value) this.value='';"></textarea>
                            </div>
                            <div id="id_place_to_attach" style="display: none;"></div>
                            <input type="hidden" name="WI[taglist]" id="taglist">
                            <input id="id_add_mes_privacy" type="hidden" name="SI[privacy]" value="0" />
                            <input id="id_add_mes_sub_module" type="hidden" name="SI[sub_privacy_module]" value="0" />
                            <input id="id_add_mes_sub_module_val" type="hidden" name="SI[sub_privacy_module_val]" value="0" />
                            <input id="id_add_mes_sub_class" type="hidden" name="SI[sub_privacy_class]" value="0" />
                        </form>
 
                        <div id="show_smile_tab" class="smiley" style="display:none; margin-top: -72px;">
                            <?php $this->assign('type_smile', 'journal'); ?>
                            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "top_blocks/_smile.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                        </div>

                        <div id="id_uploaded_mes" class="share-icon cl_attached_block" style="margin-top: -12px;">
                            <span><a class="cl_a_btn_share" href="javascript: void(0);"><img class="cl_img_btn_share" src="<?php echo $this->_tpl_vars['imgDir']; ?>
post_b.gif" alt="Post" /></a></span>
                        </div>

                        <div id="id_uploaded_ev" class="share-icon cl_attached_block" style="display: none; margin-left:200px;">
                            <span style="margin-top: -12px;"><a class="cl_a_btn_share" href="javascript: void(0);" ><img class="cl_img_btn_share" src="<?php echo $this->_tpl_vars['imgDir']; ?>
post_b_act.gif" alt="" /></a></span>
                            <ul id="id_uploaded_ev_lable" class="cl_j_uploaded_block"></ul>
                        </div>
                        
                        <div id="id_uploaded_link" class="uploading cl_attached_block" style="display: none; margin-left: 200px;">
                            <span style="margin-top: -12px;">
                                <a class="cl_a_btn_share" href="javascript: void(0);" >
                                    <img class="cl_img_btn_share" src="<?php echo $this->_tpl_vars['imgDir']; ?>
post_b_act.gif" alt="" />
                                </a>
                            </span>
                            <ul class="cl_j_uploaded_block" id="id_uploaded_link_ul" style="position:absolute">
                                <li style="margin-top: -12px;">
                                    <a id="id_uploaded_link_lable" href="#">
                                        <img src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico_loader_ws_journal.gif" style="float:left; position:static; border: none; padding-top: 5px;" />
                                    </a>
                                </li>
                            </ul>
                        </div>
                        
                        <div id="id_uploaded_photo_url" class="uploading cl_attached_block" style="display: none;">
                            <span style="margin-top: -12px;"><a class="cl_a_btn_share" href="javascript: void(0);" ><img class="cl_img_btn_share" src="<?php echo $this->_tpl_vars['imgDir']; ?>
post_b_act.gif" alt="" /></a></span>
                            <ul id="id_ul_link_photo" class="cl_j_uploaded_block"></ul>
                        </div>

                        <div id="id_uploaded_photo_choose_file" class="uploading cl_attached_block" style="display: none;">
                            <span style="margin-top: -12px;"><a class="cl_a_btn_share" href="javascript: void(0);"><img class="cl_img_btn_share" src="<?php echo $this->_tpl_vars['imgDir']; ?>
post_b_act.gif" alt="" /></a></span>
                            <ul id="id_ul_upl_photo" class="cl_j_uploaded_block" ></ul>
                        </div>

                        <div id="id_uploaded_video_code" class="uploading cl_attached_block" style="display: none;">
                            <span style="margin-top: -12px;"><a class="cl_a_btn_share" href="javascript: void(0);" ><img class="cl_img_btn_share" src="<?php echo $this->_tpl_vars['imgDir']; ?>
post_b_act.gif" alt="" /></a></span>
                            <ul id="id_ul_code_video" class="cl_j_uploaded_block"></ul>
                        </div>
                        
                        <div id="id_uploaded_video_choose_file" class="uploading cl_attached_block" style="display: none;">
                            <span><a class="cl_a_btn_share" href="javascript: void(0);" ><img class="cl_img_btn_share" src="<?php echo $this->_tpl_vars['imgDir']; ?>
post_b_act.gif" alt="" /></a></span>
                            <ul style="margin-top: -12px;" class="cl_j_uploaded_block">
                                <li style="margin-top: -12px;"><img id="id_img_video_choose_file" src="<?php echo $this->_tpl_vars['imgDir']; ?>
upload01.gif" alt="" style="max-width: 33px; max-height: 25px;" /> <a id="id_uploaded_video_choose_file_lable" href="#">Uploaded video</a></li>
                            </ul>
                        </div>
                      
                    </div>
                   

                    <div class="share-tools" style="top: 35px; width: 300px;">
                        <div id="id_share_attention" class="share-attention" style="display: none;">
				You've exceeded the 480 characters limit for an entry. You can shorten the text or post it as it is as a Journal entry: <a href="javascript: void(0);">Switch to Journal</a>
                        </div>

                        <div id="id_share_with">
                            <span class="listing">
				                            </span>

                            <div class="dropbox03">
                                <div class="dropbox03-left">
                                    <div class="dropbox03-right">
                                        <div>Show on page:</div>
                                        <ul>
                                            <li><a href="#">My church talks</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

				Share with &nbsp;<img src="<?php echo $this->_tpl_vars['imgDir']; ?>
user_ico01.gif" alt="" />
                            <a id="id_a_share_with" href="javascript: void(0);" class="open-drop02" onclick="$('#id_smenu_sharewith2').slideToggle('fast');" >everyone</a> <img src="<?php echo $this->_tpl_vars['imgDir']; ?>
arr02.gif" alt="" onclick="$('#id_smenu_sharewith').slideToggle('fast');"  />
                        </div>
                        <div id="id_smenu_sharewith2" class="everyone" style="display: none;">
                            <div class="everyone-top">&nbsp;</div>
                            <div class="everyone-bot">
                                <ul>
                                    <li class="grey"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico02.png" alt="" /><a class="cl_a_share_with" href="javascript: void(0);"  ptype="0">everyone</a></li>
                                    <li id="id_ssmenu_0" class="grey cl_ssmenu"><p> <input type="hidden" id="id_sw_everyone_n_uid" value="" submodule_val="" submodule="not_uid" /><input class="txt3 sw_someone" directto="id_sw_everyone_n_uid" type="text" value="except these people..." onclick="if(this.value == 'except these people...')this.value='';" /> </p></li>

                                    <li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico03.png" alt="" /><a class="cl_a_share_with" href="javascript: void(0);" ptype="1">friends and followers</a>
                                        <ul id="id_ssmenu_1" class="cl_ssmenu" style="display: none;">
                                                                                        <li><a class="cl_sub_menu" href="javascript: void(0);" submodule_val="2" submodule="priesthood">young man</a></li>
                                            <li><a class="cl_sub_menu" href="javascript: void(0);" submodule_val="12" submodule="priesthood">young woman</a></li>
                                            <li><a class="cl_sub_menu" href="javascript: void(0);" submodule_val="1" submodule="priesthood">aaronic priesthood</a></li>
                                            <li><a class="cl_sub_menu" href="javascript: void(0);" submodule_val="4" submodule="priesthood">melchizedek priesthood</a></li>
                                            <li><a class="cl_sub_menu" href="javascript: void(0);" submodule_val="7" submodule="priesthood">high priest</a></li>
                                            <?php if ($this->_tpl_vars['cnt_uclasses'] != 0): ?><hr color ="#dcdcdc" style="width:100%; height: 1px; margin:2px;" />
                                            <?php $_from = $this->_tpl_vars['uclasses']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                            <li><a class="cl_sub_menu" href="javascript: void(0);" submodule_val="5" submodule="priesthood" submodule_class="<?php echo $this->_tpl_vars['item']['class_id']; ?>
"><?php echo $this->_tpl_vars['item']['title']; ?>
</a></li>
                                            <?php endforeach; endif; unset($_from); ?>
                                            <?php endif; ?>
                                            <?php if ($this->_tpl_vars['UserInfo']['ward_id'] || $this->_tpl_vars['UserInfo']['stake_id']): ?><hr color ="#dcdcdc" style="width:100%; height: 1px; margin:2px;"><?php endif; ?>
					    <?php if ($this->_tpl_vars['UserInfo']['ward_id']): ?><li><a class="cl_sub_menu" href="javascript: void(0);" submodule_val="<?php echo $this->_tpl_vars['UserInfo']['ward_id']; ?>
" submodule="ward_id">same ward</a></li><?php endif; ?>
					    <?php if ($this->_tpl_vars['UserInfo']['stake_id']): ?><li><a class="cl_sub_menu" href="javascript: void(0);" submodule_val="<?php echo $this->_tpl_vars['UserInfo']['stake_id']; ?>
" submodule="stake_id">same stake</a></li><?php endif; ?>
                                        </ul>
                                    </li>
                                    <li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico04.png" alt="" /><a class="cl_a_share_with" href="javascript: void(0);" ptype="2">only friends</a>
                                        <ul id="id_ssmenu_2" class="cl_ssmenu" style="display: none;">
                                                                                        <li><a class="cl_sub_menu" href="javascript: void(0);" submodule_val="2" submodule="priesthood">young man</a></li>
                                            <li><a class="cl_sub_menu" href="javascript: void(0);" submodule_val="12" submodule="priesthood">young woman</a></li>
                                            <li><a class="cl_sub_menu" href="javascript: void(0);" submodule_val="1" submodule="priesthood">aaronic priesthood</a></li>
                                            <li><a class="cl_sub_menu" href="javascript: void(0);" submodule_val="4" submodule="priesthood">melchizedek priesthood</a></li>
                                            <li><a class="cl_sub_menu" href="javascript: void(0);" submodule_val="7" submodule="priesthood">high priest</a></li>
					    <?php if ($this->_tpl_vars['cnt_uclasses'] != 0): ?><hr color ="#dcdcdc" style="width:100%; height: 1px; margin:2px;" />
                                            <?php $_from = $this->_tpl_vars['uclasses']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                            <li><a class="cl_sub_menu" href="javascript: void(0);" submodule_val="5" submodule="priesthood" submodule_class="<?php echo $this->_tpl_vars['item']['class_id']; ?>
"><?php echo $this->_tpl_vars['item']['title']; ?>
</a></li>
                                            <?php endforeach; endif; unset($_from); ?>
                                            <?php endif; ?>
                                            <?php if ($this->_tpl_vars['UserInfo']['ward_id'] || $this->_tpl_vars['UserInfo']['stake_id']): ?><hr color ="#dcdcdc" style="width:100%; height: 1px; margin:2px;"><?php endif; ?>
    					    <?php if ($this->_tpl_vars['UserInfo']['ward_id']): ?><li><a class="cl_sub_menu" href="javascript: void(0);" submodule_val="<?php echo $this->_tpl_vars['UserInfo']['ward_id']; ?>
" submodule="ward_id">same ward</a></li><?php endif; ?>
					    <?php if ($this->_tpl_vars['UserInfo']['stake_id']): ?><li><a class="cl_sub_menu" href="javascript: void(0);" submodule_val="<?php echo $this->_tpl_vars['UserInfo']['stake_id']; ?>
" submodule="stake_id">same stake</a></li><?php endif; ?>
                                        </ul>
                                    </li>
                                    <li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico05.png" alt="" /><a class="cl_a_share_with" href="javascript: void(0);" ptype="3">only family</a></li>
                                    <li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico06.png" alt="" /><a class="cl_a_share_with " href="javascript: void(0);" ptype="4">only...</a></li>
                                    <li id="id_ssmenu_4" class="cl_ssmenu" style="display: none;"><p class="grey"> <input type="hidden" id="id_sw_someone" value="" submodule_val="" submodule="u.uid" /><input class="txt3 sw_someone"  directto="id_sw_someone" type="text" value="enter user name" onclick="if(this.value == 'enter user name')this.value='';" /> </p></li>
                                    <li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico07.png" alt="" /><a class="cl_a_share_with" href="javascript: void(0);" ptype="5">private <?php if ($this->_tpl_vars['IS_USER']):  endif; ?></a></li>
                                </ul>
                            </div>
                        </div>
                        <div id="id_smenu_sharewith2" class="everyone" style="display: none;">
                            <div class="everyone-top">&nbsp;</div>
                            <div class="everyone-bot">
                                <ul>
                                    <li class="grey"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico02.png" alt="" /><a class="cl_a_share_with" href="javascript: void(0);"  ptype="0">everyone</a></li>
                                    <li id="id_ssmenu_0" class="grey cl_ssmenu"><p> <input type="hidden" id="id_sw_everyone_n_uid" value="" submodule_val="" submodule="not_uid" /><input class="txt3 sw_someone" directto="id_sw_everyone_n_uid" type="text" value="except these people..." onclick="if(this.value == 'except these people...')this.value='';" /> </p></li>

                                    <li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico03.png" alt="" /><a class="cl_a_share_with" href="javascript: void(0);" ptype="1">friends and followers</a>
                                        <ul id="id_ssmenu_1" class="cl_ssmenu" style="display: none;">
                                                                                        <li><a class="cl_sub_menu" href="javascript: void(0);" submodule_val="2" submodule="priesthood">young man</a></li>
                                            <li><a class="cl_sub_menu" href="javascript: void(0);" submodule_val="12" submodule="priesthood">young woman</a></li>
                                            <li><a class="cl_sub_menu" href="javascript: void(0);" submodule_val="1" submodule="priesthood">aaronic priesthood</a></li>
                                            <li><a class="cl_sub_menu" href="javascript: void(0);" submodule_val="4" submodule="priesthood">melchizedek priesthood</a></li>
                                            <li><a class="cl_sub_menu" href="javascript: void(0);" submodule_val="7" submodule="priesthood">high priest</a></li>
					    <!--<?php if ($this->_tpl_vars['UserInfo']['priesthood']): ?><li><a class="cl_sub_menu" href="javascript: void(0);" submodule_val="<?php echo $this->_tpl_vars['UserInfo']['priesthood']; ?>
" submodule="priesthood">same class</a></li><?php endif; ?>-->
                                            <?php if ($this->_tpl_vars['cnt_uclasses'] != 0): ?><hr color ="#dcdcdc" style="width:100%; height: 1px; margin:2px;" />
                                            <?php $_from = $this->_tpl_vars['uclasses']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                            <li><a class="cl_sub_menu" href="javascript: void(0);" submodule_val="5" submodule="priesthood" submodule_class="<?php echo $this->_tpl_vars['item']['class_id']; ?>
"><?php echo $this->_tpl_vars['item']['title']; ?>
</a></li>
                                            <?php endforeach; endif; unset($_from); ?>
                                            <?php endif; ?>
					    <?php if ($this->_tpl_vars['UserInfo']['ward_id']): ?><li><a class="cl_sub_menu" href="javascript: void(0);" submodule_val="<?php echo $this->_tpl_vars['UserInfo']['ward_id']; ?>
" submodule="ward_id">same ward</a></li><?php endif; ?>
					   <?php if ($this->_tpl_vars['UserInfo']['stake_id']): ?><li><a class="cl_sub_menu" href="javascript: void(0);" submodule_val="<?php echo $this->_tpl_vars['UserInfo']['stake_id']; ?>
" submodule="stake_id">same stake</a></li><?php endif; ?>
                                        </ul>
                                    </li>
                                    <li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico04.png" alt="" /><a class="cl_a_share_with" href="javascript: void(0);" ptype="2">only friends</a>
                                        <ul id="id_ssmenu_2" class="cl_ssmenu" style="display: none;">
                                                                                        <li><a class="cl_sub_menu" href="javascript: void(0);" submodule_val="2" submodule="priesthood">young man</a></li>
                                            <li><a class="cl_sub_menu" href="javascript: void(0);" submodule_val="12" submodule="priesthood">young woman</a></li>
                                            <li><a class="cl_sub_menu" href="javascript: void(0);" submodule_val="1" submodule="priesthood">aaronic priesthood</a></li>
                                            <li><a class="cl_sub_menu" href="javascript: void(0);" submodule_val="4" submodule="priesthood">melchizedek priesthood</a></li>
                                            <li><a class="cl_sub_menu" href="javascript: void(0);" submodule_val="7" submodule="priesthood">high priest</a></li>
					    <!--<?php if ($this->_tpl_vars['UserInfo']['priesthood']): ?><li><a class="cl_sub_menu" href="javascript: void(0);" submodule_val="6" submodule_uvid="<?php echo $this->_tpl_vars['UserInfo']['priesthood']; ?>
" submodule="priesthood">same class</a></li><?php endif; ?>-->
					    <?php if ($this->_tpl_vars['cnt_uclasses'] != 0): ?><hr color ="#dcdcdc" style="width:100%; height: 1px; margin:2px;" />
                                            <?php $_from = $this->_tpl_vars['uclasses']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                            <li><a class="cl_sub_menu" href="javascript: void(0);" submodule_val="6" submodule="priesthood" submodule_class="<?php echo $this->_tpl_vars['item']['class_id']; ?>
"><?php echo $this->_tpl_vars['item']['title']; ?>
</a></li>
                                            <?php endforeach; endif; unset($_from); ?>
                                            <?php endif; ?>
                                            <?php if ($this->_tpl_vars['UserInfo']['ward_id']): ?><li><a class="cl_sub_menu" href="javascript: void(0);" submodule_val="7" submodule_uvid="<?php echo $this->_tpl_vars['UserInfo']['ward_id']; ?>
" submodule="ward_id">same ward</a></li><?php endif; ?>
                                            <?php if ($this->_tpl_vars['UserInfo']['stake_id']): ?><li><a class="cl_sub_menu" href="javascript: void(0);"submodule_val="8" submodule_uvid="<?php echo $this->_tpl_vars['UserInfo']['stake_id']; ?>
" submodule="stake_id">same stake</a></li><?php endif; ?>
                                        </ul>
                                    </li>
                                    <li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico05.png" alt="" /><a class="cl_a_share_with" href="javascript: void(0);" ptype="3">only family</a></li>
                                    <li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico06.png" alt="" /><a class="cl_a_share_with " href="javascript: void(0);" ptype="4">only...</a></li>
                                    <li id="id_ssmenu_4" class="cl_ssmenu" style="display: none;"><p class="grey"> <input type="hidden" id="id_sw_someone" value="" submodule_val="" submodule="u.uid" /><input class="txt3 sw_someone"  directto="id_sw_someone" type="text" value="enter user name" onclick="if(this.value == 'enter user name')this.value='';" /> </p></li>
                                    <li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico07.png" alt="" /><a class="cl_a_share_with" href="javascript: void(0);" ptype="5">private <?php if ($this->_tpl_vars['IS_USER']):  endif; ?></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div id="id_send_block_ev" class="share-white cl_send_block" style="visibility: hidden; width: 718px; margin-left: -1px; margin-top: -1px;">
                        <div class="share-white-box" style="border: none; width:100%; height:143px;">
                            <div class="share-white-title">
                                <span><a class="___nav_attach_links" onclick="oJournal.CloseButton();" mtype="mes" href="javascript: void(0);"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
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
                                <div class="share-white-b" style="position:absolute;top:103px;left:642px;">
                                    <a href="javascript: void(0);" onclick="oJournal.AddEventButton();"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
add_b2.gif" id="add_event_button" alt="Add Event" /></a>
                                </div>
                            </div>



                        </div>

                    </div>

                    <div id="id_send_block_link" class="share-white cl_send_block" style="visibility: hidden; width: 718px; margin-left: -1px; margin-top: -1px;">
                        <div class="share-white-box" style="border: none; width:100%; height:143px;">
                            <div class="share-white-title">
                                <span><a class="____nav_attach_links" onclick="oJournal.CloseButton();" mtype="mes" href="javascript: void(0);"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close_ico.gif" alt="" /></a></span>
                                <img src="<?php echo $this->_tpl_vars['imgDir']; ?>
link_ico.gif" alt="" /> Add link
                            </div>
                            <div id="id_send_frm_link" class="add-link">
                                <input type="hidden" name="WI[mtype]" value="3" />
                                <p><label>Enter the URL:</label> <br /><input id="id_send_inp_link_url" class="txt" name="WI[l_url]" type="text" value="" style="height:18px;" /></p>
                            </div>
                            <div class="share-white-b" style=" margin-right: -10px; height:8px !important;"><a href="javascript: void(0);" onclick="oJournal.AttachBlock( 'link' );"><img id="link_add_button" src="<?php echo $this->_tpl_vars['imgDir']; ?>
add_b2.gif" alt="" /></a></div>
                        </div>
                    </div>

                    <div id="id_send_block_photo" class="share-white cl_send_block" style="visibility: hidden; width: 718px; margin-left: -1px; margin-top: -1px;">
                        <div class="share-white-box" style="border: none; width:100%; height:143px;">
                            <div class="share-white-title">
                                <span><a class="______nav_attach_links" onclick="oJournal.CloseButton();" mtype="mes" href="javascript: void(0);"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
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

                    <div id="id_send_block_photo_url" class="share-white cl_send_block" style="visibility: hidden; width: 718px; margin-left: -1px; margin-top: -1px;">
                        <div class="share-white-box" style="border: none; width:100%; height:143px;">
                            <div class="share-white-title">
                                <span><a class="______nav_attach_links" onclick="oJournal.CloseButton();" mtype="mes" href="javascript: void(0);"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close_ico.gif" alt="" /></a></span>
                                <img src="<?php echo $this->_tpl_vars['imgDir']; ?>
photo_ico.gif" alt="" /> Add photo
                            </div>
                            <div id="id_send_frm_photo_url" class="enter-photo">
                                <input type="hidden" name="WI[mtype]" value="4" />
                                <p><label>Enter photo URL:</label><br /><input style="height:18px;" id="id_send_inp_photo_url_link" class="txt" name="WI[p_url]" type="text" value="" /></p>
                            </div>
                            <div class="share-white-b" style="margin-right: -7px; height:8px !important;"><a href="javascript: void(0);" onclick="oJournal.AttachBlock( 'photo_url' );"><img id="send_photo_link" src="<?php echo $this->_tpl_vars['imgDir']; ?>
add_b2.gif" alt="" /></a></div>
                        </div>
                    </div>

                    <div id="id_send_block_photo_choose_file" class="share-white cl_send_block" style="visibility: hidden; width: 718px; margin-left: -1px; margin-top: -1px;">
                        <div class="cl_div_cover" style="display: none; background-color: gray; position: absolute; z-index:1500; width: 100%; height: 100%;" ></div>
                        <div class="share-white-box" style="border: none; width:100%; height:143px;">
                            <div class="share-white-title">
                                <span><a class="_______nav_attach_links" onclick="oJournal.CloseButton();" mtype="mes" href="javascript: void(0);"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close_ico.gif"  /></a></span>
                                <span style="float:left; padding-right: 10px;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
photo_ico.gif"  /> <b>Add photo:</b> Please select up to 3 photos and press "Add" </span><div style="display:inline;" id="ufy_plch"></div>
                                                            </div>
                            <div id="id_send_frm_photo_choose_file" class="upload-photo" style="margin-top: -15px;">
                                <form id="form1" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/journal/chkuplphoto" method="post" enctype="multipart/form-data">

                                    <input type="hidden" name="WI[mtype]" value="4" />
                                    <div id="ufy_plch_list"></div>

                                                                        <!-- <input type="submit" value="Choose File" /></p> -->
                                                                    </form>
                            </div>
                            <div class="share-white-b" style=" margin-right: -20px; height:8px !important;"><a href="javascript: void(0);" onclick="oJournal.UplPhoto( 'photo_choose_file' );"><img  id="ufy_block_ab" src="<?php echo $this->_tpl_vars['imgDir']; ?>
add_b2.gif" alt="" /></a></div>
                        </div>
                    </div>

                    <div id="id_send_block_video" class="share-white cl_send_block" style="visibility: hidden; width: 718px; margin-left: -1px; margin-top: -1px;">
                        <div class="share-white-box" style="border: none; width:100%; height:143px;">
                            <div class="share-white-title">
                                <span><a class="________nav_attach_links" onclick="oJournal.CloseButton();" mtype="mes" href="javascript: void(0);"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close_ico.gif" alt="" /></a></span>
                                <img src="<?php echo $this->_tpl_vars['imgDir']; ?>
video_ico.gif" alt="" /> Add video
                            </div>
                            <div class="grey-b">
					                                <a class="nav_attach_links" mtype="video_code" href="javascript: void(0);"><span>Embed code</span>Paste code from sites <br />like Youtbe, Vimeo</a>
                            </div>
                        </div>
                    </div>

                    <div id="id_send_block_video_code" class="share-white cl_send_block" style="visibility: hidden; width: 718px; margin-left: -1px; margin-top: -1px;">
                        <div class="share-white-box" style="border: none; width:100%; height:143px;">
                            <div class="share-white-title">
                                <span><a class="________nav_attach_links" onclick="oJournal.CloseButton();" mtype="mes" href="javascript: void(0);"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close_ico.gif" alt="" /></a></span>
                                <img src="<?php echo $this->_tpl_vars['imgDir']; ?>
video_ico.gif" alt="" /> Add video
                            </div>
                            <div id="id_send_frm_video_code" class="paste-video">
                                <input type="hidden" name="WI[mtype]" value="5" />
                                <p><label>Paste video embed code:</label><br /><textarea id="id_send_txt_video_code_link" name="WI[v_code]" class="txt" style="border: 1px solid; height: 45px; width: 470px;"></textarea></p>
                                <input id="id_send_inp_video_code_link" type="hidden" name="WI[v_code]" value="" />
                            </div>
                            <div class="share-white-b" style=" margin-right: -20px; height:8px !important;"><a href="javascript: void(0);" onclick="oJournal.AttachBlock( 'video_code' );" style="width: 60px; height: 40px;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
add_b2_act.gif" alt="" /></a></div>
                        </div>
                    </div>

                    <div id="id_send_block_video_choose_file" class="share-white cl_send_block" style="visibility: hidden; width: 718px; margin-left: -1px; margin-top: -1px;">
                        <div class="share-white-box" style="border: none; width:100%; height:143px;">
                            <div class="share-white-title">
                                <span><a class="_________nav_attach_links" onclick="oJournal.CloseButton();" mtype="mes" href="javascript: void(0);"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
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
                            <div class="share-white-b" style="margin-right: -20px; height:8px !important;"><a id="id_btn_video_upl" href="javascript: void(0);" onclick="oJournal.GetYTToken();"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
add_b2.gif" alt="" /></a></div>
                        </div>
                    </div>
                </div>

		<?php endif; ?>

            </td>
        </tr>
    </table>
</div>