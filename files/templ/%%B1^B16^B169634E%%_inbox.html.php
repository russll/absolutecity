<?php /* Smarty version 2.6.11, created on 2014-03-15 09:09:58
         compiled from top_blocks/_inbox.html */ ?>

<!-- Message top box -->

<div class="top-box-inbox">
    <table>
        <tr>
            <td class="top-left">
                <div class="m-awatar">
                    <!--a href="javascript: void(0);" <?php if (IS_USER): ?> onclick="javascript: oUsers.SHUplPopup(1, 'id_upl_avatar_popup');" <?php endif; ?>><div style="height: 100%; width: 100%;"><img src="<?php if ($this->_tpl_vars['ui']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['ui']['fpath']; ?>
/a/a_<?php echo $this->_tpl_vars['ui']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo.jpg<?php endif; ?>"   class="big_avatar" /></a-->
                    <div style="height: 100%; width: 100%;"><img src="<?php if ($this->_tpl_vars['ui']['image']):  echo $this->_tpl_vars['fImgDir']; ?>
users/<?php echo $this->_tpl_vars['ui']['fpath']; ?>
/a/a_<?php echo $this->_tpl_vars['ui']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo.jpg<?php endif; ?>"   class="big_avatar" /></div>
		    <span></span>
                                  </div>
            </td>
            <td>
                <div>
                    <span style="font-size: 20px; color: white; margin: 45px 0 30px 20px;"><?php echo $this->_tpl_vars['UserInfo']['first_name']; ?>
&nbsp;<?php echo $this->_tpl_vars['UserInfo']['last_name']; ?>
</span>
                </div>
            </td>

            <!--td class="top-right"-->
                            <!--/td-->

        </tr>
    </table>
</div>