<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyCreateRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Mail\CompanyConfirmationMail;
use App\Models\Company;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CompanyController extends Controller
{
    // ensure that only admin user has access to the functions except for index
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->user()->hasRole('Admin')) {
                abort(403);
            }

            return $next($request);
        })->except(['index']);
    }

    public function index(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        // retrieve company data from database using pagination for 10 records
        $companies = Company::paginate(10);
        return view('companies.index', compact('companies'));
    }

    public function edit(string $id): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $company = Company::findOrFail($id);
        return view('companies.edit', compact('company'));
    }

    // data validation is done by CompanyUpdateRequest class
    public function update(CompanyUpdateRequest $request, string $id): RedirectResponse
    {
        $company = Company::findOrFail($id);

        // initialize $logoImagePath with the original value
        $logoImagePath = $company->logo_image_path;

        // if admin user choose the no logo option set $logoImagePath to null
        // else if there is an image file (logo_image) in request data save it with a unique id as filename in storage/app/public/images/company_logos
        if ($request->has('no_logo')) {
            $logoImagePath = null;
        } elseif ($request->hasFile('logo_image')) {
            $logoImage = $request->file('logo_image');
            $logoImagePath = $logoImage->storeAs('images/company_logos', uniqid() . '.' . $logoImage->getClientOriginalExtension(), 'public');
        }

        // save changes in database
        $company->name = $request->get('name');
        $company->email = $request->get('email');
        $company->logo_image_path = $logoImagePath;
        $company->website_url = $request->get('website_url');

        $company->save();

        return redirect()->route('companies.index')
            ->with('success', __('Company updated successfully!'));
    }

    public function create(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('companies.create');
    }

    // data validation is done by CompanyCreateRequest class
    public function store(CompanyCreateRequest $request): RedirectResponse
    {
        // if an image file (logo_image) is provided in request data save it with a unique id as filename in storage/app/public/images/company_logos
        if ($request->hasFile('logo_image')) {
            $logoImage = $request->file('logo_image');
            $logoImagePath = $logoImage->storeAs('images/company_logos', uniqid() . '.' . $logoImage->getClientOriginalExtension(), 'public');
        } else {
            $logoImagePath = null;
        }

        // save new company in database
        $company = new Company();

        $company->name = $request->get('name');
        $company->email = $request->get('email');
        $company->logo_image_path = $logoImagePath;
        $company->website_url = $request->get('website_url');

        $company->save();

        // try-catch for sending confirmation email
        try {
            if ($company->email) {
                Mail::to($company->email)->send(new CompanyConfirmationMail($company));
                $email_sent_text = __('Confirmation email is sent to the provided e-mail address.');
            } else {
                $email_sent_text = '';
            }
        } catch (\Exception $exception) {
            Log::error('Email sending failed: ' . $exception->getMessage());
            $email_sent_text = __('There was an error while sending the confirmation email.');
        }


        return redirect()->route('companies.index')
            ->with('success', __('Company created successfully!') . '<br>' . $email_sent_text);
    }

    public function destroy(string $id): RedirectResponse
    {
        $company = Company::findOrFail($id);
        $company->delete();

        return redirect()->route('companies.index')
            ->with('success', __('Company deleted successfully!'));
    }
}
