<?php /* Smarty version 2.6.11, created on 2014-03-15 08:51:13
         compiled from main.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'main.html', 87, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>inZion.com</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="<?php echo $this->_tpl_vars['stlDir']; ?>
styles.css" rel="stylesheet" type="text/css" />
 
        <link href="<?php echo $this->_tpl_vars['stlDir']; ?>
check.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $this->_tpl_vars['stlDir']; ?>
jquery.autocomplete.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $this->_tpl_vars['stlDir']; ?>
uploadify.css" rel="stylesheet" type="text/css" />

        <?php if ($this->_tpl_vars['NO_ROBOTS']): ?>
        <meta name="robots" content="noindex,nofollow"/>
        <?php endif; ?>
        <link href="http://<?php echo $this->_tpl_vars['DOMEN']; ?>
/i/favicon.ico" type="image/x-icon" rel="icon" />
        <link href="http://<?php echo $this->_tpl_vars['DOMEN']; ?>
/i/favicon.ico" type="image/x-icon" rel="shortcut icon" />

        <script type="text/javascript" src="/min/?g=jsbasic"></script>

        
        <!--  System Libs  -->
                <script type="text/javascript">
            <?php echo '
            $(document).ready(function() {
                oSystem._initInterface();
            });
            '; ?>

        </script>

        <!--  Define the default parameters  -->
        <script type="text/javascript">
            var UserID         = '<?php echo $this->_tpl_vars['UserInfo']['uid']; ?>
';
            var UserOtherID    = '<?php echo $this->_tpl_vars['ui']['uid']; ?>
';
            var siteAdr        = '<?php echo $this->_tpl_vars['siteAdr']; ?>
';
            var imgDir         = '<?php echo $this->_tpl_vars['imgDir']; ?>
';
            var flDir          = '<?php echo $this->_tpl_vars['flDir']; ?>
';
            var siteAdr        = '<?php echo $this->_tpl_vars['siteAdr']; ?>
';
            var jsDir          = '<?php echo $this->_tpl_vars['jsDir']; ?>
';
            var jsClDir        = '<?php echo $this->_tpl_vars['jsClDir']; ?>
';
            var stlDir         = '<?php echo $this->_tpl_vars['stlDir']; ?>
';
            var fImgDir        = '<?php echo $this->_tpl_vars['fImgDir']; ?>
';
            var SSesID         = '<?php echo $this->_tpl_vars['SSesID']; ?>
';

            var IS_USER = 0;
            if (UserOtherID == UserID)
                IS_USER = 1;
        </script>

        <!--  User's Libs  -->
                <!-- Configuration files -->
	    <?php echo smarty_function_config_load(array('file' => "notify.conf"), $this);?>

    </head>

    <body class="<?php if (! $this->_tpl_vars['HIDE_RC']): ?>bg001<?php else: ?>bg002<?php endif; ?>">

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_popups/_confirmation.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_popups/_warn.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_popups/_temp_warn.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	<?php if ('search' == $this->_tpl_vars['m_page']): ?>
        <!--  Initialization of the SearchBox  -->
        <script type="text/javascript">
            <?php echo '
            $(document).ready(function() {
                oSearch._initInterface();
                '; ?>

                <?php if ($this->_tpl_vars['glsrchsubfilt'] == 'Stake/Wards'): ?>
                oUsers.InitStakeComplete('ward_name');
                <?php endif; ?>
                <?php if ($this->_tpl_vars['glsrchsubfilt'] == 'Missions'): ?>
                oUsers.InitMissionComplete('mission_location');
                <?php endif; ?>
                <?php echo '
            });
            '; ?>

        </script>
        <!--  Initialization of the SearchBox  -->

	<?php elseif ('friends_list' == $this->_tpl_vars['m_page']): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_popups/_confirm_friends.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_popups/_add_friend.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php else: ?>
        <!--  Initialization of the Necasseries for TOP Boxes Libraries  -->
    	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_popups/_add_friend.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_popups/_confirm_friends.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_popups/_upl_avatar.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <!--  Initialization of the User's AvatarBox  -->
        <script type="text/javascript">
            <?php echo '
            $(document).ready(function() {
                oSearch._initListeners();
                oUsers._initListeners();
            });
            '; ?>

        </script>


	<?php if ('wards_wall' == $this->_tpl_vars['m_page']): ?>

	    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_popups/_confirm_wards.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_popups/_upl_wards_avatar.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_popups/_add_bishopric.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

        <!--  Initialization of the Ward's WallBox  -->
        <script type="text/javascript" src="<?php echo $this->_tpl_vars['jsClDir']; ?>
Wards/WardsProgress.js"></script>
        <script type="text/javascript" src="<?php echo $this->_tpl_vars['jsClDir']; ?>
Wards/Wards.js"></script>
        <script type="text/javascript" src="<?php echo $this->_tpl_vars['jsClDir']; ?>
Wards/WallProgress.js"></script>
        <script type="text/javascript" src="<?php echo $this->_tpl_vars['jsClDir']; ?>
Wards/Wall.js"></script>

        <script type="text/javascript">
            <?php echo '
            $(document).ready(function() {
                oWWall._initInterface();
                oWards._initInterface();
            });
            '; ?>

        </script>
        <!--  Initialization of the Ward's WallBox  -->

	<?php elseif ('wards_list' == $this->_tpl_vars['m_page']): ?>
	    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_popups/_confirm_wards.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <script type="text/javascript" src="<?php echo $this->_tpl_vars['jsClDir']; ?>
Wards/Wall.js"></script>
        <script type="text/javascript">
            <?php echo '
            $(document).ready(function() {
                oWWall._initInterface();
            });
            '; ?>

        </script>

	<?php elseif ('mission_wall' == $this->_tpl_vars['m_page']): ?>

	    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_popups/_confirm_mission.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_popups/_upl_mission_avatar.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_popups/_add_president.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

        <!--  Initialization of the Mission's WallBox  -->
        <script type="text/javascript" src="<?php echo $this->_tpl_vars['jsClDir']; ?>
Mission/MissionProgress.js"></script>
        <script type="text/javascript" src="<?php echo $this->_tpl_vars['jsClDir']; ?>
Mission/Mission.js"></script>
        <script type="text/javascript" src="<?php echo $this->_tpl_vars['jsClDir']; ?>
Mission/WallProgress.js"></script>
        <script type="text/javascript" src="<?php echo $this->_tpl_vars['jsClDir']; ?>
Mission/Wall.js"></script>

        <script type="text/javascript">
            <?php echo '
            $(document).ready(function() {
                oMWall._initInterface();
                oMission._initInterface();
            });
            '; ?>

        </script>
        <!--  Initialization of the Mission's WallBox  -->

	<?php elseif ('mission_list' == $this->_tpl_vars['m_page']): ?>
	    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_popups/_confirm_mission.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <!--  Initialization of the Mission's WallBox  -->
        <script type="text/javascript" src="<?php echo $this->_tpl_vars['jsClDir']; ?>
Mission/Wall.js"></script>
        <?php echo '
        <script typ="text/javascript">
            $(document).ready(function() {
                oUsers.InitMissionComplete(\'mission_location\');
                oMWall._initInterface();
            });
        </script>
        '; ?>

	<?php elseif ('albums_list' == $this->_tpl_vars['m_page'] || 'albums_photos' == $this->_tpl_vars['m_page']): ?>
	    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_popups/_add_album.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_popups/_confirm_albums.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_popups/_chng_album.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	    <?php if ('albums_photos' == $this->_tpl_vars['m_page']): ?>
	        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_popups/_upl_photo.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <?php endif; ?>
        <!--  Initialization of the AlbumsBox  -->
        <script type="text/javascript" src="<?php echo $this->_tpl_vars['jsClDir']; ?>
Albums/WallProgress.js"></script>
        <script type="text/javascript" src="<?php echo $this->_tpl_vars['jsClDir']; ?>
Albums/Albums.js"></script>

        <script type="text/javascript">
            <?php echo '
            $(document).ready(function() {
                oAlbums._initInterface();
            });
            '; ?>

        </script>

        <!--  Initialization of the AlbumsPhotoBox  -->

	<?php elseif ('albums_photo' == $this->_tpl_vars['m_page']): ?>
	    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_popups/_confirm_albums.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_popups/_chng_album.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_popups/_album_photo_new_message.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_popups/_album_photo_share.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

        <script type="text/javascript" src="<?php echo $this->_tpl_vars['jsClDir']; ?>
Albums/Albums.js"></script>


        <script type="text/javascript">
            <?php echo '
            $(document).ready(function() {
                var pimg = "';  echo $this->_tpl_vars['pimg'];  echo '";	//previes navigation link of the image
                var nimg = "';  echo $this->_tpl_vars['nimg'];  echo '";	//next navigation link of the image
                setTimeout(\'this.oAlbums._initPInterface( "\'+pimg+\'", "\'+nimg+\'" )\', 700);
            });
            '; ?>

        </script>

	<?php elseif ('valbums_list' == $this->_tpl_vars['m_page'] || 'valbums_videos' == $this->_tpl_vars['m_page'] || 'valbums_video' == $this->_tpl_vars['m_page']): ?>
			<?php if ('valbums_list' == $this->_tpl_vars['m_page']):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_popups/_add_valbum.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?>
			<?php if ('valbums_videos' == $this->_tpl_vars['m_page']):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_popups/_upl_video.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?>

			<?php if ('valbums_video' == $this->_tpl_vars['m_page']): ?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_popups/_confirm_valbums.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_popups/_chng_valbum.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endif; ?>

        <!--  Initialization of the AlbumsVideoBox  -->
        <script type="text/javascript" src="<?php echo $this->_tpl_vars['jsClDir']; ?>
Valbums/Valbums.js"></script>

        <script type="text/javascript">
            <?php echo '
            $(document).ready(function() {
                oValbums._initInterface();
            });
            '; ?>

        </script>

        <!--  Initialization of the AlbumsVideoBox  -->

	<?php elseif ('journal' == $this->_tpl_vars['m_page']): ?>
        <script type="text/javascript" src="/j/jquery.timers.js"></script>
        <script type="text/javascript" src="/j/jquery.scrollTo.js"></script>
        <!--  Initialization of the JournalBox  -->
        <script type="text/javascript" src="<?php echo $this->_tpl_vars['jsClDir']; ?>
Journal/WallProgress.js"></script>
        <script type="text/javascript" src="<?php echo $this->_tpl_vars['jsClDir']; ?>
Journal/Wall.js"></script>

        <script type="text/javascript">
            <?php echo '
            $(document).ready(function() {
                oJournal._initInterface();
            });
            '; ?>

        </script>

	    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'mods/system/_init_html_editor.html', 'smarty_include_vars' => array('he_delay' => 0,'he_type' => "''+'extended'")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	<?php elseif ('inbox' == $this->_tpl_vars['m_page']): ?>

        <!--  Initialization of the JournalBox  -->
        <script type="text/javascript" src="/j/jquery.timers.js"></script>
        <script type="text/javascript" src="<?php echo $this->_tpl_vars['jsClDir']; ?>
Inbox/WallProgress.js"></script>
        <script type="text/javascript" src="<?php echo $this->_tpl_vars['jsClDir']; ?>
Inbox/Wall.js"></script>

        <script type="text/javascript">
            var last_msg_time = <?php if ($this->_tpl_vars['inb_last_msg_time']):  echo $this->_tpl_vars['inb_last_msg_time'];  else: ?>0<?php endif; ?>;
            <?php echo '
            $(document).ready(function() {
                oIWall._initInterface();
                oIWall.CheckInboxAjax();
            });
            '; ?>

        </script>

	    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'mods/system/_init_html_editor.html', 'smarty_include_vars' => array('he_delay' => 0,'he_type' => "''+'extended'")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	<?php else: ?>
        <!--  Initialization of the WallBox  -->
        <script type="text/javascript" src="/min/?g=wallbox"></script>
                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_popups/_add_filter.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <script type="text/javascript">
            <?php echo '
            $(document).ready(function() {
                oWall._initInterface();
            });
            '; ?>

        </script>
	    <?php endif; ?>

	<?php endif; ?>

        <div id="id_eclipse_bckgrnd" style="display: none; background-color: black; width: 100%; min-height: 100%; min-width: 100%; height: 100%; z-index: 1000;" align="center"></div>
        <div id="id_eclipse_img_bckgrnd" style="display: none; background-color: black; width: 100%; min-height: 100%; min-width: 100%; height: 100%; z-index: 1000;" align="center"><img style="padding-top: 25%;" src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico_loader.gif" /></div>

        <div id="id_main_contatiner" class="main-container">
            <div class="main-box">

                <!-- Header -->
                <div class="header3">
	            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                </div>
                <!-- Header -->

                <!-- top box -->
                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_top.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                <!-- top box -->

                <div class="content">
                    <table class="carcass">
                        <tr>
		                <?php if (! $this->_tpl_vars['HIDE_LC']): ?>
                            <td class="c-left">
		                  	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_left_column.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                            </td>
		                <?php endif; ?>

                            <td id="id_main_content" class="<?php if (! $this->_tpl_vars['HIDE_LC'] && ! $this->_tpl_vars['HIDE_RC']): ?>c-center<?php else: ?>c-center2<?php endif; ?>">
                                <?php if (! $this->_tpl_vars['im_blocked']): ?>
                                <?php echo $this->_tpl_vars['_content']; ?>

                            <?php endif; ?>
                            </td>

                            <td>
                            </td>
		                <?php if (! $this->_tpl_vars['HIDE_RC']): ?>
                            <td class="c-right">
			                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_right_column.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                            </td>
                                <?php endif; ?>
                        </tr>
                    </table>
                </div>

            </div>

            <!-- Footer -->
            <div id="footer">
	        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            </div>
            <!-- Footer -->
        </div>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_popups/_report.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_popups/_invite.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ga.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

        <?php if ($this->_tpl_vars['show_ward']): ?>
        <script type="text/javascript">
            <?php echo '
            $(document).ready(function() {
                var show = "';  echo $this->_tpl_vars['show_ward'];  echo '";
                oUsers.SettingsChurchWeek();
            });
            '; ?>

        </script>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_popups/_add_church_info.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <?php endif; ?>
        <!-- Query: <?php echo $this->_tpl_vars['gCnt']; ?>
, Time: <?php echo $this->_tpl_vars['gTime']; ?>
  -->
    </body>
</html>