/** base styles */

$(document).ready(function(){

	FavHover();
    $(".open-drop01").click(function(){
        $(".dropbox01").slideToggle('fast');
        return false;
    });
    $(".open-cdrop02").click(function(){
        $(".dropbox02").slideToggle('fast');
        return false;
    });
    $(".open-drop03").click(function(){
        $(".dropbox03").slideToggle('fast');
        return false;
    });
    //DD_belatedPNG.fix('div, a, img, *');

    //Set sub privacy type (share with)
    if ($('#id_smenu_sharewith').unbind('mouseover'))
    {
        $('#id_smenu_sharewith').mouseover(function () {
            setTimeout('$(\'#id_smenu_sharewith\').show();', 300);
        });
    }
    if ($('#id_smenu_sharewith').unbind('mouseout'))
    {
        $('#id_smenu_sharewith').mouseout(function () {
            setTimeout('$(\'#id_smenu_sharewith\').hide(); $(\'.dropbox01.\').hide(); $(\'.dropbox00.\').hide();', 300);
        });
    }

    $('#id_eclipse_bckgrnd').css({
        'height': $(document).height()+'px',  	//eclipsed cover (for modal windows especially)
        'width': $(document).width()+'px',
        'opacity': '0.4',
        'position': 'fixed',
        'display': 'none'
    });

    $('#id_eclipse_img_bckgrnd').css({
        'height': $(document).height()+'px',    	//eclipsed cover with Image (for loading especially)
        'width': $(document).width()+'px',
        'opacity': '0.4',
        'position': 'fixed',
        'display': 'none'
    });

    //FavHover();
     /*
	 $('.user_report').css('cursor','pointer');
	 $('.user_report').click(function(){
		 var uid = $(this).attr('uid');
		 if (true === oUsers.ReportUser(uid)) {
			 //$(this).remove();
			 $(this).unbind('click');
			 $(this).attr('onclick', 'javascript:void(0)');
			 $(this).css({'color':'gray', 'cursor':'default'});
		 }
	 });
     */
});

function isDate(mm,dd,yyyy) {
    var d = new Date(mm + "/" + dd + "/" + yyyy);
    return d.getMonth() + 1 == mm && d.getDate() == dd && d.getFullYear() == yyyy;
}

function IsValidTime(timeStr) {

    var timePat = /^(\d{1,2}):(\d{2})(:(\d{2}))?(\s?(AM|am|PM|pm))?$/;

    var matchArray = timeStr.match(timePat);
    if (matchArray == null) {
        alert("Time is not in a valid format.");
        return false;
    }
    hour = matchArray[1];
    minute = matchArray[2];
    second = matchArray[4];
    ampm = matchArray[6];

    if (second=="") {
        second = null;
    }
    if (ampm=="") {
        ampm = null
    }

    if (hour < 0  || hour > 12) {
        alert("Hour must be between 1 and 12");
        return false;
    }
    if (hour <= 12 && ampm == null) {
        //if (confirm("Please indicate which time format you are using.  OK = Standard Time, CANCEL = Military Time")) {
        alert("You must specify AM or PM.");
        return false;
    //}
    }
    if  (hour > 12 && ampm != null) {
        //alert("You can't specify AM or PM for military time.");
        alert("Time is not in a valid format.");
        return false;
    }
    if (minute<0 || minute > 59) {
        alert ("Minute must be between 0 and 59.");
        return false;
    }
    if (second != null && (second < 0 || second > 59)) {
        alert ("Second must be between 0 and 59.");
        return false;
    }
    return true;
}

/* silent version*/
function IsValidTimeS(timeStr) {

    var timePat = /^(\d{1,2}):(\d{2})(:(\d{2}))?(\s?(AM|am|PM|pm))?$/;

    var matchArray = timeStr.match(timePat);
    if (matchArray == null) {
        return false;
    }
    hour = matchArray[1];
    minute = matchArray[2];
    second = matchArray[4];
    ampm = matchArray[6];

    if (second=="") {
        second = null;
    }
    if (ampm=="") {
        ampm = null
    }

    if (hour < 0  || hour > 12)							{
        return false;
    }
    if (hour <= 12 && ampm == null)						{
        return false;
    }
    if (hour > 12 && ampm != null)						{
        return false;
    }
    if (minute<0 || minute > 59)						{
        return false;
    }
    if (second != null && (second < 0 || second > 59))	{
        return false;
    }
    return true;
}

