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
        'fullname'          => 'ФИО',
        'firstname'         => 'Имя',
        'lastname'          => 'Фамилия',
        'email'             => 'Email',
        'phone'             => 'Телефон',
        'comment'           => 'Комментарий',

        'search_address'    => 'Поиск адреса (автозаполнение)',
        'search_address_description'    => 'Начните вводить адрес относительно Алматы или введите координаты',

        'full_address'      => 'Полный адрес',
        'country'           => 'Страна',
        'region'            => 'Регион',
        'district'          => 'Район',
        'locality'          => 'Город',
        'street'            => 'Улица',
        'house_number'      => 'Дом',
        'house_frontway'    => 'Подьезд',
        'house_floor'       => 'Этаж',
        'latitude'          => 'Широта',
        'longitude'         => 'Долгота',
        'type'              => 'type',

        'coords'            => 'Координаты',
        'apartment'                 => 'Офис/квартира',
        'intercom_code'             => 'Код домофона',

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
            'label'     => 'Баланс точки',
            'balance'   => 'Баланс',
            'total_balance'   => 'Текущий баланс точки',
            'description'  => 'Основание',
            'created_at'   => 'Время',
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
        'name'          => 'Наименование',
        'price'         => 'Цена',
        'quantity'      => 'Остаток',
        'type'          => 'Тип',
        'wp_id'         => 'ID продукта (WordPress)',
    ],

    'car'       => [
        'name'          => 'Название (марка авто)',
        'reg_name'      => 'Гос. номер',
    ],

    'individual_price'  => [
        'price'         => 'Спец. цена',
        'product_name'  => 'Продукт',
    ],

    'talons'            => [
        'section'       => [
            'title'     => 'Баланс талонов'
        ],
        'total_balance' => 'Текущий баланс талонов пользователя',

        'balance'       => 'Баланс',
        'description'   => 'Основание',
        'created_at'    => 'Создано',
    ],

    'courier'           => [
        'users'         => 'Сотрудник',
        'transport'     => 'Транспорт',
    ],
    'order'           => [
        'customer_shiping'         => 'Поиск адреса (автозаполнение)',
    ],

    'program'   => [
        'name'  => 'Название',
        'program_type'   => 'Тип канала',
    ],
    'program_type'   => [
        'name'  => 'Название',
    ],

    'indicator'   => [
        'name'  => 'Название',
    ],
    'style'   => [
        'name'  => 'Название',
    ],
    'service'   => [
        'name'  => 'Услуга',
    ],
    'service_type'   => [
        'name'  => 'Вид Услуги',
        'parent'    => 'Родительская услуга',
    ],
    'contract_type'   => [
        'name'  => 'Тип Договора',
    ],
    'contract'   => [
        'number'    => '№ Договора',
        'date'      => 'Дата',
        'type'      => [
            'label' => 'Тип договора',
            'values'    => [
                'local'     => 'местный',
                'center'   => 'централизованный',
            ]
        ],
        'client'    => [
            'name'  => 'Контрагент',
        ],
        'manager'    => [
            'name'  => 'Менеджер',
        ],
        'date_start'    => 'Срок действия с',
        'date_end'  => 'Срок действия до',
        'comment'   => 'Предмет договора',
    ],
    'sub_contract'  => [
        'number'    => 'Номер доп. соглашения',
        'date_start'    => 'Дата доп. соглашения',
        'date_end'    => 'Срок договора до',
        'contract'     => [
            'number'    => 'Основной договор',
        ],
    ],
    'type'   => [
        'name'  => 'Тип',
    ],
    'activity'   => [
        'name'  => 'Деятельность',
    ],
    'subservice'   => [
        'name'  => 'Подуслуга',
    ],
    'state'   => [
        'name'  => 'Филиал',
    ],
    'area'   => [
        'name'  => 'Область',
    ],
    'district'   => [
        'name'  => 'Район',
    ],
    'station'   => [
        'name'  => 'РТС',
    ],
    'city'   => [
        'name'  => 'Нас. пункт',
    ],
    'client' => [
        'name'  => 'Контрагент (название)',
        'type'  => [
            'name' => 'Тип Контрагента',
            'COMMERCE'  => 'Коммерческий',
            'GOVERMENTAL'   => 'Государственный',
        ],
        'state'  => 'Филиал',
        'area'  => 'Область',
        'district'  => 'Район',
        'city'  => 'Населенный Пункт Факт Адреса',
        'address'  => 'Адрес',
        'actual_city' => 'Населенный Пункт Факт Адреса',
        'legal_city'    => 'Населенный Пункт Юр Адреса',
        'actual_address'    => 'Факт адрес',
        'legal_address'     => 'Юр адрес',
        'RNN'  => 'РНН',
        'IIK'  => 'ИИК',
        'BIN'  => 'БИН',
        'BIK'  => 'БИК',
        'BANK'  => 'БАНК',
        'KBE'  => 'КБЕ',
        'manager_name'   => 'Менеджер (!!)',
        'manager'   => ['name' => 'Менеджер'],
        'contacts'  => 'Контакты',
        'contract_count'    => 'Договоров : :contract_count',
    ],

    'debit' => [
        'period'  => 'Отч. период',
        'contract'  => '№ договора',
        'activity_type' => [
            'label'     => 'Деятельность',
            'values'    => [
                'main'  => 'Основная деятельность',
                'non-main' => 'Неосновная деятельность',
            ]
        ],
        'indicator'     => 'Ед. измерений',
        'program'       => 'Канал',
        'count'         => 'Кол-во',
        'sum'         => 'Cумма',
        'state'         => 'Филиал',
        'area'          => 'Область',
        'district'      => 'Район',
        'city'          => 'Город',
        'station'       => 'РТС',
        'services'      => 'Услуги',
        'status'        => [
            'label' => 'Статус',
            'values'    => [
                'open'  => 'Открытый',
                'close'  => 'Закрытый',
            ],
        ],
        'filter'    => [
            'period' => [
                'from_to'   => 'Фильтрация по периоду',
                'from'      => 'Период с',
                'to'        => 'Период до',
                'from_month'    => 'Mecяц',
                'from_year'     => 'Год',
                'to_month'      => 'Месяц',
                'to_year'       => 'Год',
            ],
        ]
    ],
    'contract_service'  => [
        'contract'      => '№ договора',
        'state'         => 'Филиал',
        'count'         => 'Кол-во',
        'amount'           => 'Стоимость без НДС',
        'sum'           => 'Сумма',
        'services'      => 'Услуги',
        'programs'      => 'Каналы',
        'indicator'     => 'Ед. измерения',
        'client'        => [
            'name'      => 'Контрагент',
            'hint'      => 'Фильтровать договора по контрагенту'
        ],
        'sub_contract' => [
            'number'    => '№ доп. соглашения',
        ],
        'manager'       => 'Менеджер'
    ],
];
