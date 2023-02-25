<?php

namespace app\models;

use app\core\DbModel;

class MovieModel extends DbModel
{
    public $movie_id;
    public $name;
    public $image_url;
    public $price;
    public $most_popular;
    public $pocetak_prikazivanja;
    public $movie_length;
    public $category_id;
    public $categories;
    public $selected_category_ids;
    public $category;
    public $description;

    // pomoc za movieDetails funkciju u MovieCont
    public string $director_name;
    public string $actor_name_role;
    public string $time_auditorium;
    public string $screening_id;


    // pomoc za createMovieProcess u AdministrationCont
    public $directors_full_name;
    public $actors_full_name;

    public function table(): string
    {
        return "movie";
    }

    public function attributes(): array
    {
        return [
            "name",
            "image_url",
            "price",
            "description",
            "most_popular",
            "movie_length"
        ];
    }

    public function rules(): array
    {
        return [
            "name" => [self::RULE_REQUIRED],
            "image_url" => [self::RULE_REQUIRED],
            "price" => [self::RULE_REQUIRED],
            "selected_category_ids" => [self::RULE_REQUIRED],
            "movie_length" => [self::RULE_REQUIRED],
            "directors_full_name" => [self::RULE_REQUIRED],
            "actors_full_name" => [self::RULE_REQUIRED],
            "description" => [self::RULE_REQUIRED]
        ];
    }
}