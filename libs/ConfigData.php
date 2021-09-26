<?php

class ConfigData
{

    // Utils members
    const MAX_RESP_CONTR = 1;

    // Person members
    const MAX_RESP_TECH_CONTR = 1;
    CONST ALLOW_ALL = 0;
    CONST WORK_NORM = 8;
    public static $msLegal = array(
        '2010-01-01' => '01-01',
        '2010-01-02' => '02-01',
        '2010-04-05' => '05-04',
        '2010-05-01' => '01-05',
        '2010-05-24' => '24-05',
        '2010-12-01' => '01-12',
        '2010-12-25' => '25-12',
        '2010-12-26' => '26-12',
        '2011-01-01' => '01-01',
        '2011-01-02' => '02-01',
        '2011-04-24' => '24-04',
        '2011-04-25' => '25-04',
        '2011-05-01' => '01-05',
        '2011-06-12' => '12-06',
        '2011-06-13' => '13-06',
        '2011-08-15' => '15-08',
        '2011-12-01' => '01-12',
        '2011-12-25' => '25-12',
        '2011-12-26' => '26-12',
        '2012-01-01' => '01-01',
        '2012-01-02' => '02-01',
        '2012-04-15' => '15-04',
        '2012-04-16' => '16-04',
        '2012-05-01' => '01-05',
        '2012-06-03' => '03-06',
        '2012-06-04' => '04-06',
        '2012-08-15' => '15-08',
        '2012-11-30' => '30-11',
        '2012-12-01' => '01-12',
        '2012-12-25' => '25-12',
        '2012-12-26' => '26-12',

        '2013-01-01' => '01-01',
        '2013-01-02' => '02-01',
        '2013-05-01' => '01-05',
        '2013-05-05' => '05-05',//paste
        '2013-05-06' => '06-05',//paste
        '2013-06-23' => '23-06',//rusalii
        '2013-06-24' => '24-06',//rusalii
        '2013-08-15' => '15-08',
        '2013-11-30' => '30-11',
        '2013-12-01' => '01-12',
        '2013-12-25' => '25-12',
        '2013-12-26' => '26-12',

        '2014-01-01' => '01-01',
        '2014-01-02' => '02-01',
        '2014-05-01' => '01-05',
        '2014-04-20' => '20-04',//paste
        '2014-04-21' => '21-04',//paste
        '2014-06-08' => '08-06',//rusalii
        '2014-06-09' => '09-06',//rusalii
        '2014-08-15' => '15-08',
        '2014-11-30' => '30-11',
        '2014-12-01' => '01-12',
        '2014-12-25' => '25-12',
        '2014-12-26' => '26-12',

        '2015-01-01' => '01-01',
        '2015-01-02' => '02-01',
        '2015-05-01' => '01-05',
        '2015-04-12' => '12-04',//paste
        '2015-04-13' => '13-04',//paste
        '2015-05-31' => '31-05',//rusalii
        '2015-06-01' => '01-06',//rusalii
        '2015-08-15' => '15-08',
        '2015-11-30' => '30-11',
        '2015-12-01' => '01-12',
        '2015-12-25' => '25-12',
        '2015-12-26' => '26-12',

        '2016-01-01' => '01-01',
        '2016-01-02' => '02-01',
        '2016-01-24' => '24-01',
        '2016-05-01' => '01-05',//paste
        '2016-05-02' => '02-05',//paste
        '2016-06-19' => '19-06', //rusalii
        '2016-06-20' => '20-06', //rusalii
        '2016-08-15' => '15-08',
        '2016-11-30' => '30-11',
        '2016-12-01' => '01-12',
        '2016-12-25' => '25-12',
        '2016-12-26' => '26-12',

        '2017-01-01' => '01-01',
        '2017-01-02' => '02-01',
        '2017-01-24' => '24-01',
        '2017-04-16' => '16-04',//paste
        '2017-04-17' => '17-04',//paste
        '2017-05-01' => '01-05',
        '2017-06-04' => '04-06', //rusalii
        '2017-06-05' => '05-06', //rusalii
        '2017-08-15' => '15-08',
        '2017-11-30' => '30-11',
        '2017-12-01' => '01-12',
        '2017-12-25' => '25-12',
        '2017-12-26' => '26-12',

        '2018-01-01' => '01-01',
        '2018-01-02' => '02-01',
        '2018-01-24' => '24-01',
        '2018-04-08' => '08-04',//paste
        '2018-04-09' => '09-04',//paste
        '2018-05-01' => '01-05',
        '2018-05-27' => '27-05',//rusalii
        '2018-05-28' => '28-05', //rusalii
        '2018-06-01' => '01-06',
        '2018-08-15' => '15-08',
        '2018-11-30' => '30-11',
        '2018-12-01' => '01-12',
        '2018-12-25' => '25-12',
        '2018-12-26' => '26-12'
    );
    public static $PersonImportData = array();
    public static $PersonImportSalaryData = array();
    public static $msMaritalStatus = array(
        1 => 'Casatorit',
        2 => 'Necasatorit',
        3 => 'Vaduv',
        4 => 'Divortat',
    );
    public static $msStudies = array(
        1 => 'Scoala profesionala',
        2 => 'Liceu',
        7 => 'Scoala postliceala',
        3 => 'Facultate absolvent',
        8 => 'Facultate absolvent a 2-a facultate',
        4 => 'Facultate in curs',
        5 => 'Studii postuniversitare / master',
        9 => 'MBA',
        6 => 'Doctorat',
        10 => '10 clase',
        11 => 'Scoala generala',
        12 => 'Scoala primara',
        13 => 'Fara studii',
    );
    public static $msCVStatus = array(
        1 => 'CV citit',
        2 => 'CV selectat la interviu',
        3 => 'CV respins',
        4 => 'angajat',
        5 => 'CV StandBy',
        6 => 'Black listed',
        7 => 'Trimis la client',
        8 => 'Respins de client',
        9 => 'Respins la interviu',
    );
    public static $msCVSource = array(
//        'bestjobs' => 'BestJobs',
//        'ejobs' => 'eJobs',
//        'recomandare' => 'Recomandare',
//        'mail' => 'E-mail',
//        'head-hunting' => 'Head Hunting',
//        'phone calling' => 'Phone Calling',
//        'linkedin' => 'LinkedIn',
        'personal' => 'Adus personal',
        'registratura' => 'Registratura',
    );
    public static $msStatus = array(
        0 => '- alege -',
//        1 => 'Candidat',
        2 => 'Angajat',
//        9 => 'Angajat temporar',
//        12 => 'Angajat leasing',
//        3 => 'Consultant',
//        7 => 'Colaborator',
//        10 => 'Cursant',
//        11 => 'Aplicant',
//        5 => 'Disponibilizat',
        6 => 'Plecat',
//        8 => 'Importat',
    );
    public static $msCandidateStatus = array(
        1 => 'Candidat',
        2 => 'Candidat extern',
    );
    public static $msSubStatus = array(/*
								1 => array(
									1 => 'CV citit',
									2 => 'CV selectat la interviu',
									3 => 'CV respins',
									4 => 'angajat',
									5 => 'CV StandBy',
									6 => 'Black listed',
								),
							*/
//        2 => array(
//            1 => 'CM - direct - full time',
//            2 => 'CM - direct - part time',
//            3 => 'CM - indirect - full time',
//            4 => 'CM - indirect - part time',
//            5 => 'Functionar public'
//        ),
         2 => array(
             1 => 'Contract de munca',
             5 => 'Functionar public'
         ),
        3 => array(),
        4 => array(),
        5 => array(
            1 => 'Contactat',
            2 => 'Necontactat',
            3 => 'Acompaniat',
            4 => 'Nu doreste acompanierea',
            5 => 'Angajat deja in alta parte la data contactarii',
            6 => 'Repozitionat',
            7 => 'Pensionat',
            8 => 'Altele (deces, plecat in strainatate)',
        ),
        6 => array(
            1 => 'Cu acordul partilor',
            2 => 'Demisie',
            3 => 'Concediere',
            4 => 'Pensionare',
            5 => 'Expirat contract',
            6 => 'In perioada de proba',
            7 => 'Deces',
            8 => 'Decesul persoanei cu handicap grav',
            9 => 'De drept',
            10 => 'Desfacere disciplinara',
            11 => 'Transferat',
        ),
        7 => array(
            1 => 'Are contract de colaborare',
            2 => 'Nu are contract de colaborare',
        ),
        8 => array(),
        9 => array(
            1 => 'Concurs',
            2 => 'Mod direct',
            3 => 'Detasare',
            4 => 'Transfer',
            5 => 'Reincadrare',
        ),
        10 => array(
            1 => 'CIC pana la 2 ani',
            2 => 'CIC pana la 3 ani pentru copii cu handicap',
            3 => 'CIC pana la 7 ani pentru copii cu handicap',
            4 => 'Motive personale',
            5 => 'Expirare / Suspendare aviz',
            6 => 'Arest preventiv',
            7 => 'Concediu acomodare',
            8 => 'Intreruperea activitatii din motive economice, tehnologice, structurale sau similare',
        ),
    );
    public static $msHealthCompanies = array(
        1 => 'CASMB',
        2 => 'AOPSNAJ',
        3 => 'CASMTCT',
        4 => 'CAS Arad',
        5 => 'CAS Arges',
        6 => 'CAS Bihor',
        7 => 'CAS Bistrita-Nasaud',
        8 => 'CAS Botosani',
        9 => 'CAS Cluj',
        10 => 'CAS Constanta',
        11 => 'CAS Covasna',
        12 => 'CAS Dambovita',
        13 => 'CAS Dolj',
        14 => 'CAS Galati',
        15 => 'CAS Giurgiu',
        16 => 'CAS Harghita',
        17 => 'CAS Ialomita',
        18 => 'CAS Iasi',
        19 => 'CAS Ilfov',
        20 => 'CAS Maramures',
        21 => 'CAS Mehedinti',
        22 => 'CAS Mures',
        23 => 'CAS Neamt',
        24 => 'CAS Olt',
        25 => 'CAS Prahova',
        26 => 'CAS Salaj',
        27 => 'CAS Satu Mare',
        28 => 'CAS Sibiu',
        29 => 'CAS Suceava',
        30 => 'CAS Teleorman',
        31 => 'CAS Tulcea',
        32 => 'CAS Valcea',
        33 => 'CAS Vrancea',
        34 => 'CASJ Brasov',
        44 => 'CJAS Alba',
        35 => 'CJAS Bacau',
        36 => 'CJAS Braila',
        37 => 'CJAS Buzau',
        38 => 'CJAS Calarasi',
        39 => 'CJAS Caras-Severin',
        40 => 'CJAS Gorj',
        41 => 'CJAS Hunedoara',
        42 => 'CJAS Timis',
        43 => 'CJAS Vaslui',
    );
    public static $msQualify = array(
        1 => 'Bun',
        2 => 'Excelent',
        3 => 'Satisfacator',
        4 => 'Black Listed',
    );
    public static $msQuality = array(
        1 => 'Sot/Sotie',
        2 => 'Copil',
        3 => 'Altele',
    );
    public static $msLangLevel = array(
        1 => 'Incepator',
        2 => 'Mediu',
        3 => 'Avansat',
    );
    public static $msCEType = array(
        'Nastere copil' => 5,
        'Nastere si curs puericultura' => 15,
        'Casatorie salariat' => 5,
        'Casatorie copil' => 2,
        'Deces sot/copil/parinte/socru/bunic/frate/sora' => 3,
        //'Schimbare domiciliu'   => 5,
        'Donator sange' => 2,
    );
    public static $msCSType = array(
        'Concediu de studiu cu plata',
        'Concediu de studiu fara plata',
        'Concediu vechime firma - 1 zi',
        'Concediu zi onomastica - 1 zi',
    );
    public static $msReligion = array(
        1 => 'Crestinism - Ortodoxism',
        2 => 'Crestinism - Catolicism (Romano-Catolicism)',
        3 => 'Crestinism - Catolicism (Greco-Catolicism)',
        4 => 'Crestinism - Protestantism (Biserica Adventista de Ziua a Saptea)',
        5 => 'Crestinism - Protestantism (Biserica Baptista)',
        6 => 'Crestinism - Protestantism (Biserica Penticostala)',
        7 => 'Islam',
        8 => 'Hinduism',
        9 => 'Taoism',
        10 => 'Budism',
        11 => 'Sikhism',
        12 => 'Spiritism',
        13 => 'Iudaism',
        14 => 'Jainism',
        15 => 'Shintoism',
        16 => 'Zoroastrism',
    );
    public static $msLogType = array(
        1 => 'Payroll',
        2 => 'Functie COR',
        3 => 'Functie interna',
        4 => 'Contract',
        5 => 'Pontaj',
        6 => 'Autentificare',
        7 => 'Vizualizare pontaj ore',
    );
    // Company members
    public static $msGrupaSangvina = array('0' => '0', 'A' => 'A', 'B' => 'B', 'AB' => 'AB');
    // Activity members
    public static $msSangHR = array(1 => 'RH negativ', 2 => 'RH pozitiv');
    public static $msEducationalLevel = array(
        'A) Institutie de invatamant superior' => array(1 => 'licenta', 2 => 'master', 3 => 'doctorat', 4 => 'post-doctorat'),
        'B) Unitate de invatamant tertiar non-universitar' => array(5 => 'scoala post-liceala', 6 => 'scoala de maistri'),
        'C) Unitate de invatamant secundar' => array(
            'Invatamant secundar superior' => array(7 => 'ciclul superior al liceului'),
            'Invatamant secundar inferior' => array(8 => 'ciclul inferior al liceului', 9 => 'anul de completare', 10 => 'scoala de arte si meserii', 11 => 'ciclul gimnazial'),
            'Invatamant primar' => array(12 => 'invatamant primar'),
        ),
        'D) Fara scoala absolvita' => array(13 => 'fara scoala absolvita'),
    );
    public static $msCostTypes = array(
        'expense' => array(1 => 'Transport avion',
            2 => 'Transport taxi',
            3 => 'Transport altele',
            4 => 'Cazare',
            5 => 'Masa (restaurant)',
            11 => 'Masa servita cu partener',
            13 => 'Protocol',
            6 => 'Diurna',
            7 => 'Combustibil',
            8 => 'Servicii parcare',
            9 => 'Taxa intrare',
            10 => 'Taxe',
            12 => 'Inchiriere auto',
            14 => 'Materiale nestocate',
            15 => 'Altele',
        ),
        'subsistence' => array(1 => 'Avans spre decontare',
            2 => 'Avans in timpul deplasarii'),
    );
    public static $msCompanySituation = array(
        1 => 'Insolventa',
        2 => 'Faliment',
        3 => 'Situatie speciala',
    );
    public static $msActivityStatus = array(
        1 => 'Closed',
        2 => 'OnHold',
        3 => 'Signed',
        4 => 'ToDo',
        5 => 'Blacklisted',
    );
    // Budget members
    public static $msActivitySubject = array(
        1 => 'AI',
        2 => 'Web',
        3 => 'App',
        4 => 'HRE',
        5 => 'Hardware',
    );
    // Contract members (financial)
    public static $msCampaignStatus = array(
        1 => 'Planificata',
        2 => 'Activa',
        3 => 'Inactiva',
        4 => 'Finalizata',
    );
    // Contract members (technical)
    public static $msCampaignType = array(
        1 => 'Telesales',
        2 => 'eMail',
        3 => 'Telematrketing',
        4 => 'Web',
        4 => 'Radio',
        4 => 'Television',
        4 => 'Newsletter',
    );
    public static $msParticipationTypes = array(
        1 => 'Subantreprenor',
        2 => 'Antreprenor general',
        3 => 'Consultant',
    );
    public static $msBenefits = array(
        '1' => 'As. sanatate',
        '2' => 'As. viata',
        '3' => 'As. pensie',
        '4' => 'Bonuri masa',
        '5' => 'As. stomato.',
        '6' => 'Tichete cadou',
        '7' => 'Outplacement',
        '8' => 'Training',
        '9' => 'Cantina',
        '10' => 'Masina serviciu',
        '11' => 'Sportiv',
        '12' => 'Pensii facutative',
        '13' => 'Avantaj natura',
        //'14' => 'As. sanatate familie',
        //'15' => 'Sportiv',

    );
    public static $msContractStatus = array(
        1 => 'Planned',
        2 => 'In progress',
        3 => 'Done',
        4 => 'Postponed',
        5 => 'Canceled',
        6 => 'Abonament',
    );
    public static $msPaymentType = array(
        1 => 'Plata integrala',
        2 => 'Abonament lunar',
        3 => 'Abonament trimestrial',
        4 => 'Plata in rate',
    );


