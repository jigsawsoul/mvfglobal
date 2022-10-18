<?php

namespace MVFGlobal;

class Bootstrap
{
    public function __construct()
    {
        new Api();
        new Admin();

        if (defined('WP_CLI') && WP_CLI) {
            new Command();
        }
    }
}
