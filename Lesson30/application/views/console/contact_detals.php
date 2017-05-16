<div class="contentSpec">
	<div class="ui container containerSpec">
		<div class="ui grid">
			<div class="sixteen wide column">
				<h2 class="ui dividing header">
					<i class="icon call"></i>
					<div class="content">
						詳細聯絡
						<div class="sub header">此處可以針對聯絡進行查看。</div>
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
					<div class="three fields">
						<div class="field">
							<label>姓名</label>
							<input type="text" disabled name="name" value="<?=$res['name'];?>">
						</div>
						<div class="field">
							<label>手機</label>
							<input type="text" disabled name="phone" value="<?=$res['phone'];?>">
						</div>
						<div class="field">
							<label>信箱</label>
							<input type="text" disabled name="email" value="<?=$res['email'];?>">
						</div>
					</div>
					<div class="field">
						<label>訊息</label>
						<textarea disabled><?=$res['message'];?></textarea>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
	});
</script>