<?php

class Database
{
    protected PDO $pdo;

    public function __construct(string $dsn, string $user_name, string $password)
    {
        try {
            $this->pdo = new \PDO($dsn, $user_name, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            throw new $exception;
        }
    }

    /**
     * insert new records
     *
     * @param array $data
     * @return bool
     */
    public function insert(array $data): bool
    {
        $sql = "INSERT INTO users ";
        $sql .= "(" .$this->getKeys($data) . ") VALUES (";
        $sql .= $this->getPlaceholders($data) . ");";

        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);

        return true;
    }

    /**
     * Return Statements prepared keys
     * @param array $data
     * @return string
     */
    protected function getKeys(array $data): string{
        $len = count($data);
        $keys = "";

        $iterator = 0;
        foreach ($data as $key => $value){
           $keys.= ($iterator != $len - 1) ? $key . ',' : $key;
           $iterator++;
        }

        return $keys;
    }

    /**
     * Return Statements prepared placeholders
     * @param array $data
     * @return string
     */
    protected function getPlaceholders(array $data): string{
        $len = count($data);
        $placeholders = "";

        $iterator = 0;
        foreach ($data as $key => $value){
            $placeholders.= ($iterator != $len - 1) ? ":" . $key . ',' : ":" . $key;
            $iterator++;
        }

        return $placeholders;
    }
}
