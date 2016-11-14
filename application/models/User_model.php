<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: blx32@srmoura.com.br
 * Date: 23/09/16
 * Time: 00:29
 */
class User_model extends CI_Model
{

    /** Insere dados no BD */
    public function registration_insert($data)
    {
        $condition = "username =" . "'" . $data['username'] . "'";
        $this->db->select('*');
        $this->db->from('members');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            $this->db->insert('members', $data);
            if ($this->db->affected_rows() > 0) {
                return true;
            }
        } else {
            return false;
        }
    }

    /** Efetua login */
    public function login($data)
    {
        $condition = "email =" . "'" . $data['email'] . "' AND " . "password =" . "'" . $data['password'] . "'";
        $this->db->select('*');
        $this->db->from('members');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**Recupera informações por email*/
    public function information_email($email)
    {
        $condition = "email =" . "'" . $email . "'";
        $this->db->select('*');
        $this->db->from('members');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    /**Recupera informações pela senha*/
    public function information_pass($pass)
    {
        $condition = "password =" . "'" . $pass . "'";
        $this->db->select('*');
        $this->db->from('members');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    /**Atualiza informações por email*/
    public function updatepass_email($data)
    {
        $this->db->where('email', $data['email']);
        if ($this->db->update('members', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }


    }


}