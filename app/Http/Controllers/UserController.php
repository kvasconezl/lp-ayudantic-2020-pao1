<?php

namespace App\Http\Controllers;

use App\User;
use App\UserTutor;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class UserController extends AbsoluteController{

	function __construct(){
		//parent::__construct();
	}

	/**
	 * @param Request $request
	 * @return JsonResponse
	 * internal es para uso futuro, para reciclar código
	 */
	public function getAlumnos(Request $request, bool $intenal=false): JsonResponse {

		$users = parent::unwrapArray((array)DB::table('users')
				->where('isTutor', 0)
				->select('id', 'name', 'email')
				->get());

		return response()->json($users);
	}

	/**
	 * @param Request $request
	 * @return JsonResponse
	 */
	public function getAlumno(Request $request): JsonResponse {

		$request->validate([
			'id' => 'required|integer' 
		]);

		$user = DB::table('users')
				->where([['isTutor', 0],
						['id', $request->id]])
				->select('id', 'name', 'email')
				->get();

		if ($user->count() > 0){
			$user = parent::unwrapArray((array)$user);
		} else {
			return response()->json(['error' => 'Illegal ID'], 500);
		}

		return response()->json($user);
	}


	/**
	 * @param Request $request
	 * @return JsonResponse
	 * internal es para uso futuro, para reciclar código
	 */
	public function getTutores(Request $request, bool $intenal=false): JsonResponse {

		$users = parent::unwrapArray((array)DB::table('users')
				->where('isTutor', 1)
				->select('id', 'name', 'email')
				->get());

		return response()->json($users);
	}

	/**
	 * @param Request $request
	 * @return JsonResponse
	 */
	public function getTutor(Request $request): JsonResponse {

		$request->validate([
			'id' => 'required|integer' 
		]);

		$user = DB::table('users')
				->where([['isTutor', 1],
						['id', $request->id]])
				->select('id', 'name', 'email')
				->get();

		if ($user->count() > 0){
			$user = parent::unwrapArray((array)$user);
		} else {
			return response()->json(['error' => 'Illegal ID'], 500);
		}

		return response()->json($user);
	}

	/**
	 * @param Request $request
	 * @return JsonResponse
	 */
	public function setPreferido(Request $request): JsonResponse {

		$request->validate([
			'user_id' => 'required|integer',
			'tutor_id' => 'required|integer'
		]);

		$user = $user = DB::table('users')
				->where([['isTutor', 0],
						['id', $request->user_id]])
				->select('id', 'name', 'email')
				->get();
		$tutor = $user = DB::table('users')
				->where([['isTutor', 1],
						['id', $request->tutor_id]])
				->select('id', 'name', 'email')
				->get();

		if ($user->count() > 0 && $tutor->count() > 0){
			$relacion = UserTutor::firstOrCreate(
			    ['user_id' =>  $request->user_id,
			    'tutor_id' => $request->tutor_id]
			);
			return response()->json($relacion);
		}
		return response()->json(['error' => 'Illegal ID'], 500);
	}
}
