<?php

namespace MVFGlobal;

use eftec\bladeone\BladeOne;

class Blade
{
    public $data = [];
    public $blade = null;

    public function __construct(string $template, array $data)
    {
        $this->data = $data;

        $views = [
            MVF_GLOBAL_PATH . 'src/Resources/views',
        ];

        $cache = WP_CONTENT_DIR . '/cache';

        $this->blade = new BladeOne($views, $cache, BladeOne::MODE_DEBUG);
        $this->blade->addAssetDict('app.js', MVF_GLOBAL_URL . 'dist/js/app.js');
        $this->blade->addAssetDict('app.css', MVF_GLOBAL_URL . 'dist/css/app.css');
        $this->blade->pipeEnable = true;
        $this->blade->includeScope = true;

        echo $this->blade->run($template, $this->data);
        die();
    }
}
