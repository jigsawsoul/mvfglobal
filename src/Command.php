<?php

namespace MVFGlobal;

class Command
{
    public function __construct()
    {
        \WP_CLI::add_command('github', [$this, 'mostPopularLanguage']);
    }

    public function mostPopularLanguage($args, $assoc_args)
    {
        $username = sanitize_title($args[0]) ?? false;

        if (!$username) {
            return \WP_CLI::error('Please enter a username e.g. wp github apple');
        }

        $github = new Github();
        $language = $github->queryUserRepos($username)->mostPopularLanguage();

        if (!isset($language['status'])) {
            return \WP_CLI::success($language);
        }

        return \WP_CLI::error('Unfortunately there was a error, please try again.');
    }
}
