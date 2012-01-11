<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Package: Codefight CMS
 * Module: Classifieds Menu
 * Author: Damodar Bashyal
 * Date: 9/10/2011
 */
$cnf['+menu']['classifieds']['admin'] = array(
			'child' => array(
					'menu/classifieds' => array(
                        'status' => 1,
						'title' => 'Classified Categories'
						),
				)
		);