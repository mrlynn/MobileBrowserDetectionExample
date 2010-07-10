#===========================================================================
#= Script : Mobile Detection and Redirection
#= File   : readme.txt
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
Target Audience
Web Content Publishers, Web Server Administrators and anyone considering preparing and publishing content that may be consumed by users with mobile devices.
Overview
The mobile phone and computing market is exploding. With more and more phones and hand held devices gaining web browsing capability, it only makes sense to ensure that your site is at least viewable by these mobile browsers. In this article, I present one possible solution for detecting and redirecting incoming mobile browsers so you can customize and enhance the mobile users’ experience.
In this article, I’ll discuss an example web site where we want to present customized web content to four distinct types of user based on the browser device their using when they visit the site. I’ll also discuss how to enable the users to specify a preference for one of the other versions of the site. For example, if I’m an iphone user but I really want to see the full site.
Examples and Source Code
I know – you’re in a hurry… you’ve read the intro and you know this is what you’re after… well, here you go… The examples for this site are available for demonstration at http://mlynn.org/uatest/ and the code for this is available for download from: http://mlynn.org/uatest/ua_mobile_redirection.tgz
Before diving in to my solution, let’s cover some of the background and key factors. If you’re a seasoned web publisher and you already understand the basics of the web and how it works, you’ll probably want to skip down a bit.
There are several components involved in any web user interaction.
Web Browsing Device (Device)
This can be any device running some form of browser.  Desktop computers are the most popular devices browsing the web today but mobile devices are swiftly increasing in numbers.  According to statcounter.com, mobile browsers have experienced a 3 percent increase since 2008 and with the advent of hybrid devices such as the ipad and netbook, you can bet this number will continue to grow.
Web Browsing Program (Browser)
This refers to the program being run by the device for the purpose of browsing web content.  Popular browsers include Firefox, Google Chrome, Microsoft Internet Explorer and Opera.  Each browser communicates with web servers in a similar manner.  When the web browser contacts a web server, it sends several pieces of data identifying its program, version and even the device being used for this browsing session.
Web Server (Server)
The web server is responsible for presenting web content to the browsers.  Apache HTTPD and Microsoft Internet Information Server (IIS) are the two most popular web servers.
Web Content
This is the stuff you’re sending to the browser… the stuff you’re reading right now.  Depending on the type of site and your intended audience, you’re likely to have several types of content being delivered to your browsers.
The Conversation
When you type an address into your browser, or click on a link to a web site, the browser initiates a conversation with the target web server.  Much of this conversation is handled by the browser and hidden from you, the viewer.  The following is an example of a conversation initiated by a browser.
GET /uatest/index.php HTTP/1.1
Host: www.mlynn.org
User-Agent: Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1)
In this example, a user is requesting the following url: http://www.mlynn.org/uatest/index.php from an instance of Firefox browser running on a windows device.
Here’s a list of other possible values sent along with a request for web content.
Header	Value
Host	www.mlynn.org
Connection	keep-alive
User-Agent	Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_3; en-US) AppleWebKit/533.4 (KHTML, like Gecko) Chrome/5.0.375.86 Safari/533.4
Referer	mlynn.org
Accept	application/xml,application/xhtml+xml,text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5
Accept-Encoding	gzip,deflate,sdch
Accept-Language	en-US,en;q=0.8
Accept-Charset	ISO-8859-1,utf-8;q=0.7,*;q=0.3
Cookie	__utma=2051572.1472781444.1277919157.1277919157.1277919157.1; __utmc=2051572; __utmb=2051572.1.10.1277919157
Here’s a look at what your actual request headers look like when you’re browser requested this page:

And this is the response sent back to your browser from the instance of apache httpd running on my server:

