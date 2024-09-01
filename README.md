# Sistem de Management Pacienți pentru Doctori

Acesta este un sistem simplu de management al pacienților pentru doctori, construit cu PHP, HTML și CSS. Acesta permite doctorilor să gestioneze informațiile pacienților într-un mod eficient.

## Funcționalități

- Autentificare utilizator (login/logout)
- Managementul pacienților (adăugare, editare, ștergere)
- Design responsive

## Cerințe

- PHP 7.4 sau mai recent
- MySQL sau SQLite
- Apache sau alt server web (de exemplu, XAMPP, WAMP)
- Composer (pentru managementul dependențelor, dacă este necesar)

## Instalare

### Pasul 1: Clonează Repositorul

Mai întâi, clonează acest repository pe calculatorul tău și navighează în directorul proiectului:

```bash
git clone https://github.com/valeriucojocari1998/DAW-Doctor_Patient_Management.git
cd DAW-Doctor_Patient_Management
```

### Pasul 2: Configurează Baza de Date

Trebuie să configurezi baza de date înainte de a rula aplicația.

#### Opțiunea 1: Utilizarea MySQL

1. **Creează o bază de date MySQL**:

   - Conectează-te la serverul tău MySQL și creează o bază de date:

   ```sql
   CREATE DATABASE doctor_patient_management;
   ```

2. **Configurează conexiunea la baza de date**:

   - Deschide fișierul `config/database.php` și actualizează credențialele bazei de date pentru a corespunde configurației tale MySQL:

   ```php
   $host = 'localhost';
   $db_name = 'doctor_patient_management';
   $username = 'nume_utilizator';
   $password = 'parola_ta';
   ```

3. **Rulează scriptul de inițializare a bazei de date**:
   - Execută următoarea comandă pentru a crea tabelele și a insera datele de probă:
   ```bash
   php scripts/init_db.php
   ```

#### Opțiunea 2: Utilizarea SQLite

1. **Configurează baza de date SQLite**:

   - Asigură-te că `config/database.php` este configurat pentru a utiliza SQLite și că calea bazei de date este setată corect:

2. **Rulează scriptul de inițializare a bazei de date**:
   - Execută următoarea comandă pentru a crea tabelele și a insera datele de probă:
   ```bash
   php scripts/init_db.php
   ```

### Pasul 3: Rulează Proiectul

Servește proiectul folosind metoda ta preferată:

#### Opțiunea 1: Utilizarea Serverului Built-in PHP

Poți folosi serverul built-in al PHP pentru a servi proiectul:

```bash
php -S localhost:8000 -t public
```

#### Opțiunea 2: Utilizarea Apache (de exemplu, XAMPP)

1. **Setează un host virtual** (opțional, dar recomandat) sau adaugă un proiect nou în XAMPP:

   - Setează document root-ul pentru a puncta la directorul `public` al proiectului tău.
   - Repornește Apache după configurare.

2. **Accesează proiectul** navigând la `http://localhost/DAW-Doctor_Patient_Management` sau la URL-ul hostului virtual în browserul tău.

### Pasul 4: Accesează Aplicația

Deschide browserul tău și navighează la URL-ul unde proiectul este servit. De exemplu:

```plaintext
http://localhost:8000
```

### Pasul 5: Autentificare

Folosește următoarele credențiale pentru a te autentifica în sistem:

```plaintext
Username: doctor1
Password: password
```

## Structura Proiectului

- **`config/`**: Conține fișierul de configurare a bazei de date.
- **`public/`**: Partea publică a aplicației, inclusiv `index.php` și alte resurse.
- **`scripts/`**: Conține scripturi precum `init_db.php` pentru configurarea bazei de date.
- **`views/`**: Conține fișierele de vizualizare, precum pagina de login, paginile de management al pacienților și partialele precum header și footer.

## Dezvoltare

Dacă dorești să faci modificări proiectului:

1. **Clonează repositorul**.
2. **Instalează dependențele** (dacă este aplicabil):

   ```bash
   composer install
   ```

3. **Rulează proiectul**.

## Rezolvarea Problemelor

- **Sesiuni**: Asigură-te că setările PHP pentru sesiuni sunt configurate corect dacă întâmpini probleme cu persistența autentificării.
- **Permisiuni**: Verifică dacă fișierul bazei de date (dacă folosești SQLite) și directoarele proiectului au permisiunile corecte de citire/scriere.

## Licență

Acest proiect este open-source și disponibil sub Licența MIT.
