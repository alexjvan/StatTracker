<?php
	// https://www.openshift.com/
    class DB {
        private static function connect() {
            $pdo = new PDO('mysql:host=localhost;dbname=stattracker;charset=utf8', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        }

        public static function jsquery($query, $params = array()) {
            $statement = self::connect()->prepare($query);
            $statement->execute($params);
            if(explode(' ', $query)[0] == 'SELECT') {
                $data = $statement->fetchAll(PDO::FETCH_ASSOC);
                return $data;
            }
        }

        public static function query($query, $params = array()) {
            $statement = self::connect()->prepare($query);
            $statement->execute($params);
            if(explode(' ', $query)[0] == 'SELECT') {
                $data = $statement->fetchAll();
                return $data;
            }
        }
    }
?>
