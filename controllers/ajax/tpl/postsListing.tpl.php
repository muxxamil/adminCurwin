<?php

	include_once('../../../config/defaults.php');
	include_once('../../../config/api_caller.php');
	include_once('../../Posts.cls.php');

	$post_list 	= Posts::get_posts();
	
	foreach ($post_list['body']->rows as $key => $value) {
		$postTags = array_map(function($element) {
		        return (!empty($element->Tag) && !empty($element->Tag->title)) ? $element->Tag->title : null ;
		    },
		    $value->TagsBlogPostsMappings
		);

		$image = !empty($value->Attachments) ? current($value->Attachments)->path : 'elements-1.png';
		$image = $IMAGE_PREFIX . $image;

		// $postTags = implode(', ', $postTags);
?>
		<div id="blog_post_no_<?php echo $value->id; ?>" class="isotope-item <?php echo (!empty($postTags)) ? implode(' ', $postTags) : '' ; ?> col-sm-6 col-md-4 col-lg-4">
			<div class="thumbnail">
				<div class="thumb-preview">
					<a class="thumb-image" href="<?php echo $image; ?>">
						<img src="<?php echo $image; ?>" class="img-fluid" alt="Project">
					</a>
					<div class="mg-thumb-options">
						<div class="mg-zoom"><i class="fas fa-search"></i></div>
						<div class="mg-toolbar">
							<div class="mg-option checkbox-custom checkbox-inline">
								<input type="checkbox" id="file_<?php echo $value->id; ?>" value="<?php echo $value->id; ?>">
								<label for="file_<?php echo $value->id; ?>">SELECT</label>
							</div>
							<div class="mg-group float-right">
								<a class="modal-sizes" href="#deletePostModal" onclick="deletePostButtonClick(<?php echo $value->id; ?>)">DELETE</a>
							</div>
						</div>
					</div>
				</div>
				<h5 class="mg-title font-weight-semibold"><?php echo substr($value->title, 0, 10); ?><small><?php echo substr($value->title, 10, 20); ?>...</small></h5>
				<div class="mg-description">
					<small class="float-left text-muted"><?php echo (!empty($postTags)) ? implode(', ', $postTags) : '-' ; ?></small>
					<small class="float-right text-muted"><?php echo date_format(date_create($value->createdAt), 'd/M/Y'); ?></small>
				</div>
			</div>
		</div>
<?php
	}
?>

<script type="text/javascript">
	$('.thumb-preview > a[href]').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		mainClass: 'mfp-img-mobile',
		image: {
			verticalFit: true
		}
	});
	$('.modal-sizes').magnificPopup({
		type: 'inline',
		preloader: false,
		modal: true
	});
</script>
