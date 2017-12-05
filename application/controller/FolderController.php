<?php

/**
 * This controller shows an area that's visible for logged in users
 */
class FolderController extends Controller
{
    
    public function __construct()
    {
        parent::__construct();

        // this entire controller should only be visible/usable by logged in users, so we put authentication-check here
        Auth::checkAuthentication();
    }

    /**
     * This method controls what happens when you move to /folder/index in your app.
     */
    public function index()
    {
        $this->View->render('folder/index');
    }

    
}

