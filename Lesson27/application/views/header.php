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
			<li class="item <?php if($menu == 'products') { echo 'active'; } ?>">
				<a href="products/all">所有產品</a>
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
	});
</script>