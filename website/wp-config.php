<?php
/**
 * WordPress基础配置文件。
 *
 * 本文件包含以下配置选项：MySQL设置、数据库表名前缀、密钥、
 * WordPress语言设定以及ABSPATH。如需更多信息，请访问
 * {@link http://codex.wordpress.org/zh-cn:%E7%BC%96%E8%BE%91_wp-config.php
 * 编辑wp-config.php}Codex页面。MySQL设置具体信息请咨询您的空间提供商。
 *
 * 这个文件被安装程序用于自动生成wp-config.php配置文件，
 * 您可以手动复制这个文件，并重命名为“wp-config.php”，然后填入相关信息。
 *
 * @package WordPress
 */

// ** MySQL 设置 - 具体信息来自您正在使用的主机 ** //
/** WordPress数据库的名称 */
define('DB_NAME', 'wordpress');

/** MySQL数据库用户名 */
define('DB_USER', 'root');

/** MySQL数据库密码 */
define('DB_PASSWORD', 'myoa888');

/** MySQL主机 */
define('DB_HOST', 'localhost');

/** 创建数据表时默认的文字编码 */
define('DB_CHARSET', 'utf8mb4');

/** 数据库整理类型。如不确定请勿更改 */
define('DB_COLLATE', '');

/**#@+
 * 身份认证密钥与盐。
 *
 * 修改为任意独一无二的字串！
 * 或者直接访问{@link https://api.wordpress.org/secret-key/1.1/salt/
 * WordPress.org密钥生成服务}
 * 任何修改都会导致所有cookies失效，所有用户将必须重新登录。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'sc}*:*|Fgg;7{5<|Ob@&hz6Q3-9su={Hcam>I/p3bcW,SQUC`eDd(i}V;AR9/C77');
define('SECURE_AUTH_KEY',  'sDN=61*jdt/)`1zWbj;ib`Fz:{MUoz;E5yte^ED%ISVto.:8[N$[&(V+~$f0hyfH');
define('LOGGED_IN_KEY',    'PXRl_&x_UfHT 78n&--idK`izQ[L*$^OY{F3-92f+~[<!]$^.r2?!NY!qX`QXo,2');
define('NONCE_KEY',        '2p[3mB#RqFaK+0.=*#`{(8>i8NfI5Tgm16]H]WM.|l&XHk@f|+D8Fg0kW$w+#W/O');
define('AUTH_SALT',        'F{(]H+vozX-[FA?@AdokO?4/N4ZH8I 3prVI~fltoP]%qD3`?2EFC^JPMxjM.},B');
define('SECURE_AUTH_SALT', 't>MDA_$<b=4(G(;W?]-w3XS~=-YYKy521cOTiCQuOi+2a$g[,_pH)hW2+*`vgVkM');
define('LOGGED_IN_SALT',   'L5v--BmdPq|D$TG/Lxz~><FDbk%R`roU1#45z&YTq)p@,|@=%BYdZCOdV4`zc/D8');
define('NONCE_SALT',       '%FvwY%4J;H0Ifg^|Y2Z&|@[- {WWB-pH^%9by$-0TB.VN>q[qL$KtrG`&,c]+zI^');

/**#@-*/

/**
 * WordPress数据表前缀。
 *
 * 如果您有在同一数据库内安装多个WordPress的需求，请为每个WordPress设置
 * 不同的数据表前缀。前缀名只能为数字、字母加下划线。
 */
$table_prefix  = 'wp_';

/**
 * 开发者专用：WordPress调试模式。
 *
 * 将这个值改为true，WordPress将显示所有用于开发的提示。
 * 强烈建议插件开发者在开发环境中启用WP_DEBUG。
 */
define('WP_DEBUG', false);

/**
 * zh_CN本地化设置：启用ICP备案号显示
 *
 * 可在设置→常规中修改。
 * 如需禁用，请移除或注释掉本行。
 */
define('WP_ZH_CN_ICP_NUM', true);

/* 好了！请不要再继续编辑。请保存本文件。使用愉快！ */

/** WordPress目录的绝对路径。 */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** 设置WordPress变量和包含文件。 */
require_once(ABSPATH . 'wp-settings.php');
