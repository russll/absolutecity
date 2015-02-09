<?php /* Smarty version 2.6.11, created on 2014-03-15 09:25:40
         compiled from mods/static/_contact_us.html */ ?>
<h2>Contact Us</h2>
<div class="reg-form" >
    <?php if ($this->_tpl_vars['send']): ?>
        <p>Thank you for feedback. We will review your message and get back to you.</p>
    <?php else: ?>

    Thank you for your interest in inZion.  So we can better serve you, please fill in the required fields in the form below before submitting your request.
    <br /><br />
    <form method="post" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
contact_us.html">
    <div class="reg-form" style="margin-left:35px;">
    <?php if ($this->_tpl_vars['errs']): ?>
        <font color="red">
            <?php $_from = $this->_tpl_vars['errs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                - <?php echo $this->_tpl_vars['i']; ?>
<br />
            <?php endforeach; endif; unset($_from); ?>
        </font>
    <?php endif; ?>
    <table style="width:350px;">
        <tr>
            <td colspan="2"></td>
        </tr>
		<tr>
            <td colspan="2">* denotes required fields</td>
        </tr>

		<tr>
            <td>Email*<br /><input style="width:180px;" type="text" class="txt" name="fm[email]" value="<?php echo $this->_tpl_vars['fm']['email']; ?>
" /></td>
            <td>Name*<br /><input style="width:180px;" type="text" class="txt" name="fm[name]" value="<?php echo $this->_tpl_vars['fm']['name']; ?>
" /></td>
        </tr>
        <tr>
            <td>Occupation: (optional)<br /><input type="text" style="width:180px;" name="fm[occupation]" value="<?php echo $this->_tpl_vars['fm']['occupation']; ?>
" /></td>
            <td>Organization: (optional)<br /><input type="text" style="width:180px;" name="fm[organization]" value="<?php echo $this->_tpl_vars['fm']['organization']; ?>
" /></td>
        </tr>

		<tr>
            <td>Country: (optional)<br /><select name="fm[country]" style="width:180px;">
            <?php $_from = $this->_tpl_vars['countries']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                <option value="<?php echo $this->_tpl_vars['k']; ?>
"<?php if ($this->_tpl_vars['fm']['country'] == $this->_tpl_vars['k']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['i']; ?>
</option>
            <?php endforeach; endif; unset($_from); ?>
            </select></td>

            <td align="right">&nbsp;</td>
        </tr>

        <tr>
            <td colspan="2">
                Message*:<br />
                <textarea class="txt" name="fm[mesg]" style="width:400px;"><?php echo $this->_tpl_vars['fm']['mesg']; ?>
</textarea>
            </td>
        </tr>
        
        <tr>
            <td>&nbsp;</td>
            
            <td align="right"><br /><input type="submit" id="send" value="Send" style="width: 100px;" /></td>
        </tr>
        
    </table>
    </div>
    </form>
    <?php endif; ?>
</div>