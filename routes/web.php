<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Route::get('/test-mail', function () {
//     Mail::raw('Test Mailgun', function ($message) {
//         $message->to('tristanmalubay10@gmail.com')
//             ->subject('Mailgun Test');
//     });

//     return 'Sent!';
// }); // Sample email route for testing mailgun setup. not working yet since mailgun needs to be activated