<?php

namespace App\Http\Controllers;

use App\Tutoria;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class TutoriaController extends AbsoluteController
{

	function __construct()
	{
		//parent::__construct();
	}


	/**
	 * @param Request $request
	 * @return JsonResponse
	 * internal es para uso futuro, para reciclar código
	 */
	public function getTutorias(Request $request, bool $intenal = false): JsonResponse
	{

		$tutorias = parent::unwrapArray((array)DB::table('tutorias')
			->select('id', 'user_id', 'tutor_id', 'type')
			->get());

		return response()->json($tutorias);
	}


	/**
	 * @param Request $request
	 * @return JsonResponse
	 */
	public function getTutoria(Request $request): JsonResponse
	{

		$request->validate([
			'id' => 'required|integer'
		]);

		$tutoria = DB::table('tutorias')
			->where('id', $request->id)
			->select('id', 'user_id', 'tutor_id', 'type')
			->get();

		if ($tutoria->count() > 0) {
			$tutoria = parent::unwrapArray((array)$tutoria);
		} else {
			return response()->json(['error' => 'Illegal ID'], 500);
		}

		return response()->json($tutoria);
	}

	/**
	 * @param Request $request
	 * @return JsonResponse
	 */
	public function getExpress(Request $request): JsonResponse
	{


		$tutoria = parent::unwrapArray((array)DB::table('tutorias')
			->where('type', 0)
			->select('id', 'user_id', 'tutor_id')
			->get());

		return response()->json($tutoria);
	}


	/**
	 * @param Request $request
	 * @return JsonResponse
	 */
	public function getRegular(Request $request): JsonResponse
	{


		$tutoria = parent::unwrapArray((array)DB::table('tutorias')
			->where('type', 1)
			->select('id', 'user_id', 'tutor_id')
			->get());

		return response()->json($tutoria);
	}



	/**
	 * @param Request $request
	 * @return JsonResponse
	 */
	public function setTutoria(Request $request): JsonResponse
	{

		$request->validate([
			'user_id' => 'required|integer',
			'tutor_id' => 'required|integer',
			'type' => 'required|integer'
		]);

		$user = $user = DB::table('users')
			->where([
				['isTutor', 0],
				['id', $request->user_id]
			])
			->select('id')
			->get();

		$tutor = $user = DB::table('users')
			->where([
				['isTutor', 1],
				['id', $request->tutor_id]
			])
			->select('id')
			->get();

		$type = $request->type;
		if ($type != 0 && $type != 1) {
			return response()->json(['error' => 'Illegal Type'], 500);
		}

		if ($user->count() > 0 && $tutor->count() > 0) {
			$relacion = Tutoria::firstOrCreate(
				['user_id' =>  $request->user_id, 'tutor_id' => $request->tutor_id, 'type_id' => $request->type]
			);
			return response()->json($relacion);
		}
		return response()->json(['error' => 'Illegal ID'], 500);
	}
}
