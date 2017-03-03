<?php
/**
 * Created by PhpStorm.
 * User: weiwenhao
 * Date: 17-2-21
 * Time: 下午6:52
 */

namespace App\Repositories;

use App\Models\Key;
use Bosnadev\Repositories\Eloquent\Repository;

class KeyRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return Key::class;
    }


}