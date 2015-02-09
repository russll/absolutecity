<?php /* Smarty version 2.6.11, created on 2014-10-07 02:40:14
         compiled from mods/valbums/_album_one.html */ ?>
					<div class="post-box" style="min-height: 45px">
						<div class="b-awatar"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['alb_i']['uid']; ?>
/valbums/id<?php echo $this->_tpl_vars['alb_i']['vaid']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
no_photo_m66.jpg"  /></a></div>
						
						<div class="post-title2"><b><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['alb_i']['uid']; ?>
/valbums/id<?php echo $this->_tpl_vars['alb_i']['vaid']; ?>
"><?php echo $this->_tpl_vars['alb_i']['name']; ?>
</a></b></div>
						<p><b>Created:</b> <?php if ($this->_tpl_vars['alb_i']['created']): ?> <?php echo $this->_tpl_vars['alb_i']['created']; ?>
 <?php else: ?> &nbsp <?php endif; ?></p>
						<p><b>Description:</b><?php if ($this->_tpl_vars['alb_i']['descr']): ?> <?php echo $this->_tpl_vars['alb_i']['descr']; ?>
 <?php else: ?> &nbsp <?php endif; ?></p>
						
					</div>