    // Event members
    public static $msTVA = array(9, 18, 24);
    public static $msGuaranteeType = array(
        1 => 'Scrisoare de garantie',
        2 => 'Bilet la ordin',
        3 => 'Fila CEC',
        4 => 'Asigurare',
        5 => 'Altele',
    );
    public static $msEventStatus = array(
        0 => 'neprogramata',
        1 => 'programata',
    );
    public static $msEventType = array(
        1 => 'nespecificat',
        2 => 'colectiva',
        3 => 'individuala',
        4 => 'telefonica',
        5 => 'interviu',
        6 => 'interviu colectiv',
    );

    // Job members
    public static $msEventRelation = array(
        1 => 'nespecificat',
        2 => 'companie - candidat',
        3 => 'companie - angajator',
        4 => 'companie - autoritate',
        5 => 'companie - disponibilizat',
    );
    public static $msInterviuQ = array(
        1 => 'Nesatisfacator',
        2 => 'Satisfacator',
        3 => 'Bun',
        4 => 'Foarte bun',
    );

    // News members
    public static $msExperience = array(
        1 => 'Fara experienta',
        2 => 'Sub 6 luni',
        3 => '6 luni - 1 an',
        4 => '1 - 3 ani',
        5 => '3 - 5 ani',
        6 => '5 - 10 ani',
        7 => 'Peste 10 ani',
    );
    // Newsletter members
    public static $msJobType = array(
        1 => 'Full time',
        2 => 'Part time',
        3 => 'Sezonier',
        4 => 'Proiect',
        5 => 'Voluntariat',
    );
    public static $msNewsTypes = array(
        1 => 'Anunturi',
        2 => 'Interne',
        3 => 'Media',
    );