function mktime() { // Get Unix timestamp for a date

    var i = 0, d = new Date(), argv = arguments, argc = argv.length;

    var dateManip = {
        0: function(tt){
            return d.setHours(tt);
        },
        1: function(tt){
            return d.setMinutes(tt);
        },
        2: function(tt){
            return d.setSeconds(tt);
        },
        3: function(tt){
            return d.setMonth(parseInt(tt)-1);
        },
        4: function(tt){
            return d.setDate(tt);
        },
        5: function(tt){
            return d.setYear(tt);
        }
    };

    for( i = 0; i < argc; i++ ){
        if(argv[i] && isNaN(argv[i])){
            return false;
        } else if(argv[i]){
            // arg is number, let's manipulate date object
            if(!dateManip[i](argv[i])){
                // failed
                return false;
            }
        }
    }

    return Math.floor(d.getTime()/1000);
}

function FavHover()
{
	$('.favorites').mouseover(function(){
		if ($(this).is('.not_favorite')) {
			$(this).attr('src', '/i/heart_ico03.png');
		} 
	}).mouseout (function(){
        if ($(this).is('.not_favorite')) {
			$(this).attr('src', '/i/heart_ico01.png');
		}
    });

}

/** functions */

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

function isNumeric(str)
{
    if (str.length == 0) return false;
    for (var i=0; i < str.length; i++)
    {
        var ch = str.substring(i, i+1);
        if ( ch < "0" || ch>"9" || str.length == null)  return false;
    }
    return true;
}

function in_array(needle, haystack)
{
    var len = haystack.length;
    for (var i = 0; i < len; i++)
    {
        if (needle == haystack[i])
            return true;
    }

    return false;
}

function in_arrayi(needle, haystack)
{
    var len = haystack.length;
    needle = needle.toLowerCase();
    for (var i = 0; i < len; i++)
    {
        if (needle == haystack[i].toLowerCase())
            return true;
    }

    return false;
}

function rand( min, max ) 
{
    if( max )
        return Math.floor(Math.random() * (max - min + 1)) + min;
    else
        return Math.floor(Math.random() * (min + 1));
}

function deb(d, l)
{
    if (l == null) l = 1;
    var s = '';
    if (typeof(d) == 'object')
    {
        s += typeof(d) + " {\n";
        for (var k in d)
        {
            for (var i=0; i<l; i++)
                s += "  ";

            s += k+": " + deb(d[k],l+1);
        }
        for (var i=0; i<l-1; i++)
            s += "  ";

        s += "}\n"
    }
    else
        s += '' + d + "\n";

    return s;
}

function verify_email(email)
{
    if (7 > email.length)
        return false;

    var zones = new Array(
        'ac','ad','ae','af','ag','ai','al','am','an','ao','aq','ar','as','at','au','aw','az',
        'ax','ba','bb','bd','be','bf','bg','bh','bi','bj','bm','bn','bo','br','bs','bt','bv',
        'bw','by','bz','ca','cc','cd','cf','cg','ch','ci','ck','cl','cm','cn','co','cr','cs',
        'cu','cv','cx','cy','cz','de','dj','dk','dm','do','dz','ec','ee','eg','eh','er','es',
        'et','eu','fi','fj','fk','fm','fo','fr','ga','gb','gd','ge','gf','gg','gh','gi','gl',
        'gm','gn','gp','gq','gr','gs','gt','gu','gw','gy','hk','hm','hn','hr','ht','hu','id',
        'ie','il','im','in','io','iq','ir','is','it','je','jm','jo','jp','ke','kg','kh','ki',
        'km','kn','kp','kr','kw','ky','kz','la','lb','lc','li','lk','lr','ls','lt','lu','lv',
        'ly','ma','mc','md','mg','mh','mk','ml','mm','mn','mo','mp','mq','mr','ms','mt','mu',
        'mv','mw','mx','my','mz','na','nc','ne','nf','ng','ni','nl','no','np','nr','nu','nz',
        'om','pa','pe','pf','pg','ph','pk','pl','pm','pn','pr','ps','pt','pw','py','qa','re',
        'ro','ru','rw','sa','sb','sc','sd','se','sg','sh','si','sj','sk','sl','sm','sn','so',
        'sr','st','sv','sy','sz','tc','td','tf','tg','th','tj','tk','tl','tm','tn','to','tp',
        'tr','tt','tv','tw','tz','ua','ug','uk','um','us','uy','uz','va','vc','ve','vg','vi',
        'vn','vu','wf','ws','ye','yt','yu','za','zm','zw', 'su',
        'aero','biz','cat','com','coop','info','jobs','mobi','museum','name','net',
        'org','pro','travel','gov','edu','mil','int'
        );

    var regEmail = /^[\w-\.]+@([\w-]+\.)+([\w-]{2,4})$/;

    var myArr = regEmail.exec(email);

    if (null == myArr)
        return false;

    if (!in_arrayi(myArr[2], zones))
        return false;

    return true;
}

