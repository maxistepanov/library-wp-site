<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'lib');

/** Имя пользователя MySQL */
define('DB_USER', 'root');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'lockheed');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'mDbL_|m_L4kGHB^eq53(*+G.31?mT>f(mg8C{;wZ1%A*p[.Mz;F+ r vBz/`,,t7');
define('SECURE_AUTH_KEY',  'fjsWk,gFr<bcA_3X?^SX:]GJ(QqjlN[@QQjc>gi4W~zL!&?L_T(a5@x@KGu?w?=#');
define('LOGGED_IN_KEY',    '{{O*AeP-<vyGh@=4@l$}e^ELmaaAv:lJ$%iJoPicVbmjU#giU-bQ4J%PJ-?$zl=c');
define('NONCE_KEY',        'w1-$Qn%dUK1k)vn`_xBD&}lU_HV]2h9^ $Grv[V2!_wZ;N6zU4i)0[Hlde8Gh(Qb');
define('AUTH_SALT',        'vxY@Qo(ndC8Z:K>sIojjFE1vIo[=|~a[gmF-,93zg|=Sji1lep!FSR:PN?}pGLb%');
define('SECURE_AUTH_SALT', 'J1qNdM/|lfJCdw^rpY#hr YOEaQqGjoFw-UbuiVpm1_n]D<)Qxmuva]ude1#4>t,');
define('LOGGED_IN_SALT',   '_g(rU;b}^|Ap/@xE%LF/dEci?= )=-^ew_xNsgq+=5jX?wqOss`W]ZfGd{S4:_rj');
define('NONCE_SALT',       '/IUl1)Rz<*[{qCFpP}W0 y<;n`HC=dmI6h^&6&o7{LBFH]mxvRC>j>[9p9(xF~>#');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 * 
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
