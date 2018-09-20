<?php 
	$siteUrl = "http://localhost/pt13312/";
	$conn = new PDO("mysql:host=127.0.0.1;dbname=web204;charset=utf8", 
		"root", "123456");
	// lay du lieu tu bang websettings de hien thi thong tin cho header va footer
	$getSettingQuery = "select * from web_settings";
	$stmt = $conn->prepare($getSettingQuery);
	$stmt->execute();

	$setting = $stmt->fetch();
	// echo "<pre>";
	// var_dump($setting);

	// lay du lieu tu bang categories de do data cho menu
	$menuQuery = "select * from categories";
	$stmt = $conn->prepare($menuQuery);
	$stmt->execute();

	$menus = $stmt->fetchAll();
	// echo "<pre>";
	// var_dump($menus);
	// lay du lieu trong bang slideshows cho phan slider
	$sliderQuery = "select * from slideshows";
	$stmt = $conn->prepare($sliderQuery);
	$stmt->execute();

	$sliders = $stmt->fetchAll();

	// 6 ban ghi co id lon nhat
	$newProductsQuery = "select * 
						from products 
						order by id desc
						limit 6";
	$stmt = $conn->prepare($newProductsQuery);
	$stmt->execute();

	$newProducts = $stmt->fetchAll();

	// 6 ban ghi co luong view lon nhat
	$mostViewProductsQuery = "	select * 
								from products
								order by views desc
								limit 6";
	$stmt = $conn->prepare($mostViewProductsQuery);
	$stmt->execute();

	$mostViewProducts = $stmt->fetchAll();


 ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="css/bootstrap-3/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/main.css">
	<script src="js/jquery.min.js"></script>
	<script src="css/bootstrap-3/js/bootstrap.min.js"></script>

	<title>Trang chủ</title>
</head>

