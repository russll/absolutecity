<?php /* Smarty version 2.6.11, created on 2014-03-15 09:09:52
         compiled from mods/_popups/_confirm_mission.html */ ?>
<div id="id_confirm_mission_popup" class="aj-box01" align="center" style="display: none; position: fixed; z-index: 4444; max-height: 185px">
    <div class="aj-close"><a href="javascript: void(0);" onclick="oFriends.SHConfirmPopup( 2, 'id_confirm_mission_popup' );"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close_ico.gif"  /></a></div>

    <div style="margin: 10px;" align="left"><h3>&nbsp;</h3></div>

    <div class="" style="max-height: 120px; margin: 10px; border: none !important;">
        <div>
            <div>
                <form id="id_set_ward_popup_frm" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
mission/chngmission" method="get">
                    <input id="id_mission_set_id" name="id" type=hidden value="" />
                    <fieldset style="border: none !important;">
                        <div>
                            <div>
                                <p><span id="id_friend_add_fio"></span></p>
                                <b style="">Please confirm you served this mission "<span id="mis_name">MISSION_LOCATION</span>"?</b>
                                <i style="">Choose the period: </i> <br/><br/>

                                <table>
                                    <tr>
                                        <td>From:</td>
                                        <td><span class="niceform">
                                                <select name="mfm" size="1" style="width:80px;">
                                                    <option value="">Month</option>
						    <?php $_from = $this->_tpl_vars['mm']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                                                    <option value="<?php echo $this->_tpl_vars['k']; ?>
"><?php echo $this->_tpl_vars['i']; ?>
</option>
						    <?php endforeach; endif; unset($_from); ?>
                                                </select></span>
                                        </td>

                                        <td><span class="niceform">
                                                <select name="mfd" size="1" style="width:80px;">
                                                    <option value="">Day</option>
						    <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['dd']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                                    <option value="<?php echo $this->_tpl_vars['dd'][$this->_sections['i']['index']]; ?>
"><?php echo $this->_tpl_vars['dd'][$this->_sections['i']['index']]; ?>
</option>
						    <?php endfor; endif; ?>
                                                </select></span>
                                        </td>
                                        <td><span class="niceform">
                                                <select name="mfy" size="1" style="width:80px;">
                                                    <option value="">Year</option>
						    <?php unset($this->_sections['i']);
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
?>
                                                    <option value="<?php echo $this->_tpl_vars['yy'][$this->_sections['i']['index']]; ?>
"><?php echo $this->_tpl_vars['yy'][$this->_sections['i']['index']]; ?>
</option>
						    <?php endfor; endif; ?>
                                                </select></span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>To:</td>
                                        <td>
                                            <span class="niceform">
                                                <select name="mtm" size="1" style="width:80px;">
                                                    <option value="">Month</option>
						    <?php $_from = $this->_tpl_vars['mm']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                                                    <option value="<?php echo $this->_tpl_vars['k']; ?>
"><?php echo $this->_tpl_vars['i']; ?>
</option>
						    <?php endforeach; endif; unset($_from); ?>
                                                </select>
                                            </span>
                                        </td>
                                        <td><span class="niceform">
                                                <select name="mtd" size="1" style="width:80px;">
                                                    <option value="">Day</option>
						    <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['dd']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
						    <option value="<?php echo $this->_tpl_vars['dd'][$this->_sections['i']['index']]; ?>
"><?php echo $this->_tpl_vars['dd'][$this->_sections['i']['index']]; ?>
</option>
						    <?php endfor; endif; ?>
                                                </select></span>
                                        </td>
                                        <td><span class="niceform">
                                                <select name="mty" size="1" style="width:80px;">
                                                    <option value="">Year</option>
						    <?php unset($this->_sections['i']);
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
?>
						                                                        <option value="<?php echo $this->_tpl_vars['yy'][$this->_sections['i']['index']]; ?>
"><?php echo $this->_tpl_vars['yy'][$this->_sections['i']['index']]; ?>
</option>
						    <?php endfor; endif; ?>
                                                </select></span>
                                        </td>
                                    </tr>

                                </table>


                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    <div class="aj-button" align="left" style="position:absolute;top:140px;left:350px;">
        <span class="aj-button01"><a href="javascript: void(0);" onclick="oMWall.SHConfirmPopup( 2, 'id_confirm_mission_popup' );">No</a></span>
        <span class="aj-button02"><a href="javascript: void(0);" onclick="oMWall.ChngMission();">Yes</a></span>
    </div>
    <span class="block-bottom">&nbsp;</span>
</div>