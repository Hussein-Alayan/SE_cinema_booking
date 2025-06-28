<?php
abstract class Model
{
    protected static string $table;
    protected static string $primary_key = "id";
    protected static mysqli $connection;

    public static function find(int $id)
    {
        $sql = sprintf(
            "SELECT * FROM %s WHERE %s = ?",
            static::$table,
            static::$primary_key
        );

        if (!self::$connection) {
            throw new Exception("Connection not set");
        }
        $query = self::$connection->prepare($sql);
        $query->bind_param("i", $id);
        $query->execute();

        $data = $query->get_result()->fetch_assoc();

        return $data ? new static($data) : null;
    }

    public static function all()
    {
        if (!self::$connection) {
            throw new Exception("Connection not set");
        }
        $sql = sprintf("SELECT * FROM %s", static::$table);

        $query = self::$connection->prepare($sql);
        $query->execute();

        $data = $query->get_result();

        $objects = [];
        while ($row = $data->fetch_assoc()) {
            $objects[] = new static($row);
        }

        return $objects;
    }
    
    public static function create(array $data)
    {
        if(!self::$connection){
            throw new Exception(message: "connection not set");
           };
           $columns = array_keys($data);
        $placeholders = implode(',', array_fill(0, count($columns), "?"));
        $columnNames = implode (',', $columns);

        $sql = sprintf("INSERT INTO %s (%s) VALUES (%s)",
        Static::$table
        )
        }

    // update() -> non-static function
    public function update()
    {
    }

    // 2- create() -> static function
    // 3- delete() -> non-static function
    public function delete()
    {
        // To be implemented
    }
}
