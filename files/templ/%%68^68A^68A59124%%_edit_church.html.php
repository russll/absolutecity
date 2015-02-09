<?php /* Smarty version 2.6.11, created on 2014-04-09 23:03:02
         compiled from mods/users/ajax/_edit_church.html */ ?>
<form method="post" id="church_info_form">
    <table class="t-edit">
		<tbody>
    <tr>
        <td width="124"><label>Date of baptism</label></td>
        <td>
            <span class="niceform">
                <select class="bp_month" id="bmonth" name="fm[bmonth]" size="1" style="width:61px;">
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
                <select class="bp_day" id="bday" name="fm[bday]" size="1" style="width:51px;">
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
                <select class="bp_year" id="byear" name="fm[byear]" size="1" style="width:55px;">
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
    </tr></tbody>
    
    <tbody style="display:none;" id="church_mission_tmp">
    <tr>
        <td colspan="2"></td>
    </tr>
    </tbody>
    <!--for scripts-->
    <tbody id="church_mission_default" style="display:none">
		<tr>
			<td width="124"><label>Mission location</label></td>
			<td>
				<input type="hidden" id="mission_id" />
				<input type="hidden" name="fm[user_mission_id][]" value="0" />
				<input class="txt3 loc" type="text" name="fm[mission_location][]" value=""  />
				<div style="float:left;margin-top:4px;">
					<a  href="javascript:void(0);" onclick="oUsers.SettingsChurchDelMission( $(this).parent().parent().parent(), 0 );">Clear</a>
				</div>
			</td>
		</tr>
    <tr>
        <td width="124"><label>Mission time from</label></td>
        <td>
             <span class="niceform">
                <select cls="from_month" id="bmonth" name="fm[fmonth][]" size="1" style="width:61px;">
                    <option value="0">Month</option>
                    <?php $_from = $this->_tpl_vars['mm']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                    <option value="<?php echo $this->_tpl_vars['k']; ?>
"><?php echo $this->_tpl_vars['i']; ?>
</option>
	        <?php endforeach; endif; unset($_from); ?>
                </select>
            </span>
            <span class="niceform" style="float:left">
                <select cls="from_day" id="bday" name="fm[fday][]" size="1" style="width:51px;">
                    <option value="0">Day</option>
	            <?php $_from = $this->_tpl_vars['dd']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                    <option value="<?php echo $this->_tpl_vars['i']; ?>
"><?php echo $this->_tpl_vars['i']; ?>
</option>
	            <?php endforeach; endif; unset($_from); ?>
                </select>
            </span>
            <span class="niceform" style="float:left">
                <select cls="from_year" id="byear" name="fm[fyear][]" size="1" style="width:55px;">
                    <option value="0">Year</option>
	            <?php $_from = $this->_tpl_vars['yy']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                    <option value="<?php echo $this->_tpl_vars['i']; ?>
"><?php echo $this->_tpl_vars['i']; ?>
</option>
	            <?php endforeach; endif; unset($_from); ?>
                </select>
            </span>
        </td>
    </tr>
    <tr>
        <td width="124"><label>to</label></td>
        <td>
            <span class="niceform">
                <select cls="to_month" id="bmonth" name="fm[tmonth][]" size="1" style="width:61px;">
                    <option value="0">Month</option>
                    <?php $_from = $this->_tpl_vars['mm']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                    <option value="<?php echo $this->_tpl_vars['k']; ?>
"><?php echo $this->_tpl_vars['i']; ?>
</option>
	        <?php endforeach; endif; unset($_from); ?>
                </select>
            </span>
            <span class="niceform" style="float:left">
                <select cls="to_day" id="bday" name="fm[tday][]" size="1" style="width:51px;">
                    <option value="0">Day</option>
	            <?php $_from = $this->_tpl_vars['dd']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                    <option value="<?php echo $this->_tpl_vars['i']; ?>
"><?php echo $this->_tpl_vars['i']; ?>
</option>
	            <?php endforeach; endif; unset($_from); ?>
                </select>
            </span>
            <span class="niceform" style="float:left">
                <select cls="to_year" id="byear" name="fm[tyear][]" size="1" style="width:55px;">
                    <option value="0">Year</option>
	            <?php $_from = $this->_tpl_vars['yy']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                    <option value="<?php echo $this->_tpl_vars['i']; ?>
"><?php echo $this->_tpl_vars['i']; ?>
</option>
	            <?php endforeach; endif; unset($_from); ?>
                </select>
            </span>
        </td>
    </tr>
    </tbody>
    <!--for scripts-->
    <tbody id="church_mission">
    <?php $_from = $this->_tpl_vars['mission']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k1'] => $this->_tpl_vars['i1']):
?>

	    
    <tr>
		<td width="124">
			<label>Mission location</label></td><td><input type="hidden" id="mission_id" /><input type="hidden" name="fm[user_mission_id][]" value="<?php if ($this->_tpl_vars['fm']['user_mission_id'][$this->_tpl_vars['k1']]):  echo $this->_tpl_vars['fm']['user_mission_id'][$this->_tpl_vars['k1']];  else: ?>0<?php endif; ?>" /><input class="txt3 loc" type="text" name="fm[mission_location][]" value="<?php echo $this->_tpl_vars['fm']['mission_location'][$this->_tpl_vars['k1']]; ?>
