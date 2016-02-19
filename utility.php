#!/usr/bin/php

//-------------------------------------------------------------------------------
//  Utility Albo POP Project
//-------------------------------------------------------------------------------
//  Author      Matteo Tempestini
//  Date        11 02 2016
//  License     MIT
//-------------------------------------------------------------------------------
//  List of utility for Albo POP 
//-------------------------------------------------------------------------------


<?php


function get_string_between($string, $start, $end){
    $string = " ".$string;
    $ini = strpos($string,$start);
    if ($ini == 0) return "";
    $ini += strlen($start);   
    $len = strpos($string,$end,$ini) - $ini;
    return substr($string,$ini,$len);
}

//from dd/mm/YY string to RSS pubDate
function string2dataRSS($datestring)
{
		date_default_timezone_set('Europe/Rome');
		$datestring=str_replace("/", "-",$datestring);
		$datestring_arr = explode("-", $datestring);
		$datestring=$datestring_arr[2]. "-" .$datestring_arr[1]. "-". $datestring_arr[0];
		$datestring=strtotime($datestring);
		//print_r($datestring);
		$pubDate=date('r',$datestring);
		return $pubDate;
}

//curl manager
function curl_manage($url)
{
		$ch = curl_init($url);
		curl_setopt($ch,CURLOPT_VERBOSE,1);
		//curl_setopt($ch,CURLOPT_HTTPPROXYTUNNEL,true);
		curl_setopt($ch,CURLOPT_PROXYTYPE,CURLPROXY_HTTP);
		//curl_setopt($ch,CURLOPT_PROXY,'http://proxy.shr.secureserver.net:3128');
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_TIMEOUT,120);
		$data = curl_exec($ch);
		curl_close($ch);	
		return $data;
}

//migliora blocchi di testo
function text_do_better($string)
{
	$string = preg_replace('/^[ \t]*[\r\n]+/m', '', $string);
	$string = str_replace("\n", "", $string);
	$string = str_replace("\r", "", $string);
	
	// remove non-breaking spaces and other non-standart spaces
	$string = preg_replace('~\s+~u', ' ', $string);
	// replace controls symbols with "?"
	$string = preg_replace('~\p{C}+~u', '?', $string);
	
	return $string;
}

//migliora links togliendo tail PHP SESSION
function link_do_better($link)
{
	$link = preg_replace('#([\w\d]+=[\w\d]{32})#',null,$link);
	print_r($link);
	return $link;
}



