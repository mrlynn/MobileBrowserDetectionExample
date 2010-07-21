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
#= ( at your option ) any later version.
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
use CGI;

$query = new CGI; 

$useragent = $ENV{HTTP_USER_AGENT};
$sitepref = $query->cookie( 'SITEPREF' );

if ( ismobile( $useragent ) ) {
	if ( !$sitepref ) {
	  if ( isipad( $useragent ) ) {
		  print $query->redirect( "$IPADURL" );
	  } else {
	      if ( isiphone( $useragent ) ) {
			  print $query->redirect( "$IPHONEURL" );
		  } else {
			  print $query->redirect( "$MOBILEURL" );
		  }
	  }
	} else {
	  if ( $sitepref=='MOBILE' ) {
		  print $query->redirect( "$MOBILEURL" );
	  } else {
		  if ( $sitepref=='IPHONE' ) {
			  print $query->redirect( "$IPHONEURL" );
		  } else {
			  if ( $sitepref=='IPAD' ) {
				  print $query->redirect( "$IPADURL" );
			  } else {
				  print $query->redirect( "$NORMALURL" );
			  }
		  }
	  }
	}
} else {
    if ( !$sitepref ) {
	  print $query->redirect( "$NORMALURL" );
    } else {
      if ( $sitepref=='MOBILE' ) {
          print $query->redirect( "$MOBILEURL" );
      } else {
          if ( $sitepref=='IPAD' ) {
              print $query->redirect( "$IPADURL" );
          } else {
              if ( $sitepref=='IPHONE' ) {
                  print $query->redirect( "$IPHONEURL" );
              } else {
                  print $query->redirect( "$NORMALURL" );
              }
          }  
      }

    }
}
