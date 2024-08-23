<?php
include "tool/database.php";
?>
<?php
    class product{
        private $db;
        public function __construct() {
            $this->db = new Database();
        }
        public function show_category(){
            $query = "SELECT * FROM tbl_category ORDER BY category_id DESC";
            $result = $this->db->select($query);
            return $result;
        }
        
        public function insert_product(){
            $product_name = $_POST["product_name"];
            $category_id = $_POST["category_id"];
            $price = $_POST["price"];
            $product_rating = $_POST["product_rating"];
            $image = $_FILES["image"]["name"];
            $filetarget = basename($_FILES['image']['name']);
            if(file_exists("uploads/$filetarget")){
                $alert = "file da ton tai";
                return $alert;
            }
            else{
                move_uploaded_file($_FILES["image"]["tmp_name"],"display/uploads/".$_FILES['image']['name']);
            $query = "INSERT INTO tbl_product 
            (product_name,category_id,price,image,product_rating) 
            Values ('$product_name','$category_id', '$price','$image','$product_rating')";
            $result = $this->db->insert($query);
        }

        //    // header('Location: brandlist.php');
        //     if($result){
        //         $query = "SELECT * FROM tbl_product ORDER BY product_id DESC LIMIT 1";
        //         $result = $this->db->select($query) -> fetch_assoc();
        //         $product_id = $result["product_id"];
        //         $filename = $_FILES['product_imgs']['name'];
        //         $filttmp = $_FILES['product_imgs']['tmp_name'];

        //         foreach($filename as $key => $value)
        //         {
        //             move_uploaded_file($filttmp[$key],"uploads/".$value);
        //             $query = "INSERT INTO tbl_product_image(product_id,product_imgs) VALUES ('$product_id','$value')";
        //             $result = $this->db->insert($query);
        //         }
        //     }
          

            // move_uploaded_file($_FILES["image"]["tmp_name"],"uploads/".$_FILES['image']['name']);
            // $query = "INSERT INTO tbl_product 
            // (product_name,category_id,price,image,product_rating) 
            // Values ('$product_name','$category_id', '$price','$image','$product_rating')";
            // $result = $this->db->insert($query);


           // header('Location: brandlist.php');
            // if($result){
            //     $query = "SELECT * FROM tbl_product ORDER BY product_id DESC LIMIT 1";
            //     $result = $this->db->select($query) -> fetch_assoc();
            //     $product_id = $result["product_id"];
            //     $filename = $_FILES['product_imgs']['name'];
            //     $filttmp = $_FILES['product_imgs']['tmp_name'];

            //     foreach($filename as $key => $value)
            //     {
            //         move_uploaded_file($filttmp[$key],"uploads/".$value);
            //         $query = "INSERT INTO tbl_product_image(product_id,product_imgs) VALUES ('$product_id','$value')";
            //         $result = $this->db->insert($query);
            //     }
            // }
            return $result;
        }
    }
?>