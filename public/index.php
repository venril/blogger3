<?php

use User\Model\Db\Mysql\User as UserDB;
use User\Service\User as UserService;

// blogger/public/index.php
require '../app/init.php';

$userService = new UserService(new UserDB($db));
$result = $userService->isValid($_POST);

// Le formulaire a-t-il été validé ?
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($result['valid']) {
        $userService->create($result['vars']);
    }
} else {
    $result['errors'] = [];
}

echo $view->render('user/form-save.phtml', array(
    'errors'  => $result['errors'],
    'user'    => $result['vars'],
));

//$users = $userDb->findAll();
//
//$user = $userDb->find(array(
//    'where' => array(
//        array(
//            'operator' => null,
//            'username' => '',
//        ),
//        array(
//            'operator' => 'and',
//            'password' => '1234',
//        )
//    )
//));