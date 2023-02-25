<?php
  /** @var $params \app\models\MovieModel
 */
/*
echo "<pre>";
var_dump($params);
echo "</pre>";
exit;
*/
?>
<div class="container">
    <div class="row">
        <div class="col-6 d-flex">
            <div class="movie-image-side ">
                <img class="card-img-top" src="<?php echo $params->image_url ?>">
            </div>
        </div>
        <div class="col-6 d-flex">
            <div class="movie-inf-side text-dark">
                <p class="fs-3 mb-0">Title: <?php echo $params->name ?></p>
                <p class="fs-3 mb-0">In cinema: <?php echo $params->pocetak_prikazivanja ?></p>
                <p class="fs-3 mb-0">Movie length: <?php echo $params->movie_length ?></p>
                <p class="fs-3 mb-0">Genre: <?php echo $params->category ?></p>
                <p class="fs-4 mb-0">Director: <?php echo $params->director_name ?></p>
                <p class="fs-5 mb-0">Actors: <?php echo $params->actor_name_role ?></p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h3 class="text-center pt-6">Summary</h3>
            <p class="fs-3 fst-italic text-dark"><?php echo $params->description ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col text-center">
            <p class="fs-2 text-primary">Add to cart</p>
            <a href="javascript:;" class="btn btn-primary py-4 px-8 add-to-cart-helper" data-movie_id="<?php echo $params->movie_id ?>" data-route="/api/reservation/add"><i class="fas fa-shopping-cart"></i> +</a>
        </div>
    </div>

</div>

<script>
    $(document).on('click', '.add-to-cart-helper', function() {
        var url = $(this).data("route");
        var movie_id = $(this).data("movie_id");
        var data = {"movie_id": movie_id};
        $.post(url, data, function(result) {
            var jsonResult = JSON.parse(result);

            console.log(jsonResult);
            if (jsonResult.success === true) {
                toastr.success(jsonResult.message);
            }

            if (jsonResult.success === false) {
                toastr.error(jsonResult.message);
            }
        });
    });
</script>
