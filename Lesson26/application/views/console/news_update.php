<div class="contentSpec">
	<div class="ui container containerSpec">
		<div class="ui grid">
			<div class="sixteen wide column">
				<h2 class="ui dividing header">
					<i class="icon tags"></i>
					<div class="content">
						更新消息
						<div class="sub header">此處可以針對消息進行修改。</div>
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
								<label>標題</label>
								<input type="text" name="title" value="<?=$res['title'];?>">
							</div>
							<div class="field">
								<label>敘述</label>
								<textarea name="description"><?=$res['description'];?></textarea>
							</div>
							<div class="two fields">
								<div class="field">
									<label>發布日期</label>
									<input type="text" name="release_date" value="<?=$res['release_date'];?>">
								</div>
								<div class="field">
									<label>發布時間</label>
									<input type="text" name="release_time" value="<?=$res['release_time'];?>">
								</div>
							</div>
						</div>
						<div class="four wide column">
							<div class="field">
								<div class="ui padded segment main_photo_spec">
									<h4 class="ui dividing header">圖片</h4>
									<div class="field">
										<img src="<?=$res['image'];?>" alt="Main Photo" class="ui tiny image main_photo_img">
									</div>
									<div class="field">
										<input type="file" name="image" class="main_photo_file">
										<button class="ui mini fluid inverted violet button main_photo_button" type="button">
											<i class="icon upload"></i>
											更新圖片
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<button class="ui green button" type="submit" tabindex="0">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		imageButtonEvent();
	});

	function imageButtonEvent() {
		$('.main_photo_button').on('click', function() {
			var that = $(this);
			that.closest('.main_photo_spec').find('.main_photo_file').click();
		});
	}
</script>