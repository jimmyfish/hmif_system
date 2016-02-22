<?php
/**
 * Created by PhpStorm.
 * User: jimmy
 * Date: 15/02/16
 * Time: 10:14
 */

namespace hmif_official\Controllers;


use Silex\Application;
use Silex\ControllerCollection;
use Symfony\Component\HttpFoundation\Request;
use Silex\ControllerProviderInterface;


class BaseController implements ControllerProviderInterface
{

     protected $app;

     public function __construct(Application $app)
     {
         $this->app = $app;
     }

    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->match('/', [$this, 'berandaAction'])->bind("beranda");
        $controllers->match('/admin', [$this, 'adminAction'])->bind("adminBeranda");
        return $controllers;
    }

    public function berandaAction(Request $request)
    {
        return $this->app["twig"]->render("home.twig");
    }

    public function adminAction()
    {
        return $this->app["twig"]->render("admin/login.twig");
    }
}