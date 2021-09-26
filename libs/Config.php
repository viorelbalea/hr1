<?php

class Config
{
    const VERSION = '3.2';

    const COMPANY_SELF_NO = 2;

    const COMPANY_NAME = 'DGASPC';

    const ADMIN_EMAIL = 'viorel.balea@gmail.com';

    const MYSQL_HOST = 'localhost';
    const MYSQL_USER = 'dgaspc';
    const MYSQL_PASS = '2IJBzaJLTJy6D17b';
    const MYSQL_DBNAME = 'dgaspc';

    const MSSQL_HOST = '';
    const MSSQL_USER = '';
    const MSSQL_PASS = '';
    const MSSQL_DBNAME = '';


    const SMTP_HOST = 'mail.social2.ro';
    const SMTP_AUTH = true;
    const SMTP_EMAIL = 'server.sru@social2.ro';
    const SMTP_USER = 'server.sru@social2.ro';
    const SMTP_PASS = '3icpxm8g6onhe9zq';
    const SMTP_PORT = 465;    // 25 normal, 465 for google mail
    const SMTP_SECURITY = "ssl";    // can be ssl, tls (for google mail) or blank
    /**/

    const SRV_URL = 'http://localhost/hr/';
    const SRV_PATH = '/';
    const IMG_CACHE_PATH = 'photos/_tmp/';
    const IMG_CACHE_URL = 'http://localhost/hr/photos/_tmp/';

    const LICENSE_KEY = 'VE00-HE0A-HA0A-0CA0';
    const SUPPORT_EMAIL = 'support.hre@kate.ro';
    const CHG_PW_MONTH_FREQ = 999;

    const ENCRYPTION_KEY = 'kate!@#';

    const CATERING_FREE = 1;
    const CATERING_FREE_SUBDEPARTMENTID = 1;
    const CATERING_FREE_CATEG = 1;
    const CATERING_FREE_ITEM = 1;
    const CATERING_SEMIFREE_CATEG = 2;

    const PONTAJ_IMPORT_FILE_PATH = 'pontaj-import/';

    const ETICHETA = 'HR Executive';

    public static $msAppLng = 'ro';

    public static $msAppTheme = 'style2.css';

    public static $msCurrency = 'RON'; // possibile values: RON,EUR,USD

    public static $msAppModules = array(
        1 => array(
//                    38 => 'dashboard',
            1 => 'persons',
            31 => 'functions',
            2 => 'companies',
            3 => 'jobs',
            4 => 'events',
            5 => 'training',
            22 => 'budgets',
            23 => 'projects',
            11 => 'pontaj',
            29 => 'tickets',
            30 => 'ticketing',
            10 => 'library',
            7 => 'reports',
            33 => 'reports_maker',
            6 => 'settings',
            20 => 'dictionary',
        ),
        2 => array(
            38 => 'dashboard',
            1 => 'persons',
            9 => 'performance',
            8 => 'eval',
            25 => 'colleagues-eval',
            28 => 'surveys',
            7 => 'reports',
            6 => 'settings',
            20 => 'dictionary',
        ),
        3 => array(
            38 => 'dashboard',
            //1  => 'persons',
            2 => 'companies',
            3 => 'jobs',
            21 => 'contract',
            14 => 'sales',
            37 => 'products',
            4 => 'events',
            27 => 'cars',
            26 => 'newsletters',
            10 => 'library',
            6 => 'settings',
            20 => 'dictionary',
        ),
        4 => array(
            38 => 'dashboard',
            1 => 'persons',
            3 => 'jobs',
            23 => 'projects',
            11 => 'pontaj',
            4 => 'events',
            29 => 'tickets',
            //30 => 'ticketing',
            10 => 'library',
            24 => 'forum',
            12 => 'news',
            34 => 'catering',
            6 => 'settings',
        ),
        5 => array(
            38 => 'dashboard',
            1 => 'persons',
            13 => 'candidates',
            32 => 'candidates-eval',
            2 => 'companies',
            21 => 'contract',
            3 => 'jobs',
            4 => 'events',
            //30 => 'ticketing',
            23 => 'projects',
            11 => 'pontaj',
            10 => 'library',
            7 => 'reports',
            6 => 'settings',
            20 => 'dictionary',
        ),
        6 => array(
            38 => 'dashboard',
            1 => 'persons',
            2 => 'companies',
            //21 => 'contract',
            27 => 'cars',
            35 => 'cars_cost',
            36 => 'cars_sheet',
            //30 => 'ticketing',
            10 => 'library',
            6 => 'settings',
            20 => 'dictionary',
        ),
        7 => array(
            38 => 'dashboard',
            1 => 'persons',
            2 => 'companies',
            21 => 'contract',
            //30 => 'ticketing',
            23 => 'projects',
            10 => 'library',
            6 => 'settings',
            20 => 'dictionary',

        ),
    );

    public static $msResPerPages = array(10, 20, 30, 50, 100, 500);
    public static $msResPerPage = 100;
    public static $msResPageGroup = 5;

    public static $msWeekDays = array(
        'Monday' => 'Luni',
        'Tuesday' => 'Marti',
        'Wednesday' => 'Miercuri',
        'Thursday' => 'Joi',
        'Friday' => 'Vineri',
        'Saturday' => 'Sambata',
        'Sunday' => 'Duminica',
    );

    public static $msLangs = array(
        'ro' => 'Romana',
        'en' => 'Engleza',
        'fr' => 'Franceza',
        'de' => 'Germana',
        'tr' => 'Turca',
        'gr' => 'Greaca',
        'ru' => 'Rusa',
    );

    public static $msAllowedModulesNotLogged = array(
        'candidates-eval'
    );

    public static $msAllowedOperationsNotLogged = array(
        'eval'
    );
}

?>