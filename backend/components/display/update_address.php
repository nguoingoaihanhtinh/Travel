<?php

include 'connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
};
if(isset($_POST['submit'])){

    $address = $_POST['building'].', '.$_POST['road'].', '.$_POST['district'] .', '. $_POST['city'] .', '.$_POST['country'];
    $address = filter_var($address, FILTER_SANITIZE_STRING);
 
    $update_address = $conn->prepare("UPDATE tbl_user set address = ? WHERE user_id = ?");
    $update_address->execute([$address, $user_id]);
 
    $message[] = 'address saved!';
 
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
include 'user_header.php'
?>
<div class="head-page">
    <h3>update address</h3>
    <p><a href="profile.php">profile</a><span> / update address</span></p>
</div>
<section class="form-container">

   <form action="" method="post">
      <h3>your address</h3>
      <input type="text" class="box" placeholder="building no." required maxlength="50" name="building">
      <input type="text" class="box" placeholder="road name" required maxlength="50" name="road">
      <input type="text" class="box" placeholder="district name" required maxlength="50" name="district">
      <input type="text" class="box" placeholder="city name" required maxlength="50" name="city">
      <input type="text" class="box" placeholder="country name" required maxlength="50" name="country">
      <input type="submit" value="save address" name="submit" class="btn">
   </form>

</section>
<?php 
include 'footer.php';
?>


<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="js/admin_script.js?v=1"></script>
</body>

</html>