<?php

namespace App\Http\Controllers;

use App\Http\Requests\WithdrawalRequestRequest;
use App\Repositories\ActionRepository;
use App\Repositories\LeadingGroupRepository;
use App\Repositories\MarkRepository;
use App\Repositories\PersonRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Repositories\WithdrawalRequestRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DataTables;

class WithdrawalRequestController extends Controller
{
    protected $withdrawalRequestRepository, $userRepository, $personRepository,
        $markRepository, $leadingGroupRepository, $actionRepository;

    public function __construct(WithdrawalRequestRepository $withdrawalRequestRepository, 
        UserRepository $userRepository, PersonRepository $personRepository, 
        LeadingGroupRepository $leadingGroupRepository, MarkRepository $markRepository,
        ActionRepository $actionRepository
    )
    {
        $this->withdrawalRequestRepository = $withdrawalRequestRepository;
        $this->userRepository = $userRepository;
        $this->personRepository = $personRepository;
        $this->leadingGroupRepository = $leadingGroupRepository;
        $this->markRepository = $markRepository;
        $this->actionRepository = $actionRepository;
        $this->middleware('admin', ['only' => ['process']]);
    }

    public function indexNotProcessed(Request $request)
    {
        $user_id = Auth::id();
        $admin = $this->userRepository->getRole($user_id) === config('util.roles.admin')['role'];
        if ($request->ajax()) {
            $count = $this->withdrawalRequestRepository->whereClause([['processed', '=', false]])->count();
            $withdrawal_requests =  $admin ? $this->withdrawalRequestRepository->getAllNotProcessedByJoin() : $this->withdrawalRequestRepository->getAllNotProcessedOfUserByJoin($user_id);
            $datatable = $count > 0 ? DataTables::of($withdrawal_requests) : DataTables::of(array());
            if ($count > 0) {
                $datatable->addIndexColumn()
                ->addColumn('status', function ($row) {
                    return 'Non traité';
                })
                ->addColumn('processed_at', function ($row) {
                    return 'Non définie';
                });
                if ($admin) {
                    $datatable
                    ->addColumn('action', function ($row) {
                        $btn = "";
                        if (!is_null($row)) {
                            $btn .= '<a href="'. route('home') . '/espace-membres/demande-retrait/process/'. encrypt($row->id) .'/'. encrypt(true) .'" class="btn btn-info btn-block" onclick="return confirm(\'Êtes-vous sûr(e) de vouloir faire cette opération ?\')">Traiter</a>';
                        }
                        return $btn;
                    })->rawColumns(['action']);
                }
                return $datatable->make(true);
            }
        }

        return view('back-end.withdrawal-request.index_not_processed', compact('admin'));
    }

    public function indexProcessed(Request $request)
    {
        $user_id = Auth::id();
        $admin = $this->userRepository->getRole($user_id) === config('util.roles.admin')['role'];
        if ($request->ajax()) {
            $count = $this->withdrawalRequestRepository->whereClause([['processed', '=', true]])->count();
            $withdrawal_requests =  $admin ? $this->withdrawalRequestRepository->getAllProcessedByJoin() : $this->withdrawalRequestRepository->getAllProcessedOfUserByJoin($user_id);
            $datatable = $count > 0 ? DataTables::of($withdrawal_requests) : DataTables::of(array());
            if ($count > 0) {
                $datatable->addIndexColumn()
                    ->addColumn('status', function ($row) {
                        return 'Traité';
                    })
                    ->addColumn('processed_at', function ($row) {
                        return $row->processed_at;
                    });
                return $datatable->make(true);
            }
        }

        return view('back-end.withdrawal-request.index_processed', compact('admin'));
    }

    public function create(Request $request)
    {
        $leading_groups_data = $this->leadingGroupRepository->getAllActive();
        $leading_groups = array();
        foreach ($leading_groups_data as $item) {
            $leading_groups[encrypt($item->id)] = $item->name;
        }
        return view('back-end.withdrawal-request.create', compact('leading_groups'));
    }

    public function store(WithdrawalRequestRequest $request)
    {
        $user_id = Auth::id();
        if (!$this->personRepository->isTransactionPassword($user_id, $request->transaction_password)) {
            return back()->with([
                'error_transaction_password' => 'Mot de passe de transaction incorrect.'
            ]);
        }

        $request->merge(['claimant_id' => $user_id]);
        $request->merge(['leading_group_id' => intval(decrypt($request->leading_group_id))]);
        $this->withdrawalRequestRepository->store($request->all());

        $this->markRepository->store([
            'action_id' => $this->actionRepository->getByField('code', '#008')->id,
            'user_id' => Auth::id(),
            'description' => Auth::user()->pseudo . ' a formulé une demande de retrait !'
        ]);

        return redirect()->route('withdrawal-request.not_processed_history')->with([
            'success' => 'Votre demande de retrait a été transmise avec succès !'
        ]);
    }

    public function process(Request $request)
    {
        $withdrawal_request_id = decrypt($request->withdrawal_request_id);
        $process = decrypt($request->process);
        $this->withdrawalRequestRepository->update($withdrawal_request_id, [
            'processed' => $process,
            'processed_at' => Carbon::now()->format('y-m-d H:i:s')
        ]);
        $withdrawal_request = $this->withdrawalRequestRepository->getById($withdrawal_request_id);

        $this->personRepository->updateBalance($withdrawal_request->claimant_id);
        $this->markRepository->store([
            'action_id' => $this->actionRepository->getByField('code', ($process ? '#009' : '#010'))->id,
            'user_id' => Auth::id(),
            'description' => Auth::user()->pseudo . ' a '. ($process ? 'validé' : 'invalidé') .' une demande de retrait !'
        ]);

        return redirect()->route('withdrawal-request.processed_history')->with([
            'success' => 'La demande de retrait de '. $withdrawal_request->user->pseudo . ' a été ' . ($process ? 'validée' : 'invalidée') . ' avec succès !'
        ]);
    }
}
