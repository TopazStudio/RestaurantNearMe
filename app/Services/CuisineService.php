<?php
/**
 * Created by PhpStorm.
 * User: erikn
 * Date: 9/19/2017
 * Time: 11:23 AM
 */

namespace App\Services;
use App\Models\Cuisine;
use App\Traits\HandlesImages;
use App\Util\AutoCRUD\CRUDService;
use App\Util\AutoCRUD\HandlesCRUD;
use App\Util\SessionUtil;
use Illuminate\Http\Request;

class CuisineService extends Service implements CRUDService
{
    use HandlesCRUD;

    protected $picType = 'cuisinePic';

    protected $picPath = 'public/cuisinePic';

    public function getModelType()
    {
        return 'App\Models\Cuisine';
    }

}