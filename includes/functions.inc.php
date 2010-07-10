<?
#===========================================================================
#= Script : Mobile Detection and Redirection
#= File   : includes/functions.inc.php
#= Version: 0.2
#= Author : Mike Lynn
#= Email  : merlynn@gmail.com
#= Website: http://www.mlynn.org/uatest/
#===========================================================================
#= Copyright (c) 2003 Mike Lynn
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

function setcookiealive($name,$value,$expires) {
	$_COOKIE[$name] = $value;
	setcookie($name,$value,$expires);
}

function logit($text) {
    $now=date('Y-m-d h:m:s');
    $debug_data=debug_backtrace();
    $function_name=$debug_data[1]['function'];
	$out="----------------------------------------------------------------------------------------\n";
    $out.=$now.' '.$_SERVER['HTTP_USER_AGENT']."\n";
    $out.=$now.' '.$_SERVER['SERVER_NAME'].' '.$_SERVER['PHP_SELF'].' '.$function_name.' '.$text."\n";
	$out.="----------------------------------------------------------------------------------------\n";
    file_put_contents($LOGFILE,$out,FILE_APPEND);
}

function ismobile() {
	$is_mobile = '0';

	if(preg_match('/(android|up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
		$is_mobile=1;
	}

	if((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml')>0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
		$is_mobile=1;
	}

	$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'],0,4));
	$mobile_agents = array('w3c ','acs-','alav','alca','amoi','andr','audi','avan','benq','bird','blac','blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno','ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-','maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-','newt','noki','oper','palm','pana','pant','phil','play','port','prox','qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar','sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-','tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp','wapr','webc','winw','winw','xda','xda-');

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
}

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

?>
