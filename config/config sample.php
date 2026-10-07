<?php
    
    // En fonction des routes utilisées, il est possible d'avoir besoin de la session ; on la démarre dans tous les cas. 
    session_start();

    // Ici on met les constantes utiles, 
    // les données de connexions à la bdd
    // et tout ce qui sert à configurer. 

    /* Paths */
    define('ROOT', __DIR__ . '/../');
    define('VIEW_PATH', ROOT . 'views/');
    define('PARTIALS_PATH', VIEW_PATH . 'partials/');
    define('BASE_URL', '/projet-6-tomtroc/');

    /* DB */
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'tomtroc');
    define('DB_USER', 'YOUR_DB_USER');
    define('DB_PASS', 'YOUR_DB_PASSWORD');