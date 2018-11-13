<?php
require_once 'Model/user.php';

/**
 * Action Sign Up
 * @return array
 */
function signupAction(): array
{
    // if we get the form and csrf verification pass
    if (isset($_POST['password']) && $_SESSION['token'] === $_POST['token']) {

        $username = inputSanitizer($_POST['username']);
        $password = inputSanitizer($_POST['password']);

        // error management
        $error = [];
        if (!checkField($username, ['min' => 4, 'max' => 20])) {
            $params['message'][] = [
                'type' => 'error',
                'text' => 'Your username must be between 4 and 20 characters',
            ];
        }
        if (!checkField($password, ['min' => 8, 'max' => 30])) {
            $params['message'][] = [
                'type' => 'error',
                'text' => 'Your password must be between 8 and 30 characters',
            ];
        }

        if ($error === []) {
            $encryptedPassword = password_hash($password, PASSWORD_BCRYPT);

            $result = addUser($username, $encryptedPassword);

            if ($result) {
                connectUser($username);

            } else {
                $params['message'][] = [
                    'type' => 'error',
                    'text' => 'This username already exist in the database. Please choose another one',
                ];
            }
        } else {
            $params['values'] = [
                'username' => $username,
                'password' => $password,
            ];
        }
    }

    return [
        'view' => 'signup',
        'params' => $params ?? null
    ];

}

/**
 * Action Sign In
 * @return array
 */
function signinAction(): array
{
    // if we get the form and csrf verification pass
    if (isset($_POST['password']) && $_SESSION['token'] === $_POST['token']) {
        $username = inputSanitizer($_POST['username']);
        $password = inputSanitizer($_POST['password']);

        // error management
        $error = [];
        if (!checkField($username, ['min' => 4, 'max' => 20])) {
            $params['messages'][] = [
                'type' => 'error',
                'text' => 'Your username must be between 4 and 20 characters',
            ];
        }
        if (!checkField($password, ['min' => 8, 'max' => 30])) {
            $params['messages'][] = [
                'type' => 'error',
                'text' => 'Your password must be between 8 and 30 characters',
            ];
        }

        if ($error === []) {
            $result = getUserPassword($username);
            if ($result['password']) {
                // password verification between the input and the information in the database
                if (password_verify($password, $result['password'])) {
                    return connectUser($username);

                } else {
                    $params['messages'][] = [
                        'type' => 'error',
                        'text' => "This username + password combination doesn't exist",
                    ];
                }

            } else {
                $params['messages'][] = [
                    'type' => 'error',
                    'text' => "This username + password combination doesn't exist",
                ];
            }
        }
    }

    return [
        'view' => 'signin',
        'params' => $params,
    ];
}


/**
 * Action to do when an user create / connect to his account
 * @param $username
 * @return array
 */
function connectUser($username): array
{
    $result = getUser($username);

    $_SESSION['user']['id'] = $result['id'];
    $_SESSION['user']['name'] = $result['username'];

    return ['redirect' => '/article/articles'];
}

/**
 * Destroy the session and redirect to the home
 * @return array
 */
function disconnectAction(): array
{
    unset($_SESSION);
    session_destroy();

    return ['redirect' => '/'];
}