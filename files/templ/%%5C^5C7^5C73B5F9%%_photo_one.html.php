<?php /* Smarty version 2.6.11, created on 2014-09-18 12:51:58
         compiled from mods/albums/_photo_one.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_tmpl_time', 'mods/albums/_photo_one.html', 35, false),)), $this); ?>
				<input id="aid" type="hidden" value="<?php echo $this->_tpl_vars['pi']['aid']; ?>
" />
				<input id="pid" type="hidden" value="<?php echo $this->_tpl_vars['pi']['id']; ?>
" />
							
				<div class="gallery">
					<a id="id_arr_left" href="javascript: void(0);" onclick="javascript: oAlbums.ReloadImgContent( <?php echo $this->_tpl_vars['ai']['aid']; ?>
, <?php echo $this->_tpl_vars['pimg']; ?>
 );" class="pre" style="visibility: hidden;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
gal_arr_left.png"  /></a>
					<a id="id_arr_right" href="javascript: void(0);" onclick="javascript: oAlbums.ReloadImgContent( <?php echo $this->_tpl_vars['ai']['aid']; ?>
, <?php echo $this->_tpl_vars['nimg']; ?>
 );" class="next" style="visibility: hidden;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
gal_arr_right.png"  /></a>
					<div>
						<ul>
							<li style="width: 100%; text-align: center;"><a href="javascript: void(0);" <?php if ($this->_tpl_vars['nimg']): ?>onclick="javascript: oAlbums.ReloadImgContent( <?php echo $this->_tpl_vars['ai']['aid']; ?>
, <?php echo $this->_tpl_vars['nimg']; ?>
 );"<?php endif; ?>><img id="id_img_b"<?php if ($this->_tpl_vars['pi']['fpath'] == 'link'): ?> style="visibility: hidden" onload="oAlbums.ResizeUrlImage(<?php if ($this->_tpl_vars['pimg']):  echo $this->_tpl_vars['pimg'];  else: ?>''<?php endif; ?>,<?php if ($this->_tpl_vars['nimg']):  echo $this->_tpl_vars['nimg'];  else: ?>''<?php endif; ?>);"<?php endif; ?> src="<?php if ($this->_tpl_vars['pi']['fpath'] == 'link'):  echo $this->_tpl_vars['pi']['img'];  else:  echo $this->_tpl_vars['fImgDir'];  if (2 == $this->_tpl_vars['ai']['type']):  if ('Wall' == $this->_tpl_vars['ai']['name']): ?>wall/<?php elseif ('Inbox' == $this->_tpl_vars['ai']['name']): ?>inbox/<?php elseif ('Journal' == $this->_tpl_vars['ai']['name']): ?>journal/<?php elseif ('Mission' == $this->_tpl_vars['ai']['name']): ?>mission/wall/<?php elseif ('Ward' == $this->_tpl_vars['ai']['name']): ?>wards/wall/<?php endif;  else: ?>albums/<?php endif;  echo $this->_tpl_vars['pi']['fpath']; ?>
/n/n_<?php echo $this->_tpl_vars['pi']['img'];  endif; ?>"  /></a></li>
						</ul>
					</div>
				</div>

				<?php if ($this->_tpl_vars['pi']['descr']): ?>
				<div class="gal-add">
					<p><?php echo $this->_tpl_vars['pi']['descr']; ?>
</p>
				</div>
				<?php endif; ?>
				
				<div class="gal-add">
				<form id="id_img_com_frm" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/albums/id<?php echo $this->_tpl_vars['ai']['aid']; ?>
/id<?php echo $this->_tpl_vars['pi']['id']; ?>
/geteditphotoajax/?rtype=com" method="post">
					<div><textarea id="id_photo_com_text" name="CI[text]"></textarea></div>
					<p><a href="javascript: void(0);" onclick="javascript: oAlbums.ReloadImgBoxCom( 2, '<?php echo $this->_tpl_vars['ai']['aid']; ?>
', '<?php echo $this->_tpl_vars['pi']['id']; ?>
' );"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
btn_add_com.gif" /></a></p>
				</form>
				</div>
				
				<div class="gal-comment">
					<?php if ($this->_tpl_vars['cnt_img_com']): ?><h2><?php echo $this->_tpl_vars['cnt_img_com']; ?>
 comments</h2><?php endif; ?>			
					<ul id="id_img_box_com" class="recomment">
					<?php if ($this->_tpl_vars['ar_img_com']): ?>
					<?php $_from = $this->_tpl_vars['ar_img_com']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
						<li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['user_id']; ?>
"><img src="<?php if ($this->_tpl_vars['i']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['i']['user_fpath']; ?>
/s/s_<?php echo $this->_tpl_vars['i']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m56.jpg<?php endif; ?>"  style="width: 56px; height: 56px;" /></a>
							<div>
							<p><a href="#"><?php echo $this->_tpl_vars['i']['text']; ?>
</p>
							<p><span><?php echo smarty_function_html_tmpl_time(array('val' => $this->_tpl_vars['i']['dt'],'type' => 1), $this);?>
</span></p>
							</div>
						</li>
					<?php endforeach; endif; unset($_from); ?>
					<li>
						<a class="prev" href="javascript: void(0);" onclick="javascript: oAlbums.ReloadImgBoxCom( 1, '<?php echo $this->_tpl_vars['ai']['aid']; ?>
', '<?php echo $this->_tpl_vars['pi']['id']; ?>
', '<?php echo $this->_tpl_vars['fcnt']; ?>
', 2 );" <?php if (0 == $this->_tpl_vars['fcnt']): ?> style="visibility: hidden;" <?php endif; ?>>previous</a>
						<a class="next" href="javascript: void(0);" onclick="javascript: oAlbums.ReloadImgBoxCom( 1, '<?php echo $this->_tpl_vars['ai']['aid']; ?>
', '<?php echo $this->_tpl_vars['pi']['id']; ?>
', '<?php echo $this->_tpl_vars['fcnt']; ?>
', 1 );" <?php if ($this->_tpl_vars['cnt_img_com'] <= ( $this->_tpl_vars['fcnt'] + $this->_tpl_vars['pcnt'] )): ?> style="visibility: hidden;" <?php endif; ?> >next</a>
					</li>
					<?php else: ?>
						<li>There aren't any comments</li>
					<?php endif; ?>
					</ul>
				</div>