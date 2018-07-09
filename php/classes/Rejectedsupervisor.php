<?php
class Rejectedsupervisor
{
    protected $first_name;
    protected $last_name;
    protected $organization;
    protected $email;
    protected $id_number;
    protected $org_website;
    protected $reason;

    public function __construct($first_name, $last_name, $organization, $email, $id_number, $org_website, $reason){
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->organization = $organization;
        $this->email = $email;
        $this->id_number = $id_number;
        $this->org_website = $org_website;
        $this->reason = $reason;
    }

    public function insertRejectedSupervisor($db){
        $sql = 'INSERT INTO rejected_field(id, first_name, last_name, organization, email, id_number, org_website, reason) VALUES(:id, :first_name, :last_name, :organization, :email, :id_number, :org_website, :reason)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":id", NULL);
        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":last_name", $this->last_name);
        $stmt->bindParam(":organization", $this->organization);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":id_number", $this->id_number);
        $stmt->bindParam(":org_website", $this->org_website);
        $stmt->bindParam(":reason", $this->reason);
        $result = $stmt->execute();
        return $result;
    }

    public static function getRejectedSupervisors($db){
        $sql = 'SELECT * FROM rejected_field';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $rows = $stmt->rowCount();
        if($rows > 0){
            $resultset = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultset;
        }else{
            return false;
        }
    }
    
}
