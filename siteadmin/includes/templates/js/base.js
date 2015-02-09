function Go(link) {
    document.location=link;
	return true;
}

function CGo(link, mesg) {
    if (confirm(mesg))
	{
		document.location=link;
		return true;
	}
}

function _v(id) {
    return document.getElementById(id);
}
