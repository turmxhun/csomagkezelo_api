<!DOCTYPE html>
<html>
<head>
    <title>Felhasználói Felület</title>
</head>
<body>
    <h1>Felhasználói Felület</h1>
    <h2>Felhasználók</h2>
    <form action="users.php" method="GET">
        <button type="submit">Felhasználói lista lekérdezése (GET)</button>
    </form>

    <h2>Új Felhasználó Hozzáadása</h2>
    <form id="addUserForm" action="users.php" method="POST">
        <label for="first_name">Keresztnév</label>
        <input type="text" name="first_name" required>
        <label for="last_name">Vezetéknév</label>
        <input type="text" name="last_name" required>
        <label for="email_address">Email cím</label>
        <input type="email" name="email_address" required>
        <label for="password">Jelszó</label>
        <input type="password" name="password" required>
        <label for="phone_number">Telefonszám</label>
        <input type="tel" name="phone_number">
        <button type="submit">Hozzáadás</button>
    </form>




    <h2>Csomagok</h2>
    <form action="parcels.php" method="GET">
        <label for="parcel_number">Csomagszám</label>
        <input type="text" name="parcel_number" required>
        <button type="submit">Lekérdezés</button>
    </form>

    <h2>Új Csomag Hozzáadása</h2>
    <form action="parcels.php" method="POST">
        <label for="size">Méret</label>
        <input type="text" name="size" required>
        <label for="user_id">Felhasználó ID</label>
        <input type="number" name="user_id" required>
        <button type="submit">Hozzáadás</button>
    </form>
</body>
</html>
