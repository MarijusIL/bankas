<?php require __DIR__ . '/head.php' ?>
<form action="<?= URL ?>?route=add&id=<?= $_GET['id'] ?>" method="post">
    <label>Įrašykite sumą : <input type="text" name="amount"></label>
    <button type="submit">Pridėti lėšas</button>
</form>
<?php require __DIR__ . '/footer.php' ?>