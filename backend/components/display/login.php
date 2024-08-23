<?php 
include 'connect.php'; 


session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $password = sha1($_POST['password']);
   $password = filter_var($password, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM tbl_user WHERE email = ? AND password = ?");
   $select_user->execute([$email, $password]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      
      $_SESSION['user_id'] = $row['user_id'];
      $user_id = $_SESSION['user_id'];
      var_dump($user_id);
      
      $message[] = "login successfully!";
      //header('location:home.php');
   }else{
      $message[] = 'incorrect username or password!';
   }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name = "viewport" content="width = device-width, initial-scale = 1.0">
    <script src="https://kit.fontawesome.com/2b51d69771.js" crossorigin="anonymous"></script>
    <!-- <link rel = "stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"> -->
    <link rel = "stylesheet" href="phpstyle.css?v=<?php echo time(); ?>">
   
    <title>home</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
</head>
<body>

<?php
include 'user_header.php';
?>

<div class="head-page">
    <h3>shopping cart</h3>
    <p><a href="home.php">home</a><span> / cart</span></p>
</div>
<section class="form-container">
    <form action="" method="post">
        <h3>login now</h3>
        <input type="email" name="email" required placeholder="enter your email" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="password" name="password" required placeholder="enter your password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="submit" value="login now" class="btn" name="submit">
        <p>don't have an account? <a href="register.php">register now</a></p>
    </form>
</section>
<?php 
include 'footer.php';
?>


<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="js/admin_script.js?v=1"></script>
</body>

</html>
