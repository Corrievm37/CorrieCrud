<?php

class Person{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function getPeople(){
        $this->db->query('SELECT *
                            FROM system_people');
        $result = $this->db->resultSet();

        return $result;
    }

    public function addPerson($data){
        $this->db->query('INSERT INTO system_people(name, surname, idnr, cellnr, email, birthdate, language, interest) VALUES (:name, :surname, :idnr, :cellnr, :email, :birthdate, :language, :interest)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':surname', $data['surname']);
        $this->db->bind(':idnr', $data['idnr']);
        $this->db->bind(':cellnr', $data['cellnr']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':birthdate', $data['birthdate']);
        $this->db->bind(':language', $data['language']);
        $this->db->bind(':interest', json_encode($data['interest[]']));
print_r(json_decode($data['interest']));
        //execute 
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function getPersonById($id){
        $this->db->query('SELECT * FROM system_people WHERE id = :id');
        $this->db->bind(':id', $id);
        $row = $this->db->single();

        return $row;
    }

    public function updatePerson($data){
        $this->db->query('UPDATE system_people SET name = :name, surname = :surname, idnr = :idnr, cellnr = :cellnr, email = :email, 
                         birthdate = :birthdate, language = :language, interest = :interest
                            WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':surname', $data['surname']);
        $this->db->bind(':idnr', $data['idnr']);
        $this->db->bind(':cellnr', $data['cellnr']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':birthdate', $data['birthdate']);
        $this->db->bind(':language', $data['language']);
        $this->db->bind(':interest', json_encode($data['interest[]']));
        
        //execute 
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    //delete a person
    public function deletePerson($id){

        $this->db->query('DELETE FROM system_people WHERE id = :id');
        $this->db->bind(':id', $id);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
}