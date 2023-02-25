<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\DbConnection;
use app\models\CartItemModel;
use app\models\CartModel;
use app\models\MovieModel;
use app\models\ReservationItemModel;
use app\models\ReservationModel;
use app\models\ResponseMessageModel;
use app\models\UserModel;

class CartController extends Controller
{
    public function addMovieToReservation() {
        $responseMessageModel = new ResponseMessageModel();
        $cartModel = Application::$app->session->get(Application::$app->session->CART_SESSION);

        $movieModel = new MovieModel();
        $movieModel->mapData($this->router->request->all());
        $movieModel->mapData($movieModel->one("movie_id = $movieModel->movie_id"));

        if ($movieModel->movie_id === null) {
            $responseMessageModel->success = false;
            $responseMessageModel->message = "Ovaj film ne postoji!";

            echo json_encode($responseMessageModel);
            exit;
        }

        if ($cartModel === false) {
            $cartModel = new CartModel();
        }

        $alreadyExists = false;

        if ($cartModel != null && ($cartModel->cart_items != null || $cartModel->cart_items = [])) {
            foreach ($cartModel->cart_items as $cart_item) {
                if ($cart_item->movie_id === $movieModel->movie_id) {
                    $alreadyExists = true;
                    $cart_item->quantity += 1;
                }
            }
        }

        if (!$alreadyExists) {
            $cartItemModel = new CartItemModel();
            $cartItemModel->movie_id = $movieModel->movie_id;
            $cartItemModel->name = $movieModel->name;
            $cartItemModel->price = $movieModel->price;
            $cartItemModel->image_url = $movieModel->image_url;
            $cartItemModel->quantity = 1;
            $cartModel->cart_items[] = $cartItemModel;
        }

        $sum = 0;

        if ($cartModel != null && $cartModel->cart_items != null) {
            foreach ($cartModel->cart_items as $cart_item) {
                $sum += ($cart_item->price * $cart_item->quantity ?? 1);
            }
        }

        $cartModel->total_price = $sum;

        Application::$app->session->set(Application::$app->session->CART_SESSION, $cartModel);

        $responseMessageModel->success = true;
        $responseMessageModel->message = "Proizvod uspesno dodat!";

        echo json_encode($responseMessageModel);
        exit;
    }

    public function viewCart() {
        $cartModel = Application::$app->session->get(Application::$app->session->CART_SESSION);
        if ($cartModel === false) {
            Application::$app->session->setFlash(Application::$app->session->FLASH_MESSAGE_ERROR, "Cart je prazan!");
            return $this->view("home", "empty", null);
        }

        return $this->view("cart", "empty", null);
    }

    public function getCart() {
        return Application::$app->session->get(Application::$app->session->CART_SESSION);
    }

    public function deleteCart() {
        Application::$app->session->remove(Application::$app->session->CART_SESSION);
        header("location:" . "/home");
    }

    public function addMovieQuantity() {
        $movie_id = $this->router->request->one("movie_id");

        $cartModel = $this->getCart();

        foreach ($cartModel->cart_items as $cart_item) {
            if ($movie_id === $cart_item->movie_id) {
                $cart_item->quantity += 1;
                $cartModel->total_price = $cart_item->price * $cart_item->quantity ?? 1;
                echo json_encode($cart_item->quantity);
            }
        }
        exit;
    }

    public function removeMovieQuantity() {
        $movie_id = $this->router->request->one("movie_id");

        $cartModel = $this->getCart();

        foreach ($cartModel->cart_items as $cart_item) {
            if ($movie_id === $cart_item->movie_id) {
                $cart_item->quantity -= 1;

                if ($cart_item->quantity < 1) {
                    $cart_item->quantity = 1;
                }

                $cartModel->total_price = $cart_item->price * $cart_item->quantity ?? 1;
                echo json_encode($cart_item->quantity);
            }
        }
        exit;
    }

    public function checkCart() {
        $loggedIn = Application::$app->session->get(Application::$app->session->USER_SESSION);

        if ($loggedIn === false) {
            Application::$app->session->setFlash(Application::$app->session->FLASH_MESSAGE_ERROR, "Morate da se ulogujete!");
            header("location:" . "/login");
            return;
        }

        $cartModel = $this->getCart();

        $reservationModel = new ReservationModel();
        $reservationModel->mapData($cartModel);
        $reservationModel->data_created = date('Y-m-d');

        $userModel = new UserModel();
        $userModel->mapData($this->oneCont("email = '$loggedIn'"));

        $reservationModel->user_id = $userModel->user_id;

        $reservationModel->create();

        $reservationModel->mapData($reservationModel->lastCreated());

        foreach ($cartModel->cart_items as $cart_item) {
            $reservationItemModel = new ReservationItemModel();
            $reservationItemModel->mapData($cart_item);
            $reservationItemModel->reservation_id = $reservationModel->reservation_id;

            $reservationItemModel->create();
        }

        Application::$app->session->setFlash(Application::$app->session->FLASH_MESSAGE_SUCCESS, "Uspesno naruceno!");
        $this->deleteCart();
    }

    public function oneCont($where) {
        $db = new DbConnection();
        $table = "user";
        $sqlString = "SELECT * FROM $table WHERE $where limit 1;";

        $dbResult = $db->conn()->query($sqlString);

        return $dbResult->fetch_assoc();
    }

    public function authorize(): array
    {
        return [];
    }
}