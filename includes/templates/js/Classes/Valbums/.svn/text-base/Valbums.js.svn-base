/**
 * Valbums's Wall jsController
 * 
 * @package    5dev Valbums
 * @version    1.0
 * @since      4.04.2010
 * @copyright  2010 5dev Team
 * @link       http://5dev.com
 */

function Valbums() { 
    this.__construct( );
}

Valbums.prototype = { 
    __construct: function() {
        crand = rand(999, 99999999);	//special numer for video & video
    }, /* __construct */
	
    //---- System Methods
	
    /**
	 * Initialization of the Interfaces
	 */
    _initInterface: function () {
        oValbums._initListeners();
        oValbums._initDefaultSettings();
    },  /* initInterface */
	
    /**
	 * Initialization of the constant Event's Listeners
	 * Set Necessary values for the fields
	 */
    _initListeners: function () {
        if ($(".cl_valbums_show_filts").unbind('click'))
        {
            $('.cl_valbums_show_filts').click(function () {
                $('#id_eclipse_img_bckgrnd').css({
                    'display': 'block'
                });	//show eclipsed background
                $('.cl_valbums_lists').hide();
                if (1 == $(this).attr('stype'))	//show all
                {
                    $('#id_valbums_system_list').show();
                    $('#id_valbums_user_list').show();
                }
                else if (2 == $(this).attr('stype'))	//show system
                    $('#id_valbums_system_list').show();
                else if (3 == $(this).attr('stype'))	//show user's
                    $('#id_valbums_user_list').show();
                setTimeout('$(\'#id_eclipse_img_bckgrnd\').hide()', 200);
            });
        }
	     
        oSystem.SHDeleteLinks('cl_valbums_list', 'cl_del_link', 'vaid');

        //init CRAND	//random number for videos
        crand = rand(1, 100000);
    }, /* initListeners */
	
    _initDefaultSettings: function (  ) {
        $('#id_upl_popup_close').show();
        $('#id_upl_popup_cancel').show();
        $('#id_upl_popup_add').show();
		
        setTimeout('$(\'#id_add_album_popup\').css({\'display\': \'none\', \'visibility\': \'visible\'})', 300);
        setTimeout('$(\'#id_upl_photo_popup\').css({\'display\': \'none\', \'visibility\': \'visible\'})', 300);
        $('.NFSelect').remove();
        NFFix();
    }, /* _initDefaultSettings */
	
    SHConfirmPopup: function ( action, id_popup ) {
        if (1 == action)	//show
        {
            $('#id_eclipse_bckgrnd').show();	//show eclipsed background
            $("#"+id_popup).fadeIn(300);
        }
        else
        {
            if ($('#'+id_popup).fadeOut(300))
                $('#id_eclipse_bckgrnd').hide();	//hide eclipsed background
        }
    },  /* SHConfirmPopup */
    
    SHUplPopup: function ( action, id_popup, album_id ) {
        if (1 == action)	//show
        {
            //$('#id_mission_set_id').val(mission_id);
            $('#id_eclipse_bckgrnd').show();	//show eclipsed background
            $("#"+id_popup).fadeIn(300);

			$('#id_upl_video_album option[selected=selected]').attr('selected', '');
			$('#id_upl_video_album option[value='+album_id+']').attr('selected', 'selected');
            
            NFFix();

        }
        else
        {
            if ($('#'+id_popup).fadeOut(300))
                $('#id_eclipse_bckgrnd').hide();	//hide eclipsed background
        }
    }, /* SHUplPopup */
    
    SHChngPopup: function ( action, id_popup ) { 
        if (1 == action)	//show
        {
            $('#id_eclipse_bckgrnd').show();	//show eclipsed background
            $("#"+id_popup).fadeIn(300);
			NFFix();
        }
        else
        {
            if ($('#'+id_popup).fadeOut(300))
                $('#id_eclipse_bckgrnd').hide();	//hide eclipsed background
        }
    }, /* SHChngPopup */
	
	
	
	
    //---- Main Methods
	
    /**
	 * Upload Video
	 * 
	 * @param id - Flash Button ID
	 */	
    
    AddValbum: function ( id_frm ) {

		if ($('#id_upl_video_title').val() == '')
			{
				alert('Please, fill the "title" field.')
				return false;
			}

        var options = {
            data: {'ajaxinit': 1},
            success: function(r) {
                if ('not_success' != r)
                {
                    $('#id_new_alb_list').html(r + $('#id_new_alb_list').html());
                    $('.box001').hide();
                    $('#id_add_valbum_popup').hide();
                    oValbums._initListeners();	//refresh Interface
					$('#id_upl_video_title').val('');
					$('#id_upl_video_descr').val('');
                }
				else
				{
					alert('Error happened while adding new album. Please, check the "name" field to be non-empty and correct');
					$('.box001').hide();
					$('#id_add_valbum_popup').hide();
				}
                setTimeout('$(\'#id_eclipse_bckgrnd\').hide()', 200);
            }
        };
        $('#' + id_frm).ajaxSubmit(options);
    }, /* AddValbum */
    
    ReloadVideoBoxCom: function ( act, vaid, vid, fcnt, direct ) {	//show navigation's links on the image
        $('#id_eclipse_img_bckgrnd').show();	//show eclipsed background
        if (1 == act)	//reload com area
        {
            //direct - 1: plus; 2: minus;
            $.ajax({
                type: 'POST',
                cache: true,
                mode: 'abort',
                port: 'reloadvideoboxcom',
                data: {
                    'vid': vid,
                    'vaid': vaid,
                    'fcnt': fcnt,
                    'direct': direct,
                    'rtype': 'com',
                    'ajaxinit': 1
                },
                url: siteAdr+'base/valbums/geteditvideoajax',
                success: function(res_data)
                {
						
                    $('#id_video_box_com').html(res_data);
                    $('#id_video_com_text').attr({
                        'value': ''
                    });
                    setTimeout('$(\'#id_eclipse_img_bckgrnd\').hide()', 300);
                }
            });
        }
        else if (2 == act)	//send com
        {
            var options = {
                data: {'ajaxinit': 1},
                success: function(res_data) {
                    $('#id_video_box_com').html(res_data);
                    $('#id_video_com_text').attr({
                        'value': ''
                    });
                    setTimeout('$(\'#id_eclipse_img_bckgrnd\').hide()', 300);
                }
            };
            $('#id_video_com_frm').ajaxSubmit(options);
        }
    }, /* ReloadVideoBoxCom */
	
    ReloadVideoContent: function ( vaid, vid ) {
        if (!vid) var vid = '';
        $('#id_eclipse_img_bckgrnd').show();	//show eclipsed background
        $.ajax({
            type: 'POST',
            cache: true,
            mode: 'abort',
            dataType: 'json',
            port: 'reloadvideocontent',
            data: {
                'vid': vid,
                'vaid': vaid,
                'rtype': 'all',
                'ajaxinit': 1
            },
            url: siteAdr+'base/valbums/geteditvideoajax',
            success: function(res_data)
            {
                if ($('#id_place_video_content').html(res_data[2]) && $('#id_video_right_col').html(res_data[3]))
                {
                    setTimeout('oValbums._initPInterface( \''+res_data[0]+'\', \''+res_data[1]+'\' )', 500);
                    setTimeout('$(\'#id_eclipse_img_bckgrnd\').hide()', 300);
                }
            }
        });
    }, /* ReloadVideoContent */
    
    DelAlbum: function ( vaid, type ) {
        $.post(siteAdr+'id'+UserOtherID+'/valbums/delajax?ajaxinit=1', {
            'vaid': vaid
        }, function(r) {
            if ('not_success' != r)
            {
                $('#id_valbums_el_'+type+'_'+vaid).remove();
                if (jQuery.trim($('#all_alb_list').html())=='') {
                    $('#all_alb_list').html('<div class="box001"><div class="post-box">You don\'t have any albums</div></div>');
                }
            }
        });
    }, /* DelAlbum */

    DelVideo: function () { 
        var vaid = $('#vaid').val();
        var vid = $('#vid').val();
        if (vaid && vid)
        {
            $('#id_eclipse_img_bckgrnd').show();	//show eclipsed background
            $.ajax({
                type: 'POST',
                cache: true,
                mode: 'abort',
                port: 'delvideo',
                data: {
                    'vid': vid,
                    'vaid': vaid,
                    'ajaxinit': 1
                },
                url: siteAdr+'base/valbums/delvideoajax',
                success: function(r) {
                    if ('not_success' != r) {
                        Go(siteAdr+'id'+UserID+'/valbums/id'+r);
                    }
                    if ($('#id_confirm_valbums_popup').fadeOut(300)) {
                        $('#id_eclipse_bckgrnd').hide();	//hide eclipsed background
                    }
                }
            });
        }
    }, /* DelVideo */
    
    EmbingVideo: function ( id_frm ){ 
        var ch_code = verify_embed_code($('#id_upl_video_code').val());

        if ($('#id_upl_video_code').val())
        {
            $.get(siteAdr + 'base/valbums/getevideoiajax', {
                'video': $('#id_upl_video_code').val(),
                'ajaxinit': 1
            },
            function(r)
            {
                if (r != 'not_success')
                {
                    $('#id_upl_video_val').val($('#id_upl_video_code').val());
                    var options = {
                        data: {'ajaxinit': 1},
                        success: function(r)
                        {
                            if ('not_success' != r)
                                Go(siteAdr + 'id' + UserID + '/valbums/id' + r);

                        }
                    };
                    $('#' + id_frm).ajaxSubmit(options);
                }
            });
        }
    }, /* UplPhotoSendData */
    
    
    ChngValbums: function () {
        var vid 	= $('#vid').val();
        var new_vaid = $('#id_chng_valbum_album').val();
        if (new_vaid && vid)
        {
            $('#id_eclipse_img_bckgrnd').show();	//show eclipsed background
            $.ajax({
                type: 'POST',
                cache: true,
                mode: 'abort',
                port: 'chngvalbums',
                data: {
                    'vid': vid,
                    'vaid': new_vaid,
                    'ajaxinit': 1
                },
                url: siteAdr+'base/valbums/chngvalbums',
                success: function(r)
                {
					if (r == 'hold_still')
						alert('Video was successfully copied');
                    else if ('not_success' != r)
                        Go(siteAdr+'id'+UserID+'/valbums');

					//$('#id_alb_photos_cp_'+pid).hide();
                    if ($('#id_chng_valbum_popup').fadeOut(300)) {
                        $('#id_eclipse_bckgrnd').hide();	//hide eclipsed background
                        $('#id_eclipse_img_bckgrnd').hide();	//hide eclipsed background
                    }
                }
            });
        }
		NFFix();
    } /* ChngValbums */
}

var oValbums = new Valbums();