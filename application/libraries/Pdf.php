<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

class Pdf {

    protected $dompdf;

    public function __construct() {
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $this->dompdf = new Dompdf($options);
    }

    public function loadHtml($html) {
        $this->dompdf->loadHtml($html);
    }

    public function setPaper($size, $orientation) {
        $this->dompdf->setPaper($size, $orientation);
    }

    public function render() {
        $this->dompdf->render();
    }

    public function stream($filename, $options = array()) {
        $this->dompdf->stream($filename, $options);
    }
}
?>
