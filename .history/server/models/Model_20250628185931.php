<?php
abstract class Model
{
    protected static string $table;
    protected static string $primary_key = 'id';
    protected static mysqli $connection;
    protected array $attributes;

    // to run a method without passing the connection everytime 
    public static function setConnection(mysqli $conn): void
    {
        static::$connection = $conn;
    }
    
    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }
    //Get a value from the attributes array by column name
    public function get(string $key)
    {
        return $this->attributes[$key] ?? null;
    }


    public function set(string $key, $value): void
    {
        $this->attributes[$key] = $value;
    }

    protected function syncToAttributes(): void
    {
    }

    public static function find(int $id): ?static
    {
        if (!isset(static::$connection)) {
            throw new Exception('Connection not set');
        }

        $sql = sprintf(
            'SELECT * FROM %s WHERE %s = ?',
            static::$table,
            static::$primary_key
        );

        $stmt = static::$connection->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $data = $stmt->get_result()->fetch_assoc();
        return $data ? new static($data) : null;
    }

    public static function all(): array
    {
        if (!isset(static::$connection)) {
            throw new Exception('Connection not set');
        }

        $sql = sprintf('SELECT * FROM %s', static::$table);
        $stmt = static::$connection->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();
        $objects = [];

        while ($row = $result->fetch_assoc()) {
            $objects[] = new static($row);
        }

        return $objects;
    }

    public static function create(array $data): static
    {
        if (!isset(static::$connection)) {
            throw new Exception('Connection not set');
        }

        $columns      = array_keys($data);
        $placeholders = implode(', ', array_fill(0, count($columns), '?'));
        $columnNames  = implode(', ', $columns);

        $sql = sprintf(
            'INSERT INTO %s (%s) VALUES (%s)',
            static::$table,
            $columnNames,
            $placeholders
        );

        $stmt = static::$connection->prepare($sql);

        // Determine types
        $types  = '';
        $values = [];
        foreach ($data as $value) {
            if (is_int($value)) {
                $types .= 'i';
            } elseif (is_float($value)) {
                $types .= 'd';
            } else {
                $types .= 's';
            }
            $values[] = $value;
        }

        $stmt->bind_param($types, ...$values);
        $stmt->execute();

        // Return the newly created instance
        $newId = static::$connection->insert_id;
        return $newId ? static::find($newId) : new static($data);
    }

    public function update(): bool
    {
        if (!isset(static::$connection)) {
            throw new Exception('Connection not set');
        }

        // Sync properties to attributes before updating
        $this->syncToAttributes();

        $id   = $this->get(static::$primary_key);
        $data = $this->attributes;
        unset($data[static::$primary_key]);

        $columns   = array_keys($data);
        $setClause = implode(
            ', ',
            array_map(fn($col) => "$col = ?", $columns)
        );

        $sql = sprintf(
            'UPDATE %s SET %s WHERE %s = ?',
            static::$table,
            $setClause,
            static::$primary_key
        );

        $stmt = static::$connection->prepare($sql);

        $types  = '';
        $values = [];
        foreach ($data as $value) {
            if (is_int($value)) {
                $types .= 'i';
            } elseif (is_float($value)) {
                $types .= 'd';
            } else {
                $types .= 's';
            }
            $values[] = $value;
        }
        $types      .= 'i'; 
        $values[]    = $id;

        $stmt->bind_param($types, ...$values);
        return $stmt->execute();
    }

    public function delete(): bool
    {
        if (!isset(static::$connection)) {
            throw new Exception('Connection not set');
        }

        $id  = $this->get(static::$primary_key);
        $sql = sprintf(
            'DELETE FROM %s WHERE %s = ?',
            static::$table,
            static::$primary_key
        );

        $stmt = static::$connection->prepare($sql);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }
}
