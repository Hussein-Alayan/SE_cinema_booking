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
        $this->id = $data["id"];
        $this->userId = $data["user_id"];
        $this->type = $data["type"];
        $this->details = $data["details"];
        $this->isDefault = (bool)$data["is_default"];
        $this->createdAt = $data["created_at"];
    }
    // Getters and setters
}
