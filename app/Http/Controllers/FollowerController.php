<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FollowerController extends Controller
{
    /**
     * Display a listing of the followers.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $followers = Follower::all();
            return response()->json($followers);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An unexpected error occurred.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified follower.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $follower = Follower::findOrFail($id);
            return response()->json($follower);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Follower not found.',
                'details' => $e->getMessage()
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An unexpected error occurred.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created follower in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validate input data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'gender' => 'required|string|in:male,female,other',
            'country' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validation failed.',
                'details' => $validator->errors()
            ], 400);
        }

        try {
            $follower = Follower::create($request->all());
            return response()->json($follower, 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An unexpected error occurred.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Display a listing of followers added in a specific date range.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFollowersByDateRange(Request $request)
    {
        try {
            // Validate the date parameters
            $request->validate([
                'start_date' => 'required|date_format:Y-m-d',
                'end_date' => 'required|date_format:Y-m-d',
            ]);

            // Retrieve the date filters from the query parameters
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');

            // Retrieve followers within the date range
            $followers = Follower::dateBetween($startDate, $endDate)->get();

            // Return the followers as a JSON response
            return response()->json($followers);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An unexpected error occurred.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
