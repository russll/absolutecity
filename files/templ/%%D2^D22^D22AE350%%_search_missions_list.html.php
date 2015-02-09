<?php /* Smarty version 2.6.11, created on 2014-04-09 23:02:56
         compiled from mods/system/_search_missions_list.html */ ?>
 <?php if ($this->_tpl_vars['srch_res']['missions']): ?>
        <?php $this->assign('missions', $this->_tpl_vars['srch_res']['missions']); ?>
		<?php $this->assign('cnt_missions', $this->_tpl_vars['cnt_all']['missions']); ?>
        <h2><span></span>Missions</h2>
		<div btype="Missions" class="cl_srch_list">
			<?php $_from = $this->_tpl_vars['missions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['mk'] => $this->_tpl_vars['mis']):
?>
				<div class="box002">
					<div class="post-box">
						<div class="post-box-bg00" style="min-height: 40px">
							<div class="b-awatar"><a href="#"><img src="<?php if ($this->_tpl_vars['mis']['img']):  echo $this->_tpl_vars['fImgDir']; ?>
mission/<?php echo $this->_tpl_vars['mis']['img'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_ward_m66.png<?php endif; ?>"  /></a></div>
							<div class="post-title2">
								<?php if (! $this->_tpl_vars['mis']['served']): ?><a href="javascript: void(0);" onclick="$('#mis_name').html($('#mtl_<?php echo $this->_tpl_vars['mis']['id']; ?>
').text());oMWall.SHConfirmPopup( 1, 'id_confirm_mission_popup', <?php echo $this->_tpl_vars['mis']['id']; ?>
 );" style="float:right;">Served this mission?</a><?php endif; ?>
								<b><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/mission/id<?php echo $this->_tpl_vars['mis']['id']; ?>
" id="mtl_<?php echo $this->_tpl_vars['mis']['id']; ?>
"><?php if ($this->_tpl_vars['mis']['location']):  echo $this->_tpl_vars['mis']['location'];  else:  echo $this->_tpl_vars['mis']['title'];  endif; ?></a></b> <br/>
							</div>
							<p>&nbsp</p>
						</div>
					</div>
				</div>
			<?php endforeach; endif; unset($_from); ?>
		</div>

		<?php if (( $this->_tpl_vars['pcnt']['missions']+$this->_tpl_vars['data_rcnt'] ) < $this->_tpl_vars['cnt_missions']): ?>
			<div id="id_div_show_more_mes_missions" class="more-box" align="center" style="margin-left: 0px; padding-left: 0px;">
				<a href="javascript: void(0);" class="cl_search_pagging<?php if ($this->_tpl_vars['nwall']): ?>2<?php endif; ?>" pname="missions" pcnt=" <?php echo $this->_tpl_vars['pcnt']['missions']+$this->_tpl_vars['data_rcnt']; ?>
" rcnt="<?php echo $this->_tpl_vars['data_rcnt']; ?>
" >More <img src="/i/arr01.gif"  /></a>
			</div>
		<?php endif; ?>
 <?php else: ?>
<h2><span></span>Missions</h2>

    <div class="box001">
        <div class="post-box">Missions not found...<br />
        <br />Can not find your Mission? <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['UserInfo']['uid']; ?>
/settings?ed_mission"><b>Add here..</b></a>
        </div>

    </div>
 <?php endif; ?>        