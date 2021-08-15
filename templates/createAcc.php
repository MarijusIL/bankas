<?php require __DIR__ . '/head.php' ?>

<div class="m-5">
    <form action="<?= URL ?>?route=create" method="post">
        <label class="mx-1">Įrašykite vardą : <input type="text" name="name"></label>
        <label class="mx-1">Įrašykite pavardę : <input type="text" name="surname"></label>
        <label class="mx-1">Įrašykite asmens kodą : <input type="text" name="id"></label>
        <button type="submit" class="btn btn-warning mx-1">Sukurti naują sąskaitą</button>
    </form>
</div>

<?php require __DIR__ . '/footer.php' ?>