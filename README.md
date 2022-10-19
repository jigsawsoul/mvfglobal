## MVF Global

I have attached the completed full-stack developer test.

https://wordpress-859557-2969453.cloudwaysapps.com/ 

Due to the nature of this role, being a WordPress Engineering Manager, I decided to go ahead and create a WordPress plugin, building both a web and command line application that utilises the WP CLI.

The plugin can be installed through the WordPress admin panel and viewed by creating a page and selecting the "GitHub Language" template. This plugin can also be run by the command line, using WP CLI by running the following command: wp github <username>.

I have included my GitHub token (read-only) for this demo to exceed the API rate limit. However, within a real-world setting, this would be included within an environment during the build process.

For ease of reviewing, I have uploaded the plugin to a test server here: https://wordpress-859557-2969453.cloudwaysapps.com/ - if you require access to the admin panel, please let me know.

## Installing

This project requires: 

- PHP 8^
- Composer
- NPM 

```shell
composer install

npm install && npx mix dev
```

Please also ensure avaid github token is used within `mvfglobal/src/Github.php`, as the one within this project is invalid. However, you can see a fully functionally demo here: https://wordpress-859557-2969453.cloudwaysapps.com/

Addtionally, to use the command line interface you must have WP CLI installed. https://wp-cli.org/#installing

Please do not hesitate to reach out with any questions,
Richard
