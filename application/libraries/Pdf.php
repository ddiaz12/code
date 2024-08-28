<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once FCPATH . 'vendor/autoload.php';

class Pdf extends \Mpdf\Mpdf
{
    public function __construct($config = [])
    {
        parent::__construct($config);
    }
}
