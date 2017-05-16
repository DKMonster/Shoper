<h1 class="ui center aligned header">
	<div class="content">
		Member
		<p class="sub header">
			歡迎 <?=$this->session->userdata('user_name');?> 登入Shoper購物網站。
		</p>
	</div>
</h1>

<div class="ui one column stackable grid container">
	<form method="post" class="ui form column">
		<h4 class="ui dividing header">登入資訊</h4>
		<input type="hidden" name="rule" value="update">
		<div class="field">
			<label>信箱</label>
			<input type="text" name="email" value="<?=$user['email'];?>">
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
				<input type="text" name="nickname" value="<?=$user['nickname'];?>">
			</div>
			<div class="field">
				<label>手機</label>
				<input type="text" name="phone" value="<?=$user['phone'];?>">
			</div>
		</div>
		<div class="field">
			<label>地址</label>
			<input type="text" name="address" value="<?=$user['address'];?>">
		</div>
		<div class="field">
			<button class="ui green button" type="submit">修改會員</button>
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
		);
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