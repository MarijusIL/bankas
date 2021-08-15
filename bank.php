<?php
require __DIR__ . '/functions.php';
define('URL', 'http://localhost/lape/bankas/bank.php');
initialize();

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $accounts = getAccounts();
    if ('del' == $_POST['action_type']) {
        $deleted = deleteAccount($iban);
    } elseif ('add' == $_POST['action_type']) {
        $accounts[$iban] = setAmount($accounts[$iban], $_POST['ammount'], 'add');
    } elseif ('sub' == $_POST['action_type']) {
        $accounts[$iban] = setAmount($accounts[$iban], $_POST['ammount'], 'sub');
    } elseif ('create' == $_POST['action_type']) {
        $accounts = createAccount($_POST['name'], $_POST['surname'], $_POST['id']);
    }
    setAccounts($accounts);
    header('Location: ' . URL);
    die;
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Labai Patikimas Bankas</title>
</head>

<body>
    <div>
        <form action="http://localhost/lape/bankas/bank.php" method="post">
            <label>Įrašykite vardą : <input type="text" name="name"></label>
            <label>Įrašykite pavardę : <input type="text" name="surname"></label>
            <label>Įrašykite asmens kodą : <input type="text" name="id"></label>
            <button type="submit" name="action_type" value="create">Sukurti naują sąskaitą</button>
        </form>
    </div>
    <div>
        <h2>Sąskaita LT###################</h2>
        <h3>Vardenis Pavardenis</h3>
        <p>Sąskaitoje yra: 00.00 eur</p>
    </div>
    <div>
        <form action="http://localhost/lape/bankas/bank.php" method="post">
            <label>Įrašykite sumą : <input type="text" name="ammount"></label>
            <button type="submit" name="action_type" value="add">Pridėti lėšas</button>
            <button type="submit" name="action_type" value="sub">Nuskaičiuoti lėšas</button>
            <button type="submit" name="action_type" value="del">Uždaryti sąskaitą</button>
        </form>
    </div>
</body>

</html>