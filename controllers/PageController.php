<?php

require_once __DIR__ . '/../utils/helper_functions.php';
require_once __DIR__ . '/../utils/Auth.php';

function pageController()
{


    // defines array to be returned and extracted for view
    $data = [];

    // get the part of the request after the domain name
    $request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    // switch that will run functions and setup variables dependent on what route was accessed
    switch ($request) {
        
        case '/':
            $mainView = '../views/home.php';
            break;

        case '/login': 
            $mainView = '../views/users/login.php';
            $data['message'] = "";

            if (Auth::check()) {
                    header("Location: /");
                    exit;
            }

            // login logic
            if(!empty($_POST)) {
                if (Auth::attempt(Input::get('email_user'), Input::get('password'))){
                    header("Location: /account");
                } else {
                    $data['message'] = "Either username/email or password were incorrect";
                }
            }
            break;

        case '/logout':
            $mainView = '/';
            Auth::logout();
            break;

        case '/signup':
            $mainView = '../views/users/signup.php';

            // Signup Logic
            $data['errors'] = [];

            if(!empty($_POST)) {
                $user = new User();

                try {
                    $user->name = Input::getString('name');
                } catch (Exception $e) {
                    $data['errors']['name'] = $e->getMessage();
                }
                try {
                    $user->email = Input::getString('email');
                } catch (Exception $e) {
                    $data['errors']['email'] = $e->getMessage();
                }
                try {
                    $user->username = Input::getString('username');
                } catch (Exception $e) {
                    $data['errors']['username'] = $e->getMessage();
                }

                try {
                    $user->password = Input::getString('password');
                } catch (Exception $e) {
                    $data['errors']['password'] = $e->getMessage();
                }
                if(Input::get('password') !== Input::get('passwordConfirm')) {
                    $data['errors']['passwordConfirm'] = "Password does not match.";
                }
                
                if(User::findByUsernameOrEmail($user->username) !== null) {
                    $data['errors']['username'] = "Username is already taken";
                }

                if(User::findByUsernameOrEmail($user->email) !== null) {
                    $data['errors']['email'] = "Email is already taken";
                }

                if(empty($data['errors'])) {
                    $user->save();
                    Auth::attempt($user->username, Input::get('password'));
                    header('Location: /');
                }
            }

            break;

        case '/account':
            $mainView = '../views/users/account.php';
            break;

        case '/account/edit':
            $mainView = '../views/users/edit.php';
            if(!Auth::check()) {
                header('Location: /login');
                exit;
            }
            break;

        case '/ads':
            $mainView = '../views/ads/index.php';
            break;

        case '/ads?id={n}':
            $mainView = '../views/ads/show.php';
            break;

        case '/ads/create':
            $mainView = '../views/ads/create.php';
            if(!Auth::check()) {
                header('Location: /login');
                exit;
            }
            break;

        case '/ads/edit?id={n}':
            $mainView = '../views/ads/edit.php';
            if(!Auth::check()) {
                header('Location: /login');
                exit;
            }   
            break;

        default:    // displays 404 if route not specified above
            $mainView = '../views/404.php';
            break;
    }

    $data['mainView'] = $mainView;

    return $data;
}

extract(pageController());