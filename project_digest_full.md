# Project Digest (Full Content)
_Generated: 2026-02-09 14:10:30_
**Root:** D:\Laragon\www\epokir


## Struktur Proyek (filtered, no depth limit)
```
.git
app
bootstrap
config
database
node_modules
public
resources
routes
storage
tests
vendor
.editorconfig
.env
.env.example
.gitattributes
.gitignore
artisan
composer.json
composer.lock
digest.ps1
package-lock.json
package.json
phpunit.xml
postcss.config.js
project_digest_full.md
README.md
tailwind.config.js
vite.config.js
app\Console
app\Http
app\Models
app\Providers
app\View
app\Console\Commands
app\Console\Commands\TestApiConnection.php
app\Http\Controllers
app\Http\Requests
app\Http\Controllers\Auth
app\Http\Controllers\AiController.php
app\Http\Controllers\Controller.php
app\Http\Controllers\DashboardController.php
app\Http\Controllers\MasterController.php
app\Http\Controllers\PlanController.php
app\Http\Controllers\PokirController.php
app\Http\Controllers\ProfileController.php
app\Http\Controllers\ResesController.php
app\Http\Controllers\Auth\AuthenticatedSessionController.php
app\Http\Controllers\Auth\ConfirmablePasswordController.php
app\Http\Controllers\Auth\EmailVerificationNotificationController.php
app\Http\Controllers\Auth\EmailVerificationPromptController.php
app\Http\Controllers\Auth\NewPasswordController.php
app\Http\Controllers\Auth\PasswordController.php
app\Http\Controllers\Auth\PasswordResetLinkController.php
app\Http\Controllers\Auth\RegisteredUserController.php
app\Http\Controllers\Auth\VerifyEmailController.php
app\Http\Requests\Auth
app\Http\Requests\ProfileUpdateRequest.php
app\Http\Requests\Auth\LoginRequest.php
app\Models\Aleg.php
app\Models\Kategori.php
app\Models\Opd.php
app\Models\Pokir.php
app\Models\PokirPlan.php
app\Models\User.php
app\Providers\AppServiceProvider.php
app\View\Components
app\View\Components\AppLayout.php
app\View\Components\GuestLayout.php
bootstrap\cache
bootstrap\app.php
bootstrap\providers.php
bootstrap\cache\.gitignore
bootstrap\cache\packages.php
bootstrap\cache\services.php
config\app.php
config\auth.php
config\cache.php
config\database.php
config\filesystems.php
config\logging.php
config\mail.php
config\queue.php
config\services.php
config\session.php
database\factories
database\migrations
database\seeders
database\.gitignore
database\factories\UserFactory.php
database\migrations\0001_01_01_000000_create_users_table.php
database\migrations\0001_01_01_000001_create_cache_table.php
database\migrations\0001_01_01_000002_create_jobs_table.php
database\migrations\2025_12_07_115824_create_pokirs_table.php
database\migrations\2025_12_07_145925_create_alegs_table.php
database\migrations\2025_12_07_145925_create_opds_table.php
database\migrations\2025_12_07_145927_create_kategoris_table.php
database\migrations\2025_12_09_114333_create_pokir_plans_table.php
database\seeders\DatabaseSeeder.php
public\build
public\images
public\js
public\.htaccess
public\favicon.ico
public\index.php
public\robots.txt
public\images\logo-golkar.png
public\js\reses-logic.js
resources\css
resources\js
resources\views
resources\css\app.css
resources\js\app.js
resources\js\bootstrap.js
resources\views\auth
resources\views\components
resources\views\layouts
resources\views\master
resources\views\plan
resources\views\pokir
resources\views\profile
resources\views\reses
resources\views\dashboard.blade.php
resources\views\welcome.blade.php
resources\views\auth\confirm-password.blade.php
resources\views\auth\forgot-password.blade.php
resources\views\auth\login.blade.php
resources\views\auth\register.blade.php
resources\views\auth\reset-password.blade.php
resources\views\auth\verify-email.blade.php
resources\views\components\application-logo.blade.php
resources\views\components\auth-session-status.blade.php
resources\views\components\danger-button.blade.php
resources\views\components\dropdown-link.blade.php
resources\views\components\dropdown.blade.php
resources\views\components\input-error.blade.php
resources\views\components\input-label.blade.php
resources\views\components\modal.blade.php
resources\views\components\nav-link.blade.php
resources\views\components\primary-button.blade.php
resources\views\components\responsive-nav-link.blade.php
resources\views\components\secondary-button.blade.php
resources\views\components\text-input.blade.php
resources\views\layouts\app.blade.php
resources\views\layouts\guest.blade.php
resources\views\layouts\navigation.blade.php
resources\views\master\index.blade.php
resources\views\plan\index.blade.php
resources\views\pokir\create-bulk.blade.php
resources\views\pokir\create.blade.php
resources\views\pokir\index.blade.php
resources\views\pokir\print.blade.php
resources\views\profile\partials
resources\views\profile\edit.blade.php
resources\views\profile\partials\delete-user-form.blade.php
resources\views\profile\partials\update-password-form.blade.php
resources\views\profile\partials\update-profile-information-form.blade.php
resources\views\reses\index.blade.php
resources\views\reses\pdf.blade.php
routes\auth.php
routes\console.php
routes\web.php
storage\app
storage\debugbar
storage\framework
storage\logs
storage\app\private
storage\app\public
storage\app\.gitignore
storage\app\template_pokir.xlsx
storage\app\private\.gitignore
storage\app\public\.gitignore
storage\framework\cache
storage\framework\sessions
storage\framework\testing
storage\framework\views
storage\framework\.gitignore
storage\framework\cache\data
storage\framework\cache\.gitignore
storage\framework\cache\data\.gitignore
storage\framework\sessions\.gitignore
storage\framework\testing\.gitignore
storage\framework\views\.gitignore
storage\framework\views\02062740613d03fe7be09cc1264dab53.php
storage\framework\views\051c70b37c990c0a5d805b26b9498063.php
storage\framework\views\0bfa2b904ef70772992dcd9ffd2cb9b5.php
storage\framework\views\116456d540792b2eeadc1b2c1b19d4a7.php
storage\framework\views\144f5084c6a2901684ab21148e0be895.php
storage\framework\views\14578d3442a7557320483a4a23ac56a8.php
storage\framework\views\199dbf8e25fe38d6449cb2356933624f.php
storage\framework\views\1adcc5d13e534ea1bf3310f65b0a1930.php
storage\framework\views\1b4aa595219f4584b2cc405891289cc2.php
storage\framework\views\224a1dae11c57395436e4ff02823bd39.php
storage\framework\views\249960dcd7930b32b39d972bdafe334b.php
storage\framework\views\28d666e3906ae26441b72e5d9ef5666e.php
storage\framework\views\34db34aa1570087a37b56c9ed91bf7e4.php
storage\framework\views\375fa89afec6f9dd2ca560d0b34e3a80.php
storage\framework\views\4123882327798f38539a456e7a9c7f7a.php
storage\framework\views\42ca00058ce0a7e54a679059004952cd.php
storage\framework\views\45482aeee06414af66a5f6d815e9a52d.php
storage\framework\views\45b792433c06e88cd89d3cb2049a46c2.php
storage\framework\views\4ea2ed6b5230bfb995a3d34e268ddbd0.php
storage\framework\views\502e3b2f5905cb215f70374f2ef5989c.php
storage\framework\views\55dbf29760b44555b07174c425be7b64.php
storage\framework\views\5ef96d53b2546f1c0e71867a7242b518.php
storage\framework\views\63fdb53e74d925c52d4b43615909b6c1.php
storage\framework\views\6861c9e7ef080bce93a9aca87d5ba048.php
storage\framework\views\745ee9128d301fdf1366e95d1f04ad67.php
storage\framework\views\759e25983fad0579ba835ca56d540ffd.php
storage\framework\views\7889413d5bfda6a27abe51fe6b079557.php
storage\framework\views\8139428df38ce35134dcc590981d2945.php
storage\framework\views\81af27648c32262fdabead69b4de37f8.php
storage\framework\views\8439fdaa8f3a205e10bf8ca2ad7d1b5b.php
storage\framework\views\85abf7e1f6b04c934e2b927eb9333cf8.php
storage\framework\views\87f0b633522fcc04aecab2fa46a6d3af.php
storage\framework\views\8b52d7a3ce7614c4daa3c4be284fe4bf.php
storage\framework\views\8be15b6da9e6be1f105aeb1095396be3.php
storage\framework\views\8d2e60f2ecd29fd5cd058314f29027de.php
storage\framework\views\90228a72e5d9d36eaf3a1fba1aa2d3b2.php
storage\framework\views\9396e709f23ef558ea9905169cbd16a5.php
storage\framework\views\948b243d5e5a188ca0834cdfb1a390bc.php
storage\framework\views\9504db4962b4a63d45d4113b48141d2e.php
storage\framework\views\9c3b8510570f758b48a453e4fed58dea.php
storage\framework\views\9c848969092d0079f5aef6124893e0c5.php
storage\framework\views\a392e105b990cdb414a158a7ee88b3ef.php
storage\framework\views\a84fb51111e087d2d57e3d09f77abb80.php
storage\framework\views\a8905b63217519a283db2e1421f23763.php
storage\framework\views\a94df3b71a5d7cea030b570a44c8829b.php
storage\framework\views\b1a6880a6651e4e432907fa92b5bf970.php
storage\framework\views\b41192ade8fe5ac0fe26cca2797a95c8.php
storage\framework\views\bbaa67c3179bf330628834f5ef85890a.php
storage\framework\views\c15fcec8e21df0dee381a5df2e2fccd8.php
storage\framework\views\c209a3e7c9d90b2b8e75a653b1685c1d.php
storage\framework\views\c32bf7048f3d5419567207e289e144b4.php
storage\framework\views\c787b55564b56ee226f06e6642a20068.php
storage\framework\views\d07ca34fbc1a1fef5c35b2e4b6615331.php
storage\framework\views\d4a54683cf124374e7f95a5f970d2e14.php
storage\framework\views\def741140cb062e1e68ebcb3a746b6f4.php
storage\framework\views\e04a59d99a9412323db2749af9bc7f50.php
storage\framework\views\e2cec13b25537392954dd8040aae0cd8.php
storage\framework\views\e9b8d690b4a299b6d29c8e1980c39b8f.php
storage\framework\views\ef4929aed0307f40e62abaf3def631f7.php
storage\framework\views\f25c6657be2f9f7c223d5d04471861ad.php
storage\framework\views\fc16e119116747b2220c8724135fac51.php
storage\framework\views\ff6bae976704fa62120d288bddae83d6.php
tests\Feature
tests\Unit
tests\TestCase.php
tests\Feature\Auth
tests\Feature\ExampleTest.php
tests\Feature\ProfileTest.php
tests\Feature\Auth\AuthenticationTest.php
tests\Feature\Auth\EmailVerificationTest.php
tests\Feature\Auth\PasswordConfirmationTest.php
tests\Feature\Auth\PasswordResetTest.php
tests\Feature\Auth\PasswordUpdateTest.php
tests\Feature\Auth\RegistrationTest.php
tests\Unit\ExampleTest.php
```


## Info Git
```
Remote:
origin	https://github.com/frhanp/epokir.git (fetch)
origin	https://github.com/frhanp/epokir.git (push)

Branch:
main

Last 5 commits:
9e21eaa add fitur opsi di header spj
51c07d3 fix spj reses
a6d1879 fix reses tahap 1
43f3f32 commit sebelum fitur reses
12d3fef add pagu
```


## Dependencies (summary)
```
composer.json (require):
  (parse error / none)
composer.json (require-dev):
  (parse error / none)

package.json (dependencies):
  (parse error / none)
package.json (devDependencies):
  (parse error / none)
```


## Routes Files Content
```
===== routes\auth.php =====
<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

===== routes\console.php =====
<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

===== routes\web.php =====
<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokirController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\AiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ResesController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    // === 1. MODUL POKIR ===
    // Input Massal (Prioritas Utama)
    Route::get('/pokir/input-massal', [PokirController::class, 'createBulk'])->name('pokir.bulk');
    Route::post('/pokir/input-massal', [PokirController::class, 'storeBulk'])->name('pokir.storeBulk');

    // List Data & Fitur Pendukung
    Route::get('/pokir', [PokirController::class, 'index'])->name('pokir.index');
    Route::get('/pokir/create', [PokirController::class, 'create'])->name('pokir.create'); // Input Satuan (Opsional)
    Route::post('/pokir', [PokirController::class, 'store'])->name('pokir.store');
    Route::get('/pokir/export', [PokirController::class, 'exportExcel'])->name('pokir.export');
    Route::get('/pokir/print', [PokirController::class, 'print'])->name('pokir.print');

    // === 2. MODUL MASTER DATA ===
    Route::get('/master', [MasterController::class, 'index'])->name('master.index');

    // Action Master Data
    Route::post('/master/aleg', [MasterController::class, 'storeAleg'])->name('master.aleg.store');
    Route::delete('/master/aleg/{aleg}', [MasterController::class, 'destroyAleg'])->name('master.aleg.destroy');

    Route::post('/master/opd', [MasterController::class, 'storeOpd'])->name('master.opd.store');
    Route::delete('/master/opd/{opd}', [MasterController::class, 'destroyOpd'])->name('master.opd.destroy');

    Route::post('/master/kategori', [MasterController::class, 'storeKategori'])->name('master.kategori.store');
    Route::delete('/master/kategori/{kategori}', [MasterController::class, 'destroyKategori'])->name('master.kategori.destroy');

    // Route Master Plan (Wadah)
    Route::get('/master/plans', [PlanController::class, 'index'])->name('plans.index');
    Route::post('/master/plans/import', [PlanController::class, 'import'])->name('plans.import');

    Route::put('/master/plans/{plan}', [PlanController::class, 'update'])->name('plans.update');
    Route::post('/master/plans/store', [PlanController::class, 'store'])->name('plans.store');
    Route::delete('/master/plans/aleg', [PlanController::class, 'destroyByAleg'])->name('plans.destroyAleg');
    Route::delete('/master/plans/{plan}', [PlanController::class, 'destroy'])->name('plans.destroy');

    Route::get('/reses/lampiran', [ResesController::class, 'index'])->name('reses.index');
Route::post('/reses/cetak', [ResesController::class, 'printPdf'])->name('reses.print');




    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

```


