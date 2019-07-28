<?php
     class Database
     {
        private $dsn,$dbh,$stmt;

        public function __construct() {
            $this->dsn = 'mysql:host='.DB_HOST.';dbname='.DB_NAME;
            try {
                $this->dbh = new PDO($dsn,DB_USER,DB_PASS);
                $this->dbh = setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('DAtabase error : '.$e);
            }
        }

        // *basic func prepare dan execute
        public function prepare($pre)
        {
            $this->stmt = $this->dbh->prepare($pre);
        }
        // *bind sql injection
        public function bind($type = null,$param,$value)
        {
            if ($type == null) {
                switch ($value) {
                    case is_int($value):
                        $type = PDO::PARAM_INT;
                        break;
                    case is_bool($value):
                        $type = PDO::PARAM_BOOL;
                        break;
                    case is_null($value):
                        $type = PDO::PARAM_NULL;
                        break;
                    default:
                        $type = PDO::PARAM_STR;
                        break;
                }
            }
        }

        public function execute()
        {
            $this->stmt->execute();
        }

        // *mengambil semua data
        public function queryAll()
        {
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        // *mengambil satu data
        public function quoryOne()
        {
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_ASSOC);
        }
        // *menghiting kolom yang berubah
        public function rowCount()
        {
            return $this->stmt->rowCount();
        }
     }
     