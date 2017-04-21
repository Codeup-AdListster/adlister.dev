<!--Page for single advertisement -->
<div class="container">
	<div class="col-xs-6">
		<h1> <?= $ad->title ?></h1>
		<p><img src="<?= $ad->image ?>"></p>
		<p>$ <?= $ad->price ?></p>	
		<p> <?= $ad->description ?></p>
		<?php if(!($ad->user_id === Auth::id())): ?>
			<?php else: ?>
        		<form action="/ads/delete">
        			<input type="hidden" name="id" value="<?=$ad->id?>">
        			<button id="delete">Delete</button>
    			</form>
    		<?php endif; ?>
	</div>
</div>