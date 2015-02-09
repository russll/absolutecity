/**
 * Wall jsController
 * 
 * @package    5dev Wall
 * @version    1.0
 * @since      1.03.2010
 * @copyright  2010 5dev Team
 * @link       http://5dev.com
 */

function Wall() { 
    this.__construct( );
}

Wall.prototype = { 
    __construct: function() {
        crand = rand(999, 99999999);	//special numer for photo & video
        retCont = '';
        retId   = '';
        showed  = {
            'ev': 0,
            'link': 0
        };
        fileStyled = false;
        ufy_ready = false;
        invalid_video = false;
        evNextYear = false;
    }, /* __construct */
	
    //---- System Methods
	
    /**
	 * Initialization of the Interfaces
	 */
    _initInterface: function () {
        oWall._initDefaultParams();
        oWall._initListeners();
    },  /* initInterface */

    _initDefaultParams: function () {
        $('.cl_send_block').css({
            'display': 'none',
            'visibility': 'visible'
        });
        $('.cl_attached_block').css({
            'display': 'none'
        });
        $('#id_send_block_mes').show();
        $('#id_uploaded_mes').show();
        $('#id_main_btn_share').show();
        $('#id_smenu_sharewith2').hide();
        $('#id_send_inp_mes_story').css('color', 'gray');
        $('#id_send_frm_descr_ta').css('color', 'gray');
        $('#id_send_frm_descr_ta').val('Enter description');
        
        if (IS_USER)
        {
            $('#id_send_inp_mes_story').val('Share your thoughts');
        }
        else
        {
            $('#id_send_inp_mes_story').val('Post something on this wall');
        }

        $('.cl_a_btn_share').attr({
            'href': 'javascript: oWall.AddMes( \'id_frm_add_mes\' );'
        });

        //$('#id_send_block_mes').css({'background': 'url('+imgDir+'share_bg.gif) no-repeat 100% 0; width:492px; height:130px;',
        //				 'padding': '1px 2px 1px 8px'});
        $('.cl_answ_story').val('');
        
        if (retCont && retId)
        {
            $('#id_place_to_attach').html();
            $('#'+retId).html(retCont);
            redId = '';
            retCont = '';
            NFFix();
        }
        $('#id_send_inp_ev_title, #id_send_inp_ev_where').val('');

        //clear privacy
        $('#id_add_mes_privacy').val(0);
        $('#id_add_mes_sub_module').val(0);
        $('#id_add_mes_sub_module_val').val(0);
        $('#id_add_mes_sub_class').val(0);
        $('.sw_someone').val('enter user name');

        $('#id_a_share_with').html('everyone');
        $('#id_send_block_mes').css({
            'background': 'url('+imgDir+'share_bg.gif) no-repeat',
            'padding-left': '8px',
            'width': '492px',
            'height': '130px'
        });

        $('.everyone-bot').children('ul').find('li').removeClass('grey');
        $('.cl_sub_menu').css('color', '');
        $('.cl_ssmenu').hide();
    },  /* initDefaultParams*/
	
    /**
	 * Initialization of the Necessaries To Complete Fields
	 * 
	 * @param smtype ('ev'-event, 'link'-link, 'photo'-photo, 'video'-video) 
	 */
    _initNecData: function ( smtype ) {
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
            /*case 'badge':
                this.n_data = new Array('sub_mtype','story','b_img_name');
                break;*/
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
    _initListeners: function () {
        FavHover();
        $('#id_send_frm_ev input, #id_send_frm_ev select').change(oWall.EvInpCheck);
        $('#id_send_frm_ev input, #id_send_frm_ev select').keyup(oWall.EvInpCheck);

        $('#id_send_inp_link_url').keyup(function(){
            if ($(this).val().length > 0) $('#link_add_button').attr('src',imgDir +  'add_b2_act.gif'); else $('#link_add_button').attr('src',imgDir +  'add_b2.gif');
        });

        //check maxlength of the TextArea && enable buttons to send
        $('#id_send_inp_mes_story').change(function(){
            if($('.cl_img_btn_share').attr('src') == imgDir + 'share_b.gif')
            {
                $('#id_send_inp_mes_story').trigger('keypress');
            }
        });

        /* "enable\disable" add-button in link section dependent on character's length */
        if ($('#send_photo_link').val() && $('#send_photo_link').val().length > 0) $('#send_photo_link').attr('src', imgDir + 'add_b2_act.gif'); else $('#send_photo_link').attr('src', imgDir + 'add_b2.gif');
        $('#id_send_inp_photo_url_link').keyup(function() {
            if ($(this).val().length > 0) $('#send_photo_link').attr('src', imgDir + 'add_b2_act.gif'); else $('#send_photo_link').attr('src', imgDir + 'add_b2.gif');
        });


        $('#id_send_inp_mes_story').keyup(function(){
            $('#id_send_inp_mes_story').css('color', 'black');
            var max = parseInt($(this).attr('maxlength'));
            if($(this).val().length > max)
            {
                //$(this).val($(this).val().substr(0, $(this).attr('maxlength')));
                $('#id_refill_txt_ntf').show();
                //$('.cl_a_btn_share').attr({ 'href': 'javascript: void(0)' });
                $('.cl_img_btn_share').attr({
                    'src': imgDir + 'share_b.gif'
                });
                $('#id_share_attention').show();
                $('#id_share_with').hide();
            }
            else
            {
                $('#id_refill_txt_ntf').hide();
                var attached = $('#id_place_to_attach: input');
					
                if ('' == $('#id_send_inp_mes_story').val() && 0 == attached.length)
                {
                    $('.cl_img_btn_share').attr({
                        'src': imgDir + 'share_b.gif'
                    });
                /*$('.cl_a_btn_share').attr({
                            'href': 'javascript: void(0);'
                        });*/
                }
                else
                {
                    $('.cl_img_btn_share').attr({
                        'src': imgDir + 'share_b_act.gif'
                    });
                }

                $('#id_share_attention').hide();
                $('#id_share_with').show();

                if ($('#id_send_inp_mes_story').unbind('keydown'))
                {
                    $('#id_send_inp_mes_story').keydown(function(e) {

                        var code = (e.keyCode ? e.keyCode : e.which);
                        if(code == 13 && e.ctrlKey)
                        {
                            var str = $('#id_send_inp_mes_story').val();
                            if(str != 'Share your thoughts' && str != '')
                            {
                                oWall.AddMes( 'id_frm_add_mes' );
                            }
                        }
                    });
                }
            }
        //$(this).parent().find('.charsRemaining').html('You have ' + (max - $(this).val().length) + ' characters remaining');
        });
        //event buts activate
        if ($(".ev_field").unbind('keypress'))
        {
            $('.ev_field').keypress(function () {

                return;	/* Eugene */

                if($('#id_send_inp_ev_title').val() != '' && $('#id_send_inp_ev_where').val() != '' && checkTime( $('#id_time_hour_min_meridian').val() ) )
                {
                    $('.cl_img_btn_next').attr('src',imgDir + 'next_b2.gif');
                }
                else
                {
                    $('.cl_img_btn_next').attr('src',imgDir + 'next_b.gif');
                }
            });
        }

        //initialization of the Add Attach Navigation Bar
        if ($(".nav_attach_links").unbind('click'))
        {
            $('.nav_attach_links').click(function () {
                oWall.ChngSendBlock($(this).attr('mtype'));
            });
        }
        if ($('#id_send_frm_descr_ta').unbind('click'))
        {
            $('#id_send_frm_descr_ta').click(function () {
                if($('#id_send_frm_descr_ta').val() == 'Enter description')
                {
                    $('#id_send_frm_descr_ta').val('');
                    $('#id_send_frm_descr_ta').css('color', 'black');
                }
            });
        }
        if ($('#id_send_frm_descr_ta').unbind('keypress'))
        {
            $('#id_send_frm_descr_ta').keypress(function () {
                if($('#id_send_frm_descr_ta').val() != '' && $('#id_send_frm_descr_ta').val() != 'Enter description')
                {
                    $('.cl_img_btn_add').attr('src',imgDir + 'add_b2_act.gif');
                }
                else
                {
                    $('.cl_img_btn_add').attr('src',imgDir + 'add_b2_act.gif');
                }
            });
        }
		
        //Set privacy type (share with)
        if ($(".cl_a_share_with").unbind('click'))
        {
            $('.cl_a_share_with').click(function () {
                var ptype = $(this).attr('ptype');
                $(this).parent().parent('ul').find('li').removeClass('grey');
                $(this).parent('li').addClass('grey');
                $('.cl_sub_menu').css('color', '');
                $('#id_add_mes_privacy').val(ptype);
                $('.cl_ssmenu').hide();

                //-- if submenu is existed
                if ($('#id_ssmenu_'+ptype).find('li').length > 0 || $('#id_ssmenu_'+ptype).find('input').length > 0)
                {
                    $('#id_ssmenu_'+ptype).slideToggle();
                }
                else
                {
                    $('#id_smenu_sharewith2').hide();
                }

                if(ptype == 0 && $('#id_ssmenu_'+ptype).find('input').css('display') == 'none' && $('#id_ssmenu_'+ptype).find('input').val() == '')
                {
                    $('#id_ssmenu_'+ptype).find('input').val('except these people...');
                }
                if(ptype == 4 && $('#id_ssmenu_'+ptype).find('input').css('display') == 'none' && $('#id_ssmenu_'+ptype).find('input').val() == '')
                {
                    $('#id_ssmenu_'+ptype).find('input').val('enter user name');
                }
          
                //$('#id_smenu_sharewith').hide();
                var sptype = '';
                var sbckgrnd = 'share_bg.gif';
                switch (ptype)
                {
                    case '0':
                        sptype = 'everyone';
                        sbckgrnd = 'share_bg.gif';
                        break;
                    case '1':
                        sptype = 'friends and followers';
                        sbckgrnd = 'share_bg02.gif';
                        break;
                    case '2':
                        sptype = 'only friends';
                        sbckgrnd = 'share_bg03.gif';
                        break;
                    case '3':
                        sptype = 'only family';
                        sbckgrnd = 'share_bg04.gif';
                        break;
                    case '4':
                        sptype = 'only someone...';
                        sbckgrnd = 'share_bg05.gif';
                        break;
                    case '5':
                        sptype = 'private';
                        sbckgrnd = 'share_bg06.gif';
                        break;
                }
				
                $('#id_send_block_mes').css({
                    'background': 'url('+imgDir+sbckgrnd+') no-repeat',
                    'padding-left': '8px',
                    'width': '492px',
                    'height': '130px'
                });
                $('#id_a_share_with').html(sptype);
            });
        }
		
        //Set sub privacy type (share with)
        if ($(".cl_sub_menu").unbind('click'))
        {
            $('.cl_sub_menu').click(function () {
                var submodule     = $(this).attr('submodule');
                var submodule_val = $(this).attr('submodule_val');
                $('#id_add_mes_sub_module').val(submodule);
                $('#id_add_mes_sub_module_val').val(submodule_val);

                $(this).parent().parent('ul').find('a').css('color', '');
                $(this).css('color', 'gray');
                
                if(submodule_val == 5)
                {
                    var submodule_class = $(this).attr('submodule_class');
                    $('#id_add_mes_sub_class').val(submodule_class);
                }
                
                $('#id_smenu_sharewith').hide();
                //$('.cl_ssmenu').hide();
                $('#id_smenu_sharewith2').hide();

                var s = $('#id_a_share_with').html();
                if ( s.indexOf('...') === -1 ) {
                    $('#id_a_share_with').html($('#id_a_share_with').html() + '...');
                }
            });
        }
		
        //show/hide input or txtarea for answer
        if ($(".cl_add_answ_inp").unbind('click'))
        {
            $('.cl_add_answ_inp').click(function () {
                var mid = $(this).attr('mid');
                $('.add-comment-in2').hide();
                $('.add-comment-in').show();
                $('#id_add_new_answ_inp_'+mid).hide();
                $('#id_add_new_answ_txtar_'+mid).show();
                $('#id_add_new_answ_txtar_b'+mid).focus();
                //re-init expander
                jQuery("textarea[class*=expand]").TextAreaExpander();
            });
        }
		
        //init Upload Photo objects

        if (!ufy_ready)
        {
            ufy_ready = true;
			
            $('#ufy_plch').uploadify({
                'uploader'      : flDir+ '/uploadify.swf',
                'script'        : siteAdr+'id'+UserOtherID+'/wall/chkuplphoto/?pcash='+rand(1, 10000),
                'fileDataName'  : 'Filedata',
                'auto'          : false,
                'multi'         : true,
                'queueID'       : 'ufy_plch_list',
                'fileDesc'      : 'Images',
                'fileExt'       : '*.jpeg;*.jpg;*.png;*.gif',
                'sizeLimit'     :  10 * 1024 * 1024,
                'buttonImg'     : imgDir+'browse2.png',
                'cancelImg'     : imgDir+'close_ico.gif',
                'queueSizeLimit': 3,
                'width'         : 79,
                'height'        : 25,
                onComplete : function(event,queueID,fileObj,response,data) {
				 
                    response = jQuery.parseJSON(response);
                    if (response.status == 'success')
                    {
                        //  alert('caught');
                        oWall.CreateLinkUploaded(response.image);
                    }

                    if (response.status == 'err') {
                        alert('Error happened :( ');
                    }
                },

                // onClearQueue:function() {$('#ufy_block_ab').attr('src', '/i/add_b2.gif');},
                onSelectOnce: function() {
                    $('#ufy_block_ab').attr('src', '/i/add_b2_act.gif');
                },
                onCancel: function() {
                    var nch = $('#ufy_plch_list').children().length;
                    if (nch <= 1) $('#ufy_block_ab').attr('src', '/i/add_b2.gif');
                },
				 
                onAllComplete: function () {
                    $('#id_send_block_mes, #id_uploaded_photo_choose_file').show();
                    $('#id_send_block_photo_choose_file, #id_uploaded_mes').hide();
                    $('.share-white-b').show();
                    $('#ufy_plch_list').html('');
                //oWall.ChngSendBlock( 'mes' );
                }

            });
        }

        //init Friends AutoComplete
        
        $('.sw_someone').autocomplete('/base/friends/frlistbynameajax?ajaxinit=1',
        {
            delay:        200,
            cacheLength:  7,
            minChars:     2,
            width:        295,
            formatItem:   oUsers.formatItem,
            formatResult: oUsers.formatItem
        }).result(function(e, item)
        {
            var directto = $(this).attr('directto');
            $('#'+directto).val(item[0]);
            $('#'+directto).attr({
                'submodule_val': item[0]
            });
            $('#id_add_mes_sub_module').val($('#'+directto).attr('submodule'));
            $('#id_add_mes_sub_module_val').val(item[0]);
            $(this).val(item[1]);
        });
		
        if ($(".cl_add_filt_privacy_el").unbind('click'))
        {
            $('.cl_add_filt_privacy_el').click(function () {
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
                    success: function(r) {
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

        //hide share panel
        $("#id_smenu_sharewith2").mouseout(function() {
            $(this).oneTime(100, 'hide_share', function() {
                $(this).hide();
            });
        });
        $("#id_smenu_sharewith2").mouseover(function() {
            $(this).stopTime('hide_share');
        });

        $("#id_smenu_sharewith2 input").blur(function() {
            $("#id_smenu_sharewith2").mouseout(function() {
                $(this).oneTime(100, 'hide_share', function() {
                    $(this).hide();
                });
            });
            $("#id_smenu_sharewith2").mouseover(function() {
                $(this).stopTime('hide_share');
            });
        });
        $("#id_smenu_sharewith2 input").focus(function() {
            $("#id_smenu_sharewith2").unbind('mouseout');
            $("#id_smenu_sharewith2").unbind('mouseover');
        });

    	
        if ($(".cl_add_filt_mtype_el").unbind('click'))
        {
            $('.cl_add_filt_mtype_el').click(function () {
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
	
    /**
	 * Change type of sending Message (Change Form & Elements)
	 * 
	 * @param smtype ('ev'-event, 'link'-link, 'photo'-photo, 'video'-video) 
	 */
    ChngSendBlock: function ( smtype ) {
        $('#ufy_plch_list').html('');
        if(smtype != 'mes')
        {
            $('#id_main_btn_share').hide();
        }
        else
        {
            $('#id_main_btn_share').show();
        }
        if ('ev' == smtype)
            oWall.ChckEvDate( 'id_send_inp_ev_dt' );
        $('.cl_send_block').hide();
        var attached = $('#id_place_to_attach: input').html();
        if (attached)
        {
            $('#id_send_block_'+smtype).html(attached);
        }
        
        $('#id_send_block_'+smtype).show();
        if ('ev' != smtype || !showed[smtype]) {
            NFFix();
        } else {
            $('.NFSelect').remove();
            NFFix();
        }
        if('descr'==smtype && !fileStyled)
        {
            $("#fileToUpload").filestyle({
                image: "/i/choose-file.gif",
                imageheight : 22,
                imagewidth : 82,
                width : 255
            });
            fileStyled = true;
        }
        if ('ev'==smtype) {
            showed[smtype]=1;
        }
    }, /* ChngSendBlock */

    EvInpCheck: function() {
        var valid = true;

        var title = $('#id_send_inp_ev_title').val();
        var where = $('#id_send_inp_ev_where').val();
		
        var date = new Date;

        var year	= date.getFullYear();
        var month	= $('select[name=Date_Month]').val();
        var day		= $('select[name=Date_Day]').val();
        var time	= $('#id_time_hour_min_meridian').val();

        var event_stamp = mktime(23,59,59, Number(month), Number(day), year);
        var cur_stamp = mktime();


        if (!title || !where || /*cur_stamp > event_stamp ||*/ !isDate(month, day, year) || !IsValidTimeS(time))
            valid = false;

        if (valid)
            $('.cl_img_btn_next').attr('src',imgDir + 'next_b2.gif');
        else
            $('.cl_img_btn_next').attr('src',imgDir + 'next_b.gif');

        return true;
    },

    AddEventButton: function() {

        var title = $('#id_send_inp_ev_title').val();
        var where = $('#id_send_inp_ev_where').val();

        if (!title)
            alert('Please, specify the "title" field');

        if (!where)
            alert('Please, specify the "where" field');

        var date = new Date;
		
        var year	= date.getFullYear();
        var month	= $('select[name=Date_Month]').val();
        var day		= $('select[name=Date_Day]').val();
        var time	= $('#id_time_hour_min_meridian').val();

        var event_stamp = mktime(23,59,59, Number(month), Number(day), year);
        var cur_stamp = mktime();

        if (cur_stamp > event_stamp)
        {
            //alert('You can not add events to date, which has already passed');
            evNextYear = true;
            alert('You have specified a date that has already passed. The event will be added next year');
        }
        else
            evNextYear = false;

        if (!isDate(month, day, year))
        {
            alert('Date is invalid. Please, specify correct date');
            return false;
        }

        if (!IsValidTime(time))
        {
            //alert('Time is invalid. Please, specify correct time');
            return false;
        }


        if( title != '' && where != '')
            oWall.ChngSendBlock( 'descr' );
    },
	
    /**
	 * Attach blocks with Enclose while the Message is adding
	 * 
	 * @param smtype ('ev'-event, 'link'-link, 'photo'-photo, 'video'-video)
	 */
    AttachBlock: function ( smtype ) {
        if ('ev' == smtype)
            oWall.ChckEvDate( 'id_send_inp_ev_dt' );
        else if ('video_code' == smtype)
            $('#id_send_inp_video_code_link').val($('#id_send_txt_video_code_link').val());

        $('.cl_err').html('');
        var n_data = oWall._initNecData( smtype );	//init necessary data

        if ('badge' == smtype)
        {
            var badge_store = $('#id_send_badge_b_story').val();
            if (badge_store == 'Enter badge text'||badge_store == '')
              {
                  alert('Please enter badge text.');
                  return;
              }
              else
              {
                  if ($('#select_badge').attr('src') == imgDir + 'select_badge_ico.gif')
                  {
                        alert('Please, select badge.');
                        return;
                  }
              }
        }

        if (null != n_data)
        {
            var errs = new Array();
            var cnt_ndata = n_data.length;
            for (j = 0; j < cnt_ndata; j++)
            {
                /* 1 */
                var n_inp_val = '';
                if ('video_code' == smtype)
                    n_inp_val = $('#id_send_txt_video_code_link').val()
                else
                    n_inp_val = $('#id_send_inp_'+smtype+'_'+n_data[j]).val();
                /* 1 */

                if ('link' == smtype) 	//check link
                {
                    if (verify_url(n_inp_val)) {
                        vrf_link = true;
                        $.ajax({
                            type:     'POST',
                            dataType: 'json',
                            data:     "link="+n_inp_val+"&ajaxinit=1",
                            url:      siteAdr+'profile/wall/getlinkinfoajax',
                            success: function (data) {
                                if (data.q == 'ok') {
                                    if ('' != data.title && 'OpenDNS' != data.title) {
                                        $('#id_uploaded_link_lable').html(data.title.substring(0, 57)+(57 <= data.title.length ? '...' : ''));     
                                    } else {
                                        $('#id_uploaded_link_lable').html(data.link);
                                    }
                                    $('#id_uploaded_link_lable').attr({'href': data.link, 'target': 'blank'});
                                } else {
                                    alert('Incorrect link');
                                    return false;
                                }
                            }
                        });
                    } else {
                        alert('Incorrect link');
                        return false;
                    }
                }
                else if ('video_code' == smtype) 	//check video
                {
                    var vrf_link = verify_embed_code(n_inp_val, 300, 200);
                    if (vrf_link)
                    {
                        $('#id_send_inp_video_code_link').val(vrf_link);
                        $.get(siteAdr+'base/valbums/getevideoiajax', {
                            'video': vrf_link,
                            'ajaxinit': 1
                        }, function(r) {
                            if ('not_success' != r)
                            {
                                $('#id_img_video_code').attr({
                                    'src': r
                                });
                            }
                            else
                            {
                                $('#id_img_video_code').attr({
                                    'src': imgDir+'no_photo_m56.jpg'
                                });
                                $('#id_img_video_code').css({
                                    'width': '32px',
                                    'height': '25px'
                                });

                                /* 2 */
                                $('#id_uploaded_video_code_lable').html('Invalid embed code. Click here to try again.');
                                if ($('#id_uploaded_video_code_lable').unbind('click'))
                                {
                                    $('#id_uploaded_video_code_lable').click(function(){
                                        oWall.ChngSendBlock('video')
                                    });
                                }
                            /* 2 */
                            }
                        });
                    }
                    else
                    {
                        alert('Invalid code. Please, enter correct embed code.');
                        return false;
                    }
                }
                else if ('photo_url' == smtype) 	//check photo link
                {
                    //var vrf_link = verify_ext(n_inp_val);
                    vrf_link = verify_url(n_inp_val);
					
                    if (false !== vrf_link)	vrf_link = verify_url(n_inp_val);

                    if (!vrf_link) {
                        alert ('Invalid link.');
                        return false;
                    }
                }
                else if (null != n_inp_val && '' != n_inp_val)
                    var vrf_link = true;

                if (!vrf_link || false == vrf_link || 'undefined' == vrf_link)
                {
                    /* ?? */    $('#id_err_'+smtype+'_'+n_data[j]).html('*');	//error Exception
                    errs.push(n_data[j]);
                }
            }


            if (!errs.length)
            {
                retCont = $('#id_send_frm_'+smtype).html();
                retId   = 'id_send_frm_'+smtype;
                var att_block = $('#id_send_frm_'+smtype+': input').wrapInner();

                if ('photo_url' == smtype)
                {
                    $('#id_img_photo_url').attr({
                        'src': att_block[1].value
                    });
                    $('#id_uploaded_'+smtype+'_lable').attr({
                        'href': att_block[1].value
                    });
                }
                else if ('ev' == smtype)
                {
                    //$('#id_uploaded_ev_lable').html($('#id_send_inp_ev_title').val() + ' at ' + $('#id_send_inp_ev_where').val() + ' on ' + $('#id_send_inp_ev_dt').val());

                    $('#id_uploaded_ev_lable').html($('#id_send_inp_ev_title').val() + ' on ' + $('#id_send_inp_ev_dt').val());
                }

                $('#id_place_to_attach').html(att_block);

                if ('ev' == smtype)
                {
                    att_block = '<input type="hidden" name="WI[ev_img]" value="'+$('#fileToUploadName').val()+'" />';
                    att_block += '<input type="hidden" name="WI[ev_descr]" value="'+$('#id_send_frm_descr_ta').val()+'" />';

                    $('#id_place_to_attach').append(att_block);
                }


                $('#id_uploaded_mes').hide();
                $('#id_uploaded_'+smtype).show();

                oWall.ChngSendBlock( 'mes' );	//redirect to the mes module
            //oWall.ChngSendBlock( 'descr' );	//redirect to the descr module
            }
        }
        else
        {
            retCont = $('#id_send_frm_'+smtype).html();
            retId   = 'id_send_frm_'+smtype;

            var att_block = $('#id_send_frm_'+smtype+': input').wrapInner();
            $('#id_place_to_attach').html(att_block);
            if (smtype == 'badge')
            {
              $('#id_send_inp_mes_story').val(badge_store);
              $('#id_send_inp_mes_story').attr('maxlength',112);
              oWall.AddMes('id_frm_add_mes');
            }
            else
            {
              oWall.ChngSendBlock( 'mes' );	//redirect to the mes module
            }
        }
        $('#id_main_btn_share').hide();
    }, /* AttachBlock */
	
    /**
	 * Create new Message
	 * 
	 * @param id_frm - form, which is submitted
	 */
    AddMes: function ( id_frm ) {
        var options = {
            cache: false,
            mode: 'abort',
            port: 'addmes',
            data: {
                'ajaxinit': 1
            },
            success: function(r) {
                if ('not_success' != r) {
                    $('#id_div_empty_mes').remove();
                    $('#id_mes_list').html(r + $('#id_mes_list').html());

                    $('#id_share_attention_badge').hide();
                    $('#id_share_with').show();

		    $('#id_send_txt_video_code_link').val('');
		    $('#id_send_txt_video_code_link').html('');
                    oWall._initInterface();	//refresh Interface
                }
                setTimeout('$(\'#id_eclipse_img_bckgrnd\').hide();', 300);
            }
        };
		
        var errs = new Array();

        var att_frm = $('#id_place_to_attach').html();
        var mes_story = $('#id_send_inp_mes_story').val();
        var max = parseInt($('#id_send_inp_mes_story').attr('maxlength'));

/*     if (mes_story == '')
            {
                alert('Enter some text.');
                return;
            }
*/
        //Check for badge_maxlength
        if ($('#id_send_badge_b_story').val() == mes_story && $('#id_send_inp_badge_img_val').val() == undefined)
        {
           var inputs = '<input id=\"id_send_inp_badge_img_val\" type=\"hidden\" name=\"WI[b_img_name]\" value=\"0\" \/><input id=\"id_send_inp_badge_sub_mtype\" type=\"hidden\" name=\"WI[sub_mtype]\" value=\"1\" \/>';
           $('#id_place_to_attach').append(inputs);

           var str = $('#select_badge').attr('src');
           var b_name = str.substring(10, str.length-4);
           $('#id_send_inp_badge_img_val').val(b_name);
           $('#id_send_inp_badge_sub_mtype').val('1');
        }
         
        var attached = $('#id_place_to_attach: input');

        if (mes_story.length > max) {
            errs.push(1);
            //badge maxlenght
            if (mes_story == $('#id_send_badge_b_story').val())
                {
                    $('#id_share_attention_badge').show();
                    $('#id_share_with').hide();
                }
                else
                {
                    $('#id_refill_txt_ntf').show();
                    $('.cl_img_btn_share').attr({
                        'src': imgDir + 'share_b.gif'
                    });
                    $('#id_share_attention').show();
                    $('#id_share_with').hide();
                }
        }
        else
        {
            /*if (mes_story == '')
            {
                errs.push(1);
            }
            else
            {
*/
                if (oWall.CheckFreeMesg()) {
                errs.push(1);
                }
//            }
        }

        if (!errs.length)
        {
            $('#id_eclipse_img_bckgrnd').show();
            $('#' + id_frm).ajaxSubmit(options);

            $('#evImg').attr('src', '/i/im_bg.gif');
            $('#fileToUploadName').val('');
			
            $('#id_place_to_attach').html('');
            $('#id_ul_upl_photo li').remove();
        }
        else
        {
            $('#id_eclipse_img_bckgrnd').hide();
        }
        
    }, /* AddMes */


    CheckFreeMesg: function() {
        var attached = $('#id_place_to_attach: input');

        if ( 'Share your thoughts' == $('#id_send_inp_mes_story').val() || 'Post something on this wall' == $('#id_send_inp_mes_story').val()) {
            if (attached.length > 0) {
                $('#id_send_inp_mes_story').val('');
                return false;
            } else {
                return true;
            }
        }
    },


    /**
	 * Create new Answer on the Message
	 * 
	 * @param id - Message ID
	 */
    AddMesAnsw: function ( id ) {
        var options = {
            cache: true,
            mode: 'abort',
            port: 'addmesansw',
            data: {
                'ajaxinit': 1
            },
            success: function(r) {
                if ('not_success' != r)
                {
                    $('#id_mes_answ_list_'+id).html($('#id_mes_answ_list_'+id).html() + r);
                    $('.add-comment-in2').hide();
                    $('.add-comment-in').show();
                    oWall._initInterface();	//refresh Interface
                }
            }
        };
        if( $('#id_add_new_answ_txtar_b'+id).val() != '' )
        {
            $('#id_frm_add_mes_answ_' + id).ajaxSubmit(options);
        }
    },  /* AddMesAnsw */

    AddSmileStat: function ( name, uid, id ) {
       $.ajax({
                type: 'POST',
                data: {
                    'name': name,
                    'suid': uid,
                    'mid': id
                },
                url: siteAdr+'id' + uid + '/wall/getonesmstat',
                success: function(r)
                {
                    if (r == 'exist')
                    {
                      //alert('You already set this status for this message');
                    }
                    else
                    {
                       $('#id_mes_sts_list_'+id).empty().html(r);
                    }
                }
            });
    },  /* AddSmileStat */


    AddSmileStatExtra: function ( name, uid, id, cnt ) {
       $.ajax({
                type: 'POST',
                data: {
                    'name': name,
                    'suid': uid,
                    'mid': id,
                    'cnt': cnt
                },
                url: siteAdr+'id' + uid + '/wall/getonesmstat',
                success: function(r)
                {
                    if (r == 'exist')
                    {
                      //alert('You already set this status for this message');
                    }
                    else
                    {
                       $('#id_mes_sts_list_'+id).empty().html(r);
                    }
                }
            });
    },

    AddBadgeTab: function () {
        
            $('#show_badge_tab').slideToggle('fast');
            $("#show_badge_tab").mouseout(function() {
                $(this).oneTime(100, 'hide_share', function() {
                    $(this).hide();
                });
            });
            $("#show_badge_tab").mouseover(function() {
                $(this).stopTime('hide_share');
            });
    },  /* AddBadgeTab */

    AddSmileTab: function (id) {
    if (!id)
        {
            $('#show_smile_tab').slideToggle('fast');
            $("#show_smile_tab").mouseout(function() {
                $(this).oneTime(100, 'hide_share', function() {
                    $(this).hide();
                });
            });
            $("#show_smile_tab").mouseover(function() {
                $(this).stopTime('hide_share');
            });
        }
        else if (id == 'badge')
        {
            $('#show_smile_tab_badge').slideToggle('fast');
            $('#show_smile_tab_badge').mouseout(function() {
                $(this).oneTime(100, 'hide_share', function() {
                    $(this).hide();
                });
            });
            $('#show_smile_tab_badge').mouseover(function() {
                $(this).stopTime('hide_share');
            });
        }
        else
        {
            $('#show_smile_tab_comment_'+id).slideToggle('fast');
            $('#show_smile_tab_comment_'+id).mouseout(function() {
                $(this).oneTime(100, 'hide_share', function() {
                    $(this).hide();
                });
            });
            $('#show_smile_tab_comment_'+id).mouseover(function() {
                $(this).stopTime('hide_share');
            });
            
        }
    },  /* AddSmileTab */

    AddSmileText: function(code, type, id){
        if (type == 'board')
        {
            if ($("#id_send_inp_mes_story").val() == 'Share your thoughts'||$("#id_send_inp_mes_story").val() == 'Post something on this wall')
            var string = code;
            else var string = $("#id_send_inp_mes_story").val()+ code;
            $("#id_send_inp_mes_story").val(string);
        }
        else if(type == 'just_comment')
        {
                var string = $('#id_add_new_answ_txtar_b_'+id).val()+ code;
                $('#id_add_new_answ_txtar_b_'+id).val(string);
        }
        else if (type == 'comment')
        {
                var string = $('#id_add_new_answ_txtar_b'+id).val()+ code;
                $('#id_add_new_answ_txtar_b'+id).val(string);
        }
    },

    /**
	 * Ajax uploading event picture
	 *
	 * @param  - Message ID
	 */
    ajaxFileUpload: function ( file_id, file_type )
    {
        var file_id = 'fileToUpload';
        var file_type = 'img';

        $("#aloader")
        .ajaxStart(function(){
            $(this).show();
        })
        .ajaxComplete(function(){
            $(this).hide();
        });
        $('#uplFileStatus').hide();
        $.ajaxFileUpload( {
            url:'/id'+UserID+'/wall/ajaxfileupload/',//?fid='+file_id+'&ftype='+file_type,
            secureuri:false,
            fileElementId:file_id,
            dataType: 'json',
            success: function (data, status)
            {
                if(typeof(data.error) != 'undefined')
                {
                    if(data.error != '')
                    {
                        alert(data.error);
                    //$('#'+file_id+'_uplFileMsg').html(data.error);
                    }
                    else
                    {
                        $('#evImg').attr('src','/files/images/wall/_temp/t/'+data.imgname);
                        $('#fileToUploadName').val(data.imgname);

                    //$('#'+file_id+'_uplFileMsg').html('Загружен файл: ' + data.msg);
                    }
                    $('#'+file_id+'_uplFileStatus').show();
                }
                else	// success?
                {
                    $('#evImg').attr('src','/files/images/wall/'+UserID+'/t/'+data.imgname);
                    $('#fileToUploadName').val(data.imgname);
                }
            },
            error: function (data, status, e)
            {
                alert(e);
                $('#'+file_id+'_uplFileMsg').html('При загрузке файла произошла ошибка');
                $('#'+file_id+'_uplFileStatus').show();
            }
        });

        //$('#'+file_id).attr('disabled', true);
        $('#'+file_id).attr('value', '');

        return true;
    },  /* AddMesAnsw */
	
    EditMes: function ( act, frm ) {
        var options = {
            cache: true,
            mode: 'abort',
            port: 'editmes',
            data: {
                'ajaxinit': 1
            },
            success: function(r) {
                if ('not_success' != r)
                {
                    if (1 == act)
                        $('.cl_mes:first').before(r);
                    oWall._initListeners();	//refresh Listeners
                }
            }
        };
        $('#' + frm).ajaxSubmit(options);
    }, /* EditMes */
	
    DelMes: function ( id, parent ) {
        if (id)
        {
            $.post(siteAdr+'id' + UserID + '/wall/delajax', {
                'mes_id': id,
                'ajaxinit': 1
            }, function(r) {
                if ('not_success' != r)
                {
                    $('#id_wall_mes_'+parent).hide();
                }
            });
        }
    },
	
    EditMesAnsw: function ( mid ) {
        if (mid)
        {
            var options = {
                cache: true,
                mode: 'abort',
                port: 'editmesansw',
                data: {
                    'ajaxinit': 1
                },
                success: function(r) {
                    if ('not_success' != r)
                    {
                        $('.cl_mes:first').before(r);
                        oWall._initListeners();	//refresh Listeners
                    }
                }
            };
            $('#' + frm).ajaxSubmit(options);
        }
    }, /* EditMesAnsw */
		
    /**
	 * Get List of Messages and Answers
	 *
         * @param uid - user ID
	 * @param last_id - last item ID on page
	 * @param sf_type - type of the showing data
	 * @param sf - filter of the showing data
         * @param sf2
         * @param append
	 */
    GetList: function ( uid, last_id, sf_type, sf, sf2, append ) {
        //if sf2 -> sf = mtype ; sf2 = ptype;
        if (uid) {

            if (('' == sf_type || null == sf_type || 'undefined' == sf_type) && (null == sf || 'undefined' == sf || '' == sf) )	{
                //exactly is not with filters
                sf_type = '';
                sf = '';
            }
            
            if (null == sf2 || 'undefined' == sf2 || '' == sf2) {
                sf2 = '';
            }

            if (null == append || 'undefined' == append) {
                append = '';
            }
			
            $('#id_eclipse_img_bckgrnd').css({
                'display': 'block'
            });	//show eclipsed background
            $.ajax({
                type: 'GET',
                cache: true,
                mode: 'abort',
                port: 'getmeslist',
                data: {
                    'last_id': last_id,
                    'sf_type': sf_type,
                    'sf': sf,
                    'sf2': sf2,
                    'ajaxinit': 1
                },
                url: siteAdr+'id' + uid + '/wall/getlistajax',
                success: function(r) {
                    if ('not_success' != r) {
                        
                        if ($('#id_mes_list').css('display') != 'block') {
                            $('#id_main_content').html('<h2>All entries</h2><div id="id_mes_list" style="word-wrap: break-word; overflow: hidden; max-width:  500px; width: 500px; display: block;"></div>');
                        }

                        $('#id_div_show_more_mes').remove();
                        if (append) {
                            $('#id_mes_list').html($('#id_mes_list').html() + r);
                            oWall._initListeners();	//refresh Listeners
                        }
                        else {
                            $('#id_mes_list').html(r);
                        }
                    }
                    setTimeout('$(\'#id_eclipse_img_bckgrnd\').css({\'display\': \'none\'})', 200);	//show eclipsed background
                    oWall._initListeners();	//refresh Listeners
                }
            });
        }
    },

	
    /**
	 * Get List of Messages and Answers
	 * 
	 * @param pcnt - start index of the element
	 * @param rcnt - end index of the element
	 */
    GetAnswList: function ( uid, mid, pcnt, rcnt ) {
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
            url: siteAdr+'id' + uid + '/wall/getanswlistajax',
            success: function(r)
            {
                if ('not_success' != r)
                {
                    $('#id_mes_answ_list_'+mid).html(/*$('#id_mes_answ_list_'+mid).html() + */r);
                    $('#id_div_show_more_answ_'+mid).hide();
                    oWall._initListeners();	//refresh Listeners
                }
            }
        });
    },
	
    SHFilterPopup: function ( action, id_popup ) {
        if (1 == action)	//show
        {
            if ($('#'+id_popup).fadeIn(300))
                $('#id_eclipse_bckgrnd').show();	//show eclipsed background
        }
        else
        {
            if ($('#'+id_popup).fadeOut(300))
                $('#id_eclipse_bckgrnd').hide();	//hide eclipsed background
        }
    }, /* SHUplPopup */
    
    EditFilter: function ( id_frm ) {
        var name = $('#id_add_filt_frm_send_name').val();
        if ('Enter new filter name' == name || '' == name || 2 > name.length)
            var err = 1;
        var options = {
            data: {
                'ajaxinit': 1
            },
            success: function(r) {
                if ('not_success' != r)
                {
                    Go(siteAdr+'id'+UserOtherID);
                }
            }
        };
        if (!err)
            $('#' + id_frm).ajaxSubmit(options);
    }, /* SHUplPopup */
	
    DelFilter: function ( id ) {
        $.post(siteAdr+'profile/wall/delfiltajax', {
            'fid': id,
            'ajaxinit': 1
        }, function(r) {
            if ('not_success' != r)
            {
                $('#id_filter_li_el_'+id).hide();
            }
        });
    }, /* DelFilter */
	
	
	
    //---- Additional Methods
	
    /**
	 * Check Events Dates Format
	 * Set in Necessary field correct type of data
	 */
    ChckEvDate: function ( id_field ) {
        var objEvDate = new Object();
        var date = new Date;

        objEvDate.month = $('select[name=Date_Month]').attr('value');
        objEvDate.day = $('select[name=Date_Day]').attr('value');
        //objEvDate.year = $('select[name=Date_Year]').attr('value');
        objEvDate.year = date.getFullYear() + (evNextYear ? 1 : 0);
        objEvDate.hour_min_meridian = $('#id_time_hour_min_meridian').attr('value');


        if(objEvDate.month.length == 1)
        {
            objEvDate.month = '0' + objEvDate.month;
        }
        if(objEvDate.day.length == 1)
        {
            objEvDate.day = '0' + objEvDate.day;
        }

        var strEvDate = objEvDate.month + '/' + objEvDate.day + '/' + objEvDate.year + ' ' + objEvDate.hour_min_meridian;

        $('#'+id_field).val(strEvDate);
    }, /* ChckEvDate */ 		
	
    /**
	 * Create new Answer on the Message
	 * 
	 * @param id - Flash Button ID
	 */	
    UplPhoto: function( smtype ) {
        var p_img = $('#id_send_frm_'+smtype+': input[p_img]');	//count of the elements
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

    CreateLinkUploaded: function(image_src) {
        var p_img_src = image_src;/*$(p_img[i]).val();*/
        var li = document.createElement('li');
        var img = document.createElement('img');
        img.src = fImgDir+'wall/_temp/'+p_img_src;
        img.width = 25;
        img.height = 25;
        var a = document.createElement('span');
        a.innerHTML = p_img_src.substring(0, 10)+((10 < p_img_src.length) ? '...' : '');
        $(li).append($(img));
        $(li).append($(a));
        $('#id_ul_upl_photo').append(li);

        if ($('#id_place_to_attach').find('#s_mtype').length == 0)
            $('#id_place_to_attach').append('<input type="hidden" name="WI[mtype]" value="4" />');
		
        $('#id_place_to_attach').append('<input value="'+image_src+'" name="WI[p_img][]" />');
    },
	
    YTDone: function(id) {
        $('#id_send_inp_video_choose_file_v_unid').val(id);
        oWall.AttachBlock( 'video_choose_file' );
    //setTimeout('oWall.AttachBlock( \'video\' )', 4000);
    //setTimeout('oWall.ChkVideo('+id+')', 10000);
    },
	
    DoYTUpl: function(eg, url) {
        $('#id_frm_video_upl').attr('action', url);
        $('#id_frm_video_upl').submit();
        oWall.YTDone(eg);
        setTimeout('$(\'#stat\').html(\'Loading...\');', 1500);
    },
	
    GetYTToken: function() {
        $('#stat').html('Connecting...');
        $('#stat').show();
        setTimeout('$(\'#stat\').html(\'Data validation...\');', 200);
        
        $('#stat').html('Getting the token...');
        $('#stat').html('Sending the form...');
        //$('#id_btn_video_upl').css('display', 'none');
        
        var unid = (getCDateHash()+''+crand)*1.0;
        $.ajax({
            type: 'POST',
            dataType: 'json',
            port: 'getyttoken',
            data: {
                'module': 'token',
                'unid': unid,
                'ajaxinit': 1
            },
            url: siteAdr+'id'+UserOtherID+'/wall/ytloader',
            success: function(r)
            {
                if (r['err']=='1')
                {
                    $('#stat').html('<font color=\'red\'>Some of the necessaries fields were not filled!</font>');
                    $('#sbbut').css('display', 'block');
                }
                else
                {
                    $('#token').val(r['token']);
                    $('#stat').html('Patching the form to send data...');
                    $('#stat').html('Sending data to YouTube...');
                        
                    oWall.DoYTUpl(r['unid'], r['url']);
                }
            }
        });
    }, 
    
    ChkVideo : function(id) { 
        document.location = siteAdr+'';
        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: {
                'id':id,
                'ajaxinit': 1
            },
            url: siteAdr+'id'+UserOtherID+'/wall/chckvideoajax',
            success: function (r) {
                if ('not_success' != r)
                {
                    if (r['vi'])
                        document.location = siteAdr+'';
                    else
                        setTimeout('oWall.ChkVideo('+r['id']+')', 1000);
                }
            }
        });
    }
}

var oWall = new Wall();
