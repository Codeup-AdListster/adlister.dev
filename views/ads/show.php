<!--Page for single advertisement -->
<div class="container">
	<div class="col-xs-6">
		<h1> <?= $ad->title ?></h1>
		<p><img src="<?= $ad->image ?>"></p>
		<p>$ <?= $ad->price ?></p>	
		<p> <?= $ad->description ?></p>
	</div>
</div>