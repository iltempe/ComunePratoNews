#!/usr/bin/php

//-------------------------------------------------------------------------------
// Comune di Prato Project Project main script
//-------------------------------------------------------------------------------
//  Author      Matteo Tempestini
//  Date        19 02 2016
//  License     MIT
//-------------------------------------------------------------------------------
//  Select the right parser and Build RSS Feed
//-------------------------------------------------------------------------------

<?php

require_once('class.rssbuilder.php');
require_once('parsing.php');
require_once('utility.php');


date_default_timezone_set('Europe/Rome');

//NEWS
rss_build('prato');

//FEED BUILDER
//the output of parser must be an array of array that for each item rapresent with an element
//- title
//- description
//- pubDate
//- item link
function rss_build($comune) {

	//build the RSS feed
	$RB = new RSSBuilder();

	$file_rss=dirname(__FILE__). "/". $comune."_news.xml";
	$web_link="http://www.comune.prato.it/news/";

			$parsed=parsing($web_link);
		
			$RB->addChannel(); 
			$RB->addChannelElement('title', 'Feed News del Comune di'.$comune);
			$RB->addChannelElement('link', $web_link);
			$RB->addChannelElement('description', 'feed RSS del Comune di '.$comune);
			$RB->addChannelElement( 'pubDate', 'Fri, 19 Feb 2016 00:00:00 +0100' );
			$RB->addChannelElement('lastBuildDate', 'Fri, 19 Feb 2016 00:00:00 +0100');
			$RB->addChannelElement('generator', 'PHP Framework');

		for($i = 0; $i <count($parsed[0]); $i++)
			{ 
				$RB->addItem();
				$RB->addItemElement('title', $parsed[0][$i]);
				$RB->addItemElement('description', $parsed[0][$i]);
				$RB->addItemElement('link', str_replace("&amp;", "%26",escapeXmlValue($parsed[2][$i])));
				$RB->addItemElement('pubDate', string2dataRSS($parsed[1][$i]));
				//echo $i;
			}

	echo $RB;

	file_put_contents($file_rss, $RB);

}
