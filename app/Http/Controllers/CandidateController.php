<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCandidateRequest;
use App\Http\Requests\UpdateCandidateRequest;
use App\Http\Resources\CandidateResource;
use App\Models\Candidate;
use App\Models\Status;
use Exception;
use Illuminate\Http\JsonResponse;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            return response()->json(
                CandidateResource::collection(
                    Candidate::with('skills', 'status', 'position')->get()
                )
            );
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCandidateRequest $request
     * @return JsonResponse
     */
    public function store(StoreCandidateRequest $request)
    {
        try {

            return response()->json(
                CandidateResource::make(
                    Candidate::create($request->validated())
                )
            );
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Candidate $candidate
     * @return JsonResponse
     */
    public function show(Candidate $candidate)
    {
        try {

            return response()->json(
                CandidateResource::make($candidate)
            );
        } catch (Exception $exception) {

            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCandidateRequest  $request
     * @param Candidate $candidate
     * @return Response
     */
    public function update(UpdateCandidateRequest $request, Candidate $candidate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Candidate $candidate
     * @return JsonResponse
     */
    public function destroy(Candidate $candidate)
    {
        try {
            $candidate->delete();

            return response()->json([
                'message' => true
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * Get candidate status timeline
     *
     * @param Candidate $candidate
     * @return JsonResponse
     */
    public function getTimeline(Candidate $candidate){
        try {

            return response()->json(
                $candidate->timeline()
            );
        } catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * Get candidates by status
     *
     * @param Status $status
     * @return JsonResponse
     */
    public function getByStatus(Status $status){
        try {

            return response()->json(
                CandidateResource::collection(
                    Candidate::where('status_id', $status->id)->get()
                )
            );
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }
}
