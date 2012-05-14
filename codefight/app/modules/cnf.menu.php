<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Package: Codefight CMS
 * Module: Menu
 * Author: Damodar Bashyal
 * Date: 5/10/2011
 */
$cnf['menu']['global'] = array(
			'status' => 1,
			'sort' => 10,
            'title' => 'Menu',
            'void' => 1, /*1 = onclick="return false;"*/
			'parent' => 'top',
		);
$cnf['menu']['admin'] = array(
			'child' => array(
					'menu/page' => array(
                        'status' => 1,
						'title' => 'Page Links'
						),
					'menu/blog' => array(
                        'status' => 1,
						'title' => 'Blog Categories'
						),
                    'menu/blog-roll' => array(
                        'status' => 1,
                        'title' => 'Blog Roll'
                        ),
				)
		);
$cnf['menu']['frontend'] = array();/*to be included in future releases*/

//$cnf['assets']['js'][] = 'jquery.tablesorter';
