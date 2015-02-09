<?php /* Smarty version 2.6.11, created on 2014-10-26 17:50:46
         compiled from mods/users/ajax/_edit_basic.html */ ?>
<form method="post" id="basic_info_form">
    <table class="t-edit">
        <tr>
            <td id="basic_info_err" style="display:none;color:red;" colspan="2">

            </td>
        </tr>
        <tr>
            <td width="150"><label>Gender</label></td>
            <td><span class="niceform">
                    <select name="fm[gender]" id="gender" size="1">
                        <option value="0">Select</option>
                        <option value="1"<?php if ($this->_tpl_vars['fm']['gender'] == 1): ?> selected="selected"<?php endif; ?>>Male</option>
                        <option value="2"<?php if ($this->_tpl_vars['fm']['gender'] == 2): ?> selected="selected"<?php endif; ?>>Female</option>
                    </select>
                </span></td>
        </tr>
        <tr>
            <td width="150"><label>Birthday</label></td>
            <td>
                <span class="niceform" style="float:left">
                    <select id="bmonth" name="fm[bmonth]" size="1">
                        <option value="0">Month</option>
                        <?php $_from = $this->_tpl_vars['mm']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                        <option value="<?php echo $this->_tpl_vars['k']; ?>
"<?php if ($this->_tpl_vars['k'] == $this->_tpl_vars['fm']['bmonth']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['i']; ?>
</option>
	                <?php endforeach; endif; unset($_from); ?>
                    </select>    
                </span>
                <span class="niceform" style="float:left">
                    <select id="bday" name="fm[bday]" size="1">
                        <option value="0">Day</option>
	                <?php $_from = $this->_tpl_vars['dd']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                        <option value="<?php echo $this->_tpl_vars['i']; ?>
"<?php if ($this->_tpl_vars['i'] == $this->_tpl_vars['fm']['bday']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['i']; ?>
</option>
	                <?php endforeach; endif; unset($_from); ?>
                    </select>
                </span>
                <span class="niceform" style="float:left">
                    <select id="byear" name="fm[byear]" size="1">
                        <option value="0">Year</option>
	               <?php $_from = $this->_tpl_vars['yy']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                        <option value="<?php echo $this->_tpl_vars['i']; ?>
"<?php if ($this->_tpl_vars['i'] == $this->_tpl_vars['fm']['byear']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['i']; ?>
</option>
	               <?php endforeach; endif; unset($_from); ?>
                    </select>
                </span>
            </td>
        </tr>
        <tr><td width="150">&nbsp;</td><td><input type="checkbox" id="no_dob" name="fm[no_dob]" value="1"<?php if ($this->_tpl_vars['fm']['no_dob']): ?> checked="checked"<?php endif; ?> /> Don’t show my birthday in the profile</td></tr>
        <tr><td width="150"><label>I was born in</label></td><td><input class="txt" type="text" name="fm[was_born]" value="<?php echo $this->_tpl_vars['fm']['was_born']; ?>
" id="was_born" /></td></tr>
        <tr><td width="150"><label>I currently live in</label></td><td><input class="txt" type="text" name="fm[live_in]" value="<?php echo $this->_tpl_vars['fm']['live_in']; ?>
" id="live_in" /></td></tr>
		
        <tr><td width="150"><label>Family </label></td><td>
                <table id="basic_rel" style="margin:0; padding: 0;" cellpadding="0" cellspacing="0">
                <?php $_from = $this->_tpl_vars['relation']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                <tr>
                    <td>
                    <span class="niceform">
                    <select name="fm[relation][]" size="1">
                    <option value="0">Relation</option>
                    <?php $_from = $this->_tpl_vars['relations']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k2'] => $this->_tpl_vars['i2']):
?>
                    <option value="<?php echo $this->_tpl_vars['k2']; ?>
"<?php if ($this->_tpl_vars['k2'] == $this->_tpl_vars['fm']['relation'][$this->_tpl_vars['k']]): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['i2']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                    </select></span></td>
                    <td>
                    	<input type="hidden" id="id_fam" name="fm[relation_id][]" value="<?php echo $this->_tpl_vars['fm']['relation_id'][$this->_tpl_vars['k']]; ?>
" />
                    	<input type="text" class="fam" name="fm[relation_name][]" value="<?php echo $this->_tpl_vars['fm']['relation_name'][$this->_tpl_vars['k']]; ?>
" />
                    </td>
                    <td><div style="margin-top: 3px;"><a href="javascript:void(0);" onclick="oUsers.SettingsBasicDelRel( $(this).parent().parent().parent() );">Clear</a></div></td>
                </tr>
                <?php endforeach; endif; unset($_from); ?>
                </table>
                <div><a href="javascript:oUsers.SettingsBasicAddRel();">Add another family member</a></div>
                </td></tr>
				
         <tr><td width="150"><label>Relationship status</label></td><td>
                    <span class="niceform"><select name="fm[rel_status]" size="1">
                    <option value="0">Select</option>
                    <?php $_from = $this->_tpl_vars['rel_statuses']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                    <option value="<?php echo $this->_tpl_vars['k']; ?>
"<?php if ($this->_tpl_vars['k'] == $this->_tpl_vars['fm']['rel_status']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['i']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                    </select></span>
              </td></tr>
        <tr>
            <td width="150"><label>Spoken languages</label></td>
            <td>
                <table id="basic_lng" style="margin:0; padding: 0;" cellpadding="0" cellspacing="0">
                <?php $_from = $this->_tpl_vars['spoken_lang']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                <tr>
                <td style="width:100px;">
					<span class="niceform">

						<input style="width:180px;" type="text" name="fm[spoken_lang]" id="langsAC" value="<?php echo $this->_tpl_vars['ulangs']; ?>
" />

											</span>
				</td>
                           </tr>
                <?php endforeach; endif; unset($_from); ?>
                </table>
                            </td>
        </tr>
        <tr style="height:50px;">
            <td colspan="2" align="right">
                <div class="aj-button">
                    <span class="aj-button01"><a href="javascript:void(0);" id="basic_cancel" onclick="oUsers.SettingsBasicCnl();">Cancel</a></span>
                    <span class="aj-button02"><a href="javascript:void(0);" id="basic_save" onclick="oUsers.SettingsBasicSubm();">Save</a></span>
                </div>
            </td>
        </tr>
    </table>
</form>
