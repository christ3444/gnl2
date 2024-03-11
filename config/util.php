<?php

return [
    'roles' => [
        'guest' => [
            'id' => 1,
            'role' => 'guest',
            'degree' => 0
        ],
        'user' => [
            'id' => 2,
            'role' => 'user',
            'degree' => 1
        ],
        'admin' => [
            'id' => 3,
            'role' => 'admin',
            'degree' => 2
        ],
    ],

    'recording_transaction_amount' => 5000,

    'levels' => [
        'one' => [
            'label' => 'Niveau 1',
            'number' => 1,
            'generation_one_bonus_amount' => 1500, 
            'generation_two_bonus_amount' => null, 
            'generation_three_bonus_amount' => null, 
        ],
        'two' => [
            'label' => 'Niveau 2',
            'number' => 2,
            'generation_one_bonus_amount' => 2500,
            'generation_two_bonus_amount' => 2250,
            'generation_three_bonus_amount' => 750,
        ],
        'three' => [
            'label' => 'Niveau 3',
            'number' => 3,
            'generation_one_bonus_amount' => 5000,
            'generation_two_bonus_amount' => 4500,
            'generation_three_bonus_amount' => 1500,
        ],
        'four' => [
            'label' => 'Niveau 4',
            'number' => 4,
            'generation_one_bonus_amount' => 25000,
            'generation_two_bonus_amount' => 22500,
            'generation_three_bonus_amount' => 7500,
        ],
        'five' => [
            'label' => 'Niveau 5',
            'number' => 5,
            'generation_one_bonus_amount' => 500000,
            'generation_two_bonus_amount' => 450000,
            'generation_three_bonus_amount' => 150000,
        ],
        'six' => [
            'label' => 'Niveau 6',
            'number' => 6,
            'generation_one_bonus_amount' => 3125000,
            'generation_two_bonus_amount' => 2812500,
            'generation_three_bonus_amount' => 937500,
        ],
        'seven' => [
            'label' => 'Niveau 7',
            'number' => 7,
            'generation_one_bonus_amount' => 18750000,
            'generation_two_bonus_amount' => 16875000,
            'generation_three_bonus_amount' => 5625000,
        ],
    ],
    'stater_level_label' => 'Niveau 0',
    'stater_level_number' => 0,
    'maximum_godsons_of_generation_one' => 2,
    'maximum_godsons_of_generation_two' => 4,
    'maximum_godsons_of_generation_three' => 8,
    'tree_count' => 14,
    'logs_folder' => '/home/sharpdev/',
    'logs_files_format' => 'json',
    'mark_actions' => [
        [
            'id' => 1,
            'action' => 'Génération de codes',
            'code' => '#001'
        ],
        [
            'id' => 2,
            'action' => 'Transfert de codes',
            'code' => '#002'
        ],
        [
            'id' => 3,
            'action' => 'Création de groupe leader',
            'code' => '#003'
        ],
        [
            'id' => 4,
            'action' => 'Edition de groupe leader',
            'code' => '#004'
        ],
        [
            'id' => 5,
            'action' => 'Activation de groupe leader',
            'code' => '#005'
        ],
        [
            'id' => 6,
            'action' => 'Suspension de groupe leader',
            'code' => '#006'
        ],
        [
            'id' => 7,
            'action' => 'Enregistrement de filleul',
            'code' => '#007'
        ],
        [
            'id' => 8,
            'action' => 'Formulation de demande de retrait',
            'code' => '#008'
        ],
        [
            'id' => 9,
            'action' => 'Traitement de demande de retrait',
            'code' => '#009'
        ],
        [
            'id' => 10,
            'action' => 'Annulation de demande de retrait',
            'code' => '#010'
        ],
    ]
];