    // PayRoll members
    public static $msNewsletterTypes = array(
        1 => 'Intern',
        2 => 'Extern',
    );
    public static $msNewsletterStatus = array(
        1 => 'Activ',
        2 => 'Inactiv',

    );
    public static $msLeaveReason = array(
        1 => 'demisie',
        2 => 'acord',
        3 => 'pensionat',
    );

    // Performance members
    public static $msEmployeeType = array(
        1 => 'direct',
        2 => 'indirect',
    );
    public static $msContractType = array(
        1 => 'Determinat',
        2 => 'Nedeterminat',
        3 => 'Suspendat',
    );

    // Pontaj members
    public static $msPerformanceStatus = array(
        1 => 'planned',
        // 2 => 'ongoing',
        3 => 'in progress',
        4 => 'done',
        5 => 'postponed',
        6 => 'canceled',
    );
    public static $msPerformanceCalif = array(
        1 => 'A demonstrat in mod consistent comportamente nepotrivite si negative',
        2 => 'A demonstrat ocazional comportamente nepotrivite si negative',
        3 => 'A demonstrat comportamente potrivite si pozitive',
        4 => 'A demonstrat ocazional competenta',
        5 => 'A demonstrat prezenta competentei in mod consistent si adecvat',
    );
    public static $msPhases = array(
        1 => 'PS',
        2 => 'PAC',
        3 => 'PT',
        4 => 'DDE',
        5 => 'AT',
        6 => 'EXP',
    );

