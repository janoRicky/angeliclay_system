<div id="navbar" class="col-12 p-1 position-fixed text-left navbar text-light font-weight-bold">
	<div class="col-12">
		<button id="sidebar_toggle" class="bg-transparent border-0 text-light mr-2" style="font-size: 1.2rem; padding: 0 0.2rem; cursor: pointer;">
			<i class="fa fa-navicon" aria-hidden="true"></i>
		</button>
		<?php foreach ($nav as $key => $val): ?>
			<?php if ($key > 0): ?>
				<span> / </span>
			<?php endif; ?>
			<a href="<?=$val['link']?>"><?=$val['text']?></a>
		<?php endforeach; ?>
	</div>
</div>