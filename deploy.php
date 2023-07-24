<?php

namespace Deployer;

require 'recipe/symfony.php';
require 'contrib/php-fpm.php'; // See https://deployer.org/docs/7.x/contrib/php-fpm + https://deployer.org/docs/7.x/avoid-php-fpm-reloading

set('git_tty', true);
set('php_fpm_version', '8.1');

// Config

set('repository', 'https://github.com/jbelien/stripe-api.git');
set('branch', '2.x');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('stripe.osm.be')
    ->set('remote_user', 'root')
    ->set('deploy_path', '/var/www/stripe-api');

// Hooks

after('deploy:failed', 'deploy:unlock');
after('deploy:success', 'php-fpm:reload');

set('bin/composer', function () {
    return '/usr/bin/php{{php_fpm_version}} /usr/local/bin/composer';
});