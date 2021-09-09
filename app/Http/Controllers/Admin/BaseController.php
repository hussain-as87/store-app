<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    public function __construct()
    {
/*         $this->middleware('usertype:admin,super_admin');
 */        $this->middleware('verified');
        $this->middleware('auth');

    }
}
