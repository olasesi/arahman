<?php
/**
 * 
 * * MySQL settings
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the */
define( 'DB_NAME', 'arahman_portal');

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );


define ('GEN_WEBSITE', 'http://localhost/arahman');	//
date_default_timezone_set('UTC');
session_start();


/*PRIMARY SCHOOL ADMIN ROLES*/
define("OWNER","owner");
define("ADMISSION","admission");
define('HEADMASTER', 'headmaster');
define('ACCOUNTANT', 'accountant');
$now = new DateTime();					




/*Classroom name*/
$class_range = array('Basic one'=>'1', 'Basic two'=>'2', 'Basic three'=>'3', 'Basic four'=>'4', 'Basic five'=>'5', 'Basic six'=>'6');   
$age_range = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20); 


/*Primary class school fees in kobo*/
define("BASIC_ONE_FEES", 100000);
define("BASIC_TWO_FEES", 200000);
define("BASIC_THREE_FEES", 300000);
define("BASIC_FOUR_FEES", 400000);
define("BASIC_FIVE_FEES", 500000);
define("BASIC_SIX_FEES", 600000);


/*API keys*/








function genReference($qtd){
    //Under the string $Caracteres you write all the characters you want to be used to randomly generate the code.
        $Caracteres = 'ABCDEFGHIJKLMOPQRSTUVXWYZ0123456789';
        $QuantidadeCaracteres = strlen($Caracteres);
        $QuantidadeCaracteres--;
    
        $reference=NULL;
    
        for($x=1;$x<=$qtd;$x++){
            $Posicao = rand(0,$QuantidadeCaracteres);
            $reference .= substr($Caracteres,$Posicao,1);
        }
    
        return $reference;
    }











//Techcrunch or Medium.


/*This directory is that of a folder behind the root directory */
//if ( ! defined( 'ABSPATH' ) ) {
//	define( 'ABSPATH', __DIR__ );
//}

//define( 'ROOT', 'arahman');

//require_once ("../arahman/autoloader/autoloader.php");



/*Loading contents of the user folder*/

