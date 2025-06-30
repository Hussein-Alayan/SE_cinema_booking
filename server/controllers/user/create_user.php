<?php
require_once(__DIR__ . "/../BaseController.php");


class CreateUserController extends BaseController
{
    protected function setAllowedMethods()
    {
        $this->allowedMethods = ['post'];
    }

    protected function setModelClass()
    {
        $this->modelClass = 'User';
    }

    protected function setRequiredFields()
    {
        $this->requiredFields = ['first_name', 'last_name', 'email', 'password_hash', 'mobile', 'date_of_birth'];
    }

    protected function setOptionalFields()
    {
        $this->optionalFields = ['address'];
    }


    protected function handlePost()
    {
        $data = $this->getRequestData();

        $this->validateRequiredFields($data);

        // Create user
        $user = User::create($data);

        // Return success with user data
        $this->respondCreated($user->toArray(), 'User created successfully');
    }
}

$controller = new CreateUserController();
$controller->handleRequest();
