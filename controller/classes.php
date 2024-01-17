<?php


class Database{
    private $server = 'localhost';
    private $username = 'root';
    private $password = '';
    private $name = 'capstone2';
    protected $conn;

    public function StartConnection(){

        $this->link = mysqli_connect($this->server, $this->username, $this->password, $this->name);

        if($this->link === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }else{
            return $this->link;
        }
    }

    public function ExecuteQuery(string $sqlCommand){

        $conn = $this->StartConnection();
        $sqlExecute = mysqli_query($conn, $sqlCommand);

        if($sqlExecute == true){
            return true;
        }else{
            return false;
        }
    }
    
    public function SingleData(string $sqlFetchData){
        
        $conn = $this->StartConnection();

        $sqlExecuteFetch = mysqli_query($conn, $sqlFetchData);

        $fetchData = mysqli_fetch_row($sqlExecuteFetch);
        return $fetchData[0];
    }

    public function NumRows(string $sqlFetchData){
        
        $conn = $this->StartConnection();

        $sqlExecuteFetch = mysqli_query($conn, $sqlFetchData);

        $fetchRow = mysqli_num_rows($sqlExecuteFetch);
        return $fetchRow;
    }

    public function SingleRow(string $sqlFetchArray){

        $conn = $this->StartConnection();

        $sqlExecuteFetchRow = mysqli_query($conn, $sqlFetchArray);
        if($fetchRow = mysqli_fetch_array($sqlExecuteFetchRow)){
            return $fetchRow;
        }
    }

    public function PostSecure(string $post){
        $conn = $this->StartConnection();
        return mysqli_real_escape_string($conn, $post);
    }
}

class GenerateString extends Database{

    public function uuid() {
        $uuid = array(
         'time_low'  => 0,
         'time_mid'  => 0,
         'time_hi'  => 0,
         'clock_seq_hi' => 0,
         'clock_seq_low' => 0,
         'node'   => array()
        );
        
        $uuid['time_low'] = mt_rand(0, 0xffff) + (mt_rand(0, 0xffff) << 16);
        $uuid['time_mid'] = mt_rand(0, 0xffff);
        $uuid['time_hi'] = (4 << 12) | (mt_rand(0, 0x1000));
        $uuid['clock_seq_hi'] = (1 << 7) | (mt_rand(0, 128));
        $uuid['clock_seq_low'] = mt_rand(0, 255);
        
        for ($i = 0; $i < 6; $i++) {
            $uuid['node'][$i] = mt_rand(0, 255);
        }
        
        $uuid = sprintf('%08x-%04x-%04x-%02x%02x-%02x%02x%02x%02x%02x%02x',
         $uuid['time_low'],
         $uuid['time_mid'],
         $uuid['time_hi'],
         $uuid['clock_seq_hi'],
         $uuid['clock_seq_low'],
         $uuid['node'][0],
         $uuid['node'][1],
         $uuid['node'][2],
         $uuid['node'][3],
         $uuid['node'][4],
         $uuid['node'][5]
        );
        
        return $uuid;
    }

