<?php
/**
 * Codefight CMS
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to info@codefight.org so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Codefight CMS to newer
 * versions in the future.
 *
 * @category    Codefight CMS
 * @package     cf_trim
 * @copyright   Copyright (c) 2010 Codefight CMS Team (http://codefight.org)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Page Controller
 */
class Trim extends MY_Controller
{
    var $out;
    var $base;

    /**
     * Constructor method
     *
     * @access public
     * @return void
     */
    public function __construct()
    {
        parent::MY_Controller();
    }

    /**
     * default method index
     *
     * @access public
     * @return void
     */
    public function index()
    {
        if (!preg_match('|^[0-9a-zA-Z]{1,6}$|', $this->uri->segment(2, 0))) {
            die('That is not a valid short url.');
        }
        $this->config->load('trim.php');
        $this->base = $this->config->item('allowed_chars');

        $trim_id = $this->_getShortUrl($this->uri->segment(2, 0));

        if ($this->config->item('cache')) {
            $long_url = file_get_contents($this->config->item('cache_dir') . $trim_id);
            if (empty($long_url) || !preg_match('|^https?://|', $long_url)) {
                $this->db->where('trim_id', $trim_id);
                $this->db->select('long_url');
                $query = $this->db->get('trim');
                $long_url = $query->result_array();
                //print_r($long_url);
                $long_url = $long_url[0]['long_url'];

                @mkdir($this->config->item('cache_dir'), 0777);
                $handle = fopen($this->config->item('cache_dir') . $trim_id, 'w+');
                fwrite($handle, $long_url);
                fclose($handle);
            }
        }
        else
        {
            $this->db->where('trim_id', $trim_id);
            $this->db->select('long_url');
            $query = $this->db->get('trim');
            $long_url = $query->result_array();
            $long_url = $long_url[0]['long_url'];
        }

        if ($this->config->item('track')) {
            $this->db->set('referrals', 'referrals+1', FALSE);
            $this->db->where('trim_id', $trim_id);
            $this->db->update('trim');
        }

        header('HTTP/1.1 301 Moved Permanently');
        header('Location: ' . $long_url);
        exit;

    }

    private function _getShortUrl($string)
    {
        $length = strlen($this->base);
        $size = strlen($string) - 1;
        $string = str_split($string);

        $out = strpos($this->base, array_pop($string));

        foreach ($string as $k => $v)
        {
            $out += strpos($this->base, $v) * pow($length, $size - $k);
        }
        return $out;
    }
}

/* End of file page.php */
/* Location: ./app/controllers/frontend/trim/trim.php */
?>