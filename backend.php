<?php
    class Reservation {
        private $pdo; // PDO object
        private $stmt; // SQL statement
        public $error; // Error message
        public $succes; // succes message

        // Connect naar database
        function __construct() {
            try {
            $this->pdo = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET,
                DB_USER, DB_PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
            } catch (Exception $ex) { die($ex->getMessage()); }
        }

        // close database
        function __destruct() {
            $this->pdo = null;
            $this->stmt = null;
        }

            
        // save a reservation
        function save ($date, $time, $name, $tel) {

            // DATABASE ENTRY
            try {
            $this->stmt = $this->pdo->prepare(
                "INSERT INTO `reservations` (`res_date`, `res_time`, `res_name`, `res_tel`) VALUES (?,?,?,?)"
            );
            $this->stmt->execute([$date, $time, $name, $tel]);
            } catch (Exception $ex) {
                $this->error = $ex->getMessage();
                return false;
            }
        }
        
        // reserveringen voor de dag
        function getDay ($day="") {
            // (E1) DEFAULT TO TODAY
            if ($day=="") { $day = date("Y-m-d"); }
            
            // (E2) GET ENTRIES
            $this->stmt = $this->pdo->prepare(
            "SELECT * FROM `reservations` WHERE `res_date`=?"
            );
            $this->stmt->execute([$day]);
            return $this->stmt->fetchAll(PDO::FETCH_NAMED);
        }
    }

    // data base settings
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'tcr');
    define('DB_CHARSET', 'utf8');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');

    // Nieuwe reservering
    $_RSV = new Reservation();

