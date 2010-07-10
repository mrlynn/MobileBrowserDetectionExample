<?php
header("Location: Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Location: Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
#===========================================================================
#= Script : Mobile Detection and Redirection
#= File   : index.php
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
include_once('includes/config.inc.php');
include_once('includes/functions.inc.php');
$useragent=$_SERVER['HTTP_USER_AGENT'];
if (ismobile($useragent)) {
	if (!isset($_COOKIE["SITEPREF"])) {
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
	  if ($_COOKIE['SITEPREF']=='MOBILE') {
		  header("Location: $MOBILEURL");
	  } else {
		  if ($_COOKIE['SITEPREF']=='IPHONE') {
			  header("Location: $IPHONEURL");
		  } else {
			  if ($_COOKIE['SITEPREF']=='IPAD') {
				  header("Location: $IPADURL");
			  } else {
				  header("Location: $NORMALURL");
			  }
		  }
	  }
	}
} else {
    if (!isset($_COOKIE["SITEPREF"])) {
	  header("Location: $NORMALURL");
    } else {
      if ($_COOKIE['SITEPREF']=='MOBILE') {
          header("Location: $MOBILEURL");
      } else {
          if ($_COOKIE['SITEPREF']=='IPAD') {
              header("Location: $IPADURL");
          } else {
              if ($_COOKIE['SITEPREF']=='IPHONE') {
                  header("Location: $IPHONEURL");
              } else {
                  header("Location: $NORMALURL");
              }
          }  
      }

    }
}
?>
