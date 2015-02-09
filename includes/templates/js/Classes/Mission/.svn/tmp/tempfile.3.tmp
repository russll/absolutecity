/**
 * Mission's Wall jsController
 * 
 * @package    5dev Wall
 * @version    1.0
 * @since      1.03.2010
 * @copyright  2010 5dev Team
 * @link       http://5dev.com
 */

function Mission() { 
    this.__construct( );
}

Mission.prototype = { 
	__construct: function() { 
		crand = rand(999, 99999999);	//special numer for photo & video
	}, /* __construct */
	
	//---- System Methods
	
	/**
	 * Initialization of the Interfaces
	 */
	_initInterface: function () { 
		oMission._initListeners();
		oMission._initDefaultSettings();
	},  /* initInterface */

	_initDefaultSettings: function () { 
		$('#id_mis_chng_time').css({'display': 'none',
									'visibility': 'visible'});
	}, /* _initDefaultSettings */
	
	/**
	 * Initialization of the constant Event's Listeners
	 * Set Necessary values for the fields
	 */
	_initListeners: function () {
		$('.keyfilter_phone').keyfilter(/^[0-9()\-\+\s]*$/);

		//init Upload Mission Avatar objects
		var mission_id = $('#mission_id').val();

		$("#ma_Filedata").filestyle({image: imgDir+'browse2.png', imageheight : 25, imagewidth : 79});
        $("#ma_Filedata").css('display','block');


		$('#pr_upl').uploadify({
			'uploader'  : flDir+ '/uploadify.swf',
			'script'    : siteAdr+'mission/id'+mission_id+'/chkuplpresidentavatar/?pcash='+rand(1, 10000),
			'fileDataName' : 'Filedata',
			'scriptData' : {'omni3id' : SSesID},
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
				$.blockUI({baseZ:4000, message: '<h2>Please, wait...</h2>', timeout: 25000, css: {border: 'none', padding: '15px', 	backgroundColor: '#000', '-webkit-border-radius': '10px', '-moz-border-radius': '10px', opacity: .5, color: '#fff'}});

			 },

			 onComplete : function(event,queueID,fileObj,response,data) {
				$.unblockUI();
				response =jQuery.parseJSON(response);
				
				if (response.status == 'success')
                {
					$('#president_p_img_hi').val(response.image);
					$('#id_img_upl_president').attr('src', fImgDir+'mission/info/_temp/president/'+response.image);
                }
				if (response.status == 'err') {
					alert('Some error happened while uploading image :( ');
                }
			 },

			 onAllComplete: function () {
				// $('#photos_status_td').html('Uploading complete! To view your photos, please <a style="text-decoration:underline;" href="javascript:document.location = location.href">refresh</a>.');
			 }

		});
		
		if ($(".cl_umis_info").unbind('keyup'))
		{
			$('.cl_umis_info').keyup(function(){ 
				oMission.EditMisUInfo( this );
			});
		}

	     //init CRAND	//random number for photos
	     crand = rand(1, 100000);
	}, /* initListeners */
	
	ChngMisTime: function ( frm_id ) { 
		var options = {
                    data: {'ajaxinit': 1},
	            success: function(data) {
                        //alert(frm_id);
	                if (data) {
	                	if ($('#id_mis_chng_time').slideToggle()) 
				{
					var fdate = $('#fyear').val()+'-'+$('#fmonth').val()+'-'+$('#fday').val();
	                		var tdate = $('#tyear').val()+'-'+$('#tmonth').val()+'-'+$('#tday').val();
	                		
	                		$('#id_mis_time_s_from').html('from '+fdate);
	                		$('#id_mis_time_s_to').html('to '+tdate);
	                		setTimeout('$(\'#id_div_mis_time_i\').show()', 500);
				}
	                    NFFix();
	                }
	            }
	        };
	    $("#"+frm_id).ajaxSubmit(options);
	}, /* ChngMisTime */
	
	EditMisUInfo: function ( obj ) { 
		var mission_id = $('#mission_id').val();
		var par_k = $(obj).attr('name');
		var par_v = $(obj).val();
		
		setTimeout(function() {
					$.get(siteAdr+'mission/id'+mission_id+'/editumisajax?'+par_k+'='+par_v, function(r) { 
				 		  if ('not_success' == r)
				 		  {
				 			 //$(obj).val(par_v);
				 		  }
					});
		}, 300);
	}, /* EditMis */
    
	EditPresident: function ( frm_id ) { 
		var first_name = $('#id_mis_pres_first_name').val();
		var last_name = $('#id_mis_pres_last_name').val();
		
		if (first_name || last_name)
			$('#'+frm_id).submit();
	}, /* EditPresident */

  	SHUplPopup: function ( action, id_popup ) { 
    	if (1 == action)	//show
    	{
    		$('#id_eclipse_bckgrnd').show();	//show eclipsed background
	    	_v(id_popup).style.visibility = "visible";
	    	_v(id_popup).style.display = "block";
    	}
    	else
    	{
    		if ($('#'+id_popup).fadeOut(300)) 
	    		$('#id_eclipse_bckgrnd').hide();	//hide eclipsed background
    	}
    /*    if(id_popup == 'id_upl_mavatar_popup')
        {
            $(oUplAvatar.getMovieElement()).css({
                'visibility': 'visible'
            });
        } */
    }, /* SHUplPopup */

   SHPresidentPopup: function ( action, id_popup ) { 
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
    
    UplAvatar: function() { 

		if ($('#ma_Filedata').val() == '')
				return false;

			$('#ma_id_upl_popup_add').attr('disabled', 'disabled');
			$('#ma_loading_circle').show();
			$('#ma_status_td').html('Loading image, please wait...');

			//$(this).attr('disabled', 'disabled');
			$.ajaxFileUpload( {
				url: siteAdr+'mission/id'+$('#mission_id').val()+'/chkuplavatar/?pcash='+rand(1, 10000),
				secureuri:false,
				fileElementId: 'ma_Filedata',
				dataType: 'json',
				success: function (data, status) {
					$('#ma_loading_circle').hide();
					$('#ma_status_td').html('Image was successfully loaded, thanks! Reloading page...');
					$('#ma_status_td').css('color', 'green');
					document.location = location.href;
				},
				error: function(data, status) {
					$('#ma_status_td').html('Some error happened, sorry :(');
					$('#ma_status_td').css('color', 'red');
				}
			});
	}, /* UplAvatar */
    
    UplAvatarSendData: function ( id_frm ) { 
		return false;
		/*
		var options = { success: function(r) { 
										if ('not_success' != r)
										{
											oMission.UplAvatarComplete( 'Uploading has been succesfully completed...', r );
										}
										else
											oMission.UplAvatarComplete( 'Uploading failed...', '' );
								 }
					  };
					  $('#' + id_frm).ajaxSubmit(options); */
	}, /* UplAvatarSendData */
	
	UplAvatarComplete: function ( str, img ) {
		return false;
	}, /* UplAvatarComplete */

	UplPresidentAvatar: function() { 
		var first_name = $('#id_mis_pres_first_name').val();
		var last_name = $('#id_mis_pres_last_name').val();
		
		if (first_name || last_name)
		{
	    	$('#id_eclipse_img_bckgrnd').css({'z-index': '5000',  
	    									  'display': 'block'});	//show eclipsed background
			var p_img = $('#id_pava_upl_pr_ol :input[p_img]');	//count of the elements
			var p_img_cnt = p_img.length;
			
			if (0 < p_img_cnt)
			{
				//$(oUplPresident.getMovieElement()).css({'visibility': 'hidden'});
				
//				var PostParams =  { 'omni3id' : SSesID, 'cnt_p_img' : p_img_cnt, 'crand': crand };
//					oUplPresident.setPostParams(PostParams);
//					oUplPresident.startUpload();
//					//$('#id_btn_pava_upload').click();
				
				//oMission.UplPresidentAvatarComplete();
	    	}
			else
				oMission.EditPresident( 'id_frm_add_president' );
		}
		else
			alert('Please, fill at least first or last name');
	}, /* UplPresidentAvatar */
	
	UplPresidentAvatarComplete: function () { 
		var p_uploaded = $('#id_pava_upl_pr_ol li');	//get all li items from the uploading avatars list
		var l_ind = p_uploaded.length - 1;	//get the last index	
		var l_avatar = $('#'+$(p_uploaded[l_ind]).attr('id'));	//get the last of the uploading avatar
		
		if ('none' == $(l_avatar).css('display'))
		{
			$('#id_eclipse_img_bckgrnd').css({'z-index': '3333',  
				  							  'display': 'none'});	//hide eclipsed background
			oMission.EditPresident( 'id_frm_add_president' );
		}
		else
			setTimeout('oMission.UplPresidentAvatarComplete()', 1000);
	} /* UplPresidentAvatarComplete */
}

var oMission = new Mission();