<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    protected $userModel;
    protected $helpers = ['url', 'form'];

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        // If already logged in, redirect to dashboard
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }
        
        return view('login');
    }

    public function register()
    {
        // If already logged in, redirect to dashboard
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }
        
        return view('register');
    }

    public function save()
    {
        $username = trim($this->request->getPost('username'));
        $email = trim($this->request->getPost('email'));
        $password = $this->request->getPost('password');

        // Validate input
        if (empty($username) || empty($email) || empty($password)) {
            session()->setFlashdata('error', 'All fields are required');
            return redirect()->to('/register');
        }

        $data = [
            'username' => $username,
            'email' => $email,
            'password' => $password
        ];

        // Check if email already exists - try exact match first
        $existingUser = $this->userModel->where('email', $email)->first();
        
        // If not found, try case-insensitive search
        if (!$existingUser) {
            $db = \Config\Database::connect();
            $result = $db->query("SELECT * FROM users WHERE LOWER(email) = ?", [strtolower($email)]);
            $existingUser = $result->getRowArray();
        }
        
        if ($existingUser) {
            session()->setFlashdata('error', 'Email already exists');
            return redirect()->to('/register');
        }

        // Check if username already exists
        $existingUsername = $this->userModel->where('username', $username)->first();
        if ($existingUsername) {
            session()->setFlashdata('error', 'Username already exists');
            return redirect()->to('/register');
        }

        if ($this->userModel->insert($data)) {
            session()->setFlashdata('success', 'Registration successful. Please login.');
            return redirect()->to('/');
        } else {
            session()->setFlashdata('error', 'Registration failed');
            return redirect()->to('/register');
        }
    }

    public function auth()
    {
        $email = trim($this->request->getPost('email'));
        $password = $this->request->getPost('password');

        // Validate input
        if (empty($email) || empty($password)) {
            session()->setFlashdata('error', 'Email and password are required');
            return redirect()->to('/');
        }

        // Find user by email - try exact match first, then case-insensitive
        $user = $this->userModel->where('email', $email)->first();
        
        // If not found, try case-insensitive search
        if (!$user) {
            $db = \Config\Database::connect();
            $result = $db->query("SELECT * FROM users WHERE LOWER(email) = ?", [strtolower($email)]);
            $user = $result->getRowArray();
        }

        if (!$user) {
            session()->setFlashdata('error', 'Invalid email or password');
            return redirect()->to('/');
        }

        // Debug: Check if password field exists and is not empty
        if (empty($user['password'])) {
            session()->setFlashdata('error', 'User account error. Please contact administrator.');
            return redirect()->to('/');
        }

        // Verify password (plain text comparison)
        if ($password !== $user['password']) {
            session()->setFlashdata('error', 'Invalid email or password');
            return redirect()->to('/');
        }

        // Set session data
        $sessionData = [
            'id' => $user['id'],
            'username' => $user['username'],
            'email' => $user['email'],
            'isLoggedIn' => true
        ];
        session()->set($sessionData);
        
        return redirect()->to('/dashboard');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }

    public function dashboard()
    {
        return view('dashboard');
    }
}

