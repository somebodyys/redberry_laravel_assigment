<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCandidateRequest;
use App\Http\Requests\UpdateCandidateRequest;
use App\Http\Resources\CandidateResource;
use App\Models\Candidate;
use App\Models\Skill;
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
            $data = $request->validated();

            if($file = $request->file('cv')){
                $path = 'storage/cv_uploads/' . $data['first_name'] . '_' . $data['last_name'];
                $fileName = time() . '.' . $file->extension();
                $file->move(public_path($path), $fileName);
                $data['cv'] = $path . '/' . $fileName;
            }

            return response()->json(
                CandidateResource::make(
                    Candidate::create($data)
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
     * @param UpdateCandidateRequest $request
     * @param Candidate $candidate
     * @return JsonResponse
     */
    public function update(UpdateCandidateRequest $request, Candidate $candidate)
    {
        try {
            $data = $request->validated();

            if($file = $request->file('cv')){
                $path = 'storage/cv_uploads/' . $data['first_name'] . '_' . $data['last_name'];
                $fileName = time() . '.' . $file->extension();
                $file->move(public_path($path), $fileName);
                $data['cv'] = $path . '/' . $fileName;
            }

            activity('Timeline')
                ->performedOn($candidate)
                ->withProperties([
                    'old' => [ 'status_id' => (int)$candidate->status_id ],
                    'attributes' => [ 'status_id' => (int)$data['status_id']]
                ])
                ->event('updated')
                ->log($data['comment']);

            $candidate->update($data);

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

    /**
     * Attach skill to candidate
     *
     * @param Candidate $candidate
     * @param Skill $skill
     * @return JsonResponse
     */
    public function attachSkill(Candidate $candidate, Skill $skill){
        try {
            $candidate->skills()->attach($skill);

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
     * Detach skill from candidate
     *
     * @param Candidate $candidate
     * @param Skill $skill
     * @return JsonResponse
     */
    public function detachSkill(Candidate $candidate, Skill $skill){
        try {
            $candidate->skills()->detach($skill);

            return response()->json([
                'message' => true
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }
}