"  />
            <div style="float:left;margin-top:4px;"><a  href="javascript:void(0);" onclick="oUsers.SettingsChurchDelMission( $(this).parent().parent().parent(), <?php if ($this->_tpl_vars['fm']['user_mission_id'][$this->_tpl_vars['k1']]):  echo $this->_tpl_vars['fm']['user_mission_id'][$this->_tpl_vars['k1']];  else: ?>0<?php endif; ?> );">Clear</a></div>
	    </td>
	</tr>

    <tr>
        <td width="124"><label>Mission time from</label></td>
        <td>
             <span class="niceform">
                <select cls="from_month" id="bmonth" name="fm[fmonth][]" size="1" style="width:61px;">
                    <option value="0">Month</option>
                    <?php $_from = $this->_tpl_vars['mm']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                    <option value="<?php echo $this->_tpl_vars['k']; ?>
"<?php if ($this->_tpl_vars['k'] == $this->_tpl_vars['fm']['fmonth'][$this->_tpl_vars['k1']]): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['i']; ?>
</option>
	        <?php endforeach; endif; unset($_from); ?>
                </select>
            </span>
            <span class="niceform" style="float:left">
                <select cls="from_day" id="bday" name="fm[fday][]" size="1" style="width:51px;">
                    <option value="0">Day</option>
	            <?php $_from = $this->_tpl_vars['dd']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                    <option value="<?php echo $this->_tpl_vars['i']; ?>
"<?php if ($this->_tpl_vars['i'] == $this->_tpl_vars['fm']['fday'][$this->_tpl_vars['k1']]): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['i']; ?>
</option>
	            <?php endforeach; endif; unset($_from); ?>
                </select>
            </span>
            <span class="niceform" style="float:left">
                <select cls="from_year" id="byear" name="fm[fyear][]" size="1" style="width:55px;">
                    <option value="0">Year</option>
	            <?php $_from = $this->_tpl_vars['yy']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                    <option value="<?php echo $this->_tpl_vars['i']; ?>
"<?php if ($this->_tpl_vars['i'] == $this->_tpl_vars['fm']['fyear'][$this->_tpl_vars['k1']]): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['i']; ?>
</option>
	            <?php endforeach; endif; unset($_from); ?>
                </select>
            </span>
        </td>
    </tr>
    <tr>
        <td width="124"><label>to</label></td>
        <td>
            <span class="niceform">
                <select cls="to_month" id="bmonth" name="fm[tmonth][]" size="1" style="width:61px;">
                    <option value="0">Month</option>
                    <?php $_from = $this->_tpl_vars['mm']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                    <option value="<?php echo $this->_tpl_vars['k']; ?>
"<?php if ($this->_tpl_vars['k'] == $this->_tpl_vars['fm']['tmonth'][$this->_tpl_vars['k1']]): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['i']; ?>
</option>
	        <?php endforeach; endif; unset($_from); ?>
                </select>
            </span>
            <span class="niceform" style="float:left">
                <select cls="to_day" id="bday" name="fm[tday][]" size="1" style="width:51px;">
                    <option value="0">Day</option>
	            <?php $_from = $this->_tpl_vars['dd']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                    <option value="<?php echo $this->_tpl_vars['i']; ?>
"<?php if ($this->_tpl_vars['i'] == $this->_tpl_vars['fm']['tday'][$this->_tpl_vars['k1']]): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['i']; ?>
</option>
	            <?php endforeach; endif; unset($_from); ?>
                </select>
            </span>
            <span class="niceform" style="float:left">
                <select cls="to_year" id="byear" name="fm[tyear][]" size="1" style="width:55px;">
                    <option value="0">Year</option>
	            <?php $_from = $this->_tpl_vars['yy']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                    <option value="<?php echo $this->_tpl_vars['i']; ?>
"<?php if ($this->_tpl_vars['i'] == $this->_tpl_vars['fm']['tyear'][$this->_tpl_vars['k1']]): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['i']; ?>
</option>
	            <?php endforeach; endif; unset($_from); ?>
                </select>
            </span>
        </td>
    </tr>
    <?php endforeach; endif; unset($_from); ?>
    </tbody>
	<tbody>
    <tr><td></td><td><a href="javascript:oUsers.SettingsChurchAddMission();">Add another mission</a></td>

       <tr>
		<td width="124">
			<label>Ward/Branch</label>
		</td>
		<td>
			<input type="hidden" id="stake_id" name="fm[stake_id]" value="<?php echo $this->_tpl_vars['fm']['stake_id']; ?>
" />
			<input type="hidden" id="ward_id" name="fm[ward_id]" value="<?php echo $this->_tpl_vars['fm']['ward_id']; ?>
" />
			<input id="ward_id_input" class="txt3 ward" name="fm[ward]" type="text" value="<?php echo $this->_tpl_vars['fm']['ward']; ?>
