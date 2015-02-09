/*
	A simple class for displaying file information and progress
	Note: This is a demonstration only and not part of SWFUpload.
	Note: Some have had problems adapting this class in IE7. It may not be suitable for your application.
*/

// Constructor
// file is a SWFUpload file object
// targetID is the HTML element id attribute that the FileProgress HTML structure will be added to.
// Instantiating a new FileProgress object with an existing file will reuse/update the existing DOM elements
function FileProgress(file, targetID) { 
	var cdate = new Date();
	var cD = addzeros(1.0*cdate.getUTCDate());
	var cM = addzeros(1.0*cdate.getUTCMonth() + 1.00);
	var cY = cdate.getUTCFullYear();
	var cHour = addzeros(1.0*cdate.getHours());
	var cMin = addzeros(1.0*cdate.getMinutes());
	
	var MissionID = $('#mission_id').val();
	
	this.filePrID = ''+file.id;
	//this.filePrName = ''+UserID+'_mw_'+MissionID+'_'+cD+cM+cY+cHour+cMin+'_'+crand+'_'+file.name; //+rand(1, 10000)
	this.filePrName = ''+UserID+'_mw_'+MissionID+'_'+crand+'_'+Txt2Charse(file.name); //+rand(1, 10000)
	this.opacity = 100;
	this.height = 0;
	
	this.fileProgressWrapper = document.getElementById(this.filePrID);
	if (!this.fileProgressWrapper) {
		
		this.fileProgressWrapper    = document.createElement('li');
		this.fileProgressWrapper.id = this.filePrID;
		
		this.fileProgressElement = document.createElement("div");
		
		var fileProgressInp = document.createElement('input');
			fileProgressInp.type  	   = 'hidden';
			fileProgressInp.value 	   = this.filePrName;
			fileProgressInp.id    	   = 'id_send_inp_photo_choose_file_p_img';
			fileProgressInp.name  	   = 'WI[p_img][]';
			fileProgressInp.p_img      = 'p_img';		//input type
		
		var fileProgressText = document.createElement('lable');
			fileProgressText.appendChild(document.createTextNode(file.name));
		
		var fileProgressDel = document.createElement('a');
			fileProgressDel.href = 'javascript: oUplPhoto.cancelUpload("'+this.filePrID+'");';
			fileProgressDel.innerHTML = 'Remove';
		
		this.fileProgressElement.appendChild(fileProgressInp);
		this.fileProgressElement.appendChild(fileProgressText);
		this.fileProgressElement.appendChild(fileProgressDel);
		
		this.fileProgressWrapper.appendChild(this.fileProgressElement);
		
		document.getElementById(targetID).appendChild(this.fileProgressWrapper);
	} else { 
		this.fileProgressElement = this.fileProgressWrapper.firstChild;
		this.reset();
	}
	document.getElementById('id_span_upl_file_cnt').innerHTML = '';
	this.height = this.fileProgressWrapper.offsetHeight;
	this.setTimer(null);
}

FileProgress.prototype.setTimer = function (timer) {
	this.fileProgressElement["FP_TIMER"] = timer;
};
FileProgress.prototype.getTimer = function (timer) {
	return this.fileProgressElement["FP_TIMER"] || null;
};

FileProgress.prototype.reset = function () {
	//this.fileProgressElement.className = "progressContainer";

	//this.fileProgressElement.childNodes[2].innerHTML = "&nbsp;";
	//this.fileProgressElement.childNodes[2].className = "progressBarStatus";
	
	//this.fileProgressElement.childNodes[3].className = "progressBarInProgress";
	//this.fileProgressElement.childNodes[3].style.width = "0%";
	
	this.appear();	
};

FileProgress.prototype.setProgress = function (percentage) {
	//this.fileProgressElement.className = "progressContainer green";
	//this.fileProgressElement.childNodes[3].className = "progressBarInProgress";
	//this.fileProgressElement.childNodes[3].style.width = percentage + "%";

	this.appear();	
};
FileProgress.prototype.setComplete = function () {
	//this.fileProgressElement.className = "progressContainer blue";
	//this.fileProgressElement.childNodes[3].className = "progressBarComplete";
	//this.fileProgressElement.childNodes[3].style.width = "";

	var oSelf = this;
	this.setTimer(setTimeout(function () {
		oSelf.disappear();
	}, 10000));
};
FileProgress.prototype.setError = function () {
	this.fileProgressElement.className = "progressContainer red";
	this.fileProgressElement.childNodes[3].className = "progressBarError";
	this.fileProgressElement.childNodes[3].style.width = "";

	var oSelf = this;
	this.setTimer(setTimeout(function () {
		oSelf.disappear();
	}, 5000));
};
FileProgress.prototype.setCancelled = function () {
	this.fileProgressElement.className = "progressContainer";
	this.fileProgressElement.childNodes[3].className = "progressBarError";
	this.fileProgressElement.childNodes[3].style.width = "";

	var oSelf = this;
	this.setTimer(setTimeout(function () {
		oSelf.disappear();
	}, 2000));
};
FileProgress.prototype.setStatus = function (status) { 
	this.fileProgressElement.childNodes[2].innerHTML = status;
};

// Show/Hide the cancel button
FileProgress.prototype.toggleCancel = function (show, swfUploadInstance) {
	this.fileProgressElement.childNodes[0].style.visibility = show ? "visible" : "hidden";
	if (swfUploadInstance) {
		var fileID = this.fileProgressID;
		this.fileProgressElement.childNodes[0].onclick = function () {
			swfUploadInstance.cancelUpload(fileID);
			return false;
		};
	}
};

FileProgress.prototype.appear = function () { 
	if (this.getTimer() !== null) {
		clearTimeout(this.getTimer());
		this.setTimer(null);
	}
	
	if (this.fileProgressWrapper.filters) {
		try {
			this.fileProgressWrapper.filters.item("DXImageTransform.Microsoft.Alpha").opacity = 100;
		} catch (e) {
			// If it is not set initially, the browser will throw an error.  This will set it if it is not set yet.
			this.fileProgressWrapper.style.filter = "progid:DXImageTransform.Microsoft.Alpha(opacity=100)";
		}
	} else {
		this.fileProgressWrapper.style.opacity = 1;
	}
	$(this.fileProgressWrapper).remove();
};

// Fades out and clips away the FileProgress box.
FileProgress.prototype.disappear = function () { 

	var reduceOpacityBy = 15;
	var reduceHeightBy = 4;
	var rate = 30;	// 15 fps

	if (this.opacity > 0) {
		this.opacity -= reduceOpacityBy;
		if (this.opacity < 0) {
			this.opacity = 0;
		}

		if (this.fileProgressWrapper.filters) {
			try {
				this.fileProgressWrapper.filters.item("DXImageTransform.Microsoft.Alpha").opacity = this.opacity;
			} catch (e) {
				// If it is not set initially, the browser will throw an error.  This will set it if it is not set yet.
				this.fileProgressWrapper.style.filter = "progid:DXImageTransform.Microsoft.Alpha(opacity=" + this.opacity + ")";
			}
		} else {
			this.fileProgressWrapper.style.opacity = this.opacity / 100;
		}
	}

	if (this.height > 0) {
		this.height -= reduceHeightBy;
		if (this.height < 0) {
			this.height = 0;
		}

		this.fileProgressWrapper.style.height = this.height + "px";
	}

	if (this.height > 0 || this.opacity > 0) {
		var oSelf = this;
		this.setTimer(setTimeout(function () {
			oSelf.disappear();
		}, rate));
	} else {
		this.fileProgressWrapper.style.display = "none";
		this.setTimer(null);
	}
};