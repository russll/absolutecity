/**
 * Ward's Wall jsController
 * 
 * @package    5dev Wall
 * @version    1.0
 * @since      1.03.2010
 * @copyright  2010 5dev Team
 * @link       http://5dev.com
 */

function Wards() { 
    this.__construct( );
}

Wards.prototype = { 
    __construct: function() {
        crand = rand(999, 99999999);	//special numer for photo & video
    }, /* __construct */
	
    //---- System Methods
	
    /**
	 * Initialization of the Interfaces
	 */
    _initInterface: function () {
        oWards._initListeners();
    },  /* initInterface */
	
    /**
	 * Initialization of the constant Event's Listeners
	 * Set Necessary values for the fields
	 */
    _initListeners: function () {

        $('.keyfilter_phone').keyfilter(/^[0-9()\-\+\s]*$/);

		
        //init Upload Ward Avatar objects
        var wid = $('#wid').val();


        //$('#id_link_upl_bishopric').filestyle({image: imgDir+'upl_aphoto_100.gif', imageheight : 17, imagewidth : 100});
	     
        if (IS_USER) {

        }

        /* eugene's avatar upload */
        $("#wa_Filedata").filestyle({
            image: imgDir+'browse2.png',
            imageheight : 25,
            imagewidth : 79
        });
        $("#wa_Filedata").css('display','block');

        $('#bsprc_upl').uploadify({
            'uploader'  : flDir+ '/uploadify.swf',
            'script'    : siteAdr+'wards/id'+wid+'/chkuplbishopricavatar/?pcash='+rand(1, 10000),
            'fileDataName' : 'Filedata',
            'scriptData' : {
                'omni3id' : SSesID
            },
            'auto'      : true,
            'multi'		: false,
            'queueID'   : 'sphotos_list',
            'fileDesc'	: 'Images',
            'fileExt'	: '*.jpeg;*.jpg;*.png;*.gif',
            'sizeLimit' :  10 * 1024 * 1024,
            'buttonImg'	: imgDir+'upl_aphoto_100.gif',
            'cancelImg' : imgDir+'close_ico.gif',
            'width'		: 100,
            'height'	: 17,

            onSelect : function () {

                //$('#id_eclipse_bckgrnd').show();
                $.blockUI({
                    baseZ:4000,
                    message: '<h2>Please, wait...</h2>',
                    timeout: 25000,
                    css: {
                        border: 'none',
                        padding: '15px',
                        backgroundColor: '#000',
                        '-webkit-border-radius': '10px',
                        '-moz-border-radius': '10px',
                        opacity: .5,
                        color: '#fff'
                    }
                });

        },

        onComplete : function(event,queueID,fileObj,response,data) {
            $.unblockUI();
            //alert(response);
            response =jQuery.parseJSON(response);

            if (response.status == 'success')
            {
                $('#bishop_p_img_hi').val(response.image);
                $('#id_img_upl_bishopric').attr('src', fImgDir+'wards/info/_temp/bishopric/'+response.image);
            }
            if (response.status == 'err') {
                alert('Some error happened while uploading image :( ');
            }
        },

        onAllComplete: function () {
            // $('#photos_status_td').html('Uploading complete! To view your photos, please <a style="text-decoration:underline;" href="javascript:document.location = location.href">refresh</a>.');
            }

        });



    //init CRAND	//random number for photos
    crand = rand(1, 100000);
}, /* initListeners */
    
SHUplPopup: function ( action, id_popup ) { 
    if (1 == action)	//show
    {
        $('#id_eclipse_bckgrnd').show();	//show eclipsed background
        //$('#'+id_popup).fadeIn(300);
        _v(id_popup).style.visibility = "visible";
        _v(id_popup).style.display = "block";
    }
    else
    {
        if ($('#'+id_popup).fadeOut(300))
            $('#id_eclipse_bckgrnd').hide();	//hide eclipsed background
    }
    if(id_popup == 'id_upl_wavatar_popup')
    {
//                $(oUplAvatar.getMovieElement()).css({
//                    'visibility': 'visible'
//                });
}
}, /* SHUplPopup */

SHBishopricPopup: function ( action, id_popup ) { 
    if (1 == action)	//show
    {
        $('#id_eclipse_bckgrnd').show();	//show eclipsed background
        $('#'+id_popup).fadeIn(300);
    }
    else
    {
        if ($('#'+id_popup).fadeOut(300))
            $('#id_eclipse_bckgrnd').hide();	//hide eclipsed background
    }
}, /* SHBishopricPopup */
    
EditBishopric: function ( frm_id ) { 
    var first_name = $('#id_bishopric_pres_first_name').val();
    var last_name = $('#id_bishopric_pres_last_name').val();
		
    if (first_name || last_name)
        $('#'+frm_id).submit();
    else
        $('#id_eclipse_img_bckgrnd').css({
            'z-index': '3000',
            'display': 'none'
        });	//show eclipsed background

}, /* EditBishopric */

EditWhatching: function ( act, wid ) { 
    $.ajax({
        type: 'POST',
        port: 'editwhatching',
        data: {
            'act': act,
            'ajaxinit': 1
        },
        url: siteAdr+'wards/id'+wid+'/editwhatching?ajaxinit=1',
        success: function(r)
        {
            if ('not_success' != r)
            {
                if (1 == act)
                {
                    $('#id_wards_whatch').attr({
                        'href': 'javascript: oWards.EditWhatching( 2, '+wid+' )',
                        'onclick': ''
                    });
                    $('#id_wards_whatch').html('Unwatch this ward');
                }
                else
                {
                    $('#id_wards_whatch').attr({
                        'href': 'javascript: oWards.EditWhatching( 1, '+wid+' )',
                        'onclick': ''
                    });
                    $('#id_wards_whatch').html('Watch this ward');
                }
            }
        }
    });
}, /* DoSubscr */

UplAvatar: function() {
    if ($('#wa_Filedata').val() == '')
    {
        return false;
    }

    $('#wa_loading_circle').show();
    $('#wa_status_td').html('Loading image, please wait...');
    $.ajaxFileUpload( {
        url: siteAdr+'wards/id'+$('#wid').val()+'/chkuplavatar/?pcash='+rand(1, 10000)+'&ajaxinit=1',
        secureuri:false,
        fileElementId: 'wa_Filedata',
        dataType: 'json',
        success: function (data, status) {
            $('#wa_loading_circle').hide();
            $('#wa_status_td').html('Image was successfully loaded, thanks! Reloading page...');
            $('#wa_status_td').css('color', 'green');
            document.location = location.href;
        },
        error: function(data, status) {
            $('#wa_status_td').html('Some error happened, sorry :(');
            $('#wa_status_td').css('color', 'red');
        }
    });

    return false;



/*
        $('#id_avatar_loader_pic').css({
            'z-index': '5000',
            'display': 'block'
        });
		var p_img = $('#id_send_frm_wavatar_choose_file :input[p_img]');	//count of the elements
		var p_img_cnt = p_img.length;

		if (0 < p_img_cnt)
		{
	    	//popup
	    	$('#id_upl_popup_close').hide();
	    	$('#id_upl_popup_cancel').hide();
	    	$('#id_upl_popup_add').hide();

                $(oUplAvatar.getMovieElement()).css({
                    'visibility': 'hidden'
                });
                $('.share-white-b').hide();

			var PostParams =  {'omni3id' : SSesID, 'cnt_p_img' : p_img_cnt, 'crand': crand};
			oUplAvatar.setPostParams(PostParams);
			$('#id_btn_wavatar_upload').click();
			oWards.UplAvatarSendData( 'id_frm_upl_wavatar' );

                //$('.swfupload').css('visibility', 'visible');
    	}*/
}, /* UplAvatar */

    
UplAvatarSendData: function ( id_frm ) {
    return false;
/*
		var options = {success: function(r) { 
										if ('not_success' != r)
										{
											oWards.UplAvatarComplete( 'Uploading has been succesfully completed...', r );
										}
										else
											oWards.UplAvatarComplete( 'Uploading failed...', '' );
								 }
					  };
					  $('#' + id_frm).ajaxSubmit(options); */
}, /* UplAvatarSendData */

UplAvatarComplete: function ( str, img ) {
    return false;
/*
		var p_uploaded = $('#id_wavatar_upl_pr_ol li');	//get all li items from the uploading avatars list
		var l_ind = p_uploaded.length - 1;	//get the last index	
		var l_avatar = $('#'+$(p_uploaded[l_ind]).attr('id'));	//get the last of the uploading avatar
		
                $('#id_avatar_loader_pic').hide();
                $('#id_upl_wavatar_popup').hide();
                $('.warn_nav').hide();
                $('#id_warn_text').html(str);
                $('#id_warn_popup_mbtn_ward').show();
                $('#id_warn_popup_mbtn_album').hide();
                $('#id_warn_popup').show();

                var ua = navigator.userAgent.toLowerCase();

                if((ua.indexOf("msie") != -1 && ua.indexOf("webtv") == -1) || ua.indexOf("opera") != -1)
                {
                    window.location.reload( true );
                }

                $('.big_avatar').attr('src', img.replace('[fld]', 'a/a_'));

                $('.big_avatar').error(function (e) {
                    this.src = this.src;
                    $('.big_avatar').unbind('error');
                });

                //$('.cl_img_btn_share').show();
                $('#id_upl_popup_close').show();
                $('#id_upl_popup_cancel').show();
                $('#id_upl_popup_add').show();
                $('#id_avatar_loader_pic').hide();
                //$('.swfupload').css('visibility', 'visible');
 */
}, /* UplAvatarComplete */

UplBishopricAvatar: function() {
		
		
    var first_name = $('#id_bishopric_pres_first_name').val();
    var last_name = $('#id_bishopric_pres_last_name').val();
		
    if (first_name || last_name)
    {
        //	    	$('#id_eclipse_img_bckgrnd').css({'z-index': '5000',
        //	    									  'display': 'block'});	//show eclipsed background
        //			var p_img = $('#id_bava_upl_pr_ol :input[p_img]');	//count of the elements
        //			var p_img_cnt = p_img.length;
        //
        //			if (0 < p_img_cnt)
        //			{
        //				var PostParams =  {'omni3id' : SSesID, 'cnt_p_img' : p_img_cnt, 'crand': crand};
        //					oUplBishopric.setPostParams(PostParams);
        //					oUplBishopric.startUpload();
        //
        //				oWards.UplBishopricAvatarComplete();
        //	    	}
        //			else
        oWards.EditBishopric( 'id_frm_add_bishopric' );
    }
    else
        alert('Please, fill first and last name');
}, /* UplBishopricAvatar */
	
UplBishopricAvatarComplete: function () { 
    return false;
/*
		var p_uploaded = $('#id_bava_upl_pr_ol li');	//get all li items from the uploading avatars list
		var l_ind = p_uploaded.length - 1;	//get the last index	
		var l_avatar = $('#'+$(p_uploaded[l_ind]).attr('id'));	//get the last of the uploading avatar
		
		if ('none' == $(l_avatar).css('display'))
			oWards.EditBishopric( 'id_frm_add_bishopric' );
		else
			setTimeout('oWards.UplBishopricAvatarComplete()', 1000); */
} /* UplBishopricAvatarComplete */
}

var oWards = new Wards();