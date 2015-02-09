<?php /* Smarty version 2.6.11, created on 2014-12-05 10:02:58
         compiled from mods/journal/_wall_answ_one.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_tmpl_time', 'mods/journal/_wall_answ_one.html', 4, false),)), $this); ?>
<li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ai']['uid']; ?>
"><img src="<?php if ($this->_tpl_vars['ai']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['ai']['fpath']; ?>
/s/s_<?php echo $this->_tpl_vars['ai']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m56.jpg<?php endif; ?>"  style="width: 56px; height: 56px;" /></a>
	<div>
	<p><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ai']['uid']; ?>
"><?php if ($this->_tpl_vars['ai']['first_name'] || $this->_tpl_vars['ai']['last_name']):  echo $this->_tpl_vars['ai']['first_name']; ?>
 <?php echo $this->_tpl_vars['ai']['last_name'];  else:  echo $this->_tpl_vars['ai']['public_name'];  endif; ?></a> <?php if ($this->_tpl_vars['ai']['story']):  echo $this->_tpl_vars['ai']['story'];  endif; ?></p>
	<p><span><?php echo smarty_function_html_tmpl_time(array('val' => $this->_tpl_vars['ai']['pdate'],'type' => 1), $this);?>
</span></p>
	</div>
</li>