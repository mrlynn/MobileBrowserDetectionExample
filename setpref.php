<?
#===========================================================================
#= Script : Mobile Detection and Redirection
#= File   : setpref.php
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
?>
