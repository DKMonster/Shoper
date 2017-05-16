<h1 class="ui center aligned header">
	<div class="content">
		Register
		<p class="sub header">
			歡迎加入Shoper！
		</p>
	</div>
</h1>
<div class="ui one column stackable grid container">
	<form method="post" class="ui form column">
		<h4 class="ui dividing header">登入資訊</h4>
		<input type="hidden" name="rule" value="register">
		<div class="field">
			<label>信箱</label>
			<input type="text" name="email">
		</div>
		<div class="field">
			<label>密碼</label>
			<input type="password" name="password">
		</div>
		<div class="field">
			<label>重複密碼</label>
			<input type="password" name="confirmPassword">
		</div>
		<h4 class="ui dividing header">會員資訊</h4>
		<div class="two fields">
			<div class="field required">
				<label>暱稱</label>
				<input type="text" name="nickname">
			</div>
			<div class="field">
				<label>手機</label>
				<input type="text" name="phone">
			</div>
		</div>
		<div class="field">
			<label>地址</label>
			<input type="text" name="address">
		</div>
		<div class="field">
			<button class="ui blue button" type="submit">註冊會員</button>
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