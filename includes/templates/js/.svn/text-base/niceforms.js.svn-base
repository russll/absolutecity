/*#############################################################
Name: Niceforms
Version: 2.0
Author: Lucian Slatineanu
URL: http://www.emblematiq.com/projects/niceforms/

Feel free to use and modify but please keep this copyright intact.
#################################################################*/

//Theme Variables - edit these to match your theme
var imagesPath = "/i/";
var selectRightWidthSimple = 19;
var selectRightWidthScroll = 2;
var selectMaxHeight = 200;
var textareaTopPadding = 10;
var textareaSidePadding = 10;

//Global Variables
var NF = new Array();
var isIE = false;
var resizeTest = 1;

//Initialization function
function NFInit() {
	try {
		document.execCommand('BackgroundImageCache', false, true);
	} catch(e) {}
	if(!document.getElementById) {return false;}
	//alert("click me first");
	NFDo('start');
}
function NFDo(what) {
	//var niceforms = document.getElementsByTagName('span');
	var niceforms = $('span.niceform');
	var identifier = new RegExp('(^| )'+'niceform'+'( |$)');
	if (/MSIE (\d+\.\d+);/.test(navigator.userAgent)) {
		var ieversion=new Number(RegExp.$1);
		if(ieversion < 7) {return false;} //exit script if IE6
		isIE = true;
	}
	for(var q = 0; q < niceforms.length; q++) {if(identifier.test(niceforms[q].className)) {
		if(what == "start") { //Load Niceforms
			NF[q] = new niceform(niceforms[q]);
			niceforms[q].start();
		}
		else { //Unload Niceforms
			//niceforms[q].unload();
			NF[q] = "";
		}
	}}
}
function NFFix() {
    $('.NFSelect').remove();
	NFDo('stop');
	NFDo('start');
}
function niceform(nf) {
	nf._inputText = new Array();nf._inputRadio = new Array();nf._inputCheck = new Array();nf._inputSubmit = new Array();nf._inputFile = new Array();nf._textarea = new Array();nf._select = new Array();nf._multiselect = new Array();
	nf.add_inputText = function(obj) {this._inputText[this._inputText.length] = obj;inputText(obj);}
	nf.add_inputRadio = function(obj) {this._inputRadio[this._inputRadio.length] = obj;inputRadio(obj);}
	nf.add_inputCheck = function(obj) {this._inputCheck[this._inputCheck.length] = obj;inputCheck(obj);}
	nf.add_inputSubmit = function(obj) {this._inputSubmit[this._inputSubmit.length] = obj;inputSubmit(obj);}
	nf.add_inputFile = function(obj) {this._inputFile[this._inputFile.length] = obj;inputFile(obj);}
	nf.add_textarea = function(obj) {this._textarea[this._textarea.length] = obj;textarea(obj);}
	nf.add_select = function(obj) {this._select[this._select.length] = obj;selects(obj);}
	nf.add_multiselect = function(obj) {this._multiselect[this._multiselect.length] = obj;multiSelects(obj);}
	nf.start = function() {
		//Separate and assign elements
		var allInputs = this.getElementsByTagName('input');
		for(var w = 0; w < allInputs.length; w++) {
			switch(allInputs[w].type) {
				case "text": case "password": {this.add_inputText(allInputs[w]);break;}
				case "radio": {this.add_inputRadio(allInputs[w]);break;}
				case "checkbox": {this.add_inputCheck(allInputs[w]);break;}
				case "submit": case "reset": case "button": {this.add_inputSubmit(allInputs[w]);break;}
				case "file": {this.add_inputFile(allInputs[w]);break;}
			}
		}
		var allButtons = this.getElementsByTagName('button');
		for(var w = 0; w < allButtons.length; w++) {
			this.add_inputSubmit(allButtons[w]);
		}
		var allTextareas = this.getElementsByTagName('textarea');
		for(var w = 0; w < allTextareas.length; w++) {
			this.add_textarea(allTextareas[w]);
		}
		var allSelects = this.getElementsByTagName('select');
		for(var w = 0; w < allSelects.length; w++) {
			if(allSelects[w].size == "1") {this.add_select(allSelects[w]);}
			else {this.add_multiselect(allSelects[w]);}
		}
		//Start

		for(w = 0; w < this._select.length; w++) {this._select[w].init(w);}
	}
	nf.unload = function() {
		//Stop
		for(w = 0; w < this._select.length; w++) {this._select[w].unload();}

	}
}
function inputText(el) { //extent Text inputs
	el.oldClassName = el.className;
	el.left = document.createElement('img');
	el.left.src = imagesPath + "0.png";
	el.left.className = "NFTextLeft";
	el.right = document.createElement('img');
	el.right.src = imagesPath + "0.png";
	el.right.className = "NFTextRight";
	el.dummy = document.createElement('div');
	el.dummy.className = "NFTextCenter";
	el.onfocus = function() {
		this.dummy.className = "NFTextCenter NFh";
		this.left.className = "NFTextLeft NFh";
		this.right.className = "NFTextRight NFh";
	}
	el.onblur = function() {
		this.dummy.className = "NFTextCenter";
		this.left.className = "NFTextLeft";
		this.right.className = "NFTextRight";
	}
	el.init = function() {
		this.parentNode.insertBefore(this.left, this);
		this.parentNode.insertBefore(this.right, this.nextSibling);
		this.dummy.appendChild(this);
		this.right.parentNode.insertBefore(this.dummy, this.right);
		this.className = "NFText";
	}
	el.unload = function() {
		this.parentNode.parentNode.appendChild(this);
		this.parentNode.removeChild(this.left);
		this.parentNode.removeChild(this.right);
		this.parentNode.removeChild(this.dummy);
		this.className = this.oldClassName;
	}
}

