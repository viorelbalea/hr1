<?php

class Message
{

    public static $msAppAreasRO = array(
        1 => 'Resurse Umane',
        5 => 'Recrutare',
        2 => 'Performanta',
        3 => 'CRM',
        4 => 'Self Service',
        6 => 'Fleet Management',
        //7 => 'Ticketing',
    );

    public static $msAppModulesRO = array(
        1 => 'Personal',
        2 => 'Companii/Institutii',
        21 => 'Contracte',
        3 => 'Concursuri',
        4 => 'Intalniri',
        5 => 'Training',
        22 => 'Bugete',
        8 => 'Evaluari',
        25 => 'Feedback',
        9 => 'Obiective',
        23 => 'Proiecte',
        11 => 'Pontaj',
        26 => 'Newslettere',
        28 => 'Studii',
        24 => 'Forum',
        10 => 'Biblioteca',
        6 => 'Setari',
        7 => 'Rapoarte',
        12 => 'Stiri',
        14 => 'Vanzari',
        20 => 'Dictionare',
        27 => 'Masini',
        29 => 'Cereri',
        30 => 'Tichete',
        31 => 'Organigrama',
        13 => 'Candidati',
        32 => 'Evaluari candidati',
        33 => 'Generator rapoarte',
        34 => 'Catering',
        35 => 'Cheltuieli auto',
        36 => 'Foi de parcurs',
        37 => 'Produse',
        38 => 'Dashboard',
    );
    //They appear in the Administrare->Utilizator but not in the top menu bar
    public static $msAppModulesHiddenRO = array();

    public static $msAppModulesEN = array(
        1 => 'Persons',
        2 => 'Companies',
        21 => 'Contracte',
        3 => 'Concursuri',
        4 => 'Events',
        5 => 'Training',
        22 => 'Budgets',
        8 => 'Evaluations',
        25 => 'Feedback',
        9 => 'Performance',
        11 => 'Pontaj',
        26 => 'Newsletters',
        28 => 'Surveys',
        24 => 'Forum',
        10 => 'Library',
        6 => 'Settings',
        7 => 'Reports',
        12 => 'News',
        14 => 'Sales',
        20 => 'Dictionaries',
        27 => 'Cars',
        29 => 'Tickets',
        31 => 'Organigram',
        13 => 'Candidates',
    );
    //They appear in the Administrare->Utilizator but not in the top menu bar
    public static $msAppModulesHiddenEN = array(

        15 => 'Sales activities',
        16 => 'Sales dailies',
    );

