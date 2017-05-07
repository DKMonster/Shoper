<div class="sliderSpec">
	<ul class="sliderList">
		<li class="sliderMenuItem <?php if($menu == 'dashboard') { echo 'menuActive'; } ?>">
			<a href="console/index">
				<i class="icon home"></i>
				控制台
			</a>
		</li>
		<li class="sliderMenuItem <?php if($menu == 'manager') { echo 'menuActive'; } ?>">
			<a href="console/manager">
				<i class="icon spy"></i>
				管理員
			</a>
		</li>
		<li class="sliderMenuItem disable">
			<a href="javascript: void(0)">
				<i class="icon user"></i>
				會員管理
			</a>
		</li>
	</ul>
</div>