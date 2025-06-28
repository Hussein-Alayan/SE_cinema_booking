<?php
require_once("Model.php");

class PaymentMethod extends Model
{
    private int $id;
    private int $user_id;
    private string $type;
    private string $details;
    private bool $is_default;
    private string $created_at;

    protected static string $table = "payment_methods";

    public function __construct(array $data)
    {
        $this->id = $data["id"];
        $this->user_id = $data["user_id"];
        $this->type = $data["type"];
        $this->details = $data["details"];
        $this->is_default = (bool)$data["is_default"];
        $this->created_at = $data["created_at"];
    }
    // Getters and setters can be added here as needed
}
