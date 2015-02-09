<?php /* Smarty version 2.6.11, created on 2014-07-25 10:02:35
         compiled from mods/_popups/_upl_video.html */ ?>
<div id="id_upl_video_popup" class="aj-box01" style="display: none; position: absolute; z-index: 3333; max-height: 270px">
    <div id="id_upl_popup_close" class="aj-close"><a href="javascript: void(0);" onclick="oValbums.SHUplPopup( 2, 'id_upl_video_popup' )"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close_ico.gif"  /></a></div>

    <div style="margin: 10px;"><h3>Add a new embed video</h3></div>

    <div class="" style="max-height: 180px; margin: 10px; border: none !important;">
        <div>
            <div>
                <input id="id_friend_add_friend_id" name="fr_id" type="hidden" value="" />
                <fieldset style="border: none !important;">
                    <div>
                        <table>
                            <tr>
                                <td>
                                    <div id="id_send_frm_video_choose_file" class="upload-photo">
                                        <form id="id_frm_upl_video" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['UserInfo']['uid']; ?>
/valbums/id<?php echo $this->_tpl_vars['ai']['vaid']; ?>
/uplvideos" method="post" enctype="multipart/form-data">
                                            <table width="80%">
                                                <tr>
                                                    <td width="70px" valign="top"><b>Album: &nbsp</b></td>
                                                    <td valign="top">
                                                        <span class="niceform">
                                                            <select id="id_upl_video_album" name="PI[vaid]" size="1" style="width:249px">
                                                                <?php $_from = $this->_tpl_vars['al']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['n'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['n']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['n']['iteration']++;
?>
								                                <option  value="<?php echo $this->_tpl_vars['i']['vaid']; ?>
"<?php if (0 == ($this->_foreach['n']['iteration']-1)): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['i']['name']; ?>
</option>
                                                                <?php endforeach; endif; unset($_from); ?>
					                                        </select>
                                                            <input id="id_upl_video_val" type="text" value="" name="PI[video]" style="display: none;"></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="70px" style="vertical-align: middle"><b>Embed code: &nbsp</b></td>
                                                    <td><span><textarea id="id_upl_video_code" rows="6" cols="50" ></textarea></span>
                                                    <i>We accept: <a href="http://YouTube.com" target="_blank">YouTube.com</a>, <a href="http://Vimeo.com" target="_blank">Vimeo.com</a>, <a href="http://RuTube.ru" target="_blank">RuTube.ru</a></i>

                                                    </td>
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
        <span id="id_upl_popup_cancel" class="aj-button01"><a href="javascript: void(0);" onclick="oValbums.SHUplPopup( 2, 'id_upl_video_popup', <?php echo $this->_tpl_vars['ai']['vaid']; ?>
 );">Cancel</a></span>
        <span id="id_upl_popup_add" class="aj-button02"><a href="javascript: void(0);" onclick="oValbums.EmbingVideo( 'id_frm_upl_video' );">Add</a></span>
    </div>

</div>