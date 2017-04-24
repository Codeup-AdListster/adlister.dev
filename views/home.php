
<div class="container">

    <section id="welcome">

        <div class="row">

            <div class="col-xs-12">

                <h1 class="text-center">Welcome To localHookUps!</h1>

            </div>

        </div>

    </section>

    <section id="features">

        <div class="container-fluid">

            <h3 class="featured">Featured Items</h3>
            
            <!-- Placeholder for featured items.-->
            <div class="row">
                <?php foreach($ads as $ad) : ?>                
                <div class=" wrapped col-xs-6 col-sm-4">
                    
                    <div>
                        <p><a href="/ads/show?id=<?=$ad->id?>"><img class = "home_img" src="<?= $ad->image ?>"></a></p>
                        <p><a href="/ads/show?id=<?=$ad->id?>"><?= $ad->title?></a></p>
                    </div>

                </div>
        <?php endforeach; ?>
                
            </div>
    </section>

</div>
<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous">
  </script>
<script>
$(function(){
    var test = localStorage.input === 'true'? true: false;
    $('input').prop('checked', test || false);
});

$('input').on('change', function() {
    var ad_id = $(this).val();
    var request = $.ajax({
        url: '/account/addtofavorites',
        data: {
            ad_id: ad_id
        }
    });

    request.done(function(){
        console.log ('saved');
    });

    request.error(function(error){
        console.log (error);
    });

});
</script>
