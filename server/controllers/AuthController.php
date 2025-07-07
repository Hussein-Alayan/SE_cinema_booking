<?php
require_once(__DIR__ . '/BaseController.php');
require_once(__DIR__ . '/../models/User.php');

class AuthController extends BaseController
{
    protected function setAllowedMethods()
    {
        $this->allowedMethods = ['get', 'post'];
    }

    protected function setModelClass()
    {
        $this->modelClass = User::class;
    }

    protected function setRequiredFields()
    {
        // For registration, these are required
        $this->requiredFields = ['first_name', 'last_name', 'email', 'mobile', 'password', 'date_of_birth'];
    }

    protected function setOptionalFields()
    {
        $this->optionalFields = [];
    }

    protected function handleGet()
    {
        // Return a simple message indicating this is an auth endpoint
        ResponseService::success(['message' => 'Auth endpoint - use POST for login/register'], 'Auth controller ready');
    }

    protected function handlePost()
    {
        $data = $this->getRequestData();
        $action = $_GET['action'] ?? 'register';

        if ($action === 'login') {
            $this->login($data);
        } else {
            $this->register($data);
        }
    }

    private function register($data)
    {
        ValidationService::validateRequiredFields($data, $this->requiredFields);

        // Hash password
        if (isset($data['password'])) {
            $data['password_hash'] = password_hash($data['password'], PASSWORD_DEFAULT);
            unset($data['password']);
        }

        $user = $this->modelClass::create($data);
        ResponseService::success($user->toArray(), 'User registered successfully', 201);
    }

    private function login($data)
    {
        // For login, only email and password are required
        if (empty($data['email']) || empty($data['password'])) {
            ResponseService::error('Email and password are required', 400);
        }

        $user = $this->modelClass::findByEmailOrMobile($data['email']);
        if (!$user || !$user->verifyPassword($data['password'])) {
            ResponseService::error('Invalid email or password', 401);
        }

        ResponseService::success($user->toArray(), 'Login successful');
    }
}
