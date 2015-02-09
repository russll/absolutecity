<?php /* Smarty version 2.6.11, created on 2014-10-12 10:04:09
         compiled from mods/journal/_wall_actions_one.html */ ?>
<div class="tlink" style="display:none;width:150px;" id="tl_<?php echo $this->_tpl_vars['mai']['id']; ?>
" mid="<?php echo $this->_tpl_vars['mai']['id']; ?>
">
    <?php if ($this->_tpl_vars['IS_USER'] || $this->_tpl_vars['UserInfo']['uid'] == $this->_tpl_vars['mai']['uid']): ?>
    <span mid="<?php echo $this->_tpl_vars['mai']['id']; ?>
" class="cl_del_link"><a href="javascript: void(0);" onclick="javascript: oSystem.SConfPopup( 'oJournal.DelMes( <?php echo $this->_tpl_vars['mai']['id']; ?>
 );', 'Please confirm you want to delete this message' );">&nbsp&nbsp&nbsp&nbsp</a></span>
    <a href="javascript:void(0);" style="float:right" onClick="oJournal.LoadMes(<?php echo $this->_tpl_vars['mai']['id']; ?>
);"><img src="/i/edit_mes.png" width="12" height="16" alt="Edit Message"></a>
    <?php endif; ?>

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
		    <?php $_from = $this->_tpl_vars['mai']['ctags']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['j']):
?>
                    <li><a href="/id<?php echo $this->_tpl_vars['UserInfo']['uid']; ?>
/tags/id<?php echo $this->_tpl_vars['j']['id']; ?>
"><?php echo $this->_tpl_vars['j']['name']; ?>
</a></li>
		    <?php endforeach; endif; unset($_from); ?>
		<?php else: ?>
		    There aren't any tags
		<?php endif; ?>
                </ul>
                <p>
                    <input id="id_inp_tag_name_<?php echo $this->_tpl_vars['mai']['id']; ?>
" type="text" value="Add tag" onclick="this.value='';" />
                    <a href="javascript: void(0);" onclick="javascript: oUsers.EditTags( 1, <?php echo $this->_tpl_vars['mai']['id']; ?>
, <?php echo $this->_tpl_vars['mai']['fpath']; ?>
, 5, 1 );">
                        <img src="<?php echo $this->_tpl_vars['imgDir']; ?>
add_b.gif" alt="Add tag" />
                    </a>
                </p>
            </div>
        </div>
    </span>

    <a  id="id_edit_fav_a_<?php echo $this->_tpl_vars['mai']['id']; ?>
" style="float:right" href="javascript: void(0);" <?php if ($this->_tpl_vars['mai']['my_fav']): ?> onclick="javascript: oUsers.EditTagsMes( 2, <?php if ($this->_tpl_vars['ctags_fav']['id']):  echo $this->_tpl_vars['ctags_fav']['id'];  else: ?>0<?php endif; ?>, <?php echo $this->_tpl_vars['mai']['id']; ?>
, <?php echo $this->_tpl_vars['mai']['fpath']; ?>
, 5 );" <?php else: ?> onclick="javascript: oUsers.EditTagsMes( 1, <?php if ($this->_tpl_vars['ctags_fav']['id']):  echo $this->_tpl_vars['ctags_fav']['id'];  else: ?>0<?php endif; ?>, <?php echo $this->_tpl_vars['mai']['id']; ?>
, <?php echo $this->_tpl_vars['mai']['fpath']; ?>
, 5 );" <?php endif; ?>>
		<img <?php if ($this->_tpl_vars['mai']['my_fav']): ?>class="favorites favorite" src="<?php echo $this->_tpl_vars['imgDir']; ?>
heart_ico03.png" <?php else: ?> class="favorites not_favorite" src="<?php echo $this->_tpl_vars['imgDir']; ?>
heart_ico01.png" <?php endif; ?> alt="Favorite" />
	</a>
</div>