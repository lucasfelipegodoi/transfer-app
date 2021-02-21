<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exceptions\Exception;

class ExampleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $request = request();
            $data = $request->all();

            return response()->json([
                'data' => ['Index example'],
                'error_message' => [],
                'success' => 1,
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'data' => [],
                'error_messages' => [$exception->getMessage()],
                'success' => 0,
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();

            return response()->json([
                'data' => ['Store example'],
                'error_message' => [],
                'success' => 1,
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'data' => [],
                'error_messages' => [$exception->getMessage()],
                'success' => 0,
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();
            $data['id'] = $id;

            return response()->json([
                'data' => ['Update example'],
                'error_message' => [],
                'success' => 1,
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'data' => [],
                'error_messages' => [$exception->getMessage()],
                'success' => 0,
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            throw new Exception('Method DELETE not allowed');
        } catch (Exception $exception) {
            
            return response()->json([
                'data' => [],
                'error_messages' => [$exception->getMessage()],
                'success' => 0,
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return response()->json([
                'data' => ['Show example'],
                'error_message' => [],
                'success' => 1,
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'data' => [],
                'error_messages' => [$exception->getMessage()],
                'success' => 0,
            ], 500);
        }
    }
}