    public static $msMessagesRO = array(
        'ACCESS_FORBIDDEN' => 'Acces restrictionat',
        'USERNAME_EMPTY' => 'Nu ati introdus username',
        'PASSWORD_EMPTY' => 'Nu ati introdus parola',
        'AUTH_ERROR' => 'Autentificare esuata',
        'PASSWORD_ERROR' => 'Parola gresita',
        'PASSWORD_RETYPE_ERROR' => 'Parola rescrisa gresit',
        'PASSWORD_FORMAT_ERROR' => 'Parola incorecta: trebuie sa contina caractere alfabetice, caps si cifre (minim 8 caractere)',
        'FULLNAME_EMPTY' => 'Nu ati introdus nume si prenume',
        'LASTNAME_EMPTY' => 'Nu ati introdus nume',
        'FIRSTNAME_EMPTY' => 'Nu ati introdus prenume',
        'CNP_ERROR' => 'CNP-ul nu este introdus corect',
        'BINUMBER_ERROR' => 'Numarul BI nu este introdus corect',
        'BISERIE_EMPTY' => 'Completati Seria BI',
        'DISTRICT_EMPTY' => 'Alegeti judetul',
        'CITY_EMPTY' => 'Alegeti localitatea',
        'STREETCODE_EMPTY' => 'Completati codul postal',
        'STREETNAME_EMPTY' => 'Completati strada',
        'STREETNO_EMPTY' => 'Completati numarul strazii',
        'MOBILE_EMPTY' => 'Completati mobilul',
        'EMAIL_ERROR' => 'Email-ul nu estpe introdus corect',
        'MARITAL_EMPTY' => 'Alegeti starea civila',
        'NO_SUCH_PERSON' => 'Acces restrictionat la datele acestei persoane',
        'DUPLICATE_CNP' => 'Exista o persoana in baza de date cu acest CNP',
        'PROF_EMPTY' => 'Specificati titulatura postului',
        'STUDIES_EMPTY' => 'Alegeti pregatirea',
        'PHOTO_ERROR_TYPE' => 'Poza nu este .jpg sau .gif',
        'PHOTO_ERROR_UPLOAD' => 'Poza nu a fost incarcata',
        'COMPANYNAME_EMPTY' => 'Nu ati introdus numele companiei',
        'COMPANYSELF_LIMIT' => 'Nu mai puteti introduce companii self',
        'COMPANYDOMAIN_EMPTY' => 'Nu ati introdus domeniul de activitate',
        'CIF_EMPTY' => 'Nu ati introdus CIF-ul',
        'REGCOMERT_EMPTY' => 'Nu ati introdus Nr. Registrul comertului',
        'PHONE_EMPTY' => 'Nu ati completat numarul de telefon',
        'DUPLICATE_CIF' => 'Exista o companie in baza de date cu acest CIF sau Nume',
        'NO_SUCH_COMPANY' => 'Acces restrictionat la datele acestei companii',
        'JOBTITLE_EMPTY' => 'Nu ati introdus Denumire concurs',
        'JOBDESCRIPTION_EMPTY' => 'Nu ati introdus Descriere',
        'DOMAIN_EMPTY' => 'Nu ati ales Domeniu',
        'EXPERIENCE_EMPTY' => 'Nu ati ales Experienta',
        'JOBTYPE_EMPTY' => 'Nu ati ales Tip concurs',
        'STARTDATE_EMPTY' => 'Nu ati ales Data de inceput',
        'STOPDATE_EMPTY' => 'Nu ati introdus Data de sfarsit',
        'NO_SUCH_JOB' => 'Acces restrictionat la datele acestui concurs',
        'TRAINING_TYPE_EMPTY' => 'Nu ati ales tipul de training',
        'TRAININGNAME_EMPTY' => 'Nu ati introdus denumirea trainingului',
        'TRAININGDESCR_EMPTY' => 'Nu ati introdus specializarea trainingului',
        'CONSULTANT_EMPTY' => 'Nu ati introdus reprezentant companie ',
        'TRAININGSTATUS_EMPTY' => 'Nu ati introdus statusul trainingului',
        'NO_SUCH_TRAINING' => 'Acces restrictionat la datele acestui training',
        'NO_SEL_TRAINING' => 'Nu ati selectat trainingul',
        'ROOM_EMPTY' => 'Nu ati selectat locatia',
        'NO_SUCH_EVENT' => 'Acces restrictionat la datele acestui eveniment',
        'EMPLOYEETYPE_ERROR' => 'Nu ati ales tipul de angajat',
        'TRAINER_EMPTY' => 'Nu ati introdus trainer',
        'HOUR_ERROR' => 'Interval orar necorespunzator',
        'EVENTDATA_EMPTY' => 'Nu ati specificat data evenimentului',
        'SCOPE_EMPTY' => 'Nu ati completat campul Scop',
        'INVALIDE_LICENSE' => 'Licenta invalida',
        'DUPLICATE_PERSON' => 'Exista un angajat cu acest username',
        'DUPLICATE_DIM' => 'Exista o dimensiune cu aceasta denumire',
        'DUPLICATE_DIV' => 'Exista o divizie cu acest nume',
        'DUPLICATE_DEP' => 'Exista un departament cu acest nume',
        'DUPLICATE_COST' => 'Exista un centru de cost cu acest nume',
        'DUPLICATE_DOM' => 'Exista un domeniu cu acest nume',
        'DUPLICATE_FUNC' => 'Exista o functie cu acest nume',
        'DUPLICATE_SITE' => 'Exista o locatie cu acest nume',
        'DUPLICATE_ROOM' => 'Exista o sala cu acest nume',
        'DUPLICATE_PROF' => 'Exista o profesie cu acest nume',
        'DUPLICATE_DOM' => 'Exista un domeniu cu acest nume',
        'DUPLICATE_CAT' => 'Exista o categorie cu acest nume',
        'DUPLICATE_QUESTION' => 'Exista o intrebare cu acest nume',
        'DUPLICATE_SUBJ_COMPANY' => 'Exista o asociere de firma, subiect si status',
        'DUPLICATE_SUBJECT' => 'Exista un subiect cu aceasta denumire',
        'DOC_CAT_EMPTY' => 'Nu ati selectat categoria',
        'DOC_CODE_EMPTY' => 'Nu ati introdus cod document',
        'DOC_NAME_EMPTY' => 'Nu ati introdus nume document',
        'DOC_VERSION_EMPTY' => 'Nu ati introdus versiunea',
        'DOC_DESCR_EMPTY' => 'Nu ati introdus descrierea',
        'DOC_TAGS_EMPTY' => 'Nu ati introdus tag-urile asociate documentului',
        'DOC_UPLOAD_ERROR' => 'Eroare salvare document',
        'DOC_SIZE_ERROR' => 'Dimensiune document mai mare de 2MB',
        'DOC_EMPTY' => 'Nu a fost incarcat document',
        'DOC_DUPLICATE' => 'Exista un document cu aceeasi denumire',
        'NO_SUCH_DOC' => 'Nu puteti accesa acest document',
        'NO_SUCH_PROJECT' => 'Nu exista acest proiect',
        'PHASE_EMPTY' => 'Nu a fost introdusa faza',
        'PHASE_DUPLICATE' => 'Exista o faza cu aceeasi denumire',
        'PROJECT_NAME_DPK' => 'Exista un proiect cu aceasta denumire',
        'PROJECT_CODE_DPK' => 'Exista un proiect cu acest cod',
        'NEWS_TITLE_EMPTY' => 'Nu ati introdus titlu stire',
        'NEWS_CONTENT_EMPTY' => 'Nu ati introdus continut stire',
        'NO_SUCH_NEWS' => 'Nu exista aceasta stire',
        'NO_SUCH_ACTIVITY' => 'Acces restrictionat la datele acestei activitati',
        'NO_SUCH_DAILY' => 'Nu exista aceasta activitate zilnica',
        'COMPANY_EMPTY' => 'Nu ati selectat numele companiei',
        'CONTACT_EMPTY' => 'Nu ati selectat persoana de contact',
        'NO_SUCH_DAILY_DATES' => 'Nu exista date pentru rapoarte daily',
        'NO_SUCH_DICTIONARY' => 'Acces restrictionat la acest dictionar',
        'NO_SUCH_EVAL_FORM' => 'Nu exista acest formular de evaluare',
        'NO_SEL_PERSON' => 'Nu ati selectat persoana/ persoanele',
        'NO_SUCH_EVAL_FORM_NAME' => 'Nu ati introdus numele formularului',
        'SELECT_EVAL_SECTION' => 'Nu ati selectat sectiunea de evaluare',
        'QUESTION_EMPTY' => 'Nu ati introdus criteriul de evaluare',
        'PONDERE_EMPTY' => 'Nu ati introdus ponderea criteriul de evaluare',
        'CONTRACTNAME_EMPTY' => 'Nu ati introdus nume contract',
        'CONTRACTTYPE_EMPTY' => 'Nu ati specificat tip contract',
        'CONTRACTCOMPANY_EMPTY' => 'Nu ati specificat compania self',
        'CONTRACTPARTNER_EMPTY' => 'Nu ati specificat partener',
        'CONTRACTNO_EMPTY' => 'Nu ati specificat numar contract',
        'CONTRACTSIGNDATE_EMPTY' => 'Nu ati specificat data semnarii',
        'CONTRACTSTARTDATE_EMPTY' => 'Nu ati specificat data inceput',
        'CONTRACTSTOPDATE_EMPTY' => 'Nu ati specificat data sfarsit',
        'CONTRACTSTATUS_EMPTY' => 'Nu ati specificat stare contract',
        'NO_SUCH_CONTRACT' => 'Acces restrictionat la datele acestui contract',
        'NO_SUCH_CAMPAIGN' => 'Acces restrictionat la datele acestei campanii',
        'XLS_FULLNAME_EMPTY' => 'Nu exista numele introdus pentru cel putin una din inregistrari <br>Va rugam verificati fisierul si reincarcati din nou',
        'XLS_EMAIL_ERROR' => 'Adresa de e-mail nu este introdusa corect pentru cel putin una din inregistrari <br>Va rugam verificati fisierul si reincarcati din nou',
        'XLS_ERROR_TYPE' => 'Fisierul nu este in format .xls',
        'XLS_ERROR_UPLOAD' => 'Fisierul nu a fost incarcat',
        'THREADNAME_EMPTY' => 'Nu ati specificat numele discutiei',
        'NO_SUCH_THREAD' => 'Nu exista aceasta discutie',
        'POSTTEXT_EMPTY' => 'Nu ati introdus comentariul',
        'NO_SEL_EVALUATOR' => 'Nu ati selectat evaluatorul',
        'NEWSLETTER_TITLE_EMPTY' => 'Nu ati introdus titlu stire',
        'NEWSLETTER_CONTENT_EMPTY' => 'Nu ati introdus continut stire',
        'NEWSLETTER_FROM_EMPTY' => 'Nu ati introdus nume expeditor',
        'NEWSLETTER_EMAIL_EMPTY' => 'Nu ati introdus e-mail expeditor',
        'NEWSLETTER_CAMPAIGN_EMPTY' => 'Nu ati introdus nume campanie',
        'TICKET_REPORT_EMPTY' => 'Nu ati selectat cererea',
        'TICKET_STATUS_EMPTY' => 'Nu ati selectat statusul',
        'TICKET_LDATE_EMPTY' => 'Nu ati selectat data limita',
        'NO_SUCH_CAR_SHEET' => 'Nu exista aceasta foaie de parcurs',
        'NO_SUCH_CAR_COST' => 'Nu exista aceasta cheltuiala',
        'TELEFON_INVENTAR_DEJA_ALOCAT' => 'Numarul de telefon este deja alocat persoanei: ',
    );

    public static $msMessagesEN = array();

    public static function getAppModules()
    {
        switch (Config::$msAppLng) {
            case 'ro':
                return self::$msAppModulesRO;
                break;
            case 'en':
                return self::$msAppModulesEN;
                break;
        }
    }

    public static function getAppModulesHidden()
    {
        switch (Config::$msAppLng) {
            case 'ro':
                return self::$msAppModulesHiddenRO;
                break;
            case 'en':
                return self::$msAppModulesHiddenEN;
                break;
        }
    }

    public static function getMessage($indexError)
    {
        switch (Config::$msAppLng) {
            case 'ro':
                return self::$msMessagesRO[$indexError];
                break;
            case 'en':
                return self::$msMessagesEN[$indexError];
                break;
        }
    }

}

?>