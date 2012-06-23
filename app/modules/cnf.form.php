<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Package: Codefight CMS
 * Module: Form
 * Author: Damodar Bashyal
 * Date: 5/10/2011
 */
$cnf['form']['global'] = array(
			'status' => 1,
			'sort' => 40,
            'title' => 'Form',
            'void' => 0, /*1 = onclick="return false;"*/
			'parent' => 'top',
		);
$cnf['form']['admin'] = array(
			'child' => array(
					'form/item' => array(
                        'status' => 1,
						'title' => 'Items'
						),
					'form/group' => array(
                        'status' => 1,
						'title' => 'Group'
						),
                    'form/submitted' => array(
                        'status' => 1,
                        'title' => 'Submitted'
                        ),
				)
		);
$cnf['form']['frontend'] = array();/*to be included in future releases*/
