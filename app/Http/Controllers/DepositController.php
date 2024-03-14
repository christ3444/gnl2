<?php

namespace App\Http\Controllers;


use App\Repositories\ActionRepository;
use App\Repositories\CodeRepository;
use App\Repositories\MarkRepository;
use App\Repositories\PersonRepository;
use App\Repositories\RecordingTransactionRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Models\Deposit;
use App\Models\User;

use Illuminate\Support\Facades\DB;

class DepositController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



     protected $recordingTransactionRepository, $markRepository, $actionRepository,
     $codeRepository, $userRepository, $personRepository;

 public function __construct(RecordingTransactionRepository $recordingTransactionRepository,
     MarkRepository $markRepository, ActionRepository $actionRepository, 
     UserRepository $userRepository, CodeRepository $codeRepository,
     PersonRepository $personRepository
 )
 {
     $this->recordingTransactionRepository = $recordingTransactionRepository;
     $this->markRepository = $markRepository;
     $this->actionRepository = $actionRepository;
     $this->userRepository = $userRepository;
     $this->codeRepository = $codeRepository;
     $this->personRepository = $personRepository;
 
 }
    public function index()
    {
        $admin="admin";
        $somme=5000*Deposit::count('user_id');
        $deposits =0;
        return view('back-end.deposit.index',compact('admin','somme','deposits'));
    }

    public function paynow($id){
         return view('back-end.deposit.pay',compact('id'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        // find and chose a godfather Id for this user

        $user_id = $request->input('pseudo');


        $findgodfather=0;

        do{ 
            $godfather_as_user =DB::table('be_parrains')->select('parrain_id')->first();
                //echo $godfather_as_user->parrain_id."<br>";

                if ($this->userRepository->isGodfatherHasTwoDirectGodsons($godfather_as_user->parrain_id)) {

                   $deleted = DB::table('be_parrains')->where('parrain_id', '=', $godfather_as_user->parrain_id )->delete();
                
                  } 
                  else {
                   $request->merge([
                       'godfather_id' => $godfather_as_user->parrain_id
                   ]);
                   //echo "votre parrain".$godfather_as_user->parrain_id;
                   $findgodfather =1;
                }
           } while( $findgodfather==0);
        

            User::where('id', $user_id)->update(['godfather_id' => $godfather_as_user->parrain_id]);


        //Make this user be able to be a godfather
        DB::table('be_parrains')->insert([
            'parrain_id' => $user_id
            ]);

            DB::table('deposits')->insert([
                'user_id' => $user_id
                ]);


            return redirect()->route('login');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        echo $request->input('pseudo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
