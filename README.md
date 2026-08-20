# MATRO – katalog bio produktů

Webová prezentace společnosti MATRO Praha, s.r.o. určená především pro prodejny a další B2B partnery. Web představuje firmu a její sortiment makrobiotických a bio produktů. Není to e-shop: produkty nelze vložit do košíku ani objednat online, zájemce kontaktuje MATRO telefonicky nebo e-mailem.

## Aktuální stav projektu

Tato verze je frontendový prototyp postavený v Reactu. Obsahuje:

- katalog produktů s vyhledáváním, filtrováním a řazením,
- produktové karty, rychlý náhled a detail produktu,
- stránky O společnosti a Kontakt,
- českou a anglickou verzi,
- responzivní zobrazení pro mobil, tablet a počítač.

Zatím zde **není databáze ani administrační panel**. Produkty, kontakty a texty se nyní upravují přímo v souborech popsaných níže. Převod do WordPressu a správa přes `/wp-admin` jsou plánovaný další krok.

Produktové fotografie, ceny a některé kontaktní údaje jsou ukázkové placeholdery a před zveřejněním se musí nahradit finálními daty.

## Použité technologie

- React 19
- React Router 7
- Vite 7
- Tailwind CSS 3
- JavaScript / JSX
- npm

Projekt v tuto chvíli nepotřebuje žádný `.env` soubor ani připojení k databázi.

## Rychlé spuštění

### Požadavky

- Node.js `20.19+` nebo `22.12+`
- npm (je součástí Node.js)

Verze ověříš příkazy:

```bash
node --version
npm --version
```

### První spuštění po stažení projektu

V terminálu přejdi do složky projektu a spusť:

```bash
cd /Users/ondrejkodr/Documents/GitHub/Matro
npm ci
npm run dev
```

Potom otevři adresu:

```text
http://127.0.0.1:5173/
```

Vývojový server zůstává spuštěný v terminálu. Ukončíš ho klávesovou zkratkou `Ctrl+C`. Změny v kódu se při uložení automaticky projeví v prohlížeči.

Pokud už je složka `node_modules` nainstalovaná, stačí pouze:

```bash
npm run dev
```

### Otevření webu z jiného zařízení v síti

```bash
npm run dev -- --host
```

Vite v terminálu vypíše síťovou adresu. Počítač i druhé zařízení musí být ve stejné síti.

## Dostupné příkazy

| Příkaz | K čemu slouží |
| --- | --- |
| `npm ci` | Nainstaluje přesné verze balíčků podle `package-lock.json`. Doporučeno po stažení projektu. |
| `npm install` | Nainstaluje balíčky a případně aktualizuje lockfile. Používej hlavně při přidávání závislostí. |
| `npm run dev` | Spustí lokální vývojový server s automatickým obnovováním. |
| `npm run build` | Vytvoří produkční verzi webu ve složce `dist/`. |
| `npm run preview` | Lokálně zobrazí již vytvořenou produkční verzi z `dist/`. Nejdřív spusť build. |
| `npm run lint` | Zkontroluje JavaScript a JSX pomocí ESLintu. |
| `npm run tailwind:init` | Znovu vytvoří základní konfiguraci Tailwindu. Projekt ji už má, běžně tento příkaz nepoužívej. |

Doporučená kontrola před odevzdáním změn:

```bash
npm run lint
npm run build
npm run preview
```

## Adresy jednotlivých stránek

| Adresa | Obsah |
| --- | --- |
| `/` | Úvodní stránka a katalog |
| `/products` | Katalog produktů |
| `/product/:slug` | Detail konkrétního produktu |
| `/about` | O společnosti |
| `/contact` | Kontakt |

Například detail ukázkového produktu je na `/product/ryze-kratkozrnna-1kg`.

## Orientace ve složkách

