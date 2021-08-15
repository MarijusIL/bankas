<?php require __DIR__ . '/head.php' ?>


<?php
$accounts = getAccounts();
foreach ($accounts as $iban => $data) { ?>


<div>
    <h2>Sąskaita <?= $iban ?></h2>
    <h3><?= $data['name'] ?> <?= $data['surname'] ?></h3>
    <p>Sąskaitoje yra: <?= $data['balance'] ?> eur</p>
</div>
<div>
    <a href="<?= URL ?>?route=bInc&id=<?= $iban ?>">Pridėti lėšų</a>
    <a href="<?= URL ?>?route=bDec&id=<?= $iban ?>">Nuskaičiuoti lėšų</a>
    <form action="<?= URL ?>?route=del&id=<?= $iban ?>" method="post">
        <button type="submit">Uždaryti sąskaitą</button>
    </form>
</div>
<?php } ?>

<?php require __DIR__ . '/footer.php' ?>