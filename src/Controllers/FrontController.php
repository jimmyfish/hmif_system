<?php
/**
 * Created by PhpStorm.
 * User: jimmy
 * Date: 15/02/16
 * Time: 10:17
 */

namespace hmif_official\Controllers;


use Silex\Application;
use Silex\ControllerCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\ControllerProviderInterface;

class FrontController extends BaseController implements ControllerProviderInterface
{
    /**
     * @param Application $app
     * @return mixed
     */
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->match('/', [$this, 'berandaAction'])->bind("beranda");

        return $controllers;
    }

    public function berandaAction()
    {
        return $this->app['twig']->render('home.twig');
    }
}