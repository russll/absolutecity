<?php /* Smarty version 2.6.11, created on 2014-08-07 16:12:42
         compiled from mods/users/ajax/_edit_edu.html */ ?>
<form method="post" id="edu_info_form">
<table class="t-edit">
    <tbody id="edu_college">
    <?php $_from = $this->_tpl_vars['universities']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
		<tr>
			<td width="150">
				<label>College/University</label>
			</td>

			<td>
				<input class="txt3" type="text" name="fm[university][]" value="<?php echo $this->_tpl_vars['fm']['university'][$this->_tpl_vars['k']]; ?>
" />
				<span class="niceform">
					<select name="fm[cyear][]" size="1" style="width:58px;">
						<option value="0">From</option>
						<?php $_from = $this->_tpl_vars['yy']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k2'] => $this->_tpl_vars['i2']):
?>
							<option value="<?php echo $this->_tpl_vars['i2']; ?>
"<?php if ($this->_tpl_vars['i2'] == $this->_tpl_vars['fm']['cyear'][$this->_tpl_vars['k']]): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['i2']; ?>
</option>
						<?php endforeach; endif; unset($_from); ?>
					</select>
				</span>
				<span class="niceform">
					<select name="fm[cyear2][]" size="1" style="width:58px;">
						<option value="0">To</option>
						<?php $_from = $this->_tpl_vars['yy']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k2'] => $this->_tpl_vars['i2']):
?>
							<option value="<?php echo $this->_tpl_vars['i2']; ?>
"<?php if ($this->_tpl_vars['i2'] == $this->_tpl_vars['fm']['cyear2'][$this->_tpl_vars['k']]): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['i2']; ?>
</option>
						<?php endforeach; endif; unset($_from); ?>
					</select>
				</span>
			</td>
		</tr>
		
		<tr>
			<td width="150"><label>Major</label></td>
			<td>
				<input class="txt3" type="text" name="fm[major][]" value="<?php echo $this->_tpl_vars['fm']['major'][$this->_tpl_vars['k']]; ?>
" />
			</td>
		</tr>
		
		<tr>
			<td width="150"><label>Minor</label></td>
			<td>
				<input type="text" class="txt3" name="fm[minor][]" value="<?php echo $this->_tpl_vars['fm']['minor'][$this->_tpl_vars['k']]; ?>
">
				<div class="clear"></div>
				<div><a href="javascript:void(0);" onclick="oUsers.SettingsEduDelCollege( $(this).parent().parent().parent() );">Remove college/university</a></div>
			</td>
		</tr>
    <?php endforeach; endif; unset($_from); ?>
    </tbody>

	<tbody>
		<tr>
			<td width="150"></td>
			<td>
				<a href="javascript:oUsers.SettingsEduAddCollege();">Add another college/university</a>
			</td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
	</tbody>

    <tbody id="edu_hschool">
	<?php $_from = $this->_tpl_vars['hschools']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
		<tr>
			<td width="150"><label>High school</label></td>
		    <td>
			    <input class="txt3" name="fm[hschool][]" type="text" value="<?php echo $this->_tpl_vars['fm']['hschool'][$this->_tpl_vars['k']]; ?>
" />
				<span class="niceform">
					<select name="fm[hyear][]" size="1" style="width:58px;">
						<option value="0">From</option>
						<?php $_from = $this->_tpl_vars['yy']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k2'] => $this->_tpl_vars['i2']):
?>
                        <option value="<?php echo $this->_tpl_vars['i2']; ?>
"<?php if ($this->_tpl_vars['i2'] == $this->_tpl_vars['fm']['hyear'][$this->_tpl_vars['k']]): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['i2']; ?>
</option>
						<?php endforeach; endif; unset($_from); ?>
                    </select>
				</span>
				<span class="niceform">
					<select name="fm[hyear2][]" size="1" style="width:58px;">
						<option value="0">To</option>
						<?php $_from = $this->_tpl_vars['yy']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k2'] => $this->_tpl_vars['i2']):
?>
                        <option value="<?php echo $this->_tpl_vars['i2']; ?>
