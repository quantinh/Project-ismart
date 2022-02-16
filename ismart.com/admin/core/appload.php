<?php

defined('APPPATH') OR exit('Không được quyền truy cập phần này');

// Include file config/database
require CONFIGPATH . DIRECTORY_SEPARATOR . 'database.php';

// Include file config/config
require CONFIGPATH . DIRECTORY_SEPARATOR . 'config.php';

// Include file config/email
require CONFIGPATH . DIRECTORY_SEPARATOR . 'email.php';

// Include file config/autoload
require CONFIGPATH . DIRECTORY_SEPARATOR . 'autoload.php';

// Include core database
require LIBPATH . DIRECTORY_SEPARATOR . 'database.php';

// Include core base
require COREPATH . DIRECTORY_SEPARATOR . 'base.php';


// Nếu tồn tại array autoload thì duyệt qua và lấy ra các phần tử $list_auto(tự động lấy danh sách)
if (is_array($autoload)) {
    foreach ($autoload as $type => $list_auto) {
        if (!empty($list_auto)) {
            foreach ($list_auto as $name) {
                load($type, $name);
            }
        }
    }
}


// connect db
db_connect($db);

// Gọi file router.php làm việc 
require COREPATH . DIRECTORY_SEPARATOR . 'router.php';
