function verify_ext(ext)
{
    if (5 > ext.length)
        return false;

    var r_ext = new Array(
        'jpg', 'jpeg', 'gif','png', 'bmp');

    var regExt = /\.([a-z]{2,4}$)/;

    var myArr = regExt.exec(ext);

    if (null == myArr)
        return false;
    
    if (!in_arrayi(myArr[1], r_ext))
        return false;

    return true;
}

var url3;
function verify_url (url)
{
    if (4 > url.length)
        return false;

    /*   var zones = new Array( 'ac','ad','ae','af','ag','ai','al','am','an','ao','aq','ar','as','at','au','aw','az', 'ax','ba','bb','bd','be','bf','bg','bh','bi','bj','bm','bn','bo','br','bs','bt','bv',      'bw','by','bz','ca','cc','cd','cf','cg','ch','ci','ck','cl','cm','cn','co','cr','cs', 'cu','cv','cx','cy','cz','de','dj','dk','dm','do','dz','ec','ee','eg','eh','er','es', 'et','eu','fi','fj','fk','fm','fo','fr','ga','gb','gd','ge','gf','gg','gh','gi','gl',
	            'gm','gn','gp','gq','gr','gs','gt','gu','gw','gy','hk','hm','hn','hr','ht','hu','id', 'ie','il','im','in','io','iq','ir','is','it','je','jm','jo','jp','ke','kg','kh','ki', 'km','kn','kp','kr','kw','ky','kz','la','lb','lc','li','lk','lr','ls','lt','lu','lv', 'ly','ma','mc','md','mg','mh','mk','ml','mm','mn','mo','mp','mq','mr','ms','mt','mu',
	            'mv','mw','mx','my','mz','na','nc','ne','nf','ng','ni','nl','no','np','nr','nu','nz', 'om','pa','pe','pf','pg','ph','pk','pl','pm','pn','pr','ps','pt','pw','py','qa','re', 'ro','ru','rw','sa','sb','sc','sd','se','sg','sh','si','sj','sk','sl','sm','sn','so', 'sr','st','sv','sy','sz','tc','td','tf','tg','th','tj','tk','tl','tm','tn','to','tp',
	            'tr','tt','tv','tw','tz','ua','ug','uk','um','us','uy','uz','va','vc','ve','vg','vi', 'vn','vu','wf','ws','ye','yt','yu','za','zm','zw', 'su', 'aero','biz','cat','com','coop','info','jobs','mobi','museum','name','net',
	            'org','pro','travel','gov','edu','mil','int'
	            );

		var zones2 = '\.ru|\.ad|\.ae|\.af|\.ag|\.ai|\.al|\.am|\.an|\.ao|\.aq|\.ar|\.as|\.at|\.au|\.aw|\.az|\.ax|\.ba|\.bb|\.bd|\.be|\.bf|\.bg|\.bh|\.bi|\.bj|\.bm|\.bn|\.bo|\.br|\.bs|\.bt|\.bv'+
			'|\.bw|\.by|\.bz|\.ca|\.cc|\.cd|\.cf|\.cg|\.ch|\.ci|\.ck|\.cl|\.cm|\.cn|\.co|\.cr|\.cs|\.cu|\.cv|\.cx|\.cy|\.cz|\.de|\.dj|\.dk|\.dm|\.do|\.dz|\.ec|\.ee|\.eg|\.eh|\.er|\.es'+
			'|\.et|\.eu|\.fi|\.fj|\.fk|\.fm|\.fo|\.fr|\.ga|\.gb|\.gd|\.ge|\.gf|\.gg|\.gh|\.gi|\.gl|\.gm|\.gn|\.gp|\.gq|\.gr|\.gs|\.gt|\.gu|\.gw|\.gy|\.hk|\.hm|\.hn|\.hr|\.ht|\.hu|\.id'+
			'|\.ie|\.il|\.im|\.in|\.io|\.iq|\.ir|\.is|\.it|\.je|\.jm|\.jo|\.jp|\.ke|\.kg|\.kh|\.ki|\.km|\.kn|\.kp|\.kr|\.kw|\.ky|\.kz|\.la|\.lb|\.lc|\.li|\.lk|\.lr|\.ls|\.lt|\.lu|\.lv'+
			'|\.ly|\.ma|\.mc|\.md|\.mg|\.mh|\.mk|\.ml|\.mm|\.mn|\.mo|\.mp|\.mq|\.mr|\.ms|\.mt|\.mu|\.mv|\.mw|\.mx|\.my|\.mz|\.na|\.nc|\.ne|\.nf|\.ng|\.ni|\.nl|\.no|\.np|\.nr|\.nu|\.nz'+
			'|\.om|\.pa|\.pe|\.pf|\.pg|\.ph|\.pk|\.pl|\.pm|\.pn|\.pr|\.ps|\.pt|\.pw|\.py|\.qa|\.re|\.ro|\.ru|\.rw|\.sa|\.sb|\.sc|\.sd|\.se|\.sg|\.sh|\.si|\.sj|\.sk|\.sl|\.sm|\.sn|\.so'+
			'|\.sr|\.st|\.sv|\.sy|\.sz|\.su|\.tc|\.td|\.tf|\.tg|\.th|\.tj|\.tk|\.tl|\.tm|\.tn|\.to|\.tp|\.tr|\.tt|\.tv|\.tw|\.tz|\.ua|\.ug|\.uk|\.um|\.us|\.uy|\.uz|\.va|\.vc|\.ve|\.vg|\.vi'+
			'|\.vn|\.vu|\.wf|\.ws|\.ye|\.yt|\.yu|\.za|\.zm|\.zw|\.aero|\.biz|\.cat|\.com|\.coop|\.info|\.jobs|\.mobi|\.museum|\.name|\.net|\.org|\.pro|\.travel|\.gov|\.edu|\.mil|\.int';


	    //var regUrl = /^([0-9a-z_\-\.\/])+\.([\w-]{2,6})\/?$|i/;
		//var regUrl = '/^([0-9a-z_\-\.\/])+('+zones2+')+\/(?:\S*)$|i/';
		
		var regUrl = /^([0-9a-z_\-\.\/])+(\.ru|\.ad|\.ae|\.af|\.ag|\.ai|\.al|\.am|\.an|\.ao|\.aq|\.ar|\.as|\.at|\.au|\.aw|\.az|\.ax|\.ba|\.bb|\.bd|\.be|\.bf|\.bg|\.bh|\.bi|\.bj|\.bm|\.bn|\.bo|\.br|\.bs|\.bt|\.bv			|\.bw|\.by|\.bz|\.ca|\.cc|\.cd|\.cf|\.cg|\.ch|\.ci|\.ck|\.cl|\.cm|\.cn|\.co|\.cr|\.cs|\.cu|\.cv|\.cx|\.cy|\.cz|\.de|\.dj|\.dk|\.dm|\.do|\.dz|\.ec|\.ee|\.eg|\.eh|\.er|\.es|\.et|\.eu|\.fi|\.fj|\.fk|\.fm|\.fo|\.fr|\.ga|\.gb|\.gd|\.ge|\.gf|\.gg|\.gh|\.gi|\.gl|\.gm|\.gn|\.gp|\.gq|\.gr|\.gs|\.gt|\.gu|\.gw|\.gy|\.hk|\.hm|\.hn|\.hr|\.ht|\.hu|\.id|\.ie|\.il|\.im|\.in|\.io|\.iq|\.ir|\.is|\.it|\.je|\.jm|\.jo|\.jp|\.ke|\.kg|\.kh|\.ki|\.km|\.kn|\.kp|\.kr|\.kw|\.ky|\.kz|\.la|\.lb|\.lc|\.li|\.lk|\.lr|\.ls|\.lt|\.lu|\.lv|\.ly|\.ma|\.mc|\.md|\.mg|\.mh|\.mk|\.ml|\.mm|\.mn|\.mo|\.mp|\.mq|\.mr|\.ms|\.mt|\.mu|\.mv|\.mw|\.mx|\.my|\.mz|\.na|\.nc|\.ne|\.nf|\.ng|\.ni|\.nl|\.no|\.np|\.nr|\.nu|\.nz|\.om|\.pa|\.pe|\.pf|\.pg|\.ph|\.pk|\.pl|\.pm|\.pn|\.pr|\.ps|\.pt|\.pw|\.py|\.qa|\.re|\.ro|\.ru|\.rw|\.sa|\.sb|\.sc|\.sd|\.se|\.sg|\.sh|\.si|\.sj|\.sk|\.sl|\.sm|\.sn|\.so|\.sr|\.st|\.sv|\.sy|\.sz|\.su|\.tc|\.td|\.tf|\.tg|\.th|\.tj|\.tk|\.tl|\.tm|\.tn|\.to|\.tp|\.tr|\.tt|\.tv|\.tw|\.tz|\.ua|\.ug|\.uk|\.um|\.us|\.uy|\.uz|\.va|\.vc|\.ve|\.vg|\.vi|\.vn|\.vu|\.wf|\.ws|\.ye|\.yt|\.yu|\.za|\.zm|\.zw|\.aero|\.biz|\.cat|\.com|\.coop|\.info|\.jobs|\.mobi|\.museum|\.name|\.net|\.org|\.pro|\.travel|\.gov|\.edu|\.mil|\.int)+\/?(?:\S*)$|i/;
	    url = url.replace('http://', ''); */

    //var zones = 'ru|ad|ae|af|ag|ai|al|am|an|ao|aq|ar|as|at|au|aw|az|ax|ba|bb|bd|be|bf|bg|bh|bi|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gg|gh|gi|gl|gm|gn|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|im|in|io|iq|ir|is|it|je|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|mv|mw|mx|my|mz|na|nc|ne|nf|ng|ni|nl|no|np|nr|nu|nz|om|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|sv|sy|sz|su|tc|td|tf|tg|th|tj|tk|tl|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw|aero|biz|cat|com|coop|info|jobs|mobi|museum|name|net|org|pro|travel|gov|edu|mil|int';
    //myRe = new RegExp ("(?:<a [^>]*href=[\\']+)?(?:(?:http|ftp|https):\\/\\/)?(?:www\\.?)?([\\w\\-\\.]+(?:(?:"+zones+")+))+(?:[\\w\\-\\.,@?^=%&amp;:/~\\+#]*[\\w\\-\\@?^=%&amp;\\/~\\+#])?(?:[\'\"]+[^>]*>(.+?)</a>)?",						"g");

	// doubled 'http://' check
	var mtch = url.split('http://');
	if (mtch.length > 2) {
		return false;
	}
		
	
    var ZZZ = new RegExp("(?:(?:https?|ftp|telnet)://(?:[a-z0-9_-]{1,32}(?::[a-z0-9_-]{1,32})?@)?)?(?:(?:[a-z0-9-]{1,128}\\.)+(?:ru|ad|ae|af|ag|ai|al|am|an|ao|aq|ar|as|at|au|aw|az|ax|ba|bb|bd|be|bf|bg|bh|bi|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gg|gh|gi|gl|gm|gn|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|im|in|io|iq|ir|is|it|je|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|mv|mw|mx|my|mz|na|nc|ne|nf|ng|ni|nl|no|np|nr|nu|nz|om|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|sv|sy|sz|su|tc|td|tf|tg|th|tj|tk|tl|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw|aero|biz|cat|com|coop|info|jobs|mobi|museum|name|net|org|pro|travel|gov|edu|mil|int)|(?!0)(?:(?!0[^.]|255)[0-9]{1,3}\\.){3}(?!0|255)[0-9]{1,3})(?:/[a-z0-9.,_@%&?+=\\~/-]*)?(?:#[^ '\\\"&<>]*)?", "g");

	var myArr = ZZZ.exec(url);
    
    if (null == myArr || myArr.length == 0)
        return false;
	    
    if (!substr_count(myArr[0],'http://') || (1 < substr_count(myArr[0],'http://')))
    {
        url2 = myArr[0];
        url2 = url2.replace('http://', '');
        url3 = 'http://'+url2;
    }
    else if(1 >= substr_count(myArr[0],'http://'))
    {
        url3 = myArr[0];
    }
		
    //if (!in_arrayi(myArr[2], zones))
    //   return false;
	    
    return true;
}

