<?php
/** @var $params \app\models\CartModel
 */

use app\core\Application;

$params = Application::$app->session->get(Application::$app->session->CART_SESSION);
?>
<div class="row p-3 pt-5">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-md-6"><h6>Cart Items</h6></div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <a href="/cart/check" class="btn btn-sm btn-primary">Check Cart</a>
                        <a href="/cart/delete" class="btn btn-sm btn-primary ">Delete Cart</a>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Product Name</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Price</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Quantity</th>
                        </tr>
                        </thead>
                        <tbody id="table-body">
                        <?php
                        $eachValueButton = 0;
                        $eachMovie_id = "movie_quantity";
                        $valueAndId = $eachMovie_id.$eachValueButton;

                        if ($params != null && $params->cart_items != null) {
                            foreach ($params->cart_items as $cart_item) {
                                $movie_idForId = $cart_item->movie_id;
                                $valueAndId = $eachMovie_id.$movie_idForId;
                                echo "<tr>";
                                echo "<td>";
                                echo "<div class='d-flex px-2 py-1'>";
                                echo "<div>";
                                echo "<img src='$cart_item->image_url' class='avatar avatar-sm me-3' alt='user1'>";
                                echo "</div>";
                                echo "<div class='d-flex flex-column justify-content-center'>";
                                echo "<h6 class='mb-0 text-sm'>$cart_item->name</h6>";
                                echo "</div>";
                                echo "</div>";
                                echo "</td>";
                                echo "<td>";
                                echo "<p class='mb-0 text-sm'>$cart_item->price</p>";
                                echo "</td>";
                                echo "<td>";
                                echo "<button class='remove-quantity-from-cart btn btn-sm btn-outline-secondary' data-movie_id='$cart_item->movie_id' data-route='/api/cart/quantity/remove'>-</button>";
                                echo "<button class='btn btn-sm btn-link' id='$valueAndId'>$cart_item->quantity</button>";
                                echo "<button class='add-quantity-from-cart btn btn-sm btn-outline-secondary' data-movie_id='$cart_item->movie_id' data-route='/api/cart/quantity/add'>+</button>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('click', '.remove-quantity-from-cart', function() {
        var movie_id = $(this).data("movie_id");
        var route = $(this).data("route");
        var data = {"movie_id": movie_id};

        $.getJSON(route, data, function(result) {

            let movie_quantity = "movie_quantity";
            let id = movie_quantity + movie_id;

            //$(id).text(result);

            document.getElementById(id).innerText = result;
        });
    });

    $(document).on('click', '.add-quantity-from-cart', function() {
        var movie_id = $(this).data("movie_id");
        var route = $(this).data("route");
        var data = {"movie_id": movie_id};
        $.getJSON(route, data, function(result) {

            let movie_quantity = "movie_quantity";
            let id = movie_quantity + movie_id;

            //$("#id").text(result);

            document.getElementById(id).innerText = result;
        });
    });
</script>