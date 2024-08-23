<?php
include 'connect.php';
session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'add_cart.php';

include 'header.php';
?>
<?php
$sql = "SELECT product_id,category_id,product_name,price,image,product_rating FROM tbl_product";
$result = $conn->query($sql);
$stmt = $conn->prepare($sql);
$stmt->execute();

$dishes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- Heading start -->
<div class="head-page">
    <h3>Menu</h3>
    <p><a href="home.php">home</a><span> / menu</span></p>
</div>
<!-- Menu-->
<section class="dishes">
    <div class="top-sort">
        
    <form method="GET" action="">
        <label for="category">Filter by Category:</label>
        <select name="category" id="category" onchange="this.form.submit()">
            <option value="">All</option>
            <?php
            // Fetch categories from the database
            $sqlCategories = "SELECT DISTINCT c.category_name FROM tbl_category c JOIN tbl_product p ON c.category_id = p.category_id";
            $categories = $conn->query($sqlCategories)->fetchAll(PDO::FETCH_ASSOC);

            foreach ($categories as $category) {
                //$selected = ($selectedCategory && $selectedCategory == $category['category_name']) ? 'selected' : '';
                $selected = (isset($_GET['category']) && $_GET['category'] == $category['category_name']) ? 'selected' : '';
                echo "<option value='" . htmlspecialchars($category['category_name']) . "' $selected>" . htmlspecialchars($category['category_name']) . "</option>";
            }
            ?>
        </select>

        <label for="sort">Sort by:</label>
        <select name="sort" id="sort" onchange="this.form.submit()">
            <option value="">Default</option>
            <option value="name_asc" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'name_asc') ? 'selected' : ''; ?>>Name A-Z</option>
            <option value="name_desc" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'name_desc') ? 'selected' : ''; ?>>Name Z-A</option>
            <option value="rating_desc" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'rating_desc') ? 'selected' : ''; ?>>Rating High to Low</option>
            <option value="rating_asc" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'rating_asc') ? 'selected' : ''; ?>>Rating Low to High</option>
        </select>
    </form>
        <p><a href="home.php">home</a> / <span>menu</span> /
        <?php echo isset($selectedCategory) && $selectedCategory != '' ? htmlspecialchars($selectedCategory) : 'All Categories'; ?></p>
    </div>
    <div class="box-container">
    <?php
        // Get the selected category and sort options
        $selectedCategory = isset($_GET['category']) ? $_GET['category'] : '';
        $sortOption = isset($_GET['sort']) ? $_GET['sort'] : '';        

        // Modify the SQL query based on the selected category and sort option
        $sqlDishes = "SELECT p.*, c.category_name FROM tbl_product p JOIN tbl_category c ON p.category_id = c.category_id";

        // Apply category filter if selected
        if ($selectedCategory) {
            $sqlDishes .= " WHERE c.category_name = :category_name";
        }

        // Apply sort option
        switch ($sortOption) {
            case 'name_asc':
                $sqlDishes .= " ORDER BY p.product_name ASC";
                break;
            case 'name_desc':
                $sqlDishes .= " ORDER BY p.product_name DESC";
                break;
            case 'rating_asc':
                $sqlDishes .= " ORDER BY p.product_rating ASC";
                break;
            case 'rating_desc':
                $sqlDishes .= " ORDER BY p.product_rating DESC";
                break;
            default:
                $sqlDishes .= " ORDER BY p.product_id ASC"; // Default sort by product ID
                break;
        }

        // Prepare and execute the query
        $stmt = $conn->prepare($sqlDishes);

        if ($selectedCategory) {
            $stmt->execute(['category_name' => $selectedCategory]);
        } else {
            $stmt->execute();
        }

        $dishes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Display the dishes
        if(count($dishes) > 0) {
            foreach( $dishes as $dish ) {
        ?>
        <div class="box">
            <a href="#" class="fas fa-heart"></a>
            <a href="#" class="fas fa-eye"></a>
            <img src="uploads/<?php echo htmlspecialchars($dish['image']); ?>" alt=""> 
            <h1><?php echo htmlspecialchars($dish['category_id']); ?></h1>
            <h3><?php echo htmlspecialchars($dish['product_name']); ?></h3>
            <div class="stars">
                <?php 
                $rating = $dish['product_rating'];
                for($i = 0; $i< 5; $i++){
                    if($i < floor($rating)) {
                        echo '<i class="fas fa-star"></i>';
                    }
                    else if($i < $rating){
                        echo '<i class="fas fa-star-half-alt"></i>';
                    }
                    else{echo '<i class="fas fa-star-half-alt"></i>';}
                }
                ?>
            </div>
            <span><?php echo htmlspecialchars($dish['price']); ?></span>
            <a href="#" class="btn">add to cart</a>
        </div>
        <?php 
                }
            }else{
                echo 'no dish available';
            }
        ?>
     
        
    </div>
</section>




















    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="js/script.js"></script>
<!-- Footer section starts-->
<section class="footer" id="footer">
    <div class="box-container">
        <div class="box">
            <h3>locations</h3>
            <a href="#">vietnam</a>
            <a href="#">japan</a>
            <a href="#">chinese</a>
            <a href="#">united state</a>
        </div>
        <div class="box">
            <h3>quick links</h3>
            <a href="#">home</a>
            <a href="#">dishes</a>
            <a href="#">about</a>
            <a href="#">menu</a>
            <a href="#">review</a>
            <a href="#">order</a>
        </div>
        <div class="box">
            <h3>contact info</h3>
            <a href="#">+123-456-7890</a>
            <a href="#">lorakitchen@gmail.com</a>
        </div>
        <div class="box">
            <h3>Follow us</h3>
            <a href="#">facebook</a>
            <a href="#">twitter</a>
            <a href="#">instagram</a>
        </div>
    </div>
    <div class="credit">copy right @ 2024 by <span>Sir Lora</span></div>
 </section>
<!-- Footer section ends-->

<!-- Loader-->
<div class="loader-container">
    <img src="" alt="">
</div>





    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>