<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);



include $_SERVER['DOCUMENT_ROOT'] . "/wp-config.php";
// коннектимся к базе данных
$mysql_database 	= DB_USER;
$mysql_username 	= DB_NAME;
$mysql_password 	= DB_PASSWORD;
$mysql_host 		= DB_HOST;
$dbpf 				= $table_prefix;

//Соединяемся с базой данных
$mysqli = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database);
if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
$mysqli->set_charset("utf8");


require_once __DIR__ . '/PHPExcel/Classes/PHPExcel.php';


$file =	__DIR__ . '/list(4).xls'; //файл с отзывами и вопросами



$list_col = 0;
$col_ean = 0;





set_time_limit(1800);
ini_set('memory_limit', '128M');
/*	some vars	*/
$chunkSize = 2000;		//размер считываемых строк за раз
$startRow = 2;			//начинаем читать со строки 2, в PHPExcel первая строка имеет индекс 1, и как правило это строка заголовков
$exit = false;			//флаг выхода
$empty_value = 0;		//счетчик пустых знаений
$sku_col = 0;
$ot_col = 0;
$vp_col = 0;
$ot_col_t = 0;
$vp_col_t = 0;



/*	some vars	*/
if (!file_exists($file)) {
    exit();
}
$document_new = new PHPExcel();
$sheet = $document_new->setActiveSheetIndex(0); // Выбираем первый лист в документе
$columnPosition = 0; // Начальная координата x
$startLine = 0; // Начальная координата y
$document_new->getActiveSheet()->getColumnDimension('A')->setWidth(10);
$document_new->getActiveSheet()->getColumnDimension("B")->setAutoSize(true);
$document_new->getActiveSheet()->getColumnDimension("C")->setAutoSize(true);
$columnPosition = 0; // Начальная координата x
$startLine = 0; // Начальная координата y
// Перекидываем указатель на следующую строку
$startLine++;
// Массив с названиями столбцов
$columns = ['№', 'Название компании', 'Ссылка'];
// Указатель на первый столбец
$currentColumn = $columnPosition;
// Формируем шапку
foreach ($columns as $column) {
    $sheet->setCellValueByColumnAndRow($currentColumn, $startLine, $column);
    // Смещаемся вправо
    $currentColumn++;
}
$startLine++;
// Формируем список
$key = 1;

$objReader = PHPExcel_IOFactory::createReaderForFile($file);
$objReader->setReadDataOnly(true);

