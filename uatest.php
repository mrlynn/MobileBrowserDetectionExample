<?php

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
#===========================================================================
#= Script : Mobile Detection and Redirection
#= File   : uatest.php
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

include_once('includes/functions.inc.php');
$useragent=$_SERVER['HTTP_USER_AGENT'];
$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'],0,4));
print "Mobile UA: $mobile_ua<br>";
if(ismobile($useragent)) {
	$useragent='mobile';
} else {
	$useragent='normal';
}
print "USER AGENT: $useragent<p>";
if ($useragent=='mobile' || $useragent=='iphone') {
	if (!isset($_COOKIE["SITEPREF"])) {
	  print "No preference set and you're a mobile device.";
	} else {
	  if ($_COOKIE['SITEPREF']=='MOBILE') {
		  print "Preference set to mobile and you are a mobile device."; 
	  } else {
		  print "Preference set to normal and you are a mobile device."; 
	  }
	}
} else {
    if (!isset($_COOKIE["SITEPREF"])) {
	  print "No preference set and you are NOT a mobile device.";
    } else {
      if ($_COOKIE['SITEPREF']=='MOBILE') {
		  print "Preference set to mobile and you are NOT a mobile device.";
      } else {
		  print "Preference set to normal and you are NOT a mobile device.";
      }
    }
}
?>
