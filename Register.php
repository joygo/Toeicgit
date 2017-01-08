<!DOCTYPE html>
<html>
<head>
	<meta charset="utf8">
	<title>會員註冊區</title>


<?php
session_start();




$ID = $account = $password = $Gender = "";
$IDError = $accountError = $passwordError = $genderError = "";
$SuccessFlag = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST")
 {
   if(empty($_POST["ID"]))
   {
      $IDError = "姓名是必須的呢!";
   }
   else
   {
      $ID = Decode_input($_POST["ID"]);
      $SuccessFlag++;
   }
   if(empty($_POST["account"]))
   {
      $accountError = "帳號是必須的呢!";
   }
   else
   {
       $account = Decode_input($_POST["account"]);
       $SuccessFlag++;
   }
   if(empty($_POST["password"]))
   {
      $passwordError = "密碼是必須的呢!";
   }
   else
   {
     $password = Decode_input($_POST["password"]);
     $SuccessFlag++;
   }
   if(empty($_POST["gender"]))
   {
      $genderError = "請選擇性別!";
      
   }
   else
   {
   @$Gender = Decode_input($_POST["gender"]);  //avoid notice.
    $SuccessFlag++;
   }
   
   if($SuccessFlag==4)
   {
    $_SESSION['ID']=$ID;
    $_SESSION['Account']=$account;
    $_SESSION['Password']=$password;
    $_SESSION['Gender']=$Gender;

   require_once('../LoadRegister.php');
   
 
   }
}



function Decode_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
   
}

?>

</head>
<body>


 <style type="text/css">
 	header { padding : 5px 5px 30px 5px; border: 3px solid #FFFFFF; color: red; font-size :28px;}
 	div {margin-left: auto;margin-right: auto; width: 600px;}
 	input {padding :10px; margin :5px;}
   span {color: red ;  }
 </style>
 <div>
 <header>歡迎註冊使用</header>
 <p><span>*<span>代表必填</p>
 <form method="post" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">

 姓名:<input type="text" name="ID" autocomplete="off"><span>*<?php echo $IDError; ?></span><br> 
 帳號:<input type="text" name="account" autocomplete="off"><span>*<?php echo $accountError; ?></span><br> 
 密碼:<input type="password" name="password" autocomplete="off"><span>*<?php echo $passwordError; ?></span><br> 	
 性別:<span>*<?php echo $genderError; ?></span><br>
      <input type="radio" name="gender" value=female>女性
  	   <input type="radio" name="gender" value=male>男性<br>
      <input type="submit" name ="submit" value="提交">
 </form>

<?php



echo "<h2>您的输入：</h2>";
echo $ID;
echo "<br>";
echo $account;
echo "<br>";
echo $password;
echo "<br>";
echo $Gender;
?>


 </div>              
</body>
</html>