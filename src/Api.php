<?php

namespace MVFGlobal;

use MVFGlobal\Github;

class Api
{
    protected $version = 'v1';

    public function __construct()
    {
        // Regisiter /github/<username> API route
        add_action('rest_api_init', [$this, 'registerRoutes']);
    }

    public function registerRoutes()
    {
        register_rest_route($this->version, '/github/(?P<username>[a-zA-Z0-9-]+)', [
            'methods' => \WP_REST_Server::READABLE,
            'callback' => [$this, 'data'],
            'permission_callback' => '__return_true'
        ]);
    }

    public function data($request)
    {
        // Get username parameter and transform to a slug
        $username = sanitize_title($request->get_param('username'));

        // Query github for the users details
        $github = new Github();
        $user = $github->queryUser($username)->data();
        $language = $github->queryUserRepos($username)->mostPopularLanguage();

        // Check status returned from API is succesful
        if ($user['status'] === 200 && !isset($language['status'])) {
            $user['data']['language'] = $language;
            return $user;
        }

        return $user;
    }
}
