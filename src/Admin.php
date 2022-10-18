<?php

namespace MVFGlobal;

use MVFGlobal\Blade;

class Admin
{
    public function __construct()
    {
        add_filter('theme_page_templates', [$this, 'pageTemplates']);
        add_filter('template_include', [$this, 'loadTemplate']);
    }

    public function pageTemplates($templates): array
    {
        $templates['github'] = 'Github Language';
        return $templates;
    }

    public function loadTemplate()
    {
        // Current page template
        $template = get_page_template_slug();

        // Check if blade template should be loaded.
        if ($template === 'github') {

            // Load blade template
            return new Blade($template, [
                get_post()
            ]);
        }

        return $template;
    }
}
