<?php
/**
 * User: sayyid
 * Date: 30/07/2018
 * Time: 01:47 م
 */
try {
    include '../include/config.php';
    include '../include/functions.php';
    mb_internal_encoding('UTF-8');
//---------------check if table exists if not create table......
    if (tableExists($conn, 'fooddelivery_menu') !== true)
    {
        $sql = "CREATE TABLE IF NOT EXISTS `fooddelivery_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `res_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) 
";

        // use exec() because no results are returned
        $conn->exec($sql);
        echo "تم انشاء الجدول بنجاح!";
    }

    // get data via GET and store it into variables.
    // Example    127.0.0.1/fooddelivery_menu/push/fooddelivery_menu.php?id=10&name=بيتزا
    $id = isset($_GET['id']) && $_GET['id'] !== '' ? Quoted($_GET['id'])  : 'null';
    $name = isset($_GET['name']) && $_GET['name'] !== '' ? Quoted($_GET['name']) : 'null';


    //---- Replace into to merge data if not exist insert new record if exists update record.
    $sql = "REPLACE INTO fooddelivery_menu (id, name, created_at )
    VALUES ($id, $name, unix_timestamp(UTC_TIMESTAMP))";
    // use exec() because no results are returned
    // echo $sql;
    $conn->exec($sql);
    echo "تم اضافة صف جديد!";

}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}
