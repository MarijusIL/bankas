<?php
require __DIR__ . '/routerHelperFunctions.php';

function router()
{
    $route = $_GET['route'] ?? '';

    if ('GET' == $_SERVER['REQUEST_METHOD']) {
        if ('' == $route) {
            showMain();
        } elseif ('create' == $route) {
            showCreate();
        } elseif ('bDec' == $route) {
            showDec();
        } elseif ('bInc' == $route) {
            showInc();
        }
    } elseif ('POST' == $_SERVER['REQUEST_METHOD']) {
        if ('del' == $route) {
            deleteAccount($_GET['id']);
        } elseif ('add' == $route) {
            incBalance($_GET['id'], $_POST['amount']);
        } elseif ('sub' == $route) {
            decBalance($_GET['id'], $_POST['amount']);
        } elseif ('create' == $route) {
            createAccount($_POST['name'], $_POST['surname'], $_POST['id']);
        }
    }
}