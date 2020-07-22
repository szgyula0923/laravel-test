<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Contact;

use Carbon\Carbon;
use App\Mail\SendMail;
use App\Jobs\SendEmailJob;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactRequest;
use App\Http\Controllers\Api\Controller;

class ContactController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth:api');
        $this->middleware('admin:api')->except('store');
    }

    /**
     * GET
     * api/contacts
     * 
     * List all contacts.
     */

    public function index() 
    {
        return response()
            ->json([
                'success' => true,
                'message' => 'ok',
                'data'    => Contact::paginate(5)
            ], 200);
    }

    /**
     * POST
     * api/users
     * 
     * Save new contact
     * 
     * Example:
     *  {
     *      "phone": "+36301234567",
     *      "email": "nagysandor@gmail.com",
     *      "name": "Nagy Sándor",
     *      "message": "Egyszer volt, hol nem volt...",
     *      "website": "www.nagysandor.hu"
     *  }
     */

    public function store(ContactRequest $request)
    {
        $request->user()->contacts()->create($request->all());
        
        $submitter = $request->user();

        $users = User::where('admin', true)->orWhere('email', $submitter->email)->get();

        $data = array(
            'submitter_email' => $submitter->email,
            'info'            => 'Contact has been added successfully',
            'phone'           => $request->phone,
            'email'           => $request->email,
            'name'            => $request->name,
            'message'         => $request->message,
            'website'         => $request->website
        );

        $ii = 1;

        foreach ($users as $user)
        {
            $data['first_name'] = $user->first_name;
            $data['user_email'] = $user->email;
    
            //Mail::to($user->email)->send(new SendMail($data));

            // mailtrap.io...
            // Requested action not taken: too many emails per second
            //sleep(1);

            $job = (new SendEmailJob($user, $data))->delay(Carbon::now()->addSeconds(10 + ($ii++ * 5)));

            dispatch($job);
            //dispatch(new SendEmailJob($user, $data));
        }

        return response()
            ->json([
                'success' => true,
                'message' => 'Contact has been added successfully'
            ], 201);
    }
}
