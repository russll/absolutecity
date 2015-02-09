<?php /* Smarty version 2.6.11, created on 2014-04-23 21:00:42
         compiled from top_blocks/_albums_photos.html */ ?>
<!-- Album's Photos top box -->
<div class="album-top-box" style="background: url('<?php echo $this->_tpl_vars['imgDir']; ?>
top_bg2.png')">

	<div class="a-button">
		<?php if ($this->_tpl_vars['IS_USER'] && $this->_tpl_vars['owner'] && 2 != $this->_tpl_vars['ai']['type']): ?>
			<span class="a-button0">
				<a href="javascript: void(0);" onclick="javascript: oAlbums.SHUplPopup( 1, 'id_upl_photo_popup', <?php echo $this->_tpl_vars['ai']['aid']; ?>
 );">Add a photo to this album</a>
			</span>
		<?php else: ?>
			&nbsp;
		<?php endif; ?>
	</div>

	<div class="a-awatar"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
"><img src="<?php if ($this->_tpl_vars['ui']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['ui']['fpath']; ?>
/s/s_<?php echo $this->_tpl_vars['ui']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m56.jpg<?php endif; ?>"  style="width: 56px; height: 56px;" /></a></div>
	<div class="back-link"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/albums">Back to albums list</a></div>
</div>
<!-- Album's Photos top box -->