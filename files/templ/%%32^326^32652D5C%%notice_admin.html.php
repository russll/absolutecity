<?php /* Smarty version 2.6.11, created on 2014-04-28 15:33:26
         compiled from mails/notice_admin.html */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  </head>
  <body>
    <br />
    Administrator,
    <br />
    user <?php if ($this->_tpl_vars['uid']): ?>with UID=<?php echo $this->_tpl_vars['uid'];  endif; ?>
    was trying to use <?php if ($this->_tpl_vars['location']): ?> Ward's location "<?php echo $this->_tpl_vars['location']; ?>
"<?php endif; ?>,
    which doesn't exist in Database.
    <br />
    <?php if ($this->_tpl_vars['stake_val']): ?> With that user have used Stake "<?php echo $this->_tpl_vars['stake_val']; ?>
" and Ward title "<?php echo $this->_tpl_vars['title']; ?>
".<?php endif; ?>
    <br />
    <br />
    Thank you,
    <br />
    <br />
    <a href="http://inzion.com/">inZion</a> Team.
    <br />
  </body>
</html>