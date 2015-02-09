/**
 * Wall jsController
 *
 * @package    5dev IWall
 * @version    1.0
 * @since      1.03.2010
 * @copyright  2010 5dev Team
 * @link       http://5dev.com
 */

function IWall()
{
    this.__construct();
}

IWall.prototype = {
    __construct: function()
    {
        crand = rand(999, 99999999);	//special numer for photo & video
        retCont = '';
        retId = '';
        showed = {
            'ev': 0,
            'link': 0
        };
        ufy_ready = false;
        stopColor = false;
        defColor = '';
    }, /* __construct */

    disableNAL: function ()
    {
        $('.top_nav_attach_links').each(function()
        {
            $(this).css('opacity', '0.4');
        });

        $(".top_nav_attach_links").unbind('click');

        $('.top_nav_attach_links').click(function ()
        {
            return false;
        });
    },

    enableNAL: function ()
    {
        $('.top_nav_attach_links').each(function()
        {
            $(this).css('opacity', '1');
        });

        $(".top_nav_attach_links").unbind('click');

        $('.top_nav_attach_links').click(function ()
        {
            oIWall.ChngSendBlock($(this).attr('mtype'));
            oIWall.disableNAL();
        });
    },


    //---- System Methods

    /**
     * Initialization of the Interfaces
     */
    _initInterface: function ()
    {
        oIWall._initDefaultSettings();
        oIWall._initListeners();
    },  /* initInterface */

    _initDefaultSettings: function ()
    {
        $('.cl_send_block').css({
            'display': 'none',
            'visibility': 'visible'
        });
        $('.cl_attached_block').css({
            'display': 'none'
        });
        $('#id_send_block_mes').show();
        $('#id_uploaded_mes').show();

        if (oIWall.defColor != '')
            //$('iframe').contents().find('body').html('<font style="font-size:14px;color: gray;">Send an instant message</font>');
            $('#id_iframe_txt').contents().find('body').html('<font style="font-size:14px;color: gray;">Type your message</font>');

        $('.cl_answ_story').val('');
        $('#id_jwrite_subj').val('Subject');
        $('#id_iframe_txt').css({
            'border': 'none'
        });
        $('.share-white-b').show();


        if (retCont && retId)
        {
            $('#id_place_to_attach').html();
            $('#' + retId).html(retCont);
            redId = '';
            retCont = '';
            NFFix();
        }
    }, /* _initDefaultSettings */

    /**
     * Initialization of the Necessaries To Complete Fields
     *
     * @param smtype ('link'-link, 'photo'-photo, 'video'-video)
     */
    _initNecData: function (smtype)
    {
        switch (smtype)
        {
            case 'ev':
                this.n_data = new Array('title', 'where', 'dt');
                break;
            case 'link':
                this.n_data = new Array('url');
                break;
            case 'photo_url':
                this.n_data = new Array('link');
                break;
            case 'photo_choose_file':
                this.n_data = new Array('p_img');
                break;
            case 'video_code':
                this.n_data = new Array('link');
                break;
            case 'video_choose_file':
                this.n_data = new Array('v_unid');
                break;
            default:
                this.n_data = null;
                break;
        }
        return this.n_data;
    }, /* _initNecData */

    /**
     * Initialization of the constant Event's Listeners
     * Set Necessary values for the fields
     */
    _initListeners: function ()
    {

        $('#id_send_inp_link_url').keyup(function()
        {
            if ($(this).val().length > 0) $('#link_add_button').attr('src', imgDir + 'add_b2_act.gif'); else $('#link_add_button').attr('src', imgDir + 'add_b2.gif');
        });

        /* "enable\disable" add-button in link section dependent on character's length */
        if ($('#send_photo_link').val() && $('#send_photo_link').val().length > 0)
            $('#send_photo_link').attr('src', imgDir + 'add_b2_act.gif');
        else
            $('#send_photo_link').attr('src', imgDir + 'add_b2.gif');

        $('#id_send_inp_photo_url_link').keyup(function()
        {
            if ($(this).val().length > 0) $('#send_photo_link').attr('src', imgDir + 'add_b2_act.gif'); else $('#send_photo_link').attr('src', imgDir + 'add_b2.gif');
        });


        if ($('#id_iframe_txt').contents().unbind('click'))
        {
            var k = function()
            {
                var str = $('#id_iframe_txt').contents().find('body').html();

                //var reg = /Send an instant message/i;
                var reg = /Type your message/i;
                if (reg.test(str))
                {
                    $('#id_iframe_txt').contents().find('body').html('');
                }
            }

            $('#id_iframe_txt').contents().click(k);
            $('#id_iframe_txt').contents().keypress(k);

            if (oIWall.defColor != '' && oIWall.defColor != undefined)
            {
                $('.forecolor').click();

                $('.jHtmlAreaColorPickerMenu div').each(function()
                {
                    if ($(this).css('background-color') == oIWall.defColor)
                        $(this).click();
                });
            }
        }

        //check maxlength of the TextArea && enable buttons to send
        $('#id_send_inp_mes_story').val();

        var attached = $('#id_place_to_attach: input');

        $('.cl_img_btn_share').attr({
            'src': imgDir + 'share_b_act.gif'
        });

        $('.cl_a_btn_share').attr({
            'href': 'javascript: oIWall.AddMes( \'id_frm_add_mes\' );'
        });

        $('#id_share_with').show();
        //$(this).parent().find('.charsRemaining').html('You have ' + (max - $(this).val().length) + ' characters remaining');

        if ($('#id_iframe_txt').contents().unbind('keydown'))
        {
            $('#id_iframe_txt').contents().keydown(function(e)
            {
                var code = (e.keyCode ? e.keyCode : e.which);
                if (code == 13)
                { // && e.ctrlKey
                    var str = $('#id_iframe_txt').contents().find('body').html();

                    //var reg = /Send an instant message/i;
                    var reg = /Type your message/i;
                    if (!reg.test(str) && str != '')
                    {
                        var selectedColor = $('#id_iframe_txt').contents().find('body').find('span').css('color');
                        oIWall.defColor = selectedColor;
                        oIWall.AddMes('id_frm_add_mes');
                        $('#id_iframe_txt').contents().find('body').html('');
                        //$('id_send_inp_mes_story').html('');
                    }
                }
            });
        }

        //initialization of the Add Attach Navigation Bar
        if ($(".link").unbind('click'))
        {
            $('.nav_attach_links').click(function ()
            {
                oIWall.ChngSendBlock($(this).attr('mtype'));
            });
            oIWall.enableNAL();
        }


        //Set privacy type (share with)
        if ($(".cl_a_share_with").unbind('click'))
        {
            $('.cl_a_share_with').click(function ()
            {
                var ptype = $(this).attr('ptype');
                $(this).parent().parent('ul').find('li').removeClass('grey');
                $(this).parent('li').addClass('grey');
                $('#id_add_mes_privacy').val(ptype);
                $('.cl_ssmenu').hide();

                //-- if submenu is existed
                if ($('#id_ssmenu_' + ptype).attr('id'))
                    $('#id_ssmenu_' + ptype).slideToggle();
                else
                    $('#id_smenu_sharewith').hide();

                if (ptype == 0 && $('#id_ssmenu_' + ptype).find('input').css('display') == 'none' && $('#id_ssmenu_' + ptype).find('input').val() == '')
                {
                    $('#id_ssmenu_' + ptype).find('input').val('except these people...');
                }
                if (ptype == 4 && $('#id_ssmenu_' + ptype).find('input').css('display') == 'none' && $('#id_ssmenu_' + ptype).find('input').val() == '')
                {
                    $('#id_ssmenu_' + ptype).find('input').val('enter user name');
                }

                //$('#id_smenu_sharewith').hide();
                var sptype = '';
                switch (ptype)
                {
                    case '0':
                        sptype = 'everyone';
                        break;
                    case '1':
                        sptype = 'friends and followers';
                        break;
                    case '2':
                        sptype = 'only friends';
                        break;
                    case '3':
                        sptype = 'only family';
                        break;
                    case '4':
                        sptype = 'only someone...';
                        break;
                    case '5':
                        sptype = 'private';
                        break;
                }
                $('#id_a_share_with').html(sptype);
            });
        }

        //show/hide input or txtarea for answer
        if ($('.cl_add_answ_inp').unbind('click'))
        {
            $('.cl_add_answ_inp').click(function ()
            {
                var mid = $(this).attr('mid');
                $('.add-comment-in2').hide();
                $('.add-comment-in').show();
                $('#id_add_new_answ_inp_' + mid).hide();
                $('#id_add_new_answ_txtar_' + mid).show();
            });
        }

        //navigation of the right friends list
        if ($('.cl_fr_list_recent').unbind('click'))
        {
            $('.cl_fr_list_recent').click(function ()
            {
                $('#id_eclipse_img_bckgrnd').show();	//show eclipsed background

                var sb = $(this).attr('sb');
                var str = $('#id_inb_fr_rlist_find').val();
                if (!str || 'Find user...' == str) str = '';

                var cobj = $(this);

                if ('undefined' != sb)
                {
                    $.post(siteAdr + 'inbox/chngfrlistajax', {
                        'sb': sb,
                        'str': str,
                        'ajaxinit': 1
                    }, function(r)
                    {
                        if ('not_success' != r)
                        {

                            $('#id_inb_fr_rlist_find').attr({
                                'sb': sb
                            });

                            $('.cl_fr_list_recent').css({
                                'color': '#324373'
                            });

                            $(cobj).css({
                                'color': '#000',
                                'href': 'javascript: void(0);'
                            });

                            $(cobj).addClass('act');

                            $('.cl_fr_list_recent').removeClass('act');

                            $('#id_inb_fr_rlist').html(r);
                            oIWall._initListeners();
                            $('#id_eclipse_img_bckgrnd').hide();	//hide eclipsed background


                        }
                    });
                }
            });
        }

        //init Friends AutoComplete
        if ($('#id_inb_fr_rlist_find').unbind('keyup'))
        {
            $('#id_inb_fr_rlist_find').keyup(function()
            {
                var sb = $(this).attr('sb');
                var str = $(this).val();
                if (!str || 'Find user...' == str) str = '';

                var cobj = $(this);
                if ('undefined' != sb)
                {
                    $.post(siteAdr + 'inbox/chngfrlistajax', {
                        'sb': sb,
                        'str': str,
                        'ajaxinit': 1
                    }, function(r)
                    {
                        if ('not_success' != r)
                        {
                            $('#id_inb_fr_rlist').html(r);
                            oIWall._initListeners();
                        }
                    });
                }
            });
        }

        //show/hide input or txtarea for answer
        if ($(".cl_rlist_fr_el").unbind('click'))
        {
            $('.cl_rlist_fr_el').click(function ()
            {
                var fr_uid = $(this).attr('fr_uid');
                if (fr_uid)
                {
                    $('.cl_rlist_fr').removeClass('act');
                    $(this).parents('li').addClass('act');
                    oIWall.GetList(fr_uid, 0, 1);
                }
            });
        }

        //init Upload Photo objects
        if (!ufy_ready)
        {
            ufy_ready = true;
            $('#ufy_plch').uploadify({
                'uploader'      : flDir + 'uploadify.swf',
                'script'        : siteAdr + 'inbox/chkuplphoto/?pcash=' + rand(1, 10000),
                'fileDataName'  : 'Filedata',
                'auto'          : false,
                'multi'         : true,
                'queueID'       : 'ufy_plch_list',
                'fileDesc'      : 'Images',
                'fileExt'       : '*.jpeg;*.jpg;*.png;*.gif',
                'sizeLimit'     :  10 * 1024 * 1024,
                'buttonImg'     : imgDir + 'browse2.png',
                'cancelImg'     : imgDir + 'close_ico.gif',
                'queueSizeLimit': 3,
                'width'         : 79,
                'height'        : 25,
                onComplete : function(event, queueID, fileObj, response, data)
                {
                    response = jQuery.parseJSON(response);
                    if (response.status == 'success')
                    {
                        //alert( response.image );
                        oIWall.CreateLinkUploaded(response.image);
                    }

                    if (response.status == 'err')
                    {
                        alert('Error happened :( ');
                    }
                },
                onAllComplete: function ()
                {
                    $('#id_send_block_mes, #id_uploaded_photo_choose_file').show();
                    $('#id_send_block_photo_choose_file, #id_uploaded_mes').hide();
                    $('.share-white-b').show();
                    $('#ufy_plch_list').html('');
                    //oWall.ChngSendBlock( 'mes' );
                },

                onSelectOnce: function()
                {
                    $('#ufy_block_ab').attr('src', '/i/add_b2_act.gif');
                },
                onCancel: function()
                {
                    var nch = $('#ufy_plch_list').children().length;
                    if (nch <= 1) $('#ufy_block_ab').attr('src', '/i/add_b2.gif');
                }
            });
        }

        if ($(".cl_add_filt_privacy_el").unbind('click'))
        {
            $('.cl_add_filt_privacy_el').click(function ()
            {
                $('#id_eclipse_img_bckgrnd').css({
                    'display': 'block',
                    'z-index': 9999
                });	//show eclipsed background
                var ptype = $(this).attr('ptype');
                var txt = $(this).html();
                $('#id_add_filt_frm_ptype').val(ptype);
                $('#id_add_filt_frm_send_ptype').val(ptype);
                var options = {
                    cache: true,
                    mode: 'abort',
                    port: 'addmes',
                    data: {
                        'ajaxinit': 1
                    },
                    success: function(r)
                    {
                        if ('not_success' != r)
                        {
                            $('#id_add_filt_us_list').html(r);

                            $('.cl_add_filt_listing').hide();
                            $('#id_add_filt_ptype_label').html(txt);
                            setTimeout('$(\'#id_eclipse_img_bckgrnd\').css({\'display\': \'none\', \'z-index\': 9999})', 200);
                        }
                    }
                };
                $('#id_add_filt_frm').ajaxSubmit(options);
            });
        }

        if ($(".cl_add_filt_mtype_el").unbind('click'))
        {
            $('.cl_add_filt_mtype_el').click(function ()
            {
                var mtype = $(this).attr('mtype');
                var txt = $(this).html();
                $('#id_add_filt_frm_send_mtype').val(mtype);
                $('.cl_add_filt_listing').hide();
                $('#id_add_filt_mtype_label').html(txt);
            });
        }

        //init CRAND	//random number for photos
        crand = rand(1, 100000);
    }, /* initListeners */

    CheckInboxAjax: function ()
    {
        $("#id_mes_list").everyTime(15000, function(i)
        {
            pid = $('#id_add_mes_user_id').val();

            var last_id = 0;
            $('.message-box').each(function()
            {
                last_id = $(this).attr('aid');
            });

            $.ajax({
                type: 'GET',
                cache: false,
                dataType: 'json',
                url: siteAdr + 'inbox/checkinboxajax?last_id=' + last_id + '&pid=' + pid,
                success: function(r)
                {
                    if (r.res)
                    {
                        $('#id_mes_list').html($('#id_mes_list').html()+r.res);
                        //$('#id_mes_list').html(r.res);
                    }
                }
            });
        });
    },


    CloseButton: function ()
    {
        oIWall.enableNAL();
        oIWall.ChngSendBlock('mes');
    },


    /**
     * Change type of sending Message (Change Form & Elements)
     *
     * @param smtype ('ev'-event, 'link'-link, 'photo'-photo, 'video'-video)
     */
    ChngSendBlock: function (smtype)
    {
        $('.cl_send_block').hide();
        $('#ufy_plch_list').html('');
        var attached = $('#id_place_to_attach: input').html();
        if (attached)
        {
            $('#id_send_block_' + smtype).html(attached);
        }

        $('#id_send_block_' + smtype).show();
        NFFix();
    }, /* ChngSendBlock */

    /**
     * Attach blocks with Enclose while the Message is adding
     *
     * @param smtype ('link'-link, 'photo'-photo, 'video'-video)
     */
    AttachBlock: function (smtype)
    {
        if ('ev' == smtype)
        {
            oIWall.ChckEvDate('id_send_inp_ev_dt');
        }
        if ('video_code' == smtype)
        {
            $('#id_send_inp_video_code_link').val($('#id_send_txt_video_code_link').val());
        }
        $('.cl_err').html('');

        var n_data = oIWall._initNecData(smtype);	//init necessary data

        if (null != n_data)
        {
            /* hide buttons */
            $('.photo_button, .video_button, .link_button').css('opacity', '0.4');


            var errs = new Array();
            var cnt_ndata = n_data.length;
            for (j = 0; j < cnt_ndata; j++)
            {
                var n_inp_val = '';
                if ('video_code' == smtype)
                    n_inp_val = $('#id_send_txt_video_code_link').val()
                else
                    n_inp_val = $('#id_send_inp_' + smtype + '_' + n_data[j]).val();

                if ('link' == smtype)     //check link
                {
                    if (verify_url(n_inp_val))
                    {
                        vrf_link = true;
                        $.ajax({
                            type:     'POST',
                            dataType: 'json',
                            data:     "link=" + n_inp_val + "&ajaxinit=1",
                            url:      siteAdr + 'profile/wall/getlinkinfoajax',
                            success: function (data)
                            {
                                if (data.q == 'ok')
                                {
                                    if ('' != data.title && 'OpenDNS' != data.title)
                                    {
                                        $('#id_uploaded_link_lable').html(data.title.substring(0, 57) + (57 <= data.title.length ? '...' : ''));
                                    } else
                                    {
                                        $('#id_uploaded_link_lable').html(data.link);
                                    }
                                    $('#id_uploaded_link_lable').attr({
                                        'href': data.link,
                                        'target': 'blank'
                                    });
                                } else
                                {
                                    alert('Incorrect link');
                                    return false;
                                }
                            }
                        });
                    } else
                    {
                        alert('Incorrect link');
                        return false;
                    }
                }
                else if ('video_code' == smtype)
                {    //check video
                    var vrf_link = verify_embed_code(n_inp_val, 300, 200);
                    if (vrf_link)
                    {
                        //$('#id_send_inp_video_code_link').val(vrf_link);
                        $('#v_code').val(vrf_link);
                        $.get(siteAdr + 'base/valbums/getevideoiajax', {
                            'video': vrf_link,
                            'ajaxinit': 1
                        }, function(r)
                        {
                            if ('not_success' != r)
                            {
                                $('#id_img_video_code').attr({
                                    'src': r
                                });
                            }
                            else
                            {
                                $('#id_img_video_code').attr({
                                    'src': imgDir + 'no_photo_m56.jpg'
                                });
                                $('#id_img_video_code').css({
                                    'width': '32px',
                                    'height': '25px'
                                });
                                $('#id_uploaded_video_code_lable').html('Video code is undefined...');
                            }
                        });
                    }
                    else
                    {
                        alert('Invalid code. Please, enter correct embed code.');
                        return false;
                    }
                }
                else if ('photo_url' == smtype)
                {    //check photo link
                    var vrf_link = verify_url(n_inp_val);
                    if (!vrf_link)
                    {
                        alert('Invalid link.');
                        return false;
                    }
                }
                else if (null != n_inp_val && '' != n_inp_val)
                {
                    var vrf_link = true;
                }

                if (!vrf_link || false == vrf_link || 'undefined' == vrf_link)
                {
                    $('#id_err_' + smtype + '_' + n_data[j]).html('*');	//error Exception
                    errs.push(n_data[j]);
                }
            }

            if (!errs.length)
            {
                retCont = $('#id_send_frm_' + smtype).html();
                retId = 'id_send_frm_' + smtype;
                var att_block = $('#id_send_frm_' + smtype + ': input').wrapInner();
                if ('photo_url' == smtype)
                {
                    $('#id_img_photo_url').attr({
                        'src': att_block[1].value
                    });
                    $('#id_uploaded_' + smtype + '_lable').attr({
                        'href': att_block[1].value
                    });
                }
                else if ('ev' == smtype)
                {
                    $('#id_uploaded_ev_lable').html($('#id_send_inp_ev_title').val() + ' at ' + $('#id_send_inp_ev_where').val() + ' on ' + $('#id_send_inp_ev_dt').val());
                }

                $('#id_place_to_attach').html(att_block);
                $('#id_uploaded_mes').hide();
                $('#id_uploaded_' + smtype).show();
                oIWall.ChngSendBlock('mes');	//redirect to the mes module
            }
        }
        else
        {
            var att_block = $('#id_send_frm_' + smtype + ': input').wrapInner();

            $('#id_place_to_attach').html(att_block);
            oIWall.ChngSendBlock('mes');	//redirect to the mes module
        }
    }, /* AttachBlock */

    /**
     * Create new Message
     *
     * @param id_frm - form, which is submitted
     */
    AddMes: function (id_frm)
    {
        //$('#id_eclipse_img_bckgrnd').show();

        var options = {
            cache: true,
            mode: 'abort',
            port: 'addmes',
            data: {
                'ajaxinit': 1
            },
            dataType: 'json',
            success: function(r)
            {

                if ('not_success' != r.q)
                {
                    if (r.q == 'blocked')
                    {
                        alert('Messaging system blocked for this user');
                        oIWall.enableNAL();
                        oIWall._initInterface();	//refresh Interface
                    } else
                    {
                        $('#id_div_empty_mes').remove();
                        //$('#id_mes_list').html(r.data + $('#id_mes_list').html());
                        $('#id_mes_list').html($('#id_mes_list').html()+ r.data);
                        
                        $('#id_send_inp_mes_story').val('');

                        $('#id_mes_list').show();

                        $('.del-message, .del-message-link').show();

                        //$('.nav_attach_links').css('visibility', 'visible');
                        oIWall.enableNAL();
                        oIWall._initInterface();	//refresh Interface
                    }
                }
                setTimeout('$(\'#id_eclipse_img_bckgrnd\').hide();', 300);
            }
        };

        var errs = new Array();

        var att_frm = $('#id_place_to_attach').html();
        var mes_story = $('#id_send_inp_mes_story').val();
//        var reg = /Send an instant message/i;
        var reg = /Type your message/i;

        var smile = $('#id_iframe_txt').contents().find('body').find('font').html();
	var smile_codee = $('#id_iframe_txt').contents().find('body').html();

        if ( smile == null && smile_codee != '')
            {
                $('#id_send_inp_mes_story').val(smile_codee);
                mes_story = smile_codee;
            }

        if ('' == att_frm && (reg.test(mes_story) || mes_story == ''))
        {
            $('#id_err_mes_story').html('*');	//error Exception
            errs.push(1);
        }
        else if (reg.test(mes_story))
        {
            mes_story = '';
        }

        //$('#id_send_inp_mes_story').val(mes_story);
        if (!errs.length)
        {
            $('#' + id_frm).ajaxSubmit(options);

            var selectedColor = $('#id_iframe_txt').contents().find('body').find('span').css('color');
            oIWall.defColor = selectedColor;

            $('#id_place_to_attach').html('');
            $('#id_ul_upl_photo li').remove();
        }
        else
        {
            $('#id_eclipse_img_bckgrnd').hide();
        }

    }, /* AddMes */

    /**
     * Create new Answer on the Message
     *
     * @param id - Message ID
     */
    AddMesAnsw: function (id)
    {
        var options = {
            cache: true,
            mode: 'abort',
            port: 'addmesansw',
            data: {
                'ajaxinit': 1
            },
            success: function(r)
            {
                if ('not_success' != r)
                {
                    $('#id_mes_answ_list_' + id).html(r + $('#id_mes_answ_list_' + id).html());
                    $('.add-comment-in2').hide();
                    $('.add-comment-in').show();
                    oIWall._initInterface();	//refresh Interface
                }
            }
        };
        $('#id_frm_add_mes_answ_' + id).ajaxSubmit(options);
    },  /* AddMesAnsw */

    EditMes: function (act, frm)
    {
        var options = {
            cache: true,
            mode: 'abort',
            port: 'editmes',
            data: {
                'ajaxinit': 1
            },
            success: function(r)
            {
                if ('not_success' != r)
                {
                    if (1 == act)
                        $('.cl_mes:first').before(r);
                    oIWall._initListeners();	//refresh Listeners
                }
            }
        };
        $('#' + frm).ajaxSubmit(options);
    }, /* EditMes */

    DelMes: function (mes_id, fr_id)
    {
        if (!mes_id) mes_id = '';
        if (!fr_id) fr_id = '';
        $.post(siteAdr + 'inbox/delallajax', {
            'mes_id': mes_id,
            'fr_id': fr_id,
            'ajaxinit': 1
        }, function(r)
        {
            if ('not_success' != r)
            {
                if (mes_id)
                {
                    $('#id_wall_mes_' + mes_id).hide();
                }
                else
                {
                    $('#id_mes_list').html('<div id="id_div_empty_mes"><div class="box001"><div class="post-box">Entries are absent</div></div></div>');
                    $('.more_mes_list').hide();
                    $('#id_div_show_more_mes').hide();
                    $('.del-message').hide();
                    $('#id_mes_list').show();
                }

            }
        });

    },

    EditMesAnsw: function (mid)
    {
        if (mid)
        {
            var options = {
                cache: true,
                mode: 'abort',
                port: 'editmesansw',
                data: {
                    'ajaxinit': 1
                },
                success: function(r)
                {
                    if ('not_success' != r)
                    {
                        $('.cl_mes:first').before(r);
                        oIWall._initListeners();	//refresh Listeners
                    }
                }
            };
            $('#' + frm).ajaxSubmit(options);
        }
    }, /* EditMesAnsw */

    /* Smile Tab */
    AddSmileTab: function (id) {
    if (!id)
        {
            $('#show_smile_tab').slideToggle('fast');
            $("#show_smile_tab").mouseout(function() {
                  $(this).hide();
                });
            $("#show_smile_tab").mouseover(function() {
                $(this).show();
            });
        }
        else
        {
            $('#show_smile_tab_comment_'+id).slideToggle('fast');
            $('#show_smile_tab_comment_'+id).mouseout(function() {
                    $(this).hide();
                });
            $('#show_smile_tab_comment_'+id).mouseover(function() {
                $(this).show();
            });
        }
    },  /* AddSmileTab */

    /**
     * Get List of Messages and Answers
     *
     * @param last_id - last id
     * @param sf - filter of the showing data
     */
    GetList: function (user_id, last_id, new_item)
    {
        //if sf2 -> sf = mtype ; sf2 = ptype;
        if (user_id)
        {
            if (null == last_id || 'undefined' == last_id)
                var last_id = 0;

            $('#id_eclipse_img_bckgrnd').css({
                'display': 'block'
            });	//show eclipsed background

            $.ajax({
                type: 'GET',
                cache: true,
                mode: 'abort',
                dataType: 'json',
                port: 'getmeslist',
                data: {
                    'user_id': user_id,
                    'last_id': last_id,
                    'new': new_item,
                    'ajaxinit': 1,
                    up_time: rand(999, 99999999)
                },
                url: siteAdr + 'inbox/getlistajax',
                success: function(r)
                {
                    if ('not_success' != r)
                    {
                        $('#id_add_mes_user_id').val(user_id);

                        if (new_item)
                        {
                            $('#id_inb_wall').html(r[0]);
                        } else
                        {
                            //$('#id_mes_list').html($('#id_mes_list').html() + r[0]);
                            $('#id_mes_list').html(r[0]+$('#id_mes_list').html());
                        }

                        if (2 == r[1])
                        {
                            $('#id_inb_top_mes_menu').hide();
                            $('#id_inb_top_menu_block_i').show();
                        }
                        else
                        {
                            $('#id_inb_top_mes_menu').show();
                            $('#id_inb_top_menu_block_i').show();
                        }

                        if (!r[2])
                            $('#id_div_show_more_mes').hide();
                        else
                            $('#id_div_show_more_mes').show();
                    }

                    setTimeout('$(\'#id_eclipse_img_bckgrnd\').css({\'display\': \'none\'})', 200);	//show eclipsed background
                    oIWall._initListeners();	//refresh Listeners
                }
            });
        }
    },

    GetListMore: function (uid)
    {
        //oIWall.GetList(uid, $('.message-box:last').attr('aid'), 0);
        oIWall.GetList(uid, $('.message-box:first').attr('aid'), 0);
    },


    /**
     * Get List of Messages and Answers
     *
     * @param pcnt - start index of the element
     * @param rcnt - end index of the element
     */
    GetAnswList: function (uid, mid, pcnt, rcnt)
    {
        $.ajax({
            type: 'GET',
            cache: true,
            mode: 'abort',
            port: 'getanswlist',
            data: {
                'mid': mid,
                'apcnt': pcnt,
                'arcnt': rcnt,
                'ajaxinit': 1
            },
            url: siteAdr + 'id' + uid + '/wall/getanswlistajax',
            success: function(r)
            {
                if ('not_success' != r)
                {
                    $('#id_mes_answ_list_' + mid).html($('#id_mes_answ_list_' + mid).html() + r);
                    $('#id_div_show_more_answ_' + mid).hide();
                    oIWall._initListeners();	//refresh Listeners
                }
            }
        });
    },

    SHFilterPopup: function (action, id_popup)
    {
        if (1 == action)    //show
        {
            if ($('#' + id_popup).fadeIn(300))
                $('#id_eclipse_bckgrnd').show();	//show eclipsed background
        }
        else
        {
            if ($('#' + id_popup).fadeOut(300))
                $('#id_eclipse_bckgrnd').hide();	//hide eclipsed background
        }
    }, /* SHUplPopup */

    EditFilter: function (id_frm)
    {
        var name = $('#id_add_filt_frm_send_name').val();
        if ('Enter new filter name' == name || '' == name || 2 > name.length)
            var err = 1;
        var options = {
            data: {
                'ajaxinit': 1
            },
            success: function(r)
            {
                if ('not_success' != r)
                {
                    Go(siteAdr + 'id' + UserOtherID);
                }
            }
        };
        if (!err)
            $('#' + id_frm).ajaxSubmit(options);
    }, /* SHUplPopup */

    DelFilter: function (id)
    {
        $.post(siteAdr + 'profile/wall/delfiltajax', {
            'fid': id,
            'ajaxinit': 1
        }, function(r)
        {
            if ('not_success' != r)
            {
                $('#id_filter_li_el_' + id).hide();
            }
        });
    }, /* DelFilter */




    //---- Additional Methods

    /**
     * Check Events Dates Format
     * Set in Necessary field correct type of data
     */
    ChckEvDate: function (id_field)
    {
        var objEvDate = new Object();
        objEvDate.month = $('select[name=Date_Month]').attr('value');
        objEvDate.day = $('select[name=Date_Day]').attr('value');
        objEvDate.year = $('select[name=Date_Year]').attr('value');
        objEvDate.hour_min_meridian = $('#id_time_hour_min_meridian').attr('value');

        var strEvDate = objEvDate.month + '/' + objEvDate.day + '/' + objEvDate.year + ' ' + objEvDate.hour_min_meridian;
        //var strEvDate =  objEvDate.day + '/' + objEvDate.month + '/' + objEvDate.year + ' ' + objEvDate.hour_min_meridian;
        $('#' + id_field).val(strEvDate);
    }, /* ChckEvDate */

    /**
     * Create new Answer on the Message
     *
     * @param id - Flash Button ID
     */
    UplPhoto: function(smtype)
    {
        var p_img = $('#id_send_frm_' + smtype + ': input[p_img]');	//count of the elements
        var p_img = p_img.length;

        if ($('#ufy_plch_list').children().length > 0)
        {
            $('#ufy_plch').uploadifySettings('scriptData', {
                'omni3id' : SSesID
            });
            $('#ufy_plch').uploadifyUpload();

            $('#ufy_plch').hide();
            $('.share-white-b').hide();
        }
        else
        {
            alert('Please, choose photos');
            return false;
        }

    }, /* UplPhoto */

    CreateLinkUploaded: function(image_src)
    {
        var p_img_src = image_src;
        /*$(p_img[i]).val();*/
        var li = document.createElement('li');
        var img = document.createElement('img');
        img.src = fImgDir + 'inbox/_temp/' + p_img_src;
        img.width = 33;
        img.height = 25;
        var a = document.createElement('span');
        a.innerHTML = p_img_src.substring(0, 10) + ((10 < p_img_src.length) ? '...' : '');
        $(a).css('color', 'white');
        $(li).addClass('min12');
        $(img).css('position', 'static').css('float', 'left');
        $(li).append($(img));
        $(li).append($(a));
        $('#id_ul_upl_photo').append(li);

        if ($('#id_place_to_attach').find('#s_mtype').length == 0)
            $('#id_place_to_attach').append('<input type="hidden" name="WI[mtype]" value="4" />');

        $('#id_place_to_attach').append('<input value="' + image_src + '" name="WI[p_img][]" />');
    },

    UplPhotoComplete: function (smtype)
    {

    },

    /**
     * Create Links & Images of the uploaded Photos
     */
    CrLinksUplData: function(smtype)
    {

    }, /* CrLinksUplData */

    ChkVideo : function(id)
    {
        document.location = siteAdr + '';
        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: {
                'id':id,
                'ajaxinit': 1
            },
            url: siteAdr + 'id' + UserOtherID + '/wall/chckvideoajax',
            success: function (r)
            {
                if ('not_success' != r)
                {
                    if (r['vi'])
                    {
                        document.location = siteAdr + '';
                    }
                    else
                    {
                        setTimeout('oIWall.ChkVideo(' + r['id'] + ')', 1000);
                    }
                }
            }
        });
    }
}

var oIWall = new IWall();