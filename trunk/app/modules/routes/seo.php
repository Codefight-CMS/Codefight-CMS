<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Package: Codefight CMS
 * Module: seo
 * Author: Damodar Bashyal
 * Date: 5/10/2011
 */
// frontend routes
// SEO
$route['seo(/.*)?'] = 'frontend/seo/home/index$1';
$route['seo/keywordanalyzer(/.*)?'] = 'frontend/seo/keywordanalyzer/index$1';