/**
 * Remmove the object tags & change width
 * @param code
 * @return
 */
function verify_embed_code( code, width, height )
{
    return code;
    /*
    var reg = /http:\/\/www\.youtube\.com\/v\/([0-9A-Za-z_\-]+)/;
    var reg2 = /http:\/\/www\.youtube\.com\/embed\/([0-9A-Za-z_\-]+)/;

    if (!reg.test(code) && !reg2.test(code))
        return false;

    if (!width) width = 350;
    if (!height) height = 250;
    var re1 = /(\<object[^\>]*\>)/;
    var re2 = /(\<\/object\>)/;
    var re3 = /(width="(.*height="(.*?\")))/;
    var re4 = /(<embed)/;
	
    var r = code.replace(re1, '<param name="wmode" value="opaque" />');
    r = r.replace(re2, '');
    r = r.replace(re3, 'max-width="'+width+'" max-height="'+height+'"');
    r = r.replace(re4, '<embed wmode="opaque"');
	
    if (null != r && 'undefined' != r)
        return r;
    else
        return false;
    */
}




function isdefined(variable)
{
    return (typeof(window[variable]) == "undefined")?  false: true;
}
function substr_count(string,substring,start,length)
{
    var c = 0;
    if(start) {
        string = string.substr(start);
    }
    if(length) {
        string = string.substr(0,length);
    }
    for (var i=0;i<string.length;i++)
    {
        if(substring == string.substr(i,substring.length))
            c++;
    }
    return c;
}

