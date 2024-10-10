<?php
session_start();
require_once("./functions/cart.php");
$items = getCartItems();
$grand_total = 0;

// Xử lý khi tăng/giảm số lượng sản phẩm
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $product_id = $_POST['product_id'];

  // Tăng số lượng sản phẩm
  if (isset($_POST['increase'])) {
    // Kiểm tra xem sản phẩm có tồn tại trong giỏ hàng không
    if (isset($_SESSION['cart'][$product_id])) {
      $_SESSION['cart'][$product_id] += 1; // Tăng số lượng
    } else {
      $_SESSION['cart'][$product_id] = 1; // Nếu chưa có, thêm vào giỏ hàng với số lượng 1
    }
  }

  // Giảm số lượng sản phẩm
  if (isset($_POST['decrease'])) {
    if (isset($_SESSION['cart'][$product_id])) {
      if ($_SESSION['cart'][$product_id] > 1) {
        $_SESSION['cart'][$product_id] -= 1; // Giảm số lượng
      } else {
        unset($_SESSION['cart'][$product_id]); // Nếu số lượng = 1, xóa sản phẩm khỏi giỏ hàng
      }
    }
  }
  // Xóa sản phẩm khỏi giỏ hàng
  if (isset($_POST['remove'])) {
    unset($_SESSION['cart'][$product_id]); // Xóa sản phẩm khỏi giỏ hàng
  }

  // Cập nhật lại giỏ hàng sau khi thay đổi
  $items = getCartItems();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="css/payment1.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
  <link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
  <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
  <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
  <link rel="stylesheet" type="text/css" href="styles/main_styles.css">
  <link rel="stylesheet" type="text/css" href="styles/responsive.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
</head>

<div class="super_container">

<div class="super_container">

<!-- Header -->

<header class="header trans_300">

  <!-- Top Navigation -->

  <div class="top_nav">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="top_nav_left">free shipping on all u.s orders over $50</div>
        </div>
        <div class="col-md-6 text-right">
          <div class="top_nav_right">
            <ul class="top_nav_menu">

              <!-- Currency / Language / My Account -->

              <li class="currency">
                <a href="#">
                  usd
                  <i class="fa fa-angle-down"></i>
                </a>
                <ul class="currency_selection">
                  <li><a href="#">cad</a></li>
                  <li><a href="#">aud</a></li>
                  <li><a href="#">eur</a></li>
                  <li><a href="#">gbp</a></li>
                </ul>
              </li>
              <li class="language">
                <a href="#">
                  English
                  <i class="fa fa-angle-down"></i>
                </a>
                <ul class="language_selection">
                  <li><a href="#">French</a></li>
                  <li><a href="#">Italian</a></li>
                  <li><a href="#">German</a></li>
                  <li><a href="#">Spanish</a></li>
                </ul>
              </li>
              <li class="account">
                <a href="#">
                  My Account
                  <i class="fa fa-angle-down"></i>
                </a>
                <ul class="account_selection">
                  <li><a href="login.php"><i class="fa fa-sign-in" aria-hidden="true"></i>Sign In</a>
                  </li>
                  <li><a href="RegisterPage.php"><i class="fa fa-user-plus"
                        aria-hidden="true"></i>Register</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Navigation -->

<div class="main_nav_container">
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-right">
            <div class="logo_container">
            <a href="index.php">Bronx<span>Luggage</span></a>
            </div>
            <nav class="navbar">
                <ul class="navbar_menu">
                    <li><a href="index.php">home</a></li>
                    <li><a href="category.php">shop</a></li>
                    <li><a href="page.php">pages</a></li>
                    <li><a href="contact.html">contact</a></li>
                </ul>
                <ul class="navbar_user">
                    <li><a href="#"><i class="fa fa-search" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fa fa-user" aria-hidden="true"></i></a></li>
                    <li class="checkout">
                        <a href="#">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        </a>
                    </li>
                </ul>
                
            </nav>
        </div>
    </div>
</div>
</div>
</header>

