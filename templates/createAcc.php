<?php require __DIR__ . '/head.php' ?>

<div>
    <form action="<?= URL ?>?route=create" method="post">
        <label>Įrašykite vardą : <input type="text" name="name"></label>
        <label>Įrašykite pavardę : <input type="text" name="surname"></label>
        <label>Įrašykite asmens kodą : <input type="text" name="id"></label>
        <button type="submit">Sukurti naują sąskaitą</button>
    </form>
</div>

<?php require __DIR__ . '/footer.php' ?>