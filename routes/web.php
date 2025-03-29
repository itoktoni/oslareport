<?php

use App\Dao\Enums\Core\MenuType;
use App\Dao\Enums\Core\NotificationType;
use App\Events\SendBroadcast;
use App\Http\Controllers\Core\HomeController;
use App\Http\Controllers\PublicController;
use Buki\AutoRoute\AutoRouteFacade as AutoRoute;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Plugins\Query;

Route::get('console', [HomeController::class, 'console'])->name('console');
Route::get('test', function () {

    $notification = new \MBarlow\Megaphone\Types\Important(
        'Expected Downtime!', // Notification Title
        'We are expecting some downtime today at around 15:00 UTC for some planned maintenance.', // Notification Body
        'https://example.com/link', // Optional: URL. Megaphone will add a link to this URL within the Notification display.
        'Read More...' // Optional: Link Text. The text that will be shown on the link button.
    );

    sendNotification($notification, NotificationType::Error);

//     $ably   = new \Ably\AblyRest(env('ABLY_KEY'));

//     $channel = $ably->channels->get('private-broadcast');
//   $channel->publish('bell', 'test');

});

Route::get('/signout', 'App\Http\Controllers\Auth\LoginController@logout')->name('signout');
Route::get('/home', 'App\Http\Controllers\Core\HomeController@index')->middleware(['access'])->name('home');
Route::get('/delete/{code}', 'App\Http\Controllers\Core\HomeController@delete')->middleware(['access'])->name('delete_url');
Route::get('/doc', 'App\Http\Controllers\Core\HomeController@doc')->middleware(['access'])->name('doc');

Route::match(['POST', 'GET'], 'change-password', 'App\Http\Controllers\Core\UserController@changePassword', ['name' => 'change-password'])->middleware('auth');
Route::get('profile', 'App\Http\Controllers\Core\UserController@getProfile')->middleware('auth')->name('getProfile');
Route::post('profile', 'App\Http\Controllers\Core\UserController@updateProfile')->middleware('auth')->name('updateProfile');
Auth::routes(['verify' => true]);

Route::get('/', [PublicController::class, 'index'])->name('public');
Route::post('/checkout', [PublicController::class, 'checkout'])->middleware('auth')->name('checkout');

try {
    $routes = Query::groups();
} catch (\Throwable $th) {
    $routes = [];
}

if ($routes) {
    Route::middleware(['auth', 'access'])->group(function () use ($routes) {
        Route::prefix('admin')->group(function () use ($routes) {
            if ($routes) {
                foreach ($routes as $group) {
                    Route::group(['prefix' => $group->field_primary, 'middleware' => [
                        'auth',
                        'access',
                    ]], function () use ($group) {
                        // -- nested group
                        if ($menus = $group->has_menu) {
                            foreach ($menus as $menu) {

                                if ($menu->field_type == MenuType::Menu) {

                                    Route::group(['prefix' => 'default'], function () use ($menu) {
                                        try {
                                            AutoRoute::auto($menu->field_url, $menu->field_controller, ['name' => $menu->field_primary]);
                                        } catch (\Throwable$th) {
                                            //throw $th;
                                        }
                                    });

                                } elseif ($menu->field_type == MenuType::Group) {

                                    if ($links = $menu->has_link) {
                                        Route::group(['prefix' => $menu->field_url], function () use ($links) {
                                            foreach ($links as $link) {

                                                try {
                                                    AutoRoute::auto($link->field_url, $link->field_controller, ['name' => $link->field_primary]);
                                                } catch (\Throwable$th) {
                                                    //throw $th;
                                                }

                                            }
                                        });
                                    }
                                }
                            }
                        }
                        // end nested group

                    });
                }
            }
        });
    });
}
