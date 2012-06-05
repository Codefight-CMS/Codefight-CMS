<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Package: Codefight CMS
 * Module: Folder Manager
 * Author: Damodar Bashyal
 * Date: 5/10/2011
 */
$cnf['folder']['global'] = array(
			'status' => 1,
            'void' => 1,
			'sort' => 90,
			'title' => 'Folder Manager',
			'parent' => 'media',
		);
$cnf['+media']['+folder']['admin'] = array(
			'child' => array(
					'folder/manage-folder' => array(
                        'status' => 1,
						'title' => 'Manage Folders'
						),
					'folder/create-folder' => array(
                        'status' => 1,
						'title' => 'Create Folder'
						),
                    'folder/folder-status' => array(
                        'is_menu' => 0,
                        'status' => 1,
                        'title' => 'Change folder Status',
                    ),
                    'folder/search-file' => array(
                        'is_menu' => 0,
                        'status' => 1,
                        'title' => 'Search Files under folder',
                    ),
            )
);
$cnf['folder']['frontend'] = array();/*to be included in future releases*/