    public static $msHoursType = array(
        'Norm' => 'Ore normale',
        'Spl' => 'Ore suplimentare',
        'SplW' => 'Ore weekend',
        'Night' => 'Ore noapte',
        'Disp' => 'Deplasari',
        'Recup' => 'Recuperare',
        'Inv' => 'Invoire',
        'X' => 'Zile din afara contractului de munca',
        'CO' => 'Concediu de odihna',
        'CE' => 'Concediu pentru evenimente familiale',
        'CFS' => 'Concediu fara salariu',
        'CIC' => 'Concediu de ingrijire copil',
        'CM' => 'Concediu medical',
        'Abs' => 'Absenta nemotivata',
        'T' => 'Somaj tehnic',
        'P' => 'Preaviz',
        'LP' => 'Liber Platit',
    );

    public static $msPontajTypes = array(
        1 => 'Ore lucrate',
        2 => 'Ore invoire',
        3 => 'Ore nemotivate',
        4 => 'Ore recuperare',
    );

    // Project members
    public static $msProjectTypes = array(
        1 => 'Oferta',
        2 => 'Contract',
        3 => 'Fara Contract',
        4 => 'Incheiat',
    );
    public static $msFinancialSources = array(
        1 => 'Privat',
        2 => 'Buget Stat',
        3 => 'Proiect EU',
    );

