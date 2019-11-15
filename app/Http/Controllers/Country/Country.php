<?php

namespace App\Http\Controllers\Country;

use App\Http\Controllers\Controller;
use App\Models\CountryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class Country extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countryList = CountryModel::paginate(10);

        return response()->json($countryList, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $country = CountryModel::find($id);

        if (is_null($country)) {
            return response()->json(['message' => 'Record not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($country, Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $country = CountryModel::find($id);

        if (is_null($country)) {
            return response()->json(['message' => 'Record not found'], Response::HTTP_NOT_FOUND);
        }

        $country->update(request()->all());

        return response()->json($country, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = CountryModel::find($id);

        if (is_null($country)) {
            return response()->json(['message' => 'Record not found'], Response::HTTP_NOT_FOUND);
        }

        $country->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
