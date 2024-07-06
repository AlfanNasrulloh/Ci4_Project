<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class User extends Controller
{
    protected $db, $builder;

    public function __construct()
    {
        // Connect to the database
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('users');
    }

    public function index()
    {
        // Redirect to the admin method or define logic for the index method
        return $this->admin();
    }

    public function admin()
    {
        // Perform the join operations
        $this->builder->select('users.id as userid, username, email, auth_groups.name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');

        // Execute the query
        $query = $this->builder->get();

        // Get the results
        $data['users'] = $query->getResult();

        // Return the view with data
        return view('user/index', $data);
    }

    public function detail($id)
    {
        // Perform the join operations
        $this->builder->select('users.id as userid, username, email, auth_groups.name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('users.id', $id);

        // Execute the query
        $query = $this->builder->get();

        // Get the results
        $data['user'] = $query->getRow();

        // Return the view with data
        return view('user/detail', $data);
    }

    public function delete($id)
    {
        // Delete the user from the database
        $this->builder->where('id', $id);
        $this->builder->delete();

        // Redirect back to the admin page with a success message
        return redirect()->to('/user/admin')->with('message', 'User deleted successfully');
    }
}
