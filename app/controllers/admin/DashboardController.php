<?php

class DashboardController extends BaseController {

    /**
     * The layout that should be used for responses.
     */
     protected $layout = 'admin.layouts.main';

    public function index($action='/') {
        $reasons    = Reasons::get_all_reasons($type="product");    // combo options
         switch ($action){
                case '/':
                case 'news':
                    $products       = Product::get_products($status=1);             // news
                    $params         = array (
                                            'title' => 'PRODUCTOS NUEVOS',
                                            'type'  =>  'news'
                                        );
                break;
                case 'approved':
                    $products       = Product::get_products($status=2);             // approved
                    $params         = array (
                                            'title' => 'PRODUCTOS APROBADOS',
                                            'type'  =>  'approved'
                                        );
                break;
                case 'denied':
                    $products       = Product::get_products($status=0);             // denied
                    $params         = array (
                                            'title' => 'PRODUCTOS DENEGADOS',
                                            'type'  =>  'denied'
                                        );
                break;

            }
            
        $this->layout->content = View::make('admin.home.index')
        ->with('reasons',$reasons)
        ->with('products',$products)
        ->with ('params', $params);
    }


}