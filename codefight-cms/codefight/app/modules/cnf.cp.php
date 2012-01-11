<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Package: Codefight CMS
 * Module: Admin Control Panel Home
 * Author: Damodar Bashyal
 * Date: 5/10/2011
 * @todo:: define language file, models, libraries, helpers, controller, routes.
 */
$cnf['cp']['global'] = array(
			'void' => 1,
			'status' => 1,
			'sort' => 0,
			'title' => 'Admin',
			'parent' => 'top',
		);
$cnf['cp']['admin'] = array(
			'child' => array(
					'cp/cp' => array(
                        'status' => 1,
						'title' => 'Home'
						),
					'cp/update' => array(
                        'status' => 1,
						'title' => 'Codefight Updates'
						),
				)
		);
$cnf['cp']['frontend'] = array();/*to be included in future releases*/