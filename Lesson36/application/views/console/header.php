<div class="headerSpec">
	<div class="headerLogo">
		<a href="console/index" class="itemLogo">Shoper</a>
	</div>
	<div class="headerMenu">
		<div class="headerRightMenu">
			<div class="ui dropdown itemDropdownPerson">
				<i class="icon user"></i>
				<?=$this->session->userdata('manager_name'); ?>
				<div class="menu">
					<a href="console/logout" class="item">管理員登出</a>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('.itemDropdownPerson').dropdown();
	});
</script>
