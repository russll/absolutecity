<?php /* Smarty version 2.6.11, created on 2014-07-25 10:02:35
         compiled from mods/valbums/_videos.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'mods/valbums/_videos.html', 16, false),array('function', 'html_tmpl_time', 'mods/valbums/_videos.html', 24, false),)), $this); ?>
<?php if (2 == $this->_tpl_vars['ai']['type']): ?>
<h2><em></em> System video Album - <?php echo $this->_tpl_vars['ai']['name']; ?>
</h2>
<?php else: ?>
<h2><em></em> <?php echo $this->_tpl_vars['ai']['name']; ?>
 <?php if ($this->_tpl_vars['cnt_pl']): ?><span><?php echo $this->_tpl_vars['cnt_pl']; ?>
</span><?php endif; ?></h2>
<?php endif; ?>
<table class="album-box">
    <?php if ($this->_tpl_vars['vl']): ?>
    <?php $this->assign('ind', 0); ?>
    <?php unset($this->_sections['hi']);
$this->_sections['hi']['name'] = 'hi';
$this->_sections['hi']['loop'] = is_array($_loop=$this->_tpl_vars['cnt_hpl']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['hi']['show'] = true;
$this->_sections['hi']['max'] = $this->_sections['hi']['loop'];
$this->_sections['hi']['step'] = 1;
$this->_sections['hi']['start'] = $this->_sections['hi']['step'] > 0 ? 0 : $this->_sections['hi']['loop']-1;
if ($this->_sections['hi']['show']) {
    $this->_sections['hi']['total'] = $this->_sections['hi']['loop'];
    if ($this->_sections['hi']['total'] == 0)
        $this->_sections['hi']['show'] = false;
} else
    $this->_sections['hi']['total'] = 0;
if ($this->_sections['hi']['show']):

            for ($this->_sections['hi']['index'] = $this->_sections['hi']['start'], $this->_sections['hi']['iteration'] = 1;
                 $this->_sections['hi']['iteration'] <= $this->_sections['hi']['total'];
                 $this->_sections['hi']['index'] += $this->_sections['hi']['step'], $this->_sections['hi']['iteration']++):
$this->_sections['hi']['rownum'] = $this->_sections['hi']['iteration'];
$this->_sections['hi']['index_prev'] = $this->_sections['hi']['index'] - $this->_sections['hi']['step'];
$this->_sections['hi']['index_next'] = $this->_sections['hi']['index'] + $this->_sections['hi']['step'];
$this->_sections['hi']['first']      = ($this->_sections['hi']['iteration'] == 1);
$this->_sections['hi']['last']       = ($this->_sections['hi']['iteration'] == $this->_sections['hi']['total']);
?>
    <?php $this->assign('ind', $this->_tpl_vars['ind']); ?>
    <tr>
	<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['vl']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['start'] = (int)$this->_tpl_vars['ind'];
$this->_sections['i']['max'] = (int)2;
$this->_sections['i']['show'] = true;
if ($this->_sections['i']['max'] < 0)
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
	<?php $this->assign('ind', $this->_tpl_vars['ind']+1); ?>
        <td>
            <p style="width: 100%; text-align: center;"><object wmode="opaque" style="z-index: 300;"><?php echo $this->_tpl_vars['vl'][$this->_sections['i']['index']]['video']; ?>
</object></p>
            <p style="width: 100%; text-align: center;">Uploaded on <?php echo ((is_array($_tmp=$this->_tpl_vars['vl'][$this->_sections['i']['index']]['dt'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%b %d, %Y") : smarty_modifier_date_format($_tmp, "%b %d, %Y")); ?>
</p>
            <p style="width: 100%; text-align: center;"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/valbums/id<?php echo $this->_tpl_vars['vl'][$this->_sections['i']['index']]['vaid']; ?>
/id<?php echo $this->_tpl_vars['vl'][$this->_sections['i']['index']]['id']; ?>
">View this video <?php echo $this->_tpl_vars['vl'][$this->_sections['i']['index']]['name']; ?>
</a></p>
            <ul class="recomment">
	    <?php if ($this->_tpl_vars['vl'][$this->_sections['i']['index']]['lcom']): ?>
	        <?php $this->assign('ccom', $this->_tpl_vars['vl'][$this->_sections['i']['index']]['lcom']); ?>
                <li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ccom']['user_id']; ?>
"><img src="<?php if ($this->_tpl_vars['ccom']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['ccom']['fpath']; ?>
/s/s_<?php echo $this->_tpl_vars['ccom']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m56.jpg<?php endif; ?>"  style="width: 56px; height: 56px;" /></a>
                    <div>
                        <p><a href="#"><?php if ($this->_tpl_vars['ccom']['first_name'] || $this->_tpl_vars['ccom']['last_name']): ?> <?php echo $this->_tpl_vars['ccom']['first_name']; ?>
 <?php echo $this->_tpl_vars['ccom']['last_name']; ?>
 <?php else: ?> <?php echo $this->_tpl_vars['ccom']['public_name']; ?>
 <?php endif; ?></a> <?php echo $this->_tpl_vars['ccom']['text']; ?>
 </p>
                        <p><span><?php echo smarty_function_html_tmpl_time(array('val' => $this->_tpl_vars['ccom']['dt'],'type' => 1), $this);?>
</span></p>
                    </div>
                </li>
		<?php endif; ?>
            </ul>
        </td>
	<?php endfor; endif; ?>
    </tr>
    <?php endfor; endif; ?>
	<tr><td colspan="2"><?php echo $this->_tpl_vars['pagging']; ?>
</td></tr>
    <?php else: ?>

    <tr>
        <td>
	There aren't any videos
        </td>
    </tr>
    <?php endif; ?>
</table>