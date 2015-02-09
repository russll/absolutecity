<?php /* Smarty version 2.6.11, created on 2014-04-23 21:00:32
         compiled from mods/_popups/_chng_album.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'trim', 'mods/_popups/_chng_album.html', 24, false),array('modifier', 'strip_tags', 'mods/_popups/_chng_album.html', 24, false),)), $this); ?>
<div id="id_chng_album_popup" class="aj-box01" style="display: none; position: fixed; z-index: 3333; max-height: 180px">
    <div id="id_upl_popup_close" class="aj-close"><a href="javascript: void(0);" onclick="oAlbums.SHUplPopup( 2, 'id_chng_album_popup' )"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close_ico.gif"  /></a></div>

    <div style="margin: 10px;"><h3>Move this photo to another album</h3></div>

    <div class="" style="max-height: 180px; margin: 10px; border: none !important;">
        <div>
            <div>
                <input id="id_friend_add_friend_id" name="fr_id" type="hidden" value="" />
                <fieldset style="border: none !important;">
                    <div>
                        <table>
                            <tr>
                                <td>
                                    <div id="id_send_frm_photo_choose_file" class="upload-photo">
                                        <form id="id_frm_chng_album" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['UserInfo']['uid']; ?>
/albums/<?php if ('album' == $this->_tpl_vars['atype']): ?>id<?php echo $this->_tpl_vars['ai']['aid'];  else:  echo $this->_tpl_vars['atype'];  endif; ?>/uplphotos" method="post" enctype="multipart/form-data">

                                            <table width="80%">
                                                <tr>
                                                    <td width="70px"><b>Album:&nbsp</b></td>
                                                    <td><span class="niceform">
															<select id="id_chng_album_album" name="PI[aid]" size="1" style="width:249px">
																<?php $_from = $this->_tpl_vars['al']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['n'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['n']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['n']['iteration']++;
?>
                                                                <option value="<?php echo $this->_tpl_vars['i']['aid']; ?>
"<?php if (($this->_foreach['n']['iteration'] <= 1)): ?> selected="selected"<?php endif; ?>><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['i']['name'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)))) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)); ?>
</option>
																<?php endforeach; endif; unset($_from); ?>
                                                            </select>
														</span>
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

    <input id="id_chng_alb_cpid" type="hidden" value="" />

    <div class="aj-button">
        <span id="id_upl_popup_cancel" class="aj-button01"><a href="javascript: void(0);" onclick="oAlbums.SHUplPopup( 2, 'id_chng_album_popup' );">Cancel</a></span>
        <span id="id_upl_popup_add" class="aj-button02"><a href="javascript: void(0);" onclick="oAlbums.ChngAlbums();">Change</a></span>
    </div>

</div>