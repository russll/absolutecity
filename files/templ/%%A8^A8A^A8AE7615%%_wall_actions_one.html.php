<?php /* Smarty version 2.6.11, created on 2014-04-23 21:03:58
         compiled from mods/profile/_wall_actions_one.html */ ?>
<div class="tlink" style="" id="tl_<?php echo $this->_tpl_vars['mai']['com_parent']; ?>
" mid="<?php echo $this->_tpl_vars['mai']['com_parent']; ?>
">
<?php if ($this->_tpl_vars['mai']['fpath']): ?>
    <?php if ($this->_tpl_vars['IS_USER'] || $this->_tpl_vars['UserInfo']['uid'] == $this->_tpl_vars['mai']['uid']): ?>
    <span mid="<?php echo $this->_tpl_vars['mai']['id']; ?>
" class="cl_del_link">
        <a href="javascript: void(0);" onclick="oSystem.SConfPopup( '<?php if ($this->_tpl_vars['m_page'] == 'wall'): ?>oWall<?php elseif ($this->_tpl_vars['m_page'] == 'wards_wall'): ?>oWWall<?php elseif ($this->_tpl_vars['m_page'] == 'mission_wall'): ?>oMWall<?php endif; ?>.DelMes( <?php echo $this->_tpl_vars['mai']['id']; ?>
, <?php echo $this->_tpl_vars['mai']['com_parent']; ?>
 );', 'Please confirm you want to delete this message' );">&nbsp&nbsp&nbsp&nbsp</a>
    </span>
    <?php endif; ?>

    <a  id="id_edit_fav_a_<?php echo $this->_tpl_vars['mai']['id']; ?>
" style="float:right" href="javascript: void(0);" <?php if ($this->_tpl_vars['mai']['my_fav']): ?> onclick="oUsers.EditTagsMes( 2, <?php echo $this->_tpl_vars['ctags_fav']['id']; ?>
, <?php echo $this->_tpl_vars['mai']['id']; ?>
, <?php echo $this->_tpl_vars['mai']['fpath']; ?>
, <?php echo $this->_tpl_vars['mai']['wtype']; ?>
 );" <?php else: ?> onclick="oUsers.EditTagsMes( 1, <?php echo $this->_tpl_vars['ctags_fav']['id']; ?>
, <?php echo $this->_tpl_vars['mai']['id']; ?>
, <?php echo $this->_tpl_vars['mai']['fpath']; ?>
, <?php echo $this->_tpl_vars['mai']['wtype']; ?>
 );" <?php endif; ?>>
        <img <?php if ($this->_tpl_vars['mai']['my_fav']): ?> src="<?php echo $this->_tpl_vars['imgDir']; ?>
heart_ico03.png" class="favorites favorite" <?php else: ?> class="favorites not_favorite"  src="<?php echo $this->_tpl_vars['imgDir']; ?>
heart_ico01.png" <?php endif; ?> alt="Favorite" />
    </a>
    <span id="taghov" onmouseover="$('#tb_<?php echo $this->_tpl_vars['mai']['id']; ?>
').show();" onmouseout="$('#tb_<?php echo $this->_tpl_vars['mai']['id']; ?>
').hide();">
        <a  href="#">
            <img id="st_<?php echo $this->_tpl_vars['mai']['id']; ?>
" src="/i/stick_ico01.png" onmouseover="this.src='/i/stick_ico03.png';" onclick="this.src='/i/stick_ico03.png';" onmouseout="this.src='/i/stick_ico01.png'"  />
        </a>
        <div class="tagsbox" id="tb_<?php echo $this->_tpl_vars['mai']['id']; ?>
