<?php require __DIR__ . '/head.php' ?>


<?php
$accounts = getAccounts();
foreach ($accounts as $iban => $data) { ?>


<div class="container-fluid bg-secondary account border border-info border-5 p-3">
    <h2 class="text-white">Sąskaita <span class="text-light"><?= $iban ?></span></h2>
    <h3 class="text-light"><?= $data['name'] ?> <?= $data['surname'] ?></h3>
    <p class="text-light">Sąskaitos balansas: <?= $data['balance'] ?> eur</p>

    <a href="<?= URL ?>?route=bInc&id=<?= $iban ?>" class="btn btn-warning m-2">Pridėti lėšų</a>
    <a href="<?= URL ?>?route=bDec&id=<?= $iban ?>" class="btn btn-warning m-2">Nuskaičiuoti lėšas</a>
    <form action="<?= URL ?>?route=del&id=<?= $iban ?>" method="post">
        <button type="submit" class="btn btn-danger m-2">Uždaryti sąskaitą</button>
    </form>
</div>
<?php } ?>

<?php require __DIR__ . '/footer.php' ?>