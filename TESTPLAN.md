# Testplan - Overzichtelijk Dashboard

## Datum: 7 april 2026

### Doel
Dit document beschrijft alle testcases voor het Overzichtelijk Dashboard project. Het dashboard richt zich op het uploaden en visualiseren van Excel-bestanden met milieucheck data.

---

## 1. Uploaden van Excel-bestand

### TC-001: Succesvol uploaden van geldig Excel-bestand
**Precondities:**
- Gebruiker is ingelogd
- Excel-bestand bevat correcte kolommen: action, description, employee_name, duration, cost, date

**Stappen:**
1. Navigeer naar Upload pagina
2. Selecteer geldig Excel-bestand
3. Klik "Upload"

**Verwacht resultaat:**
- Bestand wordt gevalideerd
- Data wordt opgeslagen in database
- Succes bericht getoond
- Records verschijnen in dashboard

**Status:** ⏳ Te testen

---

### TC-002: Upload van ongeldig Excel-bestand (onjuiste kolommen)
**Precondities:**
- Gebruiker is ingelogd
- Excel-bestand bevat onjuiste/ontbrekende kolommen

**Stappen:**
1. Navigeer naar Upload pagina
2. Selecteer ongeldig Excel-bestand
3. Klik "Upload"

**Verwacht resultaat:**
- Foutmelding: "Excel bestand bevat onjuiste kolommen"
- Data wordt NIET opgeslagen
- Bestand wordt niet verwerkt

**Status:** ⏳ Te testen

---

### TC-003: Upload van leeg Excel-bestand
**Precondities:**
- Gebruiker is ingelogd
- Excel-bestand is leeg (geen data rows)

**Stappen:**
1. Navigeer naar Upload pagina
2. Selecteer leeg Excel-bestand
3. Klik "Upload"

**Verwacht resultaat:**
- Foutmelding: "Excel bestand bevat geen data"
- Data wordt NIET opgeslagen

**Status:** ⏳ Te testen

---

## 2. Weergave van data in dashboard

### TC-004: Dashboard toont alle records na upload
**Precondities:**
- Minimaal 1 Excel-bestand is geupload
- Database bevat records

**Stappen:**
1. Navigeer naar Dashboard pagina
2. Observeer tabel met records

**Verwacht resultaat:**
- Alle records uit database worden getoond
- Kolommen zichtbaar: datum, medewerker, actie, duur, kosten
- Data is correct geformateerd

**Status:** ⏳ Te testen

---

### TC-005: Dashboard stat cards tonen correcte totalen
**Precondities:**
- Database bevat minimaal 5 records met variërende kosten

**Stappen:**
1. Navigeer naar Dashboard
2. Observeer stat cards (Totale acties, Totale kosten, Gem. duur)

**Verwacht resultaat:**
- "Totale acties" toont correct aantal
- "Totale kosten" toont correct somtotaal
- "Gem. duur per actie" berekend correct

**Status:** ⏳ Te testen

---

## 3. Zoek- en filterfunctie

### TC-006: Filter op medewerker naam
**Precondities:**
- Database bevat records van verschillende medewerkers

**Stappen:**
1. Navigeer naar Dashboard
2. Typ medewerker naam in filter
3. Druk Enter/Apply

**Verwacht resultaat:**
- Tabel toont ALLEEN records van desbetreffende medewerker
- Aantal records beperkt tot match

**Status:** ⏳ Te testen

---

### TC-007: Filter op datum range
**Precondities:**
- Database bevat records met verschillende data

**Stappen:**
1. Navigeer naar Dashboard
2. Selecteer start en eind datum
3. Apply filter

**Verwacht resultaat:**
- Tabel toont ALLEEN records binnen datum range
- Stat cards updaten met gefilterde data

**Status:** ⏳ Te testen

---

### TC-008: Filter op kosten (minimaal/maximaal)
**Precondities:**
- Database bevat records met verschillende kostenbijdragen

**Stappen:**
1. Navigeer naar Dashboard
2. Voer minimale en/of maximale kosten in
3. Apply filter

**Verwacht resultaat:**
- Tabel toont records binnen kostenrange
- Grafieken updaten

**Status:** ⏳ Te testen

---

## 4. Sortering

### TC-009: Sortering op datum (oplopend)
**Precondities:**
- Database bevat records met verschillende data

**Stappen:**
1. Klik op "Datum" kolom header
2. Klik opnieuw voor omgekeerde volgorde

**Verwacht resultaat:**
- Records sorteren chronologisch (oud → nieuw)
- Tweede klik geeft omgekeerde volgorde