<div class="fs_menu_overlay"></div>
<div class="hamburger_menu">
  <div class="hamburger_close"><i class="fa fa-times" aria-hidden="true"></i></div>
  <div class="hamburger_menu_content text-right">
    <ul class="menu_top_nav">
      <li class="menu_item has-children">
        <a href="#">
          usd
          <i class="fa fa-angle-down"></i>
        </a>
        <ul class="menu_selection">
          <li><a href="#">cad</a></li>
          <li><a href="#">aud</a></li>
          <li><a href="#">eur</a></li>
          <li><a href="#">gbp</a></li>
        </ul>
      </li>
      <li class="menu_item has-children">
        <a href="#">
          English
          <i class="fa fa-angle-down"></i>
        </a>
        <ul class="menu_selection">
          <li><a href="#">French</a></li>
          <li><a href="#">Italian</a></li>
          <li><a href="#">German</a></li>
          <li><a href="#">Spanish</a></li>
        </ul>
      </li>
      <li class="menu_item has-children">
        <a href="#">
          My Account
          <i class="fa fa-angle-down"></i>
        </a>
        <ul class="menu_selection">
          <li><a href="login.php"><i class="fa fa-sign-in" aria-hidden="true"></i>Sign In</a></li>
          <li><a href="#"><i class="fa fa-user-plus" aria-hidden="true"></i>Register</a></li>
        </ul>
      </li>
      <li class="menu_item"><a href="index.php">home</a></li>
      <li class="menu_item"><a href="category.php">shop</a></li>
      <li class="menu_item"><a href="page.php">pages</a></li>
      <li class="menu_item"><a href="blog1.php">blog</a></li>
      <li class="menu_item"><a href="contact.html">contact</a></li>
    </ul>
  </div>
</div>

  <div class="payment1">
    <section class="h-100 gradient-custom">
      <div class="container py-5">
        <div class="row d-flex justify-content-center my-4">
          <div class="col-md-8">
            <div class="card mb-4">
              <div class="card-header py-3">
                <h5 class="mb-0"></h5>
              </div>
              <div class="card-body">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Thumbnail</th>
                      <th scope="col">Name</th>
                      <th scope="col">Qty</th>
                      <th scope="col">Price</th>
                      <th scope="col">Total $</th>

                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($items as $index => $item): ?>
                      <?php $grand_total += $item["price"] * $item["buy_qty"]; ?>
                      <tr>
                        <th scope="row"><?php echo $index + 1; ?></th>
                        <td><img src="<?php echo $item["thumbnail"]; ?>" width="80" /></td>
                        <td><?php echo $item["NAME"]; ?></td>
                        <td>
                          <form method="post" style="display:flex; align-items: center;">
                            <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                            <button type="submit" name="decrease" class="btn btn-danger btn-sm">-</button>
                            <input type="text" name="qty" value="<?php echo $item['buy_qty']; ?>"
                              class="form-control mx-2" style="width: 50px; text-align: center;" readonly>
                            <button type="submit" name="increase" class="btn btn-success btn-sm">+</button>
                          </form>
                        </td>
                        <td><?php echo $item["price"]; ?></td>
                        <td><?php echo $item["price"] * $item["buy_qty"]; ?></td>
                        <td>
                          <form method="post" style="display: inline;">
                            <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                            <button type="submit" name="remove" class="btn btn-link text-danger p-0"
                              style="font-size: 1.5rem;">&times;</button>
                          </form>
                        </td>

                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card mb-4">
              <div class="card-body">
                <p><strong>Expected shipping delivery</strong></p>
                <p class="mb-0">12.10.2020 - 14.10.2020</p>
              </div>
            </div>
            <div class="card mb-4 mb-lg-0">
              <div class="card-body">
                <p><strong>We accept</strong></p>
                <img class="me-2" width="45px"
                  src="https://www.shutterstock.com/image-vector/cash-on-delivery-logo-cod-260nw-2192949005.jpg"
                  alt="COD" />
                <img class="me-2" width="45px"
                  src="https://upload.wikimedia.org/wikipedia/commons/a/a4/Paypal_2014_logo.png"
                  alt="PayPal acceptance mark" />
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card mb-4">
              <div class="card-header py-3">
                <h5 class="mb-0">Summary</h5>
              </div>
              <div class="card-body">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                    Products $
                    <span><?php echo $grand_total; ?></span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                    Shipping
                    <span>Gratis</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                    <div>
                      <strong>Total amount $</strong>
                      <strong>
                        <p class="mb-0">(including VAT)</p>
                      </strong>
                    </div>
                    <span><strong><?php echo $grand_total; ?></strong></span>
                  </li>
                </ul>

                <button type="button" data-mdb-button-init data-mdb-ripple-init
                  class="btn btn-primary btn-lg btn-block">
                  <a href="/payment.php" class="btn btn-primary btn-lg btn-block">
                    Go to checkout
                  </a>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
  
  <!-- Footer -->

  <footer class="footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div
            class="footer_nav_container d-flex flex-sm-row flex-column align-items-center justify-content-lg-start justify-content-center text-center">
            <ul class="footer_nav">
              <li><a href="#">Blog</a></li>
              <li><a href="#">FAQs</a></li>
              <li><a href="contact.html">Contact us</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="footer_social d-flex flex-row align-items-center justify-content-lg-end justify-content-center">
            <ul>
              <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
              <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
              <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
              <li><a href="#"><i class="fa fa-skype" aria-hidden="true"></i></a></li>
              <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
            </ul>
          </div>
        </div>
      </div>

    </div>
  </footer>
</div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="js/custom.js"></script>
</section>