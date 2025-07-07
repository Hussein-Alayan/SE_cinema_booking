<?php
require_once(__DIR__ . '/BaseController.php');
require_once(__DIR__ . '/../models/Movie.php');

class MovieController extends BaseController
{
    protected function setAllowedMethods()
    {
        $this->allowedMethods = ['get', 'post'];
    }

    protected function setModelClass()
    {
        $this->modelClass = Movie::class;
    }

    protected function setRequiredFields()
    {
        $this->requiredFields = ['title', 'rating', 'duration_minutes', 'release_date', 'trailer_url', 'poster_url'];
    }

    protected function setOptionalFields()
    {
        $this->optionalFields = [];
    }

    protected function handleGet()
    {
        $params = $this->getQueryParams();
        $id = $params['id'] ?? null;

        if ($id) {
            // Fetch specific movie by ID
            $movie = $this->modelClass::find($id);
            if (!$movie) {
                ResponseService::notFound('Movie not found');
            }
            $movieArr = method_exists($movie, 'toArray') ? $movie->toArray() : (array)$movie;
            ResponseService::success($movieArr, 'Movie fetched successfully');
        } else {
            // Fetch all movies as associative arrays
            $movies = $this->modelClass::all();
            $moviesArr = array_map(function ($m) {
                return method_exists($m, 'toArray') ? $m->toArray() : (array)$m;
            }, $movies);
            ResponseService::success($moviesArr, 'Movies fetched successfully');
        }
    }

    protected function handlePost()
    {
        $data = $this->getRequestData();
        ValidationService::validateRequiredFields($data, $this->requiredFields);
        $movie = $this->modelClass::create($data);
        $movieArr = method_exists($movie, 'toArray') ? $movie->toArray() : (array)$movie;
        ResponseService::success($movieArr, 'Movie created successfully', 201);
    }
}
