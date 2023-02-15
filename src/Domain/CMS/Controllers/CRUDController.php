<?php

namespace Domain\CMS\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CRUDController extends Controller
{
    public function activeSwitch(Request $request): JsonResponse
    {
        $request->validate([
            'model' => 'required',
            'id' => 'required|integer',
            'active' => 'required',
        ]);

        DB::table($request->get('model'))
            ->where('id', $request->get('id'))
            ->update(['active' => filter_var($request->get('active'), FILTER_VALIDATE_BOOLEAN)]);

        return response()->json(['status' => $request->all()]);
    }

    public function updateSorting(Request $request): Response
    {
        $request->validate([
            'model' => 'required',
            'sorting' => 'required|array',
        ]);

        foreach ($request->get('sorting') as $sort => $id) {
            DB::table($request->get('model'))
                ->where('id', $id)
                ->update(['sort' => (int) $sort]);
        }

        return response()->noContent();
    }
}
