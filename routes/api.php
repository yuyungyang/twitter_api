<?php

use Illuminate\Http\Request;
use App\Http\Controllers\TweetsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

# 1.1 Authenticate with Twitter OAuth
Route::get('/user/auth', [UserController::class, 'redirectToTwitter']);

# 1.2 Twitter OAuth Callback
Route::get('/user/auth/callback', [UserController::class, 'redirectToTwitter']);

Route::prefix('tweet')->group(function () {

    # 2.1 Get tweets
    Route::get('/v1/tweet', [TweetsController::class, 'index']);

    # 2.2 Get tweet by id
    Route::get('/v1/tweet/{id}', [TweetsController::class, 'show']);

    # 2.3 Post tweet
    Route::post('/v1/tweet', [TweetsController::class, 'store']);

    # 2.4 Retweet a tweet
    Route::post('/v1/tweet/{id}/retweet', [TweetController::class, 'retweet']);

    # 2.5 Star a tweet
    Route::post('/v1/tweet/{id}/star', [TweetController::class, 'star']);

    # 2.6 Reply to a tweet 
    Route::post('/v1/tweet/{id}/reply', [TweetReplyController::class, 'store']);

    # 2.7 Star a tweet reply
    Route::post('/v1/tweet/{id}/reply/{rid}/star', [TweetReplyController::class, 'star']);

    # 2.8 Thread tweets
    Route::get('/v1/tweet/thread', [TweetController::class, 'thread']);

});