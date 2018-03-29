<?php

class db
{
    public $dbh;

    // Create a database connection for use by all functions in this class

    public static function getInstance()
    {
        static $instance = null;
        if ($instance === null)
        {
            $instance = new db();
        }
        return $instance;
    }

    function __construct()
    {

        if ($this->dbh = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT))
        {
        }
        else
        {
            exit('Unable to connect to DB');
        }
        // Set every possible option to utf-8
        mysqli_query($this->dbh, 'SET NAMES "utf8"');
        mysqli_query($this->dbh, 'SET CHARACTER SET "utf8"');
    }

    // Create a standard data format for insertion of PHP dates into MySQL
    public function date($php_date)
    {
        return date('Y-m-d H:i:s', strtotime($php_date));
    }

    // All text added to the DB should be cleaned with mysqli_real_escape_string
    // to block attempted SQL insertion exploits
    public function escape($str)
    {
        return mysqli_real_escape_string($this->dbh, $str);
    }

    // Perform a generic select and return a pointer to the result
    public function select($query)
    {
        $result = mysqli_query($this->dbh, $query);
        return $result;
    }

    // Update any row that matches a WHERE clause
    public function update($table, $field_values, $where)
    {
        $query = 'UPDATE ' . $table . ' SET ' . $field_values .
            ' WHERE ' . $where;
        mysqli_query($this->dbh, $query);
    }

    public function getAll($sql)
    {
        

        $result = $this->select($sql);
        $res = array();
        while ($row = mysqli_fetch_assoc($result))
        {
            $res[] = $row;
        }
        return $res;
    }

    public function getRow($sql)
    {
        

        $result = $this->select($sql);
        if (empty($result))
        {
            //debug_print_backtrace();
            return null;
        }
        else
        {
            return mysqli_fetch_assoc($result);
        }
    }

    public function getCell($sql)
    {
        //

        $res = $this->getRow($sql);
        if (empty($res))
        {
            //debug_print_backtrace();
            return null;
        }
        else
        {
            return reset($res);
        }
    }

    public function getCol($sql)
    {
        

        $column = array();
        $result = $this->select($sql);

        while ($row = mysqli_fetch_array($result))
        {
            $column[] = reset($row);
        }
        return $column;
    }

    public function sql($sql)
    {
        
		if(!empty($_GET['debugsql'])){
			echo '<pre>';
			echo $sql;	
			echo '</pre>';
		}
        $this->dbh->query($sql);
        $error = $this->dbh->error;
        if (!empty($error))
        {
            throw new Exception($error);
        }
        return $this->dbh->affected_rows;
    }

    public function insert($sql)
    {
        

        $this->sql($sql);
        return $this->dbh->insert_id;
    }

    public function multi_query($sql)
    {

        return $this->dbh->multi_query($sql);
    }
}

?>