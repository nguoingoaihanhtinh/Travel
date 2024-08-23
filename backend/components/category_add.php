<?php
include "header_add.php";
include "slider.php";
include "class/category_class.php"
?>

<?php
$category = new category;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $category_name = $_POST['category_name'];
    $insert_category = $category ->insert_category($category_name);
}
?>
<div class="admin-content-right">
    <div class="admin-content-right-category_add">
        <h1>Thêm danh mục</h1>
            <form action="" method = "post">
                <input required name = "category_name" type="text" placeholder="Nhập tên danh mục">
                <button type="submit">Thêm</button>
            </form>
    </div>
</div>
</section>
</body>
</html>