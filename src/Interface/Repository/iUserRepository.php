<?php

namespace App\Interface\Controller;

use App\Entity\User;

interface iUserRepository
{
    public function add(User $user): void;
    public function findByEmail(string $email): ?User;
}
