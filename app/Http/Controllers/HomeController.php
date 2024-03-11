<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactFormSubmitted;
use App\Repositories\CodeRepository;
use App\Repositories\MarkRepository;
use App\Repositories\NewsletterRepository;
use App\Repositories\RecordingTransactionRepository;
use App\Repositories\UserRepository;
use App\Repositories\WithdrawalRequestRepository;
use App\Utils\GenealogyDataManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Newsletter;

class HomeController extends Controller
{
    protected $codeRepository, $userRepository, $recordingTransactionRepository, 
        $withdrawalRequestRepository, $newsletterRepository, $markRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        CodeRepository $codeRepository, UserRepository $userRepository,
        RecordingTransactionRepository $recordingTransactionRepository,
        WithdrawalRequestRepository $withdrawalRequestRepository, 
        NewsletterRepository $newsletterRepository,
        MarkRepository $markRepository
    )
    {
        $this->codeRepository = $codeRepository;
        $this->userRepository = $userRepository;
        $this->recordingTransactionRepository = $recordingTransactionRepository;
        $this->withdrawalRequestRepository = $withdrawalRequestRepository;
        $this->newsletterRepository = $newsletterRepository;
        $this->markRepository = $markRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\8000\Support\Renderable
     */
    public function dashboard(/*GenealogyDataManager $manager*/)
    {
        $user = $this->userRepository->getByField('id', Auth::id());
        $my_codes = $user->person->number_of_code;
        $my_balance = $user->person->balance;
        $my_recordings = $this->recordingTransactionRepository->getPayerRecordingCount($user->id);
        $my_level = $user->person->level_label;
        $my_recordings_traces = $this->recordingTransactionRepository->getARecorderCertainAmount($user->id, 5);
        $flagship_members = $this->userRepository->take(5);
/*      $marks = $this->markRepository->take(5);
        $level_stats = $manager->getLevelStatsData();
        $recording_stats = $manager->getRecordingStatsData();
*/
        return view(
            'back-end.dashboard', 
            compact(
                'my_codes', 'my_balance', 'my_recordings', 'my_level', 
                'my_recordings_traces', 'flagship_members'/*,
                'marks', 'level_stats', 'recording_stats'*/
            )
        );
    }

    /**
     * Show the application home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        return view('front-end.index');
    }

    /**
     * Show the application contact page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function postContactForm(ContactRequest $request)
    {
        Mail::to(env('MAIL_CONTACT_ADDRESS'))->send(new ContactFormSubmitted($request->all()));

        return redirect('/#contact-us')->with([
            'success' => 'Votre message a bien été reçu, Nous vous contacterons très bientôt !'
        ]);
    }

    /**
     * Store newsletter email to database.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function postNewsletterForm(Request $request)
    {
        if (!Newsletter::isSubscribed($request->newsletter_email)) {
            $this->newsletterRepository->store(['email' => $request->newsletter_email]);
            Newsletter::subscribePending($request->newsletter_email);
            return redirect('/#newsletter')->with('success', 'Merci pour la souscription ! Consultez votre boîte mail, vous recevrez un mail dont le sujet est "MLM: Please Confirm Subscription". Veuillez confirmer après ouverture du mail, merci !');
        }
        return redirect('/#newsletter')->with('error', 'Désolé ! Vous êtes déjà abonné.');
    }

    public function subscribeAllOfTable(Request $request)
    {
        $records = $this->newsletterRepository->getAll();
        $parcoured = 0;
        foreach ($records as $record) {
            if (!Newsletter::isSubscribed($record->email)) {
                $parcoured++;
                Newsletter::subscribePending($record->email);
            }            
        }
        return redirect('/#newsletter')->with('success', ($this->newsletterRepository->getTableCount() == $parcoured));
    }

}
