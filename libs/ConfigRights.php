<?php

class ConfigRights
{
    public static $msRightsLevel2 = array(
        1 => array(
            1 => array('type' => 'list', 'name' => 'Personal'),
            2 => array('o' => 'new', 'name' => 'Adauga persoana'),
            4 => array('o' => 'vacation_recalc', 'name' => 'Recalculare concedii'),
            5 => array('o' => 'export_revisal', 'name' => 'Export Revisal'),
            6 => array('o' => 'filtre_personal', 'name' => 'Filtre Personal'),
            7 => array('o' => 'matching_persons', 'name' => 'Potrivire persoane'),
        ),
        2 => array(
            1 => array('type' => 'list', 'name' => 'Companii'),
            2 => array('o' => 'contacts', 'name' => 'Contacte'),
            3 => array('o' => 'new', 'name' => 'Adauga companie'),
        ),
        3 => array(
            1 => array('type' => 'list', 'name' => 'Concursuri'),
            2 => array('o' => 'new', 'name' => 'Adauga concurs'),
        ),
        4 => array(
            1 => array('type' => 'list', 'name' => 'Lista intalniri'),
            2 => array('o' => 'new', 'name' => 'Adauga intalnire'),
            4 => array('type' => 'list', 'o' => 'interview', 'name' => 'Interviuri'),
            5 => array('o' => 'new_interview', 'name' => 'Adauga interviu'),
            3 => array('o' => 'planif', 'name' => 'Planificator intalniri'),
        ),
        14 => array(
            1 => array('type' => 'list', 'o' => 'activities', 'name' => 'Lista activitati'),
            2 => array('o' => 'new_activity', 'name' => 'Adauga activitate'),
            /* NOU !!! */
            8 => array('o' => 'planif', 'name' => 'Planificator activitati'),
            7 => array('type' => 'list', 'o' => 'tender', 'name' => 'Ofertare'),
            3 => array('type' => 'list', 'o' => 'campaigns', 'name' => 'Campanii'),
            4 => array('o' => 'new_campaign', 'name' => 'Adauga campanie'),
            5 => array('type' => 'list', 'o' => 'dailies', 'name' => 'Lista rapoarte zilnice'),
            6 => array('o' => 'new_daily', 'name' => 'Adauga raport zilnic'),
        ),
        5 => array(
            1 => array('type' => 'list', 'name' => 'Lista traininguri'),
            2 => array('o' => 'companies', 'name' => 'Companii training'),
            3 => array('o' => 'new', 'name' => 'Adauga training'),
            4 => array('o' => 'formsDraft', 'name' => 'Formulare feedback'),
            5 => array('o' => 'evalDraft&action=new', 'name' => 'Adauga formular feedback'),
            6 => array('o' => 'formsTrainer', 'name' => 'Evaluari traineri'),
            7 => array('o' => 'formsTrainee', 'name' => 'Evaluari cursanti'),
        ),
        8 => array(
            1 => array('type' => 'list', 'name' => 'Evaluari angajati'),
        ),
        9 => array(
            1 => array('type' => 'list', 'name' => 'Obiective'),
        ),
        25 => array(
            1 => array('type' => 'list', 'name' => 'Feedback colegi'),
        ),
        28 => array(
            1 => array('type' => 'list', 'name' => 'Chestionare'),
        ),
        10 => array(
            1 => array('type' => 'list', 'name' => 'Documente'),
            2 => array('o' => 'new', 'name' => 'Adauga document'),
        ),
        11 => array(
            2 => array('type' => 'list', 'o' => 'psimple', 'name' => 'Pontaj simplu'),
            4 => array('type' => 'list', 'o' => 'pdetail', 'name' => 'Pontaj detaliat'),
            7 => array('type' => 'list', 'o' => 'pdhours', 'name' => 'Pontaj pe ore'),
            5 => array('type' => 'list', 'o' => 'pplanif', 'name' => 'Planificare pontaj'),
            8 => array('type' => 'list', 'o' => 'pphours', 'name' => 'Planificare pontaj pe ore'),
            1 => array('type' => 'list', 'name' => 'Pontaj proiecte'),
            3 => array('o' => 'reports', 'name' => 'Rapoarte'),
            6 => array('type' => 'list', 'o' => 'precalc', 'name' => 'Recalculare pontaj'),
        ),
        6 => array(
            1 => array('o' => 'personalisedlist', 'name' => 'Lista personalizata'),
            2 => array('o' => 'styles', 'name' => 'Stiluri'),
            3 => array('o' => 'lang', 'name' => 'Limba'),
        ),
        12 => array(
            1 => array('type' => 'list', 'name' => 'Stiri'),
            2 => array('o' => 'new', 'name' => 'Adauga stire'),
        ),
        20 => array(
            1 => array('name' => 'Dictionare'),
        ),
        21 => array(
            1 => array('type' => 'list', 'name' => 'Contracte'),
            2 => array('o' => 'new', 'name' => 'Adauga contract'),
        ),
        22 => array(
            2 => array('o' => 'planned', 'name' => 'Planificare buget'),
            3 => array('o' => 'compare', 'name' => 'Buget la data'),
            1 => array('o' => 'consumed', 'name' => 'Buget consumat'),
        ),
        23 => array(
            1 => array('type' => 'list', 'name' => 'Proiecte'),
            2 => array('o' => 'new_project', 'name' => 'Adauga proiect'),
        ),
        24 => array(
            1 => array('type' => 'list', 'name' => 'Lista discutii'),
            2 => array('o' => 'new', 'name' => 'Adauga discutie'),
        ),
        26 => array(
            1 => array('type' => 'list', 'name' => 'Newslettere'),
            2 => array('o' => 'new-intern', 'name' => 'Adauga newsletter intern'),
            3 => array('o' => 'new-extern', 'name' => 'Adauga newsletter extern'),
        ),
        27 => array(
            1 => array('type' => 'list', 'name' => 'Masini'),
            2 => array('o' => 'new', 'name' => 'Adauga masina'),
            5 => array('o' => 'dictionary', 'name' => 'Dictionar auto'),
        ),
        29 => array(
            1 => array('type' => 'list', 'name' => 'Cereri'),
            2 => array('o' => 'new', 'name' => 'Adauga cerere'),
        ),
        30 => array(
            1 => array('type' => 'list', 'name' => 'Tichete'),
            2 => array('o' => 'new', 'name' => 'Adauga tichet'),
        ),
        31 => array(
            1 => array('type' => 'list', 'name' => 'Functii'),
            2 => array('o' => 'organigram', 'name' => 'Organigrama Functii'),
            3 => array('o' => 'organigram_dir', 'name' => 'Organigrama Directii si Servicii'),
        ),
        13 => array(
            1 => array('type' => 'list', 'name' => 'Candidati'),
            3 => array('o' => 'new', 'name' => 'Adauga candidat'),
            2 => array('o' => 'list_external', 'name' => 'Candidati externi'),
            4 => array('o' => 'posts', 'name' => 'Posturi'),
        ),
        32 => array(
            1 => array('type' => 'list', 'name' => 'Evaluari candidati'),
            2 => array('o' => 'formsDraft', 'name' => 'Formulare evaluare'),
            3 => array('o' => 'evalDraft', 'name' => 'Adauga formular evaluare'),
            4 => array('o' => 'evalAssign', 'name' => 'Asignare evaluare'),
            //5 => array('o' => 'evalPersonsEvaluator', 'name' => 'Lista evaluari'),
        ),
        33 => array(
            1 => array('o' => 'new', 'name' => 'Raport nou'),
            2 => array('o' => 'myreports', 'name' => 'Rapoartele mele'),
        ),
        34 => array(
            1 => array('name' => 'Catering'),
        ),
        35 => array(
            1 => array('o' => 'cost', 'name' => 'Cheltuieli auto'),
        ),
        36 => array(
            1 => array('o' => 'sheet', 'name' => 'Foi de parcurs'),
        ),
        37 => array(
            1 => array('type' => 'list', 'name' => 'Produse'),
            2 => array('o' => 'new', 'name' => 'Adauga produs'),
        ),
        38 => array(
            1 => array('type' => 'list', 'name' => 'Dashboard'),
        ),
    );
    public static $msRightsLevel3 = array(
        1 => array(
            1 => array(
                1 => array('o' => 'edit', 'name' => 'Identificare'),
//                18 => array('o' => 'antropometrie', 'name' => 'Date antropometrice'),
                2 => array('o' => 'intretinere', 'name' => 'Intretinere'),
                26 => array('o' => 'asistate', 'name' => 'Persoane cu handicap grav / copil aflat in plasament'),
                3 => array('o' => 'editprof', 'name' => 'Profesionale'),
                4 => array('o' => 'incadrare', 'name' => 'Incadrare'),
                20 => array('o' => 'military', 'name' => 'Stagiu militar'),
                19 => array('o' => 'induction', 'name' => 'Etica'),
                5 => array('o' => 'cm', 'name' => 'Vechime in munca'),
                6 => array('o' => 'contract', 'name' => 'Contract'),
                7 => array('o' => 'payroll', 'name' => 'Salarizare'),
//                8 => array('o' => 'beneficii', 'name' => 'Beneficii'),
                9 => array('o' => 'medical', 'name' => 'Protectia muncii'),
                10 => array('o' => 'vacation', 'name' => 'Concediu'),
                23 => array('o' => 'displacement', 'name' => 'Deplasari'),
                24 => array('o' => 'projects', 'name' => 'Proiecte'),
                11 => array('o' => 'editcv', 'name' => 'CV'),
//                12 => array('o' => 'modulIT', 'name' => 'IT'),
//                25 => array('o' => 'inventar', 'name' => 'Obiecte inventar'),
//                13 => array('o' => 'car', 'name' => 'Masini'),
                14 => array('o' => 'docs', 'name' => 'Documente'),
                21 => array('o' => 'jobs', 'name' => 'Concursuri'),
//                22 => array('o' => 'events', 'name' => 'Intalniri'),
                15 => array('o' => 'auth', 'name' => 'Autentificare'),
                16 => array('o' => 'accessperf', 'name' => 'Performanta'),
                17 => array('o' => 'accesseval', 'name' => 'Evaluari'),
            ),
        ),
        2 => array(
            1 => array(
                1 => array('o' => 'edit', 'name' => 'Editare companie'),
                2 => array('o' => 'activity', 'name' => 'Detalii activitate'),
                3 => array('o' => 'other_location', 'name' => 'Adrese'),
                4 => array('o' => 'contracts', 'name' => 'Contracte'),
            ),
        ),
        3 => array(
            1 => array(
                1 => array('o' => 'edit', 'name' => 'Editare concurs'),
                4 => array('o' => 'strategy', 'name' => 'Strategie'),
                2 => array('o' => 'alloc', 'name' => 'Alocare personal'),
                3 => array('o' => 'alloc-candidates', 'name' => 'Alocare candidati'),
            ),
        ),
        4 => array(
            1 => array(
                1 => array('o' => 'edit', 'name' => 'Editare eveniment'),
            ),
        ),
        14 => array(
            1 => array(
                1 => array('o' => 'new_activity', 'name' => 'Editare activitate'),
            ),
            3 => array(
                1 => array('o' => 'edit_campaign', 'name' => 'Editare campanie'),
            ),
            5 => array(
                1 => array('o' => 'edit_daily', 'name' => 'Editare raport zilnic'),
            ),
        ),
        5 => array(
            1 => array(
                1 => array('o' => 'edit', 'name' => 'Editare training'),
            ),
        ),
        10 => array(
            1 => array(
                1 => array('o' => 'edit', 'name' => 'Modificare document'),
            ),
        ),
        11 => array(
            2 => array(
                1 => array('o' => 'psimple_day', 'name' => 'Pontaj simplu zilnic'),
                2 => array('o' => 'psimple_cal', 'name' => 'Pontaj simplu saptamanal'),
            ),
            4 => array(
                1 => array('o' => 'pdetail_act', 'name' => 'Pontaj detaliat activitati'),
                2 => array('o' => 'pdetail_stat', 'name' => 'Pontaj detaliat statistici'),
            ),
            5 => array(
                1 => array('o' => 'pplanif_act', 'name' => 'Planificare pontaj activitati'),
                2 => array('o' => 'pplanif_stat', 'name' => 'Planificare pontaj statistici'),
            ),
            1 => array(
                1 => array('o' => 'pontaj', 'name' => 'Pontaj proiecte'),
            ),
            7 => array(
                1 => array('o' => 'pdhours_act', 'name' => 'Pontaj pe ore activitati'),
            ),
            8 => array(
                1 => array('o' => 'pphours', 'name' => 'Validare planificare pontaj'),
            )
        ),
        6 => array(
            1 => array(
                1 => array('o' => 'personalisedlist', 'name' => 'Lista personalizata'),
            ),
            2 => array(
                1 => array('o' => 'styles', 'name' => 'Stiluri'),
            ),
            3 => array(
                1 => array('o' => 'lang', 'name' => 'Limba'),
            ),
        ),
        12 => array(
            1 => array(
                1 => array('o' => 'edit', 'name' => 'Modificare stire'),
            ),
        ),
        20 => array(
            1 => array(
                1 => array('o' => 'sites', 'name' => 'Locatii si sali'),
                2 => array('o' => 'jobstitle', 'name' => 'Profesii'),
                20 => array('o' => 'function_recr', 'name' => 'Functii'),
                3 => array('o' => 'function', 'name' => 'Coduri COR'),
                12 => array('o' => 'function_group', 'name' => 'Grupe de functii'),
                4 => array('o' => 'domains', 'name' => 'Domenii'),
                5 => array('o' => 'costcenter', 'name' => 'Bugete'),
                6 => array('o' => 'department', 'name' => 'Nivele organigrama'),
                7 => array('o' => 'library', 'name' => 'Biblioteca'),
                8 => array('o' => 'applications', 'name' => 'Aplicatii'),
                9 => array('o' => 'training_type', 'name' => 'Tipuri training'),
                10 => array('o' => 'performance_dimension', 'name' => 'Dimensiuni performanta'),
                11 => array('o' => 'pontaj_phases', 'name' => 'Faze proiect'),
                13 => array('o' => 'country', 'name' => 'Tari'),
                14 => array('o' => 'induction', 'name' => 'Inductie'),
                15 => array('o' => 'contract_type', 'name' => 'Tipuri contracte'),
                16 => array('o' => 'inventar', 'name' => 'Inventar'),
                17 => array('o' => 'city', 'name' => 'Orase'),
                18 => array('o' => 'grila', 'name' => 'Grila vechime'),
                19 => array('o' => 'activity_subject', 'name' => 'Subiect activitati'),
                21 => array('o' => 'measurement_units', 'name' => 'U.M.'),
                23 => array('o' => 'phone_contracts', 'name' => 'Abonamente'),
                24 => array('o' => 'product', 'name' => 'Categorii produse'),
            ),
        ),
        21 => array(
            1 => array(
                1 => array('o' => 'edit', 'name' => 'Informatii contract'),
                2 => array('o' => 'finance', 'name' => 'Financiar'),
                3 => array('o' => 'docs', 'name' => 'Documente atasate'),
                4 => array('o' => 'offer', 'name' => 'Oferte'),
            ),
        ),
        23 => array(
            1 => array(
                1 => array('o' => 'edit_project', 'name' => 'Modificare proiect'),
            ),
        ),
        24 => array(
            1 => array(
                1 => array('o' => 'edit', 'name' => 'Modificare discutie'),
            ),
        ),
        26 => array(
            1 => array(
                1 => array('o' => 'edit-intern', 'name' => 'Editare newsletter intern'),
                2 => array('o' => 'edit-extern', 'name' => 'Editare newsletter extern'),
            ),
        ),
        27 => array(
            1 => array(
                1 => array('o' => 'edit', 'name' => 'General'),
                2 => array('o' => 'financial', 'name' => 'Financiar'),
                3 => array('o' => 'assurance', 'name' => 'Asigurari'),
                6 => array('o' => 'pcheckups', 'name' => 'Plan revizii'),
                5 => array('o' => 'checkups', 'name' => 'Revizii efectuate'),
                4 => array('o' => 'docs', 'name' => 'Documente'),
            ),
        ),
        29 => array(
            1 => array(
                1 => array('o' => 'edit', 'name' => 'Modificare cerere'),
            ),
        ),
        30 => array(
            1 => array(
                1 => array('o' => 'edit', 'name' => 'Modificare tichet'),
            ),
        ),
        31 => array(
            1 => array(
                1 => array('o' => 'edit', 'name' => 'Modificare functie'),
            ),
        ),
        13 => array(
            1 => array(
                1 => array('o' => 'edit', 'name' => 'Identificare candidat'),
                5 => array('o' => 'antropometrie', 'name' => 'Date antropometrice '),
                3 => array('o' => 'military', 'name' => 'Stagiu militar'),
                4 => array('o' => 'cm', 'name' => 'CIM'),
                2 => array('o' => 'editcv', 'name' => 'CV'),
                7 => array('o' => 'recruiter-eval', 'name' => 'Evaluare recruiter'),
                8 => array('o' => 'jobs', 'name' => 'Concursuri'),
                6 => array('o' => 'docs', 'name' => 'Documente'),
            ),
        ),
        34 => array(
            1 => array(
                1 => array('o' => 'choosemenu', 'name' => 'Alegere meniu'),
                2 => array('o' => 'choosemenu_ang', 'name' => 'Alegere meniu angajati'),
                3 => array('o' => 'menu_week', 'name' => 'Introducere meniu saptamanal'),
                4 => array('o' => 'dictionary', 'name' => 'Dictionar preparate'),
            ),
        ),
        35 => array(
            1 => array(
                1 => array('o' => 'car_cost_new', 'name' => 'Detalii cheltuieli'),
            ),
        ),
        37 => array(
            1 => array(
                1 => array('o' => 'edit', 'name' => 'Modificare produs'),
            ),
        ),
    );
}

?>