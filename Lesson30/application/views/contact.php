<h1 class="ui center aligned header">
	<div class="content">
		聯絡我們
		<p class="sub header">
			可以透過以下表單與我們聯絡，稍後我們將利用Email進行回覆。
		</p>
	</div>
</h1>
<div class="ui one column stackable grid container">
	<div class="column">
		<form method="post" class="ui form">
			<h4 class="ui dividing header">個人資訊</h4>
			<input type="hidden" name="rule" value="send">
			<div class="three fields">
				<div class="field">
					<label>姓名</label>
					<input type="text" name="name">
				</div>
				<div class="field">
					<label>電話</label>
					<input type="text" name="phone">
				</div>
				<div class="field">
					<label>信箱</label>
					<input type="text" name="email">
				</div>
			</div>
			<div class="field">
				<label>訊息</label>
				<textarea name="message"></textarea>
			</div>
			<div class="field">
				<button class="ui blue button" type="submit">送出</button>
			</div>
		</form>
	</div>
	<div class="ui clearing divider"></div>
</div>

<script>
	$(document).ready(function() {
		<?php if($sys_code == 200) { ?>
		swal(
		  'Good job!',
		  '<?=$sys_msg;?>',
		  'success'
		);
		<?php } ?>
		<?php if($sys_code == 404) { ?>
		swal(
		  'oops!',
		  '<?=$sys_msg;?>',
		  'warning'
		);
		<?php } ?>
	});
</script>