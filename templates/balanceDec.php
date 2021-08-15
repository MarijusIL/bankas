<?php require __DIR__ . '/head.php' ?>
<div class="m-5">
    <form action="<?= URL ?>?route=sub&id=<?= $_GET['id'] ?>" method="post">
        <label>Įrašykite sumą : <input type="text" name="amount"></label>
        <button type="submit" class="btn btn-warning">Nuskaičiuoti lėšas</button>
    </form>
</div>
<?php require __DIR__ . '/footer.php' ?>