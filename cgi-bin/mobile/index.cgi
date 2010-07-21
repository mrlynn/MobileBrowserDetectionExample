#!/usr/bin/perl
#===========================================================================
#= Script : Mobile Detection and Redirection
#= File   : index.cgi
#= Version: 0.2
#= Author : Mike Lynn
#= Email  : merlynn@gmail.com
#= Website: http://www.mlynn.org/uatest/
#===========================================================================
#= Copyright (c) 2010 Mike Lynn
#= You are free to use and modify this script as long as this header
#= section stays intact
#= This file is part of the Mobile Detection and Redirection Script
#=
#= This program is free software; you can redistribute it and/or modify
#= it under the terms of the GNU General Public License as published by
#= the Free Software Foundation; either version 2 of the License, or
#= (at your option) any later version.
#=
#= This program is distributed in the hope that it will be useful,
#= but WITHOUT ANY WARRANTY; without even the implied warranty of
#= MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#= GNU General Public License for more details.
#=
#= You should have received a copy of the GNU General Public License
#= along with Mobile Detection Script ; if not, write to the Free Software
#= Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
#===========================================================================
require '../includes/config.inc.pl';
use CGI;
$query = new CGI;

$sitepref = $query->cookie( 'SITEPREF' );

print "Content-type: text/html\n\n";

print <<HTML;
<html>
<head>
<title>mlynn.org - Mobile Browser Device Dection Example: Generic Mobile Site</title>
<meta name="description" content="Mobile Browser Device Detection and Redirection Example using CGI">
<meta name="keywords" content="iphone,ipad,mobile,detection,browser,user-agent,example,redirection,php,cgi,perl,sample code, download">
<link REL="STYLESHEET" TYPE="text/css" HREF="css/common.css">
</head>
<body>
<div id=adbanner>
<script type="text/javascript"><!--
google_ad_client = "pub-2267566727021462";
/* 728x90, created 7/1/10 */
google_ad_slot = "6238077836";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-13067313-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</div>
<div id=container>
<h1>Mobile Browser Detection and Redirection Example: Generic Mobile Site</h1>
<h2>This is the Generic Mobile site.  You got here because you are either using a mobile device or you specified a preference for the mobile site.</h2>
<p>
YOUR CURRENT SITE PREFERENCE: $sitepref
<p>
User Agent: $ENV{HTTP_USER_AGENT}
<p>Read the <a href=http://www.mlynn.org/2010/06/mobile-device-detection-and-redirection-with-php/>article entitled Mobile Browser Device Detection and Redirection with PHP</a>.

</div>
<div id='footer'>
Visit Other Site Versions:
<a href="$NORMALURL"/>Normal Site</a> || 
<a href="$IPADURL"/>iPad Site</a>  ||
<a href="$IPHONEURL"/>iPhone Site</a> 
<p>
Set your Preference to other site versions:
<a href="/uatest/cgi-bin/setpref.cgi?SITEPREF=NORMAL"/>Normal Site</a> || 
<a href="/uatest/cgi-bin/setpref.cgi?SITEPREF=IPAD"/>iPad Site</a> ||
<a href="/uatest/cgi-bin/setpref.cgi?SITEPREF=IPHONE"/>iPhone Site</a>
</div>
</html>
HTML


