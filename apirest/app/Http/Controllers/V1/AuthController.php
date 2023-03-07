<?php
namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use JWTAuth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Closure;


class AuthController extends Controller
{

    public function index()
    {
        //Listamos todos los user
        return User::get();
    }
    //Función que utilizaremos para registrar al usuario
    public function register(Request $request)
    {
        //Indicamos que solo queremos recibir name, email y password de la request
        $data = $request->only('name', 'firstName','lastName','birthday','address','phone','email', 'password','hotelRole_id','hotelStatusEntity_id');
        //Realizamos las validaciones
        $validator = Validator::make($data, [
            'name' => 'required|string|min:3|max:50',
            'firstName'=>'required|min:3|max:50',
            'lastName'=>'required|min:3|max:50',
            'birthday'=>'required|date',
            'address'=>'required|min:3|max:100',
            'phone'=>'required|min:3|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:50',
            'hotelRole_id'=>'required',
            'hotelStatusEntity_id'=>'required',
            
        ]);
        //Devolvemos un error si fallan las validaciones
        if ($validator->fails()) {
            
            return $this->sendError('Validation Error.', $validator->errors(),401);
            //return response()->json(['error' => $validator->messages()], 400);
        }
        //Creamos el nuevo usuario
        $user = User::create([
            'name' => $request->name,
            'firstName'=>$request->firstName,
            'lastName'=>$request->lastName,
            'birthday'=>$request->birthday,
		    'address'=>$request->address,
		    'phone'=>$request->phone,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'hotelRole_id'=>$request->hotelRole_id,
		    'hotelStatusEntity_id'=>$request->hotelStatusEntity_id,
        ]);
        //Nos guardamos el usuario y la contraseña para realizar la petición de token a JWTAuth
        $credentials = $request->only('email', 'password');
        //Devolvemos la respuesta con el token del usuario
        return $this->sendResponse(Auth::user(),$token);

       /* return response()->json([
            'message' => 'User created',
            'token' => JWTAuth::attempt($credentials),
            'user' => $user
        ], Response::HTTP_OK);*/
    }
    public function update(Request $request, $id)
    {
        
        //Validamos que se nos envie el token
        $validator = Validator::make($request->header('token'), [
            'token' => 'required'
        ]);
        //Si falla la validación
        if ($validator->fails()) {
            return $this->sendError('Authenticate Error.', $validator->messages(),401);
            //return response()->json(['error' => $validator->messages()], 400);
        }
        try {
             //Indicamos que solo queremos recibir name, email y password de la request
        $data = $request->all();
        //Realizamos las validaciones
        $validator = Validator::make($data, [
            'name' => 'required|string|min:3|max:50',
            'firstName'=>'required|min:3|max:50',
            'lastName'=>'required|min:3|max:50',
            'birthday'=>'required|date',
            'address'=>'required|min:3|max:100',
            'phone'=>'required|min:3|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:50',
            'hotelRole_id'=>'required',
            'hotelStatusEntity_id'=>'required',
            
        ]);
        //Devolvemos un error si fallan las validaciones
        if ($validator->fails()) {
            return $this->sendError('Authenticate Error.', $validator->messages(),401);
            
            //return response()->json(['error' => $validator->messages()], 400);
        }
        //Buscamos el usuario
        $user = User::findOrfail($id);
        //Actualizamos el usuario.
        $user->create([
            'name' => $request->name,
            'firstName'=>$request->firstName,
            'lastName'=>$request->lastName,
            'birthday'=>$request->birthday,
		    'address'=>$request->address,
		    'phone'=>$request->phone,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'hotelRole_id'=>$request->hotelRole_id,
		    'hotelStatusEntity_id'=>$request->hotelStatusEntity_id,
        ]);
        
        
        //Devolvemos los datos actualizados.
        return $this->sendResponse('user updated successfully',$user);

        /*return response()->json([
            'message' => 'user updated successfully',
            'data' => $user
        ], Response::HTTP_OK);*/


        } catch (JWTException $exception) {
            //Error chungo

            return $this->sendError('Error : ',Response::HTTP_INTERNAL_SERVER_ERROR,500);
            /*return response()->json([
                'success' => false,
                'message' => 'Error'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);*/
        }

       
    }
    