    // Training members
    public static $msTrainingStatus = array(
        1 => 'efectuat',
        2 => 'in curs',
        3 => 'programat',
    );
    public static $msTrainingFormType = array(
        1 => 'Cursant',
        2 => 'Trainer',

    );

    // Colleagues eval (feedback)
    public static $msFeedbackRelation = array(
        1 => 'Direct report',
        2 => 'Extern',
        3 => 'Manager',
        4 => 'Pair',
        5 => 'Supervisor',
    );

    // Surveys
    public static $msSurveyRelation = array(
        1 => 'Extern',
        2 => 'Intern',
    );

    // Car members
    public static $msCarTypes = array(
        1 => 'Berlina',
        2 => 'Break',
        3 => 'Autovehicul de teren',
        4 => 'Pick-up',
        5 => 'Cabrio',
        6 => 'Roadster',
        7 => 'Altele',
    );

    public static $msBrands = array(
        1 => 'Alta',
        2 => 'Alfa Romeo',
        3 => 'Audi',
        4 => 'BMW',
        5 => 'Chevrolet',
        6 => 'Chrysler',
        7 => 'Dacia',
        21 => 'Ford',
        8 => 'Honda',
        9 => 'Hyundai',
        10 => 'Mazda',
        11 => 'Mitsubishi',
        12 => 'Nissan',
        13 => 'Opel',
        14 => 'Renault',
        15 => 'Seat',
        16 => 'Skoda',
        17 => 'Subaru',
        18 => 'Suzuki',
        20 => 'Toyota',
        19 => 'Volkswagen',
    );

