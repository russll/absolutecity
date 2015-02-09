<?php /* Smarty version 2.6.11, created on 2014-03-15 08:51:14
         compiled from _left_column.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', '_left_column.html', 427, false),array('modifier', 'moddate', '_left_column.html', 566, false),array('modifier', 'dlong', '_left_column.html', 619, false),array('modifier', 'truncate', '_left_column.html', 849, false),array('modifier', 'date_format', '_left_column.html', 913, false),array('modifier', 'nl2br', '_left_column.html', 944, false),)), $this); ?>
<?php if ('search' == $this->_tpl_vars['m_page'] && ! $this->_tpl_vars['web_search']): ?>
<!--  SearchFilters LeftColumn  -->
<?php echo '<div id="id_srch_filts" style="display: block; visibility: hidden;"><h2>Filters</h2><div class="filter-box"><h3 class="cl_srch_ftype_h3" ftype="Email"><span><a class="cl_srch_ftype" ftype="Email" style="cursor: pointer;"><img src="';  echo $this->_tpl_vars['imgDir'];  echo 'arr05.gif" alt="" /></a></span><a href="javascript: void(0);" onclick="$(\'a[ftype=\\\'Email\\\']\').click();">Email</a></h3><div ftype="Email" class="drop-filter"><table><tr><td><input name="email" type="text" value="Email address" onclick="this.value=\'\';" /></td></tr><tr><td><div class="but-filter"><span><a class="cl_filt_btn" style="cursor: pointer;">Filter</a></span></div></td></tr></table></div><h3 class="cl_srch_ftype_h3" ftype="Name"><span><a class="cl_srch_ftype" ftype="Name" style="cursor: pointer;"><img src="';  echo $this->_tpl_vars['imgDir'];  echo 'arr05.gif" alt="" /></a></span><a href="javascript: void(0);" onclick="$(\'a[ftype=\\\'Name\\\']\').click();">Name</a></h3><div ftype="Name" class="drop-filter"><table><tr><td><input name="first_name" type="text" value="First/Middle name" onclick="this.value=\'\';" /></td></tr><tr><td><input name="last_name" type="text" value="Last name" onclick="this.value=\'\';" /></td></tr><tr><td><div class="but-filter"><span><a class="cl_filt_btn" style="cursor: pointer;">Filter</a></span></div></td></tr></table></div><h3 class="cl_srch_ftype_h3" ftype="Gender"><span><a class="cl_srch_ftype" ftype="Gender" style="cursor: pointer;"><img src="';  echo $this->_tpl_vars['imgDir'];  echo 'arr05.gif" alt="" /></a></span><a href="javascript: void(0);" onclick="$(\'a[ftype=\\\'Gender\\\']\').click();">Gender</a></h3><div ftype="Gender" class="drop-filter"><table><tr><td><span class="niceform"><select name="gender" size="1" style="width:149px"><option value="0" selected="1">Select gender</option><option value="1">Male</option><option value="2">Female</option></select></span></td></tr><tr><td><div class="but-filter"><span><a class="cl_filt_btn" style="cursor: pointer;">Filter</a></span></div></td></tr></table></div><h3 class="cl_srch_ftype_h3" ftype="Age"><span><a class="cl_srch_ftype" ftype="Age" style="cursor: pointer;"><img src="';  echo $this->_tpl_vars['imgDir'];  echo 'arr05.gif" alt="" /></a></span><a href="javascript: void(0);" onclick="$(\'a[ftype=\\\'Age\\\']\').click();">Age</a></h3><div ftype="Age" class="drop-filter"><table><tr><td><span class="niceform"><select name="age_from" size="1" style="width:63px"><option value="">From</option>';  unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=100) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['start'] = (int)15;
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
 echo '<option value="';  echo $this->_sections['i']['index']+1;  echo '">';  echo $this->_sections['i']['index']+1;  echo '</option>';  endfor; endif;  echo '</select></span></td><td>&nbsp;&mdash;</td><td><span class="niceform"><select name="age_to" size="1" style="width:63px"><option value="" selected="selected">To</option>';  unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=85) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['start'] = (int)15;
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
 echo '<option value="';  echo $this->_sections['i']['index']+1;  echo '">';  echo $this->_sections['i']['index']+1;  echo '</option>';  endfor; endif;  echo '</select></span></td></tr><tr><td colspan="3"><div class="but-filter"><span><a class="cl_filt_btn" style="cursor: pointer;">Filter</a></span></div></td></tr></table></div><h3 class="cl_srch_ftype_h3" ftype="Phone number"><span><a class="cl_srch_ftype" ftype="Phone number" style="cursor: pointer;"><img src="';  echo $this->_tpl_vars['imgDir'];  echo 'arr05.gif" alt="" /></a></span><a href="javascript: void(0);" onclick="$(\'a[ftype=\\\'Phone number\\\']\').click();">Phone number</a></h3><div ftype="Phone number"class="drop-filter"><table><tr><td><input type="text" name="mob_phone" value="Enter phone number" onclick="this.value=\'\';" /></td></tr><tr><td><div class="but-filter"><span><a class="cl_filt_btn" style="cursor: pointer;">Filter</a></span></div></td></tr></table></div><h3 class="cl_srch_ftype_h3" ftype="Singles"><span><a class="cl_srch_ftype" ftype="Singles" style="cursor: pointer;"><img src="';  echo $this->_tpl_vars['imgDir'];  echo 'arr05.gif" alt="" /></a></span><a href="javascript: void(0);" onclick="$(\'a[ftype=\\\'Singles\\\']\').click();">Singles</a></h3><div ftype="Singles" class="drop-filter"><table><tr><td colspan="2"><span class="niceform"><select name="rel_status" size="1" style="width:149px"><!--<option value="">Select status</option>-->';  $_from = $this->_tpl_vars['rel_statuses']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
 echo '<option value="';  echo $this->_tpl_vars['k'];  echo '"';  if ($this->_tpl_vars['k'] == $this->_tpl_vars['fm']['rel_status']):  echo ' selected="selected"';  endif;  echo '>';  echo $this->_tpl_vars['i'];  echo '</option>';  endforeach; endif; unset($_from);  echo '</select></span></td></tr><tr><td></td><td><div class="but-filter"><span><a class="cl_filt_btn" style="cursor: pointer;">Filter</a></span></div></td></tr></table></div><h3 class="cl_srch_ftype_h3" ftype="School"><span><a class="cl_srch_ftype" ftype="School" style="cursor: pointer;"><img src="';  echo $this->_tpl_vars['imgDir'];  echo 'arr05.gif" alt="" /></a></span><a href="javascript: void(0);" onclick="$(\'a[ftype=\\\'School\\\']\').click();">School</a></h3><div ftype="School" class="drop-filter"><table><tr><td colspan="2"><span class="niceform"><select name="school_type" size="1" style="width:149px"><option value="">Select school type</option><option value="hight">High school</option><option value="college">College</option><option value="university">University</option></select></span></td></tr><tr><td colspan="2" style="padding-top:10px"><input name="school_name" type="text" value="Enter school name" onclick="this.value=\'\';" /></td></tr><tr><td colspan="2"><label style="padding-top:5px">Year (from)</label></td></tr><tr><td><span class="niceform"><select name="school_from_month" size="1"><option value="">Month</option>';  $_from = $this->_tpl_vars['mm']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
 echo '<option value="';  echo $this->_tpl_vars['k'];  echo '">';  echo $this->_tpl_vars['i'];  echo '</option>';  endforeach; endif; unset($_from);  echo '</select></span></td><td><span class="niceform"><select name="school_from_year" size="1"><option value="">Year</option>';  unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['yy']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
 echo '<option value="';  echo $this->_sections['i']['index']+1;  echo '">';  echo $this->_tpl_vars['yy'][$this->_sections['i']['index']];  echo '</option>';  endfor; endif;  echo '</select></span></td></tr><tr><td colspan="2"><label>to</label></td></tr><tr><td><span class="niceform"><select name="school_to_month" size="1"><option value="">Month</option>';  $_from = $this->_tpl_vars['mm']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
 echo '<option value="';  echo $this->_tpl_vars['k'];  echo '">';  echo $this->_tpl_vars['i'];  echo '</option>';  endforeach; endif; unset($_from);  echo '</select></span></td><td><span class="niceform"><select name="school_to_year" size="1"><option value="">Year</option>';  unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['yy']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
 echo '<option value="';  echo $this->_sections['i']['index']+1;  echo '">';  echo $this->_tpl_vars['yy'][$this->_sections['i']['index']];  echo '</option>';  endfor; endif;  echo '</select></span></td></tr><tr><td></td><td><div class="but-filter"><span><a class="cl_filt_btn" style="cursor: pointer;">Filter</a></span></div></td></tr></table></div><h3 class="cl_srch_ftype_h3" ftype="Location"><span><a class="cl_srch_ftype" ftype="Location" style="cursor: pointer;"><img src="';  echo $this->_tpl_vars['imgDir'];  echo 'arr05.gif" alt="" /></a></span><a href="javascript: void(0);" onclick="$(\'a[ftype=\\\'Location\\\']\').click();">Location</a></h3><div ftype="Location" class="drop-filter"><table><tr><td><input name="location_city" type="text" value="Enter city" onclick="this.value=\'\';" /></td></tr><tr><td style="padding-top:10px"><span class="niceform"><select name="location_country" size="1" style="width:149px"><option value="">Select country</option>';  $_from = $this->_tpl_vars['countries']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
 echo '<option value="';  echo $this->_tpl_vars['k'];  echo '"';  if ($this->_tpl_vars['k'] == $this->_tpl_vars['fm']['country']):  echo ' selected="selected"';  endif;  echo '>';  echo $this->_tpl_vars['i'];  echo '</option>';  endforeach; endif; unset($_from);  echo '</select></span>';  echo '</td></tr><tr><td style="padding-top:10px"><input name="location_street" type="text" value="Enter street" onclick="this.value=\'\';" /></td></tr><tr><td style="padding-top:10px"><input name="location_zip" type="text" value="Zip code" onclick="this.value=\'\';" /></td></tr><tr><td><div class="but-filter"><span><a class="cl_filt_btn" style="cursor: pointer;">Filter</a></span></div></td></tr></table></div><h3 class="cl_srch_ftype_h3" ftype="Stake"><span><a class="cl_srch_ftype" ftype="Stake" style="cursor: pointer;"><img src="';  echo $this->_tpl_vars['imgDir'];  echo 'arr05.gif" alt="" /></a></span><a href="javascript: void(0);" onclick="$(\'a[ftype=\\\'Stake\\\']\').click();">Stake/ward</a></h3><div ftype="Stake" class="drop-filter"><table><tr><td><span class="niceform"><select name="ward_type" id="ward_type" size="1" style="width:149px"><option value="">Select type</option><option value="1">Stake</option><option value="2">Ward</option></select></span></td></tr><tr><td style="padding-top:10px"><input name="ward_name" class="ward_name" type="text" value="Enter stake/ward name" onclick="this.value=\'\';" /></td></tr><tr><td><div class="but-filter"><span><a class="cl_filt_btn2" style="cursor: pointer;">Filter</a></span></div></td></tr></table></div><h3 class="cl_srch_ftype_h3" ftype="ByMission"><span><a class="cl_srch_ftype" ftype="ByMission" style="cursor: pointer;"><img src="';  echo $this->_tpl_vars['imgDir'];  echo 'arr05.gif" alt="" /></a></span><a href="javascript: void(0);" onclick="$(\'a[ftype=\\\'ByMission\\\']\').click();">By Mission</a></h3><div ftype="ByMission" class="drop-filter"><table><tr><td colspan="2"><label>Location</label></td></tr><tr><td colspan="2"><input name="people_mission_location" class="mission_location" type="text" value="Enter location here" onclick="this.value=\'\';" /><small style="color:gray;">Use values from the autocomplete list</small></td></tr><tr><td></td><td><div class="but-filter"><span><a class="cl_filt_btn" style="cursor: pointer;">Filter</a></span></div></td></tr></table></div><h3 class="cl_srch_ftype_h3" ftype="ByWard"><span><a class="cl_srch_ftype" ftype="ByWard"  style="cursor: pointer;"><img src="';  echo $this->_tpl_vars['imgDir'];  echo 'arr05.gif" alt="" /></a></span><a href="javascript: void(0);" onclick="$(\'a[ftype=\\\'ByWard\\\']\').click();">By Ward</a></h3><div ftype="ByWard" class="drop-filter"><table><tr><td style="padding-top:10px"><input class="people_ward_name" name="people_ward_name" type="text" value="Enter ward name" onclick="this.value=\'\';" /></td></tr><tr><td style="padding-top:10px"><input class="people_stake_name" name="people_stake_name" type="text" value="Enter stake name" onclick="this.value=\'\';" /></td></tr><tr><td><div class="but-filter"><span><a class="cl_filt_btn" style="cursor: pointer;">Filter</a></span></div></td></tr></table></div><h3 class="cl_srch_ftype_h3" ftype="Mission"><span><a class="cl_srch_ftype" ftype="Mission" style="cursor: pointer;"><img src="';  echo $this->_tpl_vars['imgDir'];  echo 'arr05.gif" alt="" /></a></span><a href="javascript: void(0);" onclick="$(\'a[ftype=\\\'Mission\\\']\').click();">Mission</a></h3><div ftype="Mission" class="drop-filter"><table><tr><td colspan="2"><label>Mission location</label></td></tr><tr><td colspan="2"><input name="mission_location" class="mission_location" type="text" value="Enter location here" onclick="this.value=\'\';" /></td></tr><tr><td colspan="2"><label style="padding-top:5px">Year (from)</label></td></tr><tr><td><span class="niceform"><select name="mission_from_month" size="1"><option value="">Month</option>';  $_from = $this->_tpl_vars['mm']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
 echo '<option value="';  echo $this->_tpl_vars['k'];  echo '">';  echo $this->_tpl_vars['i'];  echo '</option>';  endforeach; endif; unset($_from);  echo '</select></span></td><td><span class="niceform"><select name="mission_from_year" size="1"><option value="">Year</option>';  unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['yy']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
 echo '';  echo '<option value="';  echo $this->_tpl_vars['yy'][$this->_sections['i']['index']];  echo '">';  echo $this->_tpl_vars['yy'][$this->_sections['i']['index']];  echo '</option>';  endfor; endif;  echo '</select></span></td></tr><tr><td colspan="2"><label>to</label></td></tr><tr><td><span class="niceform"><select name="mission_to_month" size="1"><option value="">Month</option>';  $_from = $this->_tpl_vars['mm']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
 echo '<option value="';  echo $this->_tpl_vars['k'];  echo '">';  echo $this->_tpl_vars['i'];  echo '</option>';  endforeach; endif; unset($_from);  echo '</select></span></td><td><span class="niceform"><select name="mission_to_year" size="1"><option value="">Year</option>';  unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['yy']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
 echo '';  echo '<option value="';  echo $this->_tpl_vars['yy'][$this->_sections['i']['index']];  echo '">';  echo $this->_tpl_vars['yy'][$this->_sections['i']['index']];  echo '</option>';  endfor; endif;  echo '</select></span></td></tr><tr><td></td><td><div class="but-filter"><span><a class="cl_filt_btn" style="cursor: pointer;">Filter</a></span></div></td></tr></table></div><h3 class="cl_srch_ftype_h3" ftype="Mission2"><span><a class="cl_srch_ftype" ftype="Mission2" style="cursor: pointer;"><img src="';  echo $this->_tpl_vars['imgDir'];  echo 'arr05.gif" alt="" /></a></span><a href="javascript: void(0);" onclick="$(\'a[ftype=\\\'Mission2\\\']\').click();">Filter location</a></h3><div ftype="Mission2" class="drop-filter"><table><tr><td colspan="2"><label>Mission location</label></td></tr><tr><td colspan="2"><input name="mission_location" class="mission_location" type="text" value="Enter location here" onclick="this.value=\'\';" /></td></tr><tr><td></td><td><div class="but-filter"><span><a class="cl_filt_btn2" style="cursor: pointer;">Filter</a></span></div></td></tr></table><p style="text-align: center;">Looking for a mission? <br/> Try <a style="font-weight: bold;" href="';  echo $this->_tpl_vars['siteAdr'];  echo 'id';  echo $this->_tpl_vars['ui']['uid'];  echo '/mission">here</a></p></div><h3 class="cl_srch_ftype_h3" ftype="Interests"><span><a class="cl_srch_ftype" ftype="Interests" style="cursor: pointer;"><img src="';  echo $this->_tpl_vars['imgDir'];  echo 'arr05.gif" alt="" /></a></span><a href="javascript: void(0);" onclick="$(\'a[ftype=\\\'Interests\\\']\').click();">Interests</a></h3><div ftype="Interests" class="drop-filter"><table><tr><td><input name="interests" type="text" value="Enter interest" onclick="this.value=\'\';" /></td></tr><tr><td><div class="but-filter"><span><a class="cl_filt_btn" style="cursor: pointer;">Filter</a></span></div></td></tr></table></div></div></div>'; ?>

<?php elseif ('search' == $this->_tpl_vars['m_page'] && $this->_tpl_vars['web_search']): ?>
<!--  SearchFilters LeftColumn  -->

<?php elseif ('wards_wall' == $this->_tpl_vars['m_page']):  echo '<!--  Ward\'s Messages LeftColumn  --><h2 class="lowprof">';  echo $this->_tpl_vars['ward_i']['title'];  echo '';  if ($this->_tpl_vars['ward_i']['ward_title']):  echo ',<br> ';  echo $this->_tpl_vars['ward_i']['ward_title'];  echo ' ';  endif;  echo '</h2><ul class="list01">';  if (! $this->_tpl_vars['ward_i']['im_member']):  echo '<li><a href="javascript: void(0);" onclick="oWWall.SHConfirmPopup( 1, \'id_confirm_wards_popup\', \'';  echo $this->_tpl_vars['ward_i']['id'];  echo '\' );">Set as my ward</a></li>';  endif;  echo '<li>';  if (! $this->_tpl_vars['wwhatch']):  echo '<a id="id_wards_whatch" href="javascript: void(0);" onclick="oWards.EditWhatching( 1, \'';  echo $this->_tpl_vars['ward_i']['id'];  echo '\' ) ;">Watch this ward</a>';  else:  echo '<a id="id_wards_whatch" href="javascript: void(0);" onclick="oWards.EditWhatching( 2, \'';  echo $this->_tpl_vars['ward_i']['id'];  echo '\' ) ;">Unwatch this ward</a>';  endif;  echo '</li><li><a href="';  echo $this->_tpl_vars['siteAdr'];  echo 'wards/list">Choose other ward</a></li>';  echo '</ul>';  if ($this->_tpl_vars['ar_whatching']):  echo '<h2>';  if (5 < $this->_tpl_vars['cnt_whatching']):  echo '<span><a href="';  echo $this->_tpl_vars['siteAdr'];  echo 'wards/whatch">View all</a></span>';  endif;  echo 'Watching</h2><ul class="list01">';  $_from = $this->_tpl_vars['ar_whatching']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['n'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['n']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['n']['iteration']++;
 echo '';  if (($this->_foreach['n']['iteration']-1) < 5):  echo '<li><a href="';  echo $this->_tpl_vars['siteAdr'];  echo 'wards/id';  echo $this->_tpl_vars['i']['wid'];  echo '">';  echo $this->_tpl_vars['i']['ward_title'];  echo '</a></li>';  endif;  echo '';  endforeach; endif; unset($_from);  echo '</ul>';  endif;  echo '<h2>Information</h2><ul class="list01"><li>';  if ($this->_tpl_vars['ward_i']['country'] || $this->_tpl_vars['ward_i']['city']):  echo '<span style="color: gray; font-size: 12px;">Location</span><p>';  echo $this->_tpl_vars['ward_i']['city'];  echo ', ';  if ($this->_tpl_vars['ward_i']['region']):  echo '';  echo $this->_tpl_vars['ward_i']['region'];  echo ',';  endif;  echo ' ';  echo $this->_tpl_vars['ward_i']['country'];  echo '</p>';  else:  echo 'There isn\'t any info';  endif;  echo '</li></ul>';  if ($this->_tpl_vars['ward_i']['my_ward'] || $this->_tpl_vars['CAN_EDIT'] || ( $this->_tpl_vars['ward_i']['bishopric']['first_name'] || $this->_tpl_vars['ward_i']['bishopric']['last_name'] )):  echo '<br /><br /><h2>Bishopric</h2><ul class="list01">';  if ($this->_tpl_vars['ward_i']['bishopric']['first_name'] || $this->_tpl_vars['ward_i']['bishopric']['last_name']):  echo '<li><table><tr><td style="width: 25%;"><span style="color: gray;">Bishop</span></td><td style="width: 5%;">&nbsp</td><td>&nbsp</td></tr><tr><td align="center" style="';  if ($this->_tpl_vars['ward_i']['bishopric']['p_img']):  echo ' width:25%; ';  else:  echo ' width:0px; ';  endif;  echo '">';  $this->assign('prfname', ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['ward_i']['bishopric']['first_name'])) ? $this->_run_mod_handler('cat', true, $_tmp, ' ') : smarty_modifier_cat($_tmp, ' ')))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['ward_i']['bishopric']['last_name']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['ward_i']['bishopric']['last_name'])));  echo '<img src="';  if ($this->_tpl_vars['ward_i']['bishopric']['p_img']):  echo ' ';  echo $this->_tpl_vars['fImgDir'];  echo 'wards/info/bishopric/';  echo $this->_tpl_vars['ward_i']['bishopric']['p_img'];  echo ' ';  else:  echo ' ';  echo $this->_tpl_vars['imgDir'];  echo 'no_photo_m42.jpg ';  endif;  echo '" style="max-width: 42px; max-height: 42px;" title="';  echo $this->_tpl_vars['prfname'];  echo '" alt="';  echo $this->_tpl_vars['prfname'];  echo '" /></td><td style="width: 5%;">&nbsp</td><td><table class="pres_table"><tr><td><span>';  echo $this->_tpl_vars['prfname'];  echo '</span></td></tr><tr><td><span>';  echo $this->_tpl_vars['ward_i']['bishopric']['phone'];  echo '</span></td></tr><tr><td><span>';  echo $this->_tpl_vars['ward_i']['bishopric']['email'];  echo '</span></td></tr></table></td></tr></table></li>';  endif;  echo '';  unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=$this->_tpl_vars['ar_addi']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['j']['show'] = true;
$this->_sections['j']['max'] = $this->_sections['j']['loop'];
$this->_sections['j']['step'] = 1;
$this->_sections['j']['start'] = $this->_sections['j']['step'] > 0 ? 0 : $this->_sections['j']['loop']-1;
if ($this->_sections['j']['show']) {
    $this->_sections['j']['total'] = $this->_sections['j']['loop'];
    if ($this->_sections['j']['total'] == 0)
        $this->_sections['j']['show'] = false;
} else
    $this->_sections['j']['total'] = 0;
if ($this->_sections['j']['show']):

            for ($this->_sections['j']['index'] = $this->_sections['j']['start'], $this->_sections['j']['iteration'] = 1;
                 $this->_sections['j']['iteration'] <= $this->_sections['j']['total'];
                 $this->_sections['j']['index'] += $this->_sections['j']['step'], $this->_sections['j']['iteration']++):
$this->_sections['j']['rownum'] = $this->_sections['j']['iteration'];
$this->_sections['j']['index_prev'] = $this->_sections['j']['index'] - $this->_sections['j']['step'];
$this->_sections['j']['index_next'] = $this->_sections['j']['index'] + $this->_sections['j']['step'];
$this->_sections['j']['first']      = ($this->_sections['j']['iteration'] == 1);
$this->_sections['j']['last']       = ($this->_sections['j']['iteration'] == $this->_sections['j']['total']);
 echo '';  $this->assign('str_first_name', ((is_array($_tmp=$this->_tpl_vars['ar_addi'][$this->_sections['j']['index']])) ? $this->_run_mod_handler('cat', true, $_tmp, '_first_name') : smarty_modifier_cat($_tmp, '_first_name')));  echo '';  $this->assign('str_last_name', ((is_array($_tmp=$this->_tpl_vars['ar_addi'][$this->_sections['j']['index']])) ? $this->_run_mod_handler('cat', true, $_tmp, '_last_name') : smarty_modifier_cat($_tmp, '_last_name')));  echo '';  $this->assign('str_phone', ((is_array($_tmp=$this->_tpl_vars['ar_addi'][$this->_sections['j']['index']])) ? $this->_run_mod_handler('cat', true, $_tmp, '_phone') : smarty_modifier_cat($_tmp, '_phone')));  echo '';  $this->assign('str_email', ((is_array($_tmp=$this->_tpl_vars['ar_addi'][$this->_sections['j']['index']])) ? $this->_run_mod_handler('cat', true, $_tmp, '_email') : smarty_modifier_cat($_tmp, '_email')));  echo '';  if ($this->_tpl_vars['ward_i']['bishopric'][$this->_tpl_vars['str_first_name']] || $this->_tpl_vars['ward_i']['bishopric'][$this->_tpl_vars['str_last_name']]):  echo '';  $this->assign('prfname', ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['ward_i']['bishopric'][$this->_tpl_vars['str_first_name']])) ? $this->_run_mod_handler('cat', true, $_tmp, ' ') : smarty_modifier_cat($_tmp, ' ')))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['ward_i']['bishopric'][$this->_tpl_vars['str_last_name']]) : smarty_modifier_cat($_tmp, $this->_tpl_vars['ward_i']['bishopric'][$this->_tpl_vars['str_last_name']])));  echo '<li><table><tr><td style="width: 25%;"><span style="color: gray;">';  if ('cp' == $this->_tpl_vars['ar_addi'][$this->_sections['j']['index']]):  echo 'Contact Person';  elseif ('fc' == $this->_tpl_vars['ar_addi'][$this->_sections['j']['index']]):  echo 'First Counselor';  elseif ('sc' == $this->_tpl_vars['ar_addi'][$this->_sections['j']['index']]):  echo 'Second Counselor';  elseif ('es' == $this->_tpl_vars['ar_addi'][$this->_sections['j']['index']]):  echo 'Ward Executive Secretary';  elseif ('wc' == $this->_tpl_vars['ar_addi'][$this->_sections['j']['index']]):  echo 'Ward Clerk';  endif;  echo '</span></td></tr><tr><td><span>';  echo $this->_tpl_vars['prfname'];  echo '</span></td></tr><tr><td><span>';  echo $this->_tpl_vars['ward_i']['bishopric'][$this->_tpl_vars['str_phone']];  echo '</span></td></tr><tr><td><span>';  echo $this->_tpl_vars['ward_i']['bishopric'][$this->_tpl_vars['str_email']];  echo '</span></td></tr></table></li>';  endif;  echo '';  endfor; endif;  echo '';  if ($this->_tpl_vars['CAN_EDIT'] && $this->_tpl_vars['IS_USER'] && ( $this->_tpl_vars['ward_i']['my_ward'] || $this->_tpl_vars['ward_i']['my_stake'] )):  echo '<li><a href="javascript: void(0);" onclick="oWards.SHBishopricPopup( 1, \'id_add_bishopric_popup\' );">';  if ($this->_tpl_vars['ward_i']['bishopric']['first_name'] || $this->_tpl_vars['ward_i']['bishopric']['last_name']):  echo ' Edit bishopric info ';  else:  echo ' Suggest bishopric info';  endif;  echo '</a></li>';  endif;  echo '</ul>';  endif;  echo ''; ?>

<!--  Ward's Messages LeftColumn  -->

<?php elseif ('wards_list' == $this->_tpl_vars['m_page']):  echo '<!--  Ward\'s List LeftColumn  --><div id="id_srch_filts" style="display: block; visibility: block;"><div style="display: none;"><form id="id_frm_srch" action="';  echo $this->_tpl_vars['siteAdr'];  echo 'base/Search/SearchWards" method="post" onsubmit="javascript: return false;" ><div><input id="id_srch_edit" name="SI[bfilt]" type="text" value="" onclick="this.value=\'\';" onkeypress="if((event.keyCode == 0x0D) || ((event.ctrlKey) && ((event.keyCode == 0xA) || (event.keyCode == 0x0D) || (event.keyCode == 0xD)))) oSearch.Search(\'id_frm_srch\'); return;" /><a id="id_btn_search" href="javascript: void(0);" onclick="oSearch.Search(\'id_frm_srch\', 1);"><img src="';  echo $this->_tpl_vars['imgDir'];  echo 'find_b2.gif" alt="" /></a></div><div id="id_browse_attach_srch" style="display: none;"><input id="id_srch_attach_frm_btype" name="SI[btype]" type="hidden" value="Stake/Wards" /><input id="id_srch_attach_frm_static" name="SI[static]" type="hidden" value="1" /></div></form></div>';  if ($this->_tpl_vars['IS_USER']):  echo '<h2>Filters</h2><div class="filter-box"><h3 class="cl_srch_ftype_h3" ftype="Stake"><span><a class="cl_srch_ftype" ftype="Stake" style="cursor: pointer;"><img src="';  echo $this->_tpl_vars['imgDir'];  echo 'arr05.gif" alt="" /></a></span><a href="javascript: void(0);" onclick="$(\'a[ftype=\\\'Stake\\\']\').click();">Stake/ward</a></h3><div ftype="Stake" class="drop-filter"><table><tr><td><span class="niceform"><select name="ward_type" id="ward_type" size="1" style="width:149px"><option value="">Select type</option><option value="1">Stake</option><option value="2">Ward</option></select></span></td></tr><tr><td style="padding-top:10px"><input name="ward_name" type="text" value="Enter stake/ward name" onclick="this.value=\'\';" /></td></tr><tr><td><div class="but-filter"><span><a class="cl_filt_btn" style="cursor: pointer;">Filter</a></span></div></td></tr></table></div></div></div>';  endif;  echo ''; ?>

<!--  Ward's List LeftColumn  -->

<?php elseif ('mission_wall' == $this->_tpl_vars['m_page']):  echo '<!--  Mission\'s Messages LeftColumn  --><h2 class="lowprof" id="mtl_';  echo $this->_tpl_vars['mission_i']['id'];  echo '">';  if ($this->_tpl_vars['mission_i']['country'] && $this->_tpl_vars['mission_i']['city']):  echo '';  echo $this->_tpl_vars['mission_i']['country'];  echo ', ';  echo $this->_tpl_vars['mission_i']['city'];  echo '';  if ($this->_tpl_vars['mission_i']['region']):  echo ', ';  echo $this->_tpl_vars['mission_i']['region'];  echo '';  endif;  echo '';  else:  echo '';  echo $this->_tpl_vars['mission_i']['title'];  echo '';  endif;  echo '</h2><ul class="list01">';  if (! $this->_tpl_vars['mission_i']['is_mine']):  echo '<li id="id_set_as_mine">Served? &nbsp;<a href="javascript: void(0);" onclick="$(\'#mis_name\').html($(\'#mtl_';  echo $this->_tpl_vars['mission_i']['id'];  echo '\').text()); oMWall.SHConfirmPopup( 1, \'id_confirm_mission_popup\', \'';  echo $this->_tpl_vars['mission_i']['id'];  echo '\' );"><br /> Yes</a> / <a id="id_dosubscr_a" href="javascript: void(0);" ';  if ($this->_tpl_vars['mis_rel']['im_suscr_fr']):  echo ' onclick="oMWall.DoSubscr( 2, \'';  echo $this->_tpl_vars['mission_i']['id'];  echo '\' );" ';  else:  echo ' onclick="oMWall.DoSubscr( 1, \'';  echo $this->_tpl_vars['mission_i']['id'];  echo '\' );" href="javascript: void(0);" ';  endif;  echo '> ';  if ($this->_tpl_vars['mis_rel']['im_suscr_fr']):  echo 'No, and UnWatch ';  else:  echo 'No, but Watch';  endif;  echo '</a></li>';  endif;  echo '</ul>';  if ($this->_tpl_vars['mission_i']['is_mine']):  echo '';  if (! empty ( $this->_tpl_vars['mission_i']['is_mine']['time'] )):  echo '<h2>Mission Time</h2><ul class="list01">';  $_from = $this->_tpl_vars['mission_i']['is_mine']['time']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['mt']):
 echo '<div id="id_div_mis_time_i_';  echo $this->_tpl_vars['mt']['id'];  echo '">';  if ($this->_tpl_vars['mt']['fdate']):  echo '<li id="id_mis_time_s_from">from ';  echo ((is_array($_tmp=$this->_tpl_vars['mt']['fdate'])) ? $this->_run_mod_handler('moddate', true, $_tmp) : smarty_modifier_moddate($_tmp));  echo '</li>';  endif;  echo '';  if ($this->_tpl_vars['mt']['tdate']):  echo '<li id="id_mis_time_s_to">to ';  echo ((is_array($_tmp=$this->_tpl_vars['mission_i']['is_mine']['tdate'])) ? $this->_run_mod_handler('moddate', true, $_tmp) : smarty_modifier_moddate($_tmp));  echo '</li>';  endif;  echo '';  echo '</div>';  endforeach; endif; unset($_from);  echo '<li><br /><br /><table class="t-edit"><tr><td><span>Best places</span><textarea class="cl_umis_info" name="fm[loc_best_place]" style="width: 100%; ';  if (! $this->_tpl_vars['mission_i']['is_mine']['loc_best_place']):  echo 'color:gray;';  endif;  echo '" onclick="if (\'Best local places...\' == $(this).val()) ClearUpFld(this);">';  if ($this->_tpl_vars['mission_i']['is_mine']['loc_best_place']):  echo '';  echo $this->_tpl_vars['mission_i']['is_mine']['loc_best_place'];  echo '';  else:  echo 'Best local places...';  endif;  echo '</textarea></td></tr><tr><td><span>Food I like</span><textarea class="cl_umis_info" name="fm[loc_food_like]" style="width: 100%;';  if (! $this->_tpl_vars['mission_i']['is_mine']['loc_food_like']):  echo ' color:gray;';  endif;  echo '" onclick="if (\'Local food you like...\' == $(this).val()) ClearUpFld(this);">';  if ($this->_tpl_vars['mission_i']['is_mine']['loc_food_like']):  echo '';  echo $this->_tpl_vars['mission_i']['is_mine']['loc_food_like'];  echo '';  else:  echo 'Local food you like...';  endif;  echo '</textarea></td></tr><tr><td><span>Food I hate</span><textarea class="cl_umis_info" name="fm[loc_food_dislike]" style="width: 100%;';  if (! $this->_tpl_vars['mission_i']['is_mine']['loc_food_dislike']):  echo ' color:gray;';  endif;  echo '" onclick="if (\'Local food you hate...\' == $(this).val()) ClearUpFld(this);">';  if ($this->_tpl_vars['mission_i']['is_mine']['loc_food_dislike']):  echo '';  echo $this->_tpl_vars['mission_i']['is_mine']['loc_food_dislike'];  echo '';  else:  echo 'Local food you hate...';  endif;  echo '</textarea></td></tr><tr><td><span>Will miss the most</span><textarea class="cl_umis_info" name="fm[loc_will_miss]" style="width: 100%;';  if (! $this->_tpl_vars['mission_i']['is_mine']['loc_will_miss']):  echo ' color:gray;';  endif;  echo '" onclick="if (\'What you will miss the most...\' == $(this).val()) ClearUpFld(this);">';  if ($this->_tpl_vars['mission_i']['is_mine']['loc_will_miss']):  echo '';  echo $this->_tpl_vars['mission_i']['is_mine']['loc_will_miss'];  echo '';  else:  echo 'What you will miss the most...';  endif;  echo '</textarea></td></tr><tr><td><span>Testimony</span><textarea class="cl_umis_info" name="fm[loc_temp_language]" style="width: 100%;';  if (! $this->_tpl_vars['mission_i']['is_mine']['loc_temp_language']):  echo ' color:gray;';  endif;  echo '" onclick="if (\'Testimony in mission language...\' == $(this).val()) ClearUpFld(this);">';  if ($this->_tpl_vars['mission_i']['is_mine']['loc_temp_language']):  echo '';  echo $this->_tpl_vars['mission_i']['is_mine']['loc_temp_language'];  echo '';  else:  echo 'Testimony in mission language...';  endif;  echo '</textarea></td></tr></table></li></ul>';  endif;  echo '';  endif;  echo '';  if (! $this->_tpl_vars['CAN_EDIT']):  echo '';  if ($this->_tpl_vars['mission_i']['loc_info']):  echo '';  $this->assign('best_place', $this->_tpl_vars['mission_i']['loc_info']['loc_best_place']);  echo '';  $this->assign('food_i_like', $this->_tpl_vars['mission_i']['loc_info']['loc_food_like']);  echo '';  $this->assign('food_i_hate', $this->_tpl_vars['mission_i']['loc_info']['loc_food_dislike']);  echo '';  $this->assign('ill_miss_most', $this->_tpl_vars['mission_i']['loc_info']['loc_will_miss']);  echo '';  $this->assign('test_lang', $this->_tpl_vars['mission_i']['loc_info']['loc_temp_language']);  echo '';  if ($this->_tpl_vars['best_place']):  echo '<h2>Best places</h2><ul class="list01">';  unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['best_place']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
 echo '<li><span style="color: gray;">';  echo $this->_tpl_vars['best_place'][$this->_sections['i']['index']]['fname'];  echo '</span><br />';  echo ((is_array($_tmp=$this->_tpl_vars['best_place'][$this->_sections['i']['index']]['text'])) ? $this->_run_mod_handler('dlong', true, $_tmp) : smarty_modifier_dlong($_tmp));  echo '</li>';  endfor; endif;  echo '</ul>';  endif;  echo '';  if ($this->_tpl_vars['food_i_like']):  echo '<h2>Food I like</h2><ul class="list01">';  unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['food_i_like']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
 echo '<li><span style="color: gray;">';  echo $this->_tpl_vars['food_i_like'][$this->_sections['i']['index']]['fname'];  echo '</span><br />';  echo ((is_array($_tmp=$this->_tpl_vars['food_i_like'][$this->_sections['i']['index']]['text'])) ? $this->_run_mod_handler('dlong', true, $_tmp) : smarty_modifier_dlong($_tmp));  echo '</li>';  endfor; endif;  echo '</ul>';  endif;  echo '';  if ($this->_tpl_vars['food_i_hate']):  echo '<h2>Food I hate</h2><ul class="list01">';  unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['food_i_hate']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
 echo '<li><span style="color: gray;">';  echo $this->_tpl_vars['food_i_hate'][$this->_sections['i']['index']]['fname'];  echo '</span><br />';  echo ((is_array($_tmp=$this->_tpl_vars['food_i_hate'][$this->_sections['i']['index']]['text'])) ? $this->_run_mod_handler('dlong', true, $_tmp) : smarty_modifier_dlong($_tmp));  echo '</li>';  endfor; endif;  echo '</ul>';  endif;  echo '';  if ($this->_tpl_vars['ill_miss_most']):  echo '<h2>I\'ll miss the most</h2><ul class="list01">';  unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['ill_miss_most']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
 echo '<li><span style="color: gray;">';  echo $this->_tpl_vars['ill_miss_most'][$this->_sections['i']['index']]['fname'];  echo '</span><br />';  echo ((is_array($_tmp=$this->_tpl_vars['ill_miss_most'][$this->_sections['i']['index']]['text'])) ? $this->_run_mod_handler('dlong', true, $_tmp) : smarty_modifier_dlong($_tmp));  echo '</li>';  endfor; endif;  echo '</ul>';  endif;  echo '';  if ($this->_tpl_vars['test_lang']):  echo '<h2>Testimony</h2><ul class="list01">';  unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['test_lang']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
 echo '<li><span style="color: gray;">';  echo $this->_tpl_vars['test_lang'][$this->_sections['i']['index']]['fname'];  echo '</span><br />';  echo ((is_array($_tmp=$this->_tpl_vars['test_lang'][$this->_sections['i']['index']]['text'])) ? $this->_run_mod_handler('dlong', true, $_tmp) : smarty_modifier_dlong($_tmp));  echo '</li>';  endfor; endif;  echo '</ul>';  endif;  echo '';  endif;  echo '';  endif;  echo '';  if ($this->_tpl_vars['lphotos']):  echo '<h2><span><a href="';  echo $this->_tpl_vars['siteAdr'];  echo 'id';  echo $this->_tpl_vars['ui']['uid'];  echo '/albums">View all</a></span>Photos</h2><div class="short-photos">';  unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['lphotos']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['max'] = (int)3;
$this->_sections['i']['show'] = true;
if ($this->_sections['i']['max'] < 0)
    $this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
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
 echo '<a href="';  echo $this->_tpl_vars['siteAdr'];  echo 'id';  echo $this->_tpl_vars['ui']['uid'];  echo '/albums/id';  echo $this->_tpl_vars['lphotos'][$this->_sections['i']['index']]['aid'];  echo '/id';  echo $this->_tpl_vars['lphotos'][$this->_sections['i']['index']]['last_image'];  echo '"><img src="';  if ($this->_tpl_vars['lphotos'][$this->_sections['i']['index']]['fpath'] == 'link'):  echo '';  echo $this->_tpl_vars['lphotos'][$this->_sections['i']['index']]['img'];  echo '';  else:  echo '';  echo $this->_tpl_vars['fImgDir'];  echo '';  if (2 == $this->_tpl_vars['lphotos'][$this->_sections['i']['index']]['atype']):  echo '';  if ('Wall' == $this->_tpl_vars['lphotos'][$this->_sections['i']['index']]['aname']):  echo 'wall';  elseif ('Mission' == $this->_tpl_vars['lphotos'][$this->_sections['i']['index']]['aname']):  echo 'mission/wall';  elseif ('Journal' == $this->_tpl_vars['lphotos'][$this->_sections['i']['index']]['aname']):  echo 'journal';  elseif ('Ward' == $this->_tpl_vars['lphotos'][$this->_sections['i']['index']]['aname']):  echo 'wards/wall';  endif;  echo '';  else:  echo 'albums';  endif;  echo '/';  echo $this->_tpl_vars['lphotos'][$this->_sections['i']['index']]['fpath'];  echo '/s/s_';  echo $this->_tpl_vars['lphotos'][$this->_sections['i']['index']]['img'];  echo '';  endif;  echo '" alt="" /></a>';  endfor; endif;  echo '</div>';  endif;  echo '';  if ($this->_tpl_vars['lvideos']):  echo '<h2><span><a href="';  echo $this->_tpl_vars['siteAdr'];  echo 'id';  echo $this->_tpl_vars['ui']['uid'];  echo '/valbums">View all</a></span>Videos</h2><div class="short-video">';  unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['lvideos']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['max'] = (int)2;
$this->_sections['i']['show'] = true;
if ($this->_sections['i']['max'] < 0)
    $this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
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
 echo '';  if ($this->_tpl_vars['lvideos'][$this->_sections['i']['index']]['video_img']):  echo '<p><a href="';  echo $this->_tpl_vars['siteAdr'];  echo 'id';  echo $this->_tpl_vars['ui']['uid'];  echo '/valbums/id';  echo $this->_tpl_vars['lvideos'][$this->_sections['i']['index']]['vaid'];  echo '/id';  echo $this->_tpl_vars['lvideos'][$this->_sections['i']['index']]['last_video'];  echo '"><img src="';  echo $this->_tpl_vars['lvideos'][$this->_sections['i']['index']]['video_img'];  echo '" alt="" style="max-width: 74px; max-height: 50px;" /></a><b><img src="';  echo $this->_tpl_vars['imgDir'];  echo 'play_b.png" alt="" /></b></p>';  endif;  echo '';  endfor; endif;  echo '</div>';  endif;  echo '';  if ($this->_tpl_vars['mission_i']['is_mine']['pr_first_name'] || $this->_tpl_vars['mission_i']['is_mine']['pr_lastt_name'] || $this->_tpl_vars['CAN_EDIT']):  echo '<br /><br /><h2>President</h2><ul class="list01">';  if ($this->_tpl_vars['mission_i']['is_mine']['pr_first_name'] || $this->_tpl_vars['mission_i']['is_mine']['pr_lastt_name']):  echo '<li><table><tr><td style="width: 25%;"><span style="color: gray;">President</span></td><td style="width: 5%;">&nbsp</td><td>&nbsp</td></tr><tr><td align="center" style="';  if ($this->_tpl_vars['mission_i']['is_mine']['pr_p_img']):  echo ' width: 25%; ';  else:  echo ' width: 0px; ';  endif;  echo '">';  $this->assign('prfname', ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['mission_i']['is_mine']['pr_first_name'])) ? $this->_run_mod_handler('cat', true, $_tmp, ' ') : smarty_modifier_cat($_tmp, ' ')))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['mission_i']['is_mine']['pr_last_name']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['mission_i']['is_mine']['pr_last_name'])));  echo '<img src="';  if ($this->_tpl_vars['mission_i']['is_mine']['pr_p_img']):  echo ' ';  echo $this->_tpl_vars['fImgDir'];  echo 'mission/info/president/';  echo $this->_tpl_vars['mission_i']['is_mine']['pr_p_img'];  echo ' ';  else:  echo ' ';  echo $this->_tpl_vars['imgDir'];  echo 'no_photo_m42.jpg ';  endif;  echo '" style="max-width: 42px; max-height: 42px;" title="';  echo $this->_tpl_vars['prfname'];  echo '" alt="';  echo $this->_tpl_vars['prfname'];  echo '" /></td><td style="width: 5%;">&nbsp</td><td><table class="pres_table"><tr><td><span>';  echo $this->_tpl_vars['prfname'];  echo '</span></td></tr><tr><td><span>';  echo $this->_tpl_vars['mission_i']['is_mine']['pr_phone'];  echo '</span></td></tr><tr><td><span>';  echo $this->_tpl_vars['mission_i']['is_mine']['pr_email'];  echo '</span></td></tr></table></td></tr></table></li>';  endif;  echo '';  if ($this->_tpl_vars['CAN_EDIT'] && $this->_tpl_vars['IS_USER']):  echo '<li><a href="javascript: void(0);" onclick="oMission.SHPresidentPopup( 1, \'id_add_president_popup\' );">';  if ($this->_tpl_vars['mission_i']['is_mine']['pr_first_name'] || $this->_tpl_vars['mission_i']['is_mine']['pr_lastt_name']):  echo ' Edit president info ';  else:  echo ' Suggest president info';  endif;  echo '</a></li>';  endif;  echo '</ul>';  endif;  echo ''; ?>

<!--  Mission's Messages LeftColumn  -->

<?php elseif ('mission_list' == $this->_tpl_vars['m_page']):  echo '<!--  Mission\'s List LeftColumn  --><div id="id_srch_filts" style="display: block; visibility: block;"><div style="display: none;"><form id="id_frm_srch" action="';  echo $this->_tpl_vars['siteAdr'];  echo 'base/search" method="post" onsubmit="javascript: return false;" ><div><input id="id_srch_edit" name="SI[bfilt]" type="text" value="" onclick="this.value=\'\';" onkeypress="if((event.keyCode == 0x0D) || ((event.ctrlKey) && ((event.keyCode == 0xA) || (event.keyCode == 0x0D) || (event.keyCode == 0xD)))) oSearch.Search(\'id_frm_srch\'); return;" /><a id="id_btn_search" href="javascript: void(0);" onclick="oSearch.Search(\'id_frm_srch\', 1);"><img src="';  echo $this->_tpl_vars['imgDir'];  echo 'find_b2.gif" alt="" /></a></div><div id="id_browse_attach_srch" style="display: none;"><input id="id_srch_attach_frm_btype" name="SI[btype]" type="hidden" value="Missions" /><input id="id_srch_attach_frm_static" name="SI[static]" type="hidden" value="1" /></div></form></div>';  if ($this->_tpl_vars['IS_USER']):  echo '<h2>Filters \\ Search</h2><div class="filter-box"><h3 class="cl_srch_ftype_h3" ftype="Mission"><span><a class="cl_srch_ftype" ftype="Mission" style="cursor: pointer;"><img src="';  echo $this->_tpl_vars['imgDir'];  echo 'arr05.gif" alt="" /></a></span><a href="javascript: void(0);" onclick="$(\'a[ftype=\\\'Mission\\\']\').click();">Mission</a></h3><div ftype="Mission" class="drop-filter"><table><tr><td colspan="2"><label>Mission location</label></td></tr><tr><td colspan="2"><input name="mission_location" class="mission_location" type="text" value="Enter location here" onclick="this.value=\'\';" /></td></tr><tr><td colspan="2"><label style="padding-top:5px">Year (from)</label></td></tr><tr><td><span class="niceform"><select name="mission_from_month" size="1"><option value="">Month</option>';  $_from = $this->_tpl_vars['mm']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
 echo '<option value="';  echo $this->_tpl_vars['k'];  echo '">';  echo $this->_tpl_vars['i'];  echo '</option>';  endforeach; endif; unset($_from);  echo '</select></span></td><td><span class="niceform"><select name="mission_from_year" size="1"><option value="">Year</option>';  unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['yy']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
 echo '';  echo '<option value="';  echo $this->_tpl_vars['yy'][$this->_sections['i']['index']];  echo '">';  echo $this->_tpl_vars['yy'][$this->_sections['i']['index']];  echo '</option>';  endfor; endif;  echo '</select></span></td></tr><tr><td colspan="2"><label>to</label></td></tr><tr><td><span class="niceform"><select name="mission_to_month" size="1"><option value="">Month</option>';  $_from = $this->_tpl_vars['mm']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
 echo '<option value="';  echo $this->_tpl_vars['k'];  echo '">';  echo $this->_tpl_vars['i'];  echo '</option>';  endforeach; endif; unset($_from);  echo '</select></span></td><td><span class="niceform"><select name="mission_to_year" size="1"><option value="">Year</option>';  unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['yy']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
 echo '';  echo '<option value="';  echo $this->_tpl_vars['yy'][$this->_sections['i']['index']];  echo '">';  echo $this->_tpl_vars['yy'][$this->_sections['i']['index']];  echo '</option>';  endfor; endif;  echo '</select></span></td></tr><tr><td></td><td><div class="but-filter"><span><a class="cl_filt_btn" style="cursor: pointer;">Search</a></span></div></td></tr></table></div></div>';  endif;  echo '</div><!--  Mission\'s List LeftColumn  -->'; ?>

<?php elseif ('albums_photos' == $this->_tpl_vars['m_page']):  echo '<h2>';  if ($this->_tpl_vars['owner']):  echo '<span><a href="javascript: void(0);" onclick="oAlbums.SHUplPopup( 1, \'id_add_album_popup\' );">Add new</a></span> ';  endif;  echo 'Albums</h2><ul class="album-list">';  unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['other_alb']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
 echo '<li><span><a href="';  echo $this->_tpl_vars['siteAdr'];  echo 'id';  echo $this->_tpl_vars['other_alb'][$this->_sections['i']['index']]['uid'];  echo '/albums/id';  echo $this->_tpl_vars['other_alb'][$this->_sections['i']['index']]['aid'];  echo '"><img src="';  if ($this->_tpl_vars['other_alb'][$this->_sections['i']['index']]['img']):  echo '';  if ($this->_tpl_vars['other_alb'][$this->_sections['i']['index']]['img']['fpath'] == 'link'):  echo '';  echo $this->_tpl_vars['other_alb'][$this->_sections['i']['index']]['img']['img'];  echo '';  else:  echo '';  echo $this->_tpl_vars['fImgDir'];  echo '';  if (2 == $this->_tpl_vars['other_alb'][$this->_sections['i']['index']]['type']):  echo '';  if ('Wall' == $this->_tpl_vars['other_alb'][$this->_sections['i']['index']]['name']):  echo 'wall/';  elseif ('Mission' == $this->_tpl_vars['other_alb'][$this->_sections['i']['index']]['name']):  echo 'mission/wall/';  elseif ('Ward' == $this->_tpl_vars['other_alb'][$this->_sections['i']['index']]['name']):  echo 'wards/wall/';  endif;  echo '';  else:  echo 'albums/';  endif;  echo '';  echo $this->_tpl_vars['other_alb'][$this->_sections['i']['index']]['img']['fpath'];  echo '/n/n_';  echo $this->_tpl_vars['other_alb'][$this->_sections['i']['index']]['img']['img'];  echo '';  endif;  echo '';  else:  echo '';  echo $this->_tpl_vars['imgDir'];  echo 'no_photo_m100.jpg';  endif;  echo '" alt="" style="max-width: 100px; max-height: 100px;" /></a></span><p>';  if ($this->_tpl_vars['other_alb'][$this->_sections['i']['index']]['cnt_img']):  echo '';  echo $this->_tpl_vars['other_alb'][$this->_sections['i']['index']]['cnt_img'];  echo '';  else:  echo 'No';  endif;  echo ' photos <br />';  if ($this->_tpl_vars['other_alb'][$this->_sections['i']['index']]['name']):  echo '<a href="';  echo $this->_tpl_vars['siteAdr'];  echo 'id';  echo $this->_tpl_vars['other_alb'][$this->_sections['i']['index']]['uid'];  echo '/albums/id';  echo $this->_tpl_vars['other_alb'][$this->_sections['i']['index']]['aid'];  echo '">';  echo ((is_array($_tmp=$this->_tpl_vars['other_alb'][$this->_sections['i']['index']]['name'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 30) : smarty_modifier_truncate($_tmp, 30));  echo '</a>';  endif;  echo '</p></li>';  endfor; endif;  echo '</ul>'; ?>

<?php elseif ('inbox' == $this->_tpl_vars['m_page']):  echo '';  $this->assign('fname', ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['UserInfo']['first_name'])) ? $this->_run_mod_handler('cat', true, $_tmp, ' ') : smarty_modifier_cat($_tmp, ' ')))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['UserInfo']['last_name']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['UserInfo']['last_name'])));  echo '<h2  class="lowprof">';  if ($this->_tpl_vars['UserInfo']['first_name'] || $this->_tpl_vars['UserInfo']['last_name']):  echo '';  echo $this->_tpl_vars['fname'];  echo '';  endif;  echo '</h2><ul class="list01"><li><a href="javascript: oUsers.ChangeAppear(1);" class="appear_offline" style="display:';  if (! $this->_tpl_vars['UserInfo']['appear_offline']):  echo 'inline';  else:  echo 'none';  endif;  echo '">Appear offline<img src="';  echo $this->_tpl_vars['imgDir'];  echo 'appear_off_ico.gif" style="float:right;margin-bottom:20px;margin-right: 5px;"/></a><a href="javascript: oUsers.ChangeAppear(0);" class="appear_online" style="display:';  if ($this->_tpl_vars['UserInfo']['appear_offline']):  echo 'inline';  else:  echo 'none';  endif;  echo '">Appear online<img src="';  echo $this->_tpl_vars['imgDir'];  echo 'appear_on_ico.gif" style="float:right;margin-bottom:20px;margin-right: 5px;" /></a></li><!--li><a href="javascript: void(0);">Disable sounds</a><img src="';  echo $this->_tpl_vars['imgDir'];  echo 'sound_disable_ico.gif" style="float:right; margin-right: 5px" /></li--></ul><h2>Friends ';  if ($this->_tpl_vars['cnt_ar_fr']):  echo '<b>';  echo $this->_tpl_vars['cnt_ar_fr'];  echo '</b>';  endif;  echo '</h2><div class="sort"><input id="id_inb_fr_rlist_find" type="text" value="Find user..." sb="1" onclick="if (this.value==\'Find user...\') this.value=\'\';" /><p><a class="cl_fr_list_recent" style="cursor: pointer;" sb="0">Recent</a>&nbsp;&nbsp; <a class="cl_fr_list_recent" style="cursor: pointer; color: #000;" sb="1">A-Z</a>&nbsp; <a class="cl_fr_list_recent" style="cursor: pointer;" sb="2">Blocked</a> &nbsp;<a class="cl_fr_list_recent" style="cursor: pointer;" sb="3">Online</a></p></div><div class="friend-box"><ul id="id_inb_fr_rlist">';  $_from = $this->_tpl_vars['ar_fr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['fk'] => $this->_tpl_vars['fi']):
 echo '<li id="id_fr_rlist_';  echo $this->_tpl_vars['fi']['uid'];  echo '" class="cl_rlist_fr ';  if ($this->_tpl_vars['lfr_id'] == $this->_tpl_vars['fi']['uid']):  echo ' act ';  endif;  echo '" ><img src="';  if ($this->_tpl_vars['fi']['image']):  echo '';  echo $this->_tpl_vars['fImgDir'];  echo 'users/';  echo $this->_tpl_vars['fi']['fpath'];  echo '/s/s_';  echo $this->_tpl_vars['fi']['image'];  echo '';  else:  echo '';  echo $this->_tpl_vars['imgDir'];  echo 'no_photo_m42.jpg';  endif;  echo '"  style="width: 42px; height: 42px;"  />';  if (isset ( $this->_tpl_vars['fi']['is_online'] )):  echo '<span class="awatar"></span>';  endif;  echo '';  if ($this->_tpl_vars['fi']['cnt_new_mes']):  echo ' <span>';  echo $this->_tpl_vars['fi']['cnt_new_mes'];  echo '</span> ';  endif;  echo '<p><a class="cl_rlist_fr_el" fr_uid="';  echo $this->_tpl_vars['fi']['uid'];  echo '"  href="javascript: void(0);">';  echo $this->_tpl_vars['fi']['first_name'];  echo ' ';  echo $this->_tpl_vars['fi']['last_name'];  echo '</a>';  if ($this->_tpl_vars['fi']['last_update']):  echo '';  echo $this->_tpl_vars['fi']['last_update'];  echo '';  endif;  echo '</p></li>';  endforeach; endif; unset($_from);  echo '</ul></div>'; ?>

<?php else:  echo '<!--  Wall LeftColumn  -->';  $this->assign('fname', ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['ui']['first_name'])) ? $this->_run_mod_handler('cat', true, $_tmp, ' ') : smarty_modifier_cat($_tmp, ' ')))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['ui']['last_name']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['ui']['last_name'])));  echo '<h2 class="lowprof">';  echo $this->_tpl_vars['fname'];  echo '</h2>';  if (! $this->_tpl_vars['im_blocked'] && ! $this->_tpl_vars['ui']['is_deleted']):  echo '<ul class="list01"><li><a href="';  echo $this->_tpl_vars['siteAdr'];  echo 'id';  echo $this->_tpl_vars['ui']['uid'];  echo '">News feed</a></li>';  if (! $this->_tpl_vars['IS_USER']):  echo '<li><a href="';  echo $this->_tpl_vars['siteAdr'];  echo 'id';  echo $this->_tpl_vars['UserInfo']['uid'];  echo '">Back to my Feed</a>';  endif;  echo '<li><a href="';  echo $this->_tpl_vars['siteAdr'];  echo 'id';  echo $this->_tpl_vars['ui']['uid'];  echo '/friends">Friends</a> ';  if ($this->_tpl_vars['IS_USER'] && $this->_tpl_vars['cnt_myfrinvites']):  echo '<span style="position: relative; float: right; margin-right: 5px;">(';  echo $this->_tpl_vars['cnt_myfrinvites'];  echo ')</span>';  endif;  echo ' </li><li><a href="';  echo $this->_tpl_vars['siteAdr'];  echo 'id';  echo $this->_tpl_vars['ui']['uid'];  echo '/albums">Photo albums</a></li><li><a href="';  echo $this->_tpl_vars['siteAdr'];  echo 'id';  echo $this->_tpl_vars['ui']['uid'];  echo '/valbums">Video albums</a></li><li><a href="';  echo $this->_tpl_vars['siteAdr'];  echo 'id';  echo $this->_tpl_vars['ui']['uid'];  echo '/settings">';  if ($this->_tpl_vars['IS_USER']):  echo 'My info';  else:  echo 'Info';  endif;  echo '</a></li>';  if ($this->_tpl_vars['IS_USER']):  echo '<li><a href="';  echo $this->_tpl_vars['siteAdr'];  echo 'id';  echo $this->_tpl_vars['UserInfo']['uid'];  echo '/options">Settings</a></li>';  endif;  echo '';  if (! $this->_tpl_vars['IS_USER']):  echo '<li id="friend_block">';  if (! $this->_tpl_vars['ui']['im_friend']):  echo '<a href="javascript: void(0);" onclick="oFriends.GetFrAjax(\'';  echo $this->_tpl_vars['ui']['uid'];  echo '\', 0)">Add as a friend</a>';  elseif (3 == $this->_tpl_vars['ui']['im_friend']):  echo '<b>Blocked</b>';  else:  echo '<a href="javascript: void(0);" onclick="oFriends.SHConfirmPopup(1, \'id_confirm_friends_popup\', \'';  echo $this->_tpl_vars['ui']['uid'];  echo '\')">';  if (2 == $this->_tpl_vars['ui']['im_friend']):  echo 'Cancel Invitation';  else:  echo 'Unfriend';  endif;  echo '</a>';  endif;  echo '</li>';  endif;  echo '';  if (! $this->_tpl_vars['IS_USER']):  echo '';  echo '<li><a id="id_dosubscr_a" href="javascript: void(0);" onclick="oUsers.DoSubscr();">';  if ($this->_tpl_vars['ui']['im_suscr_fr']):  echo 'Unfollow';  else:  echo 'Follow';  endif;  echo '</a></li>';  endif;  echo '<li><a href="javascript:void(0);" onclick="$(\'#show_invite\').show();">Invite friends</a></li><li><a href="';  echo $this->_tpl_vars['siteAdr'];  echo '?logout=1">Sign out</a></li></ul>';  echo '';  if (! $this->_tpl_vars['IS_USER'] && ! $this->_tpl_vars['basic_denied']):  echo '<h2><span><a href="';  echo $this->_tpl_vars['siteAdr'];  echo 'id';  echo $this->_tpl_vars['ui']['uid'];  echo '/settings">View all</a></span> Information</h2>';  if (! $this->_tpl_vars['ui']['no_dob'] && $this->_tpl_vars['ui']['dob'] != '0000-00-00'):  echo '<div class="clear" style="height:8px;"><!-- --></div><b style="color:#999999;">Birthday</b><br /><b>';  echo ((is_array($_tmp=$this->_tpl_vars['ui']['dob'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%B %e, %Y") : smarty_modifier_date_format($_tmp, "%B %e, %Y"));  echo '</b><br />';  endif;  echo '';  if ($this->_tpl_vars['ui']['rel_status']):  echo '<div class="clear" style="height:8px;"><!-- --></div><b style="color:#999999;">Relationship status</b><br />';  if ($this->_tpl_vars['ui']['rel_status'] == 1):  echo '<b>Single</b>';  endif;  echo '';  if ($this->_tpl_vars['ui']['rel_status'] == 2):  echo '<b>Married</b>';  endif;  echo '';  if ($this->_tpl_vars['ui']['rel_status'] == 3):  echo '<b>Divorced</b>';  endif;  echo '';  if ($this->_tpl_vars['ui']['rel_status'] == 4):  echo '<b>Separated</b>';  endif;  echo '';  if ($this->_tpl_vars['ui']['rel_status'] == 5):  echo '<b>Widowed</b>';  endif;  echo '<br />';  endif;  echo '';  if ($this->_tpl_vars['ui']['live_in']):  echo '<div class="clear" style="height:8px;"><!-- --></div><b style="color:#999999;">Current location</b><br /><b>';  echo $this->_tpl_vars['ui']['live_in'];  echo '</b><br />';  endif;  echo '';  endif;  echo '<div style="padding-top:7px;">';  if ($this->_tpl_vars['IS_USER']):  echo '<div><h2 style="margin-top: -30px;"><span><a id="id_scripture_btn_edit" href="javascript: void(0);" onclick="oUsers.EditScripture( 1 );" style="display: none;"  onmouseover="$(this).show();">Edit</a></span></h2></div>';  endif;  echo '<br /><div id="id_scripture" class="snoska" onmouseover="$(\'#id_scripture_btn_edit\').show();" onmouseout="$(\'#id_scripture_btn_edit\').hide();">';  if ($this->_tpl_vars['ui']['scripture']):  echo '';  echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['ui']['scripture'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)))) ? $this->_run_mod_handler('dlong', true, $_tmp) : smarty_modifier_dlong($_tmp));  echo '';  else:  echo 'There isn\'t any scripture';  endif;  echo '</div><div id="id_scripture_field" style="display: none;"><textarea id="id_scripture_txt" cols="17">';  echo $this->_tpl_vars['ui']['scripture'];  echo '</textarea></div><div style="text-align: center;">';  echo '<a id="id_scripture_btn_save" href="javascript: void(0);" onclick="oUsers.EditScripture( 2 );" style="display: none; padding-right:10px;" >Save</a><a id="id_scripture_btn_cancel" href="javascript: void(0);" onclick="oUsers.EditScripture( 3 );" style="display: none;" >Cancel</a></div></div>';  if ($this->_tpl_vars['lphotos']):  echo '<h2><span><a href="';  echo $this->_tpl_vars['siteAdr'];  echo 'id';  echo $this->_tpl_vars['ui']['uid'];  echo '/albums">View all</a></span>Photos</h2><div class="short-photos">';  unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['lphotos']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['max'] = (int)3;
$this->_sections['i']['show'] = true;
if ($this->_sections['i']['max'] < 0)
    $this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
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
 echo '<a href="';  echo $this->_tpl_vars['siteAdr'];  echo 'id';  echo $this->_tpl_vars['ui']['uid'];  echo '/albums/id';  echo $this->_tpl_vars['lphotos'][$this->_sections['i']['index']]['aid'];  echo '/id';  echo $this->_tpl_vars['lphotos'][$this->_sections['i']['index']]['last_image'];  echo '"><img src="';  if ($this->_tpl_vars['lphotos'][$this->_sections['i']['index']]['fpath'] == 'link'):  echo '';  echo $this->_tpl_vars['lphotos'][$this->_sections['i']['index']]['img'];  echo '';  else:  echo '';  echo $this->_tpl_vars['fImgDir'];  echo '';  if (2 == $this->_tpl_vars['lphotos'][$this->_sections['i']['index']]['atype']):  echo '';  if ('Wall' == $this->_tpl_vars['lphotos'][$this->_sections['i']['index']]['aname']):  echo 'wall';  elseif ('Mission' == $this->_tpl_vars['lphotos'][$this->_sections['i']['index']]['aname']):  echo 'mission/wall';  elseif ('Journal' == $this->_tpl_vars['lphotos'][$this->_sections['i']['index']]['aname']):  echo 'journal';  elseif ('Ward' == $this->_tpl_vars['lphotos'][$this->_sections['i']['index']]['aname']):  echo 'wards/wall';  endif;  echo '';  else:  echo 'albums';  endif;  echo '/';  echo $this->_tpl_vars['lphotos'][$this->_sections['i']['index']]['fpath'];  echo '/s/s_';  echo $this->_tpl_vars['lphotos'][$this->_sections['i']['index']]['img'];  echo '';  endif;  echo '" alt="" /></a>';  endfor; endif;  echo '</div>';  endif;  echo '';  if ($this->_tpl_vars['lvideos']):  echo '<h2><span><a href="';  echo $this->_tpl_vars['siteAdr'];  echo 'id';  echo $this->_tpl_vars['ui']['uid'];  echo '/valbums">View all</a></span>Videos</h2><div class="short-video">';  unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['lvideos']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['max'] = (int)2;
$this->_sections['i']['show'] = true;
if ($this->_sections['i']['max'] < 0)
    $this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
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
 echo '';  if ($this->_tpl_vars['lvideos'][$this->_sections['i']['index']]['video_img']):  echo '<p><a href="';  echo $this->_tpl_vars['siteAdr'];  echo 'id';  echo $this->_tpl_vars['ui']['uid'];  echo '/valbums/id';  echo $this->_tpl_vars['lvideos'][$this->_sections['i']['index']]['vaid'];  echo '/id';  echo $this->_tpl_vars['lvideos'][$this->_sections['i']['index']]['last_video'];  echo '"><img src="';  echo $this->_tpl_vars['lvideos'][$this->_sections['i']['index']]['video_img'];  echo '" alt="" style="max-width: 74px; max-height: 50px;" /></a><b><img src="';  echo $this->_tpl_vars['imgDir'];  echo 'play_b.png" alt="" /></b></p>';  endif;  echo '';  endfor; endif;  echo '</div>';  endif;  echo '';  if ('journal' == $this->_tpl_vars['m_page']):  echo '<div id="tags_div">';  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'mods/adtmpl/_tags_leftcolumn.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  echo '</div><div id="journal_div">';  if (! $this->_tpl_vars['IS_USER']):  echo '<h2>Journal</h2><ul class="list01">';  if (! $this->_tpl_vars['IS_USER']):  echo '<li><a href="';  echo $this->_tpl_vars['siteAdr'];  echo 'id';  echo $this->_tpl_vars['UserInfo']['uid'];  echo '/journal">Back to my Journal</a>';  endif;  echo '';  if (! $this->_tpl_vars['IS_USER']):  echo '';  if ($this->_tpl_vars['ui']['global']['notes']):  echo '<li><a id="id_dosubscr_j" href="javascript: void(0);" onclick="oJournal.DoSubscr();">';  if ($this->_tpl_vars['ui']['im_suscr_jr']):  echo 'Unfollow';  else:  echo 'Follow';  endif;  echo '</a></li>';  endif;  echo '';  endif;  echo '</ul>';  else:  echo '';  if ($this->_tpl_vars['jsubscr'] && $this->_tpl_vars['IS_USER']):  echo '<h2 style="padding-top:5px; font-size: 13px;">';  if (3 < $this->_tpl_vars['cnt_jsubscr']):  echo '<span style="font-size:11px;"><a href="';  echo $this->_tpl_vars['siteAdr'];  echo 'id';  echo $this->_tpl_vars['ui']['uid'];  echo '/journal/getsubscr/">All</a></span>';  endif;  echo ' Journals I follow <b> ';  echo $this->_tpl_vars['cnt_jsubscr'];  echo ' </b></h2><ul class="list03" style="margin-bottom:5px;">';  $_from = $this->_tpl_vars['jsubscr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
 echo '<li style="width: 47px; height:49px; margin-bottom:10px;"><a href="';  echo $this->_tpl_vars['siteAdr'];  echo 'id';  echo $this->_tpl_vars['i']['wuid'];  echo '/journal"><img src="';  if ($this->_tpl_vars['i']['image']):  echo '';  echo $this->_tpl_vars['fImgDir'];  echo 'users/';  echo $this->_tpl_vars['i']['fpath'];  echo '/s/s_';  echo $this->_tpl_vars['i']['image'];  echo '';  else:  echo '';  echo $this->_tpl_vars['imgDir'];  echo 'no_photo_m42.jpg';  endif;  echo '"  style="width: 29px; height: 29px;" /></a> <a href="';  echo $this->_tpl_vars['siteAdr'];  echo 'id';  echo $this->_tpl_vars['i']['wuid'];  echo '/journal">';  echo $this->_tpl_vars['i']['first_name'];  echo ' ';  echo $this->_tpl_vars['i']['last_name'];  echo '</a></li>';  endforeach; endif; unset($_from);  echo '</ul>';  endif;  echo '';  endif;  echo '</div>';  endif;  echo '';  endif;  echo ''; ?>

<!--  Wall LeftColumn  -->
<?php endif; ?>

<div style="margin-top:10px;">
    <script type="text/javascript">//<!--
    google_ad_client = "ca-pub-1823921138820137";
    /* inZion Banner */
    google_ad_slot = "7585652734";
    google_ad_width = 160;
    google_ad_height = 600;
    //-->
    </script>
    <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
</div>