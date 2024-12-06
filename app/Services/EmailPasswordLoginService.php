<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class EmailPasswordLoginService
{
    public function __construct()
    {
        // Constructor can remain empty if not needed
    }

    /**
     * Attempt to log the admin user in using email and password with the auth driver.
     *
     * @param string $email
     * @param string $password
     * @return \App\Models\Admin|false
     */
    public function login($email, $password)
    {
        // Attempt to authenticate using the 'admin' guard
        if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password])) {
            // If authentication is successful, return the authenticated user
            return Auth::guard('admin')->user();
        }

        // Return false if login fails
        return false;
    }
}
