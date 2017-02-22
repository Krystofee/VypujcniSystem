<? 
/*
*	Name: 		database.php
*	Author: 	Krystofee
*	Created: 	25.1.2016
*	Desc: 		Database handling static class
*
*	class Database
*		static function initialize(); 
*		static function connect();
*		static function exec($sql);
*		static function select($sql) : array[row][column];
*		static function close();
*		(+ static function getLink() : $link to the database, may be used for debug);
*/



class Database {

	private static $initialized = false;
	private static $database;
	private static $link = null;

	private static function initialize() {
		// awokes only if it was not before
		if(self::$initialized)
			return;

		self::$link = null;
		
		// Database connection parametres
		# + maybe later stored in db.conf file
		self::$database = array(
			'host' => 'localhost',
			'user' => 'root',
			'password' => '',
			'name' => 'EshopSmluv' 
			);

		self::$initialized = true;
	}

	/*
	* 	Connecting function to database
	*/
	public static function connect() {

		self::initialize();

		try {
			self::$link = new PDO('mysql:host='.self::$database['host'].';dbname='.self::$database['name'], self::$database['user'], self::$database['password']);
			self::$link -> exec("set names utf8");
			self::$link -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
			echo "Connection to database failed: " . $e->getMessage();
		}
	}

	/*
	* 	exec($sql) where $sql is string with premared statement
	*/
	public static function exec($sql) {
		try {
			self::$link->exec($sql);
		} catch (PDOException $e) {
			echo 'Executing SQL failed: ' . $e->getMessage();
		}
	}

	/**
	* 	returns two dimensional array
	* 	if count(array) == 0 -> nothing was found
	* 	else an results were found!
	*/
	public static function select($sql) {
		try {
			$stmt = self::$link -> prepare($sql); 
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_NUM);

			return $stmt->fetchAll(); 
		} catch (PDOException $e) {
			echo 'Executing SQL failed: ' . $e->getMessage();
		}
	}

	public static function close() {
		self::$link = null;
	}

	public static function getLink() {
		return self::$link;
	}
}