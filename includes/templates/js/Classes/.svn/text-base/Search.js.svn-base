/**
 * Wall jsController
 *
 * @package    5dev Search
 * @version    1.0
 * @since      1.03.2010
 * @copyright  2010 5dev Team
 * @link       http://5dev.com
 */

function Search()
{
    this.__construct();

}

Search.prototype = { 
    __construct: function() {

    }, /* __construct */
	
    //---- System Methods
	
    /**
	 * Initialization of the Interfaces
	 */
    _initInterface: function () {
        oSearch._initDeafultCondition();
        oSearch._initListeners();
        oSearch._initActions();
        
    },  /* initInterface */
	
    /**
	 * Set default settings
	 * @return void()
	 */
    _initDeafultCondition: function() {
        setTimeout('$(\'.drop-filter\').hide()', 500);
    },
	
    /**
	 * Initialization of the constant Search's Listeners
	 */
    _initListeners: function () {
		
        //init Global Browse links
        if ($(".cl_glsrchsubfilt_links").unbind('click'))
        {
            $('.cl_glsrchsubfilt_links').click(function () {
                $('.cl_glsrchsubfilt_links').removeAttr('subfilt');
                $(this).attr('subfilt', $(this).attr('sfname'));

                $(".cl_glsrchsubfilt_links").addClass('cl_glsrchsubfilt_links_sel');
				
                /* ugly, but addClass doesn't work */
                $(".cl_glsrchsubfilt_links").css('color', '#CAE5FF').css('font-weight', 'normal');
                $(this).css('color', 'white').css('font-weight', 'bold');

                //$('#id_search_drop').slideToggle();

                var ss = $('#id_main_srch_edit').val();
                if ('Search for friends, missions, wards etc'==jQuery.trim(ss)) {
                    ss = '';
                }
                if ('Web'==$('.cl_glsrchsubfilt_links[subfilt]').attr('subfilt')) {
                    Go('/base/search/web?q='+ss);
                } else {
                    Go('/base/search?glsrch='+ss+'&glsrchsubfilt='+$('.cl_glsrchsubfilt_links[subfilt]').attr('subfilt'));
                }
            });
        }
		
        //init browse links
        if ($(".cl_srch_browse_links").unbind('click'))
        {
            $('.cl_srch_browse_links').click(function () {
                oSearch.ChngBrowse($(this));
            });
        }
		
        //init filters links
        if ($(".cl_srch_ftype").unbind('click'))
        {
            $('.cl_srch_ftype').click(function () {
                var ftype = $(this).attr('ftype');
                var ocFilt = $('div[ftype='+ftype+']');
                if ('none' == $(ocFilt).css('display')) {
                    $(this).find(' img').attr({
                        'src': imgDir+'arr05_up.gif'
                        });
                    $(ocFilt).show(200);
                    NFFix();
                } else {
                    $(ocFilt).hide(200);
                    $(this).find(' img').attr({
                        'src': imgDir+'arr05.gif'
                        });
                    NFFix();
                }
            });
        }
		
        //init filter buttons links
        if ($(".cl_filt_btn").unbind('click'))
        {
            $('.cl_filt_btn').click(function () {
                var fm = $('select[name=mission_from_month]').val();
                var fy = $('select[name=mission_from_year]').val();
                var tm = $('select[name=mission_to_month]').val();
                var ty = $('select[name=mission_to_year]').val();

                fm = (fm && fm.length == 1) ? '0'+fm : fm;
                tm = (tm && tm.length == 1) ? '0'+tm : tm;

                if ((fm || fy) && !(fm && fy))
                {
                    alert('Please, specify both "from month" and "from year" fields');
                    return false;
                }
                else if (fm && fy) {
                    if ($('input[name="SI[ftype][mission_from_date]"]').length > 0)
                        $('input[name="SI[ftype][mission_from_date]"]').val((fy+'-'+fm+'-01'));
                    else
                        $('#id_frm_srch').append('<input type="hidden" name="SI[ftype][mission_from_date]" value="'+(fy+'-'+fm+'-01')+'" />')
                }

                if ((tm || ty) && !(tm && ty))
                {
                    alert('Please, specify both "to month" and "to year" fields');
                    return false;
                } else if (ty && tm) {
                    if ($('input[name="SI[ftype][mission_to_date]"]').length > 0)
                        $('input[name="SI[ftype][mission_to_date]"]').val((ty+'-'+tm+'-01'));
                    else
                        $('#id_frm_srch').append('<input type="hidden" name="SI[ftype][mission_to_date]" value="'+(ty+'-'+tm+'-31')+'" />')
                }

		        if (mktime(1,1,1,fm, 1,fy) > mktime(1,1,1,tm, 1,ty)) {
                    alert('The To date can not be earlier than the From date.');
                    return false;
                }


                var ocFilt = $(this).closest('div[class=drop-filter]');
                var ftype = $(ocFilt).attr('ftype');
				
                var ar_no_val = new Array('Email address', 'First/Middle name', 'Last name', 'Enter phone number', 'Enter school name', 'Enter city', 'Enter street', 'Zip code', 'Enter interest', 'Enter stake/ward name', 'Enter location here');
				
                $(ocFilt).find(' input').each(function () {
                    var val = $(this).val();
                    if (in_array(val, ar_no_val))
                    {
                        val = '';
                    }

                    if ('' != val && undefined != val)	//if filter field is filled -> add to attach
                    {
                        if ( !$('#ftype_'+$(this).attr('name')).attr('ftype') ) {
                            $('<input ftype="'+ftype+'" id="ftype_'+$(this).attr('name')+'" name="SI[ftype]['+$(this).attr('name')+']" type="hidden" value="'+val+'" />').appendTo($('#id_browse_attach_srch'));
                        } else {
                            $('#ftype_'+$(this).attr('name')).val( val );
                        }
                    }
                    else if ($('#id_browse_attach_srch input[name="SI[ftype]['+$(this).attr('name')+']"]').val())	//if filter field is not filled -> remove from attache
                    {
                        $('#id_browse_attach_srch input[name="SI[ftype]['+$(this).attr('name')+']"]').remove();
                    }
                });
				
                $(ocFilt).find(' select').each(function () {
                    var val = $(this).val();
                    if (in_array(val, ar_no_val)) val = '';
		            if ('' != val && undefined != val)	//if filter field is filled -> add to attach
                    {
                        if ($('input[name="SI[ftype]['+$(this).attr('name')+']"]').length > 0)
                            $('input[name="SI[ftype]['+$(this).attr('name')+']"]').val( val );
                        else
                            $('<input ftype="'+ftype+'" name="SI[ftype]['+$(this).attr('name')+']" type="hidden" value="'+val+'" />').appendTo($('#id_browse_attach_srch'));
                    }
                    else if ($('#id_browse_attach_srch input[name="SI[ftype]['+$(this).attr('name')+']"]').val())	//if filter field is not filled -> remove from attache
                    {
                        $('#id_browse_attach_srch input[name="SI[ftype]['+$(this).attr('name')+']"]').remove();
                    }
                });

                $('.cl_search_pagging_inp').remove();

                if($('#nwall').val() == undefined)
                {
                    $('#id_frm_srch').append('<input type="hidden" id="nwall" name="SI[not_wall]" value="1">');
                }

                //refresh result's list
                oSearch.Search('id_frm_srch');
            });
        }

        //init filter buttons links
        if ($(".cl_filt_btn2").unbind('click'))
        {
            $('.cl_filt_btn2').click(function () {
                var ocFilt = $(this).closest('div[class=drop-filter]');
                var ftype = $(ocFilt).attr('ftype');

                var ar_no_val = new Array('Email address', 'First/Middle name', 'Last name', 'Enter phone number', 'Enter school name', 'Enter city', 'Enter street', 'Zip code', 'Enter interest', 'Enter stake/ward name', 'Enter location here');

                $(ocFilt).find(' input').each(function () {
                    var val = $(this).val();
                    if (in_array(val, ar_no_val)) val = '';

                    if ('' != val && undefined != val)
                        $('<input ftype="'+ftype+'" name="SI[ftype]['+$(this).attr('name')+']" type="hidden" value="'+val+'" />').appendTo($('#id_browse_attach_srch'));
                    else if ($('#id_browse_attach_srch input[name="SI[ftype]['+$(this).attr('name')+']"]').val())
                        $('#id_browse_attach_srch input[name="SI[ftype]['+$(this).attr('name')+']"]').remove();
                });

                $(ocFilt).find(' select').each(function () {
                    var val = $(this).val();
                    if (in_array(val, ar_no_val)) val = '';

                    if ('' != val && undefined != val)	$('<input ftype="'+ftype+'" name="SI[ftype]['+$(this).attr('name')+']" type="hidden" value="'+val+'" />').appendTo($('#id_browse_attach_srch'));
                    else if ($('#id_browse_attach_srch input[name="SI[ftype]['+$(this).attr('name')+']"]').val())
                        $('#id_browse_attach_srch input[name="SI[ftype]['+$(this).attr('name')+']"]').remove();
                });

                $('.cl_search_pagging_inp').remove();
                if($('#nwall2').val() == undefined)
                {
                    $('#id_frm_srch').append('<input type="hidden" id="nwall2" name="SI[not_wall]" value="0">');
                }
                //refresh result's list
                oSearch.Search('id_frm_srch');
            });
        }
		
        //init filter buttons links
        if ($('.cl_search_pagging_more').unbind('click'))
        {
            $('.cl_search_pagging_more').click(function () {
                var pname = $(this).attr('pname');
                var pcnt = $(this).attr('pcnt');
                var rcnt = $(this).attr('rcnt');
				
                if (pname) {
                    if (!pcnt) pcnt = 0;
                    if (!rcnt) rcnt = 0;
					
                    $('.cl_search_pagging_inp').remove();
                    $('<input pname="'+pname+'" class="cl_search_pagging_inp" name="PG[pname]" type="hidden" value="'+pname+'" />').appendTo($('#id_browse_attach_srch'));
                    $('<input pname="'+pcnt+'" class="cl_search_pagging_inp" name="PG[pcnt]" type="hidden" value="'+pcnt+'" />').appendTo($('#id_browse_attach_srch'));
                    $('<input pname="'+rcnt+'" class="cl_search_pagging_inp" name="PG[rcnt]" type="hidden" value="'+rcnt+'" />').appendTo($('#id_browse_attach_srch'));
                    $('<input pname="'+rcnt+'" class="cl_search_pagging_inp" name="PG[not_wall]" type="hidden" value="0" />').appendTo($('#id_browse_attach_srch'));
                    oSearch.SearchMore('id_frm_srch');
                }
            });
        }


        if ($('.cl_search_pagging2').unbind('click'))
        {
            $('.cl_search_pagging2').click(function () {
                var pname = $(this).attr('pname');
                var pcnt = $(this).attr('pcnt');
                var rcnt = $(this).attr('rcnt');

                if (pname) {
                    if (!pcnt) pcnt = 0;
                    if (!rcnt) rcnt = 0;

                    $('.cl_search_pagging_inp').remove();
                    $('<input pname="'+pname+'" class="cl_search_pagging_inp" name="PG[pname]" type="hidden" value="'+pname+'" />').appendTo($('#id_browse_attach_srch'));
                    $('<input pname="'+pcnt+'" class="cl_search_pagging_inp" name="PG[pcnt]" type="hidden" value="'+pcnt+'" />').appendTo($('#id_browse_attach_srch'));
                    $('<input pname="'+rcnt+'" class="cl_search_pagging_inp" name="PG[rcnt]" type="hidden" value="'+rcnt+'" />').appendTo($('#id_browse_attach_srch'));
                    $('<input pname="'+rcnt+'" class="cl_search_pagging_inp" name="PG[not_wall]" type="hidden" value="1" />').appendTo($('#id_browse_attach_srch'));
                    oSearch.SearchMore('id_frm_srch');
                }
            });
        }

        //-- filter tags
        if ($(".cl_tag_show_filts").unbind('click'))
        {
            $('.cl_tag_show_filts').click(function () {
                $('.cl_tag_show_filts').css('font-weight', 'normal');
                $(this).css('font-weight', 'bold');
                $('#id_eclipse_img_bckgrnd').show();	//show eclipsed background
                $('.cl_tags_list, #no_items').hide();
                if (1 == $(this).attr('stype'))	//show all
                    $('.cl_tags_list').show();
                else {
                    $('#id_tags_list_'+$(this).attr('stype')).show();

                    if ( $('#id_tags_list_'+$(this).attr('stype')).html() == null ) {
                        $('#no_items').show();
                    }
                }
                setTimeout('$(\'#id_eclipse_img_bckgrnd\').hide()', 200);
            });
        }

        //clear attach block
        //$('#id_browse_attach_srch').html($('#id_srch_attach_frm_btype').val() ? '<input id="id_srch_attach_frm_btype" name="SI[btype]" type="hidden" value="'+$('#id_srch_attach_frm_btype').val()+'" />' : '');

		
    }, /* initListeners */
	
    _initActions: function() {
        if (undefined != $('#id_glsrchsubfilt_input').val())
            $('.cl_srch_browse_links[btype="'+$('#id_glsrchsubfilt_input').val()+'"]').click();
        
        if (undefined != $('#id_glsrch_input').val())
            $('#id_btn_search').click();

        if (undefined != $('#pml').val() && '' != $('#pml').val()) {
            $('input[name="people_mission_location"]').val($('#pml').val());
            $('<input ftype="People" name="SI[ftype][people_mission_location]" type="hidden" value="'+$('#pml').val()+'" />').appendTo($('#id_browse_attach_srch'));
            $('#id_srch_edit').val('');
            $('#id_btn_search').click();
            $('.cl_srch_ftype_h3[ftype="ByMission"] span a').click();
        }
		
        if ((undefined != $('#pwn').val() && '' != $('#pwn').val()) || ('' != $('#psn').val() && undefined != $('#psn').val())) {
            if ($('#pwn').val().length > 0)
                $('input[name="people_ward_name"]').val($('#pwn').val());

            if ($('#psn').val().length > 0)
                $('input[name="people_stake_name"]').val($('#psn').val());

            $('<input ftype="People" name="SI[ftype][people_ward_name]" type="hidden" value="'+$('#pwn').val()+'" />').appendTo($('#id_browse_attach_srch'));
            $('<input ftype="People" name="SI[ftype][people_stake_name]" type="hidden" value="'+$('#psn').val()+'" />').appendTo($('#id_browse_attach_srch'));

            $('#id_srch_edit').val('');
            $('#id_btn_search').click();
            $('.cl_srch_ftype_h3[ftype="ByWard"] span a').click();
        }
    },

     /**
	 * Pagging
	 * @param 
	 */
    SearchPage: function (page, param) {

        var pname = param;
        var rcnt = $('#id_div_show_more_mes_'+param+' .cl_search_pagging').attr('rcnt');
        var pcnt = (page-1)*rcnt;
            
        if (pname) {
            if (!pcnt) pcnt = 0;
            if (!rcnt) rcnt = 0;

            $('.cl_search_pagging_inp').remove();
            $('<input pname="'+pname+'" class="cl_search_pagging_inp" name="PG[pname]" type="hidden" value="'+pname+'" />').appendTo($('#id_browse_attach_srch'));
            $('<input pname="'+pcnt+'" class="cl_search_pagging_inp" name="PG[pcnt]" type="hidden" value="'+pcnt+'" />').appendTo($('#id_browse_attach_srch'));
            $('<input pname="'+rcnt+'" class="cl_search_pagging_inp" name="PG[rcnt]" type="hidden" value="'+rcnt+'" />').appendTo($('#id_browse_attach_srch'));
            $('<input pname="'+rcnt+'" class="cl_search_pagging_inp" name="PG[page]" type="hidden" value="'+page+'" />').appendTo($('#id_browse_attach_srch'));
            $('<input pname="'+rcnt+'" class="cl_search_pagging_inp" name="PG[not_wall]" type="hidden" value="0" />').appendTo($('#id_browse_attach_srch'));
            oSearch.Search('id_frm_srch');
        }

        //refresh data
        //oSearch._initListeners();	//refresh Listeners

    }, /* ChngBrowse */


    /**
	 * Change Browse Links
	 * @param browse - browse's links object
	 */
    ChngBrowse: function ( browse ) {

        if(browse.attr('btype') == 'Stake/Wards')
        {
            oUsers.InitStakeComplete('ward_name');		
        }
        if(browse.attr('btype') == 'Missions' || browse.attr('btype') == 'People')
        {
            oUsers.InitCityComplete('mission_location');
        }

	if(browse.attr('btype') == 'People') {
            oUsers.InitStakeComplete('people_stake_name');
            oUsers.InitWardComplete('people_ward_name');
        }
			
           
        //clearing all links
        $('#id_browse_attach_srch').html('<input id="id_srch_attach_frm_btype" name="SI[btype]" type="hidden" value="All results" />');
        $('#id_browse_list li[btype]').each(function(){
            undefined != $(this).attr('btype') ? cbtype = $(this).attr('btype') : cbtype = '';
            undefined != $(this).attr('bcnt') ? cbcnt = $(this).attr('bcnt') : cbcnt = '';
            $(this).html('<span>'+cbcnt+'</span> <a btype="'+cbtype+'" bcnt="'+cbcnt+'" class="cl_srch_browse_links" style="cursor: pointer;">'+cbtype+'</a>');
        });
        //set necassery link & fill the fields
        undefined != $(browse).attr('btype') ? btype = $(browse).attr('btype') : btype = 'All results';
        undefined != $(browse).attr('bcnt') ? bcnt = $(browse).attr('bcnt') : bcnt = '';
        $('#id_browse_list li[btype='+btype+']').html('<p><span>'+bcnt+'</span> '+btype+'</p>');
        $('#id_header_title').html('<span>'+bcnt+'</span>'+btype);
		
        //hide all lists of results
        $('.cl_srch_list').hide();
        if ('All results' == btype)	//if type of the browse == all res -> show all res else show necassery
            $('.cl_srch_list').show();
        else
        {
            if (btype == 'Missions')
                $('.cl_srch_list[btype=Missions2]').show();
            else
                $('.cl_srch_list[btype='+btype+']').show();
        }
		
        $('div[ftype]').hide();
        $('a[ftype]').find(' img').attr({
            'src': imgDir+'arr05.gif'
            });
		
        //attach input to sending form (top.html -> Search top box)
        if ($('#id_srch_attach_frm_btype').val(btype))
            oSearch.ChngFilts( btype );
		
        //refresh data
        oSearch._initListeners();	//refresh Listeners
    }, /* ChngBrowse */


    /**
	 * Change Filters of the Search (left column)
	 * @param btype - type of the browse
	 */
    ChngFilts: function ( btype ) {
		
        $('#id_srch_filts').css({
            'visibility': 'hidden'
        });
        $('.cl_srch_ftype_h3').hide();
		
        switch (btype)
        {
            case 'All results': default:
                var ar_el = new Array();
                break;
            case 'People':
                var ar_el = new Array('Email', 'Name', 'Gender', 'Age', 'Phone number', 'School', 'Location', 'Stake/ward', 'Interests', 'ByMission', 'ByWard');
                break;
            case 'Singles':
                /*var ar_el = new Array('Singles');*/
                var ar_el = new Array('Singles','Email', 'Name', 'Gender', 'Age', 'Phone number', 'School', 'Location', 'Stake/ward', 'Interests', 'ByMission', 'ByWard');
                break;
            case 'Missions':
                var ar_el = new Array('Mission2');
                break;
            case 'Missions2':
                var ar_el = new Array('Mission2');
                break;
            case 'Stake/Wards':
                var ar_el = new Array('Stake');
                break;
        }
        var cnt_ar_el = ar_el.length;
        var i;
        for (i = 0; i < cnt_ar_el; i++)
        {
            $('.cl_srch_ftype_h3[ftype="'+ar_el[i]+'"]').show();
        }
        if (cnt_ar_el)
            $('#id_srch_filts').css({
                'visibility': 'visible'
            });

        $('.more-box').remove();
        $('#id_btn_search').click();
    }, /* ChngFilts */
	
    Search: function( id_frm, clear ) {

        $('#id_eclipse_img_bckgrnd').show();
/*        if (clear)
            $('.cl_search_pagging_inp').remove();
*/
        var cnt_pagging = $('.cl_search_pagging_inp').length;

        if (cnt_pagging) {
            var pname = $('.cl_search_pagging_inp[pname]').val();
            var pcnt = $('.cl_search_pagging_inp[pcnt]').val();
            var rcnt = $('.cl_search_pagging_inp[rcnt]').val();
            var page = $('.cl_search_pagging_inp[page]').val();
        }
		
        var options = {
            mode: 'abort',
            port: 'search',
            data: {
                'ajaxinit': 1
            },
            success: function(r) {
                if ('not_success' != r)
                {
                    $('.adi_srch').hide();
                    if (!cnt_pagging)
                    {
                        $('#id_srch_res_list').html( r );
                    }
                    else
                    {
                        $('#id_div_show_more_mes_'+pname).remove();
                        $('#id_div_search_'+pname).html(r);
                    }

                    oSearch._initListeners();	//refresh Listeners
                }
                setTimeout('$(\'#id_eclipse_img_bckgrnd\').hide()', 300);
            }
        };
        $('#'+id_frm).ajaxSubmit(options);
    },


        SearchMore: function( id_frm, clear ) {

        $('#id_eclipse_img_bckgrnd').show();
/*        if (clear)
            $('.cl_search_pagging_inp').remove();
*/
        var cnt_pagging = $('.cl_search_pagging_inp').length;

        if (cnt_pagging) {
            var pname = $('.cl_search_pagging_inp[pname]').val();
            var pcnt = $('.cl_search_pagging_inp[pcnt]').val();
            var rcnt = $('.cl_search_pagging_inp[rcnt]').val();
        }

        var options = {
            mode: 'abort',
            port: 'search',
            data: {
                'ajaxinit': 1
            },
            success: function(r) {
                if ('not_success' != r)
                {
                    $('.adi_srch').hide();
                    if (!cnt_pagging)
                    {
                        $('#id_srch_res_list').html( r );
                    }
                    else
                    {
                        $('#id_div_show_more_mes_'+pname).remove();
                        $('#id_div_search_'+pname).append(r);
                    }

                    oSearch._initListeners();	//refresh Listeners
                }
                setTimeout('$(\'#id_eclipse_img_bckgrnd\').hide()', 300);
            }
        };
        $('#'+id_frm).ajaxSubmit(options);
    }
}
var oSearch = new Search();