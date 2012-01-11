<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Package: Codefight CMS
 * Module: Settings
 * Author: Damodar Bashyal
 * Date: 5/10/2011
 */
$cnf['setting']['global'] = array(
			'status' => 1,
			'sort' => 10000000,
            'title' => 'Settings',
            'void' => 1, /*1 = onclick="return false;"*/
			'parent' => 'top',
		);
$cnf['setting']['admin'] = array(
			'child' => array(
					'setting/site' => array(
                        'status' => 1,
						'title' => 'Defaults'
						),
					'setting/websites' => array(
                        'status' => 1,
						'title' => 'Websites'
						),
                    'setting/keys' => array(
                        'status' => 1,
                        'title' => 'Keys'
                        ),
				)
		);
$cnf['setting']['frontend'] = array();/*to be included in future releases*/