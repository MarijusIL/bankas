<?php

function initialize()
{
    if (!file_exists(__DIR__ . '/accounts.json')) {
        $accounts = [];
        $accounts = json_encode($accounts);
        file_put_contents(__DIR__ . '/accounts.json', $accounts);
    }
    if (!file_exists(__DIR__ . '/iban_list.json')) {
        $ibanList = [];
        $ibanList = json_encode($ibanList);
        file_put_contents(__DIR__ . '/ibanList.json', $ibanList);
    }
}

function getAccounts(): array
{
    return json_decode(file_get_contents(__DIR__ . '/accounts.json'), 1);
}

function createAccount($name, $surname, $personID)
{
    $newIban = generateIBAN();
    $accounts = getAccounts();

    $accounts[$newIban] = ['name' => $name, 'surname' => $surname, 'idCode' => $personID];
}

function generateIBAN(): string
{
    $bankNo = '55986';
    $countryCode = 'LT';
    $iban = $countryCode . '01' . $bankNo;
    $ibanList = json_decode(file_get_contents(__DIR__ . '/ibanList.json'), 1);
    $unique = false;
    do {
        foreach (range(0, 10) as $_) {
            $iban .= rand(0, 9);
        }
        $unique = true;
        foreach ($ibanList as $check) {
            if ($check == $iban) {
                $unique = false;
            }
        }
    } while (!$unique);
    return $iban;
}

function validateID(): bool
{
    return true;
}

function deleteAccount()
{
}

function getAmount()
{
}

function setAmount(array $acc, string $operation): void
{
}