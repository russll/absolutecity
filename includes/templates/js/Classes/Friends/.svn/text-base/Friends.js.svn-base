function Friends() { 
    this.mTimer = null;
    this.__construct( );
}

Friends.prototype = { 
    __construct : function ( )
    {
        $(function() {
            $("#show-posts").change(function (e) {
                Go( siteAdr+'users/'+cur_login+'/friends/cid'+$("#show-posts").val());
                return false;
            });
            $("#pagging_do").keyup(function(e) {
                if(e.keyCode == 13) {
                    if ( 0 < $("#pagging_do").val()) {
                        Go( siteAdr+'users/'+cur_login+'/friends/?page='+$("#pagging_do").val());
                    }
                }
            });
            $('#to_title').autocomplete('/inbox/AjaxFindUser?rev=1&ajaxinit=1',
            {
                delay:        200,
                cacheLength:  7,
                minChars:     2,
                width:        295
            }).result(function(e, item)
            {
                $('#to_title_id').val(item[1]);
            //item[0] - item[1]
            //$('#new_mess_uid').val(item[0]);
            //$(this).val(item[1]);
            });
        });//** pagging */

    },

	
    EditFrActive: function( fr_id, active ) {
        if (fr_id) {
            if (!active) active = 0;

            $.ajax({
                type:     'GET',
                dataType: 'json',
                data:     'fr_id='+ fr_id+'&active='+active,
                url:      siteAdr + 'base/friends/editfractive',
                success: function (r) {
                    if ( 'not_success' != r.res )
                    {
                        if(3 == r.res)
                        {
                            $('#blockFr' + r.fr_id).hide();
                            $('#unblockFr' + r.fr_id).show();
                        }
                        else if(1 == r.res)
                        {
                            $('#unblockFr' + r.fr_id).hide();
                            $('#blockFr' + r.fr_id).show();
                        }
                    }
                }
            });
        }
    }, /* EditFrActive */
	
	
    ChangeShowing: function()
    {
        var show   = _v("showing_members").value;

        Go(siteAdr+"base/friends/?show="+show);
    },
	
	
    ChangeShowingList: function( show_list)
    {
        var filter = $("#id_filter_list").val();
        $.ajax({
            method: "get",
            cache: true,
            mode: "abort",
            port: "invite_act_ajax_"+show_list,
  		 	 	  
            url: siteAdr+"base/friends/getlistajax?show_list="+show_list+"&filter="+filter+"&ajaxinit=1",
            success: function(res_data)
            {
                _v("id_contacts_aft").innerHTML = res_data;
                _v("id_contacts_aft").style.display = "block";
                _v("id_contacts_bef").style.display = "none";
            }
        });
    },
	
	
    ChangeShowingListOnTimer: function( show_list )
    {
        if (this.mTimer)
            clearInterval(this.mTimer);
		
        this.mTimer = setInterval('oFriends.ChangeShowingList(\''+show_list+'\')', 1*1000);
    },
	
	
    GetFrAjax: function ( fr_id, factive )
    {
        if ((!fr_id) && (!factive))
        {
            var fr_id   = _v("fr_id").value;
            var factive = _v("factive").value;		
        }
        
        $.ajax({
            method: "get",
            cache: true,
            mode: "abort",
            port: "invite_act_ajax_get_fr",
            data: {
                fr_id: fr_id,
                'ajaxinit': 1
            },
            url: "/base/friends/getfrajax",
            dataType: "json",
            success: function(res_data)
            {
                oFriends.SHWarnPopup (1, 'id_add_friend_popup', res_data.uid, res_data.first_name + ' ' + res_data.last_name, res_data.image, res_data.fpath, factive);
            }
        });
    },

    InviteFriendsAjax: function (fr_id, mesg, with_redir)
    {
        $.ajax({
            type:     'POST',
            dataType: 'json',
            data:     'fr_id='+fr_id+'&mesg='+mesg+'&ajaxinit=1',
            url:      siteAdr+'base/friends/InviteFriendsAjax',
            success: function (data) {
                if (data.q == 'ok') {
                    $("#id_add_friend_popup").hide();
                    $('#id_eclipse_bckgrnd').hide();
                    $('#friend_block').html('<b>Invitation was sent</b>');
                /*if (with_redir) {
                        document.location = siteAdr + 'id'+data.fr_id;
                    }*/
                }
            }
        });
    },
   
    GetFrList: function( pcnt, rcnt ) {
        if (!pcnt) pcnt = '';
        if (!rcnt) rcnt = '';
        $('#id_eclipse_img_bckgrnd').show();	//show eclipsed background
        $.get(siteAdr+'id'+UserOtherID+'/friends/getlist', {
            'pcnt': pcnt,
            'rcnt': rcnt
        }, function(r) {
            if ('not_success' != r) {
                $('#id_div_show_more_mes').remove();
                $('#id_fr_mlist').html($('#id_fr_mlist').html() + r);
                $('#id_eclipse_img_bckgrnd').hide();	//show eclipsed background
            }
        });
    }, /* GetNotifyList */
	
    GetListAjax: function ( page, friend_id, show_list, filter, target, spec_filt )
    {   
        if(isdefined('spec_filt'))
        {
            var spec_filt = 'a-z';
        };
        if(_v(target))
        {
            $('#id_eclipse_img_bckgrnd').show();	//show eclipsed background
            $.ajax({
                method: "get",
                cache: true,
                mode: "abort",
                port: "load_act_ajax_get_fr",
                url: "/base/friends/getlistajax?fr_id="+friend_id+"&show_list="+show_list+"&filter="+filter+"&target="+target+"&spec_filt="+spec_filt+"&page="+page+"&ajaxinit=1",
                dataType: "text",
                success: function(data)
                {
                    //if(data != 'none')
                    //{
                    $('#'+target).html(data);
                //}
                }
            });
            setTimeout('$(\'#id_eclipse_img_bckgrnd\').css({\'display\': \'none\'})', 200);	//show eclipsed background
        }
    },
	
	
    //-- -- --
	
    
    SHWarnPopup: function( action, id_popup, fr_id, fr_public_name, fr_image, fr_im_path, factive ) { 
        if (1 == action)	//show
        {
            $('#id_eclipse_bckgrnd').css({
                'display': 'block'
            });	//show eclipsed background
            if ((0 == factive) ||
                (3 == factive))
                {
                if ("" == fr_image)
                {
                    fr_im_path = siteAdr+"i/";
                    fr_image   = "no_photo_m66.jpg";
                }
                else
                    fr_im_path = fImgDir+"users/"+fr_im_path+'/s/s_';
		    	
                $('#id_friend_add_image_a').attr({
                    'href': siteAdr + '/id' + fr_id
                });
                $('#id_friend_add_login_a').attr({
                    'href': siteAdr + '/id' + fr_id
                });
                $('#id_friend_add_friend_id').val(fr_id);
                $('#id_friend_add_image').attr({
                    'src': fr_im_path + fr_image
                });
                $('#id_friend_add_login').html(fr_public_name);
                $("#"+id_popup).fadeIn(300);
            }
            else if ("" != factive)
            {
                Go(siteAdr+"base/friends/edit?friend_id="+fr_id+"&action=edit&active="+factive);
            }
        }
        else	//hide
        {
            if ($('#'+id_popup).fadeOut(300))
                $('#id_eclipse_bckgrnd').hide();	//hide eclipsed background
        }
    }, 
    
    SHConfirmPopup: function ( action, id_popup, friend_id, active ) {
        if (1 == action)	//show
        {
            $('#id_eclipse_bckgrnd').css({
                'display': 'block'
            });	//show eclipsed background
            $('#id_friend_del_friend_id').val(friend_id);
            $("#"+id_popup).fadeIn(300);
        }
        else
        {
            if ($('#'+id_popup).fadeOut(300))
                $('#id_eclipse_bckgrnd').hide();	//hide eclipsed background
        }
    }, 
    
    InviteActAjax: function ( fr_id, action, ntxt )
    {
        if (!ntxt) var ntxt = '';

        $.ajax({
            type: 'GET',
            cache: true,
            mode: 'abort',
            port: 'invite_act_ajax_'+fr_id,
            data: {
                'fr_id': fr_id,
                'action': action,
                'ntxt': ntxt,
                'ajaxinit': 1
            },
            url: siteAdr + 'base/friends/inviteactajax',
            success: function(r)
            {
                if ('not_success' != r)
                {
                    //$('div[l_frid='+fr_id+']').remove();
                    //$('#id_fr_mlist').html( r.data );
                    
                    if(ntxt == 'invites')
                    {
                        window.location.reload();
                    }
                    else
                    {
                        if(action == 1)
                        {
                            $('#i_frid' + fr_id).html('Invitation accepted');
                        }
                        else
                        {
                            $('#i_frid' + fr_id).html('Invitation deleted');
                        }
                        if ($.trim($('#inv_list').html()) == '') {
                    //$('#inv_list_all').hide();
                    }
                    }
                }
            }
        });
    },
    
    
    //-- -- --
    
    
    ShowFriendList: function( )
    {
        $("#friendList").show();
        $("#friendListName").html(fl_name);
    },  

    HideFriendList: function( )
    {
        $("#friendList").hide();
    }, 
    
    ShowCommonFriends: function ( friend_id )
    {
        $('#friendListSearch').val('');
        this.GetListAjax(friend_id, 'common', '', 'friendListTbl');
        $('#show-all-friends').removeClass('act');
        $('#show-common-friends').addClass('act');
        show_what_friends = 'common';
    },
	
    ShowAllFriends: function ( friend_id )
    {
        $('#friendListSearch').val('');
        this.GetListAjax(friend_id, 'all', '', 'friendListTbl');
        $('#show-common-friends').removeClass('act');
        $('#show-all-friends').addClass('act');
        show_what_friends = 'all';
    },

    FindFriendTimer: function ( friend_id, show_list, filter, target, search_field )
    {
        setTimeout( "oFriends.FindFriend('"+friend_id+"', '"+show_list+"', '"+filter+"', '"+target+"', '"+search_field+"')", 500 );
    },
	
    FindFriend: function( friend_id, show_list, filter, target, search_field )
    {
		
        if (filter == $("#"+search_field).val())
        {
            this.GetListAjax(friend_id, show_list, filter, target);
        }
    },     

    // < Folders >

    SubmitFolderForm: function(frm)
    {
        /*
    	this.CheckErrors(frm, {
            rename: [['length', 2]] // , ['free', false]
        });*/
        if (!this.mErrFlag)
        {
            
            $.post(siteAdr + 'base/friends/updatefolder',
            {
                jx:     0,
                fid:    frm.fid.value,
                rename: frm.rename.value,
                pass:   frm.pass.value
            }, function(data)

            {
                    oFriends.CloseFolderEditForm();
                    oFriends.GetFoldersList();
                });
        }    

        return false;
    },

    GetFoldersList: function()
    {	
        $('#folders_list').load(siteAdr + 'base/friends/getfolderslist');
    },

    ShowAddFolderForm: function()
    {
        var frm = _v('FolderEditForm');

        //this.ClearErrors(frm);
        
        // $('#folder_edit').slideToggle('slow');
        
        _v('folder_edit').style.display   = 'block';

        _v('rename_label').innerHTML      = 'Заголовок:';
        frm.fid.value    = '';
        frm.rename.value = '';
        frm.pass.value   = '';

        _v('create_new_folder').style.display = 'none';

        _v('delete_folder').style.display = 'none';

        frm.rename.focus();
    },

    ShowEditFolderForm: function(fid, rename)
    {
        var frm = _v('FolderEditForm');

        //this.ClearErrors(frm);

        if ('none' == _v('folder_edit').style.display)
            $('#folder_edit').slideToggle('slow');

        _v('folder_edit').style.display   = 'block';

        _v('rename_label').innerHTML      = 'Переименовать:';
        frm.fid.value    = fid;
        frm.rename.value = rename;
        frm.pass.value   = '';
        
        _v('delete_folder').style.display = 'inline';

        var cur_fid                       = frm.cur_fid.value;

        if (fid != cur_fid)
            _v('delete_folder').href = 'javascript:oFriends.DeleteFolder(' + fid + ')';
        else
            _v('delete_folder').href = siteAdr + 'base/friends/delete_folder?fid=' + fid;

        frm.rename.focus();
    },

    CloseFolderEditForm: function()
    {
        //this.ClearErrors(_v('FolderEditForm'));

        _v('create_new_folder').style.display = 'inline';

        // _v('folder_edit').style.display = 'none';
        $('#folder_edit').slideToggle('slow');

        return false;
    },

    DeleteFolder: function(fid)
    {
        $.get(siteAdr + 'base/friends/delete_folder?jx=1&fid=' + fid, function(data)
        {
            oFriends.CloseFolderEditForm();
            oFriends.GetFoldersList();
        });
    },

    // </ Folders >

    // -----------------------------------------------------------------------
    
    // < Folder pass  >
    
    EnterFolderPass: function(fid)
    {
        // $('#folder_pass').slideToggle('slow');
        _v('folder_pass').style.display = 'block';
        _v('PassForm').fid.value = fid;
        _v('PassForm').pass.value = '';
        _v('PassForm').pass.focus();

        _v('bad_username').style.display = 'none';

        return false;
    },

    CheckPass: function()
    {
        var fid = _v('PassForm').fid.value;

        _v('bad_username').style.display = 'none';

        $.post(siteAdr + 'mc/main/check_folder_pass', 
        {
            fid: fid,
            pass: _v('PassForm').pass.value
        }, function(data)

        {
                if (!data)
                    _v('bad_username').style.display = 'inline';
                else
                {
                    _v('bad_username').style.display = 'none';
                    _v('PassForm').submit();
                }
            });

        return false;
    },

    ClosePassForm: function()
    {
        _v('folder_pass').style.display = 'none';
        return false;
    },

    // </ Folder pass  >    
    EditFriendsFolders: function(tbl_fr_id, fid, action)
    {
        if(action)
            action = 'add';
        else
            action = 'del';

        $.get(siteAdr + 'base/friends/editfriendsfoldersAjax?action='+action+'&tbl_fr_id='+tbl_fr_id+'&fid='+fid+'&ajaxinit=1', function(data)
        {
            });
    },
    
    toggleFrFoldList: function(id)
    {
        $("#frFold"+id).slideToggle(400);
    },
    
    
    ShowMes: function()
    {
        _v("id_mes_hide").style.display = "inline";
        _v("id_mes_show").style.display = "none";
        $("#id_mes").slideDown(400);
    },
    
    
    HideMes: function()
    {
        _v("id_mes_hide").style.display = "none";
        _v("id_mes_show").style.display = "inline";
        $("#id_mes").slideUp(400);
    },
    
    DeleteFriends: function()
    { 
        $("#FriendsListForm").submit();
    },     
    
    Popups: function( id_popup, action, factive, friend_id )
    {
        if ("" != friend_id)
            _v("friend_id").value = friend_id;
    	
        if ("" != factive)
            _v("factive").value = factive;
    	
        switch(action)
        {
            case 'none':
                $('#'+id_popup).fadeOut(400);
                _v("del_contact_form_bl").style.display = 'inline';
                break;
            default:
                $('#'+id_popup).fadeIn(400);
                _v("del_contact_form_bl").style.display = 'none';
                break;
        }
    },
	
	
    EditFr: function( action, friend_id, active, where, what )
    {
        var new_active;
    	
        if ((!action) &&
            (!friend_id) &&
            (!active))
            {
            var action    = _v("conf_action").value;
            var friend_id = _v("conf_friend_id").value;
            var active    = _v("conf_active").value;
        }
        if ((action) &&
            (friend_id))
            {
            if ("add" == action)
            {
                Go(siteAdr+"base/friends/edit?friend_id="+friend_id+"&action="+action+"&active="+active);
            }
            else
            {
                $.ajax({
                    method: "get",
                    cache: true,
                    mode: "abort",
                    port: "edit_ajax_"+where,
                    url: siteAdr+"base/friends/edit?friend_id="+friend_id+"&action="+action+"&active="+active+"&ajaxinit=1",
                    success: function(res_data)
                    {
                        if ("edit" == action)
                        {
                            if (1 != active)
                            {
                                switch (where)
                                {
                                    case "fav":
                                        new_what   = "favorites unfav";
                                        break;
                                    case "block":
                                        new_what   = "block-link unblock";
                                        break;
                                }
                                new_active = 1;
                            }
                            else
                            {
                                switch (where)
                                {
                                    case "fav":
                                        new_active = 2;
                                        new_what   = "favorites fav";
                                        break;
                                    case "block":
                                        new_active = 3;
                                        new_what   = "block-link block";
                                        break;
                                }
                            }
								
                            //_v("id_a_fav_"+friend_id).href         = "javascript:oFriends.EditFr('edit', "+friend_id+", 2, 'fav', 'Favorites')";
                            //_v("id_span_fav_"+friend_id).addClass("fav");
								
                            //_v("id_a_block_"+friend_id).href         = "javascript:oFriends.EditFr('edit', "+friend_id+", 3, 'block', 'Block')";
                            //_v("id_span_block_"+friend_id).addClass("block");
								
                            _v("id_a_"+where+"_"+friend_id).href         = "javascript:oFriends.EditFr('edit', "+friend_id+", "+new_active+", '"+where+"', '"+what+"')";
                            _v("id_a_"+where+"_"+friend_id).className    = new_what;

                        //_v("id_a_fav_bot_"+friend_id).href         = "javascript:oFriends.EditFr('edit', "+friend_id+", 2, 'fav', 'Favorites')";
                        //_v("id_span_fav_bot_"+friend_id).className = "favorites fav";
								
                        //_v("id_a_block_bot_"+friend_id).href         = "javascript:oFriends.EditFr('edit', "+friend_id+", 3, 'block', 'Block')";
                        //_v("id_span_block_bot_"+friend_id).className = "block-link block";
								
                        //_v("id_a_"+where+"_bot_"+friend_id).href         = "javascript:oFriends.EditFr('edit', "+friend_id+", "+new_active+", '"+where+"', '"+what+"')";
                        //_v("id_span_"+where+"_bot_"+friend_id).className = new_what;
                        }
                        else if ("del" == action)
                        {
                            if(_v("add_contact_form_bl"))
                                _v("add_contact_form_bl").style.display 	  = "inline";
                            if(_v("cx_"+friend_id))
                                $("#cx_"+friend_id).slideUp(400)
                            $("#id_confirm_friends_popup").hide(400);
                            if(_v("friendListActBut"))
                                $("#friendListActBut").html('<a href="javascript:void()">Удалён из друзей</a>');
                            else
                            {
                                _v("del_contact_form_bl").style.display          = "none";
                                if(_v("id_a_del_"+friend_id))
                                    _v("id_a_del_"+friend_id).style.display       = "none";
                            }
                            _v("id_confirm_friends_popup").style.display          = "none";
                            _v("id_friend_info_bef_"+friend_id).innerHTML = "This user was deleted from your friend's list";
                        }
                    }
                });
            }
        }
    },

    FriendPage: function(page, param) {
        $.ajax({
            type:     'POST',
            dataType: 'json',
            data:     'page='+page+'&param='+param+'&ajaxinit=1'+(!IS_USER ? '&uid='+UserOtherID : ''),
            url:      siteAdr+'base/friends/GetListAjaxMain',
            success: function (data) {
                if (data.q == 'ok') {
                    $('#id_fr_mlist').html( data.data );
                    $('#pagging').html(data.pagging);
                }
            }
        });
    }

}
var oFriends = new Friends();