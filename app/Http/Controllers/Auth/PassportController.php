<?php


namespace App\Http\Controllers\Auth;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PassportController extends Controller
{
	/**
	 * @param Request $request
	 *
	 * @return JsonResponse
	 */
	public function signup(Request $request)
	{
		$request->validate([
			'name' => 'required|string',
			'email' => 'required|string|email|unique:users',
			'password' => 'required|string|confirmed'
		]);

		User::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => bcrypt($request->password)
		]);

		return response()->json(['message' => 'Successfully created user!'], 201);
	}

	/**
	 * Login user and create token
	 *
	 * @param Request $request
	 *
	 * @return JsonResponse
	 */
	public function login(Request $request)
	{
		$request->validate([
			'email' => 'required|string|email',
			'password' => 'required|string',
			'remember_me' => 'boolean'
		]);

		$credentials = request(['email', 'password']);

		if (!Auth::attempt($credentials)) {
			return response()->json(['message' => 'Unauthorized'], 401);
		}

		$user = $request->user();
		$tokenResult = $user->createToken('Personal Access Token');
		$token = $tokenResult->token;

		if ($request->remember_me) {
			$token->expires_at = Carbon::now()->addWeeks(1);
		}
		$token->save();

		return response()->json([
			'access_token' => $tokenResult->accessToken,
			'token_type' => 'Bearer',
			'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
		]);
	}

	/**
	 * Redirect the User to the Dashboard tokens page
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function tokens()
	{
		return view('auth.tokens');
	}
}
