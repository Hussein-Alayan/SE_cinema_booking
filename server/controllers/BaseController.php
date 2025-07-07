<?php
require_once(__DIR__ . "/../bootstrap.php");
require_once(__DIR__ . '/../services/ValidationService.php');


//which HTTP methods you support
//which Model you are working on
//which fields you need / accept

abstract class BaseController
{
    protected $allowedMethods = [];
    protected $modelClass = null;
    protected $requiredFields = [];
    protected $optionalFields = [];

    public function __construct()
    {
        $this->setAllowedMethods();
        $this->setModelClass();
        $this->setRequiredFields();
        $this->setOptionalFields();
    }


    public function handleRequest()
    {
        try {
            // Set JSON content type
            header('Content-Type: application/json');

            // Validate HTTP method
            $this->validateMethod();

            // Route to appropriate method based on HTTP method
            $method = strtolower($_SERVER['REQUEST_METHOD']);

            switch ($method) {
                case 'get':
                    $this->handleGet();
                    break;
                case 'post':
                    $this->handlePost();
                default:
                    ResponseService::methodNotAllowed();
            }
        } catch (ValidationException $e) {
            ResponseService::error($e->getMessage(), 400);
        } catch (Exception $e) {
            ResponseService::error($e->getMessage(), 500);
        }
    }


    protected function validateMethod()
    {
        $currentMethod = strtolower($_SERVER['REQUEST_METHOD']);
        if (!in_array($currentMethod, $this->allowedMethods)) {
            ResponseService::methodNotAllowed();
        }
    }

    protected function getRequestData()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        return $input ?: $_POST;
    }

    protected function getQueryParams()
    {
        return $_GET;
    }

    protected function getIdFromQuery()
    {
        $params = $this->getQueryParams();
        $id = $params['id'] ?? null;

        if (!$id) {
            ResponseService::error('ID is required', 400);
        }

        return $id;
    }

    protected function findModel($id)
    {
        if (!$this->modelClass) {
            throw new Exception('Model class not set');
        }

        $model = $this->modelClass::find($id);

        if (!$model) {
            ResponseService::notFound();
        }

        return $model;
    }

    abstract protected function setAllowedMethods();
    abstract protected function setModelClass();
    abstract protected function setRequiredFields();
    abstract protected function setOptionalFields();

    //http methods
    protected function handleGet()
    {
        ResponseService::methodNotAllowed();
    }

    protected function handlePost()
    {
        ResponseService::methodNotAllowed();
    }
}
