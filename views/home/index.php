<?php

use Controllers\Users;

$view->title = 'Главная страница';

$from = '<info@udb.test>';
$sendTo = '<demo@domain.com>';
$subject = 'Активация аккаунта';
$emailText = 'Для подтверждения регистрации перейдите по ссылке: ';

$errorMessage = 'Ошибка отправки формы, попробуйте позже';
$okMessage = 'Пользователь успешно зарегестрирован, активируйте аккаунт по ссылке из Email';
$okMessageDen = 'Пользователь уже зарегестрирован';

if(isset($_GET['verify']))
{
    echo Users::verify_user($_GET['verify']);

    return false;
}

try
{
    if (!empty($_POST)) {

        // validate the ReCaptcha, if something is wrong, we throw an Exception,
        // i.e. code stops executing and goes to catch() block

        /*if (!isset($_POST['g-recaptcha-response'])) {
            throw new \Exception('ReCaptcha is not set.');
        }

        // do not forget to enter your secret key in the config above
        // from https://www.google.com/recaptcha/admin

        $recaptcha = new \ReCaptcha\ReCaptcha($view->recaptcha_key, new \ReCaptcha\RequestMethod\CurlPost());

        // we validate the ReCaptcha field together with the user's IP address

        $response = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);


        if (!$response->isSuccess()) {
            throw new \Exception('ReCaptcha was not validated.');
        }*/

        $user = Users::create_user($_POST);

        if($user) {
            $responseArray = array('type' => 'success', 'message' => $okMessage);

            $headers = array('Content-Type: text/plain; charset="UTF-8";',
                'From: ' . $from,
                'Reply-To: ' . $from,
                'Return-Path: ' . $from,
            );

            $link = 'http://' . $_SERVER['SERVER_NAME'] . '?verify=' . $user['key'];

            mail('<'. $user['email'].'>', $subject, $emailText . $link, implode("\n", $headers));

        } else {
            $responseArray = array('type' => 'danger', 'message' => $okMessageDen);
        }
    }
}
catch (\Exception $e)
{
    $responseArray = array('type' => 'danger', 'message' => $errorMessage);
}

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $encoded = json_encode($responseArray);

    header('Content-Type: application/json');

    echo $encoded;
}
else {
    echo $responseArray['message'];
}