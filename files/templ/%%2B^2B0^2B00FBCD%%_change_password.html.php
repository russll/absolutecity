<?php /* Smarty version 2.6.11, created on 2014-03-15 08:51:02
         compiled from mods/users/_change_password.html */ ?>
    <h2>Change member password</h2>
    
    <div style="margin: 10px 0 0 10px;">Welcome back, you are one step away from changing your password.</div>
    <?php if ($this->_tpl_vars['errs']): ?>
        <br /><p style="color:red;">Wrong passwords</p>
        <br />
    <?php endif; ?>
    
    <form method="post" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
security/users/forgot">
    <div class="reg-form">
    <table style="margin: 0px; padding: 0px;">
    <tr>
        <td><b>E-mail:</b></td>
        <td><b><?php echo $this->_tpl_vars['ui']['email']; ?>
</b></td>
    </tr>
    <tr><td colspan="2" style="height:10px;"></td></tr>
    <tr>
        <td colspan="2">Please enter your new password:</td>
    </tr>
    <tr>
        <td><b>Password:</b></td>
        <td><p><input type="password" name="fm[pass]" value="" class="txt" /></p></td>
    </tr>
    <tr>
        <td><b>Confirm Password:</b></td>
        <td><p><input type="password" name="fm[pass2]" value="" class="txt" /></p></td>
    </tr>
    <tr>
        <td></td>
        <td align="right"><input type="submit" value="Continue >>" /></td>
    </tr>
    </table>
     </div>
    </form>