## Routes (from command)
```

  GET|HEAD  / ........................................................................................................................................................................................... 
  GET|HEAD  _debugbar/assets/javascript ..................................................................................................... debugbar.assets.js ΓÇ║ Barryvdh\Debugbar ΓÇ║ AssetController@js
  GET|HEAD  _debugbar/assets/stylesheets .................................................................................................. debugbar.assets.css ΓÇ║ Barryvdh\Debugbar ΓÇ║ AssetController@css
  DELETE    _debugbar/cache/{key}/{tags?} ............................................................................................ debugbar.cache.delete ΓÇ║ Barryvdh\Debugbar ΓÇ║ CacheController@delete
  GET|HEAD  _debugbar/clockwork/{id} ........................................................................................... debugbar.clockwork ΓÇ║ Barryvdh\Debugbar ΓÇ║ OpenHandlerController@clockwork
  GET|HEAD  _debugbar/open ...................................................................................................... debugbar.openhandler ΓÇ║ Barryvdh\Debugbar ΓÇ║ OpenHandlerController@handle
  POST      _debugbar/queries/explain .......................................................................................... debugbar.queries.explain ΓÇ║ Barryvdh\Debugbar ΓÇ║ QueriesController@explain
  GET|HEAD  confirm-password ................................................................................................................. password.confirm ΓÇ║ Auth\ConfirmablePasswordController@show
  POST      confirm-password ................................................................................................................................... Auth\ConfirmablePasswordController@store
  GET|HEAD  dashboard ............................................................................................................................................. dashboard ΓÇ║ DashboardController@index
  POST      email/verification-notification ...................................................................................... verification.send ΓÇ║ Auth\EmailVerificationNotificationController@store
  GET|HEAD  forgot-password .................................................................................................................. password.request ΓÇ║ Auth\PasswordResetLinkController@create
  POST      forgot-password ..................................................................................................................... password.email ΓÇ║ Auth\PasswordResetLinkController@store
  GET|HEAD  login .................................................................................................................................... login ΓÇ║ Auth\AuthenticatedSessionController@create
  POST      login ............................................................................................................................................. Auth\AuthenticatedSessionController@store
  POST      logout ................................................................................................................................. logout ΓÇ║ Auth\AuthenticatedSessionController@destroy
  GET|HEAD  master ................................................................................................................................................ master.index ΓÇ║ MasterController@index
  POST      master/aleg .................................................................................................................................. master.aleg.store ΓÇ║ MasterController@storeAleg
  DELETE    master/aleg/{aleg} ....................................................................................................................... master.aleg.destroy ΓÇ║ MasterController@destroyAleg
  POST      master/kategori ...................................................................................................................... master.kategori.store ΓÇ║ MasterController@storeKategori
  DELETE    master/kategori/{kategori} ....................................................................................................... master.kategori.destroy ΓÇ║ MasterController@destroyKategori
  POST      master/opd ..................................................................................................................................... master.opd.store ΓÇ║ MasterController@storeOpd
  DELETE    master/opd/{opd} ........................................................................................................................... master.opd.destroy ΓÇ║ MasterController@destroyOpd
  GET|HEAD  master/plans ............................................................................................................................................. plans.index ΓÇ║ PlanController@index
  DELETE    master/plans/aleg .......................................................................................................................... plans.destroyAleg ΓÇ║ PlanController@destroyByAleg
  POST      master/plans/import .................................................................................................................................... plans.import ΓÇ║ PlanController@import
  POST      master/plans/store ....................................................................................................................................... plans.store ΓÇ║ PlanController@store
  PUT       master/plans/{plan} .................................................................................................................................... plans.update ΓÇ║ PlanController@update
  DELETE    master/plans/{plan} .................................................................................................................................. plans.destroy ΓÇ║ PlanController@destroy
  PUT       password ................................................................................................................................... password.update ΓÇ║ Auth\PasswordController@update
  GET|HEAD  pokir ................................................................................................................................................... pokir.index ΓÇ║ PokirController@index
  POST      pokir ................................................................................................................................................... pokir.store ΓÇ║ PokirController@store
  GET|HEAD  pokir/create .......................................................................................................................................... pokir.create ΓÇ║ PokirController@create
  GET|HEAD  pokir/export ..................................................................................................................................... pokir.export ΓÇ║ PokirController@exportExcel
  GET|HEAD  pokir/input-massal .................................................................................................................................. pokir.bulk ΓÇ║ PokirController@createBulk
  POST      pokir/input-massal .............................................................................................................................. pokir.storeBulk ΓÇ║ PokirController@storeBulk
  GET|HEAD  pokir/print ............................................................................................................................................. pokir.print ΓÇ║ PokirController@print
  GET|HEAD  profile ............................................................................................................................................... profile.edit ΓÇ║ ProfileController@edit
  PATCH     profile ........................................................................................................................................... profile.update ΓÇ║ ProfileController@update
  DELETE    profile ......................................................................................................................................... profile.destroy ΓÇ║ ProfileController@destroy
  GET|HEAD  register .................................................................................................................................... register ΓÇ║ Auth\RegisteredUserController@create
  POST      register ................................................................................................................................................ Auth\RegisteredUserController@store
  POST      reses/cetak .......................................................................................................................................... reses.print ΓÇ║ ResesController@printPdf
  GET|HEAD  reses/lampiran .......................................................................................................................................... reses.index ΓÇ║ ResesController@index
  POST      reset-password ............................................................................................................................ password.store ΓÇ║ Auth\NewPasswordController@store
  GET|HEAD  reset-password/{token} ................................................................................................................... password.reset ΓÇ║ Auth\NewPasswordController@create
  GET|HEAD  storage/{path} ................................................................................................................................................................ storage.local
  GET|HEAD  up .......................................................................................................................................................................................... 
  GET|HEAD  verify-email ................................................................................................................... verification.notice ΓÇ║ Auth\EmailVerificationPromptController
  GET|HEAD  verify-email/{id}/{hash} ................................................................................................................... verification.verify ΓÇ║ Auth\VerifyEmailController

                                                                                                                                                                                      Showing [50] routes

```


