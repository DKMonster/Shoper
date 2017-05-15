<div class="contentSpec">
	<div class="ui container containerSpec">
		<div class="ui grid">
			<div class="sixteen wide column">
				<h2 class="ui dividing header">
					<i class="icon spy"></i>
					<div class="content">
						商品設置
						<div class="sub header">此處可以針對商品進行新增修改刪除。</div>
					</div>
				</h2>
				<div class="ui form tableForm">
					<a href="console/product/insert" class="ui tiny blue button spBtn btnInsert">
						新增
					</a>
					<div class="field">
						<table class="ui celled padded table">
							<thead>
								<tr class="center aligned">
									<th>編號</th>
									<th>名稱</th>
									<th>價格</th>
									<th>庫存</th>
									<th>操作</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($list as $key => $value) { ?>
								<tr class="middle center aligned">
									<td><?=$value['id'];?></td>
									<td><?=$value['title'];?></td>
									<td><?=$value['cost'];?></td>
									<td><?=$value['reserve'];?></td>
									<td>
										<a href="console/product/update/<?=$value['id'];?>" class="ui tiny green button spBtn">更新</a>
										<a href="javascript: void(0)" class="ui tiny red button spBtn btnDelete" data-id="<?=$value['id'];?>">刪除</a>
										<?php if($value['online'] == 0) { ?>
										<a href="javascript: void(0)" class="ui tiny violet button spBtn btnOnline" data-num="1" data-id="<?=$value['id'];?>">上架</a>
										<?php }else{ ?>
										<a href="javascript: void(0)" class="ui tiny purple button spBtn btnOnline" data-num="0" data-id="<?=$value['id'];?>">下架</a>
										<?php } ?>
										<?php if($value['feature'] == 0) { ?>
										<a href="javascript: void(0)" class="ui tiny orange button spBtn btnFeature" data-num="1" data-id="<?=$value['id'];?>">精選</a>
										<?php }else{ ?>
										<a href="javascript: void(0)" class="ui tiny yellow button spBtn btnFeature" data-num="0" data-id="<?=$value['id'];?>">取消精選</a>
										<?php } ?>
									</td>
								</tr>
								<?php } ?>
							</tbody>
							<tfoot>
								<tr>
									<th colspan="5">
										<?=$pagination;?>
									</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="ui basic modal removeModal" id="removeModal">
	<i class="icon close"></i>
	<div class="header">
		注意
	</div>
	<div class="image content">
		<div class="image">
			<i class="icon archive"></i>
		</div>
		<div class="description">
			<p>確認是否真的要刪除？</p>
		</div>
	</div>
	<div class="actions">
		<div class="two fluid ui inverted buttons">
			<div class="ui cancel red basic inverted button">
				<i class="icon remove"></i> 取消
			</div>
			<div class="ui ok green basic inverted button">
				<i class="icon checkmark"></i> 確認
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		remove();

		online();

		feature();
	});

	function online() {
		$('.btnOnline').on('click', function(e) {
			e.preventDefault();
			var that = $(this);
			var id = that.data('id');
			var num = that.data('num');
			var api = 'api_console/online_product';
			$.post(api, {'id': id, 'num': num}, function(response) {
				window.alert(response.sys_msg);
				if(response.sys_code == 200) {
					location.href = 'console/product';
				}
			}, 'json');
		});
	}

	function feature() {
		$('.btnFeature').on('click', function(e) {
			e.preventDefault();
			var that = $(this);
			var id = that.data('id');
			var num = that.data('num');
			var api = 'api_console/feature_product';
			$.post(api, {'id': id, 'num': num}, function(response) {
				window.alert(response.sys_msg);
				if(response.sys_code == 200) {
					location.href = 'console/product';
				}
			}, 'json');
		});
	}

	function remove() {
		$('.btnDelete').on('click', function(e) {
			e.preventDefault();

			var that = $(this);
			var modal = $('#removeModal');
			var id = that.data('id');

			modal.modal({
				closable: false,
				onDeny: function() {
					// 取消
				},
				onApprove: function() {
					var api = 'api_console/delete_product';
					$.post(api, {'id': id}, function(response) {
						window.alert(response.sys_msg);
						if(response.sys_code == 200) {
							location.href = 'console/product';
						}
					}, 'json');
				}
			}).modal('show');
		});
	}
</script>