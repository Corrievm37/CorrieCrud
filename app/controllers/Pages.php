<?php
  class Pages extends Controller {
    public function __construct(){
     
    }
    
    public function index(){
      if(isLoggedIn()){
        redirect('people');
      }
      $data = [
        'title' => 'Corrie CRUD user system',
        'description' => 'Simple CRUD operation in a custom MVC',
        'info' => 'First register then login with user details to see how easy it really is to manage people',
        'name' => 'Corrie van Mollendorf',
        'location' => 'Pretoria, South Africa',
        'contact' => '+27646540304',
        'mail' => 'corrie@4you.co.za'
      ];
     
      $this->view('pages/index', $data);
    }
  }