## Controllers Content
```
===== app\Http\Controllers\Auth\AuthenticatedSessionController.php =====
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

===== app\Http\Controllers\Auth\ConfirmablePasswordController.php =====
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ConfirmablePasswordController extends Controller
{
    /**
     * Show the confirm password view.
     */
    public function show(): View
    {
        return view('auth.confirm-password');
    }

    /**
     * Confirm the user's password.
     */
    public function store(Request $request): RedirectResponse
    {
        if (! Auth::guard('web')->validate([
            'email' => $request->user()->email,
            'password' => $request->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        $request->session()->put('auth.password_confirmed_at', time());

        return redirect()->intended(route('dashboard', absolute: false));
    }
}

===== app\Http\Controllers\Auth\EmailVerificationNotificationController.php =====
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}

===== app\Http\Controllers\Auth\EmailVerificationPromptController.php =====
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended(route('dashboard', absolute: false))
                    : view('auth.verify-email');
    }
}

===== app\Http\Controllers\Auth\NewPasswordController.php =====
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withInput($request->only('email'))
                        ->withErrors(['email' => __($status)]);
    }
}

===== app\Http\Controllers\Auth\PasswordController.php =====
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }
}

===== app\Http\Controllers\Auth\PasswordResetLinkController.php =====
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                        ->withErrors(['email' => __($status)]);
    }
}

===== app\Http\Controllers\Auth\RegisteredUserController.php =====
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}

===== app\Http\Controllers\Auth\VerifyEmailController.php =====
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
    }
}

===== app\Http\Controllers\AiController.php =====
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class AiController extends Controller
{
    public function ask(Request $request)
    {
        // 1. Cek API Key
        $apiKey = env('GEMINI_API_KEY');
        if (!$apiKey) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'API Key tidak terbaca di .env'
            ], 200); // Pakai 200 biar terbaca di PowerShell
        }

        // 2. Siapkan Data
        $question = $request->input('question', 'Tes koneksi');
        $schema = "Table: pokirs (kategori_usulan, opd_tujuan, anggota_dprd, spesifikasi, alamat, nama_pemohon, created_at)";
        $prompt = "You are a SQL assistant. Schema: $schema. Question: '$question'. Return ONLY raw SQL (SELECT).";

        try {
            // Ganti jadi 1.5-flash (lebih stabil & jarang kena limit 429)
            $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key={$apiKey}";

            // 3. Kirim Request ke Google (Pakai withoutVerifying untuk bypass SSL issue di Windows/Laragon)
            $response = Http::withoutVerifying()
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post($url, [
                    'contents' => [
                        ['parts' => [['text' => $prompt]]]
                    ]
                ]);

            // ==========================================
            // ðŸ›‘ DEBUGGING MODE (Return JSON)
            // ==========================================
            return response()->json([
                'DEBUG_STATUS' => $response->successful() ? 'SUCCESS' : 'FAILED',
                'HTTP_CODE' => $response->status(),
                'API_KEY_PARTIAL' => substr($apiKey, 0, 8) . '...',
                'GOOGLE_RESPONSE' => $response->json(),
            ]);

            // Kode di bawah ini unreachable selama return di atas masih aktif
            /*
            if ($response->failed()) { ... }
            $data = $response->json();
            ...
            */
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'CRITICAL ERROR',
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ], 200);
        }
    }
}

===== app\Http\Controllers\Controller.php =====
<?php

namespace App\Http\Controllers;

abstract class Controller
{
    //
}

===== app\Http\Controllers\DashboardController.php =====
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pokir;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. STATS UTAMA
        $totalUsulan = Pokir::count();
        $totalOpd = Pokir::distinct('opd_tujuan')->count();
        $totalAleg = Pokir::distinct('anggota_dprd')->count();

        // 2. DATA UNTUK CHART KATEGORI (Donut Chart)
        $statsKategori = Pokir::select('kategori_usulan', DB::raw('count(*) as total'))
            ->groupBy('kategori_usulan')
            ->orderByDesc('total')
            ->get();
        
        $labelKategori = $statsKategori->pluck('kategori_usulan');
        $dataKategori = $statsKategori->pluck('total');

        // 3. DATA PER OPD (Top Leaderboard)
        $statsOpd = Pokir::select('opd_tujuan', DB::raw('count(*) as total'))
            ->groupBy('opd_tujuan')
            ->orderByDesc('total')
            ->get(); // Kita ambil semua, nanti di view kita limit tampilannya

        // 4. DATA PER ALEG (Progress Bar)
        $statsAleg = Pokir::select('anggota_dprd', DB::raw('count(*) as total'))
            ->groupBy('anggota_dprd')
            ->orderByDesc('total')
            ->get();
        
        // Cari nilai tertinggi untuk kalkulasi persentase progress bar
        $maxAleg = $statsAleg->max('total') ?? 1; 

        return view('dashboard', compact(
            'totalUsulan', 'totalOpd', 'totalAleg',
            'labelKategori', 'dataKategori',
            'statsOpd',
            'statsAleg', 'maxAleg'
        ));
    }
}

===== app\Http\Controllers\MasterController.php =====
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Aleg;
use App\Models\Opd;
use App\Models\Kategori;


class MasterController extends Controller
{
    // === INDEX DATA ===
    public function index()
    {
        $alegs = Aleg::all();
        $opds = Opd::all();
        $kategoris = Kategori::all();

        return view('master.index', compact('alegs', 'opds', 'kategoris'));
    }

    // === STORE DATA (SIMPAN) ===
    public function storeAleg(Request $request) {
        Aleg::create($request->only('nama', 'fraksi'));
        return back()->with('success', 'Aleg berhasil ditambah');
    }

    public function storeOpd(Request $request) {
        Opd::create(['nama_dinas' => $request->nama_dinas]);
        return back()->with('success', 'OPD berhasil ditambah');
    }

    public function storeKategori(Request $request) {
        Kategori::create(['nama_kategori' => $request->nama_kategori]);
        return back()->with('success', 'Kategori berhasil ditambah');
    }

    // === DESTROY (HAPUS) ===
    public function destroyAleg(Aleg $aleg) { $aleg->delete(); return back(); }
    public function destroyOpd(Opd $opd) { $opd->delete(); return back(); }
    public function destroyKategori(Kategori $kategori) { $kategori->delete(); return back(); }
}

===== app\Http\Controllers\PlanController.php =====
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PokirPlan;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
    // Halaman List Rencana Kerja
    public function index()
    {
        // Ambil semua data, urutkan per Aleg lalu per OPD, kemudian GROUP BY Aleg
        $groupedPlans = PokirPlan::orderBy('anggota_dprd')
            ->orderBy('opd_tujuan')
            ->get()
            ->groupBy('anggota_dprd');

        return view('plan.index', compact('groupedPlans'));
    }

    public function import(Request $request)
    {
        $request->validate(['file_excel' => 'required|mimes:xlsx,xls']);

        try {
            $file = $request->file('file_excel');
            $spreadsheet = IOFactory::load($file->getPathname());
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();

            DB::beginTransaction();

            $countInput = 0;

            // --- VARIABEL PENGINGAT (Untuk Handle Merged Cell) ---
            $lastOpd = null; // Awalnya kosong
            $lastAleg = null; // Jaga-jaga kalau kolom Aleg juga di-merge

            foreach ($rows as $index => $row) {
                // 1. Skip Header (Mulai baca dari baris 4 / Index 3)
                if ($index < 3) continue;

                // 2. Filter Baris Sampah (Cek Kolom A harus Angka)
                if (empty($row[0]) || !is_numeric($row[0])) {
                    continue;
                }

                // --- LOGIKA UN-MERGE (MEMORY) ---

                // Cek Kolom OPD (Index 6 / Kolom G)
                if (!empty($row[6])) {
                    // Kalau ada isinya, kita update ingatan kita
                    $lastOpd = $row[6];
                }
                // Kalau kosong, $lastOpd akan tetap memegang nilai dari baris sebelumnya

                // Cek Kolom Aleg (Index 7 / Kolom H) - Jaga-jaga kalau ini juga merge
                if (!empty($row[7])) {
                    $lastAleg = $row[7];
                }

                // --------------------------------

                PokirPlan::create([
                    'nama_kegiatan' => $row[1],
                    'volume_target' => (int) $row[2],
                    'satuan'        => $row[3] ?? 'Paket',
                    'harga_satuan'  => $this->cleanNumber($row[4]),
                    'pagu_total'    => $this->cleanNumber($row[5]),

                    // PENTING: Gunakan variable pengingat, bukan $row[6] mentah
                    'opd_tujuan'    => $lastOpd ?? 'Dinas Terkait',
                    'anggota_dprd'  => $lastAleg ?? 'Umum',

                    'tahun_anggaran' => 2026
                ]);

                $countInput++;
            }

            DB::commit();
            return redirect()->back()->with('success', "Sukses! $countInput program berhasil diimport (Merged Cells handled).");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    // Helper Bersihkan Rupiah
    private function cleanNumber($string)
    {
        if (empty($string)) return 0;
        if (is_numeric($string)) return $string;
        return (float) preg_replace('/[^0-9]/', '', $string);
    }


    public function update(Request $request, $id)
    {
        $plan = PokirPlan::findOrFail($id);

        // Validasi input
        $request->validate([
            'nama_kegiatan' => 'required|string',
            'volume_target' => 'required|numeric',
            'harga_satuan'  => 'required', // Bisa string "Rp...", nanti dibersihkan
        ]);

        // Bersihkan angka
        $hargaClean = $this->cleanNumber($request->harga_satuan);
        $volume = (int) $request->volume_target;

        // Hitung ulang total otomatis
        $totalBaru = $volume * $hargaClean;

        $plan->update([
            'nama_kegiatan' => $request->nama_kegiatan,
            'opd_tujuan'    => $request->opd_tujuan, // Jaga-jaga mau ganti OPD
            'volume_target' => $volume,
            'satuan'        => $request->satuan,
            'harga_satuan'  => $hargaClean,
            'pagu_total'    => $totalBaru, // Update total otomatis
        ]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui!');
    }

    // 4. PROSES HAPUS
    public function destroy($id)
    {
        $plan = PokirPlan::findOrFail($id);

        // Opsional: Cek apakah sudah ada usulan masuk? Kalau ada, cegah hapus.
        if ($plan->pokirs()->count() > 0) {
            return redirect()->back()->with('error', 'Gagal hapus! Sudah ada usulan warga yang masuk ke program ini.');
        }

        $plan->delete();
        return redirect()->back()->with('success', 'Rencana kerja berhasil dihapus.');
    }

    public function destroyByAleg(Request $request)
    {
        // Hapus semua data berdasarkan Nama Aleg
        PokirPlan::where('anggota_dprd', $request->anggota_dprd)->delete();

        return redirect()->back()->with('success', 'Seluruh pagu milik ' . $request->anggota_dprd . ' berhasil dihapus.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'anggota_dprd'  => 'required|string',
            'opd_tujuan'    => 'required|string',
            'nama_kegiatan' => 'required|string',
            'volume_target' => 'required|numeric',
            'satuan'        => 'required|string',
            'harga_satuan'  => 'required', // String Rp...
        ]);

        PokirPlan::create([
            'anggota_dprd'   => $request->anggota_dprd,
            'opd_tujuan'     => $request->opd_tujuan,
            'nama_kegiatan'  => $request->nama_kegiatan,
            'volume_target'  => $request->volume_target,
            'satuan'         => $request->satuan,
            'harga_satuan'   => $this->cleanNumber($request->harga_satuan),
            'pagu_total'     => $request->volume_target * $this->cleanNumber($request->harga_satuan),
            'tahun_anggaran' => 2026,
        ]);

        return redirect()->back()->with('success', 'Data rencana kerja berhasil ditambahkan manual.');
    }
}

===== app\Http\Controllers\PokirController.php =====
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pokir;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\Aleg;
use App\Models\Opd;
use App\Models\Kategori;

class PokirController extends Controller
{ // Fungsi bantuan agar filter bisa dipakai di Index, Print, dan Excel
    private function getFilteredPokir($request)
    {
        $query = Pokir::latest();

        if ($request->filled('kategori_usulan')) {
            $query->where('kategori_usulan', $request->kategori_usulan);
        }
        if ($request->filled('opd_tujuan')) {
            $query->where('opd_tujuan', $request->opd_tujuan);
        }
        if ($request->filled('anggota_dprd')) {
            $query->where('anggota_dprd', 'like', '%' . $request->anggota_dprd . '%');
        }

        return $query;
    }

    // HALAMAN UTAMA (LIST & FILTER)
    public function index(Request $request)
    {
        // Gunakan pagination agar halaman tidak berat
        $pokirs = $this->getFilteredPokir($request)->paginate(10);
        return view('pokir.index', compact('pokirs'));
    }

    // HALAMAN INPUT (FORM)
    public function create()
    {
        $alegs = Aleg::all();
        $opds = Opd::all();
        $kategoris = Kategori::all();

        // Sesuaikan nama view-nya (pokir.create atau pokir.create-bulk)
        return view('pokir.create', compact('alegs', 'opds', 'kategoris'));
    }

    // PROSES SIMPAN
    public function store(Request $request)
    {
        $request->validate([
            'kategori_usulan' => 'required',
            'opd_tujuan' => 'required',
            'alamat' => 'required',
            'nama_pemohon' => 'required',
            'anggota_dprd' => 'required',
        ]);

        Pokir::create([
            'kategori_usulan' => $request->kategori_usulan,
            'spesifikasi' => $request->spesifikasi,
            'opd_tujuan' => $request->opd_tujuan,
            'alamat' => $request->alamat,
            'nama_pemohon' => $request->nama_pemohon,
            'identitas_pemohon' => $request->identitas_pemohon,
            'anggota_dprd' => $request->anggota_dprd,
            'status_berkas' => $request->status_berkas,
            'operator_penerima' => $request->operator_penerima,
        ]);

        // Redirect ke Index agar bisa lihat hasil input
        return redirect()->route('pokir.index')->with('success', 'Data berhasil disimpan.');
    }



    public function createBulk()
    {
        $alegs = Aleg::all();
        $opds = Opd::all();
        $kategoris = Kategori::all();

        return view('pokir.create-bulk', compact('alegs', 'opds', 'kategoris'));
    }

    // 2. SIMPAN DATA MASSAL
    public function storeBulk(Request $request)
    {
        // Validasi Header
        $request->validate([
            'kategori_usulan' => 'required',
            'opd_tujuan' => 'required',
            'anggota_dprd' => 'required',

            // Validasi Array Detail
            'details' => 'required|array|min:1',
            'details.*.nama_pemohon' => 'required',
            'details.*.alamat' => 'required',
        ]);

        $dataHeader = [
            'kategori_usulan' => $request->kategori_usulan,
            'opd_tujuan' => $request->opd_tujuan,
            'anggota_dprd' => $request->anggota_dprd,
            'operator_penerima' => $request->operator_penerima,
        ];

        // Looping simpan per baris
        foreach ($request->details as $row) {
            // Cek jika baris kosong (nama pemohon tidak diisi), skip saja
            if (empty($row['nama_pemohon'])) continue;

            Pokir::create(array_merge($dataHeader, [
                'spesifikasi' => $row['spesifikasi'] ?? null,
                'nama_pemohon' => $row['nama_pemohon'],
                'identitas_pemohon' => $row['identitas_pemohon'] ?? null,
                'alamat' => $row['alamat'],
                'status_berkas' => !empty($row['status_berkas']) ? $row['status_berkas'] : '1 Proposal',
            ]));
        }

        return redirect()->route('pokir.index')->with('success', 'Input massal berhasil disimpan!');
    }

    // CETAK (Ikut Filter)
    public function print(Request $request)
    {
        $pokirs = $this->getFilteredPokir($request)->get(); // Get all (sesuai filter)
        return view('pokir.print', compact('pokirs'));
    }

    // EXPORT EXCEL (Ikut Filter)
    public function exportExcel(Request $request)
    {
        $dataPokir = $this->getFilteredPokir($request)->get();
        $totalData = $dataPokir->count();

        if ($totalData == 0) return redirect()->back()->with('error', 'Data kosong.');

        $templatePath = storage_path('app/template_pokir.xlsx');
        if (!file_exists($templatePath)) return redirect()->back()->with('error', 'Template tidak ada.');

        $spreadsheet = IOFactory::load($templatePath);
        $sheet = $spreadsheet->getActiveSheet();

        $startRow = 9;

        if ($totalData > 1) {
            $sheet->insertNewRowBefore($startRow + 1, $totalData - 1);
        }

        foreach ($dataPokir as $index => $row) {
            $currentRow = $startRow + $index;
            $sheet->setCellValue('A' . $currentRow, $index + 1);
            $sheet->setCellValue('B' . $currentRow, $row->judul_lengkap);
            $sheet->setCellValue('C' . $currentRow, $row->alamat);
            $sheet->setCellValue('D' . $currentRow, $row->nama_pemohon);
            $sheet->setCellValue('E' . $currentRow, $row->identitas_pemohon);
            $sheet->setCellValue('F' . $currentRow, $row->anggota_dprd);
            $sheet->setCellValue('G' . $currentRow, $row->status_berkas);
            $sheet->setCellValue('H' . $currentRow, $row->operator_penerima);
            $sheet->setCellValue('I' . $currentRow, $row->opd_tujuan);
        }

        // Nama file lebih spesifik (misal: Laporan_UMKM.xlsx)
        $suffix = $request->kategori_usulan ? '_' . $request->kategori_usulan : '';
        $fileName = 'Laporan_Pokir' . $suffix . '_' . date('Ymd_Hi') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}

===== app\Http\Controllers\ProfileController.php =====
<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

===== app\Http\Controllers\ResesController.php =====
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ResesController extends Controller
{
    public function index()
    {
        return view('reses.index');
    }

    public function printPdf(Request $request)
    {
        ini_set('memory_limit', '512M');
        ini_set('max_execution_time', '300');

        $data = $request->validate([
            'global_header_type' => 'required|string',
            'global_deskripsi'   => 'nullable|string',
            'global_masa_sidang' => 'nullable|string',
            'global_dapil'       => 'nullable|string',
            'sheets'             => 'array',
            'sheets.*.title'     => 'nullable|string',
            'sheets.*.tanggal'   => 'nullable|string',
            'sheets.*.layout'    => 'required|numeric',
            'sheets.*.photos'    => 'array',
        ]);

        foreach ($data['sheets'] as $key => &$sheet) {
            $photos = $sheet['photos'] ?? [];
            $layoutCount = (int) $sheet['layout'];

            for ($i = count($photos); $i < $layoutCount; $i++) {
                $photos[] = null;
            }
            if ($layoutCount != 3 && count($photos) % 2 != 0) {
                $photos[] = null;
            }
            $sheet['photos'] = $photos;
        }

        $pdf = Pdf::loadView('reses.pdf', $data)
            ->setPaper('a4', 'portrait')
            ->setOption([
                'dpi' => 120,
                'isRemoteEnabled' => true,
                'isHtml5ParserEnabled' => true
            ]);

        // --- UPDATE: BUAT NAMA FILE DINAMIS ---
        // Contoh hasil: Reses_Standar_20260208_1030.pdf
        $jenis = ucfirst($data['global_header_type']); // Standar / Tatap_muka
        $waktu = date('Ymd_His'); // Jam detik unik
        $namaFile = "Laporan_Reses_{$jenis}_{$waktu}.pdf";

        return $pdf->stream($namaFile);
    }
}

```


## Models Content
```
===== app\Models\Aleg.php =====
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aleg extends Model
{
    protected $guarded = [];
    
}

===== app\Models\Kategori.php =====
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $guarded = [];
}

===== app\Models\Opd.php =====
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Opd extends Model
{
    protected $guarded = [];
}

===== app\Models\Pokir.php =====
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pokir extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_usulan',
        'spesifikasi',
        'opd_tujuan',
        'alamat',
        'nama_pemohon',
        'identitas_pemohon',
        'anggota_dprd',
        'status_berkas',
        'operator_penerima',
    ];


    public function getJudulLengkapAttribute()
    {
        if (empty($this->spesifikasi)) {
            return $this->kategori_usulan;
        }
        return $this->kategori_usulan . ' - ' . $this->spesifikasi;
    }

    // Relasi ke Rencana Kerja (Wadah)
    public function plan()
    {
        return $this->belongsTo(PokirPlan::class, 'pokir_plan_id');
    }
}

===== app\Models\PokirPlan.php =====
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PokirPlan extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    // Relasi: Satu Plan punya banyak Usulan
    public function pokirs()
    {
        return $this->hasMany(Pokir::class, 'pokir_plan_id');
    }

    // Hitung Sisa Kuota (Hanya kurangi jika statusnya 'Terakomodir')
    public function getSisaKuotaAttribute()
    {
        $terpakai = $this->pokirs()->where('status_sistem', 'Terakomodir')->count();
        return max(0, $this->volume_target - $terpakai);
    }
}

```


