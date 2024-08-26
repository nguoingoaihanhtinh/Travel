<?php
include 'connect.php';
session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
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





<!-- search form-->
<form action="" id="search-form">
    <input type="search" placeholder="search here..." name="search-box" id="search-box">
    <button type="submit" class="fas fa-search" name="search_btn"></button>
    <i class="fas fa-times" id="close"></i>
</form>
<section class="dishes" style="min-height: 100vh; padding-top:0;">

<div class="box-container">

      <?php
         if(isset($_POST['search_box']) OR isset($_POST['search_btn'])){
         $search_box = $_POST['search_box'];
         $select_products = $conn->prepare("SELECT * FROM tbl_product WHERE name LIKE '%{$search_box}%'");
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
      ?>
        <form action="" method="post" class="box">
         <input type="hidden" name="pid" value="<?= $fetch_products['product_id']; ?>">
         <input type="hidden" name="name" value="<?= $fetch_products['product_name']; ?>">
         <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
         <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
         <a href="quick_view.php?pid=<?= $fetch_products['product_id']; ?>" class="fas fa-eye"></a>
         <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
         <img src="uploads/<?= $fetch_products['image']; ?>" alt="">
         <a href="category.php?category=<?= $fetch_products['category_id']; ?>" class="cat"><?= $fetch_products['category_id']; ?></a>
         <div class="name"><?= $fetch_products['product_name']; ?></div>
         <div class="flex">
            <div class="price"><span>$</span><?= $fetch_products['price']; ?></div>
            <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
         </div>
      </form>


      <?php
            }
         }else{
            echo '<p class="empty">no products added yet!</p>';
         }
      }
      ?>
</div>

<?php 
include 'footer.php';
?>


<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="js/admin_script.js?v=1"></script>
</body>

</html>