<?php /* Smarty version 2.6.11, created on 2014-03-15 08:51:13
         compiled from mods/_popups/_add_friend.html */ ?>
<div id="id_add_friend_popup" class="aj-box01" style="display: none; position: fixed; z-index: 3333; max-height: 270px;">
    <div class="aj-close"><a href="javascript: void(0);" onclick="oFriends.SHWarnPopup( 2, 'id_add_friend_popup' )"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close_ico.gif" alt="Close" /></a></div>

    <div style="margin: 10px;"><h3>Add a new Friend</h3></div>

    <div class="" style="max-height: 180px; margin: 10px; border: none !important;">
        <div>
            <div>
                <form id="id_add_friend_popup_frm" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
base/friends/edit?action=add" method="post">
                    <input id="id_friend_add_friend_id" name="fr_id" type="hidden" value="" />
                    <fieldset style="border: none !important;">
                        <div>
                            <table>
                                <tr>
                                    <td>
                                        <a id="id_friend_add_image_a"><img id="id_friend_add_image" style="border: 1px solid gray" /></a>
                                    </td>
                                    <td style="vertical-align: top">
                                        <strong style="margin-left: 5px;"><a id="id_friend_add_login_a" href=""><span id="id_friend_add_login"></span></a></strong>
                                    </td>
                                </tr>
                            </table>
                            <div id="af_bl">
                                <p><span id="id_friend_add_fio"></span></p>
                                <b>Please confirm you would like to add this member as a friend</b>
                                <p style="margin-top: 5px;"><label>Message:</label></p>
                                <textarea name="mes" class="txt" cols="60" rows="3" id="id_mes"></textarea>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    <div class="aj-button" id="af_bl_btn">
        <span class="aj-button01"><a href="javascript: void(0);" onclick="oFriends.SHWarnPopup( 2, 'id_add_friend_popup' );">Cancel</a></span>
        <span class="aj-button02"><a href="javascript: void(0);" onclick="oFriends.InviteFriendsAjax($('#id_friend_add_friend_id').val(), $('#id_mes').val(), 1);">Add</a></span>
    </div>

</div>