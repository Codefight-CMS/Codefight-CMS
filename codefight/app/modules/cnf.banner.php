<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Package: Codefight CMS
 * Module: Banner
 * Author: Damodar Bashyal
 * Date: 5/10/2011
 */
$cnf['banner']['global'] = array(
			'status' => 1,
			'sort' => 100,
			'title' => 'Banner',
			//'url' => 'banner',
            'void' => 1, /*1 = onclick="return false;"*/
			'parent' => 'top',
		);
$cnf['banner']['admin'] = array(
			'child' => array(
					'banner/manage' => array(
						'status' => 1,
						'title' => 'Manage'
						),
					'banner/create' => array(
						'status' => 1,
						'title' => 'Create New Banner'
						),
					'banner/status' => array(
						'is_menu' => 0,
						'status' => 1,
						'title' => 'Change Banner Status'
						),
				)
		);
$cnf['banner']['frontend'] = array();