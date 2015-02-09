/*
	A simple class for displaying file information and progress
	Note: This is a demonstration only and not part of SWFUpload.
	Note: Some have had problems adapting this class in IE7. It may not be suitable for your application.
*/

// Constructor
// file is a SWFUpload file object
// targetID is the HTML element id attribute that the UsersFileProgress HTML structure will be added to.
// Instantiating a new UsersFileProgress object with an existing file will reuse/update the existing DOM elements
function UsersFileProgress(file, targetID) { 
	var cdate = new Date();
	var cD = addzeros(1.0*cdate.getUTCDate());
	var cM = addzeros(1.0*cdate.getUTCMonth() + 1.00);
	var cY = cdate.getUTCFullYear();
	var cHour = addzeros(1.0*cdate.getHours());
	var cMin = addzeros(1.0*cdate.getMinutes());
	
	this.filePrID = ''+file.id;
		
	this.filePrName = ''+UserID+'_ava_'+crand+'_'+Txt2Charse(file.name); //+rand(999, 99999999)
	this.opacity = 100;
	this.height = 0;
	
	this.UsersFileProgressWrapper = document.getElementById(this.filePrID);
	if (!this.UsersFileProgressWrapper) {
		
		this.UsersFileProgressWrapper    = document.createElement('li');
		this.UsersFileProgressWrapper.id = this.filePrID;
		
		this.UsersFileProgressElement = document.createElement("div");
				
		var UsersFileProgressInp = document.createElement('input');
			UsersFileProgressInp.type  	   = 'hidden';
			UsersFileProgressInp.value 	   = this.filePrName;
			UsersFileProgressInp.id    	   = 'id_send_frm_avatar_choose_file';
			UsersFileProgressInp.name  	   = 'AI[p_img]';
			UsersFileProgressInp.p_img      = 'p_img';		//input type
				
		var UsersFileProgressText = document.createElement('lable');
			UsersFileProgressText.appendChild(document.createTextNode(file.name));
		
		var UsersFileProgressDel = document.createElement('a');
			UsersFileProgressDel.href = 'javascript: oUplAvatar.cancelUpload("'+this.filePrID+'");';
			UsersFileProgressDel.innerHTML = 'Remove';
		
		this.UsersFileProgressElement.appendChild(UsersFileProgressInp);
		this.UsersFileProgressElement.appendChild(UsersFileProgressText);
		this.UsersFileProgressElement.appendChild(UsersFileProgressDel);
		
		this.UsersFileProgressWrapper.appendChild(this.UsersFileProgressElement);
		
		document.getElementById(targetID).appendChild(this.UsersFileProgressWrapper);
	} else { 
		this.UsersFileProgressElement = this.UsersFileProgressWrapper.firstChild;
		this.reset();
	}
	document.getElementById('id_span_upl_file_cnt').innerHTML = '';
	this.height = this.UsersFileProgressWrapper.offsetHeight;
	this.setTimer(null);

}

UsersFileProgress.prototype.setTimer = function (timer) {
	this.UsersFileProgressElement["FP_TIMER"] = timer;
};
UsersFileProgress.prototype.getTimer = function (timer) {
	return this.UsersFileProgressElement["FP_TIMER"] || null;
};

UsersFileProgress.prototype.reset = function () {
	//this.UsersFileProgressElement.className = "progressContainer";

	//this.UsersFileProgressElement.childNodes[2].innerHTML = "&nbsp;";
	//this.UsersFileProgressElement.childNodes[2].className = "progressBarStatus";
	
	//this.UsersFileProgressElement.childNodes[3].className = "progressBarInProgress";
	//this.UsersFileProgressElement.childNodes[3].style.width = "0%";
	
	this.appear();	
};

