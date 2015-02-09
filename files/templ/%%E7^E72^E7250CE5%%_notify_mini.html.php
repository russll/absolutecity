<?php /* Smarty version 2.6.11, created on 2014-03-15 08:51:14
         compiled from top_blocks/_notify_mini.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'top_blocks/_notify_mini.html', 6, false),array('modifier', 'truncate', 'top_blocks/_notify_mini.html', 10, false),array('modifier', 'count', 'top_blocks/_notify_mini.html', 21, false),array('function', 'html_str_format', 'top_blocks/_notify_mini.html', 9, false),)), $this); ?>
<div class="top-title"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/notify"><span>Notifications</span></a> <?php if ($this->_tpl_vars['ar_cnt_notify_mini']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/notify" class="aa"><?php echo $this->_tpl_vars['ar_cnt_notify_mini']; ?>
</a><?php endif; ?></div>

<?php if ($this->_tpl_vars['ar_notify_mini']): ?>
<div id="id_notif_mini_list">
<?php $_from = $this->_tpl_vars['ar_notify_mini']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
    <?php $this->assign('ntype', ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp='nf_')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['i']['wtype']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['i']['wtype'])))) ? $this->_run_mod_handler('cat', true, $_tmp, '_') : smarty_modifier_cat($_tmp, '_')))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['i']['type']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['i']['type']))); ?>
    <?php $this->assign('fname', ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['i']['first_name'])) ? $this->_run_mod_handler('cat', true, $_tmp, ' ') : smarty_modifier_cat($_tmp, ' ')))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['i']['last_name']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['i']['last_name']))); ?>
    <?php if (! $this->_tpl_vars['i']['to_uid']): ?>
    <p class="cl_top_mini_notify" <?php if (50 == $this->_tpl_vars['i']['type']): ?> n_frid="<?php echo $this->_tpl_vars['i']['uid']; ?>
" id="i_frid<?php echo $this->_tpl_vars['i']['uid']; ?>
"<?php endif; ?> style="min-height: 30px;"> <?php if (50 == $this->_tpl_vars['i']['type']): ?> <span><a href="javascript: void(0);" onclick="javascript: oSystem.SConfPopup( 'oFriends.InviteActAjax( <?php echo $this->_tpl_vars['i']['uid']; ?>
, 1 );', 'Please confirm you want to add <?php echo smarty_function_html_str_format(array('str' => $this->_tpl_vars['fname']), $this);?>
 as a friend?', 'Accept' );"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
ok_b.gif" alt="" /></a> <a href="javascript: void(0);" onclick="javascript: oSystem.SConfPopup( 'oFriends.InviteActAjax( <?php echo $this->_tpl_vars['i']['uid']; ?>
, 2 );', 'Please confirm you want to reject invitation from <?php echo smarty_function_html_str_format(array('str' => $this->_tpl_vars['fname']), $this);?>
?' );"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
del_b.gif" alt="" /></a></span> <?php endif; ?>
        <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
"><img src="<?php if ($this->_tpl_vars['i']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['i']['fpath']; ?>
/s/s_<?php echo $this->_tpl_vars['i']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m42.jpg<?php endif; ?>" style="width: 30px; height: 30px;" alt="" /></a> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['fname'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 25, "...") : smarty_modifier_truncate($_tmp, 25, "...")); ?>
</a> <?php echo $this->_config[0]['vars'][$this->_tpl_vars['ntype']]; ?>
 <?php if ($this->_tpl_vars['i']['link'] && $this->_tpl_vars['i']['link_txt']): ?> <a href="<?php echo $this->_tpl_vars['i']['link']; ?>
"> <?php echo ((is_array($_tmp=$this->_tpl_vars['i']['link_txt'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 10, "...", true) : smarty_modifier_truncate($_tmp, 10, "...", true)); ?>
</a> <?php endif; ?> <?php if ($this->_tpl_vars['i']['info'] && ! $this->_tpl_vars['i']['link'] && ! $this->_tpl_vars['i']['link_txt'] && ( 50 != $this->_tpl_vars['i']['type'] )): ?> "<?php echo ((is_array($_tmp=$this->_tpl_vars['i']['info'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 10, "...", true) : smarty_modifier_truncate($_tmp, 10, "...", true)); ?>
" <?php endif; ?>
    </p>
    <?php else: ?>
    <?php $this->assign('ntype_ext', ((is_array($_tmp=((is_array($_tmp='enf_1')) ? $this->_run_mod_handler('cat', true, $_tmp, '_') : smarty_modifier_cat($_tmp, '_')))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['i']['type']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['i']['type']))); ?>
    <p class="cl_top_mini_notify" <?php if (50 == $this->_tpl_vars['i']['type']): ?> n_frid="<?php echo $this->_tpl_vars['i']['uid']; ?>
" id="i_frid<?php echo $this->_tpl_vars['i']['uid']; ?>
" <?php endif; ?> style="min-height: 30px;"> <?php if (50 == $this->_tpl_vars['i']['type']): ?> <span><a href="javascript: void(0);" onclick="javascript: oSystem.SConfPopup( 'oFriends.InviteActAjax( <?php echo $this->_tpl_vars['i']['uid']; ?>
, 1 );', 'Please confirm you want to add <?php echo smarty_function_html_str_format(array('str' => $this->_tpl_vars['fname']), $this);?>
 as a friend?', 'Accept' );"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
ok_b.gif" alt="" /></a> <a href="javascript: void(0);" onclick="javascript: oSystem.SConfPopup( 'oFriends.InviteActAjax( <?php echo $this->_tpl_vars['i']['uid']; ?>
, 2 );', 'Please confirm you want to reject invitation from <?php echo smarty_function_html_str_format(array('str' => $this->_tpl_vars['fname']), $this);?>
?' );"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
del_b.gif" alt="" /></a></span> <?php endif; ?>
    <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
"><img src="<?php if ($this->_tpl_vars['i']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['i']['fpath']; ?>
/s/s_<?php echo $this->_tpl_vars['i']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m42.jpg<?php endif; ?>" style="width: 30px; height: 30px;" alt="" /></a> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['fname'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 25, "...") : smarty_modifier_truncate($_tmp, 25, "...")); ?>
</a> <?php echo $this->_config[0]['vars'][$this->_tpl_vars['ntype_ext']]; ?>
 <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['to_uid'];  if ($this->_tpl_vars['i']['notify_pos'] == 2): ?>/journal/<?php endif; ?>"><?php echo ((is_array($_tmp=$this->_tpl_vars['i']['to_first_name'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 25, "...") : smarty_modifier_truncate($_tmp, 25, "...")); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['i']['to_last_name'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 25, "...") : smarty_modifier_truncate($_tmp, 25, "...")); ?>
</a> <?php if ($this->_tpl_vars['i']['notify_pos'] == 2): ?>journal<?php else: ?>wall<?php endif; ?> <?php if ($this->_tpl_vars['i']['link'] && $this->_tpl_vars['i']['link_txt']): ?> <a href="<?php echo $this->_tpl_vars['i']['link']; ?>
"> <?php echo ((is_array($_tmp=$this->_tpl_vars['i']['link_txt'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 10, "...", true) : smarty_modifier_truncate($_tmp, 10, "...", true)); ?>
</a> <?php endif; ?> <?php if ($this->_tpl_vars['i']['info'] && ! $this->_tpl_vars['i']['link'] && ! $this->_tpl_vars['i']['link_txt'] && ( 50 != $this->_tpl_vars['i']['type'] )): ?> "<?php echo ((is_array($_tmp=$this->_tpl_vars['i']['info'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 10, "...", true) : smarty_modifier_truncate($_tmp, 10, "...", true)); ?>
"
    <?php endif; ?>
    </p>
    <?php endif;  endforeach; endif; unset($_from); ?>

<?php $this->assign('ncnt', count($this->_tpl_vars['ar_notify_mini']));  if (3 > $this->_tpl_vars['ncnt']*1.0): ?>
    <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=3) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['start'] = (int)$this->_tpl_vars['ncnt'];
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
if ($this->_sections['i']['start'] < 0)
    $this->_sections['i']['start'] = max($this->_sections['i']['step'] > 0 ? 0 : -1, $this->_sections['i']['loop'] + $this->_sections['i']['start']);
else
    $this->_sections['i']['start'] = min($this->_sections['i']['start'], $this->_sections['i']['step'] > 0 ? $this->_sections['i']['loop'] : $this->_sections['i']['loop']-1);
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = min(ceil(($this->_sections['i']['step'] > 0 ? $this->_sections['i']['loop'] - $this->_sections['i']['start'] : $this->_sections['i']['start']+1)/abs($this->_sections['i']['step'])), $this->_sections['i']['max']);
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
    <p style="<?php if (1 == $this->_tpl_vars['ncnt']): ?> margin-top:5px; <?php endif; ?> width: 30px; height: 30px;"> <a href="javascript: void(0);"> &nbsp </a> </p>
    <?php endfor; endif;  endif; ?>
</div>

<?php if (1 < $this->_tpl_vars['notify_pages']): ?>
<div class="top-bar">
    <table>
        <tr>
            <!--td><span><a href="#"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
topbar_left.gif" alt="" /></a></span></td-->
	    <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['notify_pages']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	    <?php $this->assign('ind', $this->_sections['i']['index']); ?>
            <td><a class="<?php if (0 == $this->_tpl_vars['ind']): ?> act <?php endif; ?> notify_pagging" href="#" first="<?php echo $this->_tpl_vars['ind']*3; ?>
" last="3"></a></td>
	    <?php endfor; endif; ?>
            <!--td><span><a href="#"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
topbar_right.gif" alt="" /></a></span></td-->
        </tr>
    </table>
</div>
<?php endif;  else: ?>
<p>No new notifications</p>
<?php endif; ?>