## Views & UI Files Content
```
===== resources\views\auth\confirm-password.blade.php =====
<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button>
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

===== resources\views\auth\forgot-password.blade.php =====
<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

===== resources\views\auth\login.blade.php =====
<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

===== resources\views\auth\register.blade.php =====
<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

===== resources\views\auth\reset-password.blade.php =====
<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

===== resources\views\auth\verify-email.blade.php =====
<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>

===== resources\views\components\application-logo.blade.php =====
<svg viewBox="0 0 316 316" xmlns="http://www.w3.org/2000/svg" {{ $attributes }}>
    <path d="M305.8 81.125C305.77 80.995 305.69 80.885 305.65 80.755C305.56 80.525 305.49 80.285 305.37 80.075C305.29 79.935 305.17 79.815 305.07 79.685C304.94 79.515 304.83 79.325 304.68 79.175C304.55 79.045 304.39 78.955 304.25 78.845C304.09 78.715 303.95 78.575 303.77 78.475L251.32 48.275C249.97 47.495 248.31 47.495 246.96 48.275L194.51 78.475C194.33 78.575 194.19 78.725 194.03 78.845C193.89 78.955 193.73 79.045 193.6 79.175C193.45 79.325 193.34 79.515 193.21 79.685C193.11 79.815 192.99 79.935 192.91 80.075C192.79 80.285 192.71 80.525 192.63 80.755C192.58 80.875 192.51 80.995 192.48 81.125C192.38 81.495 192.33 81.875 192.33 82.265V139.625L148.62 164.795V52.575C148.62 52.185 148.57 51.805 148.47 51.435C148.44 51.305 148.36 51.195 148.32 51.065C148.23 50.835 148.16 50.595 148.04 50.385C147.96 50.245 147.84 50.125 147.74 49.995C147.61 49.825 147.5 49.635 147.35 49.485C147.22 49.355 147.06 49.265 146.92 49.155C146.76 49.025 146.62 48.885 146.44 48.785L93.99 18.585C92.64 17.805 90.98 17.805 89.63 18.585L37.18 48.785C37 48.885 36.86 49.035 36.7 49.155C36.56 49.265 36.4 49.355 36.27 49.485C36.12 49.635 36.01 49.825 35.88 49.995C35.78 50.125 35.66 50.245 35.58 50.385C35.46 50.595 35.38 50.835 35.3 51.065C35.25 51.185 35.18 51.305 35.15 51.435C35.05 51.805 35 52.185 35 52.575V232.235C35 233.795 35.84 235.245 37.19 236.025L142.1 296.425C142.33 296.555 142.58 296.635 142.82 296.725C142.93 296.765 143.04 296.835 143.16 296.865C143.53 296.965 143.9 297.015 144.28 297.015C144.66 297.015 145.03 296.965 145.4 296.865C145.5 296.835 145.59 296.775 145.69 296.745C145.95 296.655 146.21 296.565 146.45 296.435L251.36 236.035C252.72 235.255 253.55 233.815 253.55 232.245V174.885L303.81 145.945C305.17 145.165 306 143.725 306 142.155V82.265C305.95 81.875 305.89 81.495 305.8 81.125ZM144.2 227.205L100.57 202.515L146.39 176.135L196.66 147.195L240.33 172.335L208.29 190.625L144.2 227.205ZM244.75 114.995V164.795L226.39 154.225L201.03 139.625V89.825L219.39 100.395L244.75 114.995ZM249.12 57.105L292.81 82.265L249.12 107.425L205.43 82.265L249.12 57.105ZM114.49 184.425L96.13 194.995V85.305L121.49 70.705L139.85 60.135V169.815L114.49 184.425ZM91.76 27.425L135.45 52.585L91.76 77.745L48.07 52.585L91.76 27.425ZM43.67 60.135L62.03 70.705L87.39 85.305V202.545V202.555V202.565C87.39 202.735 87.44 202.895 87.46 203.055C87.49 203.265 87.49 203.485 87.55 203.695V203.705C87.6 203.875 87.69 204.035 87.76 204.195C87.84 204.375 87.89 204.575 87.99 204.745C87.99 204.745 87.99 204.755 88 204.755C88.09 204.905 88.22 205.035 88.33 205.175C88.45 205.335 88.55 205.495 88.69 205.635L88.7 205.645C88.82 205.765 88.98 205.855 89.12 205.965C89.28 206.085 89.42 206.225 89.59 206.325C89.6 206.325 89.6 206.325 89.61 206.335C89.62 206.335 89.62 206.345 89.63 206.345L139.87 234.775V285.065L43.67 229.705V60.135ZM244.75 229.705L148.58 285.075V234.775L219.8 194.115L244.75 179.875V229.705ZM297.2 139.625L253.49 164.795V114.995L278.85 100.395L297.21 89.825V139.625H297.2Z"/>
</svg>

===== resources\views\components\auth-session-status.blade.php =====
@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-green-600']) }}>
        {{ $status }}
    </div>
@endif

===== resources\views\components\danger-button.blade.php =====
<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>

===== resources\views\components\dropdown-link.blade.php =====
<a {{ $attributes->merge(['class' => 'block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out']) }}>{{ $slot }}</a>

===== resources\views\components\dropdown.blade.php =====
@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-1 bg-white'])

@php
$alignmentClasses = match ($align) {
    'left' => 'ltr:origin-top-left rtl:origin-top-right start-0',
    'top' => 'origin-top',
    default => 'ltr:origin-top-right rtl:origin-top-left end-0',
};

$width = match ($width) {
    '48' => 'w-48',
    default => $width,
};
@endphp

<div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
    <div @click="open = ! open">
        {{ $trigger }}
    </div>

    <div x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="absolute z-50 mt-2 {{ $width }} rounded-md shadow-lg {{ $alignmentClasses }}"
            style="display: none;"
            @click="open = false">
        <div class="rounded-md ring-1 ring-black ring-opacity-5 {{ $contentClasses }}">
            {{ $content }}
        </div>
    </div>
</div>

===== resources\views\components\input-error.blade.php =====
@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif

===== resources\views\components\input-label.blade.php =====
@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>

===== resources\views\components\modal.blade.php =====
@props([
    'name',
    'show' => false,
    'maxWidth' => '2xl'
])

@php
$maxWidth = [
    'sm' => 'sm:max-w-sm',
    'md' => 'sm:max-w-md',
    'lg' => 'sm:max-w-lg',
    'xl' => 'sm:max-w-xl',
    '2xl' => 'sm:max-w-2xl',
][$maxWidth];
@endphp

<div
    x-data="{
        show: @js($show),
        focusables() {
            // All focusable element types...
            let selector = 'a, button, input:not([type=\'hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-1\'])'
            return [...$el.querySelectorAll(selector)]
                // All non-disabled elements...
                .filter(el => ! el.hasAttribute('disabled'))
        },
        firstFocusable() { return this.focusables()[0] },
        lastFocusable() { return this.focusables().slice(-1)[0] },
        nextFocusable() { return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable() },
        prevFocusable() { return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable() },
        nextFocusableIndex() { return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1) },
        prevFocusableIndex() { return Math.max(0, this.focusables().indexOf(document.activeElement)) -1 },
    }"
    x-init="$watch('show', value => {
        if (value) {
            document.body.classList.add('overflow-y-hidden');
            {{ $attributes->has('focusable') ? 'setTimeout(() => firstFocusable().focus(), 100)' : '' }}
        } else {
            document.body.classList.remove('overflow-y-hidden');
        }
    })"
    x-on:open-modal.window="$event.detail == '{{ $name }}' ? show = true : null"
    x-on:close-modal.window="$event.detail == '{{ $name }}' ? show = false : null"
    x-on:close.stop="show = false"
    x-on:keydown.escape.window="show = false"
    x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
    x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
    x-show="show"
    class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50"
    style="display: {{ $show ? 'block' : 'none' }};"
>
    <div
        x-show="show"
        class="fixed inset-0 transform transition-all"
        x-on:click="show = false"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>

    <div
        x-show="show"
        class="mb-6 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full {{ $maxWidth }} sm:mx-auto"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    >
        {{ $slot }}
    </div>
</div>

===== resources\views\components\nav-link.blade.php =====
@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'flex items-center gap-2 px-4 py-2.5 rounded-lg bg-yellow-100 text-yellow-800 font-bold transition-all duration-150'
            : 'flex items-center gap-2 px-4 py-2.5 rounded-lg text-gray-600 hover:bg-yellow-50 hover:text-yellow-700 transition-all duration-150';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

===== resources\views\components\primary-button.blade.php =====
<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 focus:bg-yellow-600 active:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>

===== resources\views\components\responsive-nav-link.blade.php =====
@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-indigo-400 text-start text-base font-medium text-indigo-700 bg-indigo-50 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

===== resources\views\components\secondary-button.blade.php =====
<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>

===== resources\views\components\text-input.blade.php =====
@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}>

===== resources\views\layouts\app.blade.php =====
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>[x-cloak] { display: none !important; }</style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body x-data="{ sidebarOpen: false }" class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex">

        <!-- Sidebar -->
        <div
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 w-64 z-30 bg-white border-r border-gray-200 transform transition-transform duration-200 ease-in-out md:relative md:translate-x-0 md:z-auto"
        >
            @include('layouts.navigation')
        </div>

        <!-- Overlay -->
        <div
            x-show="sidebarOpen"
            @click="sidebarOpen = false"
            x-cloak
            class="fixed inset-0 bg-black bg-opacity-25 z-20 md:hidden"
        ></div>

        <!-- Main content -->
        <div class="flex-1 flex flex-col w-full">

            <!-- Mobile topbar -->
            <header class="bg-white border-b px-4 py-3 flex items-center justify-between md:hidden relative">
                <!-- Tombol hamburger -->
                <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none z-10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            
                <!-- Judul di tengah -->
                <div class="absolute left-1/2 transform -translate-x-1/2 text-lg font-bold text-gray-800">
                    {{ config('app.name', 'MY APP') }}
                </div>
            </header>
            

            <!-- Optional header (desktop only) -->
            @isset($header)
                <header class="bg-white shadow hidden md:block">
                    <div class="px-6 py-7">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-1 p-6">
                {{ $slot }}
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // --- A. HANDLING SESSION FLASH (Success/Error) ---
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'BERHASIL!',
                text: "{{ session('success') }}",
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: '#f0fdf4', // Hijau muda
                iconColor: '#16a34a'   // Hijau tua
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'GAGAL!',
                text: "{{ session('error') }}",
                confirmButtonColor: '#ef4444',
            });
        @endif

        // --- B. GLOBAL DELETE FUNCTION ---
        // Panggil fungsi ini di tombol hapus manapun: onclick="confirmDelete(this)"
        window.confirmDelete = function(button, message = 'Data yang dihapus tidak dapat dikembalikan!') {
            // Mencegah Accordion terbuka saat tombol diklik (Stop Propagation)
            if(event) event.stopPropagation();
            if(event) event.preventDefault();

            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',     // Merah
                cancelButtonColor: '#3085d6',   // Biru
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Cari form terdekat dari tombol ini dan submit
                    button.closest('form').submit();
                }
            });
        }
    </script>
</body>



</html>

===== resources\views\layouts\guest.blade.php =====
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>

===== resources\views\layouts\navigation.blade.php =====
<aside class="h-full flex flex-col md:h-screen md:sticky md:top-0">
    <!-- Logo -->
    <div class="p-6 border-b border-gray-200">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
            <img src="{{ asset('images/logo-golkar.png') }}" 
                 alt="Logo Golkar" 
                 class="h-11 w-auto rounded-xl shadow-sm transition transform group-hover:scale-105">
                 
            <span class="text-lg font-extrabold text-yellow-500 tracking-wide uppercase leading-tight">
                Fraksi Partai Golkar
            </span>
        </a>
    </div>
    <!-- Nav Links -->
    <nav class="flex-1 px-4 py-6 space-y-2">
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>

            {{ __('Dashboard') }}
        </x-nav-link>
        <x-nav-link :href="route('plans.index')" :active="request()->routeIs('plans.*')">
            {{ __('Master Pagu') }}
        </x-nav-link>
        <x-nav-link :href="route('reses.index')" :active="request()->routeIs('reses.*')">
            {{ __('Lampiran Reses') }}
        </x-nav-link>
        <x-nav-link :href="route('pokir.bulk')" :active="request()->routeIs('pokir.bulk')">
            {{ __('Input Usulan') }}
        </x-nav-link>
    
        <x-nav-link :href="route('pokir.index')" :active="request()->routeIs('pokir.index')">
            {{ __('Data Pokir') }}
        </x-nav-link>
    
        <x-nav-link :href="route('master.index')" :active="request()->routeIs('master.*')">
            {{ __('Master Data') }}
        </x-nav-link>
    
    </nav>
    <!-- User Dropdown -->
    <div x-data="{ open: false }" class="px-4 py-4 border-t border-gray-200">
        <button @click="open = !open"
            class="w-full flex items-center justify-between px-4 py-2 text-sm font-medium text-left bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">
            <span>{{ Auth::user()->name }}</span>
            <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transform transition-transform" fill="none"
                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <div x-show="open" x-cloak class="mt-2 space-y-1 bg-white rounded-lg shadow-inner text-sm text-gray-700">
            <a href="{{ route('profile.edit') }}"
                class="block px-4 py-2 hover:bg-gray-100 rounded-lg">{{ __('Profile') }}</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full text-left px-4 py-2 text-red-600 hover:text-red-700 hover:bg-red-50 rounded-lg">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</aside>

===== resources\views\master\index.blade.php =====
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Master Data (Referensi)</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="bg-white p-6 shadow sm:rounded-lg">
                    <h3 class="font-bold mb-4">Master Kategori</h3>
                    <form action="{{ route('master.kategori.store') }}" method="POST" class="mb-4 flex gap-2">
                        @csrf
                        <input type="text" name="nama_kategori" placeholder="Nama Kategori" class="w-full text-sm border-gray-300 rounded" required>
                        <button class="bg-blue-600 text-white px-3 rounded text-sm">+</button>
                    </form>
                    <ul class="space-y-2">
                        @foreach($kategoris as $item)
                        <li class="flex justify-between items-center text-sm border-b pb-1">
                            {{ $item->nama_kategori }}
                            <form action="{{ route('master.kategori.destroy', $item) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="text-red-500" onclick="return confirm('Hapus?')">x</button>
                            </form>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="bg-white p-6 shadow sm:rounded-lg">
                    <h3 class="font-bold mb-4">Master OPD</h3>
                    <form action="{{ route('master.opd.store') }}" method="POST" class="mb-4 flex gap-2">
                        @csrf
                        <input type="text" name="nama_dinas" placeholder="Nama Dinas" class="w-full text-sm border-gray-300 rounded" required>
                        <button class="bg-blue-600 text-white px-3 rounded text-sm">+</button>
                    </form>
                    <ul class="space-y-2">
                        @foreach($opds as $item)
                        <li class="flex justify-between items-center text-sm border-b pb-1">
                            {{ $item->nama_dinas }}
                            <form action="{{ route('master.opd.destroy', $item) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="text-red-500" onclick="return confirm('Hapus?')">x</button>
                            </form>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="bg-white p-6 shadow sm:rounded-lg">
                    <h3 class="font-bold mb-4">Master Aleg</h3>
                    <form action="{{ route('master.aleg.store') }}" method="POST" class="mb-4 flex gap-2">
                        @csrf
                        <input type="text" name="nama" placeholder="Nama Aleg" class="w-full text-sm border-gray-300 rounded" required>
                        <button class="bg-blue-600 text-white px-3 rounded text-sm">+</button>
                    </form>
                    <ul class="space-y-2">
                        @foreach($alegs as $item)
                        <li class="flex justify-between items-center text-sm border-b pb-1">
                            {{ $item->nama }}
                            <form action="{{ route('master.aleg.destroy', $item) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="text-red-500" onclick="return confirm('Hapus?')">x</button>
                            </form>
                        </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

===== resources\views\plan\index.blade.php =====
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight border-l-4 border-yellow-500 pl-4">
            {{ __('Master Rencana Kerja (Pagu Indikatif)') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ showModal: false, defaultAleg: '' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div
                    class="bg-yellow-50 px-6 py-4 border-b border-yellow-100 flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-yellow-200 text-yellow-700 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">Database Pagu Anggaran</h3>
                            <p class="text-xs text-yellow-700 font-medium">Upload File Excel (.xlsx)</p>
                        </div>
                    </div>

                    <button @click="defaultAleg = ''; showModal = true" type="button"
                        class="flex items-center gap-2 px-5 py-2.5 bg-yellow-500 text-white text-sm font-bold rounded-lg hover:bg-yellow-600 shadow-md transition transform hover:-translate-y-0.5">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        Input Manual
                    </button>
                </div>

                <div class="p-6">
                    <form action="{{ route('plans.import') }}" method="POST" enctype="multipart/form-data"
                        class="flex flex-col md:flex-row gap-4 items-end">
                        @csrf
                        <div class="w-full md:w-1/2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih File Excel Pagu</label>
                            <input type="file" name="file_excel" required
                                class="block w-full text-sm text-gray-500
                                      file:mr-4 file:py-2.5 file:px-4
                                      file:rounded-lg file:border-0
                                      file:text-sm file:font-bold
                                      file:bg-yellow-100 file:text-yellow-800
                                      hover:file:bg-yellow-200 transition cursor-pointer border border-gray-300 rounded-lg">
                        </div>
                        <button type="submit"
                            class="px-6 py-2.5 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 font-bold shadow-md transition w-full md:w-auto flex justify-center items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                            </svg>
                            PROSES IMPORT
                        </button>
                    </form>
                    <p class="text-xs text-gray-400 mt-3 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Format kolom wajib: No, Program, Volume, Satuan, Harga, Total, OPD, Aleg.
                    </p>
                </div>
            </div>

            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-gray-800 border-l-4 border-yellow-500 pl-3">Daftar Pagu Tersedia
                        (Per Fraksi/Aleg)</h3>
                    <span class="text-xs font-medium bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full">Tahun
                        Anggaran 2026</span>
                </div>

                @forelse($groupedPlans as $alegName => $plans)
                    @php
                        $totalPaguAleg = $plans->sum('pagu_total');
                        $totalPaket = $plans->count();
                    @endphp

                    <details
                        class="group bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-200 transition-all duration-300">
                        <summary
                            class="flex items-center justify-between cursor-pointer p-5 bg-white hover:bg-yellow-50 transition border-b border-transparent group-open:border-yellow-200">
                            <div class="flex items-center gap-4">
                                <div
                                    class="bg-gray-100 p-2 rounded-full group-open:bg-yellow-200 group-open:text-yellow-800 transition">
                                    <svg class="w-5 h-5 text-gray-500 transition transform group-open:rotate-90 group-open:text-yellow-800"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800 text-lg">{{ $alegName }}</h4>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span
                                            class="text-xs font-semibold bg-gray-100 text-gray-600 px-2 py-0.5 rounded">{{ $totalPaket }}
                                            Kegiatan</span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-6">
                                <div class="text-right hidden sm:block">
                                    <span class="block text-base font-bold text-yellow-600">
                                        Rp {{ number_format($totalPaguAleg, 0, ',', '.') }}
                                    </span>
                                    <span class="text-xs text-gray-400 uppercase tracking-wider">Total Pagu</span>
                                </div>

                                <form action="{{ route('plans.destroyAleg') }}" method="POST">
                                    @csrf @method('DELETE')
                                    <input type="hidden" name="anggota_dprd" value="{{ $alegName }}">
                                    <button type="button"
                                        onclick="confirmDelete(this, 'Hapus SEMUA data pagu milik {{ $alegName }}?')"
                                        class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-full transition"
                                        title="Hapus Semua">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </summary>

                        <div class="p-5 border-t border-yellow-100 bg-gray-50/50">

                            <div class="mb-4 flex justify-end">
                                <button @click="defaultAleg = '{{ $alegName }}'; showModal = true" type="button"
                                    class="text-xs flex items-center gap-1 bg-yellow-100 text-yellow-800 px-4 py-2 rounded-lg hover:bg-yellow-200 font-bold border border-yellow-300 transition shadow-sm">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Tambah Kegiatan {{ $alegName }}
                                </button>
                            </div>

                            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                                <div class="overflow-x-auto">
                                    <table class="w-full text-sm text-left text-gray-600">
                                        <thead
                                            class="text-xs text-gray-700 uppercase bg-yellow-50 border-b border-yellow-100">
                                            <tr>
                                                <th class="px-4 py-3 w-10 text-center">No</th>
                                                <th class="px-4 py-3 w-1/6">OPD</th>
                                                <th class="px-4 py-3 w-1/3">Program Kegiatan</th>
                                                <th class="px-4 py-3 text-center">Volume</th>
                                                <th class="px-4 py-3 text-right">Harga Satuan</th>
                                                <th class="px-4 py-3 text-right">Pagu Total</th>
                                                <th class="px-4 py-3 text-center w-28">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-100">
                                            @foreach ($plans as $plan)
                                                <tr class="hover:bg-yellow-50/50 transition duration-150"
                                                    x-data="{ isEditing: false }">
                                                    <form id="row-form-{{ $plan->id }}"
                                                        action="{{ route('plans.update', $plan->id) }}"
                                                        method="POST" class="hidden">
                                                        @csrf @method('PUT')
                                                    </form>

                                                    <td class="px-4 py-3 text-center">{{ $loop->iteration }}</td>

                                                    <td class="px-4 py-3">
                                                        <span x-show="!isEditing"
                                                            class="font-medium text-gray-900 block truncate"
                                                            title="{{ $plan->opd_tujuan }}">{{ $plan->opd_tujuan }}</span>
                                                        <input x-show="isEditing" type="text" name="opd_tujuan"
                                                            form="row-form-{{ $plan->id }}"
                                                            value="{{ $plan->opd_tujuan }}"
                                                            class="w-full text-xs border-yellow-300 rounded focus:ring-yellow-500 focus:border-yellow-500">
                                                    </td>

                                                    <td class="px-4 py-3">
                                                        <span x-show="!isEditing"
                                                            class="leading-relaxed">{{ $plan->nama_kegiatan }}</span>
                                                        <textarea x-show="isEditing" name="nama_kegiatan" form="row-form-{{ $plan->id }}" rows="2"
                                                            class="w-full text-xs border-yellow-300 rounded focus:ring-yellow-500 focus:border-yellow-500">{{ $plan->nama_kegiatan }}</textarea>
                                                    </td>

                                                    <td class="px-4 py-3 text-center">
                                                        <span x-show="!isEditing"
                                                            class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-xs font-bold">{{ $plan->volume_target }}
                                                            {{ $plan->satuan }}</span>
                                                        <div x-show="isEditing" class="flex gap-1 justify-center">
                                                            <input type="number" name="volume_target"
                                                                form="row-form-{{ $plan->id }}"
                                                                value="{{ $plan->volume_target }}"
                                                                class="w-12 text-xs border-yellow-300 rounded text-center focus:ring-yellow-500 focus:border-yellow-500">
                                                            <input type="text" name="satuan"
                                                                form="row-form-{{ $plan->id }}"
                                                                value="{{ $plan->satuan }}"
                                                                class="w-14 text-xs border-yellow-300 rounded focus:ring-yellow-500 focus:border-yellow-500">
                                                        </div>
                                                    </td>

                                                    <td class="px-4 py-3 text-right text-gray-500">
                                                        <span
                                                            x-show="!isEditing">{{ number_format($plan->harga_satuan, 0, ',', '.') }}</span>
                                                        <input x-show="isEditing" type="text" name="harga_satuan"
                                                            form="row-form-{{ $plan->id }}" autocomplete="off"
                                                            x-init="$el.value = '{{ number_format($plan->harga_satuan, 0, ',', '.') }}'"
                                                            value="{{ number_format($plan->harga_satuan, 0, ',', '.') }}"
                                                            oninput="formatRupiah(this)"
                                                            class="w-28 text-xs border-yellow-300 rounded text-right focus:ring-yellow-500 focus:border-yellow-500">
                                                    </td>

                                                    <td class="px-4 py-3 text-right font-bold text-yellow-700">
                                                        {{ number_format($plan->pagu_total, 0, ',', '.') }}</td>

                                                    <td class="px-4 py-3 text-center">
                                                        <div x-show="!isEditing"
                                                            class="flex items-center justify-center gap-2">
                                                            <button @click="isEditing = true" type="button"
                                                                class="text-yellow-500 hover:text-yellow-700 p-1 rounded hover:bg-yellow-100"
                                                                title="Edit"><svg class="w-5 h-5" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                                    </path>
                                                                </svg></button>
                                                            <form action="{{ route('plans.destroy', $plan->id) }}"
                                                                method="POST">
                                                                @csrf @method('DELETE')
                                                                <button type="button" onclick="confirmDelete(this)"
                                                                    class="text-red-400 hover:text-red-600 p-1 rounded hover:bg-red-50"
                                                                    title="Hapus"><svg class="w-5 h-5"
                                                                        fill="none" stroke="currentColor"
                                                                        viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                                        </path>
                                                                    </svg></button>
                                                            </form>
                                                        </div>
                                                        <div x-show="isEditing"
                                                            class="flex items-center justify-center gap-2"
                                                            style="display: none;">
                                                            <button
                                                                onclick="document.getElementById('row-form-{{ $plan->id }}').submit()"
                                                                type="button"
                                                                class="text-green-600 hover:text-green-800 bg-green-100 p-1 rounded-full"
                                                                title="Simpan"><svg class="w-6 h-6" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M5 13l4 4L19 7"></path>
                                                                </svg></button>
                                                            <button @click="isEditing = false" type="button"
                                                                class="text-gray-400 hover:text-gray-600 bg-gray-100 p-1 rounded-full"
                                                                title="Batal"><svg class="w-6 h-6" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M6 18L18 6M6 6l12 12"></path>
                                                                </svg></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </details>
                @empty
                    <div
                        class="p-10 bg-white rounded-xl text-center text-gray-400 shadow-sm border border-dashed border-gray-300">
                        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <p class="text-lg font-semibold text-gray-500">Belum ada data pagu.</p>
                        <p class="text-sm">Silakan import Excel atau input manual.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div x-show="showModal" style="display: none;"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60 backdrop-blur-sm px-4"
            x-transition>
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-0 relative overflow-hidden">
                <div class="bg-yellow-400 px-6 py-4 flex justify-between items-center">
                    <h3 class="text-xl font-bold text-white">Tambah Pagu Manual</h3>
                    <button @click="showModal = false" class="text-yellow-100 hover:text-white"><svg class="w-6 h-6"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg></button>
                </div>

                <div class="p-6">
                    <form action="{{ route('plans.store') }}" method="POST">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Nama Anggota DPRD /
                                    Fraksi</label>
                                <input type="text" name="anggota_dprd" x-model="defaultAleg"
                                    placeholder="Contoh: Budi Santoso" required
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500 bg-yellow-50 font-medium text-gray-900">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">OPD Tujuan</label>
                                <input type="text" name="opd_tujuan" placeholder="Contoh: Dinas PUPR" required
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Nama Program /
                                    Kegiatan</label>
                                <textarea name="nama_kegiatan" rows="3" placeholder="Contoh: Pembangunan Jalan Tani..." required
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500"></textarea>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Volume</label>
                                    <input type="number" name="volume_target" placeholder="10" required
                                        class="w-full border-gray-300 rounded-lg shadow-sm text-center focus:ring-yellow-500 focus:border-yellow-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Satuan</label>
                                    <input type="text" name="satuan" placeholder="Paket/Unit" required
                                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Harga Satuan (Rp)</label>
                                <input type="text" name="harga_satuan" oninput="formatRupiah(this)"
                                    placeholder="0" required
                                    class="w-full border-gray-300 rounded-lg shadow-sm text-right font-mono text-lg font-bold text-yellow-600 focus:ring-yellow-500 focus:border-yellow-500">
                            </div>
                        </div>
                        <div class="mt-8 flex justify-end gap-3">
                            <button @click="showModal = false" type="button"
                                class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 font-medium">Batal</button>
                            <button type="submit"
                                class="px-5 py-2.5 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 font-bold shadow-md">Simpan
                                Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function formatRupiah(input) {
            let value = input.value.replace(/\D/g, '');
            if (value !== '') {
                input.value = new Intl.NumberFormat('id-ID').format(value);
            } else {
                input.value = '';
            }
        }
    </script>
</x-app-layout>

===== resources\views\pokir\create-bulk.blade.php =====
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Input Massal E-POKIR') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="bulkInput()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <form method="POST" action="{{ route('pokir.storeBulk') }}">
                @csrf

                <div class="p-6 bg-white shadow-sm sm:rounded-lg mb-6 border-l-4 border-indigo-600">
                    <div class="flex items-center justify-between mb-5 border-b pb-2">
                        <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-5 text-indigo-600">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                            1. Data Umum (Header)
                        </h3>
                        <span class="text-xs font-medium text-gray-500 bg-gray-100 px-3 py-1 rounded-full">
                            Data ini akan diterapkan ke semua usulan di bawah
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div>
                            <x-input-label value="Kategori Usulan" class="mb-1" />
                            <div class="relative">
                                <select name="kategori_usulan"
                                    class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm"
                                    required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach ($kategoris as $kat)
                                        <option value="{{ $kat->nama_kategori }}">{{ $kat->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div>
                            <x-input-label value="OPD Tujuan" class="mb-1" />
                            <select name="opd_tujuan"
                                class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm"
                                required>
                                <option value="">-- Pilih OPD --</option>
                                @foreach ($opds as $opd)
                                    <option value="{{ $opd->nama_dinas }}">{{ $opd->nama_dinas }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label value="Anggota DPRD Pengusul" class="mb-1" />
                            <select name="anggota_dprd"
                                class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm"
                                required>
                                <option value="">-- Pilih Aleg --</option>
                                @foreach ($alegs as $aleg)
                                    <option value="{{ $aleg->nama }}">{{ $aleg->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label value="Penerima (Operator)" class="mb-1" />
                            <x-text-input name="operator_penerima"
                                class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm"
                                placeholder="Nama Operator (Opsional)" />
                        </div>
                    </div>
                </div>

                <div class="p-6 bg-white shadow sm:rounded-lg">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-gray-900">2. Daftar Usulan (Detail)</h3>
                        <button type="button" @click="addRow()"
                            class="px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 text-sm font-bold">
                            + Tambah Baris
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase w-48">
                                        Spesifikasi (Judul Kecil)</th>
                                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama
                                        Pemohon *</th>
                                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase">NIK / HP
                                    </th>
                                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase w-64">
                                        Alamat *</th>
                                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase">Ket
                                        Berkas</th>
                                    <th class="px-2 py-2"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <template x-for="(row, index) in rows" :key="index">
                                    <tr>
                                        <td class="px-2 py-2 text-center" x-text="index + 1"></td>

                                        <td class="px-2 py-2">
                                            <input type="text" :name="'details[' + index + '][spesifikasi]'"
                                                class="w-full text-sm border-gray-300 rounded-md shadow-sm"
                                                placeholder="Cth: KIOS">
                                        </td>

                                        <td class="px-2 py-2">
                                            <input type="text" :name="'details[' + index + '][nama_pemohon]'"
                                                class="w-full text-sm border-gray-300 rounded-md shadow-sm" required>
                                        </td>

                                        <td class="px-2 py-2">
                                            <input type="text" :name="'details[' + index + '][identitas_pemohon]'"
                                                class="w-full text-sm border-gray-300 rounded-md shadow-sm">
                                        </td>

                                        <td class="px-2 py-2">
                                            <input type="text" :name="'details[' + index + '][alamat]'"
                                                class="w-full text-sm border-gray-300 rounded-md shadow-sm" required>
                                        </td>

                                        <td class="px-2 py-2">
                                            <input type="text" :name="'details[' + index + '][status_berkas]'"
                                                class="w-full text-sm border-gray-300 rounded-md shadow-sm"
                                                placeholder="1 Proposal">
                                        </td>

                                        <td class="px-2 py-2 text-center">
                                            <button type="button" @click="removeRow(index)"
                                                class="text-red-600 hover:text-red-900 font-bold">X</button>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <x-primary-button class="w-full md:w-auto justify-center py-3 text-base">
                            {{ __('SIMPAN SEMUA DATA') }}
                        </x-primary-button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function bulkInput() {
            return {
                // Inisialisasi 5 baris kosong
                rows: [{}, {}, {}, {}, {}],

                addRow() {
                    this.rows.push({});
                },
                removeRow(index) {
                    if (this.rows.length > 1) {
                        this.rows.splice(index, 1);
                    }
                }
            }
        }
    </script>
</x-app-layout>

===== resources\views\pokir\create.blade.php =====
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Input Usulan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form method="POST" action="{{ route('pokir.store') }}" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">Detail Usulan</h3>
                        </div>

                        <div>
                            <x-input-label for="kategori" value="Kategori Usulan" />
                            <select id="kategori" name="kategori_usulan" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">-- Pilih Kategori --</option>
                                <option value="Bantuan UMKM">Bantuan UMKM</option>
                                <option value="Bantuan IKM">Bantuan IKM</option>
                                <option value="Pembangunan Jalan">Pembangunan Jalan</option>
                                <option value="Bantuan Pertanian">Bantuan Pertanian</option>
                                <option value="Bantuan Perikanan">Bantuan Perikanan</option>
                                <option value="Beasiswa Pendidikan">Beasiswa Pendidikan</option>
                            </select>
                        </div>

                        <div>
                            <x-input-label for="spesifikasi" value="Spesifikasi (Opsional)" />
                            <x-text-input id="spesifikasi" name="spesifikasi" class="mt-1 block w-full" placeholder="Cth: KIOS / Bengkel" />
                        </div>

                        <div class="md:col-span-2">
                            <x-input-label for="opd" value="OPD Tujuan" />
                            <select id="opd" name="opd_tujuan" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">-- Pilih OPD --</option>
                                <option value="Dinas Koperindag">Dinas Koperindag</option>
                                <option value="Dinas PUPR">Dinas PUPR</option>
                                <option value="Dinas Pertanian">Dinas Pertanian</option>
                                <option value="Dinas Sosial">Dinas Sosial</option>
                                <option value="Dinas Pendidikan">Dinas Pendidikan</option>
                            </select>
                        </div>

                        <div class="md:col-span-2 mt-4">
                            <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">Data Pemohon</h3>
                        </div>

                        <div>
                            <x-input-label for="pemohon" value="Nama Pemohon" />
                            <x-text-input id="pemohon" name="nama_pemohon" class="mt-1 block w-full" required />
                        </div>
                        <div>
                            <x-input-label for="identitas" value="Identitas (NIK/HP)" />
                            <x-text-input id="identitas" name="identitas_pemohon" class="mt-1 block w-full" />
                        </div>
                        <div class="md:col-span-2">
                            <x-input-label for="alamat" value="Alamat Lengkap" />
                            <textarea id="alamat" name="alamat" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="2" required></textarea>
                        </div>

                        <div class="md:col-span-2 mt-4">
                            <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">Data Internal</h3>
                        </div>

                        <div>
                            <x-input-label for="aleg" value="Anggota DPRD Pengusul" />
                            <x-text-input id="aleg" name="anggota_dprd" class="mt-1 block w-full" required />
                        </div>
                        <div>
                            <x-input-label for="berkas" value="Ket Berkas" />
                            <x-text-input id="berkas" name="status_berkas" class="mt-1 block w-full" placeholder="Cth: 1 Bundel" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-4 mt-6 border-t pt-4">
                        <a href="{{ route('pokir.index') }}" class="text-gray-600 hover:text-gray-900">Batal</a>
                        <x-primary-button>{{ __('Simpan Data') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

===== resources\views\pokir\index.blade.php =====
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar E-POKIR') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="p-4 bg-white shadow sm:rounded-lg">
                <form method="GET" action="{{ route('pokir.index') }}">
                    <div class="flex flex-col md:flex-row gap-4 items-end">
                        
                        <div class="w-full md:w-1/4">
                            <x-input-label value="Filter Kategori" />
                            <select name="kategori_usulan" class="mt-1 block w-full text-sm border-gray-300 rounded-md shadow-sm">
                                <option value="">Semua Kategori</option>
                                <option value="Bantuan UMKM" {{ request('kategori_usulan') == 'Bantuan UMKM' ? 'selected' : '' }}>Bantuan UMKM</option>
                                <option value="Bantuan IKM" {{ request('kategori_usulan') == 'Bantuan IKM' ? 'selected' : '' }}>Bantuan IKM</option>
                                <option value="Pembangunan Jalan" {{ request('kategori_usulan') == 'Pembangunan Jalan' ? 'selected' : '' }}>Pembangunan Jalan</option>
                                <option value="Bantuan Pertanian" {{ request('kategori_usulan') == 'Bantuan Pertanian' ? 'selected' : '' }}>Bantuan Pertanian</option>
                            </select>
                        </div>

                        <div class="w-full md:w-1/4">
                            <x-input-label value="Filter OPD" />
                            <select name="opd_tujuan" class="mt-1 block w-full text-sm border-gray-300 rounded-md shadow-sm">
                                <option value="">Semua OPD</option>
                                <option value="Dinas Koperindag" {{ request('opd_tujuan') == 'Dinas Koperindag' ? 'selected' : '' }}>Dinas Koperindag</option>
                                <option value="Dinas PUPR" {{ request('opd_tujuan') == 'Dinas PUPR' ? 'selected' : '' }}>Dinas PUPR</option>
                                <option value="Dinas Pertanian" {{ request('opd_tujuan') == 'Dinas Pertanian' ? 'selected' : '' }}>Dinas Pertanian</option>
                            </select>
                        </div>

                        <div class="w-full md:w-1/4">
                            <x-input-label value="Cari Nama Aleg" />
                            <x-text-input name="anggota_dprd" value="{{ request('anggota_dprd') }}" class="mt-1 block w-full text-sm" placeholder="Nama Aleg..." />
                        </div>

                        <div class="w-full md:w-auto pb-0.5">
                            <x-primary-button type="submit" class="h-10">Cari / Filter</x-primary-button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="bg-white shadow sm:rounded-lg overflow-hidden">
                <div class="p-4 border-b border-gray-200 flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="text-gray-600">
                        Menampilkan <strong>{{ $pokirs->count() }}</strong> data
                        @if(request('kategori_usulan')) <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded">Kat: {{ request('kategori_usulan') }}</span> @endif
                        @if(request('opd_tujuan')) <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded">OPD: {{ request('opd_tujuan') }}</span> @endif
                    </div>

                    <div class="flex gap-2">
                        <a href="{{ route('pokir.print', request()->query()) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300">
                            Cetak
                        </a>
                        
                        <a href="{{ route('pokir.export', request()->query()) }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500">
                            Excel
                        </a>

                        <a href="{{ route('pokir.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500">
                            + Input Baru
                        </a>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pemohon</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aleg</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">OPD</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($pokirs as $index => $pokir)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ $index + 1 }}</td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $pokir->judul_lengkap }}</div>
                                    <div class="text-xs text-gray-500">{{ $pokir->alamat }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $pokir->nama_pemohon }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $pokir->anggota_dprd }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $pokir->opd_tujuan }}</td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ $pokir->status_berkas ?? '-' }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada data ditemukan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-4 border-t border-gray-200">
                    {{ $pokirs->withQueryString()->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

===== resources\views\pokir\print.blade.php =====
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Tanda Terima Pokir</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid black; padding: 5px; text-align: left; vertical-align: top; }
        th { background-color: #f0f0f0; text-align: center; }
        
        /* Layout Tanda Tangan sesuai gambar */
        .signature-container {
            width: 100%;
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
        }
        .sig-box {
            width: 40%;
            text-align: center;
        }
        .date-line {
            text-align: center;
            margin-bottom: 10px;
        }
        .sig-space {
            height: 60px; /* Ruang untuk tanda tangan */
        }
        
        /* Agar saat diprint tampilan bersih */
        @media print {
            button { display: none; }
            @page { size: landscape; margin: 1cm; }
        }
    </style>
</head>
<body onload="window.print()">

    <h2 style="text-align: center;">DAFTAR USULAN POKOK-POKOK PIKIRAN (POKIR)</h2>
    
    <table>
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th>Judul Permohonan</th> <th>Alamat</th>
                <th>Yang Bermohon</th>
                <th>Identitas</th>
                <th>Anggota DPRD Pengusul</th>
                <th>Ket Berkas</th>
                <th>Ket Penerima</th>
                <th>Dinas Terkait</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pokirs as $pokir)
            <tr>
                <td style="text-align: center">{{ $loop->iteration }}</td>
                <td>{{ $pokir->judul_lengkap }}</td> 
                <td>{{ $pokir->alamat }}</td>
                <td>{{ $pokir->nama_pemohon }}</td>
                <td>{{ $pokir->identitas_pemohon }}</td>
                <td>{{ $pokir->anggota_dprd }}</td>
                <td style="text-align: center">{{ $pokir->status_berkas }}</td>
                <td style="text-align: center">{{ $pokir->operator_penerima }}</td>
                <td>{{ $pokir->opd_tujuan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="signature-container">
        <div class="sig-box">
            <br> <div>YANG MENYERAHKAN</div>
            <div>Pendamping Fraksi Golkar</div>
            <div>Set. DPRD Provinsi Gorontalo</div>
            
            <div class="sig-space"></div>
            
            <div style="font-weight: bold; text-decoration: underline;">IVHON</div>
        </div>

        <div class="sig-box">
            <div class="date-line">Gorontalo, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</div>
            <div>YANG MENERIMA</div>
            
            <div class="sig-space"></div>
            
            <div style="border-bottom: 1px solid black; width: 80%; margin: 0 auto;">&nbsp;</div>
            <div style="text-align: left; margin-left: 10%; margin-top: 5px;">NO. HP :</div>
        </div>
    </div>

</body>
</html>

===== resources\views\profile\partials\delete-user-form.blade.php =====
<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Delete Account') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>

===== resources\views\profile\partials\update-password-form.blade.php =====
<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

===== resources\views\profile\partials\update-profile-information-form.blade.php =====
<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

===== resources\views\profile\edit.blade.php =====
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

===== resources\views\reses\index.blade.php =====
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center sticky top-0 z-50">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Generator SPJ Reses (Final)') }}
            </h2>
            <button onclick="document.getElementById('btn-submit').click()" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg font-bold text-sm shadow-md flex items-center gap-2 transition transform hover:scale-105">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                DOWNLOAD PDF
            </button>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-600 min-h-screen" x-data="resesApp()" x-init="initData()">
        
        <form id="form-pdf" action="{{ route('reses.print') }}" method="POST" target="_blank">
            @csrf

            <div class="max-w-7xl mx-auto px-4 mb-8">
                <div class="bg-white rounded-lg shadow-lg p-6 border-l-4 border-yellow-500">
                    
                    <div class="mb-6 border-b pb-4 bg-yellow-50 p-4 rounded-lg">
                        <label class="text-sm font-bold text-gray-700 block mb-2">PILIH FORMAT HEADER:</label>
                        <select name="global_header_type" x-model="global.header_type" class="w-full md:w-1/2 border-gray-300 rounded font-bold text-gray-800 focus:ring-yellow-500">
                            <option value="standar">Format A: Standar (Transport, Makan, dll)</option>
                            <option value="tatap_muka">Format B: Tatap Muka (Ada Deskripsi)</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="text-xs font-bold text-gray-500 uppercase">Masa Sidang</label>
                            <textarea name="global_masa_sidang" x-model="global.masa_sidang" rows="2" class="w-full text-sm border-gray-300 rounded focus:ring-yellow-500"></textarea>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-500 uppercase">Dapil / Wilayah</label>
                            <textarea name="global_dapil" x-model="global.dapil" rows="2" class="w-full text-sm border-gray-300 rounded focus:ring-yellow-500"></textarea>
                        </div>
                        
                        <div x-show="global.header_type == 'tatap_muka'" class="col-span-1 md:col-span-2 bg-blue-50 p-3 rounded border border-blue-200" x-transition>
                            <label class="text-xs font-bold text-blue-700 uppercase">Deskripsi Kegiatan (Tatap Muka)</label>
                            <textarea name="global_deskripsi" x-model="global.deskripsi" rows="2" class="w-full text-sm border-blue-300 rounded focus:ring-blue-500" placeholder="Contoh: Tatap muka dengan masyarakat Desa..."></textarea>
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <label class="text-xs font-bold text-gray-500 uppercase">Tanggal (Otomatis ke semua halaman)</label>
                            <input type="text" name="global_tanggal" x-model="global.tanggal" class="w-full text-sm border-gray-300 rounded focus:ring-yellow-500 font-bold">
                        </div>
                    </div>

                    <div class="space-y-2 mb-4 bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-bold text-xs text-gray-500 mb-2 uppercase">Daftar Halaman:</h4>
                        <template x-for="(config, index) in masterConfig" :key="index">
                            <div class="flex items-center gap-2">
                                <span class="text-gray-500 font-mono w-6 text-sm" x-text="index+1 + '.'"></span>
                                <input type="text" x-model="config.title" class="flex-grow text-sm border-gray-300 rounded font-bold uppercase" placeholder="JUDUL HALAMAN">
                                <select x-model="config.layout" class="text-sm border-gray-300 rounded w-40">
                                    <option value="8">8 Kotak</option>
                                    <option value="6">6 Kotak</option>
                                    <option value="3">3 Kotak</option>
                                </select>
                                <button type="button" @click="removeMasterItem(index)" class="text-red-500 hover:text-red-700 p-1">Hapus</button>
                            </div>
                        </template>
                        <button type="button" @click="addMasterItem()" class="text-sm text-blue-600 hover:underline font-bold mt-2">+ Tambah Halaman</button>
                    </div>

                    <div class="flex justify-end border-t pt-4">
                        <button type="button" @click="generateFromMaster()" class="bg-green-600 text-white px-6 py-3 rounded-lg font-bold shadow-lg hover:bg-green-700 transition flex items-center gap-2">
                            GENERATE LEMBAR KERJA
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex flex-col items-center gap-8 pb-32">
                <template x-for="(sheet, sheetIndex) in sheets" :key="sheet.id">
                    <div class="relative group/sheet">
                        <div class="bg-white shadow-2xl relative transition-all" style="width: 210mm; min-height: 297mm; padding: 10mm; padding-bottom: 20mm;">
                            
                            <div class="text-center mb-4 font-tahoma text-12pt">
                                
                                <template x-if="global.header_type == 'standar'">
                                    <div>
                                        <div class="mb-1">Lampiran Fhoto</div>
                                        <div x-text="sheet.title" class="font-bold uppercase"></div>
                                        <div x-text="global.masa_sidang"></div>
                                        <div x-text="global.dapil"></div>
                                    </div>
                                </template>

                                <template x-if="global.header_type == 'tatap_muka'">
                                    <div>
                                        <div>Lampiran</div>
                                        <div class="mb-1">Foto</div>
                                        <div x-text="global.masa_sidang"></div>
                                        <div class="mb-1">Daerah</div>
                                        <div x-text="global.dapil"></div>
                                        <div x-text="global.deskripsi" class="mt-1 font-bold"></div>
                                    </div>
                                </template>

                                <div x-text="sheet.tanggal" class="mt-1"></div>
                                
                                <input type="hidden" :name="`sheets[${sheetIndex}][title]`" :value="sheet.title">
                                <input type="hidden" :name="`sheets[${sheetIndex}][tanggal]`" :value="sheet.tanggal">
                                <input type="hidden" :name="`sheets[${sheetIndex}][layout]`" :value="sheet.layout">
                            </div>

                            <div class="grid grid-cols-2 gap-x-[5mm] gap-y-[5mm]" 
                                 @dragover.prevent="isDragging = true" 
                                 @dragleave.prevent="isDragging = false"
                                 @drop.prevent="handleBatchDrop($event, sheetIndex); isDragging = false">
                                <template x-for="(photo, photoIndex) in sheet.photos" :key="photoIndex">
                                    <div class="relative border-2 border-black bg-gray-50 group/box hover:border-blue-500 transition overflow-hidden"
                                         :class="{'col-span-2': sheet.layout == '3' && photoIndex === 0}"
                                         :style="`height: ${getBoxHeight(sheet.layout)}`">
                                        
                                        <input type="hidden" :name="`sheets[${sheetIndex}][photos][]`" :value="photo">
                                        <template x-if="photo">
                                            <div class="w-full h-full relative">
                                                <img :src="photo" class="w-full h-full object-cover">
                                                <button type="button" @click="removePhoto(sheetIndex, photoIndex)" class="absolute top-1 right-1 bg-white text-red-600 rounded-full p-1 opacity-0 group-hover/box:opacity-100 transition z-10 shadow"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                                            </div>
                                        </template>
                                        <template x-if="!photo">
                                            <div class="absolute inset-0 flex flex-col items-center justify-center text-gray-300 pointer-events-none">
                                                <span class="text-2xl font-bold" x-text="photoIndex + 1"></span>
                                                <span class="text-xs">DROP</span>
                                            </div>
                                        </template>
                                        <template x-if="!photo">
                                            <input type="file" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" @change="handleSingleFile($event, sheetIndex, photoIndex)">
                                        </template>
                                    </div>
                                </template>
                            </div>
                            <div class="absolute bottom-2 right-6 text-gray-400 text-xs font-mono">Halaman <span x-text="sheetIndex + 1"></span></div>
                        </div>
                    </div>
                </template>
            </div>
            
            <button type="button" id="btn-submit" @click="submitPDF()" class="hidden"></button>
            <div x-show="isProcessing" class="fixed inset-0 bg-black/80 flex items-center justify-center z-[60]"><div class="bg-white p-6 rounded-lg text-center"><p class="font-bold">Memproses...</p></div></div>
        </form>
    </div>
    <script src="{{ asset('js/reses-logic.js') }}"></script>
    <style>
        .font-tahoma { font-family: Tahoma, sans-serif; }
        .text-12pt { font-size: 12pt; line-height: 1.3; }
        input:focus, textarea:focus { box-shadow: none !important; border-color: transparent !important; outline: none; }
    </style>
</x-app-layout>

===== resources\views\reses\pdf.blade.php =====
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan SPJ</title>
    <style>
        @page { margin: 10mm; margin-bottom: 5mm; margin-left: 10mm; margin-right: 10mm; }
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 12pt; }
        
        .page-container { page-break-after: always; width: 100%; }
        .page-container:last-child { page-break-after: avoid; }

        .header { text-align: center; margin-bottom: 5mm; }
        .header p { margin: 1px 0; font-size: 12pt; }
        .h-bold { font-weight: bold; text-transform: uppercase; }

        .grid-table { width: 100%; table-layout: fixed; border-collapse: collapse; margin-left: -2.5mm; margin-right: -2.5mm; }
        .grid-table td { padding: 2.5mm; vertical-align: top; }

        /* BORDER DIUBAH KE 3PX SESUAI REQUEST */
        .photo-box { border: 3px solid #000; background-color: #fff; width: 100%; position: relative; overflow: hidden; display: block; }
        .photo-img { width: 100%; height: 100%; object-fit: cover; display: block; }
        
        /* --- TINGGI BOX --- */
        .h-55mm { height: 55mm; } /* Standar 8 Kotak */
        .h-48mm { height: 48mm; } /* KHUSUS Format B (Header Tinggi) */
        
        .h-75mm { height: 75mm; } /* 6 Kotak */
        .h-110mm { height: 110mm; } /* 3 Kotak */

        .empty-text { text-align: center; color: #ccc; font-weight: bold; font-size: 20px; padding-top: 25%; }
    </style>
</head>
<body>

    @foreach($sheets as $sheet)
    <div class="page-container">
        
        <div class="header">
            @if($global_header_type == 'standar')
                <p>Lampiran Fhoto</p>
                <p class="h-bold">{{ $sheet['title'] ?? 'KEGIATAN' }}</p>
                <p>{{ $global_masa_sidang }}</p>
                <p>{{ $global_dapil }}</p>
                <p>{{ $sheet['tanggal'] ?? '' }}</p>
            @elseif($global_header_type == 'tatap_muka')
                <p>Lampiran</p>
                <p>Foto</p>
                <p>{{ $global_masa_sidang }}</p>
                <p>Daerah</p>
                <p>{{ $global_dapil }}</p>
                <p class="h-bold">{{ $global_deskripsi }}</p>
                <p>{{ $sheet['tanggal'] ?? '' }}</p>
            @endif
        </div>

        <table class="grid-table">
            @php 
                $photos = $sheet['photos'];
                $layout = (int)$sheet['layout'];
            @endphp

            @if($layout == 3)
                {{-- LAYOUT 3 KOTAK --}}
                <tr>
                    <td colspan="2"><div class="photo-box h-110mm">@if(!empty($photos[0])) <img src="{{ $photos[0] }}" class="photo-img"> @else <div class="empty-text">1</div> @endif</div></td>
                </tr>
                <tr>
                    <td width="50%"><div class="photo-box h-110mm">@if(!empty($photos[1])) <img src="{{ $photos[1] }}" class="photo-img"> @else <div class="empty-text">2</div> @endif</div></td>
                    <td width="50%"><div class="photo-box h-110mm">@if(!empty($photos[2])) <img src="{{ $photos[2] }}" class="photo-img"> @else <div class="empty-text">3</div> @endif</div></td>
                </tr>
            @else
                {{-- LAYOUT 6 & 8 --}}
                @php 
                    // LOGIKA TINGGI BOX:
                    if ($layout == 6) {
                        $heightClass = 'h-75mm';
                    } else {
                        // Jika Layout 8: Cek Header Type
                        // Kalau 'tatap_muka', header tinggi -> kotak harus pendek (48mm)
                        // Kalau 'standar', header pendek -> kotak standar (55mm)
                        $heightClass = ($global_header_type == 'tatap_muka') ? 'h-48mm' : 'h-55mm';
                    }
                @endphp

                @for($i = 0; $i < count($photos); $i += 2)
                <tr>
                    <td width="50%"><div class="photo-box {{ $heightClass }}">@if(!empty($photos[$i])) <img src="{{ $photos[$i] }}" class="photo-img"> @else <div class="empty-text">{{ $i + 1 }}</div> @endif</div></td>
                    <td width="50%"><div class="photo-box {{ $heightClass }}">@if(isset($photos[$i+1]) && !empty($photos[$i+1])) <img src="{{ $photos[$i+1] }}" class="photo-img"> @elseif($i+1 < $layout) <div class="empty-text">{{ $i + 2 }}</div> @endif</div></td>
                </tr>
                @endfor
            @endif
        </table>
    </div>
    @endforeach

</body>
</html>

===== resources\views\dashboard.blade.php =====
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Executive Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-indigo-500 flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Total Usulan Masuk</p>
                        <h3 class="text-3xl font-bold text-gray-800">{{ $totalUsulan }}</h3>
                    </div>
                    <div class="p-3 bg-indigo-50 rounded-full text-indigo-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-green-500 flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">OPD Terlibat</p>
                        <h3 class="text-3xl font-bold text-gray-800">{{ $totalOpd }}</h3>
                    </div>
                    <div class="p-3 bg-green-50 rounded-full text-green-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-orange-500 flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Aleg Pengusul</p>
                        <h3 class="text-3xl font-bold text-gray-800">{{ $totalAleg }}</h3>
                    </div>
                    <div class="p-3 bg-orange-50 rounded-full text-orange-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <div class="bg-white p-6 rounded-xl shadow-sm lg:col-span-1">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Distribusi Kategori</h3>
                    <div class="relative h-64">
                        <canvas id="kategoriChart"></canvas>
                    </div>
                    <p class="text-xs text-center text-gray-400 mt-2">Proporsi usulan berdasarkan jenis kategori</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm lg:col-span-2">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2 flex justify-between">
                        <span>Peringkat Usulan OPD</span>
                        <span class="text-sm font-normal text-gray-500 bg-gray-100 px-2 py-1 rounded">Top Active</span>
                    </h3>
                    
                    <div class="overflow-y-auto h-64 pr-2 custom-scrollbar">
                        <table class="w-full text-sm text-left">
                            <thead class="text-xs text-gray-500 uppercase bg-gray-50 sticky top-0">
                                <tr>
                                    <th class="px-4 py-2">Nama Dinas (OPD)</th>
                                    <th class="px-4 py-2 text-right">Jumlah</th>
                                    <th class="px-4 py-2 text-right">Persentase</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($statsOpd as $opd)
                                @php 
                                    $persen = ($opd->total / $totalUsulan) * 100;
                                @endphp
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 font-medium text-gray-700">{{ $opd->opd_tujuan }}</td>
                                    <td class="px-4 py-3 text-right font-bold text-indigo-600">{{ $opd->total }}</td>
                                    <td class="px-4 py-3 text-right text-gray-500">{{ round($persen, 1) }}%</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm">
                <h3 class="text-lg font-bold text-gray-800 mb-6 border-b pb-2">Perolehan Usulan Anggota DPRD</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                    @foreach($statsAleg as $aleg)
                    @php
                        // Menghitung lebar progress bar (relatif terhadap nilai tertinggi)
                        $width = ($aleg->total / $maxAleg) * 100;
                        // Warna progress bar dinamis (Top 3 beda warna)
                        $colorClass = $loop->iteration <= 3 ? 'bg-indigo-500' : 'bg-gray-400';
                    @endphp
                    <div class="flex items-center group">
                        <div class="w-1/3 text-sm font-medium text-gray-700 truncate pr-2" title="{{ $aleg->anggota_dprd }}">
                            {{ $aleg->anggota_dprd }}
                        </div>
                        
                        <div class="w-full bg-gray-100 rounded-full h-4 mr-3 relative overflow-hidden">
                            <div class="{{ $colorClass }} h-4 rounded-full transition-all duration-1000 ease-out group-hover:bg-indigo-600" style="width: {{ $width }}%"></div>
                        </div>
                        
                        <div class="w-10 text-right text-sm font-bold text-gray-800">{{ $aleg->total }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Setup Donut Chart Kategori
            const ctxKategori = document.getElementById('kategoriChart').getContext('2d');
            new Chart(ctxKategori, {
                type: 'doughnut', // Ganti jadi doughnut biar lebih modern drpd pie
                data: {
                    labels: @json($labelKategori),
                    datasets: [{
                        data: @json($dataKategori),
                        backgroundColor: [
                            '#4F46E5', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6', '#EC4899'
                        ],
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'right', labels: { boxWidth: 12, font: { size: 11 } } }
                    },
                    cutout: '70%', // Bikin lubang tengah lebih besar (Modern Look)
                }
            });
        });
    </script>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #9ca3af; }
    </style>
</x-app-layout>

===== resources\views\welcome.blade.php =====
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'E-POKIR Golkar') }}</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans text-gray-900 bg-white selection:bg-yellow-200 selection:text-yellow-900">

    <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo-golkar.png') }}" alt="Logo" class="h-10 w-auto drop-shadow-sm">
                    <div class="leading-tight hidden sm:block">
                        <span class="block text-lg font-extrabold text-yellow-500 tracking-wide uppercase">Fraksi Partai Golkar</span>
                        <span class="block text-xs font-semibold text-gray-500 tracking-wider">DPRD Provinsi Gorontalo</span>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="font-bold text-gray-700 hover:text-yellow-600 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="px-6 py-2.5 bg-yellow-500 text-white font-bold rounded-full shadow-lg shadow-yellow-500/30 hover:bg-yellow-600 hover:shadow-yellow-500/50 transition transform hover:-translate-y-0.5">
                                Masuk Sistem
                            </a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <section class="relative pt-32 pb-20 lg:pt-40 lg:pb-28 overflow-hidden">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-yellow-100 rounded-full blur-3xl opacity-50 z-0"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-yellow-50 rounded-full blur-3xl opacity-50 z-0"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                
                <div class="text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-yellow-50 border border-yellow-200 text-yellow-700 text-xs font-bold uppercase tracking-wider mb-6">
                        <span class="w-2 h-2 rounded-full bg-yellow-500 animate-pulse"></span>
                        Sistem Informasi Pokok Pikiran
                    </div>
                    
                    <h1 class="text-5xl lg:text-6xl font-extrabold text-gray-900 leading-tight mb-6">
                        Karya Nyata untuk <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-500 to-yellow-600">Aspirasi Rakyat.</span>
                    </h1>
                    
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed max-w-2xl mx-auto lg:mx-0">
                        Platform digital Fraksi Partai Golkar untuk pengelolaan Pokok Pikiran DPRD yang transparan, akuntabel, dan tepat sasaran demi pembangunan Gorontalo yang lebih maju.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="{{ route('login') }}" class="px-8 py-4 bg-gray-900 text-white font-bold rounded-xl shadow-xl hover:bg-gray-800 transition transform hover:-translate-y-1 flex items-center justify-center gap-2">
                            Mulai Sekarang
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                        <a href="#features" class="px-8 py-4 bg-white text-gray-700 border border-gray-200 font-bold rounded-xl hover:bg-gray-50 hover:text-yellow-600 transition flex items-center justify-center">
                            Pelajari Fitur
                        </a>
                    </div>
                </div>

                <div class="relative hidden lg:block">
                    <div class="absolute top-0 right-0 bg-white p-4 rounded-2xl shadow-2xl border border-gray-100 z-20 transform rotate-3 animate-float-slow">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <div>
                                <div class="text-xs text-gray-400">Status</div>
                                <div class="font-bold text-gray-800">Usulan Disetujui</div>
                            </div>
                        </div>
                        <div class="h-2 w-32 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full bg-green-500 w-full"></div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-yellow-500 to-yellow-400 rounded-3xl p-1 shadow-2xl transform -rotate-1">
                        <div class="bg-white rounded-[20px] overflow-hidden h-96 flex items-center justify-center relative">
                            <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#F59E0B 1px, transparent 1px); background-size: 20px 20px;"></div>
                            
                            <div class="text-center p-8">
                                <img src="{{ asset('images/logo-golkar.png') }}" class="h-24 mx-auto mb-4 opacity-90" alt="Golkar">
                                <h3 class="text-2xl font-bold text-gray-800">E-POKIR</h3>
                                <p class="text-gray-500 mt-2">Elektronik Pokok Pikiran DPRD</p>
                            </div>
                        </div>
                    </div>

                    <div class="absolute bottom-10 left-0 bg-white p-4 rounded-2xl shadow-2xl border border-gray-100 z-20 transform -rotate-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <div class="text-xs text-gray-400">Total Pagu</div>
                                <div class="font-bold text-gray-800">Rp 15.000.000.000</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section id="features" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Suara Golkar, Suara Rakyat</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Kami menghadirkan sistem yang memudahkan pengelolaan aspirasi masyarakat agar terealisasi secara efektif.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1 transition border border-gray-100">
                    <div class="w-14 h-14 bg-yellow-100 rounded-xl flex items-center justify-center text-yellow-600 mb-6">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Transparansi Data</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Seluruh usulan dan pagu anggaran tercatat secara digital, meminimalisir kesalahan dan memudahkan pelacakan program.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1 transition border border-gray-100">
                    <div class="w-14 h-14 bg-yellow-100 rounded-xl flex items-center justify-center text-yellow-600 mb-6">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Efisiensi Proses</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Dari input usulan Excel hingga rekapitulasi per Aleg dilakukan secara otomatis, mempercepat proses kerja administrasi.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1 transition border border-gray-100">
                    <div class="w-14 h-14 bg-yellow-100 rounded-xl flex items-center justify-center text-yellow-600 mb-6">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Akurasi & Realisasi</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Memastikan setiap pagu anggaran terserap sesuai dengan program kegiatan yang paling dibutuhkan masyarakat Gorontalo.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-white border-t border-gray-200 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo-golkar.png') }}" alt="Logo" class="h-8 w-auto grayscale opacity-50 hover:grayscale-0 hover:opacity-100 transition">
                <span class="text-sm font-semibold text-gray-500">
                    &copy; 2026 Fraksi Partai Golkar Gorontalo.
                </span>
            </div>
            <div class="flex gap-6 text-sm text-gray-400 font-medium">
                <a href="#" class="hover:text-yellow-600 transition">Kebijakan Privasi</a>
                <a href="#" class="hover:text-yellow-600 transition">Syarat & Ketentuan</a>
                <a href="#" class="hover:text-yellow-600 transition">Kontak Admin</a>
            </div>
        </div>
    </footer>

    <style>
        @keyframes float-slow {
            0%, 100% { transform: translateY(0) rotate(3deg); }
            50% { transform: translateY(-10px) rotate(3deg); }
        }
        .animate-float-slow {
            animation: float-slow 5s ease-in-out infinite;
        }
    </style>
</body>
</html>

```


