<?php /* Smarty version 2.6.11, created on 2014-03-15 08:51:14
         compiled from top_blocks/_badge.html */ ?>
<div>
    &nbsp;
    <?php unset($this->_sections['vertical']);
$this->_sections['vertical']['name'] = 'vertical';
$this->_sections['vertical']['loop'] = is_array($_loop=$this->_tpl_vars['badge_array']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['vertical']['start'] = (int)0;
$this->_sections['vertical']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['vertical']['show'] = true;
$this->_sections['vertical']['max'] = $this->_sections['vertical']['loop'];
if ($this->_sections['vertical']['start'] < 0)
    $this->_sections['vertical']['start'] = max($this->_sections['vertical']['step'] > 0 ? 0 : -1, $this->_sections['vertical']['loop'] + $this->_sections['vertical']['start']);
else
    $this->_sections['vertical']['start'] = min($this->_sections['vertical']['start'], $this->_sections['vertical']['step'] > 0 ? $this->_sections['vertical']['loop'] : $this->_sections['vertical']['loop']-1);
if ($this->_sections['vertical']['show']) {
    $this->_sections['vertical']['total'] = min(ceil(($this->_sections['vertical']['step'] > 0 ? $this->_sections['vertical']['loop'] - $this->_sections['vertical']['start'] : $this->_sections['vertical']['start']+1)/abs($this->_sections['vertical']['step'])), $this->_sections['vertical']['max']);
    if ($this->_sections['vertical']['total'] == 0)
        $this->_sections['vertical']['show'] = false;
} else
    $this->_sections['vertical']['total'] = 0;
if ($this->_sections['vertical']['show']):

            for ($this->_sections['vertical']['index'] = $this->_sections['vertical']['start'], $this->_sections['vertical']['iteration'] = 1;
                 $this->_sections['vertical']['iteration'] <= $this->_sections['vertical']['total'];
                 $this->_sections['vertical']['index'] += $this->_sections['vertical']['step'], $this->_sections['vertical']['iteration']++):
$this->_sections['vertical']['rownum'] = $this->_sections['vertical']['iteration'];
$this->_sections['vertical']['index_prev'] = $this->_sections['vertical']['index'] - $this->_sections['vertical']['step'];
$this->_sections['vertical']['index_next'] = $this->_sections['vertical']['index'] + $this->_sections['vertical']['step'];
$this->_sections['vertical']['first']      = ($this->_sections['vertical']['iteration'] == 1);
$this->_sections['vertical']['last']       = ($this->_sections['vertical']['iteration'] == $this->_sections['vertical']['total']);
?>
    <?php $this->assign('index', $this->_sections['vertical']['index']); ?>
    <?php $this->assign('name', $this->_tpl_vars['badge_array'][$this->_tpl_vars['index']]); ?>
       <a href="javascript:void(0);" onclick="$('#select_badge').attr('src','<?php echo $this->_tpl_vars['imgDir']; ?>
badges/<?php echo $this->_tpl_vars['name']; ?>
.png').attr('alt','<?php echo $this->_tpl_vars['name']; ?>
');$('#id_send_inp_badge_img_val').val('<?php echo $this->_tpl_vars['name']; ?>
');" /><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
badges/<?php echo $this->_tpl_vars['name']; ?>
.png" alt="Badge" <?php if ($this->_tpl_vars['name'] == 'LDS'): ?>style="margin-left:5px;;"<?php endif; ?>/></a>
    <?php endfor; endif; ?>
</div>