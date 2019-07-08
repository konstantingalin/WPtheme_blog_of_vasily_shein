<form action="<?php echo home_url('/'); ?>" class="search_mobile" id="searchform">
	<span class="icon_other"></span>
	<span class="icon_search no_active_search"></span>
	<div class="search_mobile_active">
		<span class="icon"></span>
		<input type="search" name="s" id="s" value="<?php echo get_search_query(); ?>" placeholder="Поиск по сайту">
	</div>
</form>
<form action="<?php echo home_url('/'); ?>" class="search" id="searchform">
	<span class="icon"></span>
	<input type="search" name="s" id="s" value="<?php echo get_search_query(); ?>" placeholder="Поиск по сайту">
</form>