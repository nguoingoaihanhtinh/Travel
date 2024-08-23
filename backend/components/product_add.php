<?php
include "header_add.php";
include "slider.php";
include "class/product_class.php";
?>
<?php 
$product = new product;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  
   
//    echo '<pre>';
//    echo print_r($_POST);
//    echo '<pre>';
    $insert_product = $product ->insert_product($_POST, $_FILES);
}
?>

<div class="admin-content-right">
    <div class="admin-content-right">
        <div class="admin-content-right-product_add">
            <h1>Thêm sản phẩm</h1>
            <form action="" method = "post" enctype="multipart/form-data">
                    <label for="">Nhập tên sản phẩm <span style="color: red;">*</span></label>
                    <input name="product_name" required type="text">


                    <label for="">Chọn danh mục <span style="color: red;">*</span></label>
                    <select name="category_id" id="category_id">
                        <option value="#">--Chọn--</option>
                            <?php 
                                $show_category = $product -> show_category(); 
                                if($show_category){
                                while($result = $show_category->fetch_assoc()){
                            ?>
                        <option value="<?php echo $result['category_id']?>"><?php echo $result['category_name']?></option>
                        <?php }} ?> 
                    </select>
                    <label for="">Giá sản phẩm <span style="color: red;">*</span></label>
                    <input name="price" required type="text">
                  
                   
                    <label for="">Ảnh sản phẩm <span style="color: red;">*</span></label>
                    <span style="color:red"><?php if(isset($insert_product)){
                        echo $insert_product;
                    } ?></span>
                    <input name="image" required type="file">
                    <label for="">Đánh giá sản phẩm<span style="color: red;">*</span></label>
                    <input name="product_rating" required type="decimal">
                    <button type="submit">Thêm</button>
            </form>
        </div>
    </div>
</div>
</section>

<script type="importmap">
			{
				"imports": {
					"ckeditor5": "https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.js",
					"ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/43.0.0/"
				}
			}
		</script>
        <script src = "ckeditor/ckeditor.js">

        </script>
		<script type="module">
			ClassicEditor
				.create( document.querySelector( '#editor' ), {
				} )
				.then( editor => {
					window.editor = editor;
				} )
				.catch( error => {
					console.error( error );
				} );
		</script>
   
</body>
</html>