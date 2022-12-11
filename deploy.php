<?php

namespace Deployer;

require 'recipe/symfony.php';

// Config

set('repository', 'git@github.com:tcheymol/ferme.git');

add('shared_files', [
    '.env',
]);
add('shared_dirs', [
    'var/cache',
    'var/log',
    'var/sessions',
    'vendor/',
    'node_modules/',
    'public/bundles/',
    'public/build/',
    'public/images/',
]);

add('writable_dirs', []);

// Hosts

host('155.133.130.79')
    ->set('remote_user', 'www-data')
    ->set('deploy_path', '~/ferme2');

// Tasks

task('deploy:build_frontend', function () {
    run('cd {{release_path}} && npm run build');
});

task('deploy:install_frontend', function () {
    run('cd {{release_path}} && npm install');
});

task('deploy:vendors:update', function () {
    run('cd {{release_path}} && composer update');
});
// Hooks

before('deploy:vendors', 'deploy:vendors:update');
before('deploy:build_frontend', 'deploy:install_frontend');
before('deploy:cache:clear', 'deploy:build_frontend');
before('deploy:symlink', 'database:migrate');

after('deploy:failed', 'deploy:unlock');
