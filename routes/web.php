<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Route::get('/test-mail', function () {
//     Mail::raw('Test Mailgun', function ($message) {
//         $message->to('salementemaria05@gmail.com')->to('mdwn5621@gmail.com')
//             ->subject('TESTING MAMSER')->html("<h1>SEND GCASH TAG PISO PANG SAMGYUP</h1>");
//     });

//     return 'Sent!';
// }); // Sample email route for testing mailgun setup. not working yet since mailgun needs to be activated