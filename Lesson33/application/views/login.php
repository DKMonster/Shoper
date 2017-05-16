<h1 class="ui center aligned header">
	<div class="content">
		Login
		<p class="sub header">
			歡迎使用Shoper登入網站。
		</p>
	</div>
</h1>
<div class="ui one column stackable grid container">
	<form method="post" class="ui form column">
		<h4 class="ui dividing header">登入資訊</h4>
		<input type="hidden" name="rule" value="login">
		<div class="field">
			<label>信箱</label>
			<input type="text" name="email">
		</div>
		<div class="field">
			<label>密碼</label>
			<input type="password" name="pwd">
		</div>
		<div class="field">
			<button class="ui blue button" type="submit">登入會員</button>
		</div>
	</form>
	<div class="ui clearing divider"></div>
</div>

<script>
	$(document).ready(function() {
		<?php if($sys_code == 200) { ?>
		swal(
		  'Good job!',
		  '<?=$sys_msg;?>',
		  'success'
		).then(function () {
			location.href = 'member';
		});
		<?php } ?>
		<?php if($sys_code == 404 || $sys_code == 500) { ?>
		swal(
		  'oops!',
		  '<?=$sys_msg;?>',
		  'warning'
		);
		<?php } ?>
	});
</script>