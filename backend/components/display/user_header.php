




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
    

<!-- header section start -->
<header>


    <a href="home.php" class="logo"><i class="fa-solid fa-utensils"></i>UncleLora</a>
    <nav class="navbar">
        <a class="active" href="home.php">Home</a>
        <a href="menu.php">Dishes</a>
        <a href="about.php">About</a>
        <a href="menu.php">Menu</a>
        <a href="#review">Review</a>
        <a href="order.php">Order</a>
    </nav>

    <div class="icons">
        <?php
            $count_cart_items = $conn->prepare("SELECT * FROM tbl_cart WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_items = $count_cart_items->rowCount();
         ?>
        <i class="fas fa-bars" id="menu-bars"></i>
        <i class="fas fa-search" id="search-icon"></i>
        <a href="cart.php" class="fas fa-shopping-cart"><span>(<?= $total_cart_items; ?>)</span></a>
        <!-- <a href="#" class="fas fa-heart"></a> -->
        <i class="fas fa-user" id="user-btn"></i>
    </div>
    <form action="" id="search-form">
    <input type="search" placeholder="search here..." name="search-box" id="search-box">
    <button type="submit" class="fas fa-search" name="search_btn"></button>
    <i class="fas fa-times" id="close"></i>
    </form>

    
    <div class="profile">
         <?php
      
            $select_user = $conn->prepare("SELECT * FROM tbl_user WHERE user_id = :user_id");
            $select_user->bindParam(':user_id', $user_id);
            $select_user->execute();
            if ($select_user->rowCount() > 0) {
                $fetch_profile = $select_user->fetch(PDO::FETCH_ASSOC);
            ?>
         <p class="name"><?= $fetch_profile['name']; ?></p>
         <div class="flex">
            <a href="profile.php" class="btn">profile</a>
            <a href="user_logout.php" onclick="return confirm('logout from this website?');" class="btn">logout</a>
         </div>
         <p class="account">
            <a href="login.php">login</a> or
            <a href="register.php">register</a>
         </p> 
         <?php
            
        }else{
         ?>
            <p class="name">please login first!</p>
            <a href="login.php" class="btn">login</a>
         <?php
          }
         ?>
      </div>
</header>

