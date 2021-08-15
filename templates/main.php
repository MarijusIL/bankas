<?php require __DIR__ . '/head.php' ?>


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

<?php require __DIR__ . '/footer.php' ?>