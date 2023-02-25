<?php
require_once __DIR__ . "/../vendor/autoload.php";

use app\controllers\AdministrationController;
use app\controllers\AuthController;
use app\controllers\HomeController;
use app\controllers\MovieController;
use app\controllers\CartController;
use app\controllers\ProfileController;
use app\core\Application;

$app = new Application();

$app->router->get("/", [HomeController::class, "index"]);
$app->router->get("/home", [HomeController::class, "index"]);
$app->router->get("/login", [AuthController::class, "login"]);
$app->router->get("/logout", [AuthController::class, "logout"]);
$app->router->get("/registration", [AuthController::class, "registration"]);
$app->router->get("/users", [AdministrationController::class, "users"]);
$app->router->get("/adminDirections", [AdministrationController::class, "adminDirections"]);
$app->router->get("/api/administration/users", [AdministrationController::class, "getAllUsers"]);
$app->router->get("/createMovie", [AdministrationController::class, "createMovie"]);
$app->router->get("/admin", [AdministrationController::class, "adminPage"]);
$app->router->get("/api/orders", [AdministrationController::class, "orders"]);
$app->router->get("/api/orders/top10", [AdministrationController::class, "ordersTop10"]);
$app->router->get("/api/orders/movieTopQuantity", [AdministrationController::class, "movieTopQuantity"]);
$app->router->get("/moviesAdmin", [AdministrationController::class, "moviesAdmin"]);
$app->router->get("/api/moviesAdmin/rows/json", [AdministrationController::class, "getMovieRowsAdmin"]);
$app->router->get("/movie/delete", [AdministrationController::class, "deleteMovie"]);
$app->router->get("/movie/update", [AdministrationController::class, "updateMovie"]);
$app->router->get("/movies", [MovieController::class, "movies"]);
$app->router->get("/movie/details", [MovieController::class, "movieDetails"]);
$app->router->get("/api/movies/rows/json", [MovieController::class, "getMovieRows"]);
$app->router->get("/api/product/rows/html", [MovieController::class, "getMovieRowsHome"]);
$app->router->get("/cart", [CartController::class, "viewCart"]);
$app->router->get("/api/cart/quantity/remove", [CartController::class, "removeMovieQuantity"]);
$app->router->get("/api/cart/quantity/add", [CartController::class, "addMovieQuantity"]);
$app->router->get("/cart/check", [CartController::class, "checkCart"]);
$app->router->get("/cart/delete", [CartController::class, "deleteCart"]);
$app->router->get("/userProfile", [ProfileController::class, "userProfile"]);
$app->router->post("/createMovieProcess", [AdministrationController::class, "createMovieProcess"]);
$app->router->post("/editMovieProcess", [AdministrationController::class, "editMovieProcess"]);
$app->router->post("/api/reservation/add", [CartController::class, "addMovieToReservation"]);
$app->router->post("/loginProcess", [AuthController::class, "loginProcess"]);
$app->router->post("/registrationProcess", [AuthController::class, "registrationProcess"]);

$app->run();
