<?php

class AppFactory
{
    public static $instance;

    public static function create($config)
    {
        // Prepare app
        $app = new \Framework\App($config['frameworkOptions']);
        $app->config = $config;

        // Prepare middleware
        $sessions = new \Controller\Session($app);
        $isAuth = [$sessions, 'check'];
        $isAdminOrSuper = [$sessions, 'checkAdminOrSuper'];
        $isSuper = [$sessions, 'checkSuper'];
        $isAuthOrReferer = [$sessions, 'checkAuthOrReferer'];
        $token = new \Controller\Token($app);
        $hasPermission = [$token, 'check'];

        // Define routes
        $dashboard = new \Controller\Dashboard($app);
        $app->get('/', [$dashboard, 'getIndex']);
        $app->get('/login', function () use ($app) {
            $app->render('login.php', ['title' => gettext('Login')]);
        });
        $app->get('/register', function () use ($app) {
            $app->render('register.php', ['title' => gettext('Register')]);
        });
        $app->get('/user/:id/edit', $isAuth, function ($id) use ($app) {
            $app->render('user.edit.php', ['title' => gettext('Edit user data'), 'userId' => $id]);
        });

        // Define API routes

        $user = new \Controller\User($app);
        $app->post('/api/users', $isAuthOrReferer, [$user, 'create']);
        $app->post('/api/users/:id', $isAuth, [$user, 'update']);

        $app->post('/api/session', [$sessions, 'create']);
        $app->delete('/api/session', $isAuth, [$sessions, 'delete']);

        return self::$instance = $app;
    }
}
