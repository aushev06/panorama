<?php
/**
 * Created by PhpStorm.
 * User: aushev
 * Date: 02.09.2019
 * Time: 22:01
 */

namespace App\Http\Controllers\Admin;


class AdminController
{
    public function index() {

        return view('admin.index');
    }
}
