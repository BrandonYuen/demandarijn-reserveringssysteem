<?php namespace Reserveringen\Databases;

/**
 * Class Database
 * @package StudentsList\Databases
 */
class Database
{
    private $host, $username, $password, $database;

    /**
     * @var \PDO
     */
    private $connection;

    /**
     * Database constructor.
     *
     * @param $host
     * @param $username
     * @param $password
     * @param $database
     */
    public function __construct($host, $username, $password, $database)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        $this->connect();
    }

    /**
     * @throws \Exception
     */
    private function connect()
    {
        try {
            $this->connection = new \PDO("mysql:dbname=$this->database;host=$this->host", $this->username, $this->password);
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            throw new \Exception("DB Connection failed: " . $e->getMessage());
        }
    }

    /**
     * @return \PDO
     */
    public function getConnection()
    {
        return $this->connection;
    }

	//Nieuwe reservering inserten in de database
    public function insert($datum,$tijd,$aantal_personen,$tafelnummer,$name,$email,$telefoonnummer,$toevoegingen,$creationdatetime)
    {
		//Get datetime

        $stmt = $this->connection->prepare("INSERT INTO reserveringen (datum, tijd, aantal_personen, tafelnummer, name, email, telefoonnummer, toevoegingen, creationdatetime) VALUES (:datum, :tijd, :aantal_personen, :tafelnummer, :name, :email, :telefoonnummer, :toevoegingen, :creationdatetime)");
        $stmt->bindParam(':datum', $datum);
        $stmt->bindParam(':tijd', $tijd);
        $stmt->bindParam(':aantal_personen', $aantal_personen);
        $stmt->bindParam(':tafelnummer', $tafelnummer);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefoonnummer', $telefoonnummer);
        $stmt->bindParam(':toevoegingen', $toevoegingen);
        $stmt->bindParam(':creationdatetime', $creationdatetime);
        $stmt->execute();
    }

	//Bestaande reservering verwijderen bij ID
    public function deleteById($rId)
    {
        $stmt = $this->connection->prepare("DELETE from reserveringen WHERE id = :rId");
        $stmt->bindParam(':rId', $rId);
        $stmt->execute();
    }

	//Update bestaande reservering bij ID
    public function updateById($id,$datum,$tijd,$aantal_personen,$tafelnummer,$name,$email,$telefoonnummer,$toevoegingen)
    {
        $stmt = $this->connection->prepare(
			"UPDATE reserveringen
			SET datum = :datum,
				tijd = :tijd,
				aantal_personen = :aantal_personen,
				tafelnummer = :tafelnummer,
				name = :name,
				email = :email,
				telefoonnummer = :telefoonnummer,
				toevoegingen = :toevoegingen
			WHERE id = :id"
		);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':datum', $datum);
        $stmt->bindParam(':tijd', $tijd);
        $stmt->bindParam(':aantal_personen', $aantal_personen);
        $stmt->bindParam(':tafelnummer', $tafelnummer);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefoonnummer', $telefoonnummer);
        $stmt->bindParam(':toevoegingen', $toevoegingen);
        $stmt->execute();
    }
}
