<h1 class="ui center aligned header">
	<div class="content">
		交易完成
		<p class="sub header">
			感謝您的購買，以下是您這次的訂單資訊。
		</p>
	</div>
</h1>
<div class="ui one column stackable grid container">
	<div class="ui form column">
		<h4 class="ui dividing header">個人資訊</h4>
		<div class="three fields">
			<div class="field">
				<label>姓名</label>
				<input type="text" disabled value="<?=$order['buy_name'];?>">
			</div>
			<div class="field">
				<label>電話</label>
				<input type="text" disabled value="<?=$order['buy_phone'];?>">
			</div>
			<div class="field">
				<label>信箱</label>
				<input type="text" disabled value="<?=$order['buy_email'];?>">
			</div>
		</div>
		<div class="three fields">
			<div class="field">
				<label>地址</label>
				<input type="text" disabled value="<?=$order['buy_addr'];?>">
			</div>
			<div class="field">
				<label>訂單編號</label>
				<input type="text" disabled value="<?=$order['id'];?>">
			</div>
			<div class="field">
				<label>訂單狀太</label>
				<input type="text" disabled value="
					<?php 
						if($order['status'] == 0) {
							echo '等待付款';
						}else if($order['status'] == 1){
							echo '完成付款';
						}else if($order['status'] == 2){
							echo '運送處理';
						}else if($order['status'] == 3){
							echo '完成訂單';
						}
					 ?>
				">
			</div>
		</div>
		<div class="field">
			<label>備註</label>
			<textarea disabled><?=$order['buy_remark'];?></textarea>
		</div>
	</div>
	<div class="column">
		<h4 class="ui dividing header">訂單資訊</h4>
		<table class="ui very celled table">
			<thead>
				<tr>
					<th>產品照片</th>
					<th>產品名稱</th>
					<th>產品價格</th>
					<th>產品數量</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($order['sub_order'] as $key => $value) { ?>
				<tr>
					<td><img class="ui tiny image" src="<?=$value['product_photo'];?>" alt="<?=$value['product_name'];?>"></td>
					<td><?=$value['product_name'];?></td>
					<td><?=$value['product_price'];?></td>
					<td><?=$value['product_qty'];?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
	<div class="ui clearing divider"></div>
</div>