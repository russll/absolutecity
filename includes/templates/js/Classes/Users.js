function Users()
{
    this.__construct();
}

Users.prototype =
{
    oldscripture    : null,
    __construct : function ()
    {
        $(function()
        {
            /** init signUp */
            if (UserID == '')
            {
                $("#reg_btn").click(function (e)
                {
                    oUsers.SignUp();
                });
                $("#login_btn").click(function (e)
                {
                    oUsers.SignIn();
                });
            }
        });
        tempTags = new Array('my church talks');
        tempTagsNextId = 1;
    },

    SignUp: function()
    {
        var er = 0;
        $("#reg_errs").hide();
        $("#reg_errs").html('');

        if (jQuery.trim($("#rname").val()) == "" ||
                jQuery.trim($("#rlname").val()) == "" ||
                jQuery.trim($("#remail").val()) == "" ||
                jQuery.trim($("#remail2").val()) == "" ||
                jQuery.trim($("#rpass").val()) == "" ||
                jQuery.trim($("#bday").val()) == "" ||
                jQuery.trim($("#bmonth").val()) == "" ||
                jQuery.trim($("#byear").val()) == ""

                )
        {
            er = 1;
        } else if ('Select' == $("#rgender").val())
        {
            er = 3;
        }
        else if ($("#remail").val() != $("#remail2").val())
        {
            er = 2;
        }

        if (!er)
        {
            $.ajax({
                type:     'POST',
                dataType: 'json',
                data:    {
                    'fname'    :$("#rname").val(),
                    'bday'        :$("#bday").val(),
                    'bmonth'    :$("#bmonth").val(),
                    'byear'    :$("#byear").val(),
                    'lname'    :$("#rlname").val(),
                    'email'    :$("#remail").val(),
                    'pass'        :$("#rpass").val(),
                    'gender'    :$("#rgender").val(),
                    'ajaxinit'    :'1'
                },

                url:      '/security/users/Ajaxreg',
                success: function (data)
                {
                    if (data.q == 'err')
                    {
                        var ol = data.errs.length;
                        var j;
                        for (j = 0; j < ol; j++)
                        {
                            $("#reg_errs").html($("#reg_errs").html() + data.errs[j] + ( (j != ol) ? '<br />' : '' ));
                        }

                        $("#reg_errs").show();
                    }
                    else if (data.q == 'ok')
                    {
                        $("#reg_errs").hide();
                        document.location = '/';//'/security/users/approved';
                    }
                }
            });
        }
        else
        {
            if (er == 2)
                $("#reg_errs").html('E-mails do not match.');
            else
            if (er == 3)
                $("#reg_errs").html('Please select either Male or Female.');
            else
                $("#reg_errs").html('You must fill in all of the fields.');

            $("#reg_errs").show();
        }

    },

    SignIn: function()
    {
        $("#login_errs").hide();
        var er = 0;
        if (jQuery.trim($("#system_login").val()) == "" ||
                jQuery.trim($("#system_pass").val()) == "")
        {
            er = 1;
        }

        var rmb = $('input[name="remember"]').is(':checked') ? 1 : 0;

        if (!er)
        {
            $.ajax({
                type:     'POST',
                dataType: 'json',
                data:     "system_login=" + $("#system_login").val() + "&system_pass=" + $("#system_pass").val() + "&remember=" + rmb + "&ajaxinit=1",
                url:      '/security/users/Ajaxlogin',
                success: function (data)
                {
                    if (data['q'] == 'err')
                    {
                        $("#login_errs").html('Wrong login or password.');
                        $("#login_errs").show();
                    } else
                    {
                        $("#login_errs").hide();
                        document.location = '/';

                    }
                }
            });
        }
        else
        {
            $("#login_errs").html('You must fill in all of the fields.');
            $("#login_errs").show();
        }
    },


    FbAuth: function(id, fname, lname, gender, birthday, email)
    {
        $.ajax({
            type:     'POST',
            dataType: 'json',
            cache: false,
            data:     {
                      "id": id,
                      "ajaxinit": 1,
                      "fname":  fname,
                      "lname":  lname,
                      "gender": gender,
                      "birthday": birthday,
                      "email": email
                      },
            url:      '/security/users/FbAuth',
            success: function (data)
            {
                if (data.q == 'ok')
                {
                    document.location='/id'+data.id;
                }
            }
        });
    },


    SettingsBasic: function()
    {
        $.ajax({
            type:     'POST',
            dataType: 'json',
            cache: false,
            data:     "act=basic&ajaxinit=1",
            url:      '/security/users/Ajaxsettings',
            success: function (data)
            {
                if (data.q == 'ok' && data.form)
                {
                    $("#basic_info").html(data.form);
                    oUsers.InitFamilyComplete('fam');
                    NFFix();
                }
            }
        });
    },

    SettingsBasicSubm: function()
    {

        var bmonth = Number($('#bmonth').val());
        var bday = Number($('#bday').val());
        var byear = Number($('#byear').val());

        if ((bmonth || bday || byear) && (!isDate(bmonth, bday, byear)))
        {
            alert('Please, enter correct date of birth, or do not enter it all');
            return false;
        }

        var options = {
            url: "/security/users/Ajaxsettings?act=basic_save",
            data: {
                'ajaxinit': 1
            },
            beforeSubmit: function()
            {
                $('#basic_info_err').html('').hide();
            },
            success: function(data)
            {
                if (data)
                {
                    if ('error_dob' == data)
                    {
                        $('#basic_info_err').html('You must be at least 13 years old to use inZion').show();
                    } else
                    {
                        $("#basic_info").html(data);
                        NFFix();
                    }
                }
            }
        };
        $("#basic_info_form").ajaxSubmit(options);
    },

    SettingsBasicCnl: function()
    {
        $.ajax({
            type:     'POST',
            dataType: 'json',
            cache: false,
            data:     "act=basic_cancel&ajaxinit=1",
            url:      '/security/users/Ajaxsettings',
            success: function (data)
            {
                if (data.q == 'ok' && data.form)
                {
                    $("#basic_info").html(data.form);
                    NFFix();
                }
            }
        });
    },

    SettingsBasicAddRel: function()
    {
        var obj = $("#basic_rel tr:first").clone(true);
        $(obj).find('input:text').val('');
        $(obj).find('select').val(0);
        $(obj).appendTo("#basic_rel");
        oUsers.InitFamilyComplete('fam');
        NFFix();
    },

    SettingsBasicDelRel: function(obj)
    {
        if ($("#basic_rel tr").length > 1)
        {
            $(obj).remove();
        } else
        {
            $(obj).find('input:text').val('');
            $(obj).find('select').val(0);
        }
        NFFix();
    },

    SettingsBasicAddLng: function()
    {
        var obj = $("#basic_lng tr:first").clone(true);
        $(obj).find('select').val(0);
        $(obj).appendTo("#basic_lng");
        NFFix();
    },

    SettingsBasicDelLng: function(obj)
    {
        if ($("#basic_lng tr").length > 1)
        {
            obj.remove();
        } else
        {
            $(obj).find('select').val(0);
        }
        NFFix();
    },


    SettingsContacts: function()
    {
        $.ajax({
            type:     'POST',
            dataType: 'json',
            cache: false,
            data:     "act=contacts&ajaxinit=1",
            url:      '/security/users/Ajaxsettings',
            success: function (data)
            {
                if (data.q == 'ok' && data.form)
                {
                    $("#contacts_info").html(data.form);
                    NFFix();
                }
            }
        });
    },

    SettingsContactsSubm: function()
    {
        var options = {
            url: "/security/users/Ajaxsettings?act=contacts_save",
            data: {
                'ajaxinit': 1
            },
            success: function(data)
            {
                if (data)
                {
                    $("#contacts_info").html(data);
                    NFFix();
                }
            }
        };
        $("#contacts_info_form").ajaxSubmit(options);
    },

    SettingsContactsCnl: function()
    {
        $.ajax({
            type:     'POST',
            dataType: 'json',
            cache: false,
            data:     "act=contacts_cancel&ajaxinit=1",
            url:      '/security/users/Ajaxsettings',
            success: function (data)
            {
                if (data.q == 'ok' && data.form)
                {
                    $("#contacts_info").html(data.form);
                    NFFix();
                }
            }
        });
    },

    SettingsContactsAddIm: function()
    {
        var obj = $("#contacts_im tr:first").clone(true);
        $(obj).find('input:text').val('');
        $(obj).find('select').val(0);
        $(obj).appendTo("#contacts_im");
        NFFix();
    },

    SettingsContactsDelIm: function(obj)
    {
        if ($("#contacts_im tr").length > 1)
        {
            $(obj).remove();
        } else
        {
            $(obj).find('input:text').val('');
            $(obj).find('select').val(0);
        }
        NFFix();
    },

    SettingsContactsEditName: function()
    {
        $('#contacts_name').show();
        $('#contacts_name_b').hide();
        $('#edit_name').val('1');
    },

    SettingsContactsNoEditName: function()
    {
        $('#contacts_name').hide();
        $('#contacts_name_b').show();
        $('#edit_name').val('0');
    },

    SettingsContactsEditEmail: function()
    {
        $('#contacts_email').show();
        $('#contacts_email_b').hide();
        $('#edit_email').val('1');
    },

    SettingsContactsNoEditEmail: function()
    {
        $('#contacts_email').hide();
        $('#contacts_email_b').show();
        $('#edit_email').val('0');
    },

    SettingsChurch: function()
    {
        $.ajax({
            type:     'POST',
            dataType: 'json',
            cache: false,
            data:     "act=church&ajaxinit=1",
            url:      '/security/users/Ajaxsettings',
            success: function (data)
            {
                if (data.q == 'ok' && data.form)
                {
                    $("#church_info").html(data.form);

                    oUsers.InitCityComplete('loc');
                    oUsers.InitWardComplete('ward');
                    oUsers.InitStakeComplete('stake');

                    var ward_id = $('#ward_id').val();
                    if (ward_id)
                    {
                        oUsers.InitClassComplete('schl', ward_id);
                    }
                    //oUsers.InitMissionComplete('mission');
                    NFFix();
                }
            }
        });
    },
    
    SettingsChurchWeek: function()
    {
        $.ajax({
            type:     'POST',
            dataType: 'json',
            cache: false,
            data:     "act=ward&ajaxinit=1&week=1",
            url:      '/security/users/Ajaxsettings',
            success: function (data)
            {
                if (data.q == 'ok' && data.form)
                {
                    $('#show_info_church').show();
                    $("#edit_church").html(data.form);

                    oUsers.InitWardComplete('ward');
                    oUsers.InitStakeComplete('stake');

                    $('#ward_not_found').click(function()
                    {
                        oUsers.SettingsChurchForgotWard();
                    });
                    NFFix();
                }
            }
        });
    },

    SettingsChurchSubm: function()
    {
        var options = {
            url: "/security/users/Ajaxsettings?act=church_save",
            data: {
                'ajaxinit': 1
            },
            success: function(data)
            {
                if (data)
                {
                    $("#church_info").html(data);
                    NFFix();
                }
            }
        };

        var tdays = [];
        var tmonths = [];
        var tyears = [];
        var fdays = [];
        var fmonths = [];
        var fyears = [];

        $('select[cls=from_day]').each(function()
        {
            if ($(this).parent().parent().parent().parent().attr('id') != 'church_mission_default') fdays[fdays.length] = $(this).val();
        });
        $('select[cls=from_month]').each(function()
        {
            if ($(this).parent().parent().parent().parent().attr('id') != 'church_mission_default') fmonths[fmonths.length] = $(this).val();
        });
        $('select[cls=from_year]').each(function()
        {
            if ($(this).parent().parent().parent().parent().attr('id') != 'church_mission_default') fyears[fyears.length] = $(this).val();
        });

        $('select[cls=to_day]').each(function()
        {
            if ($(this).parent().parent().parent().parent().attr('id') != 'church_mission_default') tdays[tdays.length] = $(this).val();
        });
        $('select[cls=to_month]').each(function()
        {
            if ($(this).parent().parent().parent().parent().attr('id') != 'church_mission_default') tmonths[tmonths.length] = $(this).val();
        });
        $('select[cls=to_year]').each(function()
        {
            if ($(this).parent().parent().parent().parent().attr('id') != 'church_mission_default') tyears[tyears.length] = $(this).val();
        });

        for (var i in fdays)
        {

            var has_end = (Number(tmonths[i]) != 0 || Number(tdays[i]) != 0 || Number(tyears[i]) != 0);
            var has_start = (Number(fmonths[i]) != 0 || Number(fdays[i]) != 0 || Number(fyears[i]) != 0);
            if (has_start || has_end)
            {
                if (!isDate(fmonths[i], fdays[i], fyears[i]))
                {
                    alert('Start date in mission #' + (Number(i) + 1) + ' is incorrect. Please, check the date');
                    return false;
                } else if (has_end && !isDate(tmonths[i], tdays[i], tyears[i]))
                {
                    alert('End date in mission #' + (Number(i) + 1) + ' is incorrect. Please, check the date');
                    return false;
                } else if (has_end && mktime(1, 1, 1, fmonths[i], fdays[i], fyears[i]) >= mktime(1, 1, 1, tmonths[i], tdays[i], tyears[i]))
                {
                    alert('Date of end of the mission (' + (tmonths[i] + '.' + tdays[i] + '.' + tyears[i]) + ') can not be earlier than the date it began (' + (fmonths[i] + '.' + fdays[i] + '.' + fyears[i]) + ')');
                    return false;
                }
            }
        }


        $("#church_info_form").ajaxSubmit(options);
    },

    SettingsChurchSubmWeek: function()
    {
        var options = {
            url: "/security/users/Ajaxsettings?act=church_save&week=1",
            data: {
                'ajaxinit': 1
            },
            success: function(data)
            {
                if (data)
                {
                    //$("#ward_res").text(data);
                    //$("#church_info_form").text('');
                    $("#show_info_church").hide();
                    NFFix();
                }
            }
        };

        $("#church_info_form").ajaxSubmit(options);
    },

    SettingsChurchCnl: function()
    {
        $.ajax({
            type:     'POST',
            dataType: 'json',
            cache: false,
            data:     "act=church_cancel&ajaxinit=1",
            url:      '/security/users/Ajaxsettings',
            success: function (data)
            {
                if (data.q == 'ok' && data.form)
                {
                    $("#church_info").html(data.form);
                    NFFix();
                }
            }
        });
    },

    SettingsChurchAddMission: function()
    {

        var obj = $("#church_mission_tmp tr:first").clone(true);
        obj.html($("#church_mission_default tr:first").html());
        //$(obj).find('input:text').removeClass('ac_input').removeAttr('autocomplete');

        //var obj = $("#church_mission tr:first").clone(true);
        $(obj).find('input:text').val('');
        $(obj).appendTo("#church_mission");

        var obj = $("#church_mission tr:first").next().clone(true);
        $(obj).find('select').val(0);
        $(obj).appendTo("#church_mission");

        var obj = $("#church_mission tr:first").next().next().clone(true);
        $(obj).find('select').val(0);
        $(obj).appendTo("#church_mission");

        oUsers.InitCityComplete('loc');
        NFFix();
    },

    SettingsChurchDelMission: function(obj, umid)
    {
        if (umid)
        {
            $.ajax({
                type:     'POST',
                dataType: 'html',
                cache: false,
                data:     'act=mission_delete&umid=' + umid + '&ajaxinit=1',
                url:      '/security/users/Ajaxsettings',
                success: function (data)
                {
                    if (data == 'ok')
                    {
                        if ($("#church_mission tr").length > 3)
                        {
                            $(obj).next().remove();
                            $(obj).next().remove();
                            $(obj).remove();
                        } else
                        {
                            $(obj).find('input:text').val('');
                            $(obj).next().find('select').val(0);
                            $(obj).next().next().find('select').val(0);
                        }
                        oUsers.InitCityComplete('loc');
                        NFFix();
                    }
                }
            });
        }
        else
        {
            if ($("#church_mission tr").length > 3)
            {
                $(obj).next().remove();
                $(obj).next().remove();
                $(obj).remove();
            } else
            {
                $(obj).find('input:text').val('');
                $(obj).next().find('select').val(0);
                $(obj).next().next().find('select').val(0);
            }
            oUsers.InitCityComplete('loc');
            NFFix();
        }
    },

    SettingsChurchAddClass: function()
    {
        $("#church_class").append('<tr>' + $("#church_class_default tr:first").html() + '</tr>');
        //oUsers.InitCityComplete('loc');
    },

    SettingsChurchDelClass: function(obj, ucid)
    {
        if (ucid)
        {
            $.ajax({
                type:     'POST',
                dataType: 'html',
                cache: false,
                data:     'act=class_delete&ucid=' + ucid + '&ajaxinit=1',
                url:      '/security/users/Ajaxsettings',
                success: function (data)
                {
                    if (data == 'ok')
                    {
                        $(obj).remove();
                    }
                }
            });
        }
        else
        {
            $(obj).remove();
        }
    },

    SettingsChurchAddCalling: function()
    {
        var obj = $("#church_calling tr:first").clone(true);
        $(obj).find('input:text').val('');
        $(obj).appendTo("#church_calling");

        //NFFix();
    },

    SettingsChurchDelCalling: function(obj)
    {
        if ($("#church_calling tr").length > 1)
        {
            $(obj).remove();
        } else
        {
            $(obj).find('input:text').val('');
        }
        //NFFix();
    },

    SettingsInterest: function()
    {
        $.ajax({
            type:     'POST',
            dataType: 'json',
            cache: false,
            data:     "act=interest&ajaxinit=1",
            url:      '/security/users/Ajaxsettings',
            success: function (data)
            {
                if (data.q == 'ok' && data.form)
                {
                    $("#interest_info").html(data.form);
                    NFFix();
                }
            }
        });
    },

    SettingsInterestSubm: function()
    {
        var options = {
            url: "/security/users/Ajaxsettings?act=interest_save",
            data: {
                'ajaxinit': 1
            },
            success: function(data)
            {
                if (data)
                {
                    $("#interest_info").html(data);
                    NFFix();
                }
            }
        };
        $("#interest_info_form").ajaxSubmit(options);
    },

    SettingsInterestCnl: function()
    {
        $.ajax({
            type:     'POST',
            dataType: 'json',
            cache: false,
            data:     "act=interest_cancel&ajaxinit=1",
            url:      '/security/users/Ajaxsettings',
            success: function (data)
            {
                if (data.q == 'ok' && data.form)
                {
                    $("#interest_info").html(data.form);
                    NFFix();
                }
            }
        });
    },

    SettingsInterestAdd: function()
    {
        if ($("#interest_list tr:first").css('display') == 'none')
        {
            $("#interest_list tr:first").show();
        }
        else
        {
            var obj = $("#interest_list tr:first").clone(true);
            $(obj).find(':input').val('');
            $(obj).appendTo("#interest_list");
            $(obj).show();
        }
        //NFFix();
    },

    SettingsInterestDel: function(obj)
    {
        if ($("#interest_list tr").length > 1)
        {
            $(obj).remove();
        } else
        {
            $(obj).find(':input').val('');
            $(obj).hide();
        }
        //NFFix();
    },


    SettingsEdu: function()
    {
        $.ajax({
            type:     'POST',
            dataType: 'json',
            cache: false,
            data:     "act=edu&ajaxinit=1",
            url:      '/security/users/Ajaxsettings',
            success: function (data)
            {
                if (data.q == 'ok' && data.form)
                {
                    $("#edu_info").html(data.form);
                    NFFix();
                }
            }
        });
    },

    SettingsEduSubm: function()
    {
        var options = {
            url: "/security/users/Ajaxsettings?act=edu_save",
            data: {
                'ajaxinit': 1
            },
            success: function(data)
            {
                if (data)
                {
                    $("#edu_info").html(data);
                    NFFix();
                }
            }
        };
        $("#edu_info_form").ajaxSubmit(options);
    },

    SettingsEduCnl: function()
    {
        $.ajax({
            type:     'POST',
            dataType: 'json',
            cache: false,
            data:     "act=edu_cancel&ajaxinit=1",
            url:      '/security/users/Ajaxsettings',
            success: function (data)
            {
                if (data.q == 'ok' && data.form)
                {
                    $("#edu_info").html(data.form);
                    NFFix();
                }
            }
        });
    },

    /** Add / Delete college */
    SettingsEduAddCollege: function()
    {
        var obj = $("#edu_college tr:first").clone(true);
        $(obj).find('input:text').val('');
        $(obj).find('select').val(0);
        $(obj).appendTo("#edu_college");

        var obj = $("#edu_college tr:first").next().clone(true);
        $(obj).find('input:text').val('');
        $(obj).appendTo("#edu_college");

        var obj = $("#edu_college tr:first").next().next().clone(true);
        $(obj).find('input:text').val('');
        $(obj).appendTo("#edu_college");

        NFFix();
    },

    SettingsEduDelCollege: function(obj)
    {
        if ($("#edu_college tr").length > 3)
        {
            $(obj).prev().remove();
            $(obj).prev().remove();
            $(obj).remove();
        } else
        {
            $(obj).find('input:text').val('');
            $(obj).prev().find('input:text').val('');
            $(obj).prev().prev().find('input:text').val('');
            $(obj).prev().prev().find('select').val(0);
        }
        NFFix();
    },


    /** Add / Delete high school */
    SettingsEduAddHSchool: function()
    {
        var obj = $("#edu_hschool tr:first").clone(true);
        $(obj).find('input:text').val('');
        $(obj).find('select').val(0);
        $(obj).appendTo("#edu_hschool");

        NFFix();
    },

    SettingsEduDelHSchool: function(obj)
    {
        if ($("#edu_hschool tr").length > 1)
        {
            $(obj).remove();
        } else
        {
            $(obj).find('input:text').val('');
            $(obj).find('select').val(0);
        }
        NFFix();
    },


    /** Add / Delete job */
    SettingsEduAddJob: function()
    {

        var oo = $("#edu_job tr:first");

        for (var i = 1; i <= 7; i++)
        {
            var obj = $(oo).clone(true);
            $(obj).find('select').val(0);
            $(obj).find('input:text').val('');
            $(obj).appendTo("#edu_job");
            oo = $(oo).next();
        }
        NFFix();
    },

    SettingsEduDelJob: function(obj)
    {
        if ($("#edu_job tr").length > 7)
        {
            for (var i = 1; i <= 6; i++)
            {
                $(obj).prev().remove();
            }
            $(obj).remove();
        } else
        {
            for (var i = 1; i <= 7; i++)
            {
                $(obj).find('input:text').val('');
                $(obj).find('select').val(0);
                obj = $(obj).next();
            }
        }
        NFFix();
    },


    SettingsTalk: function()
    {
        $.ajax({
            type:     'POST',
            dataType: 'json',
            cache: false,
            data:     "act=talk&ajaxinit=1",
            url:      '/security/users/Ajaxsettings',
            success: function (data)
            {
                if (data.q == 'ok' && data.form)
                {
                    $("#talk_info").html(data.form);
                    NFFix();
                }
            }
        });
    },

    SettingsTalkSubm: function()
    {
        var options = {
            url: "/security/users/Ajaxsettings?act=talk_save",
            data: {
                'ajaxinit': 1
            },
            success: function(data)
            {
                if (data)
                {
                    $("#talk_info").html(data);
                    NFFix();
                }
            }
        };
        $("#talk_info_form").ajaxSubmit(options);
    },

    InitClassComplete: function(item, ward_id)
    {
        $('.' + item).autocomplete('/security/users/AjaxClasses?ward_id=' + ward_id,
        {
            delay:        200,
            cacheLength:  7,
            // selectFirst: true,
            minChars:     2,
            // mustMatch: true,
            width:        197
        });


        /* by Eugene */
        $('#ward_not_found').click(function()
        {
            oUsers.SettingsChurchForgotWard();
        });
    },

    /* by Eugene */
    SettingsChurchForgotWard:function()
    {
       
        // replace link with 2 text inputs
        //$('#stake_id_input').attr('disabled', 'disabled');
        $('#ward_id_input').attr('disabled', 'disabled');
        var html = '<span id="new_ward_add_form">'
                + '<input type="text" id="stake_acmpl" class="wdv" style="padding:3px; color:lightgrey; width:254px;"  value="Choose stake" defaultValue="Choose stake" /><br/>'
                + '<input type="text" id="new_ward_title" class="wdv" style="padding:3px; color:lightgrey;" value="Your ward\'s title" defaultValue="Your ward\'s title" />'
                + '&nbsp;&nbsp;<input type="text" id="new_ward_location" class="wdv" style="color:lightgrey;padding:3px;" value="Your ward\'s location" defaultValue="Your ward\'s location" />'
                + '&nbsp;&nbsp;<a style="cursor:pointer;" onclick="oUsers.SettingsChurchAddWard($(\'#new_ward_title\').val(), $(\'#new_ward_location\').val(),$(\'#stake_acmpl\').val());">Add</a>'
                + '&nbsp;&nbsp;&nbsp;<a style="cursor:pointer;" onclick="oUsers.SettingsChurchCancelForgotWard()">Cancel</a></span>';

        $('#ward_not_found').replaceWith(html);
        $('#stake_id').val(0);
        $('#ward_id').val(0);

        $('#stake_acmpl').autocomplete('/base/ward/AjaxWards?stake=1', {
            delay:        200,
            cacheLength:  7,
            minChars:     2,
            width:        197,
            formatItem:   oUsers.formatItem,
            formatResult: oUsers.formatItem
        }).result(function(e, item)
        {
            $('#stake_id').val(item[0]);
            //$('#new_ward_location').val(item[1]).css('color', 'black').attr('disabled','disabled');
        });

        // autocomplete
        $('#new_ward_location').autocomplete('/security/users/AjaxCities', {
            delay: 200,
            cacheLength:  7,
            minChars: 2,
            width: 197,
            formatItem: oUsers.formatItem,
            formatResult: oUsers.formatItem
        }).result(function(e, item)
        {
            $('#ward_id').val(item[0]);
        });

        // input's default values
        $('.wdv').focus(function()
        {
            if ($(this).val() == $(this).attr('defaultValue'))
            {
                $(this).css('color', 'black');
                $(this).val('');
            }
        });
        $('.wdv').blur(function()
        {
            if ($(this).val() == '')
            {
                $(this).css('color', 'lightgrey');
                $(this).val($(this).attr('defaultValue'));
            }
        });
    },

    /* by Eugene */
    SettingsChurchCancelForgotWard: function()
    {
        //$('#stake_id_input').attr('disabled', '');
        $('#ward_id_input').attr('disabled', '');
        $('#new_ward_add_form').replaceWith('<a style="float:left; cursor:pointer;" id="ward_not_found">Haven\'t found your ward?</a>');
        $('#ward_not_found').click(function()
        {
            oUsers.SettingsChurchForgotWard();
        });
    },

    /* by Eugene */
    SettingsChurchAddWard: function(title, location, stake)
    {
        if (title == 'Your ward\'s title' || stake == 'Choose stake')
            {alert('Stake, ward title or ward location field is empty. Please specify all this fields.');
            return false;}

        if (location == 'Your ward\'s location' && stake == 'Choose stake' || location == '' && stake == '')
            {alert('Ward location field is empty. Please specify this field.');
                return false;}

        if (title == '' || location == '' || stake == '')
            {alert('Stake, ward title or ward localtion filed is empty');
            return false;}

        // do actions to add ward;
        var stake_id = $('#stake_id').val();
        var ward_id = $('#ward_id').val();
        $.ajax({
            type: 'POST',
            data: {
                'sid': stake_id,
                'wid': ward_id,
                'wt': title,
                'wl': location,
                'stake_val' : $('#stake_acmpl').val(),
                'ajaxinit': 1
            },
            dataType: 'json',
            url: siteAdr + 'security/users/AjaxAddWard/',
            success: function (data)
            {
                data = data[0];
                if (data.status == 'success')
                {
                    oUsers.SettingsChurchCancelForgotWard();
                    $('#ward_id_input').val(title + ', ' + data.location);
                    $('#ward_id').val(data.inf.wid);
                    $('#stake_id').val(data.inf.sid);
                }
                else
                {
                    if (data.answer == 'Please, choose the ward location. Use autocomplete values only.')
                               {
                                    var ward_data = $('#new_ward_location').val();
                                    var html_stake='<br /><font color="red"><small>Please, choose the ward location. Use autocomplete values only.</small></font>';
                                    $('#new_ward_location').attr('style','padding:3px; background:#FFEBE8;');
                                    $('#new_ward_add_form').append(html_stake);
                               }
                    else alert(data.answer);
                    return false;
                }
            }
        });
    },


    InitCityComplete: function(item)
    {
        $('.' + item).autocomplete('/security/users/AjaxCities',
        {
            delay:        200,
            cacheLength:  7,
            // selectFirst: true,
            minChars:     2,
            // mustMatch: true,
            width:        197,
            formatItem:   oUsers.formatItem,
            formatResult: oUsers.formatItem
        }).result(function(e, item)
        {
            //$('#'+place+'_id').val(item[0]);
        });
    },

    InitStakeComplete: function(item)
    {
        $('.' + item).autocomplete('/base/ward/AjaxWards?stake=1',
        {
            delay:        200,
            cacheLength:  7,
            // selectFirst: true,
            minChars:     2,
            // mustMatch: true,
            width:        197,
            formatItem:   oUsers.formatItem,
            formatResult: oUsers.formatItem,
            extraParams: {ward_type: function()
            {
                return $('#ward_type').val();
            }}

        }).result(function(e, item)
        {
            $('#stake_id').val(item[0]);
        });
    },

    InitWardComplete: function(item)
    {
        $('.' + item).autocomplete('/base/ward/AjaxWards',
        {
            delay:        200,
            cacheLength:  7,
            // selectFirst: true,
            minChars:     2,
            // mustMatch: true,
            width:        197,
            formatItem:   oUsers.formatItem,
            formatResult: oUsers.formatItem
        }).result(function(e, item)
        {
            $('#ward_id').val(item[0]);
        });
    },

    InitMissionComplete: function(item)
    {
        $('.' + item).autocomplete('/base/mission/AjaxMissions',
        {
            delay:        200,
            cacheLength:  7,
            // selectFirst: true,
            minChars:     2,
            // mustMatch: true,
            width:        197,
            formatItem:   oUsers.formatItem,
            formatResult: oUsers.formatItem
        });
    },

    InitFamilyComplete: function(item)
    {
        $('.' + item).autocomplete('/base/friends/frlistbynameajax',
        {
            delay:        200,
            cacheLength:  7,
            minChars:     2,
            width:        120,
            formatItem:   oUsers.formatItem,
            formatResult: oUsers.formatItem
        }).result(function(e, item)
        {
            $(this).parent('td').find('input:first').val(item[0]);
            $(this).val(item[1]);
        });

        $('#langsAC').autocomplete('/security/users/AjaxLangs',
        {
            delay:        200,
            cacheLength:  7,
            minChars:     1,
            width:        197,
            multiple: true
        });

    },


    formatItem: function(row)
    {   
        return row[1];
    },



    OptionsEdit: function(title)
    {
        $("#" + title + "_edit").show();
        //$("#" + title + "_info").hide();
        NFFix();
    },

    OptionsCnl: function(title)
    {
        $("#" + title + "_edit").hide();
        $("#" + title + "_info").show();
        NFFix();
    },

    OptionsNameSubm: function()
    {
        var options = {
            url: "/security/users/Ajaxoptions?act=edit_name",
            data: {
                'ajaxinit': 1
            },
            success: function(data)
            {
                if (data['error'] == undefined && data)
                {
                    $("#name_info").html(data);
                    NFFix();
                }
            }
        };
        $("#name_info_form").ajaxSubmit(options);
        this.OptionsCnl('name');
    },

    OptionsEmailSubm: function()
    {
        var options = {
            url: "/security/users/Ajaxoptions?act=edit_email",
            data: {
                'ajaxinit': 1
            },
            success: function(data)
            {
                if (data['error'] == undefined && data)
                {
                    $("#email_info").html(data);
                    NFFix();
                }
            }
        };
        $("#email_info_form").ajaxSubmit(options);
        this.OptionsCnl('email');
    },

    OptionsPassSubm: function()
    {
        var options = {
            url: "/security/users/Ajaxoptions?act=edit_pass",
            data: {
                'ajaxinit': 1
            },
            success: function(data)
            {
                if (data['error'] == undefined && data)
                {
                    $("#pass_info").html(data);
                    NFFix();
                }
            }
        };
        $("#pass_info_form").ajaxSubmit(options);
        this.OptionsCnl('password');
    },

    OptionsQuestionSubm: function()
    {
        var options = {
            url: "/security/users/Ajaxoptions?act=edit_question",
            data: {
                'ajaxinit': 1
            },
            success: function(data)
            {
                if (data['error'] == undefined && data)
                {
                    $("#question_info").html(data);
                    NFFix();
                }
            }
        };

        $("#question_info_form").ajaxSubmit(options);
        this.OptionsCnl('question');
    },
    /*
    OptionsDeleteSubm: function()
    {
        var options = {
            url: "/security/users/Ajaxoptions?act=edit_delete",
            data: {
                'ajaxinit': 1
            },
            success: function(data)
            {
                if (data['error'] == undefined && data)
                {
                    $("#delete_info").html(data);
                    NFFix();
                }
            }
        };
        $("#delete_info_form").ajaxSubmit(options);
        this.OptionsCnl('delete');
    },
    */

    OptionsNotifySubm: function()
    {
        // jnice hides checkboxes from ajaxSubmit
        var cbParam = "";
        var cbArr = ["news", "ward", "photo", "video", "events"];
        var cntCbArr = cbArr.length;

        var j;
        for (j = 0; j < cntCbArr; j++)
        {
            var v = cbArr[j];
            if ($("#notify_" + v).attr("checked"))
            {
                cbParam += "&notify[" + v + "]=" + $("#notify_" + v).val();
            }
        }
        // Send it
        var options = {
            url: "/security/users/Ajaxoptions?act=edit_notify" + cbParam,
            data: {
                'ajaxinit': 1
            },
            success: function(data)
            {
                if (data['error'] == undefined && data)
                {
                    $("#notify_info").html(data);
                    NFFix();
                }
            }
        };
        $("#notify_info_form").ajaxSubmit(options);
        this.OptionsCnl('notify');
    },

    OptionsPrivacySubm: function()
    {
        var options = {
            url: "/security/users/Ajaxoptions?act=edit_privacy",
            data: {
                'ajaxinit': 1
            },
            success: function(data)
            {
                if (data['q'] == undefined && data)
                {
                    $("#privacy_info").html(data);
                    NFFix();
                }
            }
        };
        $("#privacy_info_form").ajaxSubmit(options);
        this.OptionsCnl('privacy');
    },

    OptionsDeleteSubm: function()
    {
        var options = {
            url: "/security/users/Ajaxoptions?act=edit_delete",
            data: {
                'ajaxinit': 1
            },
            success: function(data)
            {
                if (data['q'] == undefined && data)
                {
                    location.reload(true);
                }
            }
        };
        $("#delete_info_form").ajaxSubmit(options);
    },

    _initListeners: function ()
    {
        if ($(".cl_subscr_show_filts").unbind('click'))
        {
            $('.cl_subscr_show_filts').click(function ()
            {
                $('#id_eclipse_img_bckgrnd').show();	//show eclipsed background
                $('.cl_subscr_list').hide();
                if (1 == $(this).attr('stype'))    //show all
                {
                    $('#id_subscr_list').show();
                    $('#id_subscribition_list').show();
                }
                else if (2 == $(this).attr('stype'))    //show subscribers list
                    $('#id_subscr_list').show();
                else if (3 == $(this).attr('stype'))    //show subscribition list
                    $('#id_subscribition_list').show();
                setTimeout('$(\'#id_eclipse_img_bckgrnd\').hide()', 200);
            });
        }

        if ($(".cl_add_filt_privacy_el").unbind('click'))
        {
            $('.cl_add_filt_privacy_el').click(function ()
            {
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
                    success: function(r)
                    {
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

        if ($(".notify_pagging").unbind('click'))
        {
            $('.notify_pagging').click(function ()
            {
                var first = $(this).attr('first');
                var last = $(this).attr('last');

                if (first && last)
                {
                    $('.notify_pagging').removeClass('act');
                    $(this).addClass('act');
                    oUsers.ChngNotifyList(first, last);
                }
            });
        }

        if ($('.cl_notify_show_filts').unbind('click'))
        {
            $('.cl_notify_show_filts').click(function ()
            {
                var ntype = $(this).attr('ntype');
                var ntypeName = $(this).html();
                var wtype = $(this).attr('wtype');

                if (ntypeName)
                {
                    $('#id_eclipse_img_bckgrnd').show();
                    $.get(siteAdr + 'base/notify/getlistajax', {
                        'ntype': ntype,
                        'wtype': wtype
                    }, function(r)
                    {
                        if ('not_success' != r)
                        {
                            $('#id_main_content').html(r);
                            $('#id_eclipse_img_bckgrnd').hide();
                        }
                    });
                }
                /*
                 $.get(siteAdr+'id'+UserID+'/getnotifyajax', {
                 'first': first,
                 'last': last
                 }, function(r) {
                 if ('not_success' != r) {
                 $('#id_notif_mini_list').html(r);
                 }
                 });
                 */
                /*
                 $('#id_eclipse_img_bckgrnd').show();
                 var ntype = $(this).attr('ntype');
                 var wtype = $(this).attr('wtype');

                 if (!ntype) ntype = '';
                 if (!wtype) wtype = '';

                 var s ='';
                 if (50 != ntype)
                 {
                 s += '[sntype!="50"]';
                 }
                 else
                 {
                 s += '[sntype="'+ntype+'"]';
                 }

                 if (wtype)
                 {
                 s += '[swtype="'+wtype+'"]';
                 }

                 if (0 != wtype)
                 {
                 $('.notific[swtype]').hide();
                 $('.notific'+s).show();
                 }
                 else
                 {
                 $('.notific[swtype]').show();
                 }
                 setTimeout('$(\'#id_eclipse_img_bckgrnd\').hide()', 300);
                 */
            });
        }

        if ($(".cl_add_filt_mtype_el").unbind('click'))
        {
            $('.cl_add_filt_mtype_el').click(function ()
            {
                var mtype = $(this).attr('mtype');
                var txt = $(this).html();
                $('#id_add_filt_frm_send_mtype').val(mtype);
                $('.cl_add_filt_listing').hide();
                $('#id_add_filt_mtype_label').html(txt);
            });
        }

        //-- SH SubMenu
        if ($('#id_smenu_sharewith').unbind('mouseover'))
        {
            $('#id_smenu_sharewith').mouseover(function ()
            {
                if ('none' == $(this).css('display'))
                {
                    $(this).show();
                    $('.dropbox00').hide();
                    $('.dropbox01').hide();
                }
            });
        }
        if ($('#id_smenu_sharewith').unbind('mouseout'))
        {
            $('#id_smenu_sharewith').mouseout(function ()
            {
                if ('block' == $(this).css('display'))
                {
                    $(this).hide();
                }
            });
        }

        if ($('.dropbox00').unbind('mouseover'))
        {
            $('.dropbox00').mouseover(function ()
            {
                if ('none' == $(this).css('display'))
                {
                    $('.dropbox00');
                    $('.dropbox01');
                    $('#id_smenu_sharewith').hide();
                    $(this).show();
                }
            });
        }

        if ($('.dropbox00').unbind('mouseout'))
        {
            $('.dropbox00').mouseout(function ()
            {
                if ('block' == $(this).css('display'))
                {
                    $(this).hide();
                }
            });
        }

        if ($('.dropbox01').unbind('mouseover'))
        {
            $('.dropbox01').mouseover(function ()
            {
                if ('none' == $(this).css('display'))
                {
                    $('.dropbox00');
                    $('.dropbox01');
                    $('#id_smenu_sharewith').hide();
                    $(this).show();
                }
            });
        }
        if ($('.dropbox01').unbind('mouseout'))
        {
            $('.dropbox01').mouseout(function ()
            {
                if ('block' == $(this).css('display'))
                {
                    $(this).hide();
                }
            });
        }


        /* eugene's avatar upload */
        $("#Filedata").filestyle({
            image: imgDir + 'browse2.png',
            imageheight : 25,
            imagewidth : 79
        });
        $("#Filedata").css('display', 'block');

        $('#id_upl_popup_add').click(function()
        {
            if ($('#Filedata').val() == '')
                return false;

            $('#id_upl_popup_add').attr('disabled', 'disabled');
            $('#loading_circle').show();
            $('#status_td').html('Loading image, please wait...');

            //$(this).attr('disabled', 'disabled');
            $.ajaxFileUpload({
                url: siteAdr + 'id' + UserID + '/chkuplavatar/?pcash=' + rand(1, 10000),
                secureuri:false,
                fileElementId: 'Filedata',
                dataType: 'json',
                success: function (data, status)
                {
                    $('#loading_circle').hide();
                    $('#status_td').html('Image was successfully loaded, thanks!');
                    $('#status_td').css('color', 'green');
                    document.location = location.href;
                },
                error: function(data, status)
                {
                    $('#status_td').html('Some error happened, sorry :(');
                    $('#status_td').css('color', 'red');
                }
            });

            return false;
        });


        oSystem.SHDeleteLinks('cl_tags_list_els', 'cl_del_link', 'tid');

    },

    SHUplPopup: function (action, id_popup)
    {
        if (1 == action)    //show
        {
            $('#id_eclipse_bckgrnd').show();	//show eclipsed background
            //$('#'+id_popup).fadeIn(300);
            _v(id_popup).style.visibility = "visible";
            _v(id_popup).style.display = "block";
        }
        else
        {
            if ($('#' + id_popup).fadeOut(300))
                $('#id_eclipse_bckgrnd').hide();	//hide eclipsed background
        }
    }, /* SHUplPopup */

    UplAvatar: function()
    {
        return false;
    },

    UplAvatarSendData: function (id_frm)
    {
        return false;
    }, /* UplAvatarSendData */

    UplAvatarComplete: function (str, img)
    {
        return false;
    }, /* UplAvatarComplete */

    DoSubscr: function ()
    {
        $('#id_eclipse_img_bckgrnd').show();	//show eclipsed background
        $.ajax({
            type: 'POST',
            port: 'dosubscr',
            data: {
                'ajaxinit': 1
            },
            url: siteAdr + 'id' + UserOtherID + '/dosubscrajax',
            success: function(r)
            {
                if ('not_success' != r)
                {
                    switch (r)
                    {
                        case '1':
                            $('#id_dosubscr_a').text('Unfollow');
                            break;
                        case '0':
                            $('#id_dosubscr_a').text('Follow');
                            break;
                    }
                }
                setTimeout('$(\'#id_eclipse_img_bckgrnd\').hide()', 200);	//show eclipsed background
            }
        });
    }, /* DoSubscr */

    EditScripture: function (act)
    {
        if (1 == act)
        {
            //this.oldscripture = $('#id_scripture').html();
            $('#id_scripture').hide();
            //$('#id_scripture_txt').val(this.oldscripture);
            $('#id_scripture_btn_edit').hide();
            $('#id_scripture_field, #id_scripture_btn_save, #id_scripture_btn_cancel').show();
        } else
        {
            var scr = $('#id_scripture_txt').val();
            if (!scr || 'undefined' == scr || null == scr || 'Scripture is absent...' == scr)
                scr = '';

            if (3 == act)
            {
                $('#id_scripture_field, #id_scripture_btn_save, #id_scripture_btn_cancel').hide();
                $('#id_scripture, #id_scripture_btn_edit').show();
                $('#id_scripture_txt').val('');
                scr = (!this.oldscripture) ? 'Scripture is absent...' : $('#id_scripture').html(scr);
            }

            if (3 != act)
            {
                $.post(siteAdr + 'id' + UserID + '/editscriptureajax', {
                    'scr': scr
                }, function(r)
                {
                    if ('not_success' != r)
                    {
                        $('#id_scripture_field, #id_scripture_btn_save, #id_scripture_btn_cancel').hide();
                        $('#id_scripture, #id_scripture_btn_edit').show();
                        r = (!r) ? 'Scripture is absent...' : r;

                        $('#id_scripture').html(nl2br(r));
                    }
                });
            }
        }
    }, /* EditScripture */


    AddTempTag: function (input_name, list_name)
    {
        var new_li = $('#tml_sample').html();
        var name = $('#' + input_name).val();

        if ('' != name && 'Add tag' != name && '' != list_name && tempTags.join().search(',' + name) == -1)
        {
            tempTags[ tempTagsNextId ] = name;
            $('#' + list_name).append(new_li.replace(/\[id\]/g, tempTagsNextId).replace(/\[name\]/g, name));

            $('#taglist').val(tempTags.join());
            $('#' + input_name).val('Add tag');
            tempTagsNextId++;

            $("#id_tags_menu_0 li").click(function()
            {
                //$("#id_tags_menu_0").hide();
            });
        }
    },


    AddTempTagVal: function (list_name, name)
    {

        if ('' != name && 'Add tag' != name && tempTags.join().search(',' + name) == -1)
        {
            return;
            
            //var new_li = $('#tml_sample').html();
            tempTags[ tempTagsNextId ] = name;
            var obj = $('#tml_sample').clone();
            /*
            if (list_name == 'id_tags_menu_list_0')
            {
                obj.find('.cl_del_link2').remove();
            }
            */

            obj = obj.html().replace(/\[id\]/g, tempTagsNextId).replace(/\[name\]/g, name);

            $('#' + list_name).append(obj);
            $('#taglist').val(tempTags.join());
            tempTagsNextId++;
            $("#id_tags_menu_0 li").click(function()
            {
                //$("#id_tags_menu_0").hide();
            });
        }
    },

    DelTempTag: function (id)
    {
        delete tempTags[id];
        $('#stag_' + id).remove();

        $('#taglist').val(tempTags.join());
    },

    ClearTempTags: function ()
    {
        for (var i in tempTags)
        {
            oUsers.DelTempTag(i);
        }
        tempTagsNextId = 1;
    },

    DeleteTag: function (tid)
    {
        $.ajax({
            type: 'POST',
            port: 'edittags',
            //dataType: 'json',
            data: {
                'tid': tid,
                'ajaxinit': 1
            },
            url: siteAdr + 'id' + UserOtherID + '/DeleteTagAjax',
            success: function(r)
            {
                if ('not_success' != r)
                {
                    $('#id_tags_menu_list_' + tid + ', #id_tags_li_el_' + tid).hide();
                }
            }
        });
    },

    EditTags: function (act, mid, mpath, wtype, tid)
    {
        var name = $('#id_inp_tag_name_' + mid).val();

        if (((1 == act && name) || (2 == act && tid) ) && name != 'Add tag')
        {
            //$('#id_eclipse_img_bckgrnd').show();	//show eclipsed background
            $.ajax({
                type: 'POST',

                dataType: 'json',
                data: {
                    'act': act,
                    'name': name,
                    'tid': tid,
                    'mid': mid,
                    'mpath': mpath,
                    'wtype': wtype,
                    'ajaxinit': 1
                },
                url: siteAdr + 'id' + UserOtherID + '/edittagsajax',
                success: function(r)
                {
                    if ('success' == r.status)
                    {
                        if (1 == act)
                        {
                            $('#tags_div').html(r.ans.tags_list);

                            if (jQuery.trim($('#id_tags_menu_list_' + mid).html()) == 'There aren\'t any tags')
                            {
                                $('#id_tags_menu_list_' + mid).html('');
                            }
                            $('#id_tags_menu_list_' + mid).append('<li><a href="/id' + UserOtherID + '/tags/id' + r.ans.id + '">' + r.ans.name + '</a>&nbsp;&nbsp;</li>');
                        }
                        else if (2 == act && tid)
                        {
                            $('#id_tags_menu_list_' + tid).remove();
                            $('#id_tags_li_el_' + tid).remove();
                        }
                    }
                    $('#id_inp_tag_name_' + mid).val('Add tag');
                    //setTimeout('$(\'#id_eclipse_img_bckgrnd\').hide()', 200);	//show eclipsed background
                }
            });
        }
    }, /* EditTags */

    DelTagFromMesg: function(tid, mid)
    {

        if (mid && tid)
        {
            $.ajax({
                type: 'POST',
                port: 'edittags',
                data: {
                    'mid': mid,
                    'tid': tid,
                    'ajaxinit': 1
                },
                url: siteAdr + 'id' + UserOtherID + '/DelTagFromMesgAjax',
                success: function(r)
                {
                    if ('not_success' != r)
                    {
                        $('#id_tags_mes_' + mid).hide();
                    }
                }
            });
        }
    },

    EditTagsMes: function (act, tid, mid, mpath, wtype)
    {
        //$('#id_eclipse_img_bckgrnd').show();	//show eclipsed background

        if (act && mid && mpath)
        {
            $.ajax({
                type: 'POST',
                port: 'edittags',
                data: {
                    'act': act,
                    'tid': tid,
                    'mid': mid,
                    'mpath': mpath,
                    'wtype': wtype,
                    'ajaxinit': 1
                },
                url: siteAdr + 'id' + UserOtherID + '/EditFavoriteAjax',
                success: function(r)
                {
                    if ('not_success' != r)
                    {
                        if (1 == act)
                        {
                            //	$('#id_edit_fav_a_'+mid+' img').removeClass('not_favorite');
                            $('#id_edit_fav_a_' + mid).attr({
                                'onclick': 'javascript: void(0);',
                                'href': 'javascript: oUsers.EditTagsMes( 2, ' + tid + ', ' + mid + ', ' + mpath + ', ' + wtype + ' );'
                            });
                            $('#id_edit_fav_a_' + mid).find('img').attr({
                                'src': imgDir + 'heart_ico03.png'
                            }).unbind('mouseover').unbind('mouseout');

                            $('#id_temp_warn_text').html('Message has been successfully added to favorites');
                            $('#id_temp_warn_popup').fadeIn('slow');
                        }
                        else if (2 == act)
                        {
                            //	$('#id_edit_fav_a_'+mid+' img').addClass('not_favorite');
                            $('#id_tags_mes_' + mid).hide();
                            $('#id_edit_fav_a_' + mid).attr({
                                'onclick': 'javascript: void(0);',
                                'href': 'javascript: oUsers.EditTagsMes( 1, ' + tid + ', ' + mid + ', ' + mpath + ', ' + wtype + ' );'
                            });
                            $('#id_edit_fav_a_' + mid).find('img').attr({
                                'src': imgDir + 'heart_ico01.png'
                            }).bind('mouseover', function()
                            {
                                $(this).attr('src', '/i/heart_ico03.png')
                            }).bind('mouseout', function()
                            {
                                $(this).attr('src', '/i/heart_ico01.png')
                            });
                            $('#id_temp_warn_text').html('Message has been successfully removed from favorites');
                            $('#id_temp_warn_popup').fadeIn('slow');

                        }
                        //FavHover();
                        setTimeout('$(\'#id_temp_warn_popup\').fadeOut(\'slow\');', 1500);
                        //setTimeout('$(\'#id_eclipse_img_bckgrnd\').hide()', 1500);	//show eclipsed background
                    }
                    //else
                    //setTimeout('$(\'#id_eclipse_img_bckgrnd\').hide()', 300);	//show eclipsed background
                }
            });
        }
    }, /* EditTagsMes */

    GetNotifyList: function(pcnt, rcnt)
    {
        if (!pcnt) pcnt = '';
        if (!rcnt) rcnt = '';
        $('#id_eclipse_img_bckgrnd').show();	//show eclipsed background
        $.get(siteAdr + 'id' + UserOtherID + '/notify/getlist', {
            'pcnt': pcnt,
            'rcnt': rcnt
        }, function(r)
        {
            if ('not_success' != r)
            {
                $('#id_div_show_more_mes').remove();
                $('#id_notify_mlist').html($('#id_notify_mlist').html() + r);
                $('#id_eclipse_img_bckgrnd').hide();	//show eclipsed background
            }
        });
    }, /* GetNotifyList */

    ChngNotifyList: function(first, last)
    {
        $.get(siteAdr + 'id' + UserOtherID + '/getmininotifyajax', {
            'first': first,
            'last': last
        }, function(r)
        {
            if ('not_success' != r)
            {
                $('#id_notif_mini_list').html(r);
            }
        });
    }, /* ChngNotifyList */

    ChangeAppear: function(offline)
    {
        $.get(siteAdr + 'id' + UserID + '/changeappearajax', {
            'offline': offline
        }, function(r)
        {
            if ('not_success' != r)
            {
                if (offline)
                {
                    $('.appear_online').show();
                    $('.appear_offline').hide();
                }
                else
                {
                    $('.appear_offline').show();
                    $('.appear_online').hide();
                }
            }
        });
    }, /* ChangeAppear */


    ReportUserSubm: function ()
    {
        $.ajax({
            type:     'POST',
            dataType: 'html',
            cache: false,
            data:     "subj="+$('#id_report_descr').val(),
            url:      '/report/uid'+$('#report_uid').val(),
            success: function (data)
            {
                //alert(data);
                if ('reported' == data)
                {
                    $('#report_uid').val(0);
                    $('#show_report').hide();
                    $('#id_temp_warn_text').html('User reported!');
                    $('#id_temp_warn_popup').fadeIn('slow');
                    setTimeout('$(\'#id_temp_warn_popup\').fadeOut(\'slow\');', 1500);
                }
            }
        });
        return true;
    },

    ReportUser: function (obj, uid)
    {
        $('#report_uid').val(uid);
        $('#show_report').show();
    },

    InviteSubm: function()
    {
        //var name  = $('#id_inv_name').val();
        var email = $('#id_inv_email').val();
        var descr = $('#id_inv_descr').val();
        $('#inv_name_err, #inv_email_err').hide();
//        if (!name) {
//            $('#inv_name_err').html('*&nbsp;Please Enter your friend\'s name').show();
//        } else if (!email || !verify_email(email)) {
        if (!email) {
            $('#inv_email_err').html('*&nbsp;Please Enter your friend\'s email').show();
        } else {
            $.ajax({
                type:     'POST',
                dataType: 'json',
                cache: false,
                data:     {'name':name, 'email':email, 'descr': descr},
                url:      '/security/users/invite',
                success: function (data)
                {
                    //alert(data.q);
                    if ('ok' == data.q || ('err'==data.q && 5==data.err)) {
                        $('#id_inv_name, #id_inv_email, #id_inv_descr').val('');
                        $('#show_invite').hide();
                        $('#id_temp_warn_text').html('Invite sent!');
                        $('#id_temp_warn_popup').fadeIn('slow');
                        setTimeout('$(\'#id_temp_warn_popup\').fadeOut(\'slow\');', 1500);
                    } else if ('err' == data.q) {
                        switch (data.err) {
                            case 1:
                                $('#inv_name_err').html('*&nbsp;Please enter friend\'s name').show();
                                break;
                            case 2:
                                $('#inv_email_err').html('*&nbsp;Please enter friend\'s email').show();
                                break;
                            case 3:
                                $('#inv_email_err').html('Email already exist in inZion').show();
                                break;
                            case 4:
                                $('#inv_email_err').html('Email already invited to inZion').show();
                                break;
                            /*
                            case 5:
                                $('#show_invite').hide();
                                break;
                            */
                            case 6:
                                $('#inv_email_err').html('Please enter correct email(s)').show();
                                break;
                        }
                    }
                }
            });
        }
    },

    SubscrPage: function(page, param) {
        $.ajax({
            type:     'POST',
            dataType: 'json',
            data:     'page='+page+'&param='+param+'&ajaxinit=1'+(!IS_USER ? '&uid='+UserOtherID : ''),
            url:      siteAdr+'security/users/GetSubscrListAjax',
            success: function (data) {
                if (data.q == 'ok') {
                    $('#id_subscr_mlist').html( data.data );
                    $('#pagging').html(data.pagging);
                }
            }
        });
    }
}

var oUsers = new Users();