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
     * returns role or null
     */
    public function attemptLogin(string $id, string $password): string
    {
      $user = DB::selectOne("SELECT * FROM users WHERE usr = ?", [$id]);
      if ($user && Hash::check($password, $user->psw)) 
      {
        //A los beneficiarios se le hace una comprobacion por codigo en su cellular
        //Estudiar como implementarlarlo

        $ent= DB::selectOne("SELECT * FROM {$user->role}s WHERE id = ?", [$user->ent_id]);

        session([
          'auth' => [
            'usr' => $user->usr,
            'ent_id' => $user->ent_id,
            'role' => $user->role,
            'permissions' => $ent->permissions ?? [],
            'name' => $ent->name
          ],
          'last_activity' => time()
        ]);

        return $user->role;
      }
      return '';

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

  public function requestPasswordReset(string $email): bool {
/*
   $user = DB::table('users')
        ->where('reset_token', $token)
        ->where('reset_token_expires_at', '>', now())
        ->first();

 */
    return false;

  }

  public function resetPassword(string $token, string $password): bool {
    
    /*
    $user = DB::table('users')
        ->where('reset_token', $request->token)
        ->where('reset_token_expires_at', '>', now())
        ->first();
    
    if (!$user) abort(400, 'Invalid or expired token');
    
    DB::table('users')
        ->where('id', $user->id)
        ->update([
            'password' => Hash::make($request->password),
            'reset_token' => null,
            'reset_token_expires_at' => null
        ]);

    */
    return false;
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