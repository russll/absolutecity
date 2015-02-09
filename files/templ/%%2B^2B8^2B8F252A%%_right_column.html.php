<?php /* Smarty version 2.6.11, created on 2014-03-15 08:51:14
         compiled from _right_column.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', '_right_column.html', 15, false),array('modifier', 'truncate', '_right_column.html', 201, false),array('modifier', 'date_format', '_right_column.html', 267, false),array('modifier', 'nl2br', '_right_column.html', 441, false),array('modifier', 'dlong', '_right_column.html', 441, false),array('function', 'html_str_format', '_right_column.html', 20, false),array('function', 'html_tmpl_time', '_right_column.html', 200, false),)), $this); ?>
<?php if ('friends_list' == $this->_tpl_vars['m_page']):  if ($this->_tpl_vars['wh'] != 'invites' && ! $this->_tpl_vars['mutual']): ?>
<h2>Sorting</h2>
<ul id="id_browse_list" class="list02">
	<li><span></span><div id="bl_link_1"><a class="cl_srch_browse_links" onclick="SetLeftBold(this); oFriends.GetListAjax( 1, '<?php echo $this->_tpl_vars['ui']['uid']; ?>
', 'all', '', 'id_main_content', '' );">A-Z</a></div></li>
        <li><span></span> <div id="bl_link_2"><a class="cl_srch_browse_links" onclick="SetLeftBold(this); oFriends.GetListAjax( 1, '<?php echo $this->_tpl_vars['ui']['uid']; ?>
', 'all', '', 'id_main_content', 'last_add' );">Recently added</a> </div></li>
	<li><span></span> <div id="bl_link_3"><a class="cl_srch_browse_links" onclick="SetLeftBold(this); oFriends.GetListAjax( 1, '<?php echo $this->_tpl_vars['ui']['uid']; ?>
', 'blocked', '', 'id_main_content', '' );">Blocked</a> </div></li>
	<li><span></span> <div id="bl_link_4"><a class="cl_srch_browse_links" onclick="SetLeftBold(this); oFriends.GetListAjax( 1, '<?php echo $this->_tpl_vars['ui']['uid']; ?>
', 'all', '', 'id_main_content', 'online' );">Online</a> </div></li>
</ul>
<?php endif;  if (! $this->_tpl_vars['wh'] && $this->_tpl_vars['ar_invites'] && $this->_tpl_vars['IS_USER']): ?>
<h2>Invitations &nbsp;<font color="grey"><?php echo $this->_tpl_vars['cnt_invites']; ?>
</font><span><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['UserInfo']['uid']; ?>
/friends?wh=invites">View all</a></span></h2>
    <div style="height:4px;"></div>
    <?php $_from = $this->_tpl_vars['ar_invites']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
    <?php $this->assign('cifull_name', ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['i']['first_name'])) ? $this->_run_mod_handler('cat', true, $_tmp, ' ') : smarty_modifier_cat($_tmp, ' ')))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['i']['last_name']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['i']['last_name']))); ?>
        <ul id="id_browse_list" class="list02">
            <li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
"><img src="<?php if ($this->_tpl_vars['i']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['i']['fpath']; ?>
/s/s_<?php echo $this->_tpl_vars['i']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m66.jpg<?php endif; ?>" style="width:30px;float:left;" alt="" /></a>
                <div style="float:left;padding-left:10px;" id ="i_frid<?php echo $this->_tpl_vars['i']['uid']; ?>
"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
"><?php if ($this->_tpl_vars['i']['first_name'] && $this->_tpl_vars['i']['last_name']):  echo $this->_tpl_vars['i']['first_name']; ?>
 <?php echo $this->_tpl_vars['i']['last_name'];  else:  echo $this->_tpl_vars['i']['public_name'];  endif; ?></a>
                    <br />
                    <a href="javascript: void(0);" onclick="oSystem.SConfPopup( 'oFriends.InviteActAjax( <?php echo $this->_tpl_vars['i']['uid']; ?>
, 1 );', 'Please confirm you want to add <?php echo smarty_function_html_str_format(array('str' => $this->_tpl_vars['cifull_name']), $this);?>
 as a friend?', 'Accept' );">Accept</a> or <a href="javascript: void(0);" onclick="oSystem.SConfPopup( 'oFriends.InviteActAjax( <?php echo $this->_tpl_vars['i']['uid']; ?>
, 2 );', 'Please confirm you want to reject invitation from <?php echo smarty_function_html_str_format(array('str' => $this->_tpl_vars['cifull_name']), $this);?>
?' );">Decline</a>
                </div>
                <div style="clear:both;"></div>
                <span></span>
            </li>
        </ul>
    <?php endforeach; endif; unset($_from);  elseif (( ( $this->_tpl_vars['wh'] == 'invites' && $this->_tpl_vars['IS_USER'] ) || $this->_tpl_vars['mutual'] ) && $this->_tpl_vars['ar_friends']): ?>
<h2>Friends &nbsp;<font color="grey"><?php echo $this->_tpl_vars['cnt_friends']; ?>
</font><span><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['UserInfo']['uid']; ?>
/friends">View all</a></span></h2>
    <div style="height:4px;"></div>
    <?php $_from = $this->_tpl_vars['ar_friends']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
        <ul id="id_browse_list" class="list02">
            <li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
"><img src="<?php if ($this->_tpl_vars['i']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['i']['fpath']; ?>
/s/s_<?php echo $this->_tpl_vars['i']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m66.jpg<?php endif; ?>" style="width:30px;float:left;" alt="" /></a>
                <div style="float:left;padding-left:10px;"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
"><?php if ($this->_tpl_vars['i']['first_name'] && $this->_tpl_vars['i']['last_name']):  echo $this->_tpl_vars['i']['first_name']; ?>
 <?php echo $this->_tpl_vars['i']['last_name'];  else:  echo $this->_tpl_vars['i']['public_name'];  endif; ?></a>
                </div>
                <div style="clear:both;"></div>
                <span></span>
            </li>
        </ul>
    <?php endforeach; endif; unset($_from);  endif; ?>

<?php elseif ('search' == $this->_tpl_vars['m_page'] && ! $this->_tpl_vars['web_search']): ?>

<!--  SearchBrowse RightColumn  -->
<h2>Browse</h2>
<ul id="id_browse_list" class="list02">
	<li btype="All results" bcnt=""><p><span></span>All results</p></li>
	<li btype="People" bcnt=""><span></span> <a btype="People" bcnt="" class="cl_srch_browse_links" style="cursor: pointer;">People</a></li>
	<li btype="Singles" bcnt=""><span></span> <a btype="Singles" bcnt="" class="cl_srch_browse_links" style="cursor: pointer;">Singles</a></li>
			<li btype="Journals" bcnt=""><span></span> <a btype="Journals" bcnt="" class="cl_srch_browse_links" style="cursor: pointer;">Journals</a></li>
	<li btype="Missions" bcnt=""><span></span> <a btype="Missions" bcnt="" class="cl_srch_browse_links" style="cursor: pointer;">Missions</a></li>
	<li btype="Stake/Wards" bcnt=""><span></span> <a btype="Stake/Wards" bcnt="" class="cl_srch_browse_links" style="cursor: pointer;">Stake/Wards</a></li>
			<li btype="Messages" bcnt=""><span></span> <a btype="Messages" bcnt="" class="cl_srch_browse_links" style="cursor: pointer;">Messages</a></li>
    </ul>

<!--  SearchBrowse RightColumn  -->
<?php elseif ($this->_tpl_vars['web_search']): ?>
<h2>Browse</h2>
<ul id="id_browse_list" class="list02">
	<li btype="All results" bcnt=""><span></span><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
base/search?glsrch=&glsrchsubfilt=undefined">All results</a></li>
	<li btype="People" bcnt=""><span></span> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
base/search?glsrch=&glsrchsubfilt=People" bcnt="" style="cursor: pointer;">People</a></li>
	<li btype="Singles" bcnt=""><span></span> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
base/search?glsrch=&glsrchsubfilt=Singles" bcnt="" style="cursor: pointer;">Singles</a></li>
			<li btype="Journals" bcnt=""><span></span> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
base/search?glsrch=&glsrchsubfilt=Journals" bcnt="" style="cursor: pointer;">Journals</a></li>
	<li btype="Missions" bcnt=""><span></span> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
base/search?glsrch=&glsrchsubfilt=Missions" bcnt="" style="cursor: pointer;">Missions</a></li>
	<li btype="Stake/Wards" bcnt=""><span></span> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
base/search?glsrch=&glsrchsubfilt=Stake/Wards" bcnt="" style="cursor: pointer;">Stake/Wards</a></li>
			<li btype="Messages" bcnt=""><span></span> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
base/search?glsrch=&glsrchsubfilt=Messages" bcnt="" style="cursor: pointer;">Messages</a></li>
    </ul>

<?php elseif ('wards_wall' == $this->_tpl_vars['m_page']): ?>

<!--  Ward's Messages RightColumn  -->
<h2></span>Feeds</h2>
<ul class="list02">
	<li><a href="javascript: void(0);" onclick="oWWall.GetList( '<?php echo $this->_tpl_vars['ward_i']['id']; ?>
', '0', '1', '' )">All entries</a></li>
	<li><span><a href="#"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
photo_ico.gif"  /></a></span> <a href="javascript: void(0);" onclick="oWWall.GetList( '<?php echo $this->_tpl_vars['ward_i']['id']; ?>
', '0', 1, 4 )">Photos</a></li>
	<li><span><a href="#"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
video_ico.gif"  /></a></span> <a href="javascript: void(0);" onclick="oWWall.GetList( '<?php echo $this->_tpl_vars['ward_i']['id']; ?>
', '0', 1, 5 )">Videos</a></li>
	<li><span><a href="#"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
event_ico.gif"  /></a></span> <a href="javascript: void(0);" onclick="oWWall.GetList( '<?php echo $this->_tpl_vars['ward_i']['id']; ?>
', '0', 1, 2 )">Events</a></li>
	<li><span><a href="#"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
link_ico.gif"  /></a></span> <a href="javascript: void(0);" onclick="oWWall.GetList( '<?php echo $this->_tpl_vars['ward_i']['id']; ?>
', '0', 1, 3 )">Links</a></li>
</ul>

<?php if ($this->_tpl_vars['ar_wusers']): ?>
<h2><?php if ($this->_tpl_vars['cnt_ar_wusers'] > 9 || 1 == 1): ?><span><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
base/search?glsrch=&glsrchsubfilt=People&pwn=<?php echo $this->_tpl_vars['ward_i']['title']; ?>
">View all</a></span><?php endif; ?> Ward members <b><?php echo $this->_tpl_vars['cnt_ar_wusers']; ?>
</b></h2>
<ul class="list03">
	<?php $_from = $this->_tpl_vars['ar_wusers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
	<?php $this->assign('fname', ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['i']['first_name'])) ? $this->_run_mod_handler('cat', true, $_tmp, ' ') : smarty_modifier_cat($_tmp, ' ')))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['i']['last_name']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['i']['last_name']))); ?>
	<li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
"><img src="<?php if ($this->_tpl_vars['i']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['i']['fpath']; ?>
/s/s_<?php echo $this->_tpl_vars['i']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m42.jpg<?php endif; ?>"  style="width: 49px; height: 49px;" /></a> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
"><?php echo $this->_tpl_vars['fname']; ?>
</a></li>
	<?php endforeach; endif; unset($_from); ?>
</ul>
<?php endif; ?>

<!--  Ward's Messages RightColumn  -->

<?php elseif ('wards_list' == $this->_tpl_vars['m_page']): ?>

<!--  Ward's List RightColumn  -->
<h2>Feeds</h2>
<span style="font-size: 12px; color: gray">Select ward/branch first</span>
<!--  Ward's List RightColumn  -->

<?php elseif ('mission_wall' == $this->_tpl_vars['m_page']): ?>

<!--  Ward's Messages RightColumn  -->
<h2></span>Feeds</h2>
<ul class="list02">
	<li><span><a href="#"></a></span> <a ltype="0" class="cl_sr_mis_filt" style="cursor: pointer;">All entries</a></li>
	<li><span><a href="#"></a></span> <a ltype="-1" class="cl_sr_mis_filt" style="cursor: pointer;">Messages</a></li>
	<li><span><a href="#"></a></span> <a ltype="1" class="cl_sr_mis_filt" style="cursor: pointer;">Best places</a></li>
	<li><span><a href="#"></a></span> <a ltype="2" class="cl_sr_mis_filt" style="cursor: pointer;">Foods</a></li>
	<li><span><a href="#"></a></span> <a ltype="4" class="cl_sr_mis_filt" style="cursor: pointer;">Miss the most</a></li>
	<li><span><a href="#"></a></span> <a ltype="5" class="cl_sr_mis_filt" style="cursor: pointer;">Testimonies</a></li>
</ul>

<?php if ($this->_tpl_vars['ar_musers_nh']): ?>
<h2><?php if ($this->_tpl_vars['cnt_show_musers_nh'] > 9): ?><span><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/friends">View all</a></span><?php endif; ?> Now on a mission <b><?php echo $this->_tpl_vars['cnt_show_musers_nh']; ?>
</b></h2>
<ul class="list03">
	<?php $_from = $this->_tpl_vars['ar_musers_nh']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
	<li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
"><img src="<?php if ($this->_tpl_vars['i']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['i']['fpath']; ?>
/s/s_<?php echo $this->_tpl_vars['i']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m42.jpg<?php endif; ?>"  style="width: 49px; height: 49px;" /></a> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
"><?php echo $this->_tpl_vars['i']['first_name']; ?>
 <?php echo $this->_tpl_vars['i']['last_name']; ?>
</a></li>
	<?php endforeach; endif; unset($_from); ?>
</ul>
<?php endif; ?>

<?php if ($this->_tpl_vars['ar_musers_gh']): ?>
<h2><?php if ($this->_tpl_vars['cnt_show_musers_gh'] > 9): ?><span><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/friends">View all</a></span><?php endif; ?> Going on a mission <b><?php echo $this->_tpl_vars['cnt_show_musers_gh']; ?>
</b></h2>
<ul class="list03">
	<?php $_from = $this->_tpl_vars['ar_musers_gh']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
	<li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
"><img src="<?php if ($this->_tpl_vars['i']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['i']['fpath']; ?>
/s/s_<?php echo $this->_tpl_vars['i']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m42.jpg<?php endif; ?>"  style="width: 49px; height: 49px;" /></a> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
"><?php echo $this->_tpl_vars['i']['first_name']; ?>
 <?php echo $this->_tpl_vars['i']['last_name']; ?>
</a></li>
	<?php endforeach; endif; unset($_from); ?>
</ul>
<?php endif; ?>

<?php if ($this->_tpl_vars['ar_musers_wh']): ?>
<h2><?php if ($this->_tpl_vars['cnt_show_musers_wh'] > 9 || 0 == 0): ?><span><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
base/search?glsrch=&glsrchsubfilt=People&pml=<?php echo $this->_tpl_vars['mission_i']['title']; ?>
">View all</a></span><?php endif; ?> Served mission <b><?php echo $this->_tpl_vars['cnt_show_musers_wh']; ?>
</b></h2>
<ul class="list03">
	<?php $_from = $this->_tpl_vars['ar_musers_wh']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
	<li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
"><img src="<?php if ($this->_tpl_vars['i']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['i']['fpath']; ?>
/s/s_<?php echo $this->_tpl_vars['i']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m42.jpg<?php endif; ?>"  style="width: 49px; height: 49px;" /></a> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
"><?php echo $this->_tpl_vars['i']['first_name']; ?>
 <?php echo $this->_tpl_vars['i']['last_name']; ?>
</a></li>
	<?php endforeach; endif; unset($_from); ?>
</ul>

<?php endif; ?>


<?php if ($this->_tpl_vars['ar_msubscr']): ?>
<h2><?php if ($this->_tpl_vars['ar_msubscr'] > 9 && 0): ?><span><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/friends">View all</a></span><?php endif; ?> Followers <b><?php echo $this->_tpl_vars['cnt_show_musers_subscr']; ?>
</b></h2>
<ul class="list03">
	<?php $_from = $this->_tpl_vars['ar_msubscr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
	<li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
"><img src="<?php if ($this->_tpl_vars['i']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['i']['fpath']; ?>
/s/s_<?php echo $this->_tpl_vars['i']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m42.jpg<?php endif; ?>"  style="width: 49px; height: 49px;" /></a> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
"><?php echo $this->_tpl_vars['i']['first_name']; ?>
 <?php echo $this->_tpl_vars['i']['last_name']; ?>
</a></li>
	<?php endforeach; endif; unset($_from); ?>
</ul>
<?php endif; ?>

<!--  Ward's Messages RightColumn  -->

<?php elseif ('mission_list' == $this->_tpl_vars['m_page']): ?>

<!--  Ward's List RightColumn  -->
<h2>Feeds</h2>
<span style="font-size: 12px; color: gray">Select mission first</span>
<!--  Ward's List RightColumn  -->

<?php elseif ('albums_list' == $this->_tpl_vars['m_page']): ?>

<!--  Albums's List RightColumn  -->
<h2>Feeds</h2>
<ul class="list02">
	<li><a class="cl_albums_show_filts" stype="1" style="cursor: pointer;">All entries</a></li>
	<li><a class="cl_albums_show_filts" stype="2" style="cursor: pointer;">System</a></li>
	<li><a class="cl_albums_show_filts" stype="3" style="cursor: pointer;">User's</a></li>
</ul>
<!--  Album's Photos RightColumn  -->

<?php elseif ('albums_photos' == $this->_tpl_vars['m_page']): ?>

<?php if ($this->_tpl_vars['taglist']): ?>
    <h2>Tags</h2>
    <ul class="list02" id="rm_tag_list">
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_ajax/tag_list.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </ul>
<?php else: ?>
    <h2>Recent activity</h2>
	<ul class="activity-list">
		<?php if ($this->_tpl_vars['ar_lap_com']): ?>
		<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['ar_lap_com']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['max'] = (int)2;
$this->_sections['i']['show'] = true;
if ($this->_sections['i']['max'] < 0)
    $this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = min(ceil(($this->_sections['i']['step'] > 0 ? $this->_sections['i']['loop'] - $this->_sections['i']['start'] : $this->_sections['i']['start']+1)/abs($this->_sections['i']['step'])), $this->_sections['i']['max']);
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
		<li>
			<em><a href="/id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/albums/id<?php echo $this->_tpl_vars['ar_lap_com'][$this->_sections['i']['index']]['aid']; ?>
/id<?php echo $this->_tpl_vars['ar_lap_com'][$this->_sections['i']['index']]['id']; ?>
/"><img src="<?php if ($this->_tpl_vars['ar_lap_com'][$this->_sections['i']['index']]['img']):  if ($this->_tpl_vars['ar_lap_com'][$this->_sections['i']['index']]['fpath'] == 'link'):  echo $this->_tpl_vars['ar_lap_com'][$this->_sections['i']['index']]['img'];  else: ?> <?php echo $this->_tpl_vars['fImgDir'];  if (2 == $this->_tpl_vars['ar_lap_com'][$this->_sections['i']['index']]['atype']):  if ('Wall' == $this->_tpl_vars['ar_lap_com'][$this->_sections['i']['index']]['aname']): ?>wall/<?php elseif ('Mission' == $this->_tpl_vars['ar_lap_com'][$this->_sections['i']['index']]['aname']): ?>mission/wall/<?php elseif ('Ward' == $this->_tpl_vars['ar_lap_com'][$this->_sections['i']['index']]['aname']): ?>wards/wall/<?php endif;  else: ?>albums/<?php endif;  echo $this->_tpl_vars['ar_lap_com'][$this->_sections['i']['index']]['fpath']; ?>
/a/a_<?php echo $this->_tpl_vars['ar_lap_com'][$this->_sections['i']['index']]['img']; ?>
 <?php endif;  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m100.jpg<?php endif; ?>"  style="max-width: 99px; max-height: 66px;" /></a></em>
			<?php $this->assign('cimg', $this->_tpl_vars['ar_lap_com'][$this->_sections['i']['index']]['com']); ?>
			<?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=$this->_tpl_vars['cimg']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['j']['max'] = (int)3;
$this->_sections['j']['show'] = true;
if ($this->_sections['j']['max'] < 0)
    $this->_sections['j']['max'] = $this->_sections['j']['loop'];
$this->_sections['j']['step'] = 1;
$this->_sections['j']['start'] = $this->_sections['j']['step'] > 0 ? 0 : $this->_sections['j']['loop']-1;
if ($this->_sections['j']['show']) {
    $this->_sections['j']['total'] = min(ceil(($this->_sections['j']['step'] > 0 ? $this->_sections['j']['loop'] - $this->_sections['j']['start'] : $this->_sections['j']['start']+1)/abs($this->_sections['j']['step'])), $this->_sections['j']['max']);
    if ($this->_sections['j']['total'] == 0)
        $this->_sections['j']['show'] = false;
} else
    $this->_sections['j']['total'] = 0;
if ($this->_sections['j']['show']):

            for ($this->_sections['j']['index'] = $this->_sections['j']['start'], $this->_sections['j']['iteration'] = 1;
                 $this->_sections['j']['iteration'] <= $this->_sections['j']['total'];
                 $this->_sections['j']['index'] += $this->_sections['j']['step'], $this->_sections['j']['iteration']++):
$this->_sections['j']['rownum'] = $this->_sections['j']['iteration'];
$this->_sections['j']['index_prev'] = $this->_sections['j']['index'] - $this->_sections['j']['step'];
$this->_sections['j']['index_next'] = $this->_sections['j']['index'] + $this->_sections['j']['step'];
$this->_sections['j']['first']      = ($this->_sections['j']['iteration'] == 1);
$this->_sections['j']['last']       = ($this->_sections['j']['iteration'] == $this->_sections['j']['total']);
?>
			<div>
			<?php $this->assign('funame', ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['cimg'][$this->_sections['j']['index']]['first_name'])) ? $this->_run_mod_handler('cat', true, $_tmp, ' ') : smarty_modifier_cat($_tmp, ' ')))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['cimg'][$this->_sections['j']['index']]['last_name']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['cimg'][$this->_sections['j']['index']]['last_name']))); ?>
				<img src="<?php if ($this->_tpl_vars['cimg'][$this->_sections['j']['index']]['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['cimg'][$this->_sections['j']['index']]['user_fpath']; ?>
/s/s_<?php echo $this->_tpl_vars['cimg'][$this->_sections['j']['index']]['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m56.jpg<?php endif; ?>"  style="width: 42px; height: 42px;" />
				<p><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['cimg'][$this->_sections['j']['index']]['user_id']; ?>
"><?php if ($this->_tpl_vars['cimg'][$this->_sections['j']['index']]['first_name'] || $this->_tpl_vars['cimg'][$this->_sections['j']['index']]['last_name']):  echo $this->_tpl_vars['funame'];  else:  echo $this->_tpl_vars['cimg'][$this->_sections['j']['index']]['public_name'];  endif; ?></a> commented<br /> <?php echo smarty_function_html_tmpl_time(array('val' => $this->_tpl_vars['cimg'][$this->_sections['j']['index']]['dt'],'type' => 1), $this);?>
</p>
				<div><?php echo ((is_array($_tmp=$this->_tpl_vars['cimg'][$this->_sections['j']['index']]['text'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 40, "...", false) : smarty_modifier_truncate($_tmp, 40, "...", false)); ?>
</div>
			</div>
			<?php endfor; endif; ?>
		</li>
		<?php endfor; endif; ?>
		<?php else: ?>
		<li>
			No activities...
		</li>
		<?php endif; ?>
	</ul>
<?php endif; ?>
<!--  Album's Photo RightColumn  -->

<?php elseif ('albums_photo' == $this->_tpl_vars['m_page']): ?>
	<h2>Actions</h2>
	<ul id="id_photo_right_col" class="list04">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/albums/_photo_right_one.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</ul>

<?php elseif ('valbums_list' == $this->_tpl_vars['m_page']): ?>

<!--  Albums's List RightColumn  -->
<h2>Feeds</h2>
<ul class="list02">
	<li><a class="cl_valbums_show_filts" stype="1" style="cursor: pointer;">All entries</a></li>
	<li><a class="cl_valbums_show_filts" stype="2" style="cursor: pointer;">System</a></li>
	<li><a class="cl_valbums_show_filts" stype="3" style="cursor: pointer;">User's</a></li>
</ul>
<!--  Album's Photos RightColumn  -->
	
<?php elseif ('valbums_videos' == $this->_tpl_vars['m_page']): ?>

			<?php if ($this->_tpl_vars['other_alb']): ?>
			<h2>Other albums</h2>
			<ul class="album-list">
				<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['other_alb']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
				<li>
					<span>
						<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['UserInfo']['uid']; ?>
/valbums/id<?php echo $this->_tpl_vars['other_alb'][$this->_sections['i']['index']]['vaid']; ?>
">
							<img src="
								 <?php if ($this->_tpl_vars['other_alb'][$this->_sections['i']['index']]['video']):  if (2 == $this->_tpl_vars['other_alb'][$this->_sections['i']['index']]['type']):  if ('Wall' == $this->_tpl_vars['other_alb'][$this->_sections['i']['index']]['name']): ?>wall/<?php elseif ('Mission' == $this->_tpl_vars['other_alb'][$this->_sections['i']['index']]['name']): ?>mission/wall/<?php elseif ('Ward' == $this->_tpl_vars['other_alb'][$this->_sections['i']['index']]['name']): ?>wards/wall/<?php endif;  else:  echo $this->_tpl_vars['other_alb'][$this->_sections['i']['index']]['video_img'];  endif;  else: ?>/i/no_photo.gif<?php endif; ?>"  width="100px" height="100px" style="max-width: 100px; max-height: 100px;" />
						</a>
					</span>
					<p>
						<?php if ($this->_tpl_vars['other_alb'][$this->_sections['i']['index']]['cnt_video']): ?>
							<?php echo $this->_tpl_vars['other_alb'][$this->_sections['i']['index']]['cnt_video']; ?>

						<?php else: ?>
							No
						<?php endif; ?> videos <br />
						
						<?php if ($this->_tpl_vars['other_alb'][$this->_sections['i']['index']]['name']): ?>
							<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['UserInfo']['uid']; ?>
/valbums/id<?php echo $this->_tpl_vars['other_alb'][$this->_sections['i']['index']]['aid']; ?>
"><?php echo $this->_tpl_vars['other_alb'][$this->_sections['i']['index']]['name']; ?>
</a>
						<?php endif; ?>
					</p>
				</li>
				<?php endfor; endif; ?>
			</ul>
			<?php endif; ?>
	
<?php elseif ('valbums_video' == $this->_tpl_vars['m_page']): ?>		
	<h2>Actions</h2>
	<ul id="id_photo_right_col" class="list04">
		<li>
			<p><b>Info</b></p>
			<ul>
				<li>Video uploaded on <?php echo ((is_array($_tmp=$this->_tpl_vars['vi']['dt'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%b %d, %Y") : smarty_modifier_date_format($_tmp, "%b %d, %Y")); ?>
</li>
							</ul>
		
			<?php if ($this->_tpl_vars['IS_USER']): ?>
				<?php if ($this->_tpl_vars['al']): ?><p><b><a href="javascript: void(0);" onclick="oValbums.SHChngPopup( 1, 'id_chng_valbum_popup' );"><?php if ($this->_tpl_vars['ai']['type'] == 1): ?>Move<?php else: ?>Copy<?php endif; ?> to another album</a></b></p><?php endif; ?>
				<p><b><a href="javascript: void(0);" onclick="oValbums.SHConfirmPopup( 1, 'id_confirm_valbums_popup' );">Delete</a></b></p>
			<?php endif; ?>
		</li>
		
	</ul>
	
<?php elseif ('tags_list' == $this->_tpl_vars['m_page']): ?>

<!--  Albums's List RightColumn  -->
<h2>Feeds</h2>
<ul class="list02">
	<li><a class="cl_tag_show_filts" stype="1" style="cursor: pointer;">All entries</a></li>
</ul>
<!--  Album's Photos RightColumn  -->

<?php elseif ('tags_mes' == $this->_tpl_vars['m_page']): ?>

<!--  Albums's List RightColumn  -->
<h2>Feeds</h2>
<ul class="list02">
	<li><a class="cl_tag_show_filts" stype="1" style="cursor: pointer;font-weight:bold;">All entries</a></li>
	<li><a class="cl_tag_show_filts" stype="2" style="cursor: pointer;">Profile</a></li>
	<li><a class="cl_tag_show_filts" stype="3" style="cursor: pointer;">Mission</a></li>
	<li><a class="cl_tag_show_filts" stype="4" style="cursor: pointer;">Ward/Stake</a></li>
	<li><a class="cl_tag_show_filts" stype="5" style="cursor: pointer;">Journal</a></li>    
</ul>
<!--  Album's Photos RightColumn  -->

<?php elseif ('subscr_list' == $this->_tpl_vars['m_page']): ?>

<!--  Albums's List RightColumn  -->
<h2>Feeds</h2>
<ul class="list02">
	<li><a class="cl_subscr_show_filts" stype="1" style="cursor: pointer;">All</a></li>
	<li><a class="cl_subscr_show_filts" stype="2" style="cursor: pointer;">Followers</a></li>
	<li><a class="cl_subscr_show_filts" stype="3" style="cursor: pointer;">People I follow</a></li>
</ul>
<!--  Album's Photos RightColumn  -->


<!--h2>All friends <?php if ($this->_tpl_vars['cnt_ar_fr']): ?><b><?php echo $this->_tpl_vars['cnt_ar_fr']; ?>
</b><?php endif; ?></h2>

<div class="sort">
    <p><a class="cl_fr_list_recent" style="cursor: pointer;" sb="0">Recent</a> &nbsp;&nbsp;&nbsp;&nbsp; <a class="cl_fr_list_recent" style="cursor: pointer; color: #000;" sb="1">A-Z</a> &nbsp;&nbsp;&nbsp;&nbsp; <a class="cl_fr_list_recent" style="cursor: pointer;" sb="2">Blocked</a> &nbsp;&nbsp;&nbsp;&nbsp; <a class="cl_fr_list_recent" style="cursor: pointer;" sb="3">Online</a></p>
    <input id="id_inb_fr_rlist_find" type="text" value="Find user..." sb="1" onclick="if (this.value=='Find user...') this.value='';" />
</div>

<div class="friend-box">
    <ul id="id_inb_fr_rlist">
	<?php $_from = $this->_tpl_vars['ar_fr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['fk'] => $this->_tpl_vars['fi']):
?>
        <li id="id_fr_rlist_<?php echo $this->_tpl_vars['fi']['uid']; ?>
" class="cl_rlist_fr <?php if ($this->_tpl_vars['lfr_id'] == $this->_tpl_vars['fi']['uid']): ?> act <?php endif; ?>" >
	    <?php if ($this->_tpl_vars['fi']['cnt_new_mes']): ?> <span><?php echo $this->_tpl_vars['fi']['cnt_new_mes']; ?>
</span> <?php endif; ?>
            <img src="<?php if ($this->_tpl_vars['fi']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['fi']['fpath']; ?>
/s/s_<?php echo $this->_tpl_vars['fi']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m42.jpg<?php endif; ?>"  style="width: 42px; height: 42px;"  />
            <p><a class="cl_rlist_fr_el" fr_uid="<?php echo $this->_tpl_vars['fi']['uid']; ?>
"  href="javascript: void(0);"><?php echo $this->_tpl_vars['fi']['first_name']; ?>
 <?php echo $this->_tpl_vars['fi']['last_name']; ?>
</a><?php if ($this->_tpl_vars['fi']['last_update']):  echo $this->_tpl_vars['fi']['last_update'];  endif; ?></p>
        </li>
	<?php endforeach; endif; unset($_from); ?>
    </ul>
</div-->

<?php elseif ('notify_list' == $this->_tpl_vars['m_page']): ?>

<h2>Feeds</h2>
<ul class="list02">
	<li><a class="cl_notify_show_filts" wtype="" ntype="" style="cursor: pointer;">All notifications</a></li>
	<li><a class="cl_notify_show_filts" wtype="1" ntype="50" style="cursor: pointer;">Friend requests</a></li>
		<li><a class="cl_notify_show_filts" wtype="1" ntype="1" style="cursor: pointer;">Comments</a></li>
</ul>

<?php else: ?>
<!--  Wall RightColumn  -->
<?php if (! $this->_tpl_vars['im_blocked'] && ! $this->_tpl_vars['ui']['is_deleted']): ?>
            <h2><?php if ($this->_tpl_vars['IS_USER']): ?><span><a href="javascript: void(0);" onclick="oWall.SHFilterPopup( 1, 'id_add_filter_popup' );">Add new</a></span><?php endif; ?> Feeds</h2>
            <ul class="list02">
                    <li><a href="javascript: void(0);" onclick="oWall.GetList( '<?php echo $this->_tpl_vars['ui']['uid']; ?>
', '0', '1', '' );">All entries</a></li>
                    <li><span><a href="javascript: void(0);" onclick="oWall.GetList( '<?php echo $this->_tpl_vars['ui']['uid']; ?>
', '0', '1', '4' );"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
photo_ico.gif" alt=""  /></a></span> <a href="javascript: void(0);" onclick="oWall.GetList( '<?php echo $this->_tpl_vars['ui']['uid']; ?>
', '0', 1, 4 )">Photos</a></li>
                    <li><span><a href="javascript: void(0);" onclick="oWall.GetList( '<?php echo $this->_tpl_vars['ui']['uid']; ?>
', '0', '1', '5' );"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
video_ico.gif" alt=""  /></a></span> <a href="javascript: void(0);" onclick="oWall.GetList( '<?php echo $this->_tpl_vars['ui']['uid']; ?>
', '0', 1, 5 )">Videos</a></li>
                    <li><span><a href="javascript: void(0);" onclick="oWall.GetList( '<?php echo $this->_tpl_vars['ui']['uid']; ?>
', '0', '1', '2' );"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
event_ico.gif" alt=""  /></a></span> <a href="javascript: void(0);" onclick="oWall.GetList( '<?php echo $this->_tpl_vars['ui']['uid']; ?>
', '0', 1, 2 )">Events</a></li>
                    <li><span><a href="javascript: void(0);" onclick="oWall.GetList( '<?php echo $this->_tpl_vars['ui']['uid']; ?>
', '0', '1', '3' );"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
link_ico.gif" alt=""  /></a></span> <a href="javascript: void(0);" onclick="oWall.GetList( '<?php echo $this->_tpl_vars['ui']['uid']; ?>
', '0', 1, 3 )">Links</a></li>
                    <li><span><a href="javascript: void(0);" onclick="oWall.GetList( '<?php echo $this->_tpl_vars['ui']['uid']; ?>
', '0', '1', '6' );"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
badge_ico.gif" alt=""  /></a></span> <a href="javascript: void(0);" onclick="oWall.GetList( '<?php echo $this->_tpl_vars['ui']['uid']; ?>
', '0', 1, 6 )">Badges</a></li>
                    <li><span><a href="javascript: void(0);" onclick="oWall.GetList( '<?php echo $this->_tpl_vars['ui']['uid']; ?>
', '0', '2', '1' );"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
friend_add_ico.gif" alt=""  /></a></span> <a href="javascript: void(0);" onclick="oWall.GetList( '<?php echo $this->_tpl_vars['ui']['uid']; ?>
', '0', 2, 1 )">Friends and followers</a></li>
                    <li><span><a href="javascript: void(0);" onclick="oWall.GetList( '<?php echo $this->_tpl_vars['ui']['uid']; ?>
', '0', '2', '2' );"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
frendly_ico.gif" alt=""  /></a></span> <a href="javascript: void(0);" onclick="oWall.GetList( '<?php echo $this->_tpl_vars['ui']['uid']; ?>
', '0', 2, 2 )">Friends only</a></li>
                    <li><span><a href="javascript: void(0);" onclick="oWall.GetList( '<?php echo $this->_tpl_vars['ui']['uid']; ?>
', '0', '2', '3' );"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
family_ico.gif" alt=""  /></a></span> <a href="javascript: void(0);" onclick="oWall.GetList( '<?php echo $this->_tpl_vars['ui']['uid']; ?>
', '0', 2, 3 )">Family only</a></li>
                    <li><span><a href="javascript: void(0);" onclick="oWall.GetList( '<?php echo $this->_tpl_vars['ui']['uid']; ?>
', '0', '2', '5' );"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
private_ico.gif" alt=""  /></a></span> <a href="javascript: void(0);" onclick="oWall.GetList( '<?php echo $this->_tpl_vars['ui']['uid']; ?>
', '0', 2, 5 )">Private</a></li>
                                        <?php $_from = $this->_tpl_vars['cfilts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                            <li class="cl_rfilt" fid="<?php echo $this->_tpl_vars['i']['id']; ?>
" id="id_filter_li_el_<?php echo $this->_tpl_vars['i']['id']; ?>
" onMouseOut="$('#id_filter_li_el_<?php echo $this->_tpl_vars['i']['id']; ?>
 .cl_del_link').hide();" onMouseOver="$('#id_filter_li_el_<?php echo $this->_tpl_vars['i']['id']; ?>
 .cl_del_link').show();"><a href="javascript: void(0);" onclick="oWall.GetList( '<?php echo $this->_tpl_vars['ui']['uid']; ?>
', '0', 3, '<?php echo $this->_tpl_vars['i']['mtype']; ?>
', '<?php echo $this->_tpl_vars['i']['ptype']; ?>
' );"><?php echo $this->_tpl_vars['i']['name']; ?>
</a> <?php if ($this->_tpl_vars['IS_USER']): ?><span class="cl_del_link" fid="<?php echo $this->_tpl_vars['i']['id']; ?>
"><a href="javascript: void(0);" onclick="oSystem.SConfPopup( 'oWall.DelFilter( <?php echo $this->_tpl_vars['i']['id']; ?>
 );', 'Please confirm you want to delete filter \'<?php echo $this->_tpl_vars['i']['name']; ?>
\'?' );">&nbsp&nbsp&nbsp&nbsp</a></span><?php endif; ?> </li>
                    <?php endforeach; endif; unset($_from); ?>
            </ul>

            <h2><?php if ($this->_tpl_vars['IS_USER']): ?><span><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['UserInfo']['uid']; ?>
/tags">Edit</a></span><?php endif; ?> Tags</h2>
            <ul class="list02">
                    <?php if ($this->_tpl_vars['ctags']): ?>
                        <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['ctags']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
                            <?php if ($this->_tpl_vars['ctags'][$this->_sections['i']['index']]['type'] != 2): ?>
                            <li class="cl_rtags" tid="<?php echo $this->_tpl_vars['ctags'][$this->_sections['i']['index']]['id']; ?>
" id="id_tags_li_el_<?php echo $this->_tpl_vars['ctags'][$this->_sections['i']['index']]['id']; ?>
" onMouseOver="$('#id_tags_li_el_<?php echo $this->_tpl_vars['ctags'][$this->_sections['i']['index']]['id']; ?>
 .cl_del_link').show();" onMouseOut="$('#id_tags_li_el_<?php echo $this->_tpl_vars['ctags'][$this->_sections['i']['index']]['id']; ?>
 .cl_del_link').hide();"><span><?php if ($this->_tpl_vars['ctags'][$this->_sections['i']['index']]['cnt_mes']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/tags/id<?php echo $this->_tpl_vars['ctags'][$this->_sections['i']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['ctags'][$this->_sections['i']['index']]['cnt_mes']; ?>
</a><?php endif; ?></span> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/tags/id<?php echo $this->_tpl_vars['ctags'][$this->_sections['i']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['ctags'][$this->_sections['i']['index']]['name']; ?>
</a> <?php if ($this->_tpl_vars['IS_USER']): ?><span class="cl_del_link" tid="<?php echo $this->_tpl_vars['ctags'][$this->_sections['i']['index']]['id']; ?>
" style="margin-right: 5px;"><a href="javascript: void(0);" onclick="oSystem.SConfPopup( 'oUsers.DeleteTag( <?php echo $this->_tpl_vars['ctags'][$this->_sections['i']['index']]['id']; ?>
 );', 'Please confirm you want to remove tag \'<?php echo smarty_function_html_str_format(array('str' => $this->_tpl_vars['ctags'][$this->_sections['i']['index']]['name']), $this);?>
\'?' );">&nbsp&nbsp&nbsp&nbsp</a></span><?php endif; ?></li>
			    <?php else: ?>
                            <li><span><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/tags/id<?php echo $this->_tpl_vars['ctags'][$this->_sections['i']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['ctags'][$this->_sections['i']['index']]['cnt_mes']; ?>
</a></span> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/tags/id<?php echo $this->_tpl_vars['ctags'][$this->_sections['i']['index']]['id']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
heart_ico.gif" title="Favorites" alt="Favorites" /></a></li>
                            <?php endif; ?>
                        <?php endfor; endif; ?>
			<?php else: ?>
			There aren't any tags
                    <?php endif; ?>
            </ul>

	    <?php if ($this->_tpl_vars['mfriends']): ?>
	    <h2><?php if (6 < $this->_tpl_vars['cnt_mfriends']): ?><span><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/friends?mutual=1">View all</a></span><?php endif; ?> Mutual Friends <b><?php echo $this->_tpl_vars['cnt_mfriends']; ?>
</b></h2>

            <?php $_from = $this->_tpl_vars['mfriends']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['n'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['n']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['n']['iteration']++;
?>
                    <?php if (($this->_foreach['n']['iteration']-1) % 4 == 0): ?>
                    <ul class="list03"<?php if (($this->_foreach['n']['iteration']-1)): ?> style="margin-top:0px; padding-top:0px;"<?php endif; ?>>
                    <?php endif; ?>
                    <li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
"><img src="<?php if ($this->_tpl_vars['i']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['i']['fpath']; ?>
/s/s_<?php echo $this->_tpl_vars['i']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m42.jpg<?php endif; ?>"  style="width: 49px; height: 49px;" /></a> <br /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
"><?php echo $this->_tpl_vars['i']['first_name']; ?>
 <font style="font-size:10px"><?php echo $this->_tpl_vars['i']['last_name']; ?>
</font></a></li>
                    <?php $this->assign('ov', ($this->_foreach['n']['iteration']-1)+1); ?>
                    <?php if ($this->_tpl_vars['ov'] % 4 == 0): ?>
                    </ul>
                    <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?>
	    <?php endif; ?>
            
            <?php if ($this->_tpl_vars['cfriends']): ?>
            <h2><?php if ($this->_tpl_vars['cnt_show_cfr'] < $this->_tpl_vars['cnt_cfriends']): ?><span><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/friends">View all</a></span><?php endif; ?> Friends <b><?php echo $this->_tpl_vars['cnt_cfriends']; ?>
</b></h2>
            
                    <?php $_from = $this->_tpl_vars['cfriends']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['n'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['n']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['n']['iteration']++;
?>
                    <?php if (($this->_foreach['n']['iteration']-1) % 4 == 0): ?>
                    <ul class="list03"<?php if (($this->_foreach['n']['iteration']-1)): ?> style="margin-top:0px; padding-top:0px;"<?php endif; ?>>
                    <?php endif; ?>
                    <li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
"><img src="<?php if ($this->_tpl_vars['i']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['i']['fpath']; ?>
/s/s_<?php echo $this->_tpl_vars['i']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m42.jpg<?php endif; ?>"  style="width: 49px; height: 49px;" /></a> <br /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
"><?php echo $this->_tpl_vars['i']['first_name']; ?>
 <font style="font-size:10px"><?php echo $this->_tpl_vars['i']['last_name']; ?>
</font></a></li>
                    <?php $this->assign('ov', ($this->_foreach['n']['iteration']-1)+1); ?>
                    <?php if ($this->_tpl_vars['ov'] % 4 == 0): ?>
                    </ul>
                    <?php endif; ?>
                    <?php endforeach; endif; unset($_from); ?>
            
            <?php endif; ?>

            <div class="clear">&nbsp;</div>

            <?php if ($this->_tpl_vars['csubscribition'] && $this->_tpl_vars['IS_USER']): ?>
            <h2 style="padding-top:5px"><?php if (4 < $this->_tpl_vars['cnt_csubscribition']): ?><span><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/subscr">View all</a></span><?php endif; ?> People I follow <b> <?php echo $this->_tpl_vars['cnt_csubscribition']; ?>
</b></h2>
            <ul class="list03" style="margin-bottom:5px">
                    <?php $_from = $this->_tpl_vars['csubscribition']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                            <li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['wuid']; ?>
"><img src="<?php if ($this->_tpl_vars['i']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['i']['fpath']; ?>
/s/s_<?php echo $this->_tpl_vars['i']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m42.jpg<?php endif; ?>"  style="width: 49px; height: 49px;" /></a> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['wuid']; ?>
"><?php echo $this->_tpl_vars['i']['first_name']; ?>
 <?php echo $this->_tpl_vars['i']['last_name']; ?>
</a></li>
                    <?php endforeach; endif; unset($_from); ?>
            </ul>
            <?php endif; ?>

            <div class="clear">&nbsp;</div>

                        <?php if ($this->_tpl_vars['csubscr']): ?>
            <h2 style="padding-top:5px"><?php if (4 < $this->_tpl_vars['cnt_csubscr']): ?><span><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['ui']['uid']; ?>
/subscr">View all</a></span><?php endif; ?> Followers <b><?php echo $this->_tpl_vars['cnt_csubscr']; ?>
</b></h2>
            <ul class="list03" style="margin-bottom:5px">
                    <?php $_from = $this->_tpl_vars['csubscr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                            <li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
"><img src="<?php if ($this->_tpl_vars['i']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['i']['fpath']; ?>
/s/s_<?php echo $this->_tpl_vars['i']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m42.jpg<?php endif; ?>"  style="width: 49px; height: 49px;" /></a> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
"><?php echo $this->_tpl_vars['i']['first_name']; ?>
 <?php echo $this->_tpl_vars['i']['last_name']; ?>
</a></li>
                    <?php endforeach; endif; unset($_from); ?>
            </ul>
            <?php endif; ?>


            <?php if ($this->_tpl_vars['scripture_of_day']): ?>
            <?php $this->assign('script', $this->_tpl_vars['scripture_of_day']['0']); ?>
            <h2>Scripture of the day</h2>
            <div class="snoska2">
                    <span style="word-wrap: break-word;">
                    <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['script']['scripture'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)))) ? $this->_run_mod_handler('dlong', true, $_tmp) : smarty_modifier_dlong($_tmp)); ?>

                    </span>
                    <p><?php echo $this->_tpl_vars['script']['first_name']; ?>
 <?php echo $this->_tpl_vars['script']['last_name']; ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['script']['script_dt'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "") : smarty_modifier_date_format($_tmp, "")); ?>
</p>
            </div>
            <?php endif; ?>
            <!--  Wall RightColumn  -->
<?php endif;  endif; ?>