function selects(el) { //extend Selects
        
	el.oldClassName = el.className;
	el.dummy = document.createElement('div');
	el.dummy.className = "NFSelect";
	el.dummy.style.width = el.offsetWidth + 'px';
	el.dummy.ref = el;
	el.left = document.createElement('img');
	el.left.src = imagesPath + "0.png";
	el.left.className = "NFSelectLeft";
	el.right = document.createElement('div');
	el.right.className = "NFSelectRight";

	el.txtWrp = document.createElement('span');
	el.txtWrp.style.display = 'block';
	el.txtWrp.style.maxWidth = '226px';
	el.txtWrp.style.overflow = 'hidden';
	

	el.txt = document.createTextNode( undefined != el.options[0] ? el.options[0].text : '');
	el.bg = document.createElement('div');
	el.bg.className = "NFSelectTarget";
	el.bg.style.display = "none";
	el.opt = document.createElement('ul');
	el.opt.className = "NFSelectOptions";
	
	el.opts = new Array(el.options.length);
	el.init = function(pos) {
		this.dummy.appendChild(this.left);

		this.txtWrp.appendChild(this.txt);
		this.right.appendChild(this.txtWrp);

		//this.right.appendChild(this.txt);
		this.dummy.appendChild(this.right);
		this.bg.appendChild(this.opt);
		this.dummy.appendChild(this.bg);
		for(var q = 0; q < this.options.length; q++) {
			this.opts[q] = new option(this.options[q], q);
			this.opt.appendChild(this.options[q].li);
			this.options[q].lnk.onclick = function() {
				this._onclick();

				var text =this.ref.options[this.pos].text;
				text = text.replace(/\&/, '&amp;');
				this.ref.dummy.getElementsByTagName('div')[0].innerHTML = text;
				
				//alert(this.ref.dummy.getElementsByTagName('div')[0].innerHTML);
				this.ref.options[this.pos].selected = "selected";
				for(var w = 0; w < this.ref.options.length; w++) {this.ref.options[w].lnk.className = "";}
				this.ref.options[this.pos].lnk.className = "NFOptionActive";
			}
		}
		if(this.options.selectedIndex && -1 != this.options.selectedIndex) {

			this.dummy.getElementsByTagName('div')[0].innerHTML = this.options[this.options.selectedIndex].text;
			this.options[this.options.selectedIndex].lnk.className = "NFOptionActive";
		}
		
		this.parentNode.insertBefore(this.dummy, this);
		this.className = "NFhidden";
	}
	el.unload = function() {
		this.parentNode.removeChild(this.dummy);
		this.className = this.oldClassName;
	}
	el.dummy.onclick = function() {
		var allDivs = document.getElementsByTagName('div');for(var q = 0; q < allDivs.length; q++) {if((allDivs[q].className == "NFSelectTarget") && (allDivs[q] != this.ref.bg)) {allDivs[q].style.display = "none";}}
		if(this.ref.bg.style.display == "none") {this.ref.bg.style.display = "block";}
		else {this.ref.bg.style.display = "none";}
		if(this.ref.opt.offsetHeight > selectMaxHeight) {
			this.ref.bg.style.width = this.ref.offsetWidth - selectRightWidthScroll + 33 + 'px';
			this.ref.opt.style.width = this.ref.offsetWidth - selectRightWidthScroll + 19 + 'px';
		}
		else {
			this.ref.bg.style.width = this.ref.offsetWidth - selectRightWidthSimple + 33 + 'px';
			this.ref.opt.style.width = this.ref.offsetWidth - selectRightWidthSimple + 19 +  'px';
		}
	}
	el.bg.onmouseout = function(e) {
		if (!e) var e = window.event;
		e.cancelBubble = true;
		if (e.stopPropagation) e.stopPropagation();
		var reltg = (e.relatedTarget) ? e.relatedTarget : e.toElement;
		if((reltg.nodeName == 'A') || (reltg.nodeName == 'LI') || (reltg.nodeName == 'UL')) return;
		if((reltg.nodeName == 'DIV') || (reltg.className == 'NFSelectTarget')) return;
		else{this.style.display = "none";}
	}
	el.dummy.onmouseout = function(e) {
		if (!e) var e = window.event;
		e.cancelBubble = true;
		if (e.stopPropagation) e.stopPropagation();
		var reltg = (e.relatedTarget) ? e.relatedTarget : e.toElement;
		if((reltg.nodeName == 'A') || (reltg.nodeName == 'LI') || (reltg.nodeName == 'UL')) return;
		if((reltg.nodeName == 'DIV') || (reltg.className == 'NFSelectTarget')) return;
		else{this.ref.bg.style.display = "none";}
	}
	el.onfocus = function() {this.dummy.className += " NFfocused";}
	el.onblur = function() {this.dummy.className = this.dummy.className.replace(/ NFfocused/g, "");}
	el.onkeydown = function(e) {
		if (!e) var e = window.event;
		var thecode = e.keyCode;
		var active = this.selectedIndex;
		switch(thecode){
			case 40: //down
				if(active < this.options.length - 1) {
					for(var w = 0; w < this.options.length; w++) {this.options[w].lnk.className = "";}
					var newOne = active + 1;
					this.options[newOne].selected = "selected";
					this.options[newOne].lnk.className = "NFOptionActive";
					this.dummy.getElementsByTagName('div')[0].innerHTML = this.options[newOne].text;
				}
				return false;
				break;
			case 38: //up
				if(active > 0) {
					for(var w = 0; w < this.options.length; w++) {this.options[w].lnk.className = "";}
					var newOne = active - 1;
					this.options[newOne].selected = "selected";
					this.options[newOne].lnk.className = "NFOptionActive";
					this.dummy.getElementsByTagName('div')[0].innerHTML = this.options[newOne].text;
				}
				return false;
				break;
			default:
				break;
		}
	}
}
function multiSelects(el) { //extend Multiple Selects
	el.oldClassName = el.className;
	el.height = el.offsetHeight;
	el.width = el.offsetWidth;
	el.topLeft = document.createElement('img');
	el.topLeft.src = imagesPath + "0.png";
	el.topLeft.className = "NFMultiSelectTopLeft";
	el.topRight = document.createElement('div');
	el.topRight.className = "NFMultiSelectTop";
	el.bottomLeft = document.createElement('img');
	el.bottomLeft.src = imagesPath + "0.png";
	el.bottomLeft.className = "NFMultiSelectBottomLeft";
	el.bottomRight = document.createElement('div');
	el.bottomRight.className = "NFMultiSelectBottom";
	el.left = document.createElement('div');
	el.left.className = "NFMultiSelectLeft";
	el.right = document.createElement('div');
	el.right.className = "NFMultiSelectRight";
	el.init = function() {
		var top = this.parentNode;
		if(this.previousSibling) {var where = this.previousSibling;}
		else {var where = top.childNodes[0];}
		top.insertBefore(el.topRight, where);
		top.insertBefore(el.right, where);
		top.insertBefore(el.bottomRight, where);
		this.topRight.appendChild(this.topLeft);
		this.right.appendChild(this.left);
		this.right.appendChild(this);
		this.bottomRight.appendChild(this.bottomLeft);
		el.style.width = el.topRight.style.width = el.bottomRight.style.width = el.width + 'px';
		el.style.height = el.left.style.height = el.right.style.height = el.height + 'px';
		el.className = "NFMultiSelect";
	}
	el.unload = function() {
		this.parentNode.parentNode.appendChild(this);
		this.parentNode.removeChild(this.topRight);
		this.parentNode.removeChild(this.bottomRight);
		this.parentNode.removeChild(this.right);
		this.className = this.oldClassName;
		this.style.width = this.style.height = "";
	}
	el.onfocus = function() {
		this.topLeft.className = "NFMultiSelectTopLeft NFh";
		this.topRight.className = "NFMultiSelectTop NFhr";
		this.left.className = "NFMultiSelectLeftH";
		this.right.className = "NFMultiSelectRightH";
		this.bottomLeft.className = "NFMultiSelectBottomLeft NFh";
		this.bottomRight.className = "NFMultiSelectBottom NFhr";
	}
	el.onblur = function() {
		this.topLeft.className = "NFMultiSelectTopLeft";
		this.topRight.className = "NFMultiSelectTop";
		this.left.className = "NFMultiSelectLeft";
		this.right.className = "NFMultiSelectRight";
		this.bottomLeft.className = "NFMultiSelectBottomLeft";
		this.bottomRight.className = "NFMultiSelectBottom";
	}
}
function option(el, no) { //extend Options
	el.li = document.createElement('li');
	el.lnk = document.createElement('a');
	el.lnk.href = "javascript:;";
	el.lnk.ref = el.parentNode;
	el.lnk.pos = no;
	el.lnk._onclick = el.onclick || function () {};
	el.txt = document.createTextNode(el.text);
	el.lnk.appendChild(el.txt);
	el.li.appendChild(el.lnk);
}

//Get Position
function findPosY(obj) {
	var posTop = 0;
	do {posTop += obj.offsetTop;} while (obj = obj.offsetParent);
	return posTop;
}
function findPosX(obj) {
	var posLeft = 0;
	do {posLeft += obj.offsetLeft;} while (obj = obj.offsetParent);
	return posLeft;
}
//Get Siblings
function getInputsByName(name) {
	var inputs = document.getElementsByTagName("input");
	var w = 0;var results = new Array();
	for(var q = 0; q < inputs.length; q++) {if(inputs[q].name == name) {results[w] = inputs[q];++w;}}
	return results;
}

//Add events
var existingLoadEvent = window.onload || function () {};
var existingResizeEvent = window.onresize || function() {};
window.onload = function () {
    existingLoadEvent();
    NFInit();
}
window.onresize = function() {
	if(resizeTest != document.documentElement.clientHeight) {
		existingResizeEvent();
		NFFix();
	}
	resizeTest = document.documentElement.clientHeight;
}