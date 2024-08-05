<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\FollowerStat;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class FollowerController extends Controller
{
    /**
     * Get followers by date range.
     * 
     * @param Request $request
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
            $followers = Follower::dateBetween($startDate, $endDate)->with('followerStats', 'interactions')->get();

            // Check if any followers were found
            if ($followers->isEmpty()) {
                return response()->json([
                    'message' => 'No followers found in the specified date range.'
                ], 404);
            }

            // Return the followers as a JSON response
            return response()->json($followers);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An unexpected error occurred.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get the total number of followers in a date range.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTotalFollowersByDateRange(Request $request)
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

            // Retrieve the total number of followers within the date range
            $totalFollowers = FollowerStat::whereBetween('date_followed', [$startDate, $endDate])
                ->distinct('follower_id')  // Ensure unique followers are counted
                ->count('follower_id');

            // Return the total number of followers as a JSON response
            return response()->json([
                'data' => $totalFollowers
            ], 200);

        } catch (\Exception $e) {
            // Log and return unexpected errors
            Log::error('Error retrieving total followers: ' . $e->getMessage());
            return response()->json([
                'error' => 'An unexpected error occurred.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
     
    /**
     * Get the number of followers grouped by country or gender within a date range.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFollowersCountByGroup(Request $request)
    {
        try {
            // Validate the request parameters
            $request->validate([
                'group_by' => 'required|in:country,gender',
                'start_date' => 'nullable|date_format:Y-m-d',
                'end_date' => 'nullable|date_format:Y-m-d'
            ]);

            // Retrieve the parameters from the query
            $groupBy = $request->input('group_by');
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
            
            // Initialize the query builder for Follower
            $query = Follower::query();

            // Apply date range filters if provided
            if ($startDate && $endDate) {
                $startDate = Carbon::createFromFormat('Y-m-d', $startDate)->startOfDay();
                $endDate = Carbon::createFromFormat('Y-m-d', $endDate)->endOfDay();
                
                // Filter based on follower stats dates
                $query->whereHas('followerStats', function($q) use ($startDate, $endDate) {
                    $q->whereBetween('date_followed', [$startDate, $endDate]);
                });
            }

            // Get the count of followers grouped by the specified parameter
            $followersCount = $query->select($groupBy)
                ->withCount('followerStats as total_followers')
                ->get()
                ->groupBy($groupBy)
                ->map(function ($items, $key) {
                    return $items->count();
                });

            // Return the counts as a JSON response
            return response()->json([
                'data' => $followersCount
            ], 200);

        } catch (\Exception $e) {
            // Log and return unexpected errors
            Log::error('Error retrieving followers count by group: ' . $e->getMessage());
            return response()->json([
                'error' => 'An unexpected error occurred.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
