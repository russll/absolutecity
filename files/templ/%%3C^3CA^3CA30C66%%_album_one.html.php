<?php /* Smarty version 2.6.11, created on 2014-09-18 12:49:02
         compiled from mods/albums/_album_one.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'trim', 'mods/albums/_album_one.html', 11, false),array('modifier', 'truncate', 'mods/albums/_album_one.html', 19, false),array('function', 'html_str_format', 'mods/albums/_album_one.html', 19, false),)), $this); ?>
<div class="post-box" id="id_albums_el_1_<?php echo $this->_tpl_vars['alb_i']['aid']; ?>
" style="min-height: 45px">
    <div class="b-awatar">
		<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['alb_i']['uid']; ?>
/albums/id<?php echo $this->_tpl_vars['alb_i']['aid']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
no_photo_m66.jpg" alt="<?php echo $this->_tpl_vars['alb_i']['name']; ?>
" /></a>
	</div>

	<div class="post-title2">
		<b><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['alb_i']['uid']; ?>
/albums/id<?php echo $this->_tpl_vars['alb_i']['aid']; ?>
"><?php echo $this->_tpl_vars['alb_i']['name']; ?>
</a></b>
	</div>

	<p><b>Created:</b> <?php if ($this->_tpl_vars['alb_i']['created']): ?> <?php echo $this->_tpl_vars['alb_i']['created']; ?>
 <?php else: ?> &nbsp; <?php endif; ?></p>
    <?php if (((is_array($_tmp=$this->_tpl_vars['alb_i']['descr'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp))): ?><p><b>Description:</b> <?php echo $this->_tpl_vars['alb_i']['descr']; ?>
</p><?php endif; ?>
    <?php if ($this->_tpl_vars['alb_i']['location']): ?><p><b>Location:</b> <?php echo $this->_tpl_vars['alb_i']['location']; ?>
</p><?php endif; ?>
    
	<?php $this->assign('asname', $this->_tpl_vars['i']['name']); ?>

    <?php if ($this->_tpl_vars['IS_USER']): ?>
		<span class="cl_del_link" style="margin-right: 5px;">
			<a href="javascript: void(0);"
			   onclick="javascript: oSystem.SConfPopup( 'oAlbums.DelAlbum( <?php echo $this->_tpl_vars['alb_i']['aid']; ?>
, <?php echo $this->_tpl_vars['alb_i']['type']; ?>
 );', 'Please confirm you want to delete this album \'<?php echo smarty_function_html_str_format(array('str' => ((is_array($_tmp=$this->_tpl_vars['alb_i']['name'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 30) : smarty_modifier_truncate($_tmp, 30))), $this);?>
\'?' );">
				&nbsp&nbsp&nbsp&nbsp
			</a>
		</span>
	<?php endif; ?>
</div>