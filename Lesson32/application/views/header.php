<div class="t-header">
	<div class="t-logo">
		<a href="/">
			Shoper
		</a>
	</div>
	<div class="t-menu">
		<ul>
			<li class="item <?php if($menu == 'store') { echo 'active'; } ?>">
				<a href="/">首頁</a>
			</li>
			<li class="item <?php if($menu == 'news') { echo 'active'; } ?>">
				<a href="news">最新消息</a>
			</li>
			<li class="item <?php if($menu == 'about') { echo 'active'; } ?>">
				<a href="about">關於我們</a>
			</li>
			<li class="item <?php if($menu == 'products' || $menu == 'product') { echo 'active'; } ?>">
				<a href="products/all">所有產品</a>
			</li>
			<li class="item <?php if($menu == 'contact') { echo 'active'; } ?>">
				<a href="contact">聯絡我們</a>
			</li>
			<li class="item <?php if($menu == 'qa') { echo 'active'; } ?>">
				<a href="qa">Q&A</a>
			</li>
			<li class="item <?php if($menu == 'search') { echo 'active'; } ?>">
				<a href="search">查詢訂單</a>
			</li>
			<li class="item itemCart">
				<a>
					<i class="icon cart"></i>$<?=$this->cart->total();?>
				</a>
			</li>
		</ul>
	</div>
</div>

<div class="ui right sidebar inverted vertical menu sidebarCart">
	<div class="sideCartItem">
		<?php foreach ($cart as $key => $value) { ?>
		<a class="item">
			<div class="itemCartImage">
				<div class="image" style="background-image: url(<?=$value['options']['image'];?>)"></div>
			</div>
			<div class="itemCartName"><?=$value['name'];?></div>
			<div class="itemCartQty">數量: <?=$value['qty'];?></div>
			<div class="itemCartPrice">單價: $<?=$value['price'];?></div>
			<div class="itemCartTotal">合計: $<?=$value['subtotal'];?></div>
			<div class="itemCartRemove" data-rowid="<?=$value['rowid'];?>">
				<i class="icon trash"></i>
			</div>
		</a>
		<?php } ?>
	</div>
	<div class="sideCartAction">
		<div class="cartTotalPrice">總價格: <div class="tprice">$<?=$this->cart->total();?></div></div>
		<a href="order" class="ui button red btnBuyCart">商品結帳</a>
		<button class="ui button yellow btnResetCart">清空購物車</button>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('.itemCart').on('click', function(e) {	
			e.preventDefault();
			$('.ui.sidebar').sidebar('toggle');
		});

		$('.itemCartRemove').on('click', function(e) {
			e.preventDefault();
			var that = $(this);
			var id = that.data('rowid');
			var api = 'api/removeFromCart';
			$.post(api, {
				rowid: id
			}, function(response) {
				window.alert(response.sys_msg);
				if(response.sys_code == 200) location.reload();
			}, 'json');
		});

		$('.btnResetCart').on('click', function(e) {
			e.preventDefault();
			var that = $(this);
			var api = 'api/resetTheCart';
			$.post(api, {}, function(response) {
				window.alert(response.sys_msg);
				if(response.sys_code == 200) location.reload();
			}, 'json');
		});
	});
</script>