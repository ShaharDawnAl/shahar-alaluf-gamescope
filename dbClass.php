<?php
require_once "tables/users.php";
require_once "tables/news.php";
require_once "tables/mods.php";
require_once "tables/codes.php";
require_once "tables/trainers.php";
require_once "tables/walkthroughs.php";

require_once "tables/comments.php";
require_once "tables/comments_news.php";
require_once "tables/comments_mods.php";
require_once "tables/comments_codes.php";
require_once "tables/comments_trainers.php";
require_once "tables/comments_walkthroughs.php";

require_once "tables/pictures.php";
require_once "tables/pictures_mods.php";
require_once "tables/pictures_codes.php";
require_once "tables/pictures_trainers.php";
require_once "tables/pictures_walkthroughs.php";

require_once "tables/videos.php";
require_once "tables/videos_news.php";
require_once "tables/videos_mods.php";
require_once "tables/videos_codes.php";
require_once "tables/videos_trainers.php";
require_once "tables/videos_walkthroughs.php";

class dbClass
{
	private $host;
	private $db;
	private $charset;
	private $user;
	private $pass;
	private $opt = array(
					PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION,
					PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC);
	private $connection;
	
    //database constructor
	public function __construct(string $host = "localhost", string $db = "gamescope", 
	string $charset = "utf8", string $user = "root", string $pass = "")
	{
		$this->host = $host;
		$this->db = $db;
		$this->charset = $charset;
		$this->user = $user;
		$this->pass = $pass;
	}
	
    //connect to database
	private function connect()
	{
		$dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
		$this->connection = new PDO($dsn, $this->user, $this->pass, $this->opt);
	}
	
    //disconnect from database
	public function disconnect ()
	{
		$this->connection = null;
	}
	
    //get the searched query by given table and search content 
    public function getSearchQuery($search, $searchtable)
	{
		$this->connect();
		$searchArray = array();
		$result = $this->connection->query("SELECT * FROM $searchtable WHERE ".$searchtable."_title LIKE '%$search%' ORDER BY ".$searchtable."_title ASC");
		if ($result->rowCount() == 0)
			return 0;
		while($row = $result->fetchObject($searchtable)) {
			$searchArray[] = $row;
		}
		
		$this->disconnect();
		return $searchArray;
	}
    
    //get all users
	public function getUsers()
	{
		$this->connect();
		$usersArray = array();
		$result = $this->connection->query("SELECT * FROM users");
		
		while($row = $result->fetchObject('Users')) {
			$usersArray[] = $row;
		}
		
		$this->disconnect();
		return $usersArray;
	}
	
    //get all the news's details
	public function getNews()
	{
		$this->connect();
		$newsArray = array();
		$result = $this->connection->query("SELECT * FROM news");
		
		while($row = $result->fetchObject('News')) {
			$newsArray[] = $row;
		}
		
		$this->disconnect();
		return $newsArray;
	}
	
    //get all the news ordered by date for the paginator
	public function getNewsOrdered($startpoint, $limit)
	{
		$this->connect();
		$newsArray = array();
		$result = $this->connection->query("select * from news ORDER BY news_date DESC LIMIT {$startpoint} , {$limit}");
		$i=0;
		while($row = $result->fetchObject('News')) {
			$newsArray[] = $row;
		}
		$this->disconnect();
		return $newsArray;
	}
	
    //count the news for the paginator
	public function getNewsOrderedCount()
	{
		$this->connect();
		$newsArray = array();
		$result = $this->connection->query("select * from news");
		$this->disconnect();
		return $result->rowCount();
	}
	
    //get the 4 last active news ordered by date 
	public function getNewsFrontDateOrdered()
	{
		$this->connect();
		$newsArray = array();
		$result = $this->connection->query("SELECT * FROM news ORDER BY news_date DESC LIMIT 4");
		
		while($row = $result->fetchObject('News')) {
			$newsArray[] = $row;
		}
		
		$this->disconnect();
		return $newsArray;
	}
	
    
    //get the next news's Auto Increment number
	public function getNextNewsAI()
	{
		$this->connect();
		$query = $this->connection->prepare("SHOW TABLE STATUS LIKE 'news'");
		$query->execute();
		$size = $query->fetch(PDO::FETCH_ASSOC);
		$this->disconnect();
		return $size['Auto_increment'];
	}
	
    //get all news's details by a given news id
	public function getNewsByNewsId($newsid)
	{
		$this->connect();
		$statement = $this->connection->prepare("SELECT * FROM news WHERE news_id = :newsid");
		$statement->execute([':newsid'=>$newsid]);
		$result = $statement->fetchObject('News');
		$this->disconnect();
		if($statement->rowCount() == 0) {
			$result = new News();
			$result->setNewsId(0);
			$result->setNewsTitle("Error in News Database");
			$result->setNewsDesc("Error in News Database, please contact administrators! Thank you.");
			$result->setNewsDate("Error");
			$result->setNewsCarPic("Error");
			$result->setNewsBoxPic("Error");
			$result->setNewsUserId(0);
			return $result;
		} else {
			return $result;
		}
	}
	
    //get all the mods
	public function getMods()
	{
		$this->connect();
		$modsArray = array();
		$result = $this->connection->query("SELECT * FROM mods");
		
		while($row = $result->fetchObject('Mods')) {
			$modsArray[] = $row;
		}
		
		$this->disconnect();
		return $modsArray;
	}
	
    //get the active mod's details ordered by date for the paginator 
	public function getModsOrdered($startpoint, $limit)
	{
		$this->connect();
		$modsArray = array();
		$result = $this->connection->query("select * from mods WHERE mods_active = 1 ORDER BY mods_date DESC LIMIT {$startpoint} , {$limit}");
		$i=0;
		while($row = $result->fetchObject('Mods')) {
			$modsArray[] = $row;
		}
		$this->disconnect();
		return $modsArray;
	}
	
    //count the activated mods 
	public function getModsOrderedCount()
	{
		$this->connect();
		$newsArray = array();
		$result = $this->connection->query("select * from mods WHERE mods_active = 1");
		$this->disconnect();
		return $result->rowCount();
	}
	
