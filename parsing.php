
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
 	//$html= parse_url($url);
 	
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
   	$my_xpath_query2 = "//div[2]/p/a/@href";
	$res3 = $xpath->query($my_xpath_query2);
	
	//scrape text links
   	$my_xpath_query2 = "//div[2]/p/a";
	$res4 = $xpath->query($my_xpath_query2);
	
	

	foreach($res1 as $span1)
	   {
			$string[] = $span1->nodeValue;
			//$string = text_do_better($string);
		}
	foreach($res2 as $span2)
	   {
			$date[] = $span2->nodeValue;
		} 
		
	foreach($res3 as $span3)
	   {
			$links[] = $span3->nodeValue;
		}    
		//$links = link_do_better($links);
		
	
		//divido in items
		//$string_arr = explode("Numero: ", $string);
		//unset($string_arr[0]);
		//rimuovo i tags
		//$string_arr=str_replace("Tipo:", ";",$string_arr);
		//$string_arr=str_replace("Data pubblicazione:", ";",$string_arr);
		//$string_arr=str_replace("Data scadenza:", ";",$string_arr);	
		//$string_arr=str_replace("Area di Riferimento:", ";",$string_arr);
		//$string_arr=str_replace("Oggetto:", ";",$string_arr);
		//$string_arr=str_replace("Numero:", ";",$string_arr);
		//$string_arr=str_replace("Documento", "",$string_arr);		
		//$string_arr = str_replace("\xc2\xa0", "", $string_arr);

	//for($i = 1; $i <=count($string_arr); $i++)
	//	{
	//		$data[$i-1]=explode(";", $string_arr[$i]);
	//	}

		//DATA
		print_r($string);

		//DATE
		print_r($date);
		
		//LINKS
		print_r($links);
	
		//print_r(array($data, $links));
		//return array($data, $links);

}





