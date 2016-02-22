<?php
/**
 * Created by PhpStorm.
 * User: jimmy
 * Date: 15/02/16
 * Time: 10:16
 */

namespace hmif_official\Controllers;

use Silex\Application;
use Silex\ControllerCollection;
use Symfony\Component\HttpFoundation\Request;
use Silex\ControllerProviderInterface;

class BackController extends BaseController implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->match('/login', [$this, 'loginAction'])->bind("adminHome");
        $controllers->get('/admin',[$this, 'indexAdmin'])->bind("adminIndex");

        return $controllers;
    }

    public function loginAction(Request $request)
    {
        if ($request->getMethod() == "POST") {
            return $this->app->redirect($this->app["url_generator"]->generate("adminHome"));
        }
        return $this->app['twig']->render('admin/login.twig');
    }
    public function indexAdmin()
    {
        /**
        * Redirecting to login
        */
        return $this->app['twig']->render('admin/login.twig');
    }
}