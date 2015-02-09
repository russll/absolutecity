<?php /* Smarty version 2.6.11, created on 2014-05-22 13:14:31
         compiled from index.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>inZion.com</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo $this->_tpl_vars['stlDir']; ?>
styles.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" language="JavaScript" src="/j/jquery-1.3.2.min.js"></script>
<script type="text/javascript" language="JavaScript" src="/j/base.js"></script>

<script type="text/javascript" src="/j/jquery.autocomplete.min.js"></script>
<link href="/s/jquery.autocomplete.css" rel="stylesheet" type="text/css" />
<link href="/s/jquery-ui.css" rel="stylesheet" type="text/css" />
<script language="javascript">
var system_login = 'admin';
var UserID = ''; 
</script>
</head>
<body>

<div class="main-container">
<!-- Header -->
<div id="header">
	<div class="logo"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
logo.png"  /></a></div>
	<div class="right">
		<div class="slogan">Content Management System</div>
		<div class="info-line">
		    <img src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico01.gif" alt="" /><a class="user-link1" href="<?php $this->assign('ov', "security/users");  if (! $this->_tpl_vars['UserInfo']['status'] || $this->_tpl_vars['UserInfo']['modules'][$this->_tpl_vars['ov']]):  echo $this->_tpl_vars['siteAdr']; ?>
security/users/show/?login=<?php echo $this->_tpl_vars['UserInfo']['login'];  else: ?>/users/<?php echo $this->_tpl_vars['UserInfo']['login'];  endif; ?>"><?php echo $this->_tpl_vars['UserInfo']['login']; ?>
</a>|<a class="user-link2" href="<?php echo $this->_tpl_vars['siteAdr']; ?>
admin.php?logout=1">Logout</a>
	        &nbsp;&nbsp;&nbsp; <?php $_from = $this->_tpl_vars['ml']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
 if ($this->_tpl_vars['i']['sortid'] >= 1 && $this->_tpl_vars['i']['sortid'] <= 10):  $this->assign('ov', $this->_tpl_vars['i']['fname']); ?> <a class="user-link1" href="<?php echo $this->_tpl_vars['siteAdr'];  echo $this->_tpl_vars['i']['fname']; ?>
"><?php echo $this->_tpl_vars['i']['name']; ?>
</a>&nbsp;<?php endif;  endforeach; endif; unset($_from); ?>
		</div>		
	</div>
</div>
<!-- /Header -->
</div>


<?php echo $this->_tpl_vars['_content']; ?>


<!-- Footer -->
<div id="footer">
	<div class="left"> <span></span></div>
	<div class="right">&copy; 2010 inZion.com<br /></div>
</div>
<!-- /Footer -->
<!--<?php echo $gCnt; ?>-->
</body>
</html>
