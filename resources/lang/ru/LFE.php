<?php
return [
	'cancel'                      => 'Отмена',
	'unauthorized'                => 'Пожалуйства авторизуйтесь',
	'name'                        => 'Форумы',
	'stats-title'                 => 'Статистика',
	'stats-legend-title'          => 'Условности',
	'stats-legend-admin'          => 'Администратор',
	'stats-legend-moderator'      => 'Модератор',
	'stats-legend-user'           => 'Пользователь',
	'stats-guests'                => ':count Гостей',
	'new-topic-title-title'       => 'Название',
	'new-topic-title-placeholder' => 'Укажите название',
	'new-topic-post-placeholder'  => 'Введите текст сообщения',
	'create-title'                => 'Создать',
	'reply-title'                 => 'Ответить',
	'fast-reply-title'            => 'Быстро ответить',
	'message-title'               => 'Сообщение',
	'reply-topic-title'           => 'Ответ в теме &laquo;:title&raquo;',
	'new-topic-title'             => 'Создать тему',
	'who-online-title'            => 'Кто онлайн за последние 15 минут',
	'subforums-title'             => 'Подфорумы',
	'new-title'                   => 'Новый',
	'delete-topic-title'          => 'Удалить тему :title',
	'delete-topic-confirm'        => 'Вы действительно хотите удалить тему &laquo;:topic&raquo; ?',
	'access-denied-not-yours'     => 'У Вас недостаточно прав для этой операции.',
	'edit-topic-title'            => 'Редактировать тему :title',
	'subscribe-topic-title'       => 'Подписаться',
	'unsubscribe-topic-title'     => 'Отписаться',
	'hide-topic-title'            => 'Спрятать тему :title',
	'unhide-topic-title'          => 'Показать тему :title',
	'topic-actions-title'         => 'Действия с темой',
	'topic-title'                 => 'Тема',
	'forum-title'                 => 'Форум',
	'post-title'                  => 'Сообщение',
	'open-profile'                => 'Открыть профиль :username',
	'user-title'                  => 'Пользователь',
	'user-posts-count'            => 'Постов: :count',
	'user-joined-date'            => '<nobr>Зарегистрировался:</nobr> <nobr>:at</nobr>',
	'users-title'                 => 'Пользователи',
	'users-not-found'             => 'Запрашиваемый пользователь не найден',
	'post-created-title'          => ':at',
	'deleted-username-title'      => 'Пользователь удалён',
	'count-posts-title'           => 'Постов',
	'last-post'                   => 'Последний пост',
	'last-poster'                 => 'Последний запостивший',
	'warning'                     => 'Предупреждение',
	'forum-not-found'             => 'Запрошенный форум не найден !',
	'topic-not-found'             => 'Запрошенная тема не найдена !',
	'post-not-found'              => 'Запрошенный пост не найден !',
	'return-back'                 => 'Вернуться назад',
	'datetime'                    => [
		'today'     => 'Today at :at',
		'yesterday' => 'Yesterday at :at',
	],
	'translit'                    => [
		'а' => 'a',
		'б' => 'b',
		'в' => 'v',
		'г' => 'g',
		'д' => 'd',
		'е' => 'e',
		'ё' => 'e',
		'ж' => 'zh',
		'з' => 'z',
		'и' => 'i',
		'й' => 'y',
		'к' => 'k',
		'л' => 'l',
		'м' => 'm',
		'н' => 'n',
		'о' => 'o',
		'п' => 'p',
		'р' => 'r',
		'с' => 's',
		'т' => 't',
		'у' => 'u',
		'ф' => 'f',
		'х' => 'h',
		'ц' => 'c',
		'ч' => 'ch',
		'ш' => 'sh',
		'щ' => 'sch',
		'ь' => '\'',
		'ы' => 'y',
		'ъ' => '\'',
		'э' => 'e',
		'ю' => 'yu',
		'я' => 'ya',
		'А' => 'A',
		'Б' => 'B',
		'В' => 'V',
		'Г' => 'G',
		'Д' => 'D',
		'Е' => 'E',
		'Ё' => 'E',
		'Ж' => 'Zh',
		'З' => 'Z',
		'И' => 'I',
		'Й' => 'Y',
		'К' => 'K',
		'Л' => 'L',
		'М' => 'M',
		'Н' => 'N',
		'О' => 'O',
		'П' => 'P',
		'Р' => 'R',
		'С' => 'S',
		'Т' => 'T',
		'У' => 'U',
		'Ф' => 'F',
		'Х' => 'H',
		'Ц' => 'C',
		'Ч' => 'Ch',
		'Ш' => 'Sh',
		'Щ' => 'Sch',
		'Ь' => '\'',
		'Ы' => 'Y',
		'Ъ' => '\'',
		'Э' => 'E',
		'Ю' => 'Yu',
		'Я' => 'Ya',
	],
	'validator' => [
		'title'	=> [
			'required' => 'Титул темы обязателен для запонения',
			'min'      => 'Минимальная длина титула темы - 4 символа',
			'max'      => 'Максимальная длина титула темы - 160 символов',
		],
		'message'  => [
			'required' => 'Сообщение обязательно для запонения',
			'min'      => 'Минимальная длина сообщения - 4 символа',
		],
		'forum_id' => [
			'required' => 'ID форума не предоставлен',
			'numeric'  => 'ID форума должен быть целым числом',
		],
		'topic_id' => [
			'required' => 'ID темы не предоставлен',
			'numeric'  => 'ID темы должен быть целым числом',
		],
	],
];