```text
Matro/
├── index.html                 # HTML obálka, titulek a základní SEO popis
├── package.json               # Balíčky a npm příkazy
├── vite.config.js             # Konfigurace Vite
├── tailwind.config.js         # Konfigurace Tailwind CSS
├── postcss.config.js          # PostCSS a Autoprefixer
├── eslint.config.js           # Pravidla kontroly kódu
├── public/                    # Veřejné statické soubory
└── src/
    ├── main.jsx               # Vstup aplikace, router a jazykový provider
    ├── App.jsx                # Seznam URL adres a jejich stránek
    ├── index.css              # Globální styly a Tailwind direktivy
    ├── assets/                # Logo a další lokální obrázky
    ├── components/            # Opakovaně používané části rozhraní
    ├── context/               # Stav a logika přepínání jazyka
    ├── data/products.js       # Aktuální ukázkové produkty a kategorie
    ├── hooks/useLanguage.js   # Přístup k překladům z komponent
    ├── i18n/translations.js   # České a anglické texty
    └── pages/                 # Jednotlivé stránky webu
```

### Hlavní komponenty

| Soubor | Odpovědnost |
| --- | --- |
| `src/components/Layout.jsx` | Společné rozložení: navigace, obsah a patička. |
| `src/components/Navbar.jsx` | Horní navigace, mobilní menu a přepínač CZ/EN. |
| `src/components/Footer.jsx` | Patička, odkazy a kontaktní placeholdery. |
| `src/components/ProductCard.jsx` | Jedna karta produktu v katalogu. |
| `src/components/Filters.jsx` | Vyhledávání, kategorie a řazení katalogu. |
| `src/components/Modal.jsx` | Okno s rychlým náhledem produktu. |
| `src/components/PageIntro.jsx` | Společná úvodní sekce stránek Produkty, O společnosti a Kontakt. |
| `src/components/ScrollToTop.jsx` | Po změně stránky vrátí zobrazení na začátek a při posunu zobrazí tlačítko Zpět nahoru. |
| `src/pages/ProductCatalogPage.jsx` | Úvod, katalog a logika filtrování produktů. |
| `src/pages/ProductDetailPage.jsx` | Detail produktu načtený podle `slug`. |
| `src/pages/AboutPage.jsx` | Stránka O společnosti. |
| `src/pages/ContactPage.jsx` | Kontakty a firemní údaje. |

## Kde se co upravuje

### Produkty a kategorie

Produkty jsou zatím v `src/data/products.js` v poli `PRODUCTS`. Nový produkt přidáš jako další objekt:

```js
{
  id: "c-999",                         // unikátní interní ID
  sku: "12345",                        // katalogové číslo
  slug: "nazev-produktu-500g",         // unikátní část URL bez mezer a diakritiky
  name: "Název produktu 500 g",        // český název
  nameEn: "Product name 500 g",        // anglický název
  priceExVat: 59.9,                     // cena za kus bez DPH
  vatRate: 12,                          // sazba DPH v procentech
  package: "6 × 500 g",                // obchodní balení
  minOrder: 6,                          // minimální odběr v kusech
  category: "Těstoviny",               // musí odpovídat názvu v CATEGORIES
  image: "https://...",                // URL obrázku nebo import lokálního souboru
  tags: ["Cereální těstoviny"],
  brand: "LIMA",
  description: "Český popis produktu.",
  descriptionEn: "English product description."
}
```

Při přidání nové kategorie:

1. Přidej český název do pole `CATEGORIES` v `src/data/products.js`.
2. Přidej anglický překlad do `CATEGORY_TRANSLATIONS` v `src/i18n/translations.js`.

Stejně fungují štítky produktů přes `TAG_TRANSLATIONS`.

Cena s DPH se na webu dopočítává automaticky z `priceExVat` a `vatRate`. Měna je v současnosti napevno nastavena na CZK.

Ukázkové fotografie se načítají z Unsplash, takže pro jejich zobrazení je potřeba internet. Finální produktové fotografie bude lepší uložit lokálně nebo spravovat ve WordPress médiích.

### Texty a překlady

Většina textů je v `src/i18n/translations.js`:

- `TRANSLATIONS.cs` obsahuje češtinu,
- `TRANSLATIONS.en` obsahuje angličtinu,
- oba jazyky by měly mít stejné klíče.

Jazyk se přepíná v horní navigaci a volba se ukládá v prohlížeči pod klíčem `matro-language`. Výchozí jazyk je čeština.

Některé firemní údaje jsou zatím napsané přímo ve stránkách. Při jejich úpravě zkontroluj hlavně:

- `src/pages/ContactPage.jsx` – IČO, DIČ a web,
- `src/pages/AboutPage.jsx` – název společnosti a rok,
- `src/i18n/translations.js` – telefon, e-mail, adresa a veškeré překlady,
- `index.html` – titulek stránky a SEO popis.

### Logo a obrázky

- Hlavní logo: `src/assets/matro-logo.svg`
- Záložní rastrové logo: `src/assets/matro-logo.png`
- Logo v navigaci a patičce importují `Navbar.jsx` a `Footer.jsx`.

SVG má průhledné pozadí a je vhodné pro web. Při výměně loga je ideální zachovat stejný název souboru nebo upravit příslušné importy.

### Barvy a vzhled

Vzhled je vytvořen převážně pomocí Tailwind tříd přímo v JSX souborech. Nejčastější barvy:

- tmavě zelená `#173f35`,
- světlé krémové pozadí `#f6f2e8`,
- světle zelená `#dce9b6`,
- oranžový akcent `#e5794b`.

Globální pravidla jsou v `src/index.css`. Soubor `src/App.css` se aktuálně do aplikace neimportuje a nemá vliv na vzhled.

### Přidání nové stránky

1. Vytvoř komponentu v `src/pages/`.
2. Importuj ji v `src/App.jsx`.
3. Přidej nový `<Route>` do `src/App.jsx`.
4. Pokud má být v menu, přidej odkaz také do `src/components/Navbar.jsx` a `src/components/Footer.jsx`.
5. Přidej české i anglické texty do `src/i18n/translations.js`.

## Jak aplikace funguje

1. `src/main.jsx` spustí React, `BrowserRouter` a jazykový provider.
2. `src/App.jsx` podle URL vybere konkrétní stránku.
3. `Layout.jsx` kolem stránky zobrazí společnou navigaci a patičku.
4. Katalog načte `PRODUCTS`, filtruje je v prohlížeči a skládá z nich `ProductCard`.
5. Detail produktu najde položku podle hodnoty `slug` v URL.
6. `LanguageProvider` vrací správný text a český nebo anglický název produktu.

Všechna data jsou nyní součástí výsledného JavaScriptu a načítají se v prohlížeči. Neexistuje serverová část ani přihlašování.

## Produkční build a nasazení

Produkční soubory vytvoříš příkazem:

```bash
npm run build
```

Výsledek se uloží do `dist/`. Správnost buildu lze ověřit:

```bash
npm run preview
```

Složka `dist/` se negituje, protože se vždy vytváří z aktuálního zdrojového kódu.

Při nasazení současné React verze musí hosting všechny neexistující cesty, například `/about` nebo `/product/ryze-kratkozrnna-1kg`, přesměrovat na `index.html`. Jinak přímé otevření nebo obnovení podstránky skončí chybou 404.

## Plánovaný WordPress

Současný projekt slouží jako funkční předloha designu a chování. Při převodu do WordPressu se počítá s:

- vlastní WordPress šablonou podle tohoto vzhledu,
- produkty jako samostatným spravovatelným typem obsahu,
- úpravou produktů, fotografií, cen, kategorií a stránek přes `/wp-admin`,
- českou a anglickou verzí,
- zachováním katalogu bez košíku a online plateb.

Dokud převod neproběhne, adresa `/wp-admin` v tomto projektu neexistuje.

## Časté problémy

### `npm` nebo `node` nebyl nalezen

Není nainstalovaný Node.js nebo není dostupný v systémové cestě. Nainstaluj podporovanou verzi Node.js a znovu otevři terminál.

### Chyba při instalaci balíčků

Nejdřív ověř verzi Node.js. Potom v kořenové složce projektu spusť znovu:

```bash
npm ci
```

### Port 5173 je obsazený

Vite obvykle automaticky zvolí další volný port a vypíše správnou adresu. Vlastní port lze nastavit například takto:

```bash
npm run dev -- --port 5174
```

### Obrázky produktů se nezobrazují

Ukázková data používají externí adresy Unsplash. Zkontroluj internetové připojení a hodnotu `image` u produktu v `src/data/products.js`.

### Přímé otevření podstránky vrací po nasazení 404

Hosting nemá nastavený fallback na `index.html`. Jde o požadavek klientského routování přes `BrowserRouter`; při budoucím převodu do WordPressu se bude směrování řešit WordPressem.