    public static $msFuels = array(
        1 => 'Benzina',
        2 => 'Motorina',
        3 => 'GPL',
        4 => 'Electric',
        5 => 'Hidrogen',
        6 => 'Hibrid',
    );

    public static $msGears = array(
        1 => 'Manuala',
        2 => 'Automata',
        3 => 'Semiautomata',
    );

    public static $msDoorsNo = array(
        1 => 'Doua sau trei',
        2 => 'Patru sau cinci',
        3 => 'Sase sau sapte',
    );

    public static $msOptions = array(
        1 => 'Geamuri electrice',
        2 => 'Inchidere centralizata',
        3 => 'Regulator de viteza',
        4 => 'Scaune de piele',
        5 => 'Scaune incalzite electric',
        6 => 'Senzori de parcare',
        7 => 'Servodirectie',
        8 => 'Sistem de incalzire auxiliar',
        9 => 'Sistem de navigare',
        10 => 'Trapa decapotabila',
    );

    public static $msScopes = array(
        1 => 'Scop deplasare',
    );

    public static $msCostGroups = array(
        1 => 'Asigurare',
        4 => 'Combustibil',
        5 => 'Piese',
        3 => 'Altele',
    );

    // Tickets members
    public static $msTicketType = array(
        1 => 'Adeverinte',
        2 => 'Servicii',
        3 => 'Diverse',
    );
    public static $msTicketServices = array(
        11 => 'Coaching',
        12 => 'Training',
        13 => 'Altele',
    );
    public static $msTicketStatus = array(
        1 => 'Finalizat',
        2 => 'In lucru',
        3 => 'Nou',
        4 => 'Renuntat',
    );

