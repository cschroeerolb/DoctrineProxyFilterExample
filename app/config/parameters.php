<?php

$db_name = "OTESTDB";
$db_user = "AZUBI";
$db_password = "azubi";

$container->setParameter('database_driver', 'oci8');
$container->setParameter('database_host', $db_name);
$container->setParameter('database_port', null);
$container->setParameter('database_name', $db_name);
$container->setParameter('database_user', $db_user);
$container->setParameter('database_password', $db_password);

/**
 * Symfony erwartet auch den folgenden Parameter
 */
$container->setParameter('secret', 'ThisTokenIsNotSoSecretChangeIt');



?>
