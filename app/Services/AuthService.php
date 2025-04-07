<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * Verify if user has the specified role
     */
    public function verifyUserRole(string $role): bool
    {
      if (!session('auth')) {
        return false;
      }
      $userId= session('auth.usr');
      $recs = DB::scalar("SELECT count(*) FROM users WHERE usr = ? AND role = ?", [$userId, $role]);

        return ($recs === 1);
    }

    /**
     * Check if user is logged in (with optional role check)
     */
    public function isLoggedIn(?string $requiredRole = null): bool
    {
        if (!session('auth')) {
            return false;
        }

        if ($requiredRole && session('auth.role') !== $requiredRole) {
            return false;
        }

        return true;
    }

    /**
     * Validate login credentials
     */
    public function attemptLogin(string $email, string $password): ?array
    {
        $user = DB::table('users')
            ->where('email', $email)
            ->first();

        if (!$user || !Hash::check($password, $user->password)) {
            return null;
        }

        $roleTable = str_ends_with($user->role, 'admin') ? 'admins' : $user->role.'s';
        $entity = DB::table($roleTable)
            ->where('id', $user->ent_id)
            ->first();

        return [
            'user_id' => $user->id,
            'role' => $entity->role,
            'name' => $entity->name
        ];
    }

    /**
     * Session timeout check
     */
    public function checkSessionTimeout(int $lifetime = 3600): bool
    {
        $lastActivity = session('last_activity', 0);
        return (time() - $lastActivity) <= $lifetime;
    }

  /**
  * Logout current user
  */
  public function logout(): void
  {
      session()->forget(['auth', 'last_activity']);
  }

  /**
   * Get current user's ID
   */
  public function getEntityId(): ?int
  {
      return session('auth.ent_id');
  }

  /**
   * Password complexity validator
   */
  public function validatePassword(string $password): bool
  {
      return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $password);
  }
}