    //get the 4 last activated mods ordered by date 
	public function getModsFrontDateOrdered()
	{
		$this->connect();
		$modsArray = array();
		$result = $this->connection->query("SELECT * FROM mods WHERE mods_active = 1 ORDER BY mods_date DESC LIMIT 4");
		
		while($row = $result->fetchObject('Mods')) {
			$modsArray[] = $row;
		}
		
		$this->disconnect();
		return $modsArray;
	}
	
    //get the mods details by a given mods id
	public function getModsByModsId($modsid)
	{
		$this->connect();
		$statement = $this->connection->prepare("SELECT * FROM mods WHERE mods_id = :modsid");
		$statement->execute([':modsid'=>$modsid]);
		$result = $statement->fetchObject('Mods');
		$this->disconnect();
		if($statement->rowCount() == 0) {
			$result = new Mods();
			$result->setModsId(0);
			$result->setModsTitle("Error in Mods Database");
			$result->setModsDesc("Error in Mods Database, please contact administrators! Thank you.");
			$result->setModsDate("Error");
			$result->setModsCarPic("Error");
			$result->setModsBoxPic("Error");
			$result->setModsUserId(0);
			return $result;
		} else {
			return $result;
		}
	}
	
    //get the next mod Auto Increment number
	public function getNextModAI()
	{
		$this->connect();
		$query = $this->connection->prepare("SHOW TABLE STATUS LIKE 'mods'");
		$query->execute();
		$size = $query->fetch(PDO::FETCH_ASSOC);
		$this->disconnect();
		return $size['Auto_increment'];
	}
	
    //get all walkthroughs
	public function getWalkthroughs()
	{
		$this->connect();
		$walkthroughsArray = array();
		$result = $this->connection->query("SELECT * FROM walkthroughs");
		
		while($row = $result->fetchObject('Walkthroughs')) {
			$walkthroughsArray[] = $row;
		}
		
		$this->disconnect();
		return $walkthroughsArray;
	}
	
    //get the active walkthroughs ordered by date for the paginator
	public function getWalkthroughsOrdered($startpoint, $limit)
	{
		$this->connect();
		$walkthroughsArray = array();
		$result = $this->connection->query("select * from walkthroughs WHERE walkthroughs_active = 1 ORDER BY walkthroughs_date DESC LIMIT {$startpoint} , {$limit}");
		$i=0;
		while($row = $result->fetchObject('Walkthroughs')) {
			$walkthroughsArray[] = $row;
		}
		$this->disconnect();
		return $walkthroughsArray;
	}
	
    //count the numbers of active walkthroughs for the paginator
	public function getWalkthroughsOrderedCount()
	{
		$this->connect();
		$newsArray = array();
		$result = $this->connection->query("select * from walkthroughs WHERE walkthroughs_active = 1");
		$this->disconnect();
		return $result->rowCount();
	}
	
    //get the last 4 active walkthroughs ordered by date
	public function getWalkthroughsFrontDateOrdered()
	{
		$this->connect();
		$walkthroughsArray = array();
		$result = $this->connection->query("SELECT * FROM walkthroughs WHERE walkthroughs_active = 1 ORDER BY walkthroughs_date DESC LIMIT 4");
		
		while($row = $result->fetchObject('Walkthroughs')) {
			$walkthroughsArray[] = $row;
		}
		
		$this->disconnect();
		return $walkthroughsArray;
	}
	
    //get all the walkthrough's details by given walkthrough id  
	public function getWalkthroughsByWalkthroughsId($walkthroughsid)
	{
		$this->connect();
		$statement = $this->connection->prepare("SELECT * FROM walkthroughs WHERE walkthroughs_id = :walkthroughsid");
		$statement->execute([':walkthroughsid'=>$walkthroughsid]);
		$result = $statement->fetchObject('Walkthroughs');
		$this->disconnect();
		if($statement->rowCount() == 0) {
			$result = new Walkthroughs();
			$result->setWalkthroughsId(0);
			$result->setWalkthroughsTitle("Error in Walkthroughs Database");
			$result->setWalkthroughsDesc("Error in Walkthroughs Database, please contact administrators! Thank you.");
			$result->setWalkthroughsDate("Error");
			$result->setWalkthroughsCarPic("Error");
			$result->setWalkthroughsBoxPic("Error");
			$result->setWalkthroughsUserId(0);
			return $result;
		} else {
			return $result;
		}
	}
	
    //get the next walkthrough Auto Increment number 
	public function getNextWalkthroughsAI()
	{
		$this->connect();
		$query = $this->connection->prepare("SHOW TABLE STATUS LIKE 'walkthroughs'");
		$query->execute();
		$size = $query->fetch(PDO::FETCH_ASSOC);
		$this->disconnect();
		return $size['Auto_increment'];
	}
	
    //get all the trainers
	public function getTrainers()
	{
		$this->connect();
		$trainersArray = array();
		$result = $this->connection->query("SELECT * FROM trainers");
		
		while($row = $result->fetchObject('Trainers')) {
			$trainersArray[] = $row;
		}
		
		$this->disconnect();
		return $trainersArray;
	}
	
    //get all the approved trainers ordered by date for the paginator
	public function getTrainersOrdered($startpoint, $limit)
	{
		$this->connect();
		$trainersArray = array();
		$result = $this->connection->query("select * from trainers WHERE trainers_active = 1 ORDER BY trainers_date DESC LIMIT {$startpoint} , {$limit}");
		$i=0;
		while($row = $result->fetchObject('Trainers')) {
			$trainersArray[] = $row;
		}
		$this->disconnect();
		return $trainersArray;
	}
	
    //get the number of approved trainers ordered by date for the paginator
	public function getTrainersOrderedCount()
	{
		$this->connect();
		$newsArray = array();
		$result = $this->connection->query("select * from trainers WHERE trainers_active = 1");
		$this->disconnect();
		return $result->rowCount();
	}
    
	//get the 4 last approved trainers ordered by date
	public function getTrainersFrontDateOrdered()
	{
		$this->connect();
		$trainersArray = array();
		$result = $this->connection->query("SELECT * FROM trainers WHERE trainers_active = 1 ORDER BY trainers_date DESC LIMIT 4");
		
		while($row = $result->fetchObject('Trainers')) {
			$trainersArray[] = $row;
		}
		
		$this->disconnect();
		return $trainersArray;
	}
	
