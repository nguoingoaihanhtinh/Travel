<?php
if(isset($_POST['add_to_cart'])) {
    if($user_id == '') {
        header('location:login.php');
    } else {
        $pid = filter_var($_POST['pid'], FILTER_SANITIZE_STRING);
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $price = filter_var($_POST['price'], FILTER_SANITIZE_STRING);
        $image = filter_var($_POST['image'], FILTER_SANITIZE_STRING);
        $qty = filter_var($_POST['quantity'], FILTER_SANITIZE_STRING);

        $check_cart_numbers = $conn->prepare("SELECT * FROM tbl_cart WHERE name = ? AND user_id = ?");
        $check_cart_numbers->execute([$name, $user_id]);

        if($check_cart_numbers->rowCount() > 0) {
            $message[] = 'already added to cart!';
        } else {
            $insert_cart = $conn->prepare("INSERT INTO tbl_cart(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
            $insert_cart->execute([$user_id, $pid, $name, $price, $qty, $image]);
            $message[] = 'added to cart!';
        }
    }
}
?>