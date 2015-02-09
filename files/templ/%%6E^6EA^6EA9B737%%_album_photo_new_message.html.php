<?php /* Smarty version 2.6.11, created on 2014-04-23 21:00:52
         compiled from mods/_popups/_album_photo_new_message.html */ ?>
<div id="id_album_photo_new_message" class="aj-box03">
<div class="aj-close"><a href="javascript: void(0);" onclick="oAlbums.SHUplPopup( 2, 'id_album_photo_new_message' )"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close_ico.gif"  /></a></div>
<div class="aj-box03-title"><h2 style="margin-left:15px;">New message</h2></div>
    <form id="id_frm_album_photo_new_message" action="/inbox/getedit" method="post">
    <input type="hidden" name="SI[user_id]" id="to_title_id" value="0"/>
        <div class="add-mesg-form">
            <table class="v1">
                <tr><td align="right"><span>To</span></td><td align="right"><input id="to_title" name="WI[name]" type="text" value="" />
                <tr><td colspan="2" class="clr"></td></tr>
                <tr>
					<td valign="top">
						<span>Message</span>
					</td>
					
					<td>
						<textarea id="to_descr" name="WI[story]">
							Hi! Check out this [photo url=<?php echo $this->_tpl_vars['siteUrl']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/albums/id<?php echo $this->_tpl_vars['ai']['aid']; ?>
/id<?php echo $this->_tpl_vars['pi']['id']; ?>
].
							&nbsp;<?php echo $this->_tpl_vars['UserInfo']['first_name']; ?>
 <?php echo $this->_tpl_vars['UserInfo']['last_name']; ?>

						</textarea>
					</td>
				</tr>
            </table>
        </div>
    </form>
    <div class="aj-button" style="width:150px;">
        <span class="aj-button01"><a href="javascript: void(0);" onclick="oAlbums.SHUplPopup( 2, 'id_album_photo_new_message' );">Cancel</a></span>
        <span class="aj-button02"><a href="javascript: void(0);" onclick="oAlbums.AddAlbum( 'id_frm_album_photo_new_message' );">Send</a></span>
    </div>
</div>