    //get all the trainer's details by given trainers id
	public function getTrainersByTrainersId($trainersid)
	{
		$this->connect();
		$statement = $this->connection->prepare("SELECT * FROM trainers WHERE trainers_id = :trainersid");
		$statement->execute([':trainersid'=>$trainersid]);
		$result = $statement->fetchObject('Trainers');
		$this->disconnect();
		if($statement->rowCount() == 0) { //if doesn't exists do this
			$result = new Trainers();
			$result->setTrainersId(0);
			$result->setTrainersTitle("Error in Trainers Database");
			$result->setTrainersDesc("Error in Trainers Database, please contact administrators! Thank you.");
			$result->setTrainersDate("Error");
			$result->setTrainersCarPic("Error");
			$result->setTrainersBoxPic("Error");
			$result->setTrainersUserId(0);
			return $result;
		} else {
			return $result;
		}
	}
	
    //get the next trainer's Auto Increment number
	public function getNextTrainersAI()
	{
		$this->connect();
		$query = $this->connection->prepare("SHOW TABLE STATUS LIKE 'trainers'");
		$query->execute();
		$size = $query->fetch(PDO::FETCH_ASSOC);
		$this->disconnect();
		return $size['Auto_increment'];
	}
	
    //get all codes
	public function getCodes()
	{
		$this->connect();
		$codesArray = array();
		$result = $this->connection->query("SELECT * FROM codes");
		
		while($row = $result->fetchObject('Codes')) {
			$codesArray[] = $row;
		}
		
		$this->disconnect();
		return $codesArray;
	}
	
    //get approved codes for paginator ordered by date
	public function getCodesOrdered($startpoint, $limit)
	{
		$this->connect();
		$codesArray = array();
		$result = $this->connection->query("select * from codes WHERE codes_active = 1 ORDER BY codes_date DESC LIMIT {$startpoint} , {$limit}");
		$i=0;
		while($row = $result->fetchObject('Codes')) {
			$codesArray[] = $row;
		}
		$this->disconnect();
		return $codesArray;
	}
	
    //count all approved codes
	public function getCodesOrderedCount()
	{
		$this->connect();
		$newsArray = array();
		$result = $this->connection->query("select * from codes WHERE codes_active = 1");
		$this->disconnect();
		return $result->rowCount();
	}
	
    //get 4 latest dated codes if they are approved
	public function getCodesFrontDateOrdered()
	{
		$this->connect();
		$codesArray = array();
		$result = $this->connection->query("SELECT * FROM codes WHERE codes_active = 1 ORDER BY codes_date DESC LIMIT 4");
		
		while($row = $result->fetchObject('Codes')) {
			$codesArray[] = $row;
		}
		
		$this->disconnect();
		return $codesArray;
	}
	
    //get all the code's details by given code id
	public function getCodesByCodesId($codesid)
	{
		$this->connect();
		$statement = $this->connection->prepare("SELECT * FROM codes WHERE codes_id = :codesid");
		$statement->execute([':codesid'=>$codesid]);
		$result = $statement->fetchObject('Codes');
		$this->disconnect();
		if($statement->rowCount() == 0) { // if does not exists do this
			$result = new Codes();
			$result->setCodesId(0);
			$result->setCodesTitle("Error in Codes Database");
			$result->setCodesDesc("Error in Codes Database, please contact administrators! Thank you.");
			$result->setCodesDate("Error");
			$result->setCodesCarPic("Error");
			$result->setCodesBoxPic("Error");
			$result->setCodesUserId(0);
			return $result;
		} else {
			return $result;
		}
	}
	
    //get the next code's Auto Increment number
	public function getNextCodesAI()
	{
		$this->connect();
		$query = $this->connection->prepare("SHOW TABLE STATUS LIKE 'codes'");
		$query->execute();
		$size = $query->fetch(PDO::FETCH_ASSOC);
		$this->disconnect();
		return $size['Auto_increment'];
	}
	
    //get the next user's Auto Increment number
	public function getNextUserAI()
	{
		$this->connect();
		$query = $this->connection->prepare("SHOW TABLE STATUS LIKE 'users'");
		$query->execute();
		$size = $query->fetch(PDO::FETCH_ASSOC);
		$this->disconnect();
		return $size['Auto_increment'];
	}
	
    //get all the user's details by given user id
	public function getUserById($id)
	{
		$this->connect();
		$statement = $this->connection->prepare("SELECT * FROM users WHERE user_id = :id");
		$statement->execute([':id'=>$id]);
		$result = $statement->fetchObject('Users');
		$this->disconnect();
		return $result;
	}
	
    //get the user id by given username
	public function getUserByUserName(string $username):int
	{
		$this->connect();
		$statement = $this->connection->prepare("SELECT * FROM users WHERE user_username = :username");
		$statement->execute([':username'=>$username]);
		$result = $statement->fetchObject('Users');
		$this->disconnect();
		return $result->getUserId();
	}
    
	//get the username by given user id
	public function getUsernameById($id):string
	{
		$this->connect();
		$statement = $this->connection->prepare("SELECT * FROM users WHERE user_id = :id");
		$statement->execute([':id'=>$id]);
		$result = $statement->fetchObject('Users');
		$this->disconnect();
		return $result->getUserName();
	}
    
    //check if the user is admin by user's user name
    public function getUserAdminByUserName(string $username):int
	{
		$this->connect();
		$statement = $this->connection->prepare("SELECT * FROM users WHERE user_username = :username");
		$statement->execute([':username'=>$username]);
		$result = $statement->fetchObject('Users');
		$this->disconnect();
		return $result->getUserAdmin();
	}
	
    //change the news date format
	public function changeNewsDateFormat($newsdate)
	{
		$this->connect();
		$statement = $this->connection->prepare("CONVERT(VARCHAR(19),GETDATE(:newsdate)");
		$statement->execute([':newsdate'=>$newsdate]);
		$result = $statement->fetchObject('News');
		$this->disconnect();
		
		echo $result->getNewsDate();
	}
	
