<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordChangeRequest;
use App\Http\Requests\RecordingRequest;
use App\Http\Requests\UpdateRecordingRequest;
use App\Jobs\BrowseGenealogy;
use App\Jobs\SetBonusesRecords;
use App\Mail\PasswordChanged;
use App\Mail\UserRecorded;
use App\Utils\Node;
use App\Repositories\ActionRepository;
use App\Repositories\CodeRepository;
use App\Repositories\MarkRepository;
use App\Repositories\PersonRepository;
use App\Repositories\RecordingTransactionRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DataTables;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\DB;

use App\Models\user;
use App\Models\BeParrain;

class NetworkController extends Controller
{
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
	$this->middleware('auth', ['except' => ['getRegisterForm', 'postRegisterForm']]);
	$this->middleware('admin', ['only' => ['getUsers', 'edit', 'update']]);
    }

    public function getRegisterForm(Request $request)
    {
        return view('back-end.network.record'. (Auth::check() ? '_auth' : '_guest'));
    }

    public function postRegisterForm(RecordingRequest $request)
    {
        // Vérification de l'existence du parrain
        // if (!$this->userRepository->exists('pseudo', $request->godfather_pseudo)) {
        //     return back()->with([
        //         'error_godfather_pseudo' => 'Aucun parrain ne possède ce pseudo'
        //     ])->withInput();
        // }


        // $findgodfather=0;

        // do{ 
        //     $godfather_as_user =DB::table('be_parrains')->select('parrain_id')->first();
        //         echo $godfather_as_user->parrain_id."<br>";

        //         if ($this->userRepository->isGodfatherHasTwoDirectGodsons($godfather_as_user->parrain_id)) {

        //            $deleted = DB::table('be_parrains')->where('parrain_id', '=', $godfather_as_user->parrain_id )->delete();
                
        //           } 
        //           else {
        //            $request->merge([
        //                'godfather_id' => $godfather_as_user->parrain_id
        //            ]);
        //            echo "votre parrain".$godfather_as_user->parrain_id;
        //            $findgodfather =1;
        //         }
        //    } while( $findgodfather==0);

        // Récupération du parrain dans la table users
        // $godfather_as_user = $this->userRepository->getByField('pseudo', $request->godfather_pseudo);

        // Vérification du parrain en tant que parrain avec 2 filleuls directs
        // if ($this->userRepository->isGodfatherHasTwoDirectGodsons($godfather_as_user->id)) {
        //     return back()->with([
        //         'error_godfather_pseudo' => 'Ce parrain a déjà deux filleuls'
        //     ])->withInput();
        // }

        // Vérification de l'existence du payeur
        // if (!$this->userRepository->exists('pseudo', $request->payer_pseudo)) {
        //     return back()->with([
        //         'error_payer_pseudo' => 'Aucun payeur ne possède ce pseudo'
        //     ])->withInput();
        // }

        // Récupération du payeur dans la table users
        // $payer_as_user = $this->userRepository->getByField('pseudo', $request->payer_pseudo);

        // Vérification du nombre de code du payeur
        // if ($payer_as_user->person->number_of_code < 1) {
        //     return back()->with([
        //         'error_payer_code' => 'Vous manquez de code pour procéder à cet enregistrement de filleul'
        //     ])->withInput();
        // }

        // Vérification de la justesse du mot de passe de transaction du payeur
        // if (!$this->personRepository->isTransactionPassword($payer_as_user->id, $request->payer_transaction_password)) {
        //     return back()->with([
        //         'error_payer_transaction_password' => 'Mot de passe de transaction du payeur incorrect.'
        //     ])->withInput();
        // }

        // Enregistrement du filleul
        $request->merge([
            'godfather_id' =>null
            // $godfather_as_user->parrain_id
        ]);
        $godson_as_user = $this->userRepository->store($request->all([
            'pseudo', 'email', 'password', 'godfather_id'
        ]));
        $request->merge([
            'user_id' => $godson_as_user->id
        ]);
        $godson_as_person = $this->personRepository->store($request->all([
            'last_name', 'first_name', 'country', 'transaction_password', 'user_id'
        ]));

         //Make this user be able to be a godfather
        //  DB::table('be_parrains')->insert([
        //     'parrain_id' => $godson_as_user->id
        //     ]);

        // Mis à jour du nombre de code du payeur
        // $payer_as_user->person->number_of_code -= 1;
        // $payer_as_user->person->save();

        $this->recordingTransactionRepository->store([
            'payer_id' => $godson_as_user->id,
            'recorded_id' => $godson_as_user->id,
            'amount' => config('util.recording_transaction_amount'),
            'month' => Carbon::now()->month,
        ]);

        // $this->markRepository->store([
        //     'action_id' => 7,
        //     'user_id' => $godson_as_user->id,
        //     'description' => $godson_as_user->pseudo . ' a ajouté le filleul ' . $request->pseudo . ' !'
        // ]);

        // Mail::to($request->email)->send(new UserRecorded([
        //     'pseudo' => $request->pseudo,
        //     'password' => $request->password,
        //     'transaction_password' => $request->transaction_password
        // ]));

        //Dispatching queues
        for ($i = 0; $i < 8; $i++) {
            SetBonusesRecords::dispatch(config('util.logs_folder'), 'gnl_b' . ($i + 1), config('util.logs_files_format'));
            BrowseGenealogy::dispatch(config('util.logs_folder'), 'gnl_n' . ($i + 1), config('util.logs_files_format'));
            SetBonusesRecords::dispatch(config('util.logs_folder'), 'gnl_b' . ($i + 1), config('util.logs_files_format'));
        }
        
 
        return redirect()->route('paynow', [$godson_as_user->id]);
        //return redirect()->route(Auth::check() ? 'dashboard' : 'network.register')->with('success', 'Filleul enregistré avec succès');
    }

    public function genealogy(Request $request)
    {
        # session(['active' => 'network-genealogy']);
        $godfather_user_id = decrypt($request->user_id);
        $root_user = $this->userRepository->getByField('id', $godfather_user_id);
        $tree = $this->userRepository->getGodsonsTreeUntilAGenerationOfAGodfather($godfather_user_id, 3);
        $root_genealogy_data = array();
        $root_node = new Node(
            $root_user->id,
            $root_user->pseudo,
            $root_user->person->level_label,
            $root_user->person->first_name,
            $root_user->person->last_name,
            $root_user->person->country,
            null
        );
        $this->appendDataToRootGenealogyData($root_genealogy_data, $this->assignRoot($root_node));
        foreach ($tree as $item) {
            $this->appendDataToRootGenealogyData($root_genealogy_data, $this->makeNode($item));
        }
        return view('back-end.network.genealogy', compact('root_genealogy_data'));
    }

    private function appendDataToRootGenealogyData(&$root_genealogy_data, Node $node)
    {
        $root_genealogy_data = array_merge(
            $root_genealogy_data,
            array(
                $node
            )
        );
    }

    private function makeNode($data)
    {
        return new Node(
            $data->id,
            $data->pseudo,
            $data->person->level_label,
            $data->person->first_name,
            $data->person->last_name,
            $data->person->country,
            $data->godfather_id
        );
    }

    private function assignRoot(Node $node)
    {
        unset($node->parent);
        return $node;
    }

    public function getPasswordChangeForm(Request $request)
    {
        $which_password = decrypt($request->which_password);
        return view('auth.passwords.change', compact('which_password'));
    }

    public function postPasswordChangeForm(PasswordChangeRequest $request)
    {
        $user = $request->user();
        if (decrypt($request->which_password) === 'password') {
            if (Hash::check($request->old_password, $this->userRepository->getPassword($user->id))) {
                $this->userRepository->update($user->id, [
                    'password' => $request->new_password
                ]);

                Mail::to($user->email)
                ->send(new PasswordChanged([
                    'which' => 'connexion',
                    'pseudo' => $user->pseudo,
                    'message' => 'Vous venez de changer votre mot de passe de connexion ! Contactez l\'administrateur en cliquant <a href="mailto:aide.globalnovalife@gmail.com">ici</a> si cette action n\'émane pas de vous !'
                ]));

                Auth::guard()->logout();

                return redirect()->route('login');
            }
            else {
                return back()->with([
                    'error_owner_password' => 'Ancien mot de passe de connexion incorrect.'
                ]);
            }
        }
        elseif (decrypt($request->which_password) === 'transaction') {
            if ($this->personRepository->isTransactionPassword($user->id, $request->old_password)) {
                $person_id = $this->personRepository->getByUserId($user->id)->id;
                $this->personRepository->update($person_id, [
                    'transaction_password' => $request->new_password
                ]);

                Mail::to($user->email)
                ->send(new PasswordChanged([
                    'which' => 'transaction',
                    'pseudo' => $user->pseudo,
                    'message' => 'Vous venez de changer votre mot de passe de transaction ! Contactez l\'administrateur en cliquant <a href="mailto:aide.globalnovalife@gmail.com">ici</a> si cette action n\'émane pas de vous !'
                ]));

                return redirect()->route('dashboard')->with([
                    'success' => 'Mot de passe de transaction changé avec succès !'
                ]);
            } else {
                return back()->with([
                    'error_owner_password' => 'Ancien mot de passe de transaction incorrect.'
                ]);
            }
        }
        else {
            return back();
        }
    }

    public function getUsers(Request $request)
    {
        if ($request->ajax()) {
            $users = $this->userRepository->getAllByJoin();
            return DataTables::of($users)
                ->setRowData([
                    'user_id' => function ($user) {
                        return $user->id;
                    }
                ])
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = "";
                    if (!is_null($row)) {
                        $btn .= '<a href="'.route('network.users.edit', ['id' => encrypt($row->user_id)]).'" class="edit-pseudo btn btn-warning btn-rounded btn-block"><i class="far fa-edit"></i> Modifier</a>';
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('back-end.network.user.index');
    }

    public function edit(Request $request)
    {
        $user = $this->userRepository->getByField('id', decrypt($request->id));

        return view('back-end.network.user.edit', compact('user'));
    }

    public function update(UpdateRecordingRequest $request)
    {
        $user = $this->userRepository->getByField('id', decrypt($request->id));
        $this->userRepository->update($user->id, $request->all(['pseudo', 'email', 'password']));
        $this->personRepository->update($user->person->id, $request->all([
            'last_name',
            'first_name',
            'country',
            'transaction_password'
        ]));

        return redirect()->route('network.users')->with('success', 'L\'utilisateur mis à jour a pour pseudo ``' . $request->pseudo . '`` !');
    }
}