UsersFileProgress.prototype.setProgress = function (percentage) {
	//this.UsersFileProgressElement.className = "progressContainer green";
	//this.UsersFileProgressElement.childNodes[3].className = "progressBarInProgress";
	//this.UsersFileProgressElement.childNodes[3].style.width = percentage + "%";

	this.appear();	
};
UsersFileProgress.prototype.setComplete = function () {
	//this.UsersFileProgressElement.className = "progressContainer blue";
	//this.UsersFileProgressElement.childNodes[3].className = "progressBarComplete";
	//this.UsersFileProgressElement.childNodes[3].style.width = "";

	var oSelf = this;
	this.setTimer(setTimeout(function () {
		oSelf.disappear();
	}, 10000));
};
UsersFileProgress.prototype.setError = function () {
	this.UsersFileProgressElement.className = "progressContainer red";
	this.UsersFileProgressElement.childNodes[3].className = "progressBarError";
	this.UsersFileProgressElement.childNodes[3].style.width = "";

	var oSelf = this;
	this.setTimer(setTimeout(function () {
		oSelf.disappear();
	}, 5000));
};
UsersFileProgress.prototype.setCancelled = function () {
	this.UsersFileProgressElement.className = "progressContainer";
	this.UsersFileProgressElement.childNodes[3].className = "progressBarError";
	this.UsersFileProgressElement.childNodes[3].style.width = "";

	var oSelf = this;
	this.setTimer(setTimeout(function () {
		oSelf.disappear();
	}, 2000));
};
UsersFileProgress.prototype.setStatus = function (status) { 
	this.UsersFileProgressElement.childNodes[2].innerHTML = status;
};

// Show/Hide the cancel button
UsersFileProgress.prototype.toggleCancel = function (show, swfUploadInstance) {
	this.UsersFileProgressElement.childNodes[0].style.visibility = show ? "visible" : "hidden";
	if (swfUploadInstance) {
		var fileID = this.UsersFileProgressID;
		this.UsersFileProgressElement.childNodes[0].onclick = function () {
			swfUploadInstance.cancelUpload(fileID);
			return false;
		};
	}
};

UsersFileProgress.prototype.appear = function () { 
	if (this.getTimer() !== null) {
		clearTimeout(this.getTimer());
		this.setTimer(null);
	}
	
	if (this.UsersFileProgressWrapper.filters) {
		try {
			this.UsersFileProgressWrapper.filters.item("DXImageTransform.Microsoft.Alpha").opacity = 100;
		} catch (e) {
			// If it is not set initially, the browser will throw an error.  This will set it if it is not set yet.
			this.UsersFileProgressWrapper.style.filter = "progid:DXImageTransform.Microsoft.Alpha(opacity=100)";
		}
	} else {
		this.UsersFileProgressWrapper.style.opacity = 1;
	}
	$(this.UsersFileProgressWrapper).remove();
};

// Fades out and clips away the UsersFileProgress box.
UsersFileProgress.prototype.disappear = function () { 

	var reduceOpacityBy = 15;
	var reduceHeightBy = 4;
	var rate = 30;	// 15 fps

	if (this.opacity > 0) {
		this.opacity -= reduceOpacityBy;
		if (this.opacity < 0) {
			this.opacity = 0;
		}

		if (this.UsersFileProgressWrapper.filters) {
			try {
				this.UsersFileProgressWrapper.filters.item("DXImageTransform.Microsoft.Alpha").opacity = this.opacity;
			} catch (e) {
				// If it is not set initially, the browser will throw an error.  This will set it if it is not set yet.
				this.UsersFileProgressWrapper.style.filter = "progid:DXImageTransform.Microsoft.Alpha(opacity=" + this.opacity + ")";
			}
		} else {
			this.UsersFileProgressWrapper.style.opacity = this.opacity / 100;
		}
	}

	if (this.height > 0) {
		this.height -= reduceHeightBy;
		if (this.height < 0) {
			this.height = 0;
		}

		this.UsersFileProgressWrapper.style.height = this.height + "px";
	}

	if (this.height > 0 || this.opacity > 0) {
		var oSelf = this;
		this.setTimer(setTimeout(function () {
			oSelf.disappear();
		}, rate));
	} else {
		this.UsersFileProgressWrapper.style.display = "none";
		this.setTimer(null);
	}
};