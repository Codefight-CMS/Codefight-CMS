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
 * @package     cf_Captcha
 * @copyright   Copyright (c) 2010 Codefight CMS Team (http://codefight.org)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Version Controller
 */
class Captcha extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }


    /*
      | if the called function doesn't exists, show the index, good for security
      */
    function _remap($method)
    {
        $method = str_replace('-', '_', $method);

        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            $this->index();
        }
    }

    public function index()
    {
        $captcha = Model('setting')->security_question();

        // Create a 100*30 image
        $im = imagecreate(100, 16);

        // White background and blue text
        $bg = imagecolorallocate($im, 255, 255, 255);
        $bg = imagecolortransparent($im, $bg);
        $textcolor = imagecolorallocate($im, 255, 255, 255);

        // Write the string at the top left
        imagestring($im, 5, 0, 0, $captcha, $textcolor); #here is my string $output

        // Output the image
        header('Content-type: image/png');

        imagepng($im);
        imagedestroy($im);
    }
}

/* End of file page.php */
/* Location: ./system/application/controllers/blog/page.php */
