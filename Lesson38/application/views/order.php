<div class="checkout-spec">
	<div class="content">
		<div class="specCart">
			<h2 class="specCartTitle">購買清單</h2>
			<div class="ui items">
				<?php if(sizeof($cart) == 0) { ?>
				<div class="specCartNone">目前購物車尚無任何商品！</div>
				<?php }else{ ?>
					<?php foreach ($cart as $key => $value) { ?>
					<div class="item" data-rowid="<?=$value['rowid'];?>">
						<div class="specCartImage">
							<div class="image" style="background-image: url(<?=$value['options']['image']?>)"></div>
						</div>
						<div class="specCartContent">
							<h3 class="specCartName"><?=$value['name']?></h3>
							<div class="specCartQty">數量: <?=$value['qty'];?></div>
							<div class="specCartPrice">單價: $<?=$value['price'];?></div>
							<div class="specCartTotal">合計: $<?=$value['subtotal'];?></div>
							<div class="specCartAction">
								<button class="ui red basic button specCartRemove" data-rowid="<?=$value['rowid'];?>">
									<i class="icon trash"></i>刪除
								</button>
							</div>
						</div>
					</div>
					<?php } ?>
				<?php } ?>
			</div>
		</div>
		<div class="specForm">
			<form method="post" class="ui form">
				<div class="field">
					<div class="specFormTitle">
						運送資訊
					</div>
					<input type="hidden" name="rule" value="order">
				</div>
				<div class="field required">
					<label>收件人姓名</label>
					<input type="text" name="order_name" placeholder="Name" value="<?=$user['nickname'];?>">
				</div>
				<div class="two fields">
					<div class="field required">
						<label>收件人電話</label>
						<input type="text" name="order_phone" placeholder="Phone" value="<?=$user['phone'];?>">
					</div>
					<div class="field required">
						<label>收件人信箱</label>
						<input type="text" name="order_email" placeholder="Email" value="<?=$user['email'];?>">
					</div>
				</div>
				<div class="field required">
					<label>收件人地址</label>
					<input type="text" name="order_addr" placeholder="Address" value="<?=$user['address'];?>">
				</div>
				<div class="field">
					<label>備註</label>
					<textarea name="order_remark"></textarea>
				</div>
				<div class="field">
					<button class="ui button blue">提交訂單</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('.specCartRemove').on('click', function(e) {
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