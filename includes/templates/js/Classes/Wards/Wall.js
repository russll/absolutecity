/**
 * Ward's Wall jsController
 * 
 * @package    5dev Wall
 * @version    1.0
 * @since      1.03.2010
 * @copyright  2010 5dev Team
 * @link       http://5dev.com
 */

function WWall() { 
    this.__construct( );
}

WWall.prototype = { 
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
	
    //---- System Methods
	
    /**
	 * Initialization of the Interfaces
	 */
    _initInterface: function () {
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
        $('#id_send_inp_mes_story').val('Share your thoughts');
        $('.cl_answ_story').val('');
        $('#id_main_btn_share').show();

        if (retCont && retId) {
            $('#id_place_to_attach').html();
            $('#'+retId).html(retCont);
            redId = '';
            retCont = '';
            NFFix();
        }


        //clear privacy
        $('#id_place_to_attach').html('');

        $('#id_add_mes_privacy').val(0);
        $('#id_add_mes_sub_module').val(0);
        $('#id_add_mes_sub_module_val').val(0);
        $('#id_add_mes_sub_class').val(0);

        $('#id_a_share_with').html('my ward');
        $('.everyone-bot').children('ul').find('li').removeClass('grey');
        $('.cl_wsub_menu').css('color', '');
        $('.cl_ssmenu').hide();

        oWWall._initListeners();
    },  /* initInterface */
	
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
	 * Initialization of the constant Event's Listeners
	 * Set Necessary values for the fields
	 */
    _initListeners: function () {
        FavHover();
        $('#id_send_frm_ev input, #id_send_frm_ev select').change(oWWall.EvInpCheck);
        $('#id_send_frm_ev input, #id_send_frm_ev select').keyup(oWWall.EvInpCheck);

        $('#id_send_inp_link_url').keyup(function(){
            if ($(this).val().length > 0)
                $('#link_add_button').attr('src',imgDir +  'add_b2_act.gif');
            else
                $('#link_add_button').attr('src',imgDir +  'add_b2.gif');
        });
        /* "enable\disable" add-button in link section dependent on character's length */
        if ($('#send_photo_link').val() && $('#send_photo_link').val().length > 0)
            $('#send_photo_link').attr('src', imgDir + 'add_b2_act.gif');
        else
            $('#send_photo_link').attr('src', imgDir + 'add_b2.gif');

        $('#id_send_txt_video_code_link').keyup(function(){
            if ($(this).val().length > 0)
                $('#send_video_code').attr('src',imgDir +  'add_b2_act.gif');
            else
                $('#send_video_code').attr('src',imgDir +  'add_b2.gif');
        });

        $('#id_send_inp_photo_url_link').keyup(function() {
            if ($(this).val().length > 0) $('#send_photo_link').attr('src', imgDir + 'add_b2_act.gif'); else $('#send_photo_link').attr('src', imgDir + 'add_b2.gif');
        });

        if ($('.cl_a_btn_share').unbind('click'))
            $('.cl_a_btn_share').click(function(){
                oWWall.AddMes( 'id_frm_add_mes' );
            });

        $('.cl_a_btn_share').attr({
            'href': '#'
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
                //$('.cl_a_btn_share').attr({ 'href': 'javascript: void(0);'  });
                }
                else
                {
                    $('.cl_img_btn_share').attr({
                        'src': imgDir + 'share_b_act.gif'
                    });
                        
                }
                $('#id_share_attention').hide();
                $('#id_share_with').show();
            }
        //$(this).parent().find('.charsRemaining').html('You have ' + (max - $(this).val().length) + ' characters remaining');
        });
		
        //initialization of the Add Attach Navigation Bar
        if ($(".nav_attach_links").unbind('click'))
        {
            $('.nav_attach_links').click(function () {
                oWWall.ChngSendBlock($(this).attr('mtype'));
            });
        }

        //initialization of the bishopric info part-links
        if ($('.cl_bishopric_info_h3').unbind('click'))
        {
            $('.cl_bishopric_info_h3').click(function () {
                var sinfo = $(this).attr('sinfo');
                var iup = imgDir+'arr05_up.gif';
                var idown = imgDir+'arr05.gif';
				
                $('div[sinfo]').hide();
                $('a[sinfo]').find('img').attr({
                    'src': idown
                });
                $('a[sinfo="'+sinfo+'"]').find('img').attr({
                    'src': iup
                });
                $('div[sinfo="'+sinfo+'"]').slideToggle();
            });
        }

		
        //Set privacy type (share with)
        if ($(".cl_a_share_with").unbind('click'))
        {
            $('.everyone a').css('cursor', 'pointer');
            $('.cl_a_share_with').click(function () {
                var ptype = $(this).attr('ptype');
                $(this).parent().parent('ul').find('li').removeClass('grey');
                $(this).parent('li').addClass('grey');
                $('.cl_wsub_menu').css('color', '');
                $('#id_add_mes_privacy').val(ptype);
                
                //$('.cl_ssmenu').hide();
                $('.cl_ssmenu').each(function() {
                    if ($(this).height() > 0 && $(this).attr('id') != 'id_ssmenu_'+ptype)
                        $(this).slideUp('normal');
                });


                if ($('#id_ssmenu_'+ptype).find('li').length > 0) {

                    $('.cl_wsub_menu').css('color', '');
                    $('.cl_a_share_with').css('color' , '');
                    $(this).css('color', 'gray');
					
                    $('#id_add_mes_sub_module').val('');
                    $('#id_add_mes_sub_module_val').val(0);

                    $('#id_ssmenu_'+ptype).slideToggle();
                }
                else {
                    $('#id_smenu_sharewith').hide();
                }
				
                //-- if submenu is existed
                

                //$('#id_smenu_sharewith').hide();
                var sptype = '';
                
                switch (ptype)
                {
                    case '0':
                        sptype = 'my ward';
                        break;
                    case '1':
                        sptype = 'my stake';
                        break;
                /* case '2':
                        sptype = 'other wards';
                        break;
                    case '3':
                        sptype = 'other stake';
                        break;*/
                }
                $('#id_a_share_with').html(sptype);
            });
        }
		
        //Set sub privacy type (share with)
        if ($(".cl_wsub_menu").unbind('click'))
        {
            $('.cl_wsub_menu').click(function () {
                var submodule     = $(this).attr('submodule');
                var submodule_val = $(this).attr('submodule_val');
                //$('#hspan').html('Selected '+submodule + ' -> ' + submodule_val );
                $('#id_add_mes_sub_module').val(submodule);
                $('#id_add_mes_sub_module_val').val(submodule_val);
                $('.cl_wsub_menu').css('color', '');
                $(this).css('color', 'gray');

                if(submodule_val == 5)
                {
                    var submodule_class = $(this).attr('submodule_class');
                    $('#id_add_mes_sub_class').val(submodule_class);
                }

                $('#id_a_share_with').html($(this).attr('parent') + '...');
            //$('#id_smenu_sharewith').hide();
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

        //Sow/Hide tags/fav/del/edit blocks
        if ($('.cl_wall_mes').unbind('mouseover'))
        {
            $('.cl_wall_mes').mouseover(function () {
				
                var mid = $(this).attr('mid');
                if (mid) {
                    $('.tlink').css({
                        'visibility': 'hidden'
                    });
                    $('.cl_del_link').css({
                        'visibility': 'hidden'
                    });
					
                    $('.tlink[mid='+mid+']').css({
                        'visibility': 'visible'
                    });
                    $('.cl_del_link[mid='+mid+']').css({
                        'visibility': 'visible'
                    });
                } 
            }); 
        }
		
        //Sow/Hide tags/fav/del/edit blocks
        if ($('.cl_wall_mes').unbind('mouseout'))
        {
            $('.cl_wall_mes').mouseout(function () {
                $('.tlink').css({
                    'visibility': 'hidden'
                });
                $('.cl_del_link').css({
                    'visibility': 'hidden'
                });
            });
        }
		
        //init Upload Photo objects
        var wid = $('#wid').val();

        if (!ufy_ready)
        {
            ufy_ready = true;
            $('#ufy_plch').uploadify({
                'uploader'      : flDir+ '/uploadify.swf',
                'script'        : siteAdr+'wards/id'+wid+'/wall/chkuplphoto/',
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
                        oWWall.CreateLinkUploaded(response.image);
                    }

                    if (response.status == 'err') {
                        alert('Error happened :( ');
                    }
                },
                onAllComplete: function () {
                    $('#id_send_block_mes, #id_uploaded_photo_choose_file').show();
                    $('#id_send_block_photo_choose_file, #id_uploaded_mes').hide();
                    $('.share-white-b').show();
                    $('#ufy_plch_list').html('');
                    $('.share-white-b img').attr('src', '/i/add_b2.gif')
                //oWall.ChngSendBlock( 'mes' );
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
            oWWall.ChckEvDate( 'id_send_inp_ev_dt' );
		
        $('.cl_send_block').hide();
        var attached = $('#id_place_to_attach: input').html();
        if (attached)
            $('#id_send_block_'+smtype).html(attached);
		
        $('#id_send_block_'+smtype).show();
        if ('ev' != smtype || !showed[smtype]) {
            NFFix();
        } else {
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

        if(cur_stamp > event_stamp)
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


        oWWall.AttachBlock('ev');
    },


    /**
	 * Attach blocks with Enclose while the Message is adding
	 * 
	 * @param smtype ('ev'-event, 'link'-link, 'photo'-photo, 'video'-video)
	 */
    AttachBlock: function ( smtype ) {
        if ('ev' == smtype)
            oWWall.ChckEvDate( 'id_send_inp_ev_dt' );
        else if ('video_code' == smtype)
            $('#id_send_inp_video_code_link').val($('#id_send_txt_video_code_link').val());
		
        $('.cl_err').html('');
        var n_data = oWWall._initNecData( smtype );	//init necessary data
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
                var n_inp_val = '';
                if ('video_code' == smtype)
                    n_inp_val = $('#id_send_txt_video_code_link').val()
                else
                    n_inp_val = $('#id_send_inp_'+smtype+'_'+n_data[j]).val();

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
                    var vrf_link = verify_embed_code(n_inp_val);
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
                                $('#id_uploaded_video_code_lable').css('cursor', 'default');
                                $('#id_uploaded_video_code_lable').hover(function(){
                                    $(this).css('text-decoration', 'none')
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
                else if ('photo_url' == smtype) 	//check photo link
                {
                    var vrf_link = verify_url(n_inp_val);
                    if (!vrf_link) {
                        alert ('Invalid link.');
                        return false;
                    }
                }
                else if (null != n_inp_val && '' != n_inp_val)
                    var vrf_link = true;
				
                if (!vrf_link || false == vrf_link || 'undefined' == vrf_link)
                {
                    $('#id_err_'+smtype+'_'+n_data[j]).html('*');	//error Exception
                    errs.push(n_data[j]);
                }
                else if ('ev' == smtype)
                {
                    $('#id_uploaded_ev_lable').html($('#id_send_inp_ev_title').val()+' at '+$('#id_send_inp_ev_where').val()+' on '+$('#id_send_inp_ev_dt').val());
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
				
                $('#id_place_to_attach').html(att_block);
                $('#id_uploaded_mes').hide();
                $('#id_uploaded_'+smtype).show();
                oWWall.ChngSendBlock( 'mes' );	//redirect to the mes module
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
              oWWall.AddMes('id_frm_add_mes');
            }
            else
            {
              oWWall.ChngSendBlock( 'mes' );	//redirect to the mes module
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
            cache: true,
            mode: 'abort',
            port: 'addmes',
            data: {
                'ajaxinit': 1
            },
            success: function(r) {
                $('#id_eclipse_img_bckgrnd').hide();
                if ('not_success' != r)
                {
                    $('#id_div_empty_mes').remove();
                    $('#id_mes_list').html(r + $('#id_mes_list').html());

                    $('#id_share_attention_badge').hide();
                    $('#id_share_with').show();

                    oWWall._initInterface();	//refresh Interface


                    $('#id_ul_upl_photo li').remove();
                    $('#id_send_inp_photo_url_link').val('');
                    $('#id_send_inp_video_code_link').val('');
                    $('#id_uploaded_ev_lable').html('');
                    $('#id_send_inp_link_url').val('');
                    $('#id_send_inp_mes_story').val('');

                }
                setTimeout('$(\'#id_eclipse_img_bckgrnd\').hide();', 300);
            }
        };
		
        var errs = new Array();
        var att_frm = $('#id_place_to_attach').html();
        var mes_story = $('#id_send_inp_mes_story').val();
        var max = parseInt($('#id_send_inp_mes_story').attr('maxlength'));
alert(max);
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

        if(mes_story.length > max)
        {
            errs.push(1);
            //badge maxlenght
            if (mes_story == $('#id_send_badge_b_story').val())
                {
                    $('#id_share_attention_badge').show();
                    $('#id_share_with').hide();
                }
                else
                {

                    //$('#id_send_inp_mes_story').val(mes_story.substr(0, max));
                    $('#id_refill_txt_ntf').show();
                    $('.cl_a_btn_share').attr({
                        'href': 'javascript: void(0)'
                    });
                    $('.cl_img_btn_share').attr({
                        'src': imgDir + 'share_b.gif'
                    });
                    $('#id_share_attention').show();
                    $('#id_share_with').hide();
                }
        }
        else
        {
            var reg = /Share your thoughts/i;
            if (reg.test($('#id_send_inp_mes_story').val()))
            {
                $('#id_send_inp_mes_story').val('');
            }

            var has_photos = $('#id_ul_upl_photo li').length > 0;
            var has_photo_link = $('#id_send_inp_photo_url_link').val() != '';
            var has_video = $('#id_send_inp_video_code_link').val() != '';
            var has_event = $('#id_uploaded_ev_lable').html() != '';
            var has_link = $('#id_send_inp_link_url').val() != '';
            var message = $('#id_send_inp_mes_story').val();

            //alert('photo_link:'+has_photo_link + 'photos:'+has_photos + ', videos:' + has_video + ', event:'+has_event + ', link:'+has_link);

            if(!message && !has_link && !has_event && !has_video && !has_photos && !has_photo_link)
                return false;
        }
        
        if (!errs.length)
        {
            $('#id_eclipse_img_bckgrnd').show();
            /*
            var pr1 = $('#id_add_mes_privacy').val();
            var pr2 = $('#id_add_mes_sub_module').val();
            var pr3 = $('#id_add_mes_sub_module_val').val();

            
            $('#id_place_to_attach').html('');
            $('#id_place_to_attach').append('<input type="hidden" value="'+pr1+'" name="SI[privacy]" id="id_add_mes_privacy">\n\
					     <input type="hidden" value="'+pr2+'" name="SI[sub_privacy_module]" id="id_add_mes_sub_module">\n\
					     <input type="hidden" value="'+pr3+'" name="SI[sub_privacy_module_val]" id="id_add_mes_sub_module_val">');
            */
            $('#id_send_inp_mes_story').css('color', 'gray');

            $('#id_ul_upl_photo li').remove();

            $('#' + id_frm).ajaxSubmit(options);
        }
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
                    oWWall._initInterface();	//refresh Interface
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
                    oWWall._initListeners();	//refresh Listeners
                }
            }
        };
        $('#' + frm).ajaxSubmit(options);
    }, /* EditMes */

    DelMes: function ( id ) {
        if (id)
        {
            var wid = $('#wid').val();
            $.post(siteAdr+'wards/id'+wid+'/wall/delajax', {
                'mes_id': id,
                'ajaxinit': 1
            }, function(r) {
                if ('not_success' != r)
                {
                    $('#id_wall_mes_'+id).hide();
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
                        oWWall._initListeners();	//refresh Listeners
                    }
                }
            };
            $('#' + frm).ajaxSubmit(options);
        }
    }, /* EditMesAnsw */

    AddBadgeTab: function () {

            $('#show_badge_tab').slideToggle('fast');
            $("#show_badge_tab").mouseout(function() {
                    $(this).hide();
                });
            $("#show_badge_tab").mouseover(function() {
                $(this).show();
            });
    },  /* AddBadgeTab */

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
        else if (id == 'badge')
        {
            $('#show_smile_tab_badge').slideToggle('fast');
            $('#show_smile_tab_badge').mouseout(function() {
                    $(this).hide();
                });
            $('#show_smile_tab_badge').mouseover(function() {
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
	 */
    GetList: function ( wid, last_id, sf_type, sf, append ) {
		
        if (wid)
        {
			
            if (('' == sf_type || null == sf_type || 'undefined' == sf_type) && (null == sf || 'undefined' == sf || '' == sf))	//exactly is not with filters
            {
                sf_type = '';
                sf = '';
            }
            if (null == append || 'undefined' == append)
                append = '';
			
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
                    'ajaxinit': 1
                },
                url: siteAdr+'wards/id' + wid + '/wall/getlistajax',
                success: function(r)
                {
                    if ('not_success' != r)
                    {
                        $('#id_div_show_more_mes').remove();
                        if (append)
                            $('#id_mes_list').html($('#id_mes_list').html() + r);
                        else
                            $('#id_mes_list').html(r);
                        oWWall._initListeners();	//refresh Listeners
                    }
                    setTimeout('$(\'#id_eclipse_img_bckgrnd\').css({\'display\': \'none\'})', 200);	//show eclipsed background
                    oWWall._initListeners();	//refresh Listeners
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
    GetAnswList: function ( wid, mid, pcnt, rcnt ) {
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
            url: siteAdr+'wards/id' + wid + '/wall/getanswlistajax',
            success: function(r)
            {
                if ('not_success' != r)
                {
                    $('#id_mes_answ_list_'+mid).html(/*$('#id_mes_answ_list_'+mid).html() + */r);
                    $('#id_div_show_more_answ_'+mid).hide();
                    oWWall._initListeners();	//refresh Listeners
                }
            }
        });
    },
	
    SHConfirmPopup: function ( action, id_popup, ward_id, active ) {
        if (1 == action)	//show
        {
            $('#id_ward_set_id').val(ward_id);
            $('#id_eclipse_bckgrnd').css({
                'display': 'block'
            });	//show eclipsed background
            $("#"+id_popup).fadeIn(300);
        }
        else
        {
            if ($('#'+id_popup).fadeOut(300))
                $('#id_eclipse_bckgrnd').hide();	//hide eclipsed background
        }
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
		
        //var strEvDate =  objEvDate.hour_min_meridian + ' ' + objEvDate.day + '/' + objEvDate.month + '/' + objEvDate.year;
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

    }, /* UplPhotoComplete */

    CreateLinkUploaded: function(image_src) {
        var p_img_src = image_src;/*$(p_img[i]).val();*/
        var li = document.createElement('li');
        var img = document.createElement('img');
        img.src = fImgDir+'wards/wall/_temp/'+p_img_src;
        img.width = 33;
        img.height = 25;
        var a = document.createElement('span');
        a.innerHTML = p_img_src.substring(0, 10)+((10 < p_img_src.length) ? '...' : '');
        $(li).append($(img));
        $(li).append($(a));
        $('#id_ul_upl_photo').append(li);

        if ($('#id_place_to_attach').find('#s_mtype').length == 0)
        {
            $('#id_place_to_attach').append('<input type="hidden" name="WI[mtype]" value="4 />"');
        }
        $('#id_place_to_attach').append('<input value="'+image_src+'" name="WI[p_img][]" />');
    },
	
    /**
	 * Create Links & Images of the uploaded Photos
	 */
    CrLinksUplData: function( smtype ) {
    
    }, /* CrLinksUplData */
	
    YTDone: function(id) {
        $('#id_send_inp_video_choose_file_v_unid').val(id);
        oWWall.AttachBlock( 'video_choose_file' );
    },
	
    DoYTUpl: function(eg, url) {
        $('#id_frm_video_upl').attr('action', url);
        $('#id_frm_video_upl').submit();
        oWWall.YTDone(eg);
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
                        
                    oWWall.DoYTUpl(r['unid'], r['url']);
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
                        setTimeout('oWWall.ChkVideo('+r['id']+')', 1000);
                }
            }
        });
    }
}

var oWWall = new WWall();