/**
 * System's Wall jsController
 * 
 * @package    5dev System
 * @version    1.0
 * @since      4.04.2010
 * @copyright  2010 5dev Team
 * @link       http://5dev.com
 */

function System() { 
    this.__construct( );
}

System.prototype = { 
    __construct: function() {
    }, /* __construct */
	
    //---- System Methods
	
    /**
	 * Initialization of the Interfaces
	 */
    _initInterface: function () {
        oSystem._initListeners();
        oSystem._initDefaultSettings();
    },  /* initInterface */
	
    /**
	 * Initialization of the constant Event's Listeners
	 * Set Necessary values for the fields
	 */
    _initListeners: function () {
    //
    }, /* initListeners */
	
    _initDefaultSettings: function (  ) {
    //
    }, /* _initDefaultSettings */
	
    /*
	 * Show Global Confirmation Popup
	 * 
	 * @param link - script, which will be executed 
	 * @param title - title of the message box
	 * @param bname - caption of the button accept
	 */
    SConfPopup: function ( link, title, bname ) {
        if (!link || '' == link || 'undefined' == link || null == link)
            return false;
        if (!title || '' == title || 'undefined' == title || null == title)
            title = 'Are you sure?';
        if (!bname || '' == bname || 'undefined' == bname || null == bname)
            bname = 'Delete';
		
        $('#id_confirmation_title').html(title);
        $('#id_confirmation_btn_02').attr({
            'onclick': '',
            'href': 'javascript: if ($(\'#id_confirmation_popup\').fadeOut(300)) $(\'#id_eclipse_bckgrnd\').hide(); $(\'#id_eclipse_img_bckgrnd\').hide(); '+link
            });
        $('#id_confirmation_btn_02').html(bname);
        $('#id_eclipse_bckgrnd').show();
        $('#id_confirmation_popup').fadeIn();
    }, /* SConfPopup */

    /*
	 * Show/Hide Delete Links
	 * 
	 * @param cl_hand - class Handler (what is changed)
	 * @param str_cl_subject - string with classes of Subjects through the comma (what will be changed)
	 * @param what - additional uniq param
	 */
    SHDeleteLinks: function ( cl_hand, str_cl_subject, what ) {
        if ($('.'+cl_hand).unbind('mouseover')) {
            $('.'+cl_hand).mouseover(function () {
                var id = $(this).attr(what);
                if (id) {
                    var cl_subject = str_cl_subject.split(',');
                    var cnt_cl_subject = cl_subject.length;
                    for ( j = 0; j < cnt_cl_subject; j++ ) {
                        $('.'+cl_subject[j]).hide();
                        $('.'+cl_subject[j]+'['+what+'='+id+']').show();
                    } 
                }

            });
        }
		
        if ($('.'+cl_hand).unbind('mouseout')) {
            $('.'+cl_hand).mouseout(function () {
                var cl_subject = str_cl_subject.split(',');
                var cnt_cl_subject = cl_subject.length;
                for ( j = 0; j < cnt_cl_subject; j++ ) {
                    $('.'+cl_subject[j]).hide();
                }
            });
        }
    }, /* SHDeleteLinks */

    /*
	 * Set HTML Editor to textarea
	 * 
	 * @param ad_coef - additional coefficient for textarea
	 */
    SetHE: function ( he, m_page ) {

        if(typeof(m_page) == "undefined")
        {
            var m_page;
            m_page = 'journal';
        }
        var sPath = stlDir+'adLibs/HtmlEditor/';

        if(m_page == 'journal')
        {
            $('.he_editor').htmlarea({
                toolbar: [
                ['bold', 'italic', 'underline', '|', 'forecolor', '|'],
                ['increaseFontSize', '|', 'decreaseFontSize', '|', 'justifyleft', 'justifycenter','justifyright', '|']
                , [{css: "photo_button nav_attach_links top_nav_attach_links", text: "Add photo", mtype: "photo", action: function(btn) { }}]
                , [{css: "video_button nav_attach_links top_nav_attach_links", text: "Add video", mtype: "video", action: function(btn) { }}]
                , [{css: "event_button nav_attach_links top_nav_attach_links", text: "Add event", mtype: "ev", action: function(btn) { }}]
                , [{css: "link_button nav_attach_links top_nav_attach_links", text: "Add link", mtype: "link", action: function(btn) { }}]
                , [{css: "tag_button", text: "Add tag", action: function(btn) { $('#id_tags_menu_0').toggle();}}]
                , [{css: "smile_button", text: "Add smile", action: function(btn) {$('#show_smile_tab').slideToggle('fast'); $("#show_smile_tab").mouseout(function() {$(this).hide();}); $("#show_smile_tab").mouseover(function() {$(this).show();});}}]
                ],
                m_page: "journal"
            //css: sPath+'he_footer.css'
            });
            $('.he_show').show();
            $('.ToolBar').append( '<div class="clear" style="clear:both;background-color:#EEE;height:1px;"><!-- --></div><input type="text" name="WI[subj]" id="id_jwrite_subj" value="Title" onclick="if (\'Subject\'==this.value) { $(this).val(\'\').css(\'color\', \'#000\'); }" />' );
        }
        else
        {
            $('.he_editor').htmlarea({
                toolbar: [
                ['bold', 'italic', 'underline', '|', 'forecolor', '|'],
                ['increaseFontSize', '|', 'decreaseFontSize', '|', 'justifyleft', 'justifycenter','justifyright', '|']
                , [{css: "photo_button nav_attach_links top_nav_attach_links", text: "Add photo", mtype: "photo", action: function(btn) { }}]
                , [{css: "video_button nav_attach_links top_nav_attach_links", text: "Add video", mtype: "video", action: function(btn) { }}]
               // , [{css: "event_button nav_attach_links top_nav_attach_links", text: "Add event", mtype: "ev", action: function(btn) { }}]
                , [{css: "link_button nav_attach_links top_nav_attach_links", text: "Add link", mtype: "link", action: function(btn) { }}]
                , [{css: "smile_button", text: "Add smile", action: function(btn) {$('#show_smile_tab').slideToggle('fast'); $("#show_smile_tab").mouseout(function() {$(this).hide();}); $("#show_smile_tab").mouseover(function() {$(this).show();});}}]
                ],
                m_page: "inbox"
            //css: sPath+'he_footer.css'
            });
            $('.he_show').show();
        }
    } /* SetHE */
}

var oSystem = new System();