<body>
	<div id="header">
		<div class="container">
			<div class="col-md-2 col-xs-12 col-sm-4">
				<a href="index.html">
					<img src="<?= $siteUrl . $setting['logo']?>" alt="Logo">
				</a>
			</div>
			<div class="col-md-10 col-xs-12 col-sm-8">
				<div class="header-time col-md-12 col-xs-12 col-sm-12">
					<a href="#" class="col-md-4">Thời gian làm việc:8h30-17h</a>
					<a href="#" class="col-md-3">Hotline: <?= $setting['hotline']?></a>
				</div>
				<div class="clear-fix"></div>
				<div class="header-menu col-md-12">
					<ul class="nav navbar-nav">
						<li>
							<a href="index.html">Trang chủ</a>
						</li>
						<li>
							<a href="gioithieu.html">Giới thiệu</a>
						</li>
						<?php foreach ($menus as $m): ?>
							<li>
								<a href="danh-muc.php?id=<?= $m['id']?>"><?= $m['name']?></a>
							</li>
						<?php endforeach ?>
						<li>
							<a href="liên hệ.html">Liên hệ</a>
						</li>
					</ul>
					<!-- <form class="navbar-form navbar-left">
						<div class="form-group">
							<input type="text" class="form-control search" placeholder="Từ khóa">
						</div>
						<button type="submit" class="btn btn-info">Tìm kiếm</button>
					</form> -->
				</div>
			</div>
		</div>
	</div>
	<div id="slideShow">
		<div class="container-fluid">
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<?php 
					$count = 0;
					foreach ($sliders as $slide): 
						$act = $count == 0 ? "active" : "";						
					?>

						<li data-target="#myCarousel" data-slide-to="<?= $count?>" class="<?= $act ?>"></li>
						
					<?php 
						$count++;
						endforeach 
					?>
				</ol>
				<div class="carousel-inner">
					<?php 
					$count = 0;
					foreach ($sliders as $slide): 
						$act = $count == 0 ? "active" : "";						
					?>
						<div class="item <?= $act?>">
							<img src="<?= $slide['image']?>">
						</div>
						
					<?php 
						$count++;
						endforeach 
					?>
					
				</div>
				<a class="left carousel-control" href="#myCarousel" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#myCarousel" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div>
	</div>
	<div id="product">
		<div class="container">
			<div class="tittle-product">
				<h2>Sản phẩm mới</h2>
			</div>
			<?php foreach ($newProducts as $product): ?>
				
				<div class="col-sm-4 col-xs-12">
					<div class="img-height">
						<img src="<?= $siteUrl . $product['image']?>" alt="">
					</div>
					<a class="title-name"><?= $product['product_name']?></a>
					<div class="text-center">
						Giá bán: <strike><b><?= $product['list_price']?> vnđ</b></strike>
						<br>
						Giá khuyến mại: <b><?= $product['sell_price']?> vnđ</b>
					</div>

					<div class="footer-product">
						<a href="#" class="details">Xem chi tiết</a>
					</div>
				</div>
			<?php endforeach ?>
			

		</div>
	</div>
	<div id="hot-product">
		<div class="container">
			<div class="tittle-product">
				<h2>Sản phẩm bán chạy</h2>
			</div>

			<div class="col-sm-4 col-xs-12">
				<div class="img-height">
					<img src="img/product-hot1.jpg" alt="">
				</div>
				<a class="title-name">Kẹo dẻo</a>
				<div class="text-center">
					<a class="promotional">100.000Đ</a>
				</div>
				<div class="footer-product">
					<a href="#" class="details">Xem chi tiết</a>
					<a href="#" class="buying">Mua hàng</a>
				</div>
			</div>
			<div class="col-sm-4 col-xs-12">
				<div class="img-height">
					<img src="img/product-hot2.jpg" alt="">
				</div>
				<a class="title-name">Kẹo dẻo</a>
				<div class="text-center">
					<a class="promotional">100.000Đ</a>
				</div>
				<div class="footer-product">
					<a href="#" class="details">Xem chi tiết</a>
					<a href="#" class="buying">Mua hàng</a>
				</div>
			</div>
			<div class="col-sm-4 col-xs-12">
				<div class="img-height">
					<img src="img/product-hot3.jpg" alt="">
				</div>
				<a class="title-name">Kẹo dẻo</a>
				<div class="text-center">
					<a class="promotional">100.000Đ</a>
				</div>
				<div class="footer-product">
					<a href="#" class="details">Xem chi tiết</a>
					<a href="#" class="buying">Mua hàng</a>
				</div>
			</div>
			<div class="col-sm-4 col-xs-12">
				<div class="img-height">
					<img src="img/product-hot4.jpg" alt="">
				</div>
				<a class="title-name">Kẹo dẻo</a>
				<div class="text-center">
					<a class="promotional">100.000Đ</a>
				</div>
				<div class="footer-product">
					<a href="#" class="details">Xem chi tiết</a>
					<a href="#" class="buying">Mua hàng</a>
				</div>
			</div>
			<div class="col-sm-4 col-xs-12">
				<div class="img-height">
					<img src="img/product-hot5.jpg" alt="">
				</div>
				<a class="title-name">Kẹo dẻo</a>
				<div class="text-center">
					<a class="promotional">100.000Đ</a>
				</div>
				<div class="footer-product">
					<a href="#" class="details">Xem chi tiết</a>
					<a href="#" class="buying">Mua hàng</a>
				</div>
			</div>
			<div class="col-sm-4 col-xs-12">
				<div class="img-height">
					<img src="img/product-hot1.jpg" alt="">
				</div>
				<a class="title-name">Kẹo dẻo</a>
				<div class="text-center">
					<a class="promotional">100.000Đ</a>
				</div>
				<div class="footer-product">
					<a href="#" class="details">Xem chi tiết</a>
					<a href="#" class="buying">Mua hàng</a>
				</div>
			</div>

		</div>
	</div>
	<div id="partner">
		<div class="container">
			<h2 class="title-product">Các đối tác</h2>
			<div class="partner-img col-md-3 col-xs-6">
				<img src="img/partner1.jpg" alt="">
			</div>
			<div class="partner-img col-md-3 col-xs-6">
				<img src="img/partner2.jpg" alt="">
			</div>
			<div class="partner-img col-md-3 col-xs-6">
				<img src="img/partner3.jpg" alt="">
			</div>
			<div class="partner-img col-md-3 col-xs-6">
				<img src="img/partner4.jpg" alt="">
			</div>
		</div>
	</div>
	<div id="footer">
		<div class="container">

			<div class="col-md-8">
				<?= $setting['map']?>
			</div>
			<div class="col-md-4 footer-main">
				<div>
					<label>Gmail:</label>
					<a href="#"><?= $setting['email']?></a>
				</div>
				<div>
					<label>Số điện thoại:</label>
					<a href="#"><?= $setting['hotline']?></a>
				</div>
				<div>
					<label>Giờ làm việc:</label>
					<a href="#">8h30-17h</a>
				</div>
				<div>
					<label>Facebook:</label>
					<a href="#"><?= $setting['fb']?></a>
				</div>
			</div>
		</div>
	</div>
</body>

</html>