<?php

namespace app\core;

abstract class Controller
{
    public Router $router;

    public function __construct() {
        $this->router = new Router();

        $this->checkRoles();
    }

    abstract public function authorize(): array;

    public function view($viewName, $layout, $params) {
        return $this->router->view($viewName, $layout, $params);
    }

    public function partialView($viewName, $params) {
        return $this->router->partialView($viewName, $params);
    }

    public function checkRoles() {
        $connection = new DbConnection();
        $email = Application::$app->session->get(Application::$app->session->USER_SESSION);
        $sqlString = "
            SELECT r.name from user u
            inner join user_role ur on u.user_id = ur.user_id
            inner join role r on ur.role_id = r.role_id
            WHERE u.email = '$email' and r.active = true;
        ";

        $resultFromDb = $connection->conn()->query($sqlString);

        $resultArray = [];

        while($result = $resultFromDb->fetch_assoc()) {
            $resultArray[] = $result["name"];
        }

        Application::$app->session->set(Application::$app->session->ROLE_SESSION, $resultArray);

        $roles = $this->authorize();

        if ($roles === [])
            return;

        $email = Application::$app->session->get(Application::$app->session->USER_SESSION);
        $access = false;

        if ($email !== false) {
            foreach ($resultArray as $item) {
                foreach ($roles as $role) {
                    if ($item === $role) {
                        $access = true;
                    }
                }
            }

            if (!$access) {
                header("location:" . "/accessDenied");
            }
            return;
        }
        header("location:" . "/login");
    }

    public function getRoles() {
        if (Application::$app->session->get(Application::$app->session->ROLE_SESSION) !== false) {
            return Application::$app->session->get(Application::$app->session->ROLE_SESSION);
        }

        $connection = new DbConnection();
        $email = Application::$app->session->get(Application::$app->session->USER_SESSION);
        $sqlString = "
            SELECT r.name from user u
            inner join user_role ur on u.user_id = ur.user_id
            inner join role r on ur.role_id = r.role_id
            WHERE u.email = '$email' and r.active = true;
        ";

        $resultFromDb = $connection->conn()->query($sqlString);

        $resultArray = [];

        while($result = $resultFromDb->fetch_assoc()) {
            $resultArray[] = $result["name"];
        }

        Application::$app->session->set(Application::$app->session->ROLE_SESSION, $resultArray);

        return $resultArray;
    }
}