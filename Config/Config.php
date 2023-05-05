<?php 
 
 //define("BASE_URL", "http://localhost/tienda_virtual/");
 const BASE_URL = "http://localhost/Empresa_Genericav1";

 //Zona horaria
 //date_default_timezone_set('America/Honduras');

 //Datos de conexi贸n a Base de Datos
 const DB_HOST = "localhost";
 const DB_NAME = "gersonv2";
 const DB_USER = "root";
 const DB_PASSWORD = "";
 const DB_CHARSET = "utf8";
// Intentar conectarse a la base de datos
$conexion = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

//Para env铆o de correo
 const ENVIRONMENT = 0; // Local: 0, Producc贸n: 1;

 



// Comprobar si la conexi贸n fue exitosa

if(!$conexion){

 echo 'Conexion Fallida';
}
 //Deliminadores decimal y millar Ej. 24,1989.00
 const SPD = ".";
 const SPM = ",";

 //Simbolo de moneda
 const SMONEY = "L.";

 //Datos envio de correo
 const NOMBRE_REMITENTE = "Empresa Generica";
 const EMAIL_REMITENTE = "thegers@empresagenerica.com";
 const NOMBRE_EMPESA = "Empresa Generica";
 const WEB_EMPRESA = "https://empresagenerica.com";

 