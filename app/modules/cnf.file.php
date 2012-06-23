<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Package: Codefight CMS
 * Module: File Manager
 * Author: Damodar Bashyal
 * Date: 5/10/2011
 */
$cnf['file']['global'] = array(
            'void' => 1,
            'status' => 1,
			'sort' => 80,
			'title' => 'File Manager',
			'parent' => 'media',
		);
$cnf['+media']['+file']['admin'] = array(
			'child' => array(
					'file/manage-file' => array(
                        'status' => 1,
						'title' => 'Manage Files'
						),
					'file/upload-file' => array(
                        'status' => 1,
						'title' => 'Upload File'
						),
					'file/file-status' => array(
                        'is_menu' => 0,
                        'status' => 1,
						'title' => 'Change File Status',
						),
				)
		);
$cnf['file']['frontend'] = array();/*to be included in future releases*/
