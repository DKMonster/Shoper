<div class="contentSpec">
	<div class="ui container containerSpec">
		<div class="ui grid">
			<div class="sixteen wide column">
				<h2 class="ui dividing header">
					<i class="icon spy"></i>
					<div class="content">
						更新管理員
						<div class="sub header">此處可以針對管理員進行更新。</div>
					</div>
				</h2>
				<?php if(isset($sys_code)) { ?>
				<div class="ui bottom attached warning message">
					<i class="icon warning"></i>
					<?=$sys_msg; ?>
				</div>
				<?php } ?>
				<form class="ui form tableForm" method="post">
					<h4 class="ui dividing header">Login Part</h4>
					<input type="hidden" name="rule" value="update">
					<input type="hidden" name="id" value="<?=$res['id'];?>">
					<div class="field required">
						<label>Email</label>
						<input type="text" name="email" value="<?=$res['email'];?>">
					</div>
					<div class="field">
						<label>Password</label>
						<input type="password" name="password">
					</div>
					<div class="field">
						<label>Re-Password</label>
						<input type="password" name="confirmPassword">
					</div>
					<h4 class="ui dividing header">Manager Information</h4>
					<div class="two fields">
						<div class="field required">
							<label>Nicknmae</label>
							<input type="text" name="nickname" value="<?=$res['nickname'];?>">
						</div>
						<div class="field">
							<label>Phone</label>
							<input type="text" name="phone" value="<?=$res['phone'];?>">
						</div>
					</div>
					<button class="ui green button" type="submit" tabindex="0">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>