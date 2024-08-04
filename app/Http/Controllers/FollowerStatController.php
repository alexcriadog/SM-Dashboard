<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\Interaction;
use App\Models\FollowerStat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FollowerStatController extends Controller
{
    /**
     * Display a listing of follower stats, with optional date filtering.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            // Validate the date parameters
            $validator = Validator::make($request->all(), [
                'start_date' => 'nullable|date_format:Y-m-d',
                'end_date' => 'nullable|date_format:Y-m-d',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => 'Invalid date format.',
                    'details' => $validator->errors()
                ], 400);
            }

            // Retrieve the date filters from the query parameters
            $startDate = $request->query('start_date');
            $endDate = $request->query('end_date');

            // Start building the query
            $query = FollowerStat::query();

            // Apply date range filtering if both start and end dates are provided
            if ($startDate && $endDate) {
                $query->dateBetween($startDate, $endDate);
            }

            // Execute the query and get the results
            $stats = $query->with('follower')->get();

            // Return the stats as a JSON response
            return response()->json($stats);

        } catch (\Exception $e) {
            // Handle unexpected errors
            return response()->json([
                'error' => 'An unexpected error occurred.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display stats for a specific follower, with optional date filtering.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id)
    {
        try {
            // Validate the date parameters
            $validator = Validator::make($request->all(), [
                'start_date' => 'nullable|date_format:Y-m-d',
                'end_date' => 'nullable|date_format:Y-m-d',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => 'Invalid date format.',
                    'details' => $validator->errors()
                ], 400);
            }

            // Retrieve the date filters from the query parameters
            $startDate = $request->query('start_date');
            $endDate = $request->query('end_date');

            // Start building the query for a specific follower
            $query = FollowerStat::where('follower_id', $id);

            // Apply date range filtering if both start and end dates are provided
            if ($startDate && $endDate) {
                $query->dateBetween($startDate, $endDate);
            }

            // Execute the query and get the results
            $stats = $query->with('follower')->get();

            if ($stats->isEmpty()) {
                // Return an error response if no stats are found
                return response()->json(['error' => 'No stats found for this follower'], 404);
            }

            // Return the stats as a JSON response
            return response()->json($stats);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Follower not found.',
                'details' => $e->getMessage()
            ], 404);
        } catch (\Exception $e) {
            // Handle unexpected errors
            return response()->json([
                'error' => 'An unexpected error occurred.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Display a listing of follower stats within a specific date range.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStatsByDateRange(Request $request)
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

            // Retrieve stats within the date range
            $stats = FollowerStat::dateBetween($startDate, $endDate)->with('follower')->get();

            // Return the stats as a JSON response
            return response()->json($stats);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An unexpected error occurred.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function getCombinedData(Request $request)
    {
        try {
            // Validate the date parameters
            $request->validate([
                'start_date' => 'required|date_format:Y-m-d',
                'end_date' => 'required|date_format:Y-m-d',
            ]);

            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');

            // Total number of followers
            $totalFollowers = FollowerStat::whereBetween('date_followed', [$startDate, $endDate])
                ->distinct('follower_id')  // Ensure unique followers are counted
                ->count('follower_id');

            // Total number of interactions
            $totalLikes = Interaction::whereBetween('timestamp', [$startDate, $endDate])->where('type', 'like')->count();

            // Total number of interactions
            $totalComments = Interaction::whereBetween('timestamp', [$startDate, $endDate])->where('type', 'comment')->count();
            
            // Calculate the interaction rate
            $interactionQuery = Interaction::whereBetween('timestamp', [$startDate, $endDate]);
            $totalInteractions = $interactionQuery->count();// Count the total number of followers

            $interactionRate = $totalFollowers > 0 ? $totalInteractions / $totalFollowers : 0;

            // Prepare the response data
            $data = [
                'total_followers' => $totalFollowers,
                'total_likes' => $totalLikes,
                'total_comments' => $totalComments,
                'interaction_rate' => number_format($interactionRate, 2),
            ];

            return response()->json($data);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An unexpected error occurred.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
