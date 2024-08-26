<?php
include 'connect.php';


session_start();
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
}

include 'add_cart.php';
?>

<?php
$sqlproduct = "SELECT product_id,category_id,product_name,price,image,product_rating FROM tbl_product ORDER BY product_rating DESC 
               LIMIT 5";
$result = $conn->query($sqlproduct);
$stmt = $conn->prepare($sqlproduct);
$stmt->execute();
$dishes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?php
$sqlhero = "SELECT product_id,hero_id,description FROM tbl_hero";
$result = $conn->query($sqlhero);
$stmt = $conn->prepare($sqlhero);
$stmt->execute();
$heros = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

<!-- Home section starts-->
<section class="home" id="home">
    <div class="swiper home-slider">
        <div class="swiper-wrapper wrapper">
        <?php foreach ($heros as $hero) {
                // Fetch the corresponding product details using the product_id from tbl_hero
                $product_id = $hero['product_id'];
                $stmt = $conn->prepare("SELECT * FROM tbl_product WHERE product_id = ?");
                $stmt->execute([$product_id]);
                $product = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($product) {
                    ?>
            <div class="swiper-slide slide">
                <div class="content">
                    <span>our special dish</span>
                    <h3><?php echo htmlspecialchars($product['product_name']); ?></h3>
                    <p><?php echo htmlspecialchars($hero['description']); ?></p>
                    <a href="" class="btn">order now</a>
                </div>
                <div class="image">
                    <img src="uploads/<?php echo htmlspecialchars($product['image']); ?>" alt="">
                </div>
            </div>

            <?php }
            } ?>
        </div>

        <div class="swiper-pagination"></div>
    </div>
 
</section>
<!-- Home section ends-->

<section class="dishes" id="dishes">
    <h3 class="sub-heading"> our dishes</h3>
    <h1 class="heading">popular dishes</h1>
    <a href="menu.php" class="btn">see more</a>

    <div class="box-container">
        <?php foreach ($dishes as $dish) { ?>
        <div class="box">
            <a href="#" class="fas fa-heart"></a>
            <a href="quick_view.php?pid=<?= $dish['product_id']; ?>" class="fas fa-eye"></a>
            <img src="uploads/<?php echo htmlspecialchars($dish['image']); ?>" alt=""> 
            <h3><?php echo htmlspecialchars($dish['product_name']); ?></h3>
            <div class="stars">
    <?php
    $rating = $dish['product_rating']; // Assuming this is a decimal number like 4.5
    $fullStars = floor($rating); // Full stars
    $halfStar = $rating - $fullStars >= 0.5 ? true : false; // Half star if the remainder is 0.5 or more

    // Display full stars
    for ($i = 0; $i < $fullStars; $i++) {
        echo '<i class="fas fa-star"></i>';
    }

    // Display half star if applicable
    if ($halfStar) {
        echo '<i class="fas fa-star-half-alt"></i>';
    }

    // Fill the rest with empty stars
    for ($i = $fullStars + ($halfStar ? 1 : 0); $i < 5; $i++) {
        echo '<i class="far fa-star"></i>';
    }
    ?>
    </div>
            <span>$<?php echo htmlspecialchars($dish['price']); ?></span>
            <a href="#" class="btn">add to cart</a>
        </div>

        <?php } ?>
    </div>
 </section>

<!-- About section starts-->
<section class="about" id="about">
    <h3 class="sub-heading">about us</h3>
    <h1 class="heading">Uncle Lora</h1>
    <div class="row">
        <div class="content">
            <h3>got extra bedrooms</h3>
            <p>Welcome to Uncle Lora, where fresh ingredients and creative cuisine come together in a warm, inviting atmosphere. 
            Whether you're here for a casual meal or a special occasion, we promise a delightful dining experience. Enjoy our carefully crafted dishes and attentive service—we look forward to serving you!</p>
            <div class="icons-container">
                <div class="icons">
                    <i class="fas fa-shipping-fast"></i>
                    <span>free delivery</span>
                </div>
                <div class="icons">
                    <i class="fas fa-dollar-sign"></i>
                    <span>easy payment</span>
                </div>
                <div class="icons">
                    <i class="fas fa-headset"></i>
                    <span>24/7 service</span>
                </div>
            </div>
            <a href="about.php" class="btn">learn more</a>
        </div>
    </div>
</section>
<!-- Menu section starts-->
<section class="menu" id="menu">
    <h3 class="sub-heading">our menu</h3>
    <h1 class="heading">food category</h1>
    <div class="box-container">
        <a href="menu.php?category=Fast%20food" class="box" id="fastfood" >
            <img src="uploads/cat-fastfood.png" alt="">
            <h3>Fast food</h3>
        </a>
        <a href="menu.php?category=main%20dish" class="box">
            <img src="uploads/cat-maindish.png" alt="">
            <h3>main dishes</h3>
        </a>
        <a href="menu.php?category=drinks" class="box">
            <img src="uploads/cat-drinks.png" alt="">
            <h3>drinks</h3>
        </a>
        <a href="menu.php?category=desserts" class="box">
            <img src="uploads/cat-desserts.png" alt="">
            <h3>desserts</h3>
        </a>
    </div>
    
 </section>
<!-- Menu section ends-->
<!-- Review section starts-->

<section class="swiper review" id="review">
    <h3 class="sub-heading">customer's reviews</h3>
    <h1 class="heading">whay they say</h1>
    <div class="review-slider">
        <div class="swiper-wrapper wrapper">
            <div class="swiper-slide slide">
                <i class="fas fa-quote-right"></i>
                <div class="user">
                    <img src="uploads/ThuyDuongg.jpg" alt="">
                    <div class="user-info">
                        <h3>Thuy Duong Le</h3>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>
                <p>"The culinary experience at [Restaurant Name] is nothing short of extraordinary. From the impeccable presentation to the exquisite flavors, every dish reflects a deep passion for perfection. The ambiance is warm and inviting, making it the perfect spot for a memorable dining experience. The staff's attentiveness and knowledge elevate the meal, ensuring every visit feels special. Truly, a gem in the culinary world!"</p>
            </div>
            <div class="swiper-slide slide">
                <i class="fas fa-quote-right"></i>
                <div class="user">
                    <img src="uploads/Ori.png" alt="">
                    <div class="user-info">
                        <h3>Ori</h3>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>
                <p>""</p>
            </div>
            <div class="swiper-slide slide">
                <i class="fas fa-quote-right"></i>
                <div class="user">
                    <img src="uploads/fried-chicken-main-1.jpg" alt="">
                    <div class="user-info">
                        <h3>Fried chicken</h3>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>
                <p>"Who ate my chickens???"</p>
            </div>
            <div class="swiper-slide slide">
                <i class="fas fa-quote-right"></i>
                <div class="user">
                    <img src="uploads/nhinguyen.png" alt="">
                    <div class="user-info">
                        <h3>Nhi Nguyen</h3>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>
                <p>"[レストランの名前]の料理体験は、まさに卓越しています。見事なプレゼンテーションから繊細な味わいまで、すべての料理に完璧への情熱が感じられます。温かみのある雰囲気は、特別な食事の時間を過ごすのに最適です。スタッフの気配りと知識が食事をさらに引き立て、訪れるたびに特別な気持ちになります。まさに、料理界の宝石です！"</p>
            </div>
        </div>
    </div>
</section>
<!-- Review section ends-->
<?php 
include 'footer.php';
?>


<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="js/admin_script.js?v=1"></script>
</body>

</html>


















