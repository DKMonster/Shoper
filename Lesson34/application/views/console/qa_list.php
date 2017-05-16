<div class="contentSpec">
	<div class="ui container containerSpec">
		<div class="ui grid">
			<div class="sixteen wide column">
				<h2 class="ui dividing header">
					<i class="icon tags"></i>
					<div class="content">
						問題設置
						<div class="sub header">此處可以針對問題進行新增修改刪除。</div>
					</div>
				</h2>
				<div class="ui form tableForm">
					<a href="console/qa/insert" class="ui tiny blue button spBtn btnInsert">
						新增
					</a>
					<div class="field">
						<table class="ui celled padded table">
							<thead>
								<tr class="center aligned">
									<th>編號</th>
									<th>標題</th>
									<th>操作</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($list as $key => $value) { ?>
								<tr class="middle center aligned">
									<td><?=$value['id'];?></td>
									<td><?=$value['question'];?></td>
									<td>
										<a href="console/qa/update/<?=$value['id'];?>" class="ui tiny green button spBtn">更新</a>
										<a href="javascript: void(0)" class="ui tiny red button spBtn btnDelete" data-id="<?=$value['id'];?>">刪除</a>										
									</td>
								</tr>
								<?php } ?>
							</tbody>
							<tfoot>
								<tr>
									<th colspan="3">
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
	});

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
					var api = 'api_console/delete_qa';
					$.post(api, {'id': id}, function(response) {
						window.alert(response.sys_msg);
						if(response.sys_code == 200) {
							location.href = 'console/qa';
						}
					}, 'json');
				}
			}).modal('show');
		});
	}
</script>