	//gets all comments, dedicated to a news page
	public function getCommentsNews($id)
	{
		$this->connect();
		$newsCommentsArray = array();
		$statement = $this->connection->prepare("SELECT s.*, cn.comment_id, n.news_id FROM comments_news cn, news n, comments s WHERE s.comment_id=cn.comment_id AND cn.news_id = n.news_id AND cn.news_id = :id ORDER BY s.comment_pdate");
		$statement->execute([':id'=>$id]);
		
		if($statement->rowCount() == 0) {
			$this->disconnect();
			return 0;
		}
			
		while($row = $statement->fetchObject('Comments_News')) {
			$newsCommentsArray[] = $row;
		}
		$this->disconnect();
		return $newsCommentsArray;
	}
	
	//gets all comments, dedicated to a mods page
	public function getCommentsMods($id)
	{
		$this->connect();
		$modsCommentsArray = array();
		$statement = $this->connection->prepare("SELECT s.*, cm.comment_id, m.mods_id FROM comments_mods cm, mods m, comments s WHERE s.comment_id=cm.comment_id AND cm.mods_id = m.mods_id AND cm.mods_id = :id ORDER BY s.comment_pdate");
		$statement->execute([':id'=>$id]);
		
		if($statement->rowCount() == 0) {
			$this->disconnect();
			return 0;
		}
			
		while($row = $statement->fetchObject('Comments_Mods')) {
			$modsCommentsArray[] = $row;
		}
		$this->disconnect();
		return $modsCommentsArray;
	}
	
	//gets all comments, dedicated to a codes page
	public function getCommentsCodes($id)
	{
		$this->connect();
		$codesCommentsArray = array();
		$statement = $this->connection->prepare("SELECT s.*, cc.comment_id, c.codes_id FROM comments_codes cc, codes c, comments s WHERE s.comment_id=cc.comment_id AND cc.codes_id = c.codes_id AND cc.codes_id = :id ORDER BY s.comment_pdate");
		$statement->execute([':id'=>$id]);
		
		if($statement->rowCount() == 0) {
			$this->disconnect();
			return 0;
		}
			
		while($row = $statement->fetchObject('Comments_Codes')) {
			$codesCommentsArray[] = $row;
		}
		$this->disconnect();
		return $codesCommentsArray;
	}
	
	//gets all comments, dedicated to a trainers page
	public function getCommentsTrainers($id)
	{
		$this->connect();
		$trainersCommentsArray = array();
		$statement = $this->connection->prepare("SELECT s.*, ct.comment_id, t.trainers_id FROM comments_trainers ct, trainers t, comments s WHERE s.comment_id=ct.comment_id AND ct.trainers_id = t.trainers_id AND ct.trainers_id = :id ORDER BY s.comment_pdate");
		$statement->execute([':id'=>$id]);
		
		if($statement->rowCount() == 0) {
			$this->disconnect();
			return 0;
		}
			
		while($row = $statement->fetchObject('Comments_Trainers')) {
			$trainersCommentsArray[] = $row;
		}
		$this->disconnect();
		return $trainersCommentsArray;
	}
	
	//gets all comments, dedicated to a walkthroughs page
	public function getCommentsWalkthroughs($id)
	{
		$this->connect();
		$walkthroughsCommentsArray = array();
		$statement = $this->connection->prepare("SELECT s.*, cw.comment_id, w.walkthroughs_id FROM comments_walkthroughs cw, walkthroughs w, comments s WHERE s.comment_id=cw.comment_id AND cw.walkthroughs_id = w.walkthroughs_id AND cw.walkthroughs_id = :id ORDER BY s.comment_pdate");
		$statement->execute([':id'=>$id]);
		
		if($statement->rowCount() == 0) {
			$this->disconnect();
			return 0;
		}
			
		while($row = $statement->fetchObject('Comments_Walkthroughs')) {
			$walkthroughsCommentsArray[] = $row;
		}
		$this->disconnect();
		return $walkthroughsCommentsArray;
	}
	
    //count all users
	public function countUsers():int
	{
		$this->connect();
		$result = $this->connection->prepare("SELECT * FROM users");
		$result->execute();
		return $result->rowCount();
	}
	
    //count all news
	public function countNews():int
	{
		$this->connect();
		$result = $this->connection->prepare("SELECT * FROM news");
		$result->execute();
		return $result->rowCount();
	}
	
    //check if the email already exists
	public function checkEmailExists(string $email, &$errArray)
	{
		$this->connect();
		$result = $this->connection->prepare("SELECT * FROM users WHERE user_email = :email");
		$result->execute([':email'=>$email]);
		if($result->rowCount() == 0) {
			//email not found
			$this->disconnect();
			return 0;
		} else {
			//email found
			$this->disconnect();
			$errArray[]="Email is not available, please choose another one";
		}
	}
	
    //check if the username already exists
	public function checkUsernameExists(string $username, &$errArray)
	{
		$this->connect();
		$result = $this->connection->prepare("SELECT * FROM users WHERE user_username = :username");
		$result->execute([':username'=>$username]);
		if($result->rowCount() == 0) {
			//username not found
			$this->disconnect();
		} else {
			//username found
			$this->disconnect();
			$errArray[]="Username is not available, please choose another one";
		}
	}
	
	//check user login
	public function checkUserLogin($username, $password):int
	{
		$this->connect();
		$statement = $this->connection->prepare("SELECT * FROM users WHERE user_username = :username");
		$statement->execute([':username'=>$username]);
		$result1 = $statement->fetchObject('Users');
		
		if ($statement->rowCount()==0)
		{
			return 0;
		}
		
		$password_hashed = $result1->getUserPassword();
		
		$result_prepare = $this->connection->prepare("SELECT * FROM users WHERE user_username = :username");
		$result_prepare->execute([':username'=>$username]);
		
		$result = $result_prepare->fetchAll();
		
		$this->disconnect();
		if (!$result || !(password_verify($password, $password_hashed)))
		{
			return 0;
		}
		else
			return 1;
	}
	
