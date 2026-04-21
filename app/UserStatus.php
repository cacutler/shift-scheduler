<?php
namespace App;
enum UserStatus: string {
    case Manager = 'manager';
    case Employee = 'employee';
}