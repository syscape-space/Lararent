<section id="<?php  echo $id ;?>" class="page-section breadcrumbs
<?php  echo $text_position; ?>
 pb-module-section">

	<div class="container">
		<div class="page-header">
			<h1><?php  echo e($page->title ?? '') ?></h1>
		</div>
		<ul class="breadcrumb">
			<li><a href="<?php  echo url('/'); ?>"><?php  echo __('Home'); ?> </a></li>
			<li class="active"><?php  echo e($page->title ?? '') ?></li>
		</ul>
	</div>
</section>