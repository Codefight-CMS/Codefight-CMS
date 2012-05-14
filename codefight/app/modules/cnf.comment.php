<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Package: Codefight CMS
 * Module: comment
 * Author: Damodar Bashyal
 * Date: 9/10/2011
 */
$cnf['comment']['global'] = array(
			'status' => 1,
			'sort' => 70,
			'title' => 'Comments',
			'parent' => 'top',
		);
$cnf['comment']['admin'] = array(
			'child' => array(
					'comment/pending-comment' => array(
                        'status' => 1,
						'title' => 'Pending Comments'
						),
					'comment/approved-comment' => array(
                        'status' => 1,
						'title' => 'Approved Comments'
						),
				)
		);
$cnf['comment']['frontend'] = array();/*to be included in future releases*/