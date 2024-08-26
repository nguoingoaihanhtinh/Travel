<?php

include 'connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
};
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
    <h3>Profile</h3>
    <p><a href="home.php">home</a><span> / profile</span></p>
</div>
<section class="user-details">
    <div class="user">
        <img src="uploads/user.png" alt="">
        <p><i class="fas fa-user"></i><span><?= $fetch_profile['name']; ?></span></p>
        <p><i class="fas fa-phone"></i><span><?= $fetch_profile['number']; ?></span></p>
        <p><i class="fas fa-envelope"></i><span><?= $fetch_profile['email']; ?></span></p>
        <a href="update_profile.php" class="btn">update info</a>
        <p class="address"><i class="fas fa-map-marker-alt"></i><span><?php if($fetch_profile['address'] == ''){echo 'please enter your address';}else{echo $fetch_profile['address'];} ?></span></p>
        <a href="update_address.php" class="btn">update address</a>

    </div>
</section>

<?php 
include 'footer.php';
?>


<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="js/admin_script.js?v=1"></script>
</body>

</html>