/**
 * Albums's Wall jsController
 * 
 * @package    5dev Albums
 * @version    1.0
 * @since      4.04.2010
 * @copyright  2010 5dev Team
 * @link       http://5dev.com
 */

function Albums() { 
    this.__construct( );
}

Albums.prototype = {
    __construct: function() {
        crand = rand(999, 99999999);	//special numer for photo & video
    }, /* __construct */
	
    //---- System Methods
	
    /**
	 * Initialization of the Interfaces
	 */
    _initInterface: function () {
        oAlbums._initListeners();
        oAlbums._initDefaultSettings();
    },  /* initInterface */
	
    /**
	 * Initialization of the constant Event's Listeners
	 * Set Necessary values for the fields
	 */
    _initListeners: function () {
        if ($(".cl_albums_show_filts").unbind('click'))
        {
            $('.cl_albums_show_filts').click(function () {
                $('#id_eclipse_img_bckgrnd').css({
                    'display': 'block'
                });	//show eclipsed background
                $('.cl_albums_lists').hide();
                if (1 == $(this).attr('stype'))	//show all
                {
                    $('#id_albums_system_list').show();
                    $('#id_albums_user_list').show();
                }
                else if (2 == $(this).attr('stype'))	//show system
                    $('#id_albums_system_list').show();
                else if (3 == $(this).attr('stype'))	//show user's
                    $('#id_albums_user_list').show();
                setTimeout('$(\'#id_eclipse_img_bckgrnd\').hide()', 200);
            });
        }

		$('#id_upl_photo_title').val('');
		$('#id_upl_photo_loc').val('');
		$('#id_upl_photo_descr').val('');
		
        //init Upload Photo objects
        var fl_btn_ex = $('#id_span_upl_btn').attr('id');
        if (fl_btn_ex)
        {
            window.onload = function() {
//                var settings = {
//                    flash_url : flDir+'SWFUpload/swfupload.swf',
//                    upload_url: siteAdr+'id'+UserOtherID+'/albums/chkuplphoto/?pcash='+rand(1, 10000),
//                    //file_size_limit : '0.5 MB',
//                    file_types : "*.jpg; *.gif; *.png; *.jpeg;",
//                    file_types_description: "Image Files",
//                    file_upload_limit : 3,
//                    file_queue_limit : 3,
//                    custom_settings : {
//                        progressTarget : 'id_photo_upl_pr_ol'
//                    },
//
//                    // Button settings
//                    button_image_url: imgDir+'uploadPhoto.gif',
//                    button_width: '84',
//                    button_height: '28',
//                    button_placeholder_id: 'id_span_upl_btn',
//
//                    // The event handler functions are defined in handlers.js
//                    file_queued_handler : fileQueued,
//                    file_queue_error_handler : fileQueueError,
//                    upload_start_handler : uploadStart,
//                    upload_progress_handler : uploadProgress,
//                    upload_error_handler : uploadError,
//                    upload_success_handler : uploadSuccess
//                };
				
                //oUplPhoto = new SWFUpload(settings);
            };
        }

/*		$('#fd_photos').MultiFile({
			max: 3,
			accept: 'gif|jpg|png|jpeg',
			STRING: { remove: '<img src="'+imgDir+'close_ico.gif" height="8" width="8" alt="x"/>' },
			list: '#sphotos_list',
			afterFileAppend: function (element, value, master_element) {},
			afterFileRemove: function (element, value, master_element) {}
		}); */



		$('#fd_photos').uploadify({
			'uploader'  : flDir+ '/uploadify.swf',
			'script'    : siteAdr+'id'+UserOtherID+'/albums/chkuplphoto/?pcash='+rand(1, 10000),
			'fileDataName' : 'Filedata',
			'auto'      : false,
			'multi'		: true,
			'queueID' : 'sphotos_list',
			'fileDesc'	: 'Images',
			'fileExt'	: '*.jpeg;*.jpg;*.png;*.gif',
			'sizeLimit' :   10 * 1024 * 1024,
			'buttonImg'     : imgDir+'browse2.png',
			'cancelImg' : imgDir+'close_ico.gif',
			'queueSizeLimit' : 3,
			'width'		: 79,
			'height'	: 25,
			 onComplete : function(event,queueID,fileObj,response,data) {
				//alert('complete: '+response.status);
				if (response.status == 'err') {
					alert('Error happened :( ');
				}
			 },

			 //onError : function(event, queueID, fileObj, errorObj) {alert('error: '+errorObj.info)},



			 onAllComplete: function () {
				 $('#photos_status_td').html('Uploading complete! Refreshing page...');
				 document.location = location.href;
			 }
			
		});

	/*	$("#fd_photos").filestyle({image: imgDir+'uploadPhoto.gif', imageheight : 28, imagewidth : 84});
        $("#fd_photos").css('display','block'); */


        $('#id_upl_photo_loc').autocomplete(siteAdr+'security/users/AjaxCities?ajaxinit=1',
        {
            delay:        200,
            cacheLength:  7,
            minChars:     2,
            width:        295,
            formatItem:   oUsers.formatItem,
            formatResult: oUsers.formatItem
        });

        //oSystem.SHDeleteLinks('cl_albums_list', 'cl_del_link', 'aid');
	     
        //init CRAND	//random number for photos
        crand = rand(1, 100000);
    }, /* initListeners */
	
    _initDefaultSettings: function (  ) {
        $('#id_upl_popup_close').show();
        $('#id_upl_popup_cancel').show();
        $('#id_upl_popup_add').show();
		
        setTimeout('$(\'#id_add_album_popup\').css({\'display\': \'none\', \'visibility\': \'visible\'})', 300);
        setTimeout('$(\'#id_upl_photo_popup\').css({\'display\': \'none\', \'visibility\': \'visible\'})', 300);
        
		//$('.NFSelect').remove();
        NFFix();
    }, /* _initDefaultSettings */
	
    SHConfirmPopup: function ( action, id_popup, pid ) {
        if (1 == action)	//show
        {
            $('#id_eclipse_bckgrnd').show();	//show eclipsed background
            $("#"+id_popup).fadeIn(300);
            if ( 'undefined' != pid && null != pid && '' != pid )
                $('#id_del_alb_cpid').val(pid);
        }
        else
        {
            if ($('#'+id_popup).fadeOut(300))
                $('#id_eclipse_bckgrnd').hide();	//hide eclipsed background
            $('#id_del_alb_cpid').val('');
        }
    },  /* SHConfirmPopup */
    
    SHUplPopup: function ( action, id_popup, album_id ) {
        if (1 == action)	//show
        {
            //$('#id_mission_set_id').val(mission_id);
            $('#id_eclipse_bckgrnd').show();	//show eclipsed background
            $("#"+id_popup).fadeIn(300);

			$('#id_upl_photo_album option[selected=selected]').attr('selected', '');
			$('#id_upl_photo_album option[value='+album_id+']').attr('selected', 'selected');

			NFFix();
        }
        else
        {
            if ($('#'+id_popup).fadeOut(300))
                $('#id_eclipse_bckgrnd').hide();	//hide eclipsed background
        }
    }, /* SHUplPopup */
    
    SHChngPopup: function ( action, id_popup, pid, album_id ) {
        if (1 == action)	//show
        {
            $('#id_eclipse_bckgrnd').show();	//show eclipsed background
            $("#"+id_popup).fadeIn(300);
            if ( 'undefined' != pid && null != pid && '' != pid )
                $('#id_chng_alb_cpid').val(pid);

			NFFix();

			if (album_id > 0) {
				var opt = $('#id_chng_album_album option[value='+album_id+']');
				var opt_index = $('#id_chng_album_album option').index(opt);
				
				$('#id_send_frm_photo_choose_file ul.NFSelectOptions li:nth-child('+(opt_index+1)+')').hide();
			} 

        }
        else
        {
			$('#id_send_frm_photo_choose_file ul.NFSelectOptions li').show();
            if ($('#'+id_popup).fadeOut(300))
                $('#id_eclipse_bckgrnd').hide();	//hide eclipsed background
            $('#id_chng_alb_cpid').val('');
        }
    }, /* SHChngPopup */
	
	
	
	
    //---- Main Methods
	
    /**
	 * Upload Photo
	 * 
	 * @param id - Flash Button ID
	 */	
    
    AddAlbum: function ( id_frm ) { 
        var options = {
            data: {'ajaxinit': 1},
            success: function(r) {
                if ('not_success' != r)
                {
                    $('#id_new_alb_list').html(r + $('#id_new_alb_list').html());
	            $('.box001').hide();
                    $('#id_add_album_popup').hide();
                    oAlbums._initListeners();	//refresh Interface
                    oAlbums.SHUplPopup( 2, 'id_album_photo_new_message' );
                }
				else
				{
					$('#id_add_album_popup').hide();
				}
                setTimeout('$(\'#id_eclipse_bckgrnd\').hide()', 200);
            }
        };

		if ('' == $('#id_upl_photo_title').val())
		{
			alert('Please, fill the "title" field');
			return false;
		}

        $('#' + id_frm).ajaxSubmit(options);
    }, /* AddAlbum */



    UplPhotos: function() {

		if($('#sphotos_list div').length > 0)
		{
			$('#id_upl_popup_add').unbind('click');
			$('#photos_status_td').html('Loading images, please wait...');

			//		$('#id_frm_upl_photo').append('<input type="hidden" name="aid" value="'+$('#id_upl_photo_album').val()+'" />');
			//		$('#id_frm_upl_photo').append('<input type="hidden" name="crand" value="'+crand+'" />');

			$('#fd_photos').uploadifySettings('scriptData', {
				'omni3id' : SSesID,
				'crand': crand,
				'aid': $('#id_upl_photo_album').val(),
				'descr': $('#id_upl_photo_descr').val()
				});
			$('#fd_photos').uploadifyUpload();
		}
		else
		{
			alert('Please, choose photos first');
		}
		return false;
    }, /* UplPhoto */
    
    UplPhotoSendData: function ( id_frm ){
		return false;
		
    }, /* UplPhotoSendData */
	
    UplPhotoComplete: function ( str ) {
		return false;
       
    },  /* UplPhotoComplete */
	
	
    //---- Additional Methods
	
    _initPInterface: function( pimg, nimg ) {		//initialization of the Photo Interface
        //$('#cur_img').imgAreaSelect({disable: true});
		
        if (!pimg) var pimg = 0;
        if (!nimg) var nimg = 0;
		
        setTimeout('oAlbums.SIArrs( '+pimg+', '+nimg+' )', 1000);

		$('#albums_tag_input').keyup(function(){
			var img = $(this).prev().children('img');
			if ($(this).val().length > 0)
				$(img).attr('src', '/i/add_b3a.gif');
			else
				$(img).attr('src', '/i/add_b3.gif');
		})

        $('#albums_tag_input').autocomplete(siteAdr+'base/albums/searchtagajax?ajaxinit=1',
        {
            delay:        200,
            cacheLength:  7,
            minChars:     2,
            width:        295
        });
    }, /* _initPInterface */
	
    SIArrs: function ( pimg, nimg ) {	//show navigation's links on the image
        var wimg   = _v('id_img_b').width;
        var himg   = _v('id_img_b').height;
	    
        var warr = _v('id_arr_left').width;
        $('#id_arr_left').css({
            'top': (himg-49)/2,
            'left': (658-wimg)/2
            });
	    
        if (navigator.appName != 'Opera')
            $('#id_arr_right').css({
                'top': (himg-49)/2,
                'left': ((658-wimg)/2)+wimg-49
                });
        else
            $('#id_arr_right').css({
                'top': (himg-49)/2,
                'left': ((658-wimg)/2)+wimg-49
                });
	    
        if (pimg)
            $('#id_arr_left').css({
                'visibility': 'visible'
            });
        if (nimg)
            $('#id_arr_right').css({
                'visibility': 'visible'
            });
    }, /* _initPInterface */
    
    ReloadImgBoxCom: function ( act, aid, pid, fcnt, direct ) {	//show navigation's links on the image
        $('#id_eclipse_img_bckgrnd').show();	//show eclipsed background
        if (1 == act)	//reload com area
        {
            //direct - 1: plus; 2: minus;
            $.ajax({
                type: 'POST',
                cache: true,
                mode: 'abort',
                port: 'reloadimgboxcom',
                data: {
                    'pid': pid,
                    'aid': aid,
                    'fcnt': fcnt,
                    'direct': direct,
                    'rtype': 'com',
                    'ajaxinit': 1
                },
                url: siteAdr+'id'+UserOtherID+'/albums/geteditphotoajax',
                success: function(res_data)
                {
                    $('#id_img_box_com').html(res_data);
                    $('#id_photo_com_text').attr({
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
                    $('#id_img_box_com').html(res_data);
                    $('#id_photo_com_text').attr({
                        'value': ''
                    });
                    setTimeout('$(\'#id_eclipse_img_bckgrnd\').hide()', 300);
                }
            };
            $('#id_img_com_frm').ajaxSubmit(options);
        }
    }, /* ReloadImgBoxCom */

    ResizeUrlImage: function (pimg, nimg) {
        
        if (parseInt($('#id_img_b').css('height'))>439){
            $('#id_img_b').css('height','439px');
            if (parseInt($('#id_img_b').css('width'))>600){
                $('#id_img_b').css('width','600px');
            }
        }else
            if (parseInt($('#id_img_b').css('width'))>600){                
                $('#id_img_b').css('width','600px');
            }

        oAlbums._initPInterface(pimg,nimg);
        setTimeout('$(\'#id_eclipse_img_bckgrnd\').hide()', 300);
        $('#id_img_b').css('visibility','visible');

    },

    ReloadImgContent: function ( aid, pid ) {
        if (!pid) var pid = '';
        $('#id_eclipse_img_bckgrnd').show();	//show eclipsed background
        $.ajax({
            type: 'POST',
            cache: true,
            dataType: 'json',
            data: {
                'pid': pid,
                'aid': aid,
                'rtype': 'all',
                'ajaxinit': 1
            },
            url: siteAdr+'id'+UserOtherID+'/albums/geteditphotoajax',
			success: function(res_data)
            { 
                if ($('#id_place_img_content').html(res_data[2]) && $('#id_photo_right_col').html(res_data[3]))
                {
					$('#id_img_b').load(function(){
						setTimeout('oAlbums._initPInterface( \''+res_data[0]+'\', \''+res_data[1]+'\' )', 500);
						setTimeout('$(\'#id_eclipse_img_bckgrnd\').hide()', 300);
					});
                    
                }
				$('#id_album_photo_share').replaceWith(res_data[4]);
            }
        });
    }, /* ReloadImgContent */
    
    DelAlbum: function ( aid, type ) {
        $.post(siteAdr+'id'+UserOtherID+'/albums/delajax', {
            'aid': aid,
            'ajaxinit': 1
        }, function(r) {
            if ('not_success' != r)
            {
                $('#id_albums_el_'+type+'_'+aid).remove();
                if (jQuery.trim($('#all_alb_list').html())=='') {
                    $('#all_alb_list').html('<div class="box001"><div class="post-box">You don\'t have any albums</div></div>');
                }
            }
        });
    }, /* DelAlbum */

    DelPhoto: function () { 
        var aid = $('#aid').val();
        var pid = $('#id_del_alb_cpid').val();
        if (!pid)
            var pid = $('#pid').val();
    	
        if (aid && pid)
        {
            $('#id_eclipse_img_bckgrnd').show();	//show eclipsed background
            $.ajax({
                type: 'POST',
                cache: true,
                mode: 'abort',
                port: 'delphoto',
                data: {
                    'pid': pid,
                    'aid': aid,
                    'ajaxinit': 1
                },
                url: siteAdr+'base/albums/delphotoajax',
                success: function(r)
                {
                    if ('not_success' != r)
                    {
                        if ('hidden' != $('#id_arr_right').css('visibility'))
                            $('#id_arr_right').click();
                        else if ('hidden' != $('#id_arr_left').css('visibility'))
                            $('#id_arr_left').click();
                        else
                            Go(siteAdr+'id'+UserID+'/albums');
                        $('#id_alb_photos_cp_'+pid).hide();
                    }
                    if ($('#id_confirm_albums_popup').fadeOut(300)) {
                        $('#id_eclipse_bckgrnd').hide();	//hide eclipsed background
                        $('#id_eclipse_img_bckgrnd').hide();	//hide eclipsed background
                    }
                }
            });
        }
    }, /* DelPhoto */
    
    ChngAlbums: function () { 
        var pid = $('#id_chng_alb_cpid').val();
        if (!pid)
            var pid 	= $('#pid').val();
        var new_aid = $('#id_chng_album_album').val();
        if (new_aid && pid)
        { 
            $('#id_eclipse_img_bckgrnd').show();	//show eclipsed background
            $.ajax({
                type:'POST',
                cache: true,
                mode: 'abort',
                port: 'chngalbums',
                data: {
                    'pid': pid,
                    'aid': new_aid,
                    'ajaxinit': 1
                },
                url: siteAdr+'base/albums/chngalbums',
                success: function(r)
                {
                    if ('not_success' != r)
                    {
						if (r == 'hold_still')
							alert('Image was successfully copied');
                        else if ('hidden' != $('#id_arr_right').css('visibility'))
                            $('#id_arr_right').click();
                        else if ('hidden' != $('#id_arr_left').css('visibility'))
                            $('#id_arr_left').click();
						else
                            Go(siteAdr+'id'+UserID+'/albums');
                        $('#id_alb_photos_cp_'+pid).hide();
                    }
                    if ($('#id_chng_album_popup').fadeOut(300)) {
                        $('#id_eclipse_bckgrnd').hide();	//hide eclipsed background
                        $('#id_eclipse_img_bckgrnd').hide();	//hide eclipsed background
                    }
                }
            });
        }
        NFFix();
    } /* ChngAlbums */
    
    
    , InitShareAutoComplete: function () { 
        $('.sw_someone').autocomplete('/inbox/AjaxFindUser?ajaxinit=1',
        {
            delay:        200,
            cacheLength:  7,
            minChars:     2,
            width:        295,
            formatItem:   oUsers.formatItem,
            formatResult: oUsers.formatItem
        }).result(function(e, item)
        {
            //item[0] - item[1]
            $('#new_mess_uid').val(item[0]);
            $(this).val(item[1]);
        });
    
    }    
    /* Tags */
    , AddTagToPhoto: function (name, pid) {
            $('#id_eclipse_img_bckgrnd').show();	//show eclipsed background
            $.ajax({
                type: 'POST',
                cache: false,
                mode: 'abort',
                port: 'addtagtophoto',
                data: {
                    'pid': pid,
                    'name': name,
                    'ajaxinit': 1
                },
                url: siteAdr+'base/albums/addtagtophotoajax',
                success: function(r)
                {
                    if('not_success' != r)
                    {
						$('.emptytag').remove();
                        $('#albums_tag_input').val(''); //right menu input
                        
                        $('#rm_tag_list').append(r);
                    }
                    $('#id_eclipse_img_bckgrnd').hide();	//hide eclipsed background
                }
             });
    }
    , DelTag: function (gtid, pid) {
            $('#id_eclipse_img_bckgrnd').show();	//show eclipsed background
            $.ajax({
                type: 'POST',
                cache: false,
                mode: 'abort',
                port: 'deltagfromphoto',
                data: {
                    'gtid': gtid,
                    'pid': pid,
                    'ajaxinit': 1
                },
                url: siteAdr+'base/albums/deltagfromphotoajax',
                success: function(r)
                {
                    if('not_success' != r)
                    {
                        $('#id_tags_li_el_' + gtid).remove(); //right menu taglist item
                    }
                    $('#id_eclipse_img_bckgrnd').hide(); //hide eclipsed background
                }
             });
    }
}

var oAlbums = new Albums();