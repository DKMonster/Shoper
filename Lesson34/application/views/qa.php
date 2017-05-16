<h1 class="ui center aligned header">
	<div class="content">
		Q&A
		<p class="sub header">
			可以透過下方Q&A內容尋找答案，假設無法解決您的要求可以透過聯絡我們來詢問。
		</p>
	</div>
</h1>

<div class="ui one column stackable grid container">
	<div class="ui form column">
		<div class="ui comments">
			<h3 class="ui dividing header">Q&A</h3>
			<?php foreach ($qa as $key => $value) { ?>
			<div class="comment">
				<div class="content">
					<a class="author">問題</a>
					<div class="metadata">
						<span class="date"><?=$value['create_date']. ' ' . $value['create_time'];?></span>
					</div>
					<div class="text">
						<?=$value['question'];?>
					</div>
				</div>
				<div class="comments">
					<div class="comment">
						<div class="content">
							<a class="author">解答</a>
							<div class="metadata">
								<span class="date"><?=$value['create_date']. ' ' . $value['create_time'];?></span>
							</div>
							<div class="text">
								<?=$value['answer'];?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
	<div class="ui clearing divider"></div>
</div>