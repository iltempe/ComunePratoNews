
//-------------------------------------------------------------------------------
//  LIBRARY FOR PARSING Albo POP Project
//-------------------------------------------------------------------------------
//  Author      Matteo Tempestini
//  Date        11 02 2016
//  License     MIT
//-------------------------------------------------------------------------------
//  List of parsers for Albo POP 
//-------------------------------------------------------------------------------

<?php

require_once('utility.php');

//estracting text information, date and links and from Prato Website news page.
function parsing($url) {

 	$html= file_get_contents($url);
 	
	$dom = new DOMDocument();
	$dom->loadHTML($html);
	$xpath = new DOMXPath($dom);
 
	//XPath Query
	//scrape text
	$my_xpath_query = "//div[2]/p";
	$res1 = $xpath->query($my_xpath_query);
   	
   	//scrape date
   	$my_xpath_query = "//strong";
   	$res2=$xpath->query($my_xpath_query);
   	
   	//scrape links
   	$my_xpath_query2 = "//div[2]/p/a[1]/@href";
	$res3 = $xpath->query($my_xpath_query2);
	
	//scrape text links
   	$my_xpath_query2 = "//div[2]/p/a";
	$res4 = $xpath->query($my_xpath_query2);
	

	foreach($res1 as $span1)
	   {
			$string[] = $span1->nodeValue;
		}
	foreach($res2 as $span2)
	   {
			$date[] = $span2->nodeValue;
		} 
		
	foreach($res3 as $span3)
	   {
			$links[] = $span3->nodeValue;
		}    
		
		//TEXT
		//print_r($string);

		//DATE
		//print_r($date);
		
		//LINKS
		for($i = 0; $i <count($links); $i++)
		{
			$links[i]=urlencode($links[i]);

			//$links[i]=str_replace("&", "%26", $links[i]);
			//$links[i]=str_replace("=", "%3D", $links[i]);
		}
			
		$res=prepare_data($string,$date,$links);

		print_r($res);
		return $res;

}

//data array preparation
//make an array of text - date - links for feed rss items creation
function prepare_data($string,$date,$links)
{
	//date in / / / format
	$date=str_replace(".", "/",$date);
	
	//text
	$string=text_do_better($string);
	$string=substr_replace($string, " ", 8, 0);
		
	return array($string,$date,$links);
}




