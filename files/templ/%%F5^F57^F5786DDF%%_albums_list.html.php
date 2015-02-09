<?php /* Smarty version 2.6.11, created on 2014-04-23 21:00:32
         compiled from top_blocks/_albums_list.html */ ?>
<!-- Album's List top box -->

<div class="album-top-box" style="background: url('<?php echo $this->_tpl_vars['imgDir']; ?>
top_bg2.png')">

	<div class="a-button">
		<?php if ($this->_tpl_vars['IS_USER']): ?><span class="a-button0"><a href="javascript: void(0);" onclick="javascript: oAlbums.SHUplPopup( 1, 'id_add_album_popup' );">Add a new album</a></span><?php endif; ?>
	</div>

	<div class="a-awatar"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
"><img src="<?php if ($this->_tpl_vars['ui']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['ui']['fpath']; ?>
/s/s_<?php echo $this->_tpl_vars['ui']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m56.jpg<?php endif; ?>"  style="width: 56px; height: 56px;" /></a></div>
	<div class="back-link"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/albums">&nbsp</a></div>
</div>
<!-- Album's List top box -->