<?php /* Smarty version 2.6.11, created on 2014-03-15 08:51:13
         compiled from mods/adtmpl/_tmpl_time.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'mods/adtmpl/_tmpl_time.html', 14, false),)), $this); ?>
<?php if (0 == $this->_tpl_vars['mins']): ?>
	<?php if (2 == $this->_tpl_vars['type']): ?>
		<span style="color:green">Now</span>
	<?php else: ?>
		less than 1 min ago
	<?php endif; ?>
<?php elseif (60 > $this->_tpl_vars['mins']): ?>
	<?php echo $this->_tpl_vars['mins']; ?>
 min<?php if (1 < $this->_tpl_vars['mins']): ?>s<?php endif; ?> ago
<?php elseif (24 > $this->_tpl_vars['hours']): ?>
	<?php echo $this->_tpl_vars['hours']; ?>
 hour<?php if (1 < $this->_tpl_vars['hours']): ?>s<?php endif; ?> ago
<?php elseif (10 > $this->_tpl_vars['days']): ?>
	<?php echo $this->_tpl_vars['days']; ?>
 day<?php if (1 < $this->_tpl_vars['days']): ?>s<?php endif; ?> ago
<?php elseif ($this->_tpl_vars['dt'] >= TODAY_TIME - 86400 && $this->_tpl_vars['dt'] < TODAY_TIME): ?>
	yesterday at <?php echo ((is_array($_tmp=$this->_tpl_vars['dt'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M") : smarty_modifier_date_format($_tmp, "%H:%M")); ?>

<?php elseif ($this->_tpl_vars['dt'] >= TODAY_TIME): ?>
	<?php echo $this->_tpl_vars['dt']; ?>
 today at <?php echo ((is_array($_tmp=$this->_tpl_vars['dt'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M") : smarty_modifier_date_format($_tmp, "%H:%M"));  else:  echo ((is_array($_tmp=$this->_tpl_vars['dt'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%b %e, %Y %H:%M") : smarty_modifier_date_format($_tmp, "%b %e, %Y %H:%M")); ?>

<?php endif; ?>