$chunkFilter = new chunkReadFilter();
$objReader->setReadFilter($chunkFilter);
//внешний цикл, пока файл не кончится
while ( !$exit )
{
    // Вопрос-тема
    $chunkFilter->setRows($startRow,$chunkSize); 	//устанавливаем знаечние фильтра
    $objPHPExcel = $objReader->load($file);		//открываем файл
    $objPHPExcel->setActiveSheetIndex(0);		//устанавливаем индекс активной страницы
    $objWorksheet = $objPHPExcel->getActiveSheet();	//делаем активной нужную страницу
    for ($i = $startRow; $i < $startRow + $chunkSize; $i++) 	//внутренний цикл по строкам
    {


        $value0 = trim(htmlspecialchars($objWorksheet->getCellByColumnAndRow(0, $i)->getValue()));		//получаем первое знаение в строке
        $value1 = trim(htmlspecialchars($objWorksheet->getCellByColumnAndRow(1, $i)->getValue()));		//получаем первое знаение в ячейке B1
        $value2 = trim(htmlspecialchars($objWorksheet->getCellByColumnAndRow(2, $i)->getValue()));		//получаем первое знаение в строке
        $value3 = trim(htmlspecialchars($objWorksheet->getCellByColumnAndRow(3, $i)->getValue()));		//получаем первое знаение в строке
        $value4 = trim(htmlspecialchars($objWorksheet->getCellByColumnAndRow(4, $i)->getValue()));		//получаем первое знаение в строке
        $value5 = trim(htmlspecialchars($objWorksheet->getCellByColumnAndRow(5, $i)->getValue()));		//получаем первое знаение в строке
        $value6 = trim(htmlspecialchars($objWorksheet->getCellByColumnAndRow(6, $i)->getValue()));		//получаем первое знаение в строке
        $value7 = trim(htmlspecialchars($objWorksheet->getCellByColumnAndRow(7, $i)->getValue()));		//получаем первое знаение в строке
        $value8 = trim(htmlspecialchars($objWorksheet->getCellByColumnAndRow(8, $i)->getValue()));		//получаем первое знаение в строке
        $value9 = trim(htmlspecialchars($objWorksheet->getCellByColumnAndRow(9, $i)->getValue()));		//получаем первое знаение в строке
        $value10 = trim(htmlspecialchars($objWorksheet->getCellByColumnAndRow(10, $i)->getValue()));		//получаем первое знаение в строке
        $value11 = trim(htmlspecialchars($objWorksheet->getCellByColumnAndRow(11, $i)->getValue()));		//получаем первое знаение в строке
        $value12 = trim(htmlspecialchars($objWorksheet->getCellByColumnAndRow(12, $i)->getValue()));		//получаем первое знаение в строке
        $value13 = trim(htmlspecialchars($objWorksheet->getCellByColumnAndRow(13, $i)->getValue()));		//получаем первое знаение в строке
        $value14 = trim(htmlspecialchars($objWorksheet->getCellByColumnAndRow(14, $i)->getValue()));		//получаем первое знаение в строке
        $value15 = trim(htmlspecialchars($objWorksheet->getCellByColumnAndRow(15, $i)->getValue()));		//получаем первое знаение в строке
        $value16 = trim(htmlspecialchars($objWorksheet->getCellByColumnAndRow(16, $i)->getValue()));		//получаем первое знаение в строке
        $value17 = trim(htmlspecialchars($objWorksheet->getCellByColumnAndRow(17, $i)->getValue()));		//получаем первое знаение в строке
        $value18 = trim(htmlspecialchars($objWorksheet->getCellByColumnAndRow(18, $i)->getValue()));		//получаем первое знаение в строке
        $value19 = trim(htmlspecialchars($objWorksheet->getCellByColumnAndRow(19, $i)->getValue()));		//получаем первое знаение в строке
        $value20 = trim(htmlspecialchars($objWorksheet->getCellByColumnAndRow(20, $i)->getValue()));		//получаем первое знаение в строке
        $value21 = trim(htmlspecialchars($objWorksheet->getCellByColumnAndRow(21, $i)->getValue()));		//получаем первое знаение в строке
        $value22 = trim(htmlspecialchars($objWorksheet->getCellByColumnAndRow(22, $i)->getValue()));		//получаем первое знаение в строке
        if (trim($value0) != '')	//проверяем значение на пустоту
        {
            $vp_col++;
            $post_id = 0;

            $res2 = $mysqli->query("SELECT post_id AS post_id FROM `" . $dbpf . "postmeta` WHERE `meta_value` = '".$value0."' AND `meta_key` =  '_excel_id' LIMIT 1");
            if($res2) {
                while ($row2 = $res2->fetch_object()){
                    $post_id =  $row2->post_id;
                }
            }

         if($post_id <= 0) {
             $vp_col_t++;
            $id = $value0;
            $post_content = '';


             $post_date = date("Y-m-d H:i:s");


            $post_value2 = explode('|', $value2);
            $post_value22 = str_replace(' |', ', ', $value22);

            $post_content = '<p>' . $post_value2[0] . ' «<strong>' .  $value1 . '</strong>»</p>';
             if(trim($value9) != ''){
            $post_content .= '<p>Адресс: ' . $value9 . '</p>';
            }
            if(trim($value13) != ''){
            $post_content .= '<p>График работы: ' . $value13 . '</p>';
            }
            if(trim($post_value22) != ''){
                $post_content .= '<p>тел. ' . $post_value22 . '</p>';
            }

             if(trim($value18) != ''){
                 $post_value18 = str_replace('|', '<br>', $value18);
                 $post_content .= '<p>' . $post_value18 . '</p>';
             }


            $post_title = $post_value2[0] . ' "' . $value1 . '"';
            $post_title = 'Отзывы про "' . $value1 . '"';

            $post_name = translit($post_title);

            $post_guid = 'http://otvet123.ru/q/' . $post_name . '/';
             $user_login = rand(1, 11);
             $user_login = skumstr($user_login);
             $user_login = translit($user_login);
             $user_pass = '59be0ea66a98715c7b26f78e20824807';
             $user_nicename = $user_login;
             $user_email = $user_login . '@mail.ru';




             $mysqli->query("INSERT INTO `" . $dbpf . "users` (`user_login`, `user_pass`, `user_nicename`, `user_email`, `user_registered`, `user_status`, `display_name`) VALUES ('".$user_login."', '".$user_pass."', '".$user_nicename."', '".$user_email."', '".$post_date."', '0', '".$user_login."')");

             $user_id_new = $mysqli->insert_id;

             $mysqli->query("INSERT INTO `" . $dbpf . "usermeta` (`user_id`, `meta_key`, `meta_value`) VALUES ('".$user_id_new."', 'nickname', '".$user_login."')");
             $mysqli->query("INSERT INTO `" . $dbpf . "usermeta` (`user_id`, `meta_key`, `meta_value`) VALUES ('".$user_id_new."', 'first_name', '')");
             $mysqli->query("INSERT INTO `" . $dbpf . "usermeta` (`user_id`, `meta_key`, `meta_value`) VALUES ('".$user_id_new."', 'last_name', '')");
             $mysqli->query("INSERT INTO `" . $dbpf . "usermeta` (`user_id`, `meta_key`, `meta_value`) VALUES ('".$user_id_new."', 'description', '')");
             $mysqli->query("INSERT INTO `" . $dbpf . "usermeta` (`user_id`, `meta_key`, `meta_value`) VALUES ('".$user_id_new."', 'rich_editing', 'true')");
             $mysqli->query("INSERT INTO `" . $dbpf . "usermeta` (`user_id`, `meta_key`, `meta_value`) VALUES ('".$user_id_new."', 'comment_shortcuts', 'alse')");
             $mysqli->query("INSERT INTO `" . $dbpf . "usermeta` (`user_id`, `meta_key`, `meta_value`) VALUES ('".$user_id_new."', 'admin_color', 'fresh')");
             $mysqli->query("INSERT INTO `" . $dbpf . "usermeta` (`user_id`, `meta_key`, `meta_value`) VALUES ('".$user_id_new."', 'use_ssl', '0')");
             $mysqli->query("INSERT INTO `" . $dbpf . "usermeta` (`user_id`, `meta_key`, `meta_value`) VALUES ('".$user_id_new."', 'show_admin_bar_front', '	
true')");
             $mysqli->query("INSERT INTO `" . $dbpf . "usermeta` (`user_id`, `meta_key`, `meta_value`) VALUES ('".$user_id_new."', 'wp_capabilities', 'a:1:{s:6:\"author\";b:1;}')");
             $mysqli->query("INSERT INTO `" . $dbpf . "usermeta` (`user_id`, `meta_key`, `meta_value`) VALUES ('".$user_id_new."', '	
wp_user_level', '2')");
             $mysqli->query("INSERT INTO `" . $dbpf . "usermeta` (`user_id`, `meta_key`, `meta_value`) VALUES ('".$user_id_new."', 'qa_point', '1')");
             $mysqli->query("INSERT INTO `" . $dbpf . "usermeta` (`user_id`, `meta_key`, `meta_value`) VALUES ('".$user_id_new."', 'et_question_count', '0')");
             $mysqli->query("INSERT INTO `" . $dbpf . "usermeta` (`user_id`, `meta_key`, `meta_value`) VALUES ('".$user_id_new."', 'et_answer_count', '0')");
             $mysqli->query("INSERT INTO `" . $dbpf . "usermeta` (`user_id`, `meta_key`, `meta_value`) VALUES ('".$user_id_new."', 'key_confirm', '72e2c6b5f0726b355da47dcacfce9ca9')");
             $mysqli->query("INSERT INTO `" . $dbpf . "usermeta` (`user_id`, `meta_key`, `meta_value`) VALUES ('".$user_id_new."', 'dismissed_wp_pointers', '')");
             $mysqli->query("INSERT INTO `" . $dbpf . "usermeta` (`user_id`, `meta_key`, `meta_value`) VALUES ('".$user_id_new."', 'qa_following_questions', 'a:4:{i:1;i:18390;i:2;s:5:\"11612\";i:3;s:4:\"6025\";i:4;s:5:\"13803\";}')");
             $mysqli->query("INSERT INTO `" . $dbpf . "usermeta` (`user_id`, `meta_key`, `meta_value`) VALUES ('".$user_id_new."', 'session_tokens', 'a:1:{s:64:\"48333508f98110b58e5d2d4c6445e8049525af62cf02b82f95316083d8086b5a\";a:4:{s:10:\"expiration\";i:1550237526;s:2:\"ip\";s:15:\"178.204.201.248\";s:2:\"ua\";s:114:\"Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36\";s:5:\"login\";i:1549027926;}}')");



                 $startLine++;
                 // Указатель на первый столбец
                 $currentColumn = $columnPosition;
                 // Вставляем порядковый номер
                 $sheet->setCellValueByColumnAndRow($currentColumn, $startLine, $key++);
                 $currentColumn++;
                 $sheet->setCellValueByColumnAndRow($currentColumn, $startLine, $post_title);
                 $currentColumn++;
                 $sheet->setCellValueByColumnAndRow($currentColumn, $startLine, $post_guid);


             $post_content = str_replace("'",'"', $post_content);

                $mysqli->query("INSERT INTO `" . $dbpf . "posts` (`post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES ('".$user_id_new."', '".$post_date."', '".$post_date."', '".$post_content."', '".$post_title."', '', 'publish', 'open', 'closed', '', '".$post_name."', '', '', '".$post_date."', '".$post_date."', '', '0', '".$post_guid."', '0', 'question', '', '0')");

                $post_id_new = $mysqli->insert_id;

                $mysqli->query("INSERT INTO `" . $dbpf . "postmeta` (`post_id`, `meta_key`, `meta_value`) VALUES ('".$post_id_new."', '_excel_id', '".$id."')");

                $mysqli->query("INSERT INTO `" . $dbpf . "term_relationships` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES ('".$post_id_new."', '618', '0')");


             foreach ($post_value2 as $post_val) {
                 $post_id_tag = 0;
                 $name_tag = trim($post_val);
                 $slug_tag = translit($name_tag);

                 $res_tag = $mysqli->query("SELECT post_id AS post_id FROM `" . $dbpf . "terms` WHERE `name` LIKE '%".$name_tag."%' LIMIT 1");
                 if($res_tag) {
                     while ($row_tag = $res_tag->fetch_object()){
                         $post_id_tag =  $row_tag->post_id;
                     }
                 }
                 if($post_id_tag <= 0) {
                     $mysqli->query("INSERT INTO `" . $dbpf . "terms` (`name`, `slug`) VALUES ('".$name_tag."', '".$slug_tag."')");
                     $post_id_tag = $mysqli->insert_id;
                     $mysqli->query("INSERT INTO `" . $dbpf . "term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`) VALUES ('".$post_id_tag."', '".$post_id_tag."', 'qa_tag')");
                     $mysqli->query("INSERT INTO `" . $dbpf . "term_relationships` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES ('".$post_id_new."', '".$post_id_tag."', '0')");
                 } else {
                     $mysqli->query("INSERT INTO `" . $dbpf . "term_relationships` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES ('".$post_id_new."', '".$post_id_tag."', '0')");
                 }
             }



             $et_view_count = rand(1, 444);

             $pump_time = '1547643640';
             $et_vote_count = '0';  // кол лайков
             //$et_view_count = '47';
             $et_users_follow = '';
             $et_new_post = '1';
             $et_answers_count = '0';
             $a_description = '';
             $edit_last = '1';
             $et_last_author = '';
             $et_updated_date = $post_date;
             $et_answer_authors = '';

             ///    Questions   -------Вопросы
             $mysqli->query("INSERT INTO `" . $dbpf . "postmeta` (`post_id`, `meta_key`, `meta_value`) VALUES ('".$post_id_new."', 'et_pump_time', '".$pump_time."')");
             $mysqli->query("INSERT INTO `" . $dbpf . "postmeta` (`post_id`, `meta_key`, `meta_value`) VALUES ('".$post_id_new."', 'et_vote_count', '".$et_vote_count."')");
             $mysqli->query("INSERT INTO `" . $dbpf . "postmeta` (`post_id`, `meta_key`, `meta_value`) VALUES ('".$post_id_new."', 'et_view_count', '".$et_view_count."')");
             $mysqli->query("INSERT INTO `" . $dbpf . "postmeta` (`post_id`, `meta_key`, `meta_value`) VALUES ('".$post_id_new."', 'et_users_follow', '".$et_users_follow."')");
             $mysqli->query("INSERT INTO `" . $dbpf . "postmeta` (`post_id`, `meta_key`, `meta_value`) VALUES ('".$post_id_new."', 'et_new_post', '".$et_new_post."')");
             $mysqli->query("INSERT INTO `" . $dbpf . "postmeta` (`post_id`, `meta_key`, `meta_value`) VALUES ('".$post_id_new."', 'et_answers_count', '".$et_answers_count."')");
             $mysqli->query("INSERT INTO `" . $dbpf . "postmeta` (`post_id`, `meta_key`, `meta_value`) VALUES ('".$post_id_new."', '_edit_lock', '".$edit_lock."')");
             $mysqli->query("INSERT INTO `" . $dbpf . "postmeta` (`post_id`, `meta_key`, `meta_value`) VALUES ('".$post_id_new."', '_edit_last', '".$edit_last."')");
             $mysqli->query("INSERT INTO `" . $dbpf . "postmeta` (`post_id`, `meta_key`, `meta_value`) VALUES ('".$post_id_new."', '_aioseop_description', '".$a_description."')");
             $mysqli->query("INSERT INTO `" . $dbpf . "postmeta` (`post_id`, `meta_key`, `meta_value`) VALUES ('".$post_id_new."', 'et_last_author', '".$et_last_author."')");
             $mysqli->query("INSERT INTO `" . $dbpf . "postmeta` (`post_id`, `meta_key`, `meta_value`) VALUES ('".$post_id_new."', 'et_updated_date', '".$et_updated_date."')");
             $mysqli->query("INSERT INTO `" . $dbpf . "postmeta` (`post_id`, `meta_key`, `meta_value`) VALUES ('".$post_id_new."', 'et_answer_authors', '".$et_answer_authors."')");



            }


            $sku_col++;


            $empty_value = 1;
        } else {
            $empty_value++;
        }
        if ($empty_value == 10)		//после 10 пустых значений, завершаем обработку файла, думая, что это конец
        {
            $exit = true;
            continue;
        }
        /*Манипуляции с данными каким Вам угодно способом, в PHPExcel их превеликое множество*/
    }
    $objPHPExcel->disconnectWorksheets(); 				//чистим
    unset($objPHPExcel); 						//память
    $startRow += $chunkSize;					//переходим на следующий шаг цикла, увеличивая строку, с которой будем читать файл
}

/*	some vars	*/
$chunkSize = 2000;		//размер считываемых строк за раз
$startRow = 2;			//начинаем читать со строки 2, в PHPExcel первая строка имеет индекс 1, и как правило это строка заголовков
$exit = false;			//флаг выхода
$empty_value = 0;		//счетчик пустых знаений
$sku_col = 0;
/*	some vars	*/
if (!file_exists($file)) {
    exit();
}

echo 'Обработано вопросов ' . $vp_col;
echo '<br>';
echo 'Добавлено вопросов ' . $vp_col_t;
echo '<br>------------------------------------<br>';

$objReader = PHPExcel_IOFactory::createReaderForFile($file);
$objReader->setReadDataOnly(true);

$chunkFilter = new chunkReadFilter();
$objReader->setReadFilter($chunkFilter);
//внешний цикл, пока файл не кончится
while ( !$exit )
{
    $chunkFilter->setRows($startRow,$chunkSize); 	//устанавливаем знаечние фильтра
    $objPHPExcel = $objReader->load($file);		//открываем файл
    $objPHPExcel->setActiveSheetIndex(1);		//устанавливаем индекс активной страницы
    $objWorksheet = $objPHPExcel->getActiveSheet();	//делаем активной нужную страницу
    for ($i = $startRow; $i < $startRow + $chunkSize; $i++) 	//внутренний цикл по строкам
    {
        $value0 = trim(htmlspecialchars($objWorksheet->getCellByColumnAndRow(0, $i)->getValue()));		//получаем первое знаение в строке
        $value1 = trim(htmlspecialchars($objWorksheet->getCellByColumnAndRow(1, $i)->getValue()));		//получаем первое знаение в строке
        $value2 = trim(htmlspecialchars($objWorksheet->getCellByColumnAndRow(2, $i)->getValue()));		//получаем первое знаение в строке
        $value3 = trim(htmlspecialchars($objWorksheet->getCellByColumnAndRow(3, $i)->getValue()));		//получаем первое знаение в строке
        $value4 = trim(htmlspecialchars($objWorksheet->getCellByColumnAndRow(4, $i)->getValue()));		//получаем первое знаение в строке
        $value5 = trim(htmlspecialchars($objWorksheet->getCellByColumnAndRow(5, $i)->getValue()));		//получаем первое знаение в строке
        $value6 = trim(htmlspecialchars($objWorksheet->getCellByColumnAndRow(6, $i)->getValue()));		//получаем первое знаение в строке
        $value7 = trim(htmlspecialchars($objWorksheet->getCellByColumnAndRow(7, $i)->getValue()));		//получаем первое знаение в строке
        $value8 = trim(htmlspecialchars($objWorksheet->getCellByColumnAndRow(8, $i)->getValue()));		//получаем первое знаение в строке
        if (trim($value0) != '' && trim($value3) != '')	//проверяем значение на пустоту
        {
            $ot_col++;

            if (trim($value2) != '') {
                $user_login = translit($value2);
                $user_id = translit($value2);
            } else {
                $user_login = rand(1, 11);
                $user_login = skumstr($user_login);
                $user_login = translit($user_login);
                $arr_value3 = explode(' ',trim($value3));
                $user_id = translit($arr_value3[0]);
            }
            $user_login_id = $value0 . $user_id;





            $user_post_id = 0;

            $res2 = $mysqli->query("SELECT post_id AS post_id FROM `" . $dbpf . "postmeta` WHERE `meta_value` = '".$user_login_id."' AND `meta_key` =  '_user_login_id' LIMIT 1");
            if($res2) {
                while ($row2 = $res2->fetch_object()){
                    $user_post_id =  $row2->post_id;
                }
            }

            if($user_post_id <= 0) {

                $user_pass = '59be0ea66a98715c7b26f78e20824807';
                $user_nicename = $user_login;
                $user_email = $user_login . '@mail.ru';




                $post_id = 0;

                $res2 = $mysqli->query("SELECT post_id AS post_id FROM `" . $dbpf . "postmeta` WHERE `meta_value` = '" . $value0 . "' AND `meta_key` =  '_excel_id' LIMIT 1");
                if ($res2) {
                    while ($row2 = $res2->fetch_object()) {
                        $post_id = $row2->post_id;
                    }
                }

                if ($post_id > 0) {


                    $ot_col_t++;

                    $mysqli->query("INSERT INTO `" . $dbpf . "users` (`user_login`, `user_pass`, `user_nicename`, `user_email`, `user_registered`, `user_status`, `display_name`) VALUES ('" . $user_login . "', '" . $user_pass . "', '" . $user_nicename . "', '" . $user_email . "', '" . $post_date . "', '0', '" . $user_login . "')");

                    $user_id_new = $mysqli->insert_id;


                    $mysqli->query("INSERT INTO `" . $dbpf . "usermeta` (`user_id`, `meta_key`, `meta_value`) VALUES ('" . $user_id_new . "', 'nickname', '" . $user_login . "')");
                    $mysqli->query("INSERT INTO `" . $dbpf . "usermeta` (`user_id`, `meta_key`, `meta_value`) VALUES ('" . $user_id_new . "', 'first_name', '')");
                    $mysqli->query("INSERT INTO `" . $dbpf . "usermeta` (`user_id`, `meta_key`, `meta_value`) VALUES ('" . $user_id_new . "', 'last_name', '')");
                    $mysqli->query("INSERT INTO `" . $dbpf . "usermeta` (`user_id`, `meta_key`, `meta_value`) VALUES ('" . $user_id_new . "', 'description', '')");
                    $mysqli->query("INSERT INTO `" . $dbpf . "usermeta` (`user_id`, `meta_key`, `meta_value`) VALUES ('" . $user_id_new . "', 'rich_editing', 'true')");
                    $mysqli->query("INSERT INTO `" . $dbpf . "usermeta` (`user_id`, `meta_key`, `meta_value`) VALUES ('" . $user_id_new . "', 'comment_shortcuts', 'alse')");
                    $mysqli->query("INSERT INTO `" . $dbpf . "usermeta` (`user_id`, `meta_key`, `meta_value`) VALUES ('" . $user_id_new . "', 'admin_color', 'fresh')");
                    $mysqli->query("INSERT INTO `" . $dbpf . "usermeta` (`user_id`, `meta_key`, `meta_value`) VALUES ('" . $user_id_new . "', 'use_ssl', '0')");
                    $mysqli->query("INSERT INTO `" . $dbpf . "usermeta` (`user_id`, `meta_key`, `meta_value`) VALUES ('" . $user_id_new . "', 'show_admin_bar_front', '	
true')");
                    $mysqli->query("INSERT INTO `" . $dbpf . "usermeta` (`user_id`, `meta_key`, `meta_value`) VALUES ('" . $user_id_new . "', 'wp_capabilities', 'a:1:{s:6:\"author\";b:1;}')");
                    $mysqli->query("INSERT INTO `" . $dbpf . "usermeta` (`user_id`, `meta_key`, `meta_value`) VALUES ('" . $user_id_new . "', '	
wp_user_level', '2')");
                    $mysqli->query("INSERT INTO `" . $dbpf . "usermeta` (`user_id`, `meta_key`, `meta_value`) VALUES ('" . $user_id_new . "', 'qa_point', '1')");
                    $mysqli->query("INSERT INTO `" . $dbpf . "usermeta` (`user_id`, `meta_key`, `meta_value`) VALUES ('" . $user_id_new . "', 'et_question_count', '0')");
                    $mysqli->query("INSERT INTO `" . $dbpf . "usermeta` (`user_id`, `meta_key`, `meta_value`) VALUES ('" . $user_id_new . "', 'et_answer_count', '0')");
                    $mysqli->query("INSERT INTO `" . $dbpf . "usermeta` (`user_id`, `meta_key`, `meta_value`) VALUES ('" . $user_id_new . "', 'key_confirm', '72e2c6b5f0726b355da47dcacfce9ca9')");
                    $mysqli->query("INSERT INTO `" . $dbpf . "usermeta` (`user_id`, `meta_key`, `meta_value`) VALUES ('" . $user_id_new . "', 'dismissed_wp_pointers', '')");
                    $mysqli->query("INSERT INTO `" . $dbpf . "usermeta` (`user_id`, `meta_key`, `meta_value`) VALUES ('" . $user_id_new . "', 'qa_following_questions', 'a:4:{i:1;i:18390;i:2;s:5:\"11612\";i:3;s:4:\"6025\";i:4;s:5:\"13803\";}')");
                    $mysqli->query("INSERT INTO `" . $dbpf . "usermeta` (`user_id`, `meta_key`, `meta_value`) VALUES ('" . $user_id_new . "', 'session_tokens', 'a:1:{s:64:\"48333508f98110b58e5d2d4c6445e8049525af62cf02b82f95316083d8086b5a\";a:4:{s:10:\"expiration\";i:1550237526;s:2:\"ip\";s:15:\"178.204.201.248\";s:2:\"ua\";s:114:\"Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36\";s:5:\"login\";i:1549027926;}}')");


                    $res_title = $mysqli->query("SELECT post_title AS post_title FROM `" . $dbpf . "posts` WHERE `ID` =  $post_id LIMIT 1");
                    if ($res_title) {
                        while ($row_title = $res_title->fetch_object()) {
                            $post_title = $row_title->post_title;
                        }
                    }

                    $post_content = '<p>' . $value3 . '</p>';
                    $post_date = date("Y-m-d H:i:s");
                    $post_title = 'RE: ' . $post_title;
                    $post_name = translit($post_title);

                    $value4 = explode('T', $value4);
                    $value4_t = substr($value4[1], 0, 8);


                    $new_date_post = $value4[0] .' ' . $value4_t;

                    $et_vote_count = $value6 - $value7;





                    $post_guid = 'http://otvet123.ru/answer/' . $post_name . '/';


                    $post_date = $new_date_post;

                    $post_content = str_replace("'",'"', $post_content);

                    $mysqli->query("INSERT INTO `" . $dbpf . "posts` (`post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES ('" . $user_id_new . "', '" . $post_date . "', '" . $post_date . "', '" . $post_content . "', '" . $post_title . "', '', 'publish', 'open', 'closed', '', '" . $post_name . "', '', '', '" . $post_date . "', '" . $post_date . "', '', '" . $post_id . "', '" . $post_guid . "', '0', 'answer', '', '0')");

                    $post_id_new = $mysqli->insert_id;

                    $mysqli->query("INSERT INTO `" . $dbpf . "postmeta` (`post_id`, `meta_key`, `meta_value`) VALUES ('" . $post_id_new . "', '_user_login_id', '" . $user_login_id . "')");


                    ////     Answers   --------Ответы
                    $mysqli->query("INSERT INTO `" . $dbpf . "postmeta` (`post_id`, `meta_key`, `meta_value`) VALUES ('".$post_id_new."', 'et_vote_count', '".$et_vote_count."')");
                    $mysqli->query("INSERT INTO `" . $dbpf . "postmeta` (`post_id`, `meta_key`, `meta_value`) VALUES ('".$post_id_new."', '_edit_lock', '1549574430:1')");

                    $mysqli->query("UPDATE `" . $dbpf . "posts` SET `post_date` = '" . $post_date . "', `post_date_gmt` = '" . $post_date . "', `post_modified` = '" . $post_date . "', `post_modified_gmt` = '" . $post_date . "' WHERE `ID` = '" . $post_id . "'");



                }

            }

            $empty_value = 1;
        } else {
            $empty_value++;
        }
        if ($empty_value == 10)		//после 10 пустых значений, завершаем обработку файла, думая, что это конец
        {
            $exit = true;
            continue;
        }
        /*Манипуляции с данными каким Вам угодно способом, в PHPExcel их превеликое множество*/
    }
    $objPHPExcel->disconnectWorksheets(); 				//чистим
    unset($objPHPExcel); 						//память
    $startRow += $chunkSize;					//переходим на следующий шаг цикла, увеличивая строку, с которой будем читать файл
}

echo 'Обработано ответов ' . $ot_col;
echo '<br>';
echo 'Добавлено ответов ' . $ot_col_t;



$objWriter = PHPExcel_IOFactory::createWriter($document_new, 'Excel5');



$objWriter->save("List.xls");


echo '<br>';
echo '<a href="/importPHPExcel/List.xls" class="function">List.xls скачать</a>';





function translit($s) {
    $s = (string) $s;
    $s = strip_tags($s);
    $s = str_replace(array("\n", "\r"), " ", $s);
    $s = preg_replace("/\s+/", ' ', $s);
    $s = trim($s);
    $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s);
    $s = strtr($s, array('а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'e','ж'=>'j','з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h','ц'=>'c','ч'=>'ch','ш'=>'sh','щ'=>'shch','ы'=>'y','э'=>'e','ю'=>'yu','я'=>'ya','ъ'=>'','ь'=>''));
    $s = preg_replace("/[^0-9a-z-_ ]/i", "", $s);
    $s = str_replace(" ", "-", $s);
    return $s;
}

function skumstr($skumstr) {
    $skumar = array(
        '1' => 'Вячеслав 32',
        '2' => 'Анна 54',
        '3' => 'Сергей 43',
        '4' => 'Егор 23',
        '5' => 'Светлана 99',
        '6' => 'Алеся 87',
        '7' => 'Никита 78',
        '8' => 'Евгений 865',
        '9' => 'Алексей 124',
        '10'				=>'Евгений Чувааааааак',
        '11'				=>'Чувааааааак Алексей'
    );
    return strtr($skumstr,$skumar);
}

