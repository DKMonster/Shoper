<div class="products-spec">
	<div class="ui two column internally celled stackable grid">
		<div class="four wide column">
			<div class="ui vertical menu">
				<?php if($category_link == 'all') { ?>
				<div class="item active">
					全部
					<div class="ui teal left pointing label"><?=$total;?></div>
				</div>
				<?php }else{ ?>
				<a href="products/all" class="item">
					全部
					<div class="ui left pointing label"><?=$total;?></div>
				</a>
				<?php } ?>
			
				<?php foreach ($category as $kCategory => $vCategory) { ?>
					<?php if($category_link == $vCategory['id']) { ?>
					<div class="item active">
						<?=$vCategory['type'];?>
						<div class="ui teal left pointing label"><?=$vCategory['total'];?></div>
					</div>
					<?php }else{ ?>
					<a href="products/<?=$vCategory['id'];?>" class="item">
						<?=$vCategory['type'];?>
						<div class="ui left pointing label"><?=$vCategory['total'];?></div>
					</a>
					<?php } ?>
				<?php } ?>
			</div>
		</div>
		<div class="twelve wide column">
			<div class="ui divided items">
				<?php foreach ($list as $kList => $vList) { ?>
				<div class="item itemProduct">
					<div class="image">
						<img src="<?=$vList['main_photo']?>" alt="<?=$vList['title']?>">
					</div>
					<div class="content">
						<a href="#" class="header"><?=$vList['title']?></a>
						<div class="meta">
							<span class="cinema"><?=$vList['sub_title']?></span>
						</div>
						<div class="extra">
							<div class="column">
								<div class="ui red label">特價 $<?=$vList['cost']?></div>
								<div class="ui blue label"><?=$vList['type']?></div>
							</div>
							<a href="product/<?=$vList['id']?>" class="ui right floated blue button">詳細內容</a>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>