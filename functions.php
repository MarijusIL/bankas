<?php

function initialize()
{
    if (!file_exists(__DIR__ . '/accounts.json')) {
        $accounts = [];
        setAccounts($accounts);
    }
}

function getAccounts(): array
{
    return json_decode(file_get_contents(__DIR__ . '/accounts.json'), 1);
}

function setAccounts(array $accs)
{
    $accounts = $accs;
    usort($accounts, function ($a, $b) {
        return $a['surname'][0] <=> $b['surname'][0];
    });
    $accounts = json_encode($accounts);
    file_put_contents(__DIR__ . '/accounts.json', $accounts);
}

function createAccount($name, $surname, $personID)
{
    $idCheck = validateID($personID);
    $nameCheck = validateName($name);
    $surnameCheck = validateName($surname);


    if ($idCheck && $nameCheck && $surnameCheck) {
        $newIban = generateIBAN();
        $accounts = getAccounts();
        $accounts[$newIban] = ['name' => $name, 'surname' => $surname, 'idCode' => $personID, 'balance' => 0];
    }
    setAccounts($accounts);
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
            return false;
        }
    }

    return true;
}

function validateName(string $name): bool
{
    return true;
}

function deleteAccount(string $iban)
{
    $accounts = getAccounts();
    if (0 === $accounts[$iban]['balance']) {
        unset($accounts[$iban]);
        setAccounts($accounts);
    }
}

function getAmount(array $acc)
{
    $accounts = getAccounts();
    return 5;
}

function incBalance(string $iban, string $amount)
{
    $accounts = getAccounts();
    $accounts[$iban]['balance'] += (float) $amount;
    $accounts[$iban]['balance'] = round($accounts[$iban]['balance'], 2);
    setAccounts($accounts);
}
function decBalance(string $iban, string $amount)
{
    $accounts = getAccounts();
    $accounts[$iban]['balance'] -= (float) $amount;
    $accounts[$iban]['balance'] = round($accounts[$iban]['balance'], 2);
    setAccounts($accounts);
}