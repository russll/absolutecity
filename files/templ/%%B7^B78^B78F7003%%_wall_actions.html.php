<?php /* Smarty version 2.6.11, created on 2014-07-17 19:38:44
         compiled from mods/journal/_wall_actions.html */ ?>
<div class="tlink" style="display:none;width:150px;" id="tl_<?php echo $this->_tpl_vars['i']['id']; ?>
" mid="<?php echo $this->_tpl_vars['i']['id']; ?>
">
    <?php if ($this->_tpl_vars['IS_USER'] || $this->_tpl_vars['UserInfo']['uid'] == $this->_tpl_vars['i']['uid']): ?>
    <span mid="<?php echo $this->_tpl_vars['i']['id']; ?>
" class="cl_del_link"><a href="javascript: void(0);" onclick="javascript: oSystem.SConfPopup( 'oJournal.DelMes( <?php echo $this->_tpl_vars['i']['id']; ?>
 );', 'Please confirm you want to delete this message' );">&nbsp&nbsp&nbsp&nbsp</a></span>
    <a href="javascript:void(0);" style="float:right; margin-top:-1px;" onClick="oJournal.LoadMes(<?php echo $this->_tpl_vars['i']['id']; ?>
);"><img src="/i/edit_normal.png" onmouseover="$(this).attr('src', '/i/edit_pressed.png');" onmouseout="$(this).attr('src', '/i/edit_normal.png');"  alt="Edit Message" /></a>
    <?php endif; ?>
    <span id="taghov" onmouseover="$('#tb_<?php echo $this->_tpl_vars['i']['id']; ?>
').show();" onmouseout="$('#tb_<?php echo $this->_tpl_vars['i']['id']; ?>
').hide();"><a  href="#"><img id="st_<?php echo $this->_tpl_vars['i']['id']; ?>
" src="/i/stick_ico01.png" onmouseover="this.src='/i/stick_ico03.png';" onclick="this.src='/i/stick_ico03.png';" onmouseout="this.src='/i/stick_ico01.png'"  /></a>
        <div class="tagsbox" id="tb_<?php echo $this->_tpl_vars['i']['id']; ?>
" onmouseover="$('#st_<?php echo $this->_tpl_vars['i']['id']; ?>
').attr('src', '/i/stick_ico03.png');" onmouseout="$('#st_<?php echo $this->_tpl_vars['i']['id']; ?>
').attr('src', '/i/stick_ico01.png');">
            <div class="tagsbox-top">Tags:</div>
            <div class="tagsbox-bot">
                <ul id="id_tags_menu_list_<?php echo $this->_tpl_vars['i']['id']; ?>
">
		<?php if ($this->_tpl_vars['i']['ctags']): ?>
		    <?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=$this->_tpl_vars['i']['ctags']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
/tags/id<?php echo $this->_tpl_vars['i']['ctags'][$this->_sections['j']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['i']['ctags'][$this->_sections['j']['index']]['name']; ?>
</a></li>
		    <?php endfor; endif; ?>
		<?php else: ?>
		    There aren't any tags
		<?php endif; ?>
                </ul>
                <p><input id="id_inp_tag_name_<?php echo $this->_tpl_vars['i']['id']; ?>
" type="text" value="Add tag" onclick="this.value='';" /> <a href="javascript: void(0);" onclick="javascript: oUsers.EditTags( 1, <?php echo $this->_tpl_vars['i']['id']; ?>
, <?php echo $this->_tpl_vars['i']['fpath']; ?>
, <?php echo $this->_tpl_vars['i']['wtype']; ?>
, 0 );"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
add_b.gif" alt="Add tag" /></a></p>
            </div>
        </div>
    </span>
    <a  id="id_edit_fav_a_<?php echo $this->_tpl_vars['i']['id']; ?>
" style="float:right" href="javascript: void(0);" <?php if ($this->_tpl_vars['i']['my_fav']): ?> onclick="javascript: oUsers.EditTagsMes( 2, <?php if ($this->_tpl_vars['ctags_fav']['id']):  echo $this->_tpl_vars['ctags_fav']['id'];  else: ?>0<?php endif; ?>, <?php echo $this->_tpl_vars['i']['id']; ?>
, <?php echo $this->_tpl_vars['i']['fpath']; ?>
, 5 );" <?php else: ?> onclick="javascript: oUsers.EditTagsMes( 1, <?php if ($this->_tpl_vars['ctags_fav']['id']):  echo $this->_tpl_vars['ctags_fav']['id'];  else: ?>0<?php endif; ?>, <?php echo $this->_tpl_vars['i']['id']; ?>
, <?php echo $this->_tpl_vars['i']['fpath']; ?>
, 5 );" <?php endif; ?>>
		<img <?php if ($this->_tpl_vars['i']['my_fav']): ?>class="favorites favorite" src="<?php echo $this->_tpl_vars['imgDir']; ?>
heart_ico03.png" <?php else: ?>class="favorites not_favorite" src="<?php echo $this->_tpl_vars['imgDir']; ?>
heart_ico01.png"<?php endif; ?> alt="Favorite" />
	</a>
</div>