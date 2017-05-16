<div class="news-spec">
	<h2 class="ui header">
		<i class="newspaper icon"></i>
		<div class="content">
			News
			<div class="sub header">最新消息</div>
		</div>
	</h2>
	<div class="ui divided items">
		<?php foreach ($news as $key => $value) { ?>
		<div class="item">
			<div class="image">
				<img src="<?=$value['image'];?>">
			</div>
			<div class="content">
				<a class="header"><?=$value['title'];?></a>
				<div class="meta">
					<span class="cinema">發布日期: <?=$value['release_date'].' '.$value['release_time'];?></span>
				</div>
				<div class="description">
					<p><?=$value['description'];?></p>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
</div>
	