	//Add New User to Database
	public function addUser_withEncr(Users $u1)
	{
		$u1->setUserPassword(password_hash($u1->getUserPassword(), PASSWORD_DEFAULT));
		$uemail = $u1->getUserEmail();
		$upassword = $u1->getUserPassword();
		$uname = $u1->getUserName();
		$ufname = $u1->getUserFName();
		$ulname = $u1->getUserLName();
		$uavatar = $u1->getUserAvatar();
		$this->connect();
		$affectedRows=$this->connection->exec("INSERT INTO users VALUES(DEFAULT,'$uemail','$upassword','$uname','$ufname','$ulname','$uavatar',DEFAULT)");
		$this->disconnect();
	}
	
	//Update existing User from Database
	public function updateUser_withoutEncr(Users $u1)
	{
		$u1->getUserEmail();
		$uid = $u1->getUserId();
		$uemail = $u1->getUserEmail();
		$uname = $u1->getUserName();
		$ufname = $u1->getUserFName();
		$ulname = $u1->getUserLName();
		$uavatar = $u1->getUserAvatar();
		$uadmin = $u1->getUserAdmin();
		$this->connect();
		$affectedRows=$this->connection->exec("UPDATE users SET user_fname = '$ufname', user_lname = '$ulname', user_email = '$uemail', user_username = '$uname', user_avatar = '$uavatar', user_admin = '$uadmin' WHERE user_id = '$uid'");
		$this->disconnect();
	}
	
	//Update existing User with password from Database
	public function updateUser_withEncr(Users $u1)
	{
		$u1->getUserEmail();
		$uid = $u1->getUserId();
		$u1->setUserPassword(password_hash($u1->getUserPassword(), PASSWORD_DEFAULT));
		$uemail = $u1->getUserEmail();
		$upassword = $u1->getUserPassword();
		$uname = $u1->getUserName();
		$ufname = $u1->getUserFName();
		$ulname = $u1->getUserLName();
		$uavatar = $u1->getUserAvatar();
		$uadmin = $u1->getUserAdmin();
		$this->connect();
		$affectedRows=$this->connection->exec("UPDATE users SET user_fname = '$ufname', user_lname = '$ulname', user_email = '$uemail', user_username = '$uname', user_password = '$upassword', user_avatar = '$uavatar', user_admin = '$uadmin' WHERE user_id = '$uid'");
		$this->disconnect();
	}
	
	//Delete User from Admin managment (delete user and all the user's content from Database)
	public function deleteUser_AdminMan($id)
	{
		$this->connect();
		$result = $this->connection->prepare("SET foreign_key_checks = 0");
		$result->execute();
		$result = $this->connection->prepare("DELETE FROM codes WHERE user_id = :id");
		$result->bindParam(':id', $_GET['Delete'], PDO::PARAM_INT);
		$result->execute();
		$result = $this->connection->prepare("DELETE FROM comments WHERE user_id = :id");
		$result->bindParam(':id', $_GET['Delete'], PDO::PARAM_INT);
		$result->execute();
		$result = $this->connection->prepare("DELETE FROM mods WHERE user_id = :id");
		$result->bindParam(':id', $_GET['Delete'], PDO::PARAM_INT);
		$result->execute();
		$result = $this->connection->prepare("DELETE FROM news WHERE user_id = :id");
		$result->bindParam(':id', $_GET['Delete'], PDO::PARAM_INT);
		$result->execute();
		$result = $this->connection->prepare("DELETE FROM trainers WHERE user_id = :id");
		$result->bindParam(':id', $_GET['Delete'], PDO::PARAM_INT);
		$result->execute();
		$result = $this->connection->prepare("DELETE FROM users WHERE user_id = :id");
		$result->bindParam(':id', $_GET['Delete'], PDO::PARAM_INT);
		$result->execute();
		$result = $this->connection->prepare("DELETE FROM walkthroughs WHERE user_id = :id");
		$result->bindParam(':id', $_GET['Delete'], PDO::PARAM_INT);
		$result->execute();
		$result = $this->connection->prepare("SET foreign_key_checks = 1");
		$result->execute();
		$this->disconnect();
	}
	
	//Create News to Database
	public function createNews(News $n1)
	{
		$newstitle = $n1->getNewsTitle();
		$newsdescrtiption = $n1->getNewsDesc();
		$newscarpic = $n1->getNewsCarPic();
		$newsboxpic = $n1->getNewsBoxPic();
		$userid = $n1->getNewsUserId();
		$this->connect();
		$affectedRows=$this->connection->exec("INSERT INTO news VALUES(DEFAULT,'$newstitle','$newsdescrtiption',DEFAULT,'$newscarpic','$newsboxpic','$userid')");
		$this->disconnect();
	}
	
	//Create Mod to Database
	public function createMod(Mods $m1)
	{
		$modtitle = $m1->getModsTitle();
		$moddescrtiption = $m1->getModsDesc();
		$modcarpic = $m1->getModsCarPic();
		$modboxpic = $m1->getModsBoxPic();
		$modactive = $m1->getModsActive();
		$moddownload = $m1->getModsDownload();
		$userid = $m1->getModsUserId();
		$this->connect();
		$affectedRows=$this->connection->exec("INSERT INTO mods VALUES(DEFAULT,'$modtitle','$moddescrtiption',DEFAULT,'$modcarpic','$modboxpic','$moddownload','$modactive','$userid')");
		$this->disconnect();
	}
	
	//Create Codes to Database
	public function createCodes(Codes $c1)
	{
		$codestitle = $c1->getCodesTitle();
		$codesdescrtiption = $c1->getCodesDesc();
		$codescarpic = $c1->getCodesCarPic();
		$codesboxpic = $c1->getCodesBoxPic();
		$codesactive = $c1->getCodesActive();
		$userid = $c1->getCodesUserId();
		$this->connect();
		$affectedRows=$this->connection->exec("INSERT INTO codes VALUES(DEFAULT,'$codestitle','$codesdescrtiption',DEFAULT,'$codescarpic','$codesboxpic','$codesactive','$userid')");
		$this->disconnect();
	}
	
	//Create Trainer to Database
	public function createTrainers(Trainers $t1)
	{
		$trainerstitle = $t1->getTrainersTitle();
		$trainersdescrtiption = $t1->getTrainersDesc();
		$trainerscarpic = $t1->getTrainersCarPic();
		$trainersboxpic = $t1->getTrainersBoxPic();
		$trainersactive = $t1->getTrainersActive();
		$trainersdownload = $t1->getTrainersDownload();
		$userid = $t1->getTrainersUserId();
		$this->connect();
		$affectedRows=$this->connection->exec("INSERT INTO trainers VALUES(DEFAULT,'$trainerstitle','$trainersdescrtiption',DEFAULT,'$trainerscarpic','$trainersboxpic','$trainersdownload','$trainersactive','$userid')");
		$this->disconnect();
	}
	
