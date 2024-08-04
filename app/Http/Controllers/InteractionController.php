<?php

namespace App\Http\Controllers;

use App\Models\Interaction;
use App\Models\Follower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Carbon;

class InteractionController extends Controller
{
    /**
     * Display a listing of interactions, with optional date filtering.
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
            $query = Interaction::query();

            // Apply date range filtering if both start and end dates are provided
            if ($startDate && $endDate) {
                $query->dateBetween($startDate, $endDate);
            }

            // Execute the query and get the results
            $interactions = $query->with('follower')->get();

            // Return the interactions as a JSON response
            return response()->json($interactions);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An unexpected error occurred.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display interactions for a specific follower, with optional date filtering.
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
            $query = Interaction::where('follower_id', $id);

            // Apply date range filtering if both start and end dates are provided
            if ($startDate && $endDate) {
                $query->dateBetween($startDate, $endDate);
            }

            // Execute the query and get the results
            $interactions = $query->with('follower')->get();

            if ($interactions->isEmpty()) {
                return response()->json(['error' => 'No interactions found for this follower'], 404);
            }

            // Return the interactions as a JSON response
            return response()->json($interactions);
        } catch (ModelNotFoundException $e) {
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
     * Store a newly created interaction in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validate input data
        $validator = Validator::make($request->all(), [
            'follower_id' => 'required|exists:followers,id',
            'type' => 'required|in:like,comment',
            'content' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validation failed.',
                'details' => $validator->errors()
            ], 400);
        }

        try {
            $interaction = Interaction::create($request->all());
            return response()->json($interaction, 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An unexpected error occurred.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display a listing of interactions within a specific date range.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInteractionsByDateRange(Request $request)
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

            // Retrieve interactions within the date range
            $interactions = Interaction::dateBetween($startDate, $endDate)->with('follower')->get();

            // Return the interactions as a JSON response
            return response()->json($interactions);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An unexpected error occurred.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Count the total number of interactions within a given date range.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function countInteractionsByDateRange(Request $request)
    {
        // Validar las fechas y el tipo
        $validator = Validator::make($request->all(), [
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d|after_or_equal:start_date',
            'type' => 'nullable|string|in:likes,comments,both',  // Validar tipo de interacción
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errores de validación.',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Obtener las fechas de entrada
            $startDate = Carbon::createFromFormat('Y-m-d', $request->input('start_date'))->startOfDay();
            $endDate = Carbon::createFromFormat('Y-m-d', $request->input('end_date'))->endOfDay();
            $type = $request->input('type', 'both'); // Obtener tipo de interacción, por defecto ambos

            // Construir consulta según el tipo de interacción
            $query = Interaction::whereBetween('created_at', [$startDate, $endDate]);

            if ($type === 'likes') {
                $query->where('type', 'like');
            } elseif ($type === 'comments') {
                $query->where('type', 'comment');
            }

            // Contar las interacciones
            $interactionCount = $query->count();

            // Retornar respuesta JSON
            return response()->json([
                'success' => true,
                'start_date' => $startDate->toDateString(),
                'end_date' => $endDate->toDateString(),
                'type' => $type,
                'data' => $interactionCount,
            ]);
        } catch (\Exception $e) {
            // Manejar errores de excepción
            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error inesperado.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

     /**
     * Get the interaction rate per total followers within a date range.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInteractionRateByDateRange(Request $request)
    {
        try {
            // Validate the date parameters
            $request->validate([
                'start_date' => 'required|date_format:Y-m-d',
                'end_date' => 'required|date_format:Y-m-d',
                'type' => 'nullable|in:like,comment,both'
            ]);

            // Retrieve the date filters from the query parameters
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
            $type = $request->input('type', 'both'); // Default to 'both' if not provided

            // Initialize query for interactions
            $interactionQuery = Interaction::whereBetween('timestamp', [$startDate, $endDate]);
            
            // Apply type filter if specified
            if ($type !== 'both') {
                $interactionQuery->where('type', $type);
            }

            // Count the total number of interactions
            $totalInteractions = $interactionQuery->count();

            // Count the total number of followers
            $totalFollowers = Follower::whereHas('followerStats', function ($query) use ($startDate, $endDate) {
                $query->whereBetween('date_followed', [$startDate, $endDate]);
            })->count();

            // Calculate the interaction rate
            $interactionRate = $totalFollowers > 0 ? $totalInteractions / $totalFollowers : 0;

            // Return the interaction rate as a JSON response
            return response()->json([
                'interaction_rate' => $interactionRate
            ], 200);

        } catch (\Exception $e) {
            // Log and return unexpected errors
            return response()->json([
                'error' => 'An unexpected error occurred.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