    public static function GenerateOTP($length){
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 1; $i <= $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public static function UserID($prefix, $length){
        $bytes = random_bytes($length);
        $token = bin2hex($bytes);

        return $prefix."_".$token;
    }
    public static function GeneratePassword($length){
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $charactersLength = strlen($characters);
        $password = '';
        for ($i = 1; $i <= $length; $i++) {
            $password .= $characters[rand(0, $charactersLength - 1)];
        }
        return $password;
    }
    public static function GenerateToken($length){
        $bytes = random_bytes($length);
        $token = bin2hex($bytes);
        return $token;
    }
    public function GenerateAccountNum($prefix){

        $conn = $this->StartConnection();

        $sql = "SELECT MAX(acctint) AS MaxNum FROM accounts WHERE acctprefix = '$prefix'";
        $result = mysqli_query($conn, $sql);
    
        if(mysqli_num_rows($result) == 1){
            if($row = mysqli_fetch_array($result)){
                $db_num = intval($row['MaxNum']) + 1;                   
                $accountNumber = sprintf("%08d", $db_num);
                return $prefix.$accountNumber;
            }
        }
    }
    
    public function GenerateAccountInt($prefix){

        $conn = $this->StartConnection();

        $sql = "SELECT MAX(acctint) AS MaxNum FROM accounts WHERE acctprefix = '$prefix'";
        $result = mysqli_query($conn, $sql);
    
        if(mysqli_num_rows($result) == 1){
            if($row = mysqli_fetch_array($result)){
                $db_num = intval($row['MaxNum']) + 1;                   
                // $accountNumber = sprintf("%08d", $db_num);
                return $db_num;
            }
        }
    }
}

class Image extends Database{
    public function UploadProfile($target_directory, $filename, $bool){
        $file = $_FILES["profile_img"]["name"];
        $target_file = $target_directory . basename($file);
        $file_ext = explode(".", $file);
        $image_file = $filename . '.' . end($file_ext);
        if($bool === true){
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            if(($target_directory != null) && ($filename != null) && ($file != null)){
                mkdir("$target_directory"); 
                $check = getimagesize($_FILES["profile_img"]["tmp_name"]);
                if($check !== false) {
                    $uploadOk = 1;
                } else {
                    $uploadOk = 0;
                }if(file_exists($target_file)) {
                    $uploadOk = 0;
                }if($_FILES["profile_img"]["size"] > 5242880) {
                    $uploadOk = 0;
                }if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "jfif" && $imageFileType != "webp" && $imageFileType != "svg") {
                    $uploadOk = 0;
                }if($uploadOk == 1){
                    $imagesrc = "$target_directory$image_file";
                    move_uploaded_file($_FILES["profile_img"]["tmp_name"],  "$imagesrc");
                    return $image_file;
                }else{
                    return 'DEFAULT';
                }
            }
        }
    }
    public function ReplaceImage($id, $dir, $filename, $bool){

        $link = $this->StartConnection();

        $file = $_FILES['file']['name'];
        $target_file = $dir . basename($file);
        $file_ext = explode(".", $file);
        $image_file = $filename.'.'.end($file_ext);
        if($bool === true){
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $sql = "SELECT profilesrc FROM accounts WHERE id = '$id' LIMIT 1";
            $query = mysqli_query($link, $sql);
            if(mysqli_num_rows($query) == 1){
                if($row = mysqli_fetch_array($query)){
                    $delsrc = $row['profilesrc'];
                    // $dbFilename = $row['filename'];
                }
            }
            if(($dir != '') && ($filename != '') && ($file != '')){
                $check = getimagesize($_FILES["file"]["tmp_name"]);
                if($check !== false) {
                    $uploadOk = 1;
                }else{
                    $uploadOk = 0;
                }if(file_exists($target_file) == 1) {
                    $uploadOk = 1;
                }else{
                    $uploadOk = 1;
                    mkdir("$dir"); 
                }if($_FILES["file"]["size"] > 5242880){
                    $uploadOk = 0;
                }if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "jfif" && $imageFileType != "webp" && $imageFileType != "svg"){
                    $uploadOk = 0;
                }if($uploadOk == 0) {
                    return false;
                }if($uploadOk == 1){
                    $imagesrc = $dir.$image_file;
                    unlink($delsrc);
                    move_uploaded_file($_FILES["file"]["tmp_name"],  $imagesrc);
                    return $image_file;
                }else{
                    return 'DEFAULT';
                }
            }
        }
    }
    public function UploadVaccine($target_directory, $filename, $bool){
        $file = $_FILES["vaccine_img"]["name"];
        $target_file = $target_directory . basename($file);
        $file_ext = explode(".", $file);
        $image_file = $filename . '.' . end($file_ext);
        if($bool === true){
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            if(($target_directory != null) && ($filename != null) && ($file != null)){
                mkdir("$target_directory"); 
                $check = getimagesize($_FILES["vaccine_img"]["tmp_name"]);
                if($check !== false) {
                    $uploadOk = 1;
                } else {
                    $uploadOk = 0;
                }if(file_exists($target_file)) {
                    $uploadOk = 0;
                }if($_FILES["vaccine_img"]["size"] > 5242880) {
                    $uploadOk = 0;
                }if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "jfif" && $imageFileType != "webp" && $imageFileType != "svg") {
                    $uploadOk = 0;
                }if($uploadOk == 1){
                    $imagesrc = "$target_directory$image_file";
                    move_uploaded_file($_FILES["vaccine_img"]["tmp_name"],  "$imagesrc");
                    return $image_file;
                }else{
                    return 'DEFAULT';
                }
            }
        }
    }
}

class Filter{
    public function Alpha($value){
        return preg_replace("/[^a-zA-Z]+/", "", $value);
    }
    // public function Numeric($value){
    //     return preg_replace("/(.)\\1+/", "$1", preg_replace("/[^0-9.]+/", "", $value));
    // }
    public function Numeric($value){
        return preg_replace("/[^0-9.]/i", "", $value);
    }
    public function AlphaNumeric($value){
        return preg_replace("/[^a-z0-9]/i", "", $value);
    }
    public function AlphaSpace($value){
        return preg_replace("/[^a-zA-Z ]+/", "", $value);
    }
    public function AlphaNumSpace($value){
        return preg_replace("/[^a-z0-9 ]/i", "", $value);
    }
    public function SEO($value){
        return preg_replace("/[^a-z 0-9-+!@#$%^&*()]/i", "", $value);
    }
    public function Email($value){
        return preg_replace("/[^a-zA-Z0-9.@_]+/", "", $value);
    }
    public function TextTruncate($text, $length) {
        if(strlen($text)<=$length) {
            echo $text;
        } else {
            $truncated = substr($text, 0, $length) . '...';
            echo $truncated;
        }
    }

}

Class Time{
    function AddMinutes($time, $plusMinutes) {
        $time = DateTime::createFromFormat('H:i:s', $time);
        $time->add( new DateInterval('PT'.((integer) $plusMinutes ).'M'));
        $newTime = $time->format('H:i:s');
        return $newTime;
    }
}

class Security{

    private $secret_key = 'AttenVax';
    private $secret_iv= 'Hannah Mae Tiongson Ciriaco';
    private $encrypt_method = "AES-256-CBC";

    public function Hashing($action, $string) {
        $output = false;
        $encrypt_method = $this->encrypt_method;
        $secret_key = $this->secret_key;
        $secret_iv = $this->secret_iv;
        // hash
        $key = hash('sha256', $secret_key);
    
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        if ($action == 'encrypt'){
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        }elseif($action == 'decrypt'){
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }
}
?>