<?php
require_once(__DIR__ . "/../bootstrap.php");


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

    /**
     * Main entry point for the controller
     */
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
                    break;
                case 'put':
                    $this->handlePut();
                    break;
                case 'delete':
                    $this->handleDelete();
                    break;
                default:
                    $this->respondMethodNotAllowed();
            }
        } catch (ValidationException $e) {
            $this->respondBadRequest($e->getMessage());
        } catch (Exception $e) {
            $this->respondServerError($e->getMessage());
        }
    }


    protected function validateMethod()
    {
        $currentMethod = strtolower($_SERVER['REQUEST_METHOD']);
        if (!in_array($currentMethod, $this->allowedMethods)) {
            $this->respondMethodNotAllowed();
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

    protected function validateRequiredFields($data)
    {
        $missing = [];
        foreach ($this->requiredFields as $field) {
            if (!isset($data[$field]) || empty($data[$field])) {
                $missing[] = $field;
            }
        }

        if (!empty($missing)) {
            throw new ValidationException('Missing required fields: ' . implode(', ', $missing));
        }

        return $data;
    }

    protected function getIdFromQuery()
    {
        $params = $this->getQueryParams();
        $id = $params['id'] ?? null;

        if (!$id) {
            throw new ValidationException('ID is required');
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
            $this->respondNotFound();
        }

        return $model;
    }

    protected function respondSuccess($data = null, $message = 'Success', $statusCode = 200)
    {
        http_response_code($statusCode);
        $response = [
            'success' => true,
            'message' => $message
        ];

        if ($data !== null) {
            $response['data'] = $data;
        }

        echo json_encode($response);
        exit;
    }

    protected function respondCreated($data = null, $message = 'Created successfully')
    {
        $this->respondSuccess($data, $message, 201);
    }

    protected function respondBadRequest($message = 'Bad request')
    {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'error' => $message
        ]);
        exit;
    }

    protected function respondNotFound($message = 'Not found')
    {
        http_response_code(404);
        echo json_encode([
            'success' => false,
            'error' => $message
        ]);
        exit;
    }

    protected function respondServerError($message = 'Server error')
    {
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'error' => $message
        ]);
        exit;
    }

    protected function respondMethodNotAllowed()
    {
        http_response_code(405);
        echo json_encode([
            'success' => false,
            'error' => 'Method not allowed'
        ]);
        exit;
    }

    abstract protected function setAllowedMethods();
    abstract protected function setModelClass();
    abstract protected function setRequiredFields();
    abstract protected function setOptionalFields();

    //http methods
    protected function handleGet()
    {
        $this->respondMethodNotAllowed();
    }

    protected function handlePost()
    {
        $this->respondMethodNotAllowed();
    }

    protected function handlePut()
    {
        $this->respondMethodNotAllowed();
    }

    protected function handleDelete()
    {
        $this->respondMethodNotAllowed();
    }
}
