<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EtablissementController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MentionController;
use App\Http\Controllers\TemoignageController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\URL;  // <-- ajouté
use Illuminate\Support\Carbon;       // <-- ajouté

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'welcome'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::get('/temoignages', [TemoignageController::class, 'index'])->name('temoignages.index');
Route::post('/temoignages', [TemoignageController::class, 'store'])->middleware('auth')->name('temoignages.store');
/**
 * Route de vérification d'email sans besoin d'être connecté (évite erreur 403)
 */
Route::get('/email/verify/{id}/{hash}', function ($id, $hash) {
    $user = User::findOrFail($id);

    // Vérifier la signature de l'URL
    if (! URL::hasValidSignature(request())) {
        abort(403);
    }

    // Vérifier que le hash correspond bien à l'email
    if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
        abort(403);
    }

    // Marquer l'email comme vérifié si ce n'est pas déjà fait
    if (! $user->hasVerifiedEmail()) {
        $user->markEmailAsVerified();
    }

    return redirect('/login')->with('success', 'Email vérifié avec succès. Vous pouvez maintenant vous connecter.');
})->name('verification.verify')->middleware('signed');


// Désactive la vérification intégrée des routes Auth pour éviter conflits
Auth::routes(['verify' => false]);

Route::get('/classement', [App\Http\Controllers\HomeController::class, 'classement'])->name('classement.public');

Route::middleware(['auth', 'verified'])->group(function () {
    
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/kpis', [App\Http\Controllers\KpiController::class, 'index'])->name('kpis.index');
    Route::get('/kpis/create', [App\Http\Controllers\KpiController::class, 'create'])->name('kpis.create');
    Route::post('/kpis', [App\Http\Controllers\KpiController::class, 'store'])->name('kpis.store');
    Route::get('/kpis/{kpi}/edit', [App\Http\Controllers\KpiController::class, 'edit'])->name('kpis.edit');
    Route::put('/kpis/{kpi}', [App\Http\Controllers\KpiController::class, 'update'])->name('kpis.update');

    Route::get('/evaluation', [EvaluationController::class, 'index'])->name('evaluation.questions');
    Route::post('/evaluation', [EvaluationController::class, 'store'])->name('evaluation.store');
    Route::get('/mention/note', [MentionController::class, 'resultats'])->name('mention.resultats');

    Route::get('/changer-mot-de-passe', [LoginController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/changer-mot-de-passe', [LoginController::class, 'updatePassword'])->name('password.update');

    Route::get('/kpi/classement', [App\Http\Controllers\KpiClassementController::class, 'create'])->name('kpi.classement.create');
    Route::post('/kpi/classement', [App\Http\Controllers\KpiClassementController::class, 'store'])->name('kpi.classement.store');
    Route::resource('etablissements', EtablissementController::class);
    Route::resource('mentions', MentionController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/etudiant/espace', [App\Http\Controllers\EtudiantController::class, 'espace'])->name('etudiant.espace');
    Route::post('/etudiant/photo', [App\Http\Controllers\EtudiantController::class, 'uploadPhoto'])->name('etudiant.photo');
});





