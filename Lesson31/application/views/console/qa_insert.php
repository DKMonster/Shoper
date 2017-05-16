<div class="contentSpec">
	<div class="ui container containerSpec">
		<div class="ui grid">
			<div class="sixteen wide column">
				<h2 class="ui dividing header">
					<i class="icon tags"></i>
					<div class="content">
						新增問題
						<div class="sub header">此處可以針對問題進行新增。</div>
					</div>
				</h2>
				<?php if(isset($sys_code)) { ?>
				<div class="ui bottom attached warning message">
					<i class="icon warning"></i>
					<?=$sys_msg; ?>
				</div>
				<?php } ?>
				<form class="ui form tableForm" method="post">
					<h4 class="ui dividing header">基本</h4>
					<input type="hidden" name="rule" value="insert">
					<div class="ui grid">
						<div class="twelve wide column">
							<div class="field required">
								<label>問題</label>
								<textarea name="question"></textarea>
							</div>
							<div class="field">
								<label>解答</label>
								<textarea name="answer"></textarea>
							</div>
						</div>
					</div>
					<button class="ui green button" type="submit" tabindex="0">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>