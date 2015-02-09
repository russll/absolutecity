<?php /* Smarty version 2.6.11, created on 2014-04-04 23:02:17
         compiled from mods/users/ajax/_show_edu.html */ ?>
<span class="edit-info" id="edu_edit" style="display:none;"> <?php if ($this->_tpl_vars['IS_USER']): ?> <a href="javascript:oUsers.SettingsEdu();">Edit</a> <?php else: ?> &nbsp <?php endif; ?></span>
<table>
    <?php if ($this->_tpl_vars['ui']['university'] || $this->_tpl_vars['ui']['hschool'] || $this->_tpl_vars['ui']['job']): ?>
        <?php if ($this->_tpl_vars['ui']['university']): ?>
            <?php $_from = $this->_tpl_vars['ui']['university']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['n'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['n']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['n']['iteration']++;
?>
            <tr>
				<td width="150">
					<?php if (($this->_foreach['n']['iteration'] <= 1)): ?><label>College/University</label><?php endif; ?>
				</td>
				<td>
					<?php echo $this->_tpl_vars['i']['university'];  if ($this->_tpl_vars['i']['cyear']): ?>, <?php echo $this->_tpl_vars['i']['cyear'];  if ($this->_tpl_vars['i']['cyear2']): ?> - <?php echo $this->_tpl_vars['i']['cyear2'];  endif;  endif;  if ($this->_tpl_vars['i']['major']): ?>, <?php echo $this->_tpl_vars['i']['major'];  endif;  if ($this->_tpl_vars['i']['minor']): ?>, <?php echo $this->_tpl_vars['i']['minor'];  endif; ?>
				</td>
			</tr>
            <?php endforeach; endif; unset($_from); ?>
        <?php endif; ?>

        <?php if ($this->_tpl_vars['ui']['hschool']): ?>
            <?php $_from = $this->_tpl_vars['ui']['hschool']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['n'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['n']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['n']['iteration']++;
?>
            <tr>
				<td width="150">
					<?php if (($this->_foreach['n']['iteration'] <= 1)): ?><label>High school</label><?php endif; ?>
				</td>
				<td>
					<?php echo $this->_tpl_vars['i']['hschool'];  if ($this->_tpl_vars['i']['hyear']): ?>, <?php echo $this->_tpl_vars['i']['hyear'];  if ($this->_tpl_vars['i']['hyear2']): ?> - <?php echo $this->_tpl_vars['i']['hyear2'];  endif;  endif; ?>
				</td>
			</tr>
            <?php endforeach; endif; unset($_from); ?>
        <?php endif; ?>

        <?php if ($this->_tpl_vars['ui']['job']): ?>
            <?php $_from = $this->_tpl_vars['ui']['job']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['n'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['n']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['n']['iteration']++;
?>
            <tr><td width="150"><?php if (($this->_foreach['n']['iteration'] <= 1)): ?><label>Job</label><?php endif; ?></td><td><?php $this->assign('ov', $this->_tpl_vars['i']['estatus']);  echo $this->_tpl_vars['estatuses'][$this->_tpl_vars['ov']]; ?>
 - <?php echo $this->_tpl_vars['i']['employer'];  if ($this->_tpl_vars['i']['pos']): ?>, <?php echo $this->_tpl_vars['i']['pos'];  endif;  if ($this->_tpl_vars['i']['descr']): ?>, <?php echo $this->_tpl_vars['i']['descr'];  endif;  if ($this->_tpl_vars['i']['fyear'] && $this->_tpl_vars['i']['fmonth']): ?>, <?php echo $this->_tpl_vars['i']['fmonth']; ?>
/<?php echo $this->_tpl_vars['i']['fyear'];  elseif ($this->_tpl_vars['i']['fyear']): ?>, <?php echo $this->_tpl_vars['i']['fyear'];  endif;  if ($this->_tpl_vars['i']['present']): ?> - present<?php else:  if ($this->_tpl_vars['i']['tyear'] && $this->_tpl_vars['i']['tmonth']): ?> - <?php echo $this->_tpl_vars['i']['tmonth']; ?>
/<?php echo $this->_tpl_vars['i']['tyear'];  elseif ($this->_tpl_vars['i']['tyear']): ?> - <?php echo $this->_tpl_vars['i']['tyear'];  endif;  endif; ?></td></tr>
            <?php endforeach; endif; unset($_from); ?>
        <?php endif; ?>
    <?php else: ?>
    <tr><td width="150"><label>None</label></td><td>&nbsp;</td></tr>
    <?php endif; ?>
</table>