<?php
/**
 * account.php
 *
 * @copyright  2022 beikeshop.com - All Rights Reserved
 * @link       https://beikeshop.com
 * @author     Edward Yang <yangjin@guangda.work>
 * @created    2022-08-04 10:59:15
 * @modified   2022-08-04 10:59:15
 */

return [
    'index'               => 'персональный центр',
    'revise_info'         => 'Изменить информацию',
    'collect'             => 'собирать',
    'coupon'              => 'купон',
    'my_order'            => 'Мой заказ',
    'orders'              => 'все заказы',
    'pending_payment'     => 'Ожидающий платеж',
    'pending_send'        => 'быть доставленным',
    'pending_receipt'     => 'ожидающий получения',
    'after_sales'         => 'После продажи',
    'no_order'            => 'У вас еще нет заказа!',
    'to_buy'              => 'установить порядок',
    'order_number'        => 'порядковый номер',
    'order_time'          => 'время заказа',
    'state'               => 'государство',
    'amount'              => 'количество',
    'check_details'       => 'проверить детали',
    'all'                 => 'общий',
    'items'               => 'Предметы',
    'verify_code_expired' => 'Срок действия вашего проверочного кода истек (10 минут), получите его еще раз.',
    'verify_code_error'   => 'Ваш проверочный код неверен',
    'account_not_exist'   => 'Пользователь не существует',

    'edit'                => [
        'index'                 => 'Изменить личную информацию',
        'modify_avatar'         => 'Изменить аватар',
        'suggest'               => 'Загрузите изображение в формате JPG или PNG. Рекомендуется 300 x 300.',
        'name'                  => 'имя',
        'email'                 => 'Почта',
        'crop'                  => 'обрезать',
        'password_edit_success' => 'Сброс пароля завершен',
        'origin_password_fail'  => 'Оригинальный пароль неверный',
    ],

    'wishlist'            => [
        'index'         => 'Мое избранное',
        'product'       => 'продукт',
        'price'         => 'цена',
        'check_details' => 'проверить детали',
    ],

    'order'               => [
        'index'         => 'Мой заказ',
        'completed'     => 'Получение подтверждено',
        'cancelled'     => 'Заказ отменен',
        'order_details' => 'Информация для заказа',
        'amount'        => 'количество',
        'state'         => 'государство',
        'order_number'  => 'порядковый номер',
        'check'         => 'Проверять',

        'order_info'    => [
            'index'             => 'Информация для заказа',
            'order_details'     => 'Информация для заказа',
            'to_pay'            => 'платить',
            'cancel'            => 'отменить заказ',
            'confirm_receipt'   => 'подтвердить получение товара',
            'order_number'      => 'порядковый номер',
            'order_date'        => 'Дата заказа',
            'state'             => 'государство',
            'order_amount'      => 'сумма заказа',
            'order_items'       => 'заказ товаров',
            'apply_after_sales' => 'Подать заявку на послепродажное обслуживание',
            'order_total'       => 'общий заказ',
            'logistics_status'  => 'Статус логистики',
            'order_status'      => 'Статус заказа',
            'remark'            => 'Примечание',
            'update_time'       => 'Время обновления',
        ],

        'order_success' => [
            'order_success'            => 'Поздравляем, заказ успешно сформирован!',
            'order_number'             => 'порядковый номер',
            'amounts_payable'          => 'Суммы к оплате ',
            'payment_method'           => 'метод оплаты',
            'view_order'               => 'Посмотреть детали заказа ',
            'pay_now'                  => 'платить немедленно ',
            'kind_tips'                => 'Напоминание: Ваш заказ был успешно сгенерирован, пожалуйста, завершите оплату как можно скорее~ ',
            'also'                     => 'Вы также можете',
            'continue_purchase'        => 'продолжать покупать',
            'contact_customer_service' => 'Если у вас возникнут какие-либо вопросы в процессе заказа, вы можете связаться с нашим персоналом службы поддержки в любое время.',
            'emaill'                   => 'Почта',
            'service_hotline'          => 'Сервисная горячая линия',
        ],

    ],

    'addresses'           => [
        'index'           => 'мой адресс',
        'add_address'     => 'Добавить новый адрес',
        'default_address' => 'адрес по умолчанию',
        'delete'          => 'Удалить',
        'edit'            => 'редактировать',
        'enter_name'      => 'Пожалуйста, введите ваше имя',
        'enter_phone'     => 'Пожалуйста, введите свой номер телефона',
        'enter_address'   => 'Пожалуйста, введите подробный адрес 1',
        'select_province' => 'Выберите провинцию',
        'enter_city'      => 'Пожалуйста, заполните город',
        'confirm_delete'  => 'Вы уверены, что хотите удалить адрес?',
        'hint'            => 'намекать',
        'check_form'      => 'Пожалуйста, проверьте правильность заполнения формы',
    ],

    'rma'                 => [
        'index'         => 'мой послепродажный',
        'commodity'     => 'товар',
        'quantity'      => 'количество',
        'service_type'  => 'Тип Обслуживания',
        'return_reason' => 'Причина возврата',
        'creation_time' => 'время создания',
        'check'         => 'Проверять',

        'rma_info'      => [
            'index' => 'Детали послепродажного обслуживания',
        ],

        'rma_form'      => [
            'index'           => 'Отправить послепродажную информацию',
            'service_type'    => 'Тип Обслуживания',
            'return_quantity' => 'Количество возврата',
            'unpacked'        => 'распакованный',
            'return_reason'   => 'Причина возврата',
            'remark'          => 'Примечание',
        ],
    ],
];
