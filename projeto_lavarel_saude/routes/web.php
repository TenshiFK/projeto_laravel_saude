<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\MedicoController;
use Illuminate\Support\Facades\Route;


//rotas após autenticação/login.
//todas paginas que so podem ser vista apos login, estarão aqui!  

// Route::get('/consultas', [AppController::class, 'consultas'])->name('interno.consultas');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/agendamento', [AppController::class, 'agendamento'])->name('interno.agendamento');
    Route::get('/agendamento', [MedicoController::class, 'listMedicosagendamento'])->name('interno.agendamento');
    Route::get('/agendamento/{medicoId}', [ConsultaController::class, 'agendamento_medico'])->name('interno.agendamento_medico');
    
   
    Route::get('/consultas/{id}', [ConsultaController::class, 'listarConsultas'])->name('interno.consultas');
    Route::post('/consultas/post', [ConsultaController::class, 'storeConsultas'])->name('consulta.insert');

    Route::post('/consultas', [ConsultaController::class, 'storeConsultas'])->name('consulta.insert');
    Route::get('/consulta/{consultaId}', [ConsultaController::class, 'detalharConsulta'])->name('interno.consulta');
    Route::get('/consulta/{consultaId}/edit', [ConsultaController::class, 'editConsulta'])->name('interno.edit-consulta');
    Route::put('/consulta/{consultaId}', [ConsultaController::class, 'updateConsulta'])->name('update-consulta.post');

    Route::post('/consultas', [AppController::class, 'edit'])->name('edit-consulta.post');

    Route::delete('delete/{id}', [ConsultaController::class, 'destroyConsulta'])->name('consulta.destroy');

    Route::get('/medicos', [MedicoController::class, 'medicos'])->name('interno.medicos');
    Route::get('/medicos', [MedicoController::class, 'listMedicos'])->name('interno.medicos');
    Route::get('/medico_informacao/{id}', [MedicoController::class, 'medicoinformacao'])->name('interno.medico_informacao');
});

Route::get('/home', [AppController::class, 'home'])->name('interno.home')->middleware('auth');

//rotas antes da autenticação/login.
Route::get('/', [SiteController::class, 'index'])->name('site.index');

//autenticações
Route::get('/login', [AuthController::class, 'login'])->name('site.login');
Route::get('/redirectlogin', [AuthController::class, 'redirectlogin'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::get('/logout', [AuthController::class, 'loginDestroy'])->name('login.destroy');
Route::get('/cadastro', [AuthController::class, 'cadastro'])->name('site.cadastro');
Route::post('/cadastro', [AuthController::class, 'cadastroPost'])->name('cadastro.post');
