<h1 class="ui center aligned header">
	<div class="content">
		Forget
		<p class="sub header">
			忘記密碼了嗎？讓我們來確認一下帳號的主人是誰？
		</p>
	</div>
</h1>

<?php if($this->session->flashdata('newpwd')) { ?>
<div class="ui one column stackable grid container">
	<form method="post" class="ui form column">
		<h4 class="ui dividing header">設定新密碼</h4>
		<input type="hidden" name="rule" value="new">
		<input type="hidden" name="id" value="<?=$this->session->flashdata('newpwd');?>">
		<div class="field required">
			<label>新密碼</label>
			<input type="password" name="password">
		</div>
		<div class="field required">
			<label>重複輸入密碼</label>
			<input type="password" name="confirmPassword">
		</div>
		<div class="field">
			<button class="ui blue button" type="submit">確認重設</button>
		</div>
	</form>
	<div class="ui clearing divider"></div>
</div>
<?php }else{ ?>
<div class="ui one column stackable grid container">
	<form method="post" class="ui form column">
		<h4 class="ui dividing header">登入資訊</h4>
		<input type="hidden" name="rule" value="forget">
		<div class="field required">
			<label>信箱</label>
			<input type="text" name="email">
		</div>
		<div class="field required">
			<label>手機</label>
			<input type="text" name="phone">
		</div>
		<div class="field">
			<button class="ui blue button" type="submit">確認查詢</button>
		</div>
	</form>
	<div class="ui clearing divider"></div>
</div>
<?php } ?>

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