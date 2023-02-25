<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\DbConnection;
use app\models\ActorModel;
use app\models\CategoryModel;
use app\models\DirectorModel;
use app\models\ListMovieModel;
use app\models\MovieCategoryModel;
use app\models\MovieModel;
use app\models\ReservationModel;

class AdministrationController extends Controller
{
    public function users() {
        $this->view("users", "dashboard", null);
    }

    public function adminPage() {
        $this->view("admin", "dashboard", null);
    }

    public function moviesAdmin() {
        $this->view("moviesAdmin", "dashboard", null);
    }

    public function adminDirections() {
        $this->view("adminDirections", "empty", null);
    }

    public function getMovieRowsAdmin() {
        $listMovieModel = new ListMovieModel();
        $listMovieModel->mapData($this->router->request->all());

        echo $listMovieModel->search();
    }

    public function createMovie() {
        $movieModel = new MovieModel();
        $categoryModel = new CategoryModel();

        $categories = $categoryModel->all();
        $movieModel->categories = $categories;

        $this->view("createMovie", "dashboard", $movieModel);
    }

    public function createMovieProcess() {
        $movieModel = new MovieModel();
        $categoryModel = new CategoryModel();
        $directorModel = new DirectorModel();

        $categories = $categoryModel->all();
        $movieModel->categories = $categories;

        $movieModel->mapData($this->router->request->all());
        $directorModel->mapData($this->router->request->all());

        $movieModel->validate();

        if ($movieModel->errors) {
            return $this->view("createMovie", "dashboard", $movieModel);
        }

        $movieModel->create();

        // INSERTING DIRECTORS
        $directorModel->insertDirectors($directorModel);

        // INSERTING ACTORS
        $actorModel = new ActorModel();
        $actorModel->mapData($this->router->request->all());
        $actorModel->insertActors($actorModel);

        //FOR CATEGORY
        $dbData = $movieModel->one("name = '$movieModel->name'");

        foreach ($movieModel->selected_category_ids as $singleMovieCategory) {
            $movieCategoryModel = new MovieCategoryModel();
            $movieCategoryModel->movie_id = $dbData["movie_id"];
            $movieCategoryModel->category_id = $singleMovieCategory;
            $movieCategoryModel->create();
        }

        return $this->view("createMovie", "dashboard", $movieModel);
    }

    public function deleteMovie() {
        $movieModel = new MovieModel();
        $movieModel->mapData($this->router->request->all());

        $movieModel->delete("movie_id = '$movieModel->movie_id'");
    }

    public function updateMovie() {
        $movieModel = new MovieModel();
        $movieModel->mapData($this->router->request->all());

        $movieModel->mapData($movieModel->one("movie_id = '$movieModel->movie_id'"));

        $db = new DbConnection();

        $sqlString = "
            SELECT 
	            c.category_id
            FROM category c
            INNER JOIN movie_category mc ON c.category_id = mc.category_id
            INNER JOIN movie m ON mc.movie_id = m.movie_id
            WHERE
	            m.movie_id = '$movieModel->movie_id'
        ";

        $dbData = $db->conn()->query($sqlString);

        while($result = $dbData->fetch_assoc()) {
            $movieModel->selected_category_ids[] = $result["category_id"];
        }

        $categoryModel = new CategoryModel();

        $categories = $categoryModel->allCategoryModel();
        $movieModel->categories = $categories;

        $this->view("aboutSingleMovieAdmin", "dashboard", $movieModel);
    }

    public function editMovieProcess() {
        $movieModel = new MovieModel();
        $movieModel->mapData($this->router->request->all());

        /*
        echo "<pre>";
        var_dump($movieModel);
        echo "</pre>";
        exit;*/

        $sqlMovieUpdate = "UPDATE movie
                      SET
                        name = '$movieModel->name',
                        image_url = '$movieModel->image_url',
                        price = '$movieModel->price',
                        most_popular = '$movieModel->most_popular',
                        description = '$movieModel->description'
                      WHERE movie_id = $movieModel->movie_id;";

        $db = new DbConnection();

        $dbQueryMovie = $db->conn()->query($sqlMovieUpdate);

        if (!$dbQueryMovie) {
            Application::$app->session->setFlash(Application::$app->session->FLASH_MESSAGE_ERROR, "Podaci nisu promenjeni!");
            return $this->view("moviesAdmin", "dashboard", null);
        }


        $sqlMovieCategories = "SELECT category_id
                                FROM movie_category
                                WHERE movie_id = '$movieModel->movie_id'";

        $dbMovieCategories = $db->conn()->query($sqlMovieCategories);

        $resultArray = [];

        while ($result = $dbMovieCategories->fetch_assoc()) {
            $resultArray[] = $result;
        }

        $movieCategoryModelCreated = false;

        foreach ($resultArray as $item) {
            if ($movieCategoryModelCreated === true) {
                break;
            }

            foreach ($movieModel->selected_category_ids as $selected_category_id) {
                if ($movieCategoryModelCreated === true) {
                    break;
                }

                if ($item != $selected_category_id) {
                    $sqlString = "DELETE FROM movie_category 
                                  WHERE movie_id = '$movieModel->movie_id'";

                    $db->conn()->query($sqlString);

                    $movieCategoryModel = new MovieCategoryModel();

                    foreach ($movieModel->selected_category_ids as $selected_id) {
                        $movieCategoryModel->movie_id = $movieModel->movie_id;
                        $movieCategoryModel->category_id = $selected_id;
                        $movieCategoryModel->create();
                    }
                    $movieCategoryModelCreated = true;
                }
            }
        }

        Application::$app->session->setFlash(Application::$app->session->FLASH_MESSAGE_SUCCESS, "Podaci uspesno promenjeni!");
        return $this->view("moviesAdmin", "dashboard", null);
    }

