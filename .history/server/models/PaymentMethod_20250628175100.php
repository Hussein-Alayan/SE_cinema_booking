<?php
require_once("Model.php");

class PaymentMethod extends Model
{
    private int $id;
    private int $userId;
    private string $type;
    private string $details;
    private bool $isDefault;
    private string $createdAt;

    protected static string $table = "payment_methods";

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->id = $data["id"];
        $this->userId = $data["user_id"];
        $this->type = $data["type"];
        $this->details = $data["details"];
        $this->isDefault = (bool)$data["is_default"];
        $this->createdAt = $data["created_at"];
    }

    protected function syncToAttributes(): void
    {
        $this->attributes['id'] = $this->id;
        $this->attributes['user_id'] = $this->userId;
        $this->attributes['type'] = $this->type;
        $this->attributes['details'] = $this->details;
        $this->attributes['is_default'] = $this->isDefault;
        $this->attributes['created_at'] = $this->createdAt;
    }

    // Property-based getters (type-safe)
    public function getId()
    {
        return $this->id;
    }
    public function getUserId()
    {
        return $this->userId;
    }
    public function getType()
    {
        return $this->type;
    }
    public function getDetails()
    {
        return $this->details;
    }
    public function getIsDefault()
    {
        return $this->isDefault;
    }
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    // Property-based setters (type-safe)
    public function setUserId(int $value)
    {
        $this->userId = $value;
    }
    public function setType(string $value)
    {
        $this->type = $value;
    }
    public function setDetails(string $value)
    {
        $this->details = $value;
    }
    public function setIsDefault(bool $value)
    {
        $this->isDefault = $value;
    }
}
