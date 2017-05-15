<div class="contentSpec">
	<div class="ui container containerSpec">
		<div class="ui grid">
			<div class="sixteen wide column">
				<h2 class="ui dividing header">
					<i class="icon spy"></i>
					<div class="content">
						詳細訂單狀況
						<div class="sub header">此處可以針對訂單狀況進行更新。</div>
					</div>
				</h2>
				<?php if(isset($sys_code)) { ?>
				<div class="ui bottom attached warning message">
					<i class="icon warning"></i>
					<?=$sys_msg; ?>
				</div>
				<?php } ?>
				<form class="ui form tableForm" method="post">
					<h4 class="ui dividing header">個人資訊</h4>
					<input type="hidden" name="rule" value="update">
					<input type="hidden" name="id" value="<?=$res['id'];?>">
					<div class="three fields">
						<div class="field">
							<label>姓名</label>
							<input type="text" disabled name="buy_name" value="<?=$res['buy_name'];?>">
						</div>
						<div class="field">
							<label>手機</label>
							<input type="text" disabled name="buy_phone" value="<?=$res['buy_phone'];?>">
						</div>
						<div class="field">
							<label>信箱</label>
							<input type="text" disabled name="buy_email" value="<?=$res['buy_email'];?>">
						</div>
					</div>
					<div class="three fields">
						<div class="field">
							<label>地址</label>
							<input type="text" name="buy_addr" value="<?=$res['buy_addr'];?>">
						</div>
						<div class="field">
							<label>訂單編號</label>
							<input type="text" name="id" value="<?=$res['id'];?>">
						</div>
						<div class="field">
							<label>訂單狀態</label>
							<div class="ui fluid search selection dropdown dropdownSataus">
								<input type="hidden" name="status">
								<i class="dropdown icon"></i>
								<div class="default text">訂單狀態</div>
								<div class="menu">
									<div class="item" data-value="0">等待付款</div>
									<div class="item" data-value="1">完成付款</div>
									<div class="item" data-value="2">運送處理</div>
									<div class="item" data-value="3">完成訂單</div>
								</div>
							</div>
						</div>
					</div>
					<div class="field">
						<label>備註</label>
						<textarea disabled><?=$res['remark'];?></textarea>
					</div>
					<h4 class="ui dividing header">訂單商品</h4>
					<table class="ui celled padded table">
						<thead>
							<tr class="center aligned">
								<th>照片</th>
								<th>名稱</th>
								<th>價格</th>
								<th>數量</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($res['sub_order'] as $key => $value) { ?>
							<tr class="middle center aligned">
								<td><img src="<?=$value['product_photo'];?>" alt="photo" class="ui tiny image"></td>
								<td><?=$value['product_name'];?></td>
								<td><?=$value['product_price'];?></td>
								<td><?=$value['product_qty'];?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
					<button class="ui green button" type="submit" tabindex="0">送出</button>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('.ui.dropdown.dropdownSataus').dropdown('set selected', '<?=$res['status'];?>');
	});
</script>