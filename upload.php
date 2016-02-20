#!/usr/bin/php

//-------------------------------------------------------------------------------
//  Upload News Comune di Prato Project
//-------------------------------------------------------------------------------
//  Author      Matteo Tempestini
//  Date        11 02 2016
//  License     MIT
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------


<?php
//
// A simple PHP/CURL FTP upload to a remote site
//

$ch = curl_init();
$localfile1 = dirname(__FILE__). "/"."prato_news.xml";

$fp = fopen($localfile1, "r");

// we upload
curl_setopt($ch, CURLOPT_URL,
            "ftp://teos6118:Caputo80#@50.62.50.1/ComunePratoNews/prato_news.xml");
curl_setopt($ch, CURLOPT_UPLOAD, 1);
curl_setopt($ch, CURLOPT_INFILE, $fp);

// set size of the image, which isn't _mandatory_ but helps libcurl to do
// extra error checking on the upload.
curl_setopt($ch, CURLOPT_INFILESIZE, filesize($localfile1));

// check $error here to see if it did fine or not!
$error = curl_exec ($ch);


curl_close ($ch); 

?>