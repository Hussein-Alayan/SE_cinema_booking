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
        if (!self::$connection) {
            throw new Exception("Connection not set");
        }

        $columns = array_keys($data);
        $placeholders = implode(',', array_fill(0, count($columns), '?'));
        $columnNames = implode(',', $columns);

        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES (%s)",
            static::$table,
            $columnNames,
            $placeholders
        );

        $query = self::$connection->prepare($sql);

        $types = str_repeat('s', count($data));
        $values = array_values($data);
        $query->bind_param($types, ...$values);

        if ($query->execute()) {
            $newId = self::$connection->insert_id;
            if ($newId) {
                return self::find($newId);
            } else {
                return new static($data);
            }
        } else {
            throw new Exception("Failed to create record: " . $query->error);
        }
    }

    public function update()
    {
        if (!self::$connection) {
            throw new Exception("Connection not set");
        }

        if (!isset($this->{static::$primary_key})) {
            throw new Exception("Cannot update: Object has no primary key value");
        }

        $data = $this->toArray();
        unset($data[static::$primary_key]);

        $setClause = implode('=?,', array_keys($data)) . '=?';
        $sql = sprintf(
            "UPDATE %s SET %s WHERE %s = ?",
            static::$table,
            $setClause,
            static::$primary_key
        );

        $query = self::$connection->prepare($sql);

        $types = str_repeat('s', count($data)) . 'i';
        $values = array_values($data);
        $values[] = $this->{static::$primary_key};
        $query->bind_param($types, ...$values);

        if ($query->execute()) {
            return $query->affected_rows > 0;
        } else {
            throw new Exception("Failed to update record: " . $query->error);
        }
    }

    public function delete()
    {
        if (!self::$connection) {
            throw new Exception("Connection not set");
        }

        if (!isset($this->{static::$primary_key})) {
            throw new Exception("Cannot delete: Object has no primary key value");
        }

        $sql = sprintf(
            "DELETE FROM %s WHERE %s = ?",
            static::$table,
            static::$primary_key
        );

        $query = self::$connection->prepare($sql);
        $query->bind_param("i", $this->{static::$primary_key});

        if ($query->execute()) {
            return $query->affected_rows > 0;
        } else {
            throw new Exception("Failed to delete record: " . $query->error);
        }
    }

    protected function toArray()
    {
        $reflection = new ReflectionClass($this);
        $properties = $reflection->getProperties(ReflectionProperty::IS_PRIVATE);

        $data = [];
        foreach ($properties as $property) {
            $property->setAccessible(true);
            $value = $property->getValue($this);
            if ($value !== null) {
                $data[$property->getName()] = $value;
            }
        }

        return $data;
    }

    public static function setConnection(mysqli $connection)
    {
        self::$connection = $connection;
    }

    public static function where(string $column, string $operator, $value)
    {
        if (!self::$connection) {
            throw new Exception("Connection not set");
        }

        $sql = sprintf(
            "SELECT * FROM %s WHERE %s %s ?",
            static::$table,
            $column,
            $operator
        );

        $query = self::$connection->prepare($sql);
        $query->bind_param("s", $value);
        $query->execute();

        $data = $query->get_result();

        $objects = [];
        while ($row = $data->fetch_assoc()) {
            $objects[] = new static($row);
        }

        return $objects;
    }

    public static function first()
    {
        if (!self::$connection) {
            throw new Exception("Connection not set");
        }

        $sql = sprintf("SELECT * FROM %s LIMIT 1", static::$table);
        $query = self::$connection->prepare($sql);
        $query->execute();

        $data = $query->get_result()->fetch_assoc();
        return $data ? new static($data) : null;
    }
}
