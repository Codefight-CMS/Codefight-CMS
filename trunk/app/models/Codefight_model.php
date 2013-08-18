<?php
//If BASEPATH is not defined, simply exit.
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Codefight_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }
}