    public function getAllUsers() {
        $connection = new DbConnection();
        $sqlString = "SELECT * FROM user";

        $resultFromDb = $connection->conn()->query($sqlString) or die();

        $resultArray = [];

        while ($result = $resultFromDb->fetch_assoc()) {
            $resultArray[] = $result;
        }

        echo json_encode($resultArray);
    }

    // STATISTICS
    public function orders() {
        $priceFrom = $this->router->request->one("priceFrom");
        $priceTo = $this->router->request->one("priceTo");
        $dateFrom = $this->router->request->one("dateFrom");
        $dateTo = $this->router->request->one("dateTo");

        $reservationModel = new ReservationModel();
        $dbData = $reservationModel->orders($priceFrom, $priceTo, $dateFrom, $dateTo);


        echo json_encode($dbData);
    }

    public function ordersTop10() {
        $db = new DbConnection();
        $top10From = $this->router->request->one("top10From");
        $top10To = $this->router->request->one("top10To");

        $top10From = $top10From == "" ? 1 : $top10From;
        $top10To = $top10To == "" ? 100000 : $top10To;


//        $sqlString = "SELECT sum(total_price) as `total_price`, u.email FROM reservation r
//                      inner join user u on r.user_id = u.user_id
//                      WHERE total_price > $top10From AND total_price < $top10To
//                      GROUP BY r.user_id;";

        $sqlString = "WITH cte1 AS (SELECT sum(total_price) as total_price, u.email, r.data_created FROM reservation r inner join user u on r.user_id = u.user_id GROUP BY r.user_id) 
        SELECT total_price, email, data_created FROM cte1 WHERE total_price > $top10From AND total_price < $top10To AND data_created between (NOW() - INTERVAL 3 MONTH) AND NOW() ORDER BY total_price DESC LIMIT 10;";

        $dbResult = $db->conn()->query($sqlString);

        $resultArray = [];

        while($result = $dbResult->fetch_assoc()) {
            $resultArray[] = $result;
        }

        //var_dump($resultArray);
        echo json_encode($resultArray);
    }

    public function movieTopQuantity() {
        $db = new DbConnection();
        $movieTopQuantityFrom = $this->router->request->one("movieTopQuantityFrom");
        $movieTopQuantityTo = $this->router->request->one("movieTopQuantityTo");

        $movieTopQuantityFrom = $movieTopQuantityFrom == "" ? 0 : $movieTopQuantityFrom;
        $movieTopQuantityTo = $movieTopQuantityTo == "" ? 100000 : $movieTopQuantityTo;

        /*$sqlString = "SELECT sum(ri.quantity) as `quantity`, m.name FROM reservation_item ri
                      inner join movie m on ri.movie_id = m.movie_id
                      WHERE quantity > $movieTopQuantityFrom AND quantity < $movieTopQuantityTo                        
                      GROUP BY ri.movie_id;";*/

        $sqlString = "WITH cte1 AS (SELECT sum(ri.quantity) as quantity, m.name FROM reservation_item ri inner join movie m on ri.movie_id = m.movie_id GROUP BY ri.movie_id) SELECT quantity, name FROM cte1 WHERE quantity > $movieTopQuantityFrom AND quantity < $movieTopQuantityTo;";

        $dbResult = $db->conn()->query($sqlString);

        $resultArray = [];

        while($result = $dbResult->fetch_assoc()) {
            $resultArray[] = $result;
        }

        //var_dump($resultArray);
        echo json_encode($resultArray);
    }

    public function authorize(): array
    {
        return [
            "SuperAdmin"
        ];
    }
}