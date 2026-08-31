# MATRO – WordPress verze

Tato složka obsahuje samostatnou WordPress variantu katalogu. Současný React web ani produkční `matro.cz` se jejím spuštěním nemění.

## Co je hotové

- vlastní WordPress téma `matro`,
- produkty jako samostatný typ obsahu,
- kategorie a štítky produktů,
- český a anglický název, popis i produktová dokumentace,
- cena bez DPH, sazba DPH a automatický výpočet ceny s DPH,
- katalogové číslo, značka, balení a minimální odběr,
- hlavní fotografie z knihovny médií,
- vyhledávání, filtrování, řazení a rychlý náhled,
- stránky O společnosti a Kontakt,
- přepínání CZ/EN,
- centrální nastavení kontaktů a hlavních textů,
- bezpečný jednorázový import ukázkových produktů,
- žádný košík ani online objednávka.

Téma nepotřebuje WooCommerce, ACF ani jiný placený plugin.

## Lokální spuštění přes Docker

Je potřeba mít spuštěný Docker Desktop.

```bash
cd /Users/ondrejkodr/Documents/GitHub/Matro/wordpress
docker compose up -d
```

Potom otevřete:

```text
http://localhost:8080
```

Při první návštěvě se zobrazí standardní instalace WordPressu:

1. Zvolte češtinu.
2. Vyplňte název webu a přihlašovací údaje správce.
3. Dokončete instalaci.
4. Přihlaste se na `http://localhost:8080/wp-admin`.
5. Přejděte do **Vzhled → Šablony** a aktivujte **MATRO**.
6. Přejděte do **Nastavení → Trvalé odkazy**, vyberte **Název příspěvku** a změnu uložte.
7. V nabídce **MATRO** upravte kontakty a texty.
8. Na stejné stránce můžete kliknout na **Importovat ukázkové produkty**.

Pokud je port 8080 obsazený, vytvořte soubor `.env` podle `.env.example` a změňte například:

```text
MATRO_WP_PORT=8081
```

## Vypnutí a opětovné spuštění

Kontejnery vypnete příkazem:

```bash
docker compose stop
```

Znovu je spustíte:

```bash
docker compose start
```

Kontejnery lze odstranit bez smazání databáze:

```bash
docker compose down
```

Příkaz `docker compose down -v` by smazal lokální databázi i nahraná média, proto ho nepoužívejte, pokud chcete data zachovat.

## Orientace v administraci

| Nabídka | Obsah |
| --- | --- |
| **Produkty** | Přidání, úprava a publikování produktů. |
| **Produkty → Kategorie produktů** | Kategorie katalogu a jejich anglické názvy. |
| **Produkty → Štítky produktů** | Produktové štítky a jejich anglické názvy. |
| **MATRO** | Kontaktní údaje, firemní údaje a hlavní CZ/EN texty webu. |
| **Média** | Nahrávání produktových fotografií. |
| **Stránky** | Systémové stránky `about` a `contact`; jejich hlavní obsah se spravuje přes MATRO. |

Český název produktu se zadává do hlavního titulku. Ostatní produktové údaje jsou v panelu **Údaje produktu**. Produkt se na webu zobrazí až po publikování.

## Důležité adresy

| Adresa | Obsah |
| --- | --- |
| `/` | Úvod a katalog |
| `/products/` | Katalog produktů |
| `/product/nazev-produktu/` | Detail produktu |
| `/about/` | O společnosti |
| `/contact/` | Kontakt |
| `/wp-admin/` | Administrace |

## Instalace na budoucí hosting

Cloudflare Worker neumí provozovat PHP a databázi WordPressu. Pro ostrou WordPress verzi proto bude potřeba hosting s PHP 8.2+, databází MariaDB/MySQL a HTTPS.

Na hosting se nahraje pouze složka:

```text
wp-content/themes/matro
```

Po aktivaci tématu se nastaví WordPress, naimportují nebo vloží produkty a až po kompletní kontrole se doména přesměruje z aktuálního Workeru na WordPress hosting. Do té doby zůstává současný web beze změny a dostupný.