"  />
		</td>
	</tr>
	<tr>
		<td width="124">
			<label></label>
		</td>
		<td>
			<a style="float:left; cursor:pointer;" id="ward_not_found">Haven't found your ward?</a>
		</td>
	</tr>
    </tbody>
    <tbody id="church_calling">
    <?php $_from = $this->_tpl_vars['calling']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
    <tr>
        <td width="124" style="margin-bottom:0px; padding-bottom: 0px;"><label>My calling</label></td>
        <td style="margin-bottom:0px; padding-bottom: 0px;">
            <span class="niceform">
                <input type="text" style="width:124px;" name="fm[calling][]" value="<?php echo $this->_tpl_vars['fm']['calling'][$this->_tpl_vars['k']]; ?>
" class="txt" />
            </span>
                      <div style="float:left;margin-top:4px; margin-left:4px;"><a href="javascript:void(0);" onclick="oUsers.SettingsChurchDelCalling( $(this).parent().parent().parent() );">Clear</a></div>
        </td>
    </tr>
    <?php endforeach; endif; unset($_from); ?>
    </tbody>

	<tbody>
    <tr><td style="margin-top:0px; padding-top: 0px;"></td><td style="margin-top:0px; padding-top: 0px;"><a href="javascript:oUsers.SettingsChurchAddCalling();">Add other calling</a></td></tr>
	</tbody>
    <tbody id="church_priesthood">
    <tr>
        <td width="124" style="margin-bottom:0px; padding-bottom: 0px;"><label>Are you a priesthood holder? </label></td>
        <td style="margin-bottom:0px; padding-bottom: 0px;">
            <span class="niceform" style="float:left">
                <select id="id_priesthood" name="fm[priesthood]" size="1" style="width:200px;">
	            <?php $_from = $this->_tpl_vars['fm']['priesthood_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                    <option value="<?php echo $this->_tpl_vars['k']; ?>
"<?php if ($this->_tpl_vars['k'] == $this->_tpl_vars['fm']['priesthood']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['i']; ?>
</option>
	            <?php endforeach; endif; unset($_from); ?>
                </select>
            </span>
        </td>
    </tr>
	</tbody>


    <!-- Classes -->
    <tbody style="display:none;" id="class_mission_tmp">
    <tr>
        <td colspan="2"></td>
    </tr>
    </tbody>
    <?php if ($this->_tpl_vars['fm']['ward_id']): ?>
    <!--for scripts-->
    <tbody id="church_class_default" style="display:none">
		<tr>
			<td width="124"><label>Sunday School Class</label></td>
			<td>
				<input type="hidden" id="class_id" /><input type="hidden" name="fm[user_class_id][]" value="0" /><input class="txt3 schl" type="text" name="fm[class_title][]" value=""  />
                <div style="float:left;margin-top:4px;"><a  href="javascript:void(0);" onclick="oUsers.SettingsChurchDelClass( $(this).parent().parent().parent(), 0 );">Clear</a></div>
			</td>
		</tr>

    </tbody>
    <!--for scripts-->
    <tbody id="church_class">
    <?php $_from = $this->_tpl_vars['class']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k1'] => $this->_tpl_vars['i1']):
?>
    <tr>
        <td width="124"><label>Sunday School Class</label></td>
        <td>
			<input type="hidden" id="class_id" /><input type="hidden" name="fm[user_class_id][]" value="<?php if ($this->_tpl_vars['fm']['user_class_id'][$this->_tpl_vars['k1']]):  echo $this->_tpl_vars['fm']['user_class_id'][$this->_tpl_vars['k1']];  else: ?>0<?php endif; ?>" /><input class="txt3 schl" type="text" name="fm[class_title][]" value="<?php echo $this->_tpl_vars['fm']['class_title'][$this->_tpl_vars['k1']]; ?>
"  />
			<div style="float:left;margin-top:4px;"><a  href="javascript:void(0);" onclick="oUsers.SettingsChurchDelClass( $(this).parent().parent().parent(), <?php if ($this->_tpl_vars['fm']['user_class_id'][$this->_tpl_vars['k1']]):  echo $this->_tpl_vars['fm']['user_class_id'][$this->_tpl_vars['k1']];  else: ?>0<?php endif; ?> );">Clear</a></div>
        </td>
    </tr>
    <?php endforeach; endif; unset($_from); ?>
    </tbody>
    <tr><td></td><td><a href="javascript:oUsers.SettingsChurchAddClass();">Add Sunday school class</a></td>
    <?php else: ?>
    <tr><td></td><td>To choose Sunday school class, please select your ward</td></tr>
    <?php endif; ?>
    </tbody>

    <tr style="height:50px;">
        <td colspan="2" align="right">
            <div class="aj-button">
                <span class="aj-button01"><a href="javascript:void(0);" id="basic_cancel" onclick="oUsers.SettingsChurchCnl();">Cancel</a></span>
                <span class="aj-button02"><a href="javascript:void(0);" id="basic_save" onclick="oUsers.SettingsChurchSubm();">Save</a></span>
            </div>
        </td>
    </tr>
</table>
</form>