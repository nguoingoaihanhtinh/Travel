
<?php 
if(isset($message)){
    foreach($message as $message){
        echo' 
        <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>';
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
    <title>Foodie</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    
</head>
<body>

<!-- header section start -->
<header>
    <a href="#" class="logo"><i class="fa-solid fa-utensils"></i>UncleLora</a>
    <nav class="navbar">
        <a class="active" href="#home">Home</a>
        <a href="#dishes">Dishes</a>
        <a href="#about">About</a>
        <a href="#menu">Menu</a>
        <a href="#review">Review</a>
        <a href="#order">Order</a>
    </nav>

    <div class="icons">
        <?php
            $count_cart_items = $conn->prepare("SELECT * FROM tbl_cart WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_items = $count_cart_items->rowCount();
         ?>
        <i class="fas fa-bars" id="menu-bars"></i>
        <a href="search.php" class="fas fa-search" ></a>
        <a href="cart.php" class="fas fa-shopping-cart"><span>(<?= $total_cart_items; ?>)</span></a>
        <a href="#" class="fas fa-heart"></a>
        <a href="#" class="fas fa-user"></a>
    </div>
</header>
<!-- search form-->
<form action="" id="search-form">
    <input type="search" placeholder="search here..." name="" id="search-box">
    <label for="search-box" class="fas fa-search"></label>
    <i class="fas fa-times" id="close"></i>
</form>
