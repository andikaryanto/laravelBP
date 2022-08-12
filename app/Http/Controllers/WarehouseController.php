<?php

namespace App\Http\Controllers;

use App\Repositories\WarehouseRepository;
use App\ViewModels\WarehouseCollection;
use LaravelCommon\Responses\SuccessResponse;

class WarehouseController extends Controller
{
    /**
     * Undocumented variable
     *
     * @var WarehouseRepository
     */
    protected WarehouseRepository $warehouseRepository;


    public function __construct(
        WarehouseRepository $warehouseRepository
    )
    {
        $this->warehouseRepository = $warehouseRepository;
    }


    /**
     * Undocumented function
     *
     * @return void
     */
    public function index(){
        $warehouses = $this->warehouseRepository->collect();
        $warehouseCollection = new WarehouseCollection($warehouses);
        return (new SuccessResponse('OK', [], $warehouseCollection));
    }

}
