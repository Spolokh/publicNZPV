
<div class="my-3 p-3 bg-body rounded shadow-sm">
	
	<h2 class="mb-4 text-center"><?=$query->name ?></h2>
    <p class="text-center">
		<img width="500" src="/img/<?=($query->avatar ? $query->username. '.' .$query->avatar : 'default.png') ?>" alt=""/>
	</p>
</div>

