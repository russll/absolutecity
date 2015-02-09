<?php /* Smarty version 2.6.11, created on 2014-03-15 08:51:13
         compiled from mods/_popups/_add_filter.html */ ?>
<div id="id_add_filter_popup" class="aj-box01" style="display: none; position: fixed; z-index: 3333; max-height: 650px; top: 10%;">
    <div class="aj-close"><a href="javascript: void(0);" onclick="oWall.SHFilterPopup( 2, 'id_add_filter_popup' )"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close_ico.gif" alt="Close" /></a></div>

    <form id="id_add_filt_frm" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['UserInfo']['uid']; ?>
/wall/filtusersajax" method="post" enctype="application/x-www-form-urlencoded">
        <input name="ptype" id="id_add_filt_frm_ptype" type="hidden" value="" />
    </form>

    <form id="id_add_filt_frm_send" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['UserInfo']['uid']; ?>
/wall/addfiltajax" method="post" enctype="application/x-www-form-urlencoded">
        <div class="aj-input"><p><input id="id_add_filt_frm_send_name" name="FI[name]" type="text" value="Enter new feed name" onclick="this.value='';" /></p></div>
        <input name="FI[ptype]" id="id_add_filt_frm_send_ptype" type="hidden" value="" />
        <input name="FI[mtype]" id="id_add_filt_frm_send_mtype" type="hidden" value="" />
    </form>
    <div class="aj-tools">

        <label style="float: right;"><a id="id_add_filt_mtype_label" href="javascript: void(0);" onclick="$('#id_add_filt_privacy').hide(); $('#id_add_filt_mtype').slideToggle();">All entries</a> <img src="<?php echo $this->_tpl_vars['imgDir']; ?>
arr05.gif" alt="" onclick="$('#id_add_filt_privacy').hide(); $('#id_add_filt_mtype').slideToggle();" /></label>

        <div id="id_add_filt_mtype" class="all-entries cl_add_filt_listing" style="top:87px; left:240px; display: none;">
            <div class="all-entries-box">
                <ul>
                    <li> <a class="cl_add_filt_mtype_el" href="javascript: void(0);" mtype="0">All entries</a></li>
                    <li><span><a href="#"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
photo_ico.gif" alt="" /></a></span> <a class="cl_add_filt_mtype_el" href="javascript: void(0);" mtype="4">Photos</a></li>
                    <li><span><a href="#"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
video_ico.gif" alt="" /></a></span> <a class="cl_add_filt_mtype_el" href="javascript: void(0);" mtype="5">Videos</a></li>
                    <li><span><a href="#"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
event_ico.gif" alt="" /></a></span> <a class="cl_add_filt_mtype_el" href="javascript: void(0);" mtype="2">Events</a></li>
                    <li><span><a href="#"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
link_ico.gif" alt="" /></a></span> <a class="cl_add_filt_mtype_el" href="javascript: void(0);" mtype="3">Links</a></li>
                </ul>
            </div>
        </div>

        <label>View &nbsp<img src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico03.png" alt="" /> <a id="id_add_filt_ptype_label" href="javascript: void(0);" onclick="$('#id_add_filt_mtype').hide(); $('#id_add_filt_privacy').slideToggle();">All entries</a> <img src="<?php echo $this->_tpl_vars['imgDir']; ?>
arr05.gif" alt="" onclick="$('#id_add_filt_mtype').hide(); $('#id_add_filt_privacy').slideToggle();" /></label>

        <div id="id_add_filt_privacy" class="all-entries cl_add_filt_listing" style="top:87px; left:25px; display: none;">
            <div class="all-entries-box">
                <ul>
                    <li> <a class="cl_add_filt_privacy_el" href="javascript: void(0);" ptype="0" >All entries</a></li>
                    <li><span><a href="#"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
friend_add_ico.gif" alt="" /></a></span> <a class="cl_add_filt_privacy_el" href="javascript: void(0);" ptype="1" >Friends and followers</a></li>
                    <li><span><a href="#"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
frendly_ico.gif" alt="" /></a></span> <a class="cl_add_filt_privacy_el" href="javascript: void(0);" ptype="2">Friends only</a></li>
                    <li><span><a href="#"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
family_ico.gif" alt="" /></a></span> <a class="cl_add_filt_privacy_el" href="javascript: void(0);" ptype="3">Family only</a></li>
                    <li><span><a href="#"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
private_ico.gif" alt="" /></a></span> <a class="cl_add_filt_privacy_el" href="javascript: void(0);" ptype="4">Private</a></li>
                                    </ul>
            </div>
        </div>
    </div>

    <div class="aj-content">
        <ul id="id_add_filt_us_list" class="aj-list">
	    <?php if ($this->_tpl_vars['myfrsubscr']): ?>
	    <?php $_from = $this->_tpl_vars['myfrsubscr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
            <li>
                <div class="box003">
                    <div class="post-box">
                        <div class="b-awatar"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
"><img src="<?php if ($this->_tpl_vars['i']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['i']['fpath']; ?>
/s/s_<?php echo $this->_tpl_vars['i']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo_m66.jpg<?php endif; ?>" alt="" /></a></div>
                        <div class="post-title2"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['i']['uid']; ?>
"><b><?php if ($this->_tpl_vars['i']['first_name'] || $this->_tpl_vars['i']['last_name']):  echo $this->_tpl_vars['i']['first_name']; ?>
 <?php echo $this->_tpl_vars['i']['last_name'];  else:  echo $this->_tpl_vars['i']['public_name'];  endif; ?></b></a></div>
                        <p><?php if ($this->_tpl_vars['i']['city']):  echo $this->_tpl_vars['i']['city']; ?>
,<?php endif; ?> <?php if ($this->_tpl_vars['i']['country']):  echo $this->_tpl_vars['i']['country'];  endif; ?></p>
                    </div>
                </div>
            </li>
	    <?php endforeach; endif; unset($_from); ?>
	    <?php else: ?>
            <li>
		There aren't any members
            </li>
	    <?php endif; ?>
        </ul>
    </div>

    <div class="aj-button">
        <span class="aj-button01"><a href="javascript: void(0);" onclick="oWall.SHFilterPopup( 2, 'id_add_filter_popup' );">Cancel</a></span>
        <span class="aj-button02"><a href="javascript: void(0);" onclick="oWall.EditFilter( 'id_add_filt_frm_send' );">Create</a></span>
    </div>

</div>