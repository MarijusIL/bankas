<?php

function router()
{
    if ('GET' == $_SERVER['REQUEST_METHOD']) {
        showMain();
    } elseif ('POST' == $_SERVER['REQUEST_METHOD']) {
        $accounts = getAccounts();
        if ('del' == $_POST['action_type']) {
            // $deleted = deleteAccount($iban);
        } elseif ('add' == $_POST['action_type']) {
            // $accounts[$iban] = setAmount($accounts[$iban], $_POST['ammount'], 'add');
        } elseif ('sub' == $_POST['action_type']) {
            // $accounts[$iban] = setAmount($accounts[$iban], $_POST['ammount'], 'sub');
        } elseif ('create' == $_POST['action_type']) {
            $accounts = createAccount($_POST['name'], $_POST['surname'], $_POST['id']);
        }
        setAccounts($accounts);
        header('Location: ' . URL);
        die;
    }
}