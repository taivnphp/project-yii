<?php 
/*DB config*/
return array(
    'class' => 'CDbConnection',
    'connectionString' => "mysql:host=localhost;dbname=example_medical",
    'emulatePrepare'   => true,
    'username'         => 'root',
    'password'         => 'root',
    'charset'          => 'utf8',
);
?>