"<?php if ($this->_tpl_vars['i2'] == $this->_tpl_vars['fm']['hyear2'][$this->_tpl_vars['k']]): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['i2']; ?>
</option>
						<?php endforeach; endif; unset($_from); ?>
                    </select>
				</span>
				<div class="clear"></div>
				<div><a href="javascript:void(0);" onclick="oUsers.SettingsEduDelHSchool( $(this).parent().parent().parent() );">Remove high school</a></div>
			</td>
		</tr>
    <?php endforeach; endif; unset($_from); ?>
    </tbody>

	<tbody>
		<tr>
			<td width="150"></td>
			<td><a href="javascript:oUsers.SettingsEduAddHSchool();">Add another high school</a></td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
	</tbody>

    <tbody id="edu_job">
    <?php $_from = $this->_tpl_vars['jobs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
		<tr>
			<td width="150">
				<label>Employment status</label>
			</td>
			<td>
				<span class="niceform">
					<select size="1" name="fm[estatus][]">
						<?php $_from = $this->_tpl_vars['estatuses']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k2'] => $this->_tpl_vars['i2']):
?>
						<option value="<?php echo $this->_tpl_vars['k2']; ?>
"<?php if ($this->_tpl_vars['fm']['estatus'][$this->_tpl_vars['k']] == $this->_tpl_vars['k2']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['i2']; ?>
</option>
						<?php endforeach; endif; unset($_from); ?>
					</select>
				</span>
            </td>
		</tr>

		<tr>
			<td width="150">
				<label>Employer</label>
			</td>
			<td>
				<input class="txt3" name="fm[employer][]" type="text" value="<?php echo $this->_tpl_vars['fm']['employer'][$this->_tpl_vars['k']]; ?>
" />
			</td>
		</tr>

		<tr><td width="150"><label>Position</label></td><td><input class="txt3" type="text" name="fm[pos][]" value="<?php echo $this->_tpl_vars['fm']['pos'][$this->_tpl_vars['k']]; ?>
" /></td></tr>
		<tr><td width="150"><label>Position description</label></td><td><input class="txt3" type="text" name="fm[descr][]" value="<?php echo $this->_tpl_vars['fm']['descr'][$this->_tpl_vars['k']]; ?>
" /></td></tr>
		<tr><td width="150"><label>City/Town</label></td><td><input class="txt3" type="text" name="fm[city][]" value="<?php echo $this->_tpl_vars['fm']['city'][$this->_tpl_vars['k']]; ?>
" /></td></tr>
		<tr>
			<td width="150"><label>Time period from</label></td>
			<td>
				<span class="niceform">
					<select name="fm[fmonth][]" size="1">
						<option value="0">Month</option>
                        <?php $_from = $this->_tpl_vars['mm']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k2'] => $this->_tpl_vars['i2']):
?>
                        <option value="<?php echo $this->_tpl_vars['k2']; ?>
"<?php if ($this->_tpl_vars['k2'] == $this->_tpl_vars['fm']['fmonth'][$this->_tpl_vars['k']]): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['i2']; ?>
</option>
						<?php endforeach; endif; unset($_from); ?>
                    </select>
				</span>
				
				<span class="niceform">
					<select  name="fm[fyear][]" size="1">
						<option value="0">Year</option>
						<?php $_from = $this->_tpl_vars['yy']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k2'] => $this->_tpl_vars['i2']):
?>
                        <option value="<?php echo $this->_tpl_vars['i2']; ?>
"<?php if ($this->_tpl_vars['i2'] == $this->_tpl_vars['fm']['fyear'][$this->_tpl_vars['k']]): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['i2']; ?>
</option>
						<?php endforeach; endif; unset($_from); ?>
                    </select>
				</span>
				<input type="checkbox" name="fm[present][]"<?php if ($this->_tpl_vars['fm']['present'][$this->_tpl_vars['k']]): ?> checked="checked"<?php endif; ?> /> To present
			</td>
		</tr>

		<tr>
			<td width="150"><label>to</label></td>
			<td>
				<span class="niceform">
					<select name="fm[tmonth][]" size="1">
                        <option value="0">Month</option>
                        <?php $_from = $this->_tpl_vars['mm']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k2'] => $this->_tpl_vars['i2']):
?>
                        <option value="<?php echo $this->_tpl_vars['k2']; ?>
"<?php if ($this->_tpl_vars['k2'] == $this->_tpl_vars['fm']['tmonth'][$this->_tpl_vars['k']]): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['i2']; ?>
</option>
						<?php endforeach; endif; unset($_from); ?>
                    </select>
				</span>
				<span class="niceform">
					<select name="fm[tyear][]" size="1">
						<option value="0">Year</option>
						<?php $_from = $this->_tpl_vars['yy']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k2'] => $this->_tpl_vars['i2']):
?>
						<option value="<?php echo $this->_tpl_vars['i2']; ?>
"<?php if ($this->_tpl_vars['i2'] == $this->_tpl_vars['fm']['tyear'][$this->_tpl_vars['k']]): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['i2']; ?>
</option>
						<?php endforeach; endif; unset($_from); ?>
                    </select>
				</span>
				<div class="clear"></div>
				<div><a href="javascript:void(0);" onclick="oUsers.SettingsEduDelJob( $(this).parent().parent().parent() );">Remove job</a></div>
			</td>
		</tr>
    <?php endforeach; endif; unset($_from); ?>
    </tbody>

	<tbody>
		<tr>
			<td width="150"></td><td><a href="javascript:oUsers.SettingsEduAddJob();">Add another job</a>
			</td>
		</tr>

		<tr style="height:50px;">
			<td colspan="2" align="right">
				<div class="aj-button">
					<span class="aj-button01"><a href="javascript:void(0);" id="basic_cancel" onclick="oUsers.SettingsEduCnl();">Cancel</a></span>
					<span class="aj-button02"><a href="javascript:void(0);" id="basic_save" onclick="oUsers.SettingsEduSubm();">Save</a></span>
				</div>
			</td>
		</tr>
	</tbody>
</table>
</form>