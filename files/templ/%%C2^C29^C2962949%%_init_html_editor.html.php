<?php /* Smarty version 2.6.11, created on 2014-03-15 09:09:42
         compiled from mods/system/_init_html_editor.html */ ?>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['jsDir']; ?>
adLibs/HtmlEditor/jHtmlArea-0.7.0.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['jsDir']; ?>
adLibs/HtmlEditor/jHtmlArea.ColorPickerMenu-0.7.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['stlDir']; ?>
adLibs/HtmlEditor/jHtmlArea.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['stlDir']; ?>
adLibs/HtmlEditor/jquery-ui-1.7.2.custom.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['stlDir']; ?>
adLibs/HtmlEditor/he_header.css" />
<link rel="Stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['stlDir']; ?>
adLibs/HtmlEditor/he_cp.css" />

<script type="text/javascript">
    var m_page = '<?php echo $this->_tpl_vars['m_page']; ?>
';
<?php echo '
var he = new Object();
	he.delay   = ';  if ($this->_tpl_vars['he_delay']):  echo $this->_tpl_vars['he_delay'];  else: ?>0<?php endif;  echo ';
	he.type    = ';  echo $this->_tpl_vars['he_type'];  echo ';
	he.ad_coef = ';  if ($this->_tpl_vars['he_ad_coef']):  echo $this->_tpl_vars['he_ad_coef'];  else: ?>''<?php endif;  echo ';

$(document).ready(function() {
	if (setTimeout( \'oSystem.SetHE( \\\'\' + he + \'\\\', \\\'\' + m_page + \'\\\' )\', he.delay ))
        {
'; ?>

            <?php if ('inbox' == $this->_tpl_vars['m_page']): ?>
            setTimeout( 'oIWall._initInterface()', 300 );
            <?php else: ?>
            setTimeout( 'oJournal._initInterface()', 300 );
            <?php endif;  echo '
        }
		
});
'; ?>

</script>