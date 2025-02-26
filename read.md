Estructura:

/projecte-cromos/
│── /css/                  # Estils CSS
│── /js/                   # Fitxers JavaScript (si cal)
│── /includes/             # Fitxers PHP reutilitzables (connexió DB, capçalera, menú)
│   ├── db.php             # Connexió a MySQL
│   ├── header.php         # Capçalera HTML
│   ├── footer.php         # Peu de pàgina HTML
│   ├── navbar.php         # Menú de navegació
│── /pages/                # Pàgines PHP
│   ├── index.php          # Llistat de futbolistes
│   ├── add_player.php     # Afegir futbolista
│   ├── edit_player.php    # Editar futbolista
│   ├── delete_player.php  # Esborrar futbolista
│── /db/                   # Scripts SQL
│   ├── database.sql       # Estructura de la base de dades
│── config.php             # Configuració global
│── styles.css             # Fitxer CSS principal
│── index.php              # Entrada principal de la web


https://www.thesportsdb.com/free_sports_api