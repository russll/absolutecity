<?php /* Smarty version 2.6.11, created on 2014-04-23 21:00:42
         compiled from mods/albums/_photos.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'mods/albums/_photos.html', 31, false),array('modifier', 'date_format', 'mods/albums/_photos.html', 41, false),)), $this); ?>
<?php if ($this->_tpl_vars['taglist']): ?>
	<h2>Photos for tag "<?php echo $this->_tpl_vars['tag']; ?>
" <?php if ($this->_tpl_vars['cnt_pl']): ?><span><?php echo $this->_tpl_vars['cnt_pl']; ?>
</span><?php endif; ?></h2>
<?php else: ?>
	<?php if (2 == $this->_tpl_vars['ai']['type']): ?>
		<h2><em></em> System album - <?php echo $this->_tpl_vars['ai']['name']; ?>
</h2>
	<?php else: ?>
		<h2> <?php echo $this->_tpl_vars['ai']['name']; ?>
 <?php if ($this->_tpl_vars['cnt_pl']): ?><span><?php echo $this->_tpl_vars['cnt_pl']; ?>
</span><?php endif; ?></h2>
	<?php endif;  endif; ?>

<input id="aid" type="hidden" value="<?php echo $this->_tpl_vars['ai']['aid']; ?>
" />

<?php if ($this->_tpl_vars['pl']): ?>
<table>
	<tr>
		<td>
			<?php $this->assign('ind', 0); ?>
			<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['pl']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>

				<div class="flow-box" id="id_alb_photos_cp_<?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['id']; ?>
">
					<div class="boxgrid captionfull" onmouseover="javascript: $('#id_famous_bridge_<?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['id']; ?>
').css('top', '125px');" onmouseout="javascript: $('#id_famous_bridge_<?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['id']; ?>
').css('top', '230px');" >
						<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/albums/id<?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['aid']; ?>
/id<?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['id']; ?>
" >
							<?php if ($this->_tpl_vars['taglist']): ?>
								<img src="<?php if ($this->_tpl_vars['pl'][$this->_sections['i']['index']]['fpath'] == 'link'):  echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['img'];  else:  echo $this->_tpl_vars['fImgDir'];  if (2 == $this->_tpl_vars['pl'][$this->_sections['i']['index']]['a_type']):  if ('Wall' == $this->_tpl_vars['pl'][$this->_sections['i']['index']]['a_name']): ?>wall<?php elseif ('Mission' == $this->_tpl_vars['pl'][$this->_sections['i']['index']]['a_name']): ?>mission/wall<?php elseif ('Journal' == $this->_tpl_vars['pl'][$this->_sections['i']['index']]['a_name']): ?>journal<?php elseif ('Inbox' == $this->_tpl_vars['pl'][$this->_sections['i']['index']]['a_name']): ?>inbox<?php elseif ('Ward' == $this->_tpl_vars['pl'][$this->_sections['i']['index']]['a_name']): ?>wards/wall<?php endif;  else: ?>albums<?php endif; ?>/<?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['fpath']; ?>
/a/a_<?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['img'];  endif; ?>" style="max-width: 230px; max-height: 154px;" />
							<?php else: ?>
								<img src="<?php if ($this->_tpl_vars['pl'][$this->_sections['i']['index']]['fpath'] == 'link'):  echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['img'];  else:  echo $this->_tpl_vars['fImgDir'];  if (2 == $this->_tpl_vars['ai']['type']):  if ('Wall' == $this->_tpl_vars['ai']['name']): ?>wall<?php elseif ('Mission' == $this->_tpl_vars['ai']['name']): ?>mission/wall<?php elseif ('Journal' == $this->_tpl_vars['ai']['name']): ?>journal<?php elseif ('Inbox' == $this->_tpl_vars['ai']['name']): ?>inbox<?php elseif ('Ward' == $this->_tpl_vars['ai']['name']): ?>wards/wall<?php endif;  else: ?>albums<?php endif; ?>/<?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['fpath']; ?>
/a/a_<?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['img'];  endif; ?>" style="max-width: 230px; max-height: 154px;"/>
							<?php endif; ?>
						</a>
						<div style="top: 260px;" class="cover boxcaption" id="id_famous_bridge_<?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['id']; ?>
" onmouseover="javascript: $('#id_famous_bridge_<?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['id']; ?>
').css('top', '125px');" onmouseout="javascript: $('#id_famous_bridge_<?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['id']; ?>
').css('top', '230px');">
							<p>
								<a href="javascript: void(0);" style="cursor: default; text-decoration: none; position:absolute;right:100px;"><?php echo ((is_array($_tmp=$this->_tpl_vars['pl'][$this->_sections['i']['index']]['descr'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 25, "...", false) : smarty_modifier_truncate($_tmp, 25, "...", false)); ?>
</a>
																<?php if ($this->_tpl_vars['IS_USER']): ?>
									<a class="ico02" href="javascript: void(0);" onclick="javascript: oAlbums.SHConfirmPopup( 1, 'id_confirm_albums_popup', <?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['id']; ?>
 );"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico0002.gif"  /></a>
									<a class="ico01" href="javascript: void(0);" onclick="javascript: oAlbums.SHChngPopup( 1, 'id_chng_album_popup', <?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['id']; ?>
, <?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['aid']; ?>
 );"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico0001.gif"  /></a>
								<?php endif; ?>
							</p>
						</div>
					</div>

					<p align="center">Uploaded on <?php echo ((is_array($_tmp=$this->_tpl_vars['pl'][$this->_sections['i']['index']]['dt'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%b %d, %Y") : smarty_modifier_date_format($_tmp, "%b %d, %Y")); ?>
</p>
					<p align="center">
						<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/albums/id<?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['aid']; ?>
/id<?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['id']; ?>
">
							<?php if ($this->_tpl_vars['pl'][$this->_sections['i']['index']]['cnt_com']): ?>View <?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['cnt_com']; ?>
 comments<?php else: ?>No comments<?php endif; ?>
						</a>
					</p>
				</div>

			<?php endfor; endif; ?>
		</td>
	</tr>

	<tr>
		<td><?php echo $this->_tpl_vars['pagging']; ?>
</td>
	</tr>
</table>
	
	
<?php else: ?>
	<div class="flow-box">
		There aren't any photos
	</div>
<?php endif; ?>