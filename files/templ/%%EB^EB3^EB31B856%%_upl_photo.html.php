<?php /* Smarty version 2.6.11, created on 2014-04-23 21:00:42
         compiled from mods/_popups/_upl_photo.html */ ?>
<div id="id_upl_photo_popup" class="aj-box01" style="visibility: hidden; position: fixed; z-index: 3333; /*max-height: 370px;*/ height: auto; top: 25%;">
    <div id="id_upl_popup_close" class="aj-close"><a href="javascript: void(0);" onclick="oAlbums.SHUplPopup( 2, 'id_upl_photo_popup' )"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close_ico.gif"  /></a></div>

    <div style="margin: 10px;"><h3>Upload new photos</h3></div>

    <div class="" style="margin: 10px; border: none !important;">
        <div>
            <div>
                <input id="id_friend_add_friend_id" name="fr_id" type="hidden" value="" />
                <fieldset style="border: none !important;">
                    <div>
                        <table>
                            <tr>
                                <td>
                                    <div id="id_send_frm_photo_choose_file" class="upload-photo">
                                        <form id="id_frm_upl_photo"
                                              											  method="post" enctype="multipart/form-data"> 

                                              <table width="80%">
                                                <tr>
                                                    <td width="100px" style="vertical-align: middle"><b>Album: &nbsp</b></td>
                                                    <td>
                                                        <span class="niceform">
                                                            <select id="id_upl_photo_album" name="PI[aid]" size="1" style="width:149px">
																<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['al']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
                                                                <option <?php if (0 == $this->_sections['i']['index']): ?> selected="selected" <?php endif; ?> value="<?php echo $this->_tpl_vars['al'][$this->_sections['i']['index']]['aid']; ?>
"><?php echo $this->_tpl_vars['al'][$this->_sections['i']['index']]['name']; ?>
</option>
																<?php endfor; endif; ?>
                                                            </select>
                                                            <input id="id_upl_photo_album_val" type="text" value="" name="PI[aid]" style="display: none;"></span>
                                                    </td>
                                                </tr>
                                                                                         </table>

                                            <input type="hidden" name="WI[mtype]" value="4" />

                                            <table style="width:100%">
                                                <tr style="">
                                                    <td style="width:150px; vertical-align: top; padding-top: 20px;">
                                                        <input type="file"  name="fd_photos[]" id="fd_photos" />

                                                    </td>
                                                    <td id="sphotos_list" style="height:50px; vertical-align: top;"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" id="photos_status_td" style="padding-top:10px;">Please select up to 3 photos and press "Add"</td>
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

    <div style="float:right;left:0px;margin-bottom: 5px;">
        <span id="id_upl_popup_cancel" class="aj-button01"><a href="javascript: void(0);" onclick="oAlbums.SHUplPopup( 2, 'id_upl_photo_popup' );">Cancel</a></span>
        <span id="id_upl_popup_add" class="aj-button02"><a href="javascript: void(0);" onclick="oAlbums.UplPhotos();">Add</a></span>
    </div>

</div>