<div class="product-detals" data-product="<?=$product['id'];?>">
	<div class="pd-spec">
		<div class="productImage">
			<div class="previewImage" style="background-image: url('<?=$product['main_photo'];?>')"></div>
			<div class="smallImage">
				<ul>
					<?php foreach ($image_list as $key => $value) { ?>
					<li class="itemImage" style="background-image: url('<?=$value['product_image'];?>')"></li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<div class="productInfo">
			<h3 class="itemTitle"><?=$product['title'];?></h3>
			<p class="itemSubTitle"><?=$product['sub_title'];?></p>
			<div class="itemPrice">
				<span class="priceCost">$<?=$product['cost'];?></span>
				<span class="priceOrigin">$<?=$product['price'];?></span>
			</div>
			<div class="itemFormQuantity">
				<label for="itemQuantity" class="itemSubject">選擇數量</label>
				<div class="itemQuantity" id="itemQuantity">
					<a href="javascript: void(0)" class="btnQMinus">
						<i class="icon minus"></i>
					</a>
					<input type="count" class="inputQuantity" value="1" data-value="1">
					<a href="javascript: void(0)" class="btnQPlus">
						<i class="icon plus"></i>
					</a>
				</div>
			</div>
			<div class="itemFormButton">
				<?php if($product['reserve'] != 0) { ?>
				<button class="ui green button btnInsertCart">
					<i class="icon cart"></i>
					加入購物車
				</button>
				<a href="order" class="ui red button btnPaymentNow">
					<i class="icon dollar"></i>
					商品結帳
				</a>
				<?php }else{ ?>
				<button class="ui blue disabled button">
					<i class="icon paw"></i>
					抱歉目前尚無庫存，正在補貨中。
				</button>
				<?php } ?>
			</div>
		</div>
		<div class="productDetal">
			<div class="itemDetal">
				<?=$product['content'];?>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		previewImage();

		typeQuantity();

		addToCart();
	});

	function previewImage() {
		var view = $('.previewImage');
		var _target = $('.smallImage').find('.itemImage');
		_target.on('click', function() {
			var that = $(this);
			// get target background image path.
			var image = that.css('background-image');
			// preivew large iamge
			view.css('background-image', image);
		});
	}

	function typeQuantity() {
		var main = $('.itemFormQuantity');
		var _target = main.find('.inputQuantity');
		var defaultAmount = _target.data('value');
		var btnPlus = main.find('.btnQPlus');
		var btnMinus = main.find('.btnQMinus');
		btnPlus.on('click', function(e) {
			e.preventDefault();
			var amount = _target.val();
			if(IntergeRegex(amount)) {
				_target.val(parseInt(amount)+1);
			}else{
				_target.val(defaultAmount);
			}
		});
		btnMinus.on('click', function(e) {
			e.preventDefault();
			var amount = _target.val();
			if(IntergeRegex(amount)) {
				if(amount > 1) {
					_target.val(parseInt(amount)-1);
				}
			}else{
				_target.val(defaultAmount);
			}
		});
	}

	function addToCart() {
		$('.btnInsertCart').on('click', function(e) {
			e.preventDefault();
			var that = $(this);
			var id = that.closest('.product-detals').data('product');
			var qty = that.closest('.productInfo').find('.inputQuantity').val();
			var api = 'api/addToCart';
			$.post(api, {
				id: id,
				qty: qty
			}, function(response) {
				window.alert(response.sys_msg);
				if(response.sys_code == 200) location.reload();
			}, 'json');
		});
	}

	function IntergeRegex(number) {
		var intRegex = /^\d+$/;
		var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;
		if(intRegex.test(number)) {
			return true;
		}else{
			return false;
		}
	}
</script>