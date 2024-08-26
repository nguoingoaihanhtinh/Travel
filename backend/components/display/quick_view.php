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

// Fetch categories from the database
$sqlCategories = "SELECT DISTINCT c.category_name FROM tbl_category c JOIN tbl_product p ON c.category_id = p.category_id";
$categories = $conn->query($sqlCategories)->fetchAll(PDO::FETCH_ASSOC);

foreach ($categories as $category) {
    //$selected = ($selectedCategory && $selectedCategory == $category['category_name']) ? 'selected' : '';
    $selected = (isset($_GET['category']) && $_GET['category'] == $category['category_name']) ? 'selected' : '';
    echo "<option value='" . htmlspecialchars($category['category_name']) . "' $selected>" . htmlspecialchars($category['category_name']) . "</option>";
}

include 'user_header.php'
?>


<div class="head-page">
    <h3>quick view</h3>
    <p><a href="home.php">home</a><span> / dish</span></p>
</div>
<section class="quick-view">
        <h1 class="heading">quick view</h1>
        <?php
        
        $pid = isset($_GET['pid']) ? $_GET['pid'] : null;
        if ($pid) {
            // Fetch product by product id and join with category to get category name
            $select_products = $conn->prepare("
                SELECT p.*, c.category_name 
                FROM tbl_product p 
                JOIN tbl_category c ON p.category_id = c.category_id 
                WHERE p.product_id = ?
            ");
            $select_products->execute([$pid]);
        }
        if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
        ?>
        <form action="" method="post" class="box">
        <input type="hidden" name="pid" value="<?= $fetch_products['product_id']; ?>">
        <input type="hidden" name="name" value="<?= $fetch_products['product_name']; ?>">
        <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
        <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
         <img src="uploads/<?= $fetch_products['image']; ?>" alt="">
        <a href="menu.php?category=<?= $fetch_products['category_name']; ?>" class="cat"><?= $fetch_products['category_name']; ?></a>
        <div class="name"><?= $fetch_products['product_name']; ?></div>
        <div class="flex">
            <div class="price"><span>$</span><?= $fetch_products['price']; ?></div>
            <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
        </div>
      <button type="submit" name="add_to_cart" class="btn">add to cart</button>
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
   ?>
</section>























<?php 
include 'footer.php';
?>

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="js/admin_script.js?v=1"></script>
</body>

</html>