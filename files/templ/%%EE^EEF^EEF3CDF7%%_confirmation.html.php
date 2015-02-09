<?php /* Smarty version 2.6.11, created on 2014-03-15 08:51:13
         compiled from mods/_popups/_confirmation.html */ ?>
<div id="id_confirmation_popup" class="aj-box01" align="center" style="display: none; position: fixed; z-index: 4444; max-height: 130px">
    <div class="aj-close"><a href="javascript: void(0);" onclick="if ($('#id_confirmation_popup').fadeOut(300)) $('#id_eclipse_bckgrnd').hide(); $('#id_eclipse_img_bckgrnd').hide();"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close_ico.gif"  /></a></div>

    <div style="margin: 10px;" align="left"><h3>&nbsp;</h3></div>

    <div style="max-height: 120px; margin: 10px; border: none !important;">
        <div>
            <div>
                <fieldset style="border: none !important;">
                    <div>
                        <div>
                            <b id="id_confirmation_title" style="color:#000;">Are you sure?</b>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
    
    <div class="aj-button" align="right">
        <span class="aj-button01"><a id="id_confirmation_btn_01" href="javascript: void(0);" onclick="if ($('#id_confirmation_popup').fadeOut(300)) $('#id_eclipse_bckgrnd').hide(); $('#id_eclipse_img_bckgrnd').hide();">Cancel</a></span>
        <span class="aj-button02"><a id="id_confirmation_btn_02" href="javascript: void(0);" onclick="if ($('#id_confirmation_popup').fadeOut(300)) $('#id_eclipse_bckgrnd').hide(); $('#id_eclipse_img_bckgrnd').hide();">Delete</a></span>
    </div>
    <span class="block-bottom">&nbsp;</span>
</div>