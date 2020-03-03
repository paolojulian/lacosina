<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProcedureRequest;
use App\Procedure;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

/**
 * @api
 * @todo TODO - Select fields, transfer to service layer validations
 * BaseUrl: /procedures
 */
class ProceduresController extends Controller
{
    /**
     * [GET] - /
     * Retrieves all procedures
     */
    public function index(): Collection
    {
        return Procedure::all();
    }

    /**
     * [GET] - /{procedure}
     * Retrieves a procedure based on the passed id
     */
    public function details(Procedure $procedure): Procedure
    {
        return $procedure;
    }

    /**
     * [POST] - /
     * Save a procedure
     */
    public function store(StoreProcedureRequest $request): JsonResponse
    {
        $procedure = Procedure::create($request->validated());

        return response()->json($procedure, 201);
    }

    /**
     * [PUT] - /{procedure}
     * Updates the procedure
     */
    public function update(StoreProcedureRequest $request, Procedure $procedure): JsonResponse
    {
        $procedure->update($request->validated());

        return response()->json($procedure, 200);
    }

    /**
     * [DELETE] - /{procedure}
     * Delete a procedure
     */
    public function delete(Procedure $procedure): JsonResponse
    {
        $procedure->delete();

        return response()->json(null, 204);
    }
}