Apache’s httpd server exposes the values of some of these request and response headers.  If you’re using the Pre-Hypertext Programming language – or PHP as it’s better known, you can access these values using built-in functions.  See PHP: apache_request_headers and PHP: apache_response_headers for more information.
Identifying Mobile Devices
Now that we have a good understanding of the conversation between the browser and the server, let’s focus on identifying mobile devices and redirection.  As I briefly explained earlier, the web browser identifies the browser program and version along with any requests for content from your web server.  The browser identifies these items using the string “User-Agent.”  The trick to identifying mobile devices is all about knowing what is sent in the User-Agent request field by each and every mobile device.  The following is an example sent by a mobile device.
User-Agent: Mozilla/5.0 (iPhone; U; CPU iPhone OS 3_0 like Mac OS X; en-us) AppleWebKit/528.18 (KHTML, like Gecko) Version/4.0 Mobile/7A341 Safari/528.16
Redirecting Based on User Agent
So now we understand that the browser identifies itself, and if we’re using Apache httpd, we can access the value of that identifier. Let’s take a look a simple redirection example written in PHP.
if (preg_match('/iphone|ipad/',strtolower($_SERVER['HTTP_USER_AGENT']))) {
    header("Location: http://mobile.mlynn.org");
} else {
    header("Location: http://www.mlynn.org");
}
This example interrogates the user agent variable using a php regular expression function and redirects accordingly. This redirection is facilitated using the PHP header() function.
There are several other mechanisms to accomplish similar redirection. For example, you could implement this redirection using a .htaccess file which would be parsed by Apache. This mechanism is discussed in detail on this blog entry. For now however, let’s stick to our PHP implementation.
If all you’re concerned about is redirecting users to another version of the site, this will probably work for you. You’ll simply need to understand and test for the right user-agent values.
However, let’s assume that we want to get a bit trickier. Let’s say we want to have different content or formatting for four separate versions of our site – one for each variant of browsing device that we want to support. One for normal desktop computer browsers, another for iPhone browsers, another for iPad users and one more for all other mobile browsing devices. The reasons for this are many and varied. You may want simply to vary the advertising code you expose to each user based on the type of device or browser they’re using.
To make this type of implementation work, I’ve created a configuration file to initialize some variables for our site. For each distinct version of the site, I’ll create a variable with the appropriate url. I’ll use these later when we write the code for our redirection script.
config.inc.php
view plaincopy to clipboardprint?
$SITEURL='http://mlynn.org/uatest/';  
$LOGFILE='debug.log';  
$MOBILEURL='http://mlynn.org/uatest/mobile/';   // Generic Mobile Device URL  
$IPHONEURL='http://mlynn.org/uatest/iphone/';   // iPhone URL  
$IPADURL='http://mlynn.org/uatest/ipad/';           // iPad URL  
$NORMALURL='http://mlynn.org/uatest/normal/'; // Normal - Full site URL  
Now let’s take a look at what our main index page or landing site will look like. This will be the initial page visited by users before being automatically redirected based on their browser device type.
view plaincopy to clipboardprint?
$useragent=$_SERVER['HTTP_USER_AGENT'];  
if (ismobile($useragent)) {  
    if (isipad($_SERVER['HTTP_USER_AGENT'])) {  
        header("Location: $IPADURL");  
    } else {  
        if (isiphone($_SERVER['HTTP_USER_AGENT'])) {  
            header("Location: $IPHONEURL");  
        } else {  
            header("Location: $MOBILEURL");  
        }  
    }  
} else {  
    header("Location: $NORMALURL");  
}  
This code snippet relies on several important custom functions: ismobile(), isiphone(), and isipad().
The first function examines the user agent value and returns a ’0′ if the device is not recognized as a mobile device and a ’1′ if it is mobile.
view plaincopy to clipboardprint?
function ismobile() {  
   $is_mobile = '0';   
  
   if(preg_match('/(android|up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {  
       $is_mobile=1;  
   }  
  
   if((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml')>0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {  
       $is_mobile=1;  
   }  
  
   $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'],0,4));    $mobile_agents = array('w3c ','acs-','alav','alca','amoi','andr','audi','avan','benq','bird','blac','blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno','ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-','maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-','newt','noki','oper','palm','pana','pant','phil','play','port','prox','qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar','sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-','tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp','wapr','webc','winw','winw','xda','xda-');  
  
   if(in_array($mobile_ua,$mobile_agents)) {  
       $is_mobile=1;  
   }  
  
   if (isset($_SERVER['ALL_HTTP'])) {  
       if (strpos(strtolower($_SERVER['ALL_HTTP']),'OperaMini')>0) {  
           $is_mobile=1;  
       }  
   }  
  
   if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'windows')>0) {  
       $is_mobile=0;  
   }  
  
   return $is_mobile;  
The following functions are used to detect specific device types.
view plaincopy to clipboardprint?
function isiphone($useragent) {  
    $iphone=0;  
    if (preg_match('/iphone/',strtolower($useragent))) {  
        $iphone=1;  
    }  
    return $iphone;  
}  
  
function isipad($useragent) {  
    $ipad=0;  
    if (preg_match('/ipad/',strtolower($useragent))) {  
        $ipad=1;  
    }  
    return $ipad;  
}  
Now when a user visits our site, they will be redirected automatically based on the specific device they are using. This works in most cases, but let’s assume we want to give users the option of visiting a site other than the default for their device? Let’s say I’m on an iPhone – but I want to see what the real, full site looks like with my browser. To implement this, we’ll need some way for the user to specify a preference for a specific version of the site.
One way to accomplish this is using cookies. Cookies are small bits of data stored on your computer and referenced when you visit or revisit a web site.
There are several ways to set and get the value of cookies. Javascript can be used but depends heavily on the implementation of javascript on the device. Additionally, you must be certain that the user has not disabled javascript on their device in order for this to work.
Fortunately, cookies can be maintained using server-side code such as php. For our example, we’ll stick with PHP.
To accomplish setting and maintaining cookies via php for our users’ site preference, I created the following php script called setpref.php.
view plaincopy to clipboardprint?
include_once('includes/config.inc.php');  
include_once('includes/functions.inc.php');  
  
$pref = (isset($_POST['SITEPREF']) ? $_POST['SITEPREF'] : $_GET['SITEPREF']);  
switch ($pref) {  
    case 'MOBILE':  
        setcookiealive('SITEPREF','MOBILE',time()+3600);  
        header("Location: $MOBILEURL");  
        break;  
    case 'IPHONE':  
        setcookiealive('SITEPREF','IPHONE',time()+3600);  
        header("Location: $IPHONEURL");  
        break;  
    case 'IPAD':  
        setcookiealive('SITEPREF','IPAD',time()+3600);  
        header("Location: $IPADURL");  
        break;  
    case 'NORMAL':  
        setcookiealive('SITEPREF','NORMAL',time()+3600);  
        header("Location: $NORMALURL");  
        break;  
    default:  
        setcookiealive('SITEPREF','NORMAL',time()+3600);  
        header("Location: $NORMALURL");  
}  
This function relies on another function called setcookiealive which simply creates the cookie using php’s setcookie() function and also sets the value of the $_COOKIE variable so that the value is available immediately.
view plaincopy to clipboardprint?
function setcookiealive($name,$value,$expires) {  
    $_COOKIE[$name] = $value;  
    setcookie($name,$value,$expires);  
}  
In order for this to work, we need to give the user’s links to the alternate versions of the sites. Let’s look at one of the example site versions.
view plaincopy to clipboardprint?
<h1>iPad Site</h1>  
<div id="content">  
<h2>This is the iPad site.  You got here because you are either using an iPad device or you specified a preference for the iPad site.</h2>  
  
  
</div>  
<div id="footer">  
Visit Other Site Versions:  
<a href="<? echo $NORMALURL;?>">Full Site</a> ||  
<a href="<? echo $MOBILEURL;?>">Generic Mobile Site</a> ||  
<a href="<? echo $IPHONEURL;?>">iPhone Site</a>  
  
  
Set your Preference to other site versions:  
<a href="/uatest/setpref.php?SITEPREF=NORMAL">Full Site</a> ||  
<a href="/uatest/setpref.php?SITEPREF=MOBILE">Generic Mobile Site</a> ||  
<a href="/uatest/setpref.php?SITEPREF=IPHONE">iPhone Site</a>  
  
  
</div>  
I’ve explained the components involved in any standard web user interaction, how they relate specifically to device detection, and I’ve showed one implementation of detection and redirection. If you’d like to implement something similar, feel free to download the code from these examples and use them as a starting base. If you do, drop me an email or log a comment to let me know how you made out. You can also try out this working example.
Example Site Links:
Full Site
Generic Mobile Device Site
iPad Site
iPhone Site

