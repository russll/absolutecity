<?php /* Smarty version 2.6.11, created on 2014-04-23 21:00:52
         compiled from mods/albums/_photo_right_one.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'mods/albums/_photo_right_one.html', 23, false),)), $this); ?>
		<li>
			<p><b>Share</b></p>
			<p><a href="javascript: void(0);" onclick="javascript: oAlbums.SHChngPopup( 1, 'id_album_photo_new_message' );">as a message</a></p>
			<p><a href="mailto:?subject=Check out this photo&body=Hi! Check out this photo: <?php echo $this->_tpl_vars['siteUrl']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/albums/id<?php echo $this->_tpl_vars['ai']['aid']; ?>
/id<?php echo $this->_tpl_vars['pi']['id']; ?>
">via email</a></p>
			<p><a href="javascript: void(0);" onclick="javascript: oAlbums.SHChngPopup( 1, 'id_album_photo_share' );">as a public link</a></p>
		</li>
		   
		<li>

			<p><b>Tags</b></p>
			<?php if ($this->_tpl_vars['IS_USER']): ?><div><a href="javascript: void(0);"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
add_b3.gif"  onClick="oAlbums.AddTagToPhoto( $('#albums_tag_input').val(), <?php echo $this->_tpl_vars['pi']['id']; ?>
 );"/></a><input id="albums_tag_input" type="text" value="" /></div><?php endif; ?>
                        <ul class="list02" id="rm_tag_list">
                            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_ajax/tag_list.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                        </ul>

			<p><b>Info</b></p>
			<ul>
				<?php if ($this->_tpl_vars['pi']['shot'] != '0000-00-00 00:00:00'): ?><li>Photo taken on <?php echo ((is_array($_tmp=$this->_tpl_vars['pi']['shot'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%b %d, %Y") : smarty_modifier_date_format($_tmp, "%b %d, %Y")); ?>
</li><?php endif; ?>
				<li>Uploaded on <?php echo ((is_array($_tmp=$this->_tpl_vars['pi']['dt'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%b %d, %Y") : smarty_modifier_date_format($_tmp, "%b %d, %Y")); ?>
</li>
				<?php if ($this->_tpl_vars['pi']['viewed']): ?><li>Viewed <?php echo $this->_tpl_vars['pi']['viewed']; ?>
 times</li><?php endif; ?>
			</ul>

			<?php if ($this->_tpl_vars['IS_USER']): ?>
				<p><b><a href="javascript: void(0);" onclick="javascript: oAlbums.SHChngPopup( 1, 'id_chng_album_popup');"><?php if ($this->_tpl_vars['ai']['type'] == 1): ?>Move<?php elseif ($this->_tpl_vars['ai']['type'] == 2): ?>Copy<?php endif; ?> to another album</a></b></p>
				<p><b><a href="javascript: void(0);" onclick="javascript: oAlbums.SHConfirmPopup( 1, 'id_confirm_albums_popup' );">Delete</a></b></p>
			<?php endif; ?>
		</li>