## Entry Points & Main Configs Content
```
===== public\index.php =====
<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());

===== artisan =====
#!/usr/bin/env php
<?php

use Illuminate\Foundation\Application;
use Symfony\Component\Console\Input\ArgvInput;

define('LARAVEL_START', microtime(true));

// Register the Composer autoloader...
require __DIR__.'/vendor/autoload.php';

// Bootstrap Laravel and handle the command...
/** @var Application $app */
$app = require_once __DIR__.'/bootstrap/app.php';

$status = $app->handleCommand(new ArgvInput);

exit($status);

===== resources\js\app.js =====
import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

===== vite.config.js =====
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});

===== config\app.php =====
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application, which will be used when the
    | framework needs to place the application's name in a notification or
    | other UI elements where an application name needs to be displayed.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | the application so that it's available within Artisan commands.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. The timezone
    | is set to "UTC" by default as it is suitable for most use cases.
    |
    */

    'timezone' => 'UTC',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by Laravel's translation / localization methods. This option can be
    | set to any locale for which you plan to have translation strings.
    |
    */

    'locale' => env('APP_LOCALE', 'en'),

    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'en'),

    'faker_locale' => env('APP_FAKER_LOCALE', 'en_US'),

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is utilized by Laravel's encryption services and should be set
    | to a random, 32 character string to ensure that all encrypted values
    | are secure. You should do this prior to deploying the application.
    |
    */

    'cipher' => 'AES-256-CBC',

    'key' => env('APP_KEY'),

    'previous_keys' => [
        ...array_filter(
            explode(',', (string) env('APP_PREVIOUS_KEYS', ''))
        ),
    ],

    /*
    |--------------------------------------------------------------------------
    | Maintenance Mode Driver
    |--------------------------------------------------------------------------
    |
    | These configuration options determine the driver used to determine and
    | manage Laravel's "maintenance mode" status. The "cache" driver will
    | allow maintenance mode to be controlled across multiple machines.
    |
    | Supported drivers: "file", "cache"
    |
    */

    'maintenance' => [
        'driver' => env('APP_MAINTENANCE_DRIVER', 'file'),
        'store' => env('APP_MAINTENANCE_STORE', 'database'),
    ],

];

===== config\database.php =====
<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for database operations. This is
    | the connection which will be utilized unless another connection
    | is explicitly specified when you execute a query / statement.
    |
    */

    'default' => env('DB_CONNECTION', 'sqlite'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Below are all of the database connections defined for your application.
    | An example configuration is provided for each database system which
    | is supported by Laravel. You're free to add / remove connections.
    |
    */

    'connections' => [

        'sqlite' => [
            'driver' => 'sqlite',
            'url' => env('DB_URL'),
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
            'busy_timeout' => null,
            'journal_mode' => null,
            'synchronous' => null,
            'transaction_mode' => 'DEFERRED',
        ],

        'mysql' => [
            'driver' => 'mysql',
            'url' => env('DB_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'laravel'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => env('DB_CHARSET', 'utf8mb4'),
            'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        'mariadb' => [
            'driver' => 'mariadb',
            'url' => env('DB_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'laravel'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => env('DB_CHARSET', 'utf8mb4'),
            'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        'pgsql' => [
            'driver' => 'pgsql',
            'url' => env('DB_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'laravel'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => env('DB_CHARSET', 'utf8'),
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',
            'sslmode' => 'prefer',
        ],

        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'url' => env('DB_URL'),
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE', 'laravel'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => env('DB_CHARSET', 'utf8'),
            'prefix' => '',
            'prefix_indexes' => true,
            // 'encrypt' => env('DB_ENCRYPT', 'yes'),
            // 'trust_server_certificate' => env('DB_TRUST_SERVER_CERTIFICATE', 'false'),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run on the database.
    |
    */

    'migrations' => [
        'table' => 'migrations',
        'update_date_on_publish' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer body of commands than a typical key-value system
    | such as Memcached. You may define your connection settings here.
    |
    */

    'redis' => [

        'client' => env('REDIS_CLIENT', 'phpredis'),

        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'),
            'prefix' => env('REDIS_PREFIX', Str::slug((string) env('APP_NAME', 'laravel')).'-database-'),
            'persistent' => env('REDIS_PERSISTENT', false),
        ],

        'default' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_DB', '0'),
            'max_retries' => env('REDIS_MAX_RETRIES', 3),
            'backoff_algorithm' => env('REDIS_BACKOFF_ALGORITHM', 'decorrelated_jitter'),
            'backoff_base' => env('REDIS_BACKOFF_BASE', 100),
            'backoff_cap' => env('REDIS_BACKOFF_CAP', 1000),
        ],

        'cache' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_CACHE_DB', '1'),
            'max_retries' => env('REDIS_MAX_RETRIES', 3),
            'backoff_algorithm' => env('REDIS_BACKOFF_ALGORITHM', 'decorrelated_jitter'),
            'backoff_base' => env('REDIS_BACKOFF_BASE', 100),
            'backoff_cap' => env('REDIS_BACKOFF_CAP', 1000),
        ],

    ],

];

```

== Selesai ==
