<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Package: Codefight CMS
 * Module: Cache Management tool.
 * Author: Damodar Bashyal
 * Date: 5/10/2011
 */
$cnf['+tools']['cache']['admin'] = array(
			'child' => array(
				'setting/cache' => array(
                        'status' => 1,
                        'title' => 'Clear Cache'
                        ),
				)
		);
		