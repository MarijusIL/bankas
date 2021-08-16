<?php

function initialize()
{
    if (!file_exists(__DIR__ . '/accounts.json')) {
        $accounts = [];
        setAccounts($accounts);
    }
    session_start();
}

function getAccounts(): array
{
    return json_decode(file_get_contents(__DIR__ . '/accounts.json'), 1);
}

function setAccounts(array $accs)
{
    $accounts = $accs;
    uasort($accounts, function ($a, $b) {
        if ($a['surname'][0] != $b['surname'][0]) {
            return $a['surname'][0] <=> $b['surname'][0];
        } else {
            $i = 1;
            do {
                $i++;
            } while ($a['surname'][$i] == $b['surname'][$i]);
            return $a['surname'][$i] <=> $b['surname'][$i];
        }
    });
    $accounts = json_encode($accounts);
    file_put_contents(__DIR__ . '/accounts.json', $accounts);
}

function createAccount($name, $surname, $personID)
{
    $idCheck = validateID($personID);
    $nameCheck = validateName($name);
    $surnameCheck = validateSurname($surname);


    if ($idCheck && $nameCheck && $surnameCheck) {
        $newIban = generateIBAN();
        $accounts = getAccounts();
        $accounts[$newIban] = ['name' => $name, 'surname' => $surname, 'idCode' => $personID, 'balance' => 0];
        setAccounts($accounts);
        addMessage('success', 'Sąskaita sukurta');
        header('Location: ' . URL);
        die;
    }
    header('Location: ' . URL . '?route=create');
    die;
}

function generateIBAN(): string
{
    $bankNo = '55986';
    $countryCode = 'LT';
    $iban = $countryCode . '01' . $bankNo;
    $accounts = getAccounts();
    $unique = false;
    do {
        foreach (range(0, 10) as $_) {
            $iban .= rand(0, 9);
        }
        $unique = true;
        foreach ($accounts as $key => $_) {
            if ($key === $iban) {
                $unique = false;
            }
        }
    } while (!$unique);
    return $iban;
}

function validateID(string $ID): bool
{
    $accounts = getAccounts();

    foreach ($accounts as $check) {
        if ($check['idCode'] === $ID) {
            addMessage('danger', 'toks asmens kodas jau yra');
            return false;
        }
    }
    return true;
}

function validateName(string $name): bool
{
    if (strlen($name) < 3) {
        addMessage('danger', 'vardas negali būti trumpesnis nei 3 simboliai');
        return false;
    }
    return true;
}
function validateSurname(string $surname): bool
{
    if (strlen($surname) < 3) {
        addMessage('danger', 'pavardė negali būti trumpesnė nei 3 simboliai');
        return false;
    }
    return true;
}

function deleteAccount(string $iban)
{
    $accounts = getAccounts();
    if (0 === $accounts[$iban]['balance']) {
        unset($accounts[$iban]);
        setAccounts($accounts);
        addMessage('success', 'Sąskaita ištrinta');
    } else {
        addMessage('danger', 'Negalima ištrinti sąskaitos, kurioje yra lėšų');
    }
    header('Location: ' . URL);
    die;
}


function incBalance(string $iban, string $amount)
{
    $accounts = getAccounts();
    $accounts[$iban]['balance'] += (float) $amount;
    $accounts[$iban]['balance'] = round($accounts[$iban]['balance'], 2);
    setAccounts($accounts);
    addMessage('success', 'lėšos sėkmingai pridėtos');
    header('Location: ' . URL);
    die;
}

function decBalance(string $iban, string $amount)
{
    $accounts = getAccounts();
    if ($accounts[$iban]['balance'] >= (float) $amount) {
        $accounts[$iban]['balance'] -= (float) $amount;
        $accounts[$iban]['balance'] = round($accounts[$iban]['balance'], 2);
        setAccounts($accounts);
        addMessage('success', 'lėšos sėkmingai nuskaičiuotos');
        header('Location: ' . URL);
        die;
    } else {
        addMessage('danger', 'nepakanka lėšų operacijai atlikti');
        header('Location: ' . URL /*. '?route=bDec'*/);
        die;
    }
}

function addMessage($type, $info)
{
    $_SESSION['info'][] = ['type' => $type, 'info' => $info];
}

function clearMessage()
{
    $_SESSION['info'] = [];
}

function showMessage()
{
    $messages = $_SESSION['info'];
    clearMessage();
    require __DIR__ . '/templates/info.php';
}