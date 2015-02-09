<?php /* Smarty version 2.6.11, created on 2014-10-12 10:02:00
         compiled from mods/inbox/_fr_list.html */ ?>
<?php $_from = $this->_tpl_vars['ar_fr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['fk'] => $this->_tpl_vars['fi']):
?>
<li id="id_fr_rlist_<?php echo $this->_tpl_vars['fi']['uid']; ?>
" class="cl_rlist_fr <?php if (0 == $this->_tpl_vars['fk']): ?> act <?php endif; ?>" >
  <?php if ($this->_tpl_vars['fi']['cnt_new_mes']): ?> <span><?php echo $this->_tpl_vars['fi']['cnt_new_mes']; ?>
</span> <?php endif; ?>
    <img src="<?php if ($this->_tpl_vars['fi']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['fi']['fpath']; ?>
/s/s_<?php echo $this->_tpl_vars['fi']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m42.jpg<?php endif; ?>"  style="width: 42px; height: 42px;"  />
    <?php if (isset ( $this->_tpl_vars['fi']['is_online'] )): ?><span class="awatar"></span><?php endif; ?>
    <p><a class="cl_rlist_fr_el" fr_uid="<?php echo $this->_tpl_vars['fi']['uid']; ?>
"  href="javascript: void(0);"><?php echo $this->_tpl_vars['fi']['first_name']; ?>
 <?php echo $this->_tpl_vars['fi']['last_name']; ?>
</a><?php if ($this->_tpl_vars['fi']['last_update']):  echo $this->_tpl_vars['fi']['last_update'];  endif; ?></p>
</li>
<?php endforeach; endif; unset($_from); ?>