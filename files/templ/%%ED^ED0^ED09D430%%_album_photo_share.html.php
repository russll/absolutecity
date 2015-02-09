<?php /* Smarty version 2.6.11, created on 2014-04-23 21:00:52
         compiled from mods/_popups/_album_photo_share.html */ ?>
<div id="id_album_photo_share" class="aj-box03">
<div class="aj-close"><a href="javascript: void(0);" onclick="oAlbums.SHUplPopup( 2, 'id_album_photo_share' )"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close_ico.gif"  /></a></div>
<div class="aj-box03-title"><h2 style="margin-left:15px;">Share</h2></div>
    <form id="id_frm_album_photo_new_message" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['UserInfo']['uid']; ?>
/albums/edit" method="post">
        <div class="add-mesg-form">
            <table class="v2">
                <tr><td><span>Copy the code below to embed this video</span></td></tr>
                <tr><td align="right">
                        <textarea id="to_descr" name="WI[story]">
<a href="<?php echo $this->_tpl_vars['siteUrl']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/albums/id<?php echo $this->_tpl_vars['ai']['aid']; ?>
/id<?php echo $this->_tpl_vars['pi']['id']; ?>
" title="<?php echo $this->_tpl_vars['pi']['descr']; ?>
 by <?php echo $this->_tpl_vars['UserInfo']['first_name']; ?>
 <?php echo $this->_tpl_vars['UserInfo']['last_name']; ?>
 on Inzion.com"><img src="<?php echo $this->_tpl_vars['siteUrl'];  echo $this->_tpl_vars['fImgDir'];  if (2 == $this->_tpl_vars['ai']['type']):  if ('Wall' == $this->_tpl_vars['ai']['name']): ?>wall/<?php elseif ('Mission' == $this->_tpl_vars['ai']['name']): ?>mission/wall/<?php elseif ('Inbox' == $this->_tpl_vars['ai']['name']): ?>inbox/<?php elseif ('Journal' == $this->_tpl_vars['ai']['name']): ?>journal/<?php elseif ('Ward' == $this->_tpl_vars['ai']['name']): ?>wards/wall/<?php endif;  else: ?>albums/<?php endif;  echo $this->_tpl_vars['pi']['fpath']; ?>
/n/n_<?php echo $this->_tpl_vars['pi']['img']; ?>
" alt="<?php echo $this->_tpl_vars['pi']['descr']; ?>
"></a>
                        </textarea>
                    </td></tr>
                <tr><td style="height:5px;"></td></tr>
                <tr><td valign="top"><span>Copy the link to this photo</span></td></tr>
                <tr><td>
                        <input id="to_title" name="WI[name]" type="text" value="<?php echo $this->_tpl_vars['siteUrl'];  echo $this->_tpl_vars['fImgDir'];  if (2 == $this->_tpl_vars['ai']['type']):  if ('Wall' == $this->_tpl_vars['ai']['name']): ?>wall/<?php elseif ('Mission' == $this->_tpl_vars['ai']['name']): ?>mission/wall/<?php elseif ('Inbox' == $this->_tpl_vars['ai']['name']): ?>inbox/<?php elseif ('Journal' == $this->_tpl_vars['ai']['name']): ?>journal/<?php elseif ('Ward' == $this->_tpl_vars['ai']['name']): ?>wards/wall/<?php endif;  else: ?>albums/<?php endif;  echo $this->_tpl_vars['pi']['fpath']; ?>
/n/n_<?php echo $this->_tpl_vars['pi']['img']; ?>
" />
                </td></tr>
            </table>
        </div>
    </form>
    <div class="aj-button">
        <span class="aj-button01"><a href="javascript: void(0);" onclick="oAlbums.SHUplPopup( 2, 'id_album_photo_share' );">Close</a></span>
    </div>
</div>