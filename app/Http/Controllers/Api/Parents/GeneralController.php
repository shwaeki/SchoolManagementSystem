<?php

namespace App\Http\Controllers\Api\Parents;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\AdvertiseResource;
use App\Http\Resources\ChatResource;
use App\Http\Resources\StudentClassResource;
use App\Models\AcademicYear;
use App\Models\Advertise;
use App\Models\Chat;
use App\Models\Message;
use App\Models\Otp;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class GeneralController extends BaseController
{



    public function getAdvertises(Request $request)
    {

        $advertises_data = Advertise::where('status',1)->get();
        $advertises = AdvertiseResource::collection($advertises_data);
        return $this->sendResponse([$advertises], 'Advertises Data');
    }


}
