<?php
namespace App\Http\Controllers;
use Illuminate\Foundation\auth\Access\AuthorizesRequests;
abstract class Controller {
    use AuthorizesRequests;
}