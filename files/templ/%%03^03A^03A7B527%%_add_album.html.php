<?php /* Smarty version 2.6.11, created on 2014-04-23 21:00:32
         compiled from mods/_popups/_add_album.html */ ?>
												<div id="id_add_album_popup" class="aj-box02" style="visibility: hidden; position: fixed; z-index: 3333; top: 25%;">
													<div class="aj-close"><a href="javascript: void(0);" onclick="oAlbums.SHUplPopup( 2, 'id_add_album_popup' )"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close_ico.gif"  /></a></div>
													<div class="aj-box02-title">
														<h2>Add an Album</h2>	
														<p>Create a new Album for your photos </p>
													</div>
													
													<form id="id_frm_add_album" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
id<?php echo $this->_tpl_vars['UserInfo']['uid']; ?>
/albums/edit" method="post">
													<div class="add-album-form">
														<p><label>Album name</label> <input id="id_upl_photo_title" name="AI[name]" type="text" value="" /></p>
														<p><label>Location</label> <input  id="id_upl_photo_loc" name="AI[location]" type="text" value="" /></p>
														<p><label>Description</label> <textarea id="id_upl_photo_descr" name="AI[descr]"></textarea></p>
														<p><label>Share with...</label> 
														<span class="niceform">
															<select name="AI[ptype]" size="1">
																<option value="0">Everyone</option>
																<option value="1">Friends and followers</option>
																<option value="2">Friends only</option>
																<option value="3">Family only</option>
																<option value="5">Private (only me)</option>
															</select>
														</span></p>
													</div>		
													</form>
													<div class="aj-button">
														<span class="aj-button01"><a href="javascript: void(0);" onclick="oAlbums.SHUplPopup( 2, 'id_add_album_popup' );">Cancel</a></span>
														<span class="aj-button02"><a href="javascript: void(0);" onclick="oAlbums.AddAlbum( 'id_frm_add_album' );">Add</a></span>	
													</div>
													
												</div>