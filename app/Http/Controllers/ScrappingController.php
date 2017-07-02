<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScrappingController extends Controller
{
    public function index()
    {
	  $crawler = Scrapper::request('GET', 'http://malesbanget.com/');
	  $url = $crawler->filter('div.wrapleft ul.middleContent > li')->each(function($node) {
	  	$title = $node->filter('div.details h3 > a')->extract(array('_text', 'href'));
	  	$img = $node->filter('div.thumbContainer img')->attr('src');
	  	return [
	  		'title' => $title[0][0],
	  		'link' => $title[0][1],
	  		'image' => $img,
	  	];
	  });

	  return response($url);
    }
}
