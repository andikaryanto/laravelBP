<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Member\Hobby;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    /**
     * Create member
     *
     * @param Request $request
     * @return ResponseFactory
     */
    public function store(Request $request){
        DB::beginTransaction();
        try{
            $validated = $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'numeric'
            ]);

            $name = $request->name;
            $email = $request->email;
            $phone = $request->phone;

            $member = new Member();
            $member->name = $name;
            $member->email = $email;
            $member->phone = $phone;
            $member->validate()->save();

            $memberHobby = new Hobby();
            $memberHobby->member_id = $member->id;
            $memberHobby->name = $request->hobby_name;
            $memberHobby->save();

            DB::commit();

            return response()->json(['result' => $member], 201);
        } catch(QueryException $e){
            DB::rollBack();
            $message = $e->getMessage();
            $errors = null;

            return response()->json(
                [
                    'message' => $message,
                    'errors' => $errors
                ], 400);
        } catch(Exception $e){
            DB::rollBack();
            $message = $e->getMessage();
            $errors = null;
            if(isset($e->validator)){
                $errors[] = $e->validator->messages()->messages();
            }
            return response()->json(
                [
                    'message' => $message,
                    'errors' => $errors
                ], 400);
        }
    }

    /**
     * Get list data of user
     *
     * @return ResponseFactory
     */
    public function getAll(){
        $memberList = Member::all();
        return response()->json(['result' => $memberList], 200);
    }

    /**
     * Update a member
     *
     * @param Request $request
     * @param mixed $id
     * @return ResponseFactory
     */
    public function update(Request $request, $id){
        DB::beginTransaction();
        try{
            $member = Member::find($id);
            $member->name = $request->name;
            $member->email = $request->email;
            $member->phone = $request->phone;
            $member->save();
            DB::commit();
            return response()->json(['result' => $member], 201);
        } catch(Exception $e){
            DB::rollBack();
            return response()->json(
                [
                    'message' => $e->getMessage(),
                    'errors' => null
                ], 400);
        }
    }
}