function getcookie(name)
{
    var cookie = ' ' + document.cookie;
    var search = ' ' + name + '=';
    var setStr = null;
    var offset = 0;
    var end    = 0;
    if (0 < cookie.length)
    {
        offset = cookie.indexOf(search);
        if (-1 != offset)
        {
            offset += search.length;
            end = cookie.indexOf(';', offset)

            if (-1 == end)
                end = cookie.length;

            setStr = unescape(cookie.substring(offset, end));
        }
    }

    return(setStr);
}

function setcookie(name, value, expires, path, domain, secure)
{
    if (null == path)
        path = '/';
    if (null == expires)
        expires = "Wednesday, 18-Sep-30 23:12:40 GMT";
    document.cookie = name + '=' + escape(value) +
    ((expires) ? '; expires=' + expires : '') +
    ((path) ? '; path=' + path : '') +
    ((domain) ? '; domain=' + domain : '') +
    ((secure) ? '; secure' : '');
}

function addzeros(num, ncnt)
{
    var snum = ''+num;
    if (!ncnt) var ncnt = 2;
    var ccnt = ncnt - snum.length;
    var i;
    for (i = 0; i < ccnt; i++)
    {
        snum = '0'+snum;
    }
    return snum;
}

function getCDateHash() 
{
    var cdate = new Date();
    var cD = addzeros(1.0*cdate.getUTCDate());
    var cM = addzeros(1.0*cdate.getUTCMonth() + 1.00);
    var cY = cdate.getUTCFullYear();
    var cHour = addzeros(1.0*cdate.getHours());
    var cMin = addzeros(1.0*cdate.getMinutes());
	
    var strDate = ''+cD+cM+cY+cHour+cMin;
    return strDate;
}

