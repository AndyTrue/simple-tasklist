<?php


namespace app\models;


use app\libraries\Model;

class Task extends Model
{
    public function getTasks()
    {
        $this->db->query("SELECT * FROM tasks");
        return $this->db->resultSet();
    }

    public function addTask($data)
    {
        $this->db->query("INSERT INTO tasks (title, body) VALUES (:title, :body)");
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getTaskById($id)
    {
        $this->db->query("SELECT * FROM tasks WHERE id = :id");
        $this->db->bind(':id', $id);

        return $this->db->single();
    }

    public function updateTask($data)
    {
        $this->db->query("UPDATE tasks SET title = :title, body = :body WHERE id = :id");

        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteTask($id)
    {
        $this->db->query("DELETE FROM tasks WHERE id = :id");
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}