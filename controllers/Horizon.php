<?php namespace Jacob\Horizon\Controllers;

use Backend\Classes\Controller;
use Backend\Classes\NavigationManager;

class Horizon extends Controller
{
    public $requiredPermissions = ['jacob.horizon.access'];

    public function __construct()
    {
        parent::__construct();

        NavigationManager::instance()->setContext('Jacob.Horizon', 'horizon', 'horizon');
    }

    public function index()
    {
        $this->pageTitle = 'Horizon dashboard';
    }
}
