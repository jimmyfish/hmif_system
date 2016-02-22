<?php

require __DIR__ . '/../vendor/autoload.php';

$config = \Symfony\Component\Yaml\Yaml::parse(file_get_contents(__DIR__ . '/../app/config.yml'));

$app = new \Silex\Application($config);
$app['asset_path'] = 'assets';

$app->register(new \Silex\Provider\DoctrineServiceProvider());

/**
 * Register Twig
 */
$app->register(new \Silex\Provider\TwigServiceProvider(),
    [
        'twig.path' => __DIR__ . '/../src/Templates',
        'twig.options' => [
            'cache' => __DIR__ . '/../app/cache/app_template',
            'auto_reload' => true
        ]
    ]
);

$app->register(new \Silex\Provider\FormServiceProvider());
$app->register(new \Silex\Provider\SessionServiceProvider());
$app->register(new \Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new \Silex\Provider\ServiceControllerServiceProvider());
$app->register(new \Silex\Provider\HttpFragmentServiceProvider());
$app->register(new \Silex\Provider\ValidatorServiceProvider());
$app->register(
    new \Silex\Provider\MonologServiceProvider(),
    ['monolog.logfile' => __DIR__ . '/../app/logs/development.log']
);
$app->register(new \Silex\Provider\TranslationServiceProvider());

// $app->mount('/', new hmif_official\Controllers\FrontController($app));
// $app->mount('/admin', new hmif_official\Controllers\BackController($app));
$app->mount('/', new hmif_official\Controllers\BaseController($app));


if ($app['debug']) {
    Symfony\Component\Debug\Debug::enable(E_ALL, true);
    $app->register(new Silex\Provider\WebProfilerServiceProvider(), [
        'profiler.cache_dir' => __DIR__ . '/../app/cache/profiler'
    ]);
}

$app->run();