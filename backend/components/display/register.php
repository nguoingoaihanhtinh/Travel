<?php

include 'connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $password = sha1($_POST['password']);
   $password = filter_var($password, FILTER_SANITIZE_STRING);
   $cpassword = sha1($_POST['cpassword']);
   $cpassword = filter_var($cpassword, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM tbl_user WHERE email = ? OR number = ?");
   $select_user->execute([$email, $number]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $message[] = 'email or number already exists!';
   }else{
      if($password != $cpassword){
         $message[] = 'confirm password not matched!';
      }else{
         $insert_user = $conn->prepare("INSERT INTO tbl_user(name, email, number, password) VALUES(?,?,?,?)");
         $insert_user->execute([$name, $email, $number, $cpassword]);
         $select_user = $conn->prepare("SELECT * FROM tbl_user WHERE email = ? AND password = ?");
         $select_user->execute([$email, $password]);
         $row = $select_user->fetch(PDO::FETCH_ASSOC);
         if($select_user->rowCount() > 0){
            $_SESSION['user_id'] = $row['id'];
            $message[] = 'register successfully!';
            header('location:login.php');
         }
      }
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
<?php include 'user_header.php' ?>
<!-- header section start -->
<div class="head-page">
    <h3>register</h3>
    <p><a href="login.php">login</a><span> / register</span></p>
</div>
<section class="form-container">
    <form action="" method="post">
        <h3>register now</h3>
        <input type="text" name="name" required placeholder="enter your name" class="box" maxlength="50">
        <input type="email" name="email" required placeholder="enter your email" class="box" maxlength="50">
        <input type="number" name="number" required placeholder="enter your number" class="box" maxlength="10" min="0" max="9999999999">
        <input type="password" name="password" required placeholder="enter your password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="password" name="cpassword" required placeholder="confirm your password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="submit" value="register now" name="submit" class="btn">
        <p>already have an account? <a href="login.php">login now</a></p>
    </form>
</section>

<?php 
include 'footer.php';
?>


<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="js/admin_script.js?v=1"></script>
</body>

</html>