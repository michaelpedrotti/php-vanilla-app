<?php namespace App\Controllers;

class HomeController extends AbstractController {
       
    static public function index(){
        
        return static::_view('home/index.twig');
    }
}