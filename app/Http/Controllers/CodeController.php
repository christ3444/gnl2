<?php

namespace App\Http\Controllers;

use App\Http\Requests\CodeGenerateRequest;
use App\Http\Requests\CodeTransferRequest;
use App\Repositories\ActionRepository;
use App\Repositories\CodeRepository;
use App\Repositories\CodeTransferRepository;
use App\Repositories\MarkRepository;
use App\Repositories\PersonRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;

class CodeController extends Controller
{
    protected $codeRepository, $personRepository, $codeTransferRepository, $userRepository,
        $actionRepository, $markRepository;

    public function __construct(
        CodeRepository $codeRepository, PersonRepository $personRepository,
        CodeTransferRepository $codeTransferRepository, UserRepository $userRepository,
        MarkRepository $markRepository, ActionRepository $actionRepository
    )
    {
        $this->codeRepository = $codeRepository;
        $this->personRepository = $personRepository;
        $this->codeTransferRepository = $codeTransferRepository;
        $this->userRepository = $userRepository;
        $this->markRepository = $markRepository;
        $this->actionRepository = $actionRepository;
        $this->middleware('admin', [
            'only' => ['indexGeneration', 'getGenerationForm', 'postGenerationForm']
        ]);
    }

    public function indexGeneration(Request $request)
    {
        if ($request->ajax()) {
            $count = $this->markRepository->whereClause([['action_id', '=', config('util.mark_actions')[0]['id']]])->count();
            $codes = $this->codeRepository->getAnAdminGenerationRecords();
            $datatable = $count > 0 ? Datatables::of($codes) : Datatables::of([]);
            if ($count > 0) {
                $datatable
                ->addIndexColumn();
            }
            return $datatable->make(true);
        }

        return view('back-end.code.list');
    }

    public function getGenerationForm(Request $request)
    {
        return view('back-end.code.create');
    }

    public function postGenerationForm(CodeGenerateRequest $request)
    {
        $user_id = Auth::id();
        if (!$this->personRepository->isTransactionPassword($user_id, $request->transaction_password)) {
            return redirect()->back()->with([
                'error_transaction_password' => 'Mot de passe de transaction incorrect.'
            ])->withInput();
        }

        if ($this->codeRepository->generateCodes($user_id, $request->amount)) {
            $this->markRepository->store([
                'action_id' => config('util.mark_actions')[0]['id'],
                'user_id' => Auth::id(),
                'description' => $request->amount
            ]);

            return redirect()->route('code.list')->with([
                'success' => $request->amount .' codes générés avec succès !'
            ]);
        }

        return redirect()->route('code.list')->with([
            'error' => 'Vous n\'êtes pas habilité à faire cette opération !'
        ]);
    }

    public function getCodeTransferForm(Request $request)
    {
        return view('back-end.code.transfer');
    }

    public function postCodeTransferForm(CodeTransferRequest $request)
    {
        if (!$this->userRepository->exists('pseudo', $request->recever_pseudo)) {
            return back()->with([
                'error_recever_pseudo' => 'Aucun utilisateur affilié à ce pseudo.'
            ])->withInput();
        }

        $sender_id = Auth::id();
        if (!$this->personRepository->isTransactionPassword($sender_id, $request->transaction_password)) {
            return back()->with([
                'error_transaction_password' => 'Mot de passe de transaction incorrect.'
            ])->withInput();
        }

        $sender_as_person = $this->personRepository->getByUserId($sender_id);
        if ($sender_as_person->number_of_code < $request->amount) {
            return back()->with([
                'error_amount' => 'Il ne vous reste que '. $sender_as_person->number_of_code .' codes.'
            ])->withInput();
        }

        $recever = $this->userRepository->getByField('pseudo', $request->recever_pseudo);
        if ($this->codeRepository->transferCode($sender_id, $recever->id, $request->amount)) {
            $this->markRepository->store([
                'action_id' => $this->actionRepository->getByField('code', '#002')->id,
                'user_id' => Auth::id(),
                'description' => Auth::user()->pseudo . ' a transféré ' . $request->amount . ' codes à '. $request->recever_pseudo .' !'
            ]);

            return redirect()->route('code.transfer-history')->with([
                'success' => $request->amount . ' codes transférés à '. $request->recever_pseudo .' avec succès !'
            ]);
        }

        return redirect()->route('code.transfer-history')->with([
            'error' => 'Une erreur est survenue, veuillez le notifier à un administrateur !'
        ]);
    }

    public function historyOfCodeTransfer(Request $request)
    {
        $user_id = Auth::id();
        $is_admin = $this->userRepository->getRole($user_id) === config('util.roles.admin')['role'];

        if ($request->ajax()) {
            $histories =  $is_admin ? $this->codeTransferRepository->getAll() : $this->codeTransferRepository->getAllOfUserAsSender($user_id);
            $count = $this->codeTransferRepository->getTableCount();
            $datatable = $count > 0 ? Datatables::of($histories) : Datatables::of([]);
            if ($count > 0) {
                $datatable->addIndexColumn();
            }
            return $datatable->make(true);
        }

        return view('back-end.code.transfer_history', compact('is_admin'));
    }
}
