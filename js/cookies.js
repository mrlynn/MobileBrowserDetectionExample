function Set_Cookie( name, value, expires, path, domain, secure )
{
	var today = new Date();
	today.setTime( today.getTime() );

	if ( expires )
	{
	expires = expires * 1000 * 60 * 60 * 24;
	}
	var expires_date = new Date( today.getTime() + (expires) );

	document.cookie = name + "=" +escape( value ) +
	( ( expires ) ? ";expires=" + expires_date.toGMTString() : "" ) +
	( ( path ) ? ";path=" + path : "" ) +
	( ( domain ) ? ";domain=" + domain : "" ) +
	( ( secure ) ? ";secure" : "" );

	if ( value=='NORMAL') {
		window.location = "http://www.mlynn.org/uatest/normal/";
	} else {
		window.location = "http://www.mlynn.org/uatest/mobile/";
	}
}
