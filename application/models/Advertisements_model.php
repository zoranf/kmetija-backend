<?php

class Advertisements_model extends CI_Model
{
    /**
     * Flag for not getting full list of ads
     */
    const NOT_FULL_LIST = false;
    /**
     * Flag for getting full list of ads
     */
    const FULL_LIST = true;

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    // Get enabled advertisements
    function getAdList($full = self::NOT_FULL_LIST)
    {
        $sql = "SELECT * FROM advertisements";
        if ($full === self::NOT_FULL_LIST) {
            $sql .= " WHERE enabled = 1";
        }
        $sql .= " ORDER BY enabled DESC";
        $query = $this->db->query($sql);

        return $query->result();
    }

    // Insert advertisement
    function add($data)
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
    function update($data)
    {
        $this->db->where('id', $data["id"]);
        unset($data["id"]);
        unset($data["submit"]);
        return $this->db->update('advertisements', $data);
    }

    // Delete advertisement
    function delete($id)
    {
        $sql = "DELETE FROM advertisements
                WHERE id = ?";

        return $this->db->query($sql, $id);
    }

    // Enable advertisement
    function enable($data)
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
