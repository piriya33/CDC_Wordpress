<?php

if (!defined('ABSPATH')) exit;

class gdbbx_core_info {
    public $code = 'gd-bbpress-toolbox';

    public $version = '4.7.2';
    public $build = 625;
    public $updated = '2017.06.09';
    public $status = 'stable';
    public $edition = 'pro';
    public $url = 'https://plugins.dev4press.com/gd-bbpress-toolbox/';
    public $author_name = 'Milan Petrovic';
    public $author_url = 'https://www.dev4press.com/';
    public $released = '2012.05.27';

    public $install = false;
    public $update = false;
    public $previous = 0;

    function __construct() { }

    public function to_array() {
        return (array)$this;
    }
}
