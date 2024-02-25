<?php

return [
    'section' => [
        'heading' => [
            'detail' => 'Реквизиты для Юр. лица'
        ]
    ],
    'forms' => [
        'fieldset' => [
            'detail' => [
                'label' => 'Реквизиты для Юр. лица',
                'addButton' => 'Добавить реквизиты'
            ]
        ]
    ],
    'customer' => [
        'name' => 'Имя',
        'email' => 'Email',
        'phone' => 'Телефон',
        'person_type' => 'Выбор формы собственности',
        'created_at' => 'Создан',
        'updated_at' => 'Обновлен',
    ],
    'shiping'   => [

        'tab'   => [
            'general'       => 'Основное',
            'address'       => 'Aдрес',
            'work_time'     => 'Рабочее время',
            'cooler_and_tara'   => 'Кулер и тара',
            'balance'       => 'Баланс',
        ],

        'isMain'            => 'Основной адрес',
        'address_name'      => 'Краткое название',

        'fullname'          => 'Full name',
        'firstname'         => 'Имя',
        'lastname'          => 'Фамилия',
        'email'             => 'Email',
        'phone'             => 'Телефон',
        'comment'           => 'Comment',

        'search_address'    => 'Search address',
        'search_address_description'    => 'Начните вводить адрес относительно Алматы или введите координаты',
        'full_address'      => 'Full address',
        'country'           => 'Country',
        'region'            => 'Region',
        'district'          => 'District',
        'locality'          => 'Locality',
        'street'            => 'Street',
        'house_number'       => 'House',
        'house_frontway'             => 'House frontway',
        'house_floor'                => 'House floor',
        'latitude'          => 'latitude',
        'longitude'         => 'longitude',
        'type'              => 'type',
        'coords'            => 'Coords',

        'apartment'                 => 'Apartment',
        'intercom_code'             => 'Intercom code',

        'work_time' => [
            'start_at'          => 'Начало рабочего дня',
            'end_at'            => 'Конец рабочего дня',
            'launch_start_at'   => 'Обеденный перерыв с',
            'launch_end_at'     => 'Обеденный перерыв до',
            'weekend_days'      => 'Выходные дни',
        ],

        'cooler'    => [
            'having'    => 'Наличие кулера',
            'count'     => 'Количество кулеров на точке'
        ],
        'tara' => [
            'count'     => 'Количество тары на точке'
        ],

        'balance'       => [
            'label'     => 'Shiping address balance',
            'balance'   => 'Баланс',
            'total_balance'   => 'Текущий баланс точки',
            'description'   => 'Description',
            'created_at'   => 'Created at',
        ],
    ],
    'detail'    => [
        'name'          => 'Юридическое название компании',
        'ownership'     => 'Форма собственности',
        'BIN_IIN'       => 'БИН/ИИН',
        'bank_account'  => 'Расчетный счет',
        'legal_address' => 'Юр. адрес',
        'KBE'           => 'КБЕ',
    ],

    'product'   => [
        'name'          => 'Name',
        'price'         => 'Price',
        'quantity'      => 'Quantity',
        'type'          => 'type',
        'wp_id'         => 'WP product id',
    ],
    'car'       => [
        'name'          => 'Name',
        'reg_name'      => 'Registration number',
    ],

    'individual_price'  => [
        'price'         => 'Individual price',
        'product_name'  => 'Product',
    ],

    'talons'            => [

        'section'       => [
            'title'     => 'Total talon balance'
        ],
        'total_balance' => 'Total talon balance',
        'balance'       => 'Balance',
        'description'   => 'Description',
        'created_at'    => 'Created at',
    ],

    'courier'           => [
        'users'         => 'Сотрудник',
        'transport'     => 'Транспорт',
    ],
    'order'           => [
        'customer_shiping'         => 'Поиск адреса (автозаполнение)',
    ],

    'program'   => [
        'name'  => 'Program name',
        'program_type'  => 'Program type name',
    ],
    'program_type'   => [
        'name'  => 'Program type name',
    ],
    'indicator'   => [
        'name'  => 'Indicator name',
    ],
    'style'   => [
        'name'  => 'Style name',
    ],
    'service'   => [
        'name'  => 'Service name',
    ],
    'service_type'   => [
        'name'  => 'Service Type name',
        'parent'    => 'Parent Service Type',
    ],
    'contract_type'   => [
        'name'  => 'Contract Type name',
    ],
    'contract'   => [
        'number'    => 'Contract number',
        'date'      => 'Contract date',
        'type'      => [
            'label' => 'Contract type',
            'values'    => [
                'local'     => 'Local type',
                'center'   => 'Сentralized type',
            ]
        ],
        'client'    => [
            'name'  => 'Client name',
        ],
        'manager'    => [
            'name'  => 'Менеджер',
        ],
        'date_start'    => 'Contract date start',
        'date_end'  => 'Contract date end',
        'comment'   => 'Contract comment',
    ],
    'sub_contract'  => [
        'number'    => 'Additional Contract number',
        'date_start'    => 'Date start',
        'date_end'    => 'Date end',
        'contract'     => [
            'number'    => 'Contract number',
        ],
    ],
    'type'   => [
        'name'  => 'Type name',
    ],
    'activity'   => [
        'name'  => 'Activity name',
    ],
    'subservice'   => [
        'name'  => 'Sub-Service name',
    ],
    'state'   => [
        'name'  => 'State name',
    ],
    'area'   => [
        'name'  => 'Area name',
    ],
    'district'   => [
        'name'  => 'District name',
    ],
    'city'   => [
        'name'  => 'City name',
    ],
    'station'   => [
        'name'  => 'Station name',
    ],

    'client' => [
        'name'  => 'Client name',
        'type'  => [
            'name' => 'Client type',
            'COMMERCE'      => 'Commercial',
            'GOVERMENTAL'   => 'Govermental',
        ],
        'state'  => 'Client state',
        'area'  => 'Client area',
        'district'  => 'Client district',
        'city'  => 'Client city',
        'actual_city' => 'Actual city',
        'legal_city'    => 'Legal city',
        'address'  => 'Client address',
        'actual_address'    => 'Actual address',
        'legal_address'     => 'Legal address',
        'RNN'  => 'Client RNN',
        'IIK'  => 'Client IIK',
        'BIN'  => 'Client BIN',
        'BIK'  => 'Client BIK',
        'BANK'  => 'Client BANK',
        'KBE'  => 'Client KBE',
        'manager_name'   => 'Manager (DEPRECATED)',
        'manager'   => ['name' => 'Manager'],
        'contacts'  => 'Contacts',
        'contract_count'    => 'Contracts count: :contract_count',
    ],

    'debit' => [
        'period'  => 'Period',
        'contract'  => 'Contract number',
        'activity_type' => [
            'label'     => 'Activity type',
            'values'    => [
                'main'  => 'Main',
                'non-main' => 'Non-main',
            ]
        ],
        'indicator' => 'Indicator',
        'program'   => 'Program',
        'count'     => 'Count',
        'sum'     =>    'Sum',
        'state'     => 'State',
        'area'     =>   'Area',
        'district'     => 'Disctrict',
        'city'     => 'City',
        'station'     => 'Station',
        'services'     => 'Services',
        'status'        => [
            'label' => 'Status',
            'values'    => [
                'open'  => 'Open',
                'close'  => 'Close',
            ],
        ],
        'filter'    => [
            'period' => [
                'from_to' => 'Filter by period',
                'from'      => 'Date from',
                'to'      => 'Date to',
                'from_month'    => 'From month',
                'from_year'     => 'From year',
                'to_month'      => 'To month',
                'to_year'       => 'To year',
            ],
        ]
    ],

    'contract_service'  => [
        'contract'  => 'Contract number',
        'state'     => 'State name',
        'count'     => 'Count',
        'amount'     => 'amount',
        'sum'           => 'Sum',
        'services'     => 'Services',
        'programs'   => 'Program',
        'indicator'     => 'Indicator ID',
        'client'    => [
            'name'  => 'Client name',
            'hint'      => 'Filter contracts by client name'
        ],
        'sub_contract' => [
            'number'    => 'Sub Contract number',
        ],
        'manager'       => 'Manager'
    ],
];
