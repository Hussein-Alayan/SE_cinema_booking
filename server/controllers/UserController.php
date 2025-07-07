<?php
require_once(__DIR__ . '/BaseController.php');
require_once(__DIR__ . '/../models/User.php');

class UserController extends BaseController
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
        $this->requiredFields = ['first_name', 'last_name', 'email', 'mobile', 'password', 'date_of_birth'];
    }

    protected function setOptionalFields()
    {
        $this->optionalFields = [];
    }

    protected function handleGet()
    {
        $id = $this->getIdFromQuery();
        $user = $this->modelClass::find($id);
        if (!$user) {
            ResponseService::notFound('User not found');
        }
        ResponseService::success($user->toArray(), 'User fetched successfully');
    }

    protected function handlePost()
    {
        $data = $this->getRequestData();
        ValidationService::validateRequiredFields($data, $this->requiredFields);
        // Hash password
        if (isset($data['password'])) {
            $data['password_hash'] = password_hash($data['password'], PASSWORD_DEFAULT);
            unset($data['password']);
        }
        $user = $this->modelClass::create($data);
        ResponseService::success($user->toArray(), 'User created successfully', 201);
    }
}
