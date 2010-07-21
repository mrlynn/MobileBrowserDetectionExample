#===========================================================================
#= Script : Mobile Detection and Redirection
#= File   : includes/functions.inc.pl
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

sub setcookiealive() {
	my ($name,$value,$expires,$redirect) = @_;
	$cookie = $query->cookie(-name=>"$name",
			 -value=>"$value",
			 -expires=>'+5d',
			 -path=>'/');
	if ($redirect) {
        print $query->redirect("$redirect","-cookie=>$cookie");
	} else {
		print $query->header(-cookie=>$cookie);
	}
}

sub in_array {
     my ($arr,$search_for) = @_;
     my %items = map {$_ => 1} @$arr; # create a hash out of the array values
     return (exists($items{$search_for}))?1:0;
}

sub ismobile {
	$useragent=lc(@_);
	$is_mobile = '0';

	if($useragent =~ m/(android|up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone)/i) {
		$is_mobile=1;
	}

	if((index($ENV{HTTP_ACCEPT},'application/vnd.wap.xhtml+xml')>0) || ($ENV{HTTP_X_WAP_PROFILE} || $ENV{HTTP_PROFILE})) {
		$is_mobile=1;
	}

	$mobile_ua = lc(substr $ENV{HTTP_USER_AGENT},0,4);
	@mobile_agents = ('w3c ','acs-','alav','alca','amoi','andr','audi','avan','benq','bird','blac','blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno','ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-','maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-','newt','noki','oper','palm','pana','pant','phil','play','port','prox','qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar','sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-','tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp','wapr','webc','winw','winw','xda','xda-');

	if(in_array(\@mobile_agents,$mobile_ua)) {
		$is_mobile=1;
	}

	if ($ENV{ALL_HTTP}) {
		if (index(lc($ENV{ALL_HTTP}),'OperaMini')>0) {
			$is_mobile=1;
		}
	}

	if (index(lc($ENV{HTTP_USER_AGENT}),'windows')>0) {
		$is_mobile=0;
	}
	
    return $is_mobile;
}

sub isiphone {
	$useragent = @_;
	$iphone=0;
	if (lc($useragent) =~ m/iphone/) {
		$iphone=1;
	}
	return $iphone;
}

sub isipad {
	$useragent = @_;
	$ipad=0;
	if (lc($useragent) =~ m/ipad/) {
		$ipad=1;
	}
	return $ipad;
}
1;