	//Create Walkthroughs to Database
	public function createWalkthroughs(Walkthroughs $w1)
	{
		$walkthroughstitle = $w1->getWalkthroughsTitle();
		$walkthroughsdescrtiption = $w1->getWalkthroughsDesc();
		$walkthroughscarpic = $w1->getWalkthroughsCarPic();
		$walkthroughsboxpic = $w1->getWalkthroughsBoxPic();
		$walkthroughsactive = $w1->getWalkthroughsActive();
		$userid = $w1->getWalkthroughsUserId();
		$this->connect();
		$affectedRows=$this->connection->exec("INSERT INTO walkthroughs VALUES(DEFAULT,'$walkthroughstitle','$walkthroughsdescrtiption',DEFAULT,'$walkthroughscarpic','$walkthroughsboxpic','$walkthroughsactive','$userid')");
		$this->disconnect();
	}
	
	//Delete news and all the contents
	public function deleteNews_AdminMan($id)
	{
		$this->connect();
		$result = $this->connection->prepare("SET foreign_key_checks = 0");
		$result->execute();
		$result = $this->connection->prepare("DELETE FROM news WHERE news_id = :id");
		$result->bindParam(':id', $_GET['Delete'], PDO::PARAM_INT);
		$result->execute();
		$result = $this->connection->prepare("DELETE FROM comments_news WHERE news_id = :id");
		$result->bindParam(':id', $_GET['Delete'], PDO::PARAM_INT);
		$result->execute();
		$result = $this->connection->prepare("DELETE FROM videos_news WHERE news_id = :id");
		$result->bindParam(':id', $_GET['Delete'], PDO::PARAM_INT);
		$result->execute();
		$result = $this->connection->prepare("SET foreign_key_checks = 1");
		$result->execute();
		$this->disconnect();
	}
	
	//Delete mods and all the contents
	public function deleteMods($id)
	{
		$this->connect();
		$result = $this->connection->prepare("SET foreign_key_checks = 0");
		$result->execute();
		$result = $this->connection->prepare("DELETE FROM mods WHERE mods_id = :id");
		$result->bindParam(':id', $_GET['Delete'], PDO::PARAM_INT);
		$result->execute();
		$result = $this->connection->prepare("DELETE FROM comments_mods WHERE mods_id = :id");
		$result->bindParam(':id', $_GET['Delete'], PDO::PARAM_INT);
		$result->execute();
		$result = $this->connection->prepare("DELETE FROM pictures_mods WHERE mods_id = :id");
		$result->bindParam(':id', $_GET['Delete'], PDO::PARAM_INT);
		$result->execute();
		$result = $this->connection->prepare("DELETE FROM videos_mods WHERE mods_id = :id");
		$result->bindParam(':id', $_GET['Delete'], PDO::PARAM_INT);
		$result->execute();
		$result = $this->connection->prepare("SET foreign_key_checks = 1");
		$result->execute();
		$this->disconnect();
	}
	
	//Delete codes and all the contents
	public function deleteCodes($id)
	{
		$this->connect();
		$result = $this->connection->prepare("SET foreign_key_checks = 0");
		$result->execute();
		$result = $this->connection->prepare("DELETE FROM codes WHERE codes_id = :id");
		$result->bindParam(':id', $_GET['Delete'], PDO::PARAM_INT);
		$result->execute();
		$result = $this->connection->prepare("DELETE FROM comments_codes WHERE codes_id = :id");
		$result->bindParam(':id', $_GET['Delete'], PDO::PARAM_INT);
		$result->execute();
		$result = $this->connection->prepare("DELETE FROM videos_codes WHERE codes_id = :id");
		$result->bindParam(':id', $_GET['Delete'], PDO::PARAM_INT);
		$result->execute();
		$result = $this->connection->prepare("SET foreign_key_checks = 1");
		$result->execute();
		$this->disconnect();
	}
	
	//Delete trainers and all the contents
	public function deleteTrainers($id)
	{
		$this->connect();
		$result = $this->connection->prepare("SET foreign_key_checks = 0");
		$result->execute();
		$result = $this->connection->prepare("DELETE FROM trainers WHERE trainers_id = :id");
		$result->bindParam(':id', $_GET['Delete'], PDO::PARAM_INT);
		$result->execute();
		$result = $this->connection->prepare("DELETE FROM comments_trainers WHERE trainers_id = :id");
		$result->bindParam(':id', $_GET['Delete'], PDO::PARAM_INT);
		$result->execute();
		$result = $this->connection->prepare("DELETE FROM pictures_trainers WHERE trainers_id = :id");
		$result->bindParam(':id', $_GET['Delete'], PDO::PARAM_INT);
		$result->execute();
		$result = $this->connection->prepare("DELETE FROM videos_trainers WHERE trainers_id = :id");
		$result->bindParam(':id', $_GET['Delete'], PDO::PARAM_INT);
		$result->execute();
		$result = $this->connection->prepare("SET foreign_key_checks = 1");
		$result->execute();
		$this->disconnect();
	}
	
	//Delete walkthroughs and all the contents
	public function deleteWalkthroughs($id)
	{
		$this->connect();
		$result = $this->connection->prepare("SET foreign_key_checks = 0");
		$result->execute();
		$result = $this->connection->prepare("DELETE FROM walkthroughs WHERE walkthroughs_id = :id");
		$result->bindParam(':id', $_GET['Delete'], PDO::PARAM_INT);
		$result->execute();
		$result = $this->connection->prepare("DELETE FROM comments_walkthroughs WHERE walkthroughs_id = :id");
		$result->bindParam(':id', $_GET['Delete'], PDO::PARAM_INT);
		$result->execute();
		$result = $this->connection->prepare("DELETE FROM pictures_walkthroughs WHERE walkthroughs_id = :id");
		$result->bindParam(':id', $_GET['Delete'], PDO::PARAM_INT);
		$result->execute();
		$result = $this->connection->prepare("DELETE FROM videos_walkthroughs WHERE walkthroughs_id = :id");
		$result->bindParam(':id', $_GET['Delete'], PDO::PARAM_INT);
		$result->execute();
		$result = $this->connection->prepare("SET foreign_key_checks = 1");
		$result->execute();
		$this->disconnect();
	}
	