**Status:** ⏳ Te testen

---

### TC-010: Sortering op kosten (aflopend)
**Precondities:**
- Database bevat records met verschillende kosten

**Stappen:**
1. Klik op "Kosten" kolom header
2. Observeer volgorde

**Verwacht resultaat:**
- Records sorteren van hoog → laag (of omgekeerd)
- Sortering is correct

**Status:** ⏳ Te testen

---

## 5. Grafieken en visualisaties

### TC-011: Bar chart "Acties per maand" toont correct
**Precondities:**
- Database bevat records verdeeld over meerdere maanden

**Stappen:**
1. Navigeer naar Dashboard
2. Observeer bar chart "Acties per maand"

**Verwacht resultaat:**
- Chart toont correct aantal acties per maand
- Y-as bereik aangepasst aan data
- Maand labels zichtbaar

**Status:** ⏳ Te testen

---

### TC-012: Donut chart "Actietypes verdeling" toont correct
**Precondities:**
- Records bevatten verschillende actie types (Bodem, Water, Lucht)

**Stappen:**
1. Navigeer naar Dashboard
2. Observeer donut chart

**Verwacht resultaat:**
- Proporties correct weergegeven
- Kleuren matchen legende
- Percentages kloppen

**Status:** ⏳ Te testen

---

### TC-013: Line chart "Kostentrend" toont trend
**Precondities:**
- Minimaal 6 maanden data beschikbaar

**Stappen:**
1. Navigeer naar Dashboard
2. Observeer line chart kostentrend

**Verwacht resultaat:**
- Trendlijn zichtbaar
- Data punten correct geplot
- Trend is herkenbaar

**Status:** ⏳ Te testen

---

## 6. Authenticatie

### TC-014: Inloggen met geldige credentials
**Precondities:**
- Test user account bestaat: test@example.com / password

**Stappen:**
1. Navigeer naar login pagina
2. Voer email + wachtwoord in
3. Klik Login

**Verwacht resultaat:**
- Gebruiker wordt ingelogd
- Redirected naar dashboard
- Session actief

**Status:** ⏳ Te testen

---

### TC-015: Inloggen met ongeldige credentials
**Precondities:**
- N/A

**Stappen:**
1. Navigeer naar login pagina
2. Voer foutieve email/wachtwoord in
3. Klik Login

**Verwacht resultaat:**
- Foutmelding getoond
- Gebruiker NIET ingelogd
- Terugkeer naar login pagina

**Status:** ⏳ Te testen

---

### TC-016: Gast kan niet naar dashboard
**Precondities:**
- Gebruiker is NIET ingelogd

**Stappen:**
1. Navigeer direct naar /admin/dashboard
2. Observeer result

**Verwacht resultaat:**
- Gast wordt geredirect naar login
- Dashboard is beveiligd

**Status:** ⏳ Te testen

---

## 7. Data integriteit

### TC-017: Upload blijft behouden na bestandsupdate
**Precondities:**
- Excel-bestand is geupload
- Origineel bestand is beschikbaar

**Stappen:**
1. Wijzig origineel Excel-bestand
2. Herlaad applicatie

**Verwacht resultaat:**
- Original geupload data is ONGEWIJZIGD
- Nieuwe upload van gewijzigd bestand wordt als nieuw opgeslagen

**Status:** ⏳ Te testen

---

### TC-018: Relatie tussen Uploads en Records
**Precondities:**
- Meerdere uploads met records

**Stappen:**
1. Verwijder 1 upload
2. Check of bijbehorende records ook verwijderd worden

**Verwacht resultaat:**
- Cascade delete werkt
- Alle records van deleted upload zijn weg
- Andere uploads/records blijven intact

**Status:** ⏳ Te testen

---

## Test Coverage Samenvatting

| Categorie | Aantal tests | Status |
|-----------|-------------|--------|
| Upload | 3 | ⏳ |
| Data weergave | 2 | ⏳ |
| Filters | 3 | ⏳ |
| Sortering | 2 | ⏳ |
| Grafieken | 3 | ⏳ |
| Authenticatie | 3 | ⏳ |
| Data integriteit | 2 | ⏳ |
| **TOTAAL** | **18** | **⏳** |

---

## Testomgeving

- **Browser**: Chrome/Firefox
- **Database**: SQLite (development)
- **Server**: Laravel dev server (php artisan serve)
- **Besturingssysteem**: Windows 10

---

## Opmerkingen

Dit testplan zal worden ingevuld naarmate de applicatie wordt gebouwd. Alle testcases moeten minimaal 1x slagen voordat release.
