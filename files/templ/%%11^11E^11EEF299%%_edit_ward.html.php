<?php /* Smarty version 2.6.11, created on 2014-03-15 08:51:17
         compiled from mods/users/ajax/_edit_ward.html */ ?>
<form method="post" id="church_info_form">
    <table class="t-edit">

        <tbody>
        <tr>
		<td width="124">
			<label>Ward/Branch &nbsp</label>
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
        <br />
      	<tr>
		<td width="124">
			<label></label>
		</td>
		<td>
			<a style="float:left; cursor:pointer;" href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['UserInfo']['uid']; ?>
/settings?ed_mission">Church-related information</a>
		</td>
        </tr>
	<tr>
		<td width="124">
			<label></label>
		</td>
		<td>
			<a style="float:left; cursor:pointer;" href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['UserInfo']['uid']; ?>
/settings?ed_basic">Basic information</a>
		</td>
        </tr>
	<tr>
		<td width="124">
			<label></label>
		</td>
		<td>
			<a style="float:left; cursor:pointer;" href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['UserInfo']['uid']; ?>
/settings?ed_contact">Contacts information</a>
		</td>
        </tr>
	<tr>
		<td width="124">
			<label></label>
		</td>
		<td>
			<a style="float:left; cursor:pointer;" href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['UserInfo']['uid']; ?>
/settings?ed_inerest">Interests information</a>
		</td>
        </tr>
	<tr>
		<td width="124">
			<label></label>
		</td>
		<td>
			<a style="float:left; cursor:pointer;" href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['UserInfo']['uid']; ?>
/settings?ed_work">Education/Work information</a>
		</td>
        </tr>
    </tbody>

    <tr style="height:50px;">
        <td colspan="2" align="right">
            <div class="aj-button">
                <!--span class="aj-button01"><a href="javascript:void(0);" id="basic_cancel" onclick="oUsers.SettingsChurchCnl();">Cancel</a></span-->
                <span class="aj-button02"><a href="javascript:void(0);" id="basic_save" onclick="oUsers.SettingsChurchSubmWeek();">Save</a></span>
            </div>
        </td>
    </tr>
</table>
</form>