/**
 * Translate symbol to charset
 * @param symb - symbol
 * @return
 */
function Symb2Charset( symb )
{
	var arAlpha = {'а':'a', 'б':'b', 'в':'v', 'г':'g', 'д':'d', 'е':'e', 'ё':'jo', 'ж':'zh', 'з':'z', 'и':'i', 'й':'j', 'к':'k', 'л':'l', 'м':'m', 'н':'n', 'о':'o',
					'п':'p', 'р':'r', 'с':'s', 'т':'t', 'у':'u', 'ф':'f', 'х':'h', 'ц':'c', 'ч':'ch', 'ш':'sh', 'щ':'w', 'ъ':'#', 'ы':'y', 'ь':'\'', 'э':'je', 'ю':'ju',
					'я':'ja', 'Б':'B', 'В':'V', 'Г':'G', 'Д':'D', 'Е':'E', 'Ё':'Jo', 'Ж':'Zh', 'З':'Z', 'И':'I', 'Й':'J', 'К':'K', 'Л':'L', 'М':'M', 'Н':'N', 'О':'O',
					'П':'P', 'Р':'R', 'С':'S', 'Т':'T', 'У':'U', 'Ф':'F', 'Х':'H', 'Ц':'C', 'Ч':'Ch', 'Ш':'Sh', 'Щ':'W', 'Ъ':'##', 'Ы':'Y', 'Ь':'\'\'', 'Э':'Je', 'Ю':'Ju', 'Я':'Ja'};

	return arAlpha[symb] ? arAlpha[symb] : symb;
}

function Txt2Charse( txt ) {
	var arAlpha = {'а':'a', 'б':'b', 'в':'v', 'г':'g', 'д':'d', 'е':'e', 'ё':'jo', 'ж':'zh', 'з':'z', 'и':'i', 'й':'j', 'к':'k', 'л':'l', 'м':'m', 'н':'n', 'о':'o',
					'п':'p', 'р':'r', 'с':'s', 'т':'t', 'у':'u', 'ф':'f', 'х':'h', 'ц':'c', 'ч':'ch', 'ш':'sh', 'щ':'w', 'ъ':'#', 'ы':'y', 'ь':'\'', 'э':'je', 'ю':'ju',
					'я':'ja', 'Б':'B', 'В':'V', 'Г':'G', 'Д':'D', 'Е':'E', 'Ё':'Jo', 'Ж':'Zh', 'З':'Z', 'И':'I', 'Й':'J', 'К':'K', 'Л':'L', 'М':'M', 'Н':'N', 'О':'O',
					'П':'P', 'Р':'R', 'С':'S', 'Т':'T', 'У':'U', 'Ф':'F', 'Х':'H', 'Ц':'C', 'Ч':'Ch', 'Ш':'Sh', 'Щ':'W', 'Ъ':'##', 'Ы':'Y', 'Ь':'\'\'', 'Э':'Je', 'Ю':'Ju', 'Я':'Ja'
				  };

	var ereg = '';
	var txtvar = txt;
	for (var k in arAlpha)
	{
		eval('ereg = /'+ k +'/g;');
		txtvar = txtvar.replace(ereg, arAlpha[k]);
	}
	return txtvar.toLowerCase();
}

function is_string( mixed_var ){
    alert(mixed_var);
    return (typeof( mixed_var ) == 'string');  
}

/**
 * Make a pause
 * @param t - time in miliseconds
 * @return
 */
function jsPause( t )
{
    var date = new Date();
    var curDate = null;
    do
    {
        curDate = new Date();
    }
    while(curDate-date < t);
}

function checkTime(str) {
    if ((/^(\d\d):(\d\d) (am||pm)$/).test(str))
    {
        var ar = (/^(\d\d):(\d\d) (am||pm)$/).exec(str)
        if(parseInt(ar[1]) <= 12 && parseInt(ar[2]) < 60) {
            return 1;
        }
    }
    return 0;
}


function ClearUpFld(obj) {
    $(obj).css('color', '#000');
    $(obj).val('');
}

function SetLeftBold(obj) {
    $('.cl_srch_browse_links').css('font-weight', 'normal');
    $(obj).css('font-weight', 'bold');
}


function nl2br (str) {
    var breakTag = '<br />';
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
}