<link rel="stylesheet" href="assets/dist/ui/trumbowyg.min.css">
<link rel="stylesheet" href="assets/dist/plugins/colors/ui/trumbowyg.colors.min.css">

<div class="contentSpec">
	<div class="ui container containerSpec">
		<div class="ui grid">
			<div class="sixteen wide column">
				<h2 class="ui dividing header">
					<i class="icon shop"></i>
					<div class="content">
						更新商品資訊
						<div class="sub header">此處可以針對商品資訊進行更新。</div>
					</div>
				</h2>
				<?php if(isset($sys_code)) { ?>
				<div class="ui bottom attached warning message">
					<i class="icon warning"></i>
					<?=$sys_msg; ?>
				</div>
				<?php } ?>
				<form class="ui form tableForm" method="post" enctype="multipart/form-data">
					<div class="ui grid">
						<div class="twelve wide column">
							<h4 class="ui dividing header">基本</h4>
							<input type="hidden" name="rule" value="update">
							<input type="hidden" name="id" value="<?=$res['id'];?>">
							<div class="two fields">
								<div class="field required">
									<label>標題</label>
									<input type="text" name="title" value="<?=$res['title'];?>">
								</div>
								<div class="field">
									<label>分類</label>
									<div class="ui fluid search selection dropdown dropdownCategory">
										<input type="hidden" name="category">
										<i class="dropdown icon"></i>
										<div class="default text">未分類</div>
										<div class="menu">
											<?php foreach ($category as $key => $value) { ?>
											<div class="item" data-value="<?=$value['id'];?>"><?=$value['type'];?></div>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
							<div class="field">
								<label>副標題</label>
								<input type="text" name="sub_title" value="<?=$res['sub_title'];?>">
							</div>
							<div class="three fields">
								<div class="field">
									<label>原價</label>
									<input type="text" name="price" value="<?=$res['price'];?>">
								</div>
								<div class="field">
									<label>特價</label>
									<input type="text" name="cost" value="<?=$res['cost'];?>">
								</div>
								<div class="field">
									<label>庫存</label>
									<input type="text" name="reserve" value="<?=$res['reserve'];?>">
								</div>
							</div>
							<h4 class="ui dividing header">商品說明</h4>
							<div class="field">
								<div class="content" id="trumbowyg-content">
									<?php 
										if(isset($res['content'])) {
											echo $res['content'];
										}
									 ?>
								</div>
							</div>
						</div>
						<div class="four wide column">
							<div class="ui padded segment main_photo_spec">
								<h4 class="ui dividing header">Main Photo</h4>
								<div class="field">
									<img src="<?=$res['main_photo'];?>" alt="Main Photo" class="ui tiny image main_photo_img">
								</div>
								<div class="field">
									<input type="file" name="main_photo_file" class="main_photo_file">
									<button class="ui mini fluid inverted violet button main_photo_button" type="button">
										<i class="icon upload"></i>
										更新圖片
									</button>
								</div>
							</div>
							<div class="ui padded segment sub_photo_spec">
								<h4 class="ui dividing header">Sub Photo</h4>
								<div class="field photoImage">
									<?php if(isset($sub_photo)) { ?>
										<?php foreach ($sub_photo as $key => $value) { ?>
										<img src="<?=$value['product_image'];?>" data-id="<?=$value['id'];?>" alt="Sub Photo" class="ui tiny image sub_photo_img">
										<?php } ?>
									<?php } ?>
								</div>
								<div class="field">
									<input type="file" name="main_photo_file" class="sub_photo_file">
									<button class="ui mini fluid inverted violet button sub_photo_button" type="button">
										<i class="icon upload"></i>
										上傳圖片
									</button>
								</div>
							</div>
						</div>
					</div>
					<button class="ui green button btnSubmit" type="button" tabindex="0">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>


<div class="ui basic modal removeModal" id="removeModal">
	<i class="icon close"></i>
	<div class="header">
		注意
	</div>
	<div class="image content">
		<div class="image">
			<i class="icon archive"></i>
		</div>
		<div class="description">
			<p>確認是否真的要刪除？</p>
		</div>
	</div>
	<div class="actions">
		<div class="two fluid ui inverted buttons">
			<div class="ui cancel red basic inverted button">
				<i class="icon remove"></i> 取消
			</div>
			<div class="ui ok green basic inverted button">
				<i class="icon checkmark"></i> 確認
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="assets/dist/trumbowyg.min.js"></script>
<script type="text/javascript" src="assets/dist/plugins/base64/trumbowyg.base64.min.js"></script>
<script type="text/javascript" src="assets/dist/plugins/colors/trumbowyg.colors.min.js"></script>
<script type="text/javascript" src="assets/dist/plugins/noembed/trumbowyg.noembed.min.js"></script>
<script type="text/javascript" src="assets/dist/plugins/pasteimage/trumbowyg.pasteimage.min.js"></script>
<script type="text/javascript" src="assets/dist/plugins/preformatted/trumbowyg.preformatted.min.js"></script>
<script type="text/javascript" src="assets/dist/plugins/upload/trumbowyg.upload.min.js"></script>
<script type="text/javascript" src="assets/dist/langs/zh_tw.min.js"></script>

<script>
	$(document).ready(function() {
		$('.ui.dropdown.dropdownCategory').dropdown('set selected', '<?=$res['category'];?>');

		trumbowygContent();

		mainPhotoButtonEvent();

		subPhotoButtonEvent();

		submitForm();
	});

	function trumbowygContent() {
		$('#trumbowyg-content').trumbowyg({
			btnsDef: {
				align: {
					dropdown: ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
					ico: 'justifyLeft'
				},

				image: {
					dropdown: ['insertImage', 'upload'],
					ico: 'insertImage'
				}
			},

			btns: [
				['viewHTML'],
				['formatting'],
				'btnGrp-design',
				['link'],
				['image'],
				['align'],
				'btnGrp-lists',
				['foreColor', 'backColor'],
				['horizontalRule'],
				['fullscreen']
			],
			plugins: {
				upload: {
					serverPath: 'api_console/upload_trumbowyg_image',
					fileFieldName: 'image',
					data: [],
					urlPropertyName: 'link',
					statusPropertyName: 'success',
					success: function(data) {
						var link = data['link'];
						var that = $('#trumbowyg-content');

						that.append('<img src="'+link+'" />');

						// close modal
						that.trumbowyg('closeModal');
					}
				}
			}
		});
	}

	function mainPhotoButtonEvent() {
		$('.main_photo_button').on('click', function() {
			var that = $(this);
			that.closest('.main_photo_spec').find('.main_photo_file').click();
		});
	}

	function subPhotoButtonEvent() {
		$('.sub_photo_button').on('click', function() {
			var that = $(this);
			that.closest('.sub_photo_spec').find('.sub_photo_file').click();
		});

		$('.sub_photo_file').change(function(e) {
			var that = $(this);
			var formData = new FormData();

			formData.append('id', $('input[name=id]').val());
			formData.append('image', that[0].files[0]);

			var api = 'api_console/upload_sub_photo';
			$.ajax({
				url: api,
				type: 'POST',
				dataType: 'json',
				data: formData,
				cache: false,
				processData: false,
				contentType: false,
				success: function(response) {
					window.alert(response.sys_msg);
					if(response.sys_code == 200) {
						that.closest('.sub_photo_spec').find('.photoImage').append(
							'<img src="'+response.link+'" alt="sub Photo" data-id="'+response.id+'" class="ui tiny image sub_photo_img">'
							);

						subPhotoRemove();
					}
				}
			});
		});
	}

	function subPhotoRemove() {
		$('.sub_photo_img').unbind('click');
		$('.sub_photo_img').on('click', function() {
			var that = $(this);

			var modal = $('#removeModal');
			var id = that.data('id');

			modal.modal({
				closable: false,
				onDeny: function() {
					// 取消
				},
				onApprove: function() {
					var api = 'api_console/delete_sub_photo';
					$.post(api, {'id': id}, function(response) {
						window.alert(response.sys_msg);
						if(response.sys_code == 200) {
							that.unbind('click').remove();
							window.alert(json.sys_msg);
						}
					}, 'json');
				}
			}).modal('show');
		});
	}

	function submitForm() {
		$('.btnSubmit').on('click', function(e) {
			e.preventDefault();

			$('.tableForm').submit();
		});
	}
</script>