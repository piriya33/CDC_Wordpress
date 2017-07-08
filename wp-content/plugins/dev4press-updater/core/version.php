<?php

if (!defined('ABSPATH')) exit;

class d4pupd_core_info {
    public $code = 'dev4press-updater';

    public $version = '3.7';
    public $build = 2312;
    public $status = 'stable';
    public $updated = '2017.07.01';
    public $url = 'https://plugins.dev4press.com/dev4press-updater/';
    public $author_name = 'Milan Petrovic';
    public $author_url = 'https://www.dev4press.com/';
    public $released = '2010.03.21';

    public $install = false;
    public $update = false;
    public $previous = 0;

    public $key = 1498996800;

    function __construct() { }

    public function to_array() {
        return (array)$this;
    }
}