    //Funcion que utilizaremos para hacer login
    public function authenticate(Request $request)
    {
        //Indicamos que solo queremos recibir email y password de la request
        //$credentials = $request->only('email', 'password');
        //$credentials = ($request);

        $credentialsE = $request->header('email');
        $credentialsP = $request->header('password');

        $credentials =[
            'email' => $credentialsE,
            'password'=>$credentialsP
        ];

        //return $credentials;
        if(!$credentials){
            return $this->sendError('Authenticate.', "Email null is required",401);  
        }
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:50'
        ]);

        //Devolvemos un error de validación en caso de fallo en las verificaciones
        if ($validator->fails()) {
            return $this->sendError('Authenticate Error.', $validator->messages(),401);
            //return response()->json(['error' => $validator->messages()], 400);
        }
        //Intentamos hacer login
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                //Credenciales incorrectas.
                /*return response()->json([
                    'message' => 'Login failed',
                ], 401);*/
                return $this->sendError('Authenticate.', "Login Failed ",401);
            
            }
        } catch (JWTException $e) {
            //Error chungo
            /*return response()->json([
                'message' => 'Error',
            ], 500);*/
            return $this->sendError('Error : ',$e,500);
            
        }
        //Devolvemos el token
        return $this->sendResponse(Auth::user(),$token);
        /*return response()->json([
            'token' => $token,
            'user' => Auth::user()
        ]);*/
    }
    //Función que utilizaremos para eliminar el token y desconectar al usuario
    
    public function logout(Request $request)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            JWTAuth::invalidate(JWTAuth::getToken());
            return $this->sendResponse(true,'Logout successful');

        } catch (JWTException $exception) {
            return $this->sendError('Error : ','Sorry, the user cannot be logged out',500);
           
        }
    }//Función que utilizaremos para obtener los datos del usuario y validar si el token a expirado.
    public function show(Request $request, $id)
    {
        
         //Validamos que se nos envie el token
         $validator = Validator::make($request->header('token'), [
            'token' => 'required'
        ]);

        //Si falla la validación
        if ($validator->fails()) {
            return $this->sendError('Authenticate Error.', $validator->messages(),401);
            //return response()->json(['error' => $validator->messages()], 400);
        }
        try {
            $user = User::findOrfail($id);
            return $this->sendResponse($user,'usuario');
           
        } catch (JWTException $exception) {
            //Error chungo

            return $this->sendError('Error : ',Response::HTTP_INTERNAL_SERVER_ERROR,500);
            /*return response()->json([
                'success' => false,
                'message' => 'Error'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);*/
        }
        //Validamos que la request tenga el token
       /* $this->validate($request, [
            'token' => 'required'
        ]);
        //Realizamos la autentificación
        $user = JWTAuth::authenticate($request->token);
        //Si no hay usuario es que el token no es valido o que ha expirado
        if(!$user)
            return $this->sendError('Authenticate.', 'Invalid token / token expired',401);
           /* return response()->json([
                'message' => 'Invalid token / token expired',
            ], 401);*/
        //Devolvemos los datos del usuario si todo va bien.*/ 
        //$user = User::findOrfail($id);
        //return $this->sendResponse("User",$user);
        //return response()->json(['user' => $user]);
    }

    public function destroy($id)
    {
        //Buscamos el usuario
        $user = User::findOrfail($id);
        //Eliminamos el producto
        $user->delete();
        //Devolvemos la respuesta
        return $this->sendResponse('user deleted successfully',Response::HTTP_OK);
        /*return response()->json([
            'message' => 'user deleted successfully'
        ], Response::HTTP_OK);*/
    }
}


//BaseController
//nombre de la ruta| descripcion |parametros 