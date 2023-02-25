<?php
/** @var $params \app\models\ListMovieModel
 */
?>
<?php
    if ($params != null && $params->movies != null) {
        foreach ($params->movies as $movie) {
            echo "<div class='col-md-3'>";
            echo "<div class='card'>";
            echo "<img src='$movie->image_url' class='card-img-top' alt='...'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>$movie->price</h5>";
            echo "<p class='card-text'>$movie->name</p>";
            echo "</div>";
            echo "<div class='card-footer p-2 d-flex justify-content-end'>";
            echo "<a href='javascript:;' class='btn btn-primary m-0 add-to-cart-helper' data-movie_id='$movie->movie_id' data-route='/api/reservation/add'><i class='fas fa-shopping-cart'></i> +</a>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
    }
?>