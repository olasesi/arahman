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


define ('GEN_WEBSITE', 'http://localhost/arahman/arahman');	//
date_default_timezone_set('UTC');
session_start();

/*Local time (Nigeria)*/
define( 'OFFSET_TIME', '+1 hour' );



/*PRIMARY SCHOOL ADMIN ROLES*/
define("OWNER","owner");
define("ADMIN","admin");
define("ADMISSION","admission");
define('ACCOUNTANT', 'accountant');
define('HEADMASTER', 'headmaster');

/*SECONDARY SCHOOL ADMIN ROLES*/
define('PRINCIPAL', 'principal');
$now = new DateTime();					




/*Primary Classroom name*/
$pri_class_range = array('Basic one'=>'1', 'Basic two'=>'2', 'Basic three'=>'3', 'Basic four'=>'4', 'Basic five'=>'5', 'Basic six'=>'6');   

/*secondary Classroom name*/
$sec_class_range = array('JSS 1'=>'1', 'JSS 2'=>'2', 'JSS 3'=>'3', 'SSS 1'=>'4', 'SSS 2'=>'5', 'SSS 3'=>'6');   

/*common-entrance-fee*/
define('COMMON_ENTRANCE_FEE', 5000);


/*Age range*/

for($i=7;$i<70;$i++){
    $age_range[] = $i;
}

/*Primary class school fees in kobo
define("BASIC_ONE_FEES", 100000);
define("BASIC_TWO_FEES", 200000);
define("BASIC_THREE_FEES", 300000);
define("BASIC_FOUR_FEES", 400000);
define("BASIC_FIVE_FEES", 500000);
define("BASIC_SIX_FEES", 600000);
*/

/*API keys*/
define('API', 'Bearer sk_test_4cab8d4d937b1ab5f847c78c0014a2f6a6e3405c');


/*Result per page*/
$per_page = 1;




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




//Cron jobs
//CREATE EVENT foo ON SCHEDULE AT CURRENT_TIMESTAMP + INTERVAL 3 HOUR
//DO DELETE FROM my_table WHERE id = 123






//Techcrunch or Medium.


/*This directory is that of a folder behind the root directory */
//if ( ! defined( 'ABSPATH' ) ) {
//	define( 'ABSPATH', __DIR__ );
//}

//define( 'ROOT', 'arahman');

//require_once ("../arahman/autoloader/autoloader.php");



/*Loading contents of the user folder*/
