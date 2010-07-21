#!/usr/bin/perl
#===========================================================================
#= Script : Mobile Detection and Redirection
#= File   : setpref.cgi
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

require 'includes/config.inc.pl';
require 'includes/functions.inc.pl';

use Switch;
use CGI;
$query = new CGI;

switch ($query->param('SITEPREF')) {
	case 'MOBILE' {
		$cookie = $query->cookie(
			-name=>"SITEPREF", 
			-value=>"MOBILE", 
			-expires=>'+5d', 
			-path=>'/');
		print $query->redirect(-location=>"$MOBILEURL",-cookie=>"$cookie");
		}
	case 'IPHONE' {
		$cookie = $query->cookie(-name=>"SITEPREF", -value=>"IPHONE", -expires=>'+5d', -path=>'/');
		print $query->redirect(-location=>"$IPHONEURL",-cookie=>"$cookie");
		}
	case 'IPAD' {
		$cookie = $query->cookie(-name=>"SITEPREF", -value=>"IPAD", -expires=>'+5d', -path=>'/');
		print $query->redirect(-location=>"$IPADURL",-cookie=>"$cookie");
		}
	case 'NORMAL' {
		$cookie = $query->cookie(-name=>"SITEPREF", -value=>"NORMAL", -expires=>'+5d', -path=>'/');
		print $query->redirect(-location=>"$NORMALURL",-cookie=>"$cookie");
		}
	else {	
		$cookie = $query->cookie(-name=>"SITEPREF", -value=>"NORMAL", -expires=>'+5d', -path=>'/');
		setcookiealive("SITEPREF","NORMAL",'+5d');
		print $query->redirect(-location=>"$NORMALURL",-cookie=>"$cookie");
	}
}
1;
