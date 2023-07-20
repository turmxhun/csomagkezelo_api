# Dokumentáció: Csomagkezelő API


Az alábbi dokumentáció bemutatja a Csomagkezelő API-t, amely lehetővé teszi a felhasználók és csomagok kezelését egy adatbázisban. Az API segítségével új felhasználókat hozzáadhatsz, meglévő felhasználókat lekérdezhet, új csomagokat adhatsz hozzá és meglévő csomagokat lekérdezhetsz. Az API a REST architektúrát követi, és JSON formátumban kommunikál.

### Futtatáshoz szükséges



- Telepített PHP környezet (ajánlott XAMPP vagy hasonló)
- Adatbázis létrehozása (az adatbázis beállításait a config.php fájlban kell konfigurálni)
- Az API fájlokat az Apache kiszolgáló futtatási mappájába kell másolni vagy elérhetővé kell tenni

### URI-k és bemenetek
- Felhasználók lekérdezése (GET):
-- URI: users.php
-- Metódus: GET
-- Bemenet: Nincs bemenet
-- Kimenet: JSON formátumban a rendelkezésre álló összes felhasználó adatai (kivéve jelszó)

- Új Felhasználó Hozzáadása (POST):
-- URI: users.php
-- Metódus: POST
-- Bemenet: JSON objektum a következő adatokkal: Keresztnév (kötelező), Vezetéknév (kötelező), Email cím (kötelező), Jelszó (kötelező), Telefonszám (opcionális)
-- Kimenet: JSON formátumban az újonnan létrehozott felhasználó adatai (kivéve jelszó) vagy hibaüzenet.

- Csomag lekérdezése (GET):
-- URI: parcels.php?parcel_number={csomagszám}
-- Metódus: GET
-- Bemenet: parcel_number URL paraméter, a csomagszám, amelyet le szeretnénk kérdezni (kötelező).
-- Kimenet: JSON formátumban a megadott csomagszámhoz tartozó csomag adatai vagy "Nincs ilyen csomag az adatbázisban." üzenet, ha a csomag nem található az adatbázisban.

- Új Csomag Hozzáadása (POST):
-- URI: parcels.php
-- Metódus: POST
-- Bemenet: JSON objektum a következő adatokkal: size: Csomag mérete (kötelező, értéke lehet: "S", "M", "L" vagy "XL"), user_id: A csomaghoz tartozó felhasználói azonosító (kötelező)
-- Kimenet: JSON formátumban az újonnan létrehozott csomag adatai vagy hibaüzenet.
 