" onmouseover="$('#st_<?php echo $this->_tpl_vars['mai']['id']; ?>
').attr('src', '/i/stick_ico03.png');" onmouseout="$('#st_<?php echo $this->_tpl_vars['mai']['id']; ?>
').attr('src', '/i/stick_ico01.png');">
            <div class="tagsbox-top">Tags:</div>
            <div class="tagsbox-bot">
                <ul id="id_tags_menu_list_<?php echo $this->_tpl_vars['mai']['id']; ?>
">
		<?php if ($this->_tpl_vars['mai']['ctags']): ?>
		    <?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=$this->_tpl_vars['mai']['ctags']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['j']['show'] = true;
$this->_sections['j']['max'] = $this->_sections['j']['loop'];
$this->_sections['j']['step'] = 1;
$this->_sections['j']['start'] = $this->_sections['j']['step'] > 0 ? 0 : $this->_sections['j']['loop']-1;
if ($this->_sections['j']['show']) {
    $this->_sections['j']['total'] = $this->_sections['j']['loop'];
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
                    <li><a href="/id<?php echo $this->_tpl_vars['UserInfo']['uid']; ?>
/tags/id<?php echo $this->_tpl_vars['ctags'][$this->_sections['i']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['ctags'][$this->_sections['i']['index']]['name']; ?>
</a></li>
		    <?php endfor; endif; ?>
		<?php else: ?>
		    There aren't any tags
		<?php endif; ?>
                </ul>
                <p>
                    <input id="id_inp_tag_name_<?php echo $this->_tpl_vars['mai']['id']; ?>
" type="text" value="Add tag" onclick="this.value='';" />
                    <a href="javascript: void(0);" onclick="oUsers.EditTags( 1, <?php echo $this->_tpl_vars['mai']['id']; ?>
, <?php echo $this->_tpl_vars['mai']['fpath']; ?>
, <?php echo $this->_tpl_vars['mai']['wtype']; ?>
, 1 );">
                        <img src="<?php echo $this->_tpl_vars['imgDir']; ?>
add_b.gif" alt="Add tag" />
                    </a>
                </p>
            </div>
        </div>
    </span>
    <span id="smile_status">
       <a href="javascript:void(0);" onmouseover="$('#status_sm_<?php echo $this->_tpl_vars['mai']['id']; ?>
').show();" onmouseout="$('#status_sm_<?php echo $this->_tpl_vars['mai']['id']; ?>
').hide();" onclick="$('#status_sm_<?php echo $this->_tpl_vars['mai']['id']; ?>
').show();"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
smile_ico.gif" alt="Smile status" /></a>
        <div class="tab_smile_status" id="status_sm_<?php echo $this->_tpl_vars['mai']['id']; ?>
" onmouseover="$('#status_sm_<?php echo $this->_tpl_vars['mai']['id']; ?>
').show();" onmouseout="$('#status_sm_<?php echo $this->_tpl_vars['mai']['id']; ?>
').hide();" <?php if (isset ( $this->_tpl_vars['mai']['sub_mtype'] )): ?>style="width:175px;"<?php endif; ?>>
            <div class="tab_smile_status_top">
                <a href="javascript:void(0);" onmouseover="$('#status_name_<?php echo $this->_tpl_vars['mai']['id']; ?>
').empty().append('I\'m '+'<?php echo $this->_tpl_vars['status']['happy']['0']; ?>
');" onclick="oWall.AddSmileStat('happy','<?php echo $this->_tpl_vars['UserInfo']['uid']; ?>
',<?php if (! ( $this->_tpl_vars['mai']['is_copy_mes'] )): ?>'<?php echo $this->_tpl_vars['mai']['id']; ?>
'<?php else: ?>'<?php echo $this->_tpl_vars['mai']['is_copy_mes']; ?>
'<?php endif; ?>);"><img src="/i/smile/happy.png" alt="Happy" /></a>
                <a href="javascript:void(0);" onmouseover="$('#status_name_<?php echo $this->_tpl_vars['mai']['id']; ?>
').empty().append('I\'m '+'<?php echo $this->_tpl_vars['status']['laugh']['0']; ?>
');" onclick="oWall.AddSmileStat('laugh','<?php echo $this->_tpl_vars['UserInfo']['uid']; ?>
',<?php if (! ( $this->_tpl_vars['mai']['is_copy_mes'] )): ?>'<?php echo $this->_tpl_vars['mai']['id']; ?>
'<?php else: ?>'<?php echo $this->_tpl_vars['mai']['is_copy_mes']; ?>
'<?php endif; ?>);"><img src="/i/smile/laugh.png" alt="Laugh" /></a>
                <a href="javascript:void(0);" onmouseover="$('#status_name_<?php echo $this->_tpl_vars['mai']['id']; ?>
').empty().append('I\'m '+'<?php echo $this->_tpl_vars['status']['wink']['0']; ?>
');" onclick="oWall.AddSmileStat('wink','<?php echo $this->_tpl_vars['UserInfo']['uid']; ?>
',<?php if (! ( $this->_tpl_vars['mai']['is_copy_mes'] )): ?>'<?php echo $this->_tpl_vars['mai']['id']; ?>
'<?php else: ?>'<?php echo $this->_tpl_vars['mai']['is_copy_mes']; ?>
'<?php endif; ?>);"><img src="/i/smile/wink.png" alt="Wink" /></a>
                <a href="javascript:void(0);" onmouseover="$('#status_name_<?php echo $this->_tpl_vars['mai']['id']; ?>
').empty().append('I\'m '+'<?php echo $this->_tpl_vars['status']['bless']['0']; ?>
');" onclick="oWall.AddSmileStat('bless','<?php echo $this->_tpl_vars['UserInfo']['uid']; ?>
',<?php if (! ( $this->_tpl_vars['mai']['is_copy_mes'] )): ?>'<?php echo $this->_tpl_vars['mai']['id']; ?>
'<?php else: ?>'<?php echo $this->_tpl_vars['mai']['is_copy_mes']; ?>
'<?php endif; ?>);"><img src="/i/smile/bless.png" alt="Bless" /></a>
                <a href="javascript:void(0);" onmouseover="$('#status_name_<?php echo $this->_tpl_vars['mai']['id']; ?>
').empty().append('I\'m '+'<?php echo $this->_tpl_vars['status']['love']['0']; ?>
');" onclick="oWall.AddSmileStat('love','<?php echo $this->_tpl_vars['UserInfo']['uid']; ?>
',<?php if (! ( $this->_tpl_vars['mai']['is_copy_mes'] )): ?>'<?php echo $this->_tpl_vars['mai']['id']; ?>
'<?php else: ?>'<?php echo $this->_tpl_vars['mai']['is_copy_mes']; ?>
'<?php endif; ?>);"><img src="/i/smile/love.png" alt="Love" /></a>
                <a href="javascript:void(0);" onmouseover="$('#status_name_<?php echo $this->_tpl_vars['mai']['id']; ?>
').empty().append('I\'m '+'<?php echo $this->_tpl_vars['status']['shock']['0']; ?>
');" onclick="oWall.AddSmileStat('shock','<?php echo $this->_tpl_vars['UserInfo']['uid']; ?>
',<?php if (! ( $this->_tpl_vars['mai']['is_copy_mes'] )): ?>'<?php echo $this->_tpl_vars['mai']['id']; ?>
'<?php else: ?>'<?php echo $this->_tpl_vars['mai']['is_copy_mes']; ?>
'<?php endif; ?>);"><img src="/i/smile/shock.png" alt="Shock" /></a>
                <a href="javascript:void(0);" onmouseover="$('#status_name_<?php echo $this->_tpl_vars['mai']['id']; ?>
').empty().append('I\'m '+'<?php echo $this->_tpl_vars['status']['sad']['0']; ?>
');" onclick="oWall.AddSmileStat('sad','<?php echo $this->_tpl_vars['UserInfo']['uid']; ?>
',<?php if (! ( $this->_tpl_vars['mai']['is_copy_mes'] )): ?>'<?php echo $this->_tpl_vars['mai']['id']; ?>
'<?php else: ?>'<?php echo $this->_tpl_vars['mai']['is_copy_mes']; ?>
'<?php endif; ?>);"><img src="/i/smile/sad.png" alt="Sad" /></a>
            </div>
            <div id="status_name_<?php echo $this->_tpl_vars['mai']['id']; ?>
" class="tab_smile_status_bot">I'm happy about this</div>
        </div>
    </span>
	<?php endif; ?>
</div>