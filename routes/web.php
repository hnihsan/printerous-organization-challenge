<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::middleware('auth')->group(function(){
   Route::get('dashboard', function(){
      return view('pages.dashboard');
   });

   Route::prefix('organizations')
       ->group(function(){
          Route::get('', function(){
              return view('pages.organizations.index');
          }) ;

          Route::get('add', function(){
             return view('pages.organizations.add');
          });

          Route::post('add', 'Organizations\Add');

          Route::get('detail/{id}', 'Organizations\Detail');

          Route::get('edit/{id}', 'Organizations\Edit');

          Route::post('update', 'Organizations\Update');

           Route::get('delete/{id}', 'Organizations\Delete');
       });

   Route::prefix('persons')->group(function(){
       Route::get('add/{id}', 'Persons\Add');
       Route::post('add/{id}', 'Persons\Add@execute');

       Route::get('edit/{org_id}/{id}', 'Persons\Edit');
       Route::post('edit/{org_id}', 'Persons\Update');

       Route::get('delete/{id}', 'Persons\Delete');
   });
});

Route::prefix('auth')->group(function (){
    Route::prefix('login')->group(function (){
        Route::get('', function (){
            return view('auth.login');
        })->name('login');

        Route::post('', 'Auth\LoginController');
    });

    Route::get('logout', 'Auth\LogoutController')->middleware('auth');
});
