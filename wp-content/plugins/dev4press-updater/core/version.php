<?php

if (!defined('ABSPATH')) exit;

class d4pupd_core_info {
    public $code = 'dev4press-updater';

    public $version = '4.0';
    public $build = 2400;
    public $status = 'stable';
    public $updated = '2018.12.30';
    public $url = 'https://plugins.dev4press.com/dev4press-updater/';
    public $author_name = 'Milan Petrovic';
    public $author_url = 'https://www.dev4press.com/';
    public $released = '2010.03.21';

    public $php = '5.6';
    public $mysql = '5.1';
    public $wordpress = '4.5';

    public $install = false;
    public $update = false;
    public $previous = 0;

    public $key = 1546171200;

    function __construct() { }

    public function to_array() {
        return (array)$this;
    }
}
