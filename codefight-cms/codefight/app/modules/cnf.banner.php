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
			'url' => 'banner',
			'parent' => 'top',
		);
$cnf['banner']['admin'] = array(
			'child' => array(
					0 => array(
						'url' => 'manage',
						'title' => 'Manage'
						),
					1 => array(
						'url' => 'create',
						'title' => 'Create New Banner'
						),
				)
		);
$cnf['banner']['frontend'] = array();