    // Ticketing members
    public static $msTicketingStatus = array(
        1 => 'Nou',
        2 => 'Asignat',
        3 => 'Confirmat',
        4 => 'In lucru',
        5 => 'Rezolvat',
        6 => 'Anulat',
        7 => 'On hold',
    );
    public static $msTicketingType = array(
        11 => 'HR - Recrutare',
        12 => 'HR - Fisa post',
        2 => 'AI - Dezvoltare',
        10 => 'AI - Estimare',
        1 => 'Software - Dezvoltare',
        //6 => 'Software - SEO',
        9 => 'Software - Estimare',
        5 => 'HR Executive - Dezvoltare',
        7 => 'HR Executive - Bug',
        8 => 'Hardware',
        3 => 'Transport',
        4 => 'Altele',
    );
    public static $msTicketingPriority = array(
        1 => 'High',
        2 => 'Medium',
        3 => 'Low',
    );
    public static $msTicketingImportance = array(
        1 => 'High',
        2 => 'Medium',
        3 => 'Low',
    );
    public static $msTicketingInterventionType = array(
        1 => 'OnSite',
        2 => 'Remote',
    );
    public static $msTicketingCategories = array();
    public static $msCurrencies = array(
        1 => 'RON',
        2 => 'USD',
        3 => 'EUR',
    );
    public static $msCurrenciesType = array(
        1 => 'Minim',
        2 => 'Mediu',
        3 => 'Maxim',
    );
    public static $msVatValues = array(
        1 => '24%',
        2 => '9%',
        3 => '19%',
    );
    public static $msDaysValues = array(
        0 => 'Duminica',
        1 => 'Luni',
        2 => 'Marti',
        3 => 'Miercuri',
        4 => 'Joi',
        5 => 'Vineri',
        6 => 'Sambata',
    );
    public static $msMonthValues = array(
        1 => 'Ianuarie',
        2 => 'Februarie',
        3 => 'Martie',
        4 => 'Aprilie',
        5 => 'Mai',
        6 => 'Iunie',
        7 => 'Iulie',
        8 => 'August',
        9 => 'Septembrie',
        10 => 'Octombrie',
        11 => 'Noiembrie',
        12 => 'Decembrie'
    );
    public static $msSalaryType = array(
        1 => 'Salariu brut',
        2 => 'Salariu net',
    );
    public static $msInventarCategories = array(
        1 => 'Laptop',
        2 => 'Telefon',
        3 => 'Altele',
    );
    public $msTicketingCategoriesDefaults = array(
        0 => 'none',
        1 => 'manager',
        2 => 'autoalocare',
        3 => 'persoana definita'
    );
    public static $normType = array(
        1 => 'norma intreaga',
        2 => 'timp partial',
    );
    public static $workLength = array(
        1 => '8/40',
        2 => '6/30',
        3 => 'legi speciale',
    );
    public static $workTime = array(
        1 => 'ore de zi',
        2 => 'ore de noapte',
        3 => 'inegal',
    );
    public static $workPrg = array(
        1 => '8 ore zi',
        2 => '12 / 36 ore zi',
        3 => '12 / 36 ore zi / noapte',
        4 => '12 / 24 - 12 / 48',
        5 => 'inegal',
        6 => 'munca la domiciliu',
    );
    public static $cmDoc = array(
        1 => 'CM',
        2 => 'adeverinta vechime',
        3 => 'raport REVISAL',
        4 => 'adeverinta somaj',
        5 => 'adeverinta CIC',
    );
    public static $transeVechime = array(
        1 => 'gradatia 0 (0 - 3ani)',
        2 => 'gradatia 1 (3 - 5 ani)',
        3 => 'gradatia 2 (5 - 10 ani)',
        4 => 'gradatia 3 (10 - 15 ani)',
        5 => 'gradatia 4 (15 - 20 ani)',
        6 => 'gradatia 5 (peste 20 ani)',
    );
    public static $sporuri = array(
        1 => array(15, 'Spor pentru condiţii periculoase sau vătămătoare'),
        2 => array(75, 'Spor pentru condiţii deosebit de periculoase 75'),
        3 => array(50, 'Spor pentru condiţii deosebit de periculoase 50'),
        4 => array(15, 'Spor pentru condiţii deosebite (stres sau risc)'),
        5 => array(15, 'Spor de tură'),
        6 => array(15, 'Spor pentru persoană cu handicap'),
        7 => array(50, 'Spor pentru conditii deosebit de periculoase pentru plasament copil cu handicap grav psihic sau mintal'),
        8 => array(25, 'Spor pentru conditii deosebit de periculoase pentru plasament copil cu handicap'),
        9 => array(15, 'Spor pentru conditii deosebite (stres sau risc)  pentru al doilea copil primit în plasament'),
        10 => array(7.5, 'Spor pentru asigurarea continuităţii în muncă'),
    );

    public static $funcStud = array(
        1 => 'S',
        2 => 'SSD',
        3 => 'M',
        4 => 'M;G',
        5 => 'PL',
        6 => 'G',
    );

    public static $gradTreapta = array(
        1 => 'I',
        2 => 'II',
        3 => 'III',
        4 => 'IV',
        5 => 'IA',
        6 => 'superior',
        7 => 'principal',
        8 => 'asistent',
        9 => 'debutant',
    );

    public static $tipFunctie = array(
        1 => 'publica',
        2 => 'contractuala',
    );

    public static $sarbatori = array(
        'Sf. Ion' => 'Sf. Ion',
        'Sf. Maria' => 'Sf. Maria',
        'Sf. Constantin si Elena' => 'Sf. Constantin si Elena',
        'Sf. Mihail si Gavriil' => 'Sf. Mihail si Gavriil',
        'Sf. Nicolae' => 'Sf. Nicolae',
        'Sf. Dumitru' => 'Sf. Dumitru',
        'Sf. Andrei' => 'Sf. Andrei',
        'Sf. Gheorghe' => 'Sf. Gheorghe',
        'Sf. Vasile' => 'Sf. Vasile',
        'Sf. Ilie' => 'Sf. Ilie',
        'Sf. Stefan' => 'Sf. Stefan',
        'Sf. Petru si Pavel' => 'Sf. Petru si Pavel',
        'Craciun' => 'Craciun',
        'Florii' => 'Florii',
    );

    public static $etica = array(
        1 => "personal contractual de conducere",
        2 => "personal contractual de executie",
        3 => "functie publica de conducere",
        4 => "functie publica de executie",
        5 => "asistenti maternali",
        6 => "asistenti personali",
        7 => "alte categorii studenti / condamnati",
    );

    public function __construct()
    {
        global $conn;
        $conn->query("select `id`, `category_name` from `ticketing_categories` order by `id` ASC");
        while ($row = $conn->fetch_array()) {
            self::$msTicketingCategories[$row['id']] = $row['category_name'];
        }
        //self::msTicketingCategoriesDefaults;
    }

}

?>