<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Package: Codefight CMS
 * Module: User
 * Author: Damodar Bashyal
 * Date: 5/10/2011
 */
$cnf['user']['global'] = array(
			'status' => 1,
			'sort' => 30,
			'title' => 'User',
			'parent' => 'top',
			'void' => 1,
		);
$cnf['user']['admin'] = array(
			'child' => array(
					'user/index' => array(
                        'status' => 1,
						'title' => 'Users'
						),
					'group' => array(
                        'status' => 1,
						'title' => 'Groups'
						),
					'group/permissions' => array(
                        'status' => 1,
						'title' => 'Group Permissions'
						),
				)
		);
$cnf['user']['frontend'] = array();/*to be included in future releases*/		