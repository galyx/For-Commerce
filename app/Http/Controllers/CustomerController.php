<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class CustomerController extends Controller
{
    private $users;

    public function __construct(User $users)
    {
        $this->users = $users;
    }

    public function clienteIndex()
    {
        return response()->json($this->users->with(['addresses'])->paginate(15));
    }
}
