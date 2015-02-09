<?php /* Smarty version 2.6.11, created on 2014-04-23 21:00:52
         compiled from top_blocks/_albums_photo.html */ ?>
<!-- Album's Photos top box -->
<div class="album-top-box" style="background: url('<?php echo $this->_tpl_vars['imgDir']; ?>
top_bg2.png')">

	<div class="a-awatar"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
"><img src="<?php if ($this->_tpl_vars['ui']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['ui']['fpath']; ?>
/s/s_<?php echo $this->_tpl_vars['ui']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m56.jpg<?php endif; ?>"  style="width: 56px; height: 56px;" /></a></div>
	<div class="back-link"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/albums/id<?php echo $this->_tpl_vars['ai']['aid']; ?>
">Back to album</a></div>
</div>