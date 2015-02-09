<?php /* Smarty version 2.6.11, created on 2014-03-15 08:43:39
         compiled from index.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>inZion.com</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/s/styles.css" rel="stylesheet" type="text/css" />
<link href="/s/styles_our.css" rel="stylesheet" type="text/css" />
<link href="/s/check.css" rel="stylesheet" type="text/css" />
<?php if ($this->_tpl_vars['NO_ROBOTS']): ?>
<meta name="robots" content="noindex,nofollow" />
<?php endif; ?>    
<link href="http://<?php echo $this->_tpl_vars['DOMEN']; ?>
/i/favicon.ico" type="image/x-icon" rel="icon" />
<link href="http://<?php echo $this->_tpl_vars['DOMEN']; ?>
/i/favicon.ico" type="image/x-icon" rel="shortcut icon" />

<script type="text/javascript">
var UserID  = '<?php echo $this->_tpl_vars['UserInfo']['uid']; ?>
';
</script>
<script type="text/javascript" src="/min/?g=jshome"></script>
<?php echo '
<!--[if IE 6]>
<script src="/j/png.min.js"></script>
<script>
	DD_belatedPNG.fix(\'div, a, img, *\');
</script>
<style type="text/css">
BODY { behavior:url("/j/csshover.htc");}
</style>
<![endif]-->
'; ?>

</head>
<body class="bg001">
<?php echo '<div class="main-container"><div class="main-box"><!-- Header --><div class="header3"><div class="logo"><a href="';  echo $this->_tpl_vars['siteAdr'];  echo '"><img src="/i/logo.png" alt="inZion" /></a></div></div><!-- Header --><!-- top map --><div class="top-map"><div class="tip01">If swine flu were to spread out of control, could we assume that aspects of the prophecies are being fulfilled?</div><div class="tip02">Do you post on-line using fake email address, or your real one? </div><div class="tip03">Some really strange habits here:)</div></div><!-- top map --><div class="content"><table class="carcass"><tr><td class="c-left"></td><td class="c-center">';  echo $this->_tpl_vars['_content'];  echo '</td><td class="c-right"><h2>Already a member?</h2><div class="login-form"><label>Email:</label><p><input class="txt" name="system_login" id="system_login" type="text" value="" ';  echo 'onkeypress="if((event.keyCode==10)||(event.keyCode==13)) $(\'#login_btn\').click();"';  echo ' /></p><label>Password:</label><p><input class="txt" name="system_pass" id="system_pass" type="password" value="" ';  echo 'onkeypress="if((event.keyCode==10)||(event.keyCode==13)) $(\'#login_btn\').click();"';  echo ' /></p><label><b class="jNice"><input  type="checkbox" name="remember" id="remember" value="1" /></b> Remember me</label><div class="but-box"><span><a href="javascript:void(0);" id="login_btn">Login</a></span> <em><a href="';  echo $this->_tpl_vars['siteAdr'];  echo 'security/users/forgot">Forgot your password?</a></em></div><div class="clear" style="height:3px;"></div><div id="login_errs" class="error_box" style="padding:5px;display: none;"></div><div class="clear" style="height:3px;"></div>';  echo '
                <fb:login-button autologoutlink="true" perms="email,user_birthday"></fb:login-button>
                                       
                <div id="fb-root"></div>
                <script>
                    window.fbAsyncInit = function()
                    {
                        FB.init({appId: \'185630468134512\', status: true, cookie: true, xfbml: true});
                        FB.Event.subscribe(\'auth.login\', function(response)
                        {
                            login();
                        });
                    };
                    (function()
                    {
                        var e   = document.createElement(\'script\');
                        e.type  = \'text/javascript\';
                        e.src   = \'http://connect.facebook.net/en_US/all.js\';
                        e.async = true;
                        document.getElementById(\'fb-root\').appendChild(e);
                    }());
                    function login()
                    {
                        FB.api(\'/me\', function(response)
                        {
                            var birthday = (undefined != response.birthday) ? response.birthday : \'\';
                            var email    = (undefined != response.email) ? response.email : \'\';
                            oUsers.FbAuth(response.id,
                                          response.first_name,
                                          response.last_name,
                                          response.gender,
                                          birthday,
                                          email
                                         );
                        });
                    }
                </script>
                ';  echo '</div></td></tr></table></div></div><!-- Footer --><div id="footer">';  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  echo '</div><!-- Footer --></div>'; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ga.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</body>
</html>