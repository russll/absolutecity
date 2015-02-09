/**
 * Journal jsController
 * 
 * @package    5dev Journal
 * @version    1.0
 * @since      1.03.2010
 * @copyright  2010 5dev Team
 * @link       http://5dev.com
 */

function Journal() { 
    this.__construct( );

}

Journal.prototype = { 
    __construct: function() {
        crand = rand(999, 99999999);	//special numer for photo & video
        retCont = '';
        retId   = '';
        showed  = {
            'ev': 0,
            'link': 0
        };
        ufy_ready = false;
        evNextYear = false;
    }, /* __construct */

    disableNAL: function () {
        $('.top_nav_attach_links').each(function(){
            $(this).css('opacity', '0.4');
        });

        $(".top_nav_attach_links").unbind('click');

        $('.top_nav_attach_links').click(function () {
            return false;
        });
    },

    enableNAL: function () {
        $('.top_nav_attach_links').each(function(){
            $(this).css('opacity', '1');
        });
		
        $(".top_nav_attach_links").unbind('click');

        $('.top_nav_attach_links').click(function () {
            oJournal.ChngSendBlock($(this).attr('mtype'));
            oJournal.disableNAL();
        });
    },
	
    //---- System Methods
	
    /**
	 * Initialization of the Interfaces
	 */
    _initInterface: function () {
        oJournal._initDefaultSettings();
        oJournal._initListeners();
    },  /* initInterface */

    _initDefaultSettings: function () {
	FavHover();
        $('.cl_send_block').css({
            'display': 'none',
            'visibility': 'visible'
        });
        $('.cl_attached_block').css({
            'display': 'none'
        });
        $('#id_send_block_mes').show();
        $('#id_uploaded_mes').show();
        //$('iframe').contents().find('body').html('<font style="font-size: 14px; color:gray">Share your thoughts</font>');
        $('#id_iframe_txt').contents().find('body').html('<font style="font-size: 14px; color:gray">Share your thoughts</font>');
        $('.cl_answ_story').val('');
        $('#id_jwrite_subj').val('Subject').css('color', '#808080');
        $('#id_iframe_txt').css({
            'border': 'none'
        });
        $('.share-tools').show();
        //$('.nav_attach_links').show();
        oJournal.enableNAL();
        $('.tag_button').show();
        $('.share-tools').css('top', 35);

        if (retCont && retId) {
            $('#id_place_to_attach').html('');
            $('#'+retId).html(retCont);
            redId = '';
            retCont = '';
            NFFix();
        }
        $('#id_inp_tag_name_0').autocomplete('/security/users/gettaglistajax?ajaxinit=1',
        {
            delay:        200,
            cacheLength:  7,
            minChars:     2,
            width:        197,
            eH_MOver:   function () {	/* will be executed on every li's mouseover, By Eugene */
                $("#id_tags_menu_0").stopTime('hide_tagli');
            }
        });

        $("#id_tags_menu_0 li").click(function() {
            $("#id_tags_menu_0").hide();
        });

        $("#id_tags_menu_0").mouseout(function() {
            $(this).oneTime(100, 'hide_tagli', function() {
                $(this).slideUp();
                $('.ac_results').hide();
            });
        });
        $("#id_tags_menu_0").mouseover(function() {
            $(this).stopTime('hide_tagli');
        });

        $('#id_ul_link_photo').html('');
        $('#id_ul_upl_photo').html('');
        $('#id_ul_code_video').html('');

        //clear privacy
        $('#id_add_mes_privacy').val(0);
        $('#id_add_mes_sub_module').val(0);
        $('#id_add_mes_sub_module_val').val(0);
        $('#id_add_mes_sub_class').val(0);
        $('.sw_someone').val('enter user name');

        $('#id_a_share_with').html('everyone');
        $('.everyone-bot').children('ul').find('li').removeClass('grey');
        $('.cl_sub_menu').css('color', '');
        $('.cl_ssmenu').hide();

        oUsers.ClearTempTags();
        oUsers.AddTempTagVal( 'id_tags_menu_list_0', 'my church talks' );
    }, /* _initDefaultSettings */
	
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
            default:
                this.n_data = null;
                break;
        }
        return this.n_data;
    }, /* _initNecData */

    /**
	 * Initialization of the Necessaries To Complete Fields
	 *
	 * @param smtype ('ev'-event, 'link'-link, 'photo'-photo, 'video'-video)
	 */
    toggleMes: function(dir) {
        if(dir)
        {
            $('#yt_frame').css('height', 200);
            //$('iframe').css('min-height', 200);
            $('#id_iframe_txt').css('min-height', 200);
            $('#wj_block').removeClass('writej').addClass('writej2');
            $('.top-box').css('height', 310);
            $('.top-box').css('background', 'url("/i/content_top_2.png")');
            $('.cl_img_btn_share').css('top', 273);
                    
            $('.cl_j_uploaded_block').css('margin-top', '147px');
            $('#id_ul_upl_photo').css('margin-top', '177px');

            if ($('#id_ul_upl_photo li').length > 0)
            {
                //alert('photo');
                $('.share-tools').css('top', '-20px');
            }
            else if ($('#id_send_inp_video_code_link').val() != '')
            {
                //alert('video');
                //$('.share-tools').css('top', '10px');
                $('.share-tools').css('top', '-20px');
                $('#id_ul_code_video').css('margin-top', '167px');
            }
            else if ($('#id_uploaded_ev_lable').html() != '')
            {
                //event
                $('#id_uploaded_ev').css('margin-top', '177px');
                $('.share-tools').css('top', '-15px');
                $('#id_smenu_sharewith2').css('margin-top', '5px');
            }
            else if ($('#id_send_inp_photo_url_link').val() != '')
            {
                $('.share-tools').css('top', '-20px');
                $('#id_ul_link_photo').css('margin-top', '167px');
            }
            else if($('#id_send_inp_link_url').val() != '')
            {

                //alert('link');
                $('.share-tools').css('top', '160px');
                $('#id_uploaded_link_lable').css('margin-top', '31px');
            }
            else
            {
                //alert(4);
                $('.share-tools').css('top', 180);
            }

        }
        else
        {
            $('#yt_frame').css('height', 60);
            //$('iframe').css('min-height', 60);
            $('#id_iframe_txt').css('min-height', 60);
            $('#wj_block').removeClass('writej2').addClass('writej');
            $('.top-box').css('height', 175);
            $('.top-box').css('background', 'url("/i/content_top.png")');
            $('.cl_img_btn_share').css('top', 134);

            $('#id_ul_upl_photo').css('margin-top', '34px');
        }
    }, /* _initNecData */

    /**
	 * Initialization of the constant Event's Listeners
	 * Set Necessary values for the fields
	 */
    _initListeners: function () {
        FavHover();
        $('#id_send_frm_ev input, #id_send_frm_ev select').change(oJournal.EvInpCheck);
        $('#id_send_frm_ev input, #id_send_frm_ev select').keyup(oJournal.EvInpCheck);

        $('#id_send_inp_link_url').keyup(function(){
            if ($(this).val().length > 0) $('#link_add_button').attr('src',imgDir +  'add_b2_act.gif'); else $('#link_add_button').attr('src',imgDir +  'add_b2.gif');
        });
        /* "enable\disable" add-button in link section dependent on character's length */
        if ($('#send_photo_link').val() && $('#send_photo_link').val().length > 0) $('#send_photo_link').attr('src', imgDir + 'add_b2_act.gif'); else $('#send_photo_link').attr('src', imgDir + 'add_b2.gif');
        $('#id_send_inp_photo_url_link').keyup(function() {
            if ($(this).val().length > 0 && verify_url($(this).val()))
				$('#send_photo_link').attr('src', imgDir + 'add_b2_act.gif');
			else
				$('#send_photo_link').attr('src', imgDir + 'add_b2.gif');
        });

        
        $('.link_expander').each(function(){
            $(this).click(function(){
                var sid = $(this).attr('sid');
                if ($('#mes_story_'+sid+'_s').is(':hidden'))
                {
                    $(this).html('read more...');
                    //$('#mes_story_'+sid+'_l').slideUp(500, function(){$('#mes_story_'+sid+'_s').slideDown(500);});
                    $('#mes_story_'+sid+'_l').fadeOut(10, function(){
                        $('#mes_story_'+sid+'_s').fadeIn(500);
                    });

                }
                else
                {
                    $(this).html('collapse');
                    $('#mes_story_'+sid+'_s').fadeOut(10, function(){
                        $('#mes_story_'+sid+'_l').fadeIn(500);
                    });
                }
				
            });

        });
      


        //check maxlength of the TextArea && enable buttons to send

        $('.ui-helper-reset').hide();

        //if ($('iframe').contents().unbind('click'))
        if ($('#id_iframe_txt').contents().unbind('click'))
        {
            //$('iframe').contents().click(function() {
            $('#id_iframe_txt').contents().click(function() {
                //var str = $('iframe').contents().find('body').html();
                var str = $('#id_iframe_txt').contents().find('body').html();

                var reg = /Share your thoughts/i;
                if (reg.test(str))
                {
                    //$('iframe').contents().find('body').html('');
                    $('#id_iframe_txt').contents().find('body').html('');
                }
                if($('.top-box').css('height') != 200)
                {
                    oJournal.toggleMes(1);
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
            
        $('#id_send_inp_mes_story').val();
        var attached = $('#id_place_to_attach: input');

        $('.cl_a_btn_share').attr({
            'href': 'javascript: oJournal.AddMes( \'id_frm_add_mes\' );'
        });
					
        if ('' == $('#id_send_inp_mes_story').val() && 0 == attached.length)
        {
            $('.cl_img_btn_share').attr({
                'src': imgDir + 'post_b.gif'
                });
        //$('.cl_a_btn_share').attr({ 'href': 'javascript: void(0);' });
        }
        else
        {
            $('.cl_img_btn_share').attr({
                'src': imgDir + 'post_b_act.gif'
                });
        }
        $('#id_share_with').show();
        //$(this).parent().find('.charsRemaining').html('You have ' + (max - $(this).val().length) + ' characters remaining');
		
        //initialization of the Add Attach Navigation Bar
        if ($(".nav_attach_links").unbind('click'))
        {
            $('.nav_attach_links').click(function () {
                oJournal.ChngSendBlock($(this).attr('mtype'));
            });
            oJournal.enableNAL();
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
                        $('#id_smenu_sharewith2').hide();
                        break;
                    case '4':
                        sptype = 'only someone...';
                        break;
                    case '5':
                        sptype = 'private';
                        $('#id_smenu_sharewith2').hide();
                        break;
                }
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

        if (!ufy_ready)
        {
            ufy_ready = true;
            $('#ufy_plch').uploadify({
                'uploader'      : flDir+ '/uploadify.swf',
                'script'        : siteAdr+'id'+UserOtherID+'/journal/chkuplphoto/?pcash='+rand(1, 10000),
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
                        oJournal.CreateLinkUploaded(response.image);
                    }

                    $('.share-tools').css('top', '-20px');
                    $('#id_uploaded_photo_choose_file').css('margin-left', '220px');

                    if (response.status == 'err') {
                        alert('Error happened :( ');
                    }
                },
                onAllComplete: function () {
                    /*    $('#id_send_block_mes, #id_uploaded_photo_choose_file').show();
                        $('#id_send_block_photo_choose_file, #id_uploaded_mes').hide();
                        $('.share-white-b').show(); */
                    //oWall.ChngSendBlock( 'mes' );
                    $('#id_uploaded_photo_choose_file').show();
                    $('.share-white-b').show();
                    $('#ufy_plch_list').html('');
                    oJournal.ChngSendBlock( 'mes' );
                },
				 
                onSelectOnce: function() {
                    $('#ufy_block_ab').attr('src', '/i/add_b2_act.gif');
                },
                onCancel: function() {
                    var nch = $('#ufy_plch_list').children().length;
                    if (nch <= 1) $('#ufy_block_ab').attr('src', '/i/add_b2.gif');
                }

            });
        }
		
       
        crand = rand(1, 100000);

       
    }, /* initListeners */

    CloseButton: function ()
    {
        oJournal.enableNAL();
        oJournal.ChngSendBlock('mes');
    },

    /**
	 * Change type of sending Message (Change Form & Elements)
	 * 
	 * @param smtype ('ev'-event, 'link'-link, 'photo'-photo, 'video'-video) 
	 */
    ChngSendBlock: function ( smtype ) {

        if ($('#wj_block').height() < 300 && $('#id_ul_link_photo').html()=='' && $('#id_ul_upl_photo').html()=='' && $('#id_ul_code_video').html()=='' && $('#id_uploaded_ev_lable').html()=='') {
            $('.share-tools').css('top', '35px');
        }
            
        $('#ufy_plch_list').html('');
        if ('ev' == smtype) {
            oJournal.ChckEvDate( 'id_send_inp_ev_dt' );
        }

        if(smtype == 'mes') {
            $('.share-tools').show();
        } else {
            $('.share-tools').hide();
            oJournal.toggleMes(0);
        }              
       	
        $('.cl_send_block').hide();
        var attached = $('#id_place_to_attach: input').html();
        if (attached) {
            $('#id_send_block_'+smtype).html(attached);
        }
		
        $('#id_send_block_'+smtype).show();
        if ('ev' != smtype || !showed[smtype]) {
            NFFix();
        }
        else {
            $('.NFSelect').remove();
            NFFix();
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
            $('#add_event_button').attr('src',imgDir + 'add_b2_act.gif');
        else
            $('#add_event_button').attr('src',imgDir + 'add_b2.gif');

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

        oJournal.AttachBlock('ev');
    },

	
    /**
	 * Attach blocks with Enclose while the Message is adding
	 * 
	 * @param smtype ('ev'-event, 'link'-link, 'photo'-photo, 'video'-video)
	 */
    AttachBlock: function ( smtype ) {
        if ('ev' == smtype)
        {
            $('.share-tools').css('top', '-17px');
            oJournal.ChckEvDate( 'id_send_inp_ev_dt' );
        }
        else if('link' == smtype)
        {
            if ($('#wj_block').height() < 300) {
                $('#id_uploaded_link_ul').css('margin-top', '38px');
                $('#id_uploaded_link_lable').css('margin-top', '0px');
            }
			
            $('.share-tools').css('top', '12px');
        }
        else if ('video_code' == smtype)
            $('#id_send_inp_video_code_link').val($('#id_send_txt_video_code_link').val());

		
        $('.cl_err').html('');
        var n_data = oJournal._initNecData( smtype );	//init necessary data
        if (null != n_data)
        {
            var errs = new Array();
            var cnt_ndata = n_data.length;

            /* hide buttons */
            oJournal.disableNAL();
            //$('.nav_attach_links').css('visibility', 'hidden');

            for (j = 0; j < cnt_ndata; j++)
            {
                var n_inp_val = '';
                if ('video_code' == smtype)
                    n_inp_val = $('#id_send_txt_video_code_link').val()
                else
                    n_inp_val = $('#id_send_inp_'+smtype+'_'+n_data[j]).val();
				
                if ('link' == smtype) {	//check link
                    if (verify_url(n_inp_val)) {
                        vrf_link = true;
                        $.ajax({
                            type:     'POST',
                            dataType: 'json',
                            data:     "link="+n_inp_val+"&ajaxinit=1",
                            url:      siteAdr+'profile/wall/getlinkinfoajax',
                            success: function (data) {
                                if (data.q == 'ok') {
                                    $('.share-tools').css('top', '20px');
                                    if ('' != data.title && 'OpenDNS' != data.title) {
                                        $('#id_uploaded_link_lable').html(data.title.substring(0, 57)+(57 <= data.title.length ? '...' : ''));
                                    } else {
                                        $('#id_uploaded_link_lable').html(data.link);
                                    }
                                    $('#id_uploaded_link_lable').attr({
                                        'href': data.link,
                                        'target': 'blank'
                                    });
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
                else if ('video_code' == smtype) {	//check video
                    var vrf_link = verify_embed_code(n_inp_val, 400, 300);
					
                    if (vrf_link)
                    {
                        $('.share-tools').css('top', '12px');
                        $('#id_send_inp_video_code_link').val(vrf_link);
                        $.get(siteAdr+'base/valbums/getevideoiajax', {
                            'video': vrf_link,
                            'ajaxinit': 1
                        }, function(r) {
                            if ('not_success' != r)
                            {
                                $('.share-tools').css('top', '-20px');
                                $('#id_uploaded_video_code').css('margin-left', '220px');

                                var li = document.createElement('li');
                                var img = document.createElement('img');
                                img.src = r;
                                img.width = 33;
                                img.height = 25;

                                $(img).css('position', 'static').css('float', 'left');

                                var a = document.createElement('span');
                                a.innerHTML = 'Embed code';
                                $(a).css('text-decoration', 'none').css('color', 'white').css('margin-top', '0px').css('padding-left', '0px');

                                $(li).append($(img)).append($(a));
                                $('#id_ul_code_video').append(li);
                                $('#id_ul_code_video').css('margin-top', '26px').css('margin-left', '25px');

                                $('.share-tools').css('top', '-20px');
                            }
                            else {
                                alert('Invalid code. Please, enter correct embed code.');
                            }
                        });
                    }
                    else {
                        alert('Invalid code. Please, enter correct embed code.');
                        return false;
                    }
                }
                else if ('photo_url' == smtype) {	//check photo link
                    var preg = /http:/
                    if (!preg.test(n_inp_val))
                        n_inp_val = 'http://'+n_inp_val;

                    var vrf_link = verify_url(n_inp_val);
                    if (!vrf_link) {
                        alert ('Invalid link.');
                        return false;
                    }
                }
                else if (null != n_inp_val && '' != n_inp_val) {
                    var vrf_link = true;
                }
                if (!vrf_link || false == vrf_link || 'undefined' == vrf_link)
                {
					
                    $('#id_err_'+smtype+'_'+n_data[j]).html('*');	//error Exception
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
                    $('.share-tools').css('top', '-20px');
                    $('#id_uploaded_photo_url').css('margin-left', '220px');

                    var li = document.createElement('li');
                    var img = document.createElement('img');
                    img.src = att_block[1].value;
                    img.width = 33;
                    img.height = 25;

                    $(img).css('position', 'static').css('float', 'left');

                    var a = document.createElement('span');
                    a.innerHTML = 'Image preview';
                    $(a).css('text-decoration', 'none').css('color', 'white').css('margin-top', '0px').css('padding-left', '0px');

                    $(li).append($(img)).append($(a));
                    $('#id_ul_link_photo').append(li);
                    $('#id_ul_link_photo').css('margin-top', '26px').css('margin-left', '25px');

                    $('.share-tools').css('top', '-20px');
                }
                else if ('ev' == smtype) {
                    
                    $('.share-tools').css('top', '-30px');

                    $('#id_uploaded_ev').css('margin-left', '220px');
                    var li = document.createElement('li');
                    var img = document.createElement('img');
                    img.src = '/i/event_ico.gif';
                    $(img).css('position', 'static').css('float', 'left');
                    

                    var a = document.createElement('span');
                    a.innerHTML = $('#id_send_inp_ev_title').val()+' at '+$('#id_send_inp_ev_where').val()+' on '+$('#id_send_inp_ev_dt').val();
                    $(a).css('text-decoration', 'none').css('color', 'white').css('margin-top', '0px').css('padding-left', '0px');
                    $(li).append($(img)).append($(a));
                    $('#id_uploaded_ev_lable').append(li).css('margin-top', '36px').css('margin-left', '25px').css('float', 'left');
                    $('.share-tools').css('top', '-30px');
                }
				
                $('#id_place_to_attach').html(att_block);
                $('#id_uploaded_mes').hide();
                $('#id_uploaded_'+smtype).show();
                oJournal.ChngSendBlock( 'mes' );	//redirect to the mes module
            }
        }
        else
        {
            retCont = $('#id_send_frm_'+smtype).html();
            retId   = 'id_send_frm_'+smtype;
            var att_block = $('#id_send_frm_'+smtype+': input').wrapInner();
            $('#id_place_to_attach').html(att_block);
            oJournal.ChngSendBlock( 'mes' );	//redirect to the mes module
        }
    }, /* AttachBlock */

    /**
	 * Edit Message
	 *
	 * @param id_msg
	 */
    LoadMes: function ( mid ) {
        $('#id_eclipse_img_bckgrnd').show();

        $.ajax({
            type: 'GET',
            cache: false,
            dataType: 'json',
            url: siteAdr+'id' + UserID + '/journal/editoneajax?id='+mid+'&act=0&ajaxinit=1',
            success: function(r)
            {
                if(r.id != 0) {
                    oJournal.disableNAL();
                    //$('.nav_attach_links').hide();
					
                    $('.tag_button').hide();

                    $('.cl_a_btn_share').attr({
                        'href': 'javascript: oJournal.SaveMes( ' + r.id + ' );'
                    });
                    
                    //$('iframe').contents().find('body').html(r.story);
                    $('#id_iframe_txt').contents().find('body').html(r.story);
                    $('#id_jwrite_subj').val(r.subj).css('color', '#000');

                    $('#id_eclipse_img_bckgrnd').hide();

                    $('.share-tools').hide();

                    jQuery.scrollTo('.top-box', 1000 );
                }
            }
        });
    },

    /**
	 * Save Message
	 *
	 * @param id_frm
	 */
    SaveMes: function ( id ) {
        $('#id_eclipse_img_bckgrnd').show();

        //var story = $('iframe').contents().find('body').html();
        var story = $('#id_iframe_txt').contents().find('body').html();
        var subj = $('#id_jwrite_subj').val();

        $.ajax({
            type: 'POST',
            cache: false,
            dataType: 'json',
            data: {
                'id':id,
                'act':1,
                'subj':subj,
                'story':story,
                'ajaxinit':1
            },
            url: siteAdr+'id' + UserID + '/journal/editoneajax',
            success: function(r)
            {
                //if(r.succ_edit != 0)
                //{
                    oJournal.enableNAL();

                    $('#id_journal_mes_subj_' + id).html(r.subj);
                    $('#id_journal_mes_story_' + id).html(r.story);
                    //$('#id_journal_mes_story_' + id).html(r.subj);

                    oJournal.toggleMes(0);
                    oJournal._initInterface();

                    $('#id_ul_upl_photo li').remove();
                    $('#id_send_inp_video_code_link').val('');
                    $('#id_uploaded_ev_lable').html('');
                    $('#id_send_inp_link_url').val('');

                    //$('#taglist').val('');
                    //$('#id_tags_menu_list_0 li[id!="stag_0"]').remove();
				
                    $('#id_eclipse_img_bckgrnd').hide();
                    jQuery.scrollTo('#id_journal_mes_' + id, 1000 );


                    $('#id_place_to_attach').html('');
                    $('#id_ul_upl_photo li').remove();
                    $('#id_send_inp_mes_story').val('');
                    //$('iframe').contents().find('body').html('');
                    $('#id_iframe_txt').contents().find('body').html('');


                    $('.share-tools').show();
                //}
            }
        });
    },

    /**
	 * Create new Message
	 * 
	 * @param id_frm - form, which is submitted
	 */
    AddMes: function ( id_frm ) {
        $('#id_eclipse_img_bckgrnd').show();
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
                    $('#id_div_empty_mes').remove();
                    $('#id_mes_list').html(r + $('#id_mes_list').html());
                    /* show buttons */
                    oJournal.enableNAL();
                    //$('.nav_attach_links').css('visibility', 'visible');

                    oJournal.toggleMes(0);
                    oJournal._initInterface();	//refresh Interface

                    $('#id_ul_upl_photo li').remove();
                    $('#id_send_inp_video_code_link').val('');
                    $('#id_send_txt_video_code_link').val('');
                    $('#id_uploaded_ev_lable').html('');
                    $('#id_send_inp_link_url').val('');
                    $('#id_send_inp_photo_url_link').val('');

                    $('#taglist').val('');
                    //$('#id_tags_menu_list_0 li[id!="stag_0"]').remove();
                }
                setTimeout('$(\'#id_eclipse_img_bckgrnd\').hide();', 300);
            }
        };

        var errs = new Array();
		
        var att_frm = $('#id_place_to_attach').html();
        var mes_story = $('#id_send_inp_mes_story').val();

        var allowed_empty = ($('#id_ul_upl_photo li').length > 0 || $('#id_send_inp_video_code_link').val() != ''	// photo && video
            || $('#id_uploaded_ev_lable').html() != ''			// event
            || $('#id_send_inp_photo_url_link').val() != ''	// photo link
            || $('#id_send_inp_link_url').val() != '');		// url

        var i = /Share your thoughts/;

	//var smile = $('iframe').contents().find('body').find('font').html();
	//var smile_codee = $('iframe').contents().find('body').html();
	var smile = $('#id_iframe_txt').contents().find('body').find('font').html();
	var smile_codee = $('#id_iframe_txt').contents().find('body').html();
        
        if ( smile == null && smile_codee != '')
            {
                $('#id_send_inp_mes_story').val(smile_codee);
                mes_story = smile_codee;
            }

        if (!allowed_empty && (i.test(mes_story) || '' == $.trim(mes_story))) {
            $('#id_err_mes_story').html('*');	//error Exception
            errs.push(1);
        } else if (allowed_empty && i.test(mes_story)) {
            mes_story = '';
        }

	if ($('#id_send_inp_photo_url_link').val() != '' && !verify_url( $('#id_send_inp_photo_url_link').val())) {
	    alert('Photo link is incorrect.');errs.push(1);
	}

        if (!errs.length) {
            $('#' + id_frm).ajaxSubmit(options);
            $('#id_place_to_attach').html('');
            $('#id_ul_upl_photo li').remove();
            $('#id_send_inp_mes_story').val('');
        }
        else
            $('#id_eclipse_img_bckgrnd').hide();
    }, /* AddMes */
	
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
                    oJournal._initInterface();	//refresh Interface
                }
            }
        };
        if( $('#id_add_new_answ_txtar_b'+id).val() != '' )
        {
            $('#id_frm_add_mes_answ_' + id).ajaxSubmit(options);
        }
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
                    oJournal._initListeners();	//refresh Listeners

                }
            }
        };
        $('#' + frm).ajaxSubmit(options);
    }, /* EditMes */

    DelMes: function ( id ) {
        if (id)
        {
            $.post(siteAdr+'id' + UserID + '/journal/delajax', {
                'mes_id': id,
                'ajaxinit': 1
            }, function(r) {
                if ('not_success' != r)
                {
                    $('#id_journal_mes_'+id).hide();
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
                        oJournal._initListeners();	//refresh Listeners
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
	 * @param last_id - last item ID
	 * @param sf_type - type of the showing data
	 * @param sf - filter of the showing data
	 */
    GetList: function ( uid, last_id, sf_type, sf ) {
	FavHover();
        if (uid) {
            
            if (('' == sf_type || null == sf_type || undefined == sf_type) && (null == sf || undefined == sf || '' == sf))	//exactly is not with filters
            {
                sf_type = '';
                sf = '';
                not_sf = 1;
            }
			
            $('#id_eclipse_img_bckgrnd').css({
                'display': 'block'
            });	//show eclipsed background
            $.ajax({
                type: 'GET',
                cache: true,
                data: {
                    'last_id': last_id,
                    'sf_type': sf_type,
                    'sf': sf,
                    'ajaxinit': 1
                },
                url: siteAdr+'id' + uid + '/journal/getlistajax',
                success: function(r) {
                    if ('not_success' != r) {
                        if (not_sf) {
                            $('#id_mes_list').html($('#id_mes_list').html() + r);
                            $('#id_div_show_more_mes').remove();
                        }
                        else {
                            $('#id_mes_list').html(r);
                        }
                    }
                    setTimeout('$(\'#id_eclipse_img_bckgrnd\').css({\'display\': \'none\'})', 200);	//show eclipsed background
                    oJournal._initListeners();	//refresh Listeners
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
            url: siteAdr+'id' + uid + '/journal/getanswlistajax',
            success: function(r)
            {
                if ('no_success' != r)
                {
                    $('#id_mes_answ_list_'+mid).html(/*$('#id_mes_answ_list_'+mid).html() + */r);
                    $('#id_div_show_more_answ_'+mid).hide();
                    oJournal._initListeners();	//refresh Listeners
                }
            }
        });
    },
	
	
	
	
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
		
        //var strEvDate =  objEvDate.day + '.' + objEvDate.month + '.' + objEvDate.year + ' ' + objEvDate.hour_min_meridian;
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
	
    UplPhotoComplete: function ( smtype ){

    },
	
    /**
	 * Create Links & Images of the uploaded Photos
	 */
    CrLinksUplData: function( smtype ) {
    
    }, /* CrLinksUplData */

    CreateLinkUploaded: function(image_src) {
        var p_img_src = image_src;/*$(p_img[i]).val();*/
        var li = document.createElement('li');
        var img = document.createElement('img');
        img.src = fImgDir+'journal/_temp/'+p_img_src;
        img.width = 33;
        img.height = 25;

        $(img).css('position', 'static');
        $(img).css('float', 'left');

        var a = document.createElement('span');
        a.innerHTML = p_img_src.substring(0, 10)+((10 < p_img_src.length) ? '...' : '');
        $(a).css('text-decoration', 'none');
        $(a).css('color', 'white');
        $(a).css('margin-top', '0px');
        $(a).css('padding-left', '0px');

        $(li).append($(img));
        $(li).append($(a));
        $('#id_ul_upl_photo').append(li);

        $('#id_ul_upl_photo').css('margin-top', '34px').css('margin-left', '25px');

        if ($('#id_place_to_attach').find('#s_mtype').length == 0)
            $('#id_place_to_attach').append('<input type="hidden" name="WI[mtype]" value="4" />');

        $('#id_place_to_attach').append('<input value="'+image_src+'" name="WI[p_img][]" />');
    },
	
    YTDone: function(id) {
        $('#id_send_inp_video_choose_file_v_unid').val(id);
        oJournal.AttachBlock( 'video_choose_file' );
    //setTimeout('oJournal.AttachBlock( \'video\' )', 4000);
    //setTimeout('oJournal.ChkVideo('+id+')', 10000);
    },
	
    DoYTUpl: function(eg, url) {
        $('#id_frm_video_upl').attr('action', url);
        $('#id_frm_video_upl').submit();
        oJournal.YTDone(eg);
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
            url: siteAdr+'id'+UserOtherID+'/journal/ytloader',
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
                        
                    oJournal.DoYTUpl(r['unid'], r['url']);
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
            url: siteAdr+'id'+UserOtherID+'/journal/chckvideoajax',
            success: function (r) {
                if ('not_success' != r)
                {
                    if (r['vi'])
                        document.location = siteAdr+'';
                    else
                        setTimeout('oJournal.ChkVideo('+r['id']+')', 1000);
                }
            }
        });
    },
    DoSubscr: function(id)
    {
        $('#id_eclipse_img_bckgrnd').show();	//show eclipsed background
        $.ajax({
            type: 'POST',
            port: 'dosubscr',
            data: {
                'ajaxinit': 1
            },
            url: siteAdr + 'id' + UserOtherID + '/journal/dosubscrajax',
            success: function(r)
            {
                if ('not_success' != r)
                {
                    switch (r)
                    {
                        case '1':
                            $('#id_dosubscr_j').text('Unfollow');
                            break;
                        case '0':
                            $('#id_dosubscr_j').text('Follow');
                            break;
                    }
                }
                setTimeout('$(\'#id_eclipse_img_bckgrnd\').hide()', 200);	//show eclipsed background
            }
        });
    }, /* DoSubscr */
    
    SubscrPage: function(page, param) {
        $.ajax({
            type:     'POST',
            dataType: 'json',
            data:     'page='+page+'&param='+param+'&ajaxinit=1'+(!IS_USER ? '&uid='+UserOtherID : ''),
            url:      siteAdr+'journal/wall/GetSubscrListAjax',
            success: function (data) {
                if (data.q == 'ok') {
                    $('#id_subscribition_list').html( data.data );
                    $('#pagging').html(data.pagging);
                }
            }
        });
    }

}

var oJournal = new Journal();