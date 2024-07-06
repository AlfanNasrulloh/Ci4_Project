<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class AddUser extends Controller
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
        // Display the form to add a user
        return view('user/addUser');
    }

    public function store()
    {
        // Process the form submission to add a user
        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Validate input here if needed

        // Example: Create a new user in the database
        $data = [
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT), // Hash the password
        ];
        $this->builder->insert($data);

        // Optionally, redirect to a success page or back to the form
        return redirect()->to('/addUser')->with('message', 'User added successfully');
    }
}
