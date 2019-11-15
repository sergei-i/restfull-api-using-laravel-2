<?php

namespace App\Http\Controllers\Country;

use App\Http\Controllers\Controller;
use App\Models\CountryModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CountryController extends Controller
{
    public function country()
    {
        return response()->json(CountryModel::all(), Response::HTTP_OK);
    }

    public function countryById($id)
    {
        $country = CountryModel::find($id);

        if (is_null($country)) {
            return response()->json(['message' => 'Record not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($country, Response::HTTP_OK);
    }

    public function countrySave(Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
            'iso' => 'required|min:2|max:2'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        $country = CountryModel::create($request->all());

        return response()->json($country, Response::HTTP_CREATED);
    }

    public function countryUpdate(Request $request, $id)
    {
        $country = CountryModel::find($id);

        if (is_null($country)) {
            return response()->json(['message' => 'Record not found'], Response::HTTP_NOT_FOUND);
        }

        $country->update(request()->all());

        return response()->json($country, Response::HTTP_OK);
    }

    public function countryDelete($id)
    {
        $country = CountryModel::find($id);

        if (is_null($country)) {
            return response()->json(['message' => 'Record not found'], Response::HTTP_NOT_FOUND);
        }

        $country->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
