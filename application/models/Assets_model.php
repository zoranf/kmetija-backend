<?php

class Assets_model extends CI_Model
{
    /**
     * Flag for not getting full list of ads
     */
    const NOT_FULL_LIST = false;
    /**
     * Flag for getting full list of ads
     */
    const FULL_LIST = true;

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    // Get enabled advertisements
    public function getAdList($full = self::NOT_FULL_LIST)
    {
        $sql = "SELECT * FROM advertisements";
        if ($full === self::NOT_FULL_LIST) {
            $sql .= " WHERE enabled = 1";
        }
        $sql .= " ORDER BY enabled DESC";
        $query = $this->db->query($sql);

        return $query->result();
    }

    public function getAd($id)
    {
        $sql = "SELECT * FROM advertisements WHERE id = {$id}";
        $query = $this->db->query($sql);
        if ($query->num_rows() !== 0) {
            return $query->result()[0];
        }
        return false;
    }

    // Insert advertisement
    public function add($data)
    {
        $sql = "INSERT INTO advertisements (title, picture, time)
                VALUES (?, ?, ?)";

        $insertArr = [
            "title"     =>  $data["title"],
            "picture"   =>  $data["picture"],
            "time"      =>  time()
        ];

        $status = $this->db->query($sql, $insertArr);

        if ($status === true) {

            return $this->db->insert_id();
        }

        return false;
    }

    // Update advertisement
    public function update($data)
    {
        $this->db->where('id', $data["id"]);
        unset($data["id"]);
        unset($data["submit"]);
        return $this->db->update('advertisements', $data);
    }

    // Delete advertisement
    public function delete($id)
    {
        $sql = "DELETE FROM advertisements
                WHERE id = ?";

        return $this->db->query($sql, $id);
    }

    // Enable advertisement
    public function enable($data)
    {
        $sql = "UPDATE advertisements
                SET enabled = ?
                WHERE id = ?";

        $insertArr = [
            "enabled"   => $data["enabled"],
            "id"        => $data["id"]
        ];

        return $this->db->query($sql, $insertArr);
    }
}
