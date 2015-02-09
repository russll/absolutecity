<?php /* Smarty version 2.6.11, created on 2014-03-15 08:51:29
         compiled from mods/users/ajax/_options_edit_question.html */ ?>
<tr><td width="150"><label>Question</label></td><td><input class="txt3" type="text" value="<?php echo $this->_tpl_vars['uinfo']['sec_question']; ?>
" name="sec_question" id='sec_question'  /></td></tr>
<tr><td width="150"><label>Answer<br /></label></td><td><input class="txt3" type="text" value="<?php echo $this->_tpl_vars['uinfo']['sec_answer']; ?>
" name="sec_answer" id="sec_answer"  /></td></tr>
<tr style="height:50px;">
    <td colspan="2" align="right">
        <div class="aj-button">
            <span class="aj-button01"><a href="javascript:oUsers.OptionsCnl('question');">Cancel</a></span>
            <span class="aj-button02"><a href="javascript:oUsers.OptionsQuestionSubm();">Save</a></span>
        </div>
    </td>
</tr>