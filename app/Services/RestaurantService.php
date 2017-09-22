<?php
/**
 * Created by PhpStorm.
 * User: erikn
 * Date: 9/19/2017
 * Time: 11:23 AM
 */

namespace App\Services;

use App\Util\AutoCRUD\CRUDService;
use App\Util\AutoCRUD\HandlesCRUD;
use Illuminate\Http\Request;
use App\Models\Restaurant as Model;
class RestaurantService extends Service implements CRUDService {

    use HandlesCRUD;

    protected $picType = 'restaurantPic';

    protected $picPath = 'public/restaurantPic';

    public function getModelType()
    {
        return 'App\Models\Restaurant';
    }
}