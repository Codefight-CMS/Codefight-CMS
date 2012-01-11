<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Package: Codefight CMS
 * Module: modulecreator
 * Author: Damodar Bashyal
 * Date: 5/10/2011
 */
$cnf['modulecreator']['global'] = array(
			'status' => 1,
			'sort' => 100,
			'title' => 'Module',
			'parent' => 'tools',
			'void' => 1,
		);
$cnf['+tools']['+modulecreator']['admin'] = array(
			'child' => array(
					'modulecreator/create' => array(
                        'status' => 1,
						'title' => 'Create'
						),
					'moduleinstaller' => array(
                        'status' => 1,
						'title' => 'Install'
						),
				)
		);
$cnf['modulecreator']['frontend'] = array();/*to be included in future releases*/