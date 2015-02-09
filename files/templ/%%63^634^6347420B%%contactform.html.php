<?php /* Smarty version 2.6.11, created on 2014-05-02 05:16:08
         compiled from mails/contactform.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>inZion contact form</title>
</head>
<body>
<br />

<table>
<tr>
    <td>Message:</td><td><?php echo $this->_tpl_vars['fm']['mesg']; ?>
</td>
</tr>
<tr>
    <td>Name:</td><td><?php echo $this->_tpl_vars['fm']['name']; ?>
</td>
</tr>
<tr>
    <td>Email:</td><td><?php echo $this->_tpl_vars['fm']['email']; ?>
</td>
</tr>
<?php if ($this->_tpl_vars['fm']['occupation']): ?>
<tr>
    <td>Occupation:</td><td><?php echo $this->_tpl_vars['fm']['occupation']; ?>
</td>
</tr>
<?php endif;  if ($this->_tpl_vars['fm']['organization']): ?>
<tr>
    <td>Organization:</td><td><?php echo $this->_tpl_vars['fm']['organization']; ?>
</td>
</tr>
<?php endif; ?>
<tr>
    <td>Country:</td><td><?php $this->assign('ov', $this->_tpl_vars['fm']['country']);  echo $this->_tpl_vars['countries'][$this->_tpl_vars['ov']]; ?>
</td>
</tr>
</table>
<br />
</body>
</html>