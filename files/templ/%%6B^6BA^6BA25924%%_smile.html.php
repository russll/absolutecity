<?php /* Smarty version 2.6.11, created on 2014-03-15 08:51:13
         compiled from top_blocks/_smile.html */ ?>
<?php echo '
<script type="text/javascript">
        function AddSmileText(code, type, id){
        if (type == \'board\')
        {
            if (jQuery("#id_send_inp_mes_story").val() == \'Share your thoughts\'||jQuery("#id_send_inp_mes_story").val() == \'Post something on this wall\')
            var string = code;
            else var string = jQuery("#id_send_inp_mes_story").val()+ code;
            jQuery("#id_send_inp_mes_story").val(string);
        }
        else if(type == \'just_comment\')
        {
                var string = jQuery(\'#id_add_new_answ_txtar_b_\'+id).val()+ code;
                jQuery(\'#id_add_new_answ_txtar_b_\'+id).val(string);
        }
        else if (type == \'comment\')
        {
                var string = jQuery(\'#id_add_new_answ_txtar_b\'+id).val()+ code;
                jQuery(\'#id_add_new_answ_txtar_b\'+id).val(string);
        }
        else if (type == \'inbox\' || type == \'journal\')
        {
            var mes_story = $(\'#id_iframe_txt\').contents().find(\'body\').find(\'font\').val();
            if (mes_story == \'\')
                var string = code;
            else
                var string = jQuery("#id_send_inp_mes_story").val()+code;
                $("#id_iframe_txt").contents().find("body").html(string).css(\'color\',\'black\');
        }
        else if (type == \'badge\')
        {
            if (jQuery("#id_send_badge_b_story").val() == \'Enter badge text\')
                var string = code;
            else var string = jQuery("#id_send_badge_b_story").val()+ code;
            jQuery("#id_send_badge_b_story").val(string);
             
        }
    }
</script>
'; ?>

                            <div class="smiley-top">
                             &nbsp;
                            <?php unset($this->_sections['gorizontal']);
$this->_sections['gorizontal']['name'] = 'gorizontal';
$this->_sections['gorizontal']['loop'] = is_array($_loop=$this->_tpl_vars['sname']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['gorizontal']['start'] = (int)0;
$this->_sections['gorizontal']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['gorizontal']['show'] = true;
$this->_sections['gorizontal']['max'] = $this->_sections['gorizontal']['loop'];
if ($this->_sections['gorizontal']['start'] < 0)
    $this->_sections['gorizontal']['start'] = max($this->_sections['gorizontal']['step'] > 0 ? 0 : -1, $this->_sections['gorizontal']['loop'] + $this->_sections['gorizontal']['start']);
else
    $this->_sections['gorizontal']['start'] = min($this->_sections['gorizontal']['start'], $this->_sections['gorizontal']['step'] > 0 ? $this->_sections['gorizontal']['loop'] : $this->_sections['gorizontal']['loop']-1);
if ($this->_sections['gorizontal']['show']) {
    $this->_sections['gorizontal']['total'] = min(ceil(($this->_sections['gorizontal']['step'] > 0 ? $this->_sections['gorizontal']['loop'] - $this->_sections['gorizontal']['start'] : $this->_sections['gorizontal']['start']+1)/abs($this->_sections['gorizontal']['step'])), $this->_sections['gorizontal']['max']);
    if ($this->_sections['gorizontal']['total'] == 0)
        $this->_sections['gorizontal']['show'] = false;
} else
    $this->_sections['gorizontal']['total'] = 0;
if ($this->_sections['gorizontal']['show']):

            for ($this->_sections['gorizontal']['index'] = $this->_sections['gorizontal']['start'], $this->_sections['gorizontal']['iteration'] = 1;
                 $this->_sections['gorizontal']['iteration'] <= $this->_sections['gorizontal']['total'];
                 $this->_sections['gorizontal']['index'] += $this->_sections['gorizontal']['step'], $this->_sections['gorizontal']['iteration']++):
$this->_sections['gorizontal']['rownum'] = $this->_sections['gorizontal']['iteration'];
$this->_sections['gorizontal']['index_prev'] = $this->_sections['gorizontal']['index'] - $this->_sections['gorizontal']['step'];
$this->_sections['gorizontal']['index_next'] = $this->_sections['gorizontal']['index'] + $this->_sections['gorizontal']['step'];
$this->_sections['gorizontal']['first']      = ($this->_sections['gorizontal']['iteration'] == 1);
$this->_sections['gorizontal']['last']       = ($this->_sections['gorizontal']['iteration'] == $this->_sections['gorizontal']['total']);
?>
                            <?php $this->assign('index', $this->_sections['gorizontal']['index']); ?>
                            <?php $this->assign('name', $this->_tpl_vars['sname'][$this->_tpl_vars['index']]); ?>

                            <?php if (isset ( $this->_tpl_vars['i']['com_parent'] )): ?>
                                <?php $this->assign('id_com', $this->_tpl_vars['i']['com_parent']); ?>
                            <?php elseif (isset ( $this->_tpl_vars['mai']['com_parent'] )): ?>
                                <?php $this->assign('id_com', $this->_tpl_vars['mai']['com_parent']); ?>
                            <?php elseif (isset ( $this->_tpl_vars['i'] )): ?>
                                <!--Missions Wall, Wards Wall-->
                                <?php $this->assign('id_com', $this->_tpl_vars['i']['id']); ?>
                            <?php elseif (isset ( $this->_tpl_vars['mai'] )): ?>
                                <!--Missions Wall, Wards Wall just commented-->
                                <?php $this->assign('id_com', $this->_tpl_vars['mai']['id']); ?>
                            <?php endif; ?>
                            
                            <?php if ($this->_tpl_vars['type_smile'] == 'board' || $this->_tpl_vars['type_smile'] == 'inbox'): ?>
                                <a href="javascript:void(0);" id="smiley_code" onclick="AddSmileText('<?php echo $this->_tpl_vars['snamecode'][$this->_tpl_vars['name']]; ?>
','<?php echo $this->_tpl_vars['type_smile']; ?>
');" value="<?php echo $this->_tpl_vars['snamecode'][$this->_tpl_vars['name']]; ?>
" onmouseover="$('div.smiley_name').empty().append('<?php echo $this->_tpl_vars['name']; ?>
');$('div.smiley_code').empty().append('<?php echo $this->_tpl_vars['snamecode'][$this->_tpl_vars['name']]; ?>
');"><img class="smile_border" id="smile_img" src="<?php echo $this->_tpl_vars['imgDir']; ?>
smiles/<?php echo $this->_tpl_vars['sname'][$this->_tpl_vars['index']]; ?>
.gif" <?php if ($this->_tpl_vars['snamecode'][$this->_tpl_vars['name']] == '(boeing)'): ?>style="margin-left:7px;margin-right: 0;"<?php else: ?>style="margin-left:1px; margin-right:0;"<?php endif; ?>/></a>
                            <?php elseif ($this->_tpl_vars['type_smile'] == 'journal'): ?>
                                <a href="javascript:void(0);" id="smiley_code" onclick="AddSmileText('<?php echo $this->_tpl_vars['snamecode'][$this->_tpl_vars['name']]; ?>
','<?php echo $this->_tpl_vars['type_smile']; ?>
','<?php echo $this->_tpl_vars['id_com']; ?>
'); oJournal.toggleMes(1);" value="<?php echo $this->_tpl_vars['snamecode'][$this->_tpl_vars['name']]; ?>
" onmouseover="$('div.smiley_name').empty().append('<?php echo $this->_tpl_vars['name']; ?>
');$('div.smiley_code').empty().append('<?php echo $this->_tpl_vars['snamecode'][$this->_tpl_vars['name']]; ?>
');"><img class="smile_border" id="smile_img" src="<?php echo $this->_tpl_vars['imgDir']; ?>
smiles/<?php echo $this->_tpl_vars['sname'][$this->_tpl_vars['index']]; ?>
.gif" <?php if ($this->_tpl_vars['snamecode'][$this->_tpl_vars['name']] == '(boeing)'): ?>style="margin-left:7px;margin-right: 0;"<?php else: ?>style="margin-left:1px; margin-right:0;"<?php endif; ?>/></a>
                            <?php elseif ($this->_tpl_vars['type_smile'] == 'badge'): ?>
                                <a href="javascript:void(0);" id="smiley_code" onclick="AddSmileText('<?php echo $this->_tpl_vars['snamecode'][$this->_tpl_vars['name']]; ?>
','<?php echo $this->_tpl_vars['type_smile']; ?>
');" value="<?php echo $this->_tpl_vars['snamecode'][$this->_tpl_vars['name']]; ?>
" onmouseover="$('div.smiley_name').empty().append('<?php echo $this->_tpl_vars['name']; ?>
');$('div.smiley_code').empty().append('<?php echo $this->_tpl_vars['snamecode'][$this->_tpl_vars['name']]; ?>
');"><img class="smile_border" id="smile_img" src="<?php echo $this->_tpl_vars['imgDir']; ?>
smiles/<?php echo $this->_tpl_vars['sname'][$this->_tpl_vars['index']]; ?>
.gif" /></a>
                            <?php else: ?>
                                <a href="javascript:void(0);" id="smiley_code" onclick="AddSmileText('<?php echo $this->_tpl_vars['snamecode'][$this->_tpl_vars['name']]; ?>
','<?php echo $this->_tpl_vars['type_smile']; ?>
','<?php echo $this->_tpl_vars['id_com']; ?>
');" value="<?php echo $this->_tpl_vars['snamecode'][$this->_tpl_vars['name']]; ?>
" onmouseover="$('div.smiley_name').empty().append('<?php echo $this->_tpl_vars['name']; ?>
');$('div.smiley_code').empty().append('<?php echo $this->_tpl_vars['snamecode'][$this->_tpl_vars['name']]; ?>
');"><img class="smile_border" id="smile_img" src="<?php echo $this->_tpl_vars['imgDir']; ?>
smiles/<?php echo $this->_tpl_vars['sname'][$this->_tpl_vars['index']]; ?>
.gif" /></a>
                            <?php endif; ?>
                            
                            <?php endfor; endif; ?>
                        </div>
                        <div class="smiley-bot">
                            <table>
                            <tr>
                                <td>
                                <div class="smiley_name" style="text-align: left;">
                                     &nbsp;
                                    <?php echo $this->_tpl_vars['sname']['0']; ?>

                                </div>
                                </td>
                                <td>
                                <div class="smiley_code" style="text-align: right;">
                                    <?php $this->assign('code', $this->_tpl_vars['sname']['0']); ?>
                                    <?php echo $this->_tpl_vars['snamecode'][$this->_tpl_vars['code']]; ?>

                                    &nbsp;
                                </div>
                                </td>
                            </tr>
                            </table>
                        </div>