	//Add Video
	public function addVideo($videolink, $table, $tableid)
	{
		$this->connect();
		$affectedRows=$this->connection->exec("INSERT INTO videos VALUES(DEFAULT,'$videolink')");
		$last_id = $this->connection->lastInsertId();
		$affectedRows=$this->connection->exec("INSERT INTO videos_".$table." VALUES('$last_id','$tableid')");
	}
	
	//Add Pictures
	public function addPictures($picturesArray, $table, $tableid)
	{
		$this->connect();
		for ($i=0; $i<count($picturesArray); $i++)
		{
			$affectedRows=$this->connection->exec("INSERT INTO pictures VALUES(DEFAULT,'$picturesArray[$i]')");
			$last_id = $this->connection->lastInsertId();
			$affectedRows=$this->connection->exec("INSERT INTO pictures_".$table." VALUES('$last_id','$tableid')");
		}
	}
	
	//Add comments
	public function addComment($comment, $userid)
	{
		$this->connect();
		$affectedRows=$this->connection->exec("INSERT INTO comments VALUES(DEFAULT,'$comment',DEFAULT,'$userid')");
	}
	
	//Add comment to news comments table
	public function castNewsComment($newsid)
	{
		$last_id = $this->connection->lastInsertId(); //Get the last inserted ID from the comments table!
		$affectedRows=$this->connection->exec("INSERT INTO comments_news VALUES('$last_id','$newsid')");
		$this->disconnect();
	}
	
	//Add comment to mods comments table
	public function castModsComment($modsid)
	{
		$last_id = $this->connection->lastInsertId(); //Get the last inserted ID from the comments table!
		$affectedRows=$this->connection->exec("INSERT INTO comments_mods VALUES('$last_id','$modsid')");
		$this->disconnect();
	}
	
	//Add comment to codes comments table
	public function castCodesComment($codesid)
	{
		$last_id = $this->connection->lastInsertId(); //Get the last inserted ID from the comments table!
		$affectedRows=$this->connection->exec("INSERT INTO comments_codes VALUES('$last_id','$codesid')");
		$this->disconnect();
	}
	
	//Add comment to trainers comments table
	public function castTrainersComment($trainersid)
	{
		$last_id = $this->connection->lastInsertId(); //Get the last inserted ID from the comments table!
		$affectedRows=$this->connection->exec("INSERT INTO comments_trainers VALUES('$last_id','$trainersid')");
		$this->disconnect();
	}
	
	//Add comment to walkthroughs comments table
	public function castWalkthroughsComment($walkthroughsid)
	{
		$last_id = $this->connection->lastInsertId(); //Get the last inserted ID from the comments table!
		$affectedRows=$this->connection->exec("INSERT INTO comments_walkthroughs VALUES('$last_id','$walkthroughsid')");
		$this->disconnect();
	}
	
    //delete the comment by comment id
	public function deleteCommentQuery($table, $id)
	{
		$this->connect();
		$result = $this->connection->prepare("DELETE FROM comments_".$table." WHERE comment_id = :id");
		$result->bindParam(':id', $_GET['Delete'], PDO::PARAM_INT);
		$result->execute();
		$result = $this->connection->prepare("DELETE FROM comments WHERE comment_id = :id");
		$result->bindParam(':id', $_GET['Delete'], PDO::PARAM_INT);
		$result->execute();
		$this->disconnect();
	}
	
    //get the comment's user id by given comment id 
	public function getCommentUserIdById($id)
	{
		$this->connect();
		$statement = $this->connection->prepare("SELECT * FROM comments WHERE comment_id = :id");
		$statement->execute([':id'=>$id]);
		$result = $statement->fetchObject('Comments');
		$this->disconnect();
		if($statement->rowCount() == 0) {
			return 0;
		}
		return $result->getCommentsUserId();
	}
	
    //Count the amount of comments of the selected table
	public function countCommentsQuery($table, $id)
	{
		$this->connect();
		$statement = $this->connection->prepare("SELECT * FROM comments_".$table." WHERE ".$table."_id = :id");
		$statement->execute([':id'=>$id]);
		$this->disconnect();
		if($statement->rowCount() == 0) {
			return 0;
		}
		return $statement->rowCount();
	}
	
	//gets all pictures, dedicated to a content page
	public function getPicturesQuery($table, $id)
	{
		$this->connect();
		$picturesArray = array();
		$statement = $this->connection->prepare("SELECT s.*, p".$table.".pictures_id, ".$table.".".$table."_id FROM pictures_".$table." p".$table.", ".$table." ".$table.", pictures s WHERE s.pictures_id=p".$table.".pictures_id AND p".$table.".".$table."_id = ".$table.".".$table."_id AND p".$table.".".$table."_id = :id");
		$statement->execute([':id'=>$id]);
		
		if($statement->rowCount() == 0) {
			$this->disconnect();
			return 0;
		}
			
		while($row = $statement->fetchObject('Pictures_'.$table)) {
			$picturesArray[] = $row;
		}
		$this->disconnect();
		return $picturesArray;
	}
	
	//gets all videos, dedicated to a content page
	public function getVideosQuery($table, $id)
	{
		$this->connect();
		$statement = $this->connection->prepare("SELECT s.*, v".$table.".videos_id, ".$table.".".$table."_id FROM videos_".$table." v".$table.", ".$table." ".$table.", videos s WHERE s.videos_id=v".$table.".videos_id AND v".$table.".".$table."_id = ".$table.".".$table."_id AND v".$table.".".$table."_id = :id");
		$statement->execute([':id'=>$id]);
		
		if($statement->rowCount() == 0) {
			$this->disconnect();
			return 0;
		}
			
		if($row = $statement->fetchObject('Videos_'.$table)) {
			$video = $row;
		}
		$this->disconnect();
		return $video;
	}
	
	//update all videos, dedicated to a content page
	public function updateVideosQuery($videoid, $videolink)
	{
		$this->connect();
		$affectedRows=$this->connection->exec("UPDATE videos SET videos_link = '$videolink' WHERE videos_id = '$videoid'");
		$this->disconnect();
	}
	
	//deletes all pictures dedicated to specific content from database
	public function deletePictures($table, $id)
	{
		$this->connect();
		$result = $this->connection->prepare("DELETE FROM pictures_".$table." WHERE ".$table."_id = ".$id."");
		$result->execute();
		$this->disconnect();
	}
	
	//Update existing News from Database
	public function updateNews(News $n1)
	{
		$nid = $n1->getNewsId();
		$ntitle = $n1->getNewsTitle();
		$ndesc = $n1->getNewsDesc();
		$ncarpic = $n1->getNewsCarPic();
		$nboxpic = $n1->getNewsBoxPic();
		$this->connect();
		$affectedRows=$this->connection->exec("UPDATE news SET news_title = '$ntitle', news_desc = '$ndesc', news_carpic = '$ncarpic', news_boxpic = '$nboxpic' WHERE news_id = '$nid'");
		$this->disconnect();
	}
	
	//Update existing Mods from Database
	public function updateMods(Mods $m1)
	{
		$mid = $m1->getModsId();
		$mtitle = $m1->getModsTitle();
		$mdesc = $m1->getModsDesc();
		$mcarpic = $m1->getModsCarPic();
		$mboxpic = $m1->getModsBoxPic();
		$mdownload = $m1->getModsDownload();
		$mactive = $m1->getModsActive();
		$this->connect();
		$affectedRows=$this->connection->exec("UPDATE mods SET mods_title = '$mtitle', mods_desc = '$mdesc', mods_carpic = '$mcarpic', mods_boxpic = '$mboxpic', mods_download = '$mdownload', mods_active = '$mactive' WHERE mods_id = '$mid'");
		$this->disconnect();
	}
	
	//Update existing Codes from Database
	public function updateCodes(Codes $c1)
	{
		$cid = $c1->getCodesId();
		$ctitle = $c1->getCodesTitle();
		$cdesc = $c1->getCodesDesc();
		$ccarpic = $c1->getCodesCarPic();
		$cboxpic = $c1->getCodesBoxPic();
		$cactive = $c1->getCodesActive();
		$this->connect();
		$affectedRows=$this->connection->exec("UPDATE codes SET codes_title = '$ctitle', codes_desc = '$cdesc', codes_carpic = '$ccarpic', codes_boxpic = '$cboxpic', codes_active = '$cactive' WHERE codes_id = '$cid'");
		$this->disconnect();
	}
	
	//Update existing Trainers from Database
	public function updateTrainers(Trainers $t1)
	{
		$tid = $t1->getTrainersId();
		$ttitle = $t1->getTrainersTitle();
		$tdesc = $t1->getTrainersDesc();
		$tcarpic = $t1->getTrainersCarPic();
		$tboxpic = $t1->getTrainersBoxPic();
		$tdownload = $t1->getTrainersDownload();
		$tactive = $t1->getTrainersActive();
		$this->connect();
		$affectedRows=$this->connection->exec("UPDATE trainers SET trainers_title = '$ttitle', trainers_desc = '$tdesc', trainers_carpic = '$tcarpic', trainers_boxpic = '$tboxpic', trainers_download = '$tdownload', trainers_active = '$tactive' WHERE trainers_id = '$tid'");
		$this->disconnect();
	}
	
	//Update existing Walkthroughs from Database
	public function updateWalkthroughs(Walkthroughs $w1)
	{
		$wid = $w1->getWalkthroughsId();
		$wtitle = $w1->getWalkthroughsTitle();
		$wdesc = $w1->getWalkthroughsDesc();
		$wcarpic = $w1->getWalkthroughsCarPic();
		$wboxpic = $w1->getWalkthroughsBoxPic();
		$wactive = $w1->getWalkthroughsActive();
		$this->connect();
		$affectedRows=$this->connection->exec("UPDATE walkthroughs SET walkthroughs_title = '$wtitle', walkthroughs_desc = '$wdesc', walkthroughs_carpic = '$wcarpic', walkthroughs_boxpic = '$wboxpic', walkthroughs_active = '$wactive' WHERE walkthroughs_id = '$wid'");
		$this->disconnect();
	}

    //Select all content from given table by user
	public function getUserTableQuery($table, $id)
	{
		$this->connect();
		$tableArray = array();
		$result = $this->connection->query("SELECT * FROM ".$table." WHERE user_id = ".$id);
		
		while($row = $result->fetchObject($table)) {
			$tableArray[] = $row;
		}
		
		$this->disconnect();
		return $tableArray;
	}
    
    //Forgot password query
    public function identityValidatorMailer($email, $fname, $lname)
    {
        $this->connect();
        $statement = $this->connection->prepare("SELECT user_id FROM users WHERE user_email = :email");
		$statement->execute([':email'=>$email]);
		$result = $statement->fetchObject('Users');
		$this->disconnect();
		if($statement->rowCount() == 0) {
			return 3;
		}

        else
        {
            $userid = $result->getUserId();
            $this->connect();
            $statement1 = $this->connection->prepare("SELECT * FROM users WHERE user_fname = :fname AND user_lname = :lname AND user_id = :userid");
		  $statement1->execute([':fname'=>$fname, ':lname'=>$lname, ':userid'=>$userid]);
		  $result1 = $statement->fetchObject('Users');
		    $this->disconnect();
            if($statement1->rowCount() == 0) {
                return 2;
		    }
            $this->connect();
		      $statement = $this->connection->prepare("SELECT * FROM users WHERE user_id = :userid");
		      $statement->execute([':userid'=>$userid]);
		$result = $statement->fetchObject('Users');
		$this->disconnect();
		return $result;
        }
        
    }
    
    //reset the password for users request
    public function passwordReset($generatedpassword, $uid)
    {
		$this->connect();
        $passhash = password_hash($generatedpassword, PASSWORD_DEFAULT);
		$affectedRows=$this->connection->exec("UPDATE users SET user_password = '$passhash' WHERE user_id = '$uid'");
        $this->disconnect();
    }
}
?>
