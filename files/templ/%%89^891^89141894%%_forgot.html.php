<?php /* Smarty version 2.6.11, created on 2014-03-15 08:49:40
         compiled from mods/users/_forgot.html */ ?>
<h2>Forgot Your Password?</h2>
    <?php if (! $this->_tpl_vars['send']): ?>
        <div style="margin: 10px 0 0 10px;">
            Enter your email address below. Instructions on how to change your password will be sent to your email address.

        <?php if ($this->_tpl_vars['forgoterr']): ?><br />
            <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['forgoterr']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	        <?php if ($this->_tpl_vars['forgoterr'][$this->_sections['i']['index']] == 2): ?>
                <br /><font color="red" style="font-size:13px;">- Please specify correct email</font>
	        <?php elseif ($this->_tpl_vars['forgoterr'][$this->_sections['i']['index']] == 3): ?>
                <br /><font color="red" style="font-size:13px;">- this email address doesn't exist in our system</font>
            <?php endif; ?>
	        <?php endfor; endif; ?>
	    <?php endif; ?>
        </div>
             
   
    <form id="ForgotForm" action="/security/users/forgot" method="post">
    <div class="reg-form">
        <table style="margin: 0px; padding: 0px;">
            <tr>
                <td><label>Your email address:</label></td>
                <td><p><input id="email" type="text" name="UserInfo[email]" value="<?php echo $this->_tpl_vars['UserInfo']['email']; ?>
" class="txt" /></p>
                    
                </td>
                <td><input type="submit" id="p_save" value="Continue" /></td>
            </tr>
        </table>
    </div>
    </form>
    <?php else: ?>
        <div style="margin: 10px 0 0 10px;font-size:13px;">
        An email with the password change instructions was sent to <?php echo $this->_tpl_vars['email']; ?>
.<br />
        You should receive it shortly.<br />
        Please follow the link in the email to change your password.<br />
        </div>
    <?php endif; ?>
