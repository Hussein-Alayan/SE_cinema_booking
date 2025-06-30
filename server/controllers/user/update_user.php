<?php 
require_once(__DIR__. "/../BaseController.php");

class UpdateUserController extends BaseController {
    protected function setAllowedMethods(){
        $this->allowedMethods['post'];
}

protected function setModelClass(){
    $this->modelClass = 'User';
}
protected function setOptionalFields(){
    $this->optionalFields;
